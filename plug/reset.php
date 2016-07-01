<?php
//philum_plugin_reset

function plug_reset(){
//session_destroy(); $_SESSION=''; $_SESSION['dev']='dev';
$r=array('qd','qb','USE','iq','dev');
	foreach($r as $v)$ret[$v]=$_SESSION[$v]; $_SESSION=$ret;
return btn('txtyl','all sessions were killed');}

?>