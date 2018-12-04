<?php

namespace Omnipay\PlatbaMobilom\Online\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    private const SUCCESS = 'OK';

    public function isSuccessful(): bool
    {
        return self::SUCCESS === $this->getRes();
    }

    public function getRes(): ?string
    {
        return $this->data['res'] ?? null;
    }

    public function getId(): ?string
    {
        return $this->data['id'] ?? null;
    }

    public function getPhone(): ?string
    {
        return $this->data['phone'] ?? null;
    }
}
