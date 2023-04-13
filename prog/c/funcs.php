<?php 
class funcs{
static $a=__CLASS__;
static $cb='fnc';
static $dr='progb';
static $r=[];
static $rf=[];

static function occurrences($r,$dr){$rt=[];
$a=strpos($dr,'/')?between($dr,'/','.').'::':'';
foreach($r as $k=>$v){//0=>func
	foreach(self::$r as $ka=>$va){$n=0;
		if($ka!=$dr)$n=substr_count($va,$a.$v);//not in itself
		if($a)$n+=substr_count($va,'self::'.$v);
		if($n)$rt[strto($dr,'.').'::'.$v][$ka]=$n;}}
return $rt;}

static function analys($d){$r=explode("\n",$d); $rf=[];
foreach($r as $k=>$v){if(strpos($v,'function ')!==false)$rf[]=between($v,'function ','(');}
return $rf;}

static function capture($r,$dr=''){;
foreach($r as $k=>$v){
	if(is_array($v))self::capture($v,$k.'/');
	else{$f=self::$dr.'/'.$dr.$v;
		if(is_file($f)){$d=read_file($f); self::$r[$dr.$v]=$d;
			$a=substr($v,0,-4); $a=strfrom($a,'/');
			self::$rf[$dr.$v]=self::analys($d);}}}}

static function build($p,$o){
$r=explore(self::$dr); //pr($r);
self::capture($r); $rb=[]; $rc=[]; $rd=[]; //pr(self::$rf);
foreach(self::$rf as $k=>$v)$rb[$k]=self::occurrences($v,$k); //pr($rb);
foreach($rb as $k=>$v)foreach($v as $ka=>$va)if($ka==$p)return tabler($va); else{$rd[$ka]=count($va); $rc[$ka]=$k;}
//else return tabler(self::$rf,'',1);
arsort($rd);
$rt=array_merge_recursive($rd,$rc);//pr($rt);
}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o){$bid='inp';
$j=self::$cb.'_'.self::$a.',call_'.$bid.'___'.$o;
$ret=inputj($bid,$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$bt=self::menu($p,$o);
$ret='';//::call($p,$o);
return $bt.divd(self::$cb,$ret);}
}
?>