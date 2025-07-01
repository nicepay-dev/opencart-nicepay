<?php
namespace Nicepay\data\response;


class NicepayV2RedirectResponse
{
    private $resultCd;
    private $resultMsg;
    private $tXid;
    private $referenceNo;
    private $payMethod;
    private $amt;
    private $transDt;
    private $transTm;
    private $description;
    private $currency;
    private $goodsNm;
    private $billingNm;
    private $payValidDt;
    private $payValidTm;
    private $paymentURL;

    // Constructor
    function __construct(NicepayV2redirectResponseBuilder $builder)
    {
        $this->resultCd = $builder->getResultCd();
        $this->resultMsg = $builder->getResultMsg();
        $this->tXid = $builder->getTXid();
        $this->referenceNo = $builder->getReferenceNo();
        $this->payMethod = $builder->getPayMethod();
        $this->amt = $builder->getAmt();
        $this->transDt = $builder->getTransDt();
        $this->transTm = $builder->getTransTm();
        $this->currency = $builder->getCurrency();
        $this->goodsNm = $builder->getGoodsNm();
        $this->billingNm = $builder->getBillingNm();
        $this->payValidDt = $builder->getPayValidDt();
        $this->payValidTm = $builder->getPayValidTm();
        $this->paymentURL = $builder->getPaymentURL();


    }

        // Getters
        public function getResultCd() { return $this->resultCd; }
        public function getResultMsg() { return $this->resultMsg; }
        public function getTXid() { return $this->tXid; }
        public function getReferenceNo() { return $this->referenceNo; }
        public function getPayMethod() { return $this->payMethod; }
        public function getAmt() { return $this->amt; }
        public function getTransDt() { return $this->transDt; }
        public function getTransTm() { return $this->transTm; }
        public function getDescription() { return $this->description; }
        public function getCurrency() { return $this->currency; }
        public function getGoodsNm() { return $this->goodsNm; }
        public function getBillingNm() { return $this->billingNm; }
        public function getPayValidDt() { return $this->payValidDt; }
        public function getPayValidTm() { return $this->payValidTm; }
        public function getPaymentURL() { return $this->paymentURL; }

        // Setters
        public function setResultCd($resultCd): void { $this->resultCd = $resultCd; }
        public function setResultMsg($resultMsg): void { $this->resultMsg = $resultMsg; }
        public function setTXid($tXid): void { $this->tXid = $tXid; }
        public function setReferenceNo($referenceNo): void { $this->referenceNo = $referenceNo; }
        public function setPayMethod($payMethod): void { $this->payMethod = $payMethod; }
        public function setAmt($amt): void { $this->amt = $amt; }
        public function setTransDt($transDt): void { $this->transDt = $transDt; }
        public function setTransTm($transTm): void { $this->transTm = $transTm; }
        public function setDescription($description): void { $this->description = $description; }
        public function setCurrency($currency): void { $this->currency = $currency; }
        public function setGoodsNm($goodsNm): void { $this->goodsNm = $goodsNm; }
        public function setBillingNm($billingNm): void { $this->billingNm = $billingNm; }
        public function setPayValidDt($payValidDt): void { $this->payValidDt = $payValidDt; }
        public function setPayValidTm($payValidTm): void { $this->payValidTm = $payValidTm; }
        public function setPaymentURL($paymentURL): void { $this->paymentURL = $paymentURL; }

        public static function fromArray(array $data): self
        {
            $builder = (new NicepayV2RedirectResponseBuilder())
                ->setResultCd($data['resultCd'] ?? null)
                ->setResultMsg($data['resultMsg'] ?? null)
                ->setTXid($data['tXid'] ?? null)
                ->setReferenceNo($data['referenceNo'] ?? null)
                ->setPayMethod($data['payMethod'] ?? null)
                ->setAmt($data['amt'] ?? null)
                ->setTransDt($data['transDt'] ?? null)
                ->setTransTm($data['transTm'] ?? null)
                ->setCurrency($data['currency'] ?? null)
                ->setGoodsNm($data['goodsNm'] ?? null)
                ->setBillingNm($data['billingNm'] ?? null)
                ->setPayValidDt($data['vacctValidDt'] ?? null)
                ->setPayValidTm($data['vacctValidTm'] ?? null)
                ->setPaymentURL($data['paymentURL'] ?? null);

                return new self($builder);
        }
}

    // Builder class
    class NicepayV2RedirectResponseBuilder {

        private $resultCd;
        private $resultMsg;
        private $tXid;
        private $referenceNo;
        private $payMethod;
        private $amt;
        private $transDt;
        private $transTm;
        private $description;
        private $currency;
        private $goodsNm;
        private $billingNm;
        private $payValidDt;
        private $payValidTm;
        private $paymentURL;

                // Getters
                public function getResultCd() { return $this->resultCd; }
                public function getResultMsg() { return $this->resultMsg; }
                public function getTXid() { return $this->tXid; }
                public function getReferenceNo() { return $this->referenceNo; }
                public function getPayMethod() { return $this->payMethod; }
                public function getAmt() { return $this->amt; }
                public function getTransDt() { return $this->transDt; }
                public function getTransTm() { return $this->transTm; }
                public function getDescription() { return $this->description; }
                public function getCurrency() { return $this->currency; }
                public function getGoodsNm() { return $this->goodsNm; }
                public function getBillingNm() { return $this->billingNm; }
                public function getPayValidDt() { return $this->payValidDt; }
                public function getPayValidTm() { return $this->payValidTm; }
                public function getPaymentURL() { return $this->paymentURL; }
        
                // Setters
                public function setResultCd($resultCd): NicepayV2RedirectResponseBuilder { $this->resultCd = $resultCd; return $this;}
                public function setResultMsg($resultMsg): NicepayV2RedirectResponseBuilder { $this->resultMsg = $resultMsg;return $this; }
                public function setTXid($tXid): NicepayV2RedirectResponseBuilder { $this->tXid = $tXid; return $this;}
                public function setReferenceNo($referenceNo): NicepayV2RedirectResponseBuilder { $this->referenceNo = $referenceNo; return $this;}
                public function setPayMethod($payMethod): NicepayV2RedirectResponseBuilder { $this->payMethod = $payMethod; return $this;}
                public function setAmt($amt): NicepayV2RedirectResponseBuilder { $this->amt = $amt; return $this;}
                public function setTransDt($transDt): NicepayV2RedirectResponseBuilder { $this->transDt = $transDt; return $this;}
                public function setTransTm($transTm): NicepayV2RedirectResponseBuilder { $this->transTm = $transTm; return $this;}
                public function setDescription($description): NicepayV2RedirectResponseBuilder { $this->description = $description; return $this;}
                public function setCurrency($currency): NicepayV2RedirectResponseBuilder { $this->currency = $currency; return $this;}
                public function setGoodsNm($goodsNm): NicepayV2RedirectResponseBuilder { $this->goodsNm = $goodsNm; return $this;}
                public function setBillingNm($billingNm): NicepayV2RedirectResponseBuilder { $this->billingNm = $billingNm; return $this;}
                public function setPayValidDt($payValidDt): NicepayV2RedirectResponseBuilder { $this->payValidDt = $payValidDt; return $this;}
                public function setPayValidTm($payValidTm) : NicepayV2RedirectResponseBuilder{ $this->payValidTm = $payValidTm; return $this;}
                public function setPaymentURL($paymentURL): NicepayV2RedirectResponseBuilder { $this->paymentURL = $paymentURL; return $this;}

                public function build(): NicepayV2RedirectResponse
                {
                    return new NicepayV2RedirectResponse($this);
                }
}

?>
