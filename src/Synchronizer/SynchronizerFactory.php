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

use Contao\CoreBundle\Filesystem\VirtualFilesystemInterface;
use Derhaeuptling\ContaoImmoscout24\Api\Client;
use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Derhaeuptling\ContaoImmoscout24\Repository\RealEstateRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Output\OutputInterface;

class SynchronizerFactory
{
    public function __construct(
        private readonly ManagerRegistry $registry,
        private readonly RealEstateRepository $realEstateRepository,
        private readonly VirtualFilesystemInterface $immoscoutAttachmentStorage,
    ) {
    }

    public function create(Client $client, Account $account, OutputInterface $output): Synchronizer
    {
        return new Synchronizer(
            $this->registry,
            $this->realEstateRepository,
            $client,
            $account,
            $this->immoscoutAttachmentStorage,
            $output
        );
    }
}
