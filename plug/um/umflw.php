<?php //umflw
class umflw{
static $pr='followers';

static function build($p,$o){
[$a,$b]=expl('|',$o); $n=1; $nd=ses('qb').'_'.self::$pr;
$rb=msql::read('',$nd.'_'.$a,'','1'); //pr($ra);
$ra=msql::read('',$nd.'_'.$b,'','1');
if(!$ra or !$rb)return;
$rka=array_keys_r($ra,$n);
$rkb=array_keys_r($rb,$n);
if($rka && $rkb){$r1=array_diff($rka,$rkb); $r2=array_diff($rkb,$rka); $r3=array_intersect($rka,$rkb);}
//eco($r1); eco($r2);
$r1v=[]; $r2v=[];
foreach($r1 as $k=>$v)$r1v[]=$ra[$k];
foreach($r2 as $k=>$v)$r2v[]=$rb[$k];
//eco($r1v); eco($r2v);
return tabler($r1v,['added: '.count($r1)]).tabler($r2v,['removed: '.count($r2)]);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::menu($p,$o);
$ret.=self::build($p,$o);
return $ret;}

static function scan($d){$rb=[]; $n=strlen($d)+1;
$r=msql::choose('',ses('qb'),self::$pr); //pr($r);
foreach($r as $k=>$v)if(substr($v,0,$n)==$d.'-')$rb[]=$v; //pr($rb);
sort($rb);
return $rb;}

static function menu($p,$o,$rid=''){$rt=[]; $rid='ub';
$ret=lj('txtx',$rid.'_umflw,call__2_OAY','/OAY').' ';
$ret.=lj('txtx',$rid.'_umflw,call__2_312-oay','/312-oay').' ';
[$a,$b]=expl('|',$o);
$r=self::scan($p);//pr($r);
foreach($r as $k=>$v){
	$rt[1][]=lj(active($v,$a),$rid.'_umflw,call__2_'.$p.'_'.ajx($v).'|'.ajx($b),$v).' ';
	$rt[2][]=lj(active($v,$b),$rid.'_umflw,call__2_'.$p.'_'.ajx($a).'|'.ajx($v),$v).' ';}
return divb($ret).divc('nbp',impl($rt[1])).divc('nbp',impl($rt[2]));}

static function home($p,$o){
$rid='ub'; $p=$p?$p:'OAY';
$ret=self::call($p,'|');
return divd($rid,$ret);}
}
?>