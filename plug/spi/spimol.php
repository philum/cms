<?php //spimol
class spimol{
static function build($r,$rc){$ret=''; pr($rc);
$rb=array_keys_r($r,1);
foreach($rc as $k=>$v){//$n=$rb[$k];
	//[$sym,$pos,$free,$deg,$clr]=$ra[$n];
	$ret.=spiatom::build($r,$k,1);}
return $ret;}

static function console($p){
$r=str_split($p); $rb=[];
foreach($r as $k=>$v)
	if(is_numeric($v))for($i=1;$i<$v;$i++)$rb[]=$rb[$k-1]??$rb[$k-2];
	elseif(strtoupper($v)!=$v)$rb[$k-1].=$v;
	else $rb[]=$v;
return $rb;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$r=msql::read('','public_atomic','',1);
if($p)$rb=self::console($p); //p($r);
if($p)return self::build($r,$rb);}

static function menu($p,$o,$rid){
$j=$rid.'_spimol,call_inp____'.$rid.'';
$ret=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok'));
$ret.=lk('/app/spt',picto('filelist'));
$ret.=msqbt('','public_atomic');
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>