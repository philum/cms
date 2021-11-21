<?php
//philum_plugin_buildtable

function add_quotes($r){
foreach($r as $k=>$v)foreach($v as $ka=>$va)$r[$k][$ka]='"'.$va.'"';
return $r;}

function bt_func($d){
//$d=codeline::parse($d,'','delconn');
if(strpos($d,'§'))$d=strto(strend($d,'§'),']');
$d=trim($d);
return $d;}

function buildtable_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); $ret='';
$p=str_replace(['[',':table]'],'',$p);
if(strpos($p,'¬')===false)$p=str_replace("\n",'¬',$p);
$r=explode('¬',$p);
foreach($r as $k=>$v){$rb=explode('|',$v);
	foreach($rb as $ka=>$va)$rc[$k][$ka]='"'.bt_func($va).'"';}
foreach($rc as $k=>$v)if(is_array($v))$ret.='$r['.($k+1).']=['.implode(',',$v).'];'; return $ret;
//foreach($rc as $k=>$v)if(is_array($v))$ret.=($k+1).'=>['.implode(',',$v).']';
return '$r=['.$ret.']';}

function buildtable_jb($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); $ret=''; $p=trim($p); $rt=[];
$p=str_replace(['[',']'],'',$p); $r=explode("\n",$p);
foreach($r as $k=>$v){$rb=explode('=>',$v); $rt[trim($rb[0])]=trim($rb[1]);}
return eco(msql::dump($rt),1);}

function buildtable_menu($p,$o,$rid){//$ret.=input1('inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_buildtable_buildtable*j___inp',picto('ok')).br();
$ret.=textarea('inp',$p,54,18);
return $ret;}

function plug_buildtable($p,$o){$rid='plg'.randid();
$bt=buildtable_menu($p,$o,$rid);
$ret=buildtable_j($p,$o);
return $bt.divd($rid,$ret);}

?>