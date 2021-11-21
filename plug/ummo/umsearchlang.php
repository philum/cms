<?php
//philum_plugin_umsearchlang

function umsearchlang_build($p,$o){
$r=sql('ref,lang','ynd','kv','txt like "%'.$p.'%"');
return $r;}

function umsearchlang_j($p,$o,$res=''){
req('spe,art,pop');
reqp('umcom'); $ret='';
list($p,$o)=ajxp($res,$p,$o);
$_GET['search']=$p; $rb=[];
$r=umsearchlang_build($p,$o);
if($r)foreach($r as $k=>$v)if(substr($k,0,3)=='art')$rb[substr($k,3)]=$v;
//if($rb)$ret=output_arts($rb,'','art'); else $ret='nothing';
$cats=umrec::$cats;
if($rb)foreach($rb as $k=>$v){
	$frm=sql('frm','qda','v','id='.$k);
	if(in_array($frm,$cats))$ret.=plug_umcom($k,'');}
return $ret?$ret:'nothing';}

function umsearchlang_menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__3_umsearchlang_umsearchlang*j___inp',picto('ok')).' ';
$ret.=hlpbt('umsearchlang');
return $ret;}

function plug_umsearchlang($p,$o){$rid=randid('plg');
$bt=umsearchlang_menu($p,$o,$rid);
if($p)$ret=umsearchlang_build($p,$o);
return $bt.divd($rid,$ret);}

?>