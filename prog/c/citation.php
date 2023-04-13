<?php 

class citation{
static $default='';

static function random(){
$r=[1=>17,2=>35,3=>30,4=>4,5=>8,6=>10,7=>10,9=>7,10=>6,11=>10];
$n=array_sum($r); $nb=rand(1,$n); $ib=0;
foreach($r as $k=>$v)for($i=0;$i<$v;$i++){$ib++; if($ib==$nb)return [$k,$i];}}

static function build($p,$o){
[$na,$nb]=self::random();//$na=rand(1,5); 
$r=msql::read_b('',nod('citation_'.$na));//$nb=array_rand($r); 
if(!$r)return;
$ra=array_shift($r); $t=$ra[0]; $ret=$r[$nb][0];
//$b=lj('','ctt_citation,build___citation*1',picto('reload')).' ';
$bt=lj('','ctt_citation,build',picto('after'));
return divb($ret).divc('small',$t);}

static function call($p,$o,$prm=[]){$p=$prm[0]??$p;
$ret=self::build($p,$o);
return divb($ret,'twit','ctt');}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default;
$j=$rid.'_citation,call_inp';
$ret=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
//$cols='ib,val,to';//create table, name cols
//$ret.=lj('','popup_msqedit,call___citation*1_'.$cols,picto('edit')).' ';
$ret.=msqbt('',nod('citation_1'));
return $ret;}

static function home($p,$o){$rid=randid('citation');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>