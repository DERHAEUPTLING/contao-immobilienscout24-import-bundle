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

use Contao\CoreBundle\Image\PictureFactory;
use Doctrine\ORM\Event\LifecycleEventArgs;

class AttachmentListener
{
    /** @var PictureFactory */
    private $pictureFactory;

    /** @var string */
    private $projectDir;

    public function __construct(PictureFactory $pictureFactory, string $projectDir)
    {
        $this->pictureFactory = $pictureFactory;
        $this->projectDir = $projectDir;
    }

    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        if (method_exists($entity, 'setPictureRendererService')) {
            $entity->setPictureRendererService($this->pictureFactory, $this->projectDir);
        }
    }
}
