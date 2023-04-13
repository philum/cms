<?php 
class panel{

static function build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$ret.=input('inp',$p,'').' ';
$ret.=lj('',$rid.'_panel,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>