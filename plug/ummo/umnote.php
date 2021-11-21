<?php
//philum_plugin_umnote

function umn_r(){
return msql_read('users',ses('umncnod'),'',1);}

function umnr(){$r=umn_r();
foreach($r as $k=>$v)$rb[$v[0]]=$v[0]; sort($rb);
return $rb;}

function uds_btn($r){
$rb=array('vocable','name','planet','unit','math');
$ret=$rb[$r[2]]?' ('.$rb[$r[2]].') ':' ';
$ret.=lj('','popup_search___'.ajx($r[0]),picto('search',16)).' ';
if($r[3])$ret.=' ['.$r[3].'] ';
//$ret.=ud_glyphe($r[0]).br();
return hr().balb('b',$r[0]).$ret.divc('justy',nl2br(stripslashes($r[1])));}

//edit
function umncsav($p,$o,$res){$def=ajxg($res);
$rb=sql_inner('frm','qdm','qda','id','k','where nod="ummo" and substring(frm,1,1)!="_" and frm!="Etudes" and substring(frm,1,2)!="ES" and re>0 and msg like "% '.$p.' %"',''); if($rb)$ref=implode(' ',array_keys($rb));
$defs=array($p,$def,'',$ref);
msql::modif('',ses('umncnod'),$defs,'push','','');
return ud_search($p,'1',$res);}

function umncadd($p){
$ret=textarea('addvoc','',40,4);
$ret.=lj('popsav','uncbk_plug___umnote_umncsav_'.ajx($p).'__addvoc',pictxt('save',nms(92)));
return $ret;}

//glossaire
function ud_segment($id,$pos){
$d=sql('msg','qdm','v','id='.$id);
$t=sql('suj','qda','v','id='.$id); 
$ret=lj('txtcadr','popup_popart__3_'.$id.'_3',$t).br();
$ret.=substr($d,$pos-50,100);
return $ret;}

//search
function ud_search($p,$o,$res){list($p,$o)=ajxp($res,$p,$o);
$p=strtolower(trim($p)); $ps=soundex($p); $r=umn_r(); if(!$p)return;
if($r)foreach($r as $k=>$v){$voc=strtolower($v[0]); $vcb=soundex($voc);
	if($voc==$p or $vcb==$ps or strpos($voc,$p)!==false)$ret[]=uds_btn($v);}
$n=count($ret);
$search=lj('popbt','popup_search___'.ajx(strtoupper($p)),pictxt('search',nms(24))).br();
if($ret)$ret=implode('',$ret).br();
if(auth(2))$sav=umncadd($p).br();
if(!$ret)return btn('txtcadr',nms(11).' '.nms(16)).' '.$search.br().$sav;
return btn('txtcadr',$n.' '.plurial($n,16)).' '.$search.$ret.$sav;}

function slct_j_r($p,$o){$r=umn_r();
if($r)foreach($r as $k=>$v){$d=addslashes($v[0]);
$ret.=ljb('',atjr('jumpvalue',['unrch',$d]).'; '.sj('uncbk_plug___umnote_ud*search_'.$d.'_1'); clpop(event);','',$v[0]);}
return divc('nbp list',$ret);}

function slct_j($d){$rid='bt'.randid(); $bt=btn('popbt','select...');
return togbub('plug','umnote_slct*j*r_'.$d.'_'.$rid,$bt);}

function plug_umnote($p,$o){
ses('umncnod','ummo_umnote_1');
$ret=slct_j($p).' ';
$ret.=input1('unrch',$p,'').' ';
$ret.=lj('popsav','uncbk_plug__15_umnote_ud*search_'.ajx($p).'__unrch','chercher').' ';
$ret.=divd('uncbk',ud_search($p,'1','')).br();
$ret.=msqbt('',ses('umncnod'),'').' ';
$ret.=lkt('','/plug/umnote',picto('link'));
return $ret;}

?>