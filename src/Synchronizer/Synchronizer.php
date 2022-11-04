<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Synchronizer;

use Contao\CoreBundle\Filesystem\VirtualFilesystemInterface;
use Derhaeuptling\ContaoImmoscout24\Api\Client;
use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Derhaeuptling\ContaoImmoscout24\Repository\RealEstateRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use League\Flysystem\UnableToDeleteFile;
use Symfony\Component\Console\Output\OutputInterface;

class Synchronizer
{
    private ObjectManager $entityManager;
    private ?OutputInterface $output;

    public function __construct(
        ManagerRegistry $registry,
        private readonly RealEstateRepository $realEstateRepository,
        private readonly Client $client,
        private readonly Account $account,
        private readonly VirtualFilesystemInterface $immoscoutAttachmentStorage,
        OutputInterface $output = null
    ) {
        $this->entityManager = $registry->getManager();
        $this->output = $output;
    }

    /**
     * Collect data from the API and merge it into the local copy.
     */
    public function synchronizeAllRealEstate(bool $removeIfUnavailable = true): bool
    {
        set_error_handler(function (string $code, string $message): void {
            $this->output(" ! <error>$message</error>");
        });

        // prevent mysql server from closing the connection prematurely
        $this->entityManager
            ->getConnection()
            ->exec('SET SESSION wait_timeout = 28000, interactive_timeout = 28800')
        ;

        // gather data from API
        $this->output("\n<comment>[{$this->account->getDescription()}]</comment>\n");

        $apiItems = [];
        $startTime = microtime(true);

        $this->output(' > Loading real estate objects from API...');
        foreach ($this->client->getAllRealEstate() as $apiItem) {
            $apiItems[] = $apiItem;
            $this->output("   * ID {$apiItem->getRealEstateId()} ({$apiItem->getTitle()})");
        }

        $this->output(' > Loading attachments from API...');
        foreach ($this->client->getAndSetAttachments($apiItems) as [$realEstateId, $attachmentCount]) {
            $this->output("   * ID $realEstateId ($attachmentCount attachments)");
        }

        // synchronize
        $this->output(' > Synchronizing...');
        $created = 0;
        $updated = 0;
        $removed = 0;

        $this->entityManager->beginTransaction();

        $mappedElements = [];
        $attachmentsToScrape = [];

        foreach ($apiItems as $apiItem) {
            /** @var RealEstate $localItem */
            $localItem = $this->realEstateRepository->findByRealEstateId($apiItem->getRealEstateId());
            $mappedElements[] = $apiItem->getRealEstateId();

            // add new
            if (null === $localItem) {
                $this->entityManager->persist($apiItem);
                $attachmentsToScrape = [...$attachmentsToScrape, ...$apiItem->getAttachments()->toArray()];
                ++$created;

                $this->output(
                    sprintf('   * <fg=green>Created record ID %s</>',
                        $apiItem->getRealEstateId()
                    )
                );

                continue;
            }

            // update (potentially) modified
            if ($apiItem->getImmoscoutAccount()->getId() !== $localItem->getImmoscoutAccount()->getId()) {
                $attachmentsToScrape = [...$attachmentsToScrape, ...$apiItem->getAttachments()->toArray()];

                $this->output(
                    sprintf('   * <bg=red>Warning: Skipping ID %s (already persisted via account \'%s\')</>',
                        $apiItem->getRealEstateId(),
                        $localItem->getImmoscoutAccount()->getDescription()
                    )
                );

                continue;
            }

            try {
                $localItem->update($apiItem);
                ++$updated;

                $this->output(
                    sprintf('   * <fg=yellow>Merged record ID %s</>',
                        $apiItem->getRealEstateId()
                    )
                );
            } catch (ItemAlreadyUpToDateException $e) {
                $this->output(
                    sprintf('   * Already up to date: Skipping ID %s (%s)',
                        $apiItem->getRealEstateId(),
                        $e->getMessage()
                    )
                );
            }
        }

        if ($removeIfUnavailable) {
            // remove obsolete
            /** @var RealEstate $item */
            foreach ($this->account->getRealEstates() as $item) {
                if (!\in_array($item->getRealEstateId(), $mappedElements, true)) {
                    foreach ($item->getAttachments() as $attachment) {
                        if (null !== ($file = $attachment->getFile())) {
                            try {
                                $this->immoscoutAttachmentStorage->delete($file);
                            } catch (UnableToDeleteFile) {
                                // ignore
                            }
                        }
                    }

                    $this->entityManager->remove($item);
                    ++$removed;

                    $this->output(
                        sprintf('   * <fg=red>Removed record ID %s</>',
                            $item->getRealEstateId()
                        )
                    );
                }
            }
        }

        // scrape attachments
        $downloaded = 0;
        $this->output(' > Scraping attachment files...');

        foreach ($this->client->scrapeAndUpdateAttachments($attachmentsToScrape, $this->immoscoutAttachmentStorage) as $file) {
            $this->output("   * Downloaded file '$file'");
            ++$downloaded;
        }

        $this->entityManager->commit();

        $duration = round(microtime(true) - $startTime, 2);

        $this->output(" > Done - created: $created | updated: $updated | removed: $removed | downloaded files: $downloaded");
        $this->output(" > This operation took {$duration}s.");

        restore_error_handler();

        return true;
    }

    /**
     * Apply changes to the database permanently.
     */
    public function persistChanges(): void
    {
        $this->entityManager->flush();
        $this->output(' > Persisted changes');
    }

    private function output(string $message): void
    {
        if (null !== $this->output) {
            $this->output->writeln($message);
        }
    }
}
