<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/mysql.php");
$res = $mysqli->query('SHOW TABLES;')->fetch_all();
$sql = file_get_contents('./database.sql');
$mysqli->multi_query($sql);
sleep(3);
foreach ($res as $key => $value) {
    $name = $res[$key][0];
    if(substr($name, 0, strlen('RD-')) == 'RD-') {
    $mysqli->query("ALTER TABLE `$name` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;");
    $mysqli->query("ALTER TABLE `$name` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
    }
}
sleep(1);
file_put_contents("./install/index.php",'<?php header("Content-Type: text/html; charset=utf-8"); echo "Успешно Создана база данных<br>Данные от Панели:<br>Логин: test<br>Пасс: test<br>Можете закрыть файл ибо он уже  `удалён`<br>Если нет советуем удалить папку install";?>');
header('Location: ./install/index.php');
?>
