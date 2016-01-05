<?php
//philum_ajax_meta

function utag_sav($id,$val,$msg){$msg=trim($msg);//space mean erase
list($vrf,$msb)=sql('id,msg','qdd','r','ib="'.$id.'" AND val="'.$val.'"');
if($val=='folder')$msg=ajx($msg,1);
if($vrf && !$msg)delete('qdd',$vrf);//delete //$val;
elseif(!$vrf && $msg)insert('qdd','("", "'.$id.'", "'.$_SESSION['qb'].'", "'.$val.'", "'.$msg.'");');//saved //$val
elseif($msb!=$msg)update("qdd","msg",$msg,"id",$vrf);//modif //$vrf->$msg
$_SESSION['daya']=time();}

function getjx($d){$d=$_GET[$d]; if($d==' ')return;
return ajx(str_replace(array("<",">","%u2019"),array("","","'"),$d),1);}
function cache_value($id,$n,$v){
if($_SESSION['rqt'][$id])$_SESSION['rqt'][$id][$n]=$v;}

function save_tits_j($id){$qda=$_SESSION['qda']; $wh='id='.$id.'';
if($ib=getjx('ib')){$sql.='ib="'.$ib.'", '; cache_value($id,10,$ib);}
if($cat=getjx('frm1')){$sql.='frm="'.$cat.'", '; cache_value($id,1,$cat);}
if($suj=clean_title(getjx('suj'))){$sql.='suj="'.$suj.'", '; cache_value($id,2,$suj);}
if($img=getjx('img')){$sql.='img="'.$img.'", '; cache_value($id,3,$img);}
if($src=getjx('src')){$sql.='mail="'.$src.'", '; cache_value($id,9,$src);}
if($sql)msquery('update '.$qda.' set '.substr($sql,0,-2).' where '.$wh.';');
$r=$_SESSION['art_options'];
$rdata=sql('val,msg','qdd','kv','ib="'.$id.'"');
if($r)foreach($r as $k=>$v){
	$val=$rdata[$v];
	$gv=ajx($_GET[$v],1);
	if($v=="related" or $v=="float_img" or $v=="template" or $v=="folder")$vrf=' ';
	if($v=="authlevel"){if(rstr(21))$vrf="1"; else $vrf="all";}
	if($v=="tracks"){if(rstr(1))$vrf='true'; else $vrf='false';
		$gv=$gv==1?'true':'false';}
	if($v=="2cols"){if(rstr(17))$vrf='true'; else $vrf='false';
		$gv=$gv==1?'true':'false';}
	if($v=="lang"){$vrf=prmb(25);
		$arr=explode(' ',prmb(26));
		if($arr)foreach($arr as $ka=>$va){
		$valb=$rdata['lang'.$va];
		if($_GET['lang'.$va]==$vrf && $val)$_GET['lang'.$va]=' ';
		if($_GET['lang'.$va] && $_GET['lang'.$va]!=$valb){
			utag_sav($id,'lang'.$va,$_GET['lang'.$va]);}}}
	if(!$val)$val=$vrf;//permut value with global setting
	if($gv==$vrf && $val)$gv=" ";//erase if not usefull
	if($gv && $gv!=$val)utag_sav($id,$v,$gv);}}

function same_suj($suj){
$r=sql('id','qda','k','suj="'.$suj.'" AND nod="'.$_SESSION['qb'].'" ORDER BY id DESC');
foreach($r as $k=>$v){if($k!=$_SESSION["read"])$ret.=lka('/?read='.$k,$k).' ';}
if($ret)return btn('txtsmall','with_same_title: '.$ret);}

function prior_sav($v,$id){update('qda',"re",$v,"id",$id); cache_value($id,11,$v);
return prior_edit($v,$id);}

function prior_edit($va,$id){$css='popbt';
$r=array(2=>picto('s1'),3=>picto('s2'),4=>picto('s3'));//0=>nms(30),1=>nms(29),
if($va==0)$ret.=lkc($css,'/?read='.$id.'&trash_art='.$id,picto('trash')).'';
if($va==0)$ret.=lkc($css.' active" title="'.nms(43),'/?read='.$id.'&delete_art='.$id,picto('del')).'';
$ret.=ljc($css,'rdbt'.$id,'meta_prior*sav_'.($va==0?1:0).'_'.$id,offon($va)).' ';
foreach($r as $k=>$v){$c=$k==$va?'active':''; 
	$j='rdbt'.$id.'_call___meta_prior*sav_'.($k==$va?1:$k).'_'.$id;
	$js=' var ob=document.getElementById(\'art\'+'.$id.'); ';
	if($k)$js.='ob.className=ob.className.replace(\'tab hide\',\'tab\');';
	else $js.='ob.className=ob.className.replace(\'tab\',\'tab hide\');';
	$ret.=balb('a',atc($css.' '.$c).atb('onclick',sj($j).$js),$v).'';}
return $ret;}

function edit_day($d,$id){
if($id && auth(5)){$r=explode('-',$d); 
$day=mktime($r[3],$r[4],0,$r[1],$r[2],$r[0]); update("qda","day",$day,"id",$id);
return lj('popw','chday'.$id.'_chday___'.$id,'date');}
else{$day=date('Y-m-d-H-i',rse("day", $_SESSION['qda'].' WHERE id="'.$d.'"'));
return input(1,'chd'.$d,$day,'').lj('popw','chday'.$d.'_chday_chd'.$d.'__'.$d,'ok');}}

function edit_dpl($id,$css){$use=$_SESSION['USE'];
if(auth(5)){$ret.=lj($css,'popup_deploy___'.$id,picto('mail')).'';
	$ret.=lj($css,'popup_export___'.$id,picto('export')).'';}
return $ret;}

function edit_tits($id,$prw){$css='poph';
list($ib,$day,$src,$suj,$frm,$img,$thm,$re)=sql('ib,day,mail,suj,frm,img,thm,re','qda','r','id="'.$id.'" LIMIT 1'); $csb='';
$nk='checkEnter(event,\'formtit'.$id.'\');';
$ret.=submitj('','formtit'.$id,pictxt('save',nms(57)));//save
$ret.=select_j('ib'.$id,'parent',$ib,'',picto('topo'),1);
$ret.=ljb($css,"jumpvalue",'ib'.$id.'_/',picto('no')).' ';
if(auth(2))$ret.=btd('rdbt'.$id,prior_edit($re,$id)).' ';//priority
$ret.=lj($css,'popup_track___'.$id,picto('forum')).'';
$ret.=edit_dpl($id,$css).'';//deploy
if(auth(2))$ret.=btd('chday'.$id,lj('','chday'.$id.'_chday___'.$id,picto('time'))).'';
$ret.=balise('textarea',array(3=>'suj'.$id,5=>'editor',16=>'height:34px; width:100%;'),$suj).br();//suj
$ret.=lj('poph','popup_placeim___'.$id,picto('img')).balise("input",array('','text','','img'.$id,$img,$csb,'36',255,$nk),'').lj('poph','img'.$id.'_recenseim__4_'.$id,picto('up',14)).br();//img
$ret.=lj('poph','',picto('link')).balise("input",array('','text','','src'.$id,$src,$csb,'36',255,$nk),'').br();//src
$ret.=edit_frm($id,$frm);
$ret.=edit_tags($id,'tag','tag');
if(prmb(18)){//user_tags
	$utags=explode(' ',prmb(18)); $ico=explode(' ',prmb(19));
	foreach($utags as $k=>$v)$ret.=edit_tags($id,$v,$ico[$k]);}
$ret.=art_options($id);//art_options
$dn=array('ib','suj','img','src','frm1');
foreach($_SESSION['art_options'] as $k=>$v)$dn[]=$v;
$r=explode(' ',prmb(26)); if($r)foreach($r as $k=>$v)$dn[]='lang'.$v;//lang
$js='SaveTits(\''.$id.'\',\''.implode('|',$dn).'\',\''.$prw.'\')';
$ret='<form id="formtit'.$id.'" action="javascript:'.$js.'">'.$ret.'</form>';
return $ret;}

//edit frm
function edit_frm($id,$frm,$sav=''){
$auto=lj('','slctfrm'.$id.'_call__3_meta_slct*frm_'.$id.'_'.ajx($cat),picto('folder2'));
$inp=input('','frm1'.$id,$frm,'',0,12);
return divc('nbp',$picto.$auto.$inp.btd($rid,$ret).divd('slctfrm'.$id,''));}

function slct_frm($id,$frm){
$r=sql('frm','qda','k','nod="'.ses('qb').'" and frm!="_system" and frm!="_trash" AND day>"'.calc_date("360").'" order by frm');
if($r)foreach($r as $k=>$v){
	$ret.=lja(atj('jumpvalue','frm1'.$id.'_'.ajx($k)).atj('Close','popup'),$k).' ';}
return divc('nbp',$ret);}

//translations
function lang_arts_auto($id,$va){req('spe');
$artlang=data_val('msg',$id,'lang');
if(!$artlang)$artlang=prmb(25);
$r=sql('ib','qdd','k','val="lang'.$artlang.'" AND msg="'.$id.'"');
if($r)foreach($r as $k=>$v){
	$artref=data_val('msg',$k,'lang');
	if(!$artref && $va==prmb(25))$ret=$k;
	if($artref==$va)$ret=$k;}
if(!$ret && $k)$ret=data_val('msg',$k,'lang'.$va);
return $ret;}

//options
function art_options($id){
$r=$_SESSION["art_options"]; $arl=explode(' ',prmb(26));
$rdata=sql('val,msg','qdd','kv','ib="'.$id.'"');
if($r)foreach($r as $k=>$v){$val=$rdata[$v]; $hlp='';
	if($v=='folder')$j='popup_addfolder___'.$id; else $j=''; 
	if($j)$ret.=picto('virtual').lj('poph',$j,$v).' '; 
	if($v=='related'){$picto='articles'; $hlp=hlpbt('meta_related');}
	elseif($v=='lang')$picto='global'; 
	elseif($v=='template')$picto='conn'; else $picto='file';
	if(!$j)$ret.=picto($picto).btn('poph',$v).' ';
if($v=='authlevel')$ret.=menuderj_prep('all|1|2|3|4|5|6|7|8',$v.$id,$val,'1').' ';
elseif($v=="template"){$val=$val?$val:" ";
	$tmpub=msql_read('','public_template',$tpl,1);
	$tmprv=msql_read('',$_SESSION['qb'].'_template',$tpl,1);
	$arr=array_merge_b($tmpub,$tmprv); $arr[" "]=array(""=>1);
	$ret.=menuderj_prep(implode('|',array_keys($arr)),$v.$id,$val?trim($val):$v,'1').' ';}
elseif($v=="tracks"){if((rstr(1) && $val=="") or $val=='true')$chk=1; else $chk=0;
	$ret.=checkbox_j($v.$id,$chk).' ';}
elseif($v=="2cols"){if((rstr(17) && $val=="") or $val=='true')$chk=1; else $chk=0;
	$ret.=checkbox_j($v.$id,$chk);}
elseif($v=="lang"){if($arl){
	foreach($arl as $va){//$rl[$va]=$rdata['lang'.$va];
		if(($val && $va!=$val) or (!$val && $va!=prmb(25))){
		$ret.=lj('txtsmall2',$v.$va.$id.'_autolang__4_'.$id.'_'.$va,$va);
		$ret.=input(1,$v.$va.$id,$rdata['lang'.$va],'" size="4');}
		else $ret.=hidden('',$v.$va.$id,'');}
	$ret.=hlpbt('meta_lang');
	$lang=$rdata['lang'];//lang
	//$ret.=select_j('lang'.$id,'lang',$lang,1,$lang,0);
	$ret.=radiobtj($arl,$lang,'lang'.$id);}
	else $ret.=hidden('',$v.$id,''); $ret.=br();}
else $ret.=ljb('poph','jumpvalue',$v.$id.'_ ','x').' '.balise('input',array(1=>'text',3=>$v.$id,4=>$val,5=>'',6=>'14',7=>'255','autocomplete'=>'off'),'').$hlp.br();}
return $ret;}

//category
function slct_category($btid,$hid,$n){$frm=$_SESSION['frm'];
$r=sql('frm','qda','k','nod="'.$_SESSION['qb'].'" AND frm!="_system" AND frm!="_trash" AND day>"'.calc_date("360").'" ORDER BY frm');
if(auth(3))$r['_system']=1; if(!$r[$frm])$r[$frm]=1; $r['public']=1; unset($r['Home']); 
$ret=menuder_jb($r,$hid,$btid,2,$n);
return $ret;}

//folder
function slct_folder($id){
$r=sql('msg','qdd','k','qb="'.ses('qb').'" AND val="folder"');
if($r)foreach($r as $k=>$v)
	$ret.=ljb('','jumpvalue(\'folder'.$id.'_'.addslashes($k).'\'); Close(\'popup\');','',$k);
return divc('list',$ret);}

//words
function u_words($id){
$cats=explode(' ','tag '.prmb(18));
$ico=explode(' ','tag '.prmb(19));
foreach($cats as $k=>$v){$r=match_tags($id,$v,1); $rt='';
	if($r){$rta=picto($ico[$k],24).' '; $tg=eradic_acc($v);
	foreach($r as $ka=>$va){if($va)
	$rt.=lj('','popup_getcontent___'.$tg.'_'.$va,$va).' ';}
		if($rt)$ret.=divc('nbp',$rta.$rt);}}
return $ret?$ret:nms(11);} 

//save from search
function tag_slct($id,$srch){$r=explode(' ','tag '.prmb(18));
foreach($r as $v)$ret.=lj('','svtg_savtag__x_'.ajx($v).'_'.$id.'_'.ajx($srch),$v).br();
return divc('nbp',$ret).divb('alert|svtg','');}
function savtag($cat,$id,$tag){req('spe');
sav_tag('',$id,$cat,$tag);
return $tag.' added to: '.$cat;}

//add tag
function idtag($cat,$tag){
$idtag=sql('id','qdt','v','cat="'.$cat.'" and tag="'.$tag.'"');
return $idtag;}

function add_tag($cat,$tag){
$idtag=idtag($cat,$tag);
if(!$idtag && $cat && $tag)
	$idtag=insert('qdt','("","'.$cat.'","'.$tag.'")');
//else echo 'idtag exists-';
return $idtag;}

function idartag($idart,$idtag){
$ex=sql('id','qdta','v','idart="'.$idart.'" and idtag="'.$idtag.'"');
return $ex;}

function add_artag($idart,$idtag,$cat,$tag){
$idartag=idartag($idart,$idtag);
if(!$idartag && $idart && $idtag)
	$idartag=insert('qdta','("","'.$idart.'","'.$idtag.'")');
//else echo 'idartag exists-';
return $idartag;}

function add_tag_btn($r,$idart,$cat,$curtag=''){
$rid=$cat.$idart;
if($curtag)$ret=lj('txtred',$rid.'_addtag___0_'.$idart.'_'.$cat.'_'.ajx($curtag),$curtag).' ';
if($r)foreach($r as $idtag=>$tag){
	$j=$rid.'_addtag___'.$idtag.'_'.$idart.'_'.$cat;
	$ret.=lj('',$j,$tag).' ';}
return divc('nbp',$ret);}

function del_tag_btn($r,$idart,$cat){
$rid=$cat.$idart;
if($r)foreach($r as $idtag=>$tag){
	$j=$rid.'_deltag___'.$idtag.'_'.$idart.'_'.$cat;
	$ret.=lj('',$j,'&#10006;&nbsp;'.$tag).' ';}
return $ret;}

function sav_tag($idtag,$idart,$cat,$tag){
if(!$idtag)$idtag=add_tag($cat,$tag);
$idartag=add_artag($idart,$idtag,$cat,$tag);
return $idartag;}

//from ajax
function addtag($idtag,$idart,$cat,$curtag=''){
$idartag=sav_tag($idtag,$idart,$cat,$curtag);
$r=read_tags($idart,$cat);
$ret=del_tag_btn($r,$idart,$cat);
return $ret;}

//del tag
function arts_by_tag($idtag){
$order='order by '.ses('qdta').'.id ASC';
$r=sql_inner('idart','qdt','qdta','idtag','vr','idtag="'.$idtag.'" '.$order); //p($r);
return $r;}

function deltag($idtag,$idart,$cat,$action=''){
$rid=$cat.$idart;
if($action=='remove')$removed=removetag($idtag);
$idartag=idartag($idart,$idtag);
if($idartag)delete('qdta',$idartag);
$r=read_tags($idart,$cat);
$ret=del_tag_btn($r,$idart,$cat);
if(!$removed){$rb=arts_by_tag($idtag);//remove if unused tag
	if(!$rb)$ret.=lj('txtred',$rid.'_deltag___'.$idtag.'_'.$idart.'_'.$cat.'_remove','remove tag '.$idtag).' ';}
return $ret;}

#selector
function find_tags($cat,$curtag){
$r=sql('id,tag','qdt','kv','cat="'.$cat.'" and tag like "%'.$curtag.'%" order by id desc'); //p($r);
return $r;}

function slctag($idart,$cat,$curtag){
//$curtag=utf8_decode($curtag);//$ret.=eco($curtag,1);
$ra=find_tags($cat,$curtag);//possibles
if($ra)if(in_array($curtag,$ra))$curtag='';
$rb=read_tags($idart,$cat);//existing
if($rb)if(in_array($curtag,$rb))$curtag='';
if($ra && $rb)$r=array_diff($ra,$rb); elseif($ra)$r=$ra;
$ret=add_tag_btn($r,$idart,$cat,$curtag);
if(!$ret)$ret=' ';
return $ret;}

#editor
function read_tags($idart,$cat){//tag_arts
$order='order by '.ses('qdta').'.id ASC';
$r=sql_inner('idtag,tag','qdt','qdta','idtag','kv','cat="'.$cat.'" and idart="'.$idart.'" '.$order);
return $r;}

//edit_tags
function edit_tags($idart,$cat,$ico){
$rid=$cat.$idart;
$auto=lj('','slct'.$rid.'_matchtag__3_'.$idart.'_'.ajx($cat),'&#9660;').'';
$picto=lj('','slct'.$rid.'_call__3_meta-spe_list*tags_'.$idart.'_'.ajx($cat),picto($ico)).'';
$r=read_tags($idart,$cat);
$ret=del_tag_btn($r,$idart,$cat);
$js='" onkeyup="autocomp(\''.$idart.'_'.$cat.'\');';//addtag
$js.='" onclick="autocomp(\''.$idart.'_'.$cat.'\');';
$inp=input('','inp'.$rid,$cat.$js,'',1,12).'';
return divc('nbP',$picto.$auto.$inp.btd($rid,$ret).divd('slct'.$rid,''));}

//list_tags
function list_tags($idart,$cat){//tag_list()
$wh='and cat="'.$cat.'" and day>"'.calc_date(30).'" order by tag';
$r=artags('idtag,tag',$wh,'kv');
return add_tag_btn($r,$idart,$cat);}

//match
function each_words($d){$r=explode(' ',$d); $n=count($r);
for($i=0;$i<$n;$i++)$ret[$r[$i]]+=1;
return $ret;}

function prep_msg($id){
$msg=sql('msg','qdm','v','id='.$id); $msg=html_entity_decode($msg);
if(strpos($msg,':import') or strpos($msg,':read'))$msg=strip_tags(format_txt($msg,$id,3));
else $msg=clean_internaltag($msg); $msg=strtolower(eradic_acc($msg)); $msg=deln($msg,' ');
$msg=str_replace("&nbsp;"," ",$msg);
return $msg;}

function tagsbynb_0(){
$ra=sql('idtag,idart','qdta','k',''); if($ra)arsort($ra);
$rb=sql('id,tag','qdt','kv','cat="'.$cat.'"');
if($ra)foreach($ra as $k=>$v)if($rb[$k])$rc[$k]=$rb[$k]; p($rc);
return $rc;}

function tagsbynb_1($cat){
$rb=sql_b('select idtag,idart from '.ses('qdta').'
inner join '.ses('qdt').' on '.ses('qdta').'.idart='.ses('qdt').'.id
inner join '.ses('qda').' on '.ses('qdta').'.idart='.ses('qda').'.id
where cat="'.$cat.'" and nod="'.ses('qb').'"','',1); p($rb);
return $rb;}

function match_tags($idart,$cat,$o=''){//chrono('');
$msg=prep_msg($idart); $ra=each_words($msg); arsort($ra); $ra=array_keys($ra);
$rb=sql('id,tag','qdt','kv','cat="'.$cat.'" order by id desc');
//$rba=tagsbynb_0($cat);//too slow
$rx=read_tags($idart,$cat);//existing
if($rx)$rb=array_diff($rb,$rx);//del exs
$rd=array_intersect($rb,$ra); //p($rc);
if($rb)foreach($rb as $k=>$v){$vb=strtolower(eradic_acc($v));
	if(!$rd[$k])if(strpos($msg,$vb)!==false)$rd[$k]=$v;}
//echo chrono('tags');
if($o)return $rd;
if(!$rd)return ' ';
return add_tag_btn($rd,$idart,$cat);}

#admin

//remove
function removetag($idtag){//from editor
if(!auth(6))return;
$rb=arts_by_tag($idtag);//existing
if(!$rb)delete('qdt',$idtag);
return 'ok';}

function remove_tag($idtag){//from admin
if(!auth(6))return;
if($idtag){msquery('delete from '.ses('qdta').' where idtag="'.$idtag.'"');
delete('qdt',$idtag);}
return divc('txtalert','remove: '.$idtag);}

//rename
function rename_tag($idtag,$cat,$res=''){
if(!auth(6))return;
$rid=randid('rnmtag');
$tag=sql('tag','qdt','v','id='.$idtag);
$ret=divc('txtcadr',nms(87).': '.$tag);
$ret.=divc('small',helps('tag_rename'));
$ret.=input('','rnmtg',$tag);
$ret.=lj('popbt',$rid.'_call___meta_rename*tag_'.$idtag.'_'.$cat.'_rnmtg','ok').br();
if($res){$ex=sql('id','qdt','v','tag="'.$res.'" and cat="'.$cat.'"');
	if(!$ex){update('qdt','tag',$res,'id',$idtag);
		$ret.=divc('txtalert',$tag.' became '.$res);}
	else{update('qdta','idtag',$ex,'idtag',$idtag);
		$ret.=divc('txtalert',$tag.' is erased and references are linked to '.$res);
		if($idtag)delete('qdt',$idtag);}}
return divd($rid,$ret);}

//recat
function recat_tag($idtag,$newcat=''){
if(!auth(6))return;
$rid=randid('recat');
list($tag,$cat)=sql('tag,cat','qdt','r','id='.$idtag);
$ret=divc('txtcadr',nms(140).': '.$tag);
$ret.=divc('small',helps('tag_rename'));
$utags=explode(' ','tag '.prmb(18));//cats
foreach($utags as $v){$c=$cat==$v?'active':'';
	$ret.=lj($c,$rid.'_call___meta_recat*tag_'.$idtag.'_'.ajx($v),$v).br();}
if($newcat){
	$ex=sql('id','qdt','v','tag="'.$tag.'" and cat="'.$newcat.'"');
	if(!$ex){update('qdt','cat',$newcat,'id',$idtag); 
		$ret=divc('txtalert',$cat.' => '.$newcat);}
	else{update('qdta','idtag',$ex,'idtag',$idtag); $ret=divc('txtalert',$tag.'/'.$cat.' is erased and references are linked to '.$tag.'/'.$newcat);
		if($idtag)delete('qdt',$idtag);}}
return divd($rid,$ret);}

//list_artag
function list_artag($idtag,$cat){
$rb=arts_by_tag($idtag);//existing
if($rb)foreach($rb as $idart)$ret.=lj('popbt','popup_callp___meta-spe_edit*tags_'.$idart.'_'.$cat,pictxt('tag',$idart)).' '.popart($idart,'',suj_of_id($idart)).br();
return divc('small',$ret);}

#admin
function admin_tags_edit($idtag,$cat){
$rid=randid('deltag');
$tag=sql('tag','qdt','v','id='.$idtag);
$ret=divc('txtcadr',$tag.' (id:'.$idtag.')');
$tg='cbk'.$rid.'_call___meta'; $tp='popup_callp__3x_meta';
$ret.=lj('popbt',$tp.'-spe_list*artag_'.$idtag.'_'.ajx($cat),pictxt('view',nms(2))).' ';
$ret.=lj('popsav',$tp.'_rename*tag_'.$idtag.'_'.$cat,pictxt('edit',nms(87))).' ';
$ret.=lj('popsav',$tp.'_recat*tag_'.$idtag,pictxt('edit',nms(140))).' ';
$ret.=lj('txtyl',$tg.'_remove*tag_'.$idtag,pictxt('del',nms(43).' '.nms(100)));
$ret.=divd('cbk'.$rid,'');
return divd($rid,$ret);}

function admin_tags($cat='tag'){req('spe');
$rid=randid('admtag'); if(!$cat)$cat='tag';
$utags=explode(' ','tag '.prmb(18));
foreach($utags as $v){$c=$v==$cat?'txtblc':'txtx';
	$ret.=lj($c,$rid.'_call___meta_admin*tags_'.ajx($v),$v).' ';}
$ret=divc('',$ret);
//datas
$ra=sql('idtag,idart','qdta','k',''); if($ra)arsort($ra);
$rb=sql('id,tag','qdt','kv','cat="'.$cat.'"');
if($ra)foreach($ra as $k=>$v)if($rb[$k])$rc[$k]=array($rb[$k],$v);
if($rb)foreach($rb as $k=>$v)if(!$rc[$k])$rc[$k]=array($v,$ra[$k]);
$ret.=divc('nbp',count($rb).' '.$cat).br();
if($rc)foreach($rc as $idtag=>$v)
	$ret.=lj('popbt','popup_callp___meta-spe_admin*tags*edit_'.$idtag.'_'.$cat,pictxt('popup',$v[0].'&nbsp;('.$v[1].')')).' ';
return divd($rid,$ret);}

?>