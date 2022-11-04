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
use Contao\CoreBundle\Filesystem\VirtualFilesystemInterface;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Translation\Translator;
use Contao\Input;
use Contao\ModuleModel;
use Contao\StringUtil;
use Contao\Template;
use Derhaeuptling\ContaoImmoscout24\Repository\RealEstateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RealEstateReaderController extends AbstractRealEstateController
{
    public function __construct(
        private readonly RealEstateRepository $realEstateRepository,
        Studio $studio,
        VirtualFilesystemInterface $immoscoutAttachmentStorage,
        Translator $translator
    ) {
        parent::__construct($studio, $immoscoutAttachmentStorage, $translator);
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
        $this->addDataHelpers($template, $model);

        return new Response($template->parse());
    }
}
