<?php //umtoa
class umtoa{
static $clr=['#ffffff','#ff0000','#0000ff','#ffff00','#00ff00','#00ffff','#ff9900','#cccccc','#666666','#000000'];

static function toa(){
$r=msql::read('','ummo_umtoa_1','','1'); //p($r);
if($r)foreach($r as $k=>$v){[$aeon,$xee]=explode('-',$v[0]); $ra[$aeon][$xee]=$v[1];}
if($ra)ksort($ra); $nn=0;
if($ra)foreach($ra as $k=>$v){ksort($v); foreach($v as $ka=>$va)$rb[]=[$k,$ka,$va];}
if($rb)foreach($rb as $k=>$v){[$aeon,$xee,$txt]=$v;
	$day=(($aeon-1)*6000)+$xee;
	if(isset($rb[$k+1]))[$nxaeon,$nxxee,$nxday]=$rb[$k+1];
	$nxday=(($nxaeon-1)*6000)+$nxxee;
	$length=$nxday>0?$nxday-$day:200;
	if($aeon==3 && !$nn){$nn=11750; $earth_year=self::equiv($day);//2491y,d541
		$rc[]=[3,0,'Nuit Noire',$day,$length+$nn,$earth_year];}
	$earth_year=self::equiv($day+$nn);
	$rc[]=[$aeon,$xee,$txt,$day+$nn,$length,$earth_year];
}
//pr($rc);
return $rc;}

static function equiv($nbxee){
$now=ses('dayx');
$aeon4_timestamp=1059184800; //echo mktime(4,0,0,7,26,2003).' ';//26/07/2003
$aeon4_xees=29750; //nb xees until aeon 4
$xee_sec=6679066.23889199298; //seconds
$xees_diff=$aeon4_xees-$nbxee;
$xees_diff_sec=$xees_diff*$xee_sec;
$utime=round($aeon4_timestamp-$xees_diff_sec);
return date('Y',$utime);}

static function build(){
$r=self::toa(); //pr($r);
$klr=['#2c1600','#42c6f2','#42dc42','#f29a16','#f26e6e'];
[$white,$red,$green,$yellow,$cyan,$blue,$orange,$silver,$gray,$black]=self::$clr;
$n=count($r); $ha=$r[$n-1][3]+$r[$n-1][4]; 
$h=1200; $ratio=($ha/$h); if($n)$htxt=round($h/$n); $hx=10;//start h of text
//pr([$n,$h,$ratio]);
new svg(780,$h+100); $hb=0; $xb=0;
if($r)foreach($r as $k=>$v){
	[$aeon,$xee,$txt,$pos,$height,$year]=$v;
	$date='Ere '.$aeon.' Xee '.$xee.' (AT '.$year.')';
	$top=round($pos/$ratio);
	$h=round($height/$ratio);
	$clr=$klr[$aeon];
	if($height<$htxt)$hb+=$htxt; else $hb+=$height;
	if($height<$htxt)$xb+=30; elseif($xb>=30)$xb-=30;
	if($txt=='Nuit Noire'){$txt.=', 11750 Xee (2491 years)'; $clr='aeonblack';}
	//$ret.=divs('margin:1px; padding:4px; background:'.$clr,$date.' '.$txt);
	//svg::rect(10,$top,'200',$h,$clr,$black,1);
	//if($k<4)
	svg::poly(['10/'.$hx,'580/'.$hx,'620/'.$top,'780/'.$top,'780/'.($top+$h),'620/'.($top+$h),'580/'.($hx+$htxt),'10/'.($hx+$htxt),'10/'.$hx],$clr,$black,1);
	svg::text(12,20,$hx+14,$txt,$white);
	svg::text(12,430,$hx+$htxt-6,$date,$white);
	//pr([$date,$txt,$top,$height,$h]);
	$hx+=$htxt;
}
return $draw=svg::draw();}
//return divc('grid-art',divc('col1',$ret).divc('col2',$draw));

static function home($p,$o){$rid='plg'.randid();
$ret=self::build($p,$o);
$bt=msqbt('',nod('umtoa_1'));
return $bt.divd($rid,$ret);}
}
?>