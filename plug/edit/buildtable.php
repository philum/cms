<?php 
class buildtable{

static function add_quotes($r){
foreach($r as $k=>$v)foreach($v as $ka=>$va)$r[$k][$ka]='"'.$va.'"';
return $r;}

static function bt_func($d){
//$d=codeline::parse($d,'','delconn');
if(strpos($d,'§'))$d=strto(strend($d,'§'),']');
$d=trim($d);
return $d;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p; $ret='';
$p=str_replace(['[',':table]'],'',$p);
if(strpos($p,'¬')===false)$p=str_replace("\n",'¬',$p);
$r=explode('¬',$p);
foreach($r as $k=>$v){$rb=explode('|',$v);
	foreach($rb as $ka=>$va)$rc[$k][$ka]='"'.self::bt_func($va).'"';}
foreach($rc as $k=>$v)if(is_array($v))$ret.='$r['.($k+1).']=['.implode(',',$v).'];'; return $ret;
//foreach($rc as $k=>$v)if(is_array($v))$ret.=($k+1).'=>['.implode(',',$v).']';
return '$r=['.$ret.']';}

static function jb($p,$o,$prm=[]){
$p=$prm[0]??$p; $ret=''; $p=trim($p); $rt=[];
$p=str_replace(['[',']'],'',$p); $r=explode("\n",$p);
foreach($r as $k=>$v){$rb=explode('=>',$v); $rt[trim($rb[0])]=trim($rb[1]);}
return eco(msql::dump($rt),1);}

static function menu($p,$o,$rid){//$ret.=input('inp',$p,'').' ';
$ret.=lj('',$rid.'_buildtable,call_inp_2',picto('ok')).br();
$ret.=textarea('inp',$p,54,18);
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>