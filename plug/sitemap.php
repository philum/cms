<?php
//philum_sitemap 
session_start();
ini_set('display_errors',1);
error_reporting(6135);

function prep_host_b($nod){
if($_SESSION['sbdm'])return subdom($nod).'plug/sitemap.php?p='.$nod;
else return 'http://'.$_SERVER['HTTP_HOST'].'/plug/sitemap.php?p='.$nod;}

function b_sitm($b,$d){//urlset//sitemapindex
return '<'.'?xml version="1.0" encoding="UTF-8" ?'.'>
<'.$b.' xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
'.$d.'</'.$b.'>'."\n";}

function node_build($b,$url,$date,$freq,$prio){
	$ret.='<'.$b.'>'."\n";//url//sitemap
	$ret.=balc('loc','',$url)."\n";
	if($date)$ret.=balc('lastmod','',$date)."\n";
	if($freq)$ret.=balc('changefreq','',$freq)."\n";
	if($prio)$ret.=balc('priority','',$prio)."\n";
	//if($video)$ret.=balc('video:video','',balc('video:content_loc','',$prio))."\n";
	$ret.='</'.$b.'>'."\n";
return $ret;}

function flux_sitmap($r){
foreach($r as $k=>$v){//0=day 1=frm 2=suj 3=img 4=nod 5=tag 6=lu 7=re
	$url='http://'.$_SERVER['HTTP_HOST'].htacc('read').$k;
	$date=date("Y-m-d",$v[0]); $freq='never';
	if(strpos($v[5],'**')!==false)$prio=1;
	elseif(strpos($v[5],'*')!==false)$prio=0.7; else $prio=0.5;
	$xml.=node_build('url',$url,$date,$freq,$prio);}
return $xml;}

function build_sitemap($hub){
$main=msql_read('users',$hub.'_cache','');
if($main["_menus_"])unset($main["_menus_"]); 
if($main)$ret=flux_sitmap($main);
return $ret;}

function plug_sitemap($hub,$o){require('sys.php');
if($_SESSION['mn'][$hub]){$ret=build_sitemap($hub); return b_sitm('urlset',$ret);}
else foreach($_SESSION['mn'] as $k=>$v){$ret.=node_build('sitemap',prep_host_b($k),'','','');}
return b_sitm('sitemapindex',$ret);}

if(!$_GET['plug']){require('../prog/lib.php');
echo plug_sitemap($_GET['p'],$o);}

?>