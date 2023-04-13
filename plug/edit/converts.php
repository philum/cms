<?php //converts

class converts{

static function setlocalvar($local,$defaut){
if($_GET[$local]!=''){$ret=$_GET[$local]; $_SESSION[$local]=$ret;}
elseif(!isset($_SESSION[$local])){$ret=$defaut; $_SESSION[$local]=$ret;}
else{$ret=$_SESSION[$local];}
return $ret;}

static function bin2ascii($d){$ret='';
$d=str_replace("\n",'',$d); $d=str_replace(' ','',$d);
$n=strlen($d); $nb=ceil($n/8);
for($i=0;$i<$nb;$i++)$r[]=substr($d,$i*8,8);
if($r)foreach($r as $v)$ret.=chr(bindec($v));
return $ret;}

static function ascii2bin($d){$ret=''; $r=str_split($d);
foreach($r as $v)$ret.=str_pad(decbin(ord($v)),8,'0',STR_PAD_LEFT).' ';
return $ret;}

static function ascii_encode($d){$ret='';
$d=str_replace(['&','#',';'],'',$d); $r=explode(' ',$d);
foreach($r as $k=>$v){$rb[]='&#'.trim($v).';';
	//$rb[]='%u'.utf8enc(self::unicode(dechex($v)));
	//$rb[]=mb_convert_encoding('&#'.$v.';','UTF-8','HTML-ENTITIES');}
}
return implode(' ',$rb);}

static function ascii_decode($d){$ret='';
//return $ret=mb_convert_encoding($txt,'ASCII')."\r";
$d=str_replace(['&','#'],'',$d); $r=explode(';',$d);
foreach($r as $k=>$v)$rb[]=trim($v); $rb=array_flip(array_flip($rb)); sort($rb);
return implode(' ',$rb);}

static function clean_code($d){
$d=str_replace("\r","\n",$d);
$d=preg_replace("/(\n){2,}/","\n",$d);
$ara=array("  ",'( ',' (',' )',') ',' .','. ',' > ',' < ',' =','= '," \n","\n ","{\n","\n{","\n}",', ',' {',' }','{ ','} ','if (','else (','// ',"\nbreak;",":\n",'=> ',' =>');
$arb=array("\t",'(','(',')',')','.','.','>','<','=','=',"\n","\n",'{','{','}',',','{','}','{','}','if(','else(','//',' break;',':','=>','=>');//}}
$d=preg_replace('/( ){2,}/',' ',$d);
return str_replace($ara,$arb,$d);}

static function act($txt,$d,$enc){$ret='';
if($d=='html2conn'){$ret=conv::call($txt);}
elseif($d=='conn2html'){$ret=conn::read($txt);}
elseif($d=='utf8')$ret=$enc?utf8enc(utf8enc($txt)):utf8dec_b($txt);//
elseif($d=='base64')$ret=$enc?base64_encode($txt):base64_decode($txt);
elseif($d=='htmlentities')$ret=$enc?htmlentities($txt,ENT_QUOTES,'ISO-8859-15',false):html_entity_decode($txt);
elseif($d=='url')$ret=$enc?urlencode($txt):urldecode($txt);
elseif($d=='ajx')$ret=ajx($txt,$enc?0:1);
elseif($d=='unescape')$ret=$enc?$ret:str::decode_unicode($txt,"");
elseif($d=='ascii'){if($enc)$ret=self::ascii_encode($txt); else $ret=self::ascii_decode($txt);}
elseif($d=='binary')$ret=$enc?self::ascii2bin($txt):self::bin2ascii($txt);
elseif($d=='bin/dec')$ret=$enc?decbin($txt):bindec($txt);
elseif($d=='timestamp')$ret=$enc?strtotime($txt):date('d/m/Y H:i:s',$txt);
elseif($d=='php')$ret=self::clean_code($txt);
elseif($d=='hexdec')$ret=hexdec($txt);
elseif($d=='dechex')$ret=dechex($txt);
elseif($d=='deg2rad')$ret=deg2rad($txt);
elseif($d=='rad2deg')$ret=rad2deg($txt);
elseif($d=='sin')$ret=sin(deg2rad($txt));
elseif($d=='cos')$ret=cos(deg2rad($txt));
elseif($d=='tan')$ret=tan(deg2rad($txt));
elseif($d=='asin')$ret=rad2deg(asin($txt));
elseif($d=='acos')$ret=rad2deg(acos($txt));
elseif($d=='atan')$ret=rad2deg(atan($txt));
elseif($d=='indent')$ret=indent::build($txt);
elseif($d=='md')$ret=codeline::parse($txt,'','md');
elseif($d=='meta'){[$ti,$tx]=web::metas($txt); $ret='ti:'.$ti.n().'tx:'.$tx;}
elseif($d=='counts'){$r=explode(' ',$txt); $ret=strlen($txt).' chars, '.count($r).' words';}
elseif(in_array($d,['pc2al','pc2km','al2km','al2pc','deg2ra','ra2deg','deg2dec','dec2deg','mas2al','al2mas'])){
	$m=new maths(20); $ret=$m::$d($txt);}
elseif($d=='twostars'){$m=new maths(20); $r=explode(',',$txt); $ret=$m::stars_distance($r[0],$r[1]??'');}
elseif(function_exists($d))$ret=$d($txt);
return stripslashes($ret);}

static function call($p,$o,$prm=[]){$d=$prm[0]??'';
return self::act($d,$p,$o);}

static function menu($p,$o,$rid){$ria=$rid.'a';
$ret=lj('','popup_converts,home','(+)'); $j=$rid.'_converts,call_'.$ria.'_4_';
$r=['utf8','htmlentities','url','ajx','unescape','base64','ascii','binary','bin/dec','timestamp'];
	$ret.=lj('txtx',$j.'html2conn','html2conn').' ';
	$ret.=lj('txtx',$j.'conn2html','conn2html').' ';
foreach($r as $v){
	$ret.=lj('txtx',$j.''.$v.'_1',$v.'_encode').' ';
	$ret.=lj('txtx',$j.''.$v.'',$v.'_decode').' ';}
$r=['php','hexdec','dechex','deg2rad','rad2deg','sin','cos','tan','asin','acos','atan','pc2al','pc2km','al2km','al2pc','deg2ra','ra2deg','deg2dec','dec2deg','mas2al','al2mas','twostars','indent','md','meta'];
foreach($r as $v)$ret.=lj('txtx',$j.''.$v.'_1',$v).' ';
	$ret.=lj('txtx',$j.'counts_1','counts').' ';
	$ret.=ljb('txtx','transhtml',[$rid,$ria],'&uarr;').' ';
$ret.=br().textarea($ria,$p,51,8,['class'=>'console']);
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.textarea($rid,$ret,51,8,['class'=>'console']);}
}
?>