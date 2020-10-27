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

use Derhaeuptling\ContaoImmoscout24\Api\Client;
use Derhaeuptling\ContaoImmoscout24\Api\ClientFactory;
use Derhaeuptling\ContaoImmoscout24\Api\PermissionDeniedException;
use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Derhaeuptling\ContaoImmoscout24\Repository\RealEstateRepository;
use Derhaeuptling\ContaoImmoscout24\Util\RealEstateFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Synchronizer
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var RealEstateRepository */
    private $realEstateRepository;

    /** @var Client */
    private $client;

    /** @var RealEstateFormatter */
    private $formatter;

    /** @var OutputInterface */
    private $output;

    /** @var Account */
    private $account;

    /**
     * Synchronizer constructor.
     */
    public function __construct(RegistryInterface $registry, RealEstateRepository $realEstateRepository, RealEstateFormatter $formatter, Account $account, OutputInterface $output = null)
    {
        $this->entityManager = $registry->getManager();
        $this->realEstateRepository = $realEstateRepository;
        $this->client = (new ClientFactory())->create($account);
        $this->formatter = $formatter;
        $this->account = $account;
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
        $this->output(' > Importing from API…');

        $apiItems = [];
        try {
            $startTime = microtime(true);
            foreach ($this->client->getAllRealEstate() as $apiItem) {
                $apiItems[] = $apiItem;
                $this->output("   * Real Estate ID {$apiItem->getRealEstateId()}");
                $this->output("     - Title: {$apiItem->getTitle()}");

                $attachments = $this->client->getAttachments($apiItem);
                $apiItem->setAttachments($attachments);
                $this->output(sprintf('     - %d Attachment(s)', \count($attachments)));
            }
            $duration = round(microtime(true) - $startTime, 2);
            $count = \count($apiItems);

            $this->output(" > Downloaded {$count} elements in {$duration}s.\n");
        } catch (PermissionDeniedException $e) {
            $this->output(" > <error>API access for account '{$this->account->getDescription()}' failed: '{$e->getMessage()}'</error>");

            restore_error_handler();

            return false;
        }

        // synchronize
        $this->output(' > Synchronizing…');
        $untouched = 0;
        $created = 0;
        $updated = 0;
        $removed = 0;

        $this->entityManager->beginTransaction();

        $mappedElementIds = [];
        $updatedElements = [];

        foreach ($apiItems as $apiItem) {
            /** @var RealEstate $localItem */
            $localItem = $this->realEstateRepository->findByRealEstateId($apiItem->getRealEstateId());
            $mappedElementIds[] = $apiItem->getRealEstateId();

            // add new
            if (null === $localItem) {
                $this->entityManager->persist($apiItem);
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
                $this->output(
                    sprintf('   * <bg=red>Warning: Skipping ID %s (already persisted via account \'%s\')</>',
                        $apiItem->getRealEstateId(),
                        $localItem->getImmoscoutAccount()->getDescription()
                    )
                );

                continue;
            }

            $localItem->update($apiItem);
            $updatedElements[] = $localItem;
        }

        if ($removeIfUnavailable) {
            // remove obsolete
            /** @var RealEstate $item */
            foreach ($this->account->getRealEstates() as $item) {
                if (!\in_array($item->getRealEstateId(), $mappedElementIds, true)) {
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

        $unitOfWork = $this->entityManager->getUnitOfWork();
        $unitOfWork->computeChangeSets();
        $attributesWithLabels = $this->formatter->getAttributes();

        $formatProperty = function ($input, string $property) {
            $string = $this->formatter->format($input, $property) ?: '""';

            return mb_strimwidth($string, 0, 50, '…');
        };

        foreach ($updatedElements as $item) {
            $changeSet = $unitOfWork->getEntityChangeSet($item);

            if (!empty($changeSet)) {
                ++$updated;

                $this->output(sprintf('   * <fg=yellow>Updated record ID %s</>', $item->getRealEstateId()));

                foreach ($changeSet as $property => $change) {
                    $this->output(
                        sprintf('     - %s: %s → %s',
                            $attributesWithLabels[$property] ?? '?',
                            $formatProperty($change[0], $property),
                            $formatProperty($change[1], $property),
                        )
                    );
                }
            } else {
                ++$untouched;
            }
        }

        $this->entityManager->commit();

        $this->output(" > Done - created: $created | updated: $updated | removed: $removed | untouched: $untouched");

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
