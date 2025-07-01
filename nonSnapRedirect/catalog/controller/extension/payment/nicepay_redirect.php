<?php

use Nicepay\common\NICEPay;
use Nicepay\Service\v2\BaseV2RedirectService;
use Nicepay\common\NicepayError;
use Nicepay\Data\Model\{Redirect, InquiryStatus};
use Nicepay\service\v2\V2RedirectService;
use Nicepay\utils\Helper;

require_once DIR_SYSTEM . 'library/php-nicepay/vendor/autoload.php';


class ControllerExtensionPaymentNicepayRedirect extends Controller
{
    public function index()
    {
        $this->load->language('extension/payment/nicepay_redirect');

        // $data['action'] = $this->url->link('extension/payment/nicepay_redirect/confirm', '', true);
        $data['confirm_url'] = $this->url->link('extension/payment/nicepay_redirect/confirm', '', true);

        return $this->load->view('extension/payment/nicepay_redirect', $data);
        
    }

    public function confirm()
    {
        if (
            !isset($this->session->data['payment_method']['code']) ||
            $this->session->data['payment_method']['code'] !== 'nicepay_redirect'
        ) {
            return;
        }



        $this->load->model('checkout/order');
        $order_id = $this->session->data['order_id'];
        $order_info = $this->model_checkout_order->getOrder($order_id);


        $helper = new Helper();

        $products = $this->cart->getProducts();
        $cartItems = [];

        foreach ($products as $product) {
            $cartItems[] = [
                'goods_id'           => $product['model'], // or SKU if available
                'goods_detail'       => $product['model'],
                'goods_name'         => $product['name'],
                'goods_amt'          => (string)(int)floatval($product['total']), // as string
                'goods_type'         => 'General', // You can customize this
                'goods_url'          => 'http://yourdomain.com/index.php?route=product/product&product_id=' . $product['product_id'],
                'goods_quantity'     => (string)(int)$product['quantity'], // as string
            ];
        }
        $cartDataFormatted = [
        'count' => (string) count($cartItems),
        'item'  => $cartItems
        ];

        $cartDataJson = json_encode($cartDataFormatted, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        try {
            $nicepay = $this->getNicepayConfig($order_id);
            $timeStamp =$helper::getFormattedTimestampV2();
            $iMid = $this->config->get('payment_nicepay_redirect_merchant_imid');
            $merKey = $this->config->get('payment_nicepay_redirect_merchant_key');
            $reffNo = 'INV-' . $order_id;
            $amt = intval($order_info['total']);


            $chargeData = Redirect::builder()
                ->setTimeStamp($timeStamp)
                ->setIMid($iMid)
                ->setPayMethod('00')
                ->setCurrency('IDR')
                ->setReferenceNo($reffNo)
                ->setAmt($amt)
                ->setMerchantToken($timeStamp, $iMid, $reffNo, $amt, $merKey)
                ->setGoodsNm('Order #' . $order_id)
                ->setBillingNm(trim($order_info['payment_firstname'] . ' ' . $order_info['payment_lastname']))
                ->setBillingPhone('00000000000000')
                ->setBillingEmail('test@test.com')
                ->setBillingAddr(trim($order_info['payment_address_1'] . ' ' . $order_info['payment_address_2']))
                ->setInstmntMon('1')
                ->setInstmntType('1')
                ->setBillingCity($order_info['payment_city'])
                ->setBillingState($order_info['payment_city'])
                ->setBillingPostCd($order_info['payment_postcode'])
                ->setBillingCountry($order_info['payment_country'])
                ->setUserIP('127.0.0.1')
                ->setCartData($cartDataJson)
                ->setDbProcessUrl(HTTP_SERVER . 'nicepay/nicepayredirect_dbprocessurl.php')
                ->setCallBackUrl($this->url->link('extension/payment/nicepayredirect_response'))
                ->build();


                $v2redirectService = new V2RedirectService($nicepay);
                $response = $v2redirectService->registration($chargeData);



                if ($response->getResultCd() === '0000') {


                     $this->model_checkout_order->addOrderHistory(
                        $order_id,
                        $this->config->get('payment_nicepay_redirect_order_status_id'),
                        'Payment was made using NicePay Transfer Payment. Order Invoice ID is '.$order_info['order_id'].'. Transaction ID is '.$response->getTXid(), false
                    );

                    $this->db->query("UPDATE `" . DB_PREFIX . "order` SET nicepay_txid = '" . $this->db->escape($response->getTXid()) . "' WHERE order_id = '" . (int)$order_id . "'");

                    // Redirect to payment URL
                    $this->response->redirect($response->getPaymentURL().'?tXid='.$response->getTXid());
                    
                } else {
                    throw new Exception('Nicepay Error: ' . $response->getResultMsg());
                }
        } catch (Exception $e) {
            $this->session->data['error'] = 'Payment failed: ' . $e->getMessage();
            $this->response->redirect($this->url->link('checkout/checkout', '', true));
        }
    }

public function response()
    {
        $this->load->model('checkout/order');

        $txid = $this->request->post['tXid'] ?? '';
        $referenceNo = $this->request->post['referenceNo'] ?? '';
        $status = $this->request->post['status'] ?? '';
        $amt = $this->request->post['amt'] ?? 0;

        $order_id = (int)str_replace('INV-', '', $referenceNo);
        $order_info = $this->model_checkout_order->getOrder($order_id);

        if (!$order_info) {
            http_response_code(404);
            echo "Order not found";
            return;
        }

        if ($status == '0') {
            $completed_status_id = $this->config->get('payment_nicepay_redirect_completed_status_id');

            $this->model_checkout_order->addOrderHistory(
                $order_id,
                $completed_status_id,
                'Nicepay payment successful. TXID: ' . $txid
            );
            echo "SUCCESS";
        }
 
        else {
            $this->model_checkout_order->addOrderHistory(
                $order_id,
                10,
                "NicePay callback: FAILED for TXID: {$txid}"
            );
            echo "FAIL";
        }
    }

    public function checkStatus()
    {
        $this->load->model('checkout/order');

        $nicepay = $this->getNicepayConfig();
        $baseService = new BaseV2RedirectService($nicepay);
        $helper = new Helper();

        $timestamp = $helper::getFormattedTimestampV2();
        $imid = $this->config->get('payment_nicepay_redirect_merchant_imid');
        $merchantKey = $this->config->get('payment_nicepay_redirect_merchant_key');

        $order_id = $this->session->data['order_id'];
        $order_info = $this->model_checkout_order->getOrder($order_id);

        $query = $this->db->query("SELECT nicepay_txid FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "'");
        $txid = $query->row['nicepay_txid'];
        $referenceNo = 'INV-' . $order_id;
        $amt = intval($order_info['total']);

        $inquiryRequest = InquiryStatus::builder()
            ->setTimeStamp($timestamp)
            ->setIMid($imid)
            ->setTxId($txid)
            ->setReferenceNo($referenceNo)
            ->setAmt($amt)
            ->setMerchantToken($timestamp, $imid, $referenceNo, $amt, $merchantKey)
            ->build();

        $inquiryResponse = $baseService->inquiryStatus($inquiryRequest);

        if ($inquiryResponse->getResultCd() === '0000') {
            echo "Transaction status: " . $inquiryResponse->getStatus();
        } else {
            echo "Inquiry failed: " . $inquiryResponse->getResultMsg();
        }
    }


    private function getNicepayConfig(): NICEPay
    {
        return NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret($this->config->get('payment_redirect_merchant_key'))
            ->setPartnerId($this->config->get('payment_redirect_merchant_imid'))
            ->build();
    }





}
