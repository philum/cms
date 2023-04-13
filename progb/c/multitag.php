<?php 
class multitag{
static $a=__CLASS__;
static $default='';

static function build($p,$o){
//$r=msql::read_b('',nod(self::$a.'_1'));//p($r);
$ret=$p.'-'.$o;
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if(strpos($o,';'))[$o,$ord]=opt($o,';',2);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j='clst_multitag,call_'.$inpid.'_3__'.$rid;
$r=sql('distinct(tg)','qdtm','rv','');
$ret=datalist($inpid,$r,'',16,'fam of tags',$j);
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lj('','clst_multitag,cats__',picto('category')).' ';
$ret.=lj('','clst_multitag,view__',picto('view')).' ';
return $ret;}

static function install($b){
//ses($b,qd($b));//name of table
//1=drop table on change $r !
$r=['id'=>'ai','idart'=>'int','tg'=>'var','lg'=>'var2'];
sqlop::install($b,$r,0);}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
ses('qdtm','pub_meta_mul');
//sqldb::install('meta_mul');
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}
?>