<?php

namespace test;


use Nicepay\common\HttpRequest;
use PHPUnit\Framework\TestCase;
use Nicepay\utils\Helper;
use test\TestConst;


use Exception;
use Nicepay\utils\NicepayCons;
use Nicepay\common\NicepayError;

class NicepayHttpRequestsTest extends TestCase
{

    private $headers;
    private $body;
    private $requestUrl;

    protected function setUp(): void
    {
        $this->requestUrl = NicepayCons::getSandboxBaseUrl() . "v1.0/access-token/b2b";
        $this->body = [
            'grantType' => 'client_credentials',
            'additionalInfo' => []
        ];
        $this->headers = self::getHeaders("IONPAYTEST", TestConst::$KEY_OLD_FORMAT);
    }


    public function testStart()
    {
        $this->assertTrue(true, "Able to start test");
    }

    public function testHttpRequest()
    {
        $httpRequest = new HttpRequest();

        $method = "POST";
        try {
            $response = $httpRequest->request($this->headers, $this->requestUrl, json_encode($this->body), $method, false, 1);

            $this->assertEquals('2007300', $response['responseCode']);
            $this->assertEquals('Successful', $response['responseMessage']);
        } catch (Exception $e) {
            $this->fail("Exception throws : " . $e->getMessage());
        }
    }


    public function testHttpRequestWithString()
    {
        $httpRequest = new HttpRequest();

        try {
            $response = $httpRequest->request($this->headers, $this->requestUrl, json_encode($this->body), "POST", false, null);

            $this->assertEquals('2007300', $response['responseCode']);
            $this->assertEquals('Successful', $response['responseMessage']);

        } catch (Exception $e) {
            $this->fail('Test Failed, error thrown :' . $e->getMessage());
        }
    }

    public function testTimeout()
    {
        $httpRequest = new HttpRequest();

        try {
            $httpRequest->request($this->headers, "https://httpstat.us/503?sleep=15100", $this->body, "POST", false, null);

            $this->assertTrue(false, "Test failed");
        } catch (NicepayError $e) {

            if (strpos($e->getMessage(), 'timed out') !== false) {
                $this->assertTrue(true, "Test Failed, error thrown : ".$e->getMessage());
            } else {
                $this->assertTrue(false, "Test failed, error thrown : ".$e->getMessage());
            }
        }
    }



    public function testErrorNotFromRequest()
    {
        $httpRequest = new HttpRequest();

        try {
            $httpRequest->request([], "", [], "POST", false, null);
        } catch (Exception $e) {
            if (is_string($e->getMessage())) {
                $this->assertTrue(true, "Test Failed, error thrown : ".$e->getMessage());
            } else {
                $this->assertTrue(false, "Test Failed, error thrown : ".$e->getMessage());
            }
        }
    }

    public function getHeaders($iMid, $privateKey): array
    {

        $headers = [];
        $timeStamp = Helper::getFormattedDate();

        $stringToSign = $iMid . "|" . $timeStamp;
        $signature = Helper::getSignatureAccessToken(
            Helper::getKey($privateKey),
            $stringToSign
        );

        $headers = [
            'Content-Type: application/json',
            'X-TIMESTAMP: ' . $timeStamp,
            'X-CLIENT-KEY: ' . $iMid,
            'X-SIGNATURE: ' . $signature,
        ];


        return $headers;
    }

    public function testRetryWith504Response()
    {
        $requestUrl = 'https://httpstat.us/504?sleep=1000';

        $httpRequest = new HttpRequest();

        try {
            $response = $httpRequest->request([], $requestUrl, '', 'GET', true, 5);
            $this->assertTrue(false, "Test response 504 Failed, get success response instead");
        } catch (NICEPayError $e) {
            $this->assertTrue(true, "Error Success");
        }
    }
}
