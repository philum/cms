<?php
//philum_plugin_umwords

/*function umwords_findim($v,$xt){$r=explode($xt,$v);
if($r)foreach($r as $v){$p=strrpos($v,'['); if($p)$v=substr($v,$p+1);
	if($v)$ret[]='img/'.$v.$xt;}
return $ret;}*/

function umwords_dicos($v){
$n=sql_b('select id from dicofr where mot like "'.$v.'";','v');
if(!$n)$n=sql_b('select id from dicoen where mot like "'.$v.'";','v');
return $n;}

function umwords_exart($idvoc,$idart,$pos){//
return sql('id','qdvoc_b','v','idvoc="'.$idvoc.'" and idart="'.$idart.'" and pos="'.$pos.'"');}

function umwords_ex($v){
return sql('id','qdvoc','v','voc="'.$v.'"');}

function umwords_sav($r){
if($r)foreach($r as $k=>$v)if(!umwords_ex($v[1]))$rb[]=$v; //pr($rb);
//$nid=qrid('insert into '.qd('umvoc').' values '.mysqlrb($rb,1));
return $nid;}

function umwords_sav2($v,$o){//echo $p.'-'.$o;
list($id,$pos)=explode('-',$o);
$idvoc=umwords_ex($v);
if(!$idvoc){$idvoc=insert('qdvoc',mysqlra(['voc'=>$v],1)); $ret='saved '.$v.' ';}
else $ret='word exists ';
$ex=umwords_exart($idvoc,$id,$pos);
if($idvoc && !$ex){$rb=['idvoc'=>$idvoc,'idart'=>$id,'pos'=>$pos];
	$nid=insert('qdvoc_b',mysqlra($rb,1));}
else return 'already exists';
return $ret.'added in '.$idvoc.'-'.$nid;}

function umwords_build($p,$o){$ratio=50; $min=$p*$ratio;
if($o)$wh='and pub_art.id='.$o; else $wh='limit '.$limit=$min.', '.($min+$ratio);
$r=sql_inner('pub_art.id,msg','qda','qdm','id','kv','where nod="ummo" '.$wh);// and pub_art.id>1689
if($r)foreach($r as $k=>$v){
	$v=str_replace("'",' ',$v); //$v=str_replace('-',' ',$v);
	$rb=str_word_count($v,2);
	if($rb)foreach($rb as $ka=>$va)
		if($va==strtoupper($va) && strlen($va)>1){
			if(!umwords_dicos($va)){
				if(auth(6)){
					$idvoc=umwords_ex($va);
					$ex=umwords_exart($idvoc,$k,$ka);
					$bt=lj('','popup_plup__xx_umwords_umwords*sav2_'.ajx($va).'_'.$k.'-'.$ka.'_',picto('ok'));
					if($ex)$bt='';}
				if(!$idvoc)$rd[]=array($k,$va,$ka,soundex($va),$bt);
				//idart,voc,pos,sound
			$rc[$va]=array($k,$va,$ka,soundex($va));}}}
//if(auth(6))umwords_sav($rc);
return $rd;
$ret=count($rc);
$ret.=tabler($rc);
return $ret;}

function umwords_build_liaisons($p,$o){
$rb=umwords_build($p,$o);
/*$r=sql('id,voc','qdvoc','kv','');
foreach($r as $k=>$v)
	if($rb)foreach($rb as $ka=>$va)
		if($va[1]==$v)$rc[]=array($k,$va[0],$va[2]);*/
//if(auth(6))$nid=qrid('insert into '.ses('qdvoc_b').' values '.mysqlrb($rc,1));
return tabler($rb);
return count($rc);}

function umwords_see($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=umwords_build_liaisons('',$p);
return $ret;}

function umwords_menu($p,$o,$rid){$ratio=50;
$bt=input('inp',$p).' '.lj('',$rid.'_plug__2_umwords_umwords*see___inp',picto('ok')).' ';
$n=sql('count(id)','qda','v',''); $n=ceil($n/$ratio);//id>1689
for($i=0;$i<$n;$i++)$ret.=lj('',$rid.'_plug__3_umwords_umwords*build*liaisons_'.$i,$i).' ';
return $bt.divc('nbp',$ret);}

function umwords_repair($p,$o){
$r=sql('idvoc,idart,pos','qdvoc_b','','');
foreach($r as $k=>$v)$rb[$v[0]][$v[1]][$v[2]]=1; //pr($rb);
foreach($rb as $k=>$v)foreach($v as $ka=>$va)foreach($va as $kb=>$vb)$rc[]=[$k,$ka,$kb]; pr($rc);
insert('qdvoc_b1',mysqlrb($rc,1),1);
return count($rc);}

function umwords_count(){
$r=sql('voc','qdvoc','','');
foreach($r as $k=>$v)$rc[soundex($v[0])]=1;
return count($rc);}

function affect_arts(){
$r=sqb('id,ref','thesaurus','kv','where idart=266'); p($r);
if($r)foreach($r as $k=>$v){
$id=sql('id','qda','v','suj like "['.$v.']%" and re="1" and lg="fr"');
if($id){update('thesaurus','idart',$id,'id',$k);}}
return count($r);}

function plug_umwords($p,$o){$rid='plg'.randid();
ses('thesaurus','thesaurus');
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
ses('qdvoc_b1',qd('umvoc_arts_a'));
$bt=umwords_menu($p,$o,$rid);
//umwords_repair($p,$o);
//echo umwords_count();
//echo affect_arts();
return $bt.divd($rid,$ret);}

?>