<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\EventListener;

use Contao\CoreBundle\Translation\Translator;
use Derhaeuptling\ContaoImmoscout24\Entity\Account as AccountEntity;
use Derhaeuptling\ContaoImmoscout24\Repository\AccountRepository;

class Account
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

    public function onLabelCallback(array $row): string
    {
        /** @var AccountEntity $account */
        $account = $this->accountRepository->find($row['id']);

        $syncedElementsLabel = sprintf(
            $this->translator->trans('tl_immoscout24_account.imported_elements', [], 'contao_default'),
            \count($account->getRealEstates())
        );

        return sprintf(
            '%s<span style="color: #999; margin-left: .5em;">[%s]</span>',
            $account->getDescription(),
            $syncedElementsLabel
        );
    }

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
}
