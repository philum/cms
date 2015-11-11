<?php
//philum_plugin_ifram
session_start();

function ifrcorr($d,$f){$a=http(http_domain($f)).'/';
$d=str_replace('src="/','src="'.$a,$d);
$d=str_replace('href="/','href="'.$a,$d);
return $d;}

function ifrget($a,$b,$f){$f=ajxg($f); $f=http($f); if($a)ifradd();
if($f){$ret=read_file($f); $ret=ifrcorr($ret,$f);
	if(is_image($f) && $ret)$ret=image($f);}
$encoding=embed_detect(strtolower($ret),"charset=",'"',"");
if(strtolower($encoding)=="utf-8" or strpos($ret,'é'))$ret=utf8_decode_b($ret);
return $ret;}

function plug_ifram($d,$o=''){$rid=randid();
$bt=lj('txtbox','ifru'.$rid.'_plug___ifram_ifrget___furl'.$rid,"&#9658;");
//$bt=lj('txtbox','ifru'.$rid.'_plug___ifram_ifrget_1__furl'.$rid,"+");
$ret=divs('',autoclic('furl'.$rid,'Url','64','1000" id="furl','').$bt).br();
$ret.=divd('ifru'.$rid,'');
return $ret;}

?>
