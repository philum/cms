<?php
//philum_plugin_pray

function pray_arr(){$nb_users=7;
for($i=0;$i<10;$i++)for($ia=0;$ia<7;$ia++)$ret[$i][$ia]='usr:'.$i;
return $ret;}

function pray_add($p,$o){
if($ret)modif_vars('users',ses('qb').'_pray_1',array($p,$o,1),'push');
}

function pray_clic($act,$uid,$day){
$c=$act?'active':'';
return lj('minicon '.$c,prayid.'_plug__2_pray_pray*j___'.$uid.'_'.$day,$uid);
}

function pray_arr_fill($r){$na=count($r); $nb=7-$na;
$rb=array_fill($na,$nb,''); //p($r); p($rb);
$ret=array_merge($r,$rb); //p($ret); echo hr();
return $ret;}

function pray_build($p,$o){
$r=msql_read('',ses('qb').'_pray_1','','1'); //pr($r);
//$r=pray_arr(); //p($r);
//transpose
if($r)foreach($r as $k=>$v)$ra[$v[0]][$v[1]]=$v[2]?$v[2]:'0'; //pr($ra);
//headers
//$rt=array_keys($ra[key($ra)]); $rt=pray_arr_fill($rt);
//array_unshift($rt,'user/day'); //pr($rt);
$rt=array('user/day',1,2,3,4,5,6,7);
//fill empties
if($ra)foreach($ra as $k=>$v)$ra[$k]=pray_arr_fill($v);
//buttons
if($ra)foreach($ra as $k=>$v)foreach($v as $ka=>$va)$rb[$k][$ka]=pray_clic($va,$k,$ka); //p($rb);
//render
$ret=make_tables($rt,$rb,'txtblc','',1);
return $ret;}

function pray_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); //echo $p.'-'.$o.'-'.$res;
$ret=pray_build($p,$o);
return $ret;}

function pray_log($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); //echo $p.'-'.$o.'-'.$res;
$ret=pray_build($p,$o);
return $ret;}

function plug_pray($p,$o){
define('prayid',$rid='plg'.randid());
header_add('csscode','
.minicon{display:inline-block; width:32px; height:32px; background:#eee; border:1px solid gray;}
.minicon.active {background:lightgreen; border:1px solid green;}
.minicon:hover{background:white;}
.minicon.active:hover {background:lightgreen; border:1px solid gray;}');
$ret.=autoclic('inp','uid','8',25,'');//input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_pray_pray*log___inp',picto('reload')).br();
$ret.=pray_j($p,$o);
$bt.=msqlink('',ses('qb').'_pray_1');
return $bt.divd($rid,$ret);}

?>