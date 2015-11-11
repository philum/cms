<?php
//philum_plugin_source

function plug_source($d){
$jc=$_GET['plug']?'plug/':'';
$t=read_file($jc.$d.'.php');
return txarea('',$t,50,20);}

?>