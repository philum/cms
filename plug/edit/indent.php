<?php
//philum_plugin_indent

//
/*function newvar($v,$s,$e){static $nv;
$var=embed_detect($v,$s,$e);
if($var){$nv++; $nvar='v'.$nv;
	$rvn[]=$var; $rnv[]=$nvar;}
return array($var,$nvar);}

function clean_namefunc($d){
$r=explode("\n",$d);
foreach($r as $k=>$v){
	list($func,$nfunc)=newvar($v,'function ','(');
	//$v=str_replace($func,$nfunc,$v);
	$rf[$func.'(']=$nfunc.'(';
	list($var,$nvar)=newvar($v,'$','.');
	//$v=str_replace($var,$nvar,$v);
	$rv['$'.$var]='$'.$nvar;
	list($var,$nvar)=newvar($v,'$',',');
	$rv['$'.$var]='$'.$nvar;
	list($var,$nvar)=newvar($v,'$','=');
	$rv['$'.$var]='$'.$nvar;
$ret.=$v."\n";}
$ret=str_replace(array_keys($rf),$rf,$ret);
$ret=str_replace(array_keys($rv),$rv,$ret);
return $ret;}*/

//
function list_func($d){$r=explode("function ",$d); $rb=[];
foreach($r as $k=>$v){$pos=strpos($v,'(');
	if($pos!==false)$rb[substr($v,0,$pos).'(']='f'.$k.'(';}
return $rb;}

function list_vars($d){$r=explode("$",$d); $rb=[];
$ra=array(';','.',',','=','[',']',')','+','-','!','?','<','>','|','&','"',"'");
$no=array('_GET','_POST',' _SESSION','_SERVER');//,'_GLOBAL'
foreach($r as $k=>$v){$end=''; if(substr($v,0,1)!='_')
	foreach($ra as $ka=>$va){$e=strpos($v,$va); if($e!==false)$end[]=strpos($v,$va);}
	$pos=$end?min($end):'';
	if($pos)$var='$'.substr($v,0,$pos);
	if($pos && !$rb[$var]){$kb++; $rb[$var]='$v'.$kb;}}
return $rb;}

function php_cuts(){return [' ',',',';',':','!','?','!','.','*','/','=','+','<','>','(',')','[',']','{','}','|','&','"',"'","\n","\t","\r",'\\'];}

/*function code_parse($d){
$s=php_cuts();
$d=str_replace($s,$s[0],$v);
$r=explode($s[0],$v);
pr($r);
return $ret;}*/

function code_machine($d){
$func=list_func($d); arsort($func);//pr($func);
$d=str_replace(array_keys($func),array_values($func),$d);
$vars=list_vars($d); arsort($vars);//pr($vars);
$d=str_replace(array_keys($vars),array_values($vars),$d);
//$d=code_parse($d);
return $d;}

//
/*function clean_code($d){
$d=str_replace("\r","\n",$d);
$d=ereg_replace("[\n]{2,}","\n",$d);
$ara=array("  ",'( ',' (',' )',') ',' .',' .',' > ',' < ',' =','= '," \n","\n ","{\n","\n{","\n}",', ',' {',' }','{ ','} ','if (','else (','// ');
$arb=array("\t",'(','(',')',')','.','.','>','<','=','=',"\n","\n",'{','{','}',',','{','}','{','}','if(','else(','//');
$d=preg_replace('/( ){2,}/',' ',$d);
return str_replace($ara,$arb,$d);}*/

function code_cleanup($d){
if(substr(trim($d),0,2)=='//')return;
if(substr(trim($d),0,1)=='#')return;
$r=['(',')','[',']','{','}','||','!=','==','>=','<=','>','<','=','=>','->',',',"\t",'else','if'];//
foreach($r as $k=>$v)$d=str_replace(' '.$v,$v,$d);
foreach($r as $k=>$v)$d=str_replace($v.' ',$v,$d);
$r=[',',')',')'];
foreach($r as $k=>$v)$d=str_replace($v."\n",$v,$d);
//$d=str_replace([','."\n"],",",$d);
$d=preg_replace('/( ){2,}/',' ',$d);
//$d=str_replace("\t","",$d);
return $d."\n";}

function clean_accolade($d,$a){
$d=str_replace(["\n".$a,"\n\t".$a,' '.$a,$a.' '],$a,$d);
//$d=preg_replace("/(\n)|(\t){1,}$a/",$a,$d);
return $d;}

function indent_build($d){$r=explode("\n",$d); $ret='';
foreach($r as $k=>$v)$ret.=code_cleanup($v);
$ret=str_replace("\n ","\n",$ret);
$ret=str_replace("\t ","\t",$ret);
$ret=clean_accolade($ret,'{');
$ret=clean_accolade($ret,'}');
$ret=preg_replace("/(\n){2,}/","\n",$ret);
//if($o=='high')$ret=str_replace("\n"," ",$ret);//cause pb of //
return trim($ret);}

function indent_call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=indent_build($p,$o);
//$ret=clean_code($ret);
//$ret=clean_namefunc($ret);
//$ret=code_machine($ret);
//$ret=highlight_string($ret,true);
return $ret;}

function model_menu($p,$o,$rid){
$j=$rid.'_plug__2_indent_indent*call__'.$rid.'_inpind';
$ret=textarea('inpind',$p);
$ret.=lj('',$j,picto('ok'));
return $ret;}

function plug_indent($p,$o){
$rid=randid('ind');
$bt=model_menu($p,$o,$rid);
return $bt.div(atd($rid).atc('console').ats('white-space:pre-wrap;'),'');}//nowrap

?>