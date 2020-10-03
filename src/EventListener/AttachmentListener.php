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
    /** @var PictureFactory */
    private $pictureFactory;

    /** @var string */
    private $projectDir;

    /** @var ContaoFramework */
    private $framework;

    public function __construct(PictureFactory $pictureFactory, string $projectDir, ContaoFramework $framework)
    {
        $this->pictureFactory = $pictureFactory;
        $this->projectDir = $projectDir;
        $this->framework = $framework;
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
