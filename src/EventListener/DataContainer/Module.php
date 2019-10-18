<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\CoreBundle\Translation\Translator;
use Contao\DataContainer;
use Derhaeuptling\ContaoImmoscout24\Entity\Account as AccountEntity;
use Derhaeuptling\ContaoImmoscout24\Repository\AccountRepository;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class Module implements ServiceAnnotationInterface
{
    /** @var AccountRepository */
    private $accountRepository;

    /** @var Translator */
    private $translator;

    /**
     * Account constructor.
     */
    public function __construct(AccountRepository $accountRepository, Translator $translator)
    {
        $this->accountRepository = $accountRepository;
        $this->translator = $translator;
    }

    /**
     * @Callback(table="tl_module", target="fields.immoscout24_accounts.options")
     */
    public function listAccounts(): array
    {
        /** @var AccountEntity $account */
        $accounts = $this->accountRepository->findAll();

        $accountList = [];

        foreach ($accounts as $account) {
            $accountList[$account->getId()] = $account->getDescription();
        }

        return $accountList;
    }

    /**
     * @Callback(table="tl_module", target="fields.immoscout24_filter.save")
     */
    public function validateExpression(?string $value, DataContainer $dc): ?string
    {
        // todo

        return $value;
    }
}
