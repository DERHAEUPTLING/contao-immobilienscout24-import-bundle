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
                $extractValue = static function ($container, $key) use ($annotationData) {
                    if (!\is_array($container) || !\is_string($key)) {
                        trigger_error(
                            "Warning: Cannot extract data of enumeration for `{$annotationData->name}`. Illegal types.",
                            \E_USER_WARNING
                        );

                        return null;
                    }

                    if (!\array_key_exists($key, $container)) {
                        trigger_error(
                            "Warning: Enumeration for `{$annotationData->name}` does not contain the value `$key`.",
                            \E_USER_WARNING
                        );
                    }

                    return $container[$key] ?? null;
                };

                $extractFirstScalarArray = static function ($container) {
                    $array = $container;

                    while (true) {
                        if (!\is_array($array) || empty($array)) {
                            return [];
                        }

                        $value = $array[array_key_first($array)];

                        if (\is_scalar($value)) {
                            break;
                        }

                        $array = $value;
                    }

                    return array_values($array);
                };

                // enum with flags
                if ($annotationData->flags) {
                    $enumValue = 0;

                    if (!\is_array($apiValue)) {
                        trigger_error(
                            "Warning: Cannot parse enumeration for `{$annotationData->name}`. Should be multi dimensional.",
                            \E_USER_WARNING
                        );
                    } else {
                        foreach ($extractFirstScalarArray($apiValue)  as $apiFlagValue) {
                            $flag = $extractValue(
                                $annotationData->enum,
                                $apiFlagValue
                            );

                            if (!is_numeric($flag) || 0 === (int) $flag) {
                                trigger_error(
                                    "Warning: Illegal flag `$flag` in enumeration for `{$annotationData->name}`.",
                                    \E_USER_WARNING
                                );
                            } else {
                                // store flags as negative numbers to be able
                                // to differentiate them from regular enums
                                $enumValue -= (int) $flag;
                            }
                        }
                    }
                } else {
                    $enumValue = $extractValue($annotationData->enum, $apiValue);
                }

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
