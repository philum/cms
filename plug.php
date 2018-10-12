<?php 
//philum_plugin GPLv3+
session_start();
ini_set('display_errors',1);
error_reporting(6135);

if($_SESSION['dev']=='dev' or $_SESSION['dev']=='lab')$b='b';
if(!function_exists('p'))require('prog'.$b.'/lib.php');
connect();
if(!$_SESSION['dayx']){req('boot'); reboot();}
if(!$_SESSION['picto'])$_SESSION['picto']=msql_read('system','edition_pictos','',1);
//require('plug/msql.php');
//require('plug/mysql.php');

function load_plug($d,$p,$o){$_SESSION['nl']=1;
if(function_exists('plug_'.$d))$ret=call_user_func('plug_'.$d,$p,$o);
//$_SESSION['nl']='';
return $ret;}

function plug_menu($d,$p,$o,$dr){if($dr!=1)$dr='/'.$dr;
//$ret.=li(lien('txtsmall','/plug/index',picto('phi')));
if(auth(6))$ret.=popbub('plug','plugin',picto('phi2'),'d',1);
//$ret.=llj('','popup_plup___plug_plug*slct',picto('list'));
$ret.=li(lkc('txtsmall',host().'/plug/'.$d.($p?'/'.$p:''.($o?'/'.$o:'')),$d));
if(auth(6)){
$ret.=li(call_plug('txtsmall','popup','codeview','plug'.$dr.'_'.ajx($d),picto('conn')));//source
	$ret.=msqlink('system','program_plugs').' ';
	$ret.=lj('','popup_editmsql___system/program*plugs_'.ajx($d).'__1',picto('edit')).' ';
	$ret.=lj('','popup_editmsql___lang/fr/program*plugs_'.ajx($d).'__1',picto('flag')).' ';}
return mkbub($ret,'inline','','this.style.zIndex=popz+1;').divc('admnu','');}

#--render
$_SESSION['jscode']=$_SESSION['onload']='';
$_SESSION['prog']=$_SESSION['prog']?$_SESSION['prog']:'prog/';
$d=utf8_decode($_GET['call']); $p=utf8_decode($_GET['p']); $o=utf8_decode($_GET['o']);
if(substr($d,-1)=='/')$d=substr($d,0,-1); if(substr($p,-1)=='/')$p=substr($p,0,-1);
$dr=reqp($d);
Head::add('tag',array('title',$d?$d:'plugin'));
Head::add('meta',array('http-equiv','Content-Type','text/html; charset='.$_SESSION['enc']));
Head::add('rel',array('shortcut icon',uicon('copy_16','picol/16','/')));
//Head::add('code','<base'.atb('href',$host).' />');
Head::add('meta',array('name','generator','philum_'.$_SESSION['philum']));
Head::add('csslink','/css/_global.css');
Head::add('csslink','/css/_pictos.css');
Head::add('csslink','/css/_glyphs.css');
Head::add('csslink','/css/_ascii.css');
Head::add('csslink','/css/_oomo.css');
Head::add('csslink','/css/_admin.css');
//Head::add('csslink','/css/_classic.css');
//if($_SESSION['prmb'][5])$nod=$_SESSION['qb'].'_auto';
//else $nod=$_SESSION['qb'].'_design_'.$_SESSION['prmd'];
//Head::add('csslink','/css/'.$nod.'.css');
Head::add('jslink','/progb/ajx.js');
Head::add('jslink','/progb/utils.js');
Head::add('jscode','cutat="'.$_SESSION['jbuffer'].'"; flow="0"; enc="'.$_SESSION['enc'].'";');
Head::add('jscode',$_SESSION['jscode']);
if($d)$content=load_plug($d,$p,$o);
$ret=Head::generate();
$ret.='<body onmousemove="popslide(event)" onclick="clpop(event);" onload="'.$_SESSION['onload'].'">'."\n";//spellcheck="false" 
$ret.=divd('clbub','');
$ret.=plug_menu($d,$p,$o,$dr);
$ret.=divd('content',$content);
$ret.=hidden('','socket','');
$ret.=divd('popup','');
$ret.=divd('popw','');
$ret.='</body>';
echo utf($ret);
mysqli_close($_SESSION['qr']);
?>