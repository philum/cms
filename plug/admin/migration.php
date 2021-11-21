<?php
//philum_plugin_transport_img//client-server
//session_start();
/*if(!function_exists('p'))require_once('../progb/lib.php');//always_progb
$servr=sesg('servr','philum.fr');//target
$target_hub=sesg('target_hub','');//target
$root=sesg('root',$_SERVER['PHP_SELF']);*/

//lib
/*function br(){return '<br>';}
function lka($l,$t){return '<a href="'.$l.'">'.$t.'</a>';}
function read_file($f){$fp=fopen($f,"r"); if(!$fp)return; 
while(!feof($fp)){$buffer.=fread($fp,8192);} fclose($fp); return $buffer;}
function write_file($f,$t){$h=fopen($f,'w+'); fwrite($h,$t); fclose($h);}*/

#distant

function scrut_dir_tri($dr){
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
		if($f!='..' && $f!='.' && $f){
			if(is_dir($drb))scrut_dir_tri($drb);
			else echo $drb.';';}}}
return $ret;}

function scrut_dir_only_tri($dr,$vrf){
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
	list($hub,$id,$name)=explode('_',$f);
	if($f!='..' && $f!='.' && $f && !is_dir($f) && $hub==$vrf){$ret[]=$f;}}}
return $ret;}

//function render_data(){}

#local

function call_file_list($d,$h){
$f=read_file('http://'.$_SESSION['servr'].'/plug/_migration.php?dir='.$d.'&hub='.$h);
return explode(';',$f);}

function call_dir_list($d){
$f=read_file('http://'.$_SESSION['servr'].'/plug/_migration.php?subdir='.$d);
return explode(';',$f);}

//img
function dl_img($f){
if(!is_file('../img/'.$f)){
$d=read_file('http://'.$_SESSION['servr'].'/img/'.$f);
if($d)write_file('../img/'.$f,$d); echo 'ok:'.$f.br();}
else echo 'already_exists: '.$f.br();}

//css
function dl_file($d,$f){
if(!is_dir('../'.$d))mkdir('../'.$d);
/*if($d=='css')$fb=str_replace($_SESSION['target_hub'],$_SESSION['qb'],$f);
elseif($d=='users')$fb=str_replace('../'.$d.'/'.$_SESSION['target_hub'],$_SESSION['qb'],$f);
else $fb=$f;*/
$fb=$f;//'../'.$d.'/'.
if(!is_file($fb)){mkdir_r($fb);
$t=read_file('http://'.$_SESSION['servr'].'/'.$d.'/'.$f);
if($t)write_file($fb,$t); echo 'ok: '.$fb.'<br>';}
else echo 'already_exists: '.$fb.br();}

//img
function batch_dl($d,$h){$r=call_file_list($d,$h);
foreach($r as $k=>$v){if($v)dl_file($d,$v);}}

//dir
function batch_dir($d,$h){$r=call_dir_list($d.'/'.$h);
foreach($r as $k=>$v){if($v)dl_file($d,$v);}}

//php
function dl_php_file($f){
//msql/design/test_design_3.php
list($dr,$db,$nd)=preg_split("/[|\.]/",$f); //echo $dr;//php7
$nb=str_replace($_SESSION['target_hub'],$_SESSION['qb'],$nd);
if(!is_file('../'.$f)){
$d=read_file('http://philum.fr/plug/_migration.php?php='.$f);
$d='<'.'?php'.$d.'?'.'>'; write_file('../'.$f,$d); echo 'ok: ../msql/'.$db.'/'.$nb.br();
msql::copy($db,$nd,$db,$nb);}
else echo 'already_exists: '.$f.br();}

function batch_php($d,$h){$r=call_file_list($d,$h);
foreach($r as $k=>$v){if($v)dl_php_file($d.'/'.$v);}}

//data
//http://philum.fr/params/newsnet_backup_pub_art_from_56257.txt
function dl_data($h){require('../params/_connectx.php');
$d=read_file('http://'.$_SESSION['servr'].'/params/'.$h.'_backup_'.$_GET['data']);
$d=stripslashes($d);
$d=str_replace('\''.$_SESSION['target_hub'].'\'','\''.$_SESSION['qb'].'\'',$d);
if($_SESSION['datasaved'][$_GET['data']])echo 'already_saved :: '; 
else $verif=qr($d);
if(!$verif)echo "error"; else echo btn("txtyl",'saved');
$_SESSION['datasaved'][$_GET['data']]=1;}
//target_hub//css users msql datas
function import_hub(){$h=$_SESSION['target_hub'];
$dirs=array('css','msql/users','msql/design','users','img','datas');
foreach($dirs as $k=>$v){$ret.=lka('?target_hub='.$h.'&block='.$v,$v).' ';}
$ret.=br();
if($_GET['block']=='css'){batch_dl('css',$h);}
if($_GET['block']=='msql/users'){batch_php('msql/users',$h);}
if($_GET['block']=='msql/design'){batch_php('msql/design',$h);}
if($_GET['block']=='users'){batch_dir('users',$h);}
if($_GET['block']=='img'){batch_dl('img',$h);}
if($_GET['block']=='ban'){$ret.=lka('?block=ban&import=ban',$txt).br();;}
if($_GET['block']=='datas'){$txt='enter like "pub_art_from_56257" ';
	$ret.=lka('?block='.$v.'&data=',$txt).br();
	if($_GET['data'])dl_data($h);}
}

function plug_migration($p,$o){
//css
if($_GET['dir']){
$r=scrut_dir_only_tri('../'.$_GET['dir'],$_GET['hub']);
if($r)foreach($r as $k=>$v){$ret.=$v.';';}}
//php
if($_GET['php']){
$r=scrut_dir_only_tri('../'.$_GET['php']);
if($r)foreach($r as $k=>$v){$ret.=str_replace(array('<'.'?php','?'.'>'),'',$v).';';}}
//dir
if($_GET['subdir']){scrut_dir_tri('../'.$_GET['subdir']);}
//data
//if($_GET['data']){render_data($_GET['data']);}
//import_img
//if($_GET['import']){batch_dl_img($imgs_hub);}
$ret.='follow_the_rabbit :: fill asked variables in URL'.br();
if($_SESSION['target_hub'] && $_SESSION['auth']>=6)import_hub();
$ret.=br().br();
$ret.=lka($root.'/?servr=','enter target_server').br();
$ret.='target_server: '.$_SESSION['servr'].br();
$ret.=lka($root.'/?target_hub=','target_hub').br();
$ret.='target_hub: '.$_SESSION['target_hub'].br();
$ret.='local_hub: '.$_SESSION['qb'].br();
return $ret;}

//ponctual_import
if(isset($_GET['img']))dl_img($_GET['img']);

?>