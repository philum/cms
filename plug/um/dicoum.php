<?php //dicoum
class dicoum{

static function form($id,$idb,$def,$typ){if(!$typ)$typ='word';
$ret=textarea('tx'.$id,$def,'40','2',['class'=>'console']).' '; //if($typ=='')$typ='word';
$ret.=lj('','edt'.$id.'_dicoum,edt_'.$id.'_tx'.$id.',rdx'.$id.'__'.$idb,picto('save')).' ';
$ret.=radio('rdx'.$id,['word','expression','name','planet','unit','math'],$typ);
return $ret;}

static function edt($id,$idb,$prm){
[$def,$typ]=arr($prm);
if($idb)$voc=sql('voc','dico','v','id="'.$idb.'"');
else $voc=sql('voc','bdvoc','v','id="'.$id.'"');
if($idb)sqlup('dico',['def'=>trim($def),'typ'=>$typ],$idb);
elseif($voc)sqlsav('dico',['voc'=>$voc,'def'=>$def,'snd'=>soundex($def),'typ'=>$typ]);
$ret=self::form($id,$idb,$def,$typ);
return $ret;}

static function bdv($p){ 
$r=sql('id,voc,idart,ref,sound,txt,lang','bdvoc','rr','voc="'.$p.'"');
$rb=bdvoc::play($r,$p,'');
//$ret=tabler($rb,1);
return $rb;}

static function build($p,$o){
$rb=[]; $sq=[];
$ratio=50; $min=($o-1)*$ratio; $rt=[];
if($p)$sq['%voc']=$p;
elseif($o)$sq['_limit']=$min.', '.($min+$ratio)];
$sq['group']='voc'; $sq['_order']='voc';
$r=sql('id,voc,lang,sound','bdvoc','rr',$sq);
$tr=['vocable','context','lang','ref','edit'];
if($r)foreach($r as $k=>$v){
	[$id,$voc,$lg,$sd]=$v;
	//$lk=ma::popart($idart,$ref);
	//$edt=lj('','popup_dicoum,sav___'.$id.'_'.ajx($voc).'_',picto('editxt'));
	$bt=lj('','popup_bdvoc,see___'.ajx($voc).'__',$voc);
	$rb=self::bdv($voc);
	$ra=sql('id,def,typ','dico','w','voc="'.$voc.'"'); //p($ra);
	if($rt && $ra)$rb[0][]=divd('edt'.$id,self::form($id,$ra[0],$ra[1],$ra[2]));// && auth(4)
	$rt=array_merge($rt,$rb);}//,$sd,soundex($voc)
$ret=tabler($rt,1);
return $ret;}

static function pg($p,$o){
$n=sqb('count(distinct(voc))','bdvoc','v','');
$ret=pop::btpages(50,$o?$o:1,$n,'dcm_dicoum,call___'.ajx($p).'_');
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
if(!$o)$o=1;//page
$ret=self::pg($p,$o);
$ret.=self::build($p,$o);
return $ret;}

//update dico
static function upd(){
$r=msql::read('','ummo_umvoc_1','');
if($r)foreach($r as $k=>$v){
	[$voc,$def,$typ,$ref]=$v;
	$ex=sql('id','dico','v','voc="'.$voc.'"');
	if(!$ex)sqlsav('dico',['voc'=>$voc,'def'=>$def,'sound'=>soundex($voc),'type'=>$typ],1);}
return count($r);}

static function del($p){sql::del('bdvoc',$p);
return $p;}//self::upd()

static function dic($p){
$r=sql('voc','bdvoc','v',$p); //p($r);
return $r;}

static function updedt(){
$r=sqb('voc','bdvoc','','group by voc order by voc');
foreach($r as $k=>$v){
	//$del=lj('','popup_umvoc,del___'.$va,picto('del')); $r[$k][]=$del;
	//if(auth(6))$edt=lj('','popup_sqledt___bdvoc_'.$va,picto('editxt')); $r[$k][]=$edt;
	$edt=lj('','popup_umvoc,cmdf___'.$v[0],picto('editxt')); $r[$k][]=$edt;}
//pr($rc);
return tabler($r,0);}

static function menu($p,$o,$rid){
//$ret=select_j('inp','pclass','','dicoum/dic','','2');
$j=$rid.'_dicoum_,call_inp';
$ret=inputj('inp',$p,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='dcm';
ses('bdvoc','bdvoc');
ses('dico','dicoum');
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o); //if(auth(6))
//if(auth(6))$ret.=divd('bdv',bdv_upd());
//if(auth(6))$ret.=divd('bdv',self::upd());
return $bt.divd($rid,$ret);}
}
?>