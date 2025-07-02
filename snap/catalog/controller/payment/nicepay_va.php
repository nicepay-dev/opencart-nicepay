<?php

use Nicepay\common\NICEPay;
use Nicepay\Service\Snap\{Snap, SnapVAService};
use Nicepay\common\NicepayError;
use Nicepay\Data\Model\AccessToken;
use Nicepay\Data\Model\{VirtualAccount, InquiryStatus};
use Nicepay\utils\Helper;

require_once DIR_SYSTEM . 'library/php-nicepay/vendor/autoload.php';

class ControllerExtensionPaymentNicepayVa extends Controller
{
    public function index()
    {
        $this->load->language('extension/payment/nicepay_va');
        $this->load->model('setting/setting');

        $settings = $this->model_setting_setting->getSetting('payment_nicepay_va');

        $data['available_banks'] = $settings['payment_nicepay_va_banks'] ?? ['CENA'];
        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['continue'] = $this->url->link('extension/payment/nicepay_va/confirm');

        return $this->load->view('extension/payment/nicepay_va', $data);
    }

    public function confirm()
    {
        if ($this->session->data['payment_method']['code'] !== 'nicepay_va') {
            $this->response->redirect($this->url->link('checkout/checkout'));
            return;
        }

        $this->load->model('checkout/order');

        $order_id = $this->session->data['order_id'];
        $order_info = $this->model_checkout_order->getOrder($order_id);

        $nicepay = $this->getNicepayConfig($order_id);
        $accessToken = $this->getAccessToken($nicepay);

        if (!$accessToken) {
            $this->session->data['error'] = 'Access token not obtained.';
            $this->response->redirect($this->url->link('checkout/checkout'));
            return;
        }

        try {
            $bankCode = $this->request->post['bank_code'] ?? 'CENA';

            $vaBuilder = VirtualAccount::builder()
                ->setPartnerServiceId('')
                ->setCustomerNo('')
                ->setVirtualAccountNo('')
                ->setVirtualAccountName(trim($order_info['payment_firstname'] . ' ' . $order_info['payment_lastname']))
                ->setTrxId('INV-' . $order_id)
                ->setTotalAmount(number_format($order_info['total'], 2), 'IDR')
                ->setAdditionalInfo([
                    'bankCd' => $bankCode,
                    'goodsNm' => 'Order #' . $order_id,
                    'dbProcessUrl' => HTTP_SERVER . 'index.php?route=extension/payment/nicepay_va/callback',
                ])
                ->build();

            $snapVAService = new SnapVAService($nicepay);
            $response = $snapVAService->generateVA($vaBuilder, $accessToken);

            $vaData = $response->getVirtualAccountData();

            $this->session->data['va_nicepay'] = [
                'va_number' => $vaData['virtualAccountNo'],
                'bank' => $vaData['additionalInfo']['bankCd'] ?? 'N/A',
                'va_name' => $vaData['virtualAccountName'],
                'amount' => $vaData['totalAmount']['value'] ?? '0.00',
                'trx_id' => $vaData['trxId'] ?? 'N/A',
                'txidVa' => $vaData['additionalInfo']['tXidVA'],
            ];

            $this->load->model('extension/payment/nicepay_va_order');

            $this->model_extension_payment_nicepay_va_order->saveVAData([
                'order_id'   => $order_id,
                'trx_id'     => $vaData['trxId'],
                'txid_va'    => $vaData['additionalInfo']['tXidVA'],
                'va_number'  => $vaData['virtualAccountNo'],
                'bank'       => $vaData['additionalInfo']['bankCd'] ?? 'N/A',
                'va_name'    => $vaData['virtualAccountName'],
                'amount'     => $vaData['totalAmount']['value'] ?? '0.00',
            ]);

            $this->model_checkout_order->addOrderHistory(
                $order_id,
                $this->config->get('payment_nicepay_va_order_status_id'),
                'VA Number: ' . $vaData['virtualAccountNo'],
                true
            );

            $this->response->redirect($this->url->link('extension/payment/nicepay_va/success'));

        } catch (NicepayError $e) {
            $this->log->write('[Nicepay] API Error: ' . $e->getMessage());
            $this->session->data['error'] = 'API Error: ' . $e->getMessage();
            $this->response->redirect($this->url->link('checkout/checkout'));
        } catch (Exception $e) {
            $this->log->write('[Nicepay] General Error: ' . $e->getMessage());
            $this->session->data['error'] = 'General Error: ' . $e->getMessage();
            $this->response->redirect($this->url->link('checkout/checkout'));
        }
    }

    private function getNicepayConfig(?int $order_id = null): NICEPay
    {
        $timeStamp = Helper::getFormattedDate();
        $externalId = 'Order-' . uniqid();

        return NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret($this->config->get('payment_nicepay_va_secret_client'))
            ->setPartnerId($this->config->get('payment_nicepay_va_merchant_id'))
            ->setPrivateKey($this->config->get('payment_nicepay_va_private_key'))
            ->setExternalID($externalId)
            ->setTimestamp($timeStamp)
            ->build();
    }

    private function getAccessToken(NICEPay $config): string
    {
        try {
            $tokenBody = AccessToken::builder()
                ->setGrantType('client_credentials')
                ->setAdditionalInfo([])
                ->build();

            $snap = new Snap($config);
            $response = $snap->requestSnapAccessToken($tokenBody);
            return $response->getAccessToken();

        } catch (NicepayError $e) {
            $this->log->write('[Nicepay] AccessToken Error: ' . $e->getMessage());
            return '';
        }
    }

    public function success()
    {
        if (!isset($this->session->data['va_nicepay'])) {
            $this->response->redirect($this->url->link('checkout/checkout'));
        }

        $this->cart->clear();
        $this->response->redirect($this->url->link('extension/payment/nicepay_va_success'));
    }

    public function callback()
    {
        $this->load->model('checkout/order');
        $this->load->model('extension/payment/nicepay_va_order');

        $postData = json_decode(file_get_contents('php://input'), true);

        if (
            empty($postData['virtualAccountNo']) ||
            empty($postData['additionalInfo']['trxId']) ||
            empty($postData['additionalInfo']['tXidVA']) ||
            empty($postData['additionalInfo']['totalAmount']['value'])
        ) {
            http_response_code(400);
            echo 'Missing required fields';
            return;
        }

        $vaNumber = $postData['virtualAccountNo'];
        $trxId = $postData['additionalInfo']['trxId'];
        $txidVa = $postData['additionalInfo']['tXidVA'];
        $amount = $postData['additionalInfo']['totalAmount']['value'];

        $vaData = $this->model_extension_payment_nicepay_va_order->getVADataByTrxId($trxId);

        if (!$vaData) {
            $this->log->write('[Nicepay] No VA data found for trxId: ' . $trxId);
            http_response_code(404);
            echo 'VA data not found';
            return;
        }

        $order_id = (int)$vaData['order_id'];
        $nicepay = $this->getNicepayConfig($order_id);
        $accessToken = $this->getAccessToken($nicepay);

        if (!$accessToken) {
            $this->log->write('[Nicepay] Failed to retrieve access token during callback.');
            http_response_code(500);
            echo 'Access token error';
            return;
        }

        try {
            $parameter = InquiryStatus::builder()
                ->setPartnerServiceId($postData['partnerServiceId'] ?? '')
                ->setCustomerNo($postData['customerNo'] ?? '')
                ->setVirtualAccountNo($vaNumber)
                ->setInquiryRequestId('inqVA' . Helper::getFormattedDate())
                ->setTrxId($trxId)
                ->setTxIdVA($txidVa)
                ->setTotalAmount($amount, 'IDR')
                ->build();

            $snapVAService = new SnapVAService($nicepay);
            $response = $snapVAService->inquiryStatus($parameter, $accessToken);

            $status = $response->getAdditionalInfo()['latestTransactionStatus'];


            if ($status === '00') {
                // Success
                $this->model_checkout_order->addOrderHistory(
                    $order_id,
                    $this->config->get('payment_nicepay_va_order_status_success'),
                    '[Nicepay] Payment SUCCESS for Trx ID: ' . $trxId
                );
                echo "SUCCESS";
            } elseif ($status === '03') {
                // Unpaid
                $this->model_checkout_order->addOrderHistory(
                    $order_id,
                    $this->config->get('payment_nicepay_va_order_status_pending'),
                    '[Nicepay] Payment PENDING for Trx ID: ' . $trxId
                );
            } else {
                // Unknown
                $this->log->write('[Nicepay] Unknown status code received: ' . $status);
            }

            http_response_code(200);

        } catch (Exception $e) {
            $this->log->write('[Nicepay] Callback inquiry error: ' . $e->getMessage());
            http_response_code(500);
            echo 'Error';
        }
    }

}
