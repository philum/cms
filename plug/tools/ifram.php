<?php
//philum_plugin_ifram

function ifrgz($dr){$r=explore($dr); //p($r);
$f='users/public/ifr'.date('ymd').'.tar';
if(!is_file($f))$ret=tar::gzdir($f,$dr); rmdir_r($dr);
return $ret;}

function ifrim($f,$ret){$dr='users/public/ifram/'; mkdir_r($dr);
write_file($dr.mkday('','ydmHis').'.jpg',$ret);
return image($f);}

function ifradd(){}

function ifrcorr($d,$f){$a=http(domain($f)).'/';
$d=str_replace('src="/','src="'.$a,$d);
$d=str_replace('href="/','href="'.$a,$d);
return $d;}

function ifrget($a,$b,$f){$f=ajxg($f); $f=http($f); if($a)ifradd();
if($f){$ret=read_file($f); $ret=ifrcorr($ret,$f);
	if(is_image($f) && $ret)$ret=ifrim($f,$ret);}
$encoding=embed_detect(strtolower($ret),"charset=",'"',"");
if(strtolower($encoding)=="utf-8" or strpos($ret,'é'))$ret=utf8_decode_b($ret);
return $ret;}

function plug_ifram($d,$o=''){$rid=randid(); if($o)echo ifrgz('users/public/ifram/');
$bt=lj('txtbox','ifru'.$rid.'_plug___ifram_ifrget___furl'.$rid,"&#9658;");
//$bt=lj('txtbox','ifru'.$rid.'_plug___ifram_ifrget_1__furl'.$rid,"+");
$ret=divs('',autoclic('furl'.$rid,'Url','64','1000" id="furl','').$bt).br();
$ret.=divd('ifru'.$rid,'');
return $ret;}

?>