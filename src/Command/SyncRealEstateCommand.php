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
    /** @var SynchronizerFactory */
    private $synchronizerFactory;

    /** @var AccountRepository */
    private $accountRepository;

    /** @var RealEstateRepository */
    private $realEstateRepository;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(SynchronizerFactory $synchronizerFactory, AccountRepository $accountRepository, RealEstateRepository $realEstateRepository, EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->synchronizerFactory = $synchronizerFactory;
        $this->accountRepository = $accountRepository;
        $this->realEstateRepository = $realEstateRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Synchronizes the database with the API.')
            ->addArgument('id', InputArgument::OPTIONAL, 'Account id or description.')
            ->addOption('purge', 'p', InputOption::VALUE_NONE, 'Purge the database and downloaded files.')
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
            $output->writeln('Purging... (this may take a while if there are many files)');

            foreach ($this->realEstateRepository->findAll() as $realEstate) {
                $this->entityManager->remove($realEstate);
                $output->write('.');
            }

            $this->entityManager->flush();
            $output->writeln("\nPurged real estate database and downloaded files.");
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
