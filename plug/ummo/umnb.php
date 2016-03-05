<?php
//philum_plugin_umnb

/*$r=array(
0=>'OU-O',
1=>'I·AS',
2=>'I·EN',
3=>'I·EDOO',
4=>'I·ES',
5=>'I·EGO',
6=>'O·AEE',
7=>'O·ANA',
8=>'O·ANMA',
9=>'O·ADA',
10=>'O·AS',
11=>'O·ADEN',
12=>'DOU·IO',
13=>'DI·AS',
14=>'DI·EN',
24=>'KOU-IO',
25=>'KI-AS');*/

function umnb_pic($d){return image('/users/ummo/nb/'.$d.'.png');}

function umnb_j($p,$o='',$res=''){list($p,$o)=ajxp($res,$p,$o);
//base 12
$n=base_convert($p,10,12);
//nominations base 6
$r_c=array(0=>'OU',1=>'I',2=>'I',3=>'I',4=>'I',5=>'I',6=>'O',7=>'O',8=>'O',9=>'O','a'=>'O','b'=>'O');
//chiffres
$r_u=array(0=>'O',1=>'AS',2=>'EN',3=>'EDOO',4=>'ES',5=>'EGO',6=>'AEE',7=>'ANA',8=>'ANMA',9=>'ADA','a'=>'AS','b'=>'ADEN');
//décimales
$r_d=array(0=>'',1=>'D',2=>'K',3=>'?',4=>'?',5=>'?');

$r=str_split($n); //p($r);
$nb=count($r);//nb de chiffres
$ra=array($r_c,$r_u,$r_d);

//theory
//le zéro de chaque décimale base 12 est préfixé d'un incrément de demi-décimale $r_c: I, O
$decimale12=floor($p/12);
if($decimale12==$p/12)$indicatif_zero=$r_c[$decimale12];

//foreach($r as $k=>$v)$ren.=$umnb_pic($r[$i]).' ';
for($i=$nb-1;$i>=0;$i--)$ren.=umnb_pic($r[$i]).$r[$i].br();
if($nb==1)$res=$r_c[$r[0]].'-'.$r_u[$r[0]];
if($nb==2)$res=$r_d[$r[0]].''.$r_c[$r[1]].'-'.$indicatif_zero.$r_u[$r[1]];

$ret=lka('/plug/umnb/'.$p,picto('link')).' ';
$ret.=lj('',$o.'_plug__2_umnb_umnb*j_'.($p-1).'_'.$o,picto('previous')).' ';
$ret.=lj('',$o.'_plug__2_umnb_umnb*j_'.($p+1).'_'.$o,picto('next')).' ';
$ret.=bal('b',$p).' ('.bal('b',$n).' en base 12, décimale '.$decimale12.'): ';
$ret.=bal('h3',$res);
$ret.=$ren;
return $ret;}

//
function plug_umnb($p,$o){$rid='plg'.randid();
$j=$rid.'_plug__2_umnb_umnb*j__'.$rid.'_inp';
$ret.=input(1,'inp',$p,'').' ';
$ret.=lj('',$j,picto('reload')).' ';
//$ret.=lka('/plug/umnb/'.($p-1),picto('previous')).' ';
//$ret.=lka('/plug/umnb/'.($p+1),picto('next')).' ';
return $ret.divd($rid,umnb_j($p,$rid));}

?>