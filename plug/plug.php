<?php
//philum_plugin_plug

function plug_slct(){
$r=msql_read('system','program_plugs','',1);
//ksort($r);
foreach($r as $k=>$v){
	if($v[2]=='1' && !$v[3] && !$v[5] && $v[1])$rb=tri_tag(str_replace(' ',',',$v[1]));
	if($rb)foreach($rb as $kb=>$vb)$ret[$vb][]=lkc('','/plug/'.$k,$k);}
return divc('',make_tabs($ret));}//onxcols($ret,6,'')

function plug_call($p='',$o='',$res=''){
list($d,$p,$o)=ajxr($res,3);
if(method_exists($d,'home'))$ret=$d::home($p,$o);
else $ret=plugin($d,$p,$o);
return $ret;}

function plug_plug($plg,$p='',$o='',$res=''){$rid=randid('plg');
if($res)list($plg,$p,$o)=ajxr($res);
$ret=select_j('plugin','plug','','','','2').' ';
$j=$rid.'_plug__3_plug_plug*call___plugin|plugp|plugo';
$ret.=inputj('plugin',$plg?$plg:'plugin',$j,'',1).' ';
$ret.=lj('',$j,picto('ok'));
$ret.=input1('plugp',$p?$p:'param','','',1).' ';
$ret.=input1('plugo',$o?$o:'option','','',1).' ';
return $ret.divd($rid,plugin($plg,$p,$o));}

?>