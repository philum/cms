<?php
//philum_plugin_tickets 
//loaded from admin

function microxform(){
$j='tickets_plug___tickets_tickets*j_'.ses('qb').'__tckmsg|tckansw';
$t.=lj('popbt',$j,nms(28)).' ';
$t.=bal('input',array('type'=>'text','id'=>"tckansw",'placeholder'=>nms(91),'size'=>4,'maxlength'=>4),'').br();
$t.=bal('textarea',array('id'=>"tckmsg",'maxlength'=>1000,'cols'=>61,'rows'=>7),'');
return form('',$t);}

function by_pages($r,$p){$n=count($r); $page=$p?$p:1; $npg=10;
$ret=nb_page($n,$npg,$page); $min=($page-1)*$npg; $max=$page*$npg;
for($i=0;$i<$n;$i++){if($i>=$min && $i<$max)$ret.=$r[$i];}
return $ret;}

function msqlxread(){$page=$_GET['page']?$_GET['page']:1; $npg=10;
reqp('microxml'); $min=($page-1)*$npg; $max=$page*$npg; $i=0;
$site='http://philum.fr';//$site=philum();//father_server
$r=mx_call($site.'/msql/clients/philum_tickets'); unset($r['_menus_']);
if($r)foreach($r as $k=>$v){//array('host','hub','msg','day','ip')
	if($v[0]==$_SERVER['HTTP_HOST'] && $v[1]==ses('qb')){
		$del=lj('txtyl','tickets_plug___tickets_tickets*j_'.$k.'_x','x');}else $del='';
	$answ=ljb('popbt','jumpMenu_text','tckansw_'.($v[5]?$v[5]:$k),nms(91));
	$rb[$k].=btn('txtsmall2',$v[3]).' ';
	$rb[$k].=lkc('txtsmall','http://'.$v[0].'/'.$v[1],$v[1]).' ';
	if(!$v[5])$rb[$k].=$answ.' '; $rb[$k].=$del.br(); $msg=$v[2];
	if(!function_exists('correct_txt'))req('pop,spe');
	if($i>=$min && $i<$max)$msg=codeline::parse($msg,'','sconn'); $i++;
	$rb[$k].=divc('" style="width:400px;',nl2br(stripslashes($msg))).br();
	if($v[5]){$rb[$v[5]].=div(ats('margin-left:40px;'),$rb[$k]); unset($rb[$k]);}}
if($rb)rsort($rb);
return by_pages($rb,$page);}

function msqlxml_save($suj,$res){
list($msg,$answ)=explode('_',$res); $site='http://philum.fr';//$srv=philum()
if(!is_numeric($answ))$answ='';
$msg=str_replace(array(' ',"\n","&"),array(':space:',':line:','(and)'),$msg);
$go='host='.$_SERVER['HTTP_HOST'].'&hub='.$_SESSION['qb'].'&msg='.$msg.'&suj='.$suj.'&answ='.$answ.'&admail='.$_SESSION['qbin']['adminmail'];
read_file($site.'/call/microsql/tickets/philum?'.$go);}

function tickets_j($id,$b,$res){req('spe');
msqlxml_save($id,$res); return msqlxread();}

function plug_tickets(){
//$t=msql_read('lang','helps_plugs','tickets');
$ret.=btn('txtcadr',' philum_discussions');
$ret.=msqbt('clients','philum_tickets').br().br();
$ret.=microxform().br();
$ret.=divd('tickets',msqlxread());
return $ret;}

if($_GET['openplug'])echo plug_tickets();

?>