<?php //umvoc
class umglyphes{

static function r(){
$r=msql::read('users','ummo_umvoc_1','',1);
if($r)foreach($r as $v){$rb[$v[0]]=$v[1].($v[3]?' ['.stripslashes($v[3]).']':'');}
return $rb;}

static function imz($f,$n='2'){
[$w,$h]=fwidth($f);
$w=round($w/$n); $h=round($h/$n);
return image('/'.$f,$w,$h);}

static function glyphe($p,$b){
$f='users/ummo/glyphes/'.strtoupper($p).'.png';
if(is_file($f))$bt=self::imz($f,6); else $bt=$p;
return lj('','popup_umvoc,home___'.ajx($p),$bt,att($p));}

static function call($p,$o='',$prm=[]){
$p=$prm[0]??$p; $ret='';
$r=explode(' ',$p); $ra=self::r();
foreach($r as $v)$ret.=self::glyphe(str_replace('_',' ',$v),val($ra,$v)).' ';
return $ret;}

static function home($p,$o){
if($o=='1')return self::call($p);
//$ret.=lj('','umglph___4',picto('del')).' ';
$ret=input('umglph',$p,'44').' ';
$ret.=lj('popsav','umgl_umglyphes,call_umglph__'.ajx($p),'ok').' ';
$ret.=divd('umgl',self::call($p)).br();
$ret.=msqbt('','ummo_umvoc_1','').' ';
$ret.=lkt('','/app/umvoc',picto('link'));
return $ret;}
}
?>