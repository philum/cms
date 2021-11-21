<?php 
//philum_plugin
session_start();
ini_set('display_errors',1);
error_reporting(6135);
$b=isset($_SESSION['dev'])?'b':'';
if(!function_exists('p')){require('prog'.$b.'/lib.php'); require('prog'.$b.'/tri.php');}
connect();
if(!isset($_SESSION['dayx'])){req('boot'); reboot();}
if(!isset($_SESSION['picto']))$_SESSION['picto']=msql_read('system','edition_pictos','',1);

function load_plug($a,$p,$o){$_SESSION['nl']=1;
if(method_exists($a,'home'))$ret=$a::home($p,$o);
if(method_exists($a,'headers'))$a::headers('');
else{reqp($a); if(function_exists('plug_'.$a))$ret=call_user_func('plug_'.$a,$p,$o);}
//$_SESSION['nl']='';
return $ret;}

function plug_menu($a,$p,$o){$ret='';
//$ret.=li(lien('txtsmall','/plug/index',picto('phi')));
if(auth(6)){$ret.=popbub('plug','plugin',picto('phi2'),'d',1);
	//$ret.=llj('','popup_plup___plug_plug*slct',picto('list'));
	$ret.=li(lkc('txtsmall',host().'/plug/'.$a.($p?'/'.$p:''.($o?'/'.$o:'')),$a));
	$ret.=li(lj('txtsmall','popup_plugin___codeview_plug'.ajx($a),picto('code')));//source
	$ret.=msqbt('system','program_plugs').' ';
	$ret.=lj('','popup_editmsql___system/program*plugs_'.ajx($a).'__1',picto('edit')).' ';
	$ret.=lj('','popup_editmsql___lang/fr/program*plugs_'.ajx($a).'__1',picto('flag')).' ';}
if($ret)return mkbub($ret,'inline','','this.style.zIndex=popz+1;').divc('admnu','');}

#--render
if(rstr(22)){req('boot'); block_crawls();}//crawl
$_SESSION['jscode']=$_SESSION['onload']='';
$_SESSION['prog']=$_SESSION['prog']?$_SESSION['prog']:'prog/';
$a=get('a');$p=get('p'); $o=get('o');
if(substr($a,-1)=='/')$a=substr($a,0,-1); if(substr($p,-1)=='/')$p=substr($p,0,-1);
Head::add('tag',['title',$a?$a:'plugin']);
Head::add('meta',['http-equiv','Content-Type','text/html; charset='.$_SESSION['enc']]);
Head::add('rel',['shortcut icon','favicon.ico']);
//Head::add('code','<base'.atb('href',$host).' />');
Head::add('meta',['name','generator','philum_'.$_SESSION['philum']]);
Head::add('csslink','/css/_global.css');
Head::add('csslink','/css/_pictos.css');
//Head::add('csslink','/css/_glyphs.css');
//Head::add('csslink','/css/_ascii.css');
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
$ret.=plug_menu($a,$p,$o);
$ret.=divd('content',$content);
$ret.=hidden('','socket','');
$ret.=divd('popup','');
$ret.=divd('popw','');
$ret.='</body>';
eye();
echo ($ret);//utf
mysqli_close($_SESSION['qr']);
?>