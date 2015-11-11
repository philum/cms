<?php
//philum_plugin_tickets 
//loaded from admin
session_start();

function microxform(){
$j='tickets_plug___tickets_tickets*j_'.ses('qb').'__tckmsg|tckansw';
$t.=lj('popbt',$j,nms(28)).' ';
$t.=balise('input',array(1=>'text',3=>"tckansw",23=>nms(91),6=>4,7=>4),'').br();
$t.=balise('textarea',array(3=>"tckmsg",7=>1000,9=>61,10=>7),'');
return form('',$t);}

function msqlxread(){$page=$_GET['page']?$_GET['page']:1; $npg=10;
require('plug/microxml.php'); $min=($page-1)*$npg; $max=$page*$npg; $i=0;
$site='http://philum.net';//$site=philum();//father_server
$r=clkt($site.'/msql/clients/philum_tickets'); unset($r['_menus_']);
if($r)foreach($r as $k=>$v){//array('host','hub','msg','day','ip')
	if($v[0]==$_SERVER['HTTP_HOST'] && $v[1]==ses('qb')){
		$del=lj('txtyl','tickets_plug___tickets_tickets*j_'.$k.'_x','x');}else $del='';
	$answ=ljb('popbt','jumpMenu_text','tckansw_'.($v[5]?$v[5]:$k),nms(91));
	$rb[$k].=btn('txtsmall2',$v[3]).' ';
	$rb[$k].=lkc('txtsmall','http://'.$v[0].'/'.$v[1],$v[1]).' ';
	if(!$v[5])$rb[$k].=$answ.' '; $rb[$k].=$del.br(); $msg=$v[2];
	if(!function_exists('correct_txt'))req('tri,pop,spe');
	//$msg=correct_txt($msg,'','sconn'); 
	if($i>=$min && $i<$max)$msg=miniconn($msg); $i++;
	$rb[$k].=divc('" style="width:400px;',nl2br(stripslashes($msg))).br();
	if($v[5]){$rb[$v[5]].=div('style="margin-left:40px;"',$rb[$k]); unset($rb[$k]);}}
if($rb)rsort($rb);
return by_pages($rb,$page);}

function msqlxml_save($suj,$res){
list($msg,$answ)=explode('_',$res); $site='http://philum.net';//$srv=philum()
if(!is_numeric($answ))$answ='';
$msg=str_replace(array(' ',"\n","&"),array(':space:',':line:','(and)'),$msg);
$go='host='.$_SERVER['HTTP_HOST'].'&hub='.$_SESSION['qb'].'&msg='.$msg.'&suj='.$suj.'&answ='.$answ.'&admail='.$_SESSION['qbin']['adminmail'];
read_file($site.'/plug/microsql.php?tickets=philum&'.$go);}

function tickets_j($id,$b,$res){
msqlxml_save($id,$res); return msqlxread();}

function plug_tickets(){
//$t=msql_read('lang','helps_plugs','tickets');
$ret.=btn('txtcadr',' philum_discussions');
$ret.=msqlink('clients','philum_tickets').br().br();
$ret.=microxform().br();
$ret.=divd('tickets',msqlxread());
return $ret;}

if($_GET['openplug'])echo plug_tickets();

?>