<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Repository;

use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RealEstateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RealEstate::class);
    }

    public function findByRealEstateId(string $realEstateId): ?RealEstate
    {
        /** @var RealEstate $realEstate */
        $realEstate = $this->findOneBy(['realEstateId' => $realEstateId]);

        // do not inline (variable used for type hinting)
        return $realEstate;
    }
}
