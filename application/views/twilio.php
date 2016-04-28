<?php

set_include_path(dirname(__FILE__)."/../");
require('assets/services/Twilio.php');

$account_sid = 'AC0bf0467f0af56fc24371c76da012e428';
$auth_token = 'eea66dc4d709d27d2469d6d609af0dbf';

$client = new Services_Twilio($account_sid, $auth_token);
$message = $client->account->messages->sendMessage(
    '+14084713857',
    '+14088988860',
    'Test text'
);
?>
