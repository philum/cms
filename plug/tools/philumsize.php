<?php 
class philumsize{

static function home($p='',$o=''){
$dr=($p?$p:'progb'); $nm=date('ym'); $ret=[];
//$nm='1904'; echo $dr='_old/1905'; 
//$r=explore($dr,'files',1);
$r=scandir_r($dr); //p($r);
if($r)foreach($r as $k=>$v)if($v!='_trash.php'){
	$f=$v; //$f=$dr.'/'.$v; 
	$v=read_file($f);
	$ret['nbf'][$k]=substr_count($v,'function ');
	$ret['siz'][$k]=filesize($f);}
if($ret['nbf'])$nbf=array_sum($ret['nbf']); 
if($ret['siz'])$siz=round(array_sum($ret['siz'])/1024,2);
//$exs=msql::val('system','program_sizes',$nm); if(!$exs)//eco($exs);
msql::modif('system','program_sizes',[round($siz),$nbf],$nm);
$ret=' '.$nbf.' functions / '.$siz.' Ko';
return $ret;}
}
?>