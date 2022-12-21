<?php
//данные от базы данных
define('DBHOST', 'localhost');
define('DBNAME', 'shop');
define('DBUSER', 'nhop');
define('DBPASS', 'Bax');
//Данные для сайта (важно пздц как)
define('SITENAME', 'RimWorld | Играй с нами!');
//ссылка должны быть https://вашдомен/ или http://вашдомен/
define('URLSITE', 'https://rimworlda.ru/');
//vk группы токен для оповещения о покупке доната выклю ток через engine/GMain.php удалить строчку 825
//если нужно откл или просто закоментить  строчку
define('VKTOKENS', '7ce83');
//массив вк айди кому отправить сообщение о покупке доната
define('ADMINSVK', array(359430019));
//Касса ANYPAY
define('ANYID', 97);
define('ANYSECRECT', '');
define('ANYSUCCESS', 'https://rimworlda.ru/');
define('ANYFAIL', 'https://rimworlda.ru/');
define('ANYIPS', array('185.162.128.38', '185.162.128.39', '185.162.128.88'));
//Касса FreeKassa
define('FPROCID', 86);
define('FSECRETKEY_1', '');?
define('FSECRETKEY_2', '');
define('FAPIKEY', 'bc');
define('FIPS', array('168.119.157.136', '168.119.60.227', '138.201.88.124', '178.154.197.79'));
//Касса QIWI
define('QTOKEN','');
define('QSTOKEN', '');
define('QSUCCESS', 'https://rimworlda.ru/');
//Касса PayOk
define('PAYOKID',1);
define('PAYOKSECRET', '2ac');
define('PAYOKIPS', array('195.64.101.191'));
//Касса EnotIo
define('ENOTID',123);
define('ENOTSECRECTONE', '');
define('ENOTSECRECTTWO', '');
define('ENOTIPS', array('5.187.7.207', '51.210.114.114', '149.202.68.3', '109.206.163.80', '23.88.5.163', '23.88.5.156'));
