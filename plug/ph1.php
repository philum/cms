<?php
//ph1lum_plugin_ph1

function ph1_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
return iframe('http://ph1.fr/'.$p.':api=1');
return $ret;}

function ph1_menu($p,$o,$rid){$ret=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_ph1_ph1*j___inp',picto('reload')).' ';
return $ret;}

function plug_ph1($p,$o){$rid='plg'.randid();
if(!$p)$bt=ph1_menu($p,$o,$rid);
$ret=ph1_j($p,$o);
return $bt.divd($rid,$ret);}

?>