<?php //pray
class pray{

static function css(){return '
.minicon{display:inline-block; width:32px; height:32px; background:#eee; border:1px solid gray;}
.minicon.active {background:lightgreen; border:1px solid green;}
.minicon:hover{background:white;}
.minicon.active:hover {background:lightgreen; border:1px solid gray;}';}

static function pray_arr(){$nb_users=7;
for($i=0;$i<10;$i++)for($ia=0;$ia<7;$ia++)$ret[$i][$ia]='usr:'.$i;
return $ret;}

static function clic($uid,$day,$act){$c=$act?'active':'';
return lj('minicon '.$c,ses('prayid').'_pray,sav___'.$uid.'_'.$day,$uid);}

static function arr_fill($r){
for($i=0;$i<7;$i++)$ret[$i]=$r[$i]?1:0;
return $ret;}

static function build($p,$o,$r=''){//uid,day,act
$ra=[]; $rb=[]; $rt=[];
//$r=db_read('ummo/pray/1511');
if(!$r)$r=msql::read('','ummo_pray_1','','1'); //p($r);
if($r)foreach($r as $k=>$v)if($k!='_menus_')$ra[$v[0]][$v[1]]=$v[2]?1:0;
$rt=['user/day',1,2,3,4,5,6,7];//headers
if($ra)foreach($ra as $k=>$v)$ra[$k]=self::arr_fill($v);//fill empties
if($ra)foreach($ra as $k=>$v)foreach($v as $ka=>$va)$rb[$k][$ka]=self::clic($k,$ka,$va);
array_unshift($rb,$rt);
$ret=tabler($rb,1);
return $ret;}

static function sav($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$r=msql::read('','ummo_pray_1','','');
if($r)foreach($r as $k=>$v)if($v[0]==$p && $v[1]==$o)$id=$k;
if($id)unset($r[$id]); else $r[]=[$p,$o,1];
msql::modif('users','ummo_pray_1',$r,'arr',[],'');
json::write('ummo','pray/'.$p,$r);
//if(!$id)msql::modif('','ummo_pray_1',[$p,$o,1],'push');
//else msql::modif('','ummo_pray_1',[$id=>[$p,$o,0]],'mdf');
$ret=self::build($p,$o,$r);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function home($p,$o){
ses('prayid',$rid='plg'.randid());
Head::add('csscode',self::css());
$bt=inputb('inp','','15','uid',100,[]);
$bt.=lj('',$rid.'_pray,call_inp',picto('ok')).br();
$ret=self::call($p,$o);
$bt.=msqbt('','ummo_pray_1');
return $bt.divd($rid,$ret);}
}
?>