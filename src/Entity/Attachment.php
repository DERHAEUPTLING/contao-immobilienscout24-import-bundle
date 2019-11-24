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

use Contao\CoreBundle\Image\PictureFactory;
use Contao\FilesModel;
use Contao\FrontendTemplate;
use Contao\StringUtil;
use Derhaeuptling\ContaoImmoscout24\Annotation\Immoscout24Api;
use Derhaeuptling\ContaoImmoscout24\Annotation\Immoscout24ApiMapperTrait;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Derhaeuptling\ContaoImmoscout24\Repository\AttachmentRepository")
 * @ORM\Table(name="tl_immoscout24_attachment")
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

    /** @var PictureFactory */
    private $pictureFactory;

    /** @var string */
    private $projectDir;

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
     * @ORM\Column(name="uuid", type="binary_string", length=16, options={"fixed": true}, nullable=true)
     */
    private $uuid;

    public function setPictureRendererService(PictureFactory $pictureFactory, string $projectDir): void
    {
        $this->pictureFactory = $pictureFactory;
        $this->projectDir = $projectDir;
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

        return null === $this->uuid ? self::CONTENT_WAITING_TO_BE_SCRAPED : self::CONTENT_READY;
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

    public function getFile(): ?FilesModel
    {
        if (self::CONTENT_READY !== $this->getState()) {
            return null;
        }

        return FilesModel::findByUuid($this->uuid);
    }

    public function getScrapingUrl(): ?string
    {
        $urlCandidates = StringUtil::deserialize(stream_get_contents($this->scraperUrls), true);

        if (empty($urlCandidates)) {
            return null;
        }

        $urlCandidate = (array_pop($urlCandidates))['@href'] ?? null;
        if (null === $urlCandidate) {
            return null;
        }

        // strip cloud front image url parameters
        if (0 !== ($position = strpos($urlCandidate, '/ORIG'))) {
            return substr($urlCandidate, 0, $position);
        }

        return $urlCandidate;
    }

    public function setImage(FilesModel $file): void
    {
        if (self::CONTENT_WAITING_TO_BE_SCRAPED !== $this->getState()) {
            throw new \RuntimeException('This attachment does not await scraping results.');
        }

        $this->uuid = $file->uuid;
    }

    public function getRealEstate(): RealEstate
    {
        return $this->realEstate;
    }

    /**
     * Render the attachment as html markup.
     *
     * @param mixed|null $imageSize
     */
    public function render($imageSize = null): ?string
    {
        // currently only supports pictures
        if (!$this->isPicture()) {
            return null;
        }

        $file = $this->getFile();
        if (null === $file) {
            return null;
        }

        if (null === $this->pictureFactory || null === $this->projectDir) {
            throw new \RuntimeException('Picture factory or project dir was not set.');
        }

        $path = $this->projectDir.'/'.$file->path;
        $picture = $this->pictureFactory->create($path, $imageSize);

        $template = new FrontendTemplate('picture_default');
        $template->setData([
            'alt' => $this->title,
            'img' => $picture->getImg($this->projectDir),
            'sources' => $picture->getSources($this->projectDir),
        ]);

        return $template->parse();
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
