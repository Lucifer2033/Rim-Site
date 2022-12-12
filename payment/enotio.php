<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/Rcon.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/GMain.php');
$merchant = $_REQUEST['merchant']; // id вашего магазина
$secret_word1 = ENOTSECRECTONE; // секретный ключ 1
$secret_word2 = ENOTSECRECTTWO; // секретный ключ 2
$sign = md5($merchant.':'.$_REQUEST['amount'].':'.$secret_word2.':'.$_REQUEST['merchant_id']);
function getIP() {
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) return $_SERVER['HTTP_CF_CONNECTING_IP'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    if (isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
    return $_SERVER['REMOTE_ADDR'];
}

if (!in_array(getIP(), ENOTIPS)) {die("hacking attempt!");}

if ($sign != $_REQUEST['sign_2']) {
    die('bad sign!');
}
$amount = $_REQUEST['amount'];
$price = explode('.', $amount);
$signatest = md5($merchant.':'.$price[0].':'.$secret_word1.':'.$_REQUEST['merchant_id']);
$base64query = $mysqli->query("SELECT * FROM `RD-ODERS` WHERE `name` = '$signatest' LIMIT 1;");
$base64res = $base64query->fetch_assoc();
$bs64row = (string)$base64res['base64'];
$resultpayments = base64_decode($bs64row);
$rowresultpayments = explode(";", $resultpayments);
//file_put_contents('./sing_1', $sign);
//file_put_contents('./sing_2', $signatest);
//file_put_contents('./sing_3', $_REQUEST['sign_2']);
//file_put_contents('./order_id', $_REQUEST['merchant_id']);
if($rowresultpayments[7] != ""){
$mysqli->query("UPDATE `RD-PROMOCODE` SET `amount` = `amount` - 1 WHERE `name` = '$rowresultpayments[6]';");
}
rcon_payment($bs64row);
echo "Good";
?>