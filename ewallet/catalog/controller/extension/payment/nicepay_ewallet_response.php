<?php 

class ControllerExtensionPaymentnicepayEWalletResponse extends Controller {
  
  public function index(){
    
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

    $this->load->language('extension/payment/nicepay_ewallet');
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
      'href'      => $this->url->link('extension/payment/nicepay_ewallet_response'),
      'text'      => $this->language->get('text_success'),
      'separator' => $this->language->get('text_separator')
    );

    $data['heading_title'] = $this->language->get('heading_title');
    // print_r($this->request->post["resultCd"]);die;
    // if($this->request->post["resultCd"] == "0000"){
    //   $data['description'] = $this->language->get('text_success');
    // }else{
    //   $data['description'] = $this->language->get('text_failure');
    // }
    
    $data['referenceNo'] = $this->request->post['referenceNo']; // ini diubah ke ewallet
    $data['transid'] = $this->request->post["tXid"];
    $data['transamount'] = $this->request->post["amount"];

    if ($this->customer->isLogged()) {
      $data['text_message'] = $this->language->get('text_customer');
    } else {
      $data['text_message'] = $this->language->get('text_guest');
    }

    // echo $data['description'];die;

    $data['button_continue'] = $this->language->get('button_continue');

    $data['continue'] = $this->url->link('common/home');

    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . 'extension/payment/nicepay_ewallet_response')) {
    $this->template = $this->config->get('config_template') . 'extension/payment/nicepay_ewallet_response';
    } else {
    $this->template = 'extension/payment/nicepay_ewallet_response';
    }


    $data['header'] = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('extension/payment/nicepay_ewallet_response', $data));

  }

}
