<?php //microsql_dial

class microxml{
static function parse_xml($msg){
$ar1=["&","<",">"];//'"',
$ar2=['&amp;',"&lt;","&gt;"];//"'",
$ret=str_replace($ar1,$ar2,$msg);
return $ret;}

static function protect($d,$o=''){
$r=['/','|']; if($o)$r=array_reverse($r);
return str_replace($r[0],$r[1],$d);}

static function flux_xml($main,$lst){$ret=''; $i=0;
foreach($main as $k=>$v){if($k>$lst or !$lst){$i++;
	$xml=tagb('key',htmlentities($k));
	if(is_array($v)){
	foreach($v as $ka=>$va){$xml.=tagb($ka,self::parse_xml($va));}}//val
	else $xml.=tagb('0',htmlentities($v));//val
	$ret.=tagb('item',$xml)."\n";}}
return str_replace(htmlentities("&nbsp;"),' ',$ret);}

static function stream($nod,$lst){//pr($_GET);
$nod=self::protect($nod,1);
[$dr,$nod]=split_right('/',$nod,1);
$r=msql::read($dr,$nod,'');
$dscrp=$r?self::flux_xml($r,$lst):''; $host=$_SERVER['HTTP_HOST'];
//header('Content-Type: text/xml');
$xml='<'.'?xml version="1.0" encoding="utf-8" ?'.'>'."\n";//iso-8859-1
$xml.='<rss version="2.0">'."\n"; 
$xml.='<channel>'."\n"; 
$xml.='<title>http://'.$host.'/msql/'.$nod.'</title>'."\n";
$xml.='<link>http://'.$host.'/</link>'."\n"; 
$xml.='<description>'.count($r).' entries</description>'."\n"; 
$xml.=$dscrp;
$xml.='</channel>'."\n";
$xml.='</rss>'."\n"; 
//$xml.='</xml>'."\n"; 
if(get('bz2'))return bzcompress($xml);
if(get('b64'))return base64_encode($xml);
return utf8enc($xml);}

//msql/users/philum_cache
static function call($d,$lst=''){
$http='http://'; if(substr($d,0,7)!=$http)$d=$http.$d;
$pos=strpos($d,'msql/'); $re=[]; $ret=[]; $call='';
if($pos!==false){$site=substr($d,0,$pos); $nod=substr($d,$pos+5);
	$call=$site.'call/microxml,stream/'.self::protect($nod).'/'.$lst;//table/last
	//echo $call=$site.'call/microxml,stream/server/'.$nod;
	}
$keys=['key']; for($i=0;$i<20;$i++){$keys[]=''.$i;}//val
$rss=rssin::read_old($call,'item',$keys);//p($rss);
foreach($rss as $k=>$v){$key=$v[0]; array_shift($v);
	if($key=='_menus_')$keys=$v; $n[$k]=0;
	foreach($v as $ka=>$va){if($va)$n[$k]++;}
	if($key)$re[$key]=$v;}
if($n){$max=max($n);
foreach($re as $k=>$v)for($i=0;$i<$max;$i++){
	if(sql::$enc=='utf8')$ret[$k][$i]=utf8enc_b(val($v,$i));//iso2ascii
	else $ret[$k][$i]=(val($v,$i));}//$keys[$i]
return $ret;}}

static function build($p,$o){
return self::call($p,$o);}

static function home($p,$o){
return self::stream($p,$o);}
}

//if(isset($_GET['table']))echo microxml::stream($_GET['table']);
//if(isset($_GET['call']))echo microxml::call($_GET['call']);

?>