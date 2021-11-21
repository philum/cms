<?php
//philum_plugin_oomocss

function oomocss_demo($p){
return span(att($p),oomo($p,32));}

function oomocss_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=oomocss_demo($p,$o);
return $ret;}

function oomocss_all($p,$o,$res=''){
$r=msql_read('system','edition_pictos_2','',1);
foreach($r as $k=>$v)$ret.=oomocss_demo($k).' ';
return $ret;}

function oomocss_build($p,$o){
$f='css/_oomo.css';
$r=msql_read('system','edition_pictos_2','',1);
$ret='@font-face {font-family: "oomo"; src: url("/fonts/Oomo.eot?iefix") format("eot"), url("/fonts/Oomo.woff?v1.04") format("woff"), url("/fonts/Oomo.svg#oomo") format("svg"), url("/fonts/Oomo.ttf") format("truetype");}
.oomo{font-family:"oomo";}'."\n";
foreach($r as $k=>$v){#\01F50D
	//$v='\\'.str_pad(dechex($v),6,0,STR_PAD_LEFT);
	$ret.='.oo-'.$k.':before{content:"\\'.$v[0].'";}'."\n";}
write_file($f,$ret);
return lka('/'.$f);}

function oomocss_menu($p,$o,$rid){$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_oomocss_oomocss*j___inp',picto('ok')).' ';
$ret.=lj('',$rid.'_plug__2_oomocss_oomocss*all___inp',picto('down')).' ';
$ret.=lj('',$rid.'_plug__2_oomocss_oomocss*build',picto('save')).' ';
return $ret;}

function plug_oomocss($p,$o){$rid=randid('plg');
Head::add('csslink','/css/_oomo.css');
$bt=oomocss_menu($p,$o,$rid);
$bt.=msqbt('system','edition_pictos_2');
//$ret.=oomocss_build($p,$o);
return $bt.divd($rid,$ret);}

?>