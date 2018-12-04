<?php

namespace Omnipay\PlatbaMobilom\Online\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\PlatbaMobilom\Online\Sign\HmacSign;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getData(): array
    {
        $sharedSecret = $this->getSharedSecret();
        $data = "{$this->getId()}{$this->getRes()}{$this->getPhone()}";

        $sign = new HmacSign();
        if ($sign->sign($data, $sharedSecret) !== $this->getSign()) {
            throw new InvalidRequestException('incorect signature');
        }

        return [
            'res' => $this->getRes(),
            'id' => $this->getId(),
            'phone' => $this->getPhone(),
        ];
    }

    public function sendData($data): ResponseInterface
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

    public function getPid(): string
    {
        return $this->getParameter('pid');
    }

    public function setPid(string $pid): CompletePurchaseRequest
    {
        $this->setParameter('pid', $pid);
        return $this;
    }

    public function getSharedSecret(): string
    {
        return $this->getParameter('sharedSecret');
    }

    public function setSharedSecret(string $sharedSecret): CompletePurchaseRequest
    {
        $this->setParameter('sharedSecret', $sharedSecret);
        return $this;
    }

    public function getId(): string
    {
        return $this->getParameter('id');
    }

    public function setId(string $id): CompletePurchaseRequest
    {
        $this->setParameter('id', $id);
        return $this;
    }

    public function getRes(): string
    {
        return $this->getParameter('res');
    }

    public function setRes(string $res): CompletePurchaseRequest
    {
        $this->setParameter('res', $res);
        return $this;
    }

    public function getPhone(): string
    {
        return $this->getParameter('phone');
    }

    public function setPhone(string $phone): CompletePurchaseRequest
    {
        $this->setParameter('phone', $phone);
        return $this;
    }

    public function getSign(): string
    {
        return $this->getParameter('sign');
    }

    public function setSign(string $sign): CompletePurchaseRequest
    {
        $this->setParameter('sign', $sign);
        return $this;
    }
}
