<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
$URLSITES = URLSITE;
$stranicaadmone = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-header">
<h4 class="card-title">Список статических страниц</h4>
</div>
<div class="card-content">
<a href="?mode=pages&do=add" class="btn btn-block btn-danger"><i class="material-icons">add</i>  Добавить статическую страницу</a>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>Идентификатор</th>
<th>Название</th>
<th>Действие</th>
</tr>
</thead>
<tbody>
';
$stranicaadmtwo = '
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
$stranicaadmaddone = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<form action="'.$URLSITES.'admin/cpanel.php?mode=pages" id="pages" class="card" method="POST" data-toggle="validator">
<div class="card-content">
<form method="post">
<div class="form-group label-floating">
<input name="mode" type="hidden" value=pages>
<input name="modeapi" type="hidden" value=pages_add>
<label for="name" class="control-label">Идентификатор страницы</label>
<input type="text" id="name" name="name" class="form-control" value="" required>
</div>
<div class="form-group label-floating">
<label for="title" class="control-label">Название</label>
<input type="text" id="title" name="title" class="form-control" value="" required>
</div>
<div class="form-group label-floating">
<textarea id="editoradverts_text_1" name="editoradverts_text_1" class="form-control" required placeholder="Загрузка редактора...">

</textarea>
</div>
<button type="submit" class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
</form>
</div>
</form>
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
CKEDITOR.replace("editoradverts_text_1");
</script>
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
$stranicaadmeditone = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
';
$stranicaadmedittwo = '
<script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
CKEDITOR.replace("editoradverts_text_1");
</script>
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