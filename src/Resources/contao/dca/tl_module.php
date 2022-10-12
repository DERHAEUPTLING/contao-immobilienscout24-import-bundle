<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['immoscout24_real_estate_list'] = '{title_legend},name,headline,type;{immoscout24_legend},immoscout24_accounts;immoscout24_filter,immoscout24_filter_explanation;immoscout24_number_of_items;{redirect_legend},jumpTo;{immoscout24_attachment_legend},imgSize;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
$GLOBALS['TL_DCA']['tl_module']['palettes']['immoscout24_real_estate_reader'] = '{title_legend},name,headline,type;{immoscout24_attachment_legend},imgSize,immoscout24_alt_image_size;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

$GLOBALS['TL_DCA']['tl_module']['fields']['immoscout24_accounts'] = [
    'exclude' => true,
    'eval' => ['multiple' => true, 'tl_class' => 'w50'],
    'inputType' => 'checkboxWizard',
    'sql' => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_module']['fields']['immoscout24_filter_explanation'] = [
    'exclude' => true,
];

$GLOBALS['TL_DCA']['tl_module']['fields']['immoscout24_filter'] = [
    'exclude' => true,
    'eval' => ['tl_class' => 'clr', 'preserveTags' => true, 'maxlength' => 1204],
    'inputType' => 'textarea',
    'sql' => "varchar(1024) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['immoscout24_number_of_items'] = [
    'exclude' => true,
    'default' => 0,
    'eval' => ['mandatory' => true, 'rgxp' => 'natural', 'tl_class' => 'w50 clr'],
    'inputType' => 'text',
    'sql' => 'smallint(5) unsigned NOT NULL default 0',
];

$GLOBALS['TL_DCA']['tl_module']['fields']['immoscout24_alt_image_size'] = [
    'exclude' => true,
    'inputType' => 'imageSize',
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval' => ['rgxp' => 'natural', 'includeBlankOption' => true, 'nospace' => true, 'helpwizard' => true, 'tl_class' => 'w50'],
    'options_callback' => static function () {
        return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
    },
    'sql' => "varchar(255) NOT NULL default ''"
];
