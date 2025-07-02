<?php

namespace Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Nicepay\utils\Helper;
use test\TestConst;
use Nicepay\data\model\{Payout, AccessToken};
use Nicepay\service\snap\{Snap, SnapPayoutService};
use Nicepay\common\{NICEPay, NicepayError};

class NicepayPayoutTest extends TestCase
{

    private $config;
    private $configSample;
    private $timestamp;
    private $reservedDt;
    private $reservedTm;

    public function setUp(): void
    {

        $reservedTimeStamp = Helper::getCustomTimeStamp("YmdHis", "70");
        $this->reservedDt = substr($reservedTimeStamp, 0, 8);
        $this->reservedTm = substr($reservedTimeStamp, 8, 6);

        $this->timestamp = Helper::getFormattedDate();

        $this->config = NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret(TestConst::$CLIENT_SECRET_NT)
            ->setPartnerId(TestConst::$NORMALTEST)
            ->setExternalID("NTPo" . Helper::getFormattedTimestampV2())
            ->setTimestamp($this->timestamp)
            ->setPrivateKey(TestConst::$KEY_OLD_FORMAT)
            ->build();

        $this->configSample = NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret(TestConst::$CLIENT_SECRET_NT)
            ->setPartnerId(TestConst::$NORMALTEST)
            ->setExternalID("NTPoReg" . Helper::getFormattedTimestampV2())
            ->setTimestamp($this->timestamp)
            ->setPrivateKey(TestConst::$KEY_OLD_FORMAT)
            ->build();
    }

    public function testRegistrationPayoutSnap()
    {
        $config = $this->config;
        $requestBody = Payout::builder()
            ->merchantId($config->getPartnerId())
            ->beneficiaryAccountNo("888801000157508")
            ->beneficiaryName("Test PHP Native")
            ->beneficiaryPhone("08123456789")
            ->beneficiaryCustomerResidence("1")
            ->beneficiaryCustomerType("1")
            ->beneficiaryPostalCode("123456")
            ->payoutMethod('0')
            ->beneficiaryBankCode('BRIN')
            ->amount("10000.00", "IDR")
            ->partnerReferenceNo("ordRefP" . Helper::getFormattedTimestampV2())
            ->description("Test Regist PayouT PHP Native")
            ->deliveryName("Ciki")
            ->deliveryId('1234567890234512')
            ->reservedDt($this->reservedDt)
            ->reservedTm($this->reservedTm)
            ->build();

        $accessToken = self::getAccessToken($config);

        try {
            $payoutService = new SnapPayoutService($config);
            $response = $payoutService->registration($requestBody, $accessToken);


            $this->assertEquals("2000000", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
        } catch (Exception $e) {
            $this->fail("Failed test registration failed , exception thrown :" . $e->getMessage());
        }
    }


    public function testApprovePayoutSnap()
    {

        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret(TestConst::$CLIENT_SECRET_NT)
            ->setPartnerId(TestConst::$NORMALTEST)
            ->setExternalID("NTPoApp" . Helper::getFormattedTimestampV2())
            ->setTimestamp($this->timestamp)
            ->setPrivateKey(TestConst::$KEY_OLD_FORMAT)
            ->build();

        $sample = self::getSampleData();
        $accessToken = self::getAccessToken($config);

        $requestBody = Payout::builder()
            ->merchantId(TestConst::$NORMALTEST)
            ->originalReferenceNo($sample->getOriginalReferenceNo())
            ->originalPartnerReferenceNo($sample->getPartnerReferenceNo())
            ->build();

        try {
            $payoutService = new SnapPayoutService($config);
            $response = $payoutService->approve($requestBody, $accessToken);

            $this->assertEquals("2000000", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
        } catch (Exception $e) {
            $this->fail("Failed test registration failed , exception thrown :" . $e->getMessage());
        }
    }

    public function testCheckBalanceSnap()
    {

        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret(TestConst::$CLIENT_SECRET_NT)
            ->setPartnerId(TestConst::$NORMALTEST)
            ->setExternalID("NTPoApp" . Helper::getFormattedTimestampV2())
            ->setTimestamp($this->timestamp)
            ->setPrivateKey(TestConst::$KEY_OLD_FORMAT)
            ->build();

        $accessToken = $this->getAccessToken($config);

        $requestBody = Payout::builder()
            ->accountNo(TestConst::$NORMALTEST)
            ->additionalInfo(
                [
                    "msId" => "",
                ]
            )
            ->build();

        try {
            $payoutService = new SnapPayoutService($config);
            $response = $payoutService->checkBalance($requestBody, $accessToken);

            $this->assertEquals("2001100", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
        } catch (Exception $e) {
            $this->fail("Failed test Check Balance , exception thrown :" . $e->getMessage());
        }
    }

    private function getSampleData()
    {
        $config = $this->configSample;
        $requestBody = Payout::builder()
            ->merchantId(TestConst::$NORMALTEST)
            ->beneficiaryAccountNo("1040004380536")
            ->beneficiaryName("Test PHP Native")
            ->beneficiaryPhone("08123456789")
            ->beneficiaryCustomerResidence("1")
            ->beneficiaryCustomerType("1")
            ->beneficiaryPostalCode("123456")
            ->payoutMethod('0')
            ->beneficiaryBankCode('CENA')
            ->amount("10000.00", "IDR")
            ->partnerReferenceNo("ordRefP" . Helper::getFormattedTimestampV2())
            ->description("Test Regist Payour PHP Native")
            ->deliveryName("Ciki")
            ->deliveryId('1234567890234512')
            ->reservedDt($this->reservedDt)
            ->reservedTm( $this->reservedTm)
            ->build();

        $accessToken = self::getAccessToken($config);

        try {
            $payoutService = new SnapPayoutService($config);
            $response = $payoutService->registration($requestBody, $accessToken);

            return $response;
        } catch (Exception $e) {
            $this->fail("Failed test registration failed for sample , exception thrown :" . $e->getMessage());
        }
    }

    private function getAccessToken(NICEPay $config): string
    {


        $tokenBody = AccessToken::builder()
            ->setGrantType('client_credentials')
            ->setAdditionalInfo([])
            ->build();

        $snap = new Snap($config);


        try {
            $response = $snap->requestSnapAccessToken($tokenBody);
        } catch (NicepayError $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }

        return $response->getAccessToken();
    }
}
