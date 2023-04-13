<?php //umsound
class umsound{
static function build($p,$o){
$r=msql::row('',nod('umnum'),$p,1);
return tabler($r);}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_umsound,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('umsound'));
return $bt.divd($rid,$ret);}
}
?>