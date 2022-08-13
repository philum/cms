<?php
//philum_ajax GPLv3+
session_start();
$b=$_SESSION['dev']??$_SESSION['dev']='';
ini_set('display_errors',$b?1:0); error_reporting($b?E_ALL:6135);
require('params/_connectx.php');
require('prog'.$b.'/lib.php');
require('prog'.$b.'/core.php');
require('prog'.$b.'/str.php');
require('prog'.$b.'/ajax.php');
?>