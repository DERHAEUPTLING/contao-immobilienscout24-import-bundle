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
use Contao\CoreBundle\Translation\Translator;
use Contao\Input;
use Contao\ModuleModel;
use Contao\Template;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstateRepository;
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
    public function __construct(Registry $doctrineRegistry, Translator $translator)
    {
        parent::__construct($translator);

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

        // labels & data extraction helpers
        $this->addDataHelpers($template);

        return new Response($template->parse());
    }
}
