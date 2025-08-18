<?php

require_once 'google-api-php-client-main\vendor\autoload.php';

// $client = new Google_Client();
// $client->setClientId("695540988794-n76pm4norr2jhfbrd865jgcpbpcidnsl.apps.googleusercontent.com");
// $client->setClientSecret("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");
// $client->setRedirectUri("http://localhost/preview-new-2/login.php");
// $client->addScope("email");
// $client->addScope("profile");



$client = new Google_Client();
$client->setClientId("274799735908-8fhq5kb8pogjlmfpq2g2055ocg3c9bvr.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost/preview-new-2/login.php");
$client->addScope("email");
$client->addScope("profile");
