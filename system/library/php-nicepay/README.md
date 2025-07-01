# PHP - NICEPAY

NICEPAY ❤️PHP!

This is the Official PHP API client/library for NICEPAY Payment API. Visit [PHP Library](https://github.com/nicepay-dev/java-nicepay). 
More information about the product and see documentation at [NICEPAY Docs](https://docs.nicepay.co.id/) for more technical details.

This library provides access to Nicepay BI SNAP and V2 APIs for backend use.

This library currently supports the following payment methods:

### SNAP Version:
- **Snap**
    - Get Access Token
- **Virtual Account**:
    - Generate Virtual Account
    - Inquiry Status
    - Cancel
- **Ewallet**:
    - Payment
    - Inquiry Status
    - Refund
- **QRIS**:
    - Generate QRIS
    - Inquiry Status 
    - Refund
- **Payout**:
    - Registration
    - Approve
    - Inquiry Status
    - Check Balance
    - Cancel
    - Reject

### V2 Version:
- **Virtual Account, Convenience Store**:
    - Registration
    - Inquiry Status
    - Cancel
- **Debit/Credit Card**
    - Registration
    - Inquiry Status
    - Cancel
    - Payment

### Additional Function
- **Helper**
    - Verify Signature Sha256

## 1. Installation
### 1.1 Manual Install
You can clone or [download](https://github.com/nicepay-dev/nativephp-nicepay) our source code, then import the folder manually into your project.

### 1.2 Manual Install with Github link
Add the repository details on your project composer.json
```json     
{
  "require": {
        "nicepay/nicepay-php": "dev-master"
    },
  "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/nicepay-dev/php-nicepay"
        }
    ],
}
```

Run **composer install** if it’s your first time or **composer update nicepay/nicepay-php** to update that specific package.

### 1.2 Install with Composer  
If you are using [Composer](https://getcomposer.org), install the library via the Composer CLI:
```bash
composer require nicepay/php-nicepay
```
This will download and install the package, along with its dependencies, into your project. Make sure Composer is properly set up before running this command.

## 2. Usage

### 2.1 Client Initialization and Configuration
Get your Credentials from [Nicepay Dashboard](https://bo.nicepay.co.id/)
Initialize Nicepay Config
> **WARNING:** Credentials used here are for testing purposes only.

```php 

$timestamp = Helper::getFormattedDate();

$config = NICEPay::builder()
            ->setIsProduction(false) // 
            ->setPrivateKey('MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAInJe1G22R2fMchIE6BjtYRqyMj6lurP/zq6vy79WaiGKt0Fxs4q3Ab4ifmOXd97ynS5f0JRfIqakXDcV/e2rx9bFdsS2HORY7o5At7D5E3tkyNM9smI/7dk8d3O0fyeZyrmPMySghzgkR3oMEDW1TCD5q63Hh/oq0LKZ/4Jjcb9AgMBAAECgYA4Boz2NPsjaE+9uFECrohoR2NNFVe4Msr8/mIuoSWLuMJFDMxBmHvO+dBggNr6vEMeIy7zsF6LnT32PiImv0mFRY5fRD5iLAAlIdh8ux9NXDIHgyera/PW4nyMaz2uC67MRm7uhCTKfDAJK7LXqrNVDlIBFdweH5uzmrPBn77foQJBAMPCnCzR9vIfqbk7gQaA0hVnXL3qBQPMmHaeIk0BMAfXTVq37PUfryo+80XXgEP1mN/e7f10GDUPFiVw6Wfwz38CQQC0L+xoxraftGnwFcVN1cK/MwqGS+DYNXnddo7Hu3+RShUjCz5E5NzVWH5yHu0E0Zt3sdYD2t7u7HSr9wn96OeDAkEApzB6eb0JD1kDd3PeilNTGXyhtIE9rzT5sbT0zpeJEelL44LaGa/pxkblNm0K2v/ShMC8uY6Bbi9oVqnMbj04uQJAJDIgTmfkla5bPZRR/zG6nkf1jEa/0w7i/R7szaiXlqsIFfMTPimvRtgxBmG6ASbOETxTHpEgCWTMhyLoCe54WwJATmPDSXk4APUQNvX5rr5OSfGWEOo67cKBvp5Wst+tpvc6AbIJeiRFlKF4fXYTb6HtiuulgwQNePuvlzlt2Q8hqQ==')
            ->setClientSecret('33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A==')
            ->setPartnerId('IONPAYTEST')
            ->setExternalID("randUniqueId1234")
            ->setTimestamp($timestamp)
            ->isRetryFlag(true) // default false
            ->setRetryCount(4) // default 1
            ->build();
```

### 2.2 Featured services 


### 2.2.1 Snap Version

Snap is Nicepay existing tool to help merchant charge customers using a mobile-friendly, in-page,
no-redirect checkout facilities. [Using snap is simple](https://docs.Nicepay.com/en/snap/overview).

Available methods for Snap

#### 2.2.1.1 Get Access Token

```php

        $tokenBody = AccessToken::builder()
            ->setGrantType('client_credentials')
            ->setAdditionalInfo([])
            ->build();

        $snap = new Snap($config); // check 2.1 to set up $config

        try {
            $response = $snap->requestSnapAccessToken($tokenBody);

            // Get access token
            $accessToken = $response->getAccessToken();  

        } catch (NicepayError $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }

```

#### 2.2.1.2 Generate VA

```php

$parameter = VirtualAccount::builder()
            ->setPartnerServiceId("")
            ->setCustomerNo("")
            ->setVirtualAccountNo("")
            ->setVirtualAccountName("Nicepay PHP Test")
            ->setTrxId("ordNo" . $timestamp)
            ->setTotalAmount('10000.00', 'IDR')
            ->setAdditionalInfo([
                'bankCd' => 'BMRI',     
                'goodsNm' => 'Test',
                'dbProcessUrl' => 'https://nicepay.co.id/',
            ])
            ->build();


        $accessToken = ""; // Check 2.2.1.1 for step to get access token
        $snapVAService = new SnapVAService($config);

        try {
        $response = $snapVAService->generateVA($parameter, $accessToken);
        } catch (NicepayError $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }

```
### 2.2.2 Non-Snap Version (V2)

#### 2.2.2.1 Generate VA

```php

$timestamp = Helper::getFormattedTimestampV2();
        
        $config = NICEPay::builder()
            ->setIsProduction(false)
            ->setRetryFlag(true) 
            ->setRetryCount(4) 
            ->build();

        $reffNo = "ordNo".$timestamp;
        $amount = "100";
        $virtualAccountBuilder = VirtualAccount::builder();

        // For Merchant token setter the args is (TIMESTAMP, IMID, REFFNO, AMOUNT, MERCHANT_KEY)
        $parameter = $virtualAccountBuilder
            ->setTimeStamp($timestamp)
            ->setIMid("IONPAYTEST")
            ->setPayMethod("02")
            ->setCurrency("IDR")
            ->setBankCd("CENA")
            ->setAmt("100")
            ->setReferenceNo($reffNo)
            ->setMerchantToken($timestamp, "IONPAYTEST", $reffNo, $amount, "")
            ->setVacctValidDt("20251004")
            ->setVacctValidTm("101010")
            ->setMerFixAcctId("")
            ->setDbProcessUrl("https://webhook.site/7c2d47f6-557b-4b85-b91a-ad3b6182b10c")
            ->setGoodsNm("Test VA V2 PHP")
            ->setCartData("{}")
            ->setBillingNm("Nicepay php native")
            ->setBillingPhone("081534567890")
            ->setBillingEmail("nicepay@example.com")
            ->setBillingAddr("Jln. Raya Kasablanka Kav.88")
            ->setBillingCity("South Jakarta")
            ->setBillingState("DKI Jakarta")
            ->setBillingPostCd("15119")
            ->setBillingCountry("Indonesia")
            ->build();
                
        $v2VaService = new V2VAService($config);

        try {
        $response = $v2VaService->registration($parameter);

        } catch (NicepayError $e) {
            $this->assertTrue(true, "Exmessage: ception thrown: " . $e->getMessage());
        }

```
#### 2.2.2.2 Payment Card

```php
        $config = NICEPay::builder()
            ->setIsProduction(false) // Dev
            ->build();

        $parameter = Card::builder()
        ->timeStamp($timestamp)
        ->iMid($iMid)
        ->tXid($tXid) // tXid transaction to do payment process
        ->referenceNo($referenceNo)
        ->merchantToken($timestamp, $iMid, $referenceNo, $amount, $merchantKey)
        ->cardNo(TestConst::$CARD_NO) // CARD DATA
        ->cardExpYymm(TestConst::$CARD_EXP_YYMM) // CARD DATA 
        ->cardCvv(TestConst::$CARD_CVV) // CARD DATA
        ->cardHolderNm("Nicepay test")
        ->callBackUrl("https://x.com")
        ->build();

        try {

            $cardService = new V2CardService($config);
            $response = $cardService->payment($parameter);

        } catch (Exception $exception) {
            
        }
```
The response will contain the HTML content, which should be rendered and processed on your front-end for the 3DS (3D Secure) flow.

Sample HTML Response for 3DS Flow

Here’s an example of the HTML response your front-end should handle. It contains an iframe for 3DS authentication, with the form automatically submitting to the 3DS method URL.

```html

<head>
	<style>
		body {min-width: 100%; height: auto; min-height: 500px; overflow: none; border: none; background: url("/nicepay/images/rotate.gif") no-repeat center;
	</style>
	</head>
	<body onload='javascript:getBrowserInfo();'>
		<div style='visibility:hidden'>
			<div id="initiate3dsSimpleRedirect" xmlns="http://www.w3.org/1999/html"> <iframe id="methodFrame" name="methodFrame" height="100" width="200" > </iframe> <form id ="initiate3dsSimpleRedirectForm" method="POST" action="https://mtf.gateway.mastercard.com/acs/mastercard/v2/method" target="methodFrame"> <input type="hidden" name="threeDSMethodData" value="eyJ0aHJlZURTTWV0aG9kTm90aWZpY2F0aW9uVVJMIjoiaHR0cHM6Ly9tdGYuZ2F0ZXdheS5tYXN0ZXJjYXJkLmNvbS9jYWxsYmFja0ludGVyZmFjZS9nYXRld2F5LzNjMTlhMzU0NjgwMWU2ZDMwMTYwZWJiMDllMjAxYzg2NTU0MzZkMzRjYjgwOWFjNTIyMmMxMzIwZDFhMjI3ZDUiLCJ0aHJlZURTU2VydmVyVHJhbnNJRCI6ImM2YTI5MTllLTdlNWMtNDcyMi1hYmJlLTY5YmVlZDAyM2IzZiJ9" /> </form> <script id="initiate-authentication-script"> var e=document.getElementById("initiate3dsSimpleRedirectForm"); if (e) { e.submit(); if (e.parentNode !== null) { e.parentNode.removeChild(e); } } </script> </div> 
		</div>
		<form name="mpgsAuthFrm" id="mpgsAuthFrm" method="post" action='https://dev.nicepay.co.id/nicepay/api/mpgsAuth.do'>
			<input type='hidden' name='tXid' value='TESTMPGS0501202409060047287070'>
			<input type='hidden' name='cardNo' value='5123450000000008'>
			<input type='hidden' name='cardExpYymm' value='2908'>
			<input type='hidden' name='cardCvv' value='100'>
			<input type='hidden' name='callbackUrl' value='https://dev.nicepay.co.id/IONPAY_CLIENT/paymentResult.jsp'>
			<input type='hidden' name='registered' value='true'>
			<input type='hidden' name='directV1' value='false'>
			<input type='hidden' name='authResult' value='false'>
			<input type='hidden' name='browser' value=''>
			<input type='hidden' name='browserJavaEnabled' value='false'>
			<input type='hidden' name='browserJavascriptEnabled' value='2'>
			<input type='hidden' name='browserLanguage' value=''>
			<input type='hidden' name='browserScreenColorDepth' value=''>
			<input type='hidden' name='browserScreenHeight' value='0'>
			<input type='hidden' name='browserScreenWidth' value='0'>
			<input type='hidden' name='browserTimeZone' value='0'>
		</form>
	<script>
		function getBrowserInfo() {
			document.mpgsAuthFrm.browser.value = navigator.userAgent;
			document.mpgsAuthFrm.browserJavaEnabled.value = window.navigator.javaEnabled() === true ? 'true' : 'false';
			document.mpgsAuthFrm.browserJavascriptEnabled.value = "1"; 
			document.mpgsAuthFrm.browserLanguage.value = navigator.language; 
			document.mpgsAuthFrm.browserScreenColorDepth.value = screen.colorDepth; 
			document.mpgsAuthFrm.browserScreenHeight.value = screen.height; 
			document.mpgsAuthFrm.browserScreenWidth.value = screen.width; 
			document.mpgsAuthFrm.browserTimeZone.value = new Date().getTimezoneOffset(); 
			document.mpgsAuthFrm.submit(); 
		}
	</script>
	</body>
```
##### Front-End Integration
1. When the front-end receives the responseHtml, render it as an HTML page.
2. The page will automatically post to the 3DS method URL, redirecting the user to a page where they can enter the OTP sent to their registered device.
3. After completing the 3DS flow, the user is redirected back to your callback URL.

Expected Result :

Once the user completes the 3DS authentication, they will be redirected to your defined callbackUrl, where you can process the result.


### 2.2.3 Additional Function

#### Verify Signature Sha256
import :
```php
use Nicepay\utils\Helper;
```

Code : 
```php

$signatureString = "VoxMPjbcV9pro4YyHGQgoRj4rDVJgYk2Ecxn+95B90w47Wnabtco35BfhGpR7a5RukUNnAdeOEBNczSFk4B9uYyu3jc+ceX+Dvz5OYSgSnw5CiMHtGiVnTAqCM/yHZ2MRpIEqekBc4BWMLVtexSWp0YEJjLyo9dZPrSkSbyLVuD7jkUbvmEpVdvK0uK15xb8jueCcDA6LYVXHkq/OMggS1/5mrLNriBhCGLuR7M7hBUJbhpOXSJJEy7XyfItTBA+3MRC2FLcvUpMDrn/wz1uH1+b9A6FP7mG0bRSBOm2BTLyf+xJR5+cdd88RhF70tNQdQxhqr4okVo3IFqlCz2FFg==";
$dataString = "TNICEVA023|2024-08-19T17:12:40+07:00";
$publicKeyString = TestConst::$PUBLIC_KEY;

$isVerify = Helper::verifySHA256RSA($dataString, $publicKeyString, $signatureString);

```

## 3. Examples

Integration test are available

- [Virtual Account Sample Functional Test](test/NicepayVirtualAccountTest.php)
- [E-Wallet Sample Functional Test](test/NicepayEwalletTest.php)
- [QRIS Sample Functional Test](test/NicepayQrisTest.php)
- [Payout Sample Functional Test](test/NicepayPayoutTest.php)
- [Card Sample Functional Test](test/NicepayCardTest.php)
- [Convenience Store Sample Functional Test](test/NicepayCVSTest.php)
- [Inquiry Status Sample Functional Test](test/NicepayInquiryStatusTest.php)
- [Cancel / Refund Sample Functional Test](test/NicepayCancelTest.php)

## Running in Local Development

To run the library in a local environment, follow these steps:

1. Create a `.env` file in your project root:
   ```env
   APP_ENV=local

2. Load the .env file at the start of your project (e.g., in index.php):
```php     
use Nicepay\utils\EnvLoader;

EnvLoader::load(__DIR__ . '/.env');
```

3. Verify the environment variable is set:
```php
if (getenv('APP_ENV') === 'local') {
    echo "Running in local environment";
}

```

**By default, if no .env file is loaded, the library will assume it is running in a production environment.**


## Get help

- [Nicepay Docs](https://docs.nicepay.co.id/)
- [Nicepay Dashboard ](https://bo.nicepay.co.id/)
- [SNAP documentation](http://snap-docs.Nicepay.com)
- Can't find answer you looking for? email to [cs@nicepay.co.id](mailto:cs@nicepay.co.id)







