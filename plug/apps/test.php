<?php 
class test{

static function playmod($p,$o,$prm=[]){
//list($m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr,$dv,$pv)
$res=$prm[0]??''; $r=explode('/',$res); $t=divc('txtcadr',$p);
msql::modif('',nod('test_1'),$r,'one','',$p);
return $t.mod::call($res.':'.$p);}

static function mod($p,$o){
$r=msql::read_b('system','admin_modules','',1);//p($r);
$rh=msql::read_b('lang','admin_modules','',1);
$rb=msql::read_b('',nod('test_1')); $ret=[];
$t=divc('txtcadr',count($r).' modules');
foreach($r as $k=>$v){
	$rid=normalize('prm'.$k); $j='popup_test,playmod_'.$rid.'_3_'.ajx($k);
	$ret[]=[$k,$rh[$k][0],inputj($rid,valr($rb,$k,0),$j),lj('',$j,picto('ok'))];}
return $t.tabler($ret);}

static function playconn($p,$o,$prm=[]){
$res=prm[0]??''; $t=divc('txtcadr',$res.':'.$p);
msql::modif('',nod('test_2'),[$res],'one','',$p);
return $t.conn::read('['.$res.':'.$p.']');}

static function conn($p,$o){
$r=msql::read_b('system','connectors_all','',1);
$rh=msql::read_b('lang','connectors_all','',1);
$rb=msql::read_b('',nod('test_2')); $i=0;
foreach($r as $k=>$v)if(substr($k,0,1)!=':' && !$v[1]){$tst=valr($rb,$k,0); $i++;
	if(!$tst)$tst=between($rh[$k][0],'[',':'); 
	$rid=normalize('prm'.$k); $j='popup_test,playconn_'.$rid.'__'.ajx($k);
	$ret[]=[$k,$rh[$k][0],inputj($rid,$tst,$j),lj('',$j,picto('ok'))];}
$t=divc('txtcadr',$i.' connectors');
return $t.tabler($ret);}

static function matchres($p,$o,$prm=[]){
$d=prm[0]??''; $o=strpos($d,' ')?' IN BOOLEAN MODE':'';
$sql='select pub_art.id,MATCH (msg) AGAINST ("'.$d.'"'.$o.') as score from pub_art inner join pub_txt on pub_txt.id=pub_art.id where day>'.timeago(90).' and day<'.ses('dayx').' and nod="newsnet" and substring(frm,1,1)!="_" and re>0 and MATCH (msg) AGAINST ("'.$d.'"'.$o.') order by score DESC';
$r=sql::call($sql,''); //pr($r);
return tabler($r);}

static function match($p,$rid){
$j=$rid.'_test,matchres_search_3_test_'.$rid;
$ret=inputj('search','',$j,'word').' ';
$ret.=lj('',$j,picto('ok'));
return $ret;}

static function searchapp($p,$rid,$prm=[]){
$d=$prm[0]??''; $ret='';
$ra=scandir_r('plug'); $rb=scandir_r('progb'); $r=array_merge($ra,$rb);
foreach($r as $k=>$v)if(strpos($v,$d))$ret.=divb($v);
return $ret?$ret:'no';}

static function search($p,$rid){
$j='srap_test,searchapp_search_3__'.$rid;
$ret=inputj('search','',$j,'app').' ';
$ret.=lj('',$j,picto('ok'));
return $ret.divb('','','srap');}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if($p=='mod')return self::mod($p,$o);
if($p=='conn')return self::conn($p,$o);
if($p=='match')return self::match($p,$o);
if($p=='search')return self::search($p,$o);
if($p=='backup')return backup::home('','');
if($p=='backupim')return backupim::home('','');
if($p=='backupmsql')return msqa::backup_msql('');
if($p=='reduceim')return reduceim::home($p,$o);}

static function menu($p,$o,$rid){
$ret=lj('txtx',$rid.'_test,call__3_mod','modules').' ';
$ret.=lj('txtx',$rid.'_test,call__3_conn','connectors').' ';
$ret.=lj('txtx',$rid.'_test,call__3_match_'.$rid,'match').' ';
$ret.=lj('txtx',$rid.'_test,call__3_search_'.$rid,'search app').' ';
$ret.=lj('txtx',$rid.'_test,call__3_backup_'.$rid,'backup').' ';
$ret.=lj('txtx',$rid.'_test,call__3_backupim_'.$rid,'backupim').' ';
$ret.=lj('txtx',$rid.'_test,call__3_backupmsql_'.$rid,'backupmsql').' ';
$ret.=lj('txtx',$rid.'_test,call__3_reduceim_'.$rid,'reduceim').' ';
$cols='type,app,p,o';//create table, name cols
$ret.=lj('','popup_msqedit,test*1___'.$cols,picto('edit')).' ';
return $ret;}

static function home($p,$o){$rid=randid('test');
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
$bt.=msqbt('',nod('test_1'));
return $bt.divd($rid,$ret);}
}
?>