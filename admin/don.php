<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
$URLSITES = URLSITE;
$donadm_one = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-header">
<h4 class="card-title">Список товаров</h4>
</div>
<div class="card-content">
<a href="?mode=goods&do=add" class="btn btn-block btn-danger"><i class="material-icons">add</i> Добавить</a>
<div class="table-responsive">
<table class="table">
<thead>
<th>#</th>
<th>Название</th>
<th>Цена</th>
<th>Категория</th>
<th>Приоритет</th>
<th>Сервер</th>
<th>Количество</th>
<th>Действие</th>
</thead>
<tbody>
';
$donadm_two = '
</tbody>
</table>
</div>
</div>
</div> </div>
</div>
<footer class="footer">
<div class="container-fluid">
<nav class="pull-left">
<ul>
<li>
<a href="./">
Вернуться на сайт
</a>
</li>
<li>
<a href="https://wiki.ldonate.ru/">
Wiki
</a>
</li>
<li>
<a href="https://whileteam.ru/products/">
Другие скрипты
</a>
</li>
</ul>
</nav>
<p class="copyright pull-right">
© <script>document.write(new Date().getFullYear())</script>
<a href="http://whileteam.ru/">WhileTeam</a>
</p>
</div>
</footer>
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
';
$donadm_one_add = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">

<div class="content">
<div class="container-fluid">
<form action="'.$URLSITES.'admin/cpanel.php?mode=goods" id="goods" class="card" method="POST" data-toggle="validator">
<div class="card-content">
<div class="form-group label-floating">
<label for="name" class="control-label">Название</label>
<input type="text" id="name" name="name" class="form-control" value="" required>
</div>
<input name="mode" type="hidden" value=goods>
<input name="modeapi" type="hidden" value=goods_add>
<div class="form-group label-floating">
<label for="cost" class="control-label">Цена</label>
<input type="number" id="cost" name="cost" class="form-control" value="" min="10" required>
</div>
<hr>
<div class="form-group label-floating">
<label for="cat" class="control-label">Категория</label>
<select id="cat" name="cat" class="selectpicker" data-style="select-with-transition" title="Выберите категорию"  required>
<option disabled> Выберите категорию</option>
';
$donadm_two_add = '
</select>
</div>
<div class="form-group label-floating">
<label for="server" class="control-label">Сервер</label>
<select id="server" name="server[]" class="selectpicker" multiple data-style="select-with-transition" title="Выберите сервер"  required>
<option disabled> Выберите сервер</option>
';
$donadm_three_add = '
</select>
</div>
<div class="form-group label-floating">
<label for="priority" class="control-label">Приоритет показа</label>
<input type="number" id="priority" name="priority" class="form-control" value="" required>
</div>
<div class="form-group label-floating">
<label for="counts" class="control-label">Количество если без то *</label>
<input type="string" id="counts" name="counts" class="form-control" value="" required>
</div>
<div class="form-group label-floating">
<label for="dobuy" class="control-label">Доплата</label>
<select id="dobuy" name="dobuy" class="selectpicker" data-style="select-with-transition" title="Разрешить доплачивать?"  required>
<option disabled> Разрешить доплачивать?</option>
<option value="1">Да</option>
<option value="0" selected>Нет</option>
</select>
</div>
<div class="form-group label-floating">
<label for="zapret" class="control-label">Запретить покупку равен или выше этого</label>
<select id="zapret" name="zapret" class="selectpicker" data-style="select-with-transition" title="Разрешить доплачивать?"  required>
<option disabled>Запретить покупку равен или выше этого?</option>
<option value="1">Да</option>
<option value="0" selected>Нет</option>
</select>
</div>
<hr>
<div class="form-group">
<label for="rcon_command" class="control-label">Команды для выдачи:</label>
<button type="button" class="btn btn-primary btn-block" onclick="add()"><i class="material-icons">add</i> Дoбавить</button>
<hr>
<div class="commands">
<div id="command_1" class="command">
<div class="input-group form-group label-floating">
<label for="command_c_0" class="control-label">Команда</label>
<input type="text" name="command[0]" class="form-control" value="" required>
<span class="input-group-btn">
<button type="button" class="btn btn-warning btn-round" onclick="removeid(1)"><i class="material-icons">delete</i></button>
</span>
</div>
</div> </div>
<code>
<p><b>Примечание:</b></p>
<p>%nick% - будет заменено на ник игрока</p>
<hr>
<p>Если вам нужно выполнить запрос к SQL вместо выполнения команды на сервере, пишите в поле "Команда" запрос в формате "sql:<SQL_Запрос>"</p>
<p>Пример: <i>sql:INSERT INTO `RD-ADMIN` (`id`, `login`, `password`, `error`, `ip`) VALUES (NULL, "123", "123", "0", "0")</i></p>
<p>Важно в  sql запросе не использовать одинарные прямымые кавычки вместо них  юзать двойные прямые кавычками иначе ваши сохранения или добавление доната или выдача не будет работать</p>
<p> конце запроса не ставить ; это не нужно наоборот вы так сломаете</p>
<p>SQL Запросы бете тесте</p>
</code>
<hr>
</div>
<button class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
</div>
</form>
</div>
</div>
<footer class="footer">
<div class="container-fluid">
<nav class="pull-left">
<ul>
<li>
<a href="./">
Вернуться на сайт
</a>
</li>
<li>
<a href="https://wiki.ldonate.ru/">
Wiki
</a>
</li>
<li>
<a href="https://whileteam.ru/products/">
Другие скрипты
</a>
</li>
</ul>
</nav>
<p class="copyright pull-right">
© <script>document.write(new Date().getFullYear())</script>
<a href="http://whileteam.ru/">WhileTeam</a>
</p>
</div>
</footer>
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
';
$donadm_one_edit = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">

<div class="content">
<div class="container-fluid">

';
$donadm_two_edit = '
</div>
</div>
<footer class="footer">
<div class="container-fluid">
<nav class="pull-left">
<ul>
<li>
<a href="./">
Вернуться на сайт
</a>
</li>
<li>
<a href="https://wiki.ldonate.ru/">
Wiki
</a>
</li>
<li>
<a href="https://whileteam.ru/products/">
Другие скрипты
</a>
</li>
</ul>
</nav>
<p class="copyright pull-right">
© <script>document.write(new Date().getFullYear())</script>
<a href="http://whileteam.ru/">WhileTeam</a>
</p>
</div>
</footer>
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
';
/*
<form action="../cpanel.php" id="category" class="card" method="POST" data-toggle="validator" novalidate="true">
<div class="card-content">
<div class="form-group label-floating is-empty">
<label for="title" class="control-label">Название</label>
<input type="text" id="title" name="title" class="form-control" value="" required="">
<span class="material-input"></span></div>
<div class="form-group label-floating is-empty">
<label for="priority" class="control-label">Приоритет показа</label>
<input type="number" id="priority" name="priority" class="form-control" value="">
<span class="material-input"></span></div>
<button class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
</div>
</form>
*/
?>