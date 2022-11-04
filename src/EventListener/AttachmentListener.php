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

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Image\PictureFactory;
use Derhaeuptling\ContaoImmoscout24\Entity\Attachment;
use Doctrine\ORM\Event\LifecycleEventArgs;

class AttachmentListener
{
    public function __construct(
        private readonly PictureFactory $pictureFactory,
        private readonly string $projectDir,
        private readonly ContaoFramework $framework)
    {
    }

    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Attachment) {
            return;
        }

        $entity->setPictureRendererService($this->pictureFactory, $this->projectDir);
        $entity->setContaoFramework($this->framework);
    }
}
