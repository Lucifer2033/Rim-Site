<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
date_default_timezone_set('Europe/Moscow');
$user_id = $_POST['nickname'];//ник
$sell_id = $_POST['selid'];//какой донат
$kassa = $_POST['kassa'];//какой способо оплаты
$idserver = $_POST['idserver'];//какой сервер был выбран
$promo = $_POST['promo'];//какой промо был взять
$serversresulte = $mysqli->query("SELECT * FROM `RD-RCONDATA` WHERE `id` = $idserver;");
$resserver = $serversresulte->fetch_assoc();
$nameserverrcon = (string)$resserver['server'];
$rddonresulte = $mysqli->query("SELECT * FROM `RD-DONAT` WHERE `server` REGEXP '$nameserverrcon' AND `id` = $sell_id;");
$rdonsres = $rddonresulte->fetch_assoc();
$lastdonatresulte = $mysqli->query("SELECT * FROM `RD-PAYMENT` WHERE `nick` = '$user_id' AND `server`REGEXP '$nameserverrcon' AND `give` = 1 ORDER BY `id` DESC LIMIT 1;");
$lastdonatres = $lastdonatresulte->fetch_assoc();
$ldstnd = (string)$lastdonatres['namedonat'];
$ldstcat = (string)$lastdonatres['category'];
$ldstcatprice = (string)$lastdonatres['price'];
$rdonatcheckpos = $mysqli->query("SELECT * FROM `RD-DONAT` WHERE `server` REGEXP '$nameserverrcon' AND `title` = '$ldstnd' AND `category` = '$ldstcat';");
$rdonatecheckposres = $rdonatcheckpos->fetch_assoc();
$rpromocodes = $mysqli->query("SELECT * FROM `RD-PROMOCODE` WHERE `name` = '$promo';");
$rdpromocodes = $rpromocodes->fetch_assoc();
$URLSITES = URLSITE;
if($rdonsres['pos'] <= $rdonatecheckposres['pos']&&$rdonsres['lockup'] == 1&&$rdonatecheckposres['lockup'] == 1){
$_SESSION['success_message'] = false;
$_SESSION['success_message_text']='"Ошибка","У вас и так высокий донат зачем ниже брать?"';
return header("Location: $URLSITES");
}
$pricedop = $rdonsres['price'];
if($rdonsres['doplata'] == 1&&$lastdonatres['price'] > 0){
$pricedop = $rdonsres['price']-$lastdonatres['price'];
}
if($promo == $rdpromocodes['name']){
$pricedop = $pricedop - ($pricedop * ($rdpromocodes['percent'] / 100));
}
$kassanames = array(
1 => 'FreeKassa',
2 => 'QIWI',
3 => 'AnyPay',
4 => 'FowPay',
5 => 'EnotIo'
);
$paramsarray = array(//получаю параметры заножу их в массив после шифруем 
$user_id,//0 ник
$rdonsres['id'],//1 айди доната
$rdonsres['command'],//2 команда
$rdonsres['server'],//3 название сервера
$rdonsres['category'],//4 категория 
$pricedop,//5 цена итоговая с учётом скидачного купона
$kassanames[$kassa],//6 какой платежка
$rdpromocodes['name']//7 какой промокод был взять
);
$timedays = date('d.m.Y H:i:s');
$paramshash = base64_encode(implode(';', $paramsarray));//шифрую параметры в base64
switch($kassa){
	case '1':
	$project_id = FPROCID;
	$amount = $pricedop;
	$currency = 'RUB';
	$desc = 'Покупка';
	$secret_key_1 = FSECRETKEY_1;
	$secret_key_2 = FSECRETKEY_2; 
	$api_key = FAPIKEY;
	$shasarr_sign = array(
	$project_id,
	$amount,
	$secret_key_1,
	$currency,
	$desc
	);
	$sign = md5(implode(':', $shasarr_sign));//создание сигнатуры Для ссылка
	$dwo_sign = array(
	$project_id,
	$amount,
	$secret_key_2,
	$desc
	);
	$dwosign = md5(implode(':', $dwo_sign));//создание сигны для бд 
	//фейк шифр для тех кто в ссылке решил вытащить параметры
	$fakaes =  "RwHasH;2033;_Lucifer_;rimworlda.ru;$paramshash;$sign;FREEKASSA;RW;HASH;HACKER;SOSUN";
	$twostepfakehash = hash('sha256', $fakaes);
	$titledonates = (string)$rdonsres['title'];
	$categorysdonates = (string)$rdonsres['category'];
	$nameservers = (string)$rdonsres['server'];
	//создаем в бд запись туда сигну и за шифрованные параметры base64
	$mysqli->query("INSERT INTO `RD-ODERS` (`id`, `name`, `base64`, `sha256`) VALUES (NULL, '$dwosign', '$paramshash', '$twostepfakehash');");
	$mysqli->query("INSERT INTO `RD-PAYMENT` (`id`, `nick`, `data`, `namedonat`, `category`, `price`, `server`, `give`, `base64`) VALUES (NULL, '$user_id', '$timedays', '$titledonates', '$categorysdonates', $pricedop, '$nameservers', 0, '$paramshash');");
	$url = "https://pay.freekassa.ru/?m=$project_id&oa=$amount&currency=$currency&o=$desc&s=$sign&us_field1=$twostepfakehash";
	header("Location: ".$url);
	break;
	case '2':
	require_once($_SERVER['DOCUMENT_ROOT'].'/payment/vendor/autoload.php');
	$billPayments = new Qiwi\Api\BillPayments(QSTOKEN);
	$billId = $billPayments->generateId();
	//фейк шифр для тех кто в ссылке решил вытащить параметры
	$fakaes =  "RwHasH;2033;_Lucifer_;rimworlda.ru;$paramshash;$billId;QIWI;RW;HASH;HACKER;SOSUN";
	$twostepfakehash = hash('sha256', $fakaes);
	$params = [
	'publicKey' => QTOKEN,
	'amount' => $pricedop,
	'billId' => $billId,
	'successUrl' => QSUCCESS,
	];
	$titledonates = (string)$rdonsres['title'];
	$categorysdonates = (string)$rdonsres['category'];
	$nameservers = (string)$rdonsres['server'];
	//создаем в бд запись туда сигну и за шифрованные параметры base64
	$mysqli->query("INSERT INTO `RD-ODERS` (`id`, `name`, `base64`, `sha256`) VALUES (NULL, '$billId', '$paramshash', '$twostepfakehash');");
	$mysqli->query("INSERT INTO `RD-PAYMENT` (`id`, `nick`, `data`, `namedonat`, `category`, `price`, `server`, `give`, `base64`) VALUES (NULL, '$user_id', '$timedays', '$titledonates', '$categorysdonates', $pricedop, '$nameservers', 0, '$paramshash');");
	$link = $billPayments->createPaymentForm($params);
	header("Location: ".$link);
	break;
	case '3':
	$shop_id = ANYID;
	$pay_id = rand(1, 999999);
	$amount = $pricedop;
	$desc = 'Покупка';
	$secret_key = ANYSECRECT;
	$sign = md5('RUB:'.$pricedop.':'.$secret_key.':'.$shop_id.':'.$pay_id.'');
	$fakaes =  "RwHasH;2033;_Lucifer_;rimworlda.ru;$paramshash;$sign;ANYPAY;RW;HASH;HACKER;SOSUN";
	$twostepfakehash = hash('sha256', $fakaes);
	$titledonates = (string)$rdonsres['title'];
	$categorysdonates = (string)$rdonsres['category'];
	$nameservers = (string)$rdonsres['server'];
	$mysqli->query("INSERT INTO `RD-ODERS` (`id`, `name`, `base64`, `sha256`) VALUES (NULL, '$sign', '$paramshash', '$twostepfakehash');");
	$mysqli->query("INSERT INTO `RD-PAYMENT` (`id`, `nick`, `data`, `namedonat`, `category`, `price`, `server`, `give`, `base64`) VALUES (NULL, '$user_id', '$timedays', '$titledonates', '$categorysdonates', $pricedop, '$nameservers', 0, '$paramshash');");
	$url = "https://anypay.io/merchant?merchant_id=$shop_id&amount=$amount&pay_id=$pay_id&desc=$desc&field1=$twostepfakehash&sign=$sign";
	header("Location: ".$url);
	break;
	case '4':
	$shop_id = FOWID;
	$secret = FOWSECRET;
	$order_id = rand(1, 999999);
	$order_amount = $pricedop;
	$sign = md5($shop_id.':'.$order_amount.':'.$secret.':'.$order_id); 
	$fakaes =  "RwHasH;2033;_Lucifer_;rimworlda.ru;$paramshash;$sign;FOWPAY;RW;HASH;HACKER;SOSUN";
	$twostepfakehash = hash('sha256', $fakaes);
	$titledonates = (string)$rdonsres['title'];
	$categorysdonates = (string)$rdonsres['category'];
	$nameservers = (string)$rdonsres['server'];
	$mysqli->query("INSERT INTO `RD-ODERS` (`id`, `name`, `base64`, `sha256`) VALUES (NULL, '$sign', '$paramshash', '$twostepfakehash');");
	$mysqli->query("INSERT INTO `RD-PAYMENT` (`id`, `nick`, `data`, `namedonat`, `category`, `price`, `server`, `give`, `base64`) VALUES (NULL, '$user_id', '$timedays', '$titledonates', '$categorysdonates', $pricedop, '$nameservers', 0, '$paramshash');");
	$url = "https://fowpay.com/pay?shop=$shop_id&amount=$order_amount&order=$order_id&sign=$sign";
	header("Location: ".$url);
	break;
	case '5':
	$shop_id = ENOTID;
	$secret = ENOTSECRECTONE;
	$order_id = $timedays;
	$order_amount = $pricedop;
	$sign = md5($shop_id.':'.$order_amount.':'.$secret.':'.$order_id); 
	$fakaes =  "RwHasH;2033;_Lucifer_;rimworlda.ru;$paramshash;$sign;ENOTIO-GOVNO;RW;HASH;HACKER;SOSUN";
	$twostepfakehash = hash('sha256', $fakaes);
	$titledonates = (string)$rdonsres['title'];
	$categorysdonates = (string)$rdonsres['category'];
	$nameservers = (string)$rdonsres['server'];
	$mysqli->query("INSERT INTO `RD-ODERS` (`id`, `name`, `base64`, `sha256`) VALUES (NULL, '$sign', '$paramshash', '$twostepfakehash');");
	$mysqli->query("INSERT INTO `RD-PAYMENT` (`id`, `nick`, `data`, `namedonat`, `category`, `price`, `server`, `give`, `base64`) VALUES (NULL, '$user_id', '$timedays', '$titledonates', '$categorysdonates', $pricedop, '$nameservers', 0, '$paramshash');");
	$url = "https://enot.io/pay?m=$shop_id&oa=$order_amount&o=$order_id&s=$sign";
	header("Location: ".$url);
	break;
    default:#на случий если найдется дебил который от ред HTML Код....
	$_SESSION['success_message'] = false;
	$_SESSION['success_message_text']='"Ошибка","нет времени объяснять суй ананас в жопу"';
    header("Location: $URLSITES");
    break;

}
?>