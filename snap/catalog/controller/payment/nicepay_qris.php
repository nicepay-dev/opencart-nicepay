<?php
use Nicepay\common\NICEPay;
use Nicepay\Service\Snap\{Snap, SnapQrisService};
use Nicepay\Data\Model\{AccessToken, Qris};
use Nicepay\utils\Helper;
use Nicepay\common\NicepayError;

require_once DIR_SYSTEM . 'library/php-nicepay/vendor/autoload.php';

class ControllerExtensionPaymentNicepayQris extends Controller {
    public function index() {
        $this->load->language('extension/payment/nicepay_qris');
        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['action'] = $this->url->link('extension/payment/nicepay_qris/confirm');
        return $this->load->view('extension/payment/nicepay_qris', $data);
    }

    public function confirm() {
        if ($this->session->data['payment_method']['code'] !== 'nicepay_qris') {
            $this->response->redirect($this->url->link('checkout/checkout'));
            return;
        }

        $this->load->model('checkout/order');

        $order_id = $this->session->data['order_id'];
        $order_info = $this->model_checkout_order->getOrder($order_id);

        $nicepay = $this->getNicepayConfig($order_id);
        $accessToken = $this->getAccessToken($nicepay);

        if (!$accessToken) {
            $this->session->data['error'] = 'Access token not retrieved.';
            $this->response->redirect($this->url->link('checkout/checkout'));
            return;
        }

        try {
            $qrisBuilder = Qris::builder()
                ->setPartnerReferenceNo('INV-' . $order_id)
                ->setAmount(number_format($order_info['total'], 2, '.', ''), 'IDR')
                ->setStoreId($this->config->get('payment_nicepay_qris_store_id') ?? '')
                ->setValidityPeriod(300) // 5 minutes
                ->build();

                

            $snapQrisService = new SnapQrisService($nicepay);
            $response = $snapQrisService->generateQris($qrisBuilder, $accessToken);

            $qrUrl = $response->getQrUrl();
            $this->session->data['qris_nicepay'] = [
                'qr_url' => $qrUrl,
                'trx_id' => $response->getPartnerReferenceNo(),
                'amount' => $order_info['total'],
            ];

            // Store initial order status
            $this->model_checkout_order->addOrderHistory(
                $order_id,
                $this->config->get('payment_nicepay_qris_order_status_id'),
                '[Nicepay QRIS] Waiting for payment'
            );

            $this->response->redirect($this->url->link('extension/payment/nicepay_qris/success'));

        } catch (NicepayError $e) {
            $this->log->write('[Nicepay QRIS] API Error: ' . $e->getMessage());
            $this->session->data['error'] = 'QRIS Error: ' . $e->getMessage();
            $this->response->redirect($this->url->link('checkout/checkout'));
        } catch (Exception $e) {
            $this->log->write('[Nicepay QRIS] General Error: ' . $e->getMessage());
            $this->session->data['error'] = 'QRIS Error: ' . $e->getMessage();
            $this->response->redirect($this->url->link('checkout/checkout'));
        }
    }

    public function success() {
        if (!isset($this->session->data['qris_nicepay'])) {
            $this->response->redirect($this->url->link('checkout/checkout'));
        }

        $this->cart->clear();
        $this->response->redirect($this->url->link('extension/payment/nicepay_qris_success'));
    }

    private function getNicepayConfig(?int $order_id = null): NICEPay {
        return NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret($this->config->get('payment_nicepay_qris_client_secret'))
            ->setPartnerId($this->config->get('payment_nicepay_qris_merchant_id'))
            ->setPrivateKey($this->config->get('payment_nicepay_qris_private_key'))
            ->setExternalID('Order-' . uniqid())
            ->setTimestamp(Helper::getFormattedDate())
            ->build();
    }

    private function getAccessToken(NICEPay $config): string {
        try {
            $tokenBody = AccessToken::builder()
                ->setGrantType('client_credentials')
                ->build();

            $snap = new Snap($config);
            $response = $snap->requestSnapAccessToken($tokenBody);
            return $response->getAccessToken();
        } catch (NicepayError $e) {
            $this->log->write('[Nicepay QRIS] Token Error: ' . $e->getMessage());
            return '';
        }
    }

}
