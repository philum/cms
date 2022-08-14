<?php //twss

class twss{
static $a=__CLASS__;
static $default='';

static function build($p,$o){
$ret=twit::call($p,'stream');
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function twr(){
$r=msql::read('',nod('twss'),'',1);
if(!$r)$r=msql::save('',nod('twss'),[['']],['account']);
foreach($r as $k=>$v)$rb[$k]=$v[0];
return $rb;}

static function menu($p,$o,$rid){
$r=self::twr(); $ret='';
if($r)foreach($r as $k=>$v)
$ret.=lj('',$rid.'_twss,call__3_'.$v,$v).' ';
$bt=msqbt('',nod('twss'));
return $bt.divc('list',$ret);}

static function sav($r=[]){
return msql::modif('',nod('twss'),$r,'push',['account']);}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>