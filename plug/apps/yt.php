<?php //yt
class yt{
static $a=__CLASS__;

static function build($u,$o){
$u=str_replace('|','/',$u);
if(strpos($u,'/')===false)$u='youtube.com/watch?v='.$p;
$r=web::read(http($u),'',$o);
$ret=mkjson($r);
//echo $er=json_error();
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if(strpos($o,';'))[$o,$ord]=opt($o,';',2);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_yt,call_'.$inpid.'_3_'.$p.'_'.$o;
$ret=inputj($inpid,$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>