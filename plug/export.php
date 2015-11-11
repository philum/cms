<?php
//philum_plugin_export_bases 
session_start();
require("params/_connectx.php");
//echo $_SERVER['HTTP_HOST'];

function export($su,$sn,$pw,$db,$file){
exc('mysqldump -h"'.$su.'" -u"'.$sn.'" -p"'.$pw.'" '.$db.' '.$file.' > '.$file.'.sql');
return '<a href="'.$file.'.sql">'.$file.': saved => right-clic</a><br>';}

function import(){
//exc('mysqldump -h"'.$su.'" -u"'.$sn.'" -p"'.$pw.'" '.$db.' '.$file.' < '.$file.'.sql');
}

function plug_export(){
$ret.='<a href="?export=_art">_art</a> ';
$ret.='<a href="?export=_txtt">_txt</a> ';
$ret.='<a href="?export=_user">_user</a> ';
$ret.='<a href="?export=_eye">_eye</a> ';
$ret.='<a href="?export=_idy">_idy</a>';
$ret.='<br><br>';
//export
if($_GET['export']!="" && $_SESSION["auth"]>5){
$file=$qd.$_GET['export'];
$ret.=export($host,$user,$pass,$db,$file);}
return $ret;}

?>