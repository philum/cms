<?php //sitemap
static sitemap{

static function prep_host_b($nod){
if($_SESSION['sbdm'])return subdomain($nod).'call/sitemap/'.$nod;
else return 'http://'.$_SERVER['HTTP_HOST'].'/call/sitemap/'.$nod;}

static function b_sitm($b,$d){//urlset//sitemapindex
return '<'.'?xml version="1.0" encoding="UTF-8" ?'.'>
<'.$b.' xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
'.$d.'</'.$b.'>'."\n";}

static function content($b,$url,$date,$freq,$prio){
$ret='<'.$b.'>'."\n";//url//sitemap
$ret.=balc('loc','',$url)."\n";
if($date)$ret.=balc('lastmod','',$date)."\n";
if($freq)$ret.=balc('changefreq','',$freq)."\n";
if($prio)$ret.=balc('priority','',$prio)."\n";
//if($video)$ret.=balc('video:video','',balc('video:content_loc','',$prio))."\n";
$ret.='</'.$b.'>'."\n";
return $ret;}

static function sitmap_list($r){
foreach($r as $k=>$v){//0=day 1=frm 2=suj 3=img 4=nod 5=tag 6=lu 7=re
$url='http://'.$_SERVER['HTTP_HOST'].htacc('read').$k;
$date=date('Y-m-d',$v[0]); $freq='never'; $prio='';
if($v[11]==4)$prio=1; elseif($v[11]==3)$prio=0.8;
elseif($v[11]==2)$prio=0.6; elseif($v[11]==1)$prio=0.5;
$xml.=self::content('url',$url,$date,$freq,$prio);}
return $xml;}

static function root($hub){
$r=msql_read('users',$hub.'_cache','',1);
if($r)return sitmap_list($r);}

static function build($hub,$o){$ret='';
if(!isset($_SESSION['mn'][$hub])){$ret=root($hub); return b_sitm('urlset',$ret);}
else foreach($_SESSION['mn'] as $k=>$v)$ret.=self::content('sitemap',prep_host_b($k),'','','');
return b_sitm('sitemapindex',$ret);}

static function home($p,$o){return self::$build($p,$o);}
}
?>