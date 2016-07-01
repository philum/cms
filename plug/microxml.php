<?php
//philum_plugin_microsql_dial 
if($_GET['table'])require_once('../prog/lib.php');

function parse_msg_xml($msg){
$ar1=array("&","<",">");//'"',
$ar2=array('&amp;',"&lt;","&gt;");//"'",
$ret=str_replace($ar1,$ar2,$msg);
//if($_GET["flash"])$ret=utf8_encode($ret);
return $ret;}

function flux_xml($main){$lst=$_GET['last'];
foreach($main as $k=>$v){if($k>$lst or !$lst){$i++;
	$xml=balc('key','',htmlentities($k));
	if(is_array($v)){
	foreach($v as $ka=>$va){$xml.=balc(''.$ka,'',parse_msg_xml($va));}}//val
	else $xml.=balc('0','',htmlentities($v));//val
	$ret.=balc('item','',$xml)."\n";}}
return str_replace(htmlentities("&nbsp;")," ",$ret);}

function server(){
list($dr,$nod)=split_right('/',$_GET['table'],1);
$main=msql_read($dr,$nod,''); //p($main);
if($main)$dscrp=flux_xml($main); $host=$_SERVER['HTTP_HOST'];
//$dscrp=str_replace('users/','http://'.$host.'/users/',$dscrp);
//$dscrp=str_replace('img/','http://'.$host.'/img/',$dscrp);
$xml='<'.'?xml version="1.0" encoding="utf-8" ?'.'>'."\n";//iso-8859-1//
$xml.='<rss version="2.0">'."\n"; 
$xml.='<channel>'."\n"; 
$xml.='<title>http://'.$host.'/msql/'.$_GET['table'].'</title>'."\n";
$xml.='<link>http://'.$host.'/</link>'."\n"; 
$xml.='<description>'.count($main).' entries</description>'."\n"; 
$xml.=$dscrp;
$xml.='</channel>'."\n";
$xml.='</rss>'."\n"; 
//$xml.='</xml>'."\n"; 
if($_GET['bz2'])return bzcompress($xml);
if($_GET["b64"])return base64_encode($xml);
return utf8_encode($xml);}

//msql/users/philum_cache
function clkt($d,$lst=''){
$http='http://'; if(substr($d,0,7)!=$http)$d=$http.$d;
$pos=strpos($d,'msql/');
if($pos!==false){$site=substr($d,0,$pos); $nod=substr($d,$pos+5);
	$call=$site.'plug/microxml.php?table='.$nod.'&last='.$lst;}
$keys=array('key'); for($i=0;$i<20;$i++){$keys[]=''.$i;}//val
$rss=read_rss($call,"item",$keys); //p($rss); 
foreach($rss as $k=>$v){$key=$v[0]; array_shift($v);
	if($key=='_menus_')$keys=$v;
	foreach($v as $ka=>$va){if($va)$n[$k]++;}
	if($key)$re[$key]=$v;}
if($n){$max=max($n);
foreach($re as $k=>$v){for($i=0;$i<$max;$i++){$ret[$k][$i]=($v[$i]);}}//$keys[$i]
return $ret;}}

//if($_GET['table']=='server/shared_files'){require_once('../progb/finder.php'); distrib_share();}
if($_GET['table'])echo server();
if($_GET['call'])echo clkt($_GET['call']);

?>