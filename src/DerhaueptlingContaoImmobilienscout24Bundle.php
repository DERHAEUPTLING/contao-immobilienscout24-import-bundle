<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DerhaueptlingContaoImmobilienscout24Bundle extends Bundle
{
    public function boot(): void
    {
        // load custom annotations
        AnnotationRegistry::registerLoader('class_exists');
    }
}
