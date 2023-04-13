<?php 
//philum.fr General Public License v3+
ini_set('session.cookie_lifetime',0);
ini_set('session.use_only_cookies','on');
ini_set('session.use_strict_mode','on');
ini_set('display_errors','1');
//session_name('a');
$stime=$_SERVER['REQUEST_TIME_FLOAT'];
session_start();
$b=$_SESSION['dev']??$_SESSION['dev']='';
error_reporting($b?E_ALL:6135);
require('prog'.$b.'/lib.php');
require('prog'.$b.'/core.php');
connect();
require('prog'.$b.'/sys.php');
require('prog'.$b.'/index.php');
sqlclose();
?>