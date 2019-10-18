<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

// backend
$GLOBALS['BE_MOD']['system']['immoscout24_accounts'] = [
    'tables' => ['tl_immoscout24_account'],
];

if ('BE' === TL_MODE) {
    $GLOBALS['TL_CSS'][] = 'bundles/derhaeuptlingcontaoimmobilienscout24/backend.css';
    $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/derhaeuptlingcontaoimmobilienscout24/backend.js';
}
