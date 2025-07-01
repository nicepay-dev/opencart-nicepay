<?php

namespace test;

use PHPUnit\Framework\TestCase;
use Nicepay\utils\Helper;
use DateTime;
use DateTimeZone;
use test\TestConst;





class NicepayHelperTest extends TestCase
{
    private $clientSecret;
    private $privateKeyString;

    protected function setUp(): void
    {
        $this->clientSecret = TestConst::$CLIENT_SECRET;
        $this->privateKeyString = TestConst::$KEY_OLD_FORMAT;
    }

    public function testAbleToStartTest()
    {
        $this->assertTrue(true);
    }

    public function testAbleToSignDataWithStringPrivateKey()
    {
        $helper = new Helper();
        $signature = $helper->getSignatureAccessToken(helper::getKey($this->privateKeyString), 'IONPAYTEST|2023-02-22T14:43:27+07:00');
        $this->assertIsString($signature);
        $this->assertEquals('H0SI/1ArKnqoNdKeeO0KD+3RVuhoE7/xvQ6uBWksAqf033vAIQIrXIjVRfCEqSHzSWjRkUYeaYhJ12YEQvG3zjaF6jQZEYEdTeFSw/RTEdwXCnjfZMN+MyTEPoB3UE51dVAMRFUSwhVEHirn/ucND2OKiPCj7qy7CQa8DWNq3/M=', $signature);
    }

    public function testAbleToGenerateHmacSha512ForPayload()
    {
        $helper = new Helper();
        $requestBody = [
            'merchantId' => TestConst::$IMID_TEST,
            'originalPartnerReferenceNo' => 'order1677048512514',
            'originalReferenceNo' => 'IONPAYTEST07202302221348332909'
        ];
        $encodePayload = $helper->getEncodePayload($requestBody);
        $this->assertIsString($encodePayload);
        $this->assertEquals('14cfc0aa062edc5154e97839b97840208a20c4d25a1fc2d3dc5e4053c39d091a', $encodePayload);
    }

    public function testAbleToCreateHashAndSignatureBase64()
    {
        $helper = new Helper();
        $stringToSign = 'POST:/api/v1.0/transfer-va/create-va:eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJJT05QQVlURVNUIiwiaXNzIjoiTklDRVBBWSIsIm5hbWUiOiJQREpCIiwiZXhwIjoiMjAyNC0xMC0wMlQwOTowMjozMVoifQ==.rgsVpvIrR2sXPBy504exFoLWteGXDML1uNhJ1NZ8VLo=:205b95bf226befccb18e8565116bbefc61def0e7cadb779c4ecce788c5bf4fd5:2024-10-02T15:47:31+07:00';
        $timeStamp = '20241002154731';

        $convertDate = $helper->getConvertFormatedDate($timeStamp);
        $this->assertIsString($convertDate);
        $this->assertEquals('2024-10-02T15:47:31+07:00', $convertDate);
        $signature = $helper->getRegistSignature($stringToSign, $this->clientSecret);
        $this->assertIsString($signature);
        $this->assertEquals('Fjc+UBrQH7vOZ2XwMvOOT6V/GarzV6LcIdQOojTTaGQf25NrbJ8vuGr/2BDnPy0JrMykwD/PnfkL0mSFMVaCoQ==', $signature);
    }

    public function testAbleToGetTimeNowWithSnapFormat()
    {
        $helper = new Helper();
        $formattedDate = $helper->getFormattedDate();
        $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $snapFormat = $date->format('Y-m-d\TH:i:sP');
        $this->assertIsString($formattedDate);
        $this->assertEquals($snapFormat, $formattedDate);
    }
}
