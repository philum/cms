<?php
//philum_exec

function f_inp_insert($r){
if($r)foreach($r as $k=>$v){
	if($v=="<-")$vb='\n';else $vb=$v;
	$ret.=ljb("txtx","insert",$vb,$v).' ';}
return $ret;}

function strip_r($r){
foreach($r as $k=>$v){
	if(is_array($v))$ret[$k]=strip_r($v);
	else $ret[$k]=stripslashes($v);}
return $ret;}

function readfunc($d){
$r=msql_read('system','program_core',$d); unset($r['_menus_']);
$r=strip_r($r);
$ret=on2cols($r,340,7);
$stl=strlen($r['function']);
$vrs=substr($r['variables'],$stl+1,-1);
$ret.=input(1,'fprm',$vrs);
$ret.=ljb('txtbox','jumpMenuIns',$r['function'],'insert');
return $ret;}

function exc_lib(){
$rf=msql_read('system','program_core','',1);
$ref=array_keys_r($rf,0); asort($ref);
foreach($ref as $k=>$v){$ret.=lj('','popup_plup___exec_readfunc_'.$k,$v).br();}
return divs('width:180px; overflow:auto; height:240px;',$ret);}

function exc_fast(){$ref=array('{}','[]','if()','foreach($r as $k=>$v)','$ret=;','strpos($d,\'x\')!==false','return $ret;','.br()','echo \'ee\';',"\r");
foreach($ref as $k=>$v)$ret.=ljb('txtx','insert',($v),$v).br();
return divs('width:180px; overflow:auto; height:240px;',$ret);}

function exc_js(){echo js_code('function jumpMenuIns(fc){
	var vr=document.getElementById(\'fprm\').value;
	var lk=fc+\'(\'+vr+\')\';
	insert(lk);}');}

function exc_run($a,$b,$res){$d=ajxg($res);
if(!auth(6))return;
$f='plug/_data/exec.php?'.randid();
if(is_file($f))unlink($f);
if($d)write_file($f,'<?php '.$d);
if(is_file($f))require($f);}

function plug_exec(){exc_js(); $rid='plg'.randid();
$j=$rid.'_plug__2_exec_exc*run___txtarea'; $sj='SaveJ(\''.$j.'\')';
if($_SESSION["auth"]<6)$btn.=btn('txtalert','need auth>=7');
else{$btn.=lj('',$j,picto('reload')).' ';
	$btn.=lj('txtx',"popup_plup___exec_exc*lib","lib").' ';
	$btn.=lj('txtx',"popup_plup___exec_exc*fast","fast").' ';
	$btn.=msqlink('system','program_core').' ';
	$btn.=lj('txtx',"exec","x").' ';
	$btn.=lj('popsav',$j,'exec').br();}
$ret.=txarea('txtarea',$p,61,18,atc('console'));//atb('onkeyup',$sj)..atb('onclick',$sj)
return $btn.divc('row',$ret).div(atd($rid).atc('row'),'');}

?>