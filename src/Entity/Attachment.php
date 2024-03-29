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

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Image\PictureFactory;
use Contao\StringUtil;
use Derhaeuptling\ContaoImmoscout24\Annotation\Immoscout24Api;
use Derhaeuptling\ContaoImmoscout24\Annotation\Immoscout24ApiMapperTrait;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Derhaeuptling\ContaoImmoscout24\Repository\AttachmentRepository")
 * @ORM\Table(name="tl_immoscout24_attachment")
 * @ORM\HasLifecycleCallbacks()
 */
class Attachment extends DcaDefault
{
    use Immoscout24ApiMapperTrait;

    public const TYPE_UNKNOWN = 0;
    public const TYPE_PICTURE = 1;
    public const TYPE_VIDEO = 2;

    public const CONTENT_NONE = 0;
    public const CONTENT_WAITING_TO_BE_SCRAPED = 0;
    public const CONTENT_READY = 1;

    /** @var PictureFactory|null */
    private $pictureFactory;

    /** @var string|null */
    private $projectDir;

    /** @var ContaoFramework|null */
    private $framework;

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
     * @ORM\Column(name="type", type="smallint")
     * @Immoscout24Api(name="@xsi.type", enum={
     *      "common:Picture" = Attachment::TYPE_PICTURE,
     *      "common:Video" = Attachment::TYPE_VIDEO,
     * })
     *
     * @var int
     */
    private $type = self::TYPE_UNKNOWN;

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
     * @var resource
     */
    private $scraperUrls;

    /**
     * @ORM\Column(name="file", nullable=true)
     *
     * @var string|null
     */
    private $file;

    public function getTargetIdentifier(): string
    {
        return sha1($this->getScrapingUrl() ?? '');
    }

    public function update(self $newVersion): void
    {
        $this->createdAt = $newVersion->createdAt;
        $this->modifiedAt = $newVersion->modifiedAt;
        $this->title = $newVersion->title;
        $this->isFloorPlan = $newVersion->isFloorPlan;
        $this->isTitlePicture = $newVersion->isTitlePicture;
    }

    /**
     * Get the attachment state.
     */
    public function getState(): int
    {
        if (!$this->isPicture()) {
            // todo: other content types

            return self::CONTENT_NONE;
        }

        return null === $this->file ? self::CONTENT_WAITING_TO_BE_SCRAPED : self::CONTENT_READY;
    }

    public function isPicture(): bool
    {
        return self::TYPE_PICTURE === $this->type;
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

    public function getScrapingUrl(): ?string
    {
        $data = \is_resource($this->scraperUrls) ? stream_get_contents($this->scraperUrls) : $this->scraperUrls;
        $urlCandidates = StringUtil::deserialize($data, true);

        if (empty($urlCandidates)) {
            return null;
        }

        $urlCandidate = array_pop($urlCandidates)['@href'] ?? null;
        if (null === $urlCandidate) {
            return null;
        }

        // strip cloud front image url parameters
        if (0 !== ($position = strpos($urlCandidate, '/ORIG'))) {
            return substr($urlCandidate, 0, $position);
        }

        return $urlCandidate;
    }

    public function setFile(string $filename): void
    {
        if (self::CONTENT_WAITING_TO_BE_SCRAPED !== $this->getState()) {
            throw new \RuntimeException('This attachment does not await scraping results.');
        }

        $this->file = $filename;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function getRealEstate(): RealEstate
    {
        return $this->realEstate;
    }

    public function setRealEstate(RealEstate $realEstate): void
    {
        $this->realEstate = $realEstate;
    }

    /**
     * @throws AnnotationException
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
