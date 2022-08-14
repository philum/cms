<?php //maintenance

function fixtags(){$ret='';
$r=sql('idart,idtag','qdta','kk','');//kill doublons
foreach($r as $k=>$v)foreach($v as $ka=>$va)if($va==2)$rb[$k]=$ka; //pr($rb);
if($rb)foreach($rb as $k=>$v){$id=sql('id','qdta','v','idart="'.$k.'" and idtag="'.$v.'" order by id desc'); $ret.=$k.'-'.$v.':'.$id.br(); if($id)sqldel('qdta',$id);}
return $ret;}

function imgsizes(){
$r=img::batch(0,50000); $rb=[];
foreach($r as $k=>$v){
	//sqlsav('qdg',$v;
	//$sz=round(filesize('img/'.$v[1])/1024,2);
	$rb[$k]=$v[2]; $r[$k][]=$v[2];
}
$ret=array_sum($rb);
arsort($rb);
$rc=array_slice($rb,0,1000);
$ret.='-'.array_sum($rc);
$ret.=tabler($rc);
$ret.=tabler($r);
return $ret;}

function maintenance_build($p,$o){$ret='';
if(!auth(6))return;
//if($p=='fixtags')$ret=fixtags();
if($p=='imgsizes')$ret=imgsizes();
return $ret;}

function maintenance_j($p,$o,$res=''){
if(!auth(6))return;
[$p,$o]=ajxp($res,$p,$o);
$ret=maintenance_build($p,$o);
return $ret;}

function maintenance_r(){
return ['fixtags'=>'fixtags','imgsizes'=>'imgsizes'];}

function maintenance_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','maintenance/maintenance_r','','2');
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__3_maintenance_maintenance*j___inp',picto('ok')).' ';
return $ret;}

function plug_maintenance($p,$o){$rid=randid('plg');
$bt=maintenance_menu($p,$o,$rid);
$ret=maintenance_build($p,$o);
return $bt.divd($rid,$ret);}

?>