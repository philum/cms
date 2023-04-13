<?php 
class reset{
static function home(){
//session_destroy();
$r=['qd','qb','USE','iq','dev'];
foreach($r as $v)$ret[$v]=$_SESSION[$v]; $_SESSION=$ret;
return btn('txtyl','all sessions were killed');}
}
?>