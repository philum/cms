<?php
//philum_plugin_plug
session_start();
error_reporting(6135);

function plug_slct(){
$r=msql_read('system','program_plugs','',1); //p($r);
//ksort($r);
foreach($r as $k=>$v){
	if($v[2]=='1' && !$v[3] && !$v[5] && $v[1])$rb=tri_tag(str_replace(' ',',',$v[1]));
	if($rb)foreach($rb as $kb=>$vb)$ret[$vb][]=lkc('','/plug/'.$k,$k);}
return divc('',make_tabs($ret));}//onxcols($ret,6,'')

function plug_in($p='',$o='',$res=''){list($plg,$p,$o)=ajxr($res); echo $res;
return plugin($plg,$p,$o);}

function plug_plug($plg,$p='',$o='',$res=''){$rid='plg'.$plg.$p;
if($res)list($plg,$p,$o)=ajxr($res);
$ret.=lj('','pop_plupin___plug____plugin|plugp|plugo',picto('reload')).' ';
$ret.=select_j('plugin','plug','','','','2');
$ret.=input(1,'plugin',$plg?$plg:'plugin','',1).' ';
$ret.=input(1,'plugp',$p?$p:'param','',1).' ';
$ret.=input(1,'plugo',$o?$o:'option','',1).' ';
return $ret.divd($rid,plugin($plg,$p,$o));}

?>