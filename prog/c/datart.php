<?php 
class datart{
static $a='datart';
static $cb='dta';
static $r=[];
static $rn=[];
static $rta=[];
static $rtb=[];

//taxonav::ibofid_r
static function addparents($id){$ib=ma::ib_of_id($id);
if($ib){
	if(isset(self::$r[$ib][$id]))self::$rn[$ib][]=1;
	else{self::$r[$ib][$id]=1; self::search_r($ib);}}}

static function addchilds($id){$r=ma::id_of_ib($id);
if($r)foreach($r as $k=>$v){
	if(isset(self::$r[$id][$k]))self::$rn[$k][]=1;
	else{self::$r[$id][$k]=1; self::search_r($k); }}}

static function addrelated($id){$r=ma::related_arts($id);
if($r)foreach($r as $k=>$v){
	if(isset(self::$r[$id][$v]))self::$rn[$v][]=1;
	else{self::$r[$id][$v]=2; self::search_r($v);}}}

static function sav($p){$rta=self::$rta; $rtb=self::$rtb;
$noda=nod('datart_'.$p); $nodb=nod('datartb_'.$p);
$rha=['Id','Label','timeset','modularity_class'];//[$idb,$va[1],'0',$tag]
msql::save('',$noda,$rta,$rha);
$rhb=['Source','Target','Type','Id','Label','timeset','Weight'];//[$ida,$idb,'Undirected','','',0,$n*10]
msql::save('',$nodb,$rtb,$rhb);
$ret=msqbt('',$noda).msqbt('',$nodb);
$ret.=lj('txtx','popup_msqlops___'.ajx($noda).'_export*csv__1','nodes');
$ret.=lj('txtx','popup_msqlops___'.ajx($nodb).'_export*csv__1','links');
$ret.=divc('scroll',tabler($rta,$rha));
$ret.=divc('scroll',tabler($rtb,$rhb));
return $ret;}

//id->parent->childs->related
static function search_r($id){
self::$rn[$id][]=1;
self::addparents($id); //pr(self::$r);
self::addchilds($id);
self::addrelated($id);}

static function build($id){
if(!$id)return [];
self::search_r($id); //pr(self::$r);
//$r=self::$r; //self::$r=[];
//foreach($r as $k=>$v)self::search_r($k);
foreach(self::$r as $k=>$v){
	$suj=ma::suj_of_id($k);
	self::$rta[]=[$k,$suj,'0',1];
	foreach($v as $ka=>$va){
		$suj=ma::suj_of_id($ka);
		self::$rta[]=[$ka,$suj,'0',$va];
		$weight=count(self::$rn[$ka]);
		self::$rtb[]=[$k,$ka,'Undirected','','',0,$weight];}}
return self::$r;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;//[$p,$o]=prmp($p,$o,$prm);
$r=self::build($p,$o);
$ret=echor($r);
$ret=self::sav($p);
return $ret;}

static function menu($p,$o){$bid='inp';
$j=self::$cb.'_'.self::$a.',call_'.$bid.'_2__'.$o;
$ret=inputj($bid,$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$bt=self::menu($p,$o);
$ret=self::call($p,$o);
return $bt.divd(self::$cb,$ret);}
}
?>