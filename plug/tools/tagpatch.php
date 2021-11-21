<?php
//philum_plugin_tagpatch

function erase_unused_datas(){
qr('ALTER TABLE '.ses('qdd').' DROP day, DROP cat;'); $ret.='datas deleted';
qr('UPDATE '.ses('qda').' SET thm=""'); $ret.='old tags deleted';
return $ret;}

function tagpatch_j($p,$o,$res=''){$p=$p?$p:0;
$r=sql('id,thm','qda','kv','id>'.$p.' limit 10000'); 
if($r)foreach($r as $k=>$v){$r[$k]=tri_tag($v);
	foreach($r[$k] as $ka=>$va){if($va){$ra[$va]+=1; $rb[$k][]=$va;}}}
//pr($ra);
if($ra)foreach($ra as $k=>$v){
	$idtag=sql('id','qdt','v','cat="tag" and tag="'.$k.'"');
	if(!$idtag)$idtag=insert('qdt','(NULL,"tag","'.$k.'")');
	//echo $idtag.':'.$k.br();
	$rtag[$k]=$idtag;}
//pr($rb);
if($rb)foreach($rb as $k=>$v){
	foreach($v as $ka=>$va){
		$idtag=$rtag[$va];
		if($idtag)$ex=sql('id','qdta','v','idart="'.$k.'" and idtag="'.$idtag.'"');
		if(!$ex)insert('qdta','(NULL,"'.$k.'","'.$idtag.'")');
		//echo $ex.'/'.$k.':'.$va.'-'.$idtag.br();
		}
}
$ret=$p.':'.sql('count(id)','qdt','v','').'-'.sql('count(id)','qdta','v','');
return $ret;}

function tagpatch_u($p,$o,$res=''){//$p='type';
$p=utf8_decode($p);
$r=sql('ib,msg','qdd','kv','val="'.$p.'"');//id>'.$p.' limit 10000
foreach($r as $k=>$v){$r[$k]=tri_tag($v);
	foreach($r[$k] as $ka=>$va){if($va){$ra[$va]+=1; $rb[$k][]=$va;}}}
//p($rb);
foreach($ra as $k=>$v){
	$idtag=sql('id','qdt','v','cat="'.$p.'" and tag="'.$k.'"');
	if(!$idtag)$idtag=insert('qdt','(NULL,"'.$p.'","'.$k.'")');
	$rtag[$k]=$idtag;}
foreach($rb as $k=>$v){
	foreach($v as $ka=>$va){
		$idtag=$rtag[$va];
		$ex=sql('id','qdta','v','idart="'.$k.'" and idtag="'.$idtag.'"');
		if(!$ex)insert('qdta','(NULL,"'.$k.'","'.$idtag.'")');}
}
$ret=$p.':'.sql('count(id)','qdt','v','').'-'.sql('count(id)','qdta','v','');
return $ret;}

function define_interm3(){
$sql='select cat,tag,idart from '.ses('qdt').' 
inner join '.ses('qdta').' on '.ses('qdt').'.id='.ses('qdta').'.idtag
inner join '.ses('qda').' on '.ses('qda').'.id='.ses('qdta').'.idart
where day>'.calc_date(7).'';
$r=sql_b($sql,'kkk');//
foreach($r as $k=>$v){
	$rb[$v[0]][$v[1]][]=$v[2];//interm
	$rc[$v[2]][$v[0]][]=$v[1];//meta
}
return $r;}

//patch tags
function plug_tagpatch($p,$o){$rid='plg'.randid(); return;
$bt=btn('popsav','Transfert datas to the new tables').br();
ses('qdt','pub_meta'); ses('qdta','pub_meta_art'); ses('qdtag','pub_tag');
$n=12;//req('spe'); echo $n=ceil(lastid('qda')/10000);
for($i=0;$i<$n;$i++)$bt.=lj('txtbox',$rid.'_plug__3_tagpatch_tagpatch*j_'.($i*10000),$i);//jb
//patch user_tags
if(prmb(18)){$utags=explode(' ',prmb(18)); $ico=explode(' ',prmb(19));
foreach($utags as $k=>$v)$bt.=lj('txtbox',$rid.'_plug__2_tagpatch_tagpatch*u_'.ajx($v),$v).' ';}

if($p=='finalize')erase_unused_datas();
else $ret.=lkc('popsav','/plug/tagpatch/finalize','Finalize (delete unused datas !)');
//req('meta'); $ret=admin_tags($p?($p):'tag');//utf8_encode
return $bt.divd($rid,$ret);}

?>