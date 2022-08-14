<?php //searchlang
class searchlang{
static function build($p,$o){
$r=sql('ref,lang','ynd','kv','txt like "%'.$p.'%"');
return $r;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??''; $ret='';
$_GET['search']=$p; $rb=[];
$r=self::build($p,$o);
if($r)foreach($r as $k=>$v)if(substr($k,0,3)=='art')$rb[substr($k,3)]=$v;
if($rb)$ret=ma::output_arts($rb,'','art'); else $ret='nothing';
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_searchlang,call_inp',picto('ok')).' ';
$ret.=hlpbt('searchlang');
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>