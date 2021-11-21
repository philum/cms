<?php
//philum_plugin_sun

function sunstim($d){
for($i=0;$i<12;$i+=2)$r[]=substr($d,$i,2);
return $r;}

//plugin_func('sun','sun_build',$p,$o);
function sun_build($p,$o){$ret=$p.'-'.$o;
if($p)$t=strtotime($p); else $t=time(); $d=date('ymdHis',$t); 
$r=sunstim($d); list($dy,$dm,$dd,$dh,$di,$ds)=$r; //p($r);
$posx=($dh*(100/24)).'%'; if($dm>6)$dm=(12-$dm); $posy=($dm*(90/6)).'%';
$ret=divs('position:absolute; width:20px; height:20px; border-radius:20px; box-shadow:0 0 4px silver; left:'.$posx.'; top:'.$posy.'; background:orange; border:1px solid white;','');
return divs('width:100%; height:auto; background:linear-gradient(to bottom, blue, pink) no-repeat fixed 0 0;',$ret);}//

function sun_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=sun_build($p,$o);
return $ret;}

function sun_menu($p,$o,$rid){$ret=input1('inp',$p?$p:mkday('','ymdHis'),'').' ';
$ret.=lj('',$rid.'_plug__2_sun_sun*j___inp',picto('ok')).' ';
return $ret;}

//plugin('sun',$p,$o)
function plug_sun($p,$o){$rid='plg'.randid();
$bt=sun_menu($p,$o,$rid); $ret=sun_j($p,$o);
//$bt.=msqbt('',ses('qb').'_sun');
return $bt.divd($rid,$ret);}

?>