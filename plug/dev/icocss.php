<?php
//philum_plugin_icocss

function icocss_bt($d){return span(atc('philum ic-'.$d),'');}

function icocss_demo($p){
return $p.':'.icocss_bt($p);}

function icocss_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=icocss_demo($p,$o);
return $ret;}

function icocss_build($p,$o){
$f='css/_pictos.css';
$r=msql_read('system','edition_pictos','',1);
//$ret='@font-face {font-family: "philum"; src: url("/fonts/philum.eot?iefix") format("eot"), url("/fonts/philum.woff?v8.908") format("woff"), url("/fonts/philum.svg#philum") format("svg"), url("/fonts/philum.ttf") format("truetype");}';
//$ret='.philum{font-family:"philum"; height:20px; font-size:16px; display:inline-block; text-align:center;}'."\n";
foreach($r as $k=>$v){
	//if($k=='add' or $k=='msql')echo $k.'-'.$v.'-'.ord($v).'-'.dechex(ord($v)).br();
	if($k=='msql')$v='$'; if($k=='less')$v="'";
	if($k=='triangle')$v='å'; if($k=='round')$v='ã';
	if($k=='quote')$v='"'; if($k=='tree')$v='â';
	if($k=='refresh')$v='0'; if($k=='agenda')$v='\\';
	if($k=='builders')$v=',';
	$v='\\'.str_pad(dechex(ord($v)),4,0,STR_PAD_LEFT);
	$ret.='.ic-'.$k.':before{content:"'.$v.'";}'."\n";}
write_file($f,$ret);
return lka($f);}

function icocss_menu($p,$o,$rid){$ret.=inp('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_icocss_icocss*j___inp',picto('reload')).' ';
$ret.=lj('',$rid.'_plug__2_icocss_icocss*build',picto('save')).' ';
return $ret;}

function plug_icocss($p,$o){$rid=randid('plg');
Head::add('csslink','/css/_pictos.css');
$bt=icocss_menu($p,$o,$rid);
$bt.=msqlink('system','edition_pictos');
//$ret.=icocss_build($p,$o);
return $bt.divd($rid,$ret);}

?>