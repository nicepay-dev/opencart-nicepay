<?php
class ControllerExtensionPaymentNICEPayRedirect extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/nicepay_redirect');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payment_nicepay_redirect', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['merchant_imid'])) {
			$data['error_merchant_imid'] = $this->error['merchant_imid'];
		} else {
			$data['error_merchant_imid'] = '';
		}

		if (isset($this->error['merchant_key'])) {
			$data['error_merchant_key'] = $this->error['merchant_key'];
		} else {
			$data['error_merchant_key'] = '';
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
			'href' => $this->url->link('extension/payment/nicepay_redirect', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/nicepay_redirect', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true); 

		if (isset($this->request->post['payment_nicepay_redirect_merchant_imid'])) {
			$data['payment_nicepay_redirect_merchant_imid'] = $this->request->post['payment_nicepay_redirect_merchant_imid'];
		} else {
			$data['payment_nicepay_redirect_merchant_imid'] = $this->config->get('payment_nicepay_redirect_merchant_imid');
		}

		if (isset($this->request->post['payment_nicepay_redirect_merchant_key'])) {
			$data['payment_nicepay_redirect_merchant_key'] = $this->request->post['payment_nicepay_redirect_merchant_key'];
		} else {
			$data['payment_nicepay_redirect_merchant_key'] = $this->config->get('payment_nicepay_redirect_merchant_key');
		}

		if (isset($this->request->post['payment_nicepay_redirect_rate'])) {
			$data['payment_nicepay_redirect_rate'] = $this->request->post['payment_nicepay_redirect_rate'];
		} else {
			$data['payment_nicepay_redirect_rate'] = $this->config->get('payment_nicepay_redirect_rate');
		}

		if (isset($this->request->post['payment_nicepay_redirect_invoice'])) {
			$data['payment_nicepay_redirect_invoice'] = $this->request->post['payment_nicepay_redirect_invoice'];
		} else {
			$data['payment_nicepay_redirect_invoice'] = $this->config->get('payment_nicepay_redirect_invoice');
		}

		if (isset($this->request->post['payment_nicepay_redirect_total'])) {
			$data['payment_nicepay_redirect_total'] = $this->request->post['payment_nicepay_redirect_total'];
		} else {
			$data['payment_nicepay_redirect_total'] = $this->config->get('payment_nicepay_redirect_total');
		}

		if (isset($this->request->post['payment_nicepay_redirect_order_status_id'])) {
			$data['payment_nicepay_redirect_order_status_id'] = $this->request->post['payment_nicepay_redirect_order_status_id'];
		} else {
			$data['payment_nicepay_redirect_order_status_id'] = $this->config->get('payment_nicepay_redirect_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['payment_nicepay_redirect_order_success_status'])) {
			$data['payment_nicepay_redirect_order_success_status'] = $this->request->post['payment_nicepay_redirect_order_success_status'];
		} else {
			$data['payment_nicepay_redirect_order_success_status'] = $this->config->get('payment_nicepay_redirect_order_success_status');
		}

		if (isset($this->request->post['payment_nicepay_redirect_geo_zone_id'])) {
			$data['payment_nicepay_redirect_geo_zone_id'] = $this->request->post['payment_nicepay_redirect_geo_zone_id'];
		} else {
			$data['payment_nicepay_redirect_geo_zone_id'] = $this->config->get('payment_nicepay_redirect_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['payment_nicepay_redirect_status'])) {
			$data['payment_nicepay_redirect_status'] = $this->request->post['payment_nicepay_redirect_status'];
		} else {
			$data['payment_nicepay_redirect_status'] = $this->config->get('payment_nicepay_redirect_status');
		}

		if (isset($this->request->post['payment_nicepay_redirect_sort_order'])) {
			$data['payment_nicepay_redirect_sort_order'] = $this->request->post['payment_nicepay_redirect_sort_order'];
		} else {
			$data['payment_nicepay_redirect_sort_order'] = $this->config->get('payment_nicepay_redirect_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/nicepay_redirect', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/nicepay_redirect')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['payment_nicepay_redirect_merchant_imid']) {
			$this->error['merchant_imid'] = $this->language->get('error_merchant_imid');
		}

		if (!$this->request->post['payment_nicepay_redirect_merchant_key']) {
			$this->error['merchant_key'] = $this->language->get('error_merchant_key');
		}

		return !$this->error;
	}
}