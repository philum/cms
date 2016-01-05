<?php
//philum_plugin_download 

function download_gzip($f){
header('Content-Type: application/x-bzip');
header('Content-Disposition: attachment; filename='.$f);
echo bzcompress($f);}

function download_file($f,$nmf){
header("Content-type: application/octet-stream" );
header('Content-Disposition: attachment; filename='.$nmf);
flush();//Envoie le buffer
readfile($f);}

function download_eye($arr,$dy){
$nod=$_SESSION['qb'].'_downloads';
$fb=msq_f('',$nod);//file
if(is_file($fb))require($fb);//give $r;
$r[$dy]=$arr;
if($_SESSION['qb'])write_file($fb,dump($r,$nod));}

function rednm($d){
if(strrpos($d,"/")!==false)$d=substr($d,strrpos($d,"/")+1);
//if(strrpos($d,".")!==false)$d=substr($d,0,strpos($d,"."));
return normalize($d);}

//
function plug_download($p,$o){
$dir='plug/_data/'.ses('qb').'_'; $f=base64_decode($p);
if($f!="../" && strpos($f,"params")===false && is_file($f)){
	//nb_of_dwnl
	$nm=rednm($f); $nmf=$nm.'.txt';
	if(is_file($dir.$nmf))$nb=read_file($dir.$nmf);
	write_file($dir.$nmf,$nb=$nb?$nb+1:1);
	//clients
	$arr=array($f,hostname()); $dy=date('ymd-hi',time());
	download_eye($arr,$dy);
	download_file($f,$nm);
	}
}

?>