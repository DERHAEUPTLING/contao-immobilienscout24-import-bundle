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
use Derhaeuptling\ContaoImmoscout24\Synchronizer\Synchronizer;
use Derhaeuptling\ContaoImmoscout24\Synchronizer\SynchronizerFactory;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\MockObject\Rule\InvocationOrder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class SyncRealEstateCommandTest extends TestCase
{
    private const MESSAGE_DRY_RUN = 'Dry running without applying changes...';
    private const MESSAGE_NOTHING_TO_DO = 'Nothing to do - no (enabled) accounts were found.';
    private const MESSAGE_INVALID_IDENTIFIER = 'Could not find account - invalid id or description.';

    public function testSyncWithPersistingChanges(): void
    {
        $tester = new CommandTester($this->getDefaultCommand($this->once()));
        $code = $tester->execute([]);
        $display = $tester->getDisplay();

        $this->assertSame(0, $code);
        $this->assertStringNotContainsString(self::MESSAGE_DRY_RUN, $display);
    }

    public function testSyncWithDryRunning(): void
    {
        $tester = new CommandTester($this->getDefaultCommand($this->never()));
        $code = $tester->execute(['--dry-run' => true]);
        $display = $tester->getDisplay();

        $this->assertSame(0, $code);
        $this->assertStringContainsString(self::MESSAGE_DRY_RUN, $display);
    }

    public function testSyncReturnsErrorWhenFailing(): void
    {
        $account = $this->getAccount(true);

        $accountRepository = $this->getAccountRepository([
            ['foo', $account],
        ]);

        $synchronizerFactory = $this->getSynchronizerFactory([
            [$account, $this->getSynchronizer(true, $this->once(), $this->never())],
        ]);

        $tester = new CommandTester($this->getSyncRealEstateCommand($synchronizerFactory, $accountRepository));
        $code = $tester->execute([]);

        $this->assertSame(1, $code);
    }

    public function testSyncSingleAccount(): void
    {
        $fooAccount = $this->getAccount(true);
        $barAccount = $this->getAccount(true);

        $accountRepository = $this->getAccountRepository([
            ['foo', $fooAccount],
            ['bar', $barAccount],
        ]);

        $synchronizerFactory = $this->getSynchronizerFactory([
            [$fooAccount, $this->getSynchronizer(false, $this->once(), $this->once())],
            [$barAccount, $this->getSynchronizer(false, $this->never(), $this->never())],
        ]);

        $tester = new CommandTester($this->getSyncRealEstateCommand($synchronizerFactory, $accountRepository));
        $code = $tester->execute(['id' => 'foo']);

        $this->assertSame(0, $code);
    }

    public function testSyncSingleAccountNotFoundWithWrongIdentifier(): void
    {
        $tester = new CommandTester($this->getCommandWithFooAccount(true, $this->never()));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(self::MESSAGE_INVALID_IDENTIFIER);

        $tester->execute(['id' => 'bar']);
    }

    public function testSyncSingleAccountNotFoundIfDisabled(): void
    {
        $tester = new CommandTester($this->getCommandWithFooAccount(false, $this->never()));
        $code = $tester->execute(['id' => 'foo']);
        $display = $tester->getDisplay();

        $this->assertSame(1, $code);
        $this->assertStringContainsString(self::MESSAGE_NOTHING_TO_DO, $display);
    }

    private function getDefaultCommand(InvocationOrder $shouldPersistChanges): SyncRealEstateCommand
    {
        $enabledAccount1 = $this->getAccount(true);
        $enabledAccount2 = $this->getAccount(true);
        $disabledAccount = $this->getAccount(false);

        $accountRepository = $this->getAccountRepository([
            ['foo', $enabledAccount1],
            ['bar', $enabledAccount2],
            ['disabled', $disabledAccount],
        ]);

        $synchronizerFactory = $this->getSynchronizerFactory([
            [$enabledAccount1, $this->getSynchronizer(false, $this->once(), clone $shouldPersistChanges)],
            [$enabledAccount2, $this->getSynchronizer(false, $this->once(), clone $shouldPersistChanges)],
            [$disabledAccount, $this->getSynchronizer(false, $this->never(), $this->never())],
        ]);

        return $this->getSyncRealEstateCommand($synchronizerFactory, $accountRepository);
    }

    private function getCommandWithFooAccount(bool $enabled, InvocationOrder $shouldRun)
    {
        $account = $this->getAccount($enabled);

        $accountRepository = $this->getAccountRepository([
            ['foo', $account],
        ]);

        $synchronizerFactory = $this->getSynchronizerFactory([
            [$account, $this->getSynchronizer(false, $shouldRun, $this->any())],
        ]);

        return $this->getSyncRealEstateCommand($synchronizerFactory, $accountRepository);
    }

    private function getAccount(bool $enabled): Account
    {
        $account = $this->createMock(Account::class);
        $account
            ->method('isSyncEnabled')
            ->willReturn($enabled)
        ;

        return $account;
    }

    private function getAccountRepository(array $mappings): AccountRepository
    {
        $allAccounts = array_map(static function ($mapping) {
            [$identifier, $account] = $mapping;

            return $account;
        }, $mappings);

        $accountRepository = $this->createMock(AccountRepository::class);
        $accountRepository
            ->method('findAll')
            ->willReturn($allAccounts)
        ;

        $accountRepository
            ->method('findByIdOrDescription')
            ->willReturnCallback(static function ($identifierParameter) use ($mappings) {
                foreach ($mappings as [$identifier, $account]) {
                    if ($identifier === $identifierParameter) {
                        return $account;
                    }
                }

                return null;
            })
        ;

        return $accountRepository;
    }

    private function getSynchronizer(bool $withError, InvocationOrder $shouldRun, InvocationOrder $shouldPersistChanges): Synchronizer
    {
        $synchronizer = $this->createMock(Synchronizer::class);
        $synchronizer
            ->expects($shouldRun)
            ->method('synchronizeAllRealEstate')
            ->willReturn(!$withError)
        ;

        $synchronizer
            ->expects($shouldPersistChanges)
            ->method('persistChanges')
        ;

        return $synchronizer;
    }

    private function getSynchronizerFactory(array $mappings): SynchronizerFactory
    {
        $synchronizerFactory = $this->createMock(SynchronizerFactory::class);
        $synchronizerFactory
            ->method('create')
            ->willReturnCallback(static function ($accountParameter) use ($mappings) {
                foreach ($mappings as [$account, $synchronizer]) {
                    if ($account === $accountParameter) {
                        return $synchronizer;
                    }
                }
                throw new AssertionFailedError('Invalid mapping, account not found.');
            })
        ;

        return $synchronizerFactory;
    }

    private function getSyncRealEstateCommand(SynchronizerFactory $synchronizerFactory, AccountRepository $accountRepository): SyncRealEstateCommand
    {
        return new SyncRealEstateCommand(
            $synchronizerFactory,
            $accountRepository,
            $this->createMock(RealEstateRepository::class),
            $this->createMock(EntityManagerInterface::class)
        );
    }
}
