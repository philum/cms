<?php
$db='phinfo';
if($_SESSION['dev']=='lab')$db='';
$_SESSION['qr']=mysqli_connect('localhost','root','',$db);
?>