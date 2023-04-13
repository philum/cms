<?php 
class searchtwit{

static function build($p,$o){
$r=sql('ib','umt','kv','text like "%'.$p.'%"');
return $r;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$_GET['search']=$p;
$r=self::build($p,$o);
if($r)$ret=ma::output_arts($r,'','art');
else $ret='nothing';
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_searchtwit,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
ses('umt','pub_umtwits');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>