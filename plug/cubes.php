<?php
//philum_plugin_cubes

function cub_clr($r){
foreach($r as $k=>$v){$clr='';
	for($i=0;$i<6;$i++){$clr.=rand(0,9);}
	$ret[$k]=$clr;}
return $ret;}

function cub_sz($l,$c){
	return 'float:left; border:0; background-color:#'.$c.'; color:#'.invert_color($c,1).'; width:'.$l.'px; height:'.$l.'px; overflow:true;';}

//$ret.=lj('txtbox','cbk_plug__xd_'.$here.'_cubes*j_1_2_tit|txt','save').br();
function plug_cubes($d){req('pop'); $w=currentwidth();
$r=$_SESSION['rqt']; $cols=4; $c=$cols*3; $n=count($r); $nl=ceil($n/$c);
$l=$w/$c; $cats=array_keys_r($r,1,'k'); $clr=cub_clr($cats);
foreach($r as $k=>$v){if($v[11]>1 && $v[3]){$lx=$l*($v[11]-1);
	//$pub=minimg($v[3],"h").lka(htac($k),$v[2]);
	//$pub=make_thumb_d($v[3],round($lx).'/'.round($lx));//
	$pub=image('/imgc/'.$v[3],round($lx),round($lx));
	$pub=lka(htac($k).'" title="'.$v[2],$pub);
	$ret.=divs(cub_sz($lx,$clr[$v[1]]),$pub);
	}}
	//for($ic=0;$ic<$c;$ic++){}
//for($ib=0;$ib<$nl;$ib++){$i++;}
return $ret;}

?>