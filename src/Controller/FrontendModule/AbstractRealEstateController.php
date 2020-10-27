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

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\Template;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Derhaeuptling\ContaoImmoscout24\Util\RealEstateFormatter;

abstract class AbstractRealEstateController extends AbstractFrontendModuleController
{
    /** @var RealEstateFormatter */
    private $formatter;

    public function __construct(RealEstateFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    protected function addDataHelpers(Template $template): void
    {
        $template->attributes = $this->getAllAttributesWithLabels();

        $template->hasData = function (RealEstate $realEstate, string $attribute): bool {
            return $this->hasData($realEstate, $attribute);
        };

        $template->getFormatted = function (RealEstate $realEstate, string $attribute): ?string {
            return $this->getFormatted($realEstate, $attribute);
        };
    }

    /**
     * Check if an entity's attribute exists and has data present.
     */
    protected function hasData(RealEstate $realEstate, string $attribute): bool
    {
        return property_exists($realEstate, $attribute) && null !== $realEstate->$attribute;
    }

    /**
     * Retrieve and format attribute data based on its type. Boolean values and
     * enumerations are automatically resolved if a language file is present.
     */
    protected function getFormatted(RealEstate $realEstate, string $attribute): ?string
    {
        $rawValue = $realEstate->$attribute ?? null;

        return $this->formatter->format($rawValue, $attribute);
    }

    /**
     * List all attributes that can be accessed and auto-formatted.
     *
     * @return string[]
     */
    protected function getAllAttributesWithLabels(): array
    {
        return $this->formatter->getAttributes();
    }
}
