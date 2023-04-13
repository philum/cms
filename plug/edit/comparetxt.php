<?php 
class comparetxt{

static function call($p,$o,$r=[]){
$txt1=html_entity_decode($r[0]??'text1');
$txt2=html_entity_decode($r[1]??'text2');
if($p=='sentences')$s='.';
elseif($p=='lines')$s='\n';
else $s=' ';
$r1=explode($s,$txt1);
$r2=explode($s,$txt2);
$arr=array_diff($r1,$r2);
$ret=divc('txtalert','résultat: '.count($arr).' différences').br();
if($arr)foreach($arr as $k=>$v)$ret.=$v.':'.$r2[$k].hr();
return $ret;}

static function menu($p,$o,$rid){
$ret.=lj('txtx',$rid.'_comparetxt,call_inp1,inp2__sentences','sentences').' ';
$ret.=lj('txtx',$rid.'_comparetxt,call_inp1,inp2__lines','lines').' ';
$ret.=lj('txtx',$rid.'_comparetxt,call_inp1,inp2__words','words').br();
$ex1="version.\nversion\nversion v f d";
$ex2="version.\nversion\nversion v f b";
$ret.=textarea('inp1',$ex1,54,8).' ';
$ret.=textarea('inp2',$ex2,54,8).' ';
return $ret;}

static function home(){
$rid='plg'.randid();
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>