<?php

require_once 'google-api-php-client-main\vendor\autoload.php';

$client = new Google_Client();
$client->setClientId("695540988794-n76pm4norr2jhfbrd865jgcpbpcidnsl.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost/preview-new-2/login.php");
$client->addScope("email");
$client->addScope("profile");
