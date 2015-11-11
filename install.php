<?php
// _philum_installer
//|_| |_| | |  | | |\/|
//|   | | | |_ |_| |  |
//http://philum.net 2004-2015
session_start();
error_reporting(6135);
ini_set('display_errors','1');
//$_SESSION='';

/*--utils--*/
function p($r){print_r($r);}
function br(){return '<br />'."\n";}
function bal($b,$d){return '<'.$b.'>'.$d.'</'.$b.'>';}
function lien($k,$v){return '<a href="'.$k.'">'.$v.'</a>';}
function balb($b,$c,$d){return '<'.$b.' '.$c.'>'.$d.'</'.$b.'>';}
function balise($l,$p,$t){if($t)$end=$t.'</'.$l.'>'; return '<'.$l.' '.$p.'>'.$end."\n";}
function write_file($f,$t){$h=fopen($f,'w+'); fwrite($h,$t); fclose($h);}
function read_file($f){$fp=fopen($f,"r"); if(!$fp)return;
while(!feof($fp)){$buffer.=fread($fp,8192);} fclose($fp); return $buffer;}
function w($d){$p='?'; $t=$d?'<':'>'; return $d?$t.$p.'php':$p.$t;}
function hostname(){return gethostbyaddr($_SERVER['REMOTE_ADDR']);}
function instlink($k,$v){return lien('?inst='.$k.'&'.$k.'='.$v,$k.'='.$v).br();}

function normalize($n){//,"-"
$n=str_replace(array(" ","’","?","'",'"',",",";",":",",/","%","&","$","§","#","_","+","(",")","[","]","!","\n","\r","\0","[\]","~",'{','}',"«","»"),"",($n));
return strtr($n,'àáâãäçèéêëìíîïñòóôõöùúûüıÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜİ',
'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');}

function relod($d){
echo '<script language="JavaScript">window.location="'.$d.'"</script>';}

function menu($r,$d){
foreach($r as $k=>$v){
	if($v)$ret.=str_replace(array("[k]","[v]"),array($k,$v),$d);}
return $ret;}

/*--dirs--*/
function read_dir($dr){ 
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
	if(is_dir($drb) && $f!='..' && $f!='.' && $f!=''){$ret[$drb]=read_dir($drb);}
	elseif(is_file($drb))$ret[$drb]=1;}}
return $ret;}

function del_dir($d,$r){
$nb=count($r); $re[]=$d; rsort($r);
if($nb)for($i=1;$i<$nb;$i++)$re[]=str_replace('/'.$r[$i],"",$re[$i-1]);//list_of_roots
foreach($re as $k=>$v)if(is_dir($v) && !is_array(read_dir($v))){
rmdir($v); $ret.=$v.': deleted'.br();}
return $ret;}

function mkdir_r($d){$r=explode("/",$d);
if($_GET["make_dirs"]=="remove"){/*$ret=del_dir($d,$r);*/}
else{foreach($r as $k=>$v){$dir.=$v.'/'; $di=substr($dir,0,-1);
	if(!is_dir($di)){mkdir($di); chmod($di,0777); $ret.=$di.': created'.br();}}}
return $ret;}

function make_dirs(){$r=list_of_dirs();
foreach($r as $k=>$v){$ret.=mkdir_r($v);}
return $ret;}

/*--connect--*/
function make_form($r,$go){
foreach($r as $k=>$v){
if($v=="text" or $v=="password"){$ret.=balise("input",'type="'.$v.'" name="'.$k.'" id="'.$k.'" value="'.$k.'" size="44" maxlenght="255"',"");}
if($v=="node"){$ret.=balise("input",'type="'.$v.'" name="'.$k.'" id="'.$k.'" value="pub" size="5" maxlenght="5"',"");}
if($v=="textarea"){$ret.=balise($v,'name="'.$k.'" id="'.$k.'" cols="64" rows="10"',$k);}
if($v=="submit"){$ret.=br().balise("input",'type="'.$v.'" name="'.$k.'" id="'.$k.'" value="'.$k.'"',"");}
if($v!="submit")$ret.=balise("label",'for="'.$k.'"',$k).br();}
return balise("form",'name="form" method="post" action="'.$go.'"',$ret);}

function connect_file(){
return w(1).' $dbp=mysql_pconnect("'.$_POST['localhost'].'","'.$_POST['root'].'","'.$_POST['password'].'"); $db="'.$_POST['database'].'"; $dbq=mysql_select_db($db,$dbp); '.w(0);}

function test_connection(){
$f='params/_connectx.php'; if(is_file($f)){require($f);
if(mysql_num_rows(mysql_query('SHOW TABLES')))return $db.': database ok';}
else return 'pas de connexion';}

function connexion(){$r=mkconn();
if(!is_dir('params'))mkdir('params',0777);//705
if($_GET['connexion']=="verif_connexion")return test_connection();
elseif($_GET['connexion']=="sav"){write_file('params/_connectx.php',connect_file());
	return instlink('connexion','verif_connexion');}
else return make_form($r,'?inst=connexion&connexion=sav');
return $ret;}

/*--databases--*/
function make_sql_tables($qd,$qb,$r){
if(!$qd)$qd="pub"; $qd=normalize($qd); if($qb=="sys")$qd="";
$collate='collate latin1_general_ci ';
$sql='CREATE TABLE IF NOT EXISTS `'.$qd.'_'.$qb.'` ('."\n";
foreach($r as $k=>$v){
	switch($v){
	case("ia"): $sql.='`'.$k.'` int(11) NOT NULL auto_increment,'."\n"; break;
	case("int"): $sql.='`'.$k.'` int(11),'."\n"; break;
	case("tin"): $sql.='`'.$k.'` tinytext '.$collate.'NOT NULL,'."\n"; break;
	case("vc"): $sql.='`'.$k.'` varchar(255) '.$collate.'NOT NULL default "",'."\n"; break;
	case("med"): $sql.='`'.$k.'` mediumtext '.$collate.'NOT NULL default "",'."\n"; break;
	case("long"): $sql.='`'.$k.'` longtext '.$collate.'NOT NULL,'."\n"; break;
	case("time"): $sql.='`'.$k.'` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,'."\n"; break;}}
$sql.=$r["key"]."\n";
$sql.=') ENGINE=MyISAM collate latin1_general_ci; '."\n";
$req=mysql_query($sql) or die(mysql_error()); 
if($req)$ret.=bal("p",$qd.'_'.$qb.': ok');
return $ret;}

function save_database($qd){
$_SESSION['qd']=$qd;
$r=tables_defs();
foreach($r as $k=>$v){
$ret.=make_sql_tables($qd,$k,$v);}
return $ret;}

function install_node(){
$ret=bal("p","bases_prefix (3 chars) default: 'pub'");
$r=array("qd"=>"node","create_node"=>"submit");
$ret.=make_form($r,'?inst=install_databases&install_databases=sav',$valu).br();
return $ret;}

function w_ini(){//6135
echo 'ok: .user.ini for '.$_SESSION['phpv'];
write_file('.user.ini','display_errors = "E_STRICT"
date.timezone = "Europe/Paris"');}

function w_master_p(){
$_SESSION['qd']=$_POST["qd"]?$_POST["qd"]:$_SESSION["qd"];
require('params/_connectx.php');
read_file('http://philum.net/plug/microsql.php?register='.$_SERVER['HTTP_HOST']);}

function install_databases(){//$r=mktables();
$db=test_connection();
if($_GET['install_databases']=="node"){return install_node();}
if($_GET['install_databases']=="sav"){return save_database($_POST["qd"]);}
elseif(mysql_num_rows(mysql_query('SHOW TABLES'))) return "database installed";
else return instlink("install_databases","node");}

/*--htacc--*/
function htacc(){
$t=htacc_data();
$alrt=bal("li",'be carefull! if that dont works you will need to remove .htaccess manually');
$alrt=bal("li",'some servers need to specify an entire url in the htaccess');
$alrt=bal("li",'in admin / config / params / master_params, set "htaccess" to "yes"');
if($_GET['htacc']=="delete"){return unlink('.htaccess');}
if($_GET['htacc']=="sav"){
	require('params/_connectx.php'); $prm='params/_'.$db.'_config.txt';
	write_file($prm,$_SESSION['qd'].'#yes#yes###philum.net###Europe/Paris#STRICT#####');
	return write_file('.htaccess',$t);}
elseif(file_exists(".htaccess")) return ".htaccess created";
else return bal("h5","create .htaccess file").bal("pre",$t).instlink("htacc","sav").br().$alrt;}

/*--dl_program--*/
function slct_menus($aff,$lk,$kv){
	foreach($aff as $k=>$v){
	if($kv=="k")$v=$k; elseif($kv=="v")$k=$v;
	if($v)$ret.=lien($lk.$k,$v).' ';}
	return $ret;}

function make_table($datas,$csa,$csb){
if($datas){foreach($datas as $k=>$v){
$td=""; $i++; $cs=$i==1?$csa:$csb;
	if($v)foreach($v as $ka=>$va){$td.=bal("td",$cs,$va);}
$tr.=bal("tr","",$td);}}
return bal("table",'',$tr);}

/*function build_empty_files($d){
$files=read_file($_SESSION['servr'].'?filedate='.$d);
$r=explode(';',$files);
foreach($r as $k=>$v){list($f,$sh)=split('::',$v); $doc=$d.'/'.$f;
	if(!is_file($doc) && $f){write_file($doc,'<'.'? //philum ?'.'>');}}}*/

function dl_tar($g){//echo $_SESSION['servr'].'?getzip='.$g;
	$t=read_file($_SESSION['servr'].'?getzip='.$g);
	if($t)$er=write_file('plug/userdl'.$g.'.tar.gz',$t);
	if(!$er)PclTarExtract('plug/userdl'.$g.'.tar.gz','','','');}
	
function dl_dir($d){//build_empty_files($d);
$f=read_file($_SESSION['servr'].'?dir='.$d);
$r=explode(';',$f);
foreach($r as $k=>$v){$v=str_replace('../','',$v);
	if($v!='plug/distribution.php' && $v)$ret.=dl_needed_file($v);}
return $ret;}

function dl_needed_file($f){
if(!is_file($f)){
	$mkdir=substr($f,0,strrpos($f,'/')); if($mkdir)mkdir_r($mkdir);
	if(!function_exists('bzdecompress'))$b64='&b64==';
	$d=read_file($_SESSION['servr'].'?gz=../'.$f.$b64);
	if(strpos($d,"failed to open stream")===false){
		if($b64)$t=base64_decode($d); else $t=bzdecompress($d);
		write_file($f,$t);}
	if(is_file($f))$ret='ok: '; else $ret='error: ';}
else $ret='already_exists: ';
return $ret.$f.br();}

function upd_dir($r){
foreach($r as $k=>$v){if(!is_dir($v))mkdir($v);
//if($v=='plug' or $v=='prog')
dl_dir($v);
//else dl_tar($v);
}}

function dl_prog(){
$goto='install.php?step='.$_GET['step'];
if(!is_file('plug/distribution.php') or $_GET['reinit']){
	$ret.=dl_needed_file('plug/tar/pcltar.lib.php');
	$ret.=dl_needed_file('plug/tar/pclerror.lib.php');
	$ret.=dl_needed_file('plug/tar/pcltrace.lib.php');
	$ret.=dl_needed_file('css/_global.css');
	$ret.=dl_needed_file('index.php');
	$ret.=dl_needed_file('ajax.php');
	$ret.=dl_needed_file('plug.php');
	$ret.=dl_needed_file('plug/distribution.php');//used by distant
	$ret.=dl_needed_file('plug/microxml.php');//
	$ret.=dl_needed_file('fonts/philum.tar.gz');
	$ret.=dl_needed_file('imgb/icons/system.tar.gz');
	$ret.=dl_needed_file('favicon.ico');
	$ret.=lien($goto.'&upd=program','now: download_program');}
else{$_SESSION['progam']=''; 
include_once('plug/tar/pclerror.lib.php');
include_once('plug/tar/pcltrace.lib.php');
include_once('plug/tar/pcltar.lib.php');
PclTarExtract('fonts/philum.tar.gz','','','');
PclTarExtract('imgb/icons/system.tar.gz','','','');
$ret.=lien($goto.'&upd=program&redo==','download_program').br().br();
$dirs=dl_dirs(); //dl_tar(implode(';',$dirs))
if($_GET["upd"]=='program')upd_dir($dirs);
elseif($_GET["upd"]=='plug')dl_dir($_GET["upd"]);
elseif($_GET["upd"])dl_tar($_GET["upd"]);
//$ret.='download each folder: '.br().br();
foreach($dirs as $k=>$v){
	if($v=='plug' && !is_file($v.'/index.php')){$ret.=lien($goto.'&upd='.$v,$v).br();}
	elseif(is_dir($v)){$ret.='ok: '.$v.br(); $_SESSION['progam'][$v]=1;}
	else $ret.=lien($goto.'&upd='.$v,$v).br();}
$ret.=br().'ok: '.count($_SESSION['progam']).'/'.count($dirs);}
return $ret;}

/*--hub--*/
function usefull(){
$ret=bal("p",lien('index.php','Home'));
//$ret.=bal("p",''.lien('install.php?reset==','kill session');
$ret.=bal("h5","Commandes Url :");
$ret.=bal("li","/admin : backoffice");
$ret.=bal("li","/logout : délog mais reste sur le hub en cours");
$ret.=bal("li","/shutdown : détruit toutes les sessions (restart, utilisateur fraîchement arrivé)");
$ret.=bal("p","Si une erreur type 500 apparaît, ça vient sûrement des permissions de dossiers, qui doivent être à 705 au minimum (777)");
$ret.=bal("p","Le langage est décidé par le serveur (fr ou anglais par défaut), il peut être spécifié dans admin/config");
$ret.=bal("p","Pourquoi 2 dossiers prog et progb ? progb est celui de la Dev, qui se fait en ligne, et accessible par /dev, sans aucun risque pour les visiteurs.");
$ret.=bal("p","Allez sur /index.php pour démarrer et si tout s'est bien passé, revenez sur cette page pour l'auto-détruire");
$ret.=bal("p","And Now...");
$ret.=bal("p",lien('index.php','index').', il vous sera proposé de créer le premier utilisateur, qui sera le Superadmin ayant accès à tous les hubs.');
$ret.=bal("p","Have Fun!");
$ret.=bal("p",''.lien('http://philum.net','http://philum.net').'');
return $ret;}

/*--arrays--*/
function dl_dirs(){return array("prog","progb","plug","msql","js","css","avatar","bkg","fla","gallery","gdf","imgb","pub","video");}
function list_of_dirs(){return array("avatar","bkg","css","fla","fonts","gallery/cache","gallery/mini","gdf","img","imgb/icons/system","imgc","js/colorpicker/js","js/colorpicker/css","msql/system","msql/lang/fr","msql/lang/eng","msql/users","msql/design","msql/stats","msql/clients","msql/server","params","cache","plug/data","prog","progb","users/public","video");}
function mkconn(){return array("localhost"=>"text","root"=>"text","database"=>"text","password"=>"password","ok"=>"submit");}
function mkcfng(){return array("master_of_puppets"=>"text","htaccess"=>"text","create_hub_privilege"=>"text","first_hub"=>"text","create_master_config"=>"submit");}
function mkhub(){return array("user"=>"text","mail"=>"text","password"=>"text","ok"=>"submit");}
function tables_defs(){//make_sql_tables
$table["art"]=array("id"=>"ia","ib"=>"int","name"=>"vc","mail"=>"vc","day"=>"int","nod"=>"vc","frm"=>"vc","suj"=>"vc","re"=>"int","lu"=>"int","img"=>"med","thm"=>"med","host"=>"vc","key"=>"PRIMARY KEY (`id`), KEY `nod_frm` (`day`,`frm`), KEY `suj` (`suj`), KEY `nod_day` (`day`,`nod`)");
$table["txt"]=array("id"=>"ia","msg"=>"long","key"=>"PRIMARY KEY  (`id`)");
$table["idy"]=array("id"=>"ia","ib"=>"int","name"=>"vc","mail"=>"vc","day"=>"int","nod"=>"vc","frm"=>"vc","suj"=>"vc","msg"=>"long","re"=>"int","lu"=>"int","img"=>"vc","thm"=>"vc","host"=>"vc","key"=>"PRIMARY KEY (`id`), KEY `nod_frm` (`day`,`frm`), KEY `nod_suj` (`day`,`suj`), KEY `nod_nod` (`day`,`nod`)");
$table["user"]=array("id"=>"ia","name"=>"vc","pass"=>"vc","mail"=>"vc","day"=>"int","clr"=>"vc","ip"=>"vc","rstr"=>"vc","mbrs"=>"med","hub"=>"vc","nbarts"=>"int","config"=>"med","struct"=>"med","dscrp"=>"med","menus"=>"med","active"=>"int","key"=>"PRIMARY KEY (`id`), UNIQUE KEY `one` (`name`)");
$table["data"]=array("id"=>"ia","ib"=>"vc","qb"=>"vc","day"=>"int","cat"=>"vc","val"=>"vc","msg"=>"med","key"=>"PRIMARY KEY (`id`), KEY `qb` (`qb`,`cat`,`val`)");
$table["sys"]=array("id"=>"ia","name"=>"vc","page"=>"vc","maj"=>"int","func"=>"med","key"=>"PRIMARY KEY (`id`,`name`), KEY `id` (`id`,`maj`)");
$table["live"]=array("id"=>"ia","iq"=>"int","qb"=>"int","page"=>"vc","time"=>"time","key"=>
"PRIMARY KEY (`id`), KEY `qb` (`qb`)");
$table["ips"]=array("id"=>"ia","ip"=>"vc","nav"=>"vc","ref"=>"vc","nb"=>"int","time"=>"time","key"=>
"PRIMARY KEY (`id`), KEY `ip` (`ip`)");
$table["stat"]=array("id"=>"ia","qb"=>"vc","day"=>"int","pag"=>"long","nbu"=>"int","nbv"=>"nbv","key"=> "PRIMARY KEY (`id`), KEY `qb` (`qb`,`day`)");
return $table;}
function htacc_opt(){return 'php_flag "allow_url_fopen" "On"
php_flag "allow_url_include" "On"';}
function htacc_data(){//AddDefaultCharset iso-8859-1
return 'RewriteEngine on
Options +Indexes
Options -Multiviews
Options +FollowSymlinks
RewriteEngine on
RewriteRule ^([0-9]+)$ /?read=$1 [L]
RewriteRule ^read/([^/])$ /?read=$1#$1 [L]
RewriteRule ^read/(.+)/page/([0-9]+) /?read=$1&page=$2#pages [L]
RewriteRule ^source/(.+)/([0-9]+)/page/([0-9]+)$ /?source=$1&dig=$2&page=$3#pages [L]
RewriteRule ^source/(.+)/([0-9]+)$ /?source=$1&dig=$2 [L]
RewriteRule ^source/(.+)$ /?source=$1 [L]
RewriteRule ^plugin/([^.]+)/([^.]+)/([^.]+)$ /?plug=$1&p=$2&o=$3 [L]
RewriteRule ^plugin/([^.]+)/([^.]+)$ /?plug=$1&p=$2 [L]
RewriteRule ^plugin/([^.]+)$ /?plug=$1 [L]
RewriteRule ^plug/([^.]+)/([^.]+)/([^.]+)$ /plug.php?call=$1&p=$2&o=$3 [L]
RewriteRule ^plug/([^.]+)/([^.]+)$ /plug.php?call=$1&p=$2 [L]
RewriteRule ^plug/([^.]+)$ /plug.php?call=$1 [L]
RewriteRule ^rss/([^.]+)$ /plug/rss.php?hub=$1 [L]
RewriteRule ^module/([^/]+)/page/([0-9]+)$ /?module=$1&page=$2 [L]
RewriteRule ^module/([^/]+)/([^.]+)/page/([0-9]+)$ /?module=$2:$1&page=$3 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/page/([0-9]+)$ /?module=$2/$3:$1&page=$4 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/([^.]+)/page/([0-9]+)$ /?module=$2/$3/$4:$1&page=$5 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/([^.]+)/([^.]+)/page/([0-9]+)$ /?module=$2/$3/$4/$5:$1&page=$6 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/([^.]+)/([^.]+)$ /?module=$2/$3/$4/$5:$1 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)/([^.]+)$ /?module=$2/$3/$4:$1 [L]
RewriteRule ^module/([^/]+)/([^.]+)/([^.]+)$ /?module=$2/$3:$1 [L]
RewriteRule ^module/([^/]+)/([^.]+)$ /?module=$2:$1 [L]
RewriteRule ^msql/(.+)/(.+)/(.+)/([0-9]+)$ /?msql=$1/$2&page=$4 [L]
RewriteRule ^msql/(.+)$ /?msql=$1 [L]
RewriteRule ^([^.]+)/(.+)/(.+)/page/([0-9]+)$ /?$1=$2&dig=$3&page=$4#pages [L]
RewriteRule ^([^.]+)/(.+)//page/([0-9]+)$ /?$1=$2&page=$3#pages [L]
RewriteRule ^([^.]+)/(.+)/page/([0-9]+) /?$1=$2&page=$3#pages [L]
RewriteRule ^([^.]+)/(.+)/([0-9]+)$ /?$1=$2&dig=$3 [L]
RewriteRule ^admin/([^/]+)/([^/]+)$ /?admin=$1&set=$2 [L]
RewriteRule ^reload/(.+) /?id=$1&refresh== [L]
RewriteRule ^([^.]+)/([^.^/]+)$ /?$1=$2 [L]
RewriteRule ^reload /?refresh== [L]
RewriteRule ^home /?module=Home [L]
RewriteRule ^all /?module=All [L]
RewriteRule ^admin /?admin=console [L]
RewriteRule ^login /?module=login [L]
RewriteRule ^logon /?log=on [L]
RewriteRule ^logout /?log=out [L]
RewriteRule ^logoff /?log=off [L]
RewriteRule ^reboot /?log=reboot [L]
RewriteRule ^shutdown /?log=down [L]
RewriteRule ^dev /?dev=dev [L]
RewriteRule ^lab /?dev=lab [L]
RewriteRule ^([^.]+)$ /?id=$1 [L]';}//AddType x-mapp-php5 .php

function menus_t(){return array("","phpini","connexion","databases","program","htaccess","usefull","fin");}
//"directories","index","master_config","first_hub"

/*--steps--*/
function current_step($mn){
$step=$_SESSION['step'];
$menu=bal("p",$step.'. '.$mn[$step]);
$connect=test_connection();
$c="okay";
switch($mn[$step]){
case("directories"): $l=list_of_dirs();
	foreach($l as $k=>$v){if(!is_dir($v))$no="ok";}
	if($no)$ret=instlink('make_dirs','='); else $ret=$c; break; //instlink('make_dirs','remove');
case("phpini"): $ret='php version: '.$_SESSION['phpv'].br();
	if($_SESSION['phpv']>=5.3){
		if(!is_file('.user.ini')){w_ini(); $ret.='php>5.3 : phpini a été installé, pour voir les erreurs';} else $ret=$c;} else $ret.='php<5.3 : phpini n\'a pas besoin d\'être installé'; break;
case("connexion"): 
	if($connect=='pas de connexion')$ret=instlink('connexion','='); else $ret=$c; break;
case("databases"): 
	if($connect!="pas de connexion")if(!mysql_num_rows(mysql_query('SHOW TABLES'))) 
	$ret=instlink('install_databases','='); else $ret=$c; w_master_p(); break;
case("program"): $nbp=count($_SESSION['progam']); $_SESSION['progam']='';
	if(count(dl_dirs())==$nbp)$ret=$c; else $ret=dl_prog(); break;
case("htaccess"): if(!is_file('.htaccess'))$ret=instlink('htacc','='); else $ret=$c; break;
case("usefull"): $ret=instlink('usefull','='); break;
case("philum"): $ret=instlink('philum','='); break;
case("fin"): $ret='Si '.lien('/','tout va bien').', '.lien('?fin==','auto-supprimer').' ce fichier'; break;
}
return $menu.$ret;}

/*--render--*/
if($_SESSION['phpv']){$_SESSION['phpv']=substr(phpversion(),0,3);}
if($_GET['step'])$_SESSION['step']=$_GET['step'];
if(!$_SESSION['servr'])$_SESSION['servr']='http://philum.net/_public/plug/distribution.php';
if($_GET['fin']){unlink('install.php');$_SESSION='';}
if($_GET["reset"])$_SESSION='';
if($_GET["redo"])$_SESSION['progam']='';

$v=$_GET["inst"];
if($_GET[$v] && function_exists($v)) $ret=call_user_func($v,$_GET[$v]);

echo bal("h3",lien("?step=1","philum"));
echo bal("h2","welcome");
echo bal("h5","Follow the rabbit");
//echo instlink('make_dirs','=');
//echo instlink('mkdir_r','lang/fr');

$mn=menus_t();
//echo menu($mn,'<a href="?step=[k]">step [k]: [v]</a>').br();
echo menu($mn,'<a href="?step=[k]" style="padding:4px;">[k]. [v]</a> ');
echo bal('fieldset',current_step($mn)).br();
if($ret)echo bal('fieldset',$ret).br();
echo lien('http://philum.net/237','philum GNU/GPL');

?>