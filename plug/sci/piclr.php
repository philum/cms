<?php //piclr
class piclr{
static $conn=1;
static function pi_car($d){return ;}

static function build($p){
$ra=msql::read('system','edition_colors','',1); //foreach($ra as $k=>$v)$rb[$i]=$v;
$rb=array_keys($ra);
$rand=[4,12,24,78,14,19,44,21,32,79];
for($i=0;$i<10;$i++)$css.='.clr'.$i.'{background-color:'.$rb[$rand[$i]].';}'."\n";
echo csscode($css);
$pi=msql::val('','public_pi',1); $pi=substr($pi,0,$p);
//bcscale(20);
$r=str_split(substr($pi,2));
foreach($r as $k=>$v)$ret.=btn('clr'.$v,$v)." \n";
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$ret=self::build($p);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p,'').' ';
$ret.=lj('',$rid.'_piclr,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid(); $p=$p?$p:100;
$bt=self::menu($p,$o,$rid); $ret=self::call($p,$o);
//$bt.=msqbt('',ses('qb').'_piclr');
return $bt.divd($rid,$ret);}
}
?>