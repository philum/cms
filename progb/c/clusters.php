<?php 
class clusters{
static $default='';
static $nbj=30;
static $len=200;

static function cats($p,$o,$prm=[]){$ret=''; $rd=[]; $sq=[];
$p=$prm[0]??$p; if($p)$sq['word']=$p;
$r=sql::inner('word,tag,idtag','qdt','qdtc','idtag','kkv',$sq);//p($r);
$rb=sql::inner('tag,count(idart) as nb','qdt','qdta','idtag','kv',['_group'=>'tag','_order'=>'nb desc']);//p($rb);
foreach($r as $k=>$v){$ret.=divc('txtcadr',$k); $rc=[];
	foreach($v as $ka=>$va)if(isset($rb[$ka]))$rc[$ka]=$rb[$ka]; arsort($rc);
	foreach($rc as $ka=>$va){$rd[]=[$k,$ka,$va];
		//$ret.=lj('','popup_clusters,edit__2_'.ajx($ka),$ka).' ';
		$ret.=btn('popbt',$ka.' ('.$va.')').' ';}}
//$f='_datas/clusters/tags.csv'; $d=array2csv($rd); mkdir_r($f); write_file($f,$d); $bt=lk('/'.$f);
$bt=csvfile('clusters_tags',$rd,'clusters of tags','',1);
return $bt.divc('list',$ret);}//nbp

#edit words
static function savword($p,$o,$prm=[]){$np=$prm[0]??''; echo $np;
if($np && auth(6))sql::upd('qdtc',['word'=>trim($np)],['word'=>$p]);
return self::edit($p,$o);}

static function editword($p,$o){
$rid=randid(); $j='clst_clusters,savword_'.$rid.'__'.ajx($p);
return inputj($rid,$p,$j).' '.lj('txtsav',$j,picto('ok'));}

static function edit($p,$o){$ret='';
$r=sql('distinct(word)','qdtc','rv',['_order'=>'word']);
foreach($r as $k=>$v)$ret.=togbub('clusters,editword',ajx($v),$v).' ';
return divc('nbp',$ret);}

#edit tags
static function sav2($cat,$idtag,$prm=[]){$word=$prm[0]??'';
if($word && auth(6))sql::savup('qdtc',['idtag'=>$idtag,'word'=>trim($word)],0);
return self::viewone($cat,$idtag);}

static function sav3($cat,$idtag,$word){
if($word && auth(6))sql::savup('qdtc',['idtag'=>$idtag,'word'=>trim($word)]);
return self::viewone($cat,$idtag);}

static function del2($cat,$idclust,$idtag){
//if($v)$idclust=sql('id','qdtc','v',['tag'=>$v]);
if(auth(6))sql::del('qdtc',$idclust);
return self::viewone($cat,$idtag);}

static function dropmenu($idtag,$cat){$ret='';
[$tag,$cat]=sql('tag,cat','qdt','w',['id'=>$idtag],0); $inpid='addclst'.$idtag;
$sq=['_group'=>'word'];//,'_order'=>'nb desc'//'cat'=>$cat,
$r=sql::inner('word,count(idtag) as nb','qdt','qdtc','idtag','kv',$sq,0);
$j='edt'.$idtag.'_clusters,sav3__2_'.ajx($cat).'_'.$idtag.'_';
if($r)foreach($r as $k=>$v)$ret.=lj('popsav',$j.ajx($k),$k).' ';
$j='edt'.$idtag.'_clusters,sav2_'.$inpid.'_2_'.ajx($cat).'_'.$idtag;
$ret.=inputj($inpid,'',$j).' '.lj('txtsav',$j,picto('ok'));
return divc('nbp',$ret);}

static function classtags($j){$ret='';
$r=sqb('distinct(cat)','qdt','rv','');
foreach($r as $k=>$v)$ret.=lj('',$j.ajx($v),$v).' ';
return divc('nbp',$ret);}

static function tags_list_nb($cat,$nbday=30){
$qdt=ses('qdt'); $qdta=ses('qdta'); $qda=ses('qda');
$w='inner join '.$qda.' on '.$qda.'.id='.$qdta.'.idart ';
return self::artags('tag,count(idart) as c',$wh,'kv',0);}

static function clustags($cat,$nbj=30,$limit=200){
$qdt=ses('qdt'); $qda=ses('qda'); $qdta=ses('qdta'); $qdtc=ses('qdtc');
$sql='select tag,'.$qdt.'.id as idtag,'.$qdtc.'.id as idclust,word,count('.$qdta.'.idart) as c from '.$qdt.'
inner join '.$qdta.' on '.$qdt.'.id='.$qdta.'.idtag
inner join '.$qda.' on '.$qda.'.id='.$qdta.'.idart
left outer join '.$qdtc.' on '.$qdt.'.id='.$qdtc.'.idtag
where '.($cat?'cat="'.$cat.'" and ':'').' 
day>"'.timeago($nbj).'" group by tag order by c desc limit '.$limit;
return sql::call($sql,'krr','');}

static function viewone($cat,$p){$ret='';
//$r=sql::inner(sqldb::tn('qdtc').'.id,word','qdt','qdtc','idtag','kv',['idtag'=>$p],0);
$r=sql::read('id,word','qdtc','kv',['idtag'=>$p],0); //pr($r);
foreach($r as $k=>$v){
	$ret.=lj('small','edt'.$p.'_clusters,del2___'.ajx($cat).'_'.$k.'_'.$p,$v.' (x)').' ';}
$ret.=togbub('clusters,dropmenu',$p.'_'.ajx($cat),picto('etc'));
//$ret.=toggle('','cl'.$p.'_clusters,dropmenu___'.$p.'_'.ajx($cat),picto('etc'));
//$ret.=bubble('','clusters,dropmenu',$p.'_'.ajx($cat),picto('etc'));
return $ret;}

static function view($cat,$o,$prm=[]){$ret=''; $bt=''; $rb=[];
if(!$cat)$cat='tag'; $nbj=$prm[1]??30; $len=$prm[2]??200;
if(is_numeric($cat))return self::viewart($cat,$o);//
$ret=self::classtags('clst_clusters,view__3_');
$r=self::clustags($cat,$nbj,$len);//tag=>0=>tag,idtag,idclust,word,count
foreach($r as $k=>$v){$del='';
	foreach($v as $ka=>$va){if($va[2])
		$del.=lj('small','edt'.$va[1].'_clusters,del2___'.ajx($cat).'_'.$va[2].'_'.$va[1],$va[3].' (x)').' ';}
	//$nm=toggle('txtx','edt'.$v[0][1].'_clusters,edit___'.$v[0][1].'_'.ajx($cat),$k);
	//$nm=bubble('','clusters,edit',$v[0][1].'_'.ajx($cat),$k);
	//$nm=togbub('clusters,dropmenu',$v[0][1].'_'.ajx($cat),$k);
	$del.=togbub('clusters,dropmenu',$v[0][1].'_'.ajx($cat),picto('etc'));
	$nm=lj('','edt'.$v[0][1].'_clusters,viewone___'.ajx($cat).'_'.$v[0][1],$k);
	$ret.=divc('row',divc('cell',$nm).divb($del,'cell','edt'.$v[0][1]));}
return divc('table',$ret);}

static function viewart($id){//edit art
$r=ma::art_tags($id,'krr'); $rt=[]; //pr($r);//cat[tag=>idtag]
foreach($r as $k=>$v)foreach($v as $ka=>$va){
	$bt=self::viewone($id,$va[2]);
	$rt[$k][]=divc('row',divc('cell',$va[1]).divb($bt,'cell','edt'.$va[2]));}
return tabs($rt);
return divc('table',implode_b('',$rt));}

/*static function edit($p,$cat){$ret='';
$d=sql('tag','qdt','v',['id'=>$p],0); $inpid='addclst'.$p;
$ra=sql::inner('tag,idtag','qdt','qdtc','idtag','kv',['word'=>$d],0);
$r=sqb('distinct(word)','qdtc','rv','order by word'); //p($r);
$j='clst_clusters,sav2_'.$inpid.'_2_'.ajx($cat).'_'.ajx($p);
$ret=datalist($inpid,$r,'',16,'',$j);
$ret.=lj('txtsav',$j,picto('ok'));
//if($r)foreach($r as $k=>$v)$ret.=lj('','clst_clusters,sav2__2_'.ajx($v).'_'.$id,picto('add').$v).' ';
$ra=sql('id,word','qdtc','kv',['idtag'=>$p]); //p($ra);
if($ra)foreach($ra as $k=>$v)
	$ret.=lj('','edt'.$p.'_clusters,del2__2_'.ajx($cat).'_'.$k,pictxt('del',$v)).' ';
$ret.=togbub('clusters,dropmenu',$p.'_'.ajx($cat),picto('etc'));
return $ret;}*/

static function sav($k,$p,$o){
if(auth(6))sqlsav('qdtc',[$k,$p]);
return self::build($p,$o);}

static function del($k,$p,$o){
if(auth(6))sql::del('qdtc',$k);
return self::build($p,$o);}

static function build($p,$cat){$ret=divc('txtcadr',$p);
$ret.=self::classtags('clst_clusters,build__3_'.ajx($p).'_');
$ra=sql::inner('tag,idtag','qdt','qdtc','idtag','kv',['word'=>$p]);
$rb=sqb('idtag,word,id','qdtc','kvv','');
$w=[]; if($cat)$w=['cat'=>$cat]; $w['_order']='tag';
$r=sql('id,tag','qdt','kv',$w);
$jp=ajx($p).'_'.ajx($cat);
if($p)foreach($r as $k=>$v){
	if(isset($ra[$v]))$ret.=lj('popdel','clst_clusters,del__2_'.($rb[$k][1]??'').'_'.$jp,$v.' ('.($rb[$k][0]??'').')');
	else $ret.=lj('popsav','clst_clusters,sav__2_'.$k.'_'.$jp,$v);
$ret.=togbub('clusters,dropmenu',$k.'_'.ajx($cat),'+');}
return divc('panel',$ret);}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
return self::build($p,$o);}

static function menu($p,$o,$rid){
if(!$p)$p=self::$default;
$j='clst_clusters,call_inpcl,nbjcl,lencl_3__'.$rid;
$r=sql('distinct(word)','qdtc','rv','');
$ret=datalist('inpcl',$r,'',16,'clusters of tags',$j);
//$ret.=inputses('nbj',30).inputses('length',400);
$ret.=input('nbjcl',30,4).input('lencl',400,4);
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lj('','clst_clusters,edit__3_',picto('editor')).' ';
$ret.=lj('','clst_clusters,view_inpcl,nbjcl,lencl_3_',picto('view')).' ';
$ret.=lj('','clst_clusters,cats_inpcl_3_',picto('category')).' ';
return $ret;}

static function install($b){
//ses($b,qd($b));//name of table
//sqldb::install('meta_clust');
$r=['id'=>'ai','idtag'=>'int','word'=>'var'];//,'ind'=>'2var'
sqlop::install($b,$r,1);}

static function home($p,$o){
ses('qdtc','pub_meta_clust');
$rid='clst'; $ret=''; $bt='';
//sqldb::install('meta_clust');
if(auth(6))$bt=self::menu($p,$o,$rid);
$ret='';//self::cats($p,$o);
return $bt.divd($rid,$ret);}
}
?>