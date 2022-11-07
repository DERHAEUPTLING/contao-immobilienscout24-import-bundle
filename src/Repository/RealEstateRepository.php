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
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Derhaeuptling\ContaoImmoscout24\ExpressionLanguage\RealEstateFilterEvaluator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RealEstateRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly RealEstateFilterEvaluator $realEstateFilterEvaluator
    ) {
        parent::__construct($registry, RealEstate::class);
    }

    public function findByRealEstateId(string $realEstateId): ?RealEstate
    {
        /** @var RealEstate $realEstate */
        $realEstate = $this->findOneBy(['realEstateId' => $realEstateId]);

        // do not inline (variable used for type hinting)
        return $realEstate;
    }

    /**
     * @return RealEstate[]
     */
    public function findByAccountAndConditionExpression(Account $account, string $conditionExpression, int $maxResults = 0): array
    {
        $queryBuilder = $this->createQueryBuilder('re')
            ->andWhere('re.immoscoutAccount = :account')
            ->setParameter('account', $account)
            ->orderBy('re.modifiedAt', 'DESC')
        ;

        // simple case: let database evaluate
        if ('' === $conditionExpression) {
            if ($maxResults > 0) {
                $queryBuilder->setMaxResults($maxResults);
            }

            return $queryBuilder
                ->getQuery()
                ->getResult()
            ;
        }

        // complex case: expression needs to be evaluated in code
        $realEstates = $queryBuilder
            ->getQuery()
            ->getResult()
        ;

        $realEstates = array_filter($realEstates, function (RealEstate $realEstate) use ($conditionExpression) {
            return $this->realEstateFilterEvaluator->evaluate($realEstate, $conditionExpression) ?? false;
        });

        if ($maxResults > 0) {
            $realEstates = \array_slice($realEstates, 0, $maxResults);
        }

        return $realEstates;
    }
}
