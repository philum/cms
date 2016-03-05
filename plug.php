<?php 
//philum_plugin GPLv3+
session_start();
ini_set('display_errors',1);
error_reporting(6135);

if($_SESSION['dev']=='dev' or $_SESSION['dev']=='lab')$b='b';
if(!function_exists('p'))require('prog'.$b.'/lib.php');
connect();
if(!$_SESSION['dayx']){req('boot'); $_SESSION['dayx']=time();
	master_params('params/_'.$db,$qd,$aqb,$subd);
	define_hubs(); define_qb(); define_config();}
//require('plug/msql.php');
//require('plug/mysql.php');

function load_plug($d,$p,$o){reqp($d); //$_GET['plug']=1;
if(function_exists('plug_'.$d))return call_user_func('plug_'.$d,$p,$o);}

function plug_hlp($d){
$r=msql_read('system','program_plugs',$d,'1'); $v=$r[0];
$hlp=msql_read('lang','program_plugs',$d);
$ret=btn('small',$r[1].'/'.$d.' ('.$v.')').' ';
//$ret.=lj('grey','bubble_text___'.ajx($v).'_'.$hlp,picto('help'));
//$ret.=bubble('grey','text',ajx($v).'_'.$hlp,picto('help'));
if($hlp)$ret.=togbub('text',ajx($hlp).'__panel',btn('grey',picto('help'))).' ';
return $ret;}

function plug_menu($d,$p,$o){
//$ret.=li(lien('txtsmall','/plug/index',picto('phi')));
$ret.=popbub('plug','plugin',picto('phi2'),'d',1);
//$ret.=llj('','popup_plup___plug_plug*slct',picto('list'));
$ret.=li(lkc('txtsmall',host().'/plug/'.$d.($p?'/'.$p:''.($o?'/'.$o:'')),picto('reload')));
$ret.=li(call_plug('txtsmall','popup','codeview','plug_'.ajx($d),picto('conn')));//source
if(auth(3))$ret.=msqlink('system','program_plugs').' ';
$ret.=plug_hlp($d);
if(auth(4)){
$ret.=lj('','popup_editmsql___system/program*plugs_'.ajx($d).'__1',picto('edit')).' ';
$ret.=lj('','popup_editmsql___lang/fr/program*plugs_'.ajx($d).'__1',picto('flag')).' ';}
return mkbub($ret,'inline','','this.style.zIndex=popz+1;').divc('admnu','');}

#
$_SESSION['jscode']=$_SESSION['onload']='';
$_SESSION['prog']=$_SESSION['prog']?$_SESSION['prog']:'prog/';
$d=$_GET['call']; $p=$_GET['p']; $o=$_GET['o'];
if(substr($d,-1)=='/')$d=substr($d,0,-1); if(substr($p,-1)=='/')$p=substr($p,0,-1);
 
#--render
Head::add('tag',array('title',$d?$d:'plugin'));
Head::add('meta',array('http-equiv','Content-Type','text/html; charset='.$_SESSION['enc']));
Head::add('rel',array('shortcut icon',uicon('copy_16','picol/16','/')));
//Head::add('code','<base'.atb('href',$host).' />');
Head::add('meta',array('name','generator','philum_'.$_SESSION['philum']));
Head::add('csslink','/css/_global.css');
Head::add('csslink','/css/_admin.css');
Head::add('csslink','/css/_classic.css');
//if($_SESSION['prmb'][5])$nod=$_SESSION['qb'].'_auto';
//else $nod=$_SESSION['qb'].'_design_'.$_SESSION['prmd'];
//Head::add('csslink','/css/'.$nod.'.css');
Head::add('jslink','/progb/ajx.js');
Head::add('jslink','/progb/utils.js');
Head::add('jscode','cutat="'.$_SESSION['jbuffer'].'"; flow="0";');
Head::add('jscode',$_SESSION['jscode']);
if($d)$content=load_plug($d,$p,$o);
$ret=Head::generate();
$ret.='<body onmousemove="popslide(event)" onclick="clpop(event);" spellcheck="false" onload="'.$_SESSION['onload'].'">'."\n";
$ret.=divd('clbub','');
$ret.=plug_menu($d,$p,$o);
$ret.=divd('content',$content);
$ret.=hidden('','socket','');
$ret.=divd('popup','');
$ret.=divd('popw','');
$ret.='</body>';
echo utf($ret);
mysql_close();
?>