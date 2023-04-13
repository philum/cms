<?php 
class build{
static $cb='mdl';

static function build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;//[$p,$o]=prmp($p,$o,$prm);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o){$bid='inp';
$j=self::$cb.'_'.self::$a.',call_'.$bid.'_2__'.$o;
$ret=inputj($bid,$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$bt=self::menu($p,$o);
$ret=self::call($p,$o);
return $bt.divd(self::$cb,$ret);}
}
?>