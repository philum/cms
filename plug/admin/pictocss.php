<?php
//philum_plugin_pictocss

function pictocss_bt($d){return span(atc('philum ic-'.$d),'').br();}

function pictocss_demo($p){
return $p.':'.pictocss_bt($p);}

function pictocss_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=pictocss_demo($p,$o);
return $ret;}

function pictocss_all($p,$o,$res=''){$ret='';
$r=msql_read('system','edition_pictos','',1);
foreach($r as $k=>$v)$rb[$k]=hexdec($v); asort($rb);
foreach($rb as $k=>$v)$ret.=span(att($k),picto($k,24)).' ';
return $ret;}

function pictocss_build($p,$o){
$f='css/_pictos.css';
$r=msql_read('system','edition_pictos','',1);
$ret='@font-face {font-family: "philum"; src: url("/fonts/philum.eot?iefix") format("eot"), url("/fonts/philum.woff?v15.'.date('ymdhi').'") format("woff"), url("/fonts/philum.svg#philum") format("svg"), url("/fonts/philum.ttf") format("truetype");}
.philum{font-family:"philum";}'."\n";
foreach($r as $k=>$v){
	$ret.='.ic-'.$k.':before{content:"\\'.$v.'";}'."\n";}
write_file($f,$ret);
return lka('/'.$f);}

function pictocss_menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_pictocss_pictocss*j___inp',picto('ok')).' ';
$ret.=lj('',$rid.'_plug__2_pictocss_pictocss*all___inp',picto('eye')).' ';
$ret.=lj('',$rid.'_plug__2_pictocss_pictocss*build',picto('save')).' ';
return $ret;}

function plug_pictocss($p,$o){$rid=randid('plg');
Head::add('csslink','/css/_pictos.css');
$bt=pictocss_menu($p,$o,$rid);
$bt.=msqbt('system','edition_pictos');
//$ret.=pictocss_build($p,$o);
return $bt.divd($rid,'');}

?>