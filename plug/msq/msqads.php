<?php
//philum_plugin_msqads

function msqads_j($p,$o,$res){$r=ajxr($res);//form
$p=$p?$p:'msqads'; $nod=nod($p.'_'.$o);
$r=msql::modif('',$nod,$r,'push');
$r=msql::reverse($r);
return tabler($r,'txtblc','txtx');}

function msqads_com($p,$o){$rid='plg'.$p.$o; $r=ajxr($res);
$ret=lj('','pop_plupin___msqads____p|o',picto('ok')).' ';
$ret.=autoclic('p',$p?$p:'param',10,244,'',1);
$ret.=autoclic('o',$o?$o:'option',10,244,'',1);
return $ret;}

function plug_msqads($p,$o){$rid='plg'.randid(); $p=$p?$p:'msqads'; $o?$o:1; $nod=nod($p.'_'.$o);
$rb=['day','quest','resp']; $r=msql::read('',$nod,'','',$rb);
$ret=lj('popsav',$rid.'_plug___msqads_msqads*j_'.$p.'_'.$o.'_'.implode('|',$rb),'save');
$ret.=msqbt('',$nod).br();
$ret.=input($rb[0],date('ymd')).br();
$ret.=textarea($rb[1],'',40,4).textarea($rb[2],'',40,4);
$r=msql::reverse($r);
return $ret.divd($rid,tabler($r,'txtblc','txtx'));}

?>