<?php
//philum_plugin_pray

function pray_arr(){$nb_users=7;
for($i=0;$i<10;$i++)for($ia=0;$ia<7;$ia++)$ret[$i][$ia]='usr:'.$i;
return $ret;}

function pray_clic($uid,$day,$act){$c=$act?'active':'';
return lj('minicon '.$c,ses('prayid').'_plug__2_pray_pray*sav_'.$uid.'_'.$day,$uid);}

function pray_arr_fill($r){
for($i=0;$i<7;$i++)$ret[$i]=$r[$i]?1:0;
return $ret;}

function pray_build($p,$o,$r=''){//uid,day,act
//$r=db_read('ummo/pray/1511');
if(!$r)$r=msql_read('','ummo_pray_1','','1'); //p($r);
if($r)foreach($r as $k=>$v)if($k!='_menus_')$ra[$v[0]][$v[1]]=$v[2]?1:0;
$rt=array('user/day',1,2,3,4,5,6,7);//headers
if($ra)foreach($ra as $k=>$v)$ra[$k]=pray_arr_fill($v);//fill empties
if($ra)foreach($ra as $k=>$v)foreach($v as $ka=>$va)$rb[$k][$ka]=pray_clic($k,$ka,$va); 
$ret=make_tables($rt,$rb,'txtblc','',1);
return $ret;}

function pray_sav($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); //echo $p.'-'.$o.'-'.$res;
//$r=db_read('ummo/pray/1511');
$r=msql_read('','ummo_pray_1','','');
if($r)foreach($r as $k=>$v)if($v[0]==$p && $v[1]==$o)$id=$k;
if($id)unset($r[$id]); else $r[]=array($p,$o,1);
msql_modif('users','ummo_pray_1',$r,$dfb,'arr','');
db_write('ummo/pray/1511',$r);
//if(!$id)modif_vars('users','ummo_pray_1',array($p,$o,1),'push');
//else modif_vars('users','ummo_pray_1',array($id=>array($p,$o,0)),'mdf');
$ret=pray_build($p,$o,$r);
return $ret;}

function pray_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); //echo $p.'-'.$o.'-'.$res;
$ret=pray_build($p,$o);
return $ret;}

function pray_log($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=pray_build($p,$o);
return $ret;}

function plug_pray($p,$o){
ses('prayid',$rid='plg'.randid());
header_add('csscode','
.minicon{display:inline-block; width:32px; height:32px; background:#eee; border:1px solid gray;}
.minicon.active {background:lightgreen; border:1px solid green;}
.minicon:hover{background:white;}
.minicon.active:hover {background:lightgreen; border:1px solid gray;}');
$bt=autoclic('inp','uid','8',25,'');//input(1,'inp',$p,'').' ';
$bt.=lj('',$rid.'_plug__2_pray_pray*log___inp',picto('reload')).br();
$ret.=pray_j($p,$o);
$bt.=msqlink('','ummo_pray_1');
return $bt.divd($rid,$ret);}

?>