<?php
//philum_plugin_session

function plug_session($d){
if(auth(6))return divc('console',$_SESSION[$d?$d:$_GET['call']]).br();}

?>