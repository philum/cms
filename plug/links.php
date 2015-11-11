<?php
//philum_plugin
session_start();

/*if($_GET["plug"]==""){$ret="access logically impossible";}
else{$dal=rse("msg",$_SESSION["qdd"].' WHERE qb="'.$_SESSION["qb"].'" AND cat="links"');
if($dal)$ret=dlinks_prep($dal,lkt("","/?plug=links","Network"),'','');}
$plug_output=$ret;*/

function links_all(){
$r=msql_read('','public_defcons','',1); $r=array_keys($r); sort($r);
if($r)foreach($r as $k=>$v)$ret.=$v.br();
return $ret;}

function plug_links(){
foreach(ses('rqt') as $k=>$v)$rb[preplink($v[9])]+=1; arsort($rb); //p($rb);
foreach($rb as $k=>$v)if($k)$ret.=$k.' ('.$v.')'.br();
$ret.=hr().links_all();
return $ret;}

?>