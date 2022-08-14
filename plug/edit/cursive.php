<?php //cursive

function cursive_decrypt($a){
$r=explode(';',$a); $ret=''; $rb=[]; $n=0;//eco($a);
foreach($r as $v)if(substr($v,0,1)==' '){$rb[]=' '; $rb[]=substr($v,3);} else $rb[]=substr($v,2);//p($rb);
$rc=cursive_s(); foreach($rc as $v)if($v<=$rb[0])$n=$v; //echo $n;//find key
foreach($rb as $v)if($v!=''){$vb=$v-$n; if($vb>=26)$vb+=6; if($vb>=58)$vb-=6;//0 at 38/A at 65
	if($v==' ')$ret.=' '; else $ret.=chr($vb+65);}//.'='.($vb+65).'--'
return divc('track',$ret);}

function cursive_jb($p,$o,$res=''){
[$a]=ajxr($res); 
return cursive_decrypt($a);}

function cursive_build($a,$b){
$r=str_split($b); $ret=''; $n=$a-65;//AZ-(6)-az
if($r)foreach($r as $v){$na=ord($v); if($na-65>26)$na-=6; $ret.=chr_b($na+$n).'';}//$na.'--'.
return divc('track',$ret);}

function cursive_j($p,$o,$res=''){
//[$p,$o]=ajxp($res,$p,$o);
[$a,$b]=ajxr($res);
$ret=cursive_build($a,$b);
return $ret;}

function cursive_call($p,$o){
$r=cursive_s(); if($o && $o<=count($r))$o=$r[$o];
if($o)$ret=cursive_build($o,$p);
else $ret=cursive_decrypt($p);
return $ret;}

function cursive_s(){return [1=>5121,7680,9398,9312,9372,9398,9601,10241,119552,119808,119860,119964,120016,120068,120120,120172,120328,120380,120432,120488,120546,120662,120782,120792,120802,120822,127233,127248,127280,127312,127344,127462,127744,128336,128512,128592,128929,129040,129120,129293];}

function cursive_r(){$rb=[]; $r=cursive_s();
foreach($r as $v)$rb[$v]=chr_b($v).':'.$v;
return $rb;}

function cursive_menu($p,$o,$rid){
$ret=select_j('inp1','pfunc','','cursive/cursive_r','','0');
$j=$rid.'_plug__2_cursive_cursive*j__'.$rid.'_inp1|inp2';
$ret.=inputj('inp2',$p,$j); $ret.=lj('popbt',$j,'encrypt').' ';
$j=$rid.'_plug__2_cursive_cursive*jb__'.$rid.'_inp3';
$ret.=inputj('inp3','',$j); $ret.=lj('popbt',$j,'decrypt').' ';
return $ret;}

function plug_cursive($p,$o){$rid=randid('plg');
if($p)return cursive_call($p,$o);
$bt=cursive_menu($p,$o,$rid);
return $bt.divd($rid,$ret);}

?>