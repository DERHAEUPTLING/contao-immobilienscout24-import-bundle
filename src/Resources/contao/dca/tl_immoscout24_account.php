<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

use Derhaeuptling\ContaoImmoscout24\EventListener\Account;

$GLOBALS['TL_DCA']['tl_immoscout24_account'] =
    [
        // Config
        'config' => [
            'dataContainer' => 'Table',
            'switchToEdit' => true,
            'enableVersioning' => true,
            'ondelete_callback' => [
                [Account::class, 'onDelete'],
            ],
        ],

        // List
        'list' => [
            'sorting' => [
                'mode' => 2,
                'fields' => ['description'],
                'flag' => 1,
                'panelLayout' => 'sort,search,limit',
            ],
            'label' => [
                'fields' => [''],
                'label_callback' => [Account::class, 'onGenerateLabel'],
            ],
            'global_operations' => [],
            'operations' => [
                'edit' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_immoscout24_account']['edit'],
                    'href' => 'act=edit',
                    'icon' => 'edit.svg',
                ],
                'enable' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_immoscout24_account']['enable'],
                    'attributes' => 'onclick="Backend.getScrollOffset();"',
                    'haste_ajax_operation' => [
                        'field' => 'enabled',
                        'options' => [
                            [
                                'value' => '0',
                                'icon' => 'invisible.svg',
                            ],
                            [
                                'value' => '1',
                                'icon' => 'visible.svg',
                            ],
                        ],
                    ],
                ],
                'delete' => [
                    'label' => &$GLOBALS['TL_LANG']['tl_immoscout24_account']['delete'],
                    'href' => 'act=delete',
                    'icon' => 'delete.svg',
                ],
            ],
        ],

        // Select
        'select' => [
            'buttons_callback' => [],
        ],

        // Edit
        'edit' => [
            'buttons_callback' => [],
        ],

        // Palettes
        'palettes' => [
            '__selector__' => [],
            'default' => '{basic_legend},description;'.
                '{credentials_legend},api_explanation,api_consumer_key,api_consumer_secret,api_access_token,api_access_token_secret;'.
                '{sync_legend},enabled;', // . '{media_legend},upload_directory;',
        ],

        // Subpalettes
        'subpalettes' => [],

        // Fields
        'fields' => [
            'id' => [
            ],
            'tstamp' => [
            ],
            'description' => [
                'exclude' => true,
                'inputType' => 'text',
                'eval' => ['mandatory' => true, 'maxlength' => 255, 'unique' => true],
            ],
            'api_explanation' => [
                'exclude' => true,
                'input_field_callback' => static function (Contao\DataContainer $dc) {
                    return sprintf(
                        '<div class="widget"><p class="tl_info">%s</p></div>',
                        $GLOBALS['TL_LANG']['tl_immoscout24_account']['api_explanation']
                    );
                },
            ],
            'api_consumer_key' => [
                'exclude' => true,
                'inputType' => 'text',
                'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            ],
            'api_consumer_secret' => [
                'exclude' => true,
                'inputType' => 'text',
                'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            ],
            'api_access_token' => [
                'exclude' => true,
                'inputType' => 'text',
                'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            ],
            'api_access_token_secret' => [
                'exclude' => true,
                'inputType' => 'text',
                'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            ],
            'enabled' => [
                'exclude' => true,
                'default' => false,
                'inputType' => 'checkbox',
                'eval' => ['isBoolean' => true],
                'save_callback' => [
                    static function ($value) {
                        return '1' === $value;
                    },
                ],
            ],
            //                'upload_directory' => [
            //                        'label' => &$GLOBALS['TL_LANG']['tl_immoscout24_account']['upload_directory'],
            //                        'exclude' => true,
            //                        'inputType' => 'fileTree',
            //                        'eval' => ['mandatory' => true, 'fieldType' => 'radio'],
            //                    ],
        ],
    ];
