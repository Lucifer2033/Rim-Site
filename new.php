<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");$urlsite = SITENAME; echo "$urlsite";?></title>
      <link rel="shortcut icon" href="/style/img/favicon.ico" type="image/x-icon">
      <link href="/style/template/css/bootstrap.min.css" rel="stylesheet">
      <link href="/style/template/css/site.min.css" rel="stylesheet">
      <link href="/style/template/css/style.css" rel="stylesheet">
   </head>
   <body>
      <div id="before-load">
         <i></i>
      </div>
      <nav class="navbar navbar-toggleable-md navbar-light bg-primary">
         <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/"><i class="fa fa-cube"></i> RimWorld</a>
            <div class="collapse navbar-collapse" id="navbarColor01">
               <ul class="navbar-nav mr-auto">
                  <?php
                  require_once($_SERVER["DOCUMENT_ROOT"]."/engine/GMain.php");
                  @session_start();
                  if($_SESSION["authenticated"]&&$_SESSION["authenticated"] == 'true'){
                  echo '<li class="nav-item"><a class="nav-link" href="admin/cpanel.php" target="_blank">Админ-панель</a></li>';
                  }
                  echo  $items['newsilkisheader'];
                  ?>
                  
               </ul>
               <span class="navbar-text">
               <span class="badge badge-danger">Онлайн: <b id="online"></b></span> <span class="badge badge-primary" onClick="ipsend()" id="online" onSelect="ipsend()">IP: play.rimworlda.ru</span>
               </span>
            </div>
         </div>
      </nav>
      <br>
      <div class="container">
      <center>
      <div class="payments"><div class="blockname">Последние покупки</div>
      <div class="payment-list">
      <?php
      require_once($_SERVER["DOCUMENT_ROOT"]."/engine/GMain.php");
      echo $items['newlastdonate'];
      ?>
      </div>
      </div>
</center>
         <br>
         <!-- <div class="alert alert-dismissible alert-success">
            <h4>Скидки 90% на все</h4>
            <p>Только сегодня, Вы можете купить донат с большой скидкой 90% на весь донат и другие услуги.</p>
            </div> 
          <img src="https://migosmc.net//templates/styles/images/banner-min.png" class="img-fluid" style="border: 1px solid rgba(0, 0, 0, .125); border-radius: .25rem">
         -->
         <!-- <div class="jumbotron">
            <h1 class="display-5">Скидки до 90%</h1>
            <p>Успейте и купите сегодня донат по скидке 90%. Он останется у вас навсегда и сохранится даже после вайпов.</p>
            </div> -->
            <?php
            /*
                    $ourData = file_get_contents("./admin/advert.json");
                    $array = json_decode($ourData, true);
                    if($array['status'] == "checked"){
                    echo  '<div class="card"><div class="card-body"><center>';
                    echo '<legend>'.$array['name'].'</legend>';
                    echo $array['text'];
                    echo '</center></div></div><br>';
                    }
            */
                    ?>
         <!--
            <div class="card">
              <div class="card-body">
                <center>
                  <h4>КУПИТЕ ДОНАТ СО СКИДКОЙ 90% СЕГОДНЯ</h4><br>
                  <b>До окончания акции:</b><br><br>
                  <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"><h5 class="one"></h5> Дней</div>
                    <div class="col-md-1"><h5 class="second"></h5> Часов</div>
                    <div class="col-md-1"><h5 class="third"></h5> Минут</div>
                    <div class="col-md-1"><h5 class="four"></h5> Секунд</div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1"></div>
                </center>
              </div>
            </div>
            <br> -->

         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <ul class="nav nav-tabs nav-fill" style="margin-bottom: 15px">
                     <?php
                     require_once($_SERVER["DOCUMENT_ROOT"]."/engine/GMain.php");
                     echo $items['newknopki'];
                     echo '</ul><div class="tab-content">';
                     echo $items['newform'];
                     ?>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <center>
                     <?php
                     $ourData = file_get_contents("./admin/advert.json");
                     $array = json_decode($ourData, true);
                     if($array['status'] == "checked"){
                     echo '<div class="card"><div class="card-body"><center>';
                     echo '<legend>'.$array['name'].'</legend>';
                     echo $array['text'];
                     echo '</center></div></div><br>';
                     }
                     ?>
                  </center>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </div>
      <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 text-left">
                    2018-<script>document.write(new Date().getFullYear())</script>© RimWorlda.ru. Все права защищены!
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
      <!--ТУТ МОДЕЛИ-->
      <?php 
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/GMain.php");
$lists = $itemsamdcate["pages_index_model"];
echo "$lists";
?>
      <!--ТУТ МОДЕЛИ-->
      <script src="/style/template/js/slim.min.js"></script>
      <script src="/style/template/js/popper.min.js"></script>
      <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
      <script src="/style/template/js/jquery.countdown.min.js"></script>
      <script src="/style/template/js/bootstrap.min.js"></script>
      <script src="/style/template/js/fontawesome.js"></script>
      <script src="/style/template/js/validator.min.js"></script>
      <script src="/style/template/js/jquery.formstyler.js"></script>
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
         $(window).load(function() {
             $('#before-load').find('i').fadeOut().end().delay(100).fadeOut('slow');
         });
         function ipsend() {
             prompt("Скопируйте данный айпи и вставьте в Ваш клиент", "play.rimworlda.ru");
         }
         function getidform() {
         return $(".tab-content .tab-pane.fade.in.show.active")[0].id;
         }
         function SelectServer(idnames) {
         let tabs = $('.tab-content')[0].children;
         for (let key = 0; key < tabs.length; key++) {
            const element = tabs[key];
            console.log(`${element.classList}`)
            if(element.id != `server${idnames}`&&element.className == 'tab-pane fade in show active'){
            element.classList.remove("active");
            $(`#server${idnames}`).addClass('active');
            }else{
            $(`#server${idnames}`).addClass('active');
            }
         }
         }
         $(function () {
            $('form.server').validator();
            $(".tab-content .tab-pane:first").addClass("active");
            let tabs = $('.tab-content')[0].children;
            for (let key = 0; key < tabs.length; key++) {
            const element = tabs[key];
            var options = $('#' + element.id+' #selid optgroup').parents('optgroup');
            var optionsleng = $('#' + element.id+' #selid option');
            var chesk = $('#' + element.id+' input[name="nameservers"]').val();
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
         });
         
//Таймер
/*
$('page').ready(function() {
var date = new Date();
var day = date.getDate() + 1;
if(day >= 32) { day = day - 1 }
$(".row").countdown("2030/12/" + day, function(event) {
$('.second').text(event.strftime('%H'));
$('.third').text(event.strftime('%M'));
$('.four').text(event.strftime('%S'));
});
    });
    */
    $.post('/status/ping.php?ip=play.rimworlda.ru', function(data) {
      let obj = JSON.parse(data);
      $('#online').html(`${obj.players}/${obj.max_players}`);
      });
      </script>
   </body>
</html>