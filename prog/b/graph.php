<?php //philum/b/graph
class graph{
static $a=__CLASS__;

static function build($p,$o){
$r=msql_read('',nod('graph_'.$p));
return $ret;}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$bid='inp'.$rid;
$j=$rid.'_'.self::$a.',call__2__'.$rid.'___'.$bid;
$ret.=inputj($bid,$p,$j).lj('',$j,picto('ok')).' ';
$ret.=msqbt('',nod('graph_'.$p));
return $ret;}

static function home($p,$o){$rid=randid();
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>