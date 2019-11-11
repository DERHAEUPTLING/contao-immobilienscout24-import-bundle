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

use Derhaeuptling\ContaoImmoscout24\Annotation\Immoscout24Api;
use Derhaeuptling\ContaoImmoscout24\Annotation\Immoscout24ApiMapperTrait;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="tl_immoscout24_attachment")
 */
class Attachment extends DcaDefault
{
    use Immoscout24ApiMapperTrait;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * [manually mapped]
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(name="modified_at", type="datetime")
     * [manually mapped]
     *
     * @var \DateTime
     */
    private $modifiedAt;

    /**
     * @ORM\Column(name="title")
     * @Immoscout24Api(name="title")
     *
     * @var string
     */
    private $title = '';

    /**
     * @ORM\Column(name="is_floor_plan", type="boolean")
     * @Immoscout24Api(name="floorplan", enum={
     *      "true" = true,
     *      "false" = false
     * })
     *
     * @var bool
     */
    private $isFloorPlan = false;

    /**
     * @ORM\Column(name="is_title_picture", type="boolean")
     * @Immoscout24Api(name="titlePicture", enum={
     *      "true" = true,
     *      "false" = false
     * })
     *
     * @var bool
     */
    private $isTitlePicture = false;

    /**
     * @ORM\ManyToOne(targetEntity="Derhaeuptling\ContaoImmoscout24\Entity\RealEstate", inversedBy="attachments")
     * @ORM\JoinColumn(name="real_estate", referencedColumnName="id", onDelete="CASCADE")
     * [manually mapped]
     *
     * @var RealEstate
     */
    private $realEstate;

    /**
     * @ORM\Column(name="scraper_urls", type="blob")
     * [manually mapped]
     *
     * @var string
     */
    private $scraperUrls;

    public function isPicture(): bool
    {
        return true;
    }

    public function isTitlePicture(): bool
    {
        return $this->isPicture() && $this->isTitlePicture;
    }

    public function isFloorPlan(): bool
    {
        return $this->isPicture() && $this->isFloorPlan;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getImage(): string
    {
        return $this->scraperUrls;
    }

    /**
     * @throws AnnotationException
     *
     * @return Attachment|null
     */
    public static function createFromApiResponse(array $data, RealEstate $realEstate): ?self
    {
        $attachment = new self();

        // manually mapped values
        $urlData = $data['urls'][0]['url'] ?? null;
        if (null === $urlData) {
            return null;
        }
        $attachment->scraperUrls = serialize($urlData);

        $attachment->realEstate = $realEstate;
        $attachment->createdAt = self::getDateTime($data['creationDate'] ?? '');
        $attachment->modifiedAt = self::getDateTime($data['lastModificationDate'] ?? '', $attachment->createdAt);

        // automatically mapped values
        if (self::autoMap($attachment, $data)) {
            return $attachment;
        }

        return null;
    }
}
