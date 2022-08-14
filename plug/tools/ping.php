<?php //ping

function ping_j($p,$o,$res=''){
$ret=chrono('ok');
return $ret;}

function plug_ping($p,$o){
chrono();
$ret=ping_j($p,$o);
return $ret;}

?>