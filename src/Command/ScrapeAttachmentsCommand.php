<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Command;

use Derhaeuptling\ContaoImmoscout24\Repository\AttachmentRepository;
use Derhaeuptling\ContaoImmoscout24\Synchronizer\FileScraper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webmozart\PathUtil\Path;

class ScrapeAttachmentsCommand extends Command
{
    /** @var AttachmentRepository */
    private $attachmentRepository;

    /** @var FileScraper */
    private $fileScraper;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var string */
    private $projectDir;

    public function __construct(AttachmentRepository $attachmentRepository, FileScraper $imageScraper, ManagerRegistry $registry, string $projectDir)
    {
        parent::__construct();

        $this->attachmentRepository = $attachmentRepository;
        $this->fileScraper = $imageScraper;
        $this->entityManager = $registry->getManager();
        $this->projectDir = $projectDir;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Scrape immoscout24 attachments (such as image files).')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("<comment>Scraping resources...</comment>\n");

        foreach ($this->attachmentRepository->findWaitingToBeScraped() as $attachment) {
            $scrapingUrl = $attachment->getScrapingUrl();

            if (null === $scrapingUrl) {
                $output->writeln("   * No valid url found for attachment ID {$attachment->getId()}.");
                continue;
            }

            $file = $this->fileScraper->scrape(
                $scrapingUrl,
                $this->getTargetPath(
                    $attachment->getRealEstate()->getId(),
                    $attachment->getId(),
                    Path::getExtension($scrapingUrl)
                )
            );

            if (null === $file) {
                $output->writeln("   * Could not download attachment ID {$attachment->getId()}.");
                continue;
            }

            $attachment->setImage($file);

            $output->writeln("   * ID {$attachment->getId()}");
            $output->writeln("    - Url: $scrapingUrl");
            $output->writeln("    - File: {$file->path}");
        }

        $this->entityManager->flush();
        $output->writeln(' > Done.');

        return 0;
    }

    private function getTargetPath(int $realEstateId, int $attachmentId, string $extension): string
    {
        return sprintf(
            '%s/files/immoscout24/attachment_%s_%s.%s',
            $this->projectDir, $realEstateId, $attachmentId, $extension
        );
    }
}
