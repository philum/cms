<?php
//philum_plugin_countfiles
session_start();
error_reporting(6135);
if(!function_exists('p'))require('../prog/lib.php');

function func_countfiles($d,$k,$f,$n){//dir,key,file,topology
if($v)return $d.'/'.$f; else return $d;}

function plug_countfiles($d){$r=explore($d,'files',1);
if($r)foreach($r as $k=>$v){if(is_array($v))$ret+=count($v); else $ret+=1;}
return $ret;}

?>