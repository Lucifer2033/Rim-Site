<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/engine/config.php");
$URLSITES = URLSITE;
$advertdmoneedit = '
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<form action="'.$URLSITES.'admin/cpanel.php?mode=advert" id="advert" class="card" method="POST" data-toggle="validator">
<div class="card-content">
<form method="post">
<input name="mode" type="hidden" value=advert>
<input name="modeapi" type="hidden" value=advert_edit>
<div class="form-group label-floating">
<label for="title" class="control-label">Название</label>
';
$advertdmtwoedit = '
</div>
<div class="form-group label-floating">
<textarea id="editoradverts_text_1" name="editoradverts_text_1" class="form-control" required placeholder="Загрузка редактора...">
';
$advertdmthreeedit = '
</textarea>
</div>
';
$advertdmfouredit = '
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
?>