<?php

use PHPUnit\Framework\TestCase;
use Nicepay\utils\Helper;
use Nicepay\common\NICEPay;
use test\TestConst;
use Nicepay\service\snap\SnapEwalletService;
use Nicepay\data\model\Ewallet;
use Nicepay\data\model\AccessToken;
use Nicepay\service\snap\Snap;
use Nicepay\common\NicepayError;

class NicepayEwalletTest extends TestCase
{

    private $configSnap;
    private $timestamp;
    private $iMid;



    public function setUp(): void
    {

        $this->iMid = TestConst::$IMID_EW;
        $this->timestamp = Helper::getFormattedDate();

        $this->configSnap = NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret(TestConst::$CLIENT_SECRET_EW)
            ->setPartnerId($this->iMid)
            ->setExternalID("PaymentEwallet" . $this->timestamp)
            ->setTimestamp($this->timestamp)
            ->setPrivateKey(TestConst::$KEY_OLD_FORMAT)
            ->build();
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

    public function testEwalletPaymentSnap()
    {
        $requestBody = Ewallet::builder()
            ->partnerReferenceNo("ordNo" . $this->timestamp)
            ->merchantId(TestConst::$IMID_EW)
            ->subMerchantId("")
            ->externalStoreId("")
            ->validUpTo("")
            ->pointOfInitiation("Mobile App")
            ->amount("1.00", "IDR")
            ->additionalInfo(
                [
                    "mitraCd" => "DANA",
                    "goodsNm" => "Testing Ewallet Snap",
                    "billingNm" => "PHP Native",
                    "billingPhone" => "089665542347",
                    "dbProcessUrl" => "http://ptsv2.com/t/dbProcess/post",
                    "callBackUrl" => "https://www.nicepay.co.id/IONPAY_CLIENT/paymentResult.jsp",
                    "msId" => "data",
                    "cartData" => "{\"count\":\"2\",\"item\":[{\"img_url\":\"http://img.aaa.com/ima1.jpg\",\"goods_name\":\"Item 1 Name\",\"goods_detail\":\"Item 1 Detail\",\"goods_amt\":\"0.00\",\"goods_quantity\":\"1\"},{\"img_url\":\"http://img.aaa.com/ima2.jpg\",\"goods_name\":\"Item 2 Name\",\"goods_detail\":\"Item 2 Detail\",\"goods_amt\":\"1.00\",\"goods_quantity\":\"1\"}]}",
                    "mbFee" => "2000",
                    "mbFeeType" => "2",
                    "msFee" => "2000",
                    "msFeeType" => "2"
                ]
            )
            ->urlParam([
                ["https://example.com", "PAY_NOTIFY", "Y"],
                ["https://another-example.com", "PAY_RETURN", "Y"]
            ])
            ->build();

        $ewalletService = new SnapEwalletService($this->configSnap);
        $accessToken = self::getAccessToken($this->configSnap);


        try {

            $response = $ewalletService->paymentEwallet($requestBody, $accessToken);

            $this->assertEquals("2005400", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
        } catch (Exception $e) {

            $this->fail("Ewallet Snap Payment Test Failed, Error thrown : " . $e->getMessage());
        }
    }
}
