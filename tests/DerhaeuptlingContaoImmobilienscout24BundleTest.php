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
        $bundle = new DerhaeuptlingContaoImmobilienscout24Bundle();
        $this->assertInstanceOf(DerhaeuptlingContaoImmobilienscout24Bundle::class, $bundle);
    }
}
