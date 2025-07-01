<?php

use Nicepay\common\NICEPay;
use PHPUnit\Framework\TestCase;
use Nicepay\utils\Helper;
use Nicepay\data\model\Card;
use test\TestConst;
use Nicepay\service\v2\V2CardService;


class NicepayCardTest extends TestCase
{

    private $iMidTest;
    private $merchantKey;

    protected function setUp(): void
    {
        $this->iMidTest = TestConst::$IMID_TEST;
        $this->merchantKey = TestConst::$MERCHANT_KEY;
    }



    public function testRegisterCardTransaction()
    {

        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->build();

        $timestamp = Helper::getFormattedTimestampV2();
        $reffNo = "ordNo" . $timestamp;
        $amount = "10000";

        $parameter = Card::builder()
            ->timeStamp($timestamp)
            ->iMid($this->iMidTest)
            ->payMethod("01")
            ->currency("IDR")
            ->amt($amount)
            ->referenceNo($reffNo)
            ->merchantToken($timestamp, $this->iMidTest, $reffNo, $amount, $this->merchantKey)
            ->description("Testing Registration Card With Native PHP")
            ->goodsNm("Sample Trx")
            ->billingNm("Native PHP")
            ->billingPhone("081288998899")
            ->billingEmail("email@sample.com")
            ->billingAddr("Jln. Raya Kasablanka Kav.88")
            ->billingCity("South Jakarta")
            ->billingState("DKI Jakarta")
            ->billingCountry("Indonesia")
            ->billingPostCd("12800")
            ->dbProcessUrl("http://ptsv2.com/t/merchant/post")
            ->cartData("{}")
            ->userIP("127.0.0.1")
            ->instmntType("1")
            ->instmntMon("1")
            ->recurrOpt("")
            ->userLanguage("en")
            ->userAgent("Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0")
            ->build();

        $cardService = new V2CardService($config);

        try {

            $response = $cardService->registration($parameter);
            
            $this->assertEquals("0000", $response->getResultCd());
            $this->assertEquals("SUCCESS", $response->getResultMsg());
        } catch (Exception $exception) {
            
            $this -> fail("Failed Test Registration Card Transaction, EX : ".$exception->getMessage());
        }
    }

    public function testPaymentCardV2(){

        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->build();

        $timestamp = Helper::getFormattedTimestampV2();
        $iMid = TestConst::$IMID_CARD;
        $newCCTrx = $this -> registNewCCTrx();

        $parameter = Card::builder()
        ->timeStamp($timestamp)
        ->iMid($iMid)
        ->tXid($newCCTrx->getTXid())
        ->referenceNo($newCCTrx->getReferenceNo())
        ->merchantToken($timestamp, $iMid, $newCCTrx->getReferenceNo(), $newCCTrx->getAmt(), $this->merchantKey)
        ->cardNo(TestConst::$CARD_NO)
        ->cardExpYymm(TestConst::$CARD_EXP_YYMM)
        ->cardCvv(TestConst::$CARD_CVV)
        ->cardHolderNm("Nicepay test")
        ->callBackUrl("https://x.com")
        ->build();

            
        try {

            $cardService = new V2CardService($config);
            $response = $cardService->payment($parameter);

            $this->assertIsString($response, "Response is not string");
            $this->assertNotNull($response, "Response is null");
            $this->assertNotEmpty($response, "Response is empty");

        } catch (Exception $exception) {
            
            $this -> fail("Failed Test Registration Card Transaction, EX : ".$exception->getMessage());
        }
    }

    public function registNewCCTrx(){

        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->build();

        $timestamp = Helper::getFormattedTimestampV2();
        $reffNo = "ordNo" . $timestamp;
        $amount = "10000";
        $iMid = TestConst::$IMID_CARD;

        $parameter = Card::builder()
            ->timeStamp($timestamp)
            ->iMid($iMid)
            ->payMethod("01")
            ->currency("IDR")
            ->amt($amount)
            ->referenceNo($reffNo)
            ->merchantToken($timestamp, $iMid, $reffNo, $amount, $this->merchantKey)
            ->description("Testing Registration Card With Native PHP")
            ->goodsNm("Sample Trx")
            ->billingNm("Native PHP")
            ->billingPhone("081288998899")
            ->billingEmail("email@sample.com")
            ->billingAddr("Jln. Raya Kasablanka Kav.88")
            ->billingCity("South Jakarta")
            ->billingState("DKI Jakarta")
            ->billingCountry("Indonesia")
            ->billingPostCd("12800")
            ->dbProcessUrl("http://ptsv2.com/t/merchant/post")
            ->cartData("{}")
            ->userIP("127.0.0.1")
            ->instmntType("1")
            ->instmntMon("1")
            ->recurrOpt("")
            ->userLanguage("en")
            ->userAgent("Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0")
            ->build();

        $cardService = new V2CardService($config);

        try {
            return $cardService->registration($parameter);
            
        } catch (Exception $exception) {
            
            $this -> fail("Failed Registration Card Transaction, EX : ".$exception->getMessage());
        }
    }
}
