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

    public function __construct(SynchronizerFactory $synchronizerFactory, AccountRepository $accountRepository)
    {
        parent::__construct();

        $this->synchronizerFactory = $synchronizerFactory;
        $this->accountRepository = $accountRepository;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Synchronizes the database with the API.')
            ->addArgument('id', InputArgument::OPTIONAL, 'Account id or description.')
            ->addOption('dry-run', 'd', InputOption::VALUE_NONE, 'Run dry, do not apply changes.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $dryRun = $input->getOption('dry-run');
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

            return;
        }

        foreach ($accounts as $account) {
            $synchronizer = $this->synchronizerFactory->create($account, $output);

            $synchronizer->synchronizeAllRealEstate();
            if (!$dryRun) {
                $synchronizer->persistChanges();
            }
        }
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
            throw new \InvalidArgumentException('Could not find account - invalid id or api key.');
        }

        return [$account];
    }
}
