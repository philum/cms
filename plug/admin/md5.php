<?php
//philum_plugin_md5

function md5_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=md5($p);
if(is_numeric($o))$ret=substr($ret,0,$o);
return $ret;}

function md5_menu($p,$o,$rid){$ret.=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_md5_md5*j___inp',picto('reload')).' ';
return $ret;}

function plug_md5($p,$o){$rid='plg'.randid();
$bt=md5_menu($p,$o,$rid); $ret=md5_j($p,$o);
return $bt.divd($rid,$ret);}

?>