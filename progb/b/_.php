<?php //philum/b
class model{
static $a=__CLASS__;
static $cb='mdl';

function __construct(){self::$cb=randid();}

static function build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o){$bid='inp';
$j=self::$cb.'_'.self::$a.',call__2__'.$o.'___'.$bid;
$ret=inputj($bid,$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$bt=self::menu($p,$o);
$ret=self::call($p,$o);
return $bt.divd(self::$cb,$ret);}
}
?>