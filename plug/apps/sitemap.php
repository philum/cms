<?php 
class sitemap{

static function host($nod){
if($_SESSION['sbdm'])return subdomain($nod).'call/sitemap/'.$nod;
else return 'http://'.$_SERVER['HTTP_HOST'].'/call/sitemap/'.$nod;}

static function head($b,$d){//urlset//sitemapindex
header('Content-Type: application/xml; charset=utf-8');
return '<'.'?xml version="1.0" encoding="UTF-8" ?'.'>
<'.$b.' xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
'.$d.'</'.$b.'>'."\n";}

static function content($b,$url,$date,$freq,$prio){
$ret=tagb('loc',$url)."\n";
if($date)$ret.=tagb('lastmod',$date)."\n";
if($freq)$ret.=tagb('changefreq',$freq)."\n";
if($prio)$ret.=tagb('priority',$prio)."\n";
//if($video)$ret.=tagb('video:video',tagb('video:content_loc',$prio))."\n";
return tagb($b,$ret)."\n";}//url//sitemap

static function build($r){$ret='';
foreach($r as $k=>$v){//0=day 1=frm 2=suj 3=img 4=nod 5=tag 6=lu 7=re
$url='http://'.$_SERVER['HTTP_HOST'].htacc('read').$k;
$date=date('Y-m-d',$v[0]); $freq='never'; $prio='';
if($v[11]==4)$prio=1; elseif($v[11]==3)$prio=0.8;
elseif($v[11]==2)$prio=0.6; elseif($v[11]==1)$prio=0.5;
$ret.=self::content('url',$url,$date,$freq,$prio);}
return self::head('urlset',$ret);}

static function call($hub){
$r=msql::read('users',$hub.'_cache','',1);
if($r)return self::build($r);}

static function robots($r){$rt=[];
foreach($r as $k=>$v)$rt[]='Sitemap: '.self::host($k);
write_file('robots.txt',implode("\n",$rt));}

static function robots2($r){//general
$d='Sitemap: http://'.host().'/app/sitemap';
write_file('robots.txt',$d);}

static function home($hub,$o){$ret=''; $mn=ses('mn'); self::robots([ses('qb')=>1]);//$mn
if($hub && !$mn[$hub]){$ret=self::call($hub); return self::head('urlset',$ret);}
elseif($mn)foreach($mn as $k=>$v)$ret.=self::content('sitemap',self::host($k),'','','');
return $ret;}//self::head('sitemapindex',$ret)
}
?>