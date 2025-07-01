<?php


use PHPUnit\Framework\TestCase;

use Nicepay\service\snap\{Snap, SnapVAService};
use Nicepay\service\v2\V2VAService;
use Nicepay\utils\{Helper};
use Nicepay\common\{NICEPay, NicepayError};
use Nicepay\data\model\{VirtualAccount, AccessToken, InquiryStatus};

use test\TestConst;


class NicepayVirtualAccountTest extends TestCase
{


    private $clientSecret;
    private $oldKeyFormat;
    private $iMidTest;
    private $merchantKey;

    protected function setUp(): void
    {
        $this->clientSecret = TestConst::$CLIENT_SECRET;
        $this->iMidTest = TestConst::$IMID_TEST;
        $this->merchantKey = TestConst::$MERCHANT_KEY;
        $this->oldKeyFormat = TestConst::$KEY_OLD_FORMAT;
    }

    public function testGenerateVASnap()
    {
        $timestamp = Helper::getFormattedDate();
        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->setPrivateKey($this->oldKeyFormat)
            ->setClientSecret($this->clientSecret)
            ->setPartnerId($this->iMidTest)
            ->setExternalID("extIDVa" . $timestamp)
            ->setTimestamp($timestamp)
            ->build();



        $virtualAccountBuilder = VirtualAccount::builder();
        $parameter = $virtualAccountBuilder
            ->setPartnerServiceId("")
            ->setCustomerNo("")
            ->setVirtualAccountNo("")
            ->setVirtualAccountName("Nicepay PHP Test")
            ->setTrxId("ordNo" . $timestamp)
            ->setTotalAmount('10000.00', 'IDR')
            ->setAdditionalInfo([
                'bankCd' => 'BMRI',
                'goodsNm' => 'Test',
                'dbProcessUrl' => 'https://nicepay.co.id/',
            ])
            ->build();


        $accessToken = self::getAccessToken($config);
        $snapVAService = new SnapVAService($config);

        try {
            $response = $snapVAService->generateVA($parameter, $accessToken);
            $this->assertEquals("2002700", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
            // Add more assertions as needed for specific response properties
        } catch (NicepayError $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }
    }

    public function testGenerateVAV2()
    {
        $timestamp = Helper::getFormattedTimestampV2();
        $configBuilder = NICEPay::builder();
        $config = $configBuilder
            ->setIsProduction(false)
            ->build();

        $reffNo = "ordNo" . $timestamp;
        $amount = "100";
        $virtualAccountBuilder = VirtualAccount::builder();
        $parameter = $virtualAccountBuilder
            ->setTimeStamp($timestamp)
            ->setIMid($this->iMidTest)
            ->setPayMethod("02")
            ->setCurrency("IDR")
            ->setBankCd("CENA")
            ->setAmt("100")
            ->setReferenceNo($reffNo)
            ->setMerchantToken($timestamp, $this->iMidTest, $reffNo, $amount, $this->merchantKey)
            ->setVacctValidDt("20251004")
            ->setVacctValidTm("101010")
            ->setMerFixAcctId("")
            ->setDbProcessUrl("https://webhook.site/7c2d47f6-557b-4b85-b91a-ad3b6182b10c")
            ->setGoodsNm("Test VA V2 PHP")
            ->setCartData("{}")
            ->setBillingNm("Nicepay php native")
            ->setBillingPhone("081534567890")
            ->setBillingEmail("nicepay@example.com")
            ->setBillingAddr("Jln. Raya Kasablanka Kav.88")
            ->setBillingCity("South Jakarta")
            ->setBillingState("DKI Jakarta")
            ->setBillingPostCd("15119")
            ->setBillingCountry("Indonesia")
            ->build();

        $v2VaService = new V2VAService($config);

        try {
            $response = $v2VaService->registration($parameter);
            $this->assertEquals("0000", $response->getResultCd());
            $this->assertEquals("SUCCESS", $response->getResultMsg());
            // Add more assertions as needed for specific response properties
        } catch (NicepayError $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }
    }

    public function testGenerateVAWithRetry()
    {
        $timestamp = Helper::getFormattedTimestampV2();
        $configBuilder = NICEPay::builder();
        $config = $configBuilder
            ->setIsProduction(true)
            ->setRetryFlag(true)
            ->setRetryCount(4) // 4 retry
            ->build();

        $reffNo = "ordNo" . $timestamp;
        $amount = "100";
        $virtualAccountBuilder = VirtualAccount::builder();
        $parameter = $virtualAccountBuilder
            ->setTimeStamp($timestamp)
            ->setIMid($this->iMidTest)
            ->setPayMethod("02")
            ->setCurrency("IDR")
            ->setBankCd("CENA")
            ->setAmt("100")
            ->setReferenceNo($reffNo)
            ->setMerchantToken($timestamp, $this->iMidTest, $reffNo, $amount, $this->merchantKey)
            ->setVacctValidDt("20251004")
            ->setVacctValidTm("101010")
            ->setMerFixAcctId("")
            ->setDbProcessUrl("https://webhook.site/7c2d47f6-557b-4b85-b91a-ad3b6182b10c")
            ->setGoodsNm("Test VA V2 PHP")
            ->setCartData("{}")
            ->setBillingNm("Nicepay php native")
            ->setBillingPhone("081534567890")
            ->setBillingEmail("nicepay@example.com")
            ->setBillingAddr("Jln. Raya Kasablanka Kav.88")
            ->setBillingCity("South Jakarta")
            ->setBillingState("DKI Jakarta")
            ->setBillingPostCd("15119")
            ->setBillingCountry("Indonesia")
            ->build();

        $v2VaService = new V2VAService($config);

        try {
            $response = $v2VaService->registration($parameter);
            $this->assertEquals("0000", $response->getResultCd());
            $this->assertEquals("SUCCESS", $response->getResultMsg());

        } catch (NicepayError $e) {
            $this->assertTrue(true, "Exmessage: ception thrown: " . $e->getMessage());
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
