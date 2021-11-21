<?php
//philum_plugin_bdvoc

function bdvoc_sav($v,$o){//echo $p.'-'.$o;
list($id,$pos)=explode('-',$o);
$idvoc=bdvoc_ex($v);
if(!$idvoc){$idvoc=insert('qdvoc',mysqlra(['voc'=>$v],1)); $ret='saved '.$v.' ';}
else $ret='word exists ';
$ex=bdvoc_exart($idvoc,$id,$pos);
if($idvoc && !$ex){$rb=['idvoc'=>$idvoc,'idart'=>$id,'pos'=>$pos];
	$nid=insert('qdvoc_b',mysqlra($rb,1));}
else return 'already exists';
return $ret.'added in '.$idvoc.'-'.$nid;}

function bdvoc_play($r,$p,$o){static $i; $i++;
if($i==1)$rb[]=['vocable','context','lang','ref','0'];
if($r)foreach($r as $k=>$v){
	list($id,$voc,$idart,$ref,$sound,$txt,$lg)=$v;
	$lv=levenshtein($p,$voc);
	//$lk=popart($idart,$ref);
	$lk=lj('','popup_artlook___'.$idart.'_'.ajx($voc).'_1',pictxt('article',$ref));
	$bt=lj('txtx','popup_plup___bdvoc_bdvoc*see_'.ajx($voc).'_',$voc);
	if(auth(6))$edt=lj('','popup_sqledt___bdvoc_'.$id,picto('editxt'));
	$rb[]=[$bt,$txt,$lg,$lk,$lv,$edt];}
if($o){foreach($rb as $k=>$v)$rc[$v[4]][]=$k; ksort($rc); //p($rc);
	foreach($rc as $k=>$v)foreach($v as $kb=>$vb)$rd[]=$rb[$vb]; $rb=$rd;}
return $rb;}

//soundex,metaphone,levenshtein
function bdvoc_see($p,$o,$res=''){
req('spe'); $rid='bdv'.randid();
ses('bdvoc','bdvoc');
list($p,$o)=ajxp($res,$p,$o);
if($o){$sound=sql('sound','bdvoc','v','voc="'.$p.'"');
	if(!$sound)$sound=soundex($p); $wh='sound="'.$sound.'"';}
else $wh='voc="'.$p.'"';//.' and lang="'.ses('lang').'"'
$r=sql('id,voc,idart,ref,sound,txt,lang','bdvoc','rr',$wh); //p($r);
if(!$r)$r=sql('id,voc,idart,ref,sound,txt,lang','bdvoc','rr','voc like "%'.$p.'%"');
$rb=bdvoc_play($r,$p,$o); $n=count($rb);
$ret=btn('txtx',$n.' '.plurial($n,16)).' ';
//$ret.=lj('',$rid.'_plug__15_bdvoc_bdvoc*see_'.ajx($p).'_1_',picto('sound'));
$ret.=tabler($rb,1);
return divd($rid,$ret);}

function bdvoc_build($p,$o){
$ratio=50; $min=($o-1)*$ratio; $wh=$o?'limit '.$limit=$min.', '.($min+$ratio):'';
$r=sqb('id,voc,lang,sound','bdvoc','rr','group by voc order by voc '.$wh);
if($r)foreach($r as $k=>$v){
	list($id,$voc,$lg,$sd)=$v;
	//$lk=popart($idart,$ref);
	$bt=lj('txtx','popup_plup___bdvoc_bdvoc*see_'.ajx($voc).'__',$voc);
	//$edt=lj('','popup_plup__xx_bdvoc_bdvoc*sav_'.$id.'_'.ajx($voc).'_',picto('editxt'));
	$rb[]=[$lg,$bt];}//,$sd,soundex($voc)
return $rb;}

function bdvoc_pg($p,$o){
$n=sqb('count(distinct(voc))','bdvoc','v','');
$ret=btpages(50,$o?$o:1,$n,'bdv_plug__3_bdvoc_bdvoc*j_'.ajx($p).'_');
return $ret;}

function bdvoc_j($p,$o,$res=''){req('spe');
list($p,$o)=ajxp($res,$p,$o);
$r=bdvoc_build($p,$o);
$ret=bdvoc_pg($p,$o);
$ret.=tabler($r);
return $ret;}

function bdvoc_menu($p,$o,$rid){
$j=$rid.'_plug__1_bdvoc_bdvoc*see___inpbdv';
$ret=inputj('inpbdv',$p,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lj('',$rid.'_plug__1_bdvoc_bdvoc*see__1_inpbdv',pictxt('sound',nms(179))).' ';
//$n=sqb('count(distinct(voc))','bdvoc','v','');
//$ret.=btn('txtxt',$n.' vocables').' ';
return $ret;}

function affect_arts(){
$r=sqb('id,ref','bdvoc','kv','where idart=0'); //p($r);
if($r)foreach($r as $k=>$v){
	$id=sql('id','qda','v','suj like "%['.$v.']%" and re="1" and lg="fr"');
	if($id){update('bdvoc','idart',$id,'id',$k); echo $v.':'.$id.'-';}}
return count($r);}

function plug_bdvoc($p,$o){$rid='bdv';
req('spe');
ses('bdvoc','bdvoc');
$bt=bdvoc_menu($p,$o,$rid);
//if(auth(6))echo affect_arts();
if($p)$ret=bdvoc_see($p,$o);
else $ret='';//bdvoc_j($p,$o);
return $bt.divd($rid,$ret);}

?>