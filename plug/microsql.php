<?php
//philum_plugin_microsql_dial 
require('../progb/lib.php');
ini_set('display_errors',1);
error_reporting(6135);

function clean_conn($ret){
$ret=str_replace("\n","µ",$ret);
$ret=ereg_replace("[µ]{2,}","µµ",$ret);
if(substr($ret,0,1)=='µ')$ret=substr($ret,1);
if(substr($ret,0,1)=='µ')$ret=substr($ret,1);
$ret=str_replace('µ',"\n",$ret);
$ret=ereg_replace("[ ]{2,}"," ",$ret);
$r=array(':b]',':i]',':u]',':q]',':list]');
foreach($r as $k=>$v){$ret=str_replace(array("\n".$v,' '.$v),array($v,$v.' '),$ret);}
return trim($ret);}

function convhtml_c($d){$d=str_replace('<br>',"\n",$d);
$d=str_replace(array('<li>','</li>'),array('',"\n"),$d);
$ra=array('<b>','<i>','<u>','<blockquote>','<ul>'); $d=str_replace($ra,'[',$d);
$ra=array('</b>','</i>','</u>','</blockquote>','</ul>');
$rb=array(':b]',':i]',':u]',':q]',':list]'); $d=str_replace($ra,$rb,$d);
return clean_conn($d);}

function receive_xmsg($d){$d=ajx($d,1);
$d=str_replace(array(':space:',':line:'),array(' ',"\n"),$d);
return convhtml_c(utflatindecode($d));}

function save_xmsg($dr,$nod,$arr,$dfb=''){$dir='../msql/'.$dr.'/';
if(is_file($dir.$nod.'.php')){
	if(is_numeric($_GET['suj']))modif_vars($dr,$nod,$_GET['suj'],'del');
	else modif_vars($dr,$nod,$arr,'push');}
else{$r=plug_motor($dir,$nod,$dfb); $r[]=$arr; if($r[0])$r=msq_reorder($r); 
write_file($dir.$nod.'.php',dump($r,$nod));}
if($arr[2] && ($_GET['chat']=='tickets' or $_GET['tickets']))mail('8119@philum.net','tickets',stripslashes($arr[2]),'From: '.$_GET['name'].'<'.$_GET['admail'].'>');}

if($reg=$_GET['register']){
$arr=array(date('ymd',time()),$_SERVER['HTTP_USER_AGENT'],$_SERVER['HTTP_REFERER'],hostname(),$reg); save_xmsg('clients','philum_users',$arr);}

if($_GET['tickets']){$msg=receive_xmsg($_GET['msg']);
$dfb['_menus_']=array('host','hub','msg','day','ip','ib');
$arr=array($_GET['host'],$_GET['hub'],$msg,date('ymd',time()),hostname(),$_GET['answ']);
save_xmsg('clients',$_GET['tickets'].'_tickets',$arr,$dfb);}

if($_GET['chat']){$msg=receive_xmsg($_GET['msg']);
$dfb['_menus_']=array('time','name','msg','host');
$arr=array(time(),$_GET['name'],($msg),$_GET['host']);//html_entity_decode
save_xmsg('clients','chat_'.$_GET['chat'],$arr,$dfb);}
if($_GET['canalchat'])echo implode(';',array_keys(msq_select('clients','chat','')));
if($m=$_GET['kmail']){require('sys.php'); echo sql('mail','qdu','v','name="'.$m.'"');}

if($_GET['connect']){$mnu['_menus_']=array('url'); 
	msql_modif('server','philum_share',array($_GET['share']),$mnu,'mdf',0);}
if($f=$_GET['fdate'])if(is_file($f))echo filemtime($f);
if($f=$_GET['fsize'])if(is_file($f))echo round(filesize($f)/1024).' Ko';
if($f=$_GET['fwidth'])if(is_file($f)){list($w,$h)=getimagesize($f); echo $w.'_'.$h;}
if($f=$_GET['addserver']){if($_GET['del'])$arr[$f]=array('no'); else $arr[$f]=array('ok');
	echo msql_fastsave('server','shared_servers',$arr);}
if($_GET['getservers']){$r=msql_read('server','shared_servers');
	foreach($r as $k=>$v)if($v=='ok')echo $k.';';}
if($f=$_GET['proxy'])echo file_get_contents(urldecode($f));

?>