<?php //links
class links{
static function all(){
$r=msql::read('','public_defcons','',1); $r=array_keys($r); sort($r);
return implode(br(),$r);}

static function home(){$rb=[]; $ret='';
foreach(ses('rqt') as $k=>$v)if(!empty($v[9])){
	$kb=preplink($v[9]); $n=$rb[$kb]??0; 
	$rb[$kb]=$n+1;}
arsort($rb); //p($rb);
foreach($rb as $k=>$v)if($k)$ret.=$k.' ('.$v.')'.br();
$ret.=hr().self::all();
return $ret;}
}
?>