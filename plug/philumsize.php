<?php
//philum_plugin_philumsize

function plug_philumsize($p='',$o=''){
$dr=($p?$p:'progb');//_old/
$r=explore($dr,'files',1); $nm=date('ym');
if($r)foreach($r as $k=>$v)if($v!='_trash.php'){
	$f=$dr.'/'.$v; $v=read_file($f);
	$ret[nbf][$k]=substr_count($v,'function ');
	$ret[siz][$k]=filesize($f);}
if($ret[nbf])$nbf=array_sum($ret[nbf]); 
if($ret[siz])$siz=round(array_sum($ret[siz])/1024,2);
//$exs=msql_read('system','program_sizes',$nm); if(!$exs)//eco($exs);
modif_vars('system','program_sizes',array(round($siz),$nbf),$nm);
$ret=' '.$nbf.' functions / '.$siz.' Ko';
return $ret;}

?>