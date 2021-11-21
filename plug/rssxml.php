<?php
//philum_plugin_rss_output 
//session_start();
ini_set('display_errors',1);
//error_reporting(6135);

function recup_fileinfob($doc){
if(is_file($doc))return date('d-m-Y',filemtime($doc)).'-'.round(filesize($doc)/1024).'Ko';}

function scrut_dirb($dr){$ret=[];//dev
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
	if(is_dir($drb) && $f!='..' && $f!='.' && $f)$ret[$f]=scrut_dirb($drb);
	elseif(is_file($drb))$ret[$drb]=recup_fileinfob($drb);}}
return $ret;}

function rss_del_old($da){
$r=scrut_dirb('_datas');
if($r)foreach($r as $k=>$v){list($q,$d)=explode('_',$k); $xt=substr($k,-3);
if($q=='data/'.$_SESSION['qb'] && $d<$da && $xt=='xml')unlink($k);}}

function parsetxt($d){
$d=str_replace(['<','>'],['&lt;','&gt;'],$d); //$d=parse($d);
$d=utf8_encode($d);
return $d;}

//0=day 1=frm 2=suj 3=img 4=nod 5=tag 6=lu 7=re
function rss_xml($r,$preview){$http=host();
$minday=time()-86400; $i=0; $ret=''; //p($r);
if($r)foreach($r as $k=>$v)if($i<40){
if(substr($v[1],0,1)!='_' && $v[7]){$i++;
	$url=$http.htacc('read').$k;
	$msg=sql('msg','qdm','v','id="'.$k.'"');
	$msg=codeline::parse($msg,'b i h c s','corrfast');// /2 /3
	if($preview!='full')$msg=substr($msg,0,kmax_nb(400,$msg));
	//$msg=conn::read($msg,'nlc',$k);
	//$msg=codeline::parse($msg,'','sconn');
	$msg=parsetxt($msg);
	$lang=data_val('msg',$k,'lang');
	$ret.='<item>'."\n";
	$v[2]=str_replace("&nbsp;",' ',$v[2]);
	$ret.=balb('title',parsetxt($v[2]))."\n";
	//$ret.=balb('link',$url)."\n";
	//$ret.=balb('category',parsetxt($v[1]))."\n";
	$ret.=bal('guid','isPermaLink="true"',$url)."\n";
	$ret.=balb('pubDate',date('r',$v[0]))."\n";
	$ret.=balb('description',$msg)."\n";
	//$ret.=balb('content',$txt)."\n";
	//if($v[3] && $preview)$ret.=balb('image',balb('url',$http.'/imgc/'.$v[3]))."\n";
	//$ret.=balb('author',$author)."\n";
	//$ret.=balb('language',($lang?$lang:$_SESSION['prmb'][25]))."\n";
	$ret.='</item>'."\n\n";}}
return $ret;}

function rss_build($p,$preview){$http=host();
$fnod=nod('cache'); $qb=ses('qb'); $desc=sql('dscrp','qdu','v','name="'.$qb.'"');
$r=msql::read_b('users',$fnod,'',1); //p($r);
$nb_arts=count($r);
$lastid=lastid('qda'); $last_art=$r[$lastid];
$newest=key($r); $oldest=array_pop($r);
$nb_days=round((time()-$oldest[0])/86400);
//header('Content-Type: application/rss+xml; charset=utf-8');
$ret='<?xml version="1.0" encoding="utf-8" ?>'."\n";
$ret.='<rss version="2.0">'."\n";
$ret.='<channel>'."\n";
$ret.=balb('title',$qb)."\n";
$ret.=balb('link',$http)."\n";
$ret.=balb('description',utf8_encode($desc))."\n";
$ret.=balb('language','fr')."\n";
$ret.=balb('lastBuildDate',date('r',$last_art[0]))."\n";
if($r)$ret.=rss_xml($r,$preview)."\n";
$ret.='</channel>'."\n"; 
$ret.='</rss>'."\n";
return $ret;}

function rss_j($p,$o){
//req('pop,art');
return rss_build($p,$p);}

function plug_rssxml($hub,$preview){
//require_once('plug/lib.php'); 
$rebuild=get('rebuild',1);
if(!$hub)return slct_menus(ses('mn'),'/rss/','','','','kv');
$nod=nod('cache'); $r=msql::read_b('users',$nod,'',1);
$nb_arts=count($r);
$lastid=lastid('qda'); $last_art=$r[$lastid];
$newest=key($r); $oldest=array_pop($r);
$nb_days=round((time()-$oldest[0])/86400);
$cache=1;
$f='_datas/'.$_SESSION['qb'].'_'.$newest.'_'.$preview.'.xml';
if(is_file($f) && !$rebuild && $cache)$ret=read_file($f);
else{
	$ret=rss_build($r,$preview);
	write_file($f,$ret);
	rss_del_old($newest);}
eye('rss');//eye
return $ret;}

?>