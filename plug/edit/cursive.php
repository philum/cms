<?php 
class cursive{

static function decrypt($a){
$r=explode(';',$a); $ret=''; $rb=[]; $n=0;//eco($a);
foreach($r as $v)if(substr($v,0,1)==' '){$rb[]=' '; $rb[]=substr($v,3);} else $rb[]=substr($v,2);//p($rb);
$rc=self::s(); foreach($rc as $v)if($v<=$rb[0])$n=$v; //echo $n;//find key
foreach($rb as $v)if($v!=''){$vb=$v-$n; if($vb>=26)$vb+=6; if($vb>=58)$vb-=6;//0 at 38/A at 65
	if($v==' ')$ret.=' '; else $ret.=chr($vb+65);}//.'='.($vb+65).'--'
return divc('track',$ret);}

static function jb($p,$o,$prm=[]){
$a=$prm[0]??''; 
return self::decrypt($a);}

static function build($a,$b){
$r=str_split($b); $ret=''; $n=$a-65;//AZ-(6)-az
if($r)foreach($r as $v){$na=ord($v); if($na-65>26)$na-=6; $ret.=chr_b($na+$n).'';}//$na.'--'.
return divc('track',$ret);}

static function call($p,$o,$prm=[]){
//[$p,$o]=prmp($prm,$p,$o);
[$a,$b]=arr($prm);
$ret=self::build($a,$b);
return $ret;}

static function com($p,$o){
$r=self::s(); if($o && $o<=count($r))$o=$r[$o];
if($o)$ret=self::build($o,$p);
else $ret=self::decrypt($p);
return $ret;}

static function s(){return [1=>5121,7680,9398,9312,9372,9398,9601,10241,119552,119808,119860,119964,120016,120068,120120,120172,120328,120380,120432,120488,120546,120662,120782,120792,120802,120822,127233,127248,127280,127312,127344,127462,127744,128336,128512,128592,128929,129040,129120,129293];}

static function r(){$rb=[]; $r=self::s();
foreach($r as $v)$rb[$v]=chr_b($v).':'.$v;
return $rb;}

static function menu($p,$o,$rid){
$ret=select_j('inp1','pclass','','cursive/r','','0');
$j=$rid.'_cursive,call_inp1,inp2___'.$rid;
$ret.=inputj('inp2',$p,$j); $ret.=lj('popbt',$j,'encrypt').' ';
$j=$rid.'_cursive,jb_inp3___'.$rid;
$ret.=inputj('inp3','',$j); $ret.=lj('popbt',$j,'decrypt').' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
if($p)return self::com($p,$o);
$bt=self::menu($p,$o,$rid);
return $bt.divd($rid,$ret);}
}
?>