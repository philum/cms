<?php
//philum_app_test

class test{

static function playmod($p,$o,$res=''){
req('pop,art,mod,spe');//list($m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr,$dv,$pv)
$res=ajxg($res); $r=explode('/',$res); $t=divc('txtcadr',$p);
msql::modif('',nod('test_1'),$r,'one','',$p);
return $t.build_mod_r($res.':'.$p);}

static function mod($p,$o){
$r=msql::read_b('system','admin_modules','',1);//p($r);
$rh=msql::read_b('lang','admin_modules','',1);
$rb=msql::read_b('',nod('test_1')); $ret=[];
$t=divc('txtcadr',count($r).' modules');
foreach($r as $k=>$v){
	$rid=normalize('prm'.$k); $j='popup_app__3_test_playmod_'.ajx($k).'__'.$rid;
	$ret[]=[$k,$rh[$k][0],inputj($rid,valr($rb,$k,0),$j),lj('',$j,picto('ok'))];}
return $t.tabler($ret);}

static function playconn($p,$o,$res=''){
req('pop,art,mod,spe'); $res=ajxg($res); $t=divc('txtcadr',$res.':'.$p);
msql::modif('',nod('test_2'),[$res],'one','',$p);
return $t.conn::read('['.$res.':'.$p.']');}

static function conn($p,$o){
$r=msql::read_b('system','connectors_all','',1);
$rh=msql::read_b('lang','connectors_all','',1);
$rb=msql::read_b('',nod('test_2')); $i=0;
foreach($r as $k=>$v)if(substr($k,0,1)!=':' && !$v[1]){$tst=valr($rb,$k,0); $i++;
	if(!$tst)$tst=embed_detect($rh[$k][0],'[',':'); 
	$rid=normalize('prm'.$k); $j='popup_app___test_playconn_'.ajx($k).'__'.$rid;
	$ret[]=[$k,$rh[$k][0],inputj($rid,$tst,$j),lj('',$j,picto('ok'))];}
$t=divc('txtcadr',$i.' connectors');
return $t.tabler($ret);}

static function matchres($p,$o,$res=''){
$d=ajxg($res); $o=strpos($d,' ')?' IN BOOLEAN MODE':'';
$sql='select pub_art.id,MATCH (msg) AGAINST ("'.$d.'"'.$o.') as score from pub_art inner join pub_txt on pub_txt.id=pub_art.id where day>'.calc_date(90).' and day<'.ses('dayx').' and nod="newsnet" and substring(frm,1,1)!="_" and re>0 and MATCH (msg) AGAINST ("'.$d.'"'.$o.') order by score DESC';
$r=sql_b($sql,''); //pr($r);
return tabler($r);}

static function match($p,$rid){
$j=$rid.'_app__3_test_matchres__'.$rid.'_search';
$ret=inputj('search','word',$j,'',1).' ';
$ret.=lj('',$j,picto('ok'));
return $ret;}

static function searchapp($p,$rid,$res=''){
$d=ajxg($res); $r=scandir_r('plug'); $ret='';
foreach($r as $k=>$v)if(strpos($v,$d))$ret.=divb($v);
return $ret?$ret:'no';}

static function search($p,$rid){
$j='srap_app__3_test_searchapp__'.$rid.'_search';
$ret=inputj('search','app',$j,'',1).' ';
$ret.=lj('',$j,picto('ok'));
return $ret.divb('','','srap');}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
if($p=='mod')return self::mod($p,$o);
if($p=='conn')return self::conn($p,$o);
if($p=='match')return self::match($p,$o);
if($p=='search')return self::search($p,$o);
if($p=='backup')return plugin('backup','');
if($p=='backupim')return plugin('backupim');
if($p=='backupmsql')return plugin('backup_msql');
if($p=='reduceim')return reduceim::home($p,$o);}

static function menu($p,$o,$rid){
$ret=lj('txtx',$rid.'_app__3_test_call_mod','modules').' ';
$ret.=lj('txtx',$rid.'_app__3_test_call_conn','connectors').' ';
$ret.=lj('txtx',$rid.'_app__3_test_call_match_'.$rid,'match').' ';
$ret.=lj('txtx',$rid.'_app__3_test_call_search_'.$rid,'search app').' ';
$ret.=lj('txtx',$rid.'_app__3_test_call_backup_'.$rid,'backup').' ';
$ret.=lj('txtx',$rid.'_app__3_test_call_backupim_'.$rid,'backupim').' ';
$ret.=lj('txtx',$rid.'_app__3_test_call_backupmsql_'.$rid,'backupmsql').' ';
$ret.=lj('txtx',$rid.'_app__3_test_call_reduceim_'.$rid,'reduceim').' ';
$cols='type,app,p,o';//create table, name cols
$ret.=lj('','popup_plupin___msqedit_test*1_'.$cols,picto('edit')).' ';
return $ret;}

static function home($p,$o){$rid=randid('test');
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
$bt.=msqbt('',nod('test_1'));
return $bt.divd($rid,$ret);}
}

function plug_test($p,$o){
return test::home($p,$o);}

?>