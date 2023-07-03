<?php
	
	include("../../../../config.php");

	function sent_dbproccessurl($url, $data){
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPGET, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $data);		

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
	}

	$scheme = $_SERVER["REQUEST_SCHEME"];
	$host = $_SERVER["HTTP_HOST"];
	$scriptName = $_SERVER["SCRIPT_NAME"];
	$documentRoot = $_SERVER["DOCUMENT_ROOT"];
	// $domain = $scheme."://".$host;
    $domain = "https"."://".$host;
	

	if ($scheme == "http") {
		$domain = HTTP_SERVER;
	} else {
		$domain = HTTPS_SERVER;
	}

	if (preg_match("/merchantToken/", json_encode($_REQUEST))) {
		sent_dbproccessurl($domain."/index.php?route=extension/payment/nicepay_va/notificationHandler", http_build_query($_REQUEST));
	} else if(preg_match("/0000/", json_encode($_REQUEST))) {
        header("location:".$domain."/index.php?route=extension/payment/nicepay_va/success&".http_build_query($_REQUEST));
	} else {
		exit();
	}