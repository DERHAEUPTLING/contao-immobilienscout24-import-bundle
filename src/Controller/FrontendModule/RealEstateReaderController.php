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

use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\Input;
use Contao\ModuleModel;
use Contao\StringUtil;
use Contao\Template;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Derhaeuptling\ContaoImmoscout24\Repository\RealEstateRepository;
use Derhaeuptling\ContaoImmoscout24\Util\RealEstateFormatter;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RealEstateReaderController extends AbstractRealEstateController
{
    /** @var RealEstateRepository */
    private $realEstateRepository;

    /**
     * RealEstateList constructor.
     */
    public function __construct(Registry $doctrineRegistry, RealEstateFormatter $formatter)
    {
        parent::__construct($formatter);

        $this->realEstateRepository = $doctrineRegistry->getRepository(RealEstate::class);
    }

    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {
        $id = (int) Input::get('auto_item');

        $realEstate = $this->realEstateRepository->find($id);
        if (null === $realEstate) {
            throw new PageNotFoundException('Invalid real estate.');
        }

        // real estate data
        $template->realEstate = $realEstate;

        // attachment meta data
        $template->defaultImageSize = StringUtil::deserialize($model->imgSize, true);
        $template->alternativeImageSize = StringUtil::deserialize($model->immoscout24_alt_image_size, true);

        // labels & data extraction helpers
        $this->addDataHelpers($template);

        return new Response($template->parse());
    }
}
