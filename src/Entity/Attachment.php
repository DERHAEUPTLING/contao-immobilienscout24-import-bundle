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

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="tl_immoscout24_attachment")
 */
class Attachment extends DcaDefault
{
    /**
     * @ORM\ManyToOne(targetEntity="Derhaeuptling\ContaoImmoscout24\Entity\RealEstate", inversedBy="attachments")
     * @ORM\JoinColumn(name="real_estate", referencedColumnName="id", onDelete="SET NULL")
     *
     * @var RealEstate
     */
    private $realEstate;
}
