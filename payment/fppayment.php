<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/Rcon.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/GMain.php');
date_default_timezone_set('Europe/Moscow');
$project_id = $_REQUEST['MERCHANT_ID'];
$amount = $_REQUEST['AMOUNT'];
$currency = $_REQUEST['CUR_ID'];
$desc = $_REQUEST['MERCHANT_ORDER_ID'];
$params = $_REQUEST['us_field1'];
$secret_key_2 = FSECRETKEY_2; 
$api_key = FAPIKEY;
$ssign = $_REQUEST['SIGN'];

$shasarr_sign = array(
$project_id,
$amount,
$secret_key_2,
$desc
);

function getIP() {
  if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) return $_SERVER['HTTP_CF_CONNECTING_IP'];
  if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
  if (isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
  return $_SERVER['REMOTE_ADDR'];
}

if (!in_array(getIP(), FIPS)) die("hacking attempt!");

$sign = md5(implode(':', $shasarr_sign));
if ($sign != $ssign) {
    die('BAD SIGN!');
}

$base64query = $mysqli->query("SELECT * FROM `RD-ODERS` WHERE `name` = '$ssign' LIMIT 1;");
$base64res = $base64query->fetch_assoc();
$bs64row = (string)$base64res['base64'];
$resultpayments = base64_decode($bs64row);
$rowresultpayments = explode(";", $resultpayments);

if($rowresultpayments[7] != ""){
$mysqli->query("UPDATE `RD-PROMOCODE` SET `amount` = `amount` - 1 WHERE `name` = '$rowresultpayments[6]';");
}

rcon_payment($bs64row);

echo "YES";

?>