<?php 
//philum_call
session_start();
$b=$_SESSION['dev']??$_SESSION['dev']='';
ini_set('display_errors',$b?1:0); error_reporting($b?E_ALL:6135);
require('prog'.$b.'/lib.php');
require('prog'.$b.'/core.php');
require('prog'.$b.'/str.php');
connect();
gets();
if(rstr(22))boot::block_crawls();//crawl
if(!isset($_SESSION['dayx']))boot::reboot();
#RewriteRule ^call/([^/]+)/([^/]+)/([^/]+)$ /call.php?a=$1&p=$2&o=$3 [L]
#RewriteRule ^call/([^/]+)/(.+)$ /call.php?a=$1&p=$2 [L]
#RewriteRule ^call/([^.]+)$ /call.php?a=$1 [L]
$a=get('a'); $m=get('m'); $p=get('p'); $o=get('o'); $ret='';
if(strpos($a,','))[$a,$m]=explode(',',$a); $m=$m?$m:'build';

//vacuum,api,rss,sitemap
if(method_exists($a,$m))$ret=$a::$m($p,$o);
elseif(method_exists($a,'call'))$ret=$a::call($p,$o);
elseif($a){reqp($a);
	$fc=get('fc'); $fc=$fc?$fc:'build'; $c=$a.'_'.$fc;
	if(function_exists($c))$ret=$c($p,$o);}
echo ($ret);//utf
alert(play_r(ses::r('spl')));
eye($a);
mysqli_close($_SESSION['qr']);
?>