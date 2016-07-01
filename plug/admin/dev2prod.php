<?php
//philum_plugin_dev2prod

function plug_dev2prod($p,$o){$r=explore('progb','files',1); 
$old='_old/'.date('ymd').'/'; mkdir_r($old);
$olb='_old/'.date('ym').'/'; mkdir_r($olb);
foreach($r as $k=>$v){if($v!='_trash.php'){
	$fa='progb/'.$v; $da=filemtime($fa); $sa=filesize($fa);
	$fb='prog/'.$v; $db=filemtime($fb); $sb=filesize($fb);
	if(date('d')=='01')copy($fb,$olb.$v);
	if($sa!=$sb or $da>$db){copy($fb,$old.$v); copy($fa,$fb); $ret.=strdeb($v,'.').' ';}}}
return $ret;}

?>