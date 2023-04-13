<?php 
class jsonadm{
static $a=__CLASS__;

static function drnod($u){
if(substr($u,0,1)=='/')$u=substr($u,1); $r=explode('/',$u);
$dr=array_shift($r); $nod=implode('/',$r);
return [$dr,$nod,$u];}

static function create($u,$rid,$prm=[]){$res=$prm[0]??'';
if(substr($u,0,1)=='/')$u=substr($u,1);
$r=explode('/',$u); $root='json'; $vb='';
[$dr,$nod]=self::drnod($u); $nod.='/'.$res;
json::read($dr,$nod,$rid);
return self::nav($u,$rid);}

static function add($u,$rid){
$j=$rid.'_jsonadm,create_add'.$rid.'__'.ajx($u);
$ret=inputj('add'.$rid,'',$j);
return self::nav($u,$rid).$ret;}

static function stats($r){$ret=''; $rb=[]; $na=count($r); $nb=0;
if($r)foreach($r as $k=>$v)if(is_array($v))$nb+=count($v);
return $na.' lines; '.$nb.' entries; ';}

static function player($r){$ret='';
if($r)foreach($r as $k=>$v)
	if(is_array($v))$ret.=li($k).self::player($v);
	else $ret.=li($k.':'.$v);
return ul($ret);}

static function tabler($r){$ret=[];
if($r)foreach($r as $k=>$v)
	if(is_array($v))$ret[$k][]=self::tabler($v);
	else $ret[$k][]=$v;
return tabler($ret);}

static function read($dr,$nod,$rid=''){//chrono();
$r=json::read($dr,$nod);//echo chrono('json'); echo '-'.fsize($b->f,1);
//$q=msql::read($dr,$nod); //echo chrono('msql');
if($r)$bt=self::stats($r); else $bt='';
$bt.=lj('','nav'.$rid.'_json,del___'.$dr.'_'.ajx($nod),picto('del'));
if($r)$r=array_reverse($r);
return $bt.tabler($r);}

static function build($f,$rid){
[$dr,$nod]=split_right('/',$f);
$ret=btn('popw',$dr.','.$nod);
return $ret.self::read($dr,$nod,$rid);}

static function call($p,$rid,$prm=[]){
$f=$prm[0]??'';
$ret=self::build($f,$rid);
return $ret;}

static function nav($u,$rid){$ret='';
[$dr,$nod,$u]=self::drnod($u); $root='json';
$r=scandir_b($root);
if($r)foreach($r as $k=>$v)if($v)//dr
	$ret.=lj('','nav'.$rid.'_jsonadm,nav___'.ajx($v).'_'.$rid,$v);
$ret.='|';
$r=explode('/',$nod); $vb=''; $rb=[]; //echo $nod; //p($r);
if($nod)foreach($r as $k=>$v)if($v){//back
	$rb[]=lj('','nav'.$rid.'_jsonadm,nav___'.ajx($vb).'_'.$rid,$v); $vb.='/'.$v;}
if($rb)$ret.=implode('/',$rb).'|';
if($u)$r=scandir_b($root.'/'.$u); $vb=''; $rb=[]; //p($r);
if($u)foreach($r as $k=>$v){$ub=$root.'/'.$u.'/'.$v; $va=struntil($v,'.');//current
	if(is_file($ub))$ret.=lj('active',$rid.'_jsonadm,build___'.ajx($u.'/'.$va).'_'.$rid,$va).' ';
	else $ret.=lj('','nav'.$rid.'_jsonadm,nav___'.ajx($u.'/'.$v).'_'.$rid,$v).' ';}
$ret.=lj('','nav'.$rid.'_jsonadm,add___'.ajx($u).'_'.$rid,picto('add'));
return $ret;}

static function menu($p,$o,$rid){
$bid='inp'.$rid; $cid='nav'.$rid;
//$j=$rid.'_'.self::$a.',call_'.$bid.'_2__'.$rid;
//$ret.=inputj($bid,$p,$j).lj('',$j,picto('ok')).' ';
$ret=div(atd($cid).atc('nbp'),self::nav('',$rid));
return $ret;}

static function home($p,$o){$rid=randid();
$bt=self::menu($p,$o,$rid); $ret='';
if($p)$ret=self::call($p,$o);
//rmdir_r('json/json');
//unlink('json/sys/eye.json');
return $bt.divd($rid,$ret);}

}
?>