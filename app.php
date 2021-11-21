<?php
#philum/app
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
$b=isset($_SESSION['dev'])?'b':'';
$r=['lib','tri','pop','mod','art','spe','boot'];
for($i=0;$i<7;$i++)require_once('prog'.$b.'/'.$r[$i].'.php');
connect();
if(!isset($_SESSION['dayx']))reboot();
//if(!$_SESSION['picto'])$_SESSION['picto']=msql_read('system','edition_pictos','',1);

function load_plug($a,$p,$o){//$_SESSION['nl']=1;
//echo $a.'-'.$p.'-'.$o;
if(method_exists($a,'home')){$ret=$a::home($p,$o);
	if(method_exists($a,'headers'))$a::headers('');}
elseif(function_exists($a))$ret=$a($p,$o);
else $ret=plugin($a,$p,$o);
if(!$ret)$ret=conn::read('['.$p.':'.$a.']');
//$_SESSION['nl']='';
return $ret;}

#--render
if(rstr(22)){req('boot'); block_crawls();}//crawl
$_SESSION['jscode']=$_SESSION['onload']='';
$_SESSION['prog']=$_SESSION['prog']?$_SESSION['prog']:'prog/';
$a=get('a');$p=get('p'); $o=get('o');
if(substr($a,-1)=='/')$a=substr($a,0,-1); if(substr($p,-1)=='/')$p=substr($p,0,-1);
Head::add('tag',['title',$a?$a:'plugin']);
Head::add('meta',['http-equiv','Content-Type','text/html; charset='.$_SESSION['enc']]);
Head::add('rel',['shortcut icon','favicon.ico']);//uicon('copy_16','picol/16','/')
//Head::add('code','<base'.atb('href',$host).' />');
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
else $nod=$_SESSION['qb'].'_design_'.$_SESSION['prmd'];
Head::add('csslink','/css/'.$nod.'.css');
Head::add('jslink','/progb/ajx.js');
Head::add('jslink','/progb/utils.js');
Head::add('jscode','cutat="'.$_SESSION['jbuffer'].'"; flow="0"; enc="'.$_SESSION['enc'].'";');
Head::add('jscode',$_SESSION['jscode']);
if($a)$content=load_plug($a,$p,$o);
$ret=Head::generate();
$ret.='<body onmousemove="popslide(event)" onclick="clpop(event);" onload="'.$_SESSION['onload'].'">'."\n";//spellcheck="false" 
$ret.=divd('clbub','');
//$ret.=li(lj('','popup_plugin___codeview_plug'.ajx($a),picto('code')));
$ret.=divd('content',$content);
$ret.=hidden('','socket','');
$ret.=divd('popup','');
$ret.=divd('popw','');
$ret.='</body>';
eye();
echo utf($ret);
mysqli_close($_SESSION['qr']);
?>