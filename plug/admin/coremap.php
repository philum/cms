<?php
//philum_plugin_model

function cm_open($d){return 
lj('','popup_plupin__3_codeview_progb__'.ajx($d),$d);}

function make_div_r($r){
if(is_array($r))foreach($r as $k=>$v)
$ret.=divc('track',cm_open($k).(is_array($v)?make_div_r($v):''));
return ($ret);}

function cm_orph($r,$p){
foreach($r as $v)if(!$ra=cm_parents($v))$ret[$v]=1;
return $ret;}

function cm_parents($p){
$sql='select name from _sys where func like "%='.$p.'(%" or  func like "%.'.$p.'(%" or  func like "%('.$p.'(%" or  func like "\n'.$p.'(%"'; 
$r=sql_b($sql,'k');
return $r;}

function cm_parents_r($p){$r=cm_parents($p);
if($r)foreach($r as $k=>$v)$r[$k]=cm_parents($k);
return $r;}

function core_map($r,$p){
$d=sql_b('select func from _sys where name="'.$p.'"','v'); //echo hr().$p.'-'.$d;
foreach($r as $va)if($va!=$p)if($n=substr_count($d,$va.'('))$ret[$va]=$n; //p($ret);
if($ret)foreach($ret as $k=>$v)$ret[$k]=core_map($r,$k);
return $ret;}

//p(get_defined_functions());
function coremap($p='',$o='',$res=''){
list($p,$o)=ajxp($res,$p,$o);
$r=sql_b('select name from _sys','rv'); //p($r);
if(!$r or !$p)return;
$ra=core_map($r,$p); //pr($ra);
$rb=cm_parents_r($p); //pr($rb);
//$rc=cm_orph($r,$p); p($rc);
$n=count($ra); $ret.=divc('txtcadr',$p.': '.$n.' dependencie'.($n>1?'s':''));
$ret.=make_div_r($ra).br(); 
$n=count($rb); $ret.=divc('txtcadr',$p.': '.$n.' parent'.($n>1?'s':''));
$ret.=make_div_r($rb);
return $ret;}

function plug_coremap($p='',$o=''){$rid='plg'.randid();
$ret.=autoclic($rid.'p',$p,10,244,'',1).' ';
$ret.=lj('',$rid.'_plug___coremap_coremap___'.$rid.'p',picto('reload'));
return $ret.divd($rid,coremap($p));}

?>