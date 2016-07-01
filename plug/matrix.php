<?php
//philum_plugin_matrix

function parent_prev($r,$d){//p($r);
$n=count($r); for($i=0;$i<$n;$i++)if($r[$i]==$d)return $r[$i-1];
return $k;}

//array('date','cat','title','img','hub','tag','lu','author','length','url','ib','re'); 
function matrix_rq(){return ses('rqt'); 
req('art,boot,spe'); $_GET['dig']=30; //$r=sql_b($sql,'');
list($slct,$in,$wh,$ord)=play_req(' and re>0');
$sq=sqlmk($slct,'qda',$in,$wh,$ord); $rq=$req=mysql_query($sq);
$ret=tri_cache($rq); if($rq)mysql_free_result($rq); return $ret;}

function matrix_build($p,$o){$r=matrix_rq(); $pas=10; $mi=$pas/2; ksort($r);//p($r);
foreach($r as $k=>$v){$cats[$v[1]]=1; $parents[$v[10]][]=$k; $clr[$v[10]]=rand_clr();}
ksort($cats); $cats=array_flip(array_keys($cats));
foreach($r as $k=>$v){$i++; $rb[$k]['x']=$i*$pas; $rb[$k]['y']=$cats[$v[1]]*$pas;}//pr($rb);
foreach($r as $k=>$v){$ret.='style=black,white,1;';
	$ret.='rect='.$rb[$k]['x'].','.$rb[$k]['y'].','.$pas.','.$pas.';';
	if($v[10]>0 && $r[$v[10]]){$ob=$parents[$v[10]]; 
		if($ob){$kold=parent_prev($ob,$k); //echo $rb[$kold]['x'].' ';
			if(!$kold)$kold=$v[10]; $ret.='style=,'.$clr[$v[10]].',1;';
			$ret.='line='.($rb[$k]['x']+$mi).','.($rb[$k]['y']+$mi).','.($rb[$kold]['x']+$mi).','.($rb[$kold]['y']+$mi).';';}}} 
//eco($ret,1);
ses('sz',(count($r)*$pas).'/'.(count($cats)*$pas));
return $ret;}

function matrix_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=matrix_build($p,$o);
return plugin_func('svg','svg_j',$ret,ses('sz'));}

function matrix_menu($p,$o,$rid){$ret=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_matrix_matrix*j___inp',picto('reload')).' ';
return $ret;}

//plugin('matrix',$p,$o)
function plug_matrix($p,$o){$rid='plg'.randid();
$ret=matrix_menu($p,$o,$rid);
return $ret.divd($rid,matrix_j($p,$o));}
//$ret.=msqlink('',ses('qb').'_matrix').' ';

?>