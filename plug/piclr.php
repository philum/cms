<?php
//philum_plugin_piclr
//function pi_clr(){}

function pi_car($d){
return ;}

function piclr_build($p){
$ra=msql_read('system','edition_colors','',1); //foreach($ra as $k=>$v)$rb[$i]=$v;
$rb=array_keys($ra);
$rand=array(4,12,24,78,14,19,44,21,32,79);
for($i=0;$i<10;$i++)$css.='.clr'.$i.'{background-color:'.$rb[$rand[$i]].';}'."\n";
echo css_code($css);
$pi=msql_read('','public_pi','1',1); $pi=substr($pi,0,$p);
//bcscale(20);
$r=str_split(substr($pi,2));
foreach($r as $k=>$v)$ret.=btn('clr'.$v,$v)." \n";
return $ret;}

function piclr_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=piclr_build($p);
return $ret;}

function piclr_menu($p,$o,$rid){$ret=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_piclr_piclr*j___inp',picto('reload')).' ';
return $ret;}

//plugin('piclr',$p,$o)
function plug_piclr($p,$o){$rid='plg'.randid(); $p=$p?$p:100;
$bt=piclr_menu($p,$o,$rid); $ret=piclr_j($p,$o);
//$bt.=msqlink('',ses('qb').'_piclr');
return $bt.divd($rid,$ret);}

?>