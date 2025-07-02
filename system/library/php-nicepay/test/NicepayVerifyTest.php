<?php

namespace Test;

use Nicepay\utils\Helper;
use PHPUnit\Framework\TestCase;
use test\TestConst;

class NicepayVerifyTest extends TestCase
{

    public function testVerifySignature()
    {

        $signatureString = TestConst::$SIGNATURE_TEST;
        $dataString = "IONPAYTEST|2024-11-20T14:14:15+07:00";
        $publicKeyString = TestConst::$PUBLIC_KEY;

        $isVerify = Helper::verifySHA256RSA($dataString, $publicKeyString, $signatureString);

        $this->assertTrue($isVerify, "Failed verify signature ");
    }
}
