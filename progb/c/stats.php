<?php //app_stats
class stats{
//sq
static function sql($d,$n,$b=''){$ret='';
$dt='date_format(time,"%m%d") as day'; $tm='to_days(now())-to_days(time)<='.$n.'';
switch($d){
case('nbv'):$gr=''; //if($b)$gr=', group_concat(id) as ids';
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
case('nbp3'):$ret='select count(id) as nbv,substring(page,5) as idart
from '.ses('qdv2').' where idart>0 group by idart'; break;//nbvues
case('nbpu'):if($n)$wh='and page like "%read='.$n.'%"';
$ret='select '.$dt.', count(distinct(iq)) as nbu 
from '.ses('qdv').' where qb='.ses('qbd').' '.$wh.' group by day'; break;//88674
case('nbpu2'):if($n)$wh='and page like "%read='.$n.'%"';
$ret='select '.$dt.', count(distinct(iq)) as nbu 
from '.ses('qdv2').' where qb='.ses('qbd').' '.$wh.' group by day'; break;
case('nbf'):$ret='select '.$dt.', count(id) as nbv
from '.ses('qdv').' where iq='.$n.' group by day'; break;}//187925
return $ret;}

static function datas($c,$n){
$sql=self::sql($c,$n); //if(auth(6))echo $sql;
if($c=='nbutot')$ret=sql_b($sql,'v'); else $ret=sql_b($sql,'kv');
if($c=='nbp'){$rb=sql_b(self::sql('nbp2',$n),'kv'); if($rb)$ret=array_merge($ret,$rb);}
if($c=='nbpu'){$rb=sql_b(self::sql('nbpu2',$n),'kv'); if($rb)$ret=array_merge($ret,$rb);}
if($c=='nbutot'){$ret+=sql_b(self::sql('nbutot2',$n),'v');}
return $ret;}

static function boot($c,$n,$res){
[$nb]=explode('_',$res);
$r=self::datas($c,$n?$n:$nb);
$w=ses('stw')?ses('stw'):550; $h=ses('sth')?ses('sth'):100;
return[$r,$w,$h];}

//canvas
static function draw_canvas($d,$w,$h){
return bal('canvas',atd('myCanvas').atb('width',$w).atb('height',$h).atc(''),'error').balb('script','var c=document.getElementById("myCanvas");
var ctx=c.getContext("2d"); ctx.font="12px Arial"; '.$d);}

static function canvas_mk($r,$w,$h,$t=''){$t='yes';
$clr=$_SESSION['clrs'][$_SESSION['prmd']];
$xr=max($r); $bars=count($r); $x1=0;
if($bars<$w/2)$esp=2; $ecart=$w/$bars; if($ecart<10)$t='off';
$ret='ctx.clearRect(0,0,1000,'.$h.'); '."\n";
foreach($r as $k=>$v){$x2=$x1+$ecart; $ah=round($v/$xr*($h-12));
	//$ret.=$x1.'-'.$h-$ah.'-'.$x2-$esp.'-'.$h.'|';
	//$rb[]=[$x1,$h-$ah-12,$ecart,$ah,$k,$v,$h,$t];
	$ret.='ctx.fillStyle="#'.$clr[7].'"; ';
	$ret.='ctx.fillRect('.($x1).','.($h-$ah-12).','.($ecart).','.($ah).');'."\n";
	if($t=='yes'){
		$ret.='ctx.fillStyle="#'.$clr[7].'"; ctx.font="12px Arial"; ';
		if(strpos($k,'='))$k=segment($k,'=','&');
		$ret.='ctx.fillText("'.($k).'",'.($x1).','.($h-2).'); ';
		$ret.='ctx.fillStyle="yellow"; ctx.font="11px Arial"; ';
		$ret.='ctx.fillText("'.$v.'",'.($x1+2).','.($h-$ah).'); ';}
	$x1+=$ecart;}
//eco($ret,1);
return $ret;}

static function canvas_j($c,$n,$res){
[$r,$w,$h]=self::boot($c,$n,$res);
if($r)return self::canvas_mk($r,$w,$h);}//json_encode

static function canvas($c,$n,$res){
[$r,$w,$h]=self::boot($c,$n,$res);
if($r)$ret=self::canvas_mk($r,$w,$h);
return self::draw_canvas($ret,$w,$h);}

//graph
static function graph_mk($r,$w,$h){
$dr='_datas'; $output=$dr.'/stats.png'; if(!is_dir($dr))mkdir($dr);
if($r)img::graphics($output,$w,$h,$r,'000000','yes');//$_SESSION['clrs'][$_SESSION['prmd']][7]
return image('/'.$output.'?'.randid(),'','');}

static function graph($c,$n,$res){
[$r,$w,$h]=self::boot($c,$n,$res);
$t=array_sum($r).' '.($c=='nbp'?'vues':'visitors').' / '.count($r).' '.nms(4);
if($r)return self::graph_mk($r,$w,$h).div('',$t);}

//list
static function list_sql($c,$n){
$dt='date_format(time,"%m%d") as day';
if($c=='nbv'||$c=='nbu')return 'select page, '.($c=='nbv'?'count('.ses('qdv').'.id)':'count(distinct(iq))').' as nbv, group_concat(iq) as iqs from '.ses('qdv').' where qb='.ses('qbd').' and to_days(now())-to_days(time)<='.$n.' and page like "%read=%" group by page order by nbv desc limit 100';
elseif($c=='nbp')return 'select date_format('.ses('qdv').'.time,"%y%m%d%h%i") as day, iq, ip, count('.ses('qdv').'.id) from '.ses('qdv').' inner join '.ses('qdp').' on '.ses('qdp').'.id=iq
where qb="'.ses('qbd').'" and page like "%read='.$n.'%" group by iq order by day desc';
elseif($c=='nbf')return 'select page, date_format('.ses('qdv').'.time,"%y%m%d%h%i") as day, count(id) from '.ses('qdv').' where qb="'.ses('qbd').'" and iq="'.$n.'" group by page order by day desc';}

static function statlist($c,$n){
$j='popup_stats,statlist___'; $ret=''; //echo $c.'-'.$n;
if($c=='nbv' or $c=='nbu')$ret='days: '.$n.br(); 
if($c=='nbf')$ret='user: '.$n.br();
elseif($c=='nbp')$ret='article: '.$n.br();
$sql=self::list_sql($c,$n); $r=sql_b($sql,'',0); //p($r);
if($c=='nbv' or $c=='nbu' or $c=='nbf'){if($r)foreach($r as $k=>$v){
	$id=segment($v[0],'=','&'); $id=strto($id=strfrom($id,'_'),'_');//del popart_12___
	if(is_numeric($id)){$suj=ma::suj_of_id($id); //else $suj=$id;
	$flw=lj('','popup_popart___'.$id,picto('articles'));
	$ret.=$v[1].' '.lj('txtx',$j.'nbp_'.$id,$suj).' '.$flw.br();}}}
elseif($c=='nbp')foreach($r as $k=>$v)
	$ret.=$v[0].' '.$v[3].' '.lj('txtx',$j.'nbf_'.$v[1],$v[2]).' '.br();
return $ret;}

//consolidate
static function solid($day_max_known){
$sql=self::sql('nbuv',$day_max_known);
$r=sql_b($sql,''); $n=0; $rb=[];
$mnd=array_flip($_SESSION['mnd']);
if($r)foreach($r as $k=>$v){$qbd=val($mnd,$v[0],ses('qb'));
	$ex=sql('id','qds','v','qb="'.$qbd.'" and day="'.$v['1'].'"');
	if(!$ex){$rb[]='(NULL,"'.$qbd.'","'.$v['1'].'","'.$v['2'].'","'.$v['3'].'")'; $n+=1;}}
insert('qds',implode(',',$rb));
return $n;}

//read_stats
static function read($c,$n){
$r=sql('day,'.$c,'qds','kv','qb="'.ses('qb').'" and day>"'.date('ymd',calc_date($n)).'"');
//$rv=sql('iq','qdv2','k','qb="'.ses('qb').'" and time>"'.calc_date($n).'"');
$w=ses('stw')?ses('stw'):550; $h=ses('sth')?ses('sth'):100;
if($r){
	if($c=='nbu')$nb=self::datas('nbutot',$n); else $nb=array_sum($r);
	$score=divc('panel','Total of '.($c=='nbv'?'views pages':'unique visitors').': '.$nb);
	return self::graph_mk($r,$w,$h).br().$score;}}

//freespace
static function lightlive(){
$db=install::db(ses('qd'));
if(!$db['live'])return 'er';
if(!$db['live2']){$sql=str_replace('_live','_live2',$db['live']); qr($sql);}
$tim=calc_date(30); $day=date('Y-m-d H:i:s',$tim);
$lastid=sql('id','qdv','v','time>"'.$day.'" order by id limit 1');
if(is_numeric($lastid)){
qrid('insert into '.ses('qdv2').' select * from '.ses('qdv').' where id<'.$lastid);
qr('delete from '.ses('qdv').' where id<"'.$lastid.'"'); reflush('qdv');}
return ses('qdv').' was cleaned from id '.$lastid;}

//com
static function board($c,$n,$res){//p($rs);
$ret=lj($c=='nbv'?'active':'','stat_stats,home__3_nbv_'.$n,'nbv').' ';
$ret.=lj($c=='nbu'?'active':'','stat_stats,home__3_nbu_'.$n,'nbu').' ';
$nbr=[7,30,90,180,365,730,1460,2920,4840];
foreach($nbr as $v)$ret.=lj($v==$n?'active':'','stat_stats,home__3_'.$c.'_'.$v,$v).' ';
if(auth(6))$ret.=lj('','popup_stats,statlist__3_'.$c.'_'.$n,picto('filelist'));
if(auth(6))$ret.=lj('','popup_stats,lightlive__3_','cleaner');
if(auth(6))$ret.=lj('','popup_stats,statsee__js_','live');
return divb($ret,'nbp','stt');}

static function daytime($d){
return mktime(0,0,0,substr($d,2,2),substr($d,4,2),substr($d,0,2));}

static function call($p,$o){if(!$p)$p=0; $o=100; $ret=[];
//$r=sql('iq,qb,page,time','qdv','','id>'.$p.' order by id desc');
$r=sql_inner('ip,qb,page,DATE_FORMAT('.qd('live').'.time,\'%H:%i:%s\')','qdp','qdv','iq','','where '.qd('live').'.id>'.($p).' order by '.qd('live').'.id desc limit '.$o);
if($r)foreach($r as $k=>$v)$ret[]=[$k,$v[3],$v[0],$v[2]];
return tabler($ret,'txtx','txtx');}

static function js($p,$o){$o=$o?$o:100;
$p=sqb('id','qdv','v','order by id desc limit 1');
$j=sj('sts_statsee,call___'.$p.'_'.$o);
return jscode(temporize('sttimer',$j,3000));}

static function statsee($p,$o){
$rid='sts'; if(!auth(6))return; $o=$o?$o:100;
$p=sqb('id','qdv','v','order by id desc limit 1');
$j=sj($rid.'_statsee,call___'.$p.'_'.$o);
Head::add('jscode',temporize('sttimer',$j,3000));
return divd($rid,self::call($p,$o));}

//plug
static function home($c,$n,$res=''){
static $i; $i++; if($i==2)return;
$c=$c?$c:'nbv'; $n=$n?$n:7; ses('png',1);
[$w,$h]=opt($res,'_',2); ses('stw',$w?$w:550); ses('sth',$h?$h:100);
$day_max_known=sql('day','qds','v','qb="'.ses('qb').'" and day<"'.date('ymd').'" order by id desc limit 1');
if($day_max_known<date('ymd',calc_date(1)))$ret=self::solid($day_max_known);
//if(ses('png'))$ret.=self::graph($c,$n,$res).br().br();
//else $ret.=divd('graph',self::canvas($c,$n,$res)).br().br();
$ret=self::read($c,$n).br();
$ret.=self::board($c,$n,$res);
//stat_upd();
return divd('stat',$ret);}
}
?>