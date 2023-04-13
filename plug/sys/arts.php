<?php 
class arts{

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$r=['articles',$p,'Articles','','multi',''];
geta('nl',1);
$ret=mod::mkmods($r);
getz('nl');
return $ret;}

static function home($p,$o){$rid='plg'.randid();
Head::add('csslink','/css/'.ses('qb').'_design_'.ses('prmd'));
$p=$p?$p:'nbdays=2&preview=auto';//priority=>1&priority=<4
$ret.=input('params',$p,30).' ';
$ret.=lj('',$rid.'_arts,call_params__nl',picto('ok')).' ';
return divd('page',$ret.divd($rid,divd('content',self::call($p))));}
}
?>