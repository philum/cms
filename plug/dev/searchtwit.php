<?php
//philum_plugin_searchtwit

function searchtwit_build($p,$o){
$r=sql('ib','umt','kv','text like "%'.$p.'%"');
return $r;}

function searchtwit_j($p,$o,$res=''){
req('spe,art,pop');
list($p,$o)=ajxp($res,$p,$o);
$_GET['search']=$p;
$r=searchtwit_build($p,$o);
if($r)$ret=output_arts($r,'','art');
else $ret='nothing';
return $ret;}

function searchtwit_menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__3_searchtwit_searchtwit*j___inp',picto('ok')).' ';
return $ret;}

function plug_searchtwit($p,$o){$rid=randid('plg');
ses('umt','pub_umtwits');
$bt=searchtwit_menu($p,$o,$rid);
$ret=searchtwit_build($p,$o);
return $bt.divd($rid,$ret);}

?>