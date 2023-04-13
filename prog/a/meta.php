<?php //meta
class meta{
static function utag_sav($id,$val,$msg){$msg=trim($msg??'');//space mean erase
[$vrf,$msb]=sql('id,msg','qdd','r',['ib'=>$id,'val'=>$val]);
if($vrf && !$msg)sql::del('qdd',$vrf);
elseif(!$vrf && $msg)sqlsav('qdd',[$id,$val,$msg]);
elseif($msb!=$msg)sql::upd('qdd',['msg'=>$msg],$vrf);}

static function putincache($id){//cachevs($id,11,$v,1);
$r=sql('day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re,lg','qda','w',$id); $r[3]=pop::art_img($r[3]);
msql::modif('',nod('cache'),$r,'one','',$id); $_SESSION['rqt'][$id]=$r;}

static function titsav($id,$prw,$prm=[]){//pr($prm);
$ra=['ib'=>'ib','frm1'=>'frm','suj'=>'suj','url'=>'thm','img'=>'img','src'=>'mail','author'=>'name','hub'=>'nod'];
foreach($ra as $k=>$v){$va=$prm[$k.$id]??'';
	if($v=='ib' && ($va=='/' or !$va))$va='0';
	elseif($v=='suj')$va=str::clean_title($va);
	elseif($v=='thm' && !$va)$va=str::hardurl($sq['suj']);
	elseif($v=='name' && !$va)$va=ses('qb');
	elseif($v=='nod' && !$va)$va=ses('qb');
	$sq[$v]=$va?trim($va):$va;}
sqlup('qda',$sq,$id,0); self::putincache($id);
$r=ses('art_options'); $rst=ses('rstr');
$ra=sql('val,msg','qdd','kv',['ib'=>$id]);//known
$rd=valk($ra,$r);//waited
if($r)foreach($r as $k=>$v){$val=$rd[$v]; $gv=$prm[$v.$id]??'';
	if($v=='related' or $v=='float_img' or $v=='template' or $v=='folder')$vrf=' ';
	elseif($v=='password')$vrf=''; elseif($v=='agenda')$vrf='';
	elseif($v=='authlevel')$vrf=!$rst[21]?'1':'all';
	elseif($v=='tracks'){$vrf=!$rst[1]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='2cols'){$vrf=!$rst[17]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='fav'){$vrf=!$rst[52]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='like'){$vrf=!$rst[90]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='poll'){$vrf=!$rst[91]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='mood'){$vrf=!$rst[119]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='bckp'){$vrf=!$rst[106]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='agree'){$vrf=!$rst[125]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='artstat'){$vrf=!$rst[71]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='quote'){$vrf=!$rst[109]?'true':'false'; $gv=$gv==1?'true':'false';}
	elseif($v=='plan'){$vrf=$gv?'true':'false';}
	elseif($v=='lastup'){$vrf=$gv?'true':'false';}//$rst[113]
	elseif($v=='lang'){$vrf=prmb(25); $rl=explode(' ',prmb(26));
		if($rl)foreach($rl as $ka=>$va){$known=$ra['lang'.$va]??''; $newval=$prm[$v.$va.$id]??'';
			if($newval && $newval!=$known){self::utag_sav($id,'lang'.$va,$newval);
				$lg=sql('lg','qda','v',$id); if(!$lg)$lg=ses('lng'); self::utag_sav($newval,'lang'.$lg,$id);
				self::affectlgr($id,$va);}}}
	if(!$val)$val=$vrf;//permut value with global setting
	if($gv==$vrf && $val)$gv='';//erase if not usefull
	if($gv!=$val)self::utag_sav($id,$v,$gv);}
return art::playd($id,$prw);}//$gv &&

/*static function same_suj($suj){
$r=sql('id','qda','k',['suj'=>$suj,'nod'=>ses('qb'),'_order'=>'id DESC']);
foreach($r as $k=>$v){if($k!=ses('read'))$ret.=lk('/?read='.$k,$k).' ';}
if($ret)return btn('txtsmall','with_same_title: '.$ret);}*/

static function priorsav($v,$id){
if($v=='trash')sql::upd('qda',['frm'=>'_trash'],$id);
//elseif($v=='del' && auth(6)){sql::upd('qda',['nod'=>'_trash'],$id); unset($_SESSION['rqt'][$id]);}
else sql::upd('qda',['re'=>$v],$id); cachevs($id,11,$v,1);
return self::prior_edit($v,$id);}

static function prior_edit($va,$id){
$j='rdbt'.$id.'_meta,priorsav___'; $ret='';
$ra=opt(prmb('7'),' ',5); if($ra)$r=[1=>$ra[0]==1?'-':$ra[0],2=>$ra[1]==2?picto('s1'):$ra[1],3=>$ra[2]==3?picto('s2'):$ra[2],4=>$ra[3]==4?picto('s3'):$ra[3],5=>$ra[4]==5?picto('stars'):$ra[4]];
else $r=[2=>picto('s1'),3=>picto('s2'),4=>picto('s3'),5=>picto('stars')];
if($va==0)$ret.=lj('',$j.'trash_'.$id,picto('trash')).' ';
if($va==0)$ret.=lj('active',$j.'del_'.$id,picto('del'),att(nms(43))).' ';
$ret.=lj('',$j.($va==0?1:0).'_'.$id,offon($va)).' ';
foreach($r as $k=>$v){$js=sj($j.($k==$va?1:$k).'_'.$id);
	$js.=' var ob=getbyid(\'art\'+'.$id.'); '; $ex=$k?'hide':''; $rep=$k?'':'hide';
	$js.='ob.className=ob.className.replace(\'justy '.$ex.'\',\'justy '.$rep.'\');';
	$ret.=btj($v,$js,active($k,$va)).' ';}
return btn('nbp',$ret);}

static function editdaysav($id,$o,$prm){$d=$prm[0]??''; $day=strtotime($d);
if($day && auth(5)){sql::upd('qda',['day'=>$day],$id); cachevs($id,0,$day,1);}
return self::editday($id).btn('txtyl','saved');}

static function editday($id){
$time=sql('day','qda','v',$id); $day=date('Y-m-d\TH:i',$time);
$ret=inpdate('chd'.$id,$day,'','',1);
$ret.=lj('popw','cbk'.$id.'_meta,editdaysav_chd'.$id.'__'.$id,'ok');
return $ret;}

static function recapauthor($id){
$d=sql('mail','qda','v',$id); $p=strend($d,'/');
$nm=sql::call('select screen_name from pub_umtwits where twid='.$p,'v');
if(!$nm){$q=twit::read($p); $r=twit::datas($q); $nm=$r['screen_name'];}
return $nm;}

static function artopt($id){return tabler(art::metart($id));}
static function png2jpg($id,$prw){codeline::png2jpg($id,1); echo ses::adm('alert');
return art::playd($id,$prw);}

static function addfoot($id,$prw){
$d=sql('msg','qdm','v',$id); $d=mc::add_anchors($d);
if($d)sql::upd('qdm',['msg'=>$d],$id);
return art::playd($id,$prw);}

static function titedt($id,$prw){$css='poph'; $ret='';
$ra=sql('ib,day,name,nod,mail,suj,frm,img,thm,re,lg','qda','r',$id);
[$ib,$day,$name,$hub,$src,$suj,$frm,$img,$url,$re,$lg]=$ra; if(!$lg)$lg=ses('lng');
if(rstr(38))$ret.=btn('txtsmall2','#'.$id).' ';
$ret.=toggle('','cbk'.$id.'_usg,getparent___'.$id,picto('topo'));
$ret.=input('ib'.$id,$ib,3);
$ret.=ljb($css,'jumpvalue',['ib'.$id,''],ascii(10006));
$ret.=lj($css,'popup_tracks,form___'.$id,picto('forum'));
//$ret.=lj($css,'popup_deploy,home___'.$id,picto('maillist'),att('deploy by mail list'));
//if(auth(6) && $src)$ret.=lj($css,$id.'_sav,recapart___'.$id,picto('update'),att('backup+reimport'));
//$ret.=toggle($css,'cbk'.$id.'_sav,reimportedt___'.$id.'_'.$prw,picto('rollback'));
$ret.=toggle($css,'cbk'.$id.'_translate,home___'.$id,picto('translate'));
//$ret.=toggle($css,'cbk'.$id.'_translate,repair___'.$id,picto('tools'));//missing qdm
//$ret.=toggle($css,'cbk'.$id.'_mails,sendart___'.$id,picto('mail'),'',att('send'));
$ret.=toggle($css,'cbk'.$id.'_few,exportation___'.$id.'_'.ses('qb'),picto('export'));
//$ret.=lj($css,'art'.$id.'few,importation___'.$id.'_'.$prw,picto('cycle'),att(':import'));
//$ret.='['.css.';popup_meta,titedt___'.$id.'_'.$prw.';[detach:picto]:lj]';
//$rb[]=['f'=>'lj','p1'=>$css,'p2'=>'popup_meta,titedt___'.$id.'_'.$prw,'p3'=>'[detach:picto]'];
$dn=['ib','suj','img','src','frm1']; if(rstr(38))$dn[]='url';
$ret.=toggle($css,'cbk'.$id.'_meta,editday___'.$id,picto('time'));
if($_SERVER['HTTP_HOST']=='oumo.fr')
	$ret.=lj($css,'suj'.$id.'_umrenum,last__4_'.ajx($frm).'_'.$id,picto('bb'),att('Oay'));
if(prms('srvmirror'))
$ret.=lj($css,$id.'_sav,art*mirror___'.$id.'_'.$prw,picto('symetry-v'),att('mirror'));
$ret.=lj($css,$id.'_meta,addfoot___'.$id.'_'.$prw,picto('anchor'),att('add anchors'));
$ret.=lj($css,$id.'_meta,png2jpg___'.$id.'_'.$prw,picto('gallery'),att('png2jpg'));
//$ret.=lj($css,'popup_meta,artopt___'.$id.'_'.$prw,picto('folder-tags'),att('metas'));
$ret.=lj($css,'popup_meta,titedt___'.$id.'_'.$prw,picto('popup'),att('detach'));
$ret.=divb('','','cbk'.$id);
$ret.=tag('textarea',['id'=>'suj'.$id,'class'=>'console','style'=>'height:40px; width:100%;'],$suj).br();
if(auth(6) && rstr(6)){$ret.=picto('user').input('author'.$id,$name); $dn[]='author';
	if($src)$ret.=lj('popbt','author'.$id.'_meta,recapauthor__4_'.$id,'twitter author'); $ret.=br();}
if(auth(6) && $hub!=ses('qb')){$ret.=picto('node').input('hub'.$id,$hub).br(); $dn[]='hub';}
$ret.=toggle('','pim'.$id.'_sav,placeim___'.$id,picto('img')).inputb('img'.$id,$img,'36','','512').lj('poph','img'.$id.'_sav,recenseim__4_'.$id,pictit('update','update')).lj('poph','img'.$id.'_sav,orderim__4_'.$id,pictit('before','larger as thumb')).divd('pim'.$id,'');
$ret.=pictit('link','source').inputb('src'.$id,$src,'36','','255');
if($src && auth(4)){
	$ret.=lj('',$id.'_sav,reimport_src'.$id.'_3_'.$id.'_'.$prw,pictit('cycle','reimport')).' ';
	$ret.=lj('','popup_sav,batchpreview__3_'.ajx($src),pictit('acquire','original'));}
$ret.=br();
if(rstr(38)){
	$ret.=pictit('url','url').inputb('url'.$id,$url,'36','','255');
	$ret.=lj('poph','url'.$id.'_meta,hardurlsuj__4_'.$id,pictit('upload','update'));}
$ret.=self::edit_frm($id,$frm);//$tags
$ret.=self::art_options($id,$lg).' ';//art_options
$rao=ses('art_options');
foreach($rao as $k=>$v)if($v!='lang')$dn[]=$v;//by meta_all
$r=explode(' ',prmb(26)); if($r)foreach($r as $k=>$v)$dn[]='lang'.$v;//lang
foreach($dn as $k=>$v)$dn[$k]=$v.$id;//add id
$sav=lj('popsav',$id.'_meta,titsav_'.implode(',',$dn).'_k_'.$id.'_'.$prw,picto('valid')).' ';
ses::$r['popw']=640;
return divs('min-width:440px; padding:0 4px;',$sav.$ret);}

//edit frm
static function edit_frm($id,$frm,$prm=[]){
if($prm){sql::upd('qda',['frm'=>$frm],$id); cachevs($id,1,$frm,1);}
$picto=toggle('','slctfrm'.$id.'_meta,slctfrm___'.$id.'_'.ajx($frm),picto('category',''));
$inp=input('frm1'.$id,$frm,'24');
$ret=$picto.$inp.divd('slctfrm'.$id,'');
if($prm)return $ret; return divb($ret,'','frm'.$id);}

static function slctfrm($id,$frm,$prm=[]){$res=$prm[0]??''; $w='';
if(rstr(3))$w='AND day>"'.timeago("360").'"'; $ret='';
$r=sql('distinct(frm)','qda','k','nod="'.ses('qb').'" and substring(frm,1,1)!="_" '.$w.' order by frm');
if($r)foreach($r as $k=>$v)
	$ret.=lj('','frm'.$id.'_meta,edit*frm_frm1'.$id.'__'.$id.'_'.ajx($k),$k).' ';
return divc('nbp',$ret);}

static function hardurlsuj($id){
$suj=ma::suj_of_id($id); return str::hardurl($suj);}

//langs
static function langslct($id,$lg=''){$bt='';
if($lg=='find'){$suj=sql('suj','qda','v',$id);
	if(rstr(129))$lg=trans::detect('','',$suj); else $lg='';}
if($lg){sql::upd('qda',['lg'=>$lg],$id); cachevs($id,12,$lg,1);}
else $lg=sql('lg','qda','v',$id);
if(!$lg)$lg=prmb(25); $r=explode(' ',prmb(26));
foreach($r as $k=>$v){$c=active($v,$lg);
	$bt.=lj($c,'lng'.$id.'_meta,langslct___'.$id.'_'.$v,flag($v),att($v)).' ';}
//$bt.=lj('','lng'.$id.'_meta,langslct___'.$id.'_find',picto('enquiry'));
$lgn=msql::val('system','edition_flags_7',$lg,0);
$bt.=toggle('popbt','slc'.$id.'_meta,lgsl___'.$id.'_'.$lg,$lgn);
$ret=picto('flag').' '.btn('nbp',$bt).btd('slc'.$id,'');
$ret.=btn('nbp',self::otherlangs($lg,$id));
if($r)return $ret;}

static function lgsl($id,$lg){$ret='';
$r=msql::two('system','edition_flags_4');
foreach($r as $k=>$v)$ret.=lj(active($k,$lg),'lng'.$id.'_meta,langslct___'.$id.'_'.$k,$v);
return divc('list scroll',$ret);}

static function otherlangs($lng,$id){$r=explode(' ',prmb(26));
$ret=lj('','art'.$id.'_trans,play__3_art'.$id.'_'.$lng,flag($lng)).'&#8658';
foreach($r as $k=>$v)if($v!=$lng)$ret.=lj('','art'.$id.'_trans,call__3_art'.$id.'_'.$v.'-'.$lng,flag($v)).' ';
return div('',picto('language').' '.$ret);}

static function autolang($id,$va){$ret='';
$lg=sql('lg','qda','v',$id); if(!$lg)$lg=ses('lng');
$ret=sql('ib','qdd','v',['val'=>'lang'.$lg,'msg'=>$id]);
if(!$ret){$r=sql('ib','qdd','rv','substring(val,1,4)=="lang" and msg="'.$id.'"');//jump to ref
	if($r)foreach($r as $k=>$v)if(!$ret)$ret=self::autolang($v,$va);}
if($ret)self::utag_sav($id,'lang'.$va,$ret);
return $ret;}

static function affectlgr($id){//other refs for this art
$r=sql('ib,val','qdd','kv',['msg'=>$id]);//arts using this one as ref
if($r)foreach($r as $k=>$v)if(substr($v,0,4)=='lang'){
	$lgb=sql('lg','qda','v',$k); self::utag_sav($id,'lang'.$lgb,$k);}}

static function affectlangs($id,$lg){$ret=''; if(!$lg)$lg=ses('lng'); self::affectlgr($id);
$lgs=explode(' ',prmb(26)); $r=[];
foreach($lgs as $k=>$v)$r[]=sql('msg','qdd','v',['val'=>'lang'.$v,'ib'=>$id]);
return json_encode($r);}

//options
static function art_options($id,$lg){$ret='';
$r=ses('art_options'); $lgs=explode(' ',prmb(26));
$ra=sql('val,msg','qdd','kv',['ib'=>$id]); $rst=ses('rstr');
$rd=valk($ra,$r);
if($r)foreach($r as $k=>$v){$val=$rd[$v]; $hlp=''; $sid=normalize($v).$id;
	if($v=='folder'){$rid='s'.$sid; $ret.=picto('virtual'); $hlp=btd($rid,'');
	$ret.=toggle('poph',$rid.'_meta,virtualfolder___'.$id.'_folder',nms(73));}
	if($v=='related'){$ret.=picto('file-chain').btn('poph',nms(138)); $hlp=hlpbt('meta_related');}
	if($v=='agenda'){$rid='s'.$sid; $ret.=picto('time'); $hlp=btd($rid,'');
	$ret.=toggle('poph',$rid.'_calendar,call_'.$sid.'_k__'.$sid,'Agenda');}
	elseif($v=='password')$ret.=label($sid,'password','poph');
	elseif($v=='lang'){$rl=[];
		foreach($lgs as $lg2)$rl[]='lang'.$lg2.$id; $j=implode(',',$rl).'_meta,affectlangs___'.$id.'_'.$lg;
		$ret.=picto('global').lj('poph',$j,pictxt('enquiry',nms(163)));}
//$ret.=btn('',picto('valid').' '.nms(166));
if($v=='authlevel'){$ret.=btn('txtx',$v).' '.jumpmenu('|1|2|3|4|5|6|7|8',$sid,$val,'1').' ';}
//if($v=='authlevel'){$rp=explode('|','all|1|2|3|4|5|6|7|8'); $ret.=select(['id'=>$sid],$rp,'kv',$val).br();}
elseif($v=='template'){$val=$val?$val:' '; $hlp=btd('tmp'.$id,'');
	$tmpub=msql_read('','public_template','',1);
	$tmprv=msql_read('',nod('template'),'',1);
	$arr=array_merge_b($tmpub,$tmprv); $arr[' ']=[''=>1];
	$rp='|'.implode('|',array_keys($arr));
	//$ret.=select(['id'=>$sid],$rp,'kv',$val);
	$ret.=btn('txtx',$v).' '.jumpmenu($rp,$sid,$val?trim($val):$v,'1').' ';}
//elseif($v=='agenda')$ret.=inpdate($sid,$val,'','',1).$hlp.br();
elseif($v=='password')$ret.=input($sid,$val,'4');
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
elseif($v=='agree'){if((!$rst[125] && !$val) or $val=='true')$chk=1; else $chk=0;
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
	if($chk)$ret.=ljb('txtx','jumpvalue',[$sid,time()],pictit('refresh','update'));}
elseif($v=='lang'){if($lgs){
	foreach($lgs as $va){
		if($va!=$lg){
		$ret.=lj('txtsmall2',$v.$va.$id.'_meta,autolang__4_'.$id.'_'.$va,$va);
		$ret.=input($v.$va.$id,$ra['lang'.$va]??'','4');}
		else $ret.=hidden($v.$va.$id,'');}
	$ret.=hlpbt('meta_lang');
	$lang=$rd['lang'];}
	$ret.=br();}
else $ret.=inputb($sid,$val,'14','','255',['autocomplete'=>'off']).$hlp.ljb('poph','jumpvalue',[$sid,''],ascii(10006)).br();}
return $ret;}

//folder
static function virtualfolder($id,$o=''){$r=sql('msg','qdd','k',['val'=>'folder']); $ret='';
if($r)foreach($r as $k=>$v)$ret.=ljb('','jumpvalue',[$o.$id,$k],$k).' ';
return divc('nbp',$ret);}

//words
static function uwords($id){$ret='';
$cats=self::catag(); $ro=explode(' ','tag '.prmb(19));
$t=divc('txtcadr',nms(47)); $ret='';
$msg=self::prep_msg($id); $ra=self::each_words($msg); arsort($ra);
foreach($cats as $k=>$v){[$r,$re]=self::matchtags($id,$v,2,$msg,$ra); $rt='';
	if($r){$rta=picto($ro[$k],24).' '; $tg=eradic_acc($v);
	foreach($r as $ka=>$va){$n=isset($re[$ka])?' ('.$re[$ka].')':'';
		if($ka)$rt.=lj('','popup_api___'.$tg.':'.$va,$ka.$n).' ';}
	if($rt)$ret.=divc('nbp',$rta.$rt);}}
return $ret?$t.$ret:nmx([11,16]);}

//save all from search
static function tagall_slct($vrf,$srch){$r=self::catag(); $ret='';
foreach($r as $v)$ret.=lj('','socket_meta,savtagall__xc_'.ajx($v).'_'.ajx($vrf).'_'.ajx($srch),$v);
return divc('list',$ret).divb('','alert','svtg');}

static function savtagall($cat,$vrf,$tag){
if(!self::tag_auth($cat))return;
$r=$_SESSION['recache'][$vrf]; $rn=[];
if($r)foreach($r as $k=>$v)$rn[]=self::sav_tag('',$k,$cat,$tag);
return count($rn);}

//save from search
static function tag_slct($id,$srch){$r=self::catag(); $ret='';
foreach($r as $v)$ret.=lj('','socket_meta,savtag__xc_'.ajx($v).'_'.$id.'_'.ajx($srch),$v);
return divc('list',$ret).divb('','alert','svtg');}

static function savtag($cat,$id,$tag){
if(!self::tag_auth($cat))return;
self::sav_tag('',$id,$cat,$tag);}

//add tag
static function idtag($cat,$tag){
$idtag=sql('id','qdt','v',['cat'=>$cat,'tag'=>$tag]);
return $idtag;}

static function add_tag($cat,$tag){
$idtag=self::idtag($cat,$tag);
if(!$idtag && $cat && $tag)
	$idtag=sql::sav('qdt',[$cat,$tag]);
return $idtag;}

static function idartag($idart,$idtag){
return sql('id','qdta','v',['idart'=>$idart,'idtag'=>$idtag]);}

static function add_artag($idart,$idtag,$cat,$tag){
$idartag=self::idartag($idart,$idtag);
if(!$idartag && $idart && $idtag)
	$idartag=sql::sav('qdta',[$idart,$idtag]);
return $idartag;}

static function add_tag_btn($r,$idart,$cat,$curtag='',$re=[]){
$rid=normalize($cat).$idart; $ret=''; $n=0;
if($curtag)$ret=lj('txtred',$rid.'_meta,addtag___0_'.$idart.'_'.$cat.'_'.ajx($curtag),$curtag).' ';
if($r)foreach($r as $idtag=>$tag){
	$j=$rid.'_meta,addtag___'.$idtag.'_'.$idart.'_'.$cat;
	if(isset($re[$tag])){$n=$re[$tag]>$n?$re[$tag]:$n; $tag.=' ('.$re[$tag].')';}
	$ret.=lj('',$j,$tag).' ';}
if($n)$ret.=lj('small',$rid.'_meta,filltags___'.$idart.'_'.ajx($cat).'_1','1').' ';
if($n>1)$ret.=lj('small',$rid.'_meta,filltags___'.$idart.'_'.ajx($cat).'_2','2').' ';
if($n>2)$ret.=lj('small',$rid.'_meta,filltags___'.$idart.'_'.ajx($cat).'_3','3').' ';
return divc('nbp','&#10010; '.$ret);}

static function del_tag_btn($r,$idart,$cat){
$rid=normalize($cat).$idart; $ret='';
if($r)foreach($r as $idtag=>$tag){
	$j=$rid.'_meta,deltag___'.$idtag.'_'.$idart.'_'.$cat;
	$ret.=lj('nbp',$j,'&#10006;&nbsp;'.$tag).' ';}
return $ret;}

static function sav_tag($idtag,$idart,$cat,$tag){
if(!$idtag)$idtag=self::add_tag($cat,$tag);
$idartag=self::add_artag($idart,$idtag,$cat,$tag);
return $idartag;}

//from ajax
static function addtag($idtag,$idart,$cat,$curtag=''){
if(!self::tag_auth($cat))return;
$idartag=self::sav_tag($idtag,$idart,$cat,$curtag);
$r=self::read_tags($idart,$cat);
return self::del_tag_btn($r,$idart,$cat);}

//del tag
static function deltag($idtag,$idart,$cat,$action=''){
if(!self::tag_auth($cat))return;
$rid=normalize($cat).$idart; $ret=' '; $x='';
if($action=='remove')$x=self::rmtag($idtag);
$idartag=self::idartag($idart,$idtag);
if($idartag)sql::del('qdta',$idartag);
$r=self::read_tags($idart,$cat);
$ret=self::del_tag_btn($r,$idart,$cat);
if(!$x){$rb=sql('idart','qdta','rv',['idtag'=>$idtag]);//remove if unused tag
if(!$rb)$ret.=lj('txtred',$rid.'_meta,deltag___'.$idtag.'_'.$idart.'_'.$cat.'_remove','remove tag '.$idtag).' ';}
return $ret;}

/*$j=$rid.'_meta,deltagall___'.$idtag.'_'.$idart.'_'.$cat;
$ret.=lj('nbp',$j,'&#10006;&nbsp;'.$tag).' ';*/
static function deltagall($idart,$cat){$ret='';
$r=sql('id,tag','qdt','kv',['idart'=>$idart,'cat'=>$cat]);
foreach($r as $idtag=>$v)$ret.=self::deltag($idtag,$idart,$cat,'remove');
return $ret;}

#selector
static function find_tags($cat,$curtag){
$r=sql('id,tag','qdt','kv',['cat'=>$cat,'%tag'=>$curtag,'_order'=>'id desc']);
return $r;}

static function slctag($idart,$cat,$curtag){
if(!self::tag_auth($cat))return;
$curtag=trim($curtag);
$ra=self::find_tags($cat,$curtag);//possibles
if($ra)if(in_array($curtag,$ra))$curtag='';
$rb=self::read_tags($idart,$cat);//existing
if($rb)if(in_array($curtag,$rb))$curtag='';
if($ra && $rb)$r=array_diff($ra,$rb); elseif($ra)$r=$ra; else $r='';
$ret=self::add_tag_btn($r,$idart,$cat,$curtag);
if(!$ret)$ret=' ';
return $ret;}

#editor
static function read_tags($idart,$cat){//tag_arts
return sql::inner('idtag,tag','qdt','qdta','idtag','kv',['cat'=>$cat,'idart'=>$idart,'_order'=>ses('qdta').'.id asc']);}

static function tag_auth($cat){
if(auth(4) or $cat==ses('iq'))return true;}

//edit_tag
static function editag($id,$cat,$ico){
if($cat=='utag'){$auto=hlpbt('usertags'); $cat=ses('iq');}
if(!self::tag_auth($cat))return;
$rid=normalize($cat).$id;
$picto=lj('','slct'.$rid.'_meta,alltags__3_'.$id.'_'.ajx($cat),picto($ico,'min-width:22px;'));
$auto=lj('','slct'.$rid.'_meta,matchtags___'.$id.'_'.ajx($cat),ascii(9660)).' ';
$r=self::read_tags($id,$cat);
$ret=self::del_tag_btn($r,$id,$cat); $inp='';
if(is_numeric($cat)){
	$j=atjr('autocomp',[$id,$cat]); $rj=['onkeyup'=>$j,'onclick'=>$j];
	$inp=input('inp'.$id,'',12,$rj).hlpbt('usertags');}
return divc('',$picto.$inp.$auto.btd($rid,$ret).divd('slct'.$rid,''));}

static function metall($id,$prw){$r['tag']='tag'; $ret='';
$bt=lj('popsav',$id.'_art,playd___'.$id.'_'.$prw,picto('valid')).' ';
$re=sql('re','qda','v',$id);
$bt.=btd('rdbt'.$id,self::prior_edit($re,$id)).br();//priority
$rc=explode(' ',prmb(18)); $ro=explode(' ',prmb(19)); $r+=array_combine($rc,$ro);
foreach($r as $cat=>$ro)if($cat)$ret.=self::editag($id,$cat,$ro);
$j=atjr('autocomp',[$id,'tag '.prmb(18)]); $rj=['onkeyup'=>$j,'onclick'=>$j];
$bt.=lj('','popup_meta,metall___'.$id.'_'.$prw,picto('popup')).' ';
$bt.=inputb('inp'.$id,nms(24),12,1,255,$rj);
$rj=[]; foreach($rc as $k=>$v)$rj[]='slct'.normalize($v).$id; 
$bt.=lj('',implode(',',$rj).'_meta,matchall__json_'.$id,picto('enquiry'));
$rj=[]; foreach($rc as $k=>$v)$rj[]=normalize($v).$id; 
$bt.=lj('',implode(',',$rj).'_meta,delalltags__json_'.$id,picto('del'));
$bt.=toggle('','cls'.$id.'_clusters,viewart___'.$id,picto('network')).divd('cls'.$id,'');
$ret.=divd('lng'.$id,self::langslct($id));
return divs('min-width:340px; padding:0 4px;',$bt.$ret);}

//alltags
static function alltags($id,$cat){//tag_list()
if(rstr(3) && !is_numeric($cat))$limit=' and day>"'.timeago(30).'"'; else $limit='';
$wh='and cat="'.$cat.'"'.$limit.' order by tag';
$r=ma::artags('idtag,tag',$wh,'kv');
return self::add_tag_btn($r,$id,$cat);}

#match
static function catag(){return explode(' ','tag '.prmb(18));}

static function each_words($d){
$d=str_replace(['?','.','/',',',';',':','!','"','(',')','[',']','«','»'],'',$d);
$d=str_replace("&nbsp;",' ',$d);
$r=explode(' ',$d); $n=count($r); $ret=[];
for($i=0;$i<$n;$i++)if($r[$i])$ret[$r[$i]]=radd($ret,$r[$i]);
$r=['de','et','la','les','a','le','des','du','que','en','ne','au','qui','on','se','sur','un','par','il','une','ils','cela','ou','ce','aux','ces','mais','ni','_'];	
foreach($r as $k=>$v)if(isset($ret[$v]))unset($ret[$v]);
return $ret;}

static function prep_msg($id){
$suj=sql('suj','qda','v',$id);
$msg=sql('msg','qdm','v',$id); $msg=html_entity_decode($suj."\n".$msg);
if(strpos($msg,':import') or strpos($msg,':read'))$msg=strip_tags(conn::read($msg,$id,3));
else $msg=str::clean_internaltag($msg); $msg=strtolower(eradic_acc($msg)); $msg=deln($msg,' ');
$msg=str_replace("&nbsp;",' ',$msg);
return $msg;}

//$ra:mot=>nb occurences //$rb,rx,rd,rf:tag=>id //rdb:id=>tag //re:id=>nb
//todo:mots reconnus comme étant déjà tagués dans une autre langue via leur id
static function matchtags($idart,$cat,$o='',$msg='',$ra=[]){$rd=[]; $re=[];
if(!$ra){$msg=self::prep_msg($idart); $ra=self::each_words($msg); arsort($ra);}
$rn=array_flip(self::catag()); $n=($rn[$cat]??0)+1;
$lg=sql('lg','qda','v',$idart); $lga=prmb(25); if($lg=='')$lg=$lga; $rb=[];
if($lg!=$lga){$rb=msql::kx('',nod('tags_'.$n.$lg),0); if($rb)$rb=array_flip($rb);}//langs
if(!$rb)$rb=sql('tag,id','qdt','kv',['cat'=>$cat,'_order'=>'id desc']);
if($lg=='fr'){$rbb=msql::kn('',nod('syn_'.$n),1,0); if($rbb)$rb+=$rbb;}//synonyms
if($o==2)$rx=[]; else{$rx=self::read_tags($idart,$cat); $rx=array_flip($rx);}//existing
if($rx)$rb=array_diff_key($rb,$rx);//del exs
if($rb)$rd=array_intersect_key($rb,$ra); $rdb=array_flip($rd);//detected
if($rb)foreach($rb as $k=>$v){$vb=strtolower(eradic_acc($k));
	if(!isset($rdb[$v]))if(preg_match("/\b".$vb."\b/i",$msg)){// && strpos($msg,$vb)!==false
		$rd[$k]=$v; $rn=str::detect_words($msg,$vb,1); $re[$k]=count($rn);}}
$rdb=array_flip($rd);
if($re){arsort($re); foreach($re as $k=>$v)$rf[$rd[$k]]=$k; 
	foreach($rdb as $k=>$v)if(!isset($rf[$v]))$rf[$k]=$v; $rdb=$rf;}
if($o)return [$rd,$re]; if(!$rd)return ' ';
return self::add_tag_btn($rdb,$idart,$cat,'',$re);}

static function matchall($id,$va=''){$cats=self::catag(); $rt=[];
$msg=self::prep_msg($id); $ra=self::each_words($msg); arsort($ra);
foreach($cats as $k=>$v)$rt['slct'.normalize($v).$id]=self::matchtags($id,$v,'',$msg,$ra);
return $rt;}

static function filltags($id,$cat,$n=''){
$rid=normalize($cat).$id; $ret=''; if(!auth(4))return;
$msg=self::prep_msg($id); $ra=self::each_words($msg); arsort($ra);
[$r,$re]=self::matchtags($id,$cat,1,$msg,$ra);
foreach($r as $tag=>$idtag)if(($re[$tag]??0)>=$n)
	$idartag=self::sav_tag($idtag,$id,$cat,$tag);
$r=self::read_tags($id,$cat);
return self::del_tag_btn($r,$id,$cat);}

static function delalltags($id){$cats=self::catag(); $rt=[]; if(!auth(4))return;
foreach($cats as $k=>$cat){$r=self::read_tags($id,$cat); $kb=normalize($cat).$id;
	foreach($r as $idtag=>$tag){$idartag=self::idartag($id,$idtag); sql::del('qdta',$idartag);}
$rt[$kb]='';}
return $rt;}

#admin
//remove
static function remsecurity(){
$ip=sql('id','qdu','v',['name'=>ses('qb')]);
if(auth(6) && cookie('iq')==$ip)return true;}

static function rmtag($idtag){//from editor
if(self::remsecurity())return;
$rb=sql('idart','qdta','rv',['idtag'=>$idtag]);//existing
if(!$rb)sql::del2('qdt',$idtag);
json::add('','rmtag',[$idtag=>hostname()]);
return 'ok';}

static function removetag($idtag){//from admin
if(!auth(6))return;//self::remsecurity()
if($idtag){sql::del2('qdta',['idtag'=>$idtag]);
sql::del('qdt',$idtag);
json::add('','rmtag',[$idtag=>hostname()]);}
return divc('frame-orange','remove: '.$idtag);}

//rename
static function renametag($idtag,$cat,$prm=[]){$res=$prm[0]??'';
if(!auth(6))return; $rid=randid('rnmtag'); $ret='';
$tag=sql('tag','qdt','v',$idtag);
$ret=divc('txtcadr',nms(87).': '.$tag);
$ret.=divc('small',helps('tag_rename'));
$ret.=input('rnmtg',$tag);
$ret.=lj('popbt',$rid.'_meta,renametag_rnmtg__'.$idtag.'_'.$cat,picto('ok')).br();
if($res){$ex=sql('id','qdt','v','tag="'.$res.'" collate latin1_general_cs and cat="'.$cat.'"');
	if(!$ex){sql::upd('qdt',['tag'=>$res],$idtag);//rename
		$ret.=divc('frame-orange',$tag.' became '.$res);}
	elseif($idtag && $idtag!=$ex){//attach to existing tag
		sql::upd('qdta',['idtag'=>$ex],['idtag'=>$idtag]); sql::del('qdt',$idtag);
		$ret.=divc('frame-orange',$tag.' is erased and references are linked to '.$res);}
	else $ret.=divc('frame-white','nothing has changed');}
self::renametagmsq($idtag,$cat,$res);
return divd($rid,$ret);}

static function renametagmsq($idtag,$cat,$d){$lg=prmb(25);
$rt=self::catag(); foreach($rt as $k=>$v)$rn[$v]=$k+1; $n=$rn[$cat]; $nd=nod('tags_'.$n.$lg);
$rb=msql::modif('',$nd,'','shot',0,$idtag);
return $nd.':modified => '.msqbt('',$nd);}

//recat
static function recatag($idtag,$newcat=''){
if(!auth(6))return; $rid=randid('recat'); $ret='';
[$tag,$cat]=sql('tag,cat','qdt','r',$idtag);
$ret=divc('txtcadr',nms(140).': '.$tag.' in '.$cat);
$ret.=divc('small',helps('tag_rename'));
$utags=self::catag();//cats
foreach($utags as $v)if($v!=$cat)
	$ret.=lj('popbt',$rid.'_meta,recatag___'.$idtag.'_'.ajx($v),$v).br();
if($newcat){
	$ex=sql('id','qdt','v',['tag'=>$tag,'cat'=>$newcat]);
	if(!$ex){sql::upd('qdt',['cat'=>$newcat],$idtag); 
		$ret=divc('frame-orange',$cat.' => '.$newcat);}
	elseif($ex!=$idtag){sql::upd('qdta',['idtag'=>$ex],['idtag'=>$idtag]);
		if($idtag)sql::del('qdt',$idtag); $ret=divc('frame-orange',$tag.' in '.$cat.' is erased and references are linked to '.$tag.' in '.$newcat);}}
//self::recatagmsq($idtag,$cat1,$newcat,$res);
return divd($rid,$ret);}

static function recatagmsq($idtag,$cat1,$cat2,$d){$lg=prmb(25);
$rt=self::catag(); foreach($rt as $k=>$v)$rn[$v]=$k+1; $n1=$rn[$cat1]; $n2=$rn[$cat2];
$rb=msql::modif('',nod('tags_'.$n2.'lg'),[$d],'row','',$idtag);
$rb=msql::modif('',nod('tags_'.$n1.'lg'),'','del','',$idtag);
return $d.': passed form '.$cat1.' to '.$cat2.' => '.msqbt('',nod('tags_'.$n2.'lg'));}

//transcat
static function transtag($idtag,$cat='',$prm=[]){$res=$prm[0]??'';
if(!auth(6))return; $rid=randid('trnsct'); $ret='';
$tag=sql('tag','qdt','v',$idtag);
$ret=divc('txtcadr',nmx([140,142,9,2,141]).': '.$tag);
$ret.=input('trsct',$tag);
$ret.=lj('popbt',$rid.'_meta,transtag_trsct__'.$idtag.'_'.$cat,'ok').br();//cat unused
if($res){$r=sql('idart','qdta','rv',['idtag'=>$idtag]);
	foreach($r as $k=>$id)sql::upd('qda',['frm'=>$res],$id);
	$ret.=divc('frame-orange','All the articles with tag "'.$tag.'" are put in category: '.$res);}
return divd($rid,$ret);}

//list_artag
static function tagartlist($idtag,$cat){$ret='';
$rb=sql('idart','qdta','rv',['idtag'=>$idtag]);//existing
if($rb)foreach($rb as $idart)$ret.=lj('popbt','popup_meta,editag___'.$idart.'_'.$cat,pictxt('tag',$idart)).' '.ma::popart($idart,1).br();
return divc('small',$ret);}

#admin
static function admin_tags_edit($idtag,$cat){
$rid=randid('deltag'); $ret=''; 
if($cat=='folder')$tag=sql('msg','qdd','v',$idtag);
else $tag=sql('tag','qdt','v',$idtag);
$ret=divc('txtcadr',$tag.' (id:'.$idtag.')');
$ret.=lj('popbt','popup_meta,tagartlist__3x_'.$idtag.'_'.ajx($cat),pictxt('view',nms(2))).' ';
$ret.=lj('popsav','popup_meta,renametag__3x_'.$idtag.'_'.ajx($cat),pictxt('edit',nms(87))).' ';
$ret.=lj('popsav','popup_meta,recatag__3x_'.$idtag,pictxt('edit',nms(140))).' ';
$ret.=lj('popsav','popup_meta,transtag_'.ajx($cat).'_3x_'.$idtag,pictxt('edit',nms(9))).' ';
$ret.=lj('txtyl','cbk'.$rid.'_meta,removetag___'.$idtag,pictxt('del',nmx([43,100])));
$ret.=divd('cbk'.$rid,'');
return divd($rid,$ret);}

static function admin_tags_list($cat){$ret='';
//$ra=sql::inner('idtag,idart','qda','qdta','idart','k',['nod'=>ses('qb')]);
$ra=sql('idtag,idart','qdta','k',''); if($ra)arsort($ra);
$rb=sql('id,tag','qdt','kv',['cat'=>$cat]); $rc=[]; $rd=[];
if($ra)foreach($ra as $k=>$v)if(isset($rb[$k]))$rc[$k]=[$rb[$k],$v];//idtag=>id,tag
	else $rd[]=$k; //orphelins
$ret.=divc('nbp',count($rc).' '.$cat).br();
$j='popup_meta,admin*tags*edit___';
if($rc)foreach($rc as $idtag=>$v)
	$ret.=lj('txtx',$j.$idtag.'_'.$cat,pictxt('popup',$v[0].'&nbsp;('.$v[1].')')).' ';
//sql::maintenance('idtag','tag','qdta','qdt');
//$ra=sql::inner('idtag,tag','qdta','qdt','idtag','kv','idtag is null',1); p($ra);
return $ret;}

static function admin_tags_menu($cat,$rid){
$utags=self::catag(); $utags[]=ses('iq'); $utags[]='folders'; $ret='';
$j=$rid.'_meta,admin*tags___';
foreach($utags as $v){$c=active($v,$cat);
	$ret.=lj($c,$j.ajx($v),is_numeric($v)?'usertags':$v).' ';}
$ret.=' | ';
$ret.=lj($c,$j.'clusters','clusters').' ';
$ret.=lj($c,$j.'translations',nms(153)).' ';
$ret.=lj($c,$j.'synonyms',nms(192)).' ';
$ret.=lj($c,$j.'tagid','id');
return $ret=divc('nbp',$ret);}

static function admin_tags($cat){
$rid=randid('admtag'); $ret='';
$ret=self::admin_tags_menu($cat,$rid);
if($cat=='clusters')$ret.=clusters::home('','');
elseif($cat=='translations')$ret.=self::admin_tags2msql('','en');
elseif($cat=='synonyms')$ret.=self::admin_synonyms('','','');
elseif($cat=='tagid')$ret.=self::admin_tagid('','');
elseif($cat=='folders')$ret.=self::admin_tags_folders();
elseif($cat)$ret.=self::admin_tags_list($cat);
return divd($rid,$ret);}

static function admin_folders_edit($tag,$p,$prm=[]){$res=$prm[0]??'';
if(!auth(6))return; $rid=randid('fldr'); 
$ret=input('fldr',$res?$res:$tag);
$ret.=lj('popsav',$rid.'_meta,admin*folders*edit_fldr__'.ajx($tag),nms(87));
if($res && $tag){$r=sql('id','qdd','rv',['val'=>'folder','msg'=>$tag]);
	if($r)foreach($r as $k=>$id)sql::upd('qdd',['msg'=>$res],$id);
	$ret.=divc('frame-orange','Folder "'.$tag.'" renamed: '.$res);}
return divd($rid,$ret);}

static function admin_tags_folders(){$ret='';
$ra=sql('msg','qdd','k',['val'=>'folder']);
$j='popup_meta,admin*folders*edit___';
if($ra)foreach($ra as $k=>$v)
	$ret.=lj('popbt',$j.ajx($k),pictxt('popup',$k.'&nbsp;('.$v.')')).' ';
return $ret;}

static function admin_tags2msql($cat,$lg){
$rt=self::catag(); $rn=[]; $bt=''; $n=0; $ret=divc('txtcadr',nms(191));
foreach($rt as $k=>$v){$rn[$v]=$k+1; $bt.=lj(active($cat,$v),'tg2msq_meta,admin*tags2msql___'.$v.'_'.$lg,$v).' ';}
foreach(['en','es'] as $k=>$v){$bt.=lj(active($lg,$v),'tg2msq_meta,admin*tags2msql___'.$cat.'_'.$v,$v).' ';}
$ret.=divc('nbp',$bt); if(!$cat)return divd('tg2msq',$ret);
$n=$rn[$cat];//auteurs thèmes pays type personnalité org corp
$ra=sql('id,tag','qdt','kv',['cat'=>$cat],0); //p($ra);
$rb=msql::kx('',nod('tags_'.$n.'fr'),0); //pr($rb);
$rc=array_diff_key($ra,$rb); //pr($rc);
$ret.=divc('txtcadr','newly added:'.count($rc));
$nod=nod('tags_'.$n.$lg);
$ret.=msqbt('',$nod);
$j='popup_meta,admin*tags*edit___';
if($rc)foreach($rc as $idtag=>$v)$ret.=lj('txtx',$j.$idtag.'_'.$cat,pictxt('popup',$v)).' ';
if($rc)$r=msql::modif('',nod('tags_'.$n.'fr'),$rc,'mdfv'); //pr($r);
$rd=msql::kx('',nod('tags_'.$n.$lg),0,['idtag',$cat]);//pr($rd);
$re=array_diff_key($rb,$rd); //pr($re);
$ret.=divc('txtcadr',$n.':'.count($rb).'-'.count($rd).'='.count($re));
if($re)$ret.=lj('popbt','popup_msqa,editors___users/'.ajx($nod).'_import*csv','inject').br();
if($re)$ret.=divb(implode_k($re,br(),';'),'','addcsv');
return divd('tg2msq',$ret);}

static function admin_syn_edit($cat,$idtag){
$ret=divc('txtcadr','add synonym for id:'.$idtag.''); $rid='synedt'.$idtag;
$j='tg2syn_meta,admin*synonyms_'.$rid.'_x_'.$cat.'_'.$idtag;
$ret.=input($rid,'').' '.lj('popsav',$j,pictxt('edit',nms(27))).' ';
return $ret;}

static function admin_synonyms($cat,$idtag,$prm=[]){$res=$prm[0]??'';
$rt=self::catag(); $rn=[]; $bt=''; $n=0; $ret=divc('txtcadr',nms(192));
foreach($rt as $k=>$v){$rn[$v]=$k+1; $bt.=lj(active($cat,$v),'tg2syn_meta,admin*synonyms___'.$v,$v).' ';}
$ret.=divc('nbp',$bt);
if($cat){$n=$rn[$cat];
	if($idtag && $res)$r=msql::modif('',nod('syn_'.$n),[$idtag,$res],'push');
	$j='tg2syn_meta,admin*synonyms___'.$cat.'_';
	$ra=sql('id,tag','qdt','kv',['cat'=>$cat,'_order'=>'tag']); $ra=[0=>$cat]+$ra;
	$ret.=select(['id'=>'adsyn'],$ra,'',$idtag,$j);
	$rc=msql::two('',nod('syn_'.$n),0); $rc=[0=>nms(192)]+$rc;
	$ret.=select(['id'=>'adsyn'],$rc,'',$idtag,$j);
	$rb=msql::select('',nod('syn_'.$n),$idtag);
	$ret.=msqbt('',nod('syn_'.$n));
	$j='popup_msqa,editmsql___users(slash)'.ajx(nod('syn_'.$n)).'_';
	if($rb)foreach($rb as $k=>$v)$ret.=lj('txtx',$j.$k,pictxt('popup',$v[1])).' ';
	$j='popup_meta,admin*syn*edit___'.$cat.'_'.$idtag;
	if($idtag)$ret.=lj('txtx',$j,pictxt('add',nms(92))).' ';}//new
return divd('tg2syn',$ret);}

static function admin_tagid($p,$o,$prm=[]){$p=$prm[0]??$p; $res='';
$ret=input('tgid',$p).lj('popbt','admtgid_meta,admin*tagid_tgid',picto('ok'));
if($p)$res=sql('tag','qdt','v',$p);
if(!$res){$r=sql('id,idart','qdta','kv',['idtag'=>$p]);
	if($r)$res=count($r).' orphans'; $ret.=implode_k($r,';',':');
	$ret.=lj('popdel','admtgid_meta,admin*tagid_tgid___x',picto('del'));
	if($r && $o=='x')foreach($r as $k=>$v)sql::del('qdta',$k);}
$ret.=divb($res);
$ret.=lj('popx','admtgid_meta,admin*tagid_tgid___m',picto('ambulance'));
if($o=='m'){$r=maintenance('idtag','tag','qdta','qdt');}
return divd('admtgid',$ret);}

}
?>