<?php
//philum_plugin_table2array

function table2array_build($res){
$res=str_replace(array('[',':table]'),'',$res);
$r=explode('¬',$res);
foreach($r as $k=>$v){$rb=explode('|',$v);
	foreach($rb as $ka=>$va)$rc[$k][$ka]='"'.str_replace('"','\"',$va);}
foreach($rc as $k=>$v)$ret.='$r['.$k.']=array('.implode(',',$v).');'."\n";
return $ret;}

function table2array_j($p,$o,$res=''){$res=ajxg($res);
return table2array_build($res);}

function table2array_menu($p,$o,$rid){//$ret.=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_table2array_table2array*j___inp',picto('reload')).br();
$ret.=txarea('inp',$p,64,24);
return $ret;}

function plug_table2array($p,$o){$rid='plg'.randid();
$bt=table2array_menu($p,$o,$rid);
$ret=table2array_build($p);
return $bt.divd($rid,$ret);}

?>