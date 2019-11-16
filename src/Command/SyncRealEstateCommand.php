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

use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Derhaeuptling\ContaoImmoscout24\Repository\AccountRepository;
use Derhaeuptling\ContaoImmoscout24\Synchronizer\SynchronizerFactory;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SyncRealEstateCommand extends Command
{
    /** @var SynchronizerFactory */
    private $synchronizerFactory;

    /** @var AccountRepository */
    private $accountRepository;

    /** @var Connection */
    private $connection;

    public function __construct(SynchronizerFactory $synchronizerFactory, AccountRepository $accountRepository, Connection $connection)
    {
        parent::__construct();

        $this->synchronizerFactory = $synchronizerFactory;
        $this->accountRepository = $accountRepository;
        $this->connection = $connection;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Synchronizes the database with the API.')
            ->addArgument('id', InputArgument::OPTIONAL, 'Account id or description.')
            ->addOption('purge', 'p', InputOption::VALUE_NONE, 'Purge the real estate table.')
            ->addOption('dry-run', 'd', InputOption::VALUE_NONE, 'Run dry, do not apply changes.')
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
            // note: do not use truncate - we need to execute per-row actions (such as FK cascades)
            /* @noinspection SqlWithoutWhere */
            $this->connection->executeQuery('DELETE FROM tl_immoscout24_real_estate');

            $output->writeln('Purged real estate table.');
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
            $synchronizer = $this->synchronizerFactory->create($account, $output);
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
