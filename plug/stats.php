<?php
//philum_plugin_stats

//sq
function stats_sql($d,$n,$b=''){
$dt='date_format(time,"%m%d") as day'; $tm='to_days(now())-to_days(time)<='.$n.'';
switch($d){
case('nbv')://if($b)$gr=', group_concat(id) as ids';
$ret='select '.$dt.',count(id) as nbv'.$gr.'
from '.ses('qdv').' where qb="'.ses('qbd').'" and '.$tm.' group by day'; break;
case('nbu'): $ret='select '.$dt.',count(distinct(iq)) as nbu
from '.ses('qdv').' where qb="'.ses('qbd').'" and '.$tm.' group by day'; break;
case('nbutot'): $ret='select count(distinct(iq)) as nbu from '.ses('qdv').' where qb="'.ses('qbd').'" and '.$tm.''; break;
case('nbutot2'): $ret='select count(distinct(iq)) as nbu from '.ses('qdv2').' where qb="'.ses('qbd').'" and '.$tm.''; break;
case('nbuv'): $ret='select qb,date_format(time,"%y%m%d") as day,count(distinct(iq)) as nbu,count(id) as nbv from '.ses('qdv').' where qb>0 and date_format(time,"%y%m%d")>"'.$n.'" and date_format(time,"%y%m%d")<"'.date('ymd').'" group by day,qb'; break;
case('nbp'):if($n)$wh='and page like "%read='.$n.'%"';
$ret='select '.$dt.', count(id) as nbv 
from '.ses('qdv').' where qb='.ses('qbd').' '.$wh.' group by day'; break;
case('nbp2'):if($n)$wh='and page like "%read='.$n.'%"';
$ret='select '.$dt.', count(id) as nbv
from '.ses('qdv2').' where qb='.ses('qbd').' '.$wh.' group by day'; break;
case('nbpu'):if($n)$wh='and page like "%read='.$n.'%"';
$ret='select '.$dt.', count(distinct(iq)) as nbu 
from '.ses('qdv').' where qb='.ses('qbd').' '.$wh.' group by day'; break;//88674
case('nbpu2'):if($n)$wh='and page like "%read='.$n.'%"';
$ret='select '.$dt.', count(distinct(iq)) as nbu 
from '.ses('qdv2').' where qb='.ses('qbd').' '.$wh.' group by day'; break;
case('nbf'):
$ret='select '.$dt.', count(id) as nbv
from '.ses('qdv').' where iq='.$n.' group by day'; break;//187925
}
return $ret;}

function stat_datas($c,$n){
$sql=stats_sql($c,$n); //if(auth(6))echo $sql;
if($c=='nbutot')$ret=sql_b($sql,'v'); else $ret=sql_b($sql,'kv');
if($c=='nbp'){$rb=sql_b(stats_sql('nbp2',$n),'kv'); if($rb)$ret=array_merge($ret,$rb);}
if($c=='nbpu'){$rb=sql_b(stats_sql('nbpu2',$n),'kv'); if($rb)$ret=array_merge($ret,$rb);}
if($c=='nbutot'){$ret+=sql_b(stats_sql('nbutot2',$n),'v');}
return $ret;}

function stat_boot($c,$n,$res){
list($nb)=explode('_',$res);
$r=stat_datas($c,$n?$n:$nb);
$w=ses('stw')?ses('stw'):550; $h=ses('sth')?ses('sth'):100;
return array($r,$w,$h);}

//canvas
function canvas($d,$w,$h){
return bal('canvas',atd('myCanvas').atb('width',$w).atb('height',$h).atc(''),'error').balb('script','var c=document.getElementById("myCanvas");
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
$dr='_datas'; $output=$dr.'/stats.png'; if(!is_dir($dr))mkdir($dr);
if($r)graphics($output,$w,$h,$r,'000000','yes');//$_SESSION['clrs'][$_SESSION['prmd']][7]
return image('/'.$output.'?'.randid(),'','');}

function stat_graph($c,$n,$res){
list($r,$w,$h)=stat_boot($c,$n,$res);
$t=array_sum($r).' '.($c=='nbp'?'vues':'visitors').' / '.count($r).' '.nms(4);
if($r)return graph_mk($r,$w,$h).div('',$t);}

//list
function stat_list_sql($c,$n){
$dt='date_format(time,"%m%d") as day';
if($c=='nbv'||$c=='nbu')return 'select page, '.($c=='nbv'?'count('.ses('qdv').'.id)':'count(distinct(iq))').' as nbv, group_concat(iq) as iqs from '.ses('qdv').' where qb='.ses('qbd').' and to_days(now())-to_days(time)<='.$n.' and page like "%read=%" group by page order by nbv desc limit 100';
elseif($c=='nbp')return 'select date_format('.ses('qdv').'.time,"%y%m%d%h%i") as day, iq, ip, count('.ses('qdv').'.id) from '.ses('qdv').' inner join '.ses('qdp').' on '.ses('qdp').'.id=iq
where qb="'.ses('qbd').'" and page like "%read='.$n.'%" group by iq order by day desc';
elseif($c=='nbf')return 'select page, date_format('.ses('qdv').'.time,"%y%m%d%h%i") as day, count(id) from '.ses('qdv').' where qb="'.ses('qbd').'" and iq="'.$n.'" group by page order by day desc';}

function stat_list($c,$n){req('spe');
$j='popup_plup___stats_stat*list_'; //echo $c.'-'.$n;
if($c=='nbv' or $c=='nbu')$ret='days: '.$n.br(); 
if($c=='nbf')$ret='user: '.$n.br(); 
elseif($c=='nbp')$ret='article: '.$n.br();
$sql=stat_list_sql($c,$n); $r=sql_b($sql,'',0); //p($r);
if($c=='nbv' or $c=='nbu' or $c=='nbf'){if($r)foreach($r as $k=>$v){
	$id=segment($v[0],'=','&'); $id=strto($id=strfrom($id,'_'),'_');//del popart_12___
	if(is_numeric($id)){$suj=suj_of_id($id); //else $suj=$id;
	$flw=lj('','popup_popart___'.$id,picto('articles'));
	$ret.=$v[1].' '.lj('txtx',$j.'nbp_'.$id,$suj).' '.$flw.br();}}}
elseif($c=='nbp')foreach($r as $k=>$v)
	$ret.=$v[0].' '.$v[3].' '.lj('txtx',$j.'nbf_'.$v[1],$v[2]).' '.br();
return $ret;}

//consolidate
function stat_solid($day_max_known){
$sql=stats_sql('nbuv',$day_max_known);
$r=sql_b($sql,''); $n=0;
$mnd=array_flip($_SESSION['mnd']);
if($r)foreach($r as $k=>$v){$qbd=val($mnd,$v[0],ses('qb'));
	$sql='(NULL,"'.$qbd.'","'.$v['1'].'","'.$v['2'].'","'.$v['3'].'")';
	$ex=sql('id','qds','v','qb="'.$qbd.'" and day="'.$v['1'].'"');
	if(!$ex){insert('qds',$sql); $n+=1;}}
return $n;}

//read_stats
function stat_read($c,$n){
$r=sql('day,'.$c,'qds','kv','qb="'.ses('qb').'" and day>"'.date('ymd',calc_date($n)).'"');
//$rv=sql('iq','qdv2','k','qb="'.ses('qb').'" and time>"'.calc_date($n).'"');
$w=ses('stw')?ses('stw'):550; $h=ses('sth')?ses('sth'):100;
if($r){
	if($c=='nbu')$nb=stat_datas('nbutot',$n); else $nb=array_sum($r);
	$score=divc('panel','Total of '.($c=='nbv'?'views pages':'unique visitors').': '.$nb);
	return graph_mk($r,$w,$h).br().$score;}}

//freespace
function light_live(){
$db=plugin_func('install','install_db',ses('qd'));
if(!$db['live'])return 'er';
if(!$db['live2']){$sql=str_replace('_live','_live2',$db['live']); qr($sql);}
$tim=calc_date(30); $day=date('Y-m-d H:i:s',$tim);
$lastid=sql('id','qdv','v','time>"'.$day.'" order by id limit 1');
if(is_numeric($lastid)){
qrid('insert into '.ses('qdv2').' select * from '.ses('qdv').' where id<'.$lastid);
qr('delete from '.ses('qdv').' where id<"'.$lastid.'"'); reflush('qdv');}
return ses('qdv').' was cleaned from id '.$lastid;}

//com
function stat_board($c,$n,$res){//p($rs);
$ret=lj($c=='nbv'?'active':'','stat_plugin__3_stats_nbv_'.$n,'nbv').' ';
$ret.=lj($c=='nbu'?'active':'','stat_plugin__3_stats_nbu_'.$n,'nbu').' ';
$nbr=array(7,30,90,180,365,730,1460,2920,4840);
foreach($nbr as $v)$ret.=lj($v==$n?'active':'','stat_plugin__3_stats_'.$c.'_'.$v,$v).' ';
if(auth(6))$ret.=lj('','popup_plup__3_stats_stat*list_'.$c.'_'.$n,picto('filelist'));
if(auth(6))$ret.=lj('','popup_plup__3_stats_light*live','cleaner');
if(auth(6))$ret.=lj('','popup_plup__3_statsee','live');
return divb($ret,'nbp','stt');}

function stat_daytime($d){
return mktime(0,0,0,substr($d,2,2),substr($d,4,2),substr($d,0,2));}

//plug
function plug_stats($c,$n,$res=''){
static $i; $i++; if($i==2)return;
$c=$c?$c:'nbv'; $n=$n?$n:7; ses('png',1);
list($w,$h)=opt($res,'_',2); ses('stw',$w?$w:550); ses('sth',$h?$h:100);
$day_max_known=sql('day','qds','v','qb="'.ses('qb').'" and day<"'.date('ymd').'" order by id desc limit 1');
if($day_max_known<date('ymd',calc_date(1)))$ret=stat_solid($day_max_known);
//if(ses('png'))$ret.=stat_graph($c,$n,$res).br().br();
//else $ret.=divd('graph',stat_canvas($c,$n,$res)).br().br();
$ret=stat_read($c,$n).br();
$ret.=stat_board($c,$n,$res);
//stat_upd();
return divd('stat',$ret);}

?>