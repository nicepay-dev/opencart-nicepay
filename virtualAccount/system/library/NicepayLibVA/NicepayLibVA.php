<?php
/*
 * ____________________________________________________________
 *
 * Copyright (C) 2016 NICE IT&T
 *
 * Please do not modify this module.
 * This module may used as it is, there is no warranty.
 *
 * @ description : PHP SSL Client module.
 * @ name        : NicepayLite.php
 * @ author      : NICEPAY I&T (tech@nicepay.co.kr)
 * @ date        :
 * @ modify      : 09.03.2016
 *
 * 09.03.2016 Update Log
 * Please contact it.support@ionpay.net for inquiry
 *
 * ____________________________________________________________
 */

include_once ('NicepayRequestorVA.php');

class NicepayLibVA  {
    // public $tXid;
    // public $authNo;
    // public $bankVacctNo;
    // public $resultCd;
    // public $resultMsg;

    // public $iMid = NICEPAY_IMID_VA;
    // public $callBackUrl = NICEPAY_CALLBACK_URL_VA;
    // public $dbProcessUrl = NICEPAY_DBPROCESS_URL_VA;
    // public $merchantKey = NICEPAY_MERCHANT_KEY_VA;
    // public $cartData;

    public $requestData = array();
    public $resultData = array();
    // public $log;
    // public $debug;

    public $request;

    public function __construct() {
        $this->request = new NicepayRequestorVA();
        // $this->log = new NicepayLoggerVA();
    }

    public function getUserIP() {
        $client = (isset($_SERVER['HTTP_CLIENT_IP'])) ? @$_SERVER['HTTP_CLIENT_IP'] : NULL;
        $forward = (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? @$_SERVER['HTTP_X_FORWARDED_FOR'] : NULL;
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

    public function oneLiner($string) {
        // Return string in one line, remove new lines and white spaces
        return preg_replace(array('/\n/','/\n\r/','/\r\n/','/\r/','/\s+/','/\s\s*/'), ' ', $string);
    }

    public function extractNotification($name) {
        if (is_array($name)) {
            foreach($name as $value) {
                if (isset($_REQUEST[$value])) {
                    $this->notification[$value] = $_REQUEST[$value];
                } else {
                    $this->notification[$value] = NULL;
                }
            }
        }
        elseif (isset($_REQUEST[$name])) {
            $this->notification[$name] = $_REQUEST[$name];
        } else {
            $this->notification[$name] = NULL;
        }
    }

    public function getNotification($name) {
        return $this->notification[$name];
    }

    public function merchantToken() {
        return hash('sha256', $this->get('timeStamp').$this->get('iMid').$this->get('referenceNo').$this->get('amt').$this->get('mKey'));
    }

    public function merchantTokenC() {
        return hash('sha256', $this->get('iMid').$this->get('tXid').$this->get('amt').$this->get('mKey'));
    }

    // Set POST parameter name and its value
    public function set($name, $value) {
        $this->requestData[$name] = $value;
    }

    // Retrieve POST parameter value
    public function get($name) {
        if (isset($this->requestData[$name])) {
            return $this->requestData[$name];
        }

        return "";
    }

    // Request VA
    public function requestVA() {
        // Populate data
        // $this->set('iMid', $this->iMid);
        // $this->set('goodsNm', $this->get('description'));
        // $this->set('merchantToken', $this->merchantToken());
        // $this->set('dbProcessUrl', $this->dbProcessUrl);
        // $this->set('userIP', $this->getUserIP());
        if ($this->get('cartData')  == "") {
            $this->set('cartData', '{}');
        }

        // Check Parameter
        $this->checkParam('timeStamp', '01');
        $this->checkParam('iMid', '02');
        $this->checkParam('payMethod', '03');
        $this->checkParam('currency', '04');
        $this->checkParam('amt', '05');
        $this->checkParam('referenceNo', '06');
        $this->checkParam('goodsNm', '07');
        $this->checkParam('billingNm', '08');
        $this->checkParam('billingPhone', '09');
        $this->checkParam('billingEmail', '10');
        $this->checkParam('billingAddr', '11');
        $this->checkParam('billingCity', '12');
        $this->checkParam('billingState', '13');
        $this->checkParam('billingPostCd', '14');
        $this->checkParam('billingCountry', '15');
        $this->checkParam('deliveryNm', '16');
        $this->checkParam('deliveryPhone', '17');
        $this->checkParam('deliveryAddr', '18');
        $this->checkParam('deliveryCity', '19');
        $this->checkParam('deliveryState', '20');
        $this->checkParam('deliveryPostCd', '21');
        $this->checkParam('deliveryCountry', '22');
        $this->checkParam('dbProcessUrl', '23');
        $this->checkParam('vat', '24');
        $this->checkParam('fee', '25');
        $this->checkParam('notaxAmt', '26');
        $this->checkParam('description', '27');
        $this->checkParam('merchantToken', '28');
        $this->checkParam('reqDt', '29');
        $this->checkParam('reqTm', '30');
        // $this->checkParam('reqDomain', '31');
        // $this->checkParam('reqServerIP', '32');
        // $this->checkParam('reqClientVer', '33');
        $this->checkParam('userIP', '34');
        // $this->checkParam('userSessionID', '35');
        // $this->checkParam('userAgent', '36');
        // $this->checkParam('userLanguage', '37');
        $this->checkParam('cartData', '38');
        // $this->checkParam('instmntType', '39');
        // $this->checkParam('instmntMon', '40');
        // $this->checkParam('recurrOpt', '41');
        $this->checkParam('bankCd', '42');
        $this->checkParam('vacctValidDt', '43');
        $this->checkParam('vacctValidTm', '44');
        // $this->checkParam('merFixAcctId', '45');
        // $this->checkParam('mitraCd', '46');
        // $this->checkParam('tXid', '47');

        // Send Request
        $this->request->operation('requestVA');
        $this->request->openSocket();
        $this->resultData = $this->request->apiRequest($this->requestData);
        unset($this->requestData);
        return $this->resultData;
    }

    // Charge Credit Card
    // public function chargeCard() {
        // Populate data
        // $this->set('iMid', $this->iMid);
        // $this->set('merchantToken', $this->merchantToken());
        // $this->set('dbProcessUrl', $this->dbProcessUrl);
        // $this->set('callBackUrl', $this->callBackUrl);
        // $this->set('instmntMon', '1');
        // $this->set('instmntType', '1');
        // $this->set('userIP', $this->getUserIP());
        // $this->set('goodsNm', $this->get('description'));
        // $this->set('vat', '0');
        // $this->set('fee', '0');
        // $this->set('notaxAmt', '0');
        // if ($this->get('cartData')  == "") {
            // $this->set('cartData', '{}');
        // }

        // Check Parameter
        // $this->checkParam('iMid', '01');
        // $this->checkParam('payMethod', '01');
        // $this->checkParam('currency', '03');
        // $this->checkParam('amt', '02');
        // $this->checkParam('instmntMon', '05');
        // $this->checkParam('referenceNo', '06');
        // $this->checkParam('goodsNm', '07');
        // $this->checkParam('billingNm', '08');
        // $this->checkParam('billingPhone', '09');
        // $this->checkParam('billingEmail', '10');
        // $this->checkParam('billingAddr', '11');
        // $this->checkParam('billingCity', '12');
        // $this->checkParam('billingState', '13');
        // $this->checkParam('billingCountry', '14');
        // $this->checkParam('deliveryNm', '15');
        // $this->checkParam('deliveryPhone', '16');
        // $this->checkParam('deliveryAddr', '17');
        // $this->checkParam('deliveryCity', '18');
        // $this->checkParam('deliveryState', '19');
        // $this->checkParam('deliveryPostCd', '20');
        // $this->checkParam('deliveryCountry', '21');
        // $this->checkParam('callBackUrl', '22');
        // $this->checkParam('dbProcessUrl', '23');
        // $this->checkParam('vat', '24');
        // $this->checkParam('fee', '25');
        // $this->checkParam('notaxAmt', '26');
        // $this->checkParam('description', '27');
        // $this->checkParam('merchantToken', '28');
        
        // Send Request
        // $this->request->operation('creditCard');
        // $this->request->openSocket();
        // $this->resultData = $this->request->apiRequest($this->requestData);
        // unset($this->requestData);
        // return $this->resultData;
    // }

    public function checkPaymentStatus($timeStamp, $iMid, $tXid, $referenceNo, $amt) {

        // Populate data
        $this->set('timeStamp', $timeStamp);
        $this->set('tXid', $tXid);
        $this->set('iMid', $iMid);
        $this->set('referenceNo', $referenceNo);
        $this->set('amt', $amt);
        $this->set('merchantToken', $this->merchantToken());

        unset($this->requestData['mKey']);

        // Check Parameter
        $this->checkParam('timeStamp', '01');
        $this->checkParam('tXid', '47');
        $this->checkParam('iMid', '02');
        $this->checkParam('referenceNo', '06');
        $this->checkParam('amt', '05');
        $this->checkParam('merchantToken', '28');

        // Send Request
        $this->request->operation('checkPaymentStatus');
        $this->request->openSocket();
        $this->resultData = $this->request->apiRequest($this->requestData);
        unset($this->requestData);
        return $this->resultData;
    }

    // Cancel VA (VA can be canceled only if VA status is not paid)
    // public function cancelVA($tXid, $amt) {
        // Populate data
        // $this->set('iMid', $this->iMid);
        // $this->set('merchantToken', $this->merchantTokenC());
        // $this->set('tXid', $tXid);
        // $this->set('amt', $amt);

        // Check Parameter
        // $this->checkParam('iMid', '01');
        // $this->checkParam('amt', '04');
        // $this->checkParam('merchantToken', '28');
        // $this->checkParam('tXid', '36');

        // Send Request
        // $this->request->operation('cancelVA');
        // $this->request->openSocket();
        // $this->resultData = $this->request->apiRequest($this->requestData);
        // unset($this->requestData);
        // return $this->resultData;
    // }

    public function checkParam($requestData, $errorNo) {
        if (null == $this->get($requestData)) {
            die($this->getError($errorNo));
        }
    }

    public function getError($id) {
        $error = array(

            // That always Unknown Error :)
            '00' => array(
                'errorCode' => '00000',
                'errorMsg' => 'Unknown error. Contact it.support@ionpay.net.'
            ),
            // General Mandatory parameters
            '01' => array(
                'error' => '10001',
                'errorMsg' => '(timeStamp) is not set. Please set (timeStamp).'
            ),
            '02' => array(
                'error' => '10002',
                'errorMsg' => '(iMid) is not set. Please set (iMid).'
            ),
            '03' => array(
                'error' => '10003',
                'errorMsg' => '(payMethod) is not set. Please set (payMethod).'
            ),
            '04' => array(
                'error' => '10004',
                'errorMsg' => '(currency) is not set. Please set (currency).'
            ),
            '05' => array(
                'error' => '10005',
                'errorMsg' => '(amt) is not set. Please set (amt).'
            ),
            '06' => array(
                'error' => '10006',
                'errorMsg' => '(referenceNo) is not set. Please set (referenceNo).'
            ),
            '07' => array(
                'error' => '10007',
                'errorMsg' => '(goodsNm) is not set. Please set (goodsNm).'
            ),
            '08' => array(
                'error' => '10008',
                'errorMsg' => '(billingNm) is not set. Please set (billingNm).'
            ),
            '09' => array(
                'error' => '10009',
                'errorMsg' => '(billingPhone) is not set. Please set (billingPhone).'
            ),
            '10' => array(
                'error' => '10010',
                'errorMsg' => '(billingEmail) is not set. Please set (billingEmail).'
            ),
            '11' => array(
                'error' => '10011',
                'errorMsg' => '(billingAddr) is not set. Please set (billingAddr).'
            ),
            '12' => array(
                'error' => '10012',
                'errorMsg' => '(billingCity) is not set. Please set (billingCity).'
            ),
            '13' => array(
                'error' => '10013',
                'errorMsg' => '(billingState) is not set. Please set (billingState).'
            ),
            '14' => array(
                'error' => '10014',
                'errorMsg' => '(billingPostCd) is not set. Please set (billingPostCd).'
            ),
            '15' => array(
                'error' => '10015',
                'errorMsg' => '(billingCountry) is not set. Please set (billingCountry).'
            ),
            '16' => array(
                'error' => '10016',
                'errorMsg' => '(deliveryNm) is not set. Please set (deliveryNm).'
            ),
            '17' => array(
                'error' => '10017',
                'errorMsg' => '(deliveryPhone) is not set. Please set (deliveryPhone).'
            ),
            '18' => array(
                'error' => '10018',
                'errorMsg' => '(deliveryAddr) is not set. Please set (deliveryAddr).'
            ),
            '19' => array(
                'error' => '10019',
                'errorMsg' => '(deliveryCity) is not set. Please set (deliveryCity).'
            ),
            '20' => array(
                'error' => '10020',
                'errorMsg' => '(deliveryState) is not set. Please set (deliveryState).'
            ),
            '21' => array(
                'error' => '10021',
                'errorMsg' => '(deliveryPostCd) is not set. Please set (deliveryPostCd).'
            ),
            '22' => array(
                'error' => '10022',
                'errorMsg' => '(deliveryCountry) is not set. Please set (deliveryCountry).'
            ),
            '23' => array(
                'error' => '10023',
                'errorMsg' => '(dbProcessUrl) is not set. Please set (dbProcessUrl).'
            ),
            '24' => array(
                'error' => '10024',
                'errorMsg' => '(vat) is not set. Please set (vat).'
            ),
            '25' => array(
                'error' => '10025',
                'errorMsg' => '(fee) is not set. Please set (fee).'
            ),
            '26' => array(
                'error' => '10026',
                'errorMsg' => '(notaxAmt) is not set. Please set (notaxAmt).'
            ),
            '27' => array(
                'error' => '10027',
                'errorMsg' => '(description) is not set. Please set (description).'
            ),
            // '28' => array(
            //     'error' => '10028',
            //     'errorMsg' => '(merchantToken) is not set. Please set (merchantToken).'
            // ),
            '29' => array(
                'error' => '10029',
                'errorMsg' => '(reqDt) is not set. Please set (reqDt).'
            ),
            '30' => array(
                'error' => '10030',
                'errorMsg' => '(reqTm) is not set. Please set (reqTm).'
            ),
            // '31' => array(
                // 'error' => '10031',
                // 'errorMsg' => '(reqDomain) is not set. Please set (reqDomain).'
            // ),
            // '32' => array(
                // 'error' => '10032',
                // 'errorMsg' => '(reqServerIP) is not set. Please set (reqServerIP).'
            // ),
            // '33' => array(
                // 'error' => '10033',
                // 'errorMsg' => '(reqClientVer) is not set. Please set (reqClientVer).'
            // ),
            '34' => array(
                'error' => '10034',
                'errorMsg' => '(userIP) is not set. Please set (userIP).'
            ),
            // '35' => array(
                // 'error' => '10035',
                // 'errorMsg' => '(userSessionID) is not set. Please set (userSessionID).'
            // ),
            // '36' => array(
                // 'error' => '10036',
                // 'errorMsg' => '(userAgent) is not set. Please set (userAgent).'
            // ),
            // '37' => array(
                // 'error' => '10037',
                // 'errorMsg' => '(userLanguage) is not set. Please set (userLanguage).'
            // ),
            '38' => array(
                'error' => '10038',
                'errorMsg' => '(cartData) is not set. Please set (cartData).'
            ),
            // '39' => array(
                // 'error' => '10039',
                // 'errorMsg' => '(instmntType) is not set. Please set (instmntType).'
            // ),
            // '40' => array(
                // 'error' => '10040',
                // 'errorMsg' => '(instmntMon) is not set. Please set (instmntMon).'
            // ),
            // '41' => array(
                // 'error' => '10041',
                // 'errorMsg' => '(recurrOpt) is not set. Please set (recurrOpt).'
            // ),
            '42' => array(
                'error' => '10042',
                'errorMsg' => '(bankCd) is not set. Please set (bankCd).'
            ),
            '43' => array(
                'error' => '10043',
                'errorMsg' => '(vacctValidDt) is not set. Please set (vacctValidDt).'
            ),
            '44' => array(
                'error' => '10044',
                'errorMsg' => '(vacctValidTm) is not set. Please set (vacctValidTm).'
            ),
            // '45' => array(
                // 'error' => '10045',
                // 'errorMsg' => '(merFixAcctId) is not set. Please set (merFixAcctId).'
            // ),
            // '46' => array(
                // 'error' => '10046',
                // 'errorMsg' => '(mitraCd) is not set. Please set (mitraCd).'
            // ),
            '47' => array(
                'error' => '10047',
                'errorMsg' => '(tXid) is not set. Please set (tXid).'
            ),
        );

        return (json_encode($this->oneLiner($error[$id])));
    }
}
