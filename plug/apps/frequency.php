<?php
//philum_app_frequency

class frequency{
static $a=__CLASS__;
static $default='';

static function graph($r){$ret='';
$mx=max($r); $w=620; $ratio=$w/$mx; $rb=[];
foreach($r as $k=>$v){$rb[]=[$k,div(ats('width:'.round($v*$ratio).'px; border:1px solid gray; display:inline-block;').atc('bkg'),$v)];}
return tabler($rb);}

static function twits($p,$o){$w=''; $n=10000; $rb=[]; $rc=[];
if($p){$w='where mentions like "%'.$p.'%"'; if($o)$w.=' and date>"'.calc_date($o).'"';}
$r=sqb('id,date','qdtw','kv',$w.' order by twid desc limit '.$n);
if($r)foreach($r as $k=>$v)if($v){$day=date('ymd',$v); $rb[$day][]=1;}
if($rb)foreach($rb as $k=>$v)$rc[$k]=count($v);
return self::graph($rc);}
/*
static function tags($p,$o){$w; $rb=[]; $rc=[];
if($o)$w=' and date>"'.calc_date($o).'"';
$r=sql_inner('tag,count(idart)','qdt','qdtg','idtag','kv','tag="'.$p.'" '.$w);
if($r)foreach($r as $k=>$v)if($v){$day=date('ymd',$v); $rb[$day][]=1;}
if($rb)foreach($rb as $k=>$v)$rc[$k]=count($v);
return self::graph($rc);}*/

static function arts($p,$o){$rb=[]; if(!$o)$o=$p?$p:90;//
$r=sql('id,day','qda','kv','nod="'.ses('qb').'" and day>"'.calc_date($o).'"');
if($r)foreach($r as $k=>$v)if($v){$day=date('ymd',$v); $rb[$day]=isset($rb[$day])?$rb[$day]+1:1;}
if($rb)return self::graph($rb);}

static function build($p,$o){
list($a,$b)=arr($p,',',2); $r=[];
if($b && method_exists($a,$b))$r=$a::$b($p);
elseif(function_exists($a))$r=$p($o);
if($r)return self::graph($rc);}

static function call($p,$o,$res=''){
$q=ajxg($res); $ret='';
if($p=='twits')$ret=self::twits($q,$o);
if($p=='arts')$ret=self::arts($q,$o);
elseif(function_exists($o))$ret=$p($q,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default;
$j=$rid.'_app__3_'.self::$a.'_call_'.$p.'__inp';
$ret=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid(self::$a);
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}

function plug_frequency($p,$o){
return frequency::home($p,$o);}

?>