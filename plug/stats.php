<?php
//philum_plugin_stats
session_start();
error_reporting(6135);
//set_time_limit(60);

/*function update_stats(){
$now=date("ymd",$_SESSION['dayx']); $qdl=$_SESSION['qdl'];
$sql="SELECT id,iq FROM $qdl";  
$req=mysql_query($sql) or die(mysql_error());
echo chrono(select);
while($data=mysql_fetch_array($req)){$donn="";}}*/

/*function stats_sql_z($d,$n,$b=''){
$dt='date_format(time,"%m%d") as day'; $tm='to_days(now())-to_days(time)<='.$n.'';
switch($d){
case('nbv')://if($b)$gr=', group_concat(id) as ids';
	$slct=',count(id) as nbv'.$gr; $wh=$tm; break;
case('nbu'): $slct=',count(distinct(iq)) as nbu'; $wh=$tm; break;
case('nbp'): $slct='page, count(id) as nbv'; 
	if($n)$wh='and page like "%read='.$n.'%"'; break;
case('nbpu'): if($n)$wh='and page like "%read='.$n.'%"';
	$slct=$dt.', count(distinct(iq)) as nbu'; break;//88674
case('nbf'): $slct=', count(id) as nbv'; $wh='iq='.$n; break;//187925
}
$slct=$slct?$slct:$dt; $wh=$wh?$wh:'';
$ret='select '.$slct.' from '.ses('qdv').' where qb="'.ses('qbd').'" and '.$wh.' group by day';
return $ret;}*/

//sq
function stats_sql($d,$n,$b=''){
$dt='date_format(time,"%m%d") as day'; $tm='to_days(now())-to_days(time)<='.$n.'';
switch($d){
case('nbv')://if($b)$gr=', group_concat(id) as ids';
$ret='select '.$dt.',count(id) as nbv'.$gr.'
from '.ses('qdv').' where qb="'.ses('qbd').'" and '.$tm.' group by day'; break;
case('nbu'):
$ret='select '.$dt.',count(distinct(iq)) as nbu
from '.ses('qdv').' where qb="'.ses('qbd').'" and '.$tm.' group by day'; break;
case('nbp'):if($n)$wh='and page like "%read='.$n.'%"';
$ret='select page, count(id) as nbv
from '.ses('qdv').' where qb='.ses('qbd').' '.$wh.' group by day'; break;
case('nbpu'):if($n)$wh='and page like "%read='.$n.'%"';
$ret='select '.$dt.', count(distinct(iq)) as nbu 
from '.ses('qdv').' where qb='.ses('qbd').' '.$wh.' group by day'; break;//88674
case('nbf'):
$ret='select '.$dt.', count(id) as nbv
from '.ses('qdv').' where iq='.$n.' group by day'; break;//187925
}
return $ret;}

function stat_datas($c,$n){
$sql=stats_sql($c,$n);
$ret=sql_b($sql,'kv',0); //p($ret);
return $ret;}

function stat_boot($c,$n,$res){
list($nb)=split('_',$res);
$r=stat_datas($c,$nb?$nb:$n);
$w=ses('stw')?ses('stw'):550; $h=ses('sth')?ses('sth'):100;
return array($r,$w,$h);}

//canvas
function canvas($d,$w,$h){
return balb('canvas',atd('myCanvas').atb('width',$w).atb('height',$h).atc(''),'error').bal('script','var c=document.getElementById("myCanvas");
var ctx=c.getContext("2d"); ctx.font="12px Arial"; '.$d);}

function stat_canvas_mk($r,$w,$h,$t=''){$t=yes;
$clr=$_SESSION['clrs'][$_SESSION['prmd']];
$xr=max($r); $bars=count($r); $x1=0;
if($bars<$w/2)$esp=2; $ecart=$w/$bars; if($ecart<10)$t=off;
$ret='ctx.clearRect(0,0,1000,'.$h.'); '."\n";
foreach($r as $k=>$v){$x2=$x1+$ecart; $ah=round($v/$xr*($h-12));
	//$ret.=$x1.'-'.$h-$ah.'-'.$x2-$esp.'-'.$h.'|';
	//$rb[]=array($x1,$h-$ah-12,$ecart,$ah,$k,$v,$h,$t);
	$ret.='ctx.fillStyle="#'.$clr[7].'"; ';
	$ret.='ctx.fillRect('.($x1).','.($h-$ah-12).','.($ecart).','.($ah).');'."\n";
	if($t==yes){
		$ret.='ctx.fillStyle="#'.$clr[7].'"; ctx.font="12px Arial"; ';
		if(strpos($k,'='))$k=embed_detect($k,'=','&');
		$ret.='ctx.fillText("'.($k).'",'.($x1).','.($h-2).'); ';
		$ret.='ctx.fillStyle="yellow"; ctx.font="11px Arial"; ';
		$ret.='ctx.fillText("'.$v.'",'.($x1+2).','.($h-$ah).'); ';}
	$x1+=$ecart;}
//eco($ret,1);
return $ret;}

function canvas_j($c,$n,$res){
list($r,$w,$h)=stat_boot($c,$n,$res);
if($r)return stat_canvas_mk($r,$w,$h);}//json_encode

function stat_canvas($c,$n,$res){
list($r,$w,$h)=stat_boot($c,$n,$res);
if($r)$ret=stat_canvas_mk($r,$w,$h);
return canvas($ret,$w,$h);}

//graph
function graph_mk($r,$w,$h){req('spe');
$dr='plug/_data'; $output=$dr.'/stats.png'; if(!is_dir($dr))mkdir($dr);
if($r)graphics($output,$w,$h,$r,'000000','yes');//$_SESSION['clrs'][$_SESSION['prmd']][7]
return image($output.'?'.randid(),'','');}

function stat_graph($c,$n,$res){
list($r,$w,$h)=stat_boot($c,$n,$res);
return graph_mk($r,$w,$h);}

//list
function stat_list_sql($c,$n){
$dt='date_format(time,"%m%d") as day';
if($c=='nbv'||$c=='nbu')return 'select page, '.($c==nbv?'count('.ses('qdv').'.id)':'count(distinct(iq))').' as nbv, group_concat(iq) as iqs from '.ses('qdv').' where qb='.ses('qbd').' and to_days(now())-to_days(time)<='.$n.' and page like "%read=%" group by page order by nbv desc limit 100';
elseif($c=='nbp')return 'select date_format('.ses('qdv').'.time,"%y%m%d%h%i") as day, iq, ip, count('.ses('qdv').'.id) from '.ses('qdv').' inner join '.ses('qdp').' on '.ses('qdp').'.id=iq
where qb="'.ses('qbd').'" and page like "%read='.$n.'%" group by iq order by day desc';
elseif($c=='nbf')return 'select page, date_format('.ses('qdv').'.time,"%y%m%d%h%i") as day, count(id) from '.ses('qdv').' where qb="'.ses('qbd').'" and iq="'.$n.'" group by page order by day desc';}

function stat_list($c,$n){req('spe');
$j='popup_plup___stats_stat*list_'; //echo $c.'-'.$n;
if($c=='nbv' or $c=='nbu')$ret='days: '.$n.br(); 
if($c=='nbf')$ret='user: '.$n.br(); 
elseif($c=='nbp')$ret='article: '.$n.br();
$sql=stat_list_sql($c,$n); $r=sql_b($sql,'',0); //p($r);
if($c=='nbv' or $c=='nbu' or $c=='nbf'){foreach($r as $k=>$v){
	$id=substr(split_only('&',$v[0]),5); 
	if(is_numeric($id)){$suj=suj_of_id($id); //else $suj=$id;
	$flw=lj('','popup_popart___'.$id,picto(articles));
	$ret.=$v[1].' '.lj('txtx',$j.'nbp_'.$id,$suj).' '.$flw.br();}}}
elseif($c=='nbp')foreach($r as $k=>$v)
	$ret.=$v[0].' '.$v[3].' '.lj('txtx',$j.'nbf_'.$v[1],$v[2]).' '.br();
return $ret;}

//com
/*function stat_board($c,$n,$res){$rs=split('_',ajxg($res)); $bt='nbj'; //p($rs);
$ja='socket_plug__exec_stats_canvas*j_'; $jb='stt_plug___stats_stat*board_';
$jbb='stat_plugin___stats_';
$r=array('nbv'=>'hits','nbu'=>'users');//,'nbp'=>'pag','nbpu'=>'pagu','nbf'=>'ip'
foreach($r as $k=>$v){$kb=$k.'_'.$n; $pv='p'.$v;
	if(substr($v,0,3)=='pag')$bt='id'; 
	elseif($v=='ip')$bt='iq'; 
	if(ses('png')){$ret.=lj($k==$c?'active':'',$jbb.$kb,$v).' ';
		if($c==$k)$inp=input(1,$pv,$w,'').' '.lj('popbt',$jbb.$kb.'__'.$pv,$bt);}
	else{$ret.=ljb($k==$c?'active':'','SaveJb',$ja.$kb.'\',\''.$jb.$kb,$v).' ';
	if($c==$k)$inp=input(1,$pv,$w,'').' '.lj('popbt',$ja.$kb.'_'.$pv,$bt);}}
$op=lj('','popup_plup___stats_stat*list_'.$c.'_'.$n,picto('popup'));
return divb('nbp|stt',$ret.$inp.' '.$op);}*/

function stat_board($c,$n,$res){//p($rs);
$ret=lj($c=='nbv'?'active':'','stat_plugin___stats_nbv_'.$n,'nbv').' ';
$ret=lj($c=='nbv'?'active':'','stat_plugin___stats_nbu_'.$n,'nbu').' ';
if($c=='nbv')$ret.=lj('popbt','stat_plugin___stats_nbv_30','30').' ';
if($c=='nbv')$ret.=lj('popbt','stat_plugin___stats_nbv_180','180').' ';
$ret.=lj('','popup_plup___stats_stat*list_'.$c.'_'.$n,picto('popup'));
return divb('nbp|stt',$ret);}

function stat_daytime($d){
return mktime(0,0,0,substr($d,2,2),substr($d,4,2),substr($d,0,2));}

function stat_upd(){
//$d=sql('day','qdt','v','qb="'.ses('qb').'" order by id desc limit 1');
//echo stat_daytime($d);
//1
list($r,$w,$h)=stat_boot('nbv',7,'');
//4
//$r=stat_datas('nbv',7);
//p($r);
}

//plug
function plug_stats($c,$n,$res=''){connect();
static $i; $i++; if($i==2)return;
$c=$c?$c:'nbv'; $n=$n?$n:7; ses('png',1);
list($w,$h)=split('_',$res); ses('stw',$w?$w:550); ses('sth',$h=$h?$h:100);
if(ses('png'))$ret.=stat_graph($c,$n,$res).br().br();
else $ret.=divd('graph',stat_canvas($c,$n,$res)).br().br();
$ret.=stat_board($c,$n,$res);
//stat_upd();
return divd('stat',$ret);}

?>