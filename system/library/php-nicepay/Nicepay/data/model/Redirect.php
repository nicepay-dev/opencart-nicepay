<?php

namespace Nicepay\data\model;

class Redirect
{

    // V2 

    private $timeStamp;
    private $iMid;
    private $payMethod;
    private $currency;
    private $amt;
    private $referenceNo;
    private $goodsNm;
    private $billingNm;
    private $billingPhone;
    private $billingEmail;
    private $billingAddr;
    private $billingCity;
    private $billingState;
    private $billingPostCd;
    private $billingCountry;
    private $bankCd;
    private $vacctValidDt;
    private $vacctValidTm;
    private $merFixAcctId;
    private $dbProcessUrl;
    private $callBackUrl;
    private $merchantToken;

    private $cartData;

    private $deliveryNm;
    private $deliveryPhone;

    private $deliveryAddr;
    private $instmntMon;
    private $instmntType;

    private $deliveryCity;

    private $deliveryState;
    private $deliveryPostCd;
    private $deliveryCountry;
    private $description;
    private $reqDomain;
    private $reqServerIP;
    private $userIP;
    private $userSessionID;
    private $userAgent;
    private $userLanguage;

    function __construct(redirectBuilder $builder)
    {
        // V2
        $this->timeStamp = $builder->getTimeStamp();
        $this->iMid = $builder->getIMid();
        $this->payMethod = $builder->getPayMethod();
        $this->currency = $builder->getCurrency();
        $this->amt = $builder->getAmt();
        $this->referenceNo = $builder->getReferenceNo();
        $this->goodsNm = $builder->getGoodsNm();
        $this->billingNm = $builder->getBillingNm();
        $this->billingPhone = $builder->getBillingPhone();
        $this->billingEmail = $builder->getBillingEmail();
        $this->billingAddr = $builder->getBillingAddr();
        $this->billingCity = $builder->getBillingCity();
        $this->billingState = $builder->getBillingState();
        $this->billingPostCd = $builder->getBillingPostCd();
        $this->billingCountry = $builder->getBillingCountry();
        $this->bankCd = $builder->getBankCd();
        $this->vacctValidDt = $builder->getVacctValidDt();
        $this->vacctValidTm = $builder->getVacctValidTm();
        $this->merFixAcctId = $builder->getMerFixAcctId();
        $this->dbProcessUrl = $builder->getDbProcessUrl();
        $this->callBackUrl = $builder->getCallBackUrl();
        $this->merchantToken = $builder->getMerchantToken();
        $this->instmntMon = $builder->getInstmntMon();
        $this->instmntType = $builder->getInstmntType();
 

        // Additional fields
        $this->cartData = $builder->getCartData();
        $this->deliveryNm = $builder->getDeliveryNm();
        $this->deliveryPhone = $builder->getDeliveryPhone();
        $this->deliveryAddr = $builder->getDeliveryAddr();
        $this->deliveryCity = $builder->getDeliveryCity();
        $this->deliveryState = $builder->getDeliveryState();
        $this->deliveryPostCd = $builder->getDeliveryPostCd();
        $this->deliveryCountry = $builder->getDeliveryCountry();
        $this->description = $builder->getDescription();
        $this->reqDomain = $builder->getReqDomain();
        $this->reqServerIP = $builder->getReqServerIP();
        $this->userIP = $builder->getUserIP();
        $this->userSessionID = $builder->getUserSessionID();
        $this->userAgent = $builder->getUserAgent();
        $this->userLanguage = $builder->getUserLanguage();
    }

    // Getter setter V2

    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    public function setTimeStamp(string $timeStamp): void
    {
        $this->timeStamp = $timeStamp;
    }

    public function getIMid()
    {
        return $this->iMid;
    }

    public function setIMid(string $iMid): void
    {
        $this->iMid = $iMid;
    }

    public function getPayMethod()
    {
        return $this->payMethod;
    }

    public function setPayMethod(string $payMethod): void
    {
        $this->payMethod = $payMethod;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getAmt()
    {
        return $this->amt;
    }

    public function setAmt(string $amt): void
    {
        $this->amt = $amt;
    }

    public function getReferenceNo()
    {
        return $this->referenceNo;
    }

    public function setReferenceNo(string $referenceNo): void
    {
        $this->referenceNo = $referenceNo;
    }

    public function getGoodsNm()
    {
        return $this->goodsNm;
    }

    public function setGoodsNm(string $goodsNm): void
    {
        $this->goodsNm = $goodsNm;
    }

    public function getBillingNm()
    {
        return $this->billingNm;
    }

    public function setBillingNm(string $billingNm): void
    {
        $this->billingNm = $billingNm;
    }

    public function getBillingPhone()
    {
        return $this->billingPhone;
    }

    public function setBillingPhone(string $billingPhone): void
    {
        $this->billingPhone = $billingPhone;
    }

    public function getBillingEmail()
    {
        return $this->billingEmail;
    }

    public function setBillingEmail(string $billingEmail): void
    {
        $this->billingEmail = $billingEmail;
    }

    public function getBillingAddr()
    {
        return $this->billingAddr;
    }

    public function setBillingAddr(string $billingAddr): void
    {
        $this->billingAddr = $billingAddr;
    }

    public function getBillingCity()
    {
        return $this->billingCity;
    }

    public function setBillingCity(string $billingCity): void
    {
        $this->billingCity = $billingCity;
    }

    public function getBillingState()
    {
        return $this->billingState;
    }

    public function setBillingState(string $billingState): void
    {
        $this->billingState = $billingState;
    }

    public function getBillingPostCd()
    {
        return $this->billingPostCd;
    }

    public function setBillingPostCd(string $billingPostCd): void
    {
        $this->billingPostCd = $billingPostCd;
    }

    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    public function setBillingCountry(string $billingCountry): void
    {
        $this->billingCountry = $billingCountry;
    }

    public function getBankCd()
    {
        return $this->bankCd;
    }

    public function setBankCd(string $bankCd): void
    {
        $this->bankCd = $bankCd;
    }

    public function getVacctValidDt()
    {
        return $this->vacctValidDt;
    }

    public function setVacctValidDt(string $vacctValidDt): void
    {
        $this->vacctValidDt = $vacctValidDt;
    }

    public function getVacctValidTm()
    {
        return $this->vacctValidTm;
    }

    public function setVacctValidTm(string $vacctValidTm): void
    {
        $this->vacctValidTm = $vacctValidTm;
    }

    public function getMerFixAcctId()
    {
        return $this->merFixAcctId;
    }

    public function setMerFixAcctId(string $merFixAcctId): void
    {
        $this->merFixAcctId = $merFixAcctId;
    }

    public function getDbProcessUrl()
    {
        return $this->dbProcessUrl;
    }

    public function setDbProcessUrl(string $dbProcessUrl): void
    {
        $this->dbProcessUrl = $dbProcessUrl;
    }

    //
    public function getCallBackUrl()
    {
        return $this->callBackUrl;
    }

    public function setUrl(string $callBackUrl): void
    {
        $this->callBackUrl = $callBackUrl;
    }

    //
    
    public function getMerchantToken()
    {
        return $this->merchantToken;
    }

    public function setMerchantToken(string $merchantToken): void
    {
        $this->merchantToken = $merchantToken;
    }

    public function getCartData()
    {
        return $this->cartData;
    }

    public function setCartData(string $cartData): void
    {
        $this->cartData = $cartData;
    }

    public function getDeliveryNm()
    {
        return $this->deliveryNm;
    }

    public function setDeliveryNm(string $deliveryNm): void
    {
        $this->deliveryNm = $deliveryNm;
    }

    public function getDeliveryPhone()
    {
        return $this->deliveryPhone;
    }

    public function setDeliveryPhone(string $deliveryPhone): void
    {
        $this->deliveryPhone = $deliveryPhone;
    }

    public function getDeliveryAddr()
    {
        return $this->deliveryAddr;
    }

    public function setDeliveryAddr(string $deliveryAddr): void
    {
        $this->deliveryAddr = $deliveryAddr;
    }

    public function getDeliveryCity()
    {
        return $this->deliveryCity;
    }

    public function setDeliveryCity(string $deliveryCity): void
    {
        $this->deliveryCity = $deliveryCity;
    }

    public function getDeliveryState()
    {
        return $this->deliveryState;
    }

    public function setDeliveryState(string $deliveryState): void
    {
        $this->deliveryState = $deliveryState;
    }

    public function getDeliveryPostCd()
    {
        return $this->deliveryPostCd;
    }

    public function setDeliveryPostCd(string $deliveryPostCd): void
    {
        $this->deliveryPostCd = $deliveryPostCd;
    }

    public function getDeliveryCountry()
    {
        return $this->deliveryCountry;
    }

    public function setDeliveryCountry(string $deliveryCountry): void
    {
        $this->deliveryCountry = $deliveryCountry;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getReqDomain()
    {
        return $this->reqDomain;
    }

    public function setReqDomain(string $reqDomain): void
    {
        $this->reqDomain = $reqDomain;
    }

    public function getReqServerIP()
    {
        return $this->reqServerIP;
    }

    public function setReqServerIP(string $reqServerIP): void
    {
        $this->reqServerIP = $reqServerIP;
    }

    public function getUserIP()
    {
        return $this->userIP;
    }

    public function setUserIP(string $userIP): void
    {
        $this->userIP = $userIP;
    }

    public function getUserSessionID()
    {
        return $this->userSessionID;
    }

    public function setUserSessionID(string $userSessionID): void
    {
        $this->userSessionID = $userSessionID;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    public function getUserLanguage()
    {
        return $this->userLanguage;
    }

    public function setUserLanguage(string $userLanguage): void
    {
        $this->userLanguage = $userLanguage;
    }

    public function getInstmntMon()
    {
        return $this->instmntMon;
    }

    public function setInstmntMon(string $instmntMon): void
    {
        $this->instmntMon = $instmntMon;
    }

        public function getInstmntType()
    {
        return $this->instmntType;
    }

    public function setInstmntType(string $instmntType): void
    {
        $this->instmntType = $instmntType;
    }

    public static function builder(): RedirectBuilder
    {
        return new RedirectBuilder();
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
            'bankCd' => $this->bankCd,
            'vacctValidDt' => $this->vacctValidDt,
            'vacctValidTm' => $this->vacctValidTm,
            'instmntMon' => $this->instmntMon,
            'instmntType' => $this->instmntType,
            'merFixAcctId' => $this->merFixAcctId,
            'dbProcessUrl' => $this->dbProcessUrl,
            'callBackUrl' => $this->callBackUrl,
            'merchantToken' => $this->merchantToken,
            'cartData' => $this->cartData,
            'deliveryNm' => $this->deliveryNm,
            'deliveryPhone' => $this->deliveryPhone,
            'deliveryAddr' => $this->deliveryAddr,
            'deliveryCity' => $this->deliveryCity,
            'deliveryState' => $this->deliveryState,
            'deliveryPostCd' => $this->deliveryPostCd,
            'deliveryCountry' => $this->deliveryCountry,
            'description' => $this->description,
            'reqDomain' => $this->reqDomain,
            'reqServerIP' => $this->reqServerIP,
            'userIP' => $this->userIP,
            'userSessionID' => $this->userSessionID,
            'userAgent' => $this->userAgent,
            'userLanguage' => $this->userLanguage,
        ];
    }
}

class RedirectBuilder
{
    // V2

    private $timeStamp;
    private $iMid;
    private $payMethod;
    private $currency;
    private $amt;
    private $referenceNo;
    private $goodsNm;
    private $billingNm;
    private $billingPhone;
    private $billingEmail;
    private $billingAddr;
    private $billingCity;
    private $billingState;
    private $billingPostCd;
    private $billingCountry;
    private $bankCd;
    private $vacctValidDt;
    private $vacctValidTm;
    private $merFixAcctId;
    private $dbProcessUrl;
    private $callBackUrl;
    private $merchantToken;
    private $cartData;
    private $instmntMon;
    private $instmntType;

    private $deliveryNm;
    private $deliveryPhone;

    private $deliveryAddr;

    private $deliveryCity;

    private $deliveryState;
    private $deliveryPostCd;
    private $deliveryCountry;
    private $description;
    private $reqDomain;
    private $reqServerIP;
    private $userIP;
    private $userSessionID;
    private $userAgent;
    private $userLanguage;

    // GETTER SETTER V2

    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    public function setTimeStamp(string $timeStamp): RedirectBuilder
    {
        $this->timeStamp = $timeStamp;
        return $this;
    }

    public function getIMid()
    {
        return $this->iMid;
    }

    public function setIMid(string $iMid): RedirectBuilder
    {
        $this->iMid = $iMid;
        return $this;
    }

    public function getPayMethod()
    {
        return $this->payMethod;
    }

    public function setPayMethod(string $payMethod): RedirectBuilder
    {
        $this->payMethod = $payMethod;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): RedirectBuilder
    {
        $this->currency = $currency;
        return $this;
    }

    public function getAmt()
    {
        return $this->amt;
    }

    public function setAmt(string $amt): RedirectBuilder
    {
        $this->amt = $amt;
        return $this;
    }

    public function getReferenceNo()
    {
        return $this->referenceNo;
    }

    public function setReferenceNo(string $referenceNo): RedirectBuilder
    {
        $this->referenceNo = $referenceNo;
        return $this;
    }

    public function getGoodsNm()
    {
        return $this->goodsNm;
    }

    public function setGoodsNm(string $goodsNm): RedirectBuilder
    {
        $this->goodsNm = $goodsNm;
        return $this;
    }

    public function getBillingNm()
    {
        return $this->billingNm;
    }

    public function setBillingNm(string $billingNm): RedirectBuilder
    {
        $this->billingNm = $billingNm;
        return $this;
    }

    public function getBillingPhone()
    {
        return $this->billingPhone;
    }

    public function setBillingPhone(string $billingPhone): RedirectBuilder
    {
        $this->billingPhone = $billingPhone;
        return $this;
    }

    public function getBillingEmail()
    {
        return $this->billingEmail;
    }

    public function setBillingEmail(string $billingEmail): RedirectBuilder
    {
        $this->billingEmail = $billingEmail;
        return $this;
    }

    public function getBillingAddr()
    {
        return $this->billingAddr;
    }

    public function setBillingAddr(string $billingAddr): RedirectBuilder
    {
        $this->billingAddr = $billingAddr;
        return $this;
    }

    public function getBillingCity()
    {
        return $this->billingCity;
    }

    public function setBillingCity(string $billingCity): RedirectBuilder
    {
        $this->billingCity = $billingCity;
        return $this;
    }

    public function getBillingState()
    {
        return $this->billingState;
    }

    public function setBillingState(string $billingState): RedirectBuilder
    {
        $this->billingState = $billingState;
        return $this;
    }

    public function getBillingPostCd()
    {
        return $this->billingPostCd;
    }

    public function setBillingPostCd(string $billingPostCd): RedirectBuilder
    {
        $this->billingPostCd = $billingPostCd;
        return $this;
    }

    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    public function setBillingCountry(string $billingCountry): RedirectBuilder
    {
        $this->billingCountry = $billingCountry;
        return $this;
    }

    public function getBankCd()
    {
        return $this->bankCd;
    }

    public function setBankCd(string $bankCd): RedirectBuilder
    {
        $this->bankCd = $bankCd;
        return $this;
    }

    public function getVacctValidDt()
    {
        return $this->vacctValidDt;
    }

    public function setVacctValidDt(string $vacctValidDt): RedirectBuilder
    {
        $this->vacctValidDt = $vacctValidDt;
        return $this;
    }

    public function getVacctValidTm()
    {
        return $this->vacctValidTm;
    }

    public function setVacctValidTm(string $vacctValidTm): RedirectBuilder
    {
        $this->vacctValidTm = $vacctValidTm;
        return $this;
    }

    public function getMerFixAcctId()
    {
        return $this->merFixAcctId;
    }

    public function setMerFixAcctId(string $merFixAcctId): RedirectBuilder
    {
        $this->merFixAcctId = $merFixAcctId;
        return $this;
    }

    public function getDbProcessUrl()
    {
        return $this->dbProcessUrl;
    }

    public function setDbProcessUrl(string $dbProcessUrl): RedirectBuilder
    {
        $this->dbProcessUrl = $dbProcessUrl;
        return $this;
    }


    public function getCallBackUrl()
    {
        return $this->callBackUrl;
    }

    public function setCallBackUrl(string $callBackUrl): RedirectBuilder
    {
        $this->callBackUrl = $callBackUrl;
        return $this;
    }

    

    public function getMerchantToken()
    {
        return $this->merchantToken;
    }

    public function setMerchantToken($timeStamp, $iMid, $reffNo, $amount, $merchantKey): RedirectBuilder
    {

        $this->merchantToken = $timeStamp . $iMid . $reffNo . $amount . $merchantKey;
        return $this;
    }

    public function build(): Redirect
    {
        return new Redirect($this);
    }

    public function getCartData()
    {
        return $this->cartData;
    }

    public function setCartData($cartData): RedirectBuilder
    {
        $this->cartData = $cartData;
        return $this;
    }

    public function getDeliveryNm()
    {
        return $this->deliveryNm;
    }

    public function setDeliveryNm($deliveryNm): RedirectBuilder
    {
        $this->deliveryNm = $deliveryNm;
        return $this;
    }

    public function getDeliveryPhone()
    {
        return $this->deliveryPhone;
    }

    public function setDeliveryPhone($deliveryPhone): RedirectBuilder
    {
        $this->deliveryPhone = $deliveryPhone;
        return $this;
    }

    public function getDeliveryAddr()
    {
        return $this->deliveryAddr;
    }

    public function setDeliveryAddr($deliveryAddr): RedirectBuilder
    {
        $this->deliveryAddr = $deliveryAddr;
        return $this;
    }

    public function getDeliveryCity()
    {
        return $this->deliveryCity;
    }

    public function setDeliveryCity($deliveryCity): RedirectBuilder
    {
        $this->deliveryCity = $deliveryCity;
        return $this;
    }

    public function getDeliveryState()
    {
        return $this->deliveryState;
    }

    public function setDeliveryState($deliveryState): RedirectBuilder
    {
        $this->deliveryState = $deliveryState;
        return $this;
    }

    public function getDeliveryPostCd()
    {
        return $this->deliveryPostCd;
    }

    public function setDeliveryPostCd($deliveryPostCd): RedirectBuilder
    {
        $this->deliveryPostCd = $deliveryPostCd;
        return $this;
    }

    public function getDeliveryCountry()
    {
        return $this->deliveryCountry;
    }

    public function setDeliveryCountry($deliveryCountry): RedirectBuilder
    {
        $this->deliveryCountry = $deliveryCountry;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): RedirectBuilder
    {
        $this->description = $description;
        return $this;
    }

    public function getReqDomain()
    {
        return $this->reqDomain;
    }

    public function setReqDomain($reqDomain): RedirectBuilder
    {
        $this->reqDomain = $reqDomain;
        return $this;
    }

    public function getReqServerIP()
    {
        return $this->reqServerIP;
    }

    public function setReqServerIP($reqServerIP): RedirectBuilder
    {
        $this->reqServerIP = $reqServerIP;
        return $this;
    }

    public function getUserIP()
    {
        return $this->userIP;
    }

    public function setUserIP($userIP): RedirectBuilder
    {
        $this->userIP = $userIP;
        return $this;
    }

    public function getUserSessionID()
    {
        return $this->userSessionID;
    }

    public function setUserSessionID($userSessionID): RedirectBuilder
    {
        $this->userSessionID = $userSessionID;
        return $this;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setUserAgent($userAgent): RedirectBuilder
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    public function getUserLanguage()
    {
        return $this->userLanguage;
    }

    public function setUserLanguage($userLanguage): RedirectBuilder
    {
        $this->userLanguage = $userLanguage;
        return $this;
    }

    public function getInstmntMon()
    {
        return $this->instmntMon;
    }

    public function setInstmntMon($instmntMon): RedirectBuilder
    {
        $this->instmntMon = $instmntMon;
        return $this;
    }

        public function getInstmntType()
    {
        return $this->instmntType;
    }

    public function setInstmntType($instmntType): RedirectBuilder
    {
        $this->instmntType = $instmntType;
        return $this;
    }

}
