<?php
require_once("./paypal/autoload.php");

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $PAYPAL_CLIENT_ID,     // ClientID
        $PAYPAL_CLIENT_SECRET      // ClientSecret
    )
);