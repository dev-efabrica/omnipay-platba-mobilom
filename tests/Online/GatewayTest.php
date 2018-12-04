<?php

namespace Omnipay\PlatbaMobilom\Tests\Online;

use Omnipay\PlatbaMobilom\Online\Gateway;
use Omnipay\PlatbaMobilom\Online\Message\PurchaseRequest;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchaseSign()
    {
        $this->gateway->setSharedSecret('test');
        $this->gateway->setTestMode(true);

        $request = $this->gateway->purchase([
            'amount' => '10.00',
            'description' => 'My description',
            'id' => '123456',
            'rurl' => 'https://example.com/return-url.php',
            'email' => 'email@example.com',
        ]);

        $this->assertInstanceOf(PurchaseRequest::class, $request);
        $this->assertSame('10.00', $request->getAmount());

        $response = $request->send();

        $this->assertTrue($response->isRedirect());

        $this->assertEquals(
            'https://pay.platbamobilom.sk/test/',
            $response->getRedirectUrl()
        );

        $this->assertEquals(['PID', 'ID', 'DESC', 'PRICE', 'URL', 'EMAIL', 'SIGN'], array_keys($response->getData()));
    }
}
