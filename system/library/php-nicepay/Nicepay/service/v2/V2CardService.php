<?php

namespace Nicepay\service\v2;

use Nicepay\service\v2\BaseV2Service;
use Nicepay\data\model\Card;
use Nicepay\utils\NicepayCons;


class V2CardService extends BaseV2Service {

    /**
     * Do payment with Card payment method
     * @param Card $requestBody Request body of Card
     * @return string
     */
    public function payment(Card $requestBody)
    {
        return $this->v2Service->requestV2TransactionUrlencodedBody($requestBody, NicepayCons::getV2PaymentEndpoint(), "POST");
    }

}