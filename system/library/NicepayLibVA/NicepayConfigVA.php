<?php
/*
 * ____________________________________________________________
 *
 * Copyright (C) 2016 NICE IT&T
 *
 *
 * This config file may used as it is, there is no warranty.
 *
 * @ description : PHP SSL Client module.
 * @ name        : NicepayLite.php
 * @ author      : NICEPAY I&T (tech@nicepay.co.kr)
 * @ date        :
 * @ modify      : 09.03.2016
 *
 * 09.03.2016 Update Log
 *
 * ____________________________________________________________
 */

// Please set the following

// define("NICEPAY_IMID_VA", "IONPAYTEST"); // Merchant ID
// define("NICEPAY_MERCHANT_KEY_VA", "33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A=="); // API Key
// define("NICEPAY_CALLBACK_URL_VA", "http://localhost/nicepay-sdk/result.html"); // Merchant's result page URL
// define("NICEPAY_DBPROCESS_URL_VA", "http://httpresponder.com/nicepay"); // Merchant's notification handler URL

define("X_CLIENT_KEY",              "IONPAYTEST");                                                 				 // Merchant ID
define("NICEPAY_DBPROCESS_URL",     "https://dev.nicepay.co.id/IONPAY_CLIENT/paymentResult.jsp");                // Merchant's notification handler URL

/* TIMEOUT - Define as needed (in seconds) */
define("NICEPAY_TIMEOUT_CONNECT_VA", 15);
define("NICEPAY_TIMEOUT_READ_VA", 25);


// Please do not change
define("NICEPAY_PROGRAM_VA", "NicepayLite");
define("NICEPAY_VERSION_VA", "1.11");
define("NICEPAY_BUILDDATE_VA", "20160309");
// define("NICEPAY_REQ_CC_URL_VA", "https://api.nicepay.co.id/nicepay/direct/v2/registration"); // Registration API URL
//define("NICEPAY_REG_URL_VA", "https://dev.nicepay.co.id/nicepay/direct/v2/registration"); // Registration API URL
// define("NICEPAY_CANCEL_VA_URL", "https://api.nicepay.co.id/nicepay/direct/v2/cancel"); // Credit Card (CC), Virtual Account (VA), Convience Store (CVS) API URL
//define("NICEPAY_ORDER_STATUS_URL_VA", "https://dev.nicepay.co.id/nicepay/direct/v2/inquiry"); // request to check status of transaction

define("NICEPAY_REQ_ACCESS_TOKEN_URL",  "https://dev.nicepay.co.id/nicepay/v1.0/access-token/b2b");             // Generate Access Token URL
define("NICEPAY_GENERATE_VA_URL",   "https://dev.nicepay.co.id/nicepay/api/v1.0/transfer-va/create-va");       	// Generate VA (Virtual Account) URL


// PRIVATE KEY
define("NICEPAY_PRIVATE_KEY",  <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAInJe1G22R2fMchIE6BjtYRqyMj6lurP/zq6vy79WaiGKt0Fxs4q3Ab4ifmOXd97ynS5f0JRfIqakXDcV/e2rx9bFdsS2HORY7o5At7D5E3tkyNM9smI/7dk8d3O0fyeZyrmPMySghzgkR3oMEDW1TCD5q63Hh/oq0LKZ/4Jjcb9AgMBAAECgYA4Boz2NPsjaE+9uFECrohoR2NNFVe4Msr8/mIuoSWLuMJFDMxBmHvO+dBggNr6vEMeIy7zsF6LnT32PiImv0mFRY5fRD5iLAAlIdh8ux9NXDIHgyera/PW4nyMaz2uC67MRm7uhCTKfDAJK7LXqrNVDlIBFdweH5uzmrPBn77foQJBAMPCnCzR9vIfqbk7gQaA0hVnXL3qBQPMmHaeIk0BMAfXTVq37PUfryo+80XXgEP1mN/e7f10GDUPFiVw6Wfwz38CQQC0L+xoxraftGnwFcVN1cK/MwqGS+DYNXnddo7Hu3+RShUjCz5E5NzVWH5yHu0E0Zt3sdYD2t7u7HSr9wn96OeDAkEApzB6eb0JD1kDd3PeilNTGXyhtIE9rzT5sbT0zpeJEelL44LaGa/pxkblNm0K2v/ShMC8uY6Bbi9oVqnMbj04uQJAJDIgTmfkla5bPZRR/zG6nkf1jEa/0w7i/R7szaiXlqsIFfMTPimvRtgxBmG6ASbOETxTHpEgCWTMhyLoCe54WwJATmPDSXk4APUQNvX5rr5OSfGWEOo67cKBvp5Wst+tpvc6AbIJeiRFlKF4fXYTb6HtiuulgwQNePuvlzlt2Q8hqQ==
-----END RSA PRIVATE KEY-----
EOD);

define("NICEPAY_READ_TIMEOUT_ERR_VA",  "10200");

/* LOG LEVEL */
// define("NICEPAY_LOG_CRITICAL_VA", 1);
// define("NICEPAY_LOG_ERROR_VA", 2);
// define("NICEPAY_LOG_NOTICE_VA", 3);
// define("NICEPAY_LOG_INFO_VA", 5);
// define("NICEPAY_LOG_DEBUG_VA", 7);
?>