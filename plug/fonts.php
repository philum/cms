<?php
//philum_plugin_download 
session_start();
require("../progb/lib.php");
require("../progb/spe.php");

//need refresh for each depth
function see_fonts($j,$k,$v,$io){
//$r=array('abscdefghijklmnopqrstuvwxyz','0123456789,;:!?./§&й"\'(-и_за)=');
$txt=$_GET["txt"]?$_GET["txt"]:"abcdEFGH1234!й";
echo $fnt=substr($v,0,-4); echo ': ';
echo img_txt($txt,$fnt,"").br();}

function funcb($j,$k,$v,$n){echo $j.'/'.$v.'_'.$k.br();}

walk_dir('../gdf',"see_fonts"); //rmdir($f);

?>