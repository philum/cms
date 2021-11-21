<?php
//philum_plugin_umdays

function umdays_build($p,$o){req('spe');
$r=sql('id,day','qda','kv','id>1508 order by day asc'); //pr($r);
$rb[]=array('id','date','diff sec','diff min','diff hours','diff days');
foreach($r as $k=>$v){
	$date=date('Y/m/d h:i',$v);
	if(substr($date,-2)=='00'){
		if($vb){$diff=$v-$vb; $dsec=$diff/60; $dhour=$dsec/60; $ddays=$dhour/24;}
		$rb[]=array($k,$date,$diff,$dsec,$dhour,$ddays);
		$bit[$date]=$dhour;
		$vb=$v;}}
$f='_datas/umd.png';
graphics($f,'800','200',$bit,'','');
$ret=image('/'.$f);
$ret.=tabler($rb,'popw','');
return $ret;}

function plug_umdays($p,$o){$rid='plg'.randid();
$ret=umdays_build($p,$o);
return divd($rid,$ret);}

?>