<?php
class ModelExtensionPaymentNicepayRedirect extends Model {
    public function getMethod($address, $total) {
        $this->load->language('extension/payment/nicepay_redirect');

        $method_data = [];

        if ($this->config->get('payment_nicepay_redirect_status')) {
            $method_data = [
                'code'       => 'nicepay_redirect',
                'title'      => $this->language->get('text_title'),
                'terms'      => '',
                'sort_order' => $this->config->get('payment_nicepay_redirect_sort_order')
            ];
        }

        return $method_data;
    }
}
