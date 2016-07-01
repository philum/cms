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
$nid=msquery('insert into '.qd('umvoc').' values '.mysqlrb($rb),1);
return $nid;}

function umwords_build($p,$o){$ratio=50; $min=$p*$ratio; $limit=$min.', '.($min+$ratio);
$r=sql_inner('pub_art.id,msg','qda','qdm','id','kv','where nod="ummo" limit '.$limit);
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
$ret.=make_table($rc);
return $ret;}

function umwords_build_liaisons($p,$o){//echo $p;
$rb=umwords_build($p,$o);
$r=sql('id,voc','qdvoc','kv','');
foreach($r as $k=>$v){
	foreach($rb as $ka=>$va){
		if($va[1]==$v){
			$rc[]=array($k,$va[0],$va[2]);
		}
	}
}
//if(auth(6))$nid=msquery('insert into '.ses('qdvoc_b').' values '.mysqlrb($rc),1);
return count($rc);
}

function umwords_menu($p,$o,$rid){$ratio=50;
$n=sql('count(id)','qda','v','nod="ummo"'); $n=ceil($n/$ratio);
for($i=0;$i<$n;$i++)$ret.=lj('',$rid.'_plug__3_umwords_umwords*build*liaisons_'.$i,$i).' ';
return divc('nbp',$ret);}

function plug_umwords($p,$o){$rid='plg'.randid();
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
$bt=umwords_menu($p,$o,$rid);
return $bt.divd($rid,$ret);}

?>