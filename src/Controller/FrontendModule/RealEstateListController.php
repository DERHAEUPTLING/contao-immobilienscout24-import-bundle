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
use Derhaeuptling\ContaoImmoscout24\Repository\RealEstateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RealEstateListController extends AbstractRealEstateController
{
    /** @var AccountRepository */
    private $accountRepository;

    /** @var RealEstateRepository */
    private $realEstateRepository;

    /**
     * RealEstateList constructor.
     */
    public function __construct(AccountRepository $accountRepository, RealEstateRepository $realEstateRepository, Translator $translator)
    {
        parent::__construct($translator);

        $this->accountRepository = $accountRepository;
        $this->realEstateRepository = $realEstateRepository;
    }

    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {
        $accountIds = StringUtil::deserialize($model->immoscout24_accounts, true);
        $conditionExpression = (string) $model->immoscout24_filter;
        $maxResult = (int) $model->immoscout24_number_of_items;

        // real estate data by account
        $accountData = [];
        foreach ($accountIds as $accountId) {
            /** @var Account|null $account */
            $account = $this->accountRepository->find((int) $accountId);
            if (null === $account) {
                continue;
            }

            $realEstates = $this->realEstateRepository
                ->findByAccountAndConditionExpression($account, $conditionExpression, $maxResult)
            ;

            $accountData[] = [
                'id' => $account->getId(),
                'description' => $account->getDescription(),
                'realEstates' => $realEstates,
            ];
        }

        $template->accounts = $accountData;

        // attachment meta data
        $template->defaultImageSize = StringUtil::deserialize($model->imgSize, true);

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
