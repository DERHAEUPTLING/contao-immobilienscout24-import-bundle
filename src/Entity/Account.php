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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Derhaeuptling\ContaoImmoscout24\Repository\AccountRepository")
 * @ORM\Table(name="tl_immoscout24_account")
 */
class Account extends DcaDefault
{
    /**
     * @ORM\Column(name="description", type="string", unique=true, options={"default": ""})
     *
     * @var string
     */
    private $description;

    /**
     * @ORM\Embedded(columnPrefix="api_", class="Derhaeuptling\ContaoImmoscout24\Entity\Credentials")
     *
     * @var Credentials
     */
    private $credentials;

    /**
     * @ORM\Column(name="enabled", type="boolean", options={"default": false})
     *
     * @var bool
     */
    private $syncEnabled;

    /**
     * @ORM\OneToMany(targetEntity="Derhaeuptling\ContaoImmoscout24\Entity\RealEstate", mappedBy="immoscoutAccount")
     *
     * @var Collection|RealEstate[]
     */
    private $realEstates;

    /**
     * Account constructor.
     */
    public function __construct()
    {
        $this->realEstates = new ArrayCollection();
    }

    public function getCredentials(): Credentials
    {
        return $this->credentials;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isSyncEnabled(): bool
    {
        return $this->syncEnabled;
    }

    /**
     * @return RealEstate[]|Collection
     */
    public function getRealEstates()
    {
        return $this->realEstates;
    }
}
