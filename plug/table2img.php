<?php
//philum_table2img
session_start();
if(!function_exists('p'))require('../progb/lib.php');//always_progb

function plug_table2img($d,$p){
list($dr,$nod)=split_right('/',$p,'');
$r=msql_read($dr,$nod,''); unset($r['_menus_']); //p($r);
if($r)foreach($r as $k=>$v){
	$rb[$k]=array(image($d.$v,'',''),$v);
	$ret.='<a title="'.$k.'::'.$v.'">'.image($d.$v,'','').$k.'::'.$v.'</a>';}
//$ret=make_tables('',$rb,$csa,$csb);
return $ret;}

//echo plug_table2img('../imgb/system/actions32/','system/edition_icons');

?>