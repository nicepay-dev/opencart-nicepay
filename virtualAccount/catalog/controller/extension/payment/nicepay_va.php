<?php

require_once(DIR_SYSTEM . 'library/NicepayLibVA/NicepayLibVA.php');


class ControllerExtensionPaymentNICEPayVA extends Controller {
	public function index() {
		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['action'] = $this->url->link('extension/payment/nicepay_va/send');
		
		return $this->load->view('extension/payment/nicepay_va', $data);
	}



	// private function simpleXor($string, $password) {
		// $data = array();

		// for ($i = 0; $i < strlen($password); $i++) {
			// $data[$i] = ord(substr($password, $i, 1));
		// }

		// $output = '';

		// for ($i = 0; $i < strlen($string); $i++) {
			// $output .= chr(ord(substr($string, $i, 1)) ^ ($data[$i % strlen($password)]));
		// }

		// return $output;
	// }

	public function send() {
		$this->load->model('checkout/order');
		$data['errors'] = array();

		//INI AWAL
		$X_CLIENT_KEY = X_CLIENT_KEY;
		$requestToken = NICEPAY_REQ_ACCESS_TOKEN_URL;
		date_default_timezone_set('Asia/Jakarta');
		$X_TIMESTAMP = date('c');
		$stringToSign = $X_CLIENT_KEY."|".$X_TIMESTAMP;
		
		// Start encrypt data
		
		$private_key = NICEPAY_PRIVATE_KEY;
		$binary_signature = "";
		
		$algo = "SHA256";
		openssl_sign($stringToSign, $binary_signature, $private_key, $algo);
		
		// End encrypt
		
		$jsonData = array(
			"grantType" => "client_credentials",
			"additionalInfo" => ""
		);
		
		$jsonDataEncode = json_encode($jsonData);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $requestToken);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncode);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'X-SIGNATURE: '.base64_encode($binary_signature),
			'X-CLIENT-KEY: '.$X_CLIENT_KEY,
			'X-TIMESTAMP: '.$X_TIMESTAMP
		));
		
		$output = curl_exec($ch);
		$data = json_decode($output);
		$accessToken = $data->accessToken;
		//INI AKHIR



		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);


		// $transaction_details = array();
		// $transaction_details['merchant_id'] = $this->config->get('nicepay_va_merchant_id');
		// $transaction_details['merchant_key'] = $this->config->get('nicepay_va_merchant_key');
		// $transaction_details['currency_code'] = $order_info['currency_code'];
		// $transaction_details['rate'] = $this->config->get('nicepay_va_rate');
		// $transaction_details['invoice'] = $this->config->get('nicepay_va_invoice') . $this->session->data['order_id'];
		$transaction_details['amount'] = (int)$order_info['total'];

		$products = $this->cart->getProducts();
		foreach ($products as $product) {
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || ! $this->config->get('config_customer_price')) {
				$product['price'] = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));
			}

			$orderInfo[] = array(
				'img_url' => HTTPS_SERVER. "image/". $product['image'],
				'goods_name' => $product['name'],
				'goods_detail' => $product['model']." x".$product['quantity']." item",
				'goods_amt' => (int)($product['price'] * $product['quantity'])
			);
		}

		if ($this->cart->hasShipping()) {
			$shipping_info = $this->session->data['shipping_method'];
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || ! $this->config->get('config_customer_price')) {
				$shipping_info['cost'] = $this->tax->calculate($shipping_info['cost'], $shipping_info['tax_class_id'], $this->config->get('config_tax'));
			}

			$orderInfo[] = array(
   				'img_url' => HTTPS_SERVER. "image/nicepay/png/delivery.png",
   				'goods_name' => "SHIPPING",
   				'goods_detail' => 1,
   				'goods_amt' => $shipping_info['cost']
			);
		}

		if ($this->config->get('config_currency') != 'IDR') {
			if ($this->currency->has('IDR')) {
				foreach ($orderInfo as &$item) {
					$item['goods_amt'] = intval($this->currency->convert($item['goods_amt'], $this->config->get('config_currency'), 'IDR'));
				}

				unset($item);

				$transaction_details['amount'] = intval($this->currency->convert($transaction_details['amount'], $this->config->get('config_currency'), 'IDR'));
			}
			else if ($this->config->get('payment_nicepay_va_rate') > 0) {
				foreach ($orderInfo as &$item) {
					$item['goods_amt'] = intval($item['goods_amt'] * $this->config->get('payment_nicepay_va_rate'));
				}

				unset($item);

				$transaction_details['amount'] = intval($transaction_details['amount'] * $this->config->get('payment_nicepay_va_rate'));
			} else {
				$data['errors'][] = 'Currency IDR tidak terinstall atau Nicepay currency conversion rate tidak valid. Silahkan check option kurs dollar.';
			}
		}

		$total_price = 0;
		foreach ($orderInfo as $item) {
			$total_price += $item['goods_amt'];
		}

		if ($total_price != $transaction_details['amount']) {
			$orderInfo[] = array(
   				'img_url' => HTTPS_SERVER. "image/nicepay/png/coupon.png",
   				'goods_name' => "COUPON",
   				'goods_detail' => 1,
   				'goods_amt' => $transaction_details['amount'] - $total_price
   			);
		}

		$order_total = 0;
		foreach ($orderInfo as $item) {
			$order_total += $item['goods_amt'];
		}

		$cartData = array(
  			"count" => count($orderInfo),
  			"item" => $orderInfo
		);
		
		$order_id = $this->session->data['order_id'];

		$billingNm = $order_info['payment_firstname']." ".$order_info['payment_lastname'];
		$billingEmail = $order_info['email'];
		$billingPhone = $order_info['telephone'];
		$billingAddr = ($order_info['payment_address_1'] == null) ? "-" : $order_info['payment_address_1'];
		
		$billingCountry = ($order_info['payment_iso_code_2'] == null) ? "-" : $order_info['payment_iso_code_2'];
        $billingState = ($order_info['payment_zone'] == null) ? "-" : $order_info['payment_zone'];
        $billingCity = ($order_info['payment_city'] == null) ? "-" : $order_info['payment_city'];
        $billingPostCd = ($order_info['payment_postcode'] == null) ? "-" : $order_info['payment_postcode'];

		$deliveryNm = ($order_info['shipping_firstname'] == null && $order_info['shipping_lastname'] == null) ? $billingNm : $order_info['shipping_firstname'] ." ". $order_info['shipping_lastname'];
		$deliveryAddr = ($order_info['shipping_address_1'] == null ) ? $billingAddr : $order_info['shipping_address_1'];
		$deliveryCity = ($order_info['shipping_city'] == null) ? $billingCity : $order_info['shipping_city'];
		$deliveryCountry = ($order_info['shipping_country'] == null) ? $billingCountry : $order_info['shipping_country'];
		$deliveryState = ($order_info['shipping_zone'] == null) ? $billingState : $order_info['shipping_zone'];
		$deliveryEmail = ($order_info['email'] == null) ? $billingEmail : $order_info['email'];
		$deliveryPhone = ($order_info['telephone'] == null) ? $billingPhone : $order_info['telephone'];
		$deliveryPostCd = ($order_info['shipping_postcode'] == null) ? $billingPostCd : $order_info['shipping_postcode'];

		$nicepay = new NicepayLibVA();

		$dateNow = date('Ymd');
		$vaExpiryDate = date('Ymd', strtotime($dateNow . '+1 day'));

		$nicepay->set('mKey', $this->config->get('payment_nicepay_va_merchant_key'));

		$nicepay->set('timeStamp', date('YmdHis'));
		$nicepay->set('iMid', $this->config->get('payment_nicepay_va_merchant_id'));
		$nicepay->set('payMethod', '02');
		$nicepay->set('currency', 'IDR');
		$nicepay->set('amt', $order_total);
		$nicepay->set('referenceNo', $order_id);
		$nicepay->set('goodsNm', 'Payment of invoice No '.$order_id);
		$nicepay->set('billingNm', $billingNm);
		$nicepay->set('billingPhone', $billingPhone);
		$nicepay->set('billingEmail', $billingEmail);
		$nicepay->set('billingAddr', $billingAddr);
		$nicepay->set('billingCity', $billingCity);
		$nicepay->set('billingState', $billingState);
		$nicepay->set('billingPostCd', $billingPostCd);
		$nicepay->set('billingCountry', $billingCountry);
		$nicepay->set('deliveryNm', $deliveryNm);
		$nicepay->set('deliveryPhone', $deliveryPhone);
		$nicepay->set('deliveryAddr', $deliveryAddr);
		$nicepay->set('deliveryCity', $deliveryCity);
		$nicepay->set('deliveryState', $deliveryState);
		$nicepay->set('deliveryPostCd', $deliveryPostCd);
		$nicepay->set('deliveryCountry', $deliveryCountry);
		$nicepay->set('dbProcessUrl', HTTP_SERVER . 'catalog/controller/extension/payment/nicepay_va_response.php');
		$nicepay->set('vat', '0');
		$nicepay->set('fee', '0');
		$nicepay->set('notaxAmt', '0');
		$nicepay->set('description', 'Payment of invoice No '.$order_id);
		$nicepay->set('merchantToken', $nicepay->merchantToken());
		$nicepay->set('reqDt', date('Ymd'));
		$nicepay->set('reqTm', date('His'));
		// $nicepay->set('reqDomain', '');
		// $nicepay->set('reqServerIP', '');
		// $nicepay->set('reqClientVer', '');
		$nicepay->set('userIP', $nicepay->getUserIP());
		// $nicepay->set('userSessionID', '');
		// $nicepay->set('userAgent', '');
		// $nicepay->set('userLanguage', '');
		$nicepay->set('cartData', json_encode($cartData));
		// $nicepay->set('instmntType', '2'); // Credit Card (CC)
		// $nicepay->set('instmntMon', '1'); // Credit Card (CC)
		// $nicepay->set('recurrOpt', '2'); // Credit Card (CC)
		$nicepay->set('bankCd', $this->request->post['bankCd']); // Virtual Account (VA)
		$nicepay->set('vacctValidDt', $vaExpiryDate); // Virtual Account (VA)
		$nicepay->set('vacctValidTm', date('His')); // Virtual Account (VA)
		// $nicepay->set('merFixAcctId', ''); // Virtual Account (VA)
		// $nicepay->set('mitraCd', ''); // Convenience Store (CVS)

		unset($nicepay->requestData['mKey']);

		// Send Data
				$X_CLIENT_KEY = X_CLIENT_KEY;


				date_default_timezone_set('Asia/Jakarta');
				$X_TIMESTAMP = date('c');
				
				$authorization = "Bearer ".$accessToken;
				$channel = "chnl".rand();
				$external = "ext".rand();
				$partner = X_CLIENT_KEY.rand();
				$secretClient = "33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A==";
				$body = '{"partnerServiceId":"","customerNo":"","virtualAccountNo":"","virtualAccountName":"'.$billingNm.'","trxId":"'.$order_id.'","totalAmount":{"value":"'.number_format($order_total,2).'","currency":"IDR"},"additionalInfo":{"bankCd":"'.$this->request->post['bankCd'].'","goodsNm":"Payment of invoice No '.$order_id.'","dbProcessUrl": "https://nicepay.co.id/","vacctValidDt":"","vacctValidTm":"","msId":"","msFee":"","msFeeType":"","mbFee":"","mbFeeType":""}}';

				$hashBody = strtolower(hash("SHA256", $body));
				
				$stirgSign = "POST:/api/v1.0/transfer-va/create-va:".$accessToken.":".$hashBody.":".$X_TIMESTAMP;
				$bodyHasing = hash_hmac("sha512", $stirgSign, $secretClient, true);
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, NICEPAY_GENERATE_VA_URL);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'X-SIGNATURE: '.base64_encode($bodyHasing),
					'X-CLIENT-KEY: '.$X_CLIENT_KEY,
					'X-TIMESTAMP: '.$X_TIMESTAMP,
					'Authorization: '.$authorization,
					'CHANNEL-ID: '.$channel,
					'X-EXTERNAL-ID: '.$external,
					'X-PARTNER-ID: '.$X_CLIENT_KEY
				));

				
				$output = curl_exec($ch);
				$data = json_decode($output);




		// Response from NICEPAY
		// if (isset($response->resultCd) && $response->resultCd == "0000") {
			// Response 
			// $this->session->data["resultCd"] = $response->resultCd;
			// $this->session->data["resultMsg"] = $response->resultMsg;
			// $this->session->data["tXid"] = $response->tXid;
			// $this->session->data["referenceNo"] = $response->referenceNo;
			// $this->session->data["payMethod"] = $response->payMethod;
			// $this->session->data["amt"] = $response->amt;
			// $this->session->data["currency"] = $response->currency;
			// $this->session->data["goodsNm"] = $response->goodsNm;
			// $this->session->data["billingNm"] = $response->billingNm;
			// $this->session->data["transDt"] = $response->transDt;
			// $this->session->data["transTm"] = $response->transTm;
			// $this->session->data["description"] = $response->description;
			// $this->session->data["bankCd"] = $response->bankCd;
			// $this->session->data["vacctNo"] = $response->vacctNo;
			// $this->session->data["vacctValidDt"] = $response->vacctValidDt;
			// $this->session->data["vacctValidTm"] = $response->vacctValidTm;
			// $this->session->data["mitraCd"] = $response->mitraCd;
			// $this->session->data["payNo"] = $response->payNo;
			// $this->session->data["payValidDt"] = $response->payValidDt;
			// $this->session->data["payValidTm"] = $response->payValidTm;

			// custom response

			$this->session->data["tXid"] = $data->virtualAccountData->additionalInfo->tXidVA;
			$this->session->data["amt"] = "Rp. ".number_format($data->virtualAccountData->totalAmount->value, 2);
			$this->session->data["vacctNo"] = $data->virtualAccountData->virtualAccountNo;
			$this->session->data["expDate"] = date('Y/m/d', strtotime($data->virtualAccountData->additionalInfo->vacctValidDt))." ".date('H:i:s', strtotime($data->virtualAccountData->additionalInfo->vacctValidTm));
			$this->session->data["bankName"] = $this->bank_info($this->request->post['bankCd'])["label"];
			$this->session->data["bankContent"] = $this->bank_info($this->request->post['bankCd'])["content"];
			$this->session->data["description"] = "Payment of invoice No ".$data->virtualAccountData->order_id;
			
			// $this->session->data["billingEmail"] = $billingEmail;


			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payment_nicepay_va_order_status_id'), 'Payment was made using NicePay Transfer Payment. Order Invoice ID is '.$order_info['invoice_prefix'].$order_info['order_id'].'. Transaction ID is '.$response->tXidVA, false);




			$this->response->redirect($this->url->link('extension/payment/nicepay_va/success&'.http_build_query($response), 'SSL'));



		// } 
		// elseif (isset($response->resultCd)) {
		// 	// API data not correct or error happened in bank system, you can redirect back to checkout page or echo error message.
		// 	// In this sample, we echo error message
		// 	// header("Location: "."http://example.com/checkout.php");
		// 	echo "<pre>";
		// 	echo "result code: ".$response->resultCd."\n";
		// 	echo "result message: ".$response->resultMsg."\n";
		//     // echo "requestUrl: ".$response->data->requestURL."\n";
		// 	echo "</pre>";
		// } else {
		// 	// Timeout, you can redirect back to checkout page or echo error message.
		// 	// In this sample, we echo error message
		// 	// header("Location: "."http://example.com/checkout.php");
		// 	echo "<pre>Connection Timeout. Please Try again.</pre>";
		// }

	}

	public function success() {
	    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $remove = preg_replace('/[?&]foo=[^&]+$|([?&])route=[^&]+&/', '$1', $url);
		$this->cart->clear();
		$this->response->redirect($this->url->link('extension/payment/nicepay_va_success', parse_url($remove, PHP_URL_QUERY), 'SSL'));
	}

	// public function oneLine($string) {
        // return preg_replace(array('/\n/','/\n\r/','/\r\n/','/\r/','/\s+/','/\s\s*/'), '', $string);
    // }

    public function bank_info($bankCd){
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

  		switch ($bankCd) {
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
            </div>

            <br />
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
            </div>

            <br />
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
            </div>

            <br />
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
            </div>

            <br />
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
            </div>

            <br />
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
            </div>

            <br />
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
            </div>

            <br />
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
            </div>

            <br />
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
            </div>

            <br />
            ';

            $data["content"] = "$header$body$footer";
            $data["label"] = "Bank Danamon";
  			break;

  		}

  		return $data;
	}

	public function notificationHandler() {

		$nicepay = new NicepayLibVA();

		$this->load->model('checkout/order');

		// Listen for parameters passed
		$pushParameters = array(
			'transDt',
			'transTm',
			'tXid',
			'referenceNo',
			'amt',
			'merchantToken',
		);

		$nicepay->extractNotification($pushParameters);

		$transDt = $nicepay->getNotification('transDt');
		$transTm = $nicepay->getNotification('transTm');
		$timeStamp = $transDt.$transTm;
		$iMid = $this->config->get('payment_nicepay_va_merchant_id');
		$tXid = $nicepay->getNotification('tXid');
		$referenceNo = $nicepay->getNotification('referenceNo');
		$amt = $nicepay->getNotification('amt');
		$mKey = $this->config->get('payment_nicepay_va_merchant_key');
		$pushedToken = $nicepay->getNotification('merchantToken');

		$nicepay->set('timeStamp', $timeStamp);
		$nicepay->set('iMid', $iMid);
		$nicepay->set('tXid', $tXid);
		$nicepay->set('referenceNo', $referenceNo);
		$nicepay->set('amt', $amt);
		$nicepay->set('mKey', $mKey);
		$merchantToken = $nicepay->merchantTokenC();
  		$nicepay->set('merchantToken', $merchantToken);

  		// <RESQUEST to NICEPAY>
  		$paymentStatus = $nicepay->checkPaymentStatus($timeStamp, $iMid, $tXid, $referenceNo, $amt);

  		if($pushedToken == $merchantToken) {
			if (isset($paymentStatus->status) && $paymentStatus->status == '0') {
                $status_success = $this->config->get('payment_nicepay_va_order_success_status');
                $data_transaction = $this->model_checkout_order->getOrder($referenceNo);
                
                if($data_transaction["order_status_id"] != $status_success) {
    			    echo "success : ".$paymentStatus->status;
    			    $this->model_checkout_order->addOrderHistory($referenceNo, $this->config->get('payment_nicepay_va_order_success_status'), 'Payment successfully through Nicepay Transfer Payment. With Order Number '. $referenceNo .'. Transaction ID is '.$tXid, TRUE);
                }
            } else {
                echo "Fail : ".$paymentStatus->status;
                $this->model_checkout_order->addOrderHistory($referenceNo, 10, 'Payment failed through Nicepay Virtual Account. With Transaction ID '. $referenceNo, TRUE);
            }			
		}
	}
}
?>