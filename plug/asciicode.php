<?php
//philum_plugin_asciicode

// _  _  _  _  
//¦ ¦¦  ¦  ¦  ¦ ¦
//¦¯¦¦_ ¦_ ¦  ¦ ¦
//¦ ¦ _¦ _¦¦_ ¦ ¦

function ascoo($a){
$s=array('','_','¦','¯');
$q=array(
'a'=>'111202212202',
'b'=>'111202231212',
'c'=>'111200200211',
'd'=>'110202202213',
'e'=>'111202230211',
'f'=>'111200230200',
'g'=>'111202332111',
'h'=>'111202233202',
'i'=>'100200200200',
'j'=>'001002003110',
'k'=>'',
'l'=>'',
'm'=>'',
'n'=>'',
'o'=>'',
'p'=>'',
'q'=>'',
'r'=>'',
's'=>'',
't'=>'',
'u'=>'',
'v'=>'',
'w'=>'',
'x'=>'',
'y'=>'',
'z'=>'',
'0'=>'',
'1'=>'',
'2'=>'',
'3'=>'',
'4'=>'',
'5'=>'',
'6'=>'',
'7'=>'',
'8'=>'',
'9'=>'',
'-'=>'',
'!'=>'',
'?'=>'',
'.'=>'');
$r=str_split($q[$a]);
for($i=0;$i<12;$i++){$ret.=$s[$r[$i]]; if($i==2 or $i==5)$ret.=br();}
return divc('imgl',$ret);}

function asciicode_j($a,$b,$res){if(!$a)$a=ajxg($res);
$r=str_split($a); $n=count($r); for($i=0;$i<$n;$i++){$ret.=ascoo($r[$i]);}
return $ret;}

function plug_asciicode($p){
$ret=input(1,'tit','').' '.call_plug_f('txtbox','cbk','asciicode','j','__tit','see');
$ret.=divd('cbk',asciicode_j('','',$p)).br();
return $ret;}

?>