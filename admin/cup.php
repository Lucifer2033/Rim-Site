<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
$URLSITES = URLSITE;
$cupadm_one = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-header">
<h4 class="card-title">Список купонов</h4>
</div>
<div class="card-content">
<a href="?mode=cupons&amp;do=add" class="btn btn-block btn-danger"><i class="material-icons">add</i> Добавить</a>
<div class="table-responsive">
<table class="table">
<thead>
<tr><th>Название</th>
<th>Скидка (%)</th>
<th>Осталось использований</th>
<th>Действие</th>
</tr></thead>
<tbody>
';
$cupadm_two = '
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
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 903px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 874px;"></div></div></div>
</div>
';
$cupadm_one_edit = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div></div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
';
$cupadm_two_edit = '
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
';
$cupadm_one_add = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div></div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<form  action="'.$URLSITES.'admin/cpanel.php?mode=cupons" id="cupons" class="card" method="POST" data-toggle="validator" novalidate="true">
<div class="card-content">
<div class="form-group">
<label for="name" class="control-label">Название</label>
<input name="mode" type="hidden" value=cupons>
<input name="modeapi" type="hidden" value=cupons_add>
<input name="idse" type="hidden" value=0>
<input type="text" id="name" name="name" class="form-control" value="" required="">
<span class="material-input"></span></div>
<div class="form-group">
<label for="summ" class="control-label">Скидка (%)</label>
<input type="number" id="summ" name="summ" class="form-control" value="" min="1" max="100" required="">
<span class="material-input"></span></div>
<div class="form-group">
<label for="count" class="control-label">Использований</label>
<input type="number" id="count" name="count" class="form-control" value="" required="">
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

';
?>