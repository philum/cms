<?php
//philum_plugin_umtwits

function umtwits_build($p,$o){
req('spe'); $ret='';
if($p)$w='where screen_name="'.$p.'" ';
if($o=='yes')$w.='or reply_name="'.$p.'" ';
$r=sqb('*','umt','ar',$w.'order by date asc');
if($r)foreach($r as $k=>$v)$ret.=balb('section',twit::play(val($r,'twid'),$v));
return $ret;}

function umtwits_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=umtwits_build($p,$o);
if(!$ret)$ret='nothing';
return $ret;}

function umtwits_r(){
$r=sqb('distinct(screen_name) as name','umt','rv','order by name');
foreach($r as $v)$ret[$v]=$v;
return $ret;}

function umtwits_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','umtwits/umtwits_r','','2').' ';
$j=$rid.'_plug__3_umtwits_umtwits*j___inp|chk';
$ret.=inputj('inp',$p,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=checkbox('chk','no','replies','');
return $ret;}

function plug_umtwits($p,$o){$rid=randid('plg');
ses('umt','pub_umtwits');
$bt=umtwits_menu($p,$o,$rid);
//$ret=umtwits_build($p,$o);
return $bt.divd($rid,'');}

?>