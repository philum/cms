<?php 
class msqlvue{
static $a=__CLASS__;
static $cb='msqv';

static function viewer($p,$i,$n){$bt=''; $p=ajx($p);
if($i>1)$bt=lj('',self::$cb.'_msqlvue,build___'.$p.'_'.($i-1),picto('previous'));
$bt.=lj('',self::$cb.'_msqlvue,build___'.$p.'_'.($i),picto('refresh'));
if($i<$n)$bt.=lj('',self::$cb.'_msqlvue,build___'.$p.'_'.($i+1),picto('next'));
return divb($bt);}

static function build($p,$tmp){
[$nd,$k]=expl('|',$p,2); if(!$k)$k=1; $r=msql::row('',$nd,$k,1); $n=$r?count($r):0;
if(!$tmp){$tmp=''; if($r)foreach($r as $k=>$v)$tmp.='[{'.$k.'}:div]';}
$ret=self::viewer($nd,$k,$n);
if($r)return vue::build($tmp,$r);}

static function call($p,$o,$prm=[]){$p=$prm[0]??$p;
$ret=self::build($p,$o);
return divd(self::$cb,$ret);}

static function menu($p,$o){$bid='inp';
$j=self::$cb.'_'.self::$a.',call_'.$bid.',tmp_2__'.$o;
$ret=inputj($bid,$p,$j).inputj('tmp',$o,$j).lj('',$j,picto('ok'));
return $ret;}

static function home($p,$o){
$bt=self::menu($p,$o);
$ret=self::call($p,$o);
return $bt.divd(self::$cb,$ret);}
}
?>