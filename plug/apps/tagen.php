<?php
//philum_app_tagen

class tagen{
static $a=__CLASS__;
static $db='pub_metaen';
static $default='';

static function build($p,$o){
//$r=msql::read_b('',nod(self::$a.'_1'));//p($r);
$ret=$p.'-'.$o;
return $ret;}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
if(strpos($o,';'))list($o,$ord)=opt($o,';',2);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_app__3_'.self::$a.'_call___'.$inpid;
//$ret=inputj($inpid,$p,$j);
$ret=textarea('inp',$p,40,4,atc('console'));
$ret.=lj('',$j,picto('ok')).' ';
//$cols='ib,val,to';//create table, name cols
//$ret.=lj('','popup_plupin___msqedit_'.self::$a.'*1_'.$cols,picto('edit')).' ';
//$ret.=msqbt('',nod(self::$a.'_1'));
return $ret;}

static function install($b){
//ses($b,qd($b));//name of table
//1=drop table on change $r !
$r=['tag'=>'var','cat'=>'var'];
mysql::install($b,$r,0);}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
//self::install(self::$a);
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}

function plug_tagen($p,$o){
return tagen::home($p,$o);}

?>