<?php
//philum_plugin_ummdico

function uds_btn($r){
if($r[5])//$lk=lka('/read/'.$r[5],picto(url)).' ';
$lk=lj('','popup_site___read_'.$r[5],picto(url));
return hr().bal('b',$r[4]).' ('.$r[1].') '.$lk.br().divc('justy',$r[6]);}

function ud_search($p,$o,$res){list($p,$o)=ajxr($res);
if($o=='yes')$r=sql('*','qu','','ex=soundex("'.$p.'") order by voc asc');
else $r=sql('*','qu','','voc like "%'.$p.'%" order by voc asc');
$ret=btn('txtsmall',count($r).' résultats').br();
if($r)foreach($r as $k=>$v)$ret.=uds_btn($v);
return $ret;}

function umm_sav(){require_once('params/_connectx.php');
$dfb['_menus_']=array('id','doc','date','lang','voc','link','def','ex');
$r=sql('*','qu','',''); echo ses('qb').'_ummodico';//p($r);
if($r)$r=modif_vars('users',ses('qb').'_ummodico',$r,'add',$dfb);}

function plug_ummdico($p,$o){//umm_sav();
ses('qu','umm_dico');
$ret=bal('h3','Recherche sur le dictionnaire des vocables');
$ret.=input(1,'search','','').' ';
$ret.=checkbox('chk','1','phonétique',0);
$ret.=lj('txtbox','ucbk_plug___ummdico_ud*search_1_2_search|chk','chercher').br().br();
$ret.=divd('ucbk','').br();//callback
return $ret;}

?>