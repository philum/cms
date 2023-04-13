<?php //umpictos
class umpictos{
static function ex($p){
return span(att($p),oomo($p,32));}

static function all(){
$r=msql::read('system','edition_pictos_2','',1);
if($r)foreach($r as $k=>$v)$rb[]=[$k,self::ex($k),$v[1]];
return tabler($rb);}

static function menu($p,$o,$rid){
$ret.=lj('',$rid.'_umpictos,all',picto('down')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
Head::add('csslink','/css/_oomo.css'); $bt='';
//$bt=self::menu($p,$o,$rid);
if(auth(6))$bt.=msqbt('system','edition_pictos_2');
$ret=self::all($p,$o);
return $bt.divd($rid,$ret);}
}
?>