<?php
//philum_plugin_rss_output 
session_start();
//error_reporting(E_ALL);

function rss_del_old($da){
$r=scrut_dirb('plug/_data');//dav_1305584269_.xml
foreach($r as $k=>$v){list($q,$d)=split('_',$k); $xt=substr($k,-3);
if($q=='data/'.$_SESSION['qb'] && $d<$da && $xt=='xml')unlink($k);}}

//http://validator.w3.org/feed/check.cgi?url=
//0=day 1=frm 2=suj 3=img 4=nod 5=tag 6=lu 7=re
function flux_xml($main,$preview){$http=host();
foreach($main as $k=>$v){
if($v[1]!="user" && $v[7]!=""){
	$url=$http.htacc('read').$k;
	if($preview){//require_once('../progb/mod.php');
		$msg=rse("msg",$_SESSION['qdm'].' WHERE id = "'.$k.'"');
		$msg=correct_txt($msg,'b i h c l /2 /3','corrfast');
		if($preview!="full")$msg=substr($msg,0,kmax_nb(400,$msg));
		$msg=format_txt($msg,"nlc",$k);//nlb=nl+noimages//nlc=absurl
		//if($preview!="full")$msg=substr($msg,0,kmax_nb(400,$msg));
		//$msg=nl2br($msg); //$msg=strip_tags($msg);
		$msg=parse_msg_xml($msg);}
	if(is_image($v[3]) && $preview){$gmi=$http.'/imgc/'.$v[3];
		//$sty='float:left; border-color:1px solid black;';
		$gmo='<img src="'.$gmi.'" style="margin:0 10px 4px 0;" />'."\n";
		$gmo=parse_msg_xml($gmo);}
	else{$gmi="";$gmo="";}
	$lang=data_val('msg',$k,'lang');
	$xml.="<item>\n";
	$v[2]=str_replace("&nbsp;",' ',$v[2]);
	$xml.=bal('title',parse_msg_xml($v[2]))."\n";
	$xml.=bal('link',$url)."\n";
	$xml.=bal('category',parse_msg_xml($v[1]))."\n";
	//$xml.=bal('comments',parse_msg_xml($v[5]))."\n";
	$xml.=balb('guid','isPermaLink="true"',$url)."\n";
	$xml.=bal('pubDate',date("r",$v[0]))."\n";
	$xml.=bal('description',$gmo.$msg)."\n";//'<![CDATA[';//']]>';
	$xml.=bal('author',$author)."\n";
	$xml.=bal('language',($lang?$lang:$_SESSION['prmb'][25]))."\n";
	//$omg=bal('url',$gmi)).bal('title',$v[2]).bal('link',$url);
	//if($gmi)$xml.=bal('image',$omg."\n";
	$xml.="</item>"."\n\n";}}
return $xml;}

//
function plug_rss($hub,$preview){
if($hub)$_GET['hub']=$hub;
if($preview=='=' or !$preview)$preview=2;
if(!$hub)return slct_menus(ses('mn'),'/plug/rss/','','','','kv');
//elseif($preview=='3')$preview='full';
//elseif($preview)$preview=2;
require_once('../prog/lib.php'); req('pop,art');
require('../plug/sys.php'); require('../plug/lib.php');

$fnod=$_SESSION["qb"].'_cache';
$main=msql_read_b('users',$fnod,'',1);
$nb_arts=count($main);
$lastid=lastid('qda'); $last_art=$main[$lastid];
$newest=key($main); $oldest=array_pop($main);
$nb_days=round((time()-$oldest[0])/86400);
$cache=1;

$f='../plug/_data/'.$_SESSION["qb"].'_'.$newest.'_'.$preview.'.xml';
if(is_file($f) && !$_GET['rebuild'] && $cache)return read_file($f);
else{$http=host();//echo $f;

if($preview)req('tri,pop,art');//spe,mod
//$_SESSION['headers']=header('Content-Type: application/rss+xml; charset=iso-8859-1');
//header('Content-Type: application/rss+xml; charset=iso-8859-1');
//$xml.='<!DOCTYPE html>
//<html id="feedHandler" xmlns="http://www.w3.org/1999/xhtml">';
$xml.='<'.'?xml version="1.0" encoding="iso-8859-1"?'.'>'."\n";
$xml.='<rss version="2.0">'."\n";// xmlns:atom="http://www.w3.org/2005/Atom"
$xml.='<channel>'."\n";
//$xml.='<atom:link href="'.$http.'?hub='.$_SESSION["qb"].'&preview==" rel="self" type="application/rss+xml" />'."\n";
$xml.=bal('title',$_SESSION['qb'])."\n";
$xml.=bal('link',$http)."\n";
$xml.=bal('description',$nb_arts.' articles / '.$nb_days.' days - preview='.$preview.' - static url='.$http.substr($f,2))."\n";
$xml.=bal('language','fr')."\n";
$xml.=bal('lastBuildDate',date("r",$last_art[0]))."\n";
if($main)$xml.=flux_xml($main,$preview)."\n";
$xml.='</channel>'."\n"; 
$xml.='</rss>'."\n"; 
//$xml.='</xml>'."\n";
//echo $xml;
write_file($f,$xml);
rss_del_old($newest);}

//eye 
eye('rss');
return $xml;}

if(!$_GET['plug'])
echo plug_rss($_GET['hub'],$_GET['preview']);

?>