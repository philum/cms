<?php
//philum_plugin_ifrm

function ifrgz($dr){$r=explore($dr);
$f='users/public/ifr'.date('ymd').'.tar';
if(!is_file($f))$ret=plugin('tar',$f,$dr); rmdir_r($dr);
return $ret;}

function ifrim($f,$d){$dr='users/public/ifrm/'; mkdir_r($dr);
$fb=$dr.strrchr_b($f,'/'); write_file($fb,$d);
return image('/'.$fb);}

function ifrget($a,$b,$f){$f=ajxg($f);
if($f){$f=str_replace(array("\n","\r"),' ',$f); $r=explode(' ',$f);
	foreach($r as $v){$d=curl_get_contents($v); if(is_image($v) && $d)$ret.=ifrim($v,$d);}}
return $ret;}

function plug_ifrm($d,$o=''){$rid=randid(); if($o)echo ifrgz('users/public/ifrm/');
$ret=txarea('ifru'.$rid,'',60,10);
$ret.=lj('txtbox',$rid.'_plug___ifrm_ifrget___ifru'.$rid,"&#9658;").br();
$ret.=divd($rid,'');
return $ret;}

?>