<?php //table2img

function plug_table2img($d,$p){
[$dr,$nod]=split_right('/',$p,'');
$r=msql_read($dr,$nod,'',1);
if($r)foreach($r as $k=>$v){
	$rb[$k]=array(image($d.$v,'',''),$v);
	$ret.='<a title="'.$k.'::'.$v.'">'.image($d.$v,'','').$k.'::'.$v.'</a>';}
//$ret=tabler($rb);
return $ret;}

?>