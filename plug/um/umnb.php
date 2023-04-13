<?php //umnb
class umnb{
static $r=[0=>'OU-O',1=>'I·AS',2=>'I·EN',3=>'I·EDOO',4=>'I·ES',5=>'I·EGO',6=>'O·AEE',7=>'O·ANA',8=>'O·ANMA',9=>'O·ADA',10=>'O·AS',11=>'O·ADEN',12=>'DOU·IO',13=>'DI·AS',14=>'DI·EN',24=>'KOU-IO',25=>'KI-AS'];
//nominations base 6
static $rc=[0=>'OU',1=>'I',2=>'I',3=>'I',4=>'I',5=>'I',6=>'O',7=>'O',8=>'O',9=>'O','a'=>'O','b'=>'O'];
//chiffres
static $ru=[0=>'O',1=>'AS',2=>'EN',3=>'EDOO',4=>'ES',5=>'EGO',6=>'AEE',7=>'ANA',8=>'ANMA',9=>'ADA','a'=>'AS','b'=>'ADEN'];
//décimales
static $rd=[0=>'',1=>'D',2=>'K',3=>'?',4=>'?',5=>'?'];

static function pic($d){//return oomo($d,48);
return image('/users/ummo/nb/'.$d.'.png');}

static function nav($p,$o){
$j=$o.'_umnb,call_inp'.$o.'___'.$o; $pr=['onchange'=>sj($j),'type'=>'number'];
$ret=inputj('inp'.$o,$p?$p:1,$j,'number',4,$pr).' ';
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function call($p,$o='',$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
//$bt=self::menu($p,$o);
$n=base_convert($p,10,12);//base 12
$rc=self::$ru; $ru=self::$rc; $rd=self::$rd;
$r=str_split($n); //p($r);
$nb=count($r);//nb de chiffres
$ra=[$rc,$ru,$rd];
//theory: le zéro de chaque décimale base 12 est préfixé d'un incrément de demi-décimale $rc: I, O
if(!$p)$p=0;
$decimale12=floor($p/12);
if($decimale12==$p/12)$indicatif_zero=$rc[$decimale12];
else $indicatif_zero='';
if($nb==1)$res=$rc[$r[0]].'-'.$ru[$r[0]];
if($nb==2)$res=$rd[$r[0]].''.$rc[$r[1]].'-'.$indicatif_zero.$ru[$r[1]];
$ren=''; foreach($r as $k=>$v)$ren.=self::pic($v).' ';
//for($i=$nb-1;$i>=0;$i--)$ren.=self::pic($r[$i]).$r[$i].br();
$ret=lj('',$o.'_umnb,call___'.($p-1).'_'.$o,picto('previous')).' ';
$ret.=lj('',$o.'_umnb,call___'.($p+1).'_'.$o,picto('next')).' ';
$ret.=tagb('b',$p).' ('.tagb('b',$n).' en base 12, décimale '.$decimale12.'): ';
$ret.=tagb('h3',$res);
$ret.=$ren;
return $ret;}

static function menu($p,$o){
$j=$o.'_umnb,call_inp'.$o.'___'.$o; $pr=['onchange'=>sj($j),'type'=>'number'];
$ret=inputj('inp'.$o,$p?$p:1,$j,'number',4,$pr).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lka('/app/umnb/'.$p,picto('link')).' ';
return $ret;}

static function home($p,$o){
$o='plg'.randid();
$bt=self::menu($p,$o);
//$ret.=lka('/app/umnb/'.($p-1),picto('previous')).' ';
//$ret.=lka('/app/umnb/'.($p+1),picto('next')).' ';
return $bt.divd($o,self::call($p,$o));}
}
?>