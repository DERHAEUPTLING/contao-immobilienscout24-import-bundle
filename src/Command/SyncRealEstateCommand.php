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
use Derhaeuptling\ContaoImmoscout24\Synchronizer\Synchronizer;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SyncRealEstateCommand extends Command
{
    /** @var Registry */
    private $registry;

    /**
     * TestCommand constructor.
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;

        parent::__construct();
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
            $synchronizer = new Synchronizer($this->registry, $account, $output);
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
        $accountRepository = $this->registry->getRepository(Account::class);

        if (null === $id) {
            return $accountRepository->findAll();
        }

        $account = $accountRepository->findByIdOrDescription($id);
        if (null === $account) {
            throw new \InvalidArgumentException('Could not find account - invalid id or api key.');
        }

        return [$account];
    }
}
