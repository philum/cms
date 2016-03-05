<?php
//philum_plugin_test

function plug_test($p,$o){//echo 'ee';
require('plug/mysql.php');
$r=sq2('id,page','live2','kv',''); //pr($r);
if($r)foreach($r as $k=>$v){
$vr=explode_k($v,'&','='); //pr($vr);
$v=implode_k($vr,'&','='); //echo $k.':'.$v.br();
msquery('update pub_live2 set page="'.$v.'" where id="'.$k.'"');
}
//return $ret;
}
?>