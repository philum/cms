<?php //app

class detectable{
static $a=__CLASS__;
static $default='http://logic.ovh/2221';

static function build($p,$o){$bt='';
$d=get_file($p); $dom=dom($d);
$r=$dom->getElementsByTagName('table'); $n=count($r);
for($i=0;$i<$n;$i++)$bt.=lj(active($i,$o),'dtct_detectable,call___'.ajx($p).'_'.$i,picto('p'.$i));
$rt=self::detect_table($r[$o]);
$ret=tabler($rt);
return divc('nbp',$bt).$ret;}

static function getxt($el,$ret=''){$attr=''; $at='class';
if(!isset($el->tagName))return $ret.$el->textContent;
$el=$el->firstChild;
if($el!=null)$ret=self::getxt($el,$ret);
while($el->nextSibling!=null){$ret=self::getxt($el->nextSibling,$ret); $el=$el->nextSibling;}
return $ret;}

static function detect_table($dom){$rt=[];
$r=$dom->getElementsByTagName('tr');
foreach($r as $k=>$v){$rt[$k]=[];
	//if($v->childNodes)foreach($v->childNodes as $kb=>$el){}
	$rb=$v->getElementsByTagName('th'); if(!$rb['length'])$rb=$v->getElementsByTagName('td');
	if($rb)foreach($rb as $kb=>$el)$rt[$k][$kb]=conv::call(self::getxt($el));}
return $rt;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return divd('dtct',$ret);}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_detectable,call_'.$inpid.'_3_'.$p.'_'.$o;
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