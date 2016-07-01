<?php
//philum_plugin_umvoc

function umv_r(){
return msql_read('users',ses('umvcnod'),'',1);}

function umvr(){$r=umv_r();
foreach($r as $k=>$v)$rb[$v[0]]=$v[0]; sort($rb);
return $rb;}

function uds_btn($r){
$rb=array('vocable','name','planet','unit','math');
$ret=$rb[$r[2]]?' ('.$rb[$r[2]].') ':' ';
$ret.=lj('','popup_search___'.ajx($r[0]),picto('search',16)).' ';
if($r[3])$ret.=' ['.$r[3].'] ';
$ret.=ud_glyphe($r[0]).br();
return hr().bal('b',$r[0]).$ret.divc('justy',nl2br(stripslashes($r[1])));}

//edit
function umvcsav($p,$o,$res){$def=ajxg($res);
$rb=sql_inner('frm','qdm','qda','id','k','where nod="ummo" and substring(frm,1,1)!="_" and frm!="études" and frm!="Idéogrammes" and frm!="AiooyaaOaxiiboo" and re>0 and msg like "% '.$p.' %"',''); if($rb)$ref=implode(' ',array_keys($rb));
$defs=array(strtoupper($p),$def,'',$ref);
msql_modif('',ses('umvcnod'),$defs,'','push','');
return ud_search($p,'1','');}

function umvcadd($p){
$ret=input(1,'addvoc','').' ';
$ret.=lj('popsav','ucbk_plug___umvoc_umvcsav_'.ajx($p).'__addvoc',pictxt('save',nms(92)));
return $ret;}

function ud_imz($f,$n='2'){
list($w,$hb)=fwidth($f);
$w=round($w/$n);$h=round($h/$n);
return image('/'.$f,$w,$h);}

function ud_glyphe($p){
$f='users/ummo/glyphes/'.strtoupper($p).'.png';
if(is_file($f))return ud_imz($f,6);}

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
$r=ud_levenstein($p,$r);
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_plup___umvoc_ud*segments_'.$v,$v);
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
function ud_search($p,$o,$res){list($p,$o)=ajxp($res,$p,$o);
$p=strtolower(trim($p)); $ps=soundex($p); $r=umv_r(); if(!$p)return;
if($r)foreach($r as $k=>$v){$voc=strtolower($v[0]); $vcb=soundex($voc);
if($o){if($vcb==$ps)$ret[]=uds_btn($v);}
elseif($voc==$p)$ret[]=uds_btn($v);}
$n=count($ret);
$t1='Recherche littérale';
$t2='Glossaire';
$search=lj('','popup_search___'.ajx(strtoupper($p)),pictxt('search',$t1)).' ';
$search.=lj('','popup_plup___umvoc_ud*glossary_'.$p.'_'.$o,pictxt('view',$t2)).' ';
//$search.=togbub('plug','umvoc_ud*glossary_'.$p,picto('view')).' ';
$glyphe=ud_glyphe($p).br();
if($ret)$ret=implode('',$ret).br();
if(auth(6))$sav=umvcadd($p).br();
if(!$ret)return btn('txtcadr',nms(11).' '.nms(16)).' '.$search.$glyphe.br().$sav;
return btn('txtcadr',$n.' '.plurial($n,16)).' '.$search.$glyphe.$ret.$sav;}

function slct_j_r($p,$o){$r=umv_r();
if($r)foreach($r as $k=>$v){$d=addslashes($v[0]);
$ret.=ljb('','jumpvalue(\'usrch_'.ajx($d).'\'); SaveJ(\'ucbk_plug___umvoc_ud*search_'.$d.'_1\'); clpop(event);','',$v[0]);}
return divc('nbp list',$ret);}

function slct_j($d){$rid='bt'.randid(); $bt=btn('popbt','select...');
return togbub('plug','umvoc_slct*j*r_'.$d.'_'.$rid,$bt);}

function plug_umvoc($p,$o){
ses('nl',1);
ses('umvcnod','ummo_umvoc_1');
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
$ret=slct_j($p).' ';
$ret.=lj('','usrch___4',picto('del')).' ';
$ret.=input(1,'usrch',$p,'').' ';
$ret.=lj('popsav','ucbk_plug___umvoc_ud*search_'.ajx($p).'__usrch|udsnd','chercher').' ';
$ret.=checkbox_j('udsnd',1,'soundex').br().br();//|chk
$ret.=divd('ucbk',ud_search($p,'1','')).br();
$ret.=msqlink('',ses('umvcnod'),'').' ';
$ret.=lkt('','/plug/umvoc',picto('link'));
return $ret;}

?>