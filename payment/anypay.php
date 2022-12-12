<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/Rcon.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/GMain.php');
$shop_id = $_REQUEST['merchant_id'];;
$pay_id = $_REQUEST['pay_id'];
$amount = $_REQUEST['amount'];
$price = explode('.', $amount);
$success_url = ANYSUCCESS;
$fail_url = ANYFAIL;
$secret_key = ANYSECRECT;
/*
$test = '';
foreach ($_REQUEST as $key => $value) {
   $test .= "$key=$value\n";
}
file_put_contents("./test",$test);
*/
$signatures = md5($shop_id.':'.$_REQUEST['amount'].':'.$_REQUEST['pay_id'].':'.$secret_key);
/* склейка всех параметров, как это положено делать из документации ANYPAY
Контрольня подпись
Формирование подписи производится путем склеивания параметров через ":" и создания контрольной суммы MD5.
*/

// ================================================================

function getIP() {
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) return $_SERVER['HTTP_CF_CONNECTING_IP'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    if (isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
    return $_SERVER['REMOTE_ADDR'];
}

if (!in_array(getIP(), ANYIPS)) die("hacking attempt!");

$sign = md5('RUB:'.$price[0].':'.$secret_key.':'.$shop_id.':'.$pay_id.'');
if ($signatures != $_REQUEST['sign']) {
    die('bad sign!');
}
// Оплата прошла успешно, можно проводить операцию и зачислять средства на баланс!
$base64query = $mysqli->query("SELECT * FROM `RD-ODERS` WHERE `name` = '$sign' LIMIT 1;");
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

