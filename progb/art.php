<?php
//philum_art 

#templates
function template_art(){return '[_EDIT§right:css]
[[_PARENT§h4:balise]_THUMB[[_URL§[_SUJ§[fixit:id]:span]_ARTLANG:url]§h2:balise] 
[[_SEARCH§popw:css] [_SOCIAL _WORDS _OPEN§grey:css]§right:css]
[_BACK§txtbox:css] _AVATAR [_AUTHOR _DATE§txtsmall2:css] [_NBARTS§txtnoir:css] [_LENGHT _PRIORITY _SOURCE _TAG _BTIM _RSS _TRACKS _OPT _PID _LANG§txtsmall2:css]§div|meta_ID:balise]
_FLOAT[_MSG[:clear]§article|art_ID|justy:balise]';}//_TRKBK
function template_read(){return '[_EDIT§right:css]
[[_PARENT§h4:balise]_THUMB[[_SUJ§[fixit:id]:span]_ARTLANG§h2|fixit|:balise] 
[[_SEARCH§popw:css][_SOCIAL _WORDS _OPEN [_URL§[url:picto]:url]§grey:css]§right:css]
[_BACK§txtbox:css] [_AUTHOR _DATE§txtsmall2:css] [_NBARTS§txtnoir:css] [_LENGHT _PRIORITY _SOURCE _TAG _BTIM _RSS _TRACKS _OPT _PID _LANG§txtsmall2:css]§header|meta_ID:balise]
_FLOAT[_MSG[:clear]§article|art_ID|justy:balise]';}//_TRKBK
function template_fastart(){return '[[_IMG1§44/44:thumb]§[float:left;margin:0 10px 0 0:style]:div][[_URL§_SUJ:url] _SOCIAL§h4:balise][:clear]';}
function template_tracks(){return '[[trk_ID:anchor]_AVATAR [_AUTHOR§txtblc:css] [_DATE§txtsmall2:css] _EDIT[:br]_MSG[:clear]§[_CSS:class][_STY:style]:div]';}
function template_titles(){return '_FLOAT[[[_URL§_SUJ:url]§h3:balise] [_NBARTS§txtblc:css] _DATE _OPT _PARENT _TAG:div]';}
function template_pubart(){return '[[_IMG1§44/44:thumb]§[imgl:class]:div][_CAT§txtx:css] [_DATE§txtsmall2:css][[_JURL§_SUJ:jurl]§div||:balise]_VIDEO[:clear]';}
function template_weblink(){return '[[_IMG1§72/72:thumb]§[float:left;margin-right:10px:style]:div][_URL§_SUJ:url][:br]_MSG';}
function template_book(){return '[[_BACK[_TITLE§h2:balise]
_OPT _DATE _TAG _LENGHT _PLAYER:div][_MSG§[panel:class]:div]§[book:class]:div]';}
function template_product(){return '[[[_ID§_SUJ:url]§txtcadr:css] 
_THUMB[_PRICE:div][_ADD2CART§[imgr txtsmall:class]:div]
§[float:left; width:142px; margin:2px; padding:5px; border:1px solid black;:style]:div]';}

function template_vars(){
$d='artedit pid id url jurl purl edit title suj cat msg img1 video btim back avatar author date day nbarts tag priority words search parent rss social open tracks source lenght player lang artlang opt css sty addclr thumb trkbk float '.prmb(18); $r=explode(' ',$d);
foreach($r as $v)if($v)$ret[$v]='_'.strtoupper($v);
return $ret;}

//template
function template_build($ret,$p){$r=sesmk('template_vars');
foreach($r as $k=>$v)if(!isset($p[$k]))$rb[]=$v; else{$rc[]=$v; $rd[]=$p[$k];}
$ret=str_replace($rb,'',$ret);//del_empty
$ret=str_replace(array('_DAY','_IMG1'),array($p['day'],$p['img1']),$ret);
$p['social']=str_replace('_ID',$p['id'],$p['social']);
$ret=correct_txt($ret,'','codeline');//build
return str_replace($rc,$rd,$ret);}//place

function template($p,$tpl){
if(!$tpl)$tpl=@$_SESSION['opts']['template'];//article
if(!$tpl)$tpl=$_SESSION['prma']['template'];//module
if($tpl){$tmp=msql_read('users',$_SESSION['qb'].'_template',$tpl);
if(!$tmp)$tmp=msql_read('','public_template',$tpl);}
if($tpl=="pubart")$tmp=rstr(55)&&$tmp?$tmp:template_pubart();
elseif($tpl=="titles")$tmp=rstr(65)&&$tmp?$tmp:template_titles();
elseif($tpl=="tracks")$tmp=rstr(66)&&$tmp?$tmp:template_tracks();
elseif($tpl=="book")$tmp=rstr(67)&&$tmp?$tmp:template_book();
elseif($tpl=="products")$tmp=$tmp?$tmp:template_product();
elseif($tpl=="fastart")$tmp=$tmp?$tmp:template_fastart();
elseif($tpl=="weblink")$tmp=$tmp?$tmp:template_weblink();
elseif($tpl=="read" && rstr(88))$tmp=$tmp?$tmp:template_read();
//if($_SESSION['read'])$tmp=template_read();
if(!$tmp)$tmp=template_art();
return template_build($tmp,$p);}

#edit
//admin_edit
function admin_edit($kem,$id,$re,$prw){$USE=$_SESSION['USE']; $auth=$_SESSION['auth'];
if($re==0){if(($USE==$kem && $auth>2) or $auth>3)//publish
	$ret.=ljb('txtyl" id="pba'.$id,'publishart',$id,picto('forbidden')).' ';
	elseif($USE==$kem && $auth==2)$ret.=btn("txtyl",nms(53)).' ';}
if(get('search') && $auth>4)
	$ret.=togbub('call','meta_tag*slct_'.$id.'_'.ajx(get('search')),picto('paste')).' ';
	//$ret.=lj('','popup_callp___meta_tag*slct_'.$id.'_'.ajx(get('search')),picto('paste')).' ';
if(($USE==$kem) or $auth>3){
	//$ret.=lj('','popup_tit___'.$id.'_'.$prw,picto('tag',24)).' ';
	$ret.=togbub('tit',$id.'_'.$prw,picto('tag',24)).' ';//SaveTits
	//$ret.=togbub('metall',$id,picto('editor',24)).' ';
	$ret.=lj('','popup_artedit___'.$id,picto('edit',24)).' ';}
return btd('artmnu'.$id,$ret);}

#build
function restricted_area($n){$ret=read_msg("restricted_area",""); if(!$ret)$ret=nms(55); 
return divc('txtalert',$ret.': '.nameofauthes($n));}
function target_date($v,$n=''){return htac('timetravel').date('d-m-y',$v).($n?'&nbj='.$n:'');}
function art_lenght($w){$l=round($w/1300); if($l>1)return $l.' min'; else return "< 1 min";}
function place_img($t,$m){$mg=explode("/",$m);
foreach($mg as $v){$ret=str_replace("[image$n]",'['.$v[$n].']',$t);}
return $ret;}
function suj_arts($suj,$id){
$r=sql('id','qda','k','nod="'.ses('qb').'" and suj="'.$suj.'" and id!="'.$id.'"');
if($r)return slctmenusj($r,'popup_popart___',$read,' ');}
function pub_link($m){return lkt('',http($m),picto('url',16)).' '.lj('','popup_getcontent___source_'.ajx(http_root($m)),preplink($m));}

function art_opts($id){
$ret=sql('val,msg','qdd','kv','ib="'.$id.'"');
if(!$ret['lang'])$ret['lang']=prmb(25);
if(rstr(17))$ret['2cols']=1;
return $ret;}

function lang_art($id,$r){$d=$r['lang']; 
if($d && $d!=prmb(25))return ' '.flag($d).'';}

function lang_rel_arts($id,$r){$rl=explode(' ',prmb(26)); $sp=sep();
$t=array('eng'=>'english','fr'=>'français','esp'=>'español','de'=>'deutsch'); 
if($rl)foreach($rl as $k=>$v){if($v)$lg=$r['lang'.$v];
	if($lg)$ret.=lka($lg,flag($v).$sp.$t[$v]).' ';}
return $ret;}

//tags
function tag_maker($id,$o=''){//if(!$rst[42])
$r=ses('artags'); $r=$r?$r:art_tags($id); if(!$r)return; $sep=sep();
$ica=explode(' ',prmb(18)); $ico=explode(' ',prmb(19));
$rico=array_combine($ica,$ico); $rico['tag']='tag';
if($r)foreach($r as $cat=>$vr){$rt=''; 
	foreach($vr as $ka=>$va)
		$rt.=lj('','popup_getcontent___'.$cat.'_'.ajx($ka),$ka).' ';
	if($rt)$ret[$cat]=picto($rico[$cat],16).$sep.$rt;}
if($ret)return $o?$ret:implode(' ',$ret);}

function art_back($id,$ib,$frm){
if($frm!=$_SESSION['frm'] && $frm && rstr(43)){
return lka(htac('section').$frm.'#'.$id,$frm);} else $t=picto('previous');
if($_GET['read']){$ibb=ib_of_id($ib);
	if($id!=$_SESSION['read']){
		if(!$ibb or $ibb=='/')$bl=htac('section').$frm.'#'.$ib;
		else{$bl=urlread($ibb).'#'.$ib;$t=$ibb;}}
	elseif($ib>0){$bl=urlread($ib).'#'.$id;$t=picto('left');}
	elseif($_SESSION['read']){$bl=htac('section').$frm.'#'.$id;$t=picto('previous');}
	else{$bl=htac('section').$frm.'#'.$id;}
return lka($bl,$t?$t:$frm);}}

function opnart($id,$prw,$o=''){$c=$o?'active':'';//art_read_c
return ljb($c.'" id="toggleart'.$id,'SaveBc','art_'.$id.'_'.$prw.'_'.$o,picto('kdown'));}

//prepare_tits
function prepare_tits($id,$r,$rear,$nbtrk,$nl,$prw){$ib=trim($r['ib']);
$nl=$nl?$nl:$_SESSION['nl']; $rst=$_SESSION['rstr']; $USE=$_SESSION['USE'];
$read=$_SESSION['read']; $page=$_SESSION['page']; if($nl=='nlpop'){$nl='';$nlp=1;}
$out['jurl']='content_ajxlnk2__2_art_'.$id; $out['purl']='popup_popart__3_'.$id.'_3';
$out['day']=$r['day']; $out['artedit']=' '; $nlb=substr($nl,0,2);
if($nlb=="nl")$http=host(); $out['url']=$http.good_url($id,$r['suj']);//urlread($id);
if(!$rst[19])$out['img1']=first_img($r['img']);//img1
if(!$rst[68] && $r['img'] && strpos($r['img'],'/'))//gallery
	$out['btim']=lj('','popup_callp___spe-ajxf_art*gallery_'.$id.'_gallery',picto('img'));
if($_SESSION['prma']['art_mod']){
	if($read==$id && $prw>2 && !$nl && !$nlp && rstr(60))$out['float']=build_art_mod(1);
	//$out['float']=mkbub(popbub('seek','',picto('list'),'c'),'inline','position:relative; display:inline-block;','');//seek
	$out['open'].=lj('','popup_popartmod__3_'.$id,picto('virtual')).' ';}
if(!$rst[31]){$out['back']=art_back($id,$ib,$r['frm']);}//back
if(!$rst[6] && $r['name']!=ses('qb')){//author
	$out['author']=lka(htac('author').$r['name'],$r['name']);}
if(!$rst[23] && $r['re']>1)$out['priority']=picto('s'.($r['re']-1),16);
if(!$rst[24]){$day=mkday($r['day'],1);//date
	if(!$rst[54])$out['date']=lka(target_date($r['day']),$day); 
	else $out['date']=$day;} 
if(!$rst[26])$out['pid']=$id;//id
if(!$rst[29])$out['tag']=tag_maker($id);//tags
if($nl!='nl')$out['edit']=admin_edit($r['name'],$id,$r['re'],$prw);//edit
if(rstr(27) && trim($r['mail']))$out['source']=pub_link($r['mail']);//source
if($_GET['search'] && $nl){$out['search']=nbof($nl,19);}//rech
if($rear>1 && rstr(43))
	$out['nbarts']=lj('','popup_getcontent___parent_'.$id,nbof($rear,1));//nb_arts
if(is_array($nbtrk)){$nbtk=count($nbtrk);//tracks
	if($read)$out['tracks']=lka(urlread($id).'#trackback',picto('forum').$nbtk);
	else $out['tracks']=lj('','popup_trckpop___'.$id,picto('forum').$nbtk);}
if($ib>0 && $read!=$id && $read!=$ib){$sujb=suj_of_id($ib);//parent
	if($sujb)$out['parent']=lka(urlread($ib),pictxt('copy',$sujb));}
if(!$rst[58] && $nlb!="nl")$out['open'].=lj('','popup_editbrut___'.$id,picto('conn')).' ';
if(!$rst[37] && $nlb!="nl")$out['open'].=popart($id).' ';//popen
if(!$rst[28] && $nlb!="nl"){//open
	if($prw<=2 && $rst[41]!="0")$out['open'].=opnart($id,$prw,'').' ';
	elseif($prw==3 && $rear>1)$out['open'].=opnart($id,2,'1').' ';}
if(!$rst[25] && $r['host']>1000)//lenght
	$out['lenght']=picto('time',16).' '.art_lenght($r['host']);
if(!$rst[40])//rss
	$out['rss']=lkt("",'/plug/rss1.php?read='.$id.'&preview=full',picto('rss',16));
if(!$rst[71] && $nlb!="nl")
	$out['social']=lj('','popup_artstats___'.$id.'_'.$r['day'],picto('users',16));
//if($ath=@$r['opts']['authlevel'])$out['social'].=asciinb($ath);
if($nlb!="nl"){$root=host().urlread($id);//social//&via=philum_info
	$rsoc=array(44=>'http://www.facebook.com/sharer.php?u='.$root,45=>'http://twitter.com/intent/tweet?original_referer='.$root.'&url='.$root.'&text='.utf8_encode($r['suj']).'&title='.utf8_encode($r['suj']),46=>'http://wd.sharethis.com/api/sharer.php?destination=stumbleupon&url='.$root);
	if(auth(6) && !$rst[45])
		$out['social'].=togbub('plug','twit_twit*share_'.$id,callico('tw'));
	if(!$rst[45])$out['social'].=lkt('',$rsoc[45],callico('tw'));
	if(!$rst[44])$out['social'].=lkt('',$rsoc[44],callico('fb'));
	if(!$rst[46])$out['social'].=lkt('',$rsoc[46],icon('stumble'));
	if(!$rst[52])$out['social'].=favs_edt($id).' ';
	if(!$rst[90] or ses('dev'))$out['social'].=togbub('editag',$id.'_utag_tag',picto('tag')).' ';
//	if(!$rst[86])$out['social'].=lj($css,'popup_track___'.$id,picto('forum')).' ';
	if(!$rst[47])$out['social'].=togbub('vmail',$id,callico('mail')).' ';
	if(!$rst[12])$out['social'].=lkt('','/plug/read/'.$id,picto('print')).' ';
	if(!$rst[49])$out['words']=togbub('words',$id,picto('search'));}
if($_SESSION['plgs'] && $nlb!="nl")$out['social']=$_SESSION['plgs'];
$out['artlang']=lang_art($id,$r['opts']);
$out['lang']=lang_rel_arts($id,$r['opts']);
if(!$rst[50] or $USE)$out['opt']=btn('txtsmall2',picto('view',16).' '.$r['lu']).' ';//nbof
$out['sty']='';
return $out;}

//subarts
function nb_ib_arts($id){$wh='ib="'.$id.'"';
if(!auth(1))$wh.=' and re>="1" and substring(frm,1,1)!="_"';
return $ids=sql('COUNT(id)','qda','v',$wh);}

function ib_arts($id,$prw){//child
if($_GET['order']){$ordr='DESC'; $ret=lkc('txtbox','/?read='.$id.'#pages',nms(41));}
else{$ordr='ASC'; if(rstr(43))$ret=lkc('txtbox','/?read='.$id.'&order=1#pages',nms(40));}
if(rstr(43))$ret=hr().btn('txtcadr',nms(39)).' '.$ret.br().br();
if(!auth(1))$cnd='and re>="1" and substring(frm,1,1)!="_"';
$load=sql('id','qda','k','ib="'.$id.'" '.$cnd.' ORDER BY id '.$ordr);
//$rt=define_modc_b('content');
if($load)return $ret.output_pages($load,'flow','');}//prw from config

//media
function favs_edt($id){if($_SESSION['favs'][$id])return lj('','popup_modpop___favs:plug',picto('like','color:#428a4a;'));
return btd('pgbt'.$id,lj('','pgbt'.$id.'_plug___favs_fav*sav_'.$id,picto('like')));}

function slct_media($v=''){if(rstr(5))$d=2; if(rstr(41))$d=3;//preview//full
if($v=='read')$d=4; elseif($v=='full')$d=3; elseif($v=='true' or $v=='preview')$d=2; 
elseif($v=='false')$d=1; elseif($v=='auto')$d=$v; elseif($v=='vd')$d=$v; 
elseif(is_numeric($v))$d=$v;
return $d?$d:1;}

function tometa($msg){$lgh=strlen($msg);
if($lgh>200)$n=strpos($msg,'.',200); else $n=$lgh; $msg=substr($msg,0,$n+1);
$msg=strip_tags($msg); $_SESSION['descript']=str_replace('"',"'",$msg);}

function prepare_thumb($d){if($_SESSION['rstr'][30]=="1")return; 
if($_SESSION['nl'])$prm='nl'; return minimg($d,$prm);}

//msg img suit
function prepare_msg($id,$msg,$r,$prw){
$read=$_GET['read']; $USE=$_SESSION['USE'];
if(rstr(21) && $prw>1)$ath=$r['options']['authlevel'];
if(rstr(21) && $ath && $ath!='all' && $ath>$_SESSION['auth'])$msg=restricted_area($ath);
elseif(substr($_SESSION['frm'],0,1)=='_' && $_SESSION['auth']<3)$msg=restricted_area(6);
elseif(($id==$read && $prw>2 && !$_GET['page']) or $prw>2){
	$msg=format_txt($msg,$prw,$id); if($prw!='nl')tometa($msg);
	if($_SESSION['USE']){$lenght_msg=strlen($msg);//maj_lenght
		if($lenght_msg!=$r['host']){update("qda","host",$lenght_msg,"id",$id);}}
	update("qda","lu",($r['lu']+1),"id",$id);}
elseif($prw==1)$msg="";
elseif($id!=$read or $prw==2){
	if(strlen($r['host'])<15)if(strpos($msg,':import'))
		$msg=sql('msg','qdm','v','id='.substr($msg,1,strlen($id)));
	if(rstr(34))$msg=correct_txt($msg,'b i h c l /2 /3 table','corrfast');
	if(rstr(64))$msg=correct_txt($msg,'q','stripconn');////thumb
	$msg=kmax($msg); $msg=format_txt($msg,"noimages",$id);
	$msg=clean_br_lite($msg);}//if(rstr(9))
if($_GET['look'])$msg=str_detect($msg,$_GET['look'],0);
if(($r['opts']['2cols']) && $prw>2 && strlen($msg)>2000 && $r['re']>1)
	$msg=divc('cols',$msg);// or $r['re']>3
$panout['msg']=$msg;
return $panout;}

function str_detect($v,$d,$c,$n){$sz=strlen($d); $nd=0;
for($i=0;$i<$n;$i++){if($nd<strlen($v)){$pos=strpos(strtolower($v),strtolower($d),$nd);
	if($pos!==false){$part=substr($v,$pos,$sz); 
		if(!$c)$repl='<a name="look'.$i.'"></a>'.btn('stabilo',$part).''; 
		else $repl=lkc('stabilo','/?read='.$c.'&look='.$d.'#look'.$i,$part);
		$v=substr($v,0,$pos).$repl.substr($v,$pos+$sz); $nd+=$pos+strlen($repl);}}}
if($n or !$c)return $v;}

function prepare_msg_rech($id,$msg,$r='',$n){$rech=good_rech();
if($_GET['bool'])$parts=explode(' ',trim($rech)); $nbp=count($parts);
$msg=strip_tags($msg); $msg=clean_internaltag($msg); $r=explode('.',$msg);
if(!$_GET['titles'])foreach($r as $k=>$v){
	if($nbp>1){foreach($parts as $kb=>$vb)if($v && $vb){
		$na=substr_count(strtolower($v),strtolower($vb)); $panout['count']+=$na;
		$va=str_detect($v,$vb,$id,$na);}
	else $va=''; if($va)$ret.=divc('track',$va.'.');}
	else{$na=substr_count(strtolower($v),strtolower($rech)); $panout['count']+=$na;
		$res=str_detect($v,$rech,$id,$na); if($res)$ret.=divc('track',$res.'.');}}
if($_GET['titles'])$panout['msg']=''; else $panout['msg']=clean_br_lite($ret);
return $panout;}

function prepare_tracks($id,$otp){
if($id==$_SESSION['read'] && !$_GET['page']){
	if(rstr(1))$opt="true"; $optb=@$_SESSION['opts']['tracks']; $opt=$optb?$optb:$opt;
	if($opt=="true" or ($_GET['track'] && $_SESSION['auth']>5)){$ret='<a name="trackback"></a>';
		$ret.=lj('txtcadr','popup_track___'.$id,pictxt('forum',nms(21))).br();}
	if(count($otp)>0)$trk=output_trk($otp); $_SESSION['cur_div']='content';
return $ret.divd('track'.$id,$trk);}}

//article
function art_read_mecanics($id,$r,$msg,$n,$prw,$tp){if(!$id)return;
$n=$_SESSION['nl']?$_SESSION['nl']:$n;//no_edit
$rear=nb_ib_arts($id)+1; $otp=read_idy($id,'DESC');
$r['opts']=$_SESSION['opts']?$_SESSION['opts']:art_opts($id);
$panout['id']=$id; $panout['suj']=$r['suj']; //$prw=slct_media($prw);
if($r['re']==0)$panout['css']="hide"; else $panout['css']="";
//if($_GET['module']=="agenda")$panout['suj']=strftime("%A %d %B %Y",$r['day']).' :: ';
if($prw<3)$panout['thumb']=prepare_thumb($r['img']);
if(good_rech() && $n)$panout+=prepare_msg_rech($id,$msg,$r,$n);
elseif($msg){$panout+=prepare_msg($id,$msg,$r,$prw);//corps && $prw!=1
	if(!$_SESSION['nl'])$trk=prepare_tracks($id,$otp);}
$panout+=prepare_tits($id,$r,$rear,$otp,$panout['count'],$prw);//count($otp)
return balb('section',atd($id).atn($id),template($panout,$tp)).$trk;}

#load
//join lang
function lang_req(){
$qda=$_SESSION['qda']; $qdd=$_SESSION['qdd'];
$lg=$_SESSION['lang']; if($lg=='all')return;
$wha=' inner join '.$qdd.' on '.$qdd.'.ib='.$qda.'.id';// and val="lang"
if($lg==prmb(25)){
	$lgs=str_replace(prmb(25),'',prmb(26)); $r=explode(' ',$lgs);
	foreach($r as $k=>$v)if($k)$whb.=' and '.$qdd.'.msg!="'.$v.'"';
	return $wha.$whb;}
elseif($lg!='all')return $wha.' and '.$qdd.'.msg="'.$lg.'"';}

function sqlmk($d,$b,$in,$wh='',$ord=''){
if($wh)$wh=' where '.$wh; if($ord)$ord=' order by '.$ord;
return 'select '.$d.' from '.$_SESSION[$b].$in.$wh.$ord;}

function play_req($wh){$qda=$_SESSION['qda'];
$slct=$qda.'.id,'.$qda.'.ib,'.$qda.'.day,mail,frm,suj,img,nod,thm,name,lu,re,host';
if($_SESSION['lang']!='all')$in=lang_req(); $wh='nod="'.$_SESSION['qb'].'" '.$wh;
if($dig=get('dig')){$dayb=calc_date($dig); $daya=calc_date(time_prev($dig));}
else{$dayb=ses('dayb'); $daya=ses('daya');}
$wh.=' and '.$qda.'.day<'.$daya; if($dayb)$wh.=' and '.$qda.'.day>'.$dayb;
return array($slct,$in,$wh,$qda.'.'.prmb(9),' group by '.$qda.'.id');}

function load_arts($frm,$prw){
$frm=$frm?$frm:$_SESSION['frm']; $prw=slct_media($prw);
$qda=$_SESSION['qda']; $qdm=$_SESSION['qdm']; $use=$_SESSION['USE'];
$page=$_SESSION['page']; $npg=$_SESSION['prmb'][6]; $min=($page-1)*$npg;
if($frm!="Home" && $frm!="All" && $frm)$wh=' and frm="'.$frm.'"';
else $wh=' and substring(frm,1,1)!="_"';
if($_SESSION['rstr'][33]=="1")$wh.=' and ib="0"';
if($_SESSION['auth']<4)$wh.=' and re>="1"';
if($use && $_SESSION['auth']<4)$wh.=' OR (re<1 and name="'.$use.'")';
list($slct,$in,$wh,$ord,$gr)=play_req($wh);
$sql=play_req($wh);
//$in.=' inner join '.$qdm.' on '.$qda.'.id='.$qdm.'.id';
$sql=sqlmk($slct,'qda',$in,$wh,$ord);//.' limit '.$min.', '.$npg
$req=mysql_query($sql);
if($req)while($r=mysql_fetch_assoc($req))$ret[$r['id']]=$r;//' id='.$r[0];
return $ret;}

function batch_load($r,$prw,$tp){
if($prw>1)$msg=sql('msg','qdm','v','id="'.$r['id'].'"');//msg
return art_read_mecanics($r['id'],$r,$msg,'',$prw,$tp);}

//all
function play_arts($frm,$pr,$tp){$pr=slct_media($pr);
$page=$_SESSION['page']; $npg=$_SESSION['prmb'][6]; $min=($page-1)*$npg;
$r=load_arts($frm,$prw); //pr($r);
$nbarts=count($r); if(!$r)return;
foreach($r as $k=>$v){$i++;
	if($pr=='auto')$prw=$v['re']>=2?2:1; else $prw=$pr;
	if($i>=$min && $i<$npg*$page && $v)
		$ret.=batch_load($v,$prw,$tp);
	elseif(rstr(39))$ret.=div(atd($k).atc($prw),'');}
if(!rstr(39))$nbpg=nb_page($nbarts,$npg,$page);
return $nbpg.$ret.$nbpg;}

//video
function search_conn_video($id,$msg){
$r=explode(':video',$msg); $n=count($r); if(!$r[1])return; 
else{for($i=0;$i<$n-1;$i++){$s=strrpos($r[$i],'[');
if($s!==false)$ret.='['.substr($r[$i],$s+1).'§1:video] ';}}
return $ret;}

//read
//day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re
//ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host
function art_datas($id){$r=pecho_arts($id);
return array('ib'=>$r[10],'name'=>$r[7],'mail'=>$r[9],'day'=>$r[0],'nod'=>$r[4],'frm'=>$r[1],'suj'=>$r[2],'re'=>$r[11],'lu'=>$r[6],'img'=>$r[3],'thm'=>$r[5],'host'=>$r[8]);}

function art_read($tp='read'){
$qb=$_SESSION['qb'];$qda=$_SESSION['qda'];$USE=$_SESSION['USE']; $id=$_SESSION['read'];
$r=sql('ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host','qda','a','id='.$id);
$_SESSION['imgrel']=first_img($r['img']);
$msg=sql('msg','qdm','v','id="'.$id.'"');//msg
if($id && ($r['re']>='1' or $_SESSION['auth']>=3 or $USE==$r['name'])){
	if($_GET['page'])$prw=2; else $prw=3;
	$ret=art_read_mecanics($id,$r,$msg,'',$prw,$tp);}
if(rstr(33))$ret.=ib_arts($id,$prw);
return $ret.$ibarts;}

function art_read_b($id,$n,$prw,$tp){//local_call/search/mod_load/popart
if($prw>2){$_GET['read']=$id; $tp=$tp?$tp:'read';}
if($id=='last')$id=last_art_rqt(); elseif(!is_numeric($id))$id=id_of_suj($id);
$r=art_datas($id);
if(rstr(5) or $prw>2 or $_GET['search'])
	$msg=sql('msg','qdm','v','id='.$id);//1.2.3.nl
if($prw=='vd')$msg=search_conn_video($id,$msg);
$ret=art_read_mecanics($id,$r,$msg,$n,$prw,$tp);
if($prw>2)$ret.=ib_arts($id,$prw);//affiliates
return $ret;}

function art_read_c($id,$prw,$rstr35){//4ajax: only_content
if($prw>2)$_SESSION['read']=$id; else $_SESSION['read']='';
$r=art_datas($id); //$prw=slct_media($prw);
if(rstr(5) or $prw>2)$msg=sql('msg','qdm','v','id="'.$id.'"');
$ret=implode('',prepare_msg($id,$msg,$r,$prw)); $ret.=divc('clear','');
if(rstr(35) && !$rstr35)$ret=scroll_b(strlen($ret),$ret,1000,'','400',$id);//navig($id).
if($prw==3)$ret.=lj('" href="#'.$id,'art'.$id.'_art___'.$id.'_1',picto('ktop'));
return $ret;}

function art_read_d($id,$n,$prw,$tp){//4ajax: reload inside
if($id=="last") $id=last_art_rqt(); elseif(!is_numeric($id))$id=id_of_suj($id);
if($prw>2){$_GET['read']=$id; $tp=$tp?$tp:'read';}//$prw=slct_media($prw);
$r=art_datas($id);
if((rstr(5) or $prw>2 or $prw=='vd') && $r['re'])// or auth(4)
	$msg=sql('msg','qdm','v','id="'.$id.'"');
if($prw=='vd')$msg=search_conn_video($id,$msg); 
$panout['id']=$id; $panout['suj']=$r['suj']; if(!$r['suj'])return 'not_exists';
$panout['cat']=$r['frm'];
$panout['img1']=first_img($r['img']);
if($prw<3)$panout['thumb']=prepare_thumb($r['img']);
$rear=nb_ib_arts($id)+1; $otp=read_idy($id,"DESC");//tracks
$panout+=prepare_tits($id,$r,$rear,$otp,$n,$prw);
if($msg)$panout+=prepare_msg($id,$msg,$r,$prw);//corps
return template($panout,$tp);}

#tracks
function output_trk($otp){
if(is_array($otp))foreach($otp as $id=>$nb)
if(is_numeric($id))$ret.=divd('trk'.$id,tracks_read($id,$page,$nb));
return $ret;}

function tracks_read($id,$page='',$n=''){
$USE=$_SESSION['USE']; $qb=$_SESSION['qb']; $read=$_SESSION['read'];
$ip=hostname(); $panout['css']='track'; $panout['sty']='';
if($id){$panout['id']=$id;
	list($ib,$name,$mail,$day,$nod,$frm,$suj,$msg,$re,$lu,$img,$thm,$host)=sql('ib,name,mail,day,nod,frm,suj,msg,re,lu,img,thm,host','qdi','r','id='.$id);}
	$panout['date']=mkday($day,'y/m/d H:i');//time_ago($day);
	$panout['edit'].=lj('','popup_track___'.$read.'_['.$id.':track]',picto('get')).' ';
	if($re=="0" && $host==$ip){$panout['sty'].='opacity:0.5;';
		$panout['edit'].=btn('txtsmall',helps('trackbacks')).' ';}
	if($_GET['admin'])$purl='/?admin='.$_GET['admin'];
	if($_GET['read'])$purl='/?read='.$_GET['read'];
	if($host==$ip && ($_SESSION['dayx']-$day)<600 or auth(6))//redit
		$panout['edit'].=lj('','popup_trkedit___'.$id,picto('edit')).' ';
	$sender=sql('id','qdu','v','name="'.$name.'"');
	if($sender)$panout['author']=lj('','popup_track___'.$name,$name);
	elseif($mail!='mail')$panout['author']=lj('','popup_plupin___mail_'.$mail,$name);
	else $panout['author']=$name;
	if(substr($suj,0,4)!="hide" or $_GET['idy_show']==$id){$state="hide";
		$f='imgb/avatar_'.$name.'.gif';//avat
		if(is_file($f))$panout['avatar'].=image($f,48,48,ats('vertical-align:bottom;'));
		if($re!="0" or auth(3) or $host==$ip){//$msg=format_txt($msg,'','');
			$msg=correct_br($msg); $msg=miniconn($msg);
			$msg=correct_txt($msg,'','sconn'); $msg=nl2br($msg);}
		else $msg=divc('txtalert',helps('trackbacks'));}
	else{$state='show'; $msg='';}
if(auth(4) && $frm!=$qb){$j='trk'.$id.'_plug___tracks_trk*publish_'.$id;
	if($re!=1)$panout['edit'].=lj('txtyl',$j.'_on',nms(29)).' ';
	else $panout['edit'].=lj('',$j.'_off',offon(0)).' ';}
if((auth(4) or $USE==$name) && ($re==0 or auth(6)))$panout['edit'].=lj('" title="'.nms(43),'trk'.$id.'_call___sav_edit*tracks__'.$id.'',picto('trash')).' ';
$panout['msg']=stripslashes($msg);
if(substr($n,0,2)=="nl")$http=host().'/';
$panout['url']=$http.htacc('read');
return template($panout,'tracks');}

function urledt_id($id){$b=rstr(18)?'public':$_SESSION['qb'];
$u=is_numeric($id)?rqt($id,9):$id; list($k)=verif_defcon($u);//
return lj('','popup_editmsql___users/'.$b.'*defcons_'.ajx($k),picto('txt'));}

#editor
//conn_error
function conn_correct($v){
$ca=substr_count($v,'['); $cb=substr_count($v,']');
if($ca>$cb){$nb=$ca-$cb; $t='"]"';}
elseif($ca<$cb){$nb=$cb-$ca; $t='"["';}
if($nb)return btn("txtyl",$nb.$t.' missing');}

//menus
function conn_pictos(){return array('[ ]'=>'conn','url'=>'url','img'=>'photo','video'=>'video','h'=>'h','b'=>'b','i'=>'i','u'=>'u','center'=>'textcenter','right'=>'textright','table'=>'table','list'=>'list','q'=>'quote','nh'=>'anchor','nl'=>'back','--'=>'less','nbsp'=>'fix','select'=>'select','copy'=>'copy','paste'=>'paste','del'=>'no','deline'=>'del','delconn'=>'delconn','findconn'=>'expand');}
function conn_icon($v,$rp){
$r=array('k'=>'strike','l'=>'small'); if($r[$v])return bal($r[$v],$v);
if($v=='s')return btn('stabilo',$v); if($v=='r')return btn('txtclr',$v);
return $rp[$v]?picto($rp[$v],'16'):$v;}
function conn_props(){$pad=plugin('keyboard','txtarea');
$r=array('html','arts','media','tools','filters','del','msql','codeline','backup');
foreach($r as $k=>$v)$ret.=togbub('navs',$v,$v,'',$v=='del'?1:'');//
$r=array('ascii','pictos','icons','disk'); foreach($r as $k=>$v)$ret.=bubble('','navs',$v,$v);
return $ret.togbub('navs','uc','uc').$pad.br();}

function conn_edit(){
$r=msql_read('system','connectors_basic','',1);
$help=msql_read('lang','connectors_basic','',1);
if($_SESSION['USE'])$ret=conn_props(); $rp=conn_pictos();
foreach($r as $k=>$v){$txt=conn_icon($k,$rp); $rid=randid(); if($k=='nl')$v[1]='\n';
	if($v[0]=='embed'){if($v[1])$v[0]='embed_slct'; else $v[1]=$k; $v[1].='\',\''.$rid;}
	$ret.=btd('bt'.$rid,ljb('" title="'.($help[$k]),$v[0],$v[1],$txt));}
return divc('nbp',$ret.btd('bts',''));}

//f
function f_inp($mil,$link){$_SESSION['cur_div']='content'; $ip=hostname();
$qda=$_SESSION['qda']; $USE=$_SESSION['USE']; $cont=$_GET['continue'];
$read=$_SESSION['read']; $raed=$_SESSION['raed']; $frm=$_SESSION['frm'];
if($USE)$us=$USE; else list($us,$ml)=sql('name,mail','qdi','r','host="'.$ip.'" ORDER BY id DESC LIMIT 1'); $currid=lastid('qda')+1; if($frm=="" or $frm=="Home")$frm="public";//sections
if($_GET['edit']=="=")$cit="&edit=="; $goto='/?read='.$read.$cit;
if(substr($link,0,4)=='http' && !$cont){$link=https(utmsrc($link));//vacuum
	$_GET['urlsrc']=$link; list($suj,$msg)=vacuum($link,'');}
//elseif($read)$link=$_SESSION['rqt'][$read][9];
if(!$cont)$r['urlsrc']=autoclic('urlsrc',"url",'10" id="urlsrc" onClick="SaveI(\'urlsrc\')" onContextMenu="SaveIt()" value="'.$link,'250','').btd('urledt','');//urlsrc
if($USE && !$cont){
	$r['trkname']=hidden('name','trkname',$USE).hidden('mail','trkmail','');
	$r['slcat']=select_j('frm','category',$frm,'3',$frm,'');}
elseif(!$USE){$gn='" onkeyup="log_goodname(\'trkname\');';
	$r['trkname']=autoclic('name" id="trkname'.$gn,$us?$us:nms(38),'8','50','txtx');//name
	$r['trkmail']=autoclic('mail" id="trkmail',$ml?$ml:'mail','13','50','txtx');}//mail
if(!$cont)$r['parent']=select_jp('ib','parent',rstr(10)?$read:'','0',picto('topo'),'1');
//if(!$cont)$r['parent']=togbub();
if(!$cont && auth(3))$r['publish']=checkbox_j('pub',$_SESSION['auth']<4?0:rstr(11),nms(29));
else $r['publish']=hidden('pub','pub',0);
if(!$cont){//new
	$r['pstdat']=select_j('postdat','date',date('y-m-d-H-i'),0,picto('time'),0);
	$r['pstsuj']=balise('input',array('','','suj','suj1','','editor',7=>255,16=>'width:100%;',23=>($suj?$suj:nms(71))),'');}
if($cont){$msg=sql('msg','qdm','v','id='.$read); $btcntn='continue=ok#'.$read;
	$alrt=conn_correct($msg);}// $alrt.=suj_arts($raed,$read);
else{$goto='/?read='.($currid); $btcntn='insert=ok';}//&continue==#'.$currid
$msg=str_replace("\r","",$msg);//msg
$msg=str_replace(array("<br />\n","<br />","<br>"),"\n",$msg);//save
$ids='suj1|frm|urlsrc|postdat|trkname|trkmail|ib|pub';//|sub
$c='popbt';
$sav=ljb($c,'SaveJb','socket_saveart_txtarea_id4_'.$read.'_no\',\'art'.$read.'_readart___'.$read,picto('save'));
if($cont && rstr(53))$sav.=ljb($c,'SaveJb','txarea_saveart_txtarea_id4_'.$read.'\',\'art'.$read.'_readart___'.$read,nms(57)).' ';
elseif(!rstr(53))$sav.=submitj($c,'sav',nms(57)).' ';
else $sav.=lj($c,'socket_newart_txtarea_'.(rstr(57)?7:9).'_____'.$ids,nms(57)).' ';//pop
$btdt=lj('','popup_artwedit_txtarea__',pictit('editor',nms(107))).' ';
$btdt.=ljb(''.'" title="test','captslct','preview',picto('valid')).' ';
if($cont && $read)$btdt.=urledt_id($read);//defcon//urledt($link)
$ret='<form method="POST" id="sav" action="'.$goto.'&'.$btcntn.'">'."\n";//form
$ret.=btd('bts'.$read,$sav).' '.$btdt;
$ret.=implode(' ',$r);
$ret.=sesmk('conn_edit','','');//1
$ret.=$alrt;
$ret.=divd('txarea',txarea1($msg));
//if(auth(4))$ret.=checkbox("randim","ok","rename_img",0);
$ret.=' </form>'."\n";
return $ret;}

?>