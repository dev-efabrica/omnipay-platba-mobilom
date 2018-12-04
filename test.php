<?php

use Omnipay\PlatbaMobilom\Online\Gateway;

require_once __DIR__ . '/vendor/autoload.php';

$gateway = Gateway::create();

$gateway->setPid('1');
$gateway->setSharedSecret('test');
$gateway->setTestMode(true);

$response = $gateway->purchase([
	'amount' => '10.00',
	'description' => 'My description',
	'id' => '123456',
	'rurl' => 'https://example.com/return-url.php',
    'email' => 'email@example.com',
])->send();

if ($response->isSuccessful()) {
    // Payment was successful
    var_dump($response);
} elseif ($response->isRedirect()) {
    // Redirect to offsite payment gateway
    // echo($response->getRedirectUrl() . "\n");
    $response->redirect();
} else {
    // Payment failed
    var_dump($response->getMessage());
}
