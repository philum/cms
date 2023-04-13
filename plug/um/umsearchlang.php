<?php 
class umsearchlang{
static function build($p,$o){
$r=sql('ref,lang','ynd','kv','txt like "%'.$p.'%"');
return $r;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p; $ret='';
get('search',$p); $r=[]; $rb=[];
if($p)$r=self::build($p,$o);
if($r)foreach($r as $k=>$v)if(substr($k,0,3)=='art')$rb[substr($k,3)]=$v;
//if($rb)$ret=ma::output_arts($rb,'','art'); else $ret='nothing';
$cats=umrec::$cats;
if($rb)foreach($rb as $k=>$v){
	$frm=sql('frm','qda','v','id='.$k);
	if(in_array($frm,$cats))
		//$ret.=umcom::home($k,'');
		$ret.=divd('umrec'.$k,umrec::call($k,''));
}
return $ret?$ret:'nothing';}

static function menu($p,$o,$rid){
$j=$rid.'_umsearchlang,call_inp';
$ret=inputj('inp',$p,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=hlpbt('umsearchlang');
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid); $ret='';
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>