<?php
//philum_ajax_meta

function utag_sav($id,$val,$msg){$msg=trim($msg);//space mean erase
list($vrf,$msb)=sql('id,msg','qdd','r','ib="'.$id.'" AND val="'.$val.'"');
if($vrf && !$msg)sqldel('qdd',$vrf);
elseif(!$vrf && $msg)sqlsav('qdd',[$id,$val,$msg]);
elseif($msb!=$msg)update('qdd','msg',$msg,'id',$vrf);
$_SESSION['daya']=time();}

function getjx($d){$d=get($d); if($d==' ')return; $d=decuri($d);//patch_utf8
$ret=ajx(str_replace(['<','>',"%u2019","’"],['','',"'","'"],$d),1);
if(ses('enc')=='utf-8'){$ret=urldecode($ret);}// $ret=utf8_decode($ret);
return $ret;}

function save_tits_j($id){$qda=$_SESSION['qda'];
if($ib=getjx('ib')){$sq['ib']=$ib=='/'?'0':$ib; cachevs($id,10,$ib);}
if($cat=getjx('frm1')){$sq['frm']=$cat; cachevs($id,1,$cat);}
if($suj=clean_title(getjx('suj'))){$sq['suj']=$suj; cachevs($id,2,$suj);}
if($url=getjx('url')){$sq['thm']=$url;}elseif($suj)$sq['thm']=hardurl($suj);
if($img=getjx('img')){$sq['img']=$img; cachevs($id,3,$img);}
if($src=getjx('src')){$sq['mail']=$src; cachevs($id,9,$src);}
if($nam=getjx('author')){$sq['name']=$nam; cachevs($id,7,$nam);}
if($hub=getjx('hub')){$sq['nod']=$hub; cachevs($id,4,$hub);}
//if($sq)qr('update '.$qda.' set '.implode(',',atmrup($sq)).' where id='.$id);
if($sq)sqlup('qda',$sq,'id',$id);
$ra=sql('day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re,lg','qda','w',$id);
msql::modif('',nod('cache'),$ra,'one','',$id);
$r=$_SESSION['art_options']; $rst=arr(ses('rstr'),150);
$ra=sql('val,msg','qdd','kv','ib="'.$id.'"');
$rd=valk($ra,$r);
if($r)foreach($r as $k=>$v){$val=$rd[$v]; $gv=getjx($v); //ajx(get($v),1);
	if($v=='related' or $v=='float_img' or $v=='template' or $v=='folder')$vrf=' ';
	elseif($v=='authlevel'){if(!$rst[21])$vrf='1'; else $vrf='all';}
	elseif($v=='password'){$vrf='';}
	elseif($v=='tracks'){if(!$rst[1])$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	elseif($v=='2cols'){if(!$rst[17])$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	elseif($v=='fav'){if(!$rst[52])$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	elseif($v=='like'){if(!$rst[90])$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	elseif($v=='poll'){if(!$rst[91])$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	elseif($v=='mood'){if(!$rst[119])$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	elseif($v=='bckp'){if(!$rst[106])$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	elseif($v=='artstat'){if(!$rst[71])$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	elseif($v=='quote'){if(!$rst[109])$vrf='true'; else $vrf='false'; $gv=$gv==1?'true':'false';}
	elseif($v=='plan'){$vrf=!empty($gv)?'true':'false';}
	elseif($v=='lastup'){$vrf=!empty($gv)?'true':'false';}//$rst[113]
	elseif($v=='lang'){$vrf=prmb(25); $arr=explode(' ',prmb(26));
		if($arr)foreach($arr as $ka=>$va){$valb=val($ra,'lang'.$va);
			if(get('lang'.$va)==$vrf && $val)$_GET['lang'.$va]=' '; $glg=get('lang'.$va);
			if($glg && $glg!=$valb && $glg!='undefined'){utag_sav($id,'lang'.$va,$glg);
				$lg=sql('lg','qda','v',$id); if(!$lg)$lg=ses('lng'); utag_sav($glg,'lang'.$lg,$id);
				affectlgr($id,$va);}}}
	if(!$val)$val=$vrf;//permut value with global setting
	if($gv==$vrf && $val)$gv=' ';//erase if not usefull
	if($gv!=$val)utag_sav($id,$v,$gv);}}//$gv && 

function same_suj($suj){
$r=sql('id','qda','k','suj="'.$suj.'" AND nod="'.$_SESSION['qb'].'" ORDER BY id DESC');
foreach($r as $k=>$v){if($k!=$_SESSION['read'])$ret.=lk('/?read='.$k,$k).' ';}
if($ret)return btn('txtsmall','with_same_title: '.$ret);}

function prior_sav($v,$id){
if($v=='trash')update('qda','frm','_trash','id',$id);
//elseif($v=='del' && auth(6)){update('qda','nod','_trash','id',$id); unset($_SESSION['rqt'][$id]);}
else update('qda','re',$v,'id',$id); cachevs($id,11,$v,1);
return prior_edit($v,$id);}

function prior_edit($va,$id){
$j='rdbt'.$id.'_call___meta_prior*sav_'; $ret='';
$ra=opt(prmb('7'),' ',5); if($ra)$r=[1=>$ra[0]==1?'-':$ra[0],2=>$ra[1]==2?picto('s1'):$ra[1],3=>$ra[2]==3?picto('s2'):$ra[2],4=>$ra[3]==4?picto('s3'):$ra[3],5=>$ra[4]==5?picto('stars'):$ra[4]];
else $r=[2=>picto('s1'),3=>picto('s2'),4=>picto('s3'),5=>picto('stars')];
if($va==0)$ret.=lj('',$j.'trash_'.$id,picto('trash')).' ';
if($va==0)$ret.=lj('active',$j.'del_'.$id,picto('del'),att(nms(43))).' ';
$ret.=lj('',$j.($va==0?1:0).'_'.$id,offon($va)).' ';
foreach($r as $k=>$v){$js=sj($j.($k==$va?1:$k).'_'.$id);
	$js.=' var ob=getbyid(\'art\'+'.$id.'); '; $ex=$k?'hide':''; $rep=$k?'':'hide';
	$js.='ob.className=ob.className.replace(\'justy '.$ex.'\',\'justy '.$rep.'\');';
	$ret.=lja(active($k,$va),$js,$v).' ';}
return btn('nbp',$ret);}

function edit_day($d,$id){
if($id && auth(5)){$r=explode('-',$d); 
	$day=mktime($r[3],$r[4],0,$r[1],$r[2],$r[0]);
	update('qda','day',$day,'id',$id); cachevs($id,0,$day,1);
	return lj('popw','chday'.$id.'_chday___'.$id,picto('time'));}
else{$time=sql('day','qda','v','id="'.$d.'"'); $day=date('Y-m-d-H-i',$time);
$ret=input1('chd'.$d,$day,'12'); $ret.=lj('popw','chday'.$d.'_chday_chd'.$d.'__'.$d,'ok');
$ret.=togbub('plug','calendar_calendar*build_'.$time.'_chd'.$d,picto('time'));
return $ret;}}

function recapauthor($id){
$d=sql('mail','qda','v','id='.$id); $p=strend($d,'/');
$nm=sql_b('select screen_name from pub_umtwits where twid='.$p,'v');
if(!$nm){$q=twit::read($p); $r=twit::datas($q); $nm=$r['screen_name'];}
return $nm;}

function edit_tits($id,$prw){$css='poph';
$ra=sql('ib,day,name,nod,mail,suj,frm,img,thm,re,lg','qda','r','id="'.$id.'"');
list($ib,$day,$name,$hub,$src,$suj,$frm,$img,$url,$re,$lg)=$ra; if(!$lg)$lg=ses('lng');
if(rstr(38))$ret.=btn('txtsmall2','#'.$id).' ';
$ret=toggle('','prnt'.$id.'_parent_'.$id,picto('topo')).input1('ib'.$id,$ib,3).btd('prnt'.$id,'');
$ret.=ljb($css,'jumpvalue',['ib'.$id,'/'],ascii(10006));
$ret.=lj($css,'popup_track___'.$id,picto('forum'));
//$ret.=lj($css,'popup_deploy___'.$id,picto('maillist'),att('deploy by mail list'));
//if(auth(6) && $src)$ret.=lj($css,$id.'_recapart___'.$id,picto('update'),att('backup+reimport'));
$ret.=toggle($css,'reimp'.$id.'_reimport_'.$id.'_'.$prw.'_1',picto('rollback')).btd('reimp'.$id,'');
$ret.=toggle($css,'trlg'.$id.'_translate,home_'.$id,picto('translate')).btd('trlg'.$id,'');
$ret.=toggle($css,'vml'.$id.'_vmail_'.$id,picto('mail'),'',att('send')).btd('vml'.$id,'');
$ret.=toggle($css,'exp'.$id.'_export_'.$id.'_'.ses('qb'),picto('export')).btd('exp'.$id,'');
$ret.=lj($css,'art'.$id.'_import___'.$id.'_'.$prw,picto('cycle'),att(':import'));
//$ret.='['.css.';popup_tit___'.$id.'_'.$prw.';[detach:picto]:lj]';
//$rb[]=['f'=>'lj','p1'=>$css,'p2'=>'popup_tit___'.$id.'_'.$prw,'p3'=>'[detach:picto]'];
$dn=['ib','suj','img','src','frm1']; if(rstr(38))$dn[]='url';
$ret.=toggle($css,'chday'.$id.'_chday_'.$id,picto('time')).btd('chday'.$id,'');
if($_SERVER['HTTP_HOST']=='oumo.fr')
	$ret.=lj($css,'suj'.$id.'_plug__4_umrenum_umrenum*last_'.ajx($frm).'_'.$id,picto('bb'),att('Oay'));
if(prms('srvmirror'))
$ret.=lj($css,$id.'_call___ajxf_art*mirror_'.$id,picto('symetry-v'),att('mirror'));
$ret.=lj($css,'popup_tit___'.$id.'_'.$prw,picto('popup'),att('detach'));
$ret.=bal('textarea',['id'=>'suj'.$id,'class'=>'console','style'=>'height:40px; width:100%;'],$suj).br();
if(auth(6) && rstr(6)){$ret.=picto('user').input('author'.$id,$name); $dn[]='author';
	if($src)$ret.=lj('popbt','author'.$id.'_call__4_meta_recapauthor_'.$id,'twitter author'); $ret.=br();}
if(auth(6) && $hub!=ses('qb')){$ret.=picto('node').input('hub'.$id,$hub).br(); $dn[]='hub';}
$ret.=toggle('','pim'.$id.'_placeim_'.$id,picto('img')).bal('input',['type'=>'text','id'=>'img'.$id,'value'=>$img,'size'=>'36','maxlength'=>'512'],'').lj('poph','img'.$id.'_recenseim__4_'.$id,pictit('upload','update')).lj('poph','img'.$id.'_orderim__4_'.$id,pictit('before','larger as thumb')).divd('pim'.$id,'');
$ret.=pictit('link','source').bal('input',['type'=>'text','id'=>'src'.$id,'value'=>$src,'size'=>'36','maxlength'=>'255'],'').br();
if(rstr(38)){$ret.=pictit('url','url').bal('input',['type'=>'text','id'=>'url'.$id,$url,'size'=>'36','maxlength'=>'255'],'');
	$ret.=lj('poph','url'.$id.'_call__4_meta-spe_hardurlsuj_'.$id,pictit('upload','update'));}
$ret.=edit_frm($id,$frm);//$tags
$ret.=art_options($id,$lg).' ';//art_options
foreach($_SESSION['art_options'] as $k=>$v)if($v!='lang')$dn[]=$v;//by meta_all
$r=explode(' ',prmb(26)); if($r)foreach($r as $k=>$v)$dn[]='lang'.$v;//lang
$sav=ljj('popsav','SaveTits',[$id,implode('|',$dn),$prw],picto('valid')).' ';
return divs('min-width:440px; padding:0 4px;',$sav.$ret);}

//edit frm
function edit_frm($id,$frm,$sav=''){
if($sav){update('qda','frm',$frm,'id',$id); cachevs($id,1,$frm,1);}
$picto=toggle('','slctfrm'.$id.'_call_meta_slct*frm_'.$id.'_'.ajx($frm),picto('category','min-width:22px;'));
$inp=input1('frm1'.$id,$frm,'24','','','',atk('getbyid(\'slctfrm'.$id.'\').innerHTML=\'\''));
$ret=$picto.$inp.divd('slctfrm'.$id,'');
if($sav)return $ret; return divb($ret,'small','frm'.$id);}

function slct_frm($id,$frm,$res=''){$res=ajxg($res); $w='';
if(rstr(3))$w='AND day>"'.calc_date("360").'"'; $ret='';
$r=sql('distinct(frm)','qda','k','nod="'.ses('qb').'" and substring(frm,1,1)!="_" '.$w.' order by frm');
if($r)foreach($r as $k=>$v)
	$ret.=lj('','frm'.$id.'_call___meta_edit*frm_'.$id.'_'.ajx($k).'_frm1'.$id,$k).' ';
return divc('nbp',$ret);}

function hardurlsuj($id){
$suj=suj_of_id($id);
return hardurl($suj);}

//slctlang
function langslct($id,$lg=''){$bt='';
if($lg=='find'){$suj=sql('suj','qda','v','id='.$id);
	if(rstr(129))$lg=yandex::detect('','',$suj); else $lg='';}
if($lg){update('qda','lg',$lg,'id',$id); cachevs($id,12,$lg,1);}
else $lg=sql('lg','qda','v','id="'.$id.'"');
if(!$lg)$lg=prmb(25); $lgs=prmb(26); $r=explode(' ',$lgs);
foreach($r as $k=>$v){$c=$v==$lg?'active':'';
	$bt.=lj($c,'lng'.$id.'_slctlang___'.$id.'_'.$v,flag($v),att($v)).' ';}
//$bt.=lj('','lng'.$id.'_slctlang___'.$id.'_find',picto('enquiry'));
$lgn=msql::val('system','edition_flags_7',$lg,0);
$bt.=toggle('popbt','slc'.$id.'_call_meta_lgsl_'.$id.'_'.$lg,$lgn);
$ret=picto('flag').' '.btn('nbp',$bt).btd('slc'.$id,'');
$ret.=btn('nbp',otherlangs($lg,$id,$r));
if($lgs)return $ret;}

function lgsl($id,$lg){$ret='';
$r=msql::kv('system','edition_flags_4');
foreach($r as $k=>$v)$ret.=lj(active($k,$lg),'lng'.$id.'_slctlang___'.$id.'_'.$k,$v);
return divc('list scroll',$ret);}

//otherlangs
function otherlangs($lng,$id,$r){
$ret=lj('','art'.$id.'_yandex,play__3_art'.$id.'_'.$lng,flag($lng)).'&#8658';
foreach($r as $k=>$v)if($v!=$lng)$ret.=lj('','art'.$id.'_yandex,call__3_art'.$id.'_'.$v.'-'.$lng,flag($v)).' ';
return div('',picto('language').' '.$ret);}

//translations
function autolang($id,$va){$ret='';
$lg=sql('lg','qda','v','id="'.$id.'"'); if(!$lg)$lg=ses('lng');
$ret=sql('ib','qdd','v','val="lang'.$lg.'" and msg="'.$id.'"');
if(!$ret){$r=sql('ib','qdd','rv','substring(val,1,4)=="lang" and msg="'.$id.'"');//jump to ref
	if($r)foreach($r as $k=>$v)if(!$ret)$ret=autolang($v,$va);}
if($ret)utag_sav($id,'lang'.$va,$ret);
return $ret;}

function affectlgr($id){//other refs for this art
$r=sql('ib','qdd','rv','substring(val,1,4)=="lang" and msg="'.$id.'"');//arts using this one as ref
if($r)foreach($r as $k=>$v){$lgb=sql('lg','qda','v',$v); utag_sav($id,'lang'.$lgb,$v);}}

function affectlangs($id,$lg){$ret=''; if(!$lg)$lg=ses('lng'); affectlgr($id);
$lgs=explode(' ',prmb(26)); $r=[];
foreach($lgs as $k=>$v)$r[]=sql('msg','qdd','v','val="lang'.$v.'" and ib="'.$id.'"'); //p($r);
return json_encode($r);}

//options
function art_options($id,$lg){$ret='';
$r=$_SESSION['art_options']; $lgs=explode(' ',prmb(26));
$ra=sql('val,msg','qdd','kv','ib="'.$id.'"'); $rst=arr(ses('rstr'),150);
$rd=valk($ra,$r);
if($r)foreach($r as $k=>$v){$val=$rd[$v]; $hlp=''; $sid=normalize($v).$id;
	if($v=='folder'){$rid='s'.$sid; $ret.=picto('virtual'); $hlp=btd($rid,'');
	$ret.=toggle('poph',$rid.'_virtualfolder_'.$id.'_folder',nms(73));}
	if($v=='related'){$ret.=picto('file-chain').btn('poph',nms(138)); $hlp=hlpbt('meta_related');}
	if($v=='agenda'){$rid='s'.$sid; $ret.=picto('time'); $hlp=btd($rid,'');
	$ret.=toggle('poph',$rid.'_plug_calendar_calendar*build__'.$sid,'Agenda');}
	elseif($v=='password')$ret.=picto('unlock').btn('poph','password');
	elseif($v=='lang'){$rl=[];
		foreach($lgs as $lg2)$rl[]='lang'.$lg2.$id; $j=implode(',',$rl).'_affectlangs___'.$id.'_'.$lg;
		$ret.=picto('global').lj('poph',$j,pictxt('enquiry',nms(163)));}
//$ret.=btn('',picto('valid').' '.nms(166));
if($v=='authlevel'){$ret.=btn('popbt',$v.' '.menuderj_prep('all|1|2|3|4|5|6|7|8',$sid,$val,'1')).br();}
elseif($v=='template'){$val=$val?$val:' '; $hlp=btd('tmp'.$id,'');
	$tmpub=msql_read('','public_template','',1);
	$tmprv=msql_read('',nod('template'),'',1);
	$arr=array_merge_b($tmpub,$tmprv); $arr[' ']=[''=>1];
	$klist=implode('|',array_keys($arr));
	$ret.=btn('popbt',$v.' '.menuderj_prep($klist,$sid,$val?trim($val):$v,'1')).' ';}
elseif($v=='password'){$ret.=input($sid,$val,atz(4));}
elseif($v=='tracks'){if((!$rst[1] && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}
elseif($v=='2cols'){if((!$rst[17] && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}
elseif($v=='fav'){if((!$rst[52] && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}
elseif($v=='like'){if((!$rst[90] && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}
elseif($v=='poll'){if((!$rst[91] && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}
elseif($v=='mood'){if((!$rst[119] && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}
elseif($v=='bckp'){if((!$rst[106] && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}
elseif($v=='artstat'){if((!$rst[71] && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}//$ret.=hlpbt('meta_abilities')
elseif($v=='quote'){if((!$rst[109] && !$val) or $val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}
elseif($v=='plan'){if($val=='true')$chk=1; else $chk=0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));}
elseif($v=='lastup'){$chk=$val?$val:0;
	$ret.=btn('txtx',checkbox_j($sid,$chk,$v));
	if($chk)$ret.=ljj('txtx','jumpvalue',[$sid,time()],pictit('refresh','update'));}
elseif($v=='lang'){if($lgs){
	foreach($lgs as $va){
		if($va!=$lg){
		$ret.=lj('txtsmall2',$v.$va.$id.'_autolang__4_'.$id.'_'.$va,$va);
		$ret.=input1($v.$va.$id,val($ra,'lang'.$va),'4');}
		else $ret.=hidden('',$v.$va.$id,'');}
	$ret.=hlpbt('meta_lang');
	$lang=$rd['lang'];}
	$ret.=br();}
else $ret.=ljb('poph','jumpvalue',[$sid,' '],ascii(10006)).' '.bal('input',['type'=>'text','id'=>$sid,'value'=>$val,'size'=>'14','maxlength'=>'255','autocomplete'=>'off'],'').$hlp.br();}
return $ret;}

//category
function slct_category($btid,$hid,$n){$frm=$_SESSION['frm'];
$r=sql('frm','qda','k','nod="'.$_SESSION['qb'].'" AND frm!="_system" AND frm!="_trash" AND day>"'.calc_date("360").'" ORDER BY frm');
if(auth(3))$r['_system']=1; if(!isset($r[$frm]))$r[$frm]=1; $r['public']=1; unset($r['Home']); 
$ret=menuder_jb($r,$hid,$btid,2,$n);
return $ret;}

//folder
function virtualfolder_slct($id,$o=''){$r=sql('msg','qdd','k','val="folder"'); $ret='';
if($r)foreach($r as $k=>$v)$ret.=ljj('','jumpvalue',[$o.$id,$k],$k).' ';
return divc('nbp',$ret);}

//words
function u_words($id){$ret='';
$cats=catag();
$ro=explode(' ','tag '.prmb(19));
$t=divc('txtcadr',nms(47)); $ret='';
foreach($cats as $k=>$v){list($r,$re)=match_tags($id,$v,1); $rt='';
	if($r){$rta=picto($ro[$k],24).' '; $tg=eradic_acc($v);
	foreach($r as $ka=>$va){$n=isset($re[$ka])?' ('.$re[$ka].')':'';
		$rt.=lj('','popup_api___'.$tg.':'.$va,$ka.$n).' ';}
	if($rt)$ret.=divc('nbp',$rta.$rt);}}
return $ret?$t.$ret:nmx([11,16]);} 

//save all from search
function tagall_slct($vrf,$srch){$r=catag(); $ret='';
foreach($r as $v)$ret.=lj('','socket_savtagall__xc_'.ajx($v).'_'.ajx($vrf).'_'.ajx($srch),$v);
return divc('list',$ret).divb('','alert','svtg');}
function savtagall($cat,$vrf,$tag){req('spe');
if(!tag_auth($cat))return;
$r=$_SESSION['recache'][$vrf]; $rn=[];
if($r)foreach($r as $k=>$v)$rn[]=sav_tag('',$k,$cat,$tag);
return count($rn);}

//save from search
function tag_slct($id,$srch){$r=catag(); $ret='';
foreach($r as $v)$ret.=lj('','socket_savtag__xc_'.ajx($v).'_'.$id.'_'.ajx($srch),$v);
return divc('list',$ret).divb('','alert','svtg');}
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
	$idtag=insert('qdt','(NULL,"'.$cat.'","'.$tag.'")');
return $idtag;}

function idartag($idart,$idtag){
$ex=sql('id','qdta','v','idart="'.$idart.'" and idtag="'.$idtag.'"');
return $ex;}

function add_artag($idart,$idtag,$cat,$tag){
$idartag=idartag($idart,$idtag);
if(!$idartag && $idart && $idtag)
	$idartag=insert('qdta','(NULL,"'.$idart.'","'.$idtag.'")');
return $idartag;}

function add_tag_btn($r,$idart,$cat,$curtag='',$re=[]){
$rid=normalize($cat).$idart; $ret='';
if($curtag)$ret=lj('txtred',$rid.'_addtag___0_'.$idart.'_'.$cat.'_'.ajx($curtag),$curtag).' ';
if($r)foreach($r as $idtag=>$tag){
	$j=$rid.'_addtag___'.$idtag.'_'.$idart.'_'.$cat; if(isset($re[$tag]))$tag.=' ('.$re[$tag].')';
	$ret.=lj('',$j,$tag).' ';}
return divc('nbp','&#10010; '.$ret);}

function del_tag_btn($r,$idart,$cat){
$rid=normalize($cat).$idart; $ret='';
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
$rid=normalize($cat).$idart; $ret=' ';
if($action=='remove')$x=removetag($idtag); else $x='';
$idartag=idartag($idart,$idtag);
if($idartag)sqldel('qdta',$idartag);
$r=read_tags($idart,$cat);
$ret=del_tag_btn($r,$idart,$cat);
if(!$x){$rb=sql('idart','qdta','rv','idtag="'.$idtag.'"');//remove if unused tag
if(!$rb)$ret.=lj('txtred',$rid.'_deltag___'.$idtag.'_'.$idart.'_'.$cat.'_remove','remove tag '.$idtag).' ';}
return $ret;}

/*	$j=$rid.'_deltagall___'.$idtag.'_'.$idart.'_'.$cat;
	$ret.=lj('nbp',$j,'&#10006;&nbsp;'.$tag).' ';*/
function deltagall($idart,$cat){$ret='';
$r=sql('id,tag','qdt','kv','idart="'.$idart.'" and cat="'.$cat.'"');
foreach($r as $idtag=>$v)$ret.=deltag($idtag,$idart,$cat,'remove');
return $ret;}

#selector
function find_tags($cat,$curtag){
$r=sql('id,tag','qdt','kv','cat="'.$cat.'" and tag like "%'.$curtag.'%" order by id desc'); //p($r);
return $r;}

function slctag($idart,$cat,$curtag){
if(!tag_auth($cat))return;
$curtag=trim($curtag);
$ra=find_tags($cat,$curtag);//possibles
if($ra)if(in_array($curtag,$ra))$curtag='';
$rb=read_tags($idart,$cat);//existing
if($rb)if(in_array($curtag,$rb))$curtag='';
if($ra && $rb)$r=array_diff($ra,$rb); elseif($ra)$r=$ra; else $r='';
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
function editag($id,$cat,$ico){
if($cat=='utag'){$auto=hlpbt('usertags'); $cat=ses('iq');}
if(!tag_auth($cat))return;
$rid=normalize($cat).$id; $j='slct'.$rid.'_matchtag___'.$id.'_'.ajx($cat); 
$auto=lj('',$j,ascii(9660)).' '; //$_POST['opall'][]=$j;
$picto=lj('','slct'.$rid.'_call__3_meta-spe_list*tags_'.$id.'_'.ajx($cat),picto($ico,'min-width:22px;')).'';
$r=read_tags($id,$cat);
$ret=del_tag_btn($r,$id,$cat); $inp='';
if(is_numeric($cat)){
	$j='autocomp(\''.$id.'\',\''.$cat.'\');'; $js='" onkeyup="'.$j.'" onclick="'.$j;
	$inp=input1('inp'.$id,$js,12).hlpbt('usertags');}
return divc('small',$picto.$inp.$auto.btd($rid,$ret).divd('slct'.$rid,''));}

function meta_all($id,$prw){$r['tag']='tag'; $ret='';
$bt=lj('popsav',$id.'_artin___'.$id.'_'.$prw,picto('valid')).' ';
$re=sql('re','qda','v','id='.$id);
$bt.=btd('rdbt'.$id,prior_edit($re,$id)).br();//priority
$rc=explode(' ',prmb(18)); $ro=explode(' ',prmb(19)); $r+=array_combine($rc,$ro);
$rj=[]; foreach($rc as $k=>$v)$rj[]='slct'.normalize($v).$id; 
foreach($r as $cat=>$ro)if($cat)$ret.=editag($id,$cat,$ro);
$ja=implode(',',$rj).'_matchall__json_'.$id;
$j=atjr('autocomp',[$id,'tag '.prmb(18)]); $js=atk($j).atkp($j);
//$j=atjr('autocomp',[$id,$ja]); $js=atk($j).atkp($j);
$bt.=lj('','popup_metall___'.$id.'_'.$prw,picto('popup')).' ';
$bt.=input1('inp'.$id,nms(24),12,'',1,255,$js);
//$bt.=ljb('','SaveJc',implode(';',$_POST['opall']),picto('enquiry'));
$bt.=lj('',$ja,picto('enquiry'));
$ret.=divd('lng'.$id,langslct($id));
return divs('min-width:340px; padding:0 4px;',$bt.$ret);}

//list_tags
function list_tags($id,$cat){//tag_list()
if(rstr(3) && !is_numeric($cat))$limit=' and day>"'.calc_date(30).'"'; else $limit='';
$wh='and cat="'.$cat.'"'.$limit.' order by tag';
$r=artags('idtag,tag',$wh,'kv');
return add_tag_btn($r,$id,$cat);}

#match
function catag(){return explode(' ','tag '.prmb(18));}

function each_words($d){
$d=str_replace(['?','.','/',',',';',':','!','"','(',')','[',']'],'',$d);
$r=explode(' ',$d); $n=count($r); $ret=[];
for($i=0;$i<$n;$i++)if($r[$i])$ret[$r[$i]]=radd($ret,$r[$i]);
$r=['de','et','la','les','a','le','des','du','que','en','ne','au','qui','on','se','sur','un','par','il','une','ils','cela','ou','ce','aux','ces','mais','ni','-',"&nbsp;"];	
foreach($r as $k=>$v)if(isset($ret[$v]))unset($ret[$v]);
return $ret;}

function prep_msg($id){
$suj=sql('suj','qda','v','id='.$id);
$msg=sql('msg','qdm','v','id='.$id); $msg=html_entity_decode($suj."\n".$msg);
if(strpos($msg,':import') or strpos($msg,':read'))$msg=strip_tags(conn::read($msg,$id,3));
else $msg=clean_internaltag($msg); $msg=strtolower(eradic_acc($msg)); $msg=deln($msg,' ');
$msg=str_replace("&nbsp;"," ",$msg);
return $msg;}

//$ra:mot=>nb occurences //$rb,rx,rd,rf:tag=>id //rdb:id=>tag //re:id=>nb
//todo:mots reconnus comme étant déjà tagués dans une autre langue via leur id
function match_tags($idart,$cat,$o=''){$rd=[]; $re=[];
$msg=prep_msg($idart); $ra=each_words($msg); arsort($ra);
$lg=sql('lg','qda','v','id="'.$idart.'"'); $lga=prmb(25); if($lg=='')$lg=$lga; $rb=[];
$rn=array_flip(catag()); $n=$rn[$cat]+1;
if($lg!=$lga){$rb=msql::kx('',nod('tags_'.$n.$lg),0); if($rb)$rb=array_flip($rb);}//langs
if(!$rb)$rb=sql('tag,id','qdt','kv','cat="'.$cat.'" order by id desc');
if($lg=='fr'){$rbb=msql::kn('',nod('syn_'.$n),1,0); if($rbb)$rb+=$rbb;}//synonyms
$rx=read_tags($idart,$cat); $rx=array_flip($rx);//existing
if($rx)$rb=array_diff_key($rb,$rx);//del exs
if($rb)$rd=array_intersect_key($rb,$ra); $rdb=array_flip($rd);//detected
if($rb)foreach($rb as $k=>$v){$vb=strtolower(eradic_acc($k));
	if(!isset($rdb[$v]))if(preg_match("/\b".$vb."\b/i",$msg)){// && strpos($msg,$vb)!==false
		$rd[$k]=$v; $rn=detect_words($msg,$vb,1); $re[$k]=count($rn);}}//count_occurrences($msg,$vb)
$rdb=array_flip($rd);
if($re){arsort($re); foreach($re as $k=>$v)$rf[$rd[$k]]=$k; 
	foreach($rdb as $k=>$v)if(!isset($rf[$v]))$rf[$k]=$v; $rdb=$rf;}
if($o)return [$rd,$re]; if(!$rd)return ' ';
return add_tag_btn($rdb,$idart,$cat,'',$re);}

function match_all($id,$va=''){$cats=catag(); $rt=[];
foreach($cats as $k=>$v)$rt['slct'.normalize($v).$id]=match_tags($id,$v);
return $rt;}

#admin
//remove
function remsecurity(){
$ip=sql('ip','qd','v','name="'.ses('qb').'"');
if(auth(6) && cookie('iq')==$ip)return true;}

function removetag($idtag){//from editor
if(!remsecurity())return;
$rb=sql('idart','qdta','rv','idtag="'.$idtag.'"');//existing
if(!$rb)sqldel('qdt',$idtag);
json::add('','rmtag',[$idtag=>hostname()]);
return 'ok';}

function remove_tag($idtag){//from admin
if(!auth(6))return;//remsecurity()
if($idtag){qr('delete from '.ses('qdta').' where idtag="'.$idtag.'"');
sqldel('qdt',$idtag);
json::add('','rmtag',[$idtag=>hostname()]);}
return divc('txtalert','remove: '.$idtag);}

//rename
function rename_tag($idtag,$cat,$res=''){
if(!auth(6))return; $res=ajxg($res); $rid=randid('rnmtag'); $ret='';
$tag=sql('tag','qdt','v','id='.$idtag);
$ret=divc('txtcadr',nms(87).': '.$tag);
$ret.=divc('small',helps('tag_rename'));
$ret.=input('rnmtg',$tag);
$ret.=lj('popbt',$rid.'_call___meta_rename*tag_'.$idtag.'_'.$cat.'_rnmtg',picto('ok')).br();
if($res){$ex=sql('id','qdt','v','tag="'.$res.'" collate latin1_general_cs and cat="'.$cat.'"');
	if(!$ex){update('qdt','tag',$res,'id',$idtag);//rename
		$ret.=divc('txtalert',$tag.' became '.$res);}
	elseif($idtag && $idtag!=$ex){//attach to existing tag
		update('qdta','idtag',$ex,'idtag',$idtag); sqldel('qdt',$idtag);
		$ret.=divc('txtalert',$tag.' is erased and references are linked to '.$res);}
	else $ret.=divc('txtalert','nothing has changed');}
rename_tagmsq($idtag,$cat,$res);
return divd($rid,$ret);}

function rename_tagmsq($idtag,$cat,$d){$lg=prmb(25);
$rt=catag(); foreach($rt as $k=>$v)$rn[$v]=$k+1; $n=$rn[$cat]; $nd=nod('tags_'.$n.$lg);
$rb=msql::modif('',$nd,'','shot',0,$idtag);
return $nd.':modified => '.msqbt('',$nd);}

//recat
function recat_tag($idtag,$newcat=''){
if(!auth(6))return; $rid=randid('recat'); $ret='';
list($tag,$cat)=sql('tag,cat','qdt','r','id='.$idtag);
$ret=divc('txtcadr',nms(140).': '.$tag.' in '.$cat);
$ret.=divc('small',helps('tag_rename'));
$utags=catag();//cats
foreach($utags as $v)if($v!=$cat)
	$ret.=lj('popbt',$rid.'_call___meta_recat*tag_'.$idtag.'_'.ajx($v),$v).br();
if($newcat){
	$ex=sql('id','qdt','v','tag="'.$tag.'" and cat="'.$newcat.'"');
	if(!$ex){update('qdt','cat',$newcat,'id',$idtag); 
		$ret=divc('txtalert',$cat.' => '.$newcat);}
	elseif($ex!=$idtag){update('qdta','idtag',$ex,'idtag',$idtag);
		if($idtag)sqldel('qdt',$idtag); $ret=divc('txtalert',$tag.' in '.$cat.' is erased and references are linked to '.$tag.' in '.$newcat);}}
//recat_tagmsq($idtag,$cat1,$newcat,$res);
return divd($rid,$ret);}

function recat_tagmsq($idtag,$cat1,$cat2,$d){$lg=prmb(25);
$rt=catag(); foreach($rt as $k=>$v)$rn[$v]=$k+1; $n1=$rn[$cat1]; $n2=$rn[$cat2];
$rb=msql::modif('',nod('tags_'.$n2.lg),[$d],'row','',$idtag);
$rb=msql::modif('',nod('tags_'.$n1.lg),'','del','',$idtag);
return $d.': passed form '.$cat1.' to '.$cat2.' => '.msqbt('',nod('tags_'.$n2.lg));}

//transcat
function trans_tag($idtag,$p='',$res=''){$res=ajxg($res);
if(!auth(6))return; $rid=randid('trnsct'); $ret='';
$tag=sql('tag','qdt','v','id='.$idtag);
$ret=divc('txtcadr',nmx([140,142,9,2,141]).': '.$tag);
$ret.=input('trsct',$tag);
$ret.=lj('popbt',$rid.'_call___meta_trans*tag_'.$idtag.'_'.$cat.'_trsct','ok').br();
if($res){$r=sql('idart','qdta','rv','idtag="'.$idtag.'"');
	foreach($r as $k=>$id)update('qda','frm',$res,'id',$id);
	$ret.=divc('txtalert','All the articles with tag "'.$tag.'" are put in category: '.$res);}
return divd($rid,$ret);}

//list_artag
function list_artag($idtag,$cat){$ret='';
$rb=sql('idart','qdta','rv','idtag="'.$idtag.'"');//existing
if($rb)foreach($rb as $idart)$ret.=lj('popbt','popup_callp___meta-spe_editag_'.$idart.'_'.$cat,pictxt('tag',$idart)).' '.popart($idart,suj_of_id($idart)).br();
return divc('small',$ret);}

#admin
function admin_tags_edit($idtag,$cat){
$rid=randid('deltag'); $ret='';
if($cat=='folder')$tag=sql('msg','qdd','v','id='.$idtag);
else $tag=sql('tag','qdt','v','id='.$idtag);
$ret=divc('txtcadr',$tag.' (id:'.$idtag.')');
$tg='cbk'.$rid.'_call___meta'; $j='popup_callp__3x_meta';
$ret.=lj('popbt',$j.'-spe_list*artag_'.$idtag.'_'.ajx($cat),pictxt('view',nms(2))).' ';
$ret.=lj('popsav',$j.'_rename*tag_'.$idtag.'_'.$cat,pictxt('edit',nms(87))).' ';
$ret.=lj('popsav',$j.'_recat*tag_'.$idtag,pictxt('edit',nms(140))).' ';
$ret.=lj('popsav',$j.'_trans*tag_'.$idtag.'_'.ajx($cat),pictxt('edit',nms(9))).' ';
$ret.=lj('txtyl',$tg.'_remove*tag_'.$idtag,pictxt('del',nmx([43,100])));
$ret.=divd('cbk'.$rid,'');
return divd($rid,$ret);}

function admin_folders_edit($tag,$p,$res=''){$res=ajxg($res);
if(!auth(6))return; $rid=randid('fldr');
$ret=input('fldr',$res?$res:$tag);
$ret.=lj('popsav',$rid.'_call___meta_admin*folders*edit_'.ajx($tag).'__fldr',nms(87));
if($res && $tag){$r=sql('id','qdd','rv','val="folder" and msg="'.$tag.'"');
	if($r)foreach($r as $k=>$id)update('qdd','msg',$res,'id',$id);
	$ret.=divc('txtalert','Folder "'.$tag.'" renamed: '.$res);}
return divd($rid,$ret);}

function admin_tags($cat){
$rid=randid('admtag'); $ret='';
$utags=catag(); $utags[]=ses('iq'); $utags[]='folders';
foreach($utags as $v){$c=$v==$cat?'txtblc':'txtx';
	$ret.=lj($c,$rid.'_call___meta_admin*tags_'.ajx($v),is_numeric($v)?'usertags':$v).' ';}
$ret.=' | '.lj($c,$rid.'_clusters,home___','clusters').' ';
$ret.=lj($c,$rid.'_call___meta_admin*tags2msql__en',nms(153)).' ';
$ret.=lj($c,$rid.'_call___meta_admin*synonyms',nms(192)).' ';
$ret=divc('',$ret);
if($cat=='folders'){$ra=sql('msg','qdd','k','val="folder"'); $rb='';
	$j='popup_callp___meta-spe_admin*folders*edit_';
	if($ra)foreach($ra as $k=>$v)
		$ret.=lj('popbt',$j.ajx($k),pictxt('popup',$k.'&nbsp;('.$v.')')).' ';}
elseif($cat){
	//$ra=sql_inner('idtag,idart','qda','qdta','idart','k','where nod="'.ses('qb').'"');
	$ra=sql('idtag,idart','qdta','k','');
	if(!empty($ra))arsort($ra);
	$rb=sql('id,tag','qdt','kv','cat="'.$cat.'"'); $rc=[];
	if($ra)foreach($ra as $k=>$v)if(isset($rb[$k]))$rc[$k]=[$rb[$k],$v];//idtag=>id,tag
	$ret.=divc('nbp',count($rc).' '.$cat).br();
	$j='popup_callp___meta-spe_admin*tags*edit_';
	if($rc)foreach($rc as $idtag=>$v)
		$ret.=lj('txtx',$j.$idtag.'_'.$cat,pictxt('popup',$v[0].'&nbsp;('.$v[1].')')).' ';}
	//maintenance('idtag','tag','qdt','qdta');
	//$ra=sql_inner('idtag,tag','qdta','qdt','idtag','kv','where idtag is null',1); p($ra);
return divd($rid,$ret);}

function admin_tags2msql($cat,$lg){
$rt=catag(); $rn=[]; $bt=''; $n=0; $ret=divc('txtcadr',nms(191));
foreach($rt as $k=>$v){$rn[$v]=$k+1; $bt.=lj(active($cat,$v),'tg2msq_call___meta_admin*tags2msql_'.$v.'_'.$lg,$v).' ';}
foreach(['en','es'] as $k=>$v){$bt.=lj(active($lg,$v),'tg2msq_call___meta_admin*tags2msql_'.$cat.'_'.$v,$v).' ';}
$ret.=divc('nbp',$bt);
if($cat){$n=$rn[$cat];//auteurs thèmes pays type personnalité org corp
	$ra=sql('id,tag','qdt','kv',['cat'=>$cat],0); //p($ra);
	$rb=msql::kx('',nod('tags_'.$n.'fr'),0); //pr($rb);
	$rc=array_diff_key($ra,$rb); //pr($rc);
	$ret.=divc('txtcadr','newly added:'.count($rc));
	$ret.=msqbt('',nod('tags_'.$n.$lg));
	$j='popup_callp___meta-spe_admin*tags*edit_';
	if($rc)foreach($rc as $idtag=>$v)$ret.=lj('txtx',$j.$idtag.'_'.$cat,pictxt('popup',$v)).' ';
	if($rc)$r=msql::modif('',nod('tags_'.$n.'fr'),$rc,'mdfv'); //pr($r);
	$rd=msql::kx('',nod('tags_'.$n.$lg),0,['idtag',$cat]);//pr($rd);
	$re=array_diff_key($rb,$rd); //pr($re);
	$ret.=divc('txtcadr',$n.':'.count($rb).'-'.count($rd).'='.count($re));
	if($re)$ret.=implode_k($re,br(),';');}
return divd('tg2msq',$ret);}

function admin_syn_edit($cat,$idtag,$res=''){
$ret=divc('txtcadr','add synonym for id:'.$idtag.''); $rid='synedt'.$idtag;
$j='tg2syn_callp__x_meta-spe_admin*synonyms_'.$cat.'_'.$idtag.'_'.$rid;
$ret.=input($rid,'').' '.lj('popsav',$j,pictxt('edit',nms(57))).' ';
return $ret;}

function admin_synonyms($cat,$idtag,$res=''){$res=ajxg($res);
$rt=catag(); $rn=[]; $bt=''; $n=0; $ret=divc('txtcadr',nms(192));
foreach($rt as $k=>$v){$rn[$v]=$k+1; $bt.=lj(active($cat,$v),'tg2syn_call___meta_admin*synonyms_'.$v,$v).' ';}
$ret.=divc('nbp',$bt);
if($cat){$n=$rn[$cat];
	if($idtag && $res)$r=msql::modif('',nod('syn_'.$n),[$idtag,$res],'push'); //pr($r);
	$j='tg2syn_callp___meta-spe_admin*synonyms_'.$cat.'_';
	$ra=sql('id,tag','qdt','kv','cat="'.$cat.'" order by tag',0); $ra=[0=>$cat]+$ra;//p($ra);
	$ret.=select(['id'=>'adsyn'],$ra,'',$idtag,$j);
	$rc=msql::kv('',nod('syn_'.$n),0); $rc=[0=>nms(192)]+$rc;//pr($rc);
	$ret.=select(['id'=>'adsyn'],$rc,'',$idtag,$j);
	$rb=msql::select('',nod('syn_'.$n),$idtag);//pr($rb);
	$ret.=msqbt('',nod('syn_'.$n));
	$j='popup_editmsql___users(slash)'.ajx(nod('syn_'.$n)).'_';
	if($rb)foreach($rb as $k=>$v)$ret.=lj('txtx',$j.$k,pictxt('popup',$v[1])).' ';
	$j='popup_callp___meta-spe_admin*syn*edit_'.$cat.'_'.$idtag;
	if($idtag)$ret.=lj('txtx',$j,pictxt('add',nms(92))).' ';}//new
return divd('tg2syn',$ret);}

class meta{
static function admin_tags($cat){return admin_tags($cat);}
static function admin_tags2msql($cat){return admin_tags2msql($cat);}
}

?>