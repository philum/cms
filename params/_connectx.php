<?php
$db='ph1';
if($_SESSION['dev']=='lab')$db='philab';
$dbb=mysql_pconnect('localhost','root','lgr3vdvx'); 
$dbq=mysql_select_db($db,$dbb);
?>