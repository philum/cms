<?php 
class maintenance{

static function fixtags(){$ret='';
$r=sql('idart,idtag','qdta','kk','');//kill doublons
foreach($r as $k=>$v)foreach($v as $ka=>$va)if($va==2)$rb[$k]=$ka; //pr($rb);
if($rb)foreach($rb as $k=>$v){$id=sql('id','qdta','v','idart="'.$k.'" and idtag="'.$v.'" order by id desc'); $ret.=$k.'-'.$v.':'.$id.br(); if($id)sql::del('qdta',$id);}
return $ret;}

static function imgsizes(){
$r=img::batch(0,50000); $rb=[];
foreach($r as $k=>$v){
	//sqlsav('qdg',$v;
	//$sz=round(filesize('img/'.$v[1])/1024,2);
	$rb[$k]=$v[2]; $r[$k][]=$v[2];}
$ret=array_sum($rb);
arsort($rb);
$rc=array_slice($rb,0,1000);
$ret.='-'.array_sum($rc);
$ret.=tabler($rc);
$ret.=tabler($r);
return $ret;}

static function build($p,$o){$ret='';
if(!auth(6))return;
//if($p=='fixtags')$ret=fixtags();
if($p=='imgsizes')$ret=imgsizes();
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if(!auth(6))return;
$ret=self::build($p,$o);
return $ret;}

static function r(){
return ['fixtags'=>'fixtags','imgsizes'=>'imgsizes'];}

static function menu($p,$o,$rid){
$ret=select_j('inp','pclass','','maintenance/r','','2');
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_maintenance,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>