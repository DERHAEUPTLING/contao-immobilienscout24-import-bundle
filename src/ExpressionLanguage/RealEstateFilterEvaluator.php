<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\ExpressionLanguage;

use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;

class RealEstateFilterEvaluator
{
    /** @var array */
    private $realEstateClassConstants;

    /** @var ExpressionLanguage */
    private $expressionLanguage;

    public function __construct()
    {
        $reflectionClass = new \ReflectionClass(RealEstate::class);
        $this->realEstateClassConstants = $reflectionClass->getConstants();

        $this->expressionLanguage = new ExpressionLanguage();
    }

    public function evaluate(RealEstate $realEstate, string $conditionExpression): ?bool
    {
        $values = $this->compileValues($realEstate);

        try {
            return $this->expressionLanguage->evaluate($conditionExpression, $values);
        } catch (SyntaxError $error) {
            return null;
        }
    }

    /**
     * @throws SyntaxError
     */
    public function validate(string $conditionExpression): void
    {
        if ('' === $conditionExpression) {
            return;
        }

        // throws if invalid
        $this->expressionLanguage->evaluate($conditionExpression, $this->compileValues());
    }

    public function getAvailableVariables(): array
    {
        return array_keys($this->compileValues());
    }

    private function compileValues(RealEstate $object = null): array
    {
        if (null === $object) {
            $object = new RealEstate();
        }

        return array_merge(
            get_object_vars($object),
            $this->realEstateClassConstants
        );
    }
}
