<?php 

use test\TestConst;
use Nicepay\utils\Helper;
use Nicepay\common\NICEPay;
use Nicepay\service\v2\V2CvsService;
use PHPUnit\Framework\TestCase;
use Nicepay\data\model\CvS;


class NicepayCvSTest extends TestCase {

    public $timestamp, $amount, $iMid, $merchantKey, $config;

    public function setUp(): void
    {
        $this->timestamp = Helper::getFormattedTimestampV2();
        $this->amount = "10000";
        $this->iMid = TestConst::$IMID_CVS;
        $this->merchantKey = TestConst::$MERCHANT_KEY;
        $this->config = NICEPay::builder()
            ->setIsProduction(false)
            ->build();
    }

    public function testRegistrationCvSV2() {

        $config = $this->config;
        $refNo = "ordCvsPhp".$this->timestamp;

    
        $parameter = CvS::builder()
            ->timeStamp($this->timestamp)
            ->iMid($this->iMid)
            ->payMethod("03")
            ->currency("IDR")
            ->amt($this->amount)
            ->referenceNo($refNo)
            ->goodsNm("Test Transaction Cvs with native PHP")
            ->billingNm("John Doe")
            ->billingPhone("081214714045")
            ->billingEmail("email@merchant.com")
            ->billingAddr("Jalan Bukit Berbunga 22")
            ->billingCity("Jakarta")
            ->billingState("DKI Jakarta")
            ->billingPostCd("12345")
            ->billingCountry("Indonesia")
            ->dbProcessUrl("https://ptsv2.com/t/test-nicepay-v2")
            ->description("")
            ->merchantToken($this->timestamp, $this->iMid, $refNo, $this->amount, $this->merchantKey)
            ->userIP("127.0.0.1")
            ->mitraCd("ALMA")
            ->cartData("{\"count\":\"1\",\"item\":[{\"img_url\":\"https://cdn.eraspace.com/pub/media/catalog/product/i/p/iphone_13_pro_max_silver_1_5.jpg\",\"goods_name\":\"iPhone13ProMax\",\"goods_detail\":\"1TB-White\",\"goods_amt\":\"".$this->amount."\"}]}")
            ->payValidDt("")
            ->payValidTm("")
            ->build();

        try {

            $cvsService = new V2CvsService($config);
            $response = $cvsService->registration($parameter);

            // Assert that the result code is 0000 and the result message is SUCCESS
            $this->assertEquals($response->getResultCd(), "0000");
            $this->assertEquals($response->getResultMsg(), "SUCCESS");

        } catch (Exception $e) {
            $this->fail("Failed Test Registration CVS V2, exception thrown: ".$e->getMessage());
        }

    }

}