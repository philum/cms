<?php
//philum_plugin_
session_start();
error_reporting(6135);

function kmini($f,$w,$h){
$thumb=thumb_name(strrchr_b($f,'/'),$wb,$hb);
if(!is_file($thumb))make_mini($f,$thumb,$w,$h,0);//1
return '<img src="'.$thumb.'">';}

function photok_batch($r,$dr,$ha,$wa,$hab='',$wab=''){
foreach($r as $k=>$v){$f=$dr.'/'.$v;
	list($w,$h)=getimagesize($f);
	if($w>$h){$wb=$wa; $hb=$ha;} else{$wb=$ha; $hb=$wa;}
	//else{$wb=$wab; $hb=$hab;} //echo $w.'/'.$h.' '; echo br();
	$img=kmini($f,$wb,$hb);
	$rb[]=ljb("","SaveBf",'photo_'.str_replace("_","*",$f).'_'.($w).'_'.($h),$img); 
	$rc[]=$wb;}
return $rb;}

function plug_photok($p,$o){//echo $p;
$dr='users/'.$p; //echo $_SESSION['prmb'][27];
list($wa,$ha)=split('/',$_SESSION['prmb'][27]); $wab=$ha*2; $hab=$wab*($ha/$wa);
$r=explore($dr,'files',0); //p($r);
$rb=photok_batch($r,$dr,$ha,$wa,$hab,$wab);
/*foreach($rb as $k=>$v){
if($rc[$k]==$wa){$rd.='<img src="'.$v.'">';
if($rc[$k]==$wab)$rd.='<img src="'.$v.'">';}*/
if($rb)$ret=implode($rb);
return $ret;}

?>