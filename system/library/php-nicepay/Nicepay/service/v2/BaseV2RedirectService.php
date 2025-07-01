<?php

namespace Nicepay\service\v2;

use Nicepay\common\NICEPay;
use Nicepay\data\model\Cancel;
use Nicepay\Data\Model\InquiryStatus;
use Nicepay\service\v2\NicepayV2;
use Nicepay\data\response\NicepayV2Response;
use Nicepay\data\response\NicepayV2RedirectResponse;
use Nicepay\utils\NicepayCons;

class BaseV2RedirectService {

    protected NicepayV2 $v2Service;

    public function __construct(NICEPay $config)
    {
        $this->v2Service = new NicepayV2($config);
    }


    /**
     * Registration API for V2
     *
     * @param mixed $requestBody The request body for registration
     * @return NicepayV2Response The response from the registration API
     */
    public function registration($requestBody): NicepayV2RedirectResponse
    {
        return $this->v2Service->requestV2RedirectTransaction($requestBody, NicepayCons::getV2RegistrationRedirectEndpoint(), "POST");
    }

    /**
     * Inquiry Status API for V2
     *
     * @param InquiryStatus $requestBody The request body for inquiry status
     * @return NicepayV2Response The response from the inquiry status API
     */
    public function inquiryStatus(InquiryStatus $requestBody): NicepayV2Response
    {
        return $this->v2Service->requestV2Transaction($requestBody, NicepayCons::getV2InquiryStatusEndpoint(), "POST");
    }

    /**
     * Cancel / Refund API for V2
     *
     * @param Cancel $requestBody The request body for cancel
     * @return NicepayV2Response The response from the cancel API
     */
    public function cancel(Cancel $requestBody): NicepayV2Response
    {
        return $this -> v2Service->requestV2Transaction($requestBody, NicepayCons::getV2CancelEndpoint(), "POST");
    }
}