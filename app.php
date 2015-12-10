<?php
#ph1.fr GNU/GPL
session_start();
ini_set('display_errors',1);
error_reporting(6135);
if($_SESSION['dev']=='dev')$b='b';
require('prog'.$b.'/lib.php');
spl_autoload_register('loadapp');
connect();

function plug_menu($d,$p,$o){
$ret=lkc('txtsmall',host().'/app/'.$d.($p?'/'.$p:''.($o?'/'.$o:'')),picto('reload'));
$ret.=call_plug('txtsmall','popup','codeview','app/ummo_'.ajx($d),picto('conn'));
return divd('bub',$ret);};

$app=$_GET['app']; $p=$_GET['p']; $o=$_GET['o'];

#--render 
Head::add('code','<base href="'.$_SERVER['HTTP_HOST'].'" />');
Head::add('meta',array('http-equiv','Content-Type','text/html; charset=utf-8'));//iso-8859-1
Head::add('tag',array('title','','philum'));
Head::add('rel',array('shortcut icon',uicon('copy_16','picol/16','/')));
Head::add('meta',array('name','viewport','width=device-width, initial-scale=1'));
Head::add('meta',array('name','generator','philum_'.$_SESSION['philum']));
Head::add('jslink','/prog'.$b.'/ajx.js');
Head::add('jslink','/prog'.$b.'/utils.js');
Head::add('csslink','/css/_global.css');
Head::add('csslink','/css/_admin.css');
Head::add('jscode','cutat="2000"; flow="0";');
//Head::add('jslink','//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');

$content=App::open($app,$params);
$ret=Head::generate();
$ret.='<body onmousemove="popslide(event)" onclick="clpop(event);" spellcheck="false" onload="'.$_SESSION['onload'].'">'."\n";
$ret.=divd('clbub','');
$ret.=plug_menu($app,$p,$o).br();
$ret.=divd('content',$content);
$ret.=hidden('','socket','');
$ret.=divd('popup','');
$ret.='</body>';
echo utf($ret);

?>