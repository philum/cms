<?php
//philum_art 

#templates
function template_art(){return '
[[_EDIT§right:css]_THUMB[_PARENT§h4:balise][[_URL§_SUJ_ARTLANG:url]§h2|fixit:balise] 
[[_SEARCH§popw:css] [_SOCIAL _WORDS _OPEN§grey:css]§right:css]
[_BACK§txtbox:css] _AVATAR [_AUTHOR _DATE§txtsmall2:css] [_NBARTS§txtnoir:css] [_LENGTH _PRIORITY _SOURCE _TAG _BTIM _RSS _TRACKS _OPT _PID _LANG§txtsmall2:css]§header|meta_ID:balise]
_FLOAT[_MSG[:clear]§article|art_ID|justy:balise]';}
function template_read(){return '
[[_EDIT§right:css][_PARENT§h4:balise]_THUMB[_SUJ_ARTLANG§h2|fixit|:balise] 
[[_SEARCH§popw:css] [_SOCIAL _WORDS _OPEN [_URL§[url:picto]:url]§grey:css]§right:css]
[_BACK§txtbox:css] [_AUTHOR _DATE§txtsmall2:css] [_NBARTS§txtnoir:css] [_LENGTH _PRIORITY _SOURCE _TAG _BTIM _RSS _TRACKS _OPT _PID _LANG§txtsmall2:css]§header|meta_ID:balise]
_FLOAT[_MSG[:clear]§article|art_ID|justy:balise]';}
function template_fastart(){return '[[[_URL§_SUJ:url]§h3:balise]§div:balise]
[_MSG[:clear]§article|art_ID|justy:balise]';}
function template_tracks(){return '[[trk_ID:anchor]_AVATAR [_AUTHOR§txtblc:css] [_DATE§txtsmall2:css] _EDIT[:br]_MSG[:clear]§[_CSS:class][_STY:style]:div]';}
function template_titles(){return '_FLOAT[[[_URL§_SUJ:url]§h3:balise] [_NBARTS§txtblc:css] _DATE _OPT _PARENT _TAG:div]';}
function template_pubart(){return '[[_IMG1§44/44:thumb]§[imgl:class]:div][_AUTEURS§txtx:css] [[_URL§_SUJ:url]§h4:balise]_VIDEO[:clear]';}
function template_pubart_j(){return '[[_IMG1§44/44:thumb]§[imgl:class]:div][_AUTEURS§txtx:css] [[_PURL§_SUJ:jurl]§h4:balise]_VIDEO[:clear]';}
function template_pubart_b(){return '[_URL§[_IMG1§200/100:thumb]:url][_AUTEURS§txtx:css]
[[_URL§_SUJ:url]§h4:balise]_VIDEO';}
function template_weblink(){return '[[_IMG1§72/72:thumb]§[float:left;margin-right:10px:style]:div][_URL§_SUJ:url][:br]_MSG';}
function template_book(){return '[[_BACK[_TITLE§h2:balise]
_OPT _DATE _TAG _LENGTH _PLAYER:div][_MSG§[panel:class]:div]§[book:class]:div]';}
function template_product(){return '[[[_ID§_SUJ:url]§txtcadr:css] 
_THUMB[_PRICE:div][_ADD2CART§[imgr txtsmall:class]:div]
§[float:left; width:142px; margin:2px; padding:5px; border:1px solid black;:style]:div]';}
function template_panart(){return '[[_URL§[[_AUTEURS§[small:class]:div]_SUJ§[panart:class]:div]:url]
§[background:url(/imgc/_IMG1) center; background-size:cover;:style]:div]';}
function template_vars(){
$d='artedit pid id url jurl purl edit title suj cat msg img1 video btim back avatar author date day nbarts tag priority words search parent rss social open tracks source length player lang artlang opt css sty addclr thumb trkbk float '.prmb(18); $r=explode(' ',$d);
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

function template_u($tpl){
$tmp=msql_read('users',$_SESSION['qb'].'_template',$tpl);
if(!$tmp)$tmp=msql_read('','public_template',$tpl);
return $tmp;}

function template($p,$tpl){
if(!$tpl)$tpl=@$_SESSION['opts']['template'];//article
if(!$tpl)$tpl=$_SESSION['prma']['template'];//module
if(!$tpl)$tmp=template_art();
if($tpl=="pubart")$tmp=rstr(55)?template_u($tpl):template_pubart();
elseif($tpl=="pubart_j")$tmp=rstr(55)?template_u($tpl):template_pubart_j();
elseif($tpl=="pubart_b")$tmp=rstr(55)?template_u($tpl):template_pubart_b();
elseif($tpl=="titles")$tmp=rstr(65)?template_u($tpl):template_titles();
elseif($tpl=="tracks")$tmp=rstr(66)?template_u($tpl):template_tracks();
elseif($tpl=="book")$tmp=rstr(67)?template_u($tpl):template_book();
elseif($tpl=="products")$tmp=template_product();
elseif($tpl=="fastart")$tmp=template_fastart();
elseif($tpl=="weblink")$tmp=template_weblink();
elseif($tpl=="panart")$tmp=template_panart();
elseif($tpl=="read" && rstr(88)){$tmp=template_u($tpl); if(!$tmp)$tmp=template_read();}
if(!$tmp)$tmp=template_art();
return template_build($tmp,$p);}

#edit
//admin_edit
function admin_edit($kem,$id,$re,$prw){$USE=$_SESSION['USE']; $auth=$_SESSION['auth'];
if($re==0){if(($USE==$kem && $auth>2) or $auth>3)//publish
	$ret=ljb('txtyl" id="pba'.$id,'publishart',$id,picto('forbidden')).' ';
	elseif($USE==$kem && $auth==2)$ret.=btn("txtyl",nms(53)).' ';}
if(get('search') && $auth>4)
	$ret.=togbub('call','meta_tag*slct_'.$id.'_'.ajx(get('search')),picto('paste')).' ';
if(($USE==$kem) or $auth>3){
	$ret.=togbub('metall',$id.'_'.$prw,picto('tag',24)).' ';//SaveTits
	$ret.=togbub('tit',$id.'_'.$prw,picto('localize',24)).' ';//SaveTits
	$ret.=lj('','popup_artedit___'.$id.'___autosize',picto('edit',24)).' ';}
return btd('artmnu'.$id,$ret);}

#build
function restricted_area($n){$ret=read_msg("restricted_area",""); if(!$ret)$ret=nms(55); 
return divc('txtalert',$ret.': '.nameofauthes($n));}
function target_date($v,$n=''){return htac('timetravel').date('d-m-y',$v).($n?'&nbj='.$n:'');}
function art_length($w){if($w>1300)return picto('time',16).' '.ceil($w/1300).' min';}
function place_img($t,$m){$mg=explode("/",$m);
foreach($mg as $v){$ret=str_replace("[image$n]",'['.$v[$n].']',$t);}
return $ret;}
function suj_arts($suj,$id){
$r=sql('id','qda','k','nod="'.ses('qb').'" and suj="'.$suj.'" and id!="'.$id.'"');
if($r)return slctmenusj($r,'popup_popart___',$read,' ');}
function pub_link($m){$f=ajx(http_root($m));
return lkt('',http($m),picto('url',16)).' '.lj('','popup_api___source:'.$f,preplink($m));}

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
function tag_maker($id,$o=''){
$r=ses('artags'); $r=$r?$r:art_tags($id); if(!$r)return; $sep=sep();
$ica=explode(' ',prmb(18)); $ico=explode(' ',prmb(19));
$rico=array_combine($ica,$ico); $rico['tag']='tag'; $rico['utag']='like';
if($r)foreach($r as $cat=>$vr){$rt=''; if(is_numeric($cat))$cat='utag';
	foreach($vr as $ka=>$va)$rt[$ka]=lj('','popup_api___'.$cat.':'.ajx($ka),$ka);
	if($rt)$ret[$cat]=picto($rico[$cat],16).$sep.implode(' ',$rt);}
if($ret)return $o?$ret:implode(' ',$ret);}

function art_back($id,$ib,$frm){
if($frm!=$_SESSION['frm'] && $frm && rstr(43)){
return lka(htac('cat').$frm,$frm);} else $t=picto('previous');
if($_GET['read']){$ibb=ib_of_id($ib);
	if($id!=$_SESSION['read']){
		if(!$ibb or $ibb=='/')$bl=htac('cat').$frm.'#'.$ib;
		else{$bl=urlread($ibb).'#'.$ib; $t=picto('left');}}
	elseif($ib>0){$bl=urlread($ib).'#'.$id;$t=picto('left');}
	elseif($_SESSION['read']){$bl=htac('cat').$frm.'#'.$id;$t=picto('previous');}
	else{$bl=htac('cat').$frm.'#'.$id;}
return lka($bl,$t?$t:$frm);}}

function opnart($id,$prw,$o=''){$c=$o?'active':'';//art_read_c
return ljb($c.'" id="toggleart'.$id,'SaveBc','art_'.$id.'_'.$prw.'_'.$o,picto('kdown'));}

//prepare_tits
function prepare_tits($id,$r,$rear,$nbtrk,$nl,$prw){$ib=trim($r['ib']);
$nl=$nl?$nl:$_SESSION['nl']; $rst=$_SESSION['rstr']; $USE=$_SESSION['USE'];
$read=$_SESSION['read']; $page=$_SESSION['page']; if($nl=='nlpop'){$nl='';$nlp=1;}
$out['jurl']='content_ajxlnk2__2_read_'.$id; $out['purl']='popup_popart__3_'.$id.'_3';
$out['day']=$r['day']; $out['artedit']=' '; $nlb=substr($nl,0,2);
if($nlb=="nl")$http=host(); $out['url']=$http.good_url($id,$r['suj']);//urlread($id);
if(!$rst[19])$out['img1']=best_img($r['img']);//first_img
//if(!$rst[93])$out['img1']=best_img($r['img']);//img1
if(!$rst[68] && $r['img'] && strpos($r['img'],'/'))//gallery
	$out['btim']=lj('','popup_callp___spe-ajxf_art*gallery_'.$id.'_gallery',picto('img'));
if($_SESSION['prma']['art_mod']){
	if($read==$id && $prw>2 && !$nl && !$nlp && rstr(60))$out['float']=build_art_mod(1);
	//$out['float']=mkbub(popbub('seek','',picto('list'),'c'),'inline','position:relative; display:inline-block;','');//seek
	$out['open'].=lj('','popup_popartmod__3_'.$id,picto('virtual')).' ';}
if(!$rst[31]){$out['back']=art_back($id,$ib,$r['frm']);}//back
if(!$rst[6] && $r['name']){//author
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
	$out['nbarts']=lj('','popup_api___parent:'.$id,nbof($rear,1));//nb_arts
if(!$rst[86] && is_array($nbtrk)){$nbtk=count($nbtrk);//tracks
	if($read)$out['tracks']=lka(urlread($id).'#track',picto('forum',16).$nbtk);
	else $out['tracks']=lj('','popup_trckpop___'.$id,picto('forum',16).$nbtk);}
if($ib>0 && $read!=$id && $read!=$ib){$sujb=suj_of_id($ib);//parent
	if($sujb)$out['parent']=lka(urlread($ib),pictxt('copy',$sujb));}
if(!$rst[58] && $nlb!="nl")$out['open'].=lj('','popup_editbrut___'.$id,picto('conn')).' ';
if(!$rst[37] && $nlb!="nl")$out['open'].=popart($id).' ';//popen
if(!$rst[28] && $nlb!="nl"){//open
	if($prw<=2 && $rst[41]!="0")$out['open'].=opnart($id,$prw,'').' ';
	elseif($prw==3 && $rear>1)$out['open'].=opnart($id,2,'1').' ';}
if(!$rst[25] && $r['host']>1000)//length
	$out['length']=art_length($r['host']);
if(!$rst[40])//rss
	$out['rss']=lkt("",'/plug/rss1.php?read='.$id.'&preview=full',picto('rss',16));
if(!$rst[71] && $nlb!="nl")
	$out['social']=lj('','popup_artstats___'.$id.'_'.$r['day'],picto('users',16));
//if($ath=@$r['opts']['authlevel'])$out['social'].=asciinb($ath);
if($nlb!='nl' && $prw>2){$root=host().urlread($id);//social//&via=philum_info
	$rsoc=array(44=>'http://www.facebook.com/sharer.php?u='.$root,45=>'http://twitter.com/intent/tweet?original_referer='.$root.'&url='.$root.'&text='.utf8_encode($r['suj']).'&title='.utf8_encode($r['suj']),46=>'http://wd.sharethis.com/api/sharer.php?destination=stumbleupon&url='.$root);
	if(auth(6) && !$rst[45])//api twitter
		$ots.=togbub('plug','twit_twit*share_'.$id,callico('tw'));
	if(!$rst[45])$ots.=lkt('',$rsoc[45],callico('tw'));
	if(!$rst[44])$ots.=lkt('',$rsoc[44],callico('fb')).' ';
	if(!$rst[46])$ots.=lkt('',$rsoc[46],icon('stumble')).' ';
	if(!$rst[42])$ots.=utag_edt($id).' ';
	if(!$rst[52] or $r['opts']['fav'])$ots.=fav_edt($id,'fav').' ';
	if(!$rst[90] or $r['opts']['like'])$ots.=fav_edt($id,'like').' ';
	if(!$rst[91] or $r['opts']['poll'])$ots.=poll_edt($id).' ';
	if(!$rst[86])$ots.=lj($css,'popup_track___'.$id,picto('forum')).' ';
	//$ots.=lj($css,'popup_plup___track_trk*read_'.$id,picto('forum')).' ';
	//if(!$rst[47])$ots.=togbub('vmail',$id,picto('mail')).' ';
	if(!$rst[47])$ots.=lj('','popup_vmail___'.$id,picto('mail')).' ';
	if(!$rst[12])$ots.=lkt('','/plug/read/'.$id,picto('print')).' ';
	if(!$rst[49])$out['words']=togbub('words',$id,picto('search'));
	$out['social'].=$ots;}
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
if(rstr(43))$ret=hr().btn('txtcadr',nms(39)).' '.$ret.br();
if(!auth(1))$cnd='and re>="1" and substring(frm,1,1)!="_"';
$load=sql('id','qda','k','ib="'.$id.'" '.$cnd.' ORDER BY id '.$ordr);
if($load)return $ret.output_pages($load,'flow','');}//prw from config

//visitor
function utag_edt($id){return togbub('editag',$id.'_utag_tag',picto('tag'));}
function poll_edt($id){return btd('pll'.$id,plugin_func('poll','poll_score',$id));}

function fav_sav($id,$type){
$ex=sql('id','qdd','v','ib="'.$id.'" and val="'.$type.'" and msg="'.ses('iq').'"');
if($ex)delete('qdd',$ex);
else insert('qdd','("","'.$id.'","'.$type.'","'.ses('iq').'")');
return fav_edt($id,$type,1);}

function fav_edt($id,$type,$o=''){
if($type=='fav'){$clr='#428a4a';$ic='like';}
elseif($type=='like'){$clr='#ee1111';$ic='love';
	$n=sql('count(id)','qdd','v','ib="'.$id.'" and val="'.$type.'" and msg="1"');
	$n=btn('txtsmall',$n);}
$ex=sql('id','qdd','v','ib="'.$id.'" and val="'.$type.'" and msg="'.ses('iq').'"');
if($ex)$s='color:'.$clr;
$ret=lj('small',$type.$id.'_call___art_fav*sav_'.$id.'_'.$type,picto($ic,$s)).$n;
return $o?$ret:btd($type.$id,$ret);}

//displays
function slct_media($v=''){if(rstr(5))$d=2; if(rstr(41))$d=3;//preview//full
if($v=='read')$d=4; elseif($v=='full')$d=3; elseif($v=='true' or $v=='preview')$d=2; 
elseif($v=='false')$d=1; elseif($v=='auto')$d=$v; elseif($v=='vd')$d=$v; 
elseif(is_numeric($v))$d=$v;
return $d?$d:1;}

function tometa($msg){$lgh=strlen($msg);
if($lgh>200)$n=strpos($msg,'.',200); else $n=$lgh; $msg=substr($msg,0,$n+1);
$msg=strip_tags($msg); $_SESSION['descript']=str_replace('"',"'",$msg);}

function make_thumb_css($im){
if(!file_exists('imgc/'.$im)){list($w,$h)=split('/',prmb(27));
	make_mini('img/'.$im,'imgc/'.$im,$w,$h,0);}
return $im;}

function best_img_s($d,$id){
if(!$_SESSION['thmb'][$id])$_SESSION['thmb'][$id]=best_img($d);
return $_SESSION['thmb'][$id];}

function prepare_thumb($d,$id){if($_SESSION['rstr'][30]=='1')return;
if($_SESSION['nl'])$pr='nl';
if(rstr(93)){$mg=best_img_s($d,$id); if($mg)$im=make_thumb_css($mg);
	if($im)return div(ats('background:url(/imgc/'.$im.') center;').atc('thumb'),'');}
return minimg($d,$pr);}

//msg img suit
function prepare_msg($id,$msg,$r,$prw){
$read=$_GET['read']; $USE=$_SESSION['USE'];
if(rstr(21) && $prw>1)$ath=$r['options']['authlevel'];
if(rstr(21) && $ath && $ath!='all' && $ath>$_SESSION['auth'])$msg=restricted_area($ath);
elseif(substr($r['frm'],0,1)=='_' && $_SESSION['auth']<3)$msg=restricted_area(6);
elseif(($id==$read && $prw>2 && !$_GET['page']) or $prw>2){
	$msg=format_txt($msg,$prw,$id); if($prw!='nl')tometa($msg);
	if($_SESSION['USE']){$length_msg=strlen($msg);//maj_length
		if($length_msg!=$r['host']){update("qda","host",$length_msg,"id",$id);}}
	update("qda","lu",($r['lu']+1),"id",$id);}
elseif($prw==1)$msg="";
elseif($id!=$read or $prw==2){
	if(strlen($r['host'])<15)if(strpos($msg,':import'))
		$msg=sql('msg','qdm','v','id='.substr($msg,1,strlen($id)));
	if(rstr(34))$msg=correct_txt($msg,'b i h c l','corrfast');// table
	if(rstr(64))$msg=correct_txt($msg,'q','stripconn');////thumb
	$msg=kmax($msg); $msg=format_txt($msg,"noimages",$id);
	$msg=clean_br_lite($msg);}//if(rstr(9))
if($_GET['look'])$msg=str_detect($msg,$_GET['look'],'','');
if(($r['opts']['2cols']) && $prw>2 && strlen($msg)>2000 && $r['re']>1)
	$msg=divc('cols',$msg);// or $r['re']>3
$panout['msg']=$msg;
return $panout;}

function str_detect($v,$d,$c,$n){$sz=strlen($d); $nd=0;
if(!$n)$n=substr_count(strtolower($v),strtolower($d));
for($i=0;$i<$n;$i++){if($nd<strlen($v)){$pos=strpos(strtolower($v),strtolower($d),$nd);
	if($pos!==false){$part=substr($v,$pos,$sz); 
		if(!$c)$repl='<a name="look'.$i.'"></a>'.btn('stabilo',$part).''; 
		else $repl=lkc('stabilo','/?read='.$c.'&look='.$d.'#look'.$i,$part);
		$v=substr($v,0,$pos).$repl.substr($v,$pos+$sz); $nd+=$pos+strlen($repl);}}}
if($n or !$c)return $v;}

function prepare_msg_rech($id,$msg,$r=''){$rech=good_rech();
if($_GET['bool'])$parts=explode(' ',trim($rech)); $nbp=count($parts);
$msg=strip_tags($msg); $msg=clean_internaltag($msg); $r=explode('.',$msg);
if(!$_GET['titles'] && $r)foreach($r as $k=>$v){
	if($nbp>1){foreach($parts as $kb=>$vb)if($v && $vb){
		$na=substr_count(strtolower($v),strtolower($vb)); $panout['count']+=$na;
		$va=str_detect($v,$vb,$id,$na);}
	else $va=''; if($va)$ret.=divc('track',$va.'.');}
	else{$na=substr_count(strtolower($v),strtolower($rech)); $panout['count']+=$na;
		$res=str_detect($v,$rech,$id,$na); if($res)$ret.=divc('trkmsg',$res.'.');}}
if($_GET['titles'])$panout['msg']=''; else $panout['msg']=clean_br_lite($ret);
$_GET['nboc']+=$panout['count'];
return $panout;}

function prepare_tracks($id,$otp){
if($id==$_SESSION['read'] && !$_GET['page']){
	if(rstr(1))$opt="true"; $optb=@$_SESSION['opts']['tracks']; $opt=$optb?$optb:$opt;
	if($opt=="true" or ($_GET['track'] && $_SESSION['auth']>5)){$ret='<a name="track"></a>';
		$ret.=lj('txtcadr','popup_track___'.$id,pictxt('forum',nms(21))).br();}
	if(count($otp)>0)$trk=output_trk($otp); $_SESSION['cur_div']='content';
return $ret.divd('track'.$id,$trk).br();}}

//article
function art_read_mecanics($id,$r,$msg,$n,$prw,$tp){if(!$id)return;
$n=$_SESSION['nl']?$_SESSION['nl']:$n;//no_edit
$rear=nb_ib_arts($id)+1; $otp=read_idy($id,'ASC');
$r['opts']=$_SESSION['opts']?$_SESSION['opts']:art_opts($id); //p($r['opts']);
$panout['id']=$id; $panout['suj']=$r['suj']; //$prw=slct_media($prw);
if($r['re']==0)$panout['css']="hide"; else $panout['css']='';
if($prw==1 or $prw==2)$panout['thumb']=prepare_thumb($r['img'],$id);
if($prw=='rch')$panout+=prepare_msg_rech($id,$msg,$r);
elseif($msg){$panout+=prepare_msg($id,$msg,$r,$prw);//corps && $prw!=1
	if(!$_SESSION['nl'])$trk=prepare_tracks($id,$otp);}
$panout+=prepare_tits($id,$r,$rear,$otp,$panout['count'],$prw);//count($otp)
return balb('section',atd($id).atn($id),template($panout,$tp)).$trk."\n";}

#load
//video
function search_conn_video($id,$msg){
$r=explode(':video',$msg); $n=count($r);
if($r[1]){for($i=0;$i<$n-1;$i++){$s=strrpos($r[$i],'[');
	if($s!==false)$ret.='['.substr($r[$i],$s+1).':video] ';}}
$r=explode(':popvideo',$msg); $n=count($r);
if($r[1]){for($i=0;$i<$n-1;$i++){$s=strrpos($r[$i],'[');
	if($s!==false)$ret.='['.substr($r[$i],$s+1).':video] ';}}
return $ret;}

#read
//day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re
//ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host
function art_datas($id){$r=pecho_arts($id);
return array('ib'=>$r[10],'name'=>$r[7],'mail'=>$r[9],'day'=>$r[0],'nod'=>$r[4],'frm'=>$r[1],'suj'=>$r[2],'re'=>$r[11],'lu'=>$r[6],'img'=>$r[3],'thm'=>$r[5],'host'=>$r[8]);}

function art_read($tp){$id=$_SESSION['read']; $tp=$tp?$tp:'read';
$r=sql('ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host','qda','a','id='.$id);
$_SESSION['imgrel']=first_img($r['img']);
$msg=sql('msg','qdm','v','id="'.$id.'"');//msg
if($id && ($r['re']>='1' or $_SESSION['auth']>=3 or $_SESSION['USE']==$r['name'])){
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
//if($prw==3)$ret.=lj('','art'.$id.'_art___'.$id.'_1',picto('ktop'));
return $ret;}

function art_read_d($id,$n,$prw,$tp){//4ajax: reload inside
if($id=="last")$id=last_art_rqt(); elseif(!is_numeric($id))$id=id_of_suj($id);
if($prw>2){$_GET['read']=$id; $tp=$tp?$tp:'read';}//$prw=slct_media($prw);
$r=art_datas($id); $r['opts']=art_opts($id);
if((rstr(5) or $prw>2 or $prw=='vd') && $r['re'])// or auth(4)
	$msg=sql('msg','qdm','v','id="'.$id.'"');
if($prw=='vd')$msg=search_conn_video($id,$msg);
$panout['id']=$id; $panout['suj']=$r['suj']; if(!$r['suj'])return 'not_exists';
$panout['cat']=$r['frm'];
if(rstr(19))$panout['img1']=first_img($r['img']);
if($prw<3)$panout['thumb']=prepare_thumb($r['img'],$id);
$rear=nb_ib_arts($id)+1; $otp=read_idy($id,'ASC');//tracks
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
if($id){$panout['id']=$id;//,$lu,$img,$thm
	list($ib,$name,$mail,$day,$nod,$frm,$suj,$msg,$re,$host)=sql('ib,name,mail,day,nod,frm,suj,msg,re,host','qdi','r','id='.$id);}//,lu,img,thm
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
	elseif($mail!='mail')$panout['author']=lj('','popup_plupin___mail_'.ajx($mail),$name);
	else $panout['author']=$name;
	if(substr($suj,0,4)!="hide" or $_GET['idy_show']==$id){$state='hide';
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
if((auth(4) or $USE==$name) && ($re==0 or auth(6)))$panout['edit'].=lj('','trk'.$id.'_plug___tracks_trk*trash_'.$id,pictit('trash',nms(43))).' ';
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
function conn_pictos(){return array('[ ]'=>'conn','url'=>'url','img'=>'photo','video'=>'video','h'=>'h','b'=>'b','i'=>'i','u'=>'u','center'=>'textcenter','right'=>'textright','table'=>'table','list'=>'list','q'=>'quote','nh'=>'anchor','nl'=>'back','--'=>'less','nbsp'=>'fix','select'=>'select','copy'=>'copy','paste'=>'paste','del'=>'no','deline'=>'del','delconn'=>'delconn','findconn'=>'connslct');}
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
return divc('popu nbp',$ret.btd('bts',''));}

//f
function f_inp($link,$cont){$_SESSION['cur_div']='content'; $ip=hostname();
$USE=$_SESSION['USE']; $read=$_SESSION['read']; $frm=$_SESSION['frm'];
if($USE)$us=$USE; else list($us,$ml)=sql('name,mail','qdi','r','host="'.$ip.'" ORDER BY id DESC LIMIT 1'); if(!$frm or $frm=='Home')$frm='public';
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
	$r['pstsuj']=balise('input',array('','','suj','suj1',$suj,'editor',7=>255,16=>'width:100%;',23=>nms(71)),'');}
if($cont){$msg=sql('msg','qdm','v','id='.$read); $alrt=conn_correct($msg);}
$msg=str_replace("\r","",$msg);//msg
$msg=str_replace(array("<br />\n","<br />","<br>"),"\n",$msg);//save
$ids='suj1|frm|urlsrc|postdat|trkname|trkmail|ib|pub';//|sub
$c='popbt';
$sav=ljb($c,'SaveJb','socket_saveart_txtarea_id4_'.$read.'_no\',\'art'.$read.'_readart___'.$read,picto('save'));
if($cont)$sav.=ljb($c,'SaveJb','txarea_saveart_txtarea_id4_'.$read.'\',\'art'.$read.'_readart___'.$read,nms(57)).' ';
else $sav.=lj($c,'socket_newart_txtarea_'.(rstr(57)?7:9).'_____'.$ids,nms(57)).' ';//pop
$btdt=lj('','popup_artwedit_txtarea__',pictit('editor',nms(107))).' ';
$btdt.=ljb(''.'" title="test','captslct','preview',picto('valid')).' ';
if($cont && $read)$btdt.=urledt_id($read);//defcon//urledt($link)
$ret.=btd('bts'.$read,$sav).' '.$btdt;
$ret.=implode(' ',$r);
$ret.=sesmk('conn_edit','','');//1
$ret.=$alrt;
$ret.=divd('txarea',txarea1($msg));
//if(auth(4))$ret.=checkbox("randim","ok","rename_img",0);
return $ret;}

?>