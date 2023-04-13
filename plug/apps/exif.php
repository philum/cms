<?php 
class exif{
static $default='';

static function build($p,$o){
$r=exif_read_data($p); //pr($r);
return eco($r,1);}

static function call($p,$o,$prm){
$p=$prm[0]??$p;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_exif,call_'.$inpid;
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