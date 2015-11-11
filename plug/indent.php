<?php
//philum_plugin_indent
session_start();

//
function countchars_b($v){
foreach(count_chars($v,1) as $i=>$val){$res+=$val;} //chr($i)
return $res;}
function embed_detect_b($v,$s,$e){ 
if($v && $s)$posa=strpos($v,$s);
if($posa!==false){$posa+=countchars_b($s); if($e)$posb=strpos($v,$e,$posa);}
if($posb!==false)$ret=substr($v,$posa,$posb-$posa);
elseif(!$e)$ret=substr($v,$posa);
return $ret;}

function code_cleanup($v){
if(substr(trim($v),0,2)=='//')return;
if(substr(trim($v),0,1)=='#')return;
$ra=array('( ',' )',' || ',' != ',' == ',' >= ',' <= ',' > ',' < ',' = ',' => ',', ','    ','else if','if ');
$rb=array('(',')','||','!=','==','>=','<=','>','<','=','=>',',',"\t",'elseif','if');
$ret=str_replace($ra,$rb,$v);
$ret=ereg_replace("[ ]{2,}"," ",$ret);
return $ret."\n";}

function code_eradic($v){
$v=code_cleanup($v);
$ret=str_replace("\t","",$v);
return $ret;}

function clean_accolade($ret,$a){
$ret=ereg_replace("\n$a",$a,$ret);
$ret=ereg_replace("\n\t$a",$a,$ret);
$ret=ereg_replace("\n[\t]{1,}$a",$a,$ret);
return $ret;}

function indent($d){$r=explode("\n",$d);
$o='high';$o='low';
foreach($r as $k=>$v)
	if($o=='low')$ret.=code_cleanup($v);
	elseif($o=='high')$ret.=code_eradic($v);
$ret=str_replace("\n ","\n",$ret);
$ret=str_replace("\t ","\t",$ret);
$ret=clean_accolade($ret,'{');
$ret=clean_accolade($ret,'}');
$ret=ereg_replace("[\n]{1,}","\n",$ret);
//if($o=='high')$ret=str_replace("\n"," ",$ret);//cause pb of //
return $ret;}

//
/*function newvar($v,$s,$e){static $nv;
$var=embed_detect_b($v,$s,$e);
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
function list_func($d){$r=explode("function ",$d);
foreach($r as $k=>$v){$pos=strpos($v,'(');
	if($pos!==false)$ret[substr($v,0,$pos).'(']='f'.$k.'(';}
return $ret;}

function list_vars($d){$r=explode("$",$d);
$ra=array(';','.',',','=','[',']',')','+','-','!','?','<','>','|','&','"',"'");
$no=array('_GET','_POST',' _SESSION','_SERVER');//,'_GLOBAL'
foreach($r as $k=>$v){$end=''; if(substr($v,0,1)!='_')
	foreach($ra as $ka=>$va){$e=strpos($v,$va); if($e!==false)$end[]=strpos($v,$va);}
	$pos=$end?min($end):'';
	if($pos)$var='$'.substr($v,0,$pos);
	if($pos && !$ret[$var]){$kb++; $ret[$var]='$v'.$kb;}}
return $ret;}

function php_cuts(){return array(' ',',',';',':','!','?','!','.','*','/','=','+','<','>','(',')','[',']','{','}','|','&','"',"'","\n","\t","\r",'\\');}

function code_parse($d){
$s=php_cuts();
$d=str_replace($s,$s[0],$v);
$r=explode($s[0],$v);
pr($r);
return $ret;}

function code_machine($d){
$func=list_func($d); //pr($func);
arsort($func);
$d=str_replace(array_keys($func),array_values($func),$d);
$vars=list_vars($d); //pr($vars);
arsort($vars);
$d=str_replace(array_keys($vars),array_values($vars),$d);
////$d=code_parse($d);
return $d;}

//
/*function clean_code($d){
$d=str_replace("\r","\n",$d);
$d=ereg_replace("[\n]{2,}","\n",$d);
$ara=array("  ",'( ',' (',' )',') ',' .',' .',' > ',' < ',' =','= '," \n","\n ","{\n","\n{","\n}",', ',' {',' }','{ ','} ','if (','else (','// ');
$arb=array("\t",'(','(',')',')','.','.','>','<','=','=',"\n","\n",'{','{','}',',','{','}','{','}','if(','else(','//');
$d=ereg_replace("[ ]{2,}"," ",$d);
return str_replace($ara,$arb,$d);}*/

function plug_indent($p,$o){
$f='tar/'.$p.'.php';
$f='tar/pcltar.lib.php3'; $fb='tar_light/pcltar.lib.php3';
//$f='lib.php'; $fb='lib2.php';
$ret=read_file($f);
$ret=indent($ret);
//$ret=clean_code($ret);
//$ret=clean_namefunc($ret);
//$ret=code_machine($ret);
//write_file($fb,$ret);
$ret=highlight_string($ret,true);
//$ret=htmlentities($ret);
//$ret='<pre>'.$ret.'</pre>';
//$ret='<code>'.$ret.'</code>';
//$ret=txarea('',$ret,80,20);
return $ret;}

?>