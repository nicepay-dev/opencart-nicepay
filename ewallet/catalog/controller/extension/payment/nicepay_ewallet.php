<?php
/*
status code
1 pending
2 processing
3 shipped
5 complete
7 canceled
8 denied
9 canceled reversal
10 failed
11 refunded
12 reversed
13 chargeback
14 expired
15 processed
16 voided
*/


require_once(DIR_SYSTEM . 'library/NicepayDirect/NicepayLib.php');

class ControllerExtensionPaymentnicepayEWallet extends Controller {

  private function nicepay(){
      $nicepay = new NicepayLib();
      $nicepay->iMid = $this->config->get('payment_nicepay_ewallet_merchant_id');
      $nicepay->merchantKey = $this->config->get('payment_nicepay_ewallet_merchant_key');
      return $nicepay;
  }

  public function index() {

    if ($this->request->server['HTTPS']) {
      $data['base'] = $this->config->get('config_ssl');
    } else {
      $data['base'] = $this->config->get('config_url');
    }

    $data['errors'] = array();
    $data['button_confirm'] = $this->language->get('button_confirm');

    $env = $this->config->get('nicepay_ewallet_environment') == 'production' ? true : false;
    // $data['mixpanel_key'] = $env == true ? "17253088ed3a39b1e2bd2cbcfeca939a" : "9dcba9b440c831d517e8ff1beff40bd9";
    // $data['merchant_id'] = $this->config->get('snap_merchant_id');
    
    $data['pay_type'] = 'nicepay_ewallet';
    $data['merchant_id'] = $this->config->get('payment_nicepay_ewallet_merchant_id');
    $data['merchant_key'] = $this->config->get('payment_nicepay_ewallet_merchant_key');

    // $data['text_loading'] = $this->language->get('text_loading');

    $data['process_order'] = $this->url->link('extension/payment/nicepay_ewallet/process_order'); 
     
    return $this->load->view('extension/payment/nicepay_ewallet', $data);
      
  }

  /**
   * Called when a customer checkouts.
   * If it runs successfully, it will redirect to VT-Web payment page.
   */
  public function process_order() {
    $this->load->model('extension/payment/nicepay_ewallet');
    $this->load->model('checkout/order');
    $this->load->model('extension/total/shipping');
    $this->load->language('extension/payment/nicepay_ewallet');



    $data['errors'] = array();

    $data['button_confirm'] = $this->language->get('button_confirm');

    $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
    //error_log(print_r($order_info,TRUE));

    $this->model_checkout_order->addOrderHistory($this->session->data['order_id'],1);
    /*$this->model_checkout_order->addOrderHistory($this->session->data['order_id'],
        $this->config->get('veritrans_vtweb_challenge_mapping'));*/
    

    // $transaction_details                 = array();
    // $transaction_details['order_id']     = $this->session->data['order_id'];
    // $transaction_details['gross_amount'] = $order_info['total'];

    $transaction_details = array();
    $transaction_details['mallId'] = $this->config->get('payment_nicepay_ewallet_merchant_id');
    $transaction_details['invoiceNo'] = $this->config->get('nicepay_ewallet_display_name') . $this->session->data['order_id'];
    $transaction_details['amount'] = (int)$order_info['total'];
    $transaction_details['currencyCode'] = 360;

    $billing_address                 = array();
    $billing_address['first_name']   = $order_info['payment_firstname'];
    $billing_address['last_name']    = $order_info['payment_lastname'];
    $billing_address['address']      = $order_info['payment_address_1'];
    $billing_address['city']         = $order_info['payment_city'];
    $billing_address['postal_code']  = $order_info['payment_postcode'];
    $billing_address['phone']        = $order_info['telephone'];
    $billing_address['country_code'] = 'IDN';

    if ($this->cart->hasShipping()) {
      $shipping_address = array();
      $shipping_address['first_name']   = $order_info['shipping_firstname'];
      $shipping_address['last_name']    = $order_info['shipping_lastname'];
      $shipping_address['address']      = $order_info['shipping_address_1'];
      $shipping_address['city']         = $order_info['shipping_city'];
      $shipping_address['postal_code']  = $order_info['shipping_postcode'];
      $shipping_address['phone']        = $order_info['telephone'];
      $shipping_address['country_code'] = 'IDN';
    } else {
      $shipping_address = $billing_address;
    }

    $customer_details                     = array();
    $customer_details['billing_address']  = $billing_address;
    $customer_details['shipping_address'] = $shipping_address;
    $customer_details['first_name']       = $order_info['payment_firstname'];
    $customer_details['last_name']        = $order_info['payment_lastname'];
    $customer_details['email']            = $order_info['email'];
    $customer_details['phone']            = $order_info['telephone'];


    $products = $this->cart->getProducts();
    
    $item_details = array();
    $item_details2 = array();

    foreach ($products as $product) {
      if (($this->config->get('config_customer_price')
            && $this->customer->isLogged())
          || !$this->config->get('config_customer_price')) {
        $product['price'] = $this->tax->calculate(
            $product['price'],
            $product['tax_class_id'],
            $this->config->get('config_tax'));
      }

      $item = array(
        'goods_detail' => strval($product['product_id']),
        'goods_name'     => substr($product['name'], 0, 49),
        'goods_amt'    => strval($product['price']),
        'goods_type' => substr($product['name'], 0, 49),
        'goods_url' => "http://www.jamgora.com/media/avatar/noimage.png",
        'goods_quantity' =>strval($product['quantity']),
          
        );

      $item2 = array(
          'id'       => strval($product['product_id']),
          'amt'    => strval($product['price']),
          'quantity' => $product['quantity'],
          'goods_name'     => substr($product['name'], 0, 49),
          'goods_detail'     => substr($product['name'], 0, 49),
          'img_url'  => HTTPS_SERVER. "image/". $product['image'],
        );
      $item_details[] = $item;
      $item_details2[] = $item2;
    }

    unset($product);

    $num_products = count($item_details);

    if ($this->cart->hasShipping()) {
      $shipping_info = $this->session->data['shipping_method'];
      if (($this->config->get('config_customer_price')
            && $this->customer->isLogged())
          || !$this->config->get('config_customer_price')) {
        $shipping_info['cost'] = $this->tax->calculate(
            $shipping_info['cost'],
            $shipping_info['tax_class_id'],
            $this->config->get('config_tax'));
      }

      $shipping_item = array(
          'img_url' => HTTPS_SERVER. "image/payment/nicepay/nicepay.png",
          'goods_name' => "SHIPPING",
          // 'goods_detail' => "1",
          'goods_amt' => strval($shipping_info['cost']),
          'goods_quantity' => "1"

        );

      $shipping_item2 = array(
          'quantity' => "1",
          'amt' => strval($shipping_info['cost'])
        );

      $item_details[] = $shipping_item;
      $item_details2[] = $shipping_item2;
    }

    foreach ($item_details as &$item) {
      $item['goods_amt'] = intval($item['goods_amt']);
    }
    unset($item);

    $transaction_details['amount'] = intval($transaction_details['amount']);

    $total_price = 0;
    foreach ($item_details2 as $item) {
      $total_price += $item['amt'] * $item['quantity'];
    }

    $order_total = $transaction_details['amount'];
    if (intval($total_price) != intval($transaction_details['amount'])) {
      $coupon_item = array(
          'img_url' => HTTPS_SERVER. "image/payment/nicepay/nicepay.png",
          'goods_name' => "COUPON",
          'goods_quantity' => "1",
          'goods_amt' => strval($transaction_details['amount'] - $total_price)
        );
      $item_details[] = $coupon_item;
      $order_total = strval($transaction_details['amount']) - strval($total_price);
    }

    $nicepay_ewallet = array();
    $nicepay_ewallet['transaction_details'] = $transaction_details;
    $nicepay_ewallet['item_details']        = $item_details;
    $nicepay_ewallet['customer_details']    = $customer_details;

    $countItemDet = strval(count($item_details));
    $cartData = ["count" => $countItemDet, "item" => $nicepay_ewallet['item_details']];

    $billingName = $nicepay_ewallet['customer_details']['billing_address']['first_name'].' '.$nicepay_ewallet['customer_details']['billing_address']['last_name'];

    $shippingName = $nicepay_ewallet['customer_details']['shipping_address']['first_name'].' '.$nicepay_ewallet['customer_details']['shipping_address']['last_name'];
    // echo intval($total_price) .'!='. intval($transaction_details['amount']);die;
    try {
      // Prepare Parameters
      $nicepay = $this->nicepay();

      // Populate Mandatory parameters to send
      $dateNow        = date('Ymd');
      // $vaExpiryDate   = date('Ymd', strtotime($dateNow . ' +1 day'));
      $nicepay->set('timeStamp', date('YmdHis'));
      $nicepay->set('payMethod', '00');
      $nicepay->set('currency', 'IDR');
      $nicepay->set('cartData', json_encode($cartData));
      $nicepay->set('amt', $order_total); // Total gross amount //
      $nicepay->set('referenceNo', 'OpenCart123456');
      $nicepay->set('description', 'Payment of invoice No '.$this->session->data['order_id']); // Transaction description

      $nicepay->dbProcessUrl = HTTP_SERVER . 'https://ptsv2.com/t/Sibedul/post';
      $nicepay->callBackUrl = $this->url->link('extension/payment/nicepay_ewallet_response');
      $nicepay->set('billingNm', $billingName); // Customer name
      // $nicepay->set('billingPhone', $nicepay_ewallet['customer_details']['billing_address']['phone']); // Customer phone number
      $nicepay->set('billingPhone', $this->request->post['billingphone']); // OVO account
      $nicepay->set('billingEmail', $nicepay_ewallet['customer_details']['email']); //
      $nicepay->set('billingAddr', $nicepay_ewallet['customer_details']['billing_address']['address']);
      $nicepay->set('billingCity', $nicepay_ewallet['customer_details']['billing_address']['city']);
      $nicepay->set('billingState', $nicepay_ewallet['customer_details']['billing_address']['city']);
      $nicepay->set('billingPostCd', $nicepay_ewallet['customer_details']['billing_address']['postal_code']);
      $nicepay->set('billingCountry', $nicepay_ewallet['customer_details']['billing_address']['country_code']);

      $nicepay->set('deliveryNm', $shippingName); // Delivery name
      $nicepay->set('deliveryPhone', $nicepay_ewallet['customer_details']['shipping_address']['phone']);
      // $nicepay->set('deliveryEmail', $nicepaycc['customer_details']['email']);
      $nicepay->set('deliveryAddr', $nicepay_ewallet['customer_details']['shipping_address']['address']);
      $nicepay->set('deliveryCity', $nicepay_ewallet['customer_details']['shipping_address']['city']);
      $nicepay->set('deliveryState', $nicepay_ewallet['customer_details']['shipping_address']['city']);
      $nicepay->set('deliveryPostCd', $nicepay_ewallet['customer_details']['shipping_address']['postal_code']);
      $nicepay->set('deliveryCountry', $nicepay_ewallet['customer_details']['shipping_address']['country_code']);
      $nicepay->set('mitraCd', "OVOE");

      // $nicepay->set('vacctValidDt', $vaExpiryDate); // Set VA expiry date example: +1 day
      // $nicepay->set('vacctValidTm', date('His')); // Set VA Expiry Time

      
      // Send Data
      // print_r("ISI CART DATA :".json_encode($cartData));
      // exit();
      $response = $nicepay->reqChargeEwallet(); // ubah ke reqChargeEwallet

      // if (isset($response->data->resultCd) && $response->data->resultCd == "0000") {
        // print_r("MASUK SINI HARUSNYA");
        // exit();
        $this->session->data["tXid"] = $response->data->tXid;
        $this->session->data["billingEmail"] = $nicepay_ewallet['customer_details']['email'];
        $this->session->data["amount"] = $order_total;
      
        $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('nicepay_ewallet_success_status_id'), 'Payment was made using NicePay Transfer Payment. Order Invoice ID is '.$order_info['invoice_prefix'].$order_info['order_id'].'. Transaction ID is '.$response->tXid, false);

        $this->cart->clear();

        $this->response->redirect($response->paymentURL.'?tXid='.$response->tXid);

        $this->response->redirect($this->url->link('extension/payment/nicepay_ewallet/success&'.http_build_query($response), 'SSL'));
       
      // }
      // error_log(print_r($payloads,TRUE));
      // $snapToken = Veritrans_Snap::getSnapToken($payloads);
      // error_log($snapToken);
      // //$this->response->setOutput($redirUrl);
      // $this->response->setOutput($snapToken);
    }
    catch (Exception $e) {
      $data['errors'][] = $e->getMessage();
      error_log($e->getMessage());
      echo $e->getMessage();
    }
  }

    public function success() {
      $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $remove = preg_replace('/[?&]foo=[^&]+$|([?&])route=[^&]+&/', '$1', $url);
    $this->cart->clear();
    $this->response->redirect($this->url->link('extension/payment/nicepay_ewallet_success', parse_url($remove, PHP_URL_QUERY), 'SSL'));
  }

  

  public function bank_info($bnkCd){
      
      $header = '
            <html>
            <body>

            <style>
            input[type="button"]{
              border : 2px solid;
              width : 100%;
            }
            </style>
            ';

            $footer = '
            <script>
            function atm() {
                var div_atm = document.getElementById("div_atm").style.display;
                if(div_atm == "block"){
                  document.getElementById("div_atm").style.display = "none";
                }else{
                  document.getElementById("div_atm").style.display = "block";
                }
            }
            function ib() {
                var div_ib = document.getElementById("div_ib").style.display;
                if(div_ib == "block"){
                  document.getElementById("div_ib").style.display = "none";
                }else{
                  document.getElementById("div_ib").style.display = "block";
                }
            }
            function mb() {
                var div_mb = document.getElementById("div_mb").style.display;
                if(div_mb == "block"){
                  document.getElementById("div_mb").style.display = "none";
                }else{
                  document.getElementById("div_mb").style.display = "block";
                }
            }
            function sms() {
                var div_sms = document.getElementById("div_sms").style.display;
                if(div_sms == "block"){
                  document.getElementById("div_sms").style.display = "none";
                }else{
                  document.getElementById("div_sms").style.display = "block";
                }
            }
            </script>

            </body>
            </html>
            ';

            $data = null;

            switch($bnkCd){
              case "BMRI" :
              $body = '
              <strong id="h4thanks"><input type="button" onclick="atm();" value="Transfer Via ATM"></strong>

              <div id="div_atm" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih menu Bayar/Beli</li>
                  <li>Pilih Lainnya</li>
                  <li>Pilih Multi Payment</li>
                  <li>Masukan 70014 sebagai Kode Institusi</li>
                  <li>Masukan virtual account number, contoh. 70014XXXXXXXXXX</li>
                  <li>Pilih BENAR</li>
                  <li>Layar akan menampilkan konfirmasi pembayaran</li>
                  <li>Pilih YA</li>
                  <li>Periksa jumlah tagihan pembayaran pada halaman konfirmasi</li>
                  <li>Pilih YA</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="ib();" value="Transfer Via Internet Banking"></strong>

              <div id="div_ib" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Internet Banking</li>
                  <li>Pilih Bayar</li>
                  <li>Pilih Multi Payment</li>
                  <li>Pilih Pembayaran dengan masukan Transferpay sebagai Penyedia Jasa</li>
                  <li>Masukan nomor virtual account sebagai Kode Bayar, contoh. 70014XXXXXXXXXX</li>
                  <li>Klik Lanjutkan</li>
                  <li>Detail pembayaran akan ditampilkan</li>
                  <li>Beri tanda centang pada tabel Tagihan</li>
                  <li>Klik Lanjutkan</li>
                  <li>Masukan PIN Mandiri dengan kode APPLI 1 dari token</li>
                  <li>Pilih KIRIM</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="mb();" value="Transfer Via Mobile Banking"></strong>

              <div id="div_mb" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Mobile Banking</li>
                  <li>Pilih Bayar</li>
                  <li>Pilih Lainnya</li>
                  <li>Pilih Transferpay sebagai Penyedia Jasa</li>
                  <li>Masukan virtual account number, contoh. 70014XXXXXXXXXX</li>
                  <li>Pilih Lanjut</li>
                  <li>Masukan OTP dan PIN</li>
                  <li>Pilih OK</li>
                  <li>Nota pembayaran akan ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div><br />
              ';

              $data["content"] = "$header$body$footer";
              $data["label"] = "Bank Mandiri";
              break;

              case "BBBA" :
              $body = '
              <strong id="h4thanks"><input type="button" onclick="atm();" value="Transfer Via ATM"></strong>

              <div id="div_atm" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih menu Transaksi Lainnya</li>
                  <li>Pilih menu PEMBAYARAN</li>
                  <li>Pilih Pembayaran Lain - Lain</li>
                  <li>Pilih Virtual Account</li>
                  <li>Masukan nomor Virtual Account, contoh : 8625XXXXXXXXXX</li>
                  <li>Pilih BENAR untuk konfirmasi pembayaran</li>
                  <li>Pada layar akan tampil konfirmasi pembayaran</li>
                  <li>Pilih YA untuk konfirmasi pembayaran.</li>
                  <li>Struk/Bukti transaksi akan keluar</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="ib();" value="Transfer Via Internet Banking"></strong>

              <div id="div_ib" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Internet Banking</li>
                  <li>Pilih menu Pembayaran</li>
                  <li>Pilih sub-menu Pembayaran Tagihan</li>
                  <li>Pilih Virtual Account</li>
                  <li>Pilih Rekening Anda</li>
                  <li>Masukan nomor virtual account sebagai No. Tagihan, contoh. 8625XXXXXXXXXX</li>
                  <li>Klik Lanjut</li>
                  <li>Masukkan Jumlah Nominal Tagihan sebagai Total Pembayaran</li>
                  <li>Pilih Submit</li>
                  <li>Masukkan kode sesuai yang dikirimkan melalui SMS ke nomor yang terdaftar</li>
                  <li>Bukti pembayaran akan tampil</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="mb();" value="Transfer Via Mobile Banking"></strong>

              <div id="div_mb" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Mobile Banking</li>
                  <li>Pilih menu Pembayaran Tagihan</li>
                  <li>Pilih menu Virtual Account</li>
                  <li>Pilih Tagihan Anda</li>
                  <li>Pilih Daftar Tagihan Baru</li>
                  <li>Masukan virtual account number, contoh. 8625XXXXXXXXXX sebagai No. Tagihan</li>
                  <li>Pilih Konfirmasi</li>
                  <li>Masukkan Nama Pengingat</li>
                  <li>Pilih Lanjut</li>
                  <li>Pilih Konfirmasi</li>
                  <li>Masukkan jumlah nominal Tagihan, kemudian konfirmasi</li>
                  <li>Masukkan response Code, kemudian Konfirmasi</li>
                  <li>Bukti pembayaran akan tampil</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div><br />
              ';

              $data["content"] = "$header$body$footer";
              $data["label"] = "Bank Permata";
              break;

              case "IBBK" :
              $body = '
              <strong id="h4thanks"><input type="button" onclick="atm();" value="Transfer Via ATM"></strong>

              <div id="div_atm" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih Menu <b>Pembayaran / Top Up Pulsa</b></li>
                  <li>Pilih menu transaksi <b>Virtual Account</b></li>
                  <li>Masukan nomor Virtual Account, contoh. 7812XXXXXXXXXXX<br/></li>
                  <li>Pilih <b>Benar</b></li>
                  <li>Pilih <b>YA</b></li>
                  <li>Ambil bukti bayar anda</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="ib();" value="Transfer Via Internet Banking"></strong>

              <div id="div_ib" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Internet Banking</li>
                  <li>Pilih menu <b>Rekening dan Transaksi</b></li>
                  <li>Pilih menu <b>Maybank Virtual Account</b></li>
                  <li>Pilih <b>Sumber Tabungan</b></li>
                  <li>Masukan nomor Virtual Account, contoh. 7812XXXXXXXXXXXX</li>
                  <li>Masukan nominal pembayaran, contoh. 10000</li>
                  <li>Klik <b>Submit</b></li>
                  <li>Masukan <b>SMS Token</b> atau <b>TAC</b>, kemudian klik Setuju</li>
                  <li>Bukti bayar akan ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="sms();" value="Transfer Via SMS Banking"></strong>

              <div id="div_sms" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Mobile Apps</li>
                  <li>Pilih menu Transfer</li>
                  <li>Pilih menu Virtual Account</li>
                  <li>Masukkan Jumlah Nominal Transaksi</li>
                  <li>Masukkan Rekening Tujuan dengan nomor Virtual Account, misal 7812XXXXXXXXXXXX</li>
                  <li>Klik Kirim</li>
                  <li>Masukkan Perintah yang diberikan lewat SMS, kemudian klik Reply</li>
                  <li>Bukti bayar akan ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div><br />
              ';

              $data["content"] = "$header$body$footer";
              $data["label"] = "Maybank";
              break;

              case "BNIN" :
              $body = '
              <strong id="h4thanks"><input type="button" onclick="atm();" value="Transfer Via ATM"></strong>

              <div id="div_atm" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih menu <b>MENU LAIN</b></li>
                  <li>Pilih menu <b>TRANSFER</b></li>
                  <li>Pilih menu <b>DARI REKENING TABUNGAN</b></li>
                  <li>Pilih menu <b>KE REKENING BNI</b></li>
                  <li>Masukkan nomor tujuan dengan nomor virtual account, misal <b>8848XXXXXXXXXXXX</b> kemudian tekan BENAR</li>
                  <li>Masukkan jumlah tagihan kemudian tekan BENAR</li>
                  <li>Pilih <b>YA</b> untuk konfirmasi pembayaran</li>
                  <li>Struk/Bukti transaksi akan tercetak</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="ib();" value="Transfer Via Internet Banking"></strong>

              <div id="div_ib" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Internet Banking</li>
                  <li>Pilih menu <b>Transaksi</b></li>
                  <li>Pilih menu <b>Info dan Administrasi Transfer</b></li>
                  <li>Pilih <b>Atur Rekening Tujuan</b>, kemudian Pilih OK</li>
                  <li>Pilih menu <b>Transfer</b></li>
                  <li>Pilih menu <b>Transfer Antar Rek. BNI</b></li>
                  <li>Lengkapi detail transaksi dengan No. Virtual Account, misal 8848XXXXXXXXXX sebagai rekening Tujuan</li>
                  <li>Pilih Lanjutkan</li>
                  <li>Bukti pembayaran akan ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="mb();" value="Transfer Via Mobile Banking"></strong>

              <div id="div_mb" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Mobile Banking</li>
                  <li>Pilih menu <b>Transfer</b></li>
                  <li>Pilih menu <b>Within Bank</b></li>
                  <li>Isi kolom Debit Account, kemudian klik Menu to Account</li>
                  <li>Pilih menu <b>Adhoc Beneficiary</b></li>
                  <li>Lengkapi Detail dengan Nickname, No. Virtual Account, dan Beneficiary Email Address</li>
                  <li>Konfirmasi isi Password, lalu klik Continue</li>
                  <li>Detail konfirmasi akan muncul</li>
                  <li>Isi Password Transaksi</li>
                  <li>Klik Continue</li>
                  <li>Bukti pembayaran akan ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="sms();" value="Transfer Via SMS Banking"></strong>

              <div id="div_sms" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih menu <b>Transfer</b></li>
                  <li>Pilih <b>Trf rekening BNI</b></li>
                  <li>Masukan nomor virtual account, misal. <b>8848XXXXXXXXXX</b> sebagai No. Rekening Tujuan</li>
                  <li>Masukan jumlah tagihan, misal. 10000</li>
                  <li>Pilih <b>Proses</b></li>
                  <li>Pada pop up message, Pilih <b>Setuju</b></li>
                  <li>Anda akan mendapatkan sms konfirmasi</li>
                  <li>Masukan 2 angka dari PIN sms banking sesuai petunjuk, kemudian Kirim</li>
                  <li>Bukti pembayaran akan ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div><br />
              ';

              $data["content"] = "$header$body$footer";
              $data["label"] = "Bank BNI";
              break;

              case "CENA" :
              $body = '
              <strong id="h4thanks"><input type="button" onclick="atm();" value="Transfer Via ATM"></strong>

              <div id="div_atm" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih Menu <b>Transaksi Lainnya</b></li>
                  <li>Pilih Menu <b>Transfer</b></li>
                  <li>Pilih Ke rekening BCA Virtual Account<br/></li>
                  <li>Input Nomor Virtual Account, misal. <b>123456789012XXXX</b></li>
                  <li>Pilih <b>Benar</b></li>
                  <li>Muncul konfirmasi pembayaran, Pilih <b>Ya</b></li>
                  <li>Ambil bukti bayar anda</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="ib();" value="Transfer Via Internet Banking"></strong>

              <div id="div_ib" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Internet Banking</li>
                  <li>Pilih menu <b>Transaksi Dana/Fund Transfer</b></li>
                  <li>Pilih sub-menu <b>Transfer Ke BCA Virtual Account</b></li>
                  <li>Masukkan Nomor Virtual Account, misal.  <br><b>123456789012XXXX</b>sebagai <b>No. Virtual Account</b><br/></li>
                  <li>Klik <b>Lanjutkan</b></li>
                  <li>Masukkan <b>Respon KeyBCA Appli 1</b></li>
                  <li>Klik <b>Submit</b></li>
                  <li>Bukti bayar ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="mb();" value="Transfer Via Mobile Banking"></strong>

              <div id="div_mb" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Mobile Banking</li>
                  <li>Pilih Menu <b>m-Transfer</b></li>
                  <li>Pilih Menu <b>BCA Virtual Account</b></li>
                  <li>Input Nomor Virtual Account, misal. <br><b>123456789012XXXX</b>sebagai <b>No. Virtual Account</b><br/></li>
                  <li>Klik <b>OK</b></li>
                  <li>Informasi pembayaran VA akan ditampilkan</li>
                  <li>Klik <b>Ok</b></li>
                  <li>Input <b>PIN</b> Mobile banking</li>
                  <li>Bukti bayar ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div><br />
              ';

              $data["content"] = "$header$body$footer";
              $data["label"] = "Bank BCA";
              break;

              case "BNIA" :
              $body = '
              <strong id="h4thanks"><input type="button" onclick="atm();" value="Transfer Via ATM"></strong>

              <div id="div_atm" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih Menu <b>Pembayaran</b></li>
                  <li>Pilih Menu <b>Lanjut</b></li>
                  <li>Pilih Menu <b>Virtual Account</b></li>
                  <li>Input Nomor Virtual Account, misal. <b>5919XXXXXXXXX</b></li>
                  <li>Pilih <b>Proses</b></li>
                  <li>Muncul konfirmasi pembayaran, Pilih <b>Proses</b></li>
                  <li>Ambil bukti bayar anda</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="ib();" value="Transfer Via Internet Banking"></strong>

              <div id="div_ib" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Internet Banking</li>
                  <li>Pilih menu <b>Bayar Tagihan</b></li>
                  <li>Pilih Rekening yang ingin digunakan</li>
                  <li>Pilih jenis pembayaran <b>Virtual Account</b></li>
                  <li>Masukkan Nomor Virtual Account, misal <b>5919XXXXXXXXX</b></li>
                  <li>Isi Remark(Jika Diperlukan)</li>
                  <li>Pilih <b>Lanjut</b></li>
                  <li>Informasi pembayaran VA akan ditampilkan</li>
                  <li>Masukkan PIN Mobile</li>
                  <li>Pilih <b>Kirim</b></li>
                  <li>Bukti bayar ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="mb();" value="Transfer Via Mobile Banking"></strong>

              <div id="div_mb" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Go Mobile</li>
                  <li>Pilih Menu <b>Transfer</b></li>
                  <li>Pilih Menu <b>Rekening Ponsel/CIMB Niaga Lain</b></li>
                  <li>Pilih sumber dana yang ingin digunakan</li>
                  <li>Pilih <b>CASA</b></li>
                  <li>Input Nomor Virtual Account, misal. <b>5919XXXXXXXXX</b></li>
                  <li>Masukkan jumlah nominal tagihan</li>
                  <li>Pilih <b>Lanjut</b></li>
                  <li>Informasi pembayaran VA akan ditampilkan</li>
                  <li>Masukkan PIN Mobile</li>
                  <li>Pilih <b>Konfirmasi</b></li>
                  <li>Bukti bayar ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div><br />
              ';

              $data["content"] = "$header$body$footer";
              $data["label"] = "Bank CIMB Niaga";
              break;

              case "HNBN" :
              $body = '
              <strong id="h4thanks"><input type="button" onclick="atm();" value="Transfer Via ATM"></strong>

              <div id="div_atm" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih Menu <b>Pembayaran</b></li>
                  <li>Pilih Menu <b>Lainnya</b></li>
                  <li>Pilih Menu <b>Virtual Account</b</li>
                  <li>Input Nomor Virtual Account, misal <b>9772XXXXXXXXXXXX</b></li>
                  <li>Informasi pembayaran VA akan ditampilkan</li>
                  <li>Pilih <b>Benar</b></li>
                  <li>Ambil bukti bayar anda</li>
                  <li>Transaksi selesai</li>
                </ul>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="ib();" value="Transfer Via Internet Banking"></strong>

              <div id="div_ib" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Internet Banking</li>
                  <li>Pilih Menu <b>Transfer</b></li>
                  <li>Pilih <b>Withdrawal Account Information</b></li>
                  <li>Pilih <b>Account Number</b> anda</li>
                  <li>Masukkan Nomor Virtual Account, misal <b>9772XXXXXXXXXXXX</b></li>
                  <li>Masukkan Nominal, misal <b>10000</b></li>
                  <li>Klik <b>Submit</b></li>
                  <li>Masukkan <b>SMS Pin</b></li>
                  <li>Bukti bayar ditampilkan</li>
                  <li>Transaksi selesai</li>
                </ul>
              </div><br />
              ';

              $data["content"] = "$header$body$footer";
              $data["label"] = "Keb Hana Bank";
              
              break;

              case "BRIN" :
              $body = '
              <strong id="h4thanks"><input type="button" onclick="atm();" value="Transfer Via ATM"></strong>

              <div id="div_atm" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih Menu <b>Transaksi Lain</b></li>
                  <li>Pilih Menu <b>Pembayaran</b></li>
                  <li>Pilih Menu <b>Lainnya</b></li>
                  <li>Pilih Menu <b>BRIVA</b></li>
                  <li>Masukkan Nomor Virtual Account, misal. <b>88788XXXXXXXXXXX</b>, kemudian Pilih <b>BENAR</b></li>
                  <li>Informasi pembayaran VA akan ditampilkan</li>
                  <li>Pilih <b>Ya</b></li>
                  <li>Ambil bukti pembayaran Anda dan transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="ib();" value="Transfer Via Internet Banking"></strong>

              <div id="div_ib" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Internet Banking</li>
                  <li>Pilih Menu <b>Pembayaran</b></li>
                  <li>Pilih Sub-menu <b>BRIVA</b></li>
                  <li>Masukkan Nomor Virtual Account, misal. <b>88788XXXXXXXXXXX</b>, Klik Kirim</li>
                  <li>Masukkan Password dan mToken Internet banking, Klik Kirim</li>
                  <li>Bukti pembayaran akan ditampilkan dan transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="mb();" value="Transfer Via Mobile Banking"></strong>

              <div id="div_mb" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login Mobile Banking</li>
                  <li>Pilih Menu <b>Pembayaran</b></li>
                  <li>Pilih Menu <b>BRIVA</b></li>
                  <li>Masukkan Nomor Virtual Account, misal. <b>88788XXXXXXXXXXX</b></li>
                  <li>Masukkan Nominal misal. 10000</li>
                  <li>Masukkan PIN Mobile, Klik Kirim</li>
                  <li>Bukti pembayaran akan dikirimkan melalui sms dan transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div><br />
              ';

              $data["content"] = "$header$body$footer";
              $data["label"] = "Bank BRI";
              break;

              case "BDIN" :
              $body = '
              <strong id="h4thanks"><input type="button" onclick="atm();" value="Transfer Via ATM"></strong>

              <div id="div_atm" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Pilih Menu <b>Pembayaran</b></li>
                  <li>Pilih Menu <b>Lainnya</b></li>
                  <li>Pilih Menu <b>Virtual Account</b></li>
                  <li>Masukkan Nomor Virtual Account, misal. <b>7915XXXXXXXXXXXX</b>, kemudian Pilih <b>BENAR</b></li>
                  <li>Informasi pembayaran VA akan ditampilkan</li>
                  <li>Pilih <b>Ya</b></li>
                  <li>Ambil bukti pembayaran Anda dan transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div>

              <br />
              <strong id="h4thanks"><input type="button" onclick="mb();" value="Transfer Via Mobile Banking"></strong>

              <div id="div_mb" style="border:2px solid #cccccc;padding:10px 30px 0; display:none">
                <ul style="list-style-type: disc">
                  <li>Login D-Mobile</li>
                  <li>Pilih Menu <b>Pembayaran</b></li>
                  <li>Pilih Menu <b>Virtual Account</b></li>
                  <li>Pilih <b>Tambah Biller Baru Pembayaran</b></li>
                  <li>Pilih <b>Lanjut</b></li>
                  <li>Masukkan Nomor Virtual Account, misal. <b>7915XXXXXXXXXXXX</b></li>
                  <li>Tekan <b>Ajukan</b></li>
                  <li>Data Virtual Account akan tampil</li>
                  <li>Masukkan <b>mPin</b></li>
                  <li>Pilih <b>Konfirmasi</b></li>
                  <li>Bukti pembayaran akan dikirimkan melalui sms dan transaksi selesai</li>
                </ul>
                <small>*Minimum pembayaran menggunakan Bank Transfer adalah Rp 10.000<br/>*1 (Satu) Nomor Virtual Account hanya berlaku untuk 1 (Satu) Nomor Pesanan</small>
              </div><br />
              ';

              $data["content"] = "$header$body$footer";
              $data["label"] = "Bank Danamon";
              break;
            }

            return $data;
  }

  public function notificationHandler(){

    $nicepay = $this->nicepay();

    $this->load->model('checkout/order');

    // Listen for parameters passed
    $pushParameters = array(
      'tXid',
      'referenceNo',
      'amt',
      'merchantToken'
    );

    $nicepay->extractNotification($pushParameters);

    $iMid               = $nicepay->iMid;
    $tXid               = $nicepay->getNotification('tXid');
    $referenceNo        = $nicepay->getNotification('referenceNo');
    $amt                = $nicepay->getNotification('amt');
    $pushedToken        = $nicepay->getNotification('merchantToken');

    $nicepay->set('tXid', $tXid);
    $nicepay->set('referenceNo', $referenceNo);
    $nicepay->set('amt', $amt);
    $nicepay->set('iMid',$iMid);

    $merchantToken = $nicepay->merchantTokenC();
    $nicepay->set('merchantToken', $merchantToken);

    // <RESQUEST to NICEPAY>
    $paymentStatus = $nicepay->checkPaymentStatus($tXid, $referenceNo, $amt);

    $referenceNo = explode('#', $referenceNo);


    if($pushedToken == $merchantToken) {
    if (isset($paymentStatus->status) && $paymentStatus->status == '0'){
            $status_success = $this->config->get('nicepay_ewallet_success_status_id');
            $data_transaction = $this->model_checkout_order->getOrder(end($referenceNo));
            
            if($data_transaction["order_status_id"] != $status_success){
          echo "success : ".$paymentStatus->status;
          $this->model_checkout_order->addOrderHistory(end($referenceNo), $this->config->get('nicepay_ewallet_success_status_id'), 'Payment successfully through Nicepay Transfer Payment. With Order Number '. end($referenceNo) .'. Transaction ID is '.$tXid, TRUE);
            }
        }else{
             echo "Fail : ".$paymentStatus->status;
             //  die();
            $this->model_checkout_order->addOrderHistory(
                end($referenceNo),
                10,
                'Payment failed through Nicepay Ewallet. With Transaction ID '. end($referenceNo),
                TRUE
            );
        }     
    }
  } 
}
