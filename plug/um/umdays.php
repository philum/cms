<?php //umdays
class umdays{
static function build($p,$o){$vb=0;
$r=sql('id,day','qda','kv','id>1508 order by day asc'); //pr($r);
$rb[]=['id','date','diff sec','diff min','diff hours','diff days'];
foreach($r as $k=>$v){
	$date=date('Y/m/d h:i',$v);
	if(substr($date,-2)=='00'){
		if($vb){$diff=$v-$vb; if($diff){$dsec=$diff/60; $dhour=$dsec/60; $ddays=$dhour/24;}
		$rb[]=[$k,$date,$diff,$dsec,$dhour,$ddays];
		$bit[$date]=$dhour;}
		$vb=$v;}}
$f='_datas/umd.png';
img::graphics($f,'800','200',$bit,'','');
$ret=image('/'.$f);
$ret.=tabler($rb,'popw','');
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$ret=self::build($p,$o);
return divd($rid,$ret);}
}
?>