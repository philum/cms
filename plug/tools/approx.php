<?php 
class approx{

//todo::add decimals
static function searchn($d,$o){
$r=str_split((string)$d); $n=count($r); $v=$r[$n-1];
if($o==1){
	if($v==9){$r[$n-2]+=1; $r[$n-1]=5;} else {$r[$n-1]+=1;}}
elseif($o==0){
	if($v==0){$r[$n-2]-=1; $r[$n-1]=9;} else {$r[$n-1]-=1;}}
return implode('',$r);}

static function findpi($a,$b){static $i; $i++; static $x=[];
$d=pi()*$b;
if($d<$a)$o=1; else $o=0; $x[]=$o;
$b=searchn($b,$o);
if($d!=$a && $i<100)$d=findpi($a,$b); //echo $b.' ';
return $b;}

static function build($p,$o){
//$ret=pi()*$p;
//$ret=searchn($d,1);
$ret=findpi(256,$p);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_approx,call_'.$rid.'_inp';
$ret.=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
if(!$p)$p='81.4873308639';
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('approx'));
return $bt.divd($rid,$ret);}
}
?>