<?php

// namespace App\Lib\NicepayDirect;

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
 * @ modify      : 22.02.2016
 *
 * 2016.02.22 Update Log
 * Please contact it.support@ionpay.net for inquiry
 *
 * ____________________________________________________________
 */

include_once ('NicepayLogger.php');
include_once ('NicepayConfig.php');

class NicepayRequestor {
    public $sock = 0;
    public $apiUrl;
    public $port = 443;
    public $status;
    public $headers = "";
    public $body = "";
    public $request;
    public $errorcode;
    public $errormsg;
    public $log;
    public $timeout;

    public function __construct() {
        $this->log = new NicepayLogger();
    }

    public function operation($type) {
        // print_r($type);exit;
        if ($type == "requestVA") {
            $this->apiUrl = NICEPAY_REQ_URL;
        } else if ($type == "threeDSecure") {
            $this->apiUrl = NICEPAY_3DSECURE_URL;
        } else if ($type == "reqChargeCard") {
            $this->apiUrl = NICEPAY_REQ_CHARGE_URL;
        } else if ($type == "chargeCard") {
            $this->apiUrl = NICEPAY_CHARGE_URL;
        } else if ($type == "cancel") {
            $this->apiUrl = NICEPAY_CANCEL_URL;
        } else if ($type == "checkPaymentStatus") {
            $this->apiUrl = NICEPAY_ORDER_STATUS_URL;
        } else if ($type == "recurringToken") {
            $this->apiUrl = NICEPAY_RECURRING_TOKEN;
        } else if ($type == "requestCVS") {
            $this->apiUrl = NICEPAY_REQ_URL;
        } else if ($type == "requestTRX") {
            $this->apiUrl = NICEPAY_REQ_TRX_URL;
        } else if ($type == "requestPay") {
            $this->apiUrl = NICEPAY_REQ2_URL;
        }
    }

    public function apiRequest($data, $apiUrl) {

        $postdata = json_encode($data);
        // print_r($postdata);exit;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $server_result = curl_exec ($ch);
        // print_r($server_result);exit;
        $result = json_decode($server_result);

        curl_close($ch);

        return $result;
    }


    public function apiRequestRedV2($data, $apiUrl) {

        $postdata = json_encode($data, JSON_BIGINT_AS_STRING, 1);
        // print_r($data);
        // echo "-";
        // print_r($postdata);exit;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $server_result = curl_exec ($ch);
        // print_r($server_result);exit;
        $result = json_decode($server_result);

        curl_close($ch);

        return $result;
    }

    public function openSocket() {
        $host = parse_url($this->apiUrl, PHP_URL_HOST);
        $tryCount = 0;
        if (! $this->sock = @fsockopen ("ssl://".$host, $this->port, $errno, $errstr, NICEPAY_TIMEOUT_CONNECT )) {
            while ($tryCount < 5) {
                if ($this->sock = @fsockopen("ssl://".$host, $this->port, $errno, $errstr, NICEPAY_TIMEOUT_CONNECT )) {
                    return true;
                }
                sleep(2);
                $tryCount++;
            }
            $this->errorcode = $errno;
            switch ($errno) {
                case - 3 :
                    $this->errormsg = 'Socket creation failed (-3)';
                case - 4 :
                    $this->errormsg = 'DNS lookup failure (-4)';
                case - 5 :
                    $this->errormsg = 'Connection refused or timed out (-5)';
                default :
                    $this->errormsg = 'Connection failed (' . $errno . ')';
                    $this->errormsg .= ' ' . $errstr;
            }
            return false;
        }
        return true;
    }


    public function apiRequestV1($data) {
        // print_r($data);exit;
        $host = parse_url($this->apiUrl, PHP_URL_HOST);
        $uri = parse_url($this->apiUrl, PHP_URL_PATH);
        $this->headers = "";
        $this->body = "";
        $postdata = $this->buildQueryString ($data);

        /* Write */
        $request = "POST " . $uri . " HTTP/1.0\r\n";
        $request .= "Connection: close\r\n";
        $request .= "Host: " . $host . "\r\n";
        $request .= "Content-type: application/x-www-form-urlencoded\r\n";
        $request .= "Content-length: " . strlen ( $postdata ) . "\r\n";
        $request .= "Accept: */*\r\n";
        $request .= "\r\n";
        $request .= $postdata . "\r\n";
        $request .= "\r\n";
        if($this->sock) {
            fwrite ( $this->sock, $request );

            /* Read */
            stream_set_blocking ($this->sock, FALSE);

            $atStart = true;
            $IsHeader = true;
            $timeout = false;
            $start_time = time ();
            while ( ! feof ($this->sock ) && ! $timeout) {
                $line = fgets ($this->sock, 4096);
                $diff = time () - $start_time;
                if ($diff >= NICEPAY_TIMEOUT_READ) {
                    $timeout = true;
                }
                if ($IsHeader) {
                    if ($line == "") // for stream_set_blocking
                    {
                        continue;
                    }
                    if (substr ($line, 0, 2) == "\r\n") // end of header
                    {
                        $IsHeader = false;
                        continue;
                    }
                    $this->headers .= $line;
                    if ($atStart) {
                        $atStart = false;
                        if (! preg_match ( '/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m )) {
                            $this->errormsg = "Status code line invalid: " . htmlentities ( $line );
                            fclose ( $this->sock );
                            return false;
                        }
                        $http_version = $m [1];
                        $this->status = $m [2];
                        $status_string = $m [3];
                        continue;
                    }
                } else {
                    $this->body .= $line;
                }
            }
            fclose ( $this->sock );

            if ($timeout) {
                $this->errorcode = NICEPAY_READ_TIMEOUT_ERR;
                $this->errormsg = "Socket Timeout(" . $diff . "SEC)";
                return false;
            }
            // return true
            if(!$this->parseResult($this->body)) {
                $this->body =   substr($this->body, 4);
               // var_dump($this->body);
               // var_dump($host);
               // var_dump($uri);
                return $this->parseResult($this->body);
            }
            return $this->parseResult($this->body);
        } else {
            echo "Connection Timeout. Please retry.";
            return false;
        }
    }

    public function buildQueryString($data) {
        $querystring = '';
        // print_r($data);

        if (is_array ($data)) {
            foreach ($data as $key => $val) {
                if (is_array ($val)) {
                    foreach ($val as $val2) {
                        if ($key != "key")
                            $querystring .= urlencode ($key) . '=' . urlencode ( $val2 ) . '&';
                    }
                    } else {
                    if ($key != "key")
                        $querystring .= urlencode ($key) . '=' . urlencode ($val) . '&';
                    }
            }
        $querystring = substr ($querystring, 0, - 1);
        } else {
            $querystring = $data;
        }
            return $querystring;
    }

    public function parseResult($result) {
        // print_r($result);
        return json_decode($result);
    }
}
