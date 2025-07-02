<?php
// catalog/controller/extension/payment/nicepay_va_success.php

class ControllerExtensionPaymentNicepayVaSuccess extends Controller
{
    public function index()
    {
        if (!isset($this->session->data['va_nicepay'])) {
            $this->response->redirect($this->url->link('checkout/checkout'));
        }

        $this->load->language('checkout/success');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = 'Pembayaran Virtual Account Berhasil Dibuat';
        $data['text_message'] = 'Silakan selesaikan pembayaran Anda menggunakan informasi di bawah ini:';

        $va_data = $this->session->data['va_nicepay'];

        // 🔁 Bank code to name mapping
        $bankNames = [
            'CENA' => 'BCA',
            'BNIN' => 'BNI',
            'BMRI' => 'Mandiri',
            'BRIN' => 'BRI',
            'IBBK' => 'Maybank',
            'BBBA' => 'Permata',
            'BBBB' => 'Permata Syariah',
            'HNBN' => 'KEB Hana',
            'BNIA' => 'CIMB Niaga',
            'BDIN' => 'Danamon',
            'PDJB' => 'BJB',
            'YUDB' => 'Neo Commerce (BNC)',
            'BDKI' => 'Bank DKI',
        ];

            $paymentGuides = [
            'CENA' => 'https://docs.nicepay.co.id/va-bank-bca',
            'BNIN' => 'https://docs.nicepay.co.id/va-bank-bni',
            'BMRI' => 'https://docs.nicepay.co.id/va-bank-mandiri',
            'BRIN' => 'https://docs.nicepay.co.id/va-bank-bri',
            'IBBK' => 'https://docs.nicepay.co.id/va-bank-maybank',
            'BBBA' => 'https://docs.nicepay.co.id/va-bank-permata',
            'BBBB' => 'https://docs.nicepay.co.id/va-bank-permata-syariah',
            'HNBN' => 'https://docs.nicepay.co.id/va-bank-keb-hana',
            'BNIA' => 'https://docs.nicepay.co.id/va-bank-cimb-niaga',
            'BDIN' => 'https://docs.nicepay.co.id/va-bank-danamon',
            'PDJB' => 'https://docs.nicepay.co.id/va-bank-bjb',
            'YUDB' => 'https://docs.nicepay.co.id/va-bank-neo-commerce',
            'BDKI' => 'https://docs.nicepay.co.id/va-bank-dki',
        ];



        $bankCode = $va_data['bank'];
        $data['bank'] = isset($bankNames[$bankCode]) ? $bankNames[$bankCode] : $bankCode;
        $data['how_to_pay_url'] = isset($paymentGuides[$bankCode]) ? $paymentGuides[$bankCode] : null;

        $data['va_number'] = $va_data['va_number'];
        $data['va_name'] = $va_data['va_name'];
        $data['amount'] = $va_data['amount'];
        $data['trx_id'] = $va_data['trx_id'];

        $data['continue'] = $this->url->link('common/home');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('extension/payment/nicepay_va_success', $data));
    }
}
