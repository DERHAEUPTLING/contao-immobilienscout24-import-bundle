<?php

declare(strict_types=1);

$GLOBALS['TL_LANG']['tl_immoscout24_account']['imported_elements'] = '%d real estates imported';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['enable'] = 'Enable/disable synchronization';

$GLOBALS['TL_LANG']['tl_immoscout24_account']['basic_legend'] = 'Account';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['description'] = ['Description'];

$GLOBALS['TL_LANG']['tl_immoscout24_account']['credentials_legend'] = 'API Credentials';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_consumer_key'] = ['Consumer Key', 'System Key / Consumer Key'];
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_consumer_secret'] = ['Consumer Secret', 'API Secret / Consumer Secret'];
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_explanation'] =
    <<<'TAG'
Enter your API credentials like you got them from Immoscout24.<br><br>
If you do not have credentials yet, head over to <a style="text-decoration: underline;" href="https://api.immobilienscout24.de">https://api.immobilienscout24.de</a>, log in,
select <i>Manage Access</i> and create a new API project. Make sure to choose access for the <i>production</i> environment.
Then copy the new <i>Consumer Key</i> and <i>Consumer Secret</i> into the following fields.
TAG;

$GLOBALS['TL_LANG']['tl_immoscout24_account']['token_legend'] = 'Long-lived Access Token';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_access_token'] = ['Access Token'];
$GLOBALS['TL_LANG']['tl_immoscout24_account']['api_access_token_secret'] = ['Access Token Secret'];
$GLOBALS['TL_LANG']['tl_immoscout24_account']['provision_access_token'] = ['Provision Access Token', 'Start the provisioning process when saving the record.'];
$GLOBALS['TL_LANG']['tl_immoscout24_account']['token_explanation'] =
    <<<'TAG'
If you do not have a long-lived API token yet, you can tick the following checkbox to start the provisioning process when saving.<br><br>
You will be redirected to the Immoscout24 website where you need to grant access for the consumer key you entered above.
If successful, this account record will automatically be updated with a new access token and access token secret.
TAG;
$GLOBALS['TL_LANG']['tl_immoscout24_account']['access_token_error_1'] = 'Provisioning error: Could not authenticate with the given consumer key and secret. Please make sure this key has access to the production environment.';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['access_token_error_2'] = 'Provisioning error: Verification failed. Could not generate long-lived token credentials.';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['access_token_success'] = 'Provisioning successful. The account has been updated with new access token credentials.';

$GLOBALS['TL_LANG']['tl_immoscout24_account']['sync_legend'] = 'Synchronization';
$GLOBALS['TL_LANG']['tl_immoscout24_account']['enabled'] = ['Enable', 'Include this account in the synchronization when the sync command is executed.'];
