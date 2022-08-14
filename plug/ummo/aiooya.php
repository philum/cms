<?php //aiooya
function aiooya($x,$ra,$rb){
if($x==array_intersect($ra,$rb))return 'yes'; else return 'no';}

function door_and($a,$b){if($a && $b)return 1; else return 0;}
function door_or($a,$b){if($a or $b)return 1; else return 0;}
function door_nand($a,$b){if(!$a or !$b)return 1; else return 0;}
function door_nor($a,$b){if(!$a && !$b)return 1; else return 0;}
function door_xor($a,$b){if(($a && !$b) or (!$a && $b))return 1; else return 0;}
function door_xnor($a,$b){if((!$a && !$b) or ($a && $b))return 1; else return 0;}

function pattern_intersect($ra,$rb,$door){$n=count($ra);
for($i=0;$i<$n;$i++)if($door($ra[$i],$rb[$i]))return 1;}

function pattern_diff($ra,$rb,$door){$n=count($ra);
for($i=0;$i<$n;$i++)if($door($ra[$i],$rb[$i]))return 0;}

function aiooya_build($p,$o){
//$r=msql_read('',nod('umnum'),$p);
$ra=[1,1,1,1,0,0,1];
$rb=[0,0,0,1,1,1,0];
$ra=['blue','red','green'];
$rb=['blue','black','green'];
//$ret=aiooya(1,$ra,$rb);
//intersection de tableaux
$res1=array_intersect($ra,$rb);//renvoie $ra
//diff�rence entre des tableaux
$res2=array_diff($ra,$rb);//renvoie []
//diff�rence entre le r�sultat et la question
$res=array_diff($ra,$res1);//renoie []
//p($res1);
return tabler($res);}

function aiooya_j($p,$o,$res=''){
[$p,$o]=ajxp($res,$p,$o);
$ret=aiooya_build($p,$o);
return $ret;}

function aiooya_r(){
return ['aa'=>'a','bb'=>'b'];}

function aiooya_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','aiooya/aiooya_r','','2');
//$ret.=togbub('plug','aiooya_aiooya*r',btn('popbt','select...'));
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_aiooya_aiooya*j___inp',picto('ok')).' ';
return $ret;}

function plug_aiooya($p,$o){$rid=randid('plg');
$bt=aiooya_menu($p,$o,$rid);
$ret=aiooya_build($p,$o);
//$bt.=msqbt('',nod('aiooya'));
return $bt.divd($rid,$ret);}

?>