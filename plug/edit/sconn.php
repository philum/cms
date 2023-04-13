<?php 
class sconn{

static function build($p,$o){
if($o)$p='['.$p.']';
$ret=codeline::read($p,'','test');
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_sconn,call_inp'.$rid;
$js=['onkeyup'=>sj($j),'onclick'=>sj($j)];
$ret=editarea('inp'.$rid,$p,54,8,$js);
//$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.div(atd($rid),$ret);}
}
?>