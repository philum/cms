<?php
//philum_plugin_test
session_start();
error_reporting(6135);

function plug_test($p,$o){
$v='http://www.ahmedbensaada.com/images/morfeoshow/pegida_quebe-5575/big/Pegida_04.JPG?kjkjh';
$a=strrpos($v,'.'); $b=strrpos($v,'?');
$ret=strtolower(subtopos($v,$a?$a:0,$b?$b:strlen($v)));

return $ret;}
?>