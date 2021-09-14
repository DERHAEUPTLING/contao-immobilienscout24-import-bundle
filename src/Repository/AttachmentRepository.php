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

use Derhaeuptling\ContaoImmoscout24\Entity\Attachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attachment::class);
    }

    /**
     * @return Attachment[]
     */
    public function findWaitingToBeScraped(): array
    {
        /** @var Attachment[] $attachments */
        $attachments = $this->findAll();

        return array_filter($attachments, static function (Attachment $attachment) {
            return Attachment::CONTENT_WAITING_TO_BE_SCRAPED === $attachment->getState();
        });
    }
}
