<?php
//philum_plugin_thesaurus

/*function thr_findim($v,$xt){$r=explode($xt,$v);
if($r)foreach($r as $v){$p=strrpos($v,'['); if($p)$v=substr($v,$p+1);
	if($v)$ret[]='img/'.$v.$xt;}
return $ret;}*/

/*function thr_sav($p,$o,$res){$def=ajxg($res);
$rb=sql_inner('frm','qdm','qda','id','k','where nod="ummo" and substring(frm,1,1)!="_" and frm!="Etudes" and frm!="Blog" and substring(frm,1,2)!="ES" and re>0 and msg like "%'.$p.' %"','');
if($rb)$ref=implode(' ',array_keys($rb));
$defs=array(strtoupper($p),$def,'',$ref);
$r=msql::modif('',ses('umvcnod'),$defs,'push','','');
return ud_search($p,'1','');}*/

function thr_dicos($v){
$n=sql_b('select id from dicofr where mot like "'.$v.'";','v');
if(!$n)$n=sql_b('select id from dicoen where mot like "'.$v.'";','v');
return $n;}

function thr_ex($v){
return sql('id','qdvoc','v','voc="'.$v.'"');}

function thr_pg($p,$o){req('spe');
$n=sqb('count(id)','qdvoc','v','');
$ret=btpages(50,$p?$p:1,$n,'thd_plug__3_thesaurus_thr*build_');
return $ret;}

function thr_build($p,$o){if(!$p)$p=1;
$bt=thr_pg($p,$o); $ret='';
$r=sqb('id,voc','qdvoc','kv','order by voc limit '.(($p-1)*50).',50');
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_plup___umvoc_ud*segments_'.$v,$v);
return $bt.divc('list',$ret);}

function thr_build_liaisons($p,$o){
$rb=thr_build($p,$o);
$r=sql('id,voc','qdvoc','kv','');
foreach($r as $k=>$v)
	if($rb)foreach($rb as $ka=>$va)
		if($va[1]==$v)$rc[]=array($k,$va[0],$va[2]);
//if(auth(6))$nid=qrid('insert into '.ses('qdvoc_b').' values '.mysqlrb($rc,1));
return tabler($rb);
return count($rc);}

function thr_see($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=thr_build_liaisons('',$p);
return $ret;}

function thr_glossary($p,$o,$res){
list($p,$o)=ajxp($res,$p,$o); $ps=soundex($p);//search likes
$r=sql_b('select voc from pub_umvoc where SOUNDEX(voc)="'.$ps.'";','rv');
//$a='MATCH (voc) AGAINST ("'.$p.'")';//IN BOOLEAN MODE
//$r=sql_b('select voc from pub_umvoc where '.$a.'','rv',1); pr($r);
reqp('umvoc'); $r=ud_levenstein($p,$r);
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_plup___umvoc_ud*segments_'.$v,$v);
if(!$ret)$ret=btn('txtcadr',$p.': '.nms(11).' '.nms(16));
return divc('list',$ret);}

function thr_menu($p,$o,$rid){$ratio=50;
$j=$rid.'_plug__2_thesaurus_thr*glossary___inpths';
$ret=inputj('inpths',$p,$j).' '.lj('',$j,picto('ok')).' ';
//$n=sqb('count(id)','qdvoc','v',''); $n=ceil($n/$ratio);
//for($i=1;$i<=$n;$i++)$ret.=lj('',$rid.'_plug__3_thesaurus_thr*build_'.$i,$i).' ';
return $ret;}

function plug_thesaurus($p,$o){$rid='thd';
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
$bt=thr_menu($p,$o,$rid);
$ret=thr_build($p,$o);
return $bt.divd($rid,$ret);}

?>