<?php
//philum_plugin_spimol

function spimol_build($r,$rc){$ret=''; //p($rc);
$ra=msql::read_b('','public_atomic_3','',1); $rb=array_keys_r($ra,0); $rb=array_flip($rb); //p($rb);
foreach($rc as $k=>$v){$n=$rb[$v];
	list($sym,$pos,$free,$deg,$clr)=$ra[$n];
	$ret.=spiatom_build($r,$n,1);}
return $ret;}

function spimol_console($p){
$r=str_split($p); $rb=[];
foreach($r as $k=>$v)
	if(is_numeric($v))for($i=1;$i<$v;$i++)$rb[]=isset($rb[$k-1])?$rb[$k-1]:$rb[$k-2];
	elseif(strtoupper($v)!=$v)$rb[$k-1].=$v;
	else $rb[]=$v;
return $rb;}

function spimol_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); reqp('spiatom');
$r=msql::read('','public_atomic','',1);
if($p)$rb=spimol_console($p); //p($r);
if($p)return spimol_build($r,$rb);}

function spimol_menu($p,$o,$rid){
$j=$rid.'_plug__2_spimol_spimol*j__'.$rid.'_inp';
$ret=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok'));
$ret.=lk('/plug/spt','',picto('filelist'));
$ret.=msqbt('','public_atomic');
return $ret;}

function plug_spimol($p,$o){$rid=randid('plg');
$bt=spimol_menu($p,$o,$rid);
$ret=spimol_j($p,$o);
return $bt.divd($rid,$ret);}