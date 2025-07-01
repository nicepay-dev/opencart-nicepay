<?php
class ControllerExtensionPaymentNicepayEwallet extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/payment/nicepay_ewallet');

        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('payment_nicepay_ewallet', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
        }

        $data['error_warning'] = $this->error['warning'] ?? '';
        $data['error_merchant_id'] = $this->error['merchant_id'] ?? '';
        $data['error_client_secret'] = $this->error['client_secret'] ?? '';
        $data['error_private_key'] = $this->error['private_key'] ?? '';

        $data['breadcrumbs'] = [
            [
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
            ],
            [
                'text' => $this->language->get('text_extension'),
                'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
            ],
            [
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/payment/nicepay_ewallet', 'user_token=' . $this->session->data['user_token'], true)
            ]
        ];

        $data['action'] = $this->url->link('extension/payment/nicepay_ewallet', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);

        $fields = [
            'payment_nicepay_ewallet_merchant_id',
            'payment_nicepay_ewallet_client_secret',
            'payment_nicepay_ewallet_private_key',
            'payment_nicepay_ewallet_total',
            'payment_nicepay_ewallet_order_status_id',
            'payment_nicepay_ewallet_order_status_success',
            'payment_nicepay_ewallet_geo_zone_id',
            'payment_nicepay_ewallet_status',
            'payment_nicepay_ewallet_sort_order'
        ];

        foreach ($fields as $field) {
            $data[$field] = $this->request->post[$field] ?? $this->config->get($field);
        }

        $this->load->model('localisation/order_status');
        $this->load->model('localisation/geo_zone');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/payment/nicepay_ewallet', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/payment/nicepay_ewallet')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if (empty($this->request->post['payment_nicepay_ewallet_merchant_id'])) {
            $this->error['merchant_id'] = $this->language->get('error_merchant_id');
        }
        if (empty($this->request->post['payment_nicepay_ewallet_client_secret'])) {
            $this->error['client_secret'] = $this->language->get('error_client_secret');
        }
        if (empty($this->request->post['payment_nicepay_ewallet_private_key'])) {
            $this->error['private_key'] = $this->language->get('error_private_key');
        }
        return !$this->error;
    }
}