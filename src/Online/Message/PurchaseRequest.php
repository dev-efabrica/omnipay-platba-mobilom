<?php

namespace Omnipay\PlatbaMobilom\Online\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\PlatbaMobilom\Online\Sign\HmacSign;
use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    public function getData(): array
    {
        $this->validate('sharedSecret', 'pid', 'id', 'description', 'amount', 'rurl', 'email');

        $data = [
            'PID' => $this->getPid(),
            'ID' => $this->getId(),
            'DESC' => $this->getDescription(),
            'PRICE' => $this->getAmount(),
            'URL' => $this->getRurl(),
            'EMAIL' => $this->getEmail(),
        ];
        return $data;
    }

    public function generateSignature(string $data): string
    {
        $sign = new HmacSign();
        return $sign->sign($data, $this->getParameter('sharedSecret'));
    }

    public function sendData($data): PurchaseResponse
    {
        $input = "{$this->getPid()}{$this->getId()}{$this->getDescription()}{$this->getAmount()}{$this->getRurl()}{$this->getEmail()}";
        $data['SIGN'] = $this->generateSignature($input);

        return $this->response = new PurchaseResponse($this, $data);
    }

    public function getEndpoint(): string
    {
        return $this->getTestmode() ? 'https://pay.platbamobilom.sk/test/' : 'https://pay.platbamobilom.sk/pay/';
    }

    public function getPid(): string
    {
        return $this->getParameter('pid');
    }

    public function setPid(string $pid): PurchaseRequest
    {
        $this->setParameter('pid', $pid);
        return $this;
    }

    public function getSharedSecret(): string
    {
        return $this->getParameter('sharedSecret');
    }

    public function setSharedSecret(string $sharedSecret): PurchaseRequest
    {
        $this->setParameter('sharedSecret', $sharedSecret);
        return $this;
    }

    public function getId(): string
    {
        return $this->getParameter('id');
    }

    public function setId(string $id): PurchaseRequest
    {
        $this->setParameter('id', $id);
        return $this;
    }

    public function getRurl(): string
    {
        return $this->getParameter('rurl');
    }

    public function setRurl(string $rurl): PurchaseRequest
    {
        $this->setParameter('rurl', $rurl);
        return $this;
    }

    public function getEmail(): string
    {
        return $this->getParameter('email');
    }

    public function setEmail(string $email): PurchaseRequest
    {
        $this->setParameter('email', $email);
        return $this;
    }
}
