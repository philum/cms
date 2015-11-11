<?php
//philum_ajax GPLv3+
session_start();
ini_set('display_errors','0'); error_reporting(6135);
if($_SESSION['dev']=='dev' or $_SESSION['dev']=='lab')$b='b';
require('params/_connectx.php');
require('prog'.$b.'/lib.php'); 
require('prog'.$b.'/ajax.php');
?>