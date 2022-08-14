<?php //ops

function ops_build($p,$o){
//$r=msql_read('',nod('umnum'),$p);
//$r=sqb('name,count(name)','qda','kv','group by name');
//$r=sql_inner('id,msg','qda','qdm','id','kv','limit 100',1);//,"C","E","H","NR","GR"
$r=sql('id','qda','rv','name="ummo" and frm in("D","C","E","H","NR","GR","ES");'); //p($r);

if($r)foreach($r as $k=>$v){
	$nm=')+(';
	//if($lk)update('qda','mail',$lk,'id',$v);
	$ret[]=[$v,$nm];	
}

return tabler($ret);}

function ops_j($p,$o,$res=''){
[$p,$o]=ajxp($res,$p,$o);
$ret=ops_build($p,$o);
return $ret;}

function ops_r(){
return ['aa'=>'a','bb'=>'b'];}

function ops_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','ops/ops_r','','2');
//$ret.=togbub('plug','ops_ops*r',btn('popbt','select...'));
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_ops_ops*j___inp',picto('ok')).' ';
return $ret;}

function plug_ops($p,$o){$rid=randid('plg');
ses('qdaa','pub_art_a');
$bt=ops_menu($p,$o,$rid);
$ret=ops_build($p,$o);
//$bt.=msqbt('',nod('ops'));
return $bt.divd($rid,$ret);}

?>