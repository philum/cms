<?php //umwords
class umwords{
/*static function umwords_findim($v,$xt){$r=explode($xt,$v);
if($r)foreach($r as $v){$p=strrpos($v,'['); if($p)$v=substr($v,$p+1);
	if($v)$ret[]='img/'.$v.$xt;}
return $ret;}*/

static function dicos($v){
$n=sql::call('select id from dicofr where mot like "'.$v.'";','v');
if(!$n)$n=sql::call('select id from dicoen where mot like "'.$v.'";','v');
return $n;}

static function exart($idvoc,$idart,$pos){
return sql('id','qdvoc_b','v',['idvoc'=>$idvoc,'idart'=>$idart,'pos'=>$pos);}

static function ex($v){
return sql('id','qdvoc','v','voc="'.$v.'"');}

static function sav($r){
if($r)foreach($r as $k=>$v)if(!self::ex($v[1]))$rb[]=$v; //pr($rb);
//$nid=sql::qrid('insert into '.qd('umvoc').' values '.sql::atmrb($rb,1));
return $nid;}

static function sav2($v,$o){
[$id,$pos]=explode('-',$o);
$idvoc=self::ex($v);
if(!$idvoc){$idvoc=sql::sav('qdvoc',['voc'=>$v]); $ret='saved '.$v.' ';}
else $ret='word exists ';
$ex=self::exart($idvoc,$id,$pos);
if($idvoc && !$ex){
	$nid=sql::sav('qdvoc_b',['idvoc'=>$idvoc,'idart'=>$id,'pos'=>$pos]);}
else return 'already exists';
return $ret.'added in '.$idvoc.'-'.$nid;}

static function build($p,$o){$ratio=50; $min=$p*$ratio;
if($o)$wh='and pub_art.id='.$o; else $wh='limit '.$limit=$min.', '.($min+$ratio);
$r=sql::inner('pub_art.id,msg','qda','qdm','id','kv','nod="ummo" '.$wh);// and pub_art.id>1689
if($r)foreach($r as $k=>$v){
	$v=str_replace("'",' ',$v); //$v=str_replace('-',' ',$v);
	$rb=str_word_count($v,2);
	if($rb)foreach($rb as $ka=>$va)
		if($va==strtoupper($va) && strlen($va)>1){
			if(!self::dicos($va)){
				if(auth(6)){
					$idvoc=self::ex($va);
					$ex=self::exart($idvoc,$k,$ka);
					$bt=lj('','popup_umwords,sav2__xx_'.ajx($va).'_'.$k.'-'.$ka.'_',picto('ok'));
					if($ex)$bt='';}
				if(!$idvoc)$rd[]=array($k,$va,$ka,soundex($va),$bt);
				//idart,voc,pos,sound
			$rc[$va]=array($k,$va,$ka,soundex($va));}}}
//if(auth(6))self::sav($rc);
return $rd;
$ret=count($rc);
$ret.=tabler($rc);
return $ret;}

static function liaisons($p,$o){
$rb=self::build($p,$o);
/*$r=sql('id,voc','qdvoc','kv','');
foreach($r as $k=>$v)
	if($rb)foreach($rb as $ka=>$va)
		if($va[1]==$v)$rc[]=[$k,$va[0],$va[2]];*/
//if(auth(6))$nid=sql::qrid('insert into '.ses('qdvoc_b').' values '.sql::atmrb($rc,1));
return tabler($rb);
return count($rc);}

static function see($p,$o,$prm){
$p=$prm[0]??$p;
$ret=self::liaisons('',$p);
return $ret;}

static function menu($p,$o,$rid){$ratio=50; $ret='';
$bt=input('inp',$p).' '.lj('',$rid.'_umwords,see_inp',picto('ok')).' ';
$n=sql('count(id)','qda','v',''); $n=ceil($n/$ratio);//id>1689
for($i=0;$i<$n;$i++)$ret.=lj('',$rid.'_umwords,liaisons___'.$i,$i).' ';
return $bt.divc('nbp',$ret);}

static function repair($p,$o){
$r=sql('idvoc,idart,pos','qdvoc_b','','');
foreach($r as $k=>$v)$rb[$v[0]][$v[1]][$v[2]]=1; //pr($rb);
foreach($rb as $k=>$v)foreach($v as $ka=>$va)foreach($va as $kb=>$vb)$rc[]=[$k,$ka,$kb]; pr($rc);
sql::sav2('qdvoc_b1',$rc,1);
return count($rc);}

static function count(){
$r=sql('voc','qdvoc','','');
foreach($r as $k=>$v)$rc[soundex($v[0])]=1;
return count($rc);}

static function affect_arts(){
$r=sql('id,ref','thesaurus','kv','idart=266'); //p($r);
if($r)foreach($r as $k=>$v){
$id=sql('id','qda','v','suj like "['.$v.']%" and re="1" and lg="fr"');
if($id){sql::upd('thesaurus',['idart'=>$id],$k);}}
return count($r);}

static function home($p,$o){$rid='plg'.randid();
ses('thesaurus','thesaurus'); $ret='';
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
ses('qdvoc_b1',qd('umvoc_arts_a'));
$bt=self::menu($p,$o,$rid);
//self::repair($p,$o);
//echo self::count();
//echo self::affect_arts();
return $bt.divd($rid,$ret);}
}
?>