<?php //model
class coremap{
static function cm_open($d){return 
lj('','popup_plugin__3_codeview_progb__'.ajx($d),$d);}

static function make_div_r($r){$ret='';
if(is_array($r))foreach($r as $k=>$v)
$ret.=divc('track',self::cm_open($k).(is_array($v)?self::make_div_r($v):''));
return $ret;}

static function cm_orph($r,$p){
foreach($r as $v)if(!$ra=self::cm_parents($v))$ret[$v]=1;
return $ret;}

static function cm_parents($p){
$sql='select name from _sys where func like "%='.$p.'(%" or  func like "%.'.$p.'(%" or  func like "%('.$p.'(%" or  func like "\n'.$p.'(%"'; 
$r=sql::call($sql,'k');
return $r;}

static function cm_parents_r($p){$r=self::cm_parents($p);
if($r)foreach($r as $k=>$v)$r[$k]=self::cm_parents($k);
return $r;}

static function core_map($r,$p){$ret=[];
$d=sql::call('select func from _sys where name="'.$p.'"','v'); //echo hr().$p.'-'.$d;
foreach($r as $va)if($va!=$p)if($n=substr_count($d,$va.'('))$ret[$va]=$n; //p($ret);
if($ret)foreach($ret as $k=>$v)$ret[$k]=self::core_map($r,$k);
return $ret;}

//p(get_defined_static functions());
static function map($p='',$o='',$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$r=sql::call('select name from _sys','rv'); //p($r);
if(!$r or !$p)return;
$ra=self::core_map($r,$p); //pr($ra);
$rb=self::cm_parents_r($p); //pr($rb);
//$rc=self::cm_orph($r,$p); p($rc);
$n=count($ra); $ret=divc('txtcadr',$p.': '.$n.' dependencie'.($n>1?'s':''));
$ret.=self::make_div_r($ra).br(); 
$n=count($rb); $ret.=divc('txtcadr',$p.': '.$n.' parent'.($n>1?'s':''));
$ret.=self::make_div_r($rb);
return $ret;}

static function home($p='',$o=''){$rid='plg'.randid();
$ret=inputb($rid.'p',$p,10,'',244,[]);
$ret.=lj('',$rid.'_coremap,map___'.$rid.'p',picto('ok'));
return $ret.divd($rid,self::map($p));}
}
?>