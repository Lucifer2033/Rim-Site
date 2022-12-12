<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
$URLSITES = URLSITE;
$silkaadmone = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-header">
<h4 class="card-title">Список ссылок</h4>
</div>
<div class="card-content">
<a href="?mode=links&do=add" class="btn btn-block btn-danger"><i class="material-icons">add</i> Добавить</a>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>Название</th>
<th>Ссылка</th>
<th>Вверху</th>
<th>Внизу</th>
<th>Приорити</th>
<th>Действие</th>
</tr>
</thead>
<tbody>
';
$silkaadmtwo = '
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
$silkaadmaddone = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<form action="'.$URLSITES.'admin/cpanel.php?mode=links" id="links" class="card" method="POST" data-toggle="validator" novalidate="true">
<div class="card-content">
<input name="mode" type="hidden" value=links>
<input name="modeapi" type="hidden" value=links_add>
<div class="form-group label-floating is-empty">
<label for="name" class="control-label">Название</label>
<input type="text" class="form-control" name="name" id="name" value="" required="yes">
<span class="material-input"></span></div>
<div class="form-group label-floating is-empty">
<label for="link" class="control-label">Ссылка</label>
<input type="text" class="form-control" name="link" id="link" value="">
<div class="form-group label-floating">
<select id="head" name="head" class="selectpicker" data-style="select-with-transition" title="Выберите" required>
<option disabled selected>Показать вверху</option>
<option value="1">Да</option>
<option value="0">Нет</option>
</select>
</div>
<div class="form-group label-floating">
<select id="footer" name="footer" class="selectpicker" data-style="select-with-transition" title="Выберите" required>
<option disabled selected>Показать внизу</option>
<option value="1">Да</option>
<option value="0" >Нет</option>
</select>
</div>
<span class="material-input"></span></div>
<div class="form-group is-empty">
<label for="pos" class="control-label">Позиция</label>
<input type="number" class="form-control" name="pos" id="pos" required="yes">
<span class="material-input"></span></div>
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
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 903px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 874px;"></div></div></div>
';
$silkaadmeditone = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
';
$silkaadmedittwo = '
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