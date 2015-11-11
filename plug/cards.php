<?php
//philum_plugin_model 
session_start();
if($_GET['cards']){
require_once('../prog/lib.php');
require_once('../prog/spe.php');
require_once('../prog/pop.php');
require_once('../prog/tri.php');
require_once('../params/_connectx.php');}

function plug_cards(){connect(); req('pop');
$data=rse("msg",$_SESSION['qdm'].' WHERE id="'.$_GET['cards'].'"');
$data=str_replace('[cards:plug]','',$data);
$obj=format_txt($data,3,$_SESSION['read']); $obj=nl2br($obj); 
$size=msql_read('system','edition_cards',''); //p($size);
$styl='" style="float:left; width:'.$size['card_width'].'px; height:'.$size['card_height'].'px; margin:'.$size['card_margin'].'px; border:'.$size['card_border'].';';
for($i=0;$i<10;$i++){$ret.=divc($styl,$obj);}
if($_GET['cards']){
	$rh[]['css']='../css/'.$_SESSION['qb'].'_design_'.$_SESSION['prmd'].'.css';
	echo headers_r('',$rh);
	echo divc('" style="width:'.$size['page_width'].'px; padding:'.$size['page_padding'].'px;',$ret);}
else return lkt('txtx','/plug/cards.php?cards='.$_SESSION['read'],'open');
}

//if($_GET['cards'])plug_cards();

?>