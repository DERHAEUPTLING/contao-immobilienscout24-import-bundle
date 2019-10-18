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
use Contao\DataContainer;
use Derhaeuptling\ContaoImmoscout24\Entity\Account as AccountEntity;
use Derhaeuptling\ContaoImmoscout24\ExpressionLanguage\RealEstateFilterEvaluator;
use Derhaeuptling\ContaoImmoscout24\Repository\AccountRepository;
use Symfony\Component\ExpressionLanguage\SyntaxError;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class Module implements ServiceAnnotationInterface
{
    /** @var AccountRepository */
    private $accountRepository;

    /** @var RealEstateFilterEvaluator */
    private $realEstateFilterEvaluator;

    /**
     * Account constructor.
     */
    public function __construct(AccountRepository $accountRepository, RealEstateFilterEvaluator $realEstateFilterEvaluator)
    {
        $this->accountRepository = $accountRepository;
        $this->realEstateFilterEvaluator = $realEstateFilterEvaluator;
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
        if (null === $value) {
            return $value;
        }

        try {
            $this->realEstateFilterEvaluator->validate($value);
        } catch (SyntaxError $e) {
            throw new \InvalidArgumentException('Invalid filter expression: '.$e->getMessage());
        }

        return $value;
    }

    /**
     * @Callback(table="tl_module", target="fields.immoscout24_filter_explanation.input_field")
     */
    public function compileExplanation(DataContainer $dc): string
    {
        $operators = array_map(
            static function (string $v) {
                return "<li>$v</li>";
            },
            ['and', 'or', '==', '>', '>=', '<', '<=', '(', ')']
        );

        $mappings = array_map(
            static function (string $v) {
                return "<li>$v</li>";
            },
            $this->realEstateFilterEvaluator->getAvailableVariables()
        );

        return sprintf(
            '<div class="widget m12 immoscout24_filter_explanation">'.
            '<ul class="operators">%s</ul><ul class="mappings">%s</ul>'.
            '</div>',
            implode('', $operators),
            implode('', $mappings)
        );
    }
}
