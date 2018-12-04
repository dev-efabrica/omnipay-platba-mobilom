<?php

namespace Omnipay\PlatbaMobilom\Online;

use Omnipay\Common\AbstractGateway;
use Omnipay\Omnipay;
use Omnipay\PlatbaMobilom\Online\Message\CompletePurchaseRequest;
use Omnipay\PlatbaMobilom\Online\Message\PurchaseRequest;
use Omnipay\PlatbaMobilom\Online\Message\PurchaseResponse;

class Gateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'Platba mobilom Online Gateway';
    }

    public function getDefaultParameters(): array
    {
        return [
            'pid' => '',
            'sharedSecret' => '',
        ];
    }

    public function getPid(): string
    {
        return $this->getParameter('pid');
    }

    public function setPid(string $pid): Gateway
    {
        $this->setParameter('pid', $pid);
        return $this;
    }

    public function getSharedSecret(): string
    {
        return $this->getParameter('sharedSecret');
    }

    public function setSharedSecret(string $sharedSecret): Gateway
    {
        $this->setParameter('sharedSecret', $sharedSecret);
        return $this;
    }

    public function purchase(array $parameters = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = []): CompletePurchaseRequest
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }

    public static function create(): Gateway
    {
        return Omnipay::create('\Omnipay\PlatbaMobilom\Online\Gateway');
    }
}
