<?php 
class cmpqcode{

static function noesp($d){
$r=array(';','.',',','=','[',']','(',')','+','-','!','?','<','>','|','&','"',"'");
foreach($r as $v)$d=str_replace(array(' '.$v,$v.' '),$v,$d);
return $d;}

static function nonl($d){
$d=str_replace('}'."\n",'}',$d);
$d=str_replace("\t",'',$d);
return $d;}

static function recompile($f){
$d=read_file($f);
$d=self::noesp($d);
//$d=self::nonl($d);
write_file($f,$d);}

static function build($p,$o){
[$p,$o]=prmp($prm,$p,$o);
$f='plug/editor.php';
//$f='progb/lib.php';
//self::recompile($f);
$ret=$p.'-'.$o;
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_cmpqcode,build_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('cmpqcode');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('cmpqcode_1'));
return $bt.divd($rid,$ret);}
}
?>