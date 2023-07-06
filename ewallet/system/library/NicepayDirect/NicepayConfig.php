<?php
// Merchant ID
define("NICEPAY_IMID",              "IONPAYTEST");      // IMID Default
// API Key
define("NICEPAY_MERCHANT_KEY",      "33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A==");

define("NICEPAY_CALLBACK_URL", "/ThankYou");
define("NICEPAY_DBPROCESS_URL", "/Notification");
define( "NICEPAY_TIMEOUT_CONNECT", 15 );
define( "NICEPAY_TIMEOUT_READ", 25 );

// Please do not change
define("NICEPAY_PROGRAM",           "NicepayLite");
define("NICEPAY_VERSION",           "1.11");
define("NICEPAY_BUILDDATE",         "20160309");

// Development
define("NICEPAY_3DSECURE_URL",      "https://www.nicepay.co.id/nicepay/api/secureVeRequest.do");
define("NICEPAY_REQ_URL",        "https://www.nicepay.co.id/nicepay/direct/v2/registration");
define("NICEPAY_REQ_TRX_URL",    "https://dev.nicepay.co.id/nicepay/redirect/v2/registration");
define("NICEPAY_ORDER_STATUS_URL",  "https://www.nicepay.co.id/nicepay/api/onePassStatus.do");
define("NICEPAY_READ_TIMEOUT_ERR",  "10200");

/* LOG LEVEL */
define("NICEPAY_LOG_CRITICAL", 1);
define("NICEPAY_LOG_ERROR", 2);
define("NICEPAY_LOG_NOTICE", 3);
define("NICEPAY_LOG_INFO", 5);
define("NICEPAY_LOG_DEBUG", 7);
