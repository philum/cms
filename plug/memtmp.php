<?php
//philum_ajax_storage
session_start();
$_SESSION['memtmp'][$_GET['nb']]=$_GET['callj'];
echo $_GET['nb'];
//$_SESSION['memtim'][$_GET['nb']]=microtime();
?>