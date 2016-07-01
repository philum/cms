<?php
//philum_plugin_atomic

function atomic_build($p,$o){
$r=msql_read('','public_atomic',''); $rb['-']=$r['_menus_'];
if(is_numeric($p))
	$rb[]=msql_read('','public_atomic',$p);
elseif($p)
	foreach($r as $k=>$v)if(strtolower($v[0])==strtolower($p))$rb[$k]=$v;
//p($rb);
return make_table($rb);}

function atomic_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=atomic_build($p,$o);
return $ret;}

function atomic_menu($p,$o,$rid){$ret=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_atomic_atomic*j___inp',picto('reload')).' ';
return $ret;}

function plug_atomic($p,$o){$rid='plg'.randid();
$bt=atomic_menu($p,$o,$rid);
$ret=atomic_build($p,$o);
return $bt.divd($rid,$ret);}

?>