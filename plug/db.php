<?php
//philum_plugin_db

function db_build($p,$o){
$f=db_f('test');
if($p)db_add($f,$p);
$r=db_read($f);
return p($r,1);}

function db_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=db_build($p,$o);
return $ret;}

function db_menu($p,$o,$rid){
$ret.=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_db_db*j___inp',picto('reload')).' ';
return $ret;}

function plug_db($p,$o){$rid='plg'.randid();
$bt=db_menu($p,$o,$rid);
$ret=db_build($p,$o);
return $bt.divd($rid,$ret);}

?>