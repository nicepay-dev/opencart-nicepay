<?php

use PHPUnit\Framework\TestCase;

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Nicepay\service\snap\Snap;
use Nicepay\common\{NICEPay, NicepayError};
use Nicepay\data\model\{AccessToken, VirtualAccount};
use Nicepay\utils\Helper;

use test\TestConst;

class NicepaySnapTest extends TestCase
{
    private $clientSecret;
    private $oldKeyFormat;

    protected function setUp(): void
    {
        $this->clientSecret = TestConst::$CLIENT_SECRET;
        $this->oldKeyFormat = TestConst::$KEY_OLD_FORMAT;
    }


    public function testRequestSnapAccessToken()
    {

        // Build the NICEPay config using the builder method
        $configBuilder = NICEPay::builder();
        $timestamp = Helper::getFormattedDate();
        $config = $configBuilder
            ->setIsProduction(false)
            ->setPrivateKey($this->oldKeyFormat)
            ->setClientSecret($this->clientSecret)
            ->setPartnerId(TestConst::$IMID_TEST)
            ->setExternalID("extId" . $timestamp)
            ->setTimestamp($timestamp)
            ->build();

        $tokenBody = AccessToken::builder()
            ->setGrantType('client_credentials')
            ->setAdditionalInfo([])
            ->build();

        $snap = new Snap($config);

        try {
            $response = $snap->requestSnapAccessToken($tokenBody);

            $this->assertEquals("2007300", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());


            $accessToken = $response->getAccessToken();

            // Store the access token for use in other tests or class properties
            $this->storeAccessToken($accessToken);
        } catch (NicepayError $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }
    }


    public function testRequestSnapTransaction()
    {
        // Access token should be stored or retrieved from storage
        $accessToken = $this->retrieveAccessToken();
        if ($accessToken === null || $accessToken === "") {
            $accessToken = self::getAccessToken();
        }

        $timestamp = Helper::getFormattedDate();
        $configBuilder = NICEPay::builder();
        $config = $configBuilder
            ->setIsProduction(false)
            ->setPrivateKey($this->oldKeyFormat)
            ->setClientSecret($this->clientSecret)
            ->setPartnerId(TestConst::$IMID_TEST)
            ->setExternalID("extId" . $timestamp)
            ->setTimestamp($timestamp)
            ->build();

        $virtualAccountBuilder = VirtualAccount::builder();
        $parameter = $virtualAccountBuilder
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

        $snap = new Snap($config);

        $endPoint = 'api/v1.0/transfer-va/create-va';

        try {
            $response = $snap->requestSnapTransaction($parameter, $endPoint, $accessToken, "POST");

            $this->assertEquals("2002700", $response->getResponseCode());
            $this->assertEquals("Successful", $response->getResponseMessage());
            // Add more assertions as needed for specific response properties
        } catch (NicepayError $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }
    }

    private function getAccessToken(): string
    {

        $configBuilder = NICEPay::builder();
        $timestamp = Helper::getFormattedDate();
        $config = $configBuilder
            ->setIsProduction(false)
            ->setPrivateKey($this->oldKeyFormat)
            ->setClientSecret(clientSecret: $this->clientSecret)
            ->setPartnerId(TestConst::$IMID_TEST)
            ->setExternalID("extId" . $timestamp)
            ->setTimestamp($timestamp)
            ->build();

        $tokenBody = AccessToken::builder()
            ->setGrantType('client_credentials')
            ->setAdditionalInfo([])
            ->build();

        $snap = new Snap($config);

        try {
            $response = $snap->requestSnapAccessToken($tokenBody);
            $accessToken = $response->getAccessToken();


            $this->storeAccessToken($accessToken);
        } catch (NicepayError $e) {
            $this->fail("Exception thrown: " . $e->getMessage());
        }
        return $accessToken;
    }

    /**
     * Stores the access token for use in subsequent tests or class properties
     * @param string $accessToken - The access token to store
     */
    private function storeAccessToken($accessToken)
    {
        // You can store it in a class property or session storage
        // Example: $this->accessToken = $accessToken;
        // For simplicity, storing in session for this example
        $_SESSION['accessToken'] = $accessToken;
    }

    /**
     * Retrieves the access token stored from previous test
     * @return string - The stored access token
     */
    private function retrieveAccessToken()
    {
        // Retrieve the access token stored in session
        return $_SESSION['accessToken'] ?? '';
    }
}
