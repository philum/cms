<?php 
class ops{

static function build($p,$o){
//$r=msql::read('',nod('umnum'),$p);
//$r=sqb('name,count(name)','qda','kv','group by name');
//$r=sql::inner('id,msg','qda','qdm','id','kv','limit 100',1);//,"C","E","H","NR","GR"
$r=sql('id','qda','rv','name="ummo" and frm in("D","C","E","H","NR","GR","ES");'); //p($r);
if($r)foreach($r as $k=>$v){
	$nm=')+(';
	//if($lk)sql::upd('qda',['mail'=>$lk],$v);
	$ret[]=[$v,$nm];}
return tabler($ret);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function r(){
return ['aa'=>'a','bb'=>'b'];}

static function menu($p,$o,$rid){
$ret=select_j('inp','pclass','','ops/r','','2');
//$ret.=togbub('app','ops*r',btn('popbt','select...'));
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_ops*call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
ses('qdaa','pub_art_a');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('ops'));
return $bt.divd($rid,$ret);}
}
?>