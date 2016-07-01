<?php
//philum_plugin_connectors

function connectors_build($p,$o){
req('pop,spe,tri');
$ret=format_txt($p,'','test');
return $ret;}

function connectors_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=connectors_build($p,$o);
return $ret;}

function connectors_menu($p,$o,$rid){
$j=$rid.'_plug__2_connectors_connectors*j___inpconn1';
$js='onkeyup="'.sj($j).'" onclick="'.sj($j).'"';
$ret=txarea('inpconn1',$p,54,8,''.$js).' ';
//$ret.=lj('',$j,picto('reload')).' ';
return $ret;}

function plug_connectors($p,$o){$rid='plg'.randid();
$bt=connectors_menu($p,$o,$rid);
$ret=connectors_j($p,$o);
return $bt.div(atd($rid),$ret);}

?>