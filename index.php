<?php 
//philum.fr General Public License v3+
ini_set('session.cookie_lifetime',0);
ini_set('session.use_only_cookies','on');
ini_set('session.use_strict_mode','on');
ini_set('display_errors','1');
$stime=$_SERVER['REQUEST_TIME_FLOAT'];
session_start();
$b=$_SESSION['dev']??$_SESSION['dev']='';
require('params/_connectx.php');
error_reporting($b?E_ALL:6135);
$r=['lib','core','str','sys','index'];
for($i=0;$i<5;$i++)require('prog'.$b.'/'.$r[$i].'.php');
mysqli_close($_SESSION['qr']);
?>