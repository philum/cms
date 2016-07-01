<?php
//philum_plugin_zip_prog
//http://www.phpconcept.net/pcltar/user-guide
ini_set('display_errors','1');
error_reporting(6135);

function make_archive_philum(){//$rd=explore($dr,'dirs');
if(is_file($l='../_public/plug/userdl.tar.gz'))unlink($l);
$zp='../users/philum/maj/philum'.date('ym',time()).'_1.tar'; echo lka($zp,$zp);
$rf=array("htaccess.txt","ajax.php","favicon.ico","index.php","install.php","readme.txt","css","js/colorpicker","js/jquery.js",
"msql","params","plug","prog","progb","pub","video","img","imgb","imgc",);
//"avatar","bkg/shadow","gdf","gallery",
//,"users/public","fla",
foreach($rf as $k=>$v){$v='../_public/'.$v;
	if(is_dir($v) or is_file($v))$rg[]=$v;}
$rg=array_flip(array_flip($rg));
//p($rg);
PclTarCreate($zp,$rg,'','','');}

function make_archive_philum_b(){
$zp='users/philum/maj/philum'.date('ym',time()).'.tar.gz'; echo lka('../'.$zp,'../'.$zp);
exec('tar -zcvf /home/philum/_public/ /home/philum/'.$zp.'');}

function make_archive_philum_c(){
$d='../users/philum/maj/philum'.date('ym',time()).'.tar';
plug_tar($d,'../_public'); echo lka($d,$d);}

function make_archive_philum_d(){
$f='../users/philum/maj/philum'.date('ym',time()).'.tar';
$rf=array("index.php","ajax.php","app.php","plug.php","install.php","htaccess.txt","favicon.ico","readme.txt","vps.txt",'params/_connectx.php.txt',
"avatar/FungShui","css","msql","params","plug","prog","progb","pub","video","app",
"js/colorpicker","js/jquery.js","js/live.js",
'fonts/philum.woff','fonts/philum.eot','fonts/philum.svg','fonts/philum.ttf',
"fonts/philum.tar.gz",);
//"bkg","avatar","bkg/shadow","gdf","gallery","img","imgb","imgc",
//,"users/public","fla",
foreach($rf as $k=>$v){
	$o=$v=='plug'?1:0;
	$v='../_public/'.$v;
	if(is_dir($v))$rg=array_merge_b($rg,read_dir($v,$o));
	if(is_file($v))$rg[]=$v;}
$rg=array_flip(array_flip($rg));//doublons
//p($rg);
echo targz($f,$rg);}

function make_archive_install(){
//gz_create('../_public/install.php','../users/philum/maj/install.gz');
$f='../users/philum/maj/install.tar';
$rf=array("../_public/install.php","../_public/readme.txt","../_public/vps.txt");
echo targz($f,$rf);}

function make_archive_pictos(){
$f='../_public/fonts/philum.tar';
$vr='../fonts/philum.woff'; if(is_file($vr))$rf[]=$vr;
$vr='../fonts/philum.eot'; if(is_file($vr))$rf[]=$vr;
$vr='../fonts/philum.svg'; if(is_file($vr))$rf[]=$vr;
$vr='../fonts/philum.ttf'; if(is_file($vr))$rf[]=$vr;
echo targz($f,$rf);}

function make_archive_fonts(){
$r=msql_read('server','edition_typos',''); //p($r); echo 'ooo';
foreach($r as $k=>$v){$rf='';
	$f='../_public/fonts/'.$v[0].'.tar';
	if(!is_file($f.'.gz')){
	$vr='../fonts/'.$v[0].'.woff'; if(is_file($vr))$rf[]=$vr;
	$vr='../fonts/'.$v[0].'.eot'; if(is_file($vr))$rf[]=$vr;
	$vr='../fonts/'.$v[0].'.svg'; if(is_file($vr))$rf[]=$vr;
	$vr='../fonts/'.$v[0].'.ttf'; if(is_file($vr))$rf[]=$vr;
	echo targz($f,$rf);}}}

function make_archive_icons(){
$f='../_public/imgb/icons/system'; $r=read_dir($f); echo targz($f.'.tar',$r);
$f='../_public/imgb/icons/flags'; $r=read_dir($f); echo targz($f.'.tar',$r);}

/*function mktar_dir($r,$dr,$menu){//1=menus only, 2=subdirs
foreach($r as $k=>$v){if(substr($k,0,1)!='_'){$rf=''; $f=$dr.'/'.$k;
if(is_array($v) && $menu==2)mktar_dir($v,$f,$menu);
else{
	if($menu){echo lka('_zip_prog.php?createzip=dir&dir='.$f,$f).br();}
	else{$f='../imgb/icons/'.$k.'.tar'; //$rf[]=$f;
		$rf=read_dir($dr);
		echo targz($f,$rf);}}}}}*/

function mktar_ico($f){
$dr='../imgb/icons/'; $f=str_replace($dr,'',$f); 
$gz='../imgb/icons/'.str_replace('/','',$f).'.tar.gz'; $rf=$dr.$f;
echo lkc('txtred',$gz,$rf).br();
echo PclTarCreate($gz,$rf);
copy($gz,str_replace('imgb/','_public/imgb/',$gz));}

function mktar_one($f){
$dr='../'; $gz=$dr.'_public/'.$f.'.tar.gz'; $rf=$dr.$f;
echo lkc('txtred',$gz,$dr.$f).br();
echo PclTarCreate($gz,$rf);
copy($gz,$rf.'/'.$f.'.tar.gz');}

function plug__zip_prog(){
$r=array('philum','install','fonts','pictos','icons','bkg','avatar');
return slct_menus($r,'?createzip=',$_GET['createzip'],"","","v");}

//
if(!$_GET['plug']){
require_once('../progb/lib.php');
include("tar/pclerror.lib.php");
include("tar/pcltrace.lib.php");
include("tar/pcltar.lib.php");
require("tar.php");}

if($_GET['createzip']=='philum')make_archive_philum_d();
if($_GET['createzip']=='install')make_archive_install();
if($_GET['createzip']=='fonts')make_archive_fonts();
if($_GET['createzip']=='icons')make_archive_icons();
if($_GET['createzip']=='pictos')make_archive_pictos();
if($_GET['createzip']=='dir')mktar_ico($_GET['dir']);
if($_GET['createzip']=='bkg')mktar_one($_GET['createzip']);
if($_GET['createzip']=='avatar')mktar_one($_GET['createzip']);
if($_GET['del'] && $_SESSION['auth']>5)unlink($_GET['del']);
if(!$_GET['plug'])echo plug__zip_prog();

?>