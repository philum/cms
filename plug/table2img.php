<?php
//philum_table2img

function plug_table2img($d,$p){
list($dr,$nod)=split_right('/',$p,'');
$r=msql_read($dr,$nod,''); unset($r['_menus_']); //p($r);
if($r)foreach($r as $k=>$v){
	$rb[$k]=array(image($d.$v,'',''),$v);
	$ret.='<a title="'.$k.'::'.$v.'">'.image($d.$v,'','').$k.'::'.$v.'</a>';}
//$ret=make_tables('',$rb,$csa,$csb);
return $ret;}

?>