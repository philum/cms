<?php
//philum_plugin_spi3d

function spi3d_build($p,$o){
$f='http://telex.ovh/frame/scene/'.$p;//17,18
$ret=iframe($f,'',600);
return $ret;}

function spi3d_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=spi3d_build($p,$o);
return $ret;}

function plug_spi3d($p,$o){$rid=randid('plg');
$p=$p?$p:17;//18
$bt=lk('/plug/spt',picto('filelist'));
$ret=spi3d_build($p,$o);
//$bt.=msqbt('',nod('spi3d'));
return $bt.divd($rid,$ret);}

?>