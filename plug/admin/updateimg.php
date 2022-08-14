<?php //updateimg
//uppdate index of img from articles
class updateimg{
static function build($p,$o){
$r=sql('id','qda','rv','order by  id desc');
foreach($r as $k=>$v)sav::recenseim($v);
return 'ok';}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$ret=lj('',$rid.'_updateimg,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid); $ret='';
return $bt.divd($rid,$ret);}
}
?>