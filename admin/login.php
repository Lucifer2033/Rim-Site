<?php
$username = null;
$password = null;
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
$URLSITES = URLSITE;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        require_once($_SERVER['DOCUMENT_ROOT'].'/engine/mysql.php');
        $authtest = $mysqli->query("SELECT * FROM `RD-ADMIN` WHERE `login` = '$username' AND `password` = '$password';");
        $authresult = $authtest->fetch_assoc();
        $checkauthtest = $mysqli->query("SELECT * FROM `RD-ADMIN` WHERE `login` = '$username';");
        $checkauthresult = $checkauthtest->fetch_assoc();
        if($checkauthresult['error'] >= 3){
        header('Location: '.$URLSITES.'admin/login.php');
        }
        if($checkauthresult['error'] < 3&&$checkauthresult['login'] == $username && $checkauthresult['password'] != $password){
        $mysqli->query("UPDATE `RD-ADMIN` SET `error` = `error` + 1 WHERE `login` = '$username';");
        header('Location: '.$URLSITES.'admin/login.php');
        }
        if($checkauthresult['error'] < 3 &&$authresult['login'] == $username && $authresult['password'] == $password) {
            session_start();
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = @$_SERVER['REMOTE_ADDR'];
            if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
            elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
            else $ip = $remote;
            $usersips = $ip;
            $_SESSION["authenticated"] = 'true';
            $_SESSION["authenticated_logins"] = $username;
            $_SESSION["authenticated_password"] = $password;
            $mysqli->query("UPDATE `RD-ADMIN` SET `ip` = '$usersips' WHERE `login` = '$username';");
            header('Location: cpanel.php');
        }else {
            header('Location: '.$URLSITES.'admin/login.php');
        }
        
    } else {
        header('Location: '.$URLSITES.'admin/login.php');
    }
} else {
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="./styles/css/bootstrap.min.css" rel="stylesheet">
    <link href="./styles/css/login.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

    <title>Авторизация</title>
</head>
<body>
<form id="login" class="login-form" method="post">
<h1>Авторизация </h1>

<input type="text" class="form-control gray" name="username" id="username" placeholder="Введите логин" required>
</div>
<div class="form-group has-feedback">
<input type="password" class="form-control gray" name="password" id="password" placeholder="Введите пароль" required>
</div>
<button type=submit value="Login" class="logbtn">Войти</button>

</form>

</body>
</html>
<?php } ?>
