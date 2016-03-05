<?php
//philum_plugin_umtoa

function ummo_toa(){
$r=msql_read('','ummo_umtoa','','1');
foreach($r as $k=>$v){list($aeon,$xee)=explode('-',$k); $ra[$aeon][$xee]=$v;} ksort($ra);
foreach($ra as $k=>$v){ksort($v); foreach($v as $ka=>$va)$rb[]=array($k,$ka,$va);}
foreach($rb as $k=>$v){list($aeon,$xee,$txt)=$v;
	$day=(($aeon-1)*6000)+$xee;
	list($nxaeon,$nxxee,$nxday)=$rb[$k+1]; $nxday=(($nxaeon-1)*6000)+$nxxee;
	$length=$nxday>0?$nxday-$day:200;
	if($aeon==3 && !$nn){$nn=11750; $earth_year=umtoa_equiv($day);
		$rc[]=array(3,0,'Nuit Noire',$day,$length+$nn,$earth_year);}
	$earth_year=umtoa_equiv($day+$nn);
	$rc[]=array($aeon,$xee,$txt,$day+$nn,$length,$earth_year);
}
//pr($rc);
return $rc;}

function umtoa_equiv($nbxee){
$now=ses('dayx');
$aeon4_timestamp=1059184800; //echo mktime(4,0,0,7,26,2003).' ';//26/07/2003
$aeon4_xees=29750; //nb xees until aeon 4
$xee_sec=6679066.23889199298; //seconds
$xees_diff=$aeon4_xees-$nbxee;
$xees_diff_sec=$xees_diff*$xee_sec;
$utime=$aeon4_timestamp-$xees_diff_sec;
return date('Y',$utime);}

function umtoa_build(){
$r=ummo_toa();
$ratio=10;
foreach($r as $k=>$v){
	list($aeon,$xee,$txt,$pos,$height,$year)=$v;
	$date='Ere '.$aeon.' / Xee '.$xee.' ('.$year.') ';
	//$top='top:'.($pos/$ratio+40).'px; ';
	$sty='height:'.(($height/$ratio)).'px;';
	$css='hline '.($txt=='Nuit Noire'?'aeonblack':'aeon'.$aeon);
	$ret.=div(atc($css).ats($sty),$date.$txt);
}
return div(atc('vline').ats('height:'.(($pos+$height)/$ratio+40).'px;'),$ret);}

function plug_umtoa($p,$o){$rid='plg'.randid();
Head::add('csscode','
.hline{padding-left:10px; border-top:2px solid black;width:100%;}
.hline:hover{z-index:2; background:silver; min-height:40px;}
.vline{border-left:20px dashed black;}
.aeon{border-top:2px solid dashed; background:silver;}
.aeon1{background:bisque;}
.aeon2{background:darkkhaki;}
.aeonblack{background:lightslategray;}
.aeon3{background:darkturquoise;}
.aeon4{background:hotpink;}');
$ret=umtoa_build($p,$o);
$bt.=msqlink('',ses('qb').'_umtoa');
return $bt.divd($rid,$ret);}

?>