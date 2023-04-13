<?php //md5
class md5{
static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=md5($p);
if(is_numeric($o))$ret=substr($ret,0,$o);
return $ret;}

static function menu($p,$o,$rid){$ret.=input('inp',$p,'').' ';
$ret.=lj('',$rid.'_md5,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid); $ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>