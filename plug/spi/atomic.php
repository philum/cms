<?php //atomic
class atomic{
static function build($p,$o){
$r=msql::read('','public_atomic',''); $rb['-']=$r['_menus_'];
if(is_numeric($p))$rb[]=msql::row('','public_atomic',$p,1);
elseif($p){foreach($r as $k=>$v)if(strtolower($v[0])==strtolower($p))$rb[$k]=$v;} //p($rb);
else $rb=$r;
return tabler($rb);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p,'').' ';
$ret.=lj('',$rid.'_atomic,call_inp',picto('ok')).' ';
$ret.=msqbt('','public_atomic').' ';
$ret.=lk('/app/spt',picto('url'));
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>