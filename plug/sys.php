<?php
//philum_plugin_microsys 
//second door
session_start();
$prg=root().'prog';
if($_SESSION['dev']=='dev' or $_SESSION['dev']=='lab')$prg.='b';
require_once(root().'params/_connectx.php');
require_once($prg.'/boot.php');
require_once($prg.'/spe.php');
//require_once($prg.'/lib.php');
$_SESSION["dayx"]=time();
$_SESSION['daya']=$_SESSION["dayx"];

//xml
function parse_msg_xml($msg){
$ar1=array("&","<",">");//'"',
$ar2=array('&amp;',"&lt;","&gt;");//"'",
$msg=str_replace($ar1,$ar2,$msg);
if($_GET["flash"])$msg=utf8_encode($msg);
return $msg;}

/*------*/# Boot
//refresh_cache
if(!$_SESSION['qb'] or !$_SESSION['qda'] or $_GET['qd'] or $_GET['id'] or $_GET['nbj']){
	$cache_refresh="ok";}// or $_SESSION['prmb'][0]!=$_SESSION['qb']
//master_params
if(!$_SESSION['qd'] or $cache_refresh=="ok")
	master_params('../params/_'.$db,$qd,$aqb,$subd);
//hubs
if(!$_SESSION['mn'] or $cache_refresh=="ok")define_hubs();
//qb :: need $mn
if(!$_GET['nbj'] && $cache_refresh=="ok")define_qb($defo);
$qb=$_SESSION['qb']; 
if($_GET['nbj'])$_SESSION['dayb']=calc_date($_GET['nbj']); 
	else $_SESSION['dayb']=calc_date(30);
//$_SESSION['nbj']=dayslength($_SESSION['qb'],50);
//deductions
$read=$_GET['read'];
$cache_refresh=deductions_from_read($read,$cache_refresh);
//qb_in
if(!$_SESSION['qbin'] or $cache_refresh){define_config();}
//rss
if($_GET['hub']){$_SESSION["qb"]=$_GET['hub'];}

?>