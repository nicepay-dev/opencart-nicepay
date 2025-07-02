<?php
class ControllerExtensionPaymentNICEPayVA extends Controller {
	private $error = array();

	public function index() {

		$data['banks'] = [
			'BMRI' => 'Bank Mandiri',
			'IBBK' => 'Bank International Indonesia Maybank',
			'BBBA' => 'Bank Permata',
			'BBBB' => 'Bank Permata Syariah',
			'CENA' => 'Bank Central Asia (BCA)',
			'BNIN' => 'Bank Negara Indonesia 46 (BNI)',
			'HNBN' => 'Bank KEB Hana Indonesia',
			'BRIN' => 'Bank Rakyat Indonesia (BRI)',
			'BNIA' => 'Bank PT Bank CIMB Niaga, Tbk.',
			'BDIN' => 'Bank PT Bank Danamon Indonesia, Tbk.',
			'PDJB' => 'Bank BJB',
			'YUDB' => 'Bank Neo Commerce (BNC)',
			'BDKI' => 'Bank DKI'
		];


		$this->load->language('extension/payment/nicepay_va');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('payment_nicepay_va', $this->request->post);

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payment_nicepay_va', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['merchant_id'])) {
			$data['error_merchant_id'] = $this->error['merchant_id'];
		} else {
			$data['error_merchant_id'] = '';
		}

		if (isset($this->error['secret_client'])) {
			$data['error_secret_client'] = $this->error['secret_client'];
		} else {
			$data['error_secret_client'] = '';
		}
		

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/nicepay_va', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/nicepay_va', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true); 

		if (isset($this->request->post['payment_nicepay_va_merchant_id'])) {
			$data['payment_nicepay_va_merchant_id'] = $this->request->post['payment_nicepay_va_merchant_id'];
		} else {
			$data['payment_nicepay_va_merchant_id'] = $this->config->get('payment_nicepay_va_merchant_id');
		}

		if (isset($this->request->post['payment_nicepay_va_secret_client'])) {
			$data['payment_nicepay_va_secret_client'] = $this->request->post['payment_nicepay_va_secret_client'];
		} else {
			$data['payment_nicepay_va_secret_client'] = $this->config->get('payment_nicepay_va_secret_client');
		}

		if (isset($this->request->post['payment_nicepay_va_banks'])) {
			$data['payment_nicepay_va_banks'] = $this->request->post['payment_nicepay_va_banks'];
		} else {
			$data['payment_nicepay_va_banks'] = $this->config->get('payment_nicepay_va_banks');
		}

		if (isset($this->request->post['payment_nicepay_va_rate'])) {
			$data['payment_nicepay_va_rate'] = $this->request->post['payment_nicepay_va_rate'];
		} else {
			$data['payment_nicepay_va_rate'] = $this->config->get('payment_nicepay_va_rate');
		}

		if (isset($this->request->post['payment_nicepay_va_invoice'])) {
			$data['payment_nicepay_va_invoice'] = $this->request->post['payment_nicepay_va_invoice'];
		} else {
			$data['payment_nicepay_va_invoice'] = $this->config->get('payment_nicepay_va_invoice');
		}

		if (isset($this->request->post['payment_nicepay_va_total'])) {
			$data['payment_nicepay_va_total'] = $this->request->post['payment_nicepay_va_total'];
		} else {
			$data['payment_nicepay_va_total'] = $this->config->get('payment_nicepay_va_total');
		}

		if (isset($this->request->post['payment_nicepay_va_order_status_id'])) {
			$data['payment_nicepay_va_order_status_id'] = $this->request->post['payment_nicepay_va_order_status_id'];
		} else {
			$data['payment_nicepay_va_order_status_id'] = $this->config->get('payment_nicepay_va_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['payment_nicepay_va_order_success_status'])) {
			$data['payment_nicepay_va_order_success_status'] = $this->request->post['payment_nicepay_va_order_success_status'];
		} else {
			$data['payment_nicepay_va_order_success_status'] = $this->config->get('payment_nicepay_va_order_success_status');
		}

		if (isset($this->request->post['payment_nicepay_va_geo_zone_id'])) {
			$data['payment_nicepay_va_geo_zone_id'] = $this->request->post['payment_nicepay_va_geo_zone_id'];
		} else {
			$data['payment_nicepay_va_geo_zone_id'] = $this->config->get('payment_nicepay_va_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['payment_nicepay_va_status'])) {
			$data['payment_nicepay_va_status'] = $this->request->post['payment_nicepay_va_status'];
		} else {
			$data['payment_nicepay_va_status'] = $this->config->get('payment_nicepay_va_status');
		}

		if (isset($this->request->post['payment_nicepay_va_sort_order'])) {
			$data['payment_nicepay_va_sort_order'] = $this->request->post['payment_nicepay_va_sort_order'];
		} else {
			$data['payment_nicepay_va_sort_order'] = $this->config->get('payment_nicepay_va_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/nicepay_va', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/nicepay_va')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['payment_nicepay_va_merchant_id']) {
			$this->error['merchant_id'] = $this->language->get('error_merchant_id');
		}

		if (!$this->request->post['payment_nicepay_va_secret_client']) {
			$this->error['secret_client'] = $this->language->get('error_secret_client');
		}

		return !$this->error;
	}
}