<?php 
//philum.fr General Public License v3+
ini_set('session.cookie_lifetime',0);
ini_set('session.use_only_cookies','on');
ini_set('session.use_strict_mode','on');
ini_set('display_errors','1');
$stime=$_SERVER['REQUEST_TIME_FLOAT'];
session_start();
require('params/_connectx.php');
$b=isset($_SESSION['dev'])?$_SESSION['dev']:'';
if(!isset($_SESSION['prog']))$_SESSION['prog']='prog'.$b;
error_reporting($b?E_ALL:6135);//
$r=['lib','pop','tri','mod','art','spe','boot','sys','index'];
for($i=0;$i<9;$i++)require_once('prog'.$b.'/'.$r[$i].'.php');
//var_dump(debug_backtrace());
mysqli_close($_SESSION['qr']);
?>