<?php
//philum_plugin_twice

function ra2deg($d){//00h00m
$ad1=substr($d,0,2); $ad2=substr($d,3,2);
return round($ad1/24*360+$ad2/60,4);}
function dec2deg($d){//+00°00'
$ad1=(int) mb_substr($d,0,3); $ad2=mb_substr($d,4,2);
return round($ad1+($ad2/60)/100,4);}

function twice_build($p,$o){
reqp('star'); $a=0.1;
//$ra=plugin('star','dc > -23.432, dc < -21.82, ra > 255.25, ra < 270.83, dist < 100'); pr($ra);
$r=msql::row('','ummo_exo_twice',$p);
if($r)foreach($r as $k=>$v){$res=''; $n='';
	$dc=ra2deg($v[1]);
	$req='ra > '.($dc-$a).', ra < '.($dc+$a).', dc > '.($v[2]-$a).', dc < '.($v[2]+$a).'';//, dist < 100
	$rc=star::build($req);
	if($rc){$rd=array_keys_r($rc,1); array_shift($rd); if($rd)$res=implode(',',$rd); $n=count($rd);}
	$rb[]=[$v[0],$dc,$v[2],$n,$res];
}

return tabler($rb);}

function twice_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=twice_build($p,$o);
return $ret;}

function twice_r(){
return array('aa'=>'a','bb'=>'b');}

function twice_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','twice/twice_r','','2');
//$ret.=togbub('plug','twice_twice*r',btn('popbt','select...'));
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_twice_twice*j___inp',picto('ok')).' ';
//$ret.=lj('','popup_plupin___msqedit_twice*1_id,val',picto('edit')).' ';
return $ret;}

function plug_twice($p,$o){$rid=randid('plg');
//$bt=twice_menu($p,$o,$rid);
$ret=twice_build($p,$o);
//$bt.=msqbt('',nod('twice'));
return $bt.divd($rid,$ret);}

?>