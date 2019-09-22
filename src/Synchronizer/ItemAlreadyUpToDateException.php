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
        if ($old === $new) {
            $message = 'dates match';
        } else {
            $message = sprintf(
                'item %dh older than existing one', $old->diff($new)->format('H:i')
            );
        }

        parent::__construct($message);
    }
}
