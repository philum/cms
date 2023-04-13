<?php //thesaurusw
class thesaurus{
/*static function thr_findim($v,$xt){$r=explode($xt,$v);
if($r)foreach($r as $v){$p=strrpos($v,'['); if($p)$v=substr($v,$p+1);
	if($v)$ret[]='img/'.$v.$xt;}
return $ret;}*/

/*static function thr_sav($p,$o,$prm){$def=$prm[0]??'';
$rb=sql::inner('frm','qdm','qda','id','k','nod="ummo" and substring(frm,1,1)!="_" and frm!="Etudes" and frm!="Blog" and substring(frm,1,2)!="ES" and re>0 and msg like "%'.$p.' %"','');
if($rb)$ref=implode(' ',array_keys($rb));
$defs=array(strtoupper($p),$def,'',$ref);
$r=msql::modif('',ses('umvcnod'),$defs,'push','','');
return umvoc::search($p,'1','');}*/

static function dicos($v){
$n=sql::call('select id from dicofr where mot like "'.$v.'";','v');
if(!$n)$n=sql::call('select id from dicoen where mot like "'.$v.'";','v');
return $n;}

static function ex($v){
return sql('id','qdvoc','v','voc="'.$v.'"');}

static function pg($p,$o){
$n=sqb('count(id)','qdvoc','v','');
$ret=pop::btpages(50,$p?$p:1,$n,'thd_thesaurus,build___');
return $ret;}

static function build($p,$o){if(!$p)$p=1;
$bt=self::pg($p,$o); $ret='';
$r=sqb('id,voc','qdvoc','kv','order by voc limit '.(($p-1)*50).',50');
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_umvoc,segments___'.$v,$v);
return $bt.divc('list',$ret);}

static function liaisons($p,$o){
$rb=self::build($p,$o);
$r=sql('id,voc','qdvoc','kv','');
foreach($r as $k=>$v)
	if($rb)foreach($rb as $ka=>$va)
		if($va[1]==$v)$rc[]=[$k,$va[0],$va[2]];
//if(auth(6))$nid=sql::qrid('insert into '.ses('qdvoc_b').' values '.sql::atmrb($rc,1));
return tabler($rb);
return count($rc);}

static function see($p,$o,$prm){
$p=$prm[0]??$p;
return self::liaisons('',$p);}

static function glossary($p,$o,$prm=[]){
$p=$prm[0]??$p; $ret=''; $ps=soundex($p);//search likes
$r=sql::call('select voc from pub_umvoc where SOUNDEX(voc)="'.$ps.'";','rv');
//$a='MATCH (voc) AGAINST ("'.$p.'")';//IN BOOLEAN MODE
//$r=sql::call('select voc from pub_umvoc where '.$a.'','rv',1); pr($r);
$r=umvoc::levenstein($p,$r);
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_umvoc,segments___'.$v,$v);
if(!$ret)$ret=btn('txtcadr',$p.': '.nms(11).' '.nms(16));
return divc('list',$ret);}

static function menu($p,$o,$rid){$ratio=50;
$j=$rid.'_thesaurus,glossary_inpths__';
$ret=inputj('inpths',$p,$j).' '.lj('',$j,picto('ok')).' ';
//$n=sqb('count(id)','qdvoc','v',''); $n=ceil($n/$ratio);
//for($i=1;$i<=$n;$i++)$ret.=lj('',$rid.'_thesaurus,build___'.$i,$i).' ';
return $ret;}

static function home($p,$o){$rid='thd';
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>