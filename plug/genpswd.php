<?php
//philum_plugin_genpswd

//$ra=array('de','la','et','les','le','nbsp','des','en','du','que','qui','un','pour','dans','une','par','est','pas','sur','plus','au','ne','se','http','com','www','me','on','il','ont','où','aux','nous','sont','cette','mais','leur','newsnet','on','and','ces','','');
function killbadwords($r){
$ra=array('nbsp','pour','dans','http','nous','sont','cette','mais','leur','newsnet');
foreach($r as $k=>$v)if(strlen($v)<4 or in_array($v,$ra) or strpos($v,"'"))unset($r[$k]);
return $r;}

function gp_signs(){
$r=array('$','^','§',':','(',')','[',']','{','}','°','+','-','/','*'); $n=count($r);
return $r[rand(0,$n)];}

function addwords($d,$ret){
$r=str_word_count($d,1);
$r=killbadwords($r);
foreach($r as $k=>$v)$ret[$v]+=1;
arsort($ret); //p($ret);
return $ret;}

function natwords(){
$r=sql_inner('msg','qdm','qda','id','vr',' '.ses('qda').'.day>"'.calc_date(1).'"');

foreach($r as $k=>$v)$ra=addwords($v,$ra); //p($ra);
$ra=array_flip($ra);
return $ra;}

function genpswd_build($p,$o){
$r=natwords(); $n=count($r); 
if(is_numeric($p))$pn=$p/4; else $pn=4;
for($i=0;$i<$pn;$i++){$na=rand(0,$n); $ret.=ucfirst($r[$na]).gp_signs().$na;}
if($o)$ret=md5($ret);
if(is_numeric($p))$ret=substr($ret,0,$p);
return $ret;}

function genpswd_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=genpswd_build($p,$o);
return $ret;}

function genpswd_menu($p,$o,$rid){
$ret.=input(1,'inp','limit','',1,'limit').' '.checkbox_j('opt',$o,'md5').' ';
$ret.=lj('',$rid.'_plug__2_genpswd_genpswd*j___inp|opt',picto('reload')).' ';
return $ret;}

function plug_genpswd($p,$o){$rid='plg'.randid();
$bt=genpswd_menu($p,$o,$rid); $ret=genpswd_j($p,$o);
return $bt.divd($rid,$ret);}

?>