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

use Derhaeuptling\ContaoImmoscout24\Entity\Account;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AccountRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function findByIdOrDescription(string $identifier): ?Account
    {
        /** @var Account $account */
        $account = $this->findOneBy(['id' => $identifier]);

        if (null === $account) {
            $account = $this->findOneBy(['description' => $identifier]);
        }

        return $account;
    }
}
