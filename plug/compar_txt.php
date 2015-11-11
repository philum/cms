<?php
//philum_plugin_compar_txt 

function plug_compar_txt(){req('pop');
$ex1="version.\nversion\nversion v f d";
$ex2="version.\nversion\nversion v f b";
$txt1=html_entity_decode($_POST["txt1"]);//nl2br
$txt2=html_entity_decode($_POST["txt2"]);//nl2br
if($_GET["test"]){$txt1=$ex1; $txt2=$ex2;}
if($_POST["by1"]){$by=".";}
if($_POST["by2"]){$by="\n";}
if($_POST["by3"]){$by=" ";}
if(isset($by)){
$ar1=explode($by,$txt1);
$ar2=explode($by,$txt2);
$arr=array_diff($ar1,$ar2);}
$inp=txarea("txt1",$txt1,40,10);
$inp.=txarea("txt2",$txt2,40,10).hr();
$inp.=input2('submit','by1','chaque phrase (.)','btn').' ';
$inp.=input2('submit','by2','chaque ligne (/n)','btn').' ';
$inp.=input2('submit','by3','chaque mot ( )','btn').' ';
$ret.=form("",$inp);
$ret.=divc("txtalert","résultat: ".count($arr)." differences");
if($arr){foreach($arr as $k=>$v){$ret.=balc("fieldset","",$v);
$ret.=balc("fieldset","",$ar2[$k]).hr();}}
return $ret;}

?>