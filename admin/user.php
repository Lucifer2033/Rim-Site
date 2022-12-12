<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
$URLSITES = URLSITE;
$useradmone = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-header">
<h4 class="card-title">Список пользователей пу</h4>
</div>
<div class="card-content">
<a href="?mode=users&do=add" class="btn btn-block btn-danger"><i class="material-icons">add</i> Добавить</a>
<div class="table-responsive">
<table class="table">
<thead>
<tr><th>Логин</th>
<th>IP</th>
<th>Действие</th>
</tr>
</thead>
<tbody>
';
$useradmtwo = '
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
';
$useradmaddone = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<form action="'.$URLSITES.'admin/cpanel.php?mode=users" id="users" class="card" method="POST" data-toggle="validator" novalidate="true">
<div class="card-content">
<input name="mode" type="hidden" value=users>
<input name="modeapi" type="hidden" value=users_add>
<div class="form-group label-floating is-empty">
<label for="login" class="control-label">Логин</label>
<input type="text" class="form-control" name="login" id="login" value="" required="yes">
<span class="material-input"></span></div>
<div class="form-group label-floating is-empty">
<label for="ip" class="control-label">IP</label>
<input type="text" class="form-control" name="ip" id="ip" value="localhost" disabled="">
<span class="material-input"></span></div>
<div class="form-group is-empty">
<label for="password" class="control-label">Пароль</label>
<input type="password" class="form-control" name="password" id="password" placeholder="СКРЫТ" required="yes">
<span class="material-input"></span></div>
<button class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
</div>
</form> </div>
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
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 903px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 874px;"></div></div></div>
';
$useradmeditone = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
';
$useradmedittwo = '
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
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 903px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 874px;"></div></div></div>
';
?>