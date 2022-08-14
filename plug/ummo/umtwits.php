<?php //umtwits
class umtwits{
static function build($p,$o){$ret='';
if($p)$w='where screen_name="'.$p.'" ';
if($o=='yes')$w.='or reply_name="'.$p.'" ';
$r=sqb('*','umt','ar',$w.'order by date asc');
if($r)foreach($r as $k=>$v)$ret.=balb('section',twit::play(val($r,'twid'),$v));
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
if(!$ret)$ret='nothing';
return $ret;}

static function r(){$rt=[];
$r=sqb('distinct(screen_name) as name','umt','rv','order by name');
foreach($r as $v)$rt[$v]=$v;
return $rt;}

static function menu($p,$o,$rid){
$ret=select_j('inp','pclass','','umtwits/r','','2').' ';
$j=$rid.'_umtwits,call_inp,chk';
$ret.=inputj('inp',$p,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=checkbox('chk','no','replies','');
return $ret;}

static function home($p,$o){$rid=randid('plg');
ses('umt','pub_umtwits');
$bt=self::menu($p,$o,$rid);
//$ret=self::build($p,$o);
return $bt.divd($rid,'');}
}
?>