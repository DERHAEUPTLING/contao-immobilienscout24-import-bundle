<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Exception\InvalidResourceException;
use Contao\CoreBundle\File\Metadata;
use Contao\CoreBundle\Filesystem\VirtualFilesystemInterface;
use Contao\CoreBundle\Image\Studio\Figure;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Translation\Translator;
use Contao\ModuleModel;
use Contao\Template;
use Derhaeuptling\ContaoImmoscout24\Entity\Attachment;
use Derhaeuptling\ContaoImmoscout24\Entity\RealEstate;
use Symfony\Component\Filesystem\Path;

abstract class AbstractRealEstateController extends AbstractFrontendModuleController
{
    public function __construct(
        private readonly Studio $studio,
        private readonly VirtualFilesystemInterface $immoscoutAttachmentStorage,
        private readonly Translator $translator,
    ) {
    }

    protected function addDataHelpers(Template $template, ModuleModel $model): void
    {
        $template->attributes = $this->getAllAttributesWithLabels();

        $template->hasData = function (RealEstate $realEstate, string $attribute): bool {
            return $this->hasData($realEstate, $attribute);
        };

        $template->getFormatted = function (RealEstate $realEstate, string $attribute): ?string {
            return $this->getFormatted($realEstate, $attribute);
        };

        $template->getFigureFromAttachment = function (?Attachment $attachment, $size = null) use ($model): ?Figure {
            if (null === $attachment) {
                return null;
            }

            $figureBuilder = $this->studio
              ->createFigureBuilder()
              ->setSize($size ?? $model->imgSize ?: null)
              ->setMetadata(new Metadata([Metadata::VALUE_ALT => $attachment->getTitle()]))
            ;

            if (method_exists($figureBuilder, 'fromStorage')) {
                $figureBuilder->fromStorage($this->immoscoutAttachmentStorage, $attachment->getFile());
            } else {
                // Workaround for Contao < 5
                $stream = $this->immoscoutAttachmentStorage->readStream($attachment->getFile());
                $metadata = stream_get_meta_data($stream);
                $uri = $metadata['uri'];

                if ('STDIO' !== $metadata['stream_type'] || 'plainfile' !== $metadata['wrapper_type'] || !Path::isAbsolute($uri)) {
                    throw new InvalidResourceException(sprintf('Only streams of type STDIO/plainfile pointing to an absolute path are currently supported when reading an image from a storage, got "%s/%s" with URI "%s".', $metadata['stream_type'], $metadata['wrapper_type'], $uri));
                }

                $figureBuilder->fromPath($uri);
            }

            return $figureBuilder->buildIfResourceExists();
        };
    }

    /**
     * Check if an entity's attribute exists and has data present.
     */
    protected function hasData(RealEstate $realEstate, string $attribute): bool
    {
        return property_exists($realEstate, $attribute) && null !== $realEstate->$attribute;
    }

    /**
     * Retrieve and format attribute data based on its type. Boolean values and
     * enumerations are automatically resolved if a language file is present.
     */
    protected function getFormatted(RealEstate $realEstate, string $attribute): ?string
    {
        $rawValue = $realEstate->$attribute ?? null;

        if (null === $rawValue) {
            return null;
        }

        // don't alter strings and floats
        if (\is_string($rawValue)) {
            return $rawValue;
        }
        if (\is_float($rawValue)) {
            return (string) $rawValue;
        }

        // convert booleans
        if (\is_bool($rawValue)) {
            return $rawValue ?
                $this->translator->trans('immoscout24.yes', [], 'contao_default') :
                $this->translator->trans('immoscout24.no', [], 'contao_default');
        }

        // try to resolve enumerations
        if (\is_int($rawValue)) {
            if ($rawValue >= 0) {
                return $this->getEnumerationValue($attribute, $rawValue);
            }

            // resolve flags
            $flags = [];
            $value = -$rawValue;
            $i = 0;

            while (0 !== $value) {
                if ($value & 1) {
                    $flags[] = 1 << $i;
                }

                ++$i;
                $value >>= 1;
            }

            // list as combined string
            return implode(
                ' / ',
                array_map(function ($value) use ($attribute) {
                    return $this->getEnumerationValue($attribute, $value);
                }, $flags)
            );
        }

        // flatten arrays to comma separated values
        if (\is_array($rawValue)) {
            return implode(', ', $rawValue);
        }

        // parse dates
        if ($rawValue instanceof \DateTime) {
            return $rawValue->format('d.m.Y H:i');
        }

        // fallback to 'none' value
        return $this->translator->trans('immoscout24.none', [], 'contao_default');
    }

    /**
     * List all attributes that can be accessed and auto-formatted.
     *
     * @return string[]
     */
    protected function getAllAttributesWithLabels(): array
    {
        // get all public fields as possible attributes
        $attributes = array_keys(get_object_vars(new RealEstate()));

        $attributesWithLabels = [];
        foreach ($attributes as $attribute) {
            $label = $this->translator->trans('immoscout24.'.$attribute, [], 'contao_default');
            $attributesWithLabels[$attribute] = $label;
        }

        return $attributesWithLabels;
    }

    private function getEnumerationValue(string $attribute, int $rawValue): string
    {
        $key = sprintf('immoscout24.%s_.%d', $attribute, $rawValue);
        $value = $this->translator->trans($key, [], 'contao_default');

        if ($key !== $value) {
            return $value;
        }

        return (string) $rawValue;
    }
}
