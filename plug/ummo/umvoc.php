<?php
//philum_plugin_umvoc

function umv_r(){
return msql::read('users','ummo_umvoc_1','',1);}

function umvr(){$r=umv_r();
foreach($r as $k=>$v)$rb[$v[0]]=$v[0]; sort($rb);
return $rb;}

function uds_btn($k,$r){
//$rb=['word','name','expression','unit','math'];
$ret=isset($r[2])?' ('.$r[2].') ':' ';
$ret.=lj('','popup_search___'.ajx($r[0]),picto('search',16)).' ';
if($r[3])$ret.=' ['.$r[3].'] ';
if(auth(6))$ret.=lj('popbt','popup_plup___umvoc_umvcmdf_'.$k,picto('editxt'));
$ret.=ud_glyphe($r[0]).br();
return hr().balb('b',$r[0]).$ret.divc('panel',nl2br(stripslashes($r[1])));}

//edit
function umvcsav($p,$o,$res){$def=ajxg($res);
$rb=sql_inner('distinct(frm)','qdm','qda','id','rv','where nod="ummo" and substring(frm,1,1)!="_" and frm!="Etudes" and frm!="Blog" and substring(frm,1,2)!="ES" substring(frm,1,2)!="EN" and re>0 and msg like "%'.$p.' %"','');
if($rb)$ref=implode(' ',$rb); else $ref='';
$defs=[strtoupper($p),$def,'word',$ref];
$r=msql::modif('','ummo_umvoc_1',$defs,'push','','');
return ud_search($p,'1','');}

function umvcadd($p){$ret=textarea('addvoc','',34,1).' ';
$ret.=lj('popsav','ucbk_plug___umvoc_umvcsav_'.ajx($p).'__addvoc',pictxt('save',nms(92)));
return $ret;}

function umvcmdfsav($p,$o,$res){$r=ajxr($res); $r=arr($r,4);
msql::modif('','ummo_umvoc_1',$r,'row','',$p);
return ud_search($r[0],'1','');}

function umvcmdf($p){
$r=msql::read('users','ummo_umvoc_1',$p);
$ret=input('mdfvoc',$r[0]).' ';
$ret.=select(atd('mdftyp'),['word','name','expression','unit','number'],'vv',$r[2]).br();
$ret.=textarea('mdftxt',$r[1],40,4).br();
$ret.=hidden('','mdfref',$r[3]);
$ids='mdfvoc|mdftxt|mdftyp|mdfref';
$ret.=lj('popsav','ucbk_plug___umvoc_umvcmdfsav_'.ajx($p).'__'.$ids,pictxt('save',nms(57)));
return $ret;}

function ud_imz($f,$n='2'){
list($w,$h)=fwidth($f);
$w=round($w/$n);$h=round($h/$n);
return image('/'.$f,$w,$h);}

function ud_glyphe($p){
$f='users/ummo/glyphes/'.strtoupper($p).'.png';
if(is_file($f))return ud_imz($f,6);
return oomo(strtoupper(str_replace(' ','-',$p)),36,'bkg');}

//glossaire
function ud_segment($id,$pos){
$d=sql('msg','qdm','v','id='.$id);
$t=sql('suj','qda','v','id='.$id); 
$ret=lj('txtcadr','popup_popart__3_'.$id.'_3',$t).br();
$ret.=substr($d,$pos-50,100);
return $ret;}

function ud_segments($p){//occurrences
$r=sql_inner('idart,pos','qdvoc','qdvoc_b','idvoc','','where voc="'.$p.'" group by pos order by idart');
$ret=divc('txtcadr',$p.' : '.nbof(count($r),19)).br();
if($r)foreach($r as $k=>$v){
	$va=ud_segment($v[0],$v[1]); $va=str_replace($p,btn('stabilo',$p),$va);
	$ret.=divc('tracks',$va).br();}
return $ret;}

function ud_glossary($p,$o){$ps=soundex($p);//search likes
$r=sql_b('select voc from pub_umvoc where SOUNDEX(voc)="'.$ps.'";','rv');
$r=ud_levenstein($p,$r); $ret='';
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_plup___umvoc_ud*segments_'.$v,$v);
if(!$ret)$ret=btn('txtcadr',$p.': '.nms(11).' '.nms(16));
return divc('list',$ret);}

function ud_levenstein($p,$r){
if($r)foreach($r as $v){$lev=levenshtein($p,$v); $rb[$lev][]=$v;}
if($rb){ksort($rb); foreach($rb as $v)foreach($v as $vb)$rc[]=$vb;}
return $rc;}

/*function ud_levenstein($p,$r){//correction orthographique
foreach($r as $v){$lev=levenshtein($p,$v);
	if($lev==0){$closest=$v; $shortest=0; break;}
	if($lev<=$shortest || $shortest<0){$closest=$word; $shortest=$lev;}}
if($shortest)echo 'nearest existing word';
return $closest;}*/

//search
function ud_result($p,$r,$ka){$n=count($r);
$t1='Recherche littérale'; $t2='Glossaire';
$search=lj('popbt','popup_search___'.ajx(strtolower($p)),pictxt('search',$t1)).' ';
//$search.=lj('popbt','popup_plup___umvoc_ud*glossary_'.$p.'_'.$o,pictxt('view',$t2)).' ';
$search.=lj('popbt','popup_plupin___bdvoc_'.ajx($p),pictxt('search','BD-voc')).' ';
//$search.=togbub('plug','umvoc_ud*glossary_'.$p,picto('view')).' ';
$glyphe=ud_glyphe($p);
$ret=implode('',$r).br();
if(auth(6))$sav=umvcadd(strtoupper($p)).br();
if(!$ret)return btn('txtcadr',$search.$glyphe.' '.nms(11).' '.nms(16)).br().$sav;
return btn('txtcadr',$n.' '.plurial($n,16)).' '.$search.$glyphe.$sav.$ret;}

function ud_find($p,$o,$res){list($p,$o)=ajxp($res,$p,$o);
$p=trim($p); $r=umv_r(); if(!$p)return; $ret=[];
if($r)foreach($r as $k=>$v){$v=arr($v,4);
	if(strpos($v[1],$p)!==false)$ret[]=uds_btn($k,$v);}
return ud_result($p,$ret,'');}

function ud_search($p,$o,$res){list($p,$o)=ajxp($res,$p,$o);
$p=strtolower(trim($p)); $ps=soundex($p); $r=umv_r(); if(!$p)return; $ret=[]; $rb=[]; $ka=0;
if($r)foreach($r as $k=>$v){$voc=strtolower($v[0]); $vcb=soundex($voc); $v=arr($v,4);
	if($o){if($vcb==$ps){$ret[]=uds_btn($k,$v); $rb[]=levenshtein($p,$voc);}}
	elseif(strpos($voc,$p)!==false){$ret[]=uds_btn($k,$v); $ka=$k;}}
if($rb){$rc=[]; asort($rb); foreach($rb as $k=>$v)$rc[]=$ret[$k]; $ret=$rc;}
return ud_result($p,$ret,$ka);}

function slct_j_r($p,$o){$r=umv_r(); $ret='';
if($r)foreach($r as $k=>$v){$d=addslashes($v[0]);
$ret.=ljb('',atjr('jumpvalue',['usrch',$d]).'; '.sj('ucbk_plug___umvoc_ud*search_'.$d.'_1').'; clpop(event);','',$v[0]);}
return divc('nbp list',$ret);}

function slct_j($d){$rid='bt'.randid(); $bt=btn('popbt','select...');
return togbub('plug','umvoc_slct*j*r_'.$d.'_'.$rid,$bt);}

function plug_umvoc($p,$o){
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
ses('dico','dicoum');
$ret=slct_j($p).' ';
//$ret.=lj('','usrch___4',picto('del')).' ';
$j='ucbk_plug___umvoc_ud*search_'.ajx($p).'__usrch|udsnd';
$ret.=inputj('usrch',$p,$j).' ';
$ret.=checkbox_j('udsnd',1,'soundex');//|chk
$ret.=lj('popsav',$j,'chercher').' ';
$j='ucbk_plug___umvoc_ud*find_'.ajx($p).'__usrch|udsnd';
$ret.=lj('popsav',$j,'trouver').' ';
$ret.=hlpbt('levenshtein').br().br();
$ret.=divd('ucbk',ud_search($p,'1','')).br();
$ret.=msqbt('','ummo_umvoc_1','').' ';
$ret.=lkt('','/plug/umvoc',picto('link'));
return $ret;}

?>