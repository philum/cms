<?php //app

class anagram{
static $a=__CLASS__;
static $default='';

static function rmr($r,$i,$e){
$n=count($r)-$e;
$ra=array_slice($r,0,$i);
$rb=array_slice($r,$i+$e);
return array_merge($ra,$rb);}

static function build($p,$o){$ret='';
$b=$o=='yes'?'dicofr':'dicoen'; if(!$p)return;
$ra=str_split($p); $rb=[]; $rc=[]; $n=strlen($p);
if($ra)foreach($ra as $k=>$v)$rb[]='mot like "%'.$v.'%"';
if($rb)$r=sql('mot',$b,'rv',$rb,0);
if($r)foreach($r as $k=>$v)if(strlen($v)==$n)$rc[]=$v; //pr($r);
$ret.='full completed: '.count($rc).br(); $ret.=tabler($rc);
$ret.='all results: '.count($r).br(); $ret.=tabler($r);
if($rb)for($i=0;$i<$n;$i++){$ra2=self::rmr($ra,$i,1); $rb=[];
	foreach($ra2 as $k=>$v)$rb[]='mot like "%'.$v.'%"';
	$r=sql('mot',$b,'rv',$rb,0);
	$ret.='results with: '.implode(',',$ra2).tabler($r);}
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j=$rid.'_anagram,call_'.$inpid.',dicolng_3_'.$p.'_'.$o;
$ret=inputj($inpid,$p,$j);
$ret.=checkbox('dicolng','en','fr');
//$ret.=radio('dicolng',['en','fr'],'');
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid(self::$a); $ret='';
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}
?>