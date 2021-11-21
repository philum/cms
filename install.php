<?php
// _philum_installer
//|_| |_| | |  | | |\/|
//|   | | | |_ |_| |  |
//http://philum.fr 2004-2020
session_start();
ini_set('display_errors','1');
error_reporting(E_ALL);
$_SESSION['phpv']=substr(phpversion(),0,3);//7.4
$_SESSION['philum']='http://philum.fr';
if(isset($_GET['end'])){unlink('install.php'); $_SESSION='';}
if(isset($_GET['reset']))$_SESSION='';
$_SESSION['enc']='iso-8859-1';//utf-8
//$_SESSION['dev']='b';
$_SESSION['first']=1;
$_SESSION['auth']='';
//$_SESSION=[];

//utils
function p($r){print_r($r);}
function br(){return '<br />'."\n";}
function atc($d){return $d?' class="'.$d.'"':'';}
function bal($b,$d){return '<'.$b.'>'.$d.'</'.$b.'>';}
function get($v){return isset($_GET[$v])?$_GET[$v]:'';}
function post($v){return isset($_POST[$v])?$_POST[$v]:'';}
function ses($d,$v=''){if($v)$_SESSION[$d]=$v; return isset($_SESSION[$d])?$_SESSION[$d]:'';}
function sesif($d,$v=''){return isset($_SESSION[$d])?$_SESSION[$d]:ses($d,$v);}
function lk($k,$v){return '<a href="'.$k.'">'.$v.'</a>';}
function balise($l,$p,$t){$end=$t?$t.'</'.$l.'>':''; return '<'.$l.' '.$p.'>'.$end."\n";}
function divc($c,$v){return '<div'.atc($c).'>'.$v.'</div>';}
function write_file($f,$t){$h=fopen($f,'w+'); fwrite($h,$t); fclose($h);}
function read_file($f){$fp=fopen($f,'r'); if(!$fp)return; $ret='';
while(!feof($fp)){$ret.=fread($fp,8192);} fclose($fp); return $ret;}
function w($d){$p='?'; $t=$d?'<':'>'; return $d?$t.$p.'php':$p.$t;}
function hostname(){return gethostbyaddr($_SERVER['REMOTE_ADDR']);}
function dom(){$d=$_SERVER['HTTP_HOST']; $d=substr($d,strrpos($d,'/'));
	return substr($d,0,strpos($d,'.'));}
function instlink($k,$v){return lk('?inst='.$k.'&'.$k.'='.$v,$k.'='.$v).br();}

function normalize($n){//,'-'
$n=str_replace([' ','’','?',"'",'"',',',';',':',',/','%','&','$','§','#','_','+','(',')','[',']','!',"\n",'\r','\0','[\]','~','{','}','«','»'],'',($n));
return strtr($n,'àáâãäçèéêëìíîïñòóôõöùúûüıÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜİ',
'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');}

function relod($d){
echo '<script language="JavaScript">window.location="'.$d.'"</script>';}

function menu($r,$d){$ret='';
foreach($r as $k=>$v){
	if($v)$ret.=str_replace(['[k]','[v]'],[$k,$v],$d);}
return $ret;}

function test_mysql(){
return mysqli_num_rows(mysqli_query($_SESSION['qr'],'SHOW TABLES'));}

//dirs
function read_dir($dr){ 
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
	if(is_dir($drb) && $f!='..' && $f!='.' && $f!=''){$ret[$drb]=read_dir($drb);}
	elseif(is_file($drb))$ret[$drb]=1;}}
return $ret;}

function mkdir_r($d){$r=explode('/',$d); $dir=''; $ret='';
foreach($r as $k=>$v){$dir.=$v.'/'; $di=substr($dir,0,-1);
	if(!is_dir($di) && !strpos($v,'.')){mkdir($di); chmod($di,0777); $ret.=$di.': created'.br();}}
return $ret;}

//onnect
function make_form($r,$go){$ret='';
foreach($r as $k=>$v){
if($v=='text' or $v=='password'){$ret.=balise('input','type="'.$v.'" name="'.$k.'" id="'.$k.'" value="'.($k=='hub'?dom():$k).'" size="44" maxlenght="255"','');}
if($v=='node'){$ret.=balise('input','type="'.$v.'" name="'.$k.'" id="'.$k.'" value="pub" size="5" maxlenght="5"','');}
if($v=='textarea'){$ret.=balise($v,'name="'.$k.'" id="'.$k.'" cols="64" rows="10"',$k);}
if($v=='submit'){$ret.=br().balise('input','type="'.$v.'" name="'.$k.'" id="'.$k.'" value="'.$k.'"','');}
if($v!='submit')$ret.=balise('label','for="'.$k.'"',$k).br();}
return balise('form','name="form" method="post" action="'.$go.'"',$ret);}

function connect_file(){
$lc=post('localhost'); $ro=post('root'); $db=post('database'); $ps=post('password');
return w(1).'
$db=\''.$db.'\';
$qr=mysqli_connect(\''.$lc.'\',\''.$ro.'\',\''.$ps.'\',$db);
$qr->query(\'SET NAMES '.(ses('enc')=='utf-8'?'utf8':'latin1').'\');//to use on utf8 database
ini_set(\'default_charset\',\'ISO-8859-1\');//to use on utf8 server//should be set in virtualserver
$_SESSION[\'qr\']=$qr;
'.w(0);}

function test_connection(){$f='params/_connectx.php';
if(is_file($f)){require($f); if(test_mysql())return $db.': database ok'; else return $db;}}

function connexion(){$r=['localhost'=>'text','root'=>'text','database'=>'text','password'=>'password','ok'=>'submit'];
if(!is_dir('params'))mkdir('params',0777);//705
if($_GET['connexion']=='verif_connexion'){$ok=test_connection();
	return $ok?$ok:'no connexion to mysql';}
elseif($_GET['connexion']=='sav'){write_file('params/_connectx.php',connect_file());
	return instlink('connexion','verif_connexion');}
else return make_form($r,'?inst=connexion&connexion=sav');
return $ret;}

function install_node(){
$ret=bal('p','bases_prefix (3 chars) default: "pub"');
$r=['qd'=>'node','create_node'=>'submit'];
$ret.=make_form($r,'?inst=install_databases&install_databases=sav','').br();
return $ret;}

function save_database($qd){$_SESSION['qd']=$qd; $ret='';
$f='plug/install.php'; if(!is_file($f))$ret=dl_needed_file($f);
require($f); $ret.=plug_install($qd);
return $ret;}

function install_databases(){//$r=mktables();
test_connection(); $g=get('install_databases');
if($g=='node')return install_node();
if($g=='sav')return save_database($_POST['qd']);
elseif(test_mysql())return 'database installed';
else return instlink('install_databases','node');}

function w_master_p(){
$_SESSION['qd']=isset($_POST['qd'])?$_POST['qd']:sesif('qd','pub');
require('params/_connectx.php');
read_file('http://philum.fr/plug/microsql.php?register='.$_SERVER['HTTP_HOST']);}

//masterhub
function masterhub(){
require('params/_connectx.php');
$q=mysqli_query($_SESSION['qr'],'select id from '.ses('qd').'_users where id=1');
if(mysqli_connect_errno())p(mysqli_connect_error());
if($q)$r=mysqli_num_rows($q);
if(!empty($r[0]))return 'okay';
elseif(get('masterhub')=='='){
	$r=['hub'=>'text','mail'=>'text','password'=>'password','register'=>'submit'];
	return make_form($r,'?inst=masterhub&masterhub=sav');}
elseif(get('masterhub')=='sav'){}
else return bal('h3','create first user').instlink('masterhub','=');}

//htacc
function htacc(){
$alrt=bal('li','be carefull! if that dont works you will need to remove .htaccess manually');
$alrt.=bal('li','/.htaccess is used only in case you can\t access to your server as root');
$alrt.=bal('li','in this case, go to admin/config and server params, and set "htaccess" to "yes"');
$alrt.=bal('li','in the case you have all the rights on your own server, please follow the instructions in /pub/vps.txt.');
//if($_GET['htacc']=='delete')return unlink('.htaccess');
if(file_exists('.htaccess'))return 'okay';
elseif($_GET['htacc']=='sav'){$f='pub/htaccess.txt';
	if(!is_file($f))$ret=dl_needed_file($f); rename($f,'.htaccess');}
else return bal('h3','create .htaccess file').bal('pre','').instlink('htacc','sav').br().$alrt;}

//config
function config(){
require('params/_connectx.php'); $f='params/_'.$db.'_config.txt';//$_SESSION['qd']
$ut=ses('enc')=='utf-8'?1:'';
$d='#yes#yes###philum.fr###Europe/Paris#E_ALL#4000#'.$ut.'###';
if(is_file($f))return 'okay';
elseif(get('config')=='sav')write_file($f,$d);
else return bal('h3','config for boot').bal('pre','').instlink('config','sav');}

//dl_program
function dl_needed_file($f){
$dr=substr($f,0,strrpos($f,'/'));
$fu=str_replace('/','-',$f); $ret='';
if(!is_file($f)){mkdir_r($dr);
	$u=$_SESSION['philum'].'/call/software,give/'.$fu; $d=read_file($u);
	if(strpos($d,'failed to open stream')===false && $d)write_file($f,base64_decode($d));
	$ret.=(is_file($f)?'ok:':'error:').' '.$f.br();}
else $ret.='already_exists: '.$f.br();
return $ret;}

function dl_software(){$er='';
$f='_backup/philum.tar.gz'; mkdir_r($f);
$d=read_file($_SESSION['philum'].'/'.$f);
if($d)$er=write_file($f,$d);
require('plug/tar/pclerror.lib.php');
require('plug/tar/pcltrace.lib.php');
require('plug/tar/pcltar.lib.php');
if(!$er)PclTarExtract($f,'','','');
if(is_file($f))return 'ok: software is installed';}

function dl_prog(){
shell_exec('chmod -R 777 '.__DIR__);
$goto='install.php?step='.get('step'); $ret='';
if(get('upd')=='program'){$ret=dl_software(); w_master_p();}
else{$r=['plug/tar/pcltar.lib.php','plug/tar/pclerror.lib.php','plug/tar/pcltrace.lib.php','plug/install.php','plug/apps/tar.php','plug/apps/software.php','css/_global.css','css/public_design_2.css'];
	foreach($r as $k=>$v)if(!is_file($v) or get('redo'))$ret.=dl_needed_file($v);
	if(!is_file('prog/index.php'))
	$ret.=lk($goto.'&upd=program','now: download_program').br();}
mkdir_r('img'); mkdir_r('imgc'); mkdir_r('_datas');
return $ret;}

//infos
function usefull(){
return read_file('pub/infos.txt');}

function go(){return lk('/','Go!');}

//steps
function current_step($mn){
$step=ses('step'); $stpmn=isset($mn[$step])?$mn[$step]:'';
$menu=$stpmn?bal('p',$step.'. '.$stpmn):'';
$ok=test_connection();
$c='okay'; $ret='';
switch($stpmn){
case('connexion'): 
	if(!$ok)$ret=instlink('connexion','='); else $ret=$c; break;
case('databases'): 
	if(!test_mysql())$ret=instlink('install_databases','='); else $ret=$c; break;
case('program'): $ret=dl_prog(); break;
case('htaccess'): $ret=instlink('htacc','='); break;
case('config'): $ret=instlink('config','='); break; //$ret=config();
case('usefull'): $ret=instlink('usefull','='); break;
case('masterhub'): $ret=instlink('masterhub','='); break;//$ret=masterhub();
case('philum'): $ret=instlink('philum','='); break;
case('go'): $ret=instlink('go','='); break;
default:$ret=bal('p','Welcome'); break;}
return $menu.$ret;}

//render
if(!isset($_SESSION['version']))$_SESSION['version']=read_file('http://philum.fr/call/software,version/1');
$mn=['','connexion','databases','program','config','htaccess','usefull','go'];
//'directories','index','master_config','first_hub'//,'masterhub'

$v=get('inst'); $ret='';
if($g=get('step'))$_SESSION['step']=$g;
header('Content-Type: text/html; charset=utf-8');
echo bal('h1',lk('/','philum'));
echo bal('h3','v'.$_SESSION['version']);
echo bal('h2','welcome');

echo bal('h4',lk('http://philum.fr/pub/readme.txt','readme').' '.lk('http://philum.fr/pub/vps.txt','instructions for full install'));
echo bal('h3','Follow the rabbit');
echo menu($mn,'<a href="?step=[k]" style="padding:4px;">[k]. [v]</a> ');
echo bal('fieldset',current_step($mn)).br();
if($g=get($v) && function_exists($v))echo bal('fieldset',call_user_func($v,$g)).br();
echo lk('http://philum.fr/1','philum GNU/GPL');

?>