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

use Contao\DataContainer;
use Derhaeuptling\ContaoImmoscout24\Entity\Account as AccountEntity;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Translation\TranslatorInterface;

class Account
{
    /** @var Registry */
    private $doctrineRegistry;

    /** @var TranslatorInterface */
    private $translator;

    /**
     * Account constructor.
     */
    public function __construct(Registry $doctrineRegistry, TranslatorInterface $translator)
    {
        $this->doctrineRegistry = $doctrineRegistry;
        $this->translator = $translator;
    }

    public function onDelete(DataContainer $dc): void
    {
        // todo: check if needed (DELETE cascade)

        /** @var AccountEntity $element */
        $element = $this->doctrineRegistry
            ->getRepository(AccountEntity::class)
            ->find($dc->id)
        ;

        if (null !== $element) {
            $manager = $this->doctrineRegistry->getManager();
            $manager->remove($element);
            $manager->flush();
        }
    }

    public function onGenerateLabel(array $row): string
    {
        /** @var AccountEntity $account */
        $account = $this->doctrineRegistry
            ->getRepository(AccountEntity::class)
            ->find($row['id'])
        ;

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
        $accounts = $this->doctrineRegistry
            ->getRepository(AccountEntity::class)
            ->findAll()
        ;

        $accountList = [];

        foreach ($accounts as $account) {
            $accountList[$account->getId()] = $account->getDescription();
        }

        return $accountList;
    }
}
