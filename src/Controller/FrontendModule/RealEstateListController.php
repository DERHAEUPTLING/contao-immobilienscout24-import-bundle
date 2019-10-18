<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Controller\FrontendModule;

use Contao\CoreBundle\Translation\Translator;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\StringUtil;
use Contao\Template;
use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Derhaeuptling\ContaoImmoscout24\Repository\AccountRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RealEstateListController extends AbstractRealEstateController
{
    /** @var AccountRepository */
    private $accountRepository;

    /**
     * RealEstateList constructor.
     */
    public function __construct(Registry $doctrineRegistry, Translator $translator)
    {
        parent::__construct($translator);

        $this->accountRepository = $doctrineRegistry->getRepository(Account::class);
    }

    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {
        $accountIds = StringUtil::deserialize($model->immoscout24_accounts, true);

        // real estate data by account
        $accountData = [];
        foreach ($accountIds as $accountId) {
            /** @var Account|null $account */
            $account = $this->accountRepository->find((int) $accountId);
            if (null === $account) {
                continue;
            }

            $realEstates = $account->getRealEstates()->toArray();
            usort($realEstates, static function (RealEstate $a, RealEstate $b) {
                // sort real estates by last update
                return $a->modifiedAt <=> $b->modifiedAt;
            });

            $accountData[] = [
                'id' => $account->getId(),
                'description' => $account->getDescription(),
                'realEstates' => $realEstates,
            ];
        }

        $template->accounts = $accountData;

        // labels & data extraction helpers
        $this->addDataHelpers($template);

        // url generation
        $jumpToPage = PageModel::findByPk($model->jumpTo);
        $template->getJumpToUrl = static function (RealEstate $realEstate) use ($jumpToPage) {
            return null !== $jumpToPage ?
                $jumpToPage->getFrontendUrl('/'.$realEstate->getId()) :
                '#';
        };

        return new Response($template->parse());
    }
}
