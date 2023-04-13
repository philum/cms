<?php 
class msqmerge{
//conjoint à msqarts, qui fabrique des tables par catégories

static function msg($d){
$d=str_replace('&nbsp;',' ',$d);
$r=explode(' ',$d);
foreach($r as $k=>$v){if(substr($v,0,1)!='@')$ret.=$v;
	if(substr($v,-1)!="\n")$ret.=' ';}
return $ret;}

static function merge($r,$d){$d=strend($d,'_');
if($r)foreach($r as $k=>$v){$dy=substr($v[1],0,6); 
$msg=$v[2]; 
$msg=delconn($msg);
$msg=self::msg($msg); //echo 'eee';
//$msg=miniconn($msg);
//$msg=embed_links($msg);
//$msg=conn::read($msg,'','');
$msg=codeline::parse($msg,'','sconn');
$msg=nl2br($msg);
$ret[$v[0]]=array($d,lka($v[0],$dy),$msg,lka($v[3],picto('tw')));}
return $ret;}

static function build($p,$o){
$r=explode(',',$p); $ra=array();
if($r && $p)foreach($r as $k=>$v){//echo $v;
$r=msql::read('',$v);//pr($r);
if($r)$ra+=self::merge($r,$v);}
ksort($ra);
return tabler($ra);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function default(){
return 'ummo_arts_Oaxiiboo6,ummo_arts_OolgaWaam,ummo_arts_OomoToa,ummo_arts_OyagaaAyooYissaa';}

static function menu($p,$o,$rid){
$p=$p?$p:self::default();
$ret=input('inp',$p,'').' ';
$ret.=lj('',$rid.'_msqmerge,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid(); 
$bt=self::menu($p,$o,$rid); $ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>