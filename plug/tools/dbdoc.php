<?php
class dbdoc{

static function build($p,$o){
$f='users/dav/WaletHumm.html';
$w=100000; $start=$p*$w;
$bt=btn('txtyl',$p);
//$d=file_get_contents($f);
//echo array_sum(count_chars($d));
$d=file_get_contents($f,NULL,NULL,$start,$w);
$ret=$d;
//$ret=conv::call($d);
//$ret=textarea('',$rets,44,8);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
//$ret.=togbub('plug','dbdoc_dbdoc*r',btn('popbt','select...'));
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_dbdoc,call_inp',picto('ok')).' ';
$nb=5653807; $sz=100000; $n=$nb/$sz;
for($i=0;$i<$n;$i++)$ret.=lj('',$rid.'_dbdoc,call___'.$i,$i).' ';
return divc('nbp',$ret);}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
//$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>