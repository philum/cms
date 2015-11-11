<?php
//philum_plugin_session
session_start();
error_reporting(6135);

function plug_session($d){
return divc('console',$_SESSION[$d?$d:$_GET['call']]).br();}

?>