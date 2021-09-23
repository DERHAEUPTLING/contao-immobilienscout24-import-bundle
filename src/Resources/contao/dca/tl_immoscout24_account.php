<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

$GLOBALS['TL_DCA']['tl_immoscout24_account'] =
    [
        // Config
        'config' => [
            'dataContainer' => 'Table',
            'switchToEdit' => true,
            'enableVersioning' => true,
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
                '{credentials_legend},api_explanation,api_consumer_key,api_consumer_secret;'.
                '{token_legend},api_access_token,api_access_token_secret,token_explanation,provision_access_token;'.
                '{sync_legend},enabled;',
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
                'input_field_callback' => static function () {
                    return sprintf(
                        '<div class="widget clr"><p class="tl_info">%s</p></div>',
                        $GLOBALS['TL_LANG']['tl_immoscout24_account']['api_explanation']
                    );
                },
            ],
            'token_explanation' => [
                'exclude' => true,
                'input_field_callback' => static function () {
                    return sprintf(
                        '<div class="widget clr"><p class="tl_info">%s</p></div>',
                        $GLOBALS['TL_LANG']['tl_immoscout24_account']['token_explanation']
                    );
                },
            ],
            'provision_access_token' => [
                'exclude' => true,
                'inputType' => 'checkbox',
                'eval' => ['doNotSaveEmpty' => true, 'tl_class' => 'w50'],
                'save_callback' => [
                    // Do not save
                    static function () {
                        return null;
                    },
                ],
            ],
            'api_consumer_key' => [
                'exclude' => true,
                'inputType' => 'text',
                'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50', 'preserveTags' => true],
            ],
            'api_consumer_secret' => [
                'exclude' => true,
                'inputType' => 'text',
                'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50', 'preserveTags' => true],
            ],
            'api_access_token' => [
                'exclude' => true,
                'inputType' => 'text',
                'eval' => ['maxlength' => 255, 'tl_class' => 'w50', 'preserveTags' => true],
            ],
            'api_access_token_secret' => [
                'exclude' => true,
                'inputType' => 'text',
                'eval' => ['maxlength' => 255, 'tl_class' => 'w50', 'preserveTags' => true],
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
                // Keep this for MySQL Strict mode. Otherwise, Contao would save an empty string
                'sql' => ['type' => 'boolean', 'default' => true],
            ],
        ],
    ];
