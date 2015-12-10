<?php 
//philum.net General Public License v3+
session_start();
ini_set('display_errors','1'); error_reporting(6135);
require('params/_connectx.php');
list($daym,$dayx)=explode(' ',microtime()); $stime=$dayx+$daym;
if($_SESSION['dev']=='dev' or $_SESSION['dev']=='lab')$g='b';
$r=array('lib','pop','spe','art','tri','mod','boot','sys','index');
for($i=0;$i<9;$i++)require('prog'.$g.'/'.$r[$i].'.php');
mysql_close();
?>