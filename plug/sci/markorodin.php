<?php
//philum_plugin_markorodin

class markorodin{
/*
156->100+50+6
*/
function segmentation($v){
$n=strlen($v); $ret=[];
if($n>1)for($i=$n;$i>0;$i--){
$scale=str_pad(1,$i,0);
$mod=$v % $scale;
$ret[]=$v-$mod;}
return array_sum($ret);}

/*
156->1+5+6->1+2->3
*/
function numerology($v,$p){
$n=strlen($v); $ret=0;
for($i=0;$i<$n;$i++)$ret+=substr($v,$i,1);
$ret=base_convert($ret,$p,10);
if(strlen($ret)>1)$ret=self::numerology($ret,$p);
return $v.'->'.$ret;}

function build($p,$o){//$p:math base
if(!$p)$p=10;
for($i=0;$i<10;$i++){$n=2**$i;
	$v=base_convert($n,10,$p);
	$res=self::numerology($v,$p);
	$r[]=['2^'.$i,$res];}
return tabler($r);}

function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $ret;}

function menu($p,$o,$rid){
$j=$rid.'_app__2_markorodin_call__'.$rid.'_inp';
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