<?php
//philum_plugin_memstorage
session_start();
error_reporting(6135);
if(!function_exists('p'))require('../progb/lib.php');

function mstr_j(){return 'function mem_recap(){var br="<br>";
	var n=localStorage.length; var ob=document.getElementById("cbk"); ob.innerHTML="";
	for(i=0;i<n;i++){var nm="m"+i; var ls=localStorage[nm];
		var bt=lkc("localStorage[\'"+nm+"\']=0",nm);
		addiv("cbk",bt+br+ls+br+br,"cbk"+i,"panel","");}}';}

function plug_memstorage($d){
$_SESSION['jscode']=mstr_j();
$ret.=ljb('txtbox','mem_recap()','','echo').br().br();
$ret.=divd('cbk','').br();
//$ret.=txarea('cbk','',60,10);
return $ret;}

?>