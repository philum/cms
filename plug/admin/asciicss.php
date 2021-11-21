<?php
//philum_plugin_asciicss

function asciicss_demo($p){
return span(att($p),ascii($p));}

function asciicss_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=asciicss_demo($p,$o);
return $ret;}

function asciicss_all($p,$o,$res=''){
$r=msql_read('system','edition_ascii_1','',1);
foreach($r as $k=>$v)$ret.=asciicss_demo($k).' ';
return $ret;}

function asciicss_build($p,$o){
$f='css/_ascii.css';
$r=msql_read('system','edition_ascii_1','',1);
//$ret='@font-face {font-family: "philum"; src: url("/fonts/philum.eot?iefix") format("eot"), url("/fonts/philum.woff?v8.908") format("woff"), url("/fonts/philum.svg#philum") format("svg"), url("/fonts/philum.ttf") format("truetype");}';
//$ret='.philum{font-family:"philum"; height:20px; font-size:16px; display:inline-block; text-align:center;}'."\n";
foreach($r as $k=>$v){#\01F50D
	//$v='\\'.str_pad(dechex($v),6,0,STR_PAD_LEFT);
	$ret.='.as-'.$k.':before{content:"\\'.dechex($v).'";}'."\n";}
write_file($f,$ret);
return lka($f);}

function asciicss_menu($p,$o,$rid){$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_asciicss_asciicss*j___inp',picto('ok')).' ';
$ret.=lj('',$rid.'_plug__2_asciicss_asciicss*all___inp',picto('down')).' ';
$ret.=lj('',$rid.'_plug__2_asciicss_asciicss*build',picto('save')).' ';
return $ret;}

function plug_asciicss($p,$o){$rid=randid('plg');
Head::add('csslink','/css/_ascii.css');
$bt=asciicss_menu($p,$o,$rid);
$bt.=msqbt('system','edition_ascii_1');
//$ret.=asciicss_build($p,$o);
return $bt.divd($rid,$ret);}

?>