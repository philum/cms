<?php //microsql_dial 
if(isset($_GET['table']))require_once('../prog/lib.php');

function parse_msg_xml($msg){
$ar1=["&","<",">"];//'"',
$ar2=['&amp;',"&lt;","&gt;"];//"'",
$ret=str_replace($ar1,$ar2,$msg);
//if($_GET["flash"])$ret=utf8_encode($ret);
return $ret;}

function flux_xml($main){$lst=$_GET['last']; $ret=''; $i=0;
foreach($main as $k=>$v){if($k>$lst or !$lst){$i++;
	$xml=balc('key','',htmlentities($k));
	if(is_array($v)){
	foreach($v as $ka=>$va){$xml.=balc(''.$ka,'',parse_msg_xml($va));}}//val
	else $xml.=balc('0','',htmlentities($v));//val
	$ret.=balc('item','',$xml)."\n";}}
return str_replace(htmlentities("&nbsp;")," ",$ret);}

function mx_stream($nod){//echo is_dir('plug')?'is':'isnot';
[$dr,$nod]=split_right('/',$nod,1);
$main=msql_read($dr,$nod,''); //p($main);//echo $dr.'-'.$nod;
if($main)$dscrp=flux_xml($main); $host=$_SERVER['HTTP_HOST'];
//$dscrp=str_replace('users/','http://'.$host.'/users/',$dscrp);
//$dscrp=str_replace('img/','http://'.$host.'/img/',$dscrp);
$xml='<'.'?xml version="1.0" encoding="utf-8" ?'.'>'."\n";//iso-8859-1//
$xml.='<rss version="2.0">'."\n"; 
$xml.='<channel>'."\n"; 
$xml.='<title>http://'.$host.'/msql/'.$nod.'</title>'."\n";
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
function mx_call($d,$lst=''){
$http='http://'; if(substr($d,0,7)!=$http)$d=$http.$d;
$pos=strpos($d,'msql/'); $re=[]; $ret=[]; $call='';
if($pos!==false){$site=substr($d,0,$pos); $nod=substr($d,$pos+5);
	$call=$site.'plug/microxml.php?table='.$nod.'&last='.$lst;
	//echo $call=$site.'call/microxml/server/'.$nod;
	}
$keys=['key']; for($i=0;$i<20;$i++){$keys[]=''.$i;}//val
$rss=rssin::read_old($call,'item',$keys);//p($rss);
foreach($rss as $k=>$v){$key=$v[0]; array_shift($v);
	if($key=='_menus_')$keys=$v; $n[$k]=0;
	foreach($v as $ka=>$va){if($va)$n[$k]++;}
	if($key)$re[$key]=$v;}
if($n){$max=max($n);
foreach($re as $k=>$v)for($i=0;$i<$max;$i++){
	if(ses('enc')=='utf-8')$ret[$k][$i]=utf8_encode_b(val($v,$i));//iso2ascii
	else $ret[$k][$i]=(val($v,$i));}//$keys[$i]
return $ret;}}

function microxml_build($p,$o){
return mx_call($p,$o);}

function plug_microxml($p,$o){
return mx_stream($p,$o);}

//if($_GET['table']=='server/shared_files'){require_once('../progb/finder.php'); distrib_share();}
if(isset($_GET['table']))echo mx_stream($_GET['table']);
if(isset($_GET['call']))echo mx_call($_GET['call']);

?>