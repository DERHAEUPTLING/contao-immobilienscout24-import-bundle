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

use PHPUnit\Framework\TestCase;

class DerhaeuptlingContaoImmobilienscout24BundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new DerhaueptlingContaoImmobilienscout24Bundle();
        $this->assertInstanceOf(DerhaueptlingContaoImmobilienscout24Bundle::class, $bundle);
    }
}
