<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Util;

use Contao\CoreBundle\Translation\Translator;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;

class RealEstateFormatter
{
    /** @var Translator */
    private $translator;

    /**
     * RealEstateList constructor.
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Format attribute data based on its RealEstate type. Boolean values and
     * enumerations are automatically resolved if a language file is present.
     */
    public function format($rawValue, string $attribute): ?string
    {
        if (null === $rawValue) {
            return null;
        }

        // don't alter strings and floats
        if (\is_string($rawValue)) {
            return $rawValue;
        }
        if (\is_float($rawValue)) {
            return (string) $rawValue;
        }

        // convert booleans
        if (\is_bool($rawValue)) {
            return $rawValue ?
                $this->translator->trans('immoscout24.yes', [], 'contao_default') :
                $this->translator->trans('immoscout24.no', [], 'contao_default');
        }

        // try to resolve enumerations
        if (\is_int($rawValue)) {
            if ($rawValue >= 0) {
                return $this->getEnumerationValue($attribute, $rawValue);
            }

            // resolve flags
            $flags = [];
            $value = -$rawValue;
            $i = 0;

            while (0 !== $value) {
                if ($value & 1) {
                    $flags[] = 1 << $i;
                }

                ++$i;
                $value >>= 1;
            }

            // list as combined string
            return implode(
                ' / ',
                array_map(function ($value) use ($attribute) {
                    return $this->getEnumerationValue($attribute, $value);
                }, $flags)
            );
        }

        // flatten arrays to comma separated values
        if (\is_array($rawValue)) {
            return implode(', ', $rawValue);
        }

        // fallback to 'none' value
        return $this->translator->trans('immoscout24.none', [], 'contao_default');
    }

    /**
     * List all attributes that can be accessed and auto-formatted with their respective label.
     *
     * @return array<string, string>
     */
    public function getAttributes(): array
    {
        // get all public fields as possible attributes
        $attributes = array_keys(get_object_vars(new RealEstate()));

        $attributesWithLabels = [];
        foreach ($attributes as $attribute) {
            $label = $this->translator->trans('immoscout24.'.$attribute, [], 'contao_default');
            $attributesWithLabels[$attribute] = $label;
        }

        return $attributesWithLabels;
    }

    private function getEnumerationValue(string $attribute, int $rawValue): string
    {
        $key = sprintf('immoscout24.%s_.%d', $attribute, $rawValue);
        $value = $this->translator->trans($key, [], 'contao_default');

        if ($key !== $value) {
            return $value;
        }

        return (string) $rawValue;
    }
}
