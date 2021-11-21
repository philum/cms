<?php
//philum_plugin_approx

//todo::add decimals
function searchn($d,$o){
$r=str_split((string)$d); $n=count($r); $v=$r[$n-1];
if($o==1){
  if($v==9){$r[$n-2]+=1; $r[$n-1]=5;} else {$r[$n-1]+=1;}}
elseif($o==0){
  if($v==0){$r[$n-2]-=1; $r[$n-1]=9;} else {$r[$n-1]-=1;}}
return implode('',$r);}

function findpi($a,$b){static $i; $i++; static $x=[];
$d=pi()*$b;
if($d<$a)$o=1; else $o=0; $x[]=$o;
$b=searchn($b,$o);
if($d!=$a && $i<100)$d=findpi($a,$b); //echo $b.' ';
return $b;}

function approx_build($p,$o){
//$ret=pi()*$p;
//$ret=searchn($d,1);
$ret=findpi(256,$p);
return $ret;}

function approx_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=approx_build($p,$o);
return $ret;}

function approx_menu($p,$o,$rid){
$j=$rid.'_plug__2_approx_approx*j__'.$rid.'_inp';
$ret.=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

function plug_approx($p,$o){$rid=randid('plg');
if(!$p)$p='81.4873308639';
$bt=approx_menu($p,$o,$rid);
$ret=approx_build($p,$o);
//$bt.=msqbt('',nod('approx'));
return $bt.divd($rid,$ret);}

?>