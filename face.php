<?php
$size = isset($_GET['size']) ? max(8, min(180, $_GET['size'])) : 80;
$username = isset($_GET['name']) ? $_GET['name'] : 'Steve';

header('Location: https://minotar.net/avatar/' . $username . '/' . $size . '.png');
die;