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

function umwords_ex($v){
return sql('id','qdvoc','v','voc="'.$v.'"');}

function umwords_sav($r){
if($r)foreach($r as $k=>$v)if(!umwords_ex($v[1]))$rb[]=$v;
$nid=qrid('insert into '.qd('umvoc').' values '.mysqlrb($rb,1));
return $nid;}

function umwords_build($p,$o){$ratio=50; $min=$p*$ratio;
if($o)$wh='and pub_art.id='.$o;
else $wh='limit '.$limit=$min.', '.($min+$ratio);
$r=sql_inner('pub_art.id,msg','qda','qdm','id','kv','where nod="ummo" '.$wh);
if($r)foreach($r as $k=>$v){
	$v=str_replace("'",' ',$v); //$v=str_replace('-',' ',$v);
	$rb=str_word_count($v,2);
	if($rb)foreach($rb as $ka=>$va)
		if($va==strtoupper($va) && !umwords_dicos($va) && strlen($va)>1){
			$rd[]=array($k,$va,$ka,soundex($va));
			//idart,voc,pos,sound
			$rc[$va]=array($k,$va,$ka,soundex($va));}}
//if(auth(6))umwords_sav($rc);
return $rd;
$ret=count($rc);
$ret.=tabler($rc);
return $ret;}

function umwords_build_liaisons($p,$o){
$rb=umwords_build($p,$o);
$r=sql('id,voc','qdvoc','kv','');
foreach($r as $k=>$v)
	if($rb)foreach($rb as $ka=>$va)
		if($va[1]==$v)$rc[]=array($k,$va[0],$va[2]);
//if(auth(6))$nid=qrid('insert into '.ses('qdvoc_b').' values '.mysqlrb($rc,1));
return tabler($rb);
return count($rc);}

function umwords_see($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=umwords_build_liaisons('',$p);
return $ret;}

function umwords_menu($p,$o,$rid){$ratio=50;
$ret=input('inp',$p).' '.lj('',$rid.'_plug__2_umwords_umwords*see___inp',picto('ok')).' ';
$n=sql('count(id)','qda','v','nod="ummo"'); $n=ceil($n/$ratio);
for($i=0;$i<$n;$i++)$ret.=lj('',$rid.'_plug__3_umwords_umwords*build*liaisons_'.$i,$i).' ';
return divc('nbp',$ret);}

function plug_umwords($p,$o){$rid='plg'.randid();
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
$bt=umwords_menu($p,$o,$rid);
return $bt.divd($rid,$ret);}

?>