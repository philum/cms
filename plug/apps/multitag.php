<?php //app

class multitag{
static $a=__CLASS__;
static $default='';

static function build($p,$o){
//$r=msql::read_b('',nod(self::$a.'_1'));//p($r);
$ret=$p.'-'.$o;
return $ret;}

static function call($p,$o,$res=''){
[$p,$o]=ajxp($res,$p,$o);
if(strpos($o,';'))[$o,$ord]=opt($o,';',2);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j='clst_multitag,call__3__'.$rid.'___'.$inpid;
$r=sql('distinct(tg)','qdtm','rv','');
$ret=datalist($inpid,$r,'',16,'fam of tags',$j);
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lj('','clst_app__3_multitag_cats__',picto('category')).' ';
$ret.=lj('','clst_app__3_multitag_view__',picto('view')).' ';
return $ret;}

static function install($b){
//ses($b,qd($b));//name of table
//1=drop table on change $r !
$r=['id'=>'ai','idart'=>'int','tg'=>'var','lg'=>'var2'];
mysql::install($b,$r,0);}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
ses('qdtm','pub_meta_mul');
//self::install(self::$a);
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}

?>