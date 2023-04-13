<?php //exec

class exec{
static function form_insert($r){
if($r)foreach($r as $k=>$v){
	if($v=="<-")$vb='\n';else $vb=$v;
	$ret.=ljb('txtx','insert',$vb,$v).' ';}
return $ret;}

static function strip_r($r){
foreach($r as $k=>$v){
	if(is_array($v))$ret[$k]=self::strip_r($v);
	else $ret[$k]=stripslashes($v);}
return $ret;}

static function readfunc($d){
$r=msql::read('system','program_core',$d,1);
$r=self::strip_r($r);
$ret=on2cols($r,340,7);
$stl=strlen($r['function']);
$vrs=substr($r['variables'],$stl+1,-1);
$ret.=input('fprm',$vrs);
$ret.=ljb('txtbox','jumpMenuIns',$r['function'],'insert');
return $ret;}

static function lib(){$ret='';
$r=msql::read('system','program_core','',1);
$rb=msql::sort($r,0);
foreach($rb as $k=>$v)
	$ret.=ljb('','insert_b',[$v[0].'('.$v[1].');','codarea'],$v[0].'('.$v[1].')');
return divc('list',$ret);}

static function fast(){$ref=['function done(){}','{}','[]','if()','foreach($r as $k=>$v)','$ret=;','strpos($d,\'x\')!==false','return $ret;','.br()','echo \'ee\';',"\r"]; $ret='';
foreach($ref as $k=>$v)$ret.=ljb('txtx','insert',[$v,'codarea'],$v);
return divc('list',$ret);}

static function js(){return 'function jumpMenuIns(fc){
	var vr=document.getElementById(\'fprm\').value;
	var lk=fc+\'(\'+vr+\')\';
	insert_b(lk,\'codarea\');}';}

static function run($a,$b,$prm){[$d]=$prm;
if(!auth(6))return;
//if(hostname()!='86.49.245.213.rev.sfr.net')return;
$f='_datas/exec/'.date('ymd').'.php'; mkdir_r($f);
if(is_file($f))unlink($f);
//$d=str_replace(['sql(','rq('],'',$d);
if($d)write_file($f,'<?php '.$d);
if(is_file($f))require($f);
//if(!$ret)$ret='nothing';
return isset($ret)?$ret:'';}

static function home($p){$rid='plg'.randid();
if(!auth(6))return btn('txtalert','need auth>6');
//Head::add('jscode',self::js());
$j=$rid.'_exec,run_codarea_2';
$f='_datas/exec/'.date('ymd').'.php'; mkdir_r($f);
if(!$p && is_file($f)){$p=read_file($f); if($p)$p=substr($p,6);}
$bt=lj('',$j,picto('ok')).' ';
$bt.=lj('txtx','popup_exec,lib','lib').' ';
$bt.=lj('txtx','popup_exec,fast','fast').' ';
//$bt.=select($r,'');
$bt.=msqbt('system','program_core').' ';
//$bt.=lj('txtx',"exec","x").' ';
$bt.=lj('popsav',$j,'exec').br();
$ret=jscode(self::js());
$sj=atjr('SaveJtim',[$j,1000]); //$onk=atjr('autocomp','codarea');
$ret.=textarea('codarea',$p?$p:'$ret=\'hello\';',44,32,['class'=>'console','onclick'=>$sj,'onkeyup'=>$sj]);
return $bt.div(atc('grid-pad').ats('min-width:640px'),divc('col1',$ret).div(atd($rid).atc('col2 scroll'),''));}
}
?>