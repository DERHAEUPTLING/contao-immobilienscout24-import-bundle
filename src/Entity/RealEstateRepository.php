<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Entity;

use Doctrine\ORM\EntityRepository;

class RealEstateRepository extends EntityRepository
{
    public function findByRealEstateId(string $realEstateId): ?RealEstate
    {
        /** @var RealEstate $realEstate */
        return $this->findOneBy(['realEstateId' => $realEstateId]);
    }
}
