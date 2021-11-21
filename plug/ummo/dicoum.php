<?php
//philum_plugin_dicoum

function dicform($id,$idb,$def,$typ){if(!$typ)$typ='word';
$ret=textarea('tx'.$id,$def,'40','2',atc('console')).' '; //if($typ=='')$typ='word';
$ret.=lj('','edt'.$id.'_plug___dicoum_dic*edt_'.$id.'_'.$idb.'_tx'.$id.'|rdx'.$id,picto('save')).' ';
$ret.=radiobtn(['word','expression','name','planet','unit','math'],$typ,'rdx'.$id);
return $ret;}

function dic_edt($id,$idb,$res){
list($def,$typ)=ajxr($res);
if($idb)$voc=sql('voc','dico','v','id="'.$idb.'"');
else $voc=sql('voc','bdvoc','v','id="'.$id.'"');
if($idb)sqlup('dico',['def'=>trim($def),'typ'=>$typ],'id',$idb);
elseif($voc)sqlsav('dico',['voc'=>$voc,'def'=>$def,'snd'=>soundex($def),'typ'=>$typ]);
$ret=dicform($id,$idb,$def,$typ);
return $ret;}

function dic_bdv($p){ 
$r=sql('id,voc,idart,ref,sound,txt,lang','bdvoc','rr','voc="'.$p.'"');
$rb=bdvoc_play($r,$p,'');
//$ret=tabler($rb,1);
return $rb;}

function dic_build($p,$o){
reqp('bdvoc'); req('spe'); $wa=''; $wp='';
$ratio=50; $min=($o-1)*$ratio; $rt=[];
if($p)$wa='voc like "%'.$p.'%" ';
elseif($o)$wh='limit '.$limit=$min.', '.($min+$ratio);
$r=sqb('id,voc,lang,sound','bdvoc','rr',$wa.'group by voc order by voc '.$wh);
$tr=['vocable','context','lang','ref','edit'];
if($r)foreach($r as $k=>$v){
	list($id,$voc,$lg,$sd)=$v;
	//$lk=popart($idart,$ref);
	//$edt=lj('','popup_plup__xx_dic_dic*sav_'.$id.'_'.ajx($voc).'_',picto('editxt'));
	$bt=lj('','popup_plup___bdvoc_bdvoc*see_'.ajx($voc).'__',$voc);
	$rb=dic_bdv($voc);
	$ra=sql('id,def,typ','dico','w','voc="'.$voc.'"'); //p($ra);
	if($rt)$rb[0][]=divd('edt'.$id,dicform($id,$ra[0],$ra[1],$ra[2]));// && auth(4)
	$rt=array_merge($rt,$rb);}//,$sd,soundex($voc)
$ret=tabler($rt,1);
return $ret;}

function dic_pg($p,$o){
$n=sqb('count(distinct(voc))','bdvoc','v','');
$ret=btpages(50,$o?$o:1,$n,'dcm_plug__3_dicoum_dic*j_'.ajx($p).'_');
return $ret;}

function dic_j($p,$o,$res=''){req('spe');
list($p,$o)=ajxp($res,$p,$o);
if(!$o)$o=1;//page
$ret=dic_pg($p,$o);
$ret.=dic_build($p,$o);
return $ret;}

//update dico
function dic_upd(){
$r=msql_read('','ummo_umvoc_1','');
if($r)foreach($r as $k=>$v){
	list($voc,$def,$typ,$ref)=$v;
	$ex=sql('id','dico','v','voc="'.$voc.'"');
	if(!$ex)sqlsav('dico',['voc'=>$voc,'def'=>$def,'sound'=>soundex($voc),'type'=>$typ],1);}
return count($r);}

function dcm_del($p){sqldel('bdvoc',$p);
return $p;}//dcm_upd()

function dcmdic($p){
$r=sql('voc','bdvoc','v',$p); p($r);
return $p;}//dcm_upd()

function dcm_upd(){
$r=sqb('voc','bdvoc','','group by voc order by voc');
foreach($r as $k=>$v){
	//$del=lj('','popup_plup__xx_umvoc_dcm*del_'.$va,picto('del')); $r[$k][]=$del;
	//if(auth(6))$edt=lj('','popup_sqledt___bdvoc_'.$va,picto('editxt')); $r[$k][]=$edt;
	$edt=lj('','popup_plup___umvoc_umvdic_'.$v[0],picto('editxt')); $r[$k][]=$edt;}
//pr($rc);
return tabler($r,0);}

function dicoum_menu($p,$o,$rid){
//$ret=select_j('inp','pfunc','','dicoum/dic_r','','2');
$j=$rid.'_plug__2_dicoum_dic*j___inp';
$ret=inputj('inp',$p,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
//$ret.=lj('','popup_plupin___msqedit_dicoum*1_id,val',picto('edit')).' ';
return $ret;}

function plug_dicoum($p,$o){$rid='dcm';
ses('bdvoc','bdvoc');
ses('dico','dicoum');
$bt=dicoum_menu($p,$o,$rid);
$ret=dic_j($p,$o); //if(auth(6))
//if(auth(6))$ret.=divd('bdv',bdv_upd());
//if(auth(6))$ret.=divd('bdv',dic_upd());
return $bt.divd($rid,$ret);}

?>