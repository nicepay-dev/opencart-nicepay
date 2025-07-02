<?php

namespace Nicepay\data\model;
class CvS
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

    private $deliveryNm;
    private $deliveryPhone;
    private $deliveryAddr;
    private $deliveryCity;
    private $deliveryState;
    private $deliveryPostCd;
    private $deliveryCountry;
    private $reqDt;
    private $reqTm;
    private $reqDomain;
    private $reqServerIP;
    private $reqClientVer;
    private $userSessionID;
    private $mitraCd;
    private $payValidDt;
    private $payValidTm;

    // Constructor 

    public function __construct(CvSBuilder $builder) {
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

        $this->deliveryNm = $builder->getDeliveryNm();
        $this->deliveryPhone = $builder->getDeliveryPhone();
        $this->deliveryAddr = $builder->getDeliveryAddr();
        $this->deliveryCity = $builder->getDeliveryCity();
        $this->deliveryState = $builder->getDeliveryState();
        $this->deliveryPostCd = $builder->getDeliveryPostCd();
        $this->deliveryCountry = $builder->getDeliveryCountry();        
        $this->reqDt = $builder->getReqDt();
        $this->reqTm = $builder->getReqTm();
        $this->reqDomain = $builder->getReqDomain();
        $this->reqServerIP = $builder->getReqServerIP();
        $this->reqClientVer = $builder->getReqClientVer();
        $this->userSessionID = $builder->getUserSessionID();
        $this->mitraCd = $builder->getMitraCd();
        $this->payValidDt = $builder->getPayValidDt();
        $this->payValidTm = $builder->getPayValidTm();
    }

    // Builder
    public static function builder()
    {
        return new CvSBuilder();
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

    public function getDeliveryNm()
    {
        return $this->deliveryNm;
    }

    public function getDeliveryPhone()
    {
        return $this->deliveryPhone;
    }

    public function getDeliveryAddr()
    {
        return $this->deliveryAddr;
    }

    public function getDeliveryCity()
    {
        return $this->deliveryCity;
    }

    public function getDeliveryState()
    {
        return $this->deliveryState;
    }

    public function getDeliveryPostCd()
    {
        return $this->deliveryPostCd;
    }

    public function getDeliveryCountry()
    {
        return $this->deliveryCountry;
    }

    public function getReqDt()
    {
        return $this->reqDt;
    }

    public function getReqTm()
    {
        return $this->reqTm;
    }

    public function getReqDomain()
    {
        return $this->reqDomain;
    }

    public function getReqServerIP()
    {
        return $this->reqServerIP;
    }

    public function getReqClientVer()
    {
        return $this->reqClientVer;
    }

    public function getUserSessionID()
    {
        return $this->userSessionID;
    }

    public function getMitraCd()
    {
        return $this->mitraCd;
    }

    public function getPayValidDt()
    {
        return $this->payValidDt;
    }

    public function getPayValidTm()
    {
        return $this->payValidTm;
    }
    // setter

    public function setMerchantToken($merchantToken){
        $this -> merchantToken = $merchantToken;
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
            'deliveryNm' => $this -> deliveryNm,
            'deliveryPhone' => $this -> deliveryPhone,
            'deliveryAddr' => $this -> deliveryAddr,
            'deliveryCity' => $this -> deliveryCity,
            'deliveryState' => $this -> deliveryState,
            'deliveryPostCd' => $this -> deliveryPostCd,
            'deliveryCountry' => $this -> deliveryCountry,
            'reqDt' => $this -> reqDt,
            'reqTm' => $this -> reqTm,
            'reqDomain' => $this -> reqDomain,
            'reqServerIP' => $this -> reqServerIP,
            'reqClientVer' => $this -> reqClientVer,
            'userSessionID' => $this -> userSessionID,
            'mitraCd' => $this -> mitraCd,
            'payValidDt' => $this -> payValidDt,
            'payValidTm' => $this -> payValidTm
        ];
    }

}


class CvSBuilder
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

    private $deliveryNm;
    private $deliveryPhone;
    private $deliveryAddr;
    private $deliveryCity;
    private $deliveryState;
    private $deliveryPostCd;
    private $deliveryCountry;
    private $reqDt;
    private $reqTm;
    private $reqDomain;
    private $reqServerIP;
    private $reqClientVer;
    private $userSessionID;
    private $mitraCd;
    private $payValidDt;
    private $payValidTm;


    // Build

    public function build()
    {
        return new CvS($this);
    }

    // Getter

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

    public function getDeliveryNm()
    {
        return $this->deliveryNm;
    }

    public function getDeliveryPhone()
    {
        return $this->deliveryPhone;
    }

    public function getDeliveryAddr()
    {
        return $this->deliveryAddr;
    }

    public function getDeliveryCity()
    {
        return $this->deliveryCity;
    }

    public function getDeliveryState()
    {
        return $this->deliveryState;
    }

    public function getDeliveryPostCd()
    {
        return $this->deliveryPostCd;
    }

    public function getDeliveryCountry()
    {
        return $this->deliveryCountry;
    }

    public function getReqDt()
    {
        return $this->reqDt;
    }

    public function getReqTm()
    {
        return $this->reqTm;
    }

    public function getReqDomain()
    {
        return $this->reqDomain;
    }

    public function getReqServerIP()
    {
        return $this->reqServerIP;
    }

    public function getReqClientVer()
    {
        return $this->reqClientVer;
    }

    public function getUserSessionID()
    {
        return $this->userSessionID;
    }

    public function getMitraCd()
    {
        return $this->mitraCd;
    }

    public function getPayValidDt()
    {
        return $this->payValidDt;
    }

    public function getPayValidTm()
    {
        return $this->payValidTm;
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

    public function deliveryNm($deliveryNm)
    {
        $this->deliveryNm = $deliveryNm;
        return $this;
    }
    public function deliveryPhone($deliveryPhone)
    {
        $this->deliveryPhone = $deliveryPhone;
        return $this;
    }
    public function deliveryAddr($deliveryAddr)
    {
        $this->deliveryAddr = $deliveryAddr;
        return $this;
    }
    public function deliveryCity($deliveryCity)
    {
        $this->deliveryCity = $deliveryCity;
        return $this;
    }
    public function deliveryState($deliveryState)
    {
        $this->deliveryState = $deliveryState;
        return $this;
    }
    public function deliveryPostCd($deliveryPostCd)
    {
        $this->deliveryPostCd = $deliveryPostCd;
        return $this;
    }
    public function deliveryCountry($deliveryCountry)
    {
        $this->deliveryCountry = $deliveryCountry;
        return $this;
    }
    public function reqDt($reqDt)
    {
        $this->reqDt = $reqDt;
        return $this;
    }
    public function reqTm($reqTm)
    {
        $this->reqTm = $reqTm;
        return $this;
    }
    public function reqDomain($reqDomain)
    {
        $this->reqDomain = $reqDomain;
        return $this;
    }
    public function reqServerIP($reqServerIP)
    {
        $this->reqServerIP = $reqServerIP;
        return $this;
    }
    public function reqClientVer($reqClientVer)
    {
        $this->reqClientVer = $reqClientVer;
        return $this;
    }


    public function userSessionID($userSessionID)
    {
        $this->userSessionID = $userSessionID;
        return $this;
    }

    public function mitraCd($mitraCd) {
        $this -> mitraCd = $mitraCd;
        return $this;
    }

    public function payValidDt($payValidDt) {
        $this -> payValidDt = $payValidDt;
        return $this;
    }

    public function payValidTm($payValidTm) {
        $this -> payValidTm = $payValidTm;
        return $this;
    }
}
