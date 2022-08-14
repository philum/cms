<?php //pictocss
class pictocss{
static function bt($d){return span(atc('philum ic-'.$d),'').br();}

static function demo($p){
return $p.':'.self::bt($p);}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$ret=self::demo($p,$o);
return $ret;}

static function all(){$ret='';
$r=msql::kv('system','edition_pictos','',1);
foreach($r as $k=>$v)$rb[$k]=hexdec($v); asort($rb);
foreach($rb as $k=>$v)$ret.=span(att($k),picto($k,24)).' ';
return $ret;}

static function build($p,$o){
$f='css/_pictos.css';
$r=msql::kv('system','edition_pictos','',1);
$ret='@font-face {font-family: "philum"; src: url("/fonts/philum.eot?iefix") format("eot"), url("/fonts/philum.woff?v15.'.date('ymdhi').'") format("woff"), url("/fonts/philum.svg#philum") format("svg"), url("/fonts/philum.ttf") format("truetype");}
.philum{font-family:"philum";}'."\n";
foreach($r as $k=>$v){
	$ret.='.ic-'.$k.':before{content:"\\'.$v.'";}'."\n";}
write_file($f,$ret);
return lka('/'.$f);}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_pictocss*call_inp',picto('ok')).' ';
$ret.=lj('',$rid.'_pictocss,all',picto('eye')).' ';
$ret.=lj('',$rid.'_pictocss,build',picto('save')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
Head::add('csslink','/css/_pictos.css');
$bt=self::menu($p,$o,$rid);
$bt.=msqbt('system','edition_pictos');
//$ret.=self::build($p,$o);
return $bt.divd($rid,'');}
}
?>