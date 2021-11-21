<?php
//philum_plugin_sconn

function sconn_build($p,$o){
req('pop,art,spe,mod');
if($o)$p='['.$p.']';
$ret=codeline::read($p,'','test');
return $ret;}

function sconn_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=sconn_build($p,$o);
return $ret;}

function sconn_menu($p,$o,$rid){
$j=$rid.'_plug__2_sconn_sconn*j___inp'.$rid;
$js='onkeyup="'.sj($j).'" onclick="'.sj($j).'"';
$ret=editarea('inp'.$rid,$p,54,8,$js);
//$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

function plug_sconn($p,$o){$rid='plg'.randid();
$bt=sconn_menu($p,$o,$rid);
$ret=sconn_j($p,$o);
return $bt.div(atd($rid),$ret);}

?>