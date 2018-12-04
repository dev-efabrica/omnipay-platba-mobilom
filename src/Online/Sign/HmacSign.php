<?php

namespace Omnipay\PlatbaMobilom\Online\Sign;

class HmacSign
{
    public function sign(string $input, string $secret): string
    {
        $inputString = pack('A*', $input);
        $sharedSecret = pack('A*', $secret);
        return strtoupper(hash_hmac('sha256', $inputString, $sharedSecret));
    }
}
