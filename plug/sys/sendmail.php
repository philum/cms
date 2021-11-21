<?php
//philum_plugin_sendmail 
require_once("../progb/lib.php");
setlocale(LC_TIME,"fr_FR");
////////must_fill_this:
$myip="";
//$ret.=hostname();

function make_form_b($arr,$goto){
if($_GET["kill"]) $r=array("from"=>$_GET["kill"],"dest"=>$_GET["dest"],"suj"=>$_GET["suj"]);
	foreach($arr as $k=>$v){
	if($v=="text"){
	$ret.=bal('input',array('type'=>$v,'name'=>$k,'id'=>$k,'value'=>$r[$k],'class'=>"txtblc",'size'=>44,'maxlength'=>255),"");}
	if($v=="textarea"){$ret.=bal($v,array('name'=>$k,'id'=>$k,'class'=>'txtblc','cols'=>64,'rows'=>10),$k);}
	if($v=="submit"){$ret.=submit($v,$k,"txtblc");}
	if($v!="submit")$ret.=bal('label',array("for"=>$k),$k).br();}
	return form("",$ret);}

function plug_sendmail(){
$ret.=lkc("","sendmail.php","index").br();
$ip=hostname();
$arr=array("from"=>"text","dest"=>"text","suj"=>"text","msg"=>"textarea","ok"=>"submit");
if($_POST["submit"]=="ok"){
foreach($arr as $k=>$v){$$k=$_POST[$k]; $ret.=$k.': '.$$k."\n";}
if($ip==$myip){$ret.=nl2br($ret);
	mail($dest,$suj,$msg,'From: '.$from."\n","");}
else{$ret.="_specify_your_ip_in_source".br();}}
	$f="data/sendmail.txt";//$ret.=lkc("",$f,"txt").br();
	$t.=date("ymd.Hi",time())."\n".$ip."\n".$ret."---\n";
	$t.=read_file($f);
	write_file($f,$t."\n");
	//write_file($f,$t,"a+");
$ret.=make_form_b($arr,"");
return $ret;}

?>