<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Annotation;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;

trait Immoscout24ApiMapperTrait
{
    /**
     * Map object properties.
     *
     * @param $object
     *
     * @throws AnnotationException
     */
    private static function autoMap($object, array $apiData): bool
    {
        $reader = new AnnotationReader();
        $reflectionObject = new \ReflectionObject($object);

        foreach ($reflectionObject->getProperties() as $reflectionProperty) {
            /** @var Immoscout24Api $annotationData */
            $annotationData = $reader->getPropertyAnnotation(
                $reflectionProperty,
                Immoscout24Api::class
            );

            if (null === $annotationData) {
                continue;
            }

            // step 1: find the corresponding value in the api data
            $path = explode('::', $annotationData->name);
            $apiValue = $apiData;

            do {
                $key = array_shift($path);

                if (!\array_key_exists($key, $apiValue)) {
                    if ($annotationData->mandatory) {
                        return false;
                    }

                    continue 2;
                }

                $apiValue = $apiValue[$key];
            } while (\count($path) > 0);

            // step 2: set the properties accordingly
            $propertyName = $reflectionProperty->getName();

            // mapped enum
            if ($annotationData->enum) {
                if (!\array_key_exists($apiValue, $annotationData->enum)) {
                    trigger_error(
                        "Warning: enumeration for `{$annotationData->name}` does not contain the value `$apiValue`.",
                        E_USER_WARNING
                    );
                }

                $enumValue = $annotationData->enum[$apiValue] ?? null;

                if (null === $enumValue) {
                    if ($annotationData->mandatory) {
                        return false;
                    }

                    continue;
                }

                $object->$propertyName = $enumValue;
                continue;
            }

            // basic value
            $object->$propertyName = $apiValue;
        }

        return true;
    }

    private static function getDateTime(string $value, \DateTime $fallback = null): \DateTime
    {
        try {
            // extract and remove fractions as they won't be stored in the database (ISO 8601)
            $dateTime = new \DateTime(
                (new \DateTime($value))->format('c'),
                new \DateTimeZone('GMT')
            );
        } catch (\Exception $e) {
            // ignore
            $dateTime = null;
        }

        if (!$dateTime instanceof \DateTime) {
            $dateTime = $fallback ?? new \DateTime();
        }

        return $dateTime;
    }
}
