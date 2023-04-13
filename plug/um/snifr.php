<?php 
class snifr{

static function js($rid){
Head::add('jscode','
var lapsetime=60000;
function twlive(e){var inp=getbyid("inp").value;
	SaveJ("'.$rid.'_twit,call__14_"+inp);
	setTimeout("twlive()",lapsetime);}
setTimeout("twlive()",10);//
');}

static function build($p,$o){
$ret=twit::call($p,$o);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_snifr,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
self::js($rid);
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('snifr'));
return $bt.divd($rid,$ret);}
}
?>