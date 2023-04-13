<?php 
class calendar{//deprecated by html

static function build($time,$to){$rid='cld'.randid();
if(!is_numeric($time))$time=$time?strtotime($time):time(); $gd=getdate($time);
$month=$gd['mon']; if(strlen($month)==1)$month='0'.$month;
$first=date('w',mktime(1,1,1,$month,1,$gd['year'])); if($first==0)$first=7;
$nbdy=date('t',mktime(1,1,1,$month,1,$gd['year']));
$j=$rid.'_calendar,build___';
$ret=lj('',$j.($time-2592000).'_'.$to,picto('before'));
$ret.=btn('poph',$month.'/'.$gd['year']);
$ret.=lj('',$j.($time+2592000).'_'.$to,picto('after'));
$ret.='<table>'; $today=date('dmy',time()); $ret.='<tr>';
foreach(['L','M','M','J','V','S','D'] as $v)$ret.='<td>'.$v.'</td>'; $ret.='</tr><tr>';
for($a=1;$a<$first;$a++)$ret.='<td></td>';
for($i=1;$i<=$nbdy;$i++){$mk=mktime(0,0,0,$month,$i,$gd['year']); $day=date('d',$mk);
	if(date('dmy',$mk)==$today)$c=' txtclr'; else $c='';
	$date=$gd['year'].'/'.$month.'/'.$day.' '.$gd['hours'].':'.$gd['minutes'];
	//$date=date('Y-m-d\TH:i',$mk);
	$bt=ljb('lina'.$c,'jumpvalue',[$to,$date],$day);
	$ret.='<td>'.$bt.'</td>'; 
	$a++; if($a==8){$a=1; $ret.='</tr><tr>';}}
$ret.='</tr></table>';
return divd($rid,$ret);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
return self::build($p,$o);}

static function home($p,$o){$rid='plg'.randid();
$ret=self::build($p,'res');
$bt=input('res','');
return $bt.divd($rid,$ret);}
}
?>