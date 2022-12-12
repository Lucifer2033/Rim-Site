<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/payment/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/Rcon.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/GMain.php');
$secretKey = QSTOKEN;

$billPayments = new Qiwi\Api\BillPayments($secretKey);

//получем тело ответа

$postbody = json_decode(file_get_contents('php://input'),true);

$notificationData = [
    'bill' => [
      'siteId' => $postbody['bill']['siteId'],
      'billId' => $postbody['bill']['billId'],
      'amount' => ['value' => $postbody['bill']['amount']['value'], 'currency' => 'RUB'],
      'status' => ['value' => $postbody['bill']['status']['value']]
    ],
    'version' => $postbody['version']
];

//получем заголовки ответа
$headers = apache_request_headers();

$validSignatureFromNotificationServer = $headers['X-Api-Signature-Sha256'];

$checksigna = $billPayments->checkNotificationSignature($validSignatureFromNotificationServer,$notificationData,$secretKey);

if($checksigna != true){die('Bad Sign');}

$billIds = $postbody['bill']['billId'];
$base64query = $mysqli->query("SELECT * FROM `RD-ODERS` WHERE `name` = '$billIds' LIMIT 1;");
$base64res = $base64query->fetch_assoc();
$bs64row = (string)$base64res['base64'];
$resultpayments = base64_decode($bs64row);
$rowresultpayments = explode(";", $resultpayments);

if($rowresultpayments[7] != ""){
$mysqli->query("UPDATE `RD-PROMOCODE` SET `amount` = `amount` - 1 WHERE `name` = '$rowresultpayments[6]';");
}


rcon_payment($bs64row);

header("HTTP/1.1 200 OK");

?>