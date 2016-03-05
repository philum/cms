<?php
//philum_plugin_comparetxt

function comptxt_j($p,$o,$res=''){
$r=ajxr($res);
$txt1=html_entity_decode($r[0]);
$txt2=html_entity_decode($r[1]);
if($p=='sentences')$s='.';
elseif($p=='lines')$s='\n';
else $s=' ';
$r1=explode($s,$txt1);
$r2=explode($s,$txt2);
$arr=array_diff($r1,$r2);
$ret=divc('txtalert','résultat: '.count($arr).' différences').br();
if($arr)foreach($arr as $k=>$v)$ret.=$v.':'.$r2[$k].hr();
return $ret;}

function comp_menu($p,$o,$rid){
$ret.=lj('txtx',$rid.'_plug__2_comparetxt_comptxt*j_sentences__inp1','sentences').' ';
$ret.=lj('txtx',$rid.'_plug__2_comparetxt_comptxt*j_lines__inp1','lines').' ';
$ret.=lj('txtx',$rid.'_plug__2_comparetxt_comptxt*j_words__inp1','words').br();
$ex1="version.\nversion\nversion v f d";
$ex2="version.\nversion\nversion v f b";
$ret.=txarea('inp1',$ex1,54,8).' ';
$ret.=txarea('inp2',$ex2,54,8).' ';
return $ret;}

function plug_comparetxt(){
$rid='plg'.randid();
$bt=comp_menu($p,$o,$rid);
$ret=comptxt_j($p,$o,$res='');
return $bt.divd($rid,$ret);}

?>