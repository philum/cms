<?php 
class indent{

/*function newvar($v,$s,$e){static $nv;
$var=between($v,$s,$e);
if($var){$nv++; $nvar='v'.$nv;
	$rvn[]=$var; $rnv[]=$nvar;}
return [$var,$nvar];}

function clean_namefunc($d){
$r=explode("\n",$d);
foreach($r as $k=>$v){
	[$func,$nfunc]=self::newvar($v,'function ','(');
	//$v=str_replace($func,$nfunc,$v);
	$rf[$func.'(']=$nfunc.'(';
	[$var,$nvar]=self::newvar($v,'$','.');
	//$v=str_replace($var,$nvar,$v);
	$rv['$'.$var]='$'.$nvar;
	[$var,$nvar]=self::newvar($v,'$',',');
	$rv['$'.$var]='$'.$nvar;
	[$var,$nvar]=self::newvar($v,'$','=');
	$rv['$'.$var]='$'.$nvar;
$ret.=$v."\n";}
$ret=str_replace(array_keys($rf),$rf,$ret);
$ret=str_replace(array_keys($rv),$rv,$ret);
return $ret;}*/

//
static function list_func($d){$r=explode("function ",$d); $rb=[];
foreach($r as $k=>$v){$pos=strpos($v,'(');
	if($pos!==false)$rb[substr($v,0,$pos).'(']='f'.$k.'(';}
return $rb;}

static function list_vars($d){$r=explode("$",$d); $rb=[];
$ra=array(';','.',',','=','[',']',')','+','-','!','?','<','>','|','&','"',"'");
$no=['_GET','_POST',' _SESSION','_SERVER'];//,'_GLOBAL'
foreach($r as $k=>$v){$end=''; if(substr($v,0,1)!='_')
	foreach($ra as $ka=>$va){$e=strpos($v,$va); if($e!==false)$end[]=strpos($v,$va);}
	$pos=$end?min($end):'';
	if($pos)$var='$'.substr($v,0,$pos);
	if($pos && !$rb[$var]){$kb++; $rb[$var]='$v'.$kb;}}
return $rb;}

static function php_cuts(){return [' ',',',';',':','!','?','!','.','*','/','=','+','<','>','(',')','[',']','{','}','|','&','"',"'","\n","\t","\r",'\\'];}

/*static function code_parse($d){
$s=self::php_cuts();
$d=str_replace($s,$s[0],$v);
$r=explode($s[0],$v);
pr($r);
return $ret;}*/

static function code_machine($d){
$func=self::list_func($d); arsort($func);//pr($func);
$d=str_replace(array_keys($func),array_values($func),$d);
$vars=self::list_vars($d); arsort($vars);//pr($vars);
$d=str_replace(array_keys($vars),array_values($vars),$d);
//$d=self::code_parse($d);
return $d;}

//
/*static function clean_code($d){
$d=str_replace("\r","\n",$d);
$d=ereg_replace("[\n]{2,}","\n",$d);
$ara=array("  ",'( ',' (',' )',') ',' .',' .',' > ',' < ',' =','= '," \n","\n ","{\n","\n{","\n}",', ',' {',' }','{ ','} ','if (','else (','// ');
$arb=array("\t",'(','(',')',')','.','.','>','<','=','=',"\n","\n",'{','{','}',',','{','}','{','}','if(','else(','//');
$d=preg_replace('/( ){2,}/',' ',$d);
return str_replace($ara,$arb,$d);}*/

static function code_cleanup($d){
if(substr(trim($d),0,2)=='//')return;
if(substr(trim($d),0,1)=='#')return;
$r=['(',')','[',']','{','}','||','!=','==','>=','<=','>','<','=','=>','->',',',';','::',':','?','+','-','*','/',"\t",'else','if'];//
foreach($r as $k=>$v)$d=str_replace(' '.$v,$v,$d);
foreach($r as $k=>$v)$d=str_replace($v.' ',$v,$d);
$r=[',',')',')'];
foreach($r as $k=>$v)$d=str_replace($v."\n",$v,$d);
//$d=str_replace([','."\n"],",",$d);
$d=preg_replace('/( ){2,}/',' ',$d);
//$d=str_replace("\t","",$d);
return $d."\n";}

static function clean_accolade($d,$a){
$d=str_replace(["\n".$a,"\n\t".$a,' '.$a,$a.' '],$a,$d);
//$d=preg_replace("/(\n)|(\t){1,}$a/",$a,$d);
return $d;}

static function build($d){$r=explode("\n",$d); $ret='';
foreach($r as $k=>$v)$ret.=self::code_cleanup($v);
$ret=str_replace("\n ","\n",$ret);
$ret=str_replace("\t ","\t",$ret);
$ret=self::clean_accolade($ret,'{');
$ret=self::clean_accolade($ret,'}');
$ret=preg_replace("/(\n){2,}/","\n",$ret);
//if($o=='high')$ret=str_replace("\n"," ",$ret);//cause pb of //
return trim($ret);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
//$ret=self::clean_code($ret);
//$ret=self::clean_namefunc($ret);
//$ret=self::code_machine($ret);
//$ret=highlight_string($ret,true);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_indent,call_inpind___'.$rid;
$ret=textarea('inpind',$p);
$ret.=lj('',$j,picto('ok'));
return $ret;}

static function home($p,$o){
$rid=randid('ind');
$bt=self::menu($p,$o,$rid);
return $bt.div(atd($rid).atc('console').ats('white-space:pre-wrap;'),'');}//nowrap
}
?>