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

$GLOBALS['TL_DCA']['tl_module']['palettes']['immoscout24_real_estate_list'] = '{title_legend},name,headline,type;{immoscout24_legend},immoscout24_accounts;{redirect_legend},jumpTo;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
$GLOBALS['TL_DCA']['tl_module']['palettes']['immoscout24_real_estate_reader'] = '{title_legend},name,headline,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

$GLOBALS['TL_DCA']['tl_module']['fields']['immoscout24_accounts'] = [
    'exclude' => true,
    'eval' => ['multiple' => true, 'tl_class' => 'w50'],
    'inputType' => 'checkboxWizard',
    'options_callback' => [Account::class, 'listAccounts'],
    'sql' => 'blob NULL',
];
