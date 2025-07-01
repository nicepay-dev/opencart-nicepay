<?php

namespace Nicepay\service\v2;

use Nicepay\common\{NICEPay, HttpRequest};
use Nicepay\data\response\NicepayV2Response;
use Nicepay\data\response\NicepayV2RedirectResponse;
use Nicepay\utils\Helper;


class NicepayV2 {

    private NICEPay $apiConfig;
    private $httpClient;

    public function __construct(NICEPay $config) {
        $this->apiConfig = $config;
        $this->httpClient = new HttpRequest();
    }

    /**
     * Request a transaction to NICEPAY V2 API.
     *
     * @param mixed $parameter the request body
     * @param string $endPoint the API endpoint
     * @param string $method the HTTP method
     *
     * @return NicepayV2Response the response from the API
     */
    public function requestV2Transaction($parameter, $endPoint, $method) :NicepayV2Response {
        
        $config = $this->apiConfig;

        // generate merchantToken 
        $parameter -> setMerchantToken(Helper::generateMerchantToken($parameter->getMerchantToken()));

        $jsonData = json_encode($parameter->toArrayV2());

        $url = $this->apiConfig->getNicepayBaseUrl() . $endPoint;
        $headers = self::getHeaders();

        
        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return NicepayV2Response::fromArray($response);
    }

    /**
     * Request a transaction to NICEPAY V2 API with urlencoded body.
     *
     * @param mixed $parameter the request body
     * @param string $endPoint the API endpoint
     * @param string $method the HTTP method
     *
     * @return mixed the response from the API
     */
    public function requestV2TransactionUrlencodedBody($parameter, $endPoint, $method) {
        
        $config = $this->apiConfig;

        // generate merchantToken 
        $parameter -> setMerchantToken(Helper::generateMerchantToken($parameter->getMerchantToken()));
        $url = $this->apiConfig->getNicepayBaseUrl() . $endPoint;
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $encodedBody = http_build_query($parameter->toArrayPayment());

        $response = $this->httpClient->requestWithUrlEncodedBody($headers, $url, $encodedBody, $method, $config->isRetryFlag(), $config->getRetryCount());

        return $response;
    }

    public function requestV2RedirectTransaction($parameter, $endPoint, $method) :NicepayV2RedirectResponse {
        
        $config = $this->apiConfig;

        // generate merchantToken 
        $parameter -> setMerchantToken(Helper::generateMerchantToken($parameter->getMerchantToken()));

        $jsonData = json_encode($parameter->toArrayV2());

        $url = $this->apiConfig->getNicepayBaseUrl() . $endPoint;
        $headers = self::getHeaders();

        
        $response = $this->httpClient->request($headers, $url, $jsonData, $method, $config->isRetryFlag(), $config->getRetryCount());

        return NicepayV2RedirectResponse::fromArray($response);
    }


    private function getHeaders():array {

        return [
            'Content-Type: application/json',
        ];
    }

    

    // timeStamp + iMid + refNo + amount + merchantKey
}