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
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 */
abstract class DcaDefault
{
    /**
     * @ORM\Column(name="id", type="integer", options={"unsigned": true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="tstamp", type="integer", options={"unsigned": true, "default": 0})
     */
    protected $timestamp;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Update the entry's timestamp.
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function touch(): void
    {
        $this->timestamp = time();
    }
}
