<?php
require_once('mysql.php');
require_once('Rcon.php');
require_once('config.php');
$tovars = "";
$items = array();
$itemsamdcate = array();
$admlistchesk = array();
$URLSITES = URLSITE;
$select = $mysqli->query("SELECT * FROM `RD-RCONDATA`;");
$usersadmins = $mysqli->query("SELECT * FROM `RD-ADMIN`;");
$silki = $mysqli->query("SELECT * FROM `RD-SILKA` ORDER BY `RD-SILKA`.`pos` ASC;");
$pages = $mysqli->query("SELECT * FROM `RD-PAGES`;");
$lastdonatresulte = $mysqli->query("SELECT * FROM `RD-PAYMENT` WHERE `give` = 1 ORDER BY `id` DESC LIMIT 6;");
$rddonresulte = $mysqli->query("SELECT * FROM `RD-DONAT` ORDER BY `RD-DONAT`.`pos` ASC;");
while($row = $rddonresulte->fetch_assoc())
{
    $id = (string)$row['id'];
    $title = (string)$row['title'];
    $price = (string)$row['price'];
    $command = (string)$row['command'];
    $doplata = (string)$row['doplata'];
    $pos = (string)$row['pos'];
    $category = (string)$row['category'];
    $server = (string)$row['server'];
    $lockup = (string)$row['lockup'];
    $amountse = (string)$row['amount'];
    foreach (explode('&&', $server) as $servrc) {
    if(!isset($items[$category])){
    $items[$category]['cat'] = $pos;
    $items["server=$servrc"]["cod=$category"]  = '';
    }
    if($amountse == '*'){
    $items["server=$servrc"]["cod=$category"] .= "\n<option data-price=$price data-id=$pos value='$id' data-value='$servrc'>$title - $price ₽</option>\n";
    $items[$category]['cod'] .= "\n<option data-price=$price data-id=$pos value='$id' data-value='$servrc'>$title - $price ₽</option>\n";
    }else if($amountse > 0){
    $items["server=$servrc"]["cod=$category"] .= "\n<option data-price=$price data-id=$pos value='$id' data-value='$servrc'>$title - $price ₽ ($amountse Шт.)</option>\n";
    $items[$category]['cod'] .= "\n<option data-price=$price data-id=$pos value='$id' data-value='$servrc'>$title - $price ₽ ($amountse Шт.) Шт.</option>\n";
    }
}
}
while ($result = mysqli_fetch_assoc($select)) {
    $wserver = (string)$result['server'];
    $serversresulte = $mysqli->query("SELECT * FROM `RD-RCONDATA` WHERE `server` = '$wserver' AND `status` = 1;");
    $rdcateresulte = $mysqli->query("SELECT * FROM `RD-CATEGORY` ORDER BY `RD-CATEGORY`.`pos` ASC;");
    while($row = $rdcateresulte->fetch_assoc())
    {
        $id = (string)$row['id'];
        $title = (string)$row['title'];
        $pos = (string)$row['pos'];
        $npos = (int)$row['pos'];
        $itemsamdcate["cate_edit=$id=form"] = '
        <form action="'.$URLSITES.'admin/cpanel.php?mode=category" id="category" class="card" method="POST" data-toggle="validator" novalidate="true">
        <div class="card-content">
        <div class="form-group label-floating is-empty">
        <input name="mode" type="hidden" value=category>
        <input name="modeapi" type="hidden" value=category_edit>
        <input name="idse" type="hidden" value='.$id.'>
        <label for="title" class="control-label">Название</label>
        <input type="text" id="title" name="title" class="form-control" value="'.$title.'" required="">
        <span class="material-input"></span></div>
        <div class="form-group label-floating is-empty">
        <label for="priority" class="control-label">Приоритет показа</label>
        <input type="number" id="priority" name="priority" class="form-control" value="'.$npos.'" required="">
        <span class="material-input"></span></div>
        <button class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
        </div>
        </form>
        ';
        if(!isset($admlistchesk["categoryadminslist=$title&id=$id"])){
        $admlistchesk["categoryadminslist=$title&id=$id"] = 'CHECK';
        $items['listadmcate'] .= "
        <tr>
        <td>$id</td>
        <td>$title</td>
        <td>$pos</td>
        <td class='td-actions'>
        <a href='?mode=category&do=edit&id=$id' rel='tooltip' class='btn btn-info btn-simple' data-original-title='Редактировать'><i class='material-icons'>edit</i></a>
        <a href='?mode=category&do=delete&id=$id' rel='tooltip' class='btn btn-danger btn-simple' data-original-title='Удалить'><i class='material-icons'>close</i></a>
        </td>
        </tr>
        ";
        }
        $codeses = (string)$items["server=$wserver"]["cod=$title"];
        $items["fullcodeserver=$wserver"] .= "<optgroup label='$title'>$codeses</optgroup>";
        $cod = (string)$items["$title"]['cod'];
        $tovars .= "<optgroup label='$title'>$cod</optgroup>";
        if(!isset($admlistchesk["categoryadminslists=$title&id=$id"])){
        $admlistchesk["categoryadminslists=$title&id=$id"] = 'CHECK';
        $items['listcategory'] .= "\n<option value='$title'>$title</option>";
        }
    
    }
    while($row = $serversresulte->fetch_assoc())
    {
    $id = (string)$row['id'];
    $servers = (string)$row['server'];
    $dons = (string)$items["fullcodeserver=$servers"];
    $items['serveradmdonlist'] .= '
    <option value='.$servers.'>'.$servers.'</option>
    ';
    $items['oldknopki'] .= '
    <button onclick="selectServer('.$id.')" class="btn btn-block btn-default">
    <i class="icon chevron-right"></i> Сервер: '.$servers.'
    </button>
    ';
    $items['newknopki'] .= '
    <li class="nav-item">
    <a class="nav-link " onclick="SelectServer("server'.$id.'");">'.$servers.'</a>
    </li>';
    $items['oldform'] .= '
    <form action="select.php" method="POST" id="server'.$id.'" name="server'.$id.'" class="server" data-toggle="validator" data-delay="200" autocomplete="off">
    <p id="selectMenu">
    <button type="button" onclick="selectMenu();" class="btn btn-block btn-primary">
    <i class="icon arrow-left"></i> Вернуться к выбору сервера
    </button>
    </p>
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="form-group has-feedback">
    <input name="idserver" type="hidden" value='.$id.'>
    <input name="nameservers" type="hidden" value='.$servers.'>
    <label for="nickname" class="control-label"><i class="icon user"></i> Введите ваш ник:</label>
    <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Заполните данное поле" pattern="^[А-яA-z-0-9._-]{3,20}$" maxlength="20" minlength="3" required>
    </div>
    <div class="form-group">
    <label for="selid" class="control-label">
    <i class="icon th-list"></i> Выберите товар:</label>
    <select id="selid" name="selid" class="styler width-auto" required>
    '.$dons.'
    </select>
    </div>
    <div class="form-group">
    <label for="kassa"><i class="icon triangle-right"></i> Выберите способ оплаты:</label>
    <select id="kassa" name="kassa" class="styler width-auto" required>
    <option selected disabled value="">Выберите способ оплаты</option>
    <option value="1">
    FreeKassa
    </option>
    <option value="2">
    QiWi
    </option>
    <option value="3">
    AnyPay
    </option>
    <option value="5">
    EnotIo
    </option>
    </select>
    </div>
    <div class="form-group">
    <label for="promo" class="control-label"><i class="icon ruble"></i> Введите скидочный купон (не обязательно):</label>
    <input type="text" id="promo" name="promo" class="form-control" placeholder="Заполните если есть" >
    </div>
    <div class="form-group">
    <div class="btn-group btn-group-justified" role="group">
    <div class="btn-group buy">
    <button class="btn btn-success" type="submit" name="dosubm">Купить / Доплатить</button>
    </div>
    </div>
    </div>
    </div>
    </div>
    </form>
    ';
    $items['newform'] .= '
    <div class="tab-pane fade in show" id="server1">
    <div class="alert alert-info text-center">
    Вы выбрали сервер: <b>'.$servers.'</b>
    </div>
    <form action="select.php"  method="POST" id="server'.$id.'" name="server'.$id.'" class="server" novalidate>
    <input name="idserver" type="hidden" value='.$id.'>
    <input name="nameservers" type="hidden" value='.$servers.'>
    <fieldset>
    <div class="form-group">
    <label>Никнейм игрока</label>
    <input type="text" class="form-control username" id="nickname" name="nickname" placeholder="Введите ваш ник" pattern="^[А-яA-z-0-9._-]{3,20}$" maxlength="20" minlength="3" required>
    </div>
    <div class="form-group">
    <label>Выберите донат на '.$servers.'</label>
    <select class="form-control group" id="selid" name="selid" required>
    '.$dons.'
    </select>
    </div>
    <div class="form-group">
    <label for="kassa"><i class="icon triangle-right"></i> Выберите способ оплаты:</label>
    <select id="kassa" name="kassa" class="form-control group" required>
    <option selected disabled value="">Выберите способ оплаты</option>
    <option value="1">
    FreeKassa
    </option>
    <option value="2">
    QiWi
    </option>
    <option value="3">
    AnyPay
    </option>
    <option value="5">
    EnotIo
    </option>
    </select>
    </div>
    <div class="form-group has-feedback">
    <label for="nick" class="control-label">Введите промокод:</label>
    <input type="text" class="input-promo form-control" name="promo" id="promo" placeholder="Введите промокод (если есть)"></div>
    <center>
    <button class="btn btn-primary submit" type="submit" name="dosubm">Купить / Доплатить</button>
    </center>
    </fieldset>
    </form>
    </div>
    ';
    }
    }
while ($row = $pages->fetch_assoc()) {
$ids = (string)$row['id'];
$pageidname = (string)$row['idname'];
$pagenames = (string)$row['name'];
$pagetext = (string)$row['text'];
if(!isset($admlistchesk["pagesadminslist=$pageidname&id=$ids"])){
$admlistchesk["pagesadminslist=$pageidname&id=$ids"] = 'CHECK';
$itemsamdcate["pages_view_adm"] .= "
<tr>
<td><a href='../?mod=page&amp;id=$pageidname'>$pageidname</a></td>
<td>$pagenames</td>
<td class='td-actions'>
<a href='?mode=pages&do=edit&id=$ids' rel='tooltip' class='btn btn-info btn-simple' data-original-title='Редактировать'><i class='material-icons'>edit</i></a>
<a href='?mode=pages&do=delete&id=$ids' rel='tooltip' class='btn btn-danger btn-simple' data-original-title='Удалить'><i class='material-icons'>close</i></a>
</td>
</tr>
";
$itemsamdcate["pages_index_model"] .= '
<div class="modal fade bd-example-modal-lg" id='.$pageidname.' tabindex=-1 role=dialog aria-labelledby=agreement aria-hidden=true>
<div class="modal-dialog modal-lg">
    <div class=modal-content>
        <div class=modal-header>'.$pagenames.'
            <button type=button class=close data-dismiss=modal aria-hidden=true>×</button>
        </div>
        '.$pagetext.'
    </div>
</div>
</div>
';
}
if(!isset($admlistchesk["pagesadminsforms=$pageidname&id=$ids"])){
    $admlistchesk["pagesadminsforms=$pageidname&id=$ids"] = 'CHECK';
    $itemsamdcate["pages_edit=$ids=form"] = '
    <form action="'.$URLSITES.'admin/cpanel.php?mode=pages" id="pages" class="card" method="POST" data-toggle="validator">
    <div class="card-content">
    <form method="post">
    <div class="form-group label-floating">
    <input name="idse" type="hidden" value='.$ids.'>
    <input name="mode" type="hidden" value=pages>
    <input name="modeapi" type="hidden" value=pages_edit>
    <label for="name" class="control-label">Идентификатор страницы</label>
    <input type="text" id="name" name="name" class="form-control" value="'.$pageidname.'" required>
    </div>
    <div class="form-group label-floating">
    <label for="title" class="control-label">Название</label>
    <input type="text" id="title" name="title" class="form-control" value="'.$pagenames.'" required>
    </div>
    <div class="form-group label-floating">
    <textarea id="editoradverts_text_1" name="editoradverts_text_1" class="form-control" required placeholder="Загрузка редактора...">
    '.$pagetext.'
    </textarea>
    </div>
    <button type="submit" class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
    </form>
    </div>
    </form>
    ';
    }
}
while ($row = $silki->fetch_assoc()) {
$ids = (string)$row['id'];
$silka = (string)$row['silka'];
$sheader = (string)$row['header'];
$sfooter = (string)$row['footer'];
$sname = (string)$row['name'];
$spos = (string)$row['pos'];
$items['silkaadmlist'] .= "
<tr>
<td>$sname</td>
<td>$silka</td>
<td>$sheader</td>
<td>$sfooter</td>
<td>$spos</td>
<td class='td-actions'>
<a href='?mode=links&do=edit&id=$ids' rel='tooltip' class='btn btn-info btn-simple' data-original-title='Редактировать'><i class='material-icons'>edit</i></a>
<a href='?mode=links&do=delete&id=$ids' rel='tooltip' class='btn btn-danger btn-simple' data-original-title='Удалить'><i class='material-icons'>close</i></a>
</td>
</tr>
";
$itemsamdcate["links_edit=$ids=chapter_1=form"] = '';
$itemsamdcate["links_edit=$ids=chapter_2=form"] = '';
$itemsamdcate["links_edit=$ids=chapter_3=form"] = '';
$itemsamdcate["links_edit=$ids=chapter_1=head"] =  '<option value="1">Да</option><option value="0">Нет</option>';
$itemsamdcate["links_edit=$ids=chapter_2=footer"] = '<option value="1">Да</option><option value="0">Нет</option>';
$itemsamdcate["links_edit=$ids=chapter_1=form"] = '
<form action="'.$URLSITES.'admin/cpanel.php?mode=links" id="links" class="card" method="POST" data-toggle="validator" novalidate="true">
<div class="card-content">
<input name="mode" type="hidden" value=links>
<input name="modeapi" type="hidden" value=links_edit>
<input name="idse" type="hidden" value='.$ids.'>
<div class="form-group label-floating is-empty">
<label for="name" class="control-label">Название</label>
<input type="text" class="form-control" name="name" id="name" value="'.$sname.'" required="yes">
<span class="material-input"></span></div>
<div class="form-group label-floating is-empty">
<label for="link" class="control-label">Ссылка</label>
<input type="text" class="form-control" name="link" id="link" value="'.$silka.'">
<div class="form-group label-floating">
<select id="head" name="head" class="selectpicker" data-style="select-with-transition" title="Выберите"  required>
<option disabled selected>Показать вверху</option>
';
$itemsamdcate["links_edit=$ids=chapter_2=form"] = '
</select>
</div>
<div class="form-group label-floating">
<select id="footer" name="footer" class="selectpicker" data-style="select-with-transition" title="Выберите"  required>
<option disabled selected>Показать внизу</option>
';
$itemsamdcate["links_edit=$ids=chapter_3=form"] = '
</select>
</div>
<span class="material-input"></span></div>
<div class="form-group is-empty">
<label for="pos" class="control-label">Позиция</label>
<input type="number" class="form-control" name="pos" id="pos" value="'.$spos.'" required="yes">
<span class="material-input"></span></div>
<button class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
</div>
</form>
';
switch ($sheader) {
    case '0':
    $reparray = str_replace('<option value="0">Нет</option>','<option value="0" selected>Нет</option>',$itemsamdcate["links_edit=$ids=chapter_1=head"]);
    $itemsamdcate["links_edit=$ids=chapter_1=head"] = $reparray;
    break;
    case '1':
    $reparray = str_replace('<option value="1">Да</option>','<option value="1" selected>Да</option>',$itemsamdcate["links_edit=$ids=chapter_1=head"]);
    $itemsamdcate["links_edit=$ids=chapter_1=head"] = $reparray;
    $items['oldsilkisheader'] .= '<ul class="nav navbar-nav"><li><a href="'.$silka.'">'.$sname.'</a></li></ul>';
    $items['newsilkisheader'] .= '<li class="nav-item"><a class="nav-link" href="'.$silka.'">'.$sname.'</a></li>';
    break;
}
switch ($sfooter) {
    case '0':
    $replockarray = str_replace('<option value="0">Нет</option>','<option value="0" selected>Нет</option>',$itemsamdcate["links_edit=$ids=chapter_2=footer"]);
    $itemsamdcate["links_edit=$ids=chapter_2=footer"] = $replockarray;
    break;
    case '1':
    $replockarray = str_replace('<option value="1">Да</option>','<option value="1" selected>Да</option>',$itemsamdcate["links_edit=$ids=chapter_2=footer"]);
    $itemsamdcate["links_edit=$ids=chapter_2=footer"] = $replockarray;
    $items['silkisfooter'] .= '<a href="'.$silka.'"> '.$sname.' </a>';
    break;
}
}
$selectserver = $mysqli->query("SELECT * FROM `RD-RCONDATA`;");
while ($rowservs = $selectserver->fetch_assoc()) {
    $servid = (string)$rowservs['id'];
    $servrip = (string)$rowservs['ip'];
    $servrport = (string)$rowservs['port'];
    $servrrconport = (string)$rowservs['rconport'];
    $servrpass = (string)$rowservs['password'];
    $servr = (string)$rowservs['server'];
    $servstats = (string)$rowservs['status'];
    $itemsamdcate["rcondata_$servid=formedit"] = '';
    $itemsamdcate["rcondata_$servid=formedit"] .=
    '
    <form action="'.$URLSITES.'admin/cpanel.php?mode=rcon" id="rcon" class="card" method="POST" data-toggle="validator">
    <div class="card-content">
    <input name="mode" type="hidden" value=rcon>
    <input name="modeapi" type="hidden" value=rcon_edit>
    <input name="idse" type="hidden" value='.$servid.'>
    <div class="form-group label-floating">
    <label for="servip" class="control-label">Айпи</label>
    <input type="text" id="servip" name="servip" class="form-control" value="'.$servrip.'" required>
    </div>
    <div class="form-group label-floating">
    <label for="servport" class="control-label">Порт</label>
    <input type="number" id="servport" name="servport" class="form-control" value="'.$servrport.'"required>
    </div>
    <div class="form-group label-floating">
    <label for="servrconport" class="control-label">Ркон порт</label>
    <input type="number" id="servrconport" name="servrconport" class="form-control" value="'.$servrrconport.'" required>
    </div>
    <div class="form-group label-floating">
    <label for="servpassword" class="control-label">Пароль</label>
    <input type="text" id="servpassword" name="servpassword" class="form-control" value="'.$servrpass.'" required>
    </div>
    <div class="form-group label-floating">
    <label for="servname" class="control-label">Название</label>
    <input type="text" id="servname" name="servname" class="form-control" value="'.$servr.'" required>
    </div>
    <div class="form-group label-floating">
    <label for="status" class="control-label">Вкл сервер для покупки</label>
    <select id="status" name="status" class="selectpicker" data-style="select-with-transition" title="Вкл сервер для покупки"  required>
    <option value="0">Нет</option>
    <option value="1">Да</option>
    </select>
    <button class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
    </div>
    </form>
    ';
    switch ($servstats) {
        case '0':
        $reparray = str_replace('<option value="0">Нет</option>','<option value="0" selected>Нет</option>',$itemsamdcate["rcondata_$servid=formedit"]);
        $itemsamdcate["rcondata_$servid=formedit"] = $reparray;
        break;
        case '1':
        $reparray = str_replace('<option value="1">Да</option>','<option value="1" selected>Да</option>',$itemsamdcate["rcondata_$servid=formedit"]);
        $itemsamdcate["rcondata_$servid=formedit"] = $reparray;
        break;
    }
    $items['listadmserver'] .= "
    <tr>
    <td>$servid</td>
    <td>$servrip</td>
    <td>$servrport</td>
    <td>$servrrconport</td>
    <td>$servrpass</td>
    <td>$servr</td>
    <td>$servstats</td>
    <td class='td-actions'>
    <a href='?mode=rcon&do=edit&id=$servid' rel='tooltip' class='btn btn-info btn-simple' data-original-title='Редактировать'><i class='material-icons'>edit</i></a>
    <a href='?mode=rcon&do=delete&id=$servid' rel='tooltip' class='btn btn-danger btn-simple' data-original-title='Удалить'><i class='material-icons'>close</i></a>
    </td>
    </tr>
    ";
    
}
while($row = $lastdonatresulte->fetch_assoc())
{
    $id = (string)$row['id'];
    $nick = (string)$row['nick'];
    $dates = (string)$row['data'];
    $ldonat = (string)$row['namedonat'];
    $price = (string)$row['price'];
    if(!isset($admlistchesk["lastplayeradminslist=$nick&id=$id"])){
        $admlistchesk["lastplayeradminslist=$nick&id=$id"] = 'CHECK';
    $items['oldlastdonate'] .= '
    <div class="col-sm-2">
    <img src="'.$URLSITES.'face.php?name='.$nick.'" alt="'.$nick.'" class="img-circle" data-toggle="tooltip" data-placement="top" title="'.$ldonat.' в '.$dates.'">
    <p>'.$nick.'</p>
    </div>';
    $items['newlastdonate'] .= '
    <div class="payment-id window item-id" data-modal="paymodal" data-id="'.$id.'" style="display: block;">
    <div class="image" style="background-image: url(face.php?name='.$nick.');"></div>
    <div class="title">'.$ldonat.'</div>
    <div class="player">'.$nick.'</div>
    <div class="price">'.$price.' <i class="fa fa-ruble col-black"></i></div>
    </div>';
    $items['lastdonateadmins'] .= '
    <div class="col-xs-6 col-sm-2">
    <img src="'.$URLSITES.'face.php/?name='.$nick.'" alt="'.$nick.'" class="img-circle" style="width: auto;" rel="tooltip" data-original-title="'.$ldonat.' '.$dates.'">
    <p>'.$nick.'</p>
    </div>
    ';
    }
}
$rddonadmresulte = $mysqli->query("SELECT * FROM `RD-DONAT`  ORDER BY `RD-DONAT`.`id` ASC;");
while ($row = $rddonadmresulte->fetch_assoc()) {
    $id = (string)$row['id'];
    $title = (string)$row['title'];
    $price = (string)$row['price'];
    $command = (string)$row['command'];
    $doplata = (string)$row['doplata'];
    $pos = (string)$row['pos'];
    $category = (string)$row['category'];
    $server = (string)$row['server'];
    $lockup = (string)$row['lockup'];
    $amountse = (string)$row['amount'];
    $cmd = explode('&&',$command);
    $admcatess  = $mysqli->query("SELECT * FROM `RD-CATEGORY` ORDER BY `RD-CATEGORY`.`pos` ASC;");
    $selectserveradm = $mysqli->query("SELECT * FROM `RD-RCONDATA`;");
    $itemsamdcate["goods_edit=$id=chapter_1=form"] = '';
    $itemsamdcate["goods_edit=$id=chapter_2=form"] = '';
    $itemsamdcate["goods_edit=$id=chapter_3=form"] = '';
    $itemsamdcate["goods_edit=$id=chapter_4=form"] = '';
    $itemsamdcate["goods_edit=$id=chapter_5=form"] = '';
    $itemsamdcate["goods_edit=$id=chapter_6=form"] = '';
    $itemsamdcate["goods_edit=$id=chapter_1=cate"] = '';
    $itemsamdcate["goods_edit=$id=chapter_2=serv"] = '';
    $itemsamdcate["goods_edit=$id=chapter_3=dop"] = '<option value="1">Да</option><option value="0">Нет</option>';
    $itemsamdcate["goods_edit=$id=chapter_4=lock"] = '<option value="1">Да</option><option value="0">Нет</option>';
    $itemsamdcate["goods_edit=$id=chapter_5=cmd"] = '';
    $textcates = $itemsamdcate["goods_edit=$id=chapter_1=cate"];
    switch ($doplata) {
        case '0':
        $reparray = str_replace('<option value="0">Нет</option>','<option value="0" selected>Нет</option>',$itemsamdcate["goods_edit=$id=chapter_3=dop"]);
        $itemsamdcate["goods_edit=$id=chapter_3=dop"] = $reparray;
        break;
        case '1':
        $reparray = str_replace('<option value="1">Да</option>','<option value="1" selected>Да</option>',$itemsamdcate["goods_edit=$id=chapter_3=dop"]);
        $itemsamdcate["goods_edit=$id=chapter_3=dop"] = $reparray;
        break;
    }
    switch ($lockup) {
        case '0':
        $replockarray = str_replace('<option value="0">Нет</option>','<option value="0" selected>Нет</option>',$itemsamdcate["goods_edit=$id=chapter_4=lock"]);
        $itemsamdcate["goods_edit=$id=chapter_4=lock"] = $replockarray;
        break;
        case '1':
        $replockarray = str_replace('<option value="1">Да</option>','<option value="1" selected>Да</option>',$itemsamdcate["goods_edit=$id=chapter_4=lock"]);
        $itemsamdcate["goods_edit=$id=chapter_4=lock"] = $replockarray;
        break;
    }
while ($rowcates = $admcatess->fetch_assoc()) {
    $cates = (string)$rowcates['title'];
    $itemsamdcate["goods_edit=$id=chapter_1=cate"] .= "<option value='$cates'>$cates</option>";
    $namepoisk = "<option value='$cates'>$cates</option>";
    $namepoisktwo = "<option value='$cates' selected>$cates</option>";
    if($namepoisk == "<option value='$category'>$category</option>"){
    $reparray = str_replace($namepoisk,$namepoisktwo,$itemsamdcate["goods_edit=$id=chapter_1=cate"]);
    $itemsamdcate["goods_edit=$id=chapter_1=cate"] = $reparray;
    }
}

while ($rowserv = $selectserveradm->fetch_assoc()) {
    $servid = (string)$rowserv['id'];
    $servrip = (string)$rowserv['ip'];
    $servrport = (string)$rowserv['port'];
    $servrrconport = (string)$rowserv['rconport'];
    $servrpass = (string)$rowserv['password'];
    $servr = (string)$rowserv['server'];
    $itemsamdcate["goods_edit=$id=chapter_2=serv"] .= "<option value='$servr'>$servr</option>";
    $namepoisk = "<option value='$servr'>$servr</option>";
    $namepoisktwo = "<option value='$servr' selected>$servr</option>";
    if($namepoisk == "<option value='$servr'>$servr</option>"){
    $reparray = str_replace($namepoisk,$namepoisktwo,$itemsamdcate["goods_edit=$id=chapter_2=serv"]);
    $itemsamdcate["goods_edit=$id=chapter_2=serv"] = $reparray;
    }
}
for ($ids=0; $ids < count($cmd); $ids++) { 
    $itemsamdcate["goods_edit=$id=chapter_5=cmd"] .= '
<div id="command_'.$ids.'" class="command">
<div class="input-group form-group label-floating">
<label for="command_c_'.$ids.'" class="control-label">Команда</label>
<input type="text" name="command['.$ids.']" class="form-control" value="'.$cmd[$ids].'" required="">
<span class="input-group-btn">
<button type="button" class="btn btn-warning btn-round" onclick="removeid('.$ids.')"><i class="material-icons">delete</i></button>
</span>
<span class="material-input"></span>
</div>
</div>
';
    }

    $itemsamdcate["goods_edit=$id=chapter_1=form"] = '
    <form action="'.$URLSITES.'admin/cpanel.php?mode=goods" id="goods" class="card" method="POST" data-toggle="validator">
        <div class="card-content">
        <div class="form-group label-floating">
        <label for="name" class="control-label">Название</label>
        <input type="text" id="name" name="name" class="form-control" value="'.$title.'" required>
        </div>
        <input name="mode" type="hidden" value=goods>
        <input name="modeapi" type="hidden" value=goods_edit>
        <input name="idse" type="hidden" value='.$id.'>
        <div class="form-group label-floating">
        <label for="cost" class="control-label">Цена</label>
        <input type="number" id="cost" name="cost" class="form-control" value="'.$price.'" min="10" required>
        </div>
        <hr>
        <div class="form-group label-floating">
        <label for="cat" class="control-label">Категория</label>
        <select id="cat" name="cat" class="selectpicker" data-style="select-with-transition" title="Выберите категорию"  required>
        <option disabled> Выберите категорию</option>
        ';
        $itemsamdcate["goods_edit=$id=chapter_2=form"] = '
        </select>
        </div>
        <div class="form-group label-floating">
        <label for="server" class="control-label">Сервер</label>
        <select id="server" name="server[]" class="selectpicker" multiple data-style="select-with-transition" title="Выберите сервер" required>
        <option disabled> Выберите сервер</option>
        ';
        $itemsamdcate["goods_edit=$id=chapter_3=form"] = '
        </select>
        </div>
        <div class="form-group label-floating">
        <label for="priority" class="control-label">Приоритет показа</label>
        <input type="number" id="priority" name="priority" class="form-control" value="'.$pos.'" required>
        </div>
        <div class="form-group label-floating">
        <label for="counts" class="control-label">Количество если без то *</label>
        <input type="string" id="counts" name="counts" class="form-control" value="'.$amountse.'" required>
        </div>
        <div class="form-group label-floating">
        <label for="dobuy" class="control-label">Доплата</label>
        <select id="dobuy" name="dobuy" class="selectpicker" data-style="select-with-transition" title="Разрешить доплачивать?"  required>
        <option disabled> Разрешить доплачивать?</option>
        ';
        $itemsamdcate["goods_edit=$id=chapter_4=form"] = '
        </select>
        </div>
        <div class="form-group label-floating">
        <label for="zapret" class="control-label">Запретить покупку равен или выше этого</label>
        <select id="zapret" name="zapret" class="selectpicker" data-style="select-with-transition" title="Разрешить доплачивать?"  required>
        <option disabled>Запретить покупку равен или выше этого?</option>
        ';
        $itemsamdcate["goods_edit=$id=chapter_5=form"] = '
        </select>
        </div>
        <hr>
        <div class="form-group">
        <label for="rcon_command" class="control-label">Команды для выдачи:</label>
        <button type="button" class="btn btn-primary btn-block" onclick="add()"><i class="material-icons">add</i> Дoбавить</button>
        <hr>
        <div class="commands">
        ';
        $itemsamdcate["goods_edit=$id=chapter_6=form"] = '
        </div>
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
        ';
        if(!isset($admlistchesk["donateadminslist=$title&id=$id"])){
        $admlistchesk["donateadminslist=$title&id=$id"] = 'CHECK';
        $items['listadmdonate'] .= "
        <tr>
        <td>$id</td>
        <td>$title</td>
        <td>$price руб.</td>
        <td>$category</td>
        <td>$pos</td>
        <td>$server</td>
        <td>$amountse</td>
        <td class='td-actions'>
        <a href='?mode=goods&do=edit&id=$id' rel='tooltip' class='btn btn-info btn-simple' data-original-title='Редактировать'><i class='material-icons'>edit</i></a>
        <a href='?mode=goods&do=delete&id=$id' rel='tooltip' class='btn btn-danger btn-simple' data-original-title='Удалить'><i class='material-icons'>close</i></a>
        </td>
        </tr>
        ";
        }
}
$promocodes = $mysqli->query("SELECT * FROM `RD-PROMOCODE`;");
$admpokupki = $mysqli->query("SELECT * FROM `RD-PAYMENT`;");
while ($row = $admpokupki->fetch_assoc()) {
    $id = (string)$row['id'];
    $nick = (string)$row['nick'];
    $dates = (string)$row['data'];
    $ldonat = (string)$row['namedonat'];
    $price = (string)$row['price'];
    $give = (string)$row['give'];
    $server = (string)$row['server'];
    if(!isset($admlistchesk["donateshopadminslist=$nick&id=$id"])){
    $admlistchesk["donateshopadminslist=$nick&id=$id"] = 'CHECK';
    if($give == 0){
    $items['listadminpaymets'] .= '
    <tr>
    <td>'.$id.'</td>
    <td>'.$nick.'</td>
    <td>'.$dates.'</td>
    <td><span style="color: #ff0000; font-weight: bold;">Не оплачен/не выдан</span></td>
    <td style="padding: 0px;">
    <a href="?mode=payments&do=view&id='.$id.'" rel="tooltip" class="btn btn-info btn-simple btn-icon" data-original-title="Просмотреть"><i class="material-icons">visibility</i></a>
    </td>
    </tr>
    ';
    $items['payment_view_'.$id.''] .= '
    <p><b>Статус:</b> <span style="color:#ff0000; font-weight: bold;">Не оплачен/не выдан</span></p>
    <p><b>Дата платежа:</b> '.$dates.'</p>
    <p><b>Итог. цена:</b> '.$price.' руб.</p>
    <hr>
    <p><b>Покупатель:</b> '.$nick.'</p>
    <p><b>Товар:</b> '.$ldonat.'</p>
    <p><b>Сервер:</b> '.$server.'</p>
    <hr>
    <p><a href="?mode=payments&do=apay&id='.$id.'" class="btn btn-block btn-danger">Пере-выдать</a></p>
    ';
    }else{
    $items['listadminpaymets'] .= '
    <tr>
    <td>'.$id.'</td>
    <td>'.$nick.'</td>
    <td>'.$dates.'</td>
    <td><span style="color: #4CAF50; font-weight: bold;">Оплачен</span></td>
    <td style="padding: 0px;">
    <a href="?mode=payments&do=view&id='.$id.'" rel="tooltip" class="btn btn-info btn-simple btn-icon" data-original-title="Просмотреть"><i class="material-icons">visibility</i></a>
    </td>
    </tr>
    ';
    $items['payment_view_'.$id.''] .= '
    <p><b>Статус:</b> <span style="color:#4CAF50; font-weight: bold;">Оплачен</span></p>
    <p><b>Дата платежа:</b> '.$dates.'</p>
    <p><b>Итог. цена:</b> '.$price.' руб.</p>
    <hr>
    <p><b>Покупатель:</b> '.$nick.'</p>
    <p><b>Товар:</b> '.$ldonat.'</p>
    <p><b>Сервер:</b> '.$server.'</p>
    <hr>
    <p><a href="?mode=payments&do=apay&id='.$id.'" class="btn btn-block btn-danger">Пере-выдать</a></p>
    ';
    }
    }
}
while($row = $promocodes->fetch_assoc())
{
    $id = (string)$row['id'];
    $name = (string)$row['name'];
    $percent = (string)$row['percent'];
    $amount = (string)$row['amount'];
    $itemsamdcate["cupons_edit=$id=form"] = '
    <form  action="'.$URLSITES.'admin/cpanel.php?mode=cupons" id="cupons" class="card" method="POST" data-toggle="validator" novalidate="true">
    <div class="card-content">
    <div class="form-group">
    <label for="name" class="control-label">Название</label>
    <input name="mode" type="hidden" value=cupons>
    <input name="modeapi" type="hidden" value=cupons_edit>
    <input name="idse" type="hidden" value='.$id.'>
    <input type="text" id="name" name="name" class="form-control" value="'.$name.'" required="">
    <span class="material-input"></span></div>
    <div class="form-group">
    <label for="summ" class="control-label">Скидка (%)</label>
    <input type="number" id="summ" name="summ" class="form-control" value="'.$percent.'" min="1" max="100" required="">
    <span class="material-input"></span></div>
    <div class="form-group">
    <label for="count" class="control-label">Использований</label>
    <input type="number" id="count" name="count" class="form-control" value="'.$amount.'" required="">
    <span class="material-input"></span></div>
    <button class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
    </div>
    </form>
';
if(!isset($admlistchesk["cupadminslist=$name&id=$id"])){
    $admlistchesk["cupadminslist=$name&id=$id"] = 'CHECK';
    $items['listadmcup'] .= "
    <tr>
    <td>$name</td>
    <td>$percent%</td>
    <td>$amount</td>
    <td class='td-actions'>
    <a href='?mode=cupons&amp;do=edit&amp;id=$id' rel='tooltip' class='btn btn-info btn-simple' data-original-title='Редактировать'><i class='material-icons'>edit</i></a>
    <a href='?mode=cupons&amp;do=delete&amp;id=$id' rel='tooltip' class='btn btn-danger btn-simple' data-original-title='Удалить'><i class='material-icons'>close</i></a>
    </td>
    </tr>
    ";
}
}
while ($row = $usersadmins->fetch_assoc()) {
    $id = (string)$row['id'];
    $login = (string)$row['login'];
    $pass = (string)$row['password'];
    $ip = (string)$row['ip'];
    $itemsamdcate["users_edit=$id=form"] = '
    <form action="'.$URLSITES.'admin/cpanel.php?mode=users" id="users" class="card" method="POST" data-toggle="validator" novalidate="true">
    <div class="card-content">
    <input name="mode" type="hidden" value=users>
    <input name="modeapi" type="hidden" value=users_edit>
    <input name="idse" type="hidden" value='.$id.'>
    <div class="form-group label-floating is-empty">
    <label for="login" class="control-label">Логин</label>
    <input type="text" class="form-control" name="login" id="login" value="'.$login.'" required="yes">
    <span class="material-input"></span></div>
    <div class="form-group label-floating is-empty">
    <label for="ip" class="control-label">IP</label>
    <input type="text" class="form-control" name="ip" id="ip" value="" disabled="">
    <span class="material-input"></span></div>
    <div class="form-group is-empty">
    <label for="password" class="control-label">Пароль</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="СКРЫТ" required="yes">
    <span class="material-input"></span></div>
    <button class="btn btn-block btn-danger"><i class="material-icons">save</i> Сохранить</button>
    </div>
    </form>
    ';
    $items['listadmuser'] .= '
    <tr>
    <td>'.$login.'</td>
    <td>'.$ip.'</td>
    <td class="td-actions">
    <a href="?mode=users&amp;do=edit&amp;id='.$id.'" rel="tooltip" title="" class="btn btn-info btn-simple" data-original-title="Редактировать"><i class="material-icons">edit</i></a>
    <a href="?mode=users&amp;do=delete&amp;id='.$id.'" rel="tooltip" title="" class="btn btn-danger btn-simple" data-original-title="Удалить"><i class="material-icons">close</i></a>
    </td>
    </tr>';
}
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "$output";
}
        function vk_msg_send($peer_id,$text,$token){
            $request_params = array(
                'message' => $text, 
                'peer_ids' => $peer_id,
                'access_token' => $token,
                'v' => '5.81',
                'random_id' => '0'
            );
            $get_params = http_build_query($request_params); 
            file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
            header("HTTP/1.1 200 OK");
            echo 'ok';
        }
        function rcon_payment($hash){
            $resultpayments = base64_decode($hash);
            $rowresultpayments = explode(";", $resultpayments);
            $tes = explode('&&', $rowresultpayments[2]);
            global $mysqli;
            $rddonresulte = $mysqli->query("SELECT * FROM `RD-DONAT` WHERE `server` = '$rowresultpayments[3]' AND `id` = $rowresultpayments[1];");
            $rdonsres = $rddonresulte->fetch_assoc();
            $namedons = (string)$rdonsres['title'];
            $amountse = (string)$rdonsres['amount'];
            $tokenbot = VKTOKENS;
            $adminsnotf = ADMINSVK;
            $payments = $rowresultpayments[6];
            vk_msg_send($adminsnotf, "Игрок: $rowresultpayments[0]\nДонат: $namedons\nЦена: $rowresultpayments[5]\nПлатежка: $payments\nСервер: $rowresultpayments[3]",$tokenbot);
            if($amountse != '*'){
            $mysqli->query("UPDATE `RD-DONAT` SET `amount` = `amount` - 1 WHERE `server` = '$rowresultpayments[3]' AND `id` = $rowresultpayments[1];");
            }
            foreach (explode('&&', $rowresultpayments[3]) as $servrc) {
            $servers = $mysqli->query("SELECT * FROM `RD-RCONDATA` WHERE `server` = '$servrc';");
            while($s = $servers->fetch_assoc()){
                $rcon = new Rcon($s['ip'], $s['rconport'], $s['password'], 5);
                foreach (explode('&&', $rowresultpayments[2]) as $c) {
                    $cmd = str_replace('%nick%',$rowresultpayments[0], $c);
                    $pos = strpos($cmd, 'sql:');
                    if(@$rcon->connect()){
                        if($pos === false){
                        $rcon->sendCommand($cmd);
                        }else{
                        $cmde = preg_replace('/&quot;/i', '"', $cmd);
                        $cmde = preg_replace('/sql:/i', '', $cmde);
                        $cmde = str_replace('%nick%',$rowresultpayments[0], $cmde);
                        $mysqli->query("$cmde");
                        }
                        $mysqli->query("UPDATE `RD-PAYMENT` SET `give` = 1 WHERE `server` = '$rowresultpayments[3]' AND `namedonat` = '$namedons' AND `give` = 0 AND `nick` = '$rowresultpayments[0]';");
                        //удалеам отметку о выдаче (для системы перевыдачи не удали потом выдаст и удалит)
                        $mysqli->query("DELETE FROM `RD-ODERS` WHERE `base64` = '$hash';");
                    }
                }
            }
        }
            return die('YES');
        }
        function setIntervalphp($f, $milliseconds)
        {
            $seconds=(int)$milliseconds/1000;
            while(true)
            {
                $f();
                sleep($seconds);
            }
        }
?>