<?php
//philum_plugin_calendar

function calendar_build($time,$to,$res=''){$rid='cld'.randid();
$time=$time?$time:time(); $gd=getdate($time);
$month=$gd['mon']; if(strlen($month)==1)$month='0'.$month;
$first=date('w',mktime(1,1,1,$month,1,$gd['year'])); if($first==0)$first=7;
$nbdy=date('t',mktime(1,1,1,$month,1,$gd['year']));
$j=$rid.'_plug___calendar_calendar*build_';
$ret=lj('',$j.($time-2592000).'_'.$to,picto('left'));
$ret.=btn('poph',$month.'/'.$gd['year']);
$ret.=lj('',$j.($time+2592000).'_'.$to,picto('right'));
$ret.='<table>'; $today=date('dmy',time());
for($a=1;$a<$first;$a++)$ret.='<td></td>';
for($i=1;$i<=$nbdy;$i++){$mk=mktime(0,0,0,$month,$i,$gd['year']); $day=date('d',$mk);
	if(date('dmy',$mk)==$today)$c=' txtclr'; else $c='';
	$date=$gd['year'].'-'.$month.'-'.$day.'-'.$gd['hours'].'-'.$gd['minutes'];
	$bt=lj('lina'.$c,$to.'_plug__4x_calendar_calendar*j_'.$date,$day)."\n";
	$ret.='<td>'.$bt.'</td>'; 
	$a++; if($a==8){$a=1; $ret.='</tr><tr>';}}
$ret.='</tr></table>';
return divd($rid,$ret);}

function calendar_j($p,$o){
return $p;}

function plug_calendar($p,$o){$rid='plg'.randid();
$ret=calendar_build($p,'res');
$bt=input(1,'res','');
return $bt.divd($rid,$ret);}

?>