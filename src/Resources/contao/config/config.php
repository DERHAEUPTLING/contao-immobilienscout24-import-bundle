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
    //'synchronizePosts' => ['mvo_contao_facebook.datacontainer.facebook_node', 'onSynchronizePosts'],
    //'synchronizeEvents' => ['mvo_contao_facebook.datacontainer.facebook_node', 'onSynchronizeEvents'],
];
//
//if ('BE' === TL_MODE) {
//    $GLOBALS['TL_CSS'][] = 'bundles/mvocontaofacebookimport/css/backend.css';
//}
//
//// content elements
//$GLOBALS['TL_CTE']['mvo_facebook']['mvo_facebook_post_list'] = ContentPostList::class;
//$GLOBALS['TL_CTE']['mvo_facebook']['mvo_facebook_event_list'] = ContentEventList::class;
//
//// background synchronization
//$GLOBALS['TL_CRON']['minutely'][] = ['mvo_contao_facebook.listener.contao_cron_listener', 'onExecuteByContaoCron'];
