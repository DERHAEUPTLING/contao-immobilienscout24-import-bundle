<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

namespace Derhaeuptling\ContaoImmoscout24\Synchronizer;

class ItemAlreadyUpToDateException extends \RuntimeException
{
    public function __construct(\DateTime $old, \DateTime $new)
    {
        $difference = $old->diff($new);

        if (0 === $difference->s) {
            $message = 'dates match';
        } else {
            $message = sprintf(
                'item %s second(s) older than existing one', $difference->s
            );
        }

        parent::__construct($message);
    }
}
