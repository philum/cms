<?php
//philum_app_clusters

class clusters{
static $a=__CLASS__;
static $default='';

static function sav($p,$v,$o){
if(auth(6))sqlsav('qdtc',[$p,$v]);
return self::build($p,$o);}

static function del($p,$v,$o){
if(auth(6))sqldel('qdtc',$p);
return self::build($p,$o);}

static function build($p,$o){$ret=divc('txtcadr',$p);
$ra=sql_inner('tag,idtag','qdtc','qdt','idtag','kv',['word'=>$p]); //p($ra);
$rb=sqb('idtag,word','qdtc','kv','');
$r=sqb('id,tag','qdt','kv','order by tag asc');
if($p)foreach($r as $k=>$v)
	if(isset($ra[$v]))$ret.=lj('txtyl','clst_clusters,del__2_'.$v,$v.' ('.$rb[$k].')');
	else $ret.=lj('txtsav','clst_clusters,sav__2_'.ajx($p).'_'.$k,$v);
return divc('list',$ret);}

static function cats($p,$o){$ret=''; $rd=[];
$r=sql_inner('word,tag,idtag','qdt','qdtc','idtag','kkv','');//p($r);
$rb=sql_inner('tag,count(idart) as nb','qdt','qdta','idtag','kv','group by tag order by nb desc');//p($rb);
foreach($r as $k=>$v){$ret.=divc('txtcadr',$k); $rc=[];
	foreach($v as $ka=>$va)if(isset($rb[$ka]))$rc[$ka]=$rb[$ka]; arsort($rc);
	foreach($rc as $ka=>$va){$rd[]=[$k,$ka,$va];
		//$ret.=lj('','popup_clusters,edit__2_'.ajx($ka),$ka).' ';
		$ret.=btn('popbt',$ka.' ('.$va.')').' ';}
	$ret.=br();}
//$f='_datas/clusters_tags.csv'; $d=array2csv($rd); write_file($f,$d); $bt=lk('/'.$f);
$bt=csvfile('clusters_tags',$rd,'clusters of tags','',1);
return $bt.divc('list',$ret);}

static function sav2($p,$o,$res){
list($p,$o)=ajxp($res,$p,$o);
if($p && auth(6))sqlsavup('qdtc',[$o,trim($p)]);
return self::view($p,$o);}

static function del2($p,$v,$o){
//if($v)$p=sql('id','qdtc','v',['tag'=>$v]);
if(auth(6))sqldel('qdtc',$p);
return self::view($p,$o);}

static function edit($p,$o){$ret='';
$d=sql('tag','qdt','v',['id'=>$p],0); $inpid='addclst'.$p;
$ra=sql_inner('tag,idtag','qdt','qdtc','idtag','kv',['word'=>$d],0);
$r=sqb('distinct(word)','qdtc','rv',' order by word'); //p($r);
$j='clst_clusters,sav2__2__'.$p.'___'.$inpid;
$ret=datalist($inpid,$r,'',16,'',$j);
$ret.=lj('txtsav',$j,picto('ok'));
//if($r)foreach($r as $k=>$v)$ret.=lj('','clst_clusters,sav2__2_'.ajx($v).'_'.$id,picto('add').$v).' ';
$ra=sql('id,word','qdtc','kv',['idtag'=>$p]); //p($ra);
if($ra)foreach($ra as $k=>$v)$ret.=lj('','clst_clusters,del2__2_'.$k,picto('del').$v).' ';
return $ret;}

static function view($p,$o){$ret='';
$ra=sqb('tag,id','qdt','kv','order by tag asc');//p($ra);
$r=sql_inner('tag,pub_meta_clust.id,word','qdt','qdtc','idtag','kkv',''); //p($r);
foreach($ra as $k=>$v){$bt='';
	if(isset($r[$k]))//$bt=' ('.implode(' ',$r[$k]).')';
		foreach($r[$k] as $ka=>$va)
			$bt.=lj('small','clst_clusters,del2__2_'.$ka,picto('del').$va).' ';
	$ret.=toggle('txtx','edt'.$v.'_clusters,edit_'.$v,$k.$bt).btd('edt'.$v,'').br();}
return divc('',$ret);}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default; $inpid='inp'.$rid;
$j='clst_clusters,call__3__'.$rid.'___'.$inpid;
$r=sql('distinct(word)','qdtc','rv','');
$ret=datalist($inpid,$r,'',16,'clusters of tags',$j);
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lj('','clst_clusters,cats__3_',picto('category')).' ';
$ret.=lj('','clst_clusters,view__3_',picto('view')).' ';
return $ret;}

static function install($b){
//ses($b,qd($b));//name of table
$r=['id'=>'ai','idtag'=>'int','word'=>'var'];//,'ind'=>'2var'
mysql::install($b,$r,1);}

static function home($p,$o){
ses('qdtc','pub_meta_clust');
$rid='clst'; $ret=''; $bt='';
self::install('meta_clust');
if(auth(6))$bt=self::menu($p,$o,$rid);
$ret=self::cats($p,$o);
return $bt.divd($rid,$ret);}

}

?>