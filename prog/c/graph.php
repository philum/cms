<?php 
class graph{
static $a=__CLASS__;

static function build($p,$o){
$r=msql_read('',nod('graph_'.$p));
return $r;}

static function call($p,$o,$prm=[]){$p=$prm[0]??$p;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$bid='inp'.$rid;
$j=$rid.'_graph,call_'.$bid.','.$rid;
$ret=inputj($bid,$p,$j).lj('',$j,picto('ok')).' ';
$ret.=msqbt('',nod('graph_'.$p));
return $ret;}

static function home($p,$o){$rid=randid();
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>