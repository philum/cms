<?php
//philum_plugin_arts
session_start();

function arts_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
req('pop,art,tri,spe,mod');
$r=array('articles',$p,'Articles','','multi','');
sesone('nl',$o);
$ret=build_mods($r);
sesone('nl','');
return $ret;}

function plug_arts($p,$o){$rid='plg'.randid();connect();
$_SESSION['head_r'][]['css']='../css/'.ses('qb').'_design_'.ses('prmd');
$p=$p?$p:'nbdays=2&preview=auto';//priority=>1&priority=<4
$ret.=input(1,'params',$p,'',30).' ';
$ret.=lj('',$rid.'_plug__3_arts_arts*j__nl_params',picto('reload')).' ';
return divs('',$ret).divd($rid,arts_j($p,'',''));}

?>