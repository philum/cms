<?php
//philum_plugin_ifre

function ifrgz($dr){//$r=explore($dr);//p($r);
$f='users/public/ifr'.date('ymd').'.tar';
if(!is_file($f))$ret=tar::gzdir($f,$dr); rmdir_r($dr);
return $ret;}

function ifrim($f,$ret){$dr='users/public/ifram/'; mkdir_r($dr);
write_file($dr.mkday('','ydmHis').'.jpg',$ret);
return image($f);}

function ifrget($a,$b,$f){$f=ajxg($f); $f=http($f);
if($f){$ret=curl_get_contents($f);
	if(is_image($f) && $ret)$ret=ifrim($f,$ret);}
$encoding=embed_detect(strtolower($ret),"charset=",'"',"");
if(strtolower($encoding)=="utf-8" or strpos($ret,'é'))$ret=utf8_decode_b($ret);
return $ret;}

function plug_ifr($d,$o=''){$rid=randid(); if($o)echo ifrgz('users/public/ifram/');
$bt=lj('txtbox','ifru'.$rid.'_plug___ifr_ifrget___furl'.$rid,"&#9658;");
$ret=divs('',autoclic('furl'.$rid,'Url','64','1000" id="furl','').$bt).br();
$ret.=divd('ifru'.$rid,'');
return $ret;}

?>