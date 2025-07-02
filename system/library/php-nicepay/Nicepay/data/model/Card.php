<?php

namespace Nicepay\data\model;

class Card
{

    private $timeStamp;
    private $iMid;
    private $payMethod;
    private $currency;
    private $amt;
    private $merchantToken;
    private $referenceNo;
    private $description;
    private $goodsNm;
    private $billingNm;
    private $billingPhone;
    private $billingEmail;
    private $billingAddr;
    private $billingCity;
    private $billingState;
    private $billingCountry;
    private $billingPostCd;
    private $dbProcessUrl;
    private $cartData;
    private $userIP;
    private $instmntType;
    private $instmntMon;
    private $recurrOpt;
    private $userLanguage;
    private $userAgent;

    // PAYMENT

    private $tXid;
    private $cardNo;
    private $cardExpYymm;
    private $cardCvv;
    private $cardHolderNm;
    private $recurringToken;
    private $preauthToken;
    private $callBackUrl;

    public function __construct(CardBuilder $builder)
    {
        $this->timeStamp = $builder->getTimeStamp();
        $this->iMid = $builder->getIMid();
        $this->payMethod = $builder->getPayMethod();
        $this->currency = $builder->getCurrency();
        $this->amt = $builder->getAmt();
        $this->merchantToken = $builder->getMerchantToken();
        $this->referenceNo = $builder->getReferenceNo();
        $this->description = $builder->getDescription();
        $this->goodsNm = $builder->getGoodsNm();
        $this->billingNm = $builder->getBillingNm();
        $this->billingPhone = $builder->getBillingPhone();
        $this->billingEmail = $builder->getBillingEmail();
        $this->billingAddr = $builder->getBillingAddr();
        $this->billingCity = $builder->getBillingCity();
        $this->billingState = $builder->getBillingState();
        $this->billingCountry = $builder->getBillingCountry();
        $this->billingPostCd = $builder->getBillingPostCd();
        $this->dbProcessUrl = $builder->getDbProcessUrl();
        $this->cartData = $builder->getCartData();
        $this->userIP = $builder->getUserIP();
        $this->instmntType = $builder->getInstmType();
        $this->instmntMon = $builder->getInstmnMon();
        $this->recurrOpt = $builder->getRecurrOpt();
        $this->userLanguage = $builder->getUserLanguage();
        $this->userAgent = $builder->getUserAgent();

        // PAYMENT
        $this->tXid = $builder->getTXid();
        $this->cardNo = $builder->getCardNo();
        $this->cardExpYymm = $builder->getCardExpYymm();
        $this->cardCvv = $builder->getCardCvv();
        $this->cardHolderNm = $builder->getCardHolderNm();
        $this->recurringToken = $builder->getRecurringToken();
        $this->preauthToken = $builder->getPreauthToken();
        $this->callBackUrl = $builder->getCallBackUrl();
    }

    public static function builder(): CardBuilder
    {
        return new CardBuilder();
    }

    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    public function getIMid()
    {
        return $this->iMid;
    }

    public function getPayMethod()
    {
        return $this->payMethod;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getAmt()
    {
        return $this->amt;
    }

    public function getMerchantToken()
    {
        return $this->merchantToken;
    }

    public function getReferenceNo()
    {
        return $this->referenceNo;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getGoodsNm()
    {
        return $this->goodsNm;
    }

    public function getBillingNm()
    {
        return $this->billingNm;
    }

    public function getBillingPhone()
    {
        return $this->billingPhone;
    }

    public function getBillingEmail()
    {
        return $this->billingEmail;
    }

    public function getBillingAddr()
    {
        return $this->billingAddr;
    }

    public function getBillingCity()
    {
        return $this->billingCity;
    }

    public function getBillingState()
    {
        return $this->billingState;
    }

    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    public function getBillingPostCd()
    {
        return $this->billingPostCd;
    }

    public function getDbProcessUrl()
    {
        return $this->dbProcessUrl;
    }

    public function getCartData()
    {
        return $this->cartData;
    }

    public function getUserIP()
    {
        return $this->userIP;
    }

    public function getInstmType()
    {
        return $this->instmntType;
    }

    public function getInstmnMon()
    {
        return $this->instmntMon;
    }

    public function getRecurrOpt()
    {
        return $this->recurrOpt;
    }

    public function getUserLanguage()
    {
        return $this->userLanguage;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function getTXid()
    {
        return $this->tXid;
    }

    public function getCardNo()
    {
        return $this->cardNo;
    }

    public function getCardExpYymm()
    {
        return $this->cardExpYymm;
    }
    
    public function getCardCvv()
    {
        return $this->cardCvv;
    }
    
    public function getCardHolderNm()
    {
        return $this->cardHolderNm;
    }
    
    public function getRecurringToken()
    {
        return $this->recurringToken;
    }
    
    public function getPreauthToken()
    {
        return $this->preauthToken;
    }

    public function getCallBackUrl()
    {
        return $this->callBackUrl;
    }


    public function setMerchantToken($merchantToken)
    {
        $this->merchantToken = $merchantToken;
    }

    public function toArrayV2(): array
    {
        return [
            'timeStamp' => $this->timeStamp,
            'iMid' => $this->iMid,
            'payMethod' => $this->payMethod,
            'currency' => $this->currency,
            'amt' => $this->amt,
            'referenceNo' => $this->referenceNo,
            'goodsNm' => $this->goodsNm,
            'billingNm' => $this->billingNm,
            'billingPhone' => $this->billingPhone,
            'billingEmail' => $this->billingEmail,
            'billingAddr' => $this->billingAddr,
            'billingCity' => $this->billingCity,
            'billingState' => $this->billingState,
            'billingPostCd' => $this->billingPostCd,
            'billingCountry' => $this->billingCountry,
            'dbProcessUrl' => $this->dbProcessUrl,
            'merchantToken' => $this->merchantToken,
            'cartData' => $this->cartData,
            'description' => $this->description,
            'userIP' => $this->userIP,
            'userAgent' => $this->userAgent,
            'userLanguage' => $this->userLanguage,
            'instmntType' => $this->instmntType,
            'instmntMon' => $this->instmntMon,
            'recurrOpt' => $this->recurrOpt,

        ];
    }

    public function toArrayPayment(){
        return [
            'timeStamp' => $this->timeStamp,
            'referenceNo' => $this->referenceNo,
            'merchantToken' => $this->merchantToken,
            'tXid' => $this->tXid,
            'cardNo' => $this->cardNo,
            'cardExpYymm' => $this->cardExpYymm,
            'cardCvv' => $this->cardCvv,
            'cardHolderNm' => $this->cardHolderNm,
            'recurringToken' => $this->recurringToken,
            'preauthToken' => $this->preauthToken,
            'callBackUrl' => $this->callBackUrl
        ];
    }
}

class CardBuilder
{

    private $timeStamp;
    private $iMid;
    private $payMethod;
    private $currency;
    private $amt;
    private $merchantToken;
    private $referenceNo;
    private $description;
    private $goodsNm;
    private $billingNm;
    private $billingPhone;
    private $billingEmail;
    private $billingAddr;
    private $billingCity;
    private $billingState;
    private $billingCountry;
    private $billingPostCd;
    private $dbProcessUrl;
    private $cartData;
    private $userIP;
    private $instmntType;
    private $instmntMon;
    private $recurrOpt;
    private $userLanguage;
    private $userAgent;

    // PAYMENT

    private $tXid;
    private $cardNo;
    private $cardExpYymm;
    private $cardCvv;
    private $cardHolderNm;
    private $recurringToken;
    private $preauthToken;
    private $callBackUrl;

    // build 
    public function build(): Card
    {
        return new Card($this);
    }

    // getter

    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    public function getIMid()
    {
        return $this->iMid;
    }

    public function getPayMethod()
    {
        return $this->payMethod;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getAmt()
    {
        return $this->amt;
    }

    public function getMerchantToken()
    {
        return $this->merchantToken;
    }

    public function getReferenceNo()
    {
        return $this->referenceNo;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getGoodsNm()
    {
        return $this->goodsNm;
    }

    public function getBillingNm()
    {
        return $this->billingNm;
    }

    public function getBillingPhone()
    {
        return $this->billingPhone;
    }

    public function getBillingEmail()
    {
        return $this->billingEmail;
    }

    public function getBillingAddr()
    {
        return $this->billingAddr;
    }

    public function getBillingCity()
    {
        return $this->billingCity;
    }

    public function getBillingState()
    {
        return $this->billingState;
    }

    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    public function getBillingPostCd()
    {
        return $this->billingPostCd;
    }

    public function getDbProcessUrl()
    {
        return $this->dbProcessUrl;
    }

    public function getCartData()
    {
        return $this->cartData;
    }

    public function getUserIP()
    {
        return $this->userIP;
    }

    public function getInstmType()
    {
        return $this->instmntType;
    }

    public function getInstmnMon()
    {
        return $this->instmntMon;
    }

    public function getRecurrOpt()
    {
        return $this->recurrOpt;
    }

    public function getUserLanguage()
    {
        return $this->userLanguage;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }


    public function getTXid()
    {
        return $this->tXid;
    }

    public function getCardNo()
    {
        return $this->cardNo;
    }

    public function getCardExpYymm()    
    {
        return $this->cardExpYymm;
    }

    public function getCardCvv()
    {
        return $this->cardCvv;
    }

    public function getCardHolderNm()
    {
        return $this->cardHolderNm;

    }

    public function getRecurringToken()
    {
        return $this->recurringToken;
    }

    public function getPreauthToken()
    {
        return $this->preauthToken;
    }

    public function getCallBackUrl()
    {
        return $this->callBackUrl;
    }



    public function timeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
        return $this;
    }
    public function iMid($iMid)
    {
        $this->iMid = $iMid;
        return $this;
    }
    public function payMethod($payMethod)
    {
        $this->payMethod = $payMethod;
        return $this;
    }
    public function currency($currency)
    {
        $this->currency = $currency;
        return $this;
    }
    public function amt($amt)
    {
        $this->amt = $amt;
        return $this;
    }
    public function merchantToken($timeStamp, $iMid, $referenceNo, $amt, $merchantKey)
    {
        $this->merchantToken = $timeStamp . $iMid . $referenceNo . $amt . $merchantKey;
        return $this;
    }
    public function referenceNo($referenceNo)
    {
        $this->referenceNo = $referenceNo;
        return $this;
    }
    public function description($description)
    {
        $this->description = $description;
        return $this;
    }
    public function goodsNm($goodsNm)
    {
        $this->goodsNm = $goodsNm;
        return $this;
    }
    public function billingNm($billingNm)
    {
        $this->billingNm = $billingNm;
        return $this;
    }
    public function billingPhone($billingPhone)
    {
        $this->billingPhone = $billingPhone;
        return $this;
    }
    public function billingEmail($billingEmail)
    {
        $this->billingEmail = $billingEmail;
        return $this;
    }
    public function billingAddr($billingAddr)
    {
        $this->billingAddr = $billingAddr;
        return $this;
    }
    public function billingCity($billingCity)
    {
        $this->billingCity = $billingCity;
        return $this;
    }
    public function billingState($billingState)
    {
        $this->billingState = $billingState;
        return $this;
    }
    public function billingCountry($billingCountry)
    {
        $this->billingCountry = $billingCountry;
        return $this;
    }
    public function billingPostCd($billingPostCd)
    {
        $this->billingPostCd = $billingPostCd;
        return $this;
    }
    public function dbProcessUrl($dbProcessUrl)
    {
        $this->dbProcessUrl = $dbProcessUrl;
        return $this;
    }
    public function cartData($cartData)
    {
        $this->cartData = $cartData;
        return $this;
    }
    public function userIP($userIP)
    {
        $this->userIP = $userIP;
        return $this;
    }
    public function instmntType($instmntType)
    {
        $this->instmntType = $instmntType;
        return $this;
    }
    public function instmntMon($instmntMon)
    {
        $this->instmntMon = $instmntMon;
        return $this;
    }
    public function recurrOpt($recurrOpt)
    {
        $this->recurrOpt = $recurrOpt;
        return $this;
    }
    public function userLanguage($userLanguage)
    {
        $this->userLanguage = $userLanguage;
        return $this;
    }
    public function userAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    //     private $tXid;
    // private $cardNo;
    // private $cardExpYymm;
    // private $cardCvv;
    // private $cardHolderNm;
    // private $recurringToken;
    // private $preauthToken;
    // private $callBackUrl;

    public function tXid($tXid)
    {
        $this->tXid = $tXid;
        return $this;
    }
    public function cardNo($cardNo)
    {
        $this->cardNo = $cardNo;
        return $this;   
    }
    public function cardExpYymm($cardExpYymm)
    {
        $this->cardExpYymm = $cardExpYymm;
        return $this;
    }
    public function cardCvv($cardCvv)
    {
        $this->cardCvv = $cardCvv;
        return $this;
    }
    public function cardHolderNm($cardHolderNm)
    {
        $this->cardHolderNm = $cardHolderNm;
        return $this;
    }
    public function recurringToken($recurringToken)
    {
        $this->recurringToken = $recurringToken;
        return $this;
    }
    public function preauthToken($preauthToken)
    {
        $this->preauthToken = $preauthToken;
        return $this;
    }
    public function callBackUrl($callBackUrl)
    {
        $this->callBackUrl = $callBackUrl;
        return $this;
    }

}
