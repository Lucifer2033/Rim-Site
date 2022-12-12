<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/Rcon.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/GMain.php');
$secret = FOWSECRET;

function getIP() {
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) return $_SERVER['HTTP_CF_CONNECTING_IP'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    if (isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
    return $_SERVER['REMOTE_ADDR'];
}
if (!in_array(getIP(), json_decode(file_get_contents('https://fowpay.com/ips.json'), true))) {
    die("hacking attempt!");
}
$sign = md5($_REQUEST['SHOP_ID'].':'.$_REQUEST['AMOUNT'].':'.$secret.':'.$_REQUEST['ORDER_ID']);
if ($sign != $_REQUEST['SIGN']) {
    die("wrong sign");
}
$amount = $_REQUEST['AMOUNT'];
$price = explode('.', $amount);
$signatest = md5($_REQUEST['SHOP_ID'].':'.$price[0].':'.$secret.':'.$_REQUEST['ORDER_ID']); 
$base64query = $mysqli->query("SELECT * FROM `RD-ODERS` WHERE `name` = '$signatest' LIMIT 1;");
$base64res = $base64query->fetch_assoc();
$bs64row = (string)$base64res['base64'];
$resultpayments = base64_decode($bs64row);
$rowresultpayments = explode(";", $resultpayments);
if($rowresultpayments[7] != ""){
$mysqli->query("UPDATE `RD-PROMOCODE` SET `amount` = `amount` - 1 WHERE `name` = '$rowresultpayments[6]';");
}
rcon_payment($bs64row);

die('OK');
?>