<?php 
//philum_plugin GPLv3+
session_start();
ini_set('display_errors',1);
error_reporting(6135);

if($_SESSION['dev']=='dev' or $_SESSION['dev']=='lab')$b='b';
if(!function_exists('p'))require('prog'.$b.'/lib.php');
if(!$_SESSION['dayx']){req('boot'); connect(); $_SESSION['dayx']=time();
	master_params('params/_'.$db,$qd,$aqb,$subd);
	define_hubs(); define_qb(); define_config();}
//require('plug/msql.php');
//require('plug/mysql.php');

function open_plug($d,$p,$o){$_GET['plug']=1;
if(is_file($f='plug/'.$d.'.php'))require($f); else return 'nothing';
if(function_exists('plug_'.$d))return call_user_func('plug_'.$d,$p,$o);}

function plug_hlp($d){
$r=msql_read('system','program_plugs',$d,'1'); $v=$r[0]; //p($r);
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
return mkbub($ret,'inline','','this.style.zIndex=popz+1;');}

#
$_SESSION['headr']=$_SESSION['head_r']=$_SESSION['jscode']=$_SESSION['onload']='';
$_SESSION['prog']=$_SESSION['prog']?$_SESSION['prog']:'prog/';
$d=$_GET['call']; $p=$_GET['p']; $o=$_GET['o']; if(substr($d,-1)=='/')$d=substr($d,0,-1);

#--render
header_add('rel',array('shortcut icon',uicon('copy_16','picol/16','/')));
//header_add('code','<base'.atb('href',$host).' />');
header_add('meta',array('name','generator','philum_'.$_SESSION['philum']));
header_add('css','/css/_global.css');
header_add('css','/css/_admin.css');
//if($_SESSION['prmb'][5])$nod=$_SESSION['qb'].'_auto';
//else $nod=$_SESSION['qb'].'_design_'.$_SESSION['prmd'];
//header_add('css','/css/'.$nod.'.css');
header_add('js','/progb/ajx.js');
header_add('js','/progb/utils.js');
header_add('jscode','cutat="'.$_SESSION['jbuffer'].'"; flow="0";');
header_add('jscode',$_SESSION['jscode']);
if($d)$content=open_plug($d,$p,$o);
//if($d)$content=Plug::open($d,$p,$o);
//pr($_SESSION['head_r']);
$ret=headers_r($d?$d:'plugins');
$ret.='<body onmousemove="popslide(event)" onclick="clpop(event);" spellcheck="false" onload="'.$_SESSION['onload'].'">'."\n";
$ret.=divd('clbub','');
$ret.=plug_menu($d,$p,$o).br();
$ret.=divd('content',$content);
$ret.=hidden('','socket','');
$ret.=divd('popup','');
$ret.='</body>';
echo utf($ret);

?>