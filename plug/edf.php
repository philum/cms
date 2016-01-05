<?php
//philum_plugin_edf

function plug_edf(){req('spe');
$r=msql_read('',$_SESSION['qb'].'_edf',''); unset($r['_menus_']); $n=count($r);
for($i=1;$i<=$n;$i++){list($day,$month,$year)=split('/',$r[$i][0]);
$dat=mktime(0,0,0,$month,$day,$year); $ra[$i]=$dat/86400;
if($i==1){$dorigin=$dat; $vorigin=$r[$i][1];}
$day=($dat-$dorigin)/86400;
if($ra[$i-1])$diffday=$ra[$i]-$ra[$i-1];
if($r[$i-1][1])$diffval=$r[$i][1]-$r[$i-1][1];
if($diffday)$val=round($diffval/$diffday,2);
$re[]=array($r[$i][0],$r[$i][1],round($diffday),$diffval,$val);//,$diffval*0.08
$rb[$day]=$val;
$rc[$day]=$r[$i][0];}
for($i=1;$i<=$day;$i++){
	if($rb[$i])$key=$rc[$i];else $key=$i; 
	$rd[$key]=$rb[$i];}
$ret=$day.' days = '.$val.' units => '.round($val/$day,2).' unit/day '.br();
$f='plug/_data/edf_graph.png';
graphics($f,$_SESSION['prma']['content'],300,$rd,'000000','yes');
$ret.=image($f,'','');
$rt=array('','date','count','days','units','average');//,'price'
$ret.=make_tables($rt,$re,'txtred','txtblc');
return $ret;}

?>