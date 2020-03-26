<?php 
/**
 * Openpay API v1 Client for PHP (version 1.0.0)
 * 
 * Copyright © Openpay SAPI de C.V. All rights reserved.
 * http://www.openpay.mx/
 * soporte@openpay.mx
 */

if (!function_exists('curl_init')) {
	throw new Exception('CURL PHP extension is required to run Openpay client.');
}
if (!function_exists('json_decode')) {
	throw new Exception('JSON PHP extension is required to run Openpay client.');
}
if (!function_exists('mb_detect_encoding')) {
	throw new Exception('Multibyte String PHP extension is required to run Openpay client.');
}

require(dirname(__FILE__) . '/Openpay/data/OpenpayApiError.php');
require(dirname(__FILE__) . '/Openpay/data/OpenpayApiConsole.php');
require(dirname(__FILE__) . '/Openpay/data/OpenpayApiResourceBase.php');
require(dirname(__FILE__) . '/Openpay/data/OpenpayApiConnector.php');
require(dirname(__FILE__) . '/Openpay/data/OpenpayApiDerivedResource.php');
require(dirname(__FILE__) . '/Openpay/data/OpenpayApi.php');

require(dirname(__FILE__) . '/Openpay/resources/OpenpayBankAccount.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayCapture.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayCard.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayCharge.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayCustomer.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayFee.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayPayout.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayPlan.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayRefund.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpaySubscription.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayTransfer.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayWebhook.php');
require(dirname(__FILE__) . '/Openpay/resources/OpenpayToken.php');
?>