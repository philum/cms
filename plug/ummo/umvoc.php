<?php
//philum_plugin_umvoc

function umv_r(){
return msql_read('users',ses('umvcnod'),'',1);}

function umvr(){$r=umv_r();
foreach($r as $k=>$v)$rb[$v[0]]=$v[0]; sort($rb);
return $rb;}

function uds_btn($r){
$rb=array('vocable','name','planet','unit','math');
$type=$rb[$r[2]]?' ('.$rb[$r[2]].') ':' ';
$lk=lj('','popup_search___'.ajx($r[0]),picto('search',16));
return hr().bal('b',$r[0]).$type.$lk.br().divc('justy',nl2br(stripslashes($r[1])));}

function umvcsav($p,$o,$res){$def=ajxg($res); $defs=array(strtoupper($p),$def,'');
msql_modif('',ses('umvcnod'),$defs,'','push','');
return lj('popsav','ucbk_plug___umvoc_ud*search_'.ajx($p),'ok');}

function umvcadd($p){$ret=btn('txtcadr','definition').' '.input(1,'addvoc','').' ';
$ret.=lj('popsav','popup_plup___umvoc_umvcsav_'.ajx($p).'__addvoc',pictxt('save','ajouter'));
return $ret;}

function ud_search($p,$o,$res){list($p,$o)=ajxp($res,$p,$o);
$p=strtolower($p); $ps=soundex($p); $r=umv_r(); if(!$p)return;
if($r)foreach($r as $k=>$v){$voc=strtolower($v[0]); $vcb=soundex($voc);
if($o){if($vcb==$ps)$ret[]=uds_btn($v);}
elseif($voc==$p)$ret[]=uds_btn($v);}
$n=count($ret);
if($ret)return btn('txtsmall',$n.' '.plurial($n,16)).br().implode('',$ret);
if(auth(6))$sav=umvcadd($p);
return nms(11).' '.nms(16).br().$sav;}

function slct_j_r($p,$o){$r=umv_r();
if($r)foreach($r as $k=>$v){$d=addslashes($v[0]);
$ret.=ljb('','jumpvalue(\'usrch_'.ajx($d).'\'); SaveJ(\'ucbk_plug___umvoc_ud*search_'.$d.'_1\'); Close(\'popup\');','',$v[0]).br();}
return divc('nbp',$ret);}

function slct_j($d){$rid='bt'.randid(); $bt=btn('popbt','select...');
return togbub('plug','umvoc_slct*j*r_'.$d.'_'.$rid,$bt);}

function plug_umvoc($p,$o){
ses('umvcnod','public_umvoc_1');
$ret.=slct_j($p).' '.input(1,'usrch',$p,'').' ';
$ret.=lj('txtbox','ucbk_plug___umvoc_ud*search_'.ajx($p).'__usrch|udsnd','chercher').' ';
$ret.=checkbox_j('udsnd',1,'soundex').br().br();//|chk
$ret.=divd('ucbk',ud_search($p,'','')).br();
$ret.=msqlink('',ses('umvcnod'),'').' ';
$ret.=lkt('','/plug/umvoc',picto('link'));
return $ret;}

?>