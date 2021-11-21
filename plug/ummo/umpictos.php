<?php
//philum_plugin_umpictos

function umpictos_demo($p){
return span(att($p),oomo($p,32));}

function umpictos_all($p,$o,$res=''){
$r=msql_read('system','edition_pictos_2','',1);
if($r)foreach($r as $k=>$v)$rb[]=[$k,umpictos_demo($k),$v[1]];
return tabler($rb);}

function umpictos_menu($p,$o,$rid){
$ret.=lj('',$rid.'_plug__2_umpictos_umpictos*all___inp',picto('down')).' ';
return $ret;}

function plug_umpictos($p,$o){$rid=randid('plg');
Head::add('csslink','/css/_oomo.css');
//$bt=umpictos_menu($p,$o,$rid);
if(auth(6))$bt.=msqbt('system','edition_pictos_2');
$ret.=umpictos_all($p,$o);
return $bt.divd($rid,$ret);}

?>