<?php

//Requires a file set in assets before you can accomplish everything
set_include_path(dirname(__FILE__)."/../");
require('assets/services/Twilio.php');

//Account based tokens, Don't touch
$account_sid = 'AC0bf0467f0af56fc24371c76da012e428';
$auth_token = 'eea66dc4d709d27d2469d6d609af0dbf';

//Creates new Twilio Service
$client = new Services_Twilio($account_sid, $auth_token);

//Sending message area
$message = $client->account->messages->sendMessage(
    '+14084713857', //Twilio Phone Number (Don't change for now)
    '+14088988860', //Recipient Phone Number
    'Test text'     //Message to send in the text
);
?>
