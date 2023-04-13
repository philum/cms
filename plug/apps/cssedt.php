<?php //cssedt
class cssedt{
static $a=__CLASS__;
static $default='';

static function vars(){
$d=file_get_contents('css/_fa.css');
$r=explode('.fa-',$d); geta('nb',count($r));
foreach($r as $v){$nm=''; $hex='';
	$pos=strpos($v,':before'); if($pos!==false)$nm=substr($v,0,$pos);
	$pos=strpos($v,'content:"'); if($pos!==false)$hex=substr($v,$pos+10,4);
	if($nm && $hex)$ret[$nm]=$hex;}
return $ret;}

static function build($p,$o){
$r=self::vars(); $ret=get('nb'); $rb=[];
//$ret=self::patch();
foreach($r as $k=>$v){$rb[$k]=[$v];
	if(($p && strpos($k,$p)!==false) or !$p or $p==$k)
		$ret.=tag('span',atc('icon'),fa($k,32).br().$k).' ';}
//msql::save('system','edition_glyphes_2',$rb); p($rb);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if(strpos($o,';'))[$o,$ord]=opt($o,';',2);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default;
$j=$rid.'_cssedit,call_inp_3';
$ret=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
//$ret.=msqbt('',nod(self::$a.'_1'));
return $ret;}

static function install($b){
//ses($b,qd($b));//name of table
//1=drop table on change $r !
$r=['tit'=>'var','txt'=>'text','day'=>'int'];
sqlop::install($b,$r,0);}

static function home($p,$o){
$rid=randid(self::$a);
//self::install(self::$a);
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>