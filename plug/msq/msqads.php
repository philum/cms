<?php 
class msqads{

static function call($p,$o,$prm){
[$p,$o]=prmp($prm,$p,$o);
$p=$p?$p:'msqads'; $nod=nod($p.'_'.$o);
$r=msql::modif('',$nod,$r,'push');
$r=msql::reverse($r);
return tabler($r,'txtblc','txtx');}

static function menu($p,$o){$rid='plg'.$p.$o;
$ret=lj('','pop_msqads,home_p,o',picto('ok')).' ';
$ret.=inputb('p'.$p,10,'param',244,[]);
$ret.=inputb('o'.$o,10,'option',244,[]);
return $ret;}

static function home($p,$o){
$rid='plg'.randid(); $p=$p?$p:'msqads'; $o?$o:1; $nod=nod($p.'_'.$o);
$rb=['day','quest','resp']; $r=msql::read('',$nod,'','',$rb);
$ret=lj('popsav',$rid.'_msqads,call_'.implode(',',$rb).'__'.$p.'_'.$o,'save');
$ret.=msqbt('',$nod).br();
$ret.=input($rb[0],date('ymd')).br();
$ret.=textarea($rb[1],'',40,4).textarea($rb[2],'',40,4);
$r=msql::reverse($r);
return $ret.divd($rid,tabler($r,'txtblc','txtx'));}
}
?>