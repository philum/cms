<?php
//philum_plugin_searchlang

function searchlang_build($p,$o){
$r=sql('ref,lang','ynd','kv','txt like "%'.$p.'%"');
return $r;}

function searchlang_j($p,$o,$res=''){
req('spe,art,pop');
reqp('umcom');
list($p,$o)=ajxp($res,$p,$o);
$_GET['search']=$p;
$r=searchlang_build($p,$o);
if($r)foreach($r as $k=>$v)if(substr($k,0,3)=='art')$rb[substr($k,3)]=$v;
if($rb)$ret=output_arts($rb,'','art'); else $ret='nothing';
return $ret;}

function searchlang_menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__3_searchlang_searchlang*j___inp',picto('ok')).' ';
$ret.=hlpbt('searchlang');
return $ret;}

function plug_searchlang($p,$o){$rid=randid('plg');
$bt=searchlang_menu($p,$o,$rid);
if($p)$ret=searchlang_build($p,$o);
return $bt.divd($rid,$ret);}

?>