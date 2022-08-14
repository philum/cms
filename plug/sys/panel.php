<?php //panel

function panel_build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

function panel_j($p,$o,$res=''){
[$p,$o]=ajxp($res,$p,$o);
$ret=panel_build($p,$o);
return $ret;}

function panel_menu($p,$o,$rid){
$ret.=input1('inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_panel_panel*j___inp',picto('ok')).' ';
return $ret;}

function plug_panel($p,$o){$rid='plg'.randid();
$bt=panel_menu($p,$o,$rid);
$ret=panel_build($p,$o);
return $bt.divd($rid,$ret);}

?>