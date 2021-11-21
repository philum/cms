<?php
//philum_plugin_connectors

function connectors_build($p,$o){
req('pop,art,spe,mod');
if($o)$p='['.$p.']';
$ret=conn::read($p,'','test');
return $ret;}

function connectors_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=connectors_build($p,$o);
return $ret;}

function connectors_menu($p,$o,$rid){
$j=$rid.'_plug__2_connectors_connectors*j___inp'.$rid;
$js='onkeyup="'.sj($j).'" onclick="'.sj($j).'"';
$ret=editarea('inp'.$rid,$p,54,8,$js);
//$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

function plug_connectors($p,$o){$rid='plg'.randid();
$bt=connectors_menu($p,$o,$rid);
$ret=connectors_j($p,$o);
return $bt.div(atd($rid),$ret);}

?>