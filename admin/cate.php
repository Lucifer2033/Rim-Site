<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
$URLSITES = URLSITE;
$cateadm_one = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-header">
<h4 class="card-title">Список категорий</h4>
</div>
<div class="card-content">
<a href="?mode=category&do=add" class="btn btn-block btn-danger"><i class="material-icons">add</i> Добавить</a>
<div class="table-responsive">
<table class="table">
<thead>
<th>#</th>
<th>Название</th>
<th>Приоритет</th>
<th>Действие</th>
</thead>
<tbody>
';
$cateadm_two = '
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
</footer>;
';
$cateadm_one_add = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<form action="'.$URLSITES.'admin/cpanel.php?mode=category" id="category" class="card" method="POST" data-toggle="validator" novalidate="true">
<div class="card-content">
<div class="form-group label-floating is-empty">
<input name="mode" type="hidden" value=category>
<input name="modeapi" type="hidden" value=category_add>
<label for="title" class="control-label">Название</label>
<input type="text" id="title" name="title" class="form-control" value="" required="">
<span class="material-input"></span></div>
<div class="form-group label-floating is-empty">
<label for="priority" class="control-label">Приоритет показа</label>
<input type="number" id="priority" name="priority" class="form-control" value="" required="">
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
</div>
';
$cateadm_one_edit = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">

';
$cateadm_two_edit = '
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