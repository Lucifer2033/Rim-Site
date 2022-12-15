<?php

@session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
$URLSITES = URLSITE;
if(empty($_SESSION["authenticated"]) || $_SESSION["authenticated"] != 'true') {
    header('Location: '.$URLSITES.'admin/login.php');

}
//доп защита в случае если как то можно подменять $_SESSION
if($_SESSION["authenticated"] == 'true'&&$_SESSION["authenticated_logins"]&&$_SESSION["authenticated_password"]){
	$username = $_SESSION["authenticated_logins"];
	$password = $_SESSION["authenticated_password"];
	require_once($_SERVER['DOCUMENT_ROOT'].'/engine/mysql.php');
	$checkauthtest = $mysqli->query("SELECT * FROM `RD-ADMIN` WHERE `login` = '$username' AND `password` = '$password';");
	$checkauthresult = $checkauthtest->fetch_assoc();
	if($checkauthresult['error'] >= 3){
	unset($_SESSION["authenticated"]);
	unset($_SESSION["authenticated_logins"]);
	unset($_SESSION["authenticated_password"]);
	header('Location: '.$URLSITES.'admin/login.php');
	}
	if($checkauthresult['error'] < 3&&$checkauthresult['login'] == $username && $checkauthresult['password'] != $password){
	$mysqli->query("UPDATE `RD-ADMIN` SET `error` = `error` + 1 WHERE `login` = '$username';");
	unset($_SESSION["authenticated"]);
	unset($_SESSION["authenticated_logins"]);
	unset($_SESSION["authenticated_password"]);
	header('Location:'.$URLSITES.'admin/login.php');
	}
} else {
unset($_SESSION["authenticated"]);
unset($_SESSION["authenticated_logins"]);
unset($_SESSION["authenticated_password"]);
header('Location: '.$URLSITES.'admin/login.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/mysql.php");
$modeadm = $_POST["modeapi"];
switch ($modeadm) {
	case 'category_add':
	$titlecategory = $_POST['title'];
	$poscategory = $_POST['priority'];
	$mysqli->query("INSERT INTO `RD-CATEGORY` (`id`, `title`, `pos`, `server`) VALUES (NULL, '$titlecategory', '$poscategory', 'Site by vk.com/lucifer2033');");
	break;
	case 'category_edit':
	$ids = $_POST['idse'];
	$titlecategory = $_POST['title'];
	$poscategory = $_POST['priority'];
	$mysqli->query("UPDATE `RD-CATEGORY` SET `title` = '$titlecategory', `pos` = '$poscategory' WHERE `RD-CATEGORY`.`id` = $ids;");
	break;
	case 'rcon_add':
	$ids = $_POST['idse'];
    $ipserver = $_POST['servip'];
    $portserver = $_POST['servport'];
    $rconportserver = $_POST['servrconport'];
    $passwordserver = $_POST['servpassword'];
    $nameserver = $_POST['servname'];
	$statusserver = $_POST['status'];
	$mysqli->query("INSERT INTO `RD-RCONDATA` (`id`, `ip`, `port`, `rconport`, `password`, `server`, `status`) VALUES (NULL, '$ipserver', $portserver, $rconportserver, '$passwordserver', '$nameserver', $statusserver);");
	break;
	case 'rcon_edit':
	$ids = $_POST['idse'];
    $ipserver = $_POST['servip'];
    $portserver = $_POST['servport'];
    $rconportserver = $_POST['servrconport'];
    $passwordserver = $_POST['servpassword'];
    $nameserver = $_POST['servname'];
	$statusserver = $_POST['status'];
	$mysqli->query("UPDATE `RD-RCONDATA` SET `ip` = '$ipserver', `port` = $portserver, `rconport` = $rconportserver, `password` = '$passwordserver', `server` = '$nameserver', `status` = $statusserver WHERE `id` = $ids;");
	break;
	case 'goods_add':
	$titledonate = $_POST['name'];
    $pricedonate = $_POST['cost'];
    $posdonate = $_POST['priority'];
    $doplatadonate = $_POST['dobuy'];
    $categorydonate = $_POST['cat'];
    $serversdonate = $_POST['server'];
    $lockdonate = $_POST['zapret'];
	$amountse = $_POST['counts'];
	$commanddonate = $_POST['command'];
	$lenght = array_values($commanddonate);
	$lenghtserver = array_values($serversdonate);
	$cmdsborka = "";
	$serverarrays = "";
	for ($key=0; $key < count($lenght); $key++) {
	$cmdsborka .= "$lenght[$key]&&";
	}
	for ($key=0; $key < count($lenghtserver); $key++) {
	$serverarrays .= "$lenghtserver[$key]&&";
	}
	$cmdsborka = mb_substr($cmdsborka, 0, -2);
	$cmdsborka = preg_replace('/"/i', '&quot;', $cmdsborka);
	$serverarrays = mb_substr($serverarrays, 0, -2);
	if(!$serversdonate[1]){$serverarrays = $serversdonate[0];}
	$mysqli->query("INSERT INTO `RD-DONAT` (`id`, `title`, `price`, `command`, `doplata`, `pos`, `category`, `server`, `lockup`, `amount`) VALUES (NULL, '$titledonate', $pricedonate, '$cmdsborka', $doplatadonate, $posdonate, '$categorydonate', '$serverarrays', $lockdonate, '$amountse');");
	break;
	case 'goods_edit':
	$ids = $_POST['idse'];
	$titledonate = $_POST['name'];
	$pricedonate = $_POST['cost'];
	$posdonate = $_POST['priority'];
	$doplatadonate = $_POST['dobuy'];
	$categorydonate = $_POST['cat'];
	$serversdonate = $_POST['server'];
	$lockdonate = $_POST['zapret'];
	$amountse = $_POST['counts'];
	$commanddonate = $_POST['command'];
	$lenght = array_values($commanddonate);
	$lenghtserver = array_values($serversdonate);
	$cmdsborka = "";
	$serverarrays = "";
	for ($key=0; $key < count($lenght); $key++) {
	$cmdsborka .= "$lenght[$key]&&";
	}
	for ($key=0; $key < count($lenghtserver); $key++) {
	$serverarrays .= "$lenghtserver[$key]&&";
	}
	$cmdsborka = mb_substr($cmdsborka, 0, -2);
	$cmdsborka = preg_replace('/"/i', '&quot;', $cmdsborka);
	$serverarrays = mb_substr($serverarrays, 0, -2);
	if(!$serversdonate[1]){$serverarrays = $serversdonate[0];}
	//var_dump($cmdsborka);
	$mysqli->query("UPDATE `RD-DONAT` SET `title` = '$titledonate', `price` = $pricedonate, `command` = '$cmdsborka' , `doplata` = $doplatadonate, `pos` = $posdonate, `category` = '$categorydonate', `server` = '$serverarrays', `lockup` = $lockdonate, `amount` = '$amountse' WHERE `id` = $ids;");
	break;
	case 'cupons_add':
	$namepromo = $_POST['name'];
    $percentpromo = $_POST['summ'];
    $amountpromo = $_POST['count'];
    $mysqli->query("INSERT INTO `RD-PROMOCODE` (`id`, `name`, `percent`, `amount`) VALUES (NULL, '$namepromo', $percentpromo, $amountpromo);");
	break;
	case 'cupons_edit':
	$ids = $_POST['idse'];
	$namepromo = $_POST['name'];
	$percentpromo = $_POST['summ'];
	$amountpromo = $_POST['count'];
	$mysqli->query("UPDATE `RD-PROMOCODE` SET `name` = '$namepromo', `percent` = $percentpromo, `amount` = $amountpromo WHERE `RD-PROMOCODE`.`id` = $ids;");
	break;
	case 'users_add':
	$login = $_POST['login'];
	$password = $_POST['password'];
	$mysqli->query("INSERT INTO `RD-ADMIN` (`id`, `login`, `password`, `error`, `ip`) VALUES (NULL, '$login', '$password', '0', '0');");
	break;
	case 'users_edit':
	$ids = $_POST['idse'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$mysqli->query("UPDATE `RD-ADMIN` SET `login` = '$login', `password` = '$password' WHERE `RD-ADMIN`.`id` = $ids;");
	break;
	case 'links_add':
	$name = $_POST['name'];
	$link = $_POST['link'];
	$head = $_POST['head'];
	$footer = $_POST['footer'];
	$pos = $_POST['pos'];
	$mysqli->query("INSERT INTO `RD-SILKA` (`id`, `silka`, `header`, `footer`, `name`, `pos`) VALUES (NULL, '$link', $head, $footer, '$name', $pos);");
	break;
	case 'links_edit':
	$ids = $_POST['idse'];
	$name = $_POST['name'];
	$link = $_POST['link'];
	$head = $_POST['head'];
	$footer = $_POST['footer'];
	$pos = $_POST['pos'];
	$mysqli->query("UPDATE `RD-SILKA` SET `silka` = '$link', `header` = $head, `footer` = $footer, `name` = '$name', `pos` = $pos WHERE `RD-SILKA`.`id` = $ids;");
	break;
	case 'pages_add':
	$ids = $_POST['idse'];
	$name = $_POST['name'];
	$title = $_POST['title'];
	$ckeditor = $_POST['editoradverts_text_1'];
	$mysqli->query("INSERT INTO `RD-PAGES` (`id`, `idname`, `name`, `text`) VALUES (NULL, '$name', '$title', '$ckeditor');");
	break;
	case 'pages_edit':
	$ids = $_POST['idse'];
	$name = $_POST['name'];
	$title = $_POST['title'];
	$ckeditor = $_POST['editoradverts_text_1'];
	$mysqli->query("UPDATE `RD-PAGES` SET `idname` = '$name', `name` = '$title', `text` = '$ckeditor' WHERE `RD-PAGES`.`id` = $ids;");
	break;
	case 'advert_edit':
	$title = $_POST['title'];
	$text = $_POST['editoradverts_text_1'];
	$pattern = '/[^\p{Cyrillic}\p{Latin}\p{Common}\w\s]/mui';
	$check = preg_replace($pattern, '', $text);
	$json = file_get_contents('advert.json');
	$json = json_decode($json, true);
	$json['name'] = $title;
	$json['text'] = $check;
	if($_POST['adv']){
	$json['status'] = "checked";
	}else{
	$json['status'] = " ";
	}
	$newJsonString = json_encode($json);
	file_put_contents('advert.json', $newJsonString);
	break;
}
}
if($_SERVER['REQUEST_METHOD'] == 'GET'&&!$_GET["mode"]){header('Location: '.$URLSITES.'admin/cpanel.php?mode=info');}
?>
<!DOCTYPE html>
<html lang="ru" class="perfect-scrollbar-on"><head>
<meta charset="utf-8">
<title>RimWorld - ПУ</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta name="viewport" content="width=device-width">
<meta name="mobile-web-app-capable" content="yes">
<link href="../style/css/bootstrap.min.css" rel="stylesheet">
<link href="../style/css/material-dashboard.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
</head>
<body>
<nav class="navbar navbar-transparent navbar-absolute">
<div class="container-fluid">
	
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse">
<span class="sr-only">Открыть меню</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="material-icons">person</i>
<p class="hidden-lg hidden-md">
Пользователь
<b class="caret"></b>
</p>
</a>
<ul class="dropdown-menu">
<li>
<a href="?mode=logout">Выйти</a>
</li>
</ul>
</li>
<li class="separator hidden-lg hidden-md"></li>
</ul>
</div>
</div>
</nav>
<div class="wrapper">
<div class="sidebar" data-active-color="red" data-background-color="black">
<div class="logo">
<a href="./index.php" rel="tooltip" data-placement="bottom" class="simple-text" data-original-title="Перейти на сайт">
RW </a>
</div>
<div class="sidebar-wrapper ps-container ps-theme-default" data-ps-id="c14f8f2d-aed8-7bca-d773-56a4ac4c74bf">

<ul class="nav">
<li class="<?php if($_REQUEST["mode"] == 'info'){echo "active";}?>">
<a href="?mode=info">
<i class="material-icons">dashboard</i>
<p>Информация</p>
</a>
</li>
<li class="<?php if($_REQUEST["mode"] == 'category'){echo "active";}?>">
<a href="?mode=category">
<i class="material-icons">category</i>
<p>Категории</p>
</a>
</li>
<li>
</li><li class="<?php if($_REQUEST["mode"] == 'goods'){echo "active";}?>">
<a href="?mode=goods">
<i class="material-icons">reorder</i>
<p>Товары</p>
</a>
</li>
<li class="<?php if($_REQUEST["mode"] == 'cupons'){echo "active";}?>">
<a href="?mode=cupons">
<i class="material-icons">card_giftcard</i>
<p>Купоны</p>
</a>
</li>
<li class="<?php if($_REQUEST["mode"] == 'rcon'){echo "active";}?>">
<a href="?mode=rcon">
<i class="material-icons">developer_board</i>
<p>RCON Данные</p>
</a>
</li>
<li class="<?php if($_REQUEST["mode"] == 'users'){echo "active";}?>">
<a href="?mode=users">
<i class="material-icons">account_circle</i>
<p>Пользователи</p>
</a>
</li>
<li class="<?php if($_REQUEST["mode"] == 'advert'){echo "active";}?>">
<a href="?mode=advert">
<i class="material-icons">rss_feed</i>
<p>Объявление</p>
</a>
</li>
<li class="<?php if($_REQUEST["mode"] == 'links'){echo "active";}?>">
<a href="?mode=links">
<i class="material-icons">receipt</i>
<p>Настройки ссылок</p>
</a>
</li>
<li class="<?php if($_REQUEST["mode"] == 'pages'){echo "active";}?>">
<a href="?mode=pages">
<i class="material-icons">pages</i>
<p>Страницы</p>
</a>
</li>
<li class="<?php if($_REQUEST["mode"] == 'payments'){echo "active";}?>">
<a href="?mode=payments">
<i class="material-icons">receipt</i>
<p>Платежи</p>
</a>
</li>
</ul>

<!--начало-->
<?php
@session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/info.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/cate.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/don.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/cup.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/serv.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/user.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/silki.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/advert.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/stranica.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/admin/pays.php');
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/GMain.php");
$doadm ="bs";
if(isset($_REQUEST['do'])){
$doadm = (string)$_REQUEST['do'];
}
switch ($_REQUEST["mode"]) {
	//начало информации
	case 'info':
		echo "$infoadm_one";
		echo "$infoadm_two";
	break;
	//конец информации
	//начало платижей
	case 'payments':
	switch ($doadm) {
		case 'view':
		if($_REQUEST['id']&&$_REQUEST['id'] > 0){
		$ids = $_REQUEST['id'];
		$payview = $items['payment_view_'.$ids.''];
		echo "$pays_one_view";
		echo "$payview";
		echo "$pays_two_view";
		}else {
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=payments";</script>';
		}
		break;
		case 'apay':
		if($_REQUEST['id']&&$_REQUEST['id'] > 0){
		$ids = $_REQUEST['id'];
		$admpokupki = $mysqli->query("SELECT * FROM `RD-PAYMENT` WHERE `id` = $ids;");
		$result = $admpokupki->fetch_assoc();
		$id = (string)$result['id'];
		$nick = (string)$result['nick'];
		$dates = (string)$result['data'];
		$ldonat = (string)$result['namedonat'];
		$price = (string)$result['price'];
		$give = (string)$result['give'];
		$server = (string)$result['server'];
		$base64 = (string)$result['base64'];
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=payments&do=view&id='.$ids.'";</script>';
		rcon_payment($base64);
		}else {
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=payments";</script>';
		}
		break;
		default:
		echo "$pays_one";
		if(empty($items['lastdonateadmins'])) {
		echo "<p>Как-то Пусто</p>";
		}
		echo $items['lastdonateadmins'];
		echo "$pays_two";
		echo $items['listadminpaymets'];
		echo "$pays_three";
		break;
	}
	break;
	//конец платежей
	//начало страниц
	case 'pages':
	switch ($doadm) {
		case 'add':
		echo "$stranicaadmaddone";
		break;
		case 'edit':
		if($_REQUEST['id']&&$_REQUEST['id'] > 0){
		$editid = $_REQUEST['id'];
		$formspages = $itemsamdcate["pages_edit=$editid=form"];
		echo "$stranicaadmeditone";
		echo "$formspages";
		echo "$stranicaadmedittwo";
		}else {
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=pages";</script>';
		}
		break;
		case 'delete':
		if($_REQUEST['id']&&$_REQUEST['id'] > 0){
		$deleteselectcategory = $_REQUEST['id'];
		$mysqli->query("DELETE FROM `RD-PAGES` WHERE `id` = $deleteselectcategory;");
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=pages";</script>';
		}else {
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=pages";</script>';
		}
		break;
		default:
		$viewspageadm = $itemsamdcate["pages_view_adm"];
		echo "$stranicaadmone";
		echo "$viewspageadm";
		echo "$stranicaadmtwo";
		break;
	}
	break;
	//конец страниц
	//начало обьявлений
	case 'advert':
		$ourData = file_get_contents("advert.json");
		$array = json_decode($ourData, true);
		echo "$advertdmoneedit";
		echo '<input type="text" id="title" name="title" class="form-control" value="'.$array['name'].'" required>';
		echo "$advertdmtwoedit";
		echo $array['text'];
		echo "$advertdmthreeedit";
		echo '
		<div class="form-group is-focused">
		<div class="togglebutton">
		<label>
		<input type="checkbox" id="adv" name="adv" '.$array['status'].'>
		Отображать объявление на странице?
		</label>
		</div>
		</div>';
		echo "$advertdmfouredit";
	break;
	//конец обьявлений
	//начало выхода
	case 'logout':
	unset($_SESSION["authenticated"]);
	unset($_SESSION["authenticated_logins"]);
	unset($_SESSION["authenticated_password"]);
	header('Location: '.$URLSITES.'admin/login.php');
	break;
	//конец выхода
	//начало ссылок
	case 'links':
	switch ($doadm) {
		case 'add':
		echo "$silkaadmaddone";
		break;
		case 'edit':
		if($_REQUEST['id']&&$_REQUEST['id'] > 0){
		$editid = $_REQUEST['id'];
		$editorone = $itemsamdcate["links_edit=$editid=chapter_1=form"];
		$editorhead = $itemsamdcate["links_edit=$editid=chapter_1=head"];
		$editortwo = $itemsamdcate["links_edit=$editid=chapter_2=form"];
		$edditorfooter = $itemsamdcate["links_edit=$editid=chapter_2=footer"];
		$editorthree = $itemsamdcate["links_edit=$editid=chapter_3=form"];
		echo "$silkaadmeditone";
		echo "$editorone";
		echo "$editorhead";
		echo "$editortwo";
		echo "$edditorfooter";
		echo "$editorthree";
		echo "$silkaadmedittwo";
		}else {
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=links";</script>';
		}
		break;
		case 'delete':
		if($_REQUEST['id']&&$_REQUEST['id'] > 0){
		$deleteselectcategory = $_REQUEST['id'];
		$mysqli->query("DELETE FROM `RD-SILKA` WHERE `id` = $deleteselectcategory;");
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=links";</script>';
		}else {
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=links";</script>';
		}
		break;
		default:
		echo "$silkaadmone";
		echo $items['silkaadmlist'];
		echo "$silkaadmtwo";
		break;
	}
	break;
	//конец ссылок
	//начало пользователей панели
	case 'users':
	switch ($doadm) {
		case 'add':
		echo "$useradmaddone";
		break;
		case 'edit':
		if($_REQUEST['id']&&$_REQUEST['id'] > 0){
			$editid = $_REQUEST['id'];
			$editor = $itemsamdcate["users_edit=$editid=form"];
			echo "$useradmeditone";
			echo "$editor";
			echo "$useradmedittwo";
			}else {
			echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=users";</script>';
			}
			break;
		case 'delete':
			if($_REQUEST['id']&&$_REQUEST['id'] > 0){
				$deleteselectcategory = $_REQUEST['id'];
				$mysqli->query("DELETE FROM `RD-ADMIN` WHERE `id` = $deleteselectcategory;");
				echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=users";</script>';
			}else {
				echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=users";</script>';
				}
		break;
		default:
		echo "$useradmone";
		echo $items['listadmuser'];
		echo "$useradmtwo";
		break;
	}
	break;
	//конец пользователей панели
	//начало ркон данных
	case 'rcon':
		switch ($doadm) {
			case 'add':
				echo "$servadm_one_add";
			break;
			case 'edit':
			if($_REQUEST['id']&&$_REQUEST['id'] > 0){
				$editid = $_REQUEST['id'];
				$editor = $itemsamdcate["rcondata_$editid=formedit"];
				echo "$servadm_one_edit";
				echo "$editor";
				echo "$servadm_two_edit";
				}else {
					echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=rcon";</script>';
				}
			break;
			case 'delete':
				if($_REQUEST['id']&&$_REQUEST['id'] > 0){
					$deleteselectcategory = $_REQUEST['id'];
					$mysqli->query("DELETE FROM `RD-RCONDATA` WHERE `id` = $deleteselectcategory;");
					echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=rcon";</script>';
					}else {
						echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=rcon";</script>';
					}
			break;
		default:
		echo "$servadm_one";
		echo $items['listadmserver'];
		echo "$servadm_two";
		break;
		}
	break;
	//конец ркон данных
	//начало категории
	case 'category':
		switch ($doadm) {
			case 'add':
				echo "$cateadm_one_add";
			break;
			case 'edit':
			if($_REQUEST['id']&&$_REQUEST['id'] > 0){
				$editid = $_REQUEST['id'];
				$editor = $itemsamdcate["cate_edit=$editid=form"];
				echo "$cateadm_one_edit";
				echo "$editor";
				echo "$cateadm_two_edit";
				}else {
				echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=category";</script>';
				}
			break;
			case 'delete':
				if($_REQUEST['id']&&$_REQUEST['id'] > 0){
					$deleteselectcategory = $_REQUEST['id'];
					$mysqli->query("DELETE FROM `RD-CATEGORY` WHERE `id` = $deleteselectcategory;");
					echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=category";</script>';
					}else {
					echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=category";</script>';
					}
			break;
		default:
			echo "$cateadm_one";
			echo $items['listadmcate'];
			echo "$cateadm_two";
		break;
		}
		break;
	//конец категории
	//начало промо
	case 'cupons':
		switch ($doadm) {
			case 'add':
			echo "$cupadm_one_add";
			break;
			case 'edit':
			if($_REQUEST['id']&&$_REQUEST['id'] > 0){
				$editid = $_REQUEST['id'];
				$editor = $itemsamdcate["cupons_edit=$editid=form"];
				echo "$cupadm_one_edit";
				echo "$editor";
				echo "$cupadm_two_edit";
				}else {
					echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=cupons";</script>';
				}
			break;
			case 'delete':
			if($_REQUEST['id']&&$_REQUEST['id'] > 0){
				$editid = $_REQUEST['id'];
				$mysqli->query("DELETE FROM `RD-PROMOCODE` WHERE `id` = $editid;");
				echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=cupons";</script>';
				}else {
				echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=cupons";</script>';
				}
			break;
			
			default:
			echo "$cupadm_one";
			echo $items['listadmcup'];
			echo "$cupadm_two";
			break;
		}
	break;
	//конец промо
	//начало товаров
    case 'goods':
	switch ($doadm) {
	case 'add':
	echo "$donadm_one_add";
	echo $items['listcategory'];
	echo "$donadm_two_add";
	echo $items['serveradmdonlist'];
	echo "$donadm_three_add";
	break;
	case 'edit':
	if($_REQUEST['id']&&$_REQUEST['id'] > 0){
		$editid = $_REQUEST['id'];
		$editform_1 = $itemsamdcate["goods_edit=$editid=chapter_1=form"];
		$editform_2 = $itemsamdcate["goods_edit=$editid=chapter_2=form"];
		$editform_3 = $itemsamdcate["goods_edit=$editid=chapter_3=form"];
		$editform_4 = $itemsamdcate["goods_edit=$editid=chapter_4=form"];
		$editform_5 = $itemsamdcate["goods_edit=$editid=chapter_5=form"];
		$editform_6 = $itemsamdcate["goods_edit=$editid=chapter_6=form"];
		$editcate_1 = $itemsamdcate["goods_edit=$editid=chapter_1=cate"];
		$editserv_2 = $itemsamdcate["goods_edit=$editid=chapter_2=serv"];
		$editdop_3 = $itemsamdcate["goods_edit=$editid=chapter_3=dop"];
		$editlock_4 = $itemsamdcate["goods_edit=$editid=chapter_4=lock"];
		$editcmd_5 = $itemsamdcate["goods_edit=$editid=chapter_5=cmd"];
		echo "$donadm_one_edit";
		echo "$editform_1";
		echo "$editcate_1";
		echo "$editform_2";
		echo "$editserv_2";
		echo "$editform_3";
		echo "$editdop_3";
		echo "$editform_4";
		echo "$editlock_4";
		echo "$editform_5";
		echo "$editcmd_5";
		echo "$editform_6";
		echo "$donadm_two_edit";
		}else {
			echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=goods";</script>';
		}
	break;
	case 'delete':
	if($_REQUEST['id']&&$_REQUEST['id'] > 0){
		$deleteselectdonate = $_REQUEST['id'];
		$mysqli->query("DELETE FROM `RD-DONAT` WHERE `id` = $deleteselectdonate;");
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=goods";</script>';
	}else {
		echo '<script>self.location="'.$URLSITES.'admin/cpanel.php?mode=goods";</script>';
		}
	break;
	
	default:
		echo "$donadm_one";
		echo $items['listadmdonate'];
		echo "$donadm_two";
	break;
	}
	break;
	//конец товаров
	default:
		echo "$infoadm_one";
		echo "$infoadm_two"; 
	break;
}
?>

<!--Конец-->
<script src="../style/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../style/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="../style/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../style/js/material.min.js" type="text/javascript"></script>
<script src="../style/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="../style/js/jquery.validate.min.js"></script>
<script src="../style/js/jquery.datatables.js"></script>
<script src="../style/js/jquery.select-bootstrap.js"></script>
<script src="../style/js/jasny-bootstrap.min.js"></script>
<script src="../style/js/material-dashboard.js"></script>
<script>
	var id = 0;
function add() {
	id++;
	var clearinput = '<div id="command_'+id+'" class="command"><div class="input-group form-group label-floating is-empty"><label for="command_c_'+id+'" class="control-label">Команда</label><input type="text" name="command['+id+']" class="form-control" required><span class="input-group-btn"><button type="button" class="btn btn-warning btn-round" onclick="removeid('+id+')"><i class="material-icons">delete</i></button></span><span class="material-input"></span></div></div>';
	$('.commands').append(clearinput);
	$('#command_' + id).hide();
	$('#command_' + id).fadeIn();
	$('#goods').validator('update');
}
function removeid(blockid) {
	if (blockid == this.bl) { id--; }
	$('#command_' + blockid).fadeOut(function(){$(this).remove()})

}
window.onload = function () {
    $('#server').on('change', function (event) {
        event.preventDefault();
        if ($('#server').val() === '-1') {
            $('#a_server').show();
        } else {
            $('#a_server').hide();
        }
    });
}
	$(document).ready(function() {
		$('#datatable').DataTable({
			'pagingType': 'full_numbers',
			responsive: true,
			language: {
				sProcessing: 'Подождите...',
				sZeroRecords: 'Ничего не найдено',
				sInfo: '<p>Показано _END_ из _TOTAL_ записей</p>',
				sInfoEmpty: '',
				sInfoFiltered: '',
				search: '_INPUT_',
				searchPlaceholder: 'Поиск',
				paginate: {
					first: false,
					sLast: false,
					sNext: 'Следующая',
					sPrevious: 'Прошлая',
				},
				sEmptyTable: 'Пусто',
				sLoadingRecords: 'Загрузка...',
				'lengthMenu': 'Показывать по <select name="datatable_length" aria-controls="datatable" class="form-control input-sm">'+
					'<option value="10">10</option>'+
					'<option value="20">20</option>'+
					'<option value="30">30</option>'+
					'<option value="40">40</option>'+
					'<option value="50">50</option>'+
					'<option value="-1">Все</option>'+
				'</select> записей',
			}
		});

		var table = $('#datatable').DataTable();

		$('.card .material-datatables label').addClass('form-group');
	});

</script>

</body></html>
<!--
<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert">
<span>×</span>
</button>
<b>Успех!</b> Категория успешно добавлена!</div>
-->