<?php
//philum_app_exif

class exif{
static $a=__CLASS__;
static $default='';

static function build($p,$o){
$r=exif_read_data($p); //pr($r);
return eco($r,1);}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_app__3_'.self::$a.'_call___'.$inpid;
$ret=inputj($inpid,$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}

function plug_exif($p,$o){
return exif::home($p,$o);}

?>