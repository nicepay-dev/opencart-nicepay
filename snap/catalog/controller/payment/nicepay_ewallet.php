<?php
use Nicepay\common\NICEPay;
use Nicepay\Service\Snap\{Snap, SnapEwalletService};
use Nicepay\Data\Model\{AccessToken, Ewallet};
use Nicepay\utils\Helper;

require_once DIR_SYSTEM . 'library/php-nicepay/vendor/autoload.php';

class ControllerExtensionPaymentNicepayEwallet extends Controller {
    public function index() {
        $this->load->language('extension/payment/nicepay_ewallet');
        return $this->load->view('extension/payment/nicepay_ewallet', [
            'action' => $this->url->link('extension/payment/nicepay_ewallet/confirm'),
            'button_confirm' => $this->language->get('button_confirm')
        ]);
    }

    public function confirm() {
        if ($this->session->data['payment_method']['code'] != 'nicepay_ewallet') {
            $this->response->redirect($this->url->link('checkout/checkout'));
        }

        $this->load->model('checkout/order');
        $this->load->model('tool/image');
        $order_id = $this->session->data['order_id'];
        $order_info = $this->model_checkout_order->getOrder($order_id);

        $nicepay = $this->getNicepayConfig();
        $accessToken = $this->getAccessToken($nicepay);

        try {
            $products = $this->cart->getProducts();
            $cart_items = [];
            foreach ($products as $product) {
                $cart_items[] = [
                    'img_url' => isset($product['image']) ? $this->model_tool_image->resize($product['image'], 100, 100) : '',
                    'goods_name' => $product['name'],
                    'goods_detail' => strip_tags(html_entity_decode($product['model'], ENT_QUOTES, 'UTF-8')),
                    'goods_amt' => number_format($product['price'], 2, '.', ''),
                    'goods_quantity' => $product['quantity'],
                ];
            }

            $cartData = json_encode([
                'count' => (string)count($cart_items),
                'item' => $cart_items
            ]);

            $ewallet = Ewallet::builder()
                ->setPartnerReferenceNo('INV-' . $order_id)
                ->setTotalAmount(number_format($order_info['total'], 2, '.', ''), 'IDR')
                ->setValidTime(60)
                ->setAdditionalInfo([
                    'goodsNm' => 'Order #' . $order_id,
                    'billingNm' => $order_info['payment_firstname'] . ' ' . $order_info['payment_lastname'],
                    'billingPhone' => $order_info['telephone'],
                    'dbProcessUrl' => HTTP_SERVER . 'index.php?route=extension/payment/nicepay_ewallet/callback',
                    'cartData' => $cartData
                ])
                ->build();

            $service = new SnapEwalletService($nicepay);
            $response = $service->paymentEwallet($ewallet, $accessToken);

            $this->load->model('extension/payment/nicepay_ewallet');
            $this->model_extension_payment_nicepay_ewallet->saveEwalletData([
                'order_id' => $order_id,
                'trx_id' => $response->getTrxId(),
                'reference_no' => 'INV-' . $order_id,
                'amount' => $order_info['total']
            ]);

            $this->session->data['nicepay_ewallet'] = [
                'trx_id' => $response->getTrxId(),
                'amount' => $order_info['total'],
                'redirect_url' => $response->getWebRedirectUrl(),
            ];

            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('payment_nicepay_ewallet_order_status_id'));
            $this->response->redirect($this->url->link('extension/payment/nicepay_ewallet/success'));
        } catch (Exception $e) {
            $this->log->write('[Nicepay Ewallet] ' . $e->getMessage());
            $this->response->redirect($this->url->link('checkout/checkout'));
        }
    }

    public function success() {
        if (!isset($this->session->data['nicepay_ewallet'])) {
            $this->response->redirect($this->url->link('checkout/checkout'));
        }
        $data = $this->session->data['nicepay_ewallet'];
        $this->cart->clear();

        $this->load->language('extension/payment/nicepay_ewallet');
        $this->response->setOutput($this->load->view('extension/payment/nicepay_ewallet_success', [
            'heading_title' => $this->language->get('text_title'),
            'trx_id' => $data['trx_id'],
            'amount' => $data['amount'],
            'redirect_url' => $data['redirect_url'],
            'continue' => $this->url->link('common/home'),
            'button_continue' => $this->language->get('button_continue'),
            'header' => $this->load->controller('common/header'),
            'footer' => $this->load->controller('common/footer'),
            'column_left' => $this->load->controller('common/column_left')
        ]));
    }

    private function getNicepayConfig() {
        $time = Helper::getFormattedDate();
        return NICEPay::builder()
            ->setIsProduction(false)
            ->setClientSecret($this->config->get('payment_nicepay_ewallet_client_secret'))
            ->setPartnerId($this->config->get('payment_nicepay_ewallet_merchant_id'))
            ->setPrivateKey($this->config->get('payment_nicepay_ewallet_private_key'))
            ->setExternalID('EXT-' . uniqid())
            ->setTimestamp($time)
            ->build();
    }

    private function getAccessToken(NICEPay $config) {
        $tokenBody = AccessToken::builder()->setGrantType('client_credentials')->build();
        $snap = new Snap($config);
        $response = $snap->requestSnapAccessToken($tokenBody);
        return $response->getAccessToken();
    }
}