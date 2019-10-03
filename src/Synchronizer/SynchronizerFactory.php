<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Synchronizer;

use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Derhaeuptling\ContaoImmoscout24\Repository\RealEstateRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SynchronizerFactory
{
    /** @var RegistryInterface */
    private $registry;

    /** @var RealEstateRepository */
    private $realEstateRepository;

    public function __construct(RegistryInterface $registry, RealEstateRepository $realEstateRepository)
    {
        $this->registry = $registry;
        $this->realEstateRepository = $realEstateRepository;
    }

    public function create(Account $account, OutputInterface $output): Synchronizer
    {
        return new Synchronizer($this->registry, $this->realEstateRepository, $account, $output);
    }
}
