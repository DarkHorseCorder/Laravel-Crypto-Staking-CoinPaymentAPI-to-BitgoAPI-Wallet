<?php

namespace App\Traits;

use App\Models\PaymentGateway;


trait Paytm {

        public function getPaymentData(){
            $data = PaymentGateway::whereKeyword('paytm')->first();
            return $data->convertAutoData();
        }

	    public function handlePaytmRequest( $order_id, $amount, $type ) {

            $paydata = self::getPaymentData();
    
            // Load all functions of encdec_paytm.php and config-paytm.php
            self::getAllEncdecFunc();
            // $this->getConfigPaytmSettings();
            $checkSum = "";
            $paramList = array();
            // Create an array having all required parameters for creating checksum.
            $paramList["MID"] = $paydata['merchant'];
            $paramList["ORDER_ID"] = $order_id;
            $paramList["CUST_ID"] = $order_id;
            $paramList["INDUSTRY_TYPE_ID"] = $paydata['industry'];
            $paramList["CHANNEL_ID"] = 'WEB';
            $paramList["TXN_AMOUNT"] = $amount;
            $paramList["WEBSITE"] = $paydata['website'];
            if($type == 'checkout'){
                $paramList["CALLBACK_URL"] = route('front.paytm.notify');
            }else if($type == 'subscription'){
                $paramList["CALLBACK_URL"] = route('user.paytm.notify');
            }else if($type == 'deposit'){
                $paramList["CALLBACK_URL"] = route('paytm.notify');
            }

            $paytm_merchant_key = $paydata['secret'];
            //Here checksum string will return by getChecksumFromArray() function.
            $checkSum = getChecksumFromArray( $paramList, $paytm_merchant_key );
            return array(
                'checkSum' => $checkSum,
                'paramList' => $paramList
            );
        }
    
        function getAllEncdecFunc() {
            function encrypt_e($input, $ky) {
                $key   = html_entity_decode($ky);
                $iv = "@@@@&&&&####$$$$";
                $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
                return $data;
            }
            function decrypt_e($crypt, $ky) {
                $key   = html_entity_decode($ky);
                $iv = "@@@@&&&&####$$$$";
                $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
                return $data;
            }
            function pkcs5_pad_e($text, $blocksize) {
                $pad = $blocksize - (strlen($text) % $blocksize);
                return $text . str_repeat(chr($pad), $pad);
            }
            function pkcs5_unpad_e($text) {
                $pad = ord($text(strlen($text) - 1));
                if ($pad > strlen($text))
                    return false;
                return substr($text, 0, -1 * $pad);
            }
            function generateSalt_e($length) {
                $random = "";
                srand((double) microtime() * 1000000);
                $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
                $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
                $data .= "0FGH45OP89";
                for ($i = 0; $i < $length; $i++) {
                    $random .= substr($data, (rand() % (strlen($data))), 1);
                }
                return $random;
            }
            function checkString_e($value) {
                if ($value == 'null')
                    $value = '';
                return $value;
            }
            function getChecksumFromArray($arrayList, $key, $sort=1) {
                if ($sort != 0) {
                    ksort($arrayList);
                }
                $str = getArray2Str($arrayList);
                $salt = generateSalt_e(4);
                $finalString = $str . "|" . $salt;
                $hash = hash("sha256", $finalString);
                $hashString = $hash . $salt;
                $checksum = encrypt_e($hashString, $key);
                return $checksum;
            }
            function getChecksumFromString($str, $key) {
                $salt = generateSalt_e(4);
                $finalString = $str . "|" . $salt;
                $hash = hash("sha256", $finalString);
                $hashString = $hash . $salt;
                $checksum = encrypt_e($hashString, $key);
                return $checksum;
            }
            function verifychecksum_e($arrayList, $key, $checksumvalue) {
                $arrayList = removeCheckSumParam($arrayList);
                ksort($arrayList);
                $str = getArray2StrForVerify($arrayList);
                $paytm_hash = decrypt_e($checksumvalue, $key);
                $salt = substr($paytm_hash, -4);
                $finalString = $str . "|" . $salt;
                $website_hash = hash("sha256", $finalString);
                $website_hash .= $salt;
                $validFlag = "FALSE";
                if ($website_hash == $paytm_hash) {
                    $validFlag = "TRUE";
                } else {
                    $validFlag = "FALSE";
                }
                return $validFlag;
            }
            function verifychecksum_eFromStr($str, $key, $checksumvalue) {
                $paytm_hash = decrypt_e($checksumvalue, $key);
                $salt = substr($paytm_hash, -4);
                $finalString = $str . "|" . $salt;
                $website_hash = hash("sha256", $finalString);
                $website_hash .= $salt;
                $validFlag = "FALSE";
                if ($website_hash == $paytm_hash) {
                    $validFlag = "TRUE";
                } else {
                    $validFlag = "FALSE";
                }
                return $validFlag;
            }
            function getArray2Str($arrayList) {
                $findme   = 'REFUND';
                $findmepipe = '|';
                $paramStr = "";
                $flag = 1;
                foreach ($arrayList as $key => $value) {
                    $pos = strpos($value, $findme);
                    $pospipe = strpos($value, $findmepipe);
                    if ($pos !== false || $pospipe !== false)
                    {
                        continue;
                    }
                    if ($flag) {
                        $paramStr .= checkString_e($value);
                        $flag = 0;
                    } else {
                        $paramStr .= "|" . checkString_e($value);
                    }
                }
                return $paramStr;
            }
            function getArray2StrForVerify($arrayList) {
                $paramStr = "";
                $flag = 1;
                foreach ($arrayList as $key => $value) {
                    if ($flag) {
                        $paramStr .= checkString_e($value);
                        $flag = 0;
                    } else {
                        $paramStr .= "|" . checkString_e($value);
                    }
                }
                return $paramStr;
            }
            function redirect2PG($paramList, $key) {
                $hashString = getchecksumFromArray($paramList, $key);
                $checksum = encrypt_e($hashString, $key);
            }
            function removeCheckSumParam($arrayList) {
                if (isset($arrayList["CHECKSUMHASH"])) {
                    unset($arrayList["CHECKSUMHASH"]);
                }
                return $arrayList;
            }
            function getTxnStatus($requestParamList) {
                return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
            }
            function getTxnStatusNew($requestParamList) {
                return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
            }
            function initiateTxnRefund($requestParamList) {
                $CHECKSUM = getRefundChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
                $requestParamList["CHECKSUM"] = $CHECKSUM;
                return callAPI(PAYTM_REFUND_URL, $requestParamList);
            }
            function callAPI($apiURL, $requestParamList) {
                $jsonResponse = "";
                $responseParamList = array();
                $JsonData =json_encode($requestParamList);
                $postData = 'JsonData='.urlencode($JsonData);
                $ch = curl_init($apiURL);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($postData))
                );
                $jsonResponse = curl_exec($ch);
                $responseParamList = json_decode($jsonResponse,true);
                return $responseParamList;
            }
            function callNewAPI($apiURL, $requestParamList) {
                $jsonResponse = "";
                $responseParamList = array();
                $JsonData =json_encode($requestParamList);
                $postData = 'JsonData='.urlencode($JsonData);
                $ch = curl_init($apiURL);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($postData))
                );
                $jsonResponse = curl_exec($ch);
                $responseParamList = json_decode($jsonResponse,true);
                return $responseParamList;
            }
            function getRefundChecksumFromArray($arrayList, $key, $sort=1) {
                if ($sort != 0) {
                    ksort($arrayList);
                }
                $str = getRefundArray2Str($arrayList);
                $salt = generateSalt_e(4);
                $finalString = $str . "|" . $salt;
                $hash = hash("sha256", $finalString);
                $hashString = $hash . $salt;
                $checksum = encrypt_e($hashString, $key);
                return $checksum;
            }
            function getRefundArray2Str($arrayList) {
                $findmepipe = '|';
                $paramStr = "";
                $flag = 1;
                foreach ($arrayList as $key => $value) {
                    $pospipe = strpos($value, $findmepipe);
                    if ($pospipe !== false)
                    {
                        continue;
                    }
                    if ($flag) {
                        $paramStr .= checkString_e($value);
                        $flag = 0;
                    } else {
                        $paramStr .= "|" . checkString_e($value);
                    }
                }
                return $paramStr;
            }
            function callRefundAPI($refundApiURL, $requestParamList) {
                $jsonResponse = "";
                $responseParamList = array();
                $JsonData =json_encode($requestParamList);
                $postData = 'JsonData='.urlencode($JsonData);
                $ch = curl_init($apiURL);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_URL, $refundApiURL);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $jsonResponse = curl_exec($ch);
                $responseParamList = json_decode($jsonResponse,true);
                return $responseParamList;
            }
        }
        /**
         * Config Paytm Settings from config_paytm.php file of paytm kit
         */
        function getConfigPaytmSettings() {
            $paydata = $this->getPaymentData();
        
            if ($paydata['sandbox_check'] == 1) {
            define('PAYTM_ENVIRONMENT', 'TEST'); // SANDBOX
            } else {
            define('PAYTM_ENVIRONMENT', 'PROD'); // PRODUCTION
            }
    
            define('PAYTM_MERCHANT_KEY', $paydata['secret']); //Change this constant's value with Merchant key downloaded from portal
            define('PAYTM_MERCHANT_MID', $paydata['merchant']); //Change this constant's value with MID (Merchant ID) received from Paytm
            define('PAYTM_MERCHANT_WEBSITE', $paydata['website']); //Change this constant's value with Website name received from Paytm
            $PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
            $PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
            if (PAYTM_ENVIRONMENT == 'PROD') {
                $PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
                $PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
            }
            define('PAYTM_REFUND_URL', '');
            define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
            define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
            define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
        }
}