<?php

declare(strict_types=1);

$GLOBALS['TL_LANG']['tl_immoscout24_account']['imported_elements'] = '%d real estates imported';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['enable'] = 'Enable/disable synchronization';

$GLOBALS['TL_LANG']['tl_immoscout24_account']['basic_legend'] = 'Account';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['description'] = ['Description'];

$GLOBALS['TL_LANG']['tl_immoscout24_account']['credentials_legend'] = 'API Credentials';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_explanation'] =
    <<<'TAG'
Enter your API credentials like you got them from Immoscout24.<br>
Use the <a style="text-decoration: underline;" href="https://playground.immobilienscout24.de/rest/playground">API Playground</a> and follow the 
<a style="text-decoration: underline;" href="https://api.immobilienscout24.de/useful/tutorials-sdks-plugins/tutorial-customer-website.html#playground">tutorial</a>
to obtain a never expiring access token.
TAG;
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_consumer_key'] = ['Consumer Key'];
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_consumer_secret'] = ['Consumer Secret'];
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_access_token'] = ['Access Token'];
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_access_token_secret'] = ['Access Token Secret'];

$GLOBALS['TL_LANG']['tl_immoscout24_account']['sync_legend'] = 'Synchronization';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['enabled'] = ['Enable', 'Include this account in the synchronization when the sync command is executed.'];
