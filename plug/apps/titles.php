<?php //app

class titles{
static $a=__CLASS__;
static $default='';

static function build($p,$o){
$p=str_replace([' ',','],'-',$p);
$p=str_replace('--','-',$p);
$r=explode('-',$p);
foreach($r as $k=>$v){
$ra=$r=ma::art_tags($v); //pr($ra);
$a=key($ra['auteurs']??[]);
$t=ma::suj_of_id($v);
$rb[]='- '.$t.' '.($a?'('.$a.') ':'').' : http://newsnet.fr/'.$v;}
return implode(br(),$rb);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_titles,call_'.$inpid.'_3_'.$p.'_'.$o;
$ret=inputj($inpid,$p,$j);
//$ret=textarea('inp',$p,40,4,['class'=>'console']);
$ret.=lj('',$j,picto('ok')).' ';
//$ret.=msqbt('',nod(self::$a.'_1'));
return $ret;}

static function install($b){
//ses($b,qd($b));//name of table
//1=drop table on change $r !
$r=['tit'=>'var','txt'=>'text','day'=>'int'];
sqlop::install($b,$r,0);}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
//self::install(self::$a);
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}
?>