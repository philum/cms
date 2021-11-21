<?php
//philum_plugin_umsound

function umsound_build($p,$o){
$r=msql::row('',nod('umnum'),$p,1);
return tabler($r);}

function umsound_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=umsound_build($p,$o);
return $ret;}

function umsound_menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_umsound_umsound*j___inp',picto('ok')).' ';
//$ret.=lj('','popup_plupin___msqedit_umsound*1_id,val',picto('edit')).' ';
return $ret;}

function plug_umsound($p,$o){$rid=randid('plg');
$bt=umsound_menu($p,$o,$rid);
$ret=umsound_build($p,$o);
//$bt.=msqbt('',nod('umsound'));
return $bt.divd($rid,$ret);}

?>