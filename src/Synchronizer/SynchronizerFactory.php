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
use Derhaeuptling\ContaoImmoscout24\Util\RealEstateFormatter;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SynchronizerFactory
{
    /** @var RegistryInterface */
    private $registry;

    /** @var RealEstateRepository */
    private $realEstateRepository;

    /** @var RealEstateFormatter */
    private $formatter;

    public function __construct(RegistryInterface $registry, RealEstateRepository $realEstateRepository, RealEstateFormatter $formatter)
    {
        $this->registry = $registry;
        $this->realEstateRepository = $realEstateRepository;
        $this->formatter = $formatter;
    }

    public function create(Account $account, OutputInterface $output): Synchronizer
    {
        return new Synchronizer($this->registry, $this->realEstateRepository, $this->formatter, $account, $output);
    }
}
