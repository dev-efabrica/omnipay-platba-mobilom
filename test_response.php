<?php

use Omnipay\PlatbaMobilom\Online\Gateway;

require_once __DIR__ . '/vendor/autoload.php';

$gateway = Gateway::create();

$gateway->setPid('1');
$gateway->setSharedSecret('test');
$gateway->setTestMode(true);

$response = $gateway->completePurchase([
	'id' => '123456',  // $_GET['ID']
    'res' => 'OK',  // $_GET['RES']
    'phone' => '421903123456',  // $_GET['PHONE']
    'sign' => '1000586EBF82CD0B8F04B52261021CBEFC5B705E7BDEB9297EEAC5F3C292376B', // $_GET['SIGN']
])->send();

if ($response->isSuccessful()) {
    // Payment was successful
    echo "OK - {$response->getId()}\n";
} elseif ($response->isRedirect()) {
    // Redirect to offsite payment gateway
    echo($response->getRedirectUrl() . "\n");
    //$response->redirect();
} else {
	echo "FAIL!\n";
    // Payment failed
    echo "{$response->getMessage()}\n";
}
