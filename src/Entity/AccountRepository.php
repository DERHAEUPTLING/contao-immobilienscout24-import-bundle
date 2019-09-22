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

class AccountRepository extends EntityRepository
{
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
