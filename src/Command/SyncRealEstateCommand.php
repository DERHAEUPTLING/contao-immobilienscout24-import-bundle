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

use Contao\CoreBundle\Filesystem\VirtualFilesystemInterface;
use Derhaeuptling\ContaoImmoscout24\Api\Client;
use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Derhaeuptling\ContaoImmoscout24\Repository\AccountRepository;
use Derhaeuptling\ContaoImmoscout24\Repository\RealEstateRepository;
use Derhaeuptling\ContaoImmoscout24\Synchronizer\SynchronizerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SyncRealEstateCommand extends Command
{
    public function __construct(
        private readonly SynchronizerFactory $synchronizerFactory,
        private readonly AccountRepository $accountRepository,
        private readonly RealEstateRepository $realEstateRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly VirtualFilesystemInterface $immoscoutAttachmentStorage
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Synchronizes the database with the API.')
            ->addArgument('id', InputArgument::OPTIONAL, 'Account id or description.')
            ->addOption('purge', 'p', InputOption::VALUE_NONE, 'Purge the database and downloaded files.')
            ->addOption('dry-run', 'd', InputOption::VALUE_NONE, 'Run dry, do not apply changes.')
            ->addOption('connections', 'c', InputOption::VALUE_REQUIRED, 'Max host connections.', 6)
            ->addOption('timeout', 't', InputOption::VALUE_REQUIRED, 'Request timeout.', 5)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $purge = $input->getOption('purge');
        $dryRun = $input->getOption('dry-run');

        if ($purge && $dryRun) {
            $output->writeln('Cannot use option `purge` together with `dry-run`. Aborting.');

            return 1;
        }

        if ($purge) {
            $output->writeln('Purging... (this may take a while if there are many files)');

            foreach ($this->realEstateRepository->findAll() as $realEstate) {
                $this->entityManager->remove($realEstate);
                $output->write('.');
            }

            foreach ($this->immoscoutAttachmentStorage->listContents('', true)->files() as $item) {
                $this->immoscoutAttachmentStorage->delete($item->getPath());
                $output->write('.');
            }

            $this->entityManager->flush();
            $output->writeln("\nPurged real estate database and storage.");
        }

        if ($dryRun) {
            $output->writeln('Dry running without applying changes...');
        }

        /** @var Account[] $accounts */
        $accounts = array_filter(
            $this->getAccounts($input->getArgument('id')),
            static function (Account $account) {
                return $account->isSyncEnabled();
            }
        );

        if (empty($accounts)) {
            $output->writeln('Nothing to do - no (enabled) accounts were found.');

            return 1;
        }

        $error = false;
        foreach ($accounts as $account) {
            $client = new Client(
                $account,
                (int) $input->getOption('timeout'),
                (int) $input->getOption('connections')
            );

            $synchronizer = $this->synchronizerFactory->create($client, $account, $output);
            $success = $synchronizer->synchronizeAllRealEstate();

            if ($success && !$dryRun) {
                $synchronizer->persistChanges();
            }

            $error |= !$success;
        }

        return $error ? 1 : 0;
    }

    /**
     * @return Account[]
     */
    private function getAccounts(?string $id): array
    {
        if (null === $id) {
            return $this->accountRepository->findAll();
        }

        $account = $this->accountRepository->findByIdOrDescription($id);
        if (null === $account) {
            throw new \InvalidArgumentException('Could not find account - invalid id or description.');
        }

        return [$account];
    }
}
