<?php //dev2prod

class dev2prod{

static function remove($rb){
$r=scandir_r('prog'); $ret='';
foreach($r as $k=>$v){
	[$dr,$f]=split_right('/',$v);//prog ; a/art.php
	$fb='progb/'.$f; if(!is_file($fb)){unlink($v); $ret.=strto($f,'.').' ';}}
if($ret)return br().'remove: '.$ret;}

static function call($p,$o){
//$r=explore('progb','files',0); p($r);
$r=scandir_r('progb'); $ret='ok ';
$old='_old/'.date('ymd').'/'; if(!is_dir($old))mkdir_r($old);
$olb='_old/'.date('ym').'/'; if(!is_dir($olb))mkdir_r($olb);
foreach($r as $k=>$v){
	[$dr,$f]=split_right('/',$v);//progb ; a/art.php
	[$drb,$fx]=split_right('/',$v,1);//progb/a ; art.php
	//if($v!='_trash.php'){}
	$fa='progb/'.$f; $da=filemtime($fa); $sa=filesize($fa);
	$fb='prog/'.$f; if(!is_dir($fb))mkdir_r($fb);
	if(is_file($fb)){$db=filemtime($fb); $sb=filesize($fb);} else $db=$sb=0;
	if(date('d')=='01'){if(!is_dir($olb.$f))mkdir_r($olb.$f); copy($fb,$olb.$f);}
	if($sa!=$sb or $da>$db){
		if(!is_dir($old.$f))mkdir_r($old.$f);
		if(!is_dir($olb.$f))mkdir_r($olb.$f);
		if(is_file($fb))copy($fb,$old.$f);
		copy($fa,$fb);
		$ret.=strto($f,'.').' ';}}
$ret.=self::remove($r);
return $ret;}

}
?>