<?php 
session_start();
$b=$_SESSION['dev']??$_SESSION['dev']='';
//ini_set('display_errors',$b?1:0); error_reporting($b?E_ALL:6135);
ini_set('display_errors',1); error_reporting(E_ALL);
require('prog'.$b.'/lib.php');
require('prog'.$b.'/core.php');
connect();
require('prog'.$b.'/ajax.php');
?>