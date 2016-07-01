<?php
//philum_plugin_api

function api_j($p,$o='',$res=''){
req('api,pop,art,spe,tri,mod');
list($p,$o)=ajxp($res,$p,$o);
$ret=api_call($p,$o);
return $ret;}

function api_menu($p,$o,$rid){
$ret.=balb('textarea',atd('inp').atb('cols',70).atb('row',4),$p).' ';
$ret.=lj('',$rid.'_plug__3_api_api*j___inp',picto('reload')).' ';
return $ret;}

function plug_api($p,$o){$rid='plg'.randid();
if($o)$bt=api_menu($p,$o,$rid).br();
if($p)$ret=api_j($p);
return $bt.divd($rid,$ret);}

if($_GET['query']){//ini_set('display_errors','1'); error_reporting(E_ALL);
session_start(); require('../prog/lib.php'); require('../params/_connectx.php');
echo api_j($_GET['query'].',json:1','');}

?>