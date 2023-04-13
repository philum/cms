<?php //jumplk
class jumplk{
static $a=__CLASS__;
static $default='';

//<link rel="canonical" 
static function dom_extract($dom,$va){
[$a,$b,$tg,$g]=opt($va,':',4);//get g where b=a in tag tg
$a=str_replace('(ddot)',':',$a); $ret='';
if($dom)$r=$dom->getElementsByTagName($tg); //pr($r);
if($r->length==0)return 'no result';
if($r)foreach($r as $k=>$v){$attr=domattr($v,$b);//$v->getAttribute($b)//$v->nodeValue
	if($attr==$a)$ret=$v->getAttribute($g);}
return utf8dec_b($ret);}

static function build($p,$o=''){$u=domain(trim($p)); //echo $u;
$d=get_file($p); $r=dom($d); $ret=''; //$ret=eco($d,1); //pr($r);
//if($u=='t.co'){$r=get_meta_tags($p); $ret=$r['twitter:url']; pr($r);}
if($u=='t.co')$ret=self::dom_extract($r,'refresh:http-equiv:meta:content');
if(strpos($ret,'0;URL=')!==false)$ret=substr($ret,6);
if($u=='buff.ly')$ret=self::dom_extract($r,'canonical:rel:link:href');
if($u=='sco.lt')$ret=self::dom_extract($r,'mainEntityOfPage:itemprop:meta:content');
$pb=domain($ret); if($pb!=$u && ($pb=='buff.ly' or $pb=='sco.lt'))$ret=self::build($ret,'');
return $ret?$ret:$p;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_jumplk,call_'.$inpid;
$ret=inputj($inpid,$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}
?>