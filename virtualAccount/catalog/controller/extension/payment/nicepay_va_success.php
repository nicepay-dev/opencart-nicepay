<?php
class ControllerExtensionPaymentNicepayVASuccess extends Controller { 
	public function index() { 	
		if (isset($this->session->data['order_id'])) {
			$this->cart->clear();

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);	
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
		}	
									   
		$this->language->load('extension/payment/nicepay_va_success');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['breadcrumbs'] = array(); 

      	$data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('common/home'),
        	'text'      => $this->language->get('text_home'),
        	'separator' => false
      	); 
		
      	$data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/cart'),
        	'text'      => $this->language->get('text_basket'),
        	'separator' => $this->language->get('text_separator')
      	);
				
		$data['breadcrumbs'][] = array(
			'href'      => $this->url->link('checkout/checkout', '', 'SSL'),
			'text'      => $this->language->get('text_checkout'),
			'separator' => $this->language->get('text_separator')
		);	
					
      	$data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/success'),
        	'text'      => $this->language->get('text_success'),
        	'separator' => $this->language->get('text_separator')
      	);


        // echo json_encode($this->session);
        // die();
       

		$data['heading_title'] = $this->language->get('heading_title');

		// $data['description'] = sprintf($this->language->get('text_description'), $this->session->data["description"], $this->url->link('information/contact'));
		$data['bank_name'] = sprintf($this->language->get('text_bank_name'), $this->session->data["bankName"], $this->url->link('information/contact'));
        $data['transid'] = sprintf($this->language->get('text_transid'), $this->session->data["tXid"], $this->url->link('information/contact'));
        $data['transamount'] = sprintf($this->language->get('text_transamount'), $this->session->data["amt"], $this->url->link('information/contact'));
		$data['bank_content'] = sprintf($this->language->get('text_bank_content'), $this->session->data["bankContent"], $this->url->link('information/contact'));
		$data['virtual_account'] = sprintf($this->language->get('text_va'), $this->session->data["vacctNo"], $this->url->link('information/contact'));
		$data['expired_date'] = sprintf($this->language->get('text_exp_date'), $this->session->data["expDate"], $this->url->link('information/contact'));
		
		if ($this->customer->isLogged()) {
    		$data['text_message'] = sprintf($this->language->get('text_customer'), $this->url->link('account/account', '', 'SSL'), $this->url->link('account/order', '', 'SSL'), $this->url->link('account/download', '', 'SSL'), $this->url->link('information/contact'));
		} else {
    		$data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
		}
		
    	$data['button_continue'] = $this->language->get('button_continue');

    	$data['continue'] = $this->url->link('common/home');

		//if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . 'common/nicepay_va_success')) {
			//$this->template = $this->config->get('config_template') . 'extension/payment/nicepay_va_success';
		//} else {
			// $this->template = 'default/template/extension/payment/nicepay_va_success';
		//}
		
		// $this->children = array(
		// 	'common/column_left',
		// 	'common/column_right',
		// 	'common/content_top',
		// 	'common/content_bottom',
		// 	'common/footer',
		// 	'common/header'			
		// );


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/payment/nicepay_va_success', $data));
				

                // echo json_encode($data);


               // return $this->load->view('common/nicepay_va_success.tpl', $data);


		// $this->response->setOutput($this->render());
  	}
}
?>