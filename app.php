<?php
#philum/app
session_start();
ini_set('display_errors',1); error_reporting(E_ALL);
$b=$_SESSION['dev']??$_SESSION['dev']='';
require('prog'.$b.'/lib.php');
require('prog'.$b.'/core.php');
require('prog'.$b.'/str.php');
connect();
gets();
if(!isset($_SESSION['dayx']))boot::reboot();
//if(!$_SESSION['picto'])$_SESSION['picto']=msql_read('system','edition_pictos','',1);
/*
RewriteRule ^app/([^/]+)/([^/]+)/([^/]+)$ /app.php?a=$1&p=$2&o=$3 [L]
RewriteRule ^app/([^/]+)/([^/]+)$ /app.php?a=$1&p=$2 [L]
RewriteRule ^app/([^/]+)$ /app.php?a=$1 [L]*/

function load_plug($a,$p,$o){
if(method_exists($a,'home')){$ret=$a::home($p,$o);
	//if(method_exists($a,'css'))Head::add('csslink',$a::css());
	//if(method_exists($a,'js'))Head::add('jslink',$a::js());
}
elseif(function_exists($a))$ret=$a($p,$o);
else $ret=plugin($a,$p,$o);
return $ret;}

#--render
if(rstr(22))boot::block_crawls();//crawl
$_SESSION['jscode']=$_SESSION['onload']='';
$a=get('a');$p=get('p'); $o=get('o');
if(substr($a,-1)=='/')$a=substr($a,0,-1); if(substr($p,-1)=='/')$p=substr($p,0,-1);
Head::add('tag',['title',$a?$a:'plugin']);
Head::add('meta',['http-equiv','Content-Type','text/html; charset='.$_SESSION['enc']]);
Head::add('rel',['shortcut icon','/favicon.ico']);//uicon('copy_16','picol/16','/')
//Head::add('code','<base'.atb('href',$host).' />');
Head::add('meta',['name','viewport','user-scalable=yes, initial-scale=1, minimum-scale=1, maximum-scale=1, width=device-width','yes']);
Head::add('meta',['name','apple-mobile-web-app-capable','yes']);
Head::add('meta',['name','mobile-web-app-capable','yes']);
Head::add('meta',['name','generator','philum_'.ses('philum')]);
Head::add('csslink','/css/_global.css');
Head::add('csslink','/css/_pictos.css');
Head::add('csslink','/css/_glyphs.css');
Head::add('csslink','/css/_ascii.css');
Head::add('csslink','/css/_oomo.css');
//Head::add('csslink','/css/_admin.css');
//Head::add('csslink','/css/_fa.css');
//Head::add('csslink','/css/_classic.css');
if($_SESSION['prmb'][5])$nod=$_SESSION['qb'].'_auto';
else $nod=ses('qb').'_design_'.$_SESSION['prmd'];
Head::add('csslink','/css/'.boot::define_design().'.css');
Head::add('jslink','/progb/ajx.js');
Head::add('jslink','/progb/utils.js');
Head::add('jscode','flow="0"; enc="'.ses('enc').'";');
Head::add('jscode',ses('jscode'));
if($a)$content=load_plug($a,$p,$o);
$ret=Head::generate();
$ret.='<body onmousemove="popslide(event)" onclick="clpop(event);" onload="'.ses('onload').'">'."\n";//spellcheck="false" 
$ret.=divd('clbub','');
//$ret.=li(lj('','popup_plugin___codeview_plug'.ajx($a),picto('code')));
$ret.=divd('content',$content);
$ret.=hidden('','socket','');
$ret.=divd('popup','');
$ret.=divd('popw','');
$ret.='</body>';
eye();
echo ($ret);//utf
mysqli_close($_SESSION['qr']);
?>