<?php
@session_start();
?>
<!DOCTYPE html>
<html lang=ru>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title><?php require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");$urlsite = SITENAME; echo "$urlsite";?></title>
    <link rel="stylesheet" href="/style/css/bootstrap.css">
    <link rel="stylesheet" href="/style/css/main.css">
    <link rel="stylesheet" href="/style/css/jquery.formstyler.css">
    </head>

    <link rel="shortcut icon" href="/style/img/favicon.ico?v=1" type="image/x-icon">
    <link rel="apple-touch-icon" href="/style/img/favicon.ico?v=1" sizes="180x180">
    <link rel="icon" href="/style/img/favicon.ico?v=1" sizes="32x32" type="image/x-icon">
    <link rel="canonical" href="index.php">
    <meta name="theme-color" content="#3c3c4c">
    <meta name="msapplication-navbutton-color" content="#3c3c4c">
    <meta name="apple-mobile-web-app-status-bar-style" content="#3c3c4c">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                    <span class="sr-only">Открыть меню</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <img src="https://forum.rimworlda.ru/styles/aionstyle/images/rw.png" width="170px" height="45px" style="padding-top: 5px;"></img>
            </div>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav">
                <?php
                @session_start();
                if($_SESSION["authenticated"]&&$_SESSION["authenticated"] == 'true'){
                echo '
                <ul class="nav navbar-nav"><li><a href="admin/cpanel.php">Админ-панель</a></li></ul>
                ';
                }
                ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <?php
                require_once($_SERVER["DOCUMENT_ROOT"]."/engine/GMain.php");
                echo $items['oldsilkisheader'];
                ?>
                </ul>
            </div>
        </div>
    </nav>
<div class="container page">
<div class="row">
<noscript>
				<div class="alert alert-danger">
					<b>Ошибка!</b>
					<p>Для работы сайта требуется <u>JavaScript</u>!</p>
				</div>
			</noscript>
<div class="col-md-6 col-md-offset-3">
<?php
$ourData = file_get_contents("./admin/advert.json");
$array = json_decode($ourData, true);
if($array['status'] == "checked"){
echo '
<div class="panel panel-default text-left advert">
<div class="panel-body">';
echo '<legend>'.$array['name'].'</legend>';
echo $array['text'];
echo '</div> </div> ';
}
?>
<div class="server-select">
<?php
@session_start();
require_once('engine/mysql.php');
require_once('engine/GMain.php');
$select = $mysqli->query("SELECT COUNT(*) FROM `RD-RCONDATA`");
$rowselect = $select->fetch_assoc();
if($rowselect[0]) {
echo '<div class="btn btn-primary btn-block btn-lg">Добавить сервер для начала</div>';
}else{
echo '<div class="btn btn-primary btn-block btn-lg">Выберите сервер:</div>';
require_once('engine/GMain.php');
echo $items['oldknopki'];
echo "</div>";
echo $items['oldform'];
}
?>
</div>
</div>
<div class="col-md-8 col-md-offset-2" style="margin-top: 15px;">
<div class="panel panel-default text-center">
<div class="panel-heading">Последние покупки</div>
<div class="panel-body">
<div class="row">
<?php
 require_once('engine/GMain.php');
 if(!$items['oldlastdonate']) {
 echo "<p>Как-то Пусто</p>";
 }
 echo $items['oldlastdonate'];
 ?>
</div>
</div>
</div>
</div> 
</div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 text-left">
                    2018-<script>document.write(new Date().getFullYear())</script> &copy; RimWorlda.ru. Все права защищены!
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <?php
                    require_once($_SERVER["DOCUMENT_ROOT"]."/engine/GMain.php");
                    echo $items['silkisfooter'];
                    ?>
                </div>
            </div>
        </div>
    </footer>
<?php 
$lists = $itemsamdcate["pages_index_model"];
echo "$lists";
?>
<script src="https://unpkg.com/jquery@3.6.1/dist/jquery.js"></script>
<script src="./style/js/bootstrap.min.js"></script>
<script src="./style/js/jquery.formstyler.min.js"></script>
<script src="./style/js/jquery.validate.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(function () {
    <?php
    //$_SESSION['success_message'] = false;
    //$_SESSION['success_message_text']='"Ошибка","нет времени объяснять суй ананас в жопу"';
    if (isset($_SESSION['success_message'])&&$_SESSION['success_message'] == true){
        echo 'swal('.$_SESSION['success_message_text'].', "success")';
        unset($_SESSION['success_message']);
        unset($_SESSION['success_message_text']);
    }
    if (isset($_SESSION['success_message'])&&$_SESSION['success_message'] == false){
        echo 'swal('.$_SESSION['success_message_text'].', "error")';
        unset($_SESSION['success_message']);
        unset($_SESSION['success_message_text']);
    }
    ?>
    });

    <?php 
    if($_REQUEST["mod"] == 'page'){
    require_once($_SERVER["DOCUMENT_ROOT"]."/engine/mysql.php");
    require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
    $URLSITES = URLSITE;
    $ids = $_REQUEST["id"];
    $pages = $mysqli->query("SELECT * FROM `RD-PAGES` WHERE `idname` = '$ids';");
    $row = $pages->fetch_assoc();
    $idses = (string)$row['id'];
    $pagetext = (string)$row['idname'];
    $textes = '#'.$pagetext.'';
    if($idses > 0){
    echo "$('$textes').modal('show');";
    }else{
    $_SESSION['success_message'] = false;
    $_SESSION['success_message_text'] = '"Ошибка","Такой страницы не нашёл"';
    echo 'window.location.href="'.$URLSITES.'";';
}
    }
    ?>
    <?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/engine/mysql.php");
    $select = $mysqli->query("SELECT * FROM `RD-RCONDATA` WHERE `status` = 1;");
    $selectcount = $mysqli->query("SELECT COUNT(*) FROM `RD-RCONDATA` WHERE `status` = 1;");
    $count = $selectcount->fetch_assoc();
    $row = $select->fetch_assoc();
    $idses = (string)$row['id'];
    if($idses > 0){
    $counts = $count["COUNT(*)"];
    echo "var servers = parseInt('$counts');";
    }else{
    echo "var servers = parseInt('1');";
    }
    ?>

    	var serverID = 1;

    	function selectServer(servID)
    	{
    		$('.server-select').hide(400);
    		$('#server' + servID).show(400);
    		serverID = servID;
            var options = $('#server' + servID+' #selid optgroup').parents('optgroup');
            var optionsleng = $('#server' + servID+' #selid option');
            var chesk = $('#server' + servID+' input[name="nameservers"]').val();
            for (let key = 0; key < optionsleng.length; key++) {
                const element = optionsleng[key];
                if(chesk != element.attributes["data-value"].nodeValue){
                    element.remove();
                }
            }
            for (let qkey = 0; qkey < options.prevObject.length; qkey++) {
                const element = options.prevObject[qkey];
                if(element.firstElementChild == null){
                    element.remove();
                }
            }
    	}
    	function selectMenu()
    	{
    		$('#server' + serverID).hide(400);
    		$('.server-select').show(400);
    	}
    	$(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('select').styler();
            $('form.server').validator();
    		if (servers === 1)
    		{
    			$('#selectMenu').hide();
    			$('#server1').show(400);
    		}
    		else
    		{
    		$('.server-select').show(400);
    		}
    	});

    </script>
</body>
</html>