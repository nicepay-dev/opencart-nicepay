<?php 


use PHPUnit\Framework\TestCase;
use Nicepay\utils\Helper;
use test\TestConst;
use Nicepay\data\model\{Qris, AccessToken};
use Nicepay\service\snap\{Snap, SnapQrisService};
use Nicepay\common\{NICEPay, NicepayError};

class NicepayQrisTest extends TestCase
{

    private $configSnap;
    private $timestamp;
    private $iMid;


    
    public function setUp(): void
    {

        $this->iMid = TestConst::$IMID_QRIS;
        $this->timestamp = Helper::getFormattedDate();

        $this->configSnap = NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret(TestConst::$CLIENT_SECRET_QRIS)
            ->setPartnerId($this->iMid)
            ->setExternalID("generateQr" . $this->timestamp)
            ->setTimestamp($this->timestamp)
            ->setPrivateKey(TestConst::$KEY_OLD_FORMAT)
            ->build();
    }

    public function testGenerateQrisEndpoint() {
        $config = $this->configSnap;

        $accessToken = self::getAccessToken($config);

        $requestBody = Qris::builder()
        ->partnerReferenceNo("ordNo".Helper::getFormattedTimestampV2())
        ->amount("100.00", "IDR")
        ->merchantId($this->iMid)
        ->storeId("NicepayStoreID1")
        ->validityPeriod(Helper::getCustomTimeStamp('Y-m-d\TH:i:sP', 15))
        ->additionalInfo(
            "Test SNAP Transaction Nicepay",
            "John Doe",
            "082213561712",
            "email@merchant.com",
            "Jakarta",
            "Jalan Bukit Berbunga 22",
            "DKI Jakarta",
            "12345",
            "Indonesia",
            "https://ptsv2.com/t/jhon/post",
            "https://ptsv2.com/t/jhon/post",
            "127.0.0.1",
            "{\"count\":1,\"item\":[{\"img_url\":\"https://d3nevzfk7ii3be.cloudfront.net/igi/vOrGHXlovukA566A.medium\",\"goods_name\":\"Nokia 3360\",\"goods_detail\":\"Old Nokia 3360\",\"goods_amt\":\"100\",\"goods_quantity\":\"1\"}]}",
            "QSHP"
        )
        ->build();

        $qrisService = new SnapQrisService($config);

        try {
            $response = $qrisService->generateQris($requestBody, $accessToken);
            
            $this -> assertEquals("2004700", $response->getResponseCode());
            $this -> assertEquals("Successful", $response->getResponseMessage());
        }
        catch (Exception $e) {
            $this -> fail ("Generate Qris Test Failed ".$e->getMessage());
        }
    }

    private function getAccessToken(NICEPay $config): string{


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