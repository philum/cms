<?php
//philum_app_clics

class clics{

/*
static function consolid_stats(){
$r=sql('substring(page,6)','qdv2','k','page LIKE "read=%" limit 0,10000'); //pr($r);
if($r)foreach($r as $k=>$v){if(is_numeric($k))$id=$k;
	else{$pos=strpos($k,'&'); if($pos!==false)$id=substr($k,0,$pos);}
$ret[$id]=array($id,$v);}
ksort($ret);
//$d=self::mysqlrb($ret,0); insert('qdcl',$d);//
return $ret;}

static function clic_stats($p){ses('qdcl',qd('clics'));
$r=sql('id,nb','qdcl','kv',''); //pr($r);
if(!$r){$db=plugin_func('install','install_db',ses('qd'));
	qr($db['clics']);
	$r=self::consolid_stats();}
pr($r);
}*/
//return self::clic_stats($p);

/*static function build_stats($p){
//if($p)$r=sql_inner('id,day,lu','qda','qdv2','index','mail LIKE "%'.$p.'%"'); //pr($r);
$sql='select '.ses('qda').' ,day,lu from '.ses('qda').' inner join '.ses('qdv').'  
on '.qd('qda').'.id like page '.$q;
//$rq=qr($sql);
pr($r);
}*/

static function build($p,$o){
//return self::build_stats($p);
if($p)$r=sql('id,day,lu','qda','index','mail LIKE "%'.$p.'%"'); //pr($r);
if($r)foreach($r as $k=>$v){$d=date('ym',$v[1]); $ra[$d][$k]=$v[2];}
if($ra)foreach($ra as $k=>$v){$rt=''; $tot=0;
foreach($v as $ka=>$va){
	$rt.=lkc('txtx',urlread($ka),$ka.' ('.$va.')').br(); $tot+=$va; $nb++;}
$ret.=divc('txtcadr',date('m/Y',$r[$ka][0]).' ('.$tot.' clics)').$rt; $bigtot+=$tot;}
if($nb)$av=$bigtot/$nb;
$ret.=divc('popw',$bigtot.' clics / '.$nb.' articles; Average:'.$av);
return $ret;}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $bt.$ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_app__3_clics_call___inp',picto('ok')).' ';
//$cols='ib,val,to';//create table, name cols
//$ret.=lj('','popup_plupin___msqedit_clics*1_'.$cols,picto('edit'));
return $ret;}

static function home($p,$o){$rid=randid('clics');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('clics_1'));
return $bt.divd($rid,$ret);}

}

function plug_clics($p,$o){
return clics::home($p,$o);}

?>