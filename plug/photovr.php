<?php
//philum_plugin_
require('plug/overpop.php');

function kmini($f,$w,$h){
$thumb=thumb_name(strrchr_b($f,'/'),$w,$h);
if(!is_file($thumb) or $_GET['rebuild_img'])//
	make_mini($f,$thumb,$w,$h,0);//1
return '<img src="'.$thumb.'">';}

/**/function photovr_batch($r,$dr,$wa,$ha,$wab='',$hab=''){
foreach($r as $k=>$v){$f=$dr.'/'.$v;
	list($w,$h)=getimagesize($f);
	//if($w>$h){$wb=$wa; $hb=$ha;} else{$wb=$ha; $hb=$wa;}
	//else{$wb=$wab; $hb=$hab;} //echo $w.'/'.$h.' '; echo br();
	$wb=$hb=$wa;
	$img=kmini($f,$wb,$hb);
	$t=$o?$v:''; $l='SaveBf(\'photo_'.str_replace("_","*",$f).'_'.($w).'_'.($h).'\')';
	$rb[]=divs('display:inline-block;',overpop($t,$l,'ffffff','',0.2,$wb,$hb).$img);}
return $rb;}

function plug_photovr($p,$o){//echo $p;
$dr='users/'.$p; //echo $_SESSION['prmb'][27];
list($wa,$ha)=split('/',$_SESSION['prmb'][27]); $wab=$ha*2; $hab=$wab*($ha/$wa);
$r=explore($dr,'files',0);
//$rb=photok_batch($r,$dr,$ha,$wa,$hab,$wab);
$rb=photovr_batch($r,$dr,$wa,$ha,$wab,$hab);
if($rb)$ret=implode($rb);
return $ret;}

?>