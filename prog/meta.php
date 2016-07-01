<?php
//philum_ajax_meta

function utag_sav($id,$val,$msg){$msg=trim($msg);//space mean erase
list($vrf,$msb)=sql('id,msg','qdd','r','ib="'.$id.'" AND val="'.$val.'"');
if($val=='folder')$msg=ajx($msg,1);
if($vrf && !$msg)delete('qdd',$vrf);
elseif(!$vrf && $msg)insert('qdd','("","'.$id.'","'.$val.'","'.$msg.'");');
elseif($msb!=$msg)update("qdd","msg",$msg,"id",$vrf);
$_SESSION['daya']=time();}

function getjx($d){$d=$_GET[$d]; if($d==' ')return;
return ajx(str_replace(array("<",">","%u2019"),array("","","'"),$d),1);}
function cache_value($id,$n,$v){
if($_SESSION['rqt'][$id])$_SESSION['rqt'][$id][$n]=$v;}

function save_tits_j($id){$qda=$_SESSION['qda'];
if($ib=getjx('ib')){$sq['ib']=$ib; cache_value($id,10,$ib);}
if($cat=getjx('frm1')){$sq['frm']=$cat; cache_value($id,1,$cat);}
if($suj=clean_title(getjx('suj'))){$sq['suj']=$suj; cache_value($id,2,$suj);}
if($img=getjx('img')){$sq['img']=$img; cache_value($id,3,$img);}
if($src=getjx('src')){$sq['mail']=$src; cache_value($id,9,$src);}
if($sq)msquery('update '.$qda.' set '.implode(',',atmrup($sq)).' where id='.$id);
$r=$_SESSION['art_options'];
$rdata=sql('val,msg','qdd','kv','ib="'.$id.'"');
if($r)foreach($r as $k=>$v){$val=$rdata[$v]; $gv=ajx($_GET[$v],1);
	if($v=="related" or $v=="float_img" or $v=="template" or $v=="folder")$vrf=' ';
	if($v=="authlevel"){if(rstr(21))$vrf="1"; else $vrf="all";}
	if($v=="tracks"){if(rstr(1))$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	if($v=="2cols"){if(rstr(17))$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	if($v=="fav"){if(rstr(52))$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	if($v=="like"){if(rstr(90))$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	if($v=="poll"){if(rstr(91))$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	if($v=="lang"){$vrf=prmb(25); $arr=explode(' ',prmb(26));
		if($arr)foreach($arr as $ka=>$va){$valb=$rdata['lang'.$va];
			if($_GET['lang'.$va]==$vrf && $val)$_GET['lang'.$va]=' ';
			if($_GET['lang'.$va] && $_GET['lang'.$va]!=$valb && $_GET['lang'.$va]!='undefined'){
				utag_sav($id,'lang'.$va,$_GET['lang'.$va]);}}}
	if(!$val)$val=$vrf;//permut value with global setting
	if($gv==$vrf && $val)$gv=' ';//erase if not usefull
	if($gv && $gv!=$val)utag_sav($id,$v,$gv);}}

function same_suj($suj){
$r=sql('id','qda','k','suj="'.$suj.'" AND nod="'.$_SESSION['qb'].'" ORDER BY id DESC');
foreach($r as $k=>$v){if($k!=$_SESSION['read'])$ret.=lka('/?read='.$k,$k).' ';}
if($ret)return btn('txtsmall','with_same_title: '.$ret);}

function prior_sav($v,$id){
if($v=='trash')update('qda','frm','_trash','id',$id);
//elseif($v=='del' && auth(6)){update('qda','nod','_trash','id',$id); unset($_SESSION['rqt'][$id]);}
else update('qda','re',$v,'id',$id); cache_value($id,11,$v);
return prior_edit($v,$id);}

function prior_edit($va,$id){
$j='rdbt'.$id.'_call___meta_prior*sav_';
$r=array(2=>picto('s1'),3=>picto('s2'),4=>picto('s3'));
if($va==0)$ret.=lj('popbt',$j.'trash_'.$id,picto('trash')).' ';
if($va==0)$ret.=lj('popbt active" title="'.nms(43),$j.'del_'.$id,picto('del')).' ';
$ret.=lj('popbt',$j.($va==0?1:0).'_'.$id,offon($va)).' ';
foreach($r as $k=>$v){$js=sj($j.($k==$va?1:$k).'_'.$id);
	$js.=' var ob=getbyid(\'art\'+'.$id.'); '; if($k)$ex='hide'; else $rep='hide';
	$js.='ob.className=ob.className.replace(\'justy '.$ex.'\',\'justy '.$rep.'\');';
	$ret.=lja('popbt '.($k==$va?'active':''),$js,$v);}
return $ret;}

function edit_day($d,$id){
if($id && auth(5)){$r=explode('-',$d); 
$day=mktime($r[3],$r[4],0,$r[1],$r[2],$r[0]); update("qda","day",$day,"id",$id);
return lj('popw','chday'.$id.'_chday___'.$id,'date');}
else{$time=sql('day','qda','v','id="'.$d.'"'); $day=date('Y-m-d-H-i',$time);
$ret=input(1,'chd'.$d,$day,''); $ret.=lj('popw','chday'.$d.'_chday_chd'.$d.'__'.$d,'ok');
$ret.=togbub('plug','calendar_calendar*build_'.$time.'_chd'.$d,picto('time'));
return $ret;}}

function edit_dpl($id,$css){$use=$_SESSION['USE'];
if(auth(5)){$ret.=lj($css,'popup_deploy___'.$id,picto('mail')).'';
	$ret.=lj($css,'popup_export___'.$id,picto('export')).'';}
return $ret;}

function edit_tits($id,$prw){$css='poph';
list($ib,$day,$src,$suj,$frm,$img,$thm,$re)=sql('ib,day,mail,suj,frm,img,thm,re','qda','r','id="'.$id.'"');
$nk='checkEnter(event,\'formtit'.$id.'\');';
$ret.=submitj('','formtit'.$id,pictxt('save',nms(57)));//save
$ret.=select_j('ib'.$id,'parent',$ib,'',picto('topo'),1);
$ret.=ljb($css,"jumpvalue",'ib'.$id.'_/',picto('no')).' ';
//if(auth(2))$ret.=btd('rdbt'.$id,prior_edit($re,$id)).' ';//priority
$ret.=lj($css,'popup_track___'.$id,picto('forum')).'';
$ret.=edit_dpl($id,$css).'';//deploy
if(auth(2))$ret.=btd('chday'.$id,lj('','chday'.$id.'_chday___'.$id,picto('time'))).'';
$ret.=balise('textarea',array(3=>'suj'.$id,5=>'console',16=>'height:34px; width:100%;'),$suj).br();//suj
$ret.=lj('poph','popup_placeim___'.$id,picto('img')).balise("input",array('','text','','img'.$id,$img,'','36',255,$nk),'').lj('poph','img'.$id.'_recenseim__4_'.$id,pictit('up','update')).lj('poph','img'.$id.'_orderim__4_'.$id,pictit('left','larger as thumb')).br();//img
$ret.=lj('poph','',picto('link')).balise("input",array('','text','','src'.$id,$src,'','36',255,$nk),'').' ';//src
$ret.=edit_frm($id,$frm);//$tags
$ret.=art_options($id).' ';//art_options
$dn=array('ib','suj','img','src','frm1');
foreach($_SESSION['art_options'] as $k=>$v)$dn[]=$v;
$r=explode(' ',prmb(26)); if($r)foreach($r as $k=>$v)$dn[]='lang'.$v;//lang
$js='SaveTits(\''.$id.'\',\''.implode('|',$dn).'\',\''.$prw.'\')';
$ret='<form id="formtit'.$id.'" action="javascript:'.$js.'">'.$ret.'</form>';
return divs('min-width:440px',$ret);}

//edit frm
function edit_frm($id,$frm,$sav=''){
if($sav){update('qda','frm',$frm,'id',$id); cache_value($id,1,$frm);}
$picto=lj('','slctfrm'.$id.'_call__3_meta_slct*frm_'.$id.'_'.ajx($frm),picto('folder2','min-width:22px;'));
$inp=input('','frm1'.$id,$frm,'" onclick="getbyid(\'slctfrm'.$id.'\').innerHTML=\'\'',0,12);
$ret=$picto.$inp.divd('slctfrm'.$id,'');
if($sav)return $ret; return divb('small|frm'.$id,$ret);}

function slct_frm($id,$frm,$res=''){$res=ajxg($res);
$r=sql('frm','qda','k','nod="'.ses('qb').'" and substring(frm,1,1)!="_" AND day>"'.calc_date("360").'" order by frm');
if($r)foreach($r as $k=>$v)
	$ret.=lj('','frm'.$id.'_call___meta_edit*frm_'.$id.'_'.ajx($k).'_frm1'.$id,$k).' ';
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
$r=$_SESSION['art_options']; $arl=explode(' ',prmb(26));
$rdata=sql('val,msg','qdd','kv','ib="'.$id.'"');
if($r)foreach($r as $k=>$v){$val=$rdata[$v]; $hlp='';
	if($v=='folder'){
		$ret.=picto('virtual').lj('poph','popup_addfolder___'.$id,nms(73)).' ';}
	if($v=='related'){$ret.=pictxt('articles').btn('poph',nms(138));
		$hlp=hlpbt('meta_related');}
	if($v=='agenda'){$ret.=pictxt('localize').btn('poph','Agenda');
		//$hlp=togbub('plug','calendar_calendar*build__'.$v.$id,picto('time'));
		$hlp=lj('','popup_plup___calendar_calendar*build__'.$v.$id,picto('time'));}
	elseif($v=='lang')$ret.=picto('global'); 
	elseif($v=='template')$ret.=pictxt('conn',$v);
if($v=='authlevel')$ret.=btn('popbt',$v.' '.menuderj_prep('all|1|2|3|4|5|6|7|8',$v.$id,$val,'1')).' ';
elseif($v=='template'){$val=$val?$val:' ';
	$tmpub=msql_read('','public_template',$tpl,1);
	$tmprv=msql_read('',$_SESSION['qb'].'_template',$tpl,1);
	$arr=array_merge_b($tmpub,$tmprv); $arr[' ']=array(''=>1);
	$ret.=btn('popbt',$v.' '.menuderj_prep(implode('|',array_keys($arr)),$v.$id,$val?trim($val):$v,'1')).' ';}
elseif($v=='tracks'){if((rstr(1) && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('popbt',$v.' '.checkbox_j($v.$id,$chk));}
elseif($v=='2cols'){if((rstr(17) && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('popbt',$v.' '.checkbox_j($v.$id,$chk));}
elseif($v=='fav'){if((rstr(52) && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('popbt',$v.' '.checkbox_j($v.$id,$chk));}
elseif($v=='like'){if((rstr(90) && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('popbt',$v.' '.checkbox_j($v.$id,$chk));}
elseif($v=='poll'){if((rstr(91) && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('popbt',$v.' '.checkbox_j($v.$id,$chk));}
elseif($v=='lang'){if($arl){
	foreach($arl as $va){//$rl[$va]=$rdata['lang'.$va];
		if(($val && $va!=$val) or (!$val && $va!=prmb(25))){
		$ret.=lj('txtsmall2',$v.$va.$id.'_autolang__4_'.$id.'_'.$va,$va);
		$ret.=input(1,$v.$va.$id,$rdata['lang'.$va],'" size="4');}
		else $ret.=hidden('',$v.$va.$id,'');}
	$ret.=hlpbt('meta_lang');
	$lang=$rdata['lang'];//lang
	$ret.=langslct($arl,$lang,'lang'.$id);}
	else $ret.=hidden('',$v.$id,''); $ret.=br();}
else $ret.=ljb('poph','jumpvalue',$v.$id.'_ ','x').' '.balise('input',array(1=>'text',3=>$v.$id,4=>$val,5=>'',6=>'14',7=>'255','autocomplete'=>'off'),'').$hlp.br();}
return $ret;}

function langslct($r,$vrf,$id){$rid=randid('rdio'); //$r=explode(' ',prmb(26));
if(is_array($r))foreach($r as $k=>$v){$c=$v==$vrf?'active':'';
	$ret.=ljb($c,'radioj',$rid.'\',\''.$id.'\',\''.ajx($v).'\',\''.$k,flag($v));}
return span(atd($rid).atc('nbp'),$ret).hidden($id,$id,$vrf);}

//category
function slct_category($btid,$hid,$n){$frm=$_SESSION['frm'];
$r=sql('frm','qda','k','nod="'.$_SESSION['qb'].'" AND frm!="_system" AND frm!="_trash" AND day>"'.calc_date("360").'" ORDER BY frm');
if(auth(3))$r['_system']=1; if(!$r[$frm])$r[$frm]=1; $r['public']=1; unset($r['Home']); 
$ret=menuder_jb($r,$hid,$btid,2,$n);
return $ret;}

//folder
function slct_folder($id){
$r=sql('msg','qdd','k','val="folder"');
if($r)foreach($r as $k=>$v)
	$ret.=lja('','jumpvalue(\'folder'.$id.'_'.addslashes($k).'\'); Close(\'popup\');',$k);
return divc('list',$ret);}

//words
function u_words($id){
$cats=explode(' ','tag '.prmb(18));
$ico=explode(' ','tag '.prmb(19));
foreach($cats as $k=>$v){$r=match_tags($id,$v,1); $rt='';
	if($r){$rta=picto($ico[$k],24).' '; $tg=eradic_acc($v);
	foreach($r as $ka=>$va){if($va)
	$rt.=lj('','popup_api___'.$tg.':'.$va,$va).' ';}
		if($rt)$ret.=divc('nbp',$rta.$rt);}}
return $ret?$ret:nms(11);} 

//save from search
function tag_slct($id,$srch){$r=explode(' ','tag '.prmb(18));
foreach($r as $v)$ret.=lj('','socket_savtag__xc_'.ajx($v).'_'.$id.'_'.ajx($srch),$v);
return divc('list',$ret).divb('alert|svtg','');}
function savtag($cat,$id,$tag){req('spe');
if(!tag_auth($cat))return;
sav_tag('',$id,$cat,$tag);}

//add tag
function idtag($cat,$tag){
$idtag=sql('id','qdt','v','cat="'.$cat.'" and tag="'.$tag.'"');
return $idtag;}

function add_tag($cat,$tag){
$idtag=idtag($cat,$tag);
if(!$idtag && $cat && $tag)
	$idtag=insert('qdt','("","'.$cat.'","'.$tag.'")');
return $idtag;}

function idartag($idart,$idtag){
$ex=sql('id','qdta','v','idart="'.$idart.'" and idtag="'.$idtag.'"');
return $ex;}

function add_artag($idart,$idtag,$cat,$tag){
$idartag=idartag($idart,$idtag);
if(!$idartag && $idart && $idtag)
	$idartag=insert('qdta','("","'.$idart.'","'.$idtag.'")');
return $idartag;}

function add_tag_btn($r,$idart,$cat,$curtag=''){
$rid=$cat.$idart;
if($curtag)$ret=lj('txtred',$rid.'_addtag___0_'.$idart.'_'.$cat.'_'.ajx($curtag),$curtag).' ';
if($r)foreach($r as $idtag=>$tag){
	$j=$rid.'_addtag___'.$idtag.'_'.$idart.'_'.$cat;
	$ret.=lj('',$j,$tag).' ';}//
return divc('nbp','&#10133; '.$ret);}

function del_tag_btn($r,$idart,$cat){
$rid=$cat.$idart;
if($r)foreach($r as $idtag=>$tag){
	$j=$rid.'_deltag___'.$idtag.'_'.$idart.'_'.$cat;
	$ret.=lj('nbp',$j,'&#10006;&nbsp;'.$tag).' ';}
return $ret;}

function sav_tag($idtag,$idart,$cat,$tag){
if(!$idtag)$idtag=add_tag($cat,$tag);
$idartag=add_artag($idart,$idtag,$cat,$tag);
return $idartag;}

//from ajax
function addtag($idtag,$idart,$cat,$curtag=''){
if(!tag_auth($cat))return;
$idartag=sav_tag($idtag,$idart,$cat,$curtag);
$r=read_tags($idart,$cat);
$ret=del_tag_btn($r,$idart,$cat);
return $ret;}

//del tag
function deltag($idtag,$idart,$cat,$action=''){
if(!tag_auth($cat))return;
$rid=$cat.$idart;
if($action=='remove')$removed=removetag($idtag);
$idartag=idartag($idart,$idtag);
if($idartag)delete('qdta',$idartag);
$r=read_tags($idart,$cat);
$ret=del_tag_btn($r,$idart,$cat);
if(!$removed){$rb=sql('idart','qdta','rv','idtag="'.$idtag.'"');//remove if unused tag
	if(!$rb)$ret.=lj('txtred',$rid.'_deltag___'.$idtag.'_'.$idart.'_'.$cat.'_remove','remove tag '.$idtag).' ';}
return $ret;}

#selector
function find_tags($cat,$curtag){
$r=sql('id,tag','qdt','kv','cat="'.$cat.'" and tag like "%'.$curtag.'%" order by id desc'); //p($r);
return $r;}

function slctag($idart,$cat,$curtag){
if(!tag_auth($cat))return;
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
$r=sql_inner('idtag,tag','qdt','qdta','idtag','kv','where cat="'.$cat.'" and idart="'.$idart.'" '.$order);
return $r;}

function tag_auth($cat){
if(auth(4) or $cat==ses('iq'))return true;}

//edit_tag
function editag($idart,$cat,$ico){
if($cat=='utag'){$auto=hlpbt('usertags'); $cat=ses('iq');}
if(!tag_auth($cat))return;
$rid=$cat.$idart; $j='slct'.$rid.'_matchtag___'.$idart.'_'.ajx($cat); 
$auto.=lj('',$j,'&#9660;').' '; $_POST['opall'][]=$j;
$picto=lj('','slct'.$rid.'_call__3_meta-spe_list*tags_'.$idart.'_'.ajx($cat),picto($ico,'min-width:22px;')).'';
$r=read_tags($idart,$cat);
$ret=del_tag_btn($r,$idart,$cat);
$js='" onkeyup="autocomp(\''.$idart.'_'.$cat.'\');';//addtag
$js.='" onclick="autocomp(\''.$idart.'_'.$cat.'\');';
$catname=is_numeric($cat)?nms(145):$cat;
$inp=input('','inp'.$rid,$catname.$js,'',1,12).'';
//$match=match_tags($idart,$cat);
return divc('small',$picto.$inp.$auto.btd($rid,$ret).divd('slct'.$rid,''));}

function meta_all($id,$prw){$r['tag']='tag';
$bt=lj('',$id.'_artin___'.$id.'_'.$prw,picto('valid')).' ';
$re=sql('re','qda','v','id='.$id);
$bt.=btd('rdbt'.$id,prior_edit($re,$id)).' ';//priority
$ica=explode(' ',prmb(18)); $ico=explode(' ',prmb(19)); $r+=array_combine($ica,$ico); 
foreach($r as $cat=>$ico)if($cat)$ret.=editag($id,$cat,$ico);
$bt.=ljb('','SaveJc',implode(';',$_POST['opall']),picto('down')).br();
//$arl=explode(' ',prmb(26)); $lang=sql('msg','qdd','v','ib="'.$id.'" and val="lang"');
//$ret.=radiobtj($arl,$lang,'lang'.$id);
return divs('min-width:340px;',$bt.$ret);}

//list_tags
function list_tags($idart,$cat){//tag_list()
if(rstr(3) && !is_numeric($cat))$limit=' and day>"'.calc_date(30).'"';
$wh='and cat="'.$cat.'"'.$limit.' order by tag';
$r=artags('idtag,tag',$wh,'kv');
return add_tag_btn($r,$idart,$cat);}

#match
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

function match_tags($idart,$cat,$o=''){req('tri');//chrono('');
$msg=prep_msg($idart); $ra=each_words($msg); arsort($ra); $ra=array_keys($ra);
$rb=sql('id,tag','qdt','kv','cat="'.$cat.'" order by id desc');
//$rba=tagsbynb_0($cat);//too slow
$rx=read_tags($idart,$cat);//existing
if($rx)$rb=array_diff($rb,$rx);//del exs
if($rb)$rd=array_intersect($rb,$ra); //p($rc);
if($rb)foreach($rb as $k=>$v){$vb=strtolower(eradic_acc($v));
	if(!$rd[$k])if(strpos($msg,$vb)!==false)$rd[$k]=$v;}
//echo chrono('tags');
if($o)return $rd; if(!$rd)return ' ';
return add_tag_btn($rd,$idart,$cat);}

#admin

//remove
function removetag($idtag){//from editor
if(!auth(6))return;
$rb=sql('idart','qdta','rv','idtag="'.$idtag.'"');//existing
if(!$rb)delete('qdt',$idtag);
db_add(db_f('rmtag'),$idtag.':'.hostname());
return 'ok';}

function remove_tag($idtag){//from admin
if(!auth(6))return;
if($idtag){msquery('delete from '.ses('qdta').' where idtag="'.$idtag.'"');
delete('qdt',$idtag);}
return divc('txtalert','remove: '.$idtag);}

//rename
function rename_tag($idtag,$cat,$res=''){$res=ajxg($res);
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
$ret=divc('txtcadr',nms(140).': '.$tag.' in '.$cat);
$ret.=divc('small',helps('tag_rename'));
$utags=explode(' ','tag '.prmb(18));//cats
foreach($utags as $v){if($v!=$cat)
	$ret.=lj('popbt',$rid.'_call___meta_recat*tag_'.$idtag.'_'.ajx($v),$v).br();}
if($newcat){
	$ex=sql('id','qdt','v','tag="'.$tag.'" and cat="'.$newcat.'"');
	if(!$ex){update('qdt','cat',$newcat,'id',$idtag); 
		$ret=divc('txtalert',$cat.' => '.$newcat);}
	else{update('qdta','idtag',$ex,'idtag',$idtag); $ret=divc('txtalert',$tag.' in '.$cat.' is erased and references are linked to '.$tag.' in '.$newcat);
		if($idtag)delete('qdt',$idtag);}}
return divd($rid,$ret);}

//transcat
function trans_tag($idtag,$p='',$res=''){$res=ajxg($res);
if(!auth(6))return;
$rid=randid('trnsct');
$tag=sql('tag','qdt','v','id='.$idtag);
$ret=divc('txtcadr',nms(140).' '.nms(142).' '.nms(9).' '.nms(2).' '.nms(141).': '.$tag);
$ret.=input('','trsct',$tag);
$ret.=lj('popbt',$rid.'_call___meta_trans*tag_'.$idtag.'_'.$cat.'_trsct','ok').br();
if($res){$r=sql('idart','qdta','rv','idtag="'.$idtag.'"');
	foreach($r as $k=>$id)update('qda','frm',$res,'id',$id);
	$ret.=divc('txtalert','All the articles with tag "'.$tag.'" are put in category: '.$res);}
return divd($rid,$ret);}

//list_artag
function list_artag($idtag,$cat){
$rb=sql('idart','qdta','rv','idtag="'.$idtag.'"');//existing
if($rb)foreach($rb as $idart)$ret.=lj('popbt','popup_callp___meta-spe_editag_'.$idart.'_'.$cat,pictxt('tag',$idart)).' '.popart($idart,'',suj_of_id($idart)).br();
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
$ret.=lj('popsav',$tp.'_trans*tag_'.$idtag,pictxt('edit',nms(9))).' ';
$ret.=lj('txtyl',$tg.'_remove*tag_'.$idtag,pictxt('del',nms(43).' '.nms(100)));
$ret.=divd('cbk'.$rid,'');
return divd($rid,$ret);}

function admin_tags($cat='tag'){req('spe');
$rid=randid('admtag'); if(!$cat)$cat='tag';
$utags=explode(' ','tag '.prmb(18));
foreach($utags as $v){$c=$v==$cat?'txtblc':'txtx';
	$ret.=lj($c,$rid.'_call___meta_admin*tags_'.ajx($v),$v).' ';}
$ret=divc('',$ret);
$ra=sql_inner('idtag,idart','qda','qdta','idart','k','where nod="'.ses('qb').'"');
if($ra)arsort($ra);
$rb=sql('id,tag','qdt','kv','cat="'.$cat.'"');
if($ra)foreach($ra as $k=>$v)if($rb[$k])$rc[$k]=array($rb[$k],$v);
$ret.=divc('nbp',count($rc).' '.$cat).br();
if($rc)foreach($rc as $idtag=>$v)
	$ret.=lj('popbt','popup_callp___meta-spe_admin*tags*edit_'.$idtag.'_'.$cat,pictxt('popup',$v[0].'&nbsp;('.$v[1].')')).' ';//
return divd($rid,$ret);}

?>