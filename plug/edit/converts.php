<?php
//philum_plugin_converts

function setlocalvar($local,$defaut){
if($_GET[$local]!=""){$ret=$_GET[$local]; $_SESSION[$local]=$ret;}
elseif(!isset($_SESSION[$local])){$ret=$defaut; $_SESSION[$local]=$ret;}
else{$ret=$_SESSION[$local];}
return $ret;}

function bin2ascii($d){$ret='';
	$d=str_replace("\n",'',$d); $d=str_replace(' ','',$d);
	$n=strlen($d); $nb=ceil($n/8);
	for($i=0;$i<$nb;$i++)$r[]=substr($d,$i*8,8);
	if($r)foreach($r as $v)$ret.=chr(bindec($v));
	return $ret;}

function ascii2bin($d){$ret='';
	$r=str_split($d);
	foreach($r as $v)$ret.=str_pad(decbin(ord($v)),8,'0',STR_PAD_LEFT).' ';
	return $ret;}

function ascii_encode($d){$ret='';
	$r=explode(';',$d);
	if($r)foreach($r as $v){
		if(substr($v,0,2)=='&#'){$n=substr($v,2);
			//$va='%u'.utf8_encode(self::unicode(dechex($n)));
			$va=mb_convert_encoding('&#'.intval($n).';','UTF-8','HTML-ENTITIES');}
			else $va=$v;
		$ret.=$va;}
	return $ret;}

function clean_code($d){
$d=str_replace("\r","\n",$d);
$d=ereg_replace("[\n]{2,}","\n",$d);
$ara=array("  ",'( ',' (',' )',') ',' .',' .',' > ',' < ',' =','= '," \n","\n ","{\n","\n{","\n}",', ',' {',' }','{ ','} ','if (','else (','// ');
$arb=array("\t",'(','(',')',')','.','.','>','<','=','=',"\n","\n",'{','{','}',',','{','}','{','}','if(','else(','//');
$d=ereg_replace("[ ]{2,}"," ",$d);
return str_replace($ara,$arb,$d);}

function conv_codage($txt,$d,$enc){
if($d=='utf8')$ret=$enc?utf8_encode(utf8_encode($txt)):utf8_decode_b($txt);
elseif($d=='base64')$ret=$enc?base64_encode($txt):base64_decode($txt);
elseif($d=='htmlentities')$ret=$enc?htmlentities($txt,ENT_QUOTES,'ISO-8859-15',false):html_entity_decode($txt);
elseif($d=='url')$ret=$enc?urlencode($txt):urldecode($txt);
elseif($d=='unescape')$ret=$enc?$ret:unescape($txt,"");
elseif($d=='ascii'){if($enc)$ret=ascii_encode($txt);
	else $ret=mb_convert_encoding($txt,'ASCII')."\r";}
elseif($d=='binary')$ret=$enc?ascii2bin($txt):bin2ascii($txt);
elseif($d=='bin/dec')$ret=$enc?decbin($txt):bindec($txt);
elseif($d=='timestamp')$ret=$enc?strtotime($txt):date('d/m/Y H:i:s',$txt);
elseif($d=='php')$ret=clean_code($txt);
return stripslashes($ret);}

function conv_j($p,$o,$res=''){
$ret=conv_codage(ajxg($res),$p,$o);
return $ret;}

function conv_menu($p,$o,$rid){
$r=array("utf8","htmlentities","url","unescape","base64","ascii","binary","bin/dec","timestamp");
foreach($r as $v){$ret.=$v.':';
	$ret.=lj('txtx',$rid.'_plug__2_converts_conv*j_'.$v.'_1_inp1','encode').' ';
	$ret.=lj('txtblc',$rid.'_plug__2_converts_conv*j_'.$v.'__inp1','decode').' ';}
$r=array("php");
foreach($r as $v)
	$ret.=lj('txtx',$rid.'_plug__2_converts_conv*j_'.$v.'_1_inp1',$v).' ';
$ret.=br().txarea('inp1',$p,81,8,atc('console'));
return $ret;}

function plug_converts($p){$rid='plg'.randid();
$bt=conv_menu($p,$o,$rid);
$ret=conv_j($p,$o);
return $bt.div(atd($rid).atc(''),$ret);}
?>