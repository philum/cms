<?php //umwords
class umwords{
/*function umwords_findim($v,$xt){$r=explode($xt,$v);
if($r)foreach($r as $v){$p=strrpos($v,'['); if($p)$v=substr($v,$p+1);
	if($v)$ret[]='img/'.$v.$xt;}
return $ret;}*/

static function umwords_dicos($v){
$n=sql::call('select id from dicofr where mot like "'.$v.'";','v');
if(!$n)$n=sql::call('select id from dicoen where mot like "'.$v.'";','v');
return $n;}

static function ex($v){
return sql('id','qdvoc','v','voc="'.$v.'"');}

static function sav($r){
if($r)foreach($r as $k=>$v)if(!self::ex($v[1]))$rb[]=$v;
$nid=sql::qrid('insert into '.qd('umvoc').' values '.sql::atmrb($rb,1));
return $nid;}

static function build($p,$o){$ratio=50; $min=$p*$ratio;
if($o)$wh='and pub_art.id='.$o;
else $wh='limit '.$limit=$min.', '.($min+$ratio);
$r=sql::inner('pub_art.id,msg','qda','qdm','id','kv','nod="ummo" '.$wh);
if($r)foreach($r as $k=>$v){
	$v=str_replace("'",' ',$v); //$v=str_replace('-',' ',$v);
	$rb=str_word_count($v,2);
	if($rb)foreach($rb as $ka=>$va)
		if($va==strtoupper($va) && !self::dicos($va) && strlen($va)>1){
			$rd[]=array($k,$va,$ka,soundex($va));
			//idart,voc,pos,sound
			$rc[$va]=array($k,$va,$ka,soundex($va));}}
//if(auth(6))self::sav($rc);
return $rd;
$ret=count($rc);
$ret.=tabler($rc);
return $ret;}

static function liaisons($p,$o){
$rb=self::build($p,$o);
$r=sql('id,voc','qdvoc','kv','');
foreach($r as $k=>$v)
	if($rb)foreach($rb as $ka=>$va)
		if($va[1]==$v)$rc[]=[$k,$va[0],$va[2]];
//if(auth(6))$nid=sql::qrid('insert into '.ses('qdvoc_b').' values '.sql::atmrb($rc,1));
return tabler($rb);
return count($rc);}

static function see($p,$o,$prm=[]){
$p=$prm[0]??$p;
$ret=self::liaisons('',$p);
return $ret;}

static function menu($p,$o,$rid){$ratio=50;
$ret=input('inp',$p).' '.lj('',$rid.'_umwords,see_inp',picto('ok')).' ';
$n=sql('count(id)','qda','v','nod="ummo"'); $n=ceil($n/$ratio);
for($i=0;$i<$n;$i++)$ret.=lj('',$rid.'_umwords,liaisons___'.$i,$i).' ';
return divc('nbp',$ret);}

static function home($p,$o){$rid='plg'.randid();
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
$bt=self::menu($p,$o,$rid);
return $bt.divd($rid,'');}
}
?>