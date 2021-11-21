<?php
//philum_plugin_umvoc

function ug_r(){
$r=msql_read('users','ummo_umvoc_1','',1);
if($r)foreach($r as $v){$rb[$v[0]]=$v[1].($v[3]?' ['.stripslashes($v[3]).']':'');}
return $rb;}

function ug_imz($f,$n='2'){
list($w,$h)=fwidth($f);
$w=round($w/$n); $h=round($h/$n);
return image('/'.$f,$w,$h);}

function ug_glyphe($p,$b){
$f='users/ummo/glyphes/'.strtoupper($p).'.png';
if(is_file($f))$bt=ug_imz($f,6); else $bt=$p;
$t='" title="'.$p;//.': '.$b;
return lj($t,'popup_plupin___umvoc_'.ajx($p),$bt);}

function ug_build($p,$o='',$res=''){
list($p,$o)=ajxp($res,$p,$o); $ret='';
$r=explode(' ',$p); $ra=ug_r();
foreach($r as $v)$ret.=ug_glyphe(str_replace('_',' ',$v),val($ra,$v)).' ';
return $ret;}

function plug_umglyphes($p,$o){
if($o=='1')return ug_build($p);
//$ret.=lj('','umglph___4',picto('del')).' ';
$ret=input('umglph',$p,atz('44')).' ';
$ret.=lj('popsav','umgl_plug___umglyphes_ug*build_'.ajx($p).'__umglph','ok').' ';
$ret.=divd('umgl',ug_build($p)).br();
$ret.=msqbt('','ummo_umvoc_1','').' ';
$ret.=lkt('','/plug/umvoc',picto('link'));
return $ret;}

?>