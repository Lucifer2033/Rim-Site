<?php
	use MCServerStatus\MCQuery;
	require_once($_SERVER['DOCUMENT_ROOT'].'/engine/minecraft-server-status-master/vendor/autoload.php');
	$ip = (string)htmlspecialchars($_GET["ip"]);
	$ports = explode(':',$ip);
	if(array_key_exists(1, $ports) == false){
	$response=MCQuery::check($ports[0]);
	}else{
	$response=MCQuery::check($host = $ports[0],$port = (int)$ports[1]);
	}
	echo json_encode($response->toArray());
?>