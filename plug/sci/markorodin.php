<?php //markorodin
class markorodin{
static $conn=1;
/*
156->100+50+6
*/
static function segmentation($v){
$n=strlen($v); $ret=[];
if($n>1)for($i=$n;$i>0;$i--){
$scale=str_pad(1,$i,0);
$mod=$v % $scale;
$ret[]=$v-$mod;}
return array_sum($ret);}

/*
156->1+5+6->1+2->3
*/
static function numerology($v,$p){
$n=strlen($v); $ret=0;
for($i=0;$i<$n;$i++)$ret+=substr($v,$i,1);
$ret=base_convert($ret,$p,10);
if(strlen($ret)>1)$ret=self::numerology($ret,$p);
return $v.'->'.$ret;}

static function build($p,$o){//$p:math base
if(!$p)$p=10;
for($i=0;$i<10;$i++){$n=2**$i;
	$v=base_convert($n,10,$p);
	$res=self::numerology($v,$p);
	$r[]=['2^'.$i,$res];}
return tabler($r);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_markorodin,call_inp__'.$rid;
$ret.=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok'));
$ret.=hlpbt('markorodin');
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>