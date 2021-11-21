<?php
//philum_plugin_updateimg
//uppdate index of img from articles

function updateimg_build($p,$o){req('ajxf');
$r=sql('id','qda','rv','order by  id desc');
foreach($r as $k=>$v)recenseim($v);
return 'ok';}

function updateimg_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=updateimg_build($p,$o);
return $ret;}

function updateimg_menu($p,$o,$rid){
$ret.=lj('',$rid.'_plug__2_updateimg_updateimg*j___inp',picto('ok')).' ';
return $ret;}

function plug_updateimg($p,$o){$rid=randid('plg');
$bt=updateimg_menu($p,$o,$rid);
return $bt.divd($rid,$ret);}

?>