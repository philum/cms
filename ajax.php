<?php
//philum_ajax GPLv3+
session_start();
$b=isset($_SESSION['dev'])?$_SESSION['dev']:'';
if(!isset($_SESSION['prog']))$_SESSION['prog']='prog'.$b;
ini_set('display_errors',$b?1:0); error_reporting($b?E_ALL:6135);
require('params/_connectx.php');
require('prog'.$b.'/lib.php');
require('prog'.$b.'/tri.php');
require('prog'.$b.'/ajax.php');
?>