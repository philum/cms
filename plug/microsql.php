<?php
//philum_app_microsql

class microsql{

static function clean_conn($ret){
$ret=str_replace("\n","µ",$ret);
$ret=preg_replace("/(µ){2,}/","µµ",$ret);
if(substr($ret,0,1)=='µ')$ret=substr($ret,1);
if(substr($ret,0,1)=='µ')$ret=substr($ret,1);
$ret=str_replace('µ',"\n",$ret);
$ret=preg_replace('/( ){2,}/',' ',$ret);
$r=[':b]',':i]',':u]',':q]',':list]'];
foreach($r as $k=>$v){$ret=str_replace(["\n".$v,' '.$v],[$v,$v.' '],$ret);}
return trim($ret);}

static function convhtml($d){$d=str_replace('<br>',"\n",$d);
$d=str_replace(['<li>','</li>'],['',"\n"],$d);
$ra=['<b>','<i>','<u>','<blockquote>','<ul>']; $d=str_replace($ra,'[',$d);
$ra=['</b>','</i>','</u>','</blockquote>','</ul>'];
$rb=[':b]',':i]',':u]',':q]',':list]']; $d=str_replace($ra,$rb,$d);
return self::clean_conn($d);}

static function receive_xmsg($d){$d=ajx($d,1);
$d=str_replace([':space:',':line:'],[' ',"\n"],$d);
return self::convhtml(utflatindecode($d));}

static function save_xmsg($dr,$nod,$arr,$dfb=[]){
if(is_file(msql::url($dr,$nod))){$d=get('suj');
	if(is_numeric($d))msql::modif($dr,$nod,'','del','',$d);
	else msql::modif($dr,$nod,$arr,'push');}
else{$r=msql::read_b($dr,$nod,'','',$dfb); $r[]=$arr; if($r[0])$r=msql::reorder($r); 
msql::save($dr,$nod,$r);}
//if($arr[2] && (get('chat')=='tickets' or get('tickets')))mail($_SESSION['qbin']['adminmail'],'tickets',stripslashes($arr[2]),'From: '.get('name').'<'.get('admail').'>');
}

static function build($p,$d){$ret='';
if($d=get('register')){
$ra=[date('ymd',time()),$_SERVER['HTTP_USER_AGENT'],$_SERVER['HTTP_REFERER'],hostname(),$d];
self::save_xmsg('clients','philum_users',$arr);}

if($p=='tickets'){$msg=self::receive_xmsg(get('msg'));
$dfb['_menus_']=['host','hub','msg','day','ip','ib'];
$arr=[get('host'),get('hub'),$msg,date('ymd',time()),hostname(),get('answ')];
self::save_xmsg('clients',$d.'_tickets',$arr,$dfb);}

if($p=='chat'){$msg=self::receive_xmsg(get('msg'));
$dfb['_menus_']=['time','name','msg','host'];
$arr=[time(),get('name'),$msg,get('host')];//html_entity_decode
self::save_xmsg('clients','chat_'.$_GET['chat'],$arr,$dfb);}
if($p=='canalchat'){$r=msql::choose('clients','chat',''); if($r)$ret=implode(';',array_keys($r));}
if($p=='kmail')$ret=sql('mail','qdu','v','name="'.$d.'"');

if($p=='connect'){$mnu['_menus_']=['url']; 
	msql::modif('server','philum_share',[get('share')],'mdf',$mnu,0);}
if($p=='fdate')if(is_file($d))$ret=filemtime($d);
if($p=='fsize')if(is_file($d))$ret=round(filesize($d)/1024).' Ko';
if($p=='fwidth')if(is_file($p)){list($w,$h)=getimagesize($d); $ret=$w.'_'.$h;}
if($p=='addserver'){
	if(get('del'))modif('server','shared_servers','','add',[],$d);
	else msql::add('server','shared_servers',[$d=>'ok']);}
if($p=='getservers'){$r=msql_read('server','shared_servers');
	foreach($r as $k=>$v)if($v=='ok')$ret=$k.';';}
if($p=='proxy')$ret=file_get_contents(urldecode($d));
return $ret;}

}
?>