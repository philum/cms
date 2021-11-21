<?php
//philum_ajax_hangar
error_report();
$ret='';//$_SESSION['onload']='';
if(!isset($_SESSION['dayx'])){req('boot'); reboot();}
$res=get('res'); $callj=get('callj'); $toj=0; $p=''; $s=''; $t=''; $tt=''; $ret='';
$r=ajxr($callj,5); list($app,$id,$va,$opt,$optb)=$r;
$sz=get('sz'); $pgu=get('pagup'); $ppu=get('popup');
$p0=$app.'__x_'.ajx($id).'_'.$va.'_'.$opt.'_'.$optb.'&res='.$res.'&sz='.$sz;
if($pgu)$p1=lj('','popup_'.$p0,pictxt('popup')).' '; 
else $p1=lj('','pagup_'.$p0,pictxt('fullscreen')).' ';
$ar=['plug'=>1,'plup'=>1,'plugin'=>1,'plupin'=>1,'titsav'=>1,'popbub'=>1,'call'=>1,'callp'=>1];
if(!isset($ar[$app]))require_once('prog'.$b.'/ajxf.php');

function popb($p){return ljb('','Close','popup',picto('close')).ljb('','poprepos','',picto('ktop')).ljb('','reduce','',picto('less')).ljb('','fixelem','',picto('fix')).$p.ses('popm').' ';}//poplist()
function popa($t,$p=''){return div(atd('popa').atc('popa').atb('onmousedown','noslct(0);'),popb($p).balb('small',$t?etc($t,70):'popup'));}
function popup($t,$d,$w=0,$p=''){if($w)$s='max-width:'.($w+36).'px;'; else $s='';
if($p==1)$p=lj('','page_deskbkg',picto('desktop')).' '; $popa=popa($t,$p); $_SESSION['popm']='';
return div(atc('popup').ats($s),$popa.div(atd('popu').atc('popu'),$d));}
function pagup($t,$d,$p=''){
$popa=div(atd('popa').atc('popa'),ljb('','Close','popup',picto('close')).$p.balb('small',$t));
return divs('margin:auto; width:80vw;',$popa.div(atd('popu').atc(''),$d));}

if(strpos($app,',')){list($a,$b)=explode(',',$app);
	$ret=$a::$b($id,$va,$res?$res:$opt); $tt=$a.'::'.$b; $s=is_numeric($optb)?$optb:'800';
	if(is_array($ret))$ret=mkjson($ret);}

/*$app=get('app');//j2
if($app){$mth=get('mth'); $prm=get('params'); $p=$prm?_jrb($prm):[];
	if($mth)$ret=$app::$mth($p);}*/

#private
if($_SESSION['auth']>1 && !$ret)switch($app){
//art
case('tit'):req('meta,spe'); $s=480; $tt='meta:'.$id; 
	if(get('frm1'))save_tits_j($id); $ret=edit_tits($id,$va); break;
case('titsav'):req('art,pop,spe,mod,meta'); save_tits_j($id);//SaveTits
	$ret=art_read_d($id,$va,''); break;//$va=='rch'?'art'://read?
case('webread'):req('spe'); $ret=web_import($id,1); break;//json
case('websav'):req('spe'); $ret=art_import($id,$va); break;//from embdpop
case('reimport'):req('spe,art,pop,mod'); $ret=reimport($id,$va,$opt,$res); break;
case('recapart'):req('spe,art,pop,mod'); $ret=recapart($id,$va); break;
case('urlmeta'):req('spe'); $ret=art_import_meta($res); break;//meta
case('artedit'):req('spe,art'); $_SESSION['read']=$id;
	$ret=artform('',$id); $tt='edit:'.$id; $s=0; $p=$p1; break; 
case('addCat'):req('meta'); $ret=slct_category($id,$va,$opt); $t=nms(9); $s=440; break;
case('virtualfolder'):req('meta'); $ret=virtualfolder_slct($id,$va); $tt='folder'; $s=440; break;

/**/case('addArt'):req('art,spe'); $p=1;
	$ret=artform($id,''); if($va==1)$tt='Article'; $s=0; break;
case('saveart'):req('pop,spe,sav'); if($id)$msg=modif_art($va,$id);//old
	if($opt!='no')$ret=txarea1($msg); break;
case('saveart1'):req('pop,art,spe,sav'); $msg=''; if($id)$msg=modif_art($va,$id);
	$rj[]=txarea1($msg); $rj[]=read_msg($va,3); $ret=mkjson($rj); break;
case('saveart2'):req('pop,art,spe,sav'); if($id)$msg=modif_art($va,$id); $ret=read_msg($va,3); break;
case('newart'):req('art,pop,spe,mod,sav'); $ret=addart_new($id,$va,$res); break;

/*case('addArt'):req('art,spe'); $p=1; $rs=ajxg($res);
	$ret=artform($ts,''); if($id==1)$tt='Article'; $s=0; break;
case('saveart1'):req('pop,art,spe,sav'); $rs=ajxg($res); $msg=''; //if($rs)$msg=modif_art($id,$rs);
	$rj[]=txarea1($msg); $rj[]=read_msg($id,3); $ret=mkjson($rj); break;
case('saveart2'):req('pop,art,spe,sav'); $rs=ajxg($res);
	//if($rs)$msg=modif_art($id,$rs);
	 $ret=read_msg($id,3); break;
case('newart'):req('art,pop,spe,mod,sav'); $ret=addart_new($id,$res); break;*/

case('addurlsav'):req('pop,art,spe'); $ret=addart_sav($id,$va,$opt,$optb); break;
case('placeim'):$ret=placeim($id,$va); $tt=$id; break;
case('placeimdel'):req('pop'); $ret=placeimdel($id,$va); $tt=$id; break;
case('recenseim'):$ret=recenseim($id); break;
case('orderim'):$ret=orderim($id); break;
case('plan'):req('spe'); $ret=mk::plan($id,$va,$opt,$optb); $t='Plan'; break;
//wyg
case('wygopn'):req('pop,spe'); $ret=wygopn($id); break;
case('wygsav'):req('mod,pop,spe,art,sav'); $ret=wygsav($id,$va); break;
case('savwyg'):req('mod,pop,spe,art,sav'); $ret=savwyg($id,$va,1); break;

case('wygedt'):req('pop'); $d=codeline::parse($id,'','sconn'); $tt='wyg edit'; $s=640;
	$ret=lj('','txtarea_wygok_edt'.$va.'_23_'.$va,picto('save2')).' '; $rid=$opt?$opt:'edt'.$va;
	if(rstr(13))$d=embed_p($d); if(!$d)$d="\n";
	$ret=divedit($rid,'editarea justy','max-width:720px','',nl2br($d)); break;
case('wygok'):req('pop'); $ret=html2conn_b($id); break;
case('wygoff'):req('pop,art'); $ret=conn_edit('');
	$ret.=divd('txarea',txarea1(html2conn_b($id))); break;
//meta
case('autolang'):req('meta'); $ret=autolang($id,$va); break;
case('affectlangs'):req('meta'); $ret=affectlangs($id,$va); break;
case('chday'):req('meta'); $ret=edit_day($id,$va); break;
case('agenda'):req('meta'); $ret=search_date($id); break;
case('uploadj'):req('sav,pop'); $ret=upload_sav($id,$va,$opt); break;
case('upimg'):if($id)write_file('users/'.ses('qb').'/'.$va,base64_decode($id)); break;
case('metall'):req('meta'); $ret=meta_all($id,$va); $tt='metas'; $s=440; break;
case('slctfrm'):req('meta'); $ret=slct_frm($id,$va); break;
case('slctlang'):req('meta'); $ret=langslct($id,$va); break;
//read
case('readart'):req('pop,spe,mod,art'); //sleep(1); 
	$_SESSION['read']=$id; $ret=read_msg($id,3); break;
case('artsuj'):req('pop,spe,mod,art');
	$r[0]=sql('suj','qda','v',$id); $r[1]=read_msg($id,3); $ret=mkjson($r); break;
//batch
case('batch'):req('pop'); $ret=batch($id,$va); if(!$va)$t=$app; $s=550; break;
case('batchfbi'):$ret=batchfbi(); break;
case('batchprep'):$ret=batch_prep($id); break;
case('cmption'):req('spe,meta'); $ret=cmption_call($id,$va,$opt,$optb); if(!$optb)$t=$id; $s=440; break;
//admin
case('admarts'):req('admin,spe'); $ret=adm_articles($id,$va,$opt,$optb); break;
case('banslct'):req('admin,spe'); $ret=ban_dir($id); break;
case('bansav'):req('admin'); $ret=ban_sav($id); break;
case('admin'):req('admin,pop,spe'); $tt='admin'; $s=720; $ret=admin_call($id,$va,$opt); break;
case('admn'):req('spe'); $ret=m_admin_b(); break;
case('params'):$ret=rstr::show_params($id,$va); break;
case('rstr'):req('adminx'); $ret=rstr_sav($id); $t='rstr'; $s=100; break;
case('module'):req('adminx,spe'); $ret=config_mod($id,$va); $s=640; $tt='mod.'.$id; break;
case('modules'):req('adminx,spe'); $ret=master_config($id,$va,$opt,$res); break; 
case('modadd'):req('adminx,spe'); $ret=bar_add_mod($id); $s=640; $tt='new module'; break;
case('medit'):req('adminx'); $ret=mod_edit_j($id,$va,$opt,$optb); break;
case('submds'):req('adminx,spe'); $ret=submds($id,$va,$opt,$optb,$res); break;
case('comline'):req('adminx'); $ret=comline_edit($id,$va,$opt,$res); break;
case('modsee'):req('pop,spe,art,mod'); $t='module:'.$r[0]; $ret=modsee($id,$va); $s=720;
	if(!$ret)$ret=nmx([11,16]); break;
case('sqledt'):$ret=sqledt($id,$va,$opt,$res); $tt=$id; break;
//styl
case('saveclr'):req('styl'); $ret=save_clr_j($id); break;
case('styls'):req('styl'); $ret=styls($id,$va); break;
case('stylclr'):req('styl'); $ret=select_clr($id,$va); break;
case('stylsetclr'):req('styl'); $ret=mnu_line_bt($id,$va,$opt); break;
case('stylact'):req('styl'); $ret=css_actions($id,$va,$opt,$res); $toj=1; $tt=$id; break;
case('stylsav'):req('styl'); if(!$id)$id=$res; $ret=save_css_j($va,$id,$opt); break;
case('stylsff'):req('styl'); $ret=css_fontface($id,$va,$opt,$optb,$res,1); break;
case('ffedit'):req('styl'); $ret=preview_ff_edit($id,$va,$opt,$res); break;
case('setcond'):req('adminx'); $_SESSION['cond']=determine_cond($id); break;
case('clview'):req('admin'); $ret=clview($id,$va); break;
//msql
case('editmsql'):req('msql'); $ret=editmsql($id,$va,$opt,$optb); $tt=$id.'#'.$va; $s=550; break;
case('savmsql'):req('msql'); $r=edit_msql_sav($id,$va,$res); $_GET['def']=$va;
	if(!$opt)$ret=edit_microsql($id,$r); break;
case('delmsql'):req('msql'); $ret=edit_msql_del($id,$va); break;
case('dismsql'):req('msql'); $ret=edit_msql_displace($id,$va,$res); break;
case('msqledit'):req('msql'); $ret=medit_shot($id,$va,$opt,$res); $tt='edit'; break;
case('msqlops'):req('msql'); $ret=msql_ops($id,$va,$opt?$opt:$res,$optb); $tt='operations'; break;
case('msqlmodif'):req('msql'); list($dr,$nd,$n)=murl_vars($id); $d=ajxg($res); $d=delbr(deln($d),"\n");
	msql::modif($dr,$nd,trim(strip_tags($d)),'shot',$opt,$va);
	$ret=medit_shot_bt(nl2br(cutat($d)),$va,$opt,$id,$optb); break;
case('msql'):req('spe'); if($optb)$optb=':'.ajxg($optb); list($w,$h)=explode('-',$sz); $s=$w?$w:720;
	$url='/msql/'.($id=='lang'?$id.'/'.prmb(25):$id).'/'.$va.($opt?'_'.$opt.$optb:''); 
	$ret=iframe($url,$s-20,$h-40); if(!$ret)$ret=$url; $t='msql'; break;
//plugs
case('artstats'):$ret=plugin_func('stats','stat_graph','nbp',$id,$va); $t='stats'; break;
case('livestats'):$ret=plugin_func('stats','stat_live'); $t=$id; break;
//html
case('parent'):req('spe'); $ret=getparent($id); break;
case('formail'):$ret=tracks::formail($id,$res); break;
case('mktable'):$ret=mktc($id,$va,$opt,$res); break;
//sys
case('rebuild'):req('boot,spe,art'); $_SESSION['rqt']=[]; 
	$ret=cache_arts(1); $tt='cache'; $_SESSION['dayx']=time(); break;
case('reset'):req('boot'); reboot(); break;
//edit
case('codeline'):req('pop,art'); $ret=codeline::parse($id,'','codline'); break;
case('filters'):req('tri'); $ret=edit_filters($id,$va,$opt,$res); break;
case('backdel'):msql::modif('',$id,$va,$opt); $ret=navs('backup'); break;
case('backup'):msql::modif('',$va,[mkday(),$id],$opt); $ret=navs('backup',$id); break;
case('restore'):$v=msql::val($id,$va,$opt,1); $ret=txarea1($v); break;
}

#public
if(!$ret)switch($app){
//sys
case('login'):$ret=login::call($id,$va,$opt,$optb); break;
case('loged'):$ret=login::form($id,$va,$opt); $tt='login'; break;
case('ajxf'):$ret=$id($va,$opt,$optb,$res); $tt=$id; break;//blackhole
//readers
case('art'):req('pop,spe,art'); $ret=art_read_c($id,$va,$opt); break;
case('artone'):req('art,pop,spe'); $ret=art_read_b($id,$va,$opt); break;
case('artin'):req('art,pop,spe,mod'); $ret=art_read_d($id,$va,$opt); break;
case('artlook'):req('art,pop,spe,mod'); $ret=art_look($id,$va,$opt); $t=$va; $s=prma('content')+20; break;
case('popart'):req('pop,spe,art,mod,boot'); $p=$p1;
	$_SESSION['cur_div']='content'; deductions_from_read($id,'');
	if(auth(6))$p.=lj('','popup_metall___'.$id.'_3',picto('tag')).lj('','popup_tit___'.$id.'_3',picto('meta')).lj('','popup_artedit___'.$id.'___autosize',picto('edit')).lja('',atj('editart',$id),picto('editor')); 
	$t=suj_of_id($id); $s=prma('content')+20; $ret=art_read_b($id,3); break;
case('popartmod'):req('mod,spe,art,pop,boot'); deductions_from_read($id,''); define_modc();
	ses('read',$id); $ret=build_artmod($id); $tt=nms(39); $s=440; break;
case('ibarts'):req('mod,spe,art,pop'); $ret=ibarts_load($id,$va); break;
case('api'):req('art,pop,spe,mod'); $ret=api::call($id,$va,$opt,$optb); $tt=$id; $s=720; break;
case('apij'):req('art,pop,spe'); $ret=api::callj($id,$va,$opt); $tt='api'; $s=780; break;
case('apicom'): $ret=api::com($id); $tt=$app; $s=440; break;
case('modj'):req('mod,pop,art,spe'); $ret=modj($id,$va); break;
case('site'):list($w,$h)=explode('-',$sz); $w=cw(); $h=$h?$h-80:640;
	if($id)$go='?'.$id.'='.$va; $ret=iframe('index.php'.$go.'§'.($w+24).'/'.($h),''); 
	$t=$_SESSION['qb']; break;
case('ucom'):$ret='module/'.$id; if($va)$t=$va; break;
case('modpop'):req('pop,art,spe,mod'); $t=strend($id,':');
	$t=$t?$t:strprm($id,1); $tt=$t?$t:$id; $s=$va?$va:640; $ret=build_mod_r($id); break;
case('ajxlnk'):req('pop,spe,art,mod'); if($va)$_SESSION[$va]=$id;
	if($id!='close')$ret=build_mod_r($id); break;
case('ajxlnk2'):req('pop,spe,art,mod,boot'); $tt='load'; $s=640; $_GET[$id]=$va; 
	if($id=='read')deductions_from_read($va,''); define_frm(); define_condition(); 
	$ret=build_modules('content',''); break;
case('trknav'):req('pop,art,spe,mod'); $tt='Tracks'; $s=640;
	$ret=build_mods(['tracks',$id,$va,'',$opt,$optb]); break;
case('trkrch'):req('pop,art,spe,mod'); $ret=trkarts('',$va,'','',$id); break;
case('rssart'):req('pop,spe'); $t=$id; $s=640; $ret=balb('section',rss::art($id,$va,1)); break;
case('archives'):req('spe'); $ret=m_archives($id); break;
case('editbrut'):req('admin,spe'); if($va)admin_art_sav($id,$va); 
	$ret=admin_art_edit($va?$va:$id); break;
case('vacuum'):$ret=batch_preview($id); $tt=preplink($id); $s=prma('content'); break;
//content
case('convhtml'):req('spe'); $_GET['urlsrc']=host().'/'; $ret=html2conn_b($id); break;
case('convconn'):req('pop'); $ret=conn::parser(ajx($id,1),3,'test'); break;//wwig
case('iframe'):list($w,$h)=expl('-',$sz); $s=$w?$w:cw(); $_SESSION['popm']=lkt('',$id,pictxt('pdf',domain($id)));
	$ret=iframe($id,($s-20)); $tt=$va?$va:'iframe'; break;
case('facebook'):req('pop'); $t=preplink($id); $s=640; $ret=facebook_call($id); break;
case('webpage'):$t=preplink($id); $ret=plugin_func('suggest','sugg_import',$id); $s=640; break;
//case('twit'):$ret=twit::cache($id,$va); $tt=$id; $s=640; break;
case('twit'):$ret=twit::$id($va,$opt,$res); $tt=$id; $s=640; break;
case('sitewatch'):$ret=batch_preview($id); $tt=$id; $s=640; break;
//nav
case('search'):req('pop,spe,art,mod');
	$ret=search::home($id,$va,$opt,$res); $t=nms(24); $s=640; break;
case('words'):req('pop,spe,tri,meta'); $ret=u_words($id); $tt=nms(47); $s=440; break;
case('social'):req('art'); $ret=art_social($id); $tt=nms(47); $s=440; break;
//case('searched_words'):req('mod'); $ret=searched::look($id); $tt=nms(177); $s=440; break;
case('same_tags'):req('mod,pop,art,spe'); $tt=nms(187); $s=440;
	$ret=build_mod_r($id.'///scroll:same_tags'); break;
case('cluster_tags'):req('mod,pop,art,spe'); $tt=nms(187); $s=440;
	$ret=build_mod_r($id.'///scroll:cluster_tags'); break;
//tracks
case('track'):$ret=tracks::form($id,$va,$opt); $tt=$id>0?nms(21):nms(84); if($va)$tt=nms(91); break;
case('tracks'):req('pop,spe,art'); $ret=tracks::save($id,$va,$res); break;
case('trkread'):req('pop,spe,art'); $tt=nms(65); $s=550; $ret=tracks_one($id); break;
case('trktxt'):req('pop,spe,art'); $ret=tracks_txt($id); break;
case('trkpreview'):req('pop,spe,art'); $t=nms(65); $s=550; $ret=conn::read_b($id); break;
case('trckpop'):req('pop,spe,art'); $_SESSION['read']=$id; $t='Tracks'; $s=550;
	$ret=output_trk(read_idy($id,'ASC')); break;
case('trkedit'):req('pop,spe,art'); if($va)$ret=tracks::redit_sav($id,$va);
	else{$ret=tracks::redit($id,$va); $tt='reedit';} break;
case('allquotes'):req('pop,art,spe,tri'); $ret=allquotes($id); break;
case('quote'):req('pop,art,spe'); $ret=art_read_c($id,$va,$opt,$optb); break;
case('quotrk'):req('pop,art,spe'); $ret=quotrk($id,$va,$opt); break;
case('xltags'):req('pop,art,spe'); $ret=xltags($id,$va); break;
case('xltagslct'):req('pop'); $ret=xltag_slct($id); break;
case('slctconn'):req('pop,art,spe'); $ret=slct_conn($id,$va,$opt,$optb); $tt='apply_conn'; break;
case('applyconn'):req('pop,art,spe'); $ret=apply_conn($id,$va,$opt,$optb); break;

//conn
case('conn'):req('pop,spe,art,mod'); $ret=conn::read($id,$va,$opt); break;
case('conn2'):req('pop,spe,art,mod'); $ret=sql('msg','qdm','v','id='.$id); 
	$ret=conn::read($ret,'',$id,1); $ret=str_replace('</p>',"</p>\n",$ret); break;
case('popconn'):req('pop,spe,art,mod'); $ret=conn::parser($id,3,'test'); $t=$va; $s=720; break;
case('delconn'):$rt=sql('msg','qdm','v','id='.$id); 
	$rt=html_entity_decode($rt,true,$_SESSION['enc']);
	$ret=codeline::parse($rt,'','delconn'); $ret=clean_lines($ret); break;
case('navs'):$ret=navs($id,$va); $tt=$id; $s=500; break;
case('vmail'):reqp('mail'); $ret=vmail($id); $s=360; $tt='mail article '.$id; break;
case('extractid'):$ret=video::detect($id,$va,$opt,$optb); if(!$ret)$ret='['.$id.':video]'; break;
//medias
case('photo'):$ret=photo_screen($id,$va,$opt); break;
case('slider'):req('pop'); $ret=mk::slider_slct($va,$id,$opt); break;
case('chat'):$ret=plugin_func($app,$id,$va,$opt,$res); break;
case('chatxml'):$ret=plugin_func($app,$id,$va,$opt,$res); break;
//tags
case('editag'):req('meta'); $ret=editag($id,$va,$opt); break;
case('addtag'):req('meta'); $ret=addtag($id,$va,$opt,$optb); break;
case('deltag'):req('meta'); $ret=deltag($id,$va,$opt,$optb); break;
case('slctag'):req('meta'); $ret=slctag($id,$va,$opt); break;
case('savtag'):req('meta'); $ret=savtag($id,$va,$opt); break;
case('savtagall'):req('meta'); $ret=savtagall($id,$va,$opt); break;
case('deltagall'):req('meta'); $ret=deltagall($id,$va,$opt); break;
case('matchtag'):req('pop,spe,tri,art,meta'); $ret=match_tags($id,$va); break;
case('matchall'):req('pop,spe,tri,art,meta'); $rj=match_all($id,$va); $ret=mkjson($rj); break;
case('favs'):req('art'); $ret=favs_sav($id,$va,$opt); break;
//sys
case('offon'):$ret=offon($id); break;
case('nbp'):req('pop,spe'); $ret=nbp($id,$va); $tt='footnote #'.$id; $s=400; break;
case('export'):$ret=exportation($id,$va,$opt,$optb); $tt='export:'.$id; $s=440; break;
case('import'):$ret=import_get($id); break;
case('deploy'):$ret=plugin('deploy',$id); $tt=nms(28).': '.$id; $s=440; break;
//j
case('embed'):$ret=input2('',$id,40,'txtblc'); $tt=$va; break;
case('url'):$ret=mbd_url(); $tt='url'; break;
case('emdpop'):$ret=mbd_conn($id,$va,$opt,$optb); $tt=$id?$id:'edit'; $s=440; break;
case('menuder'):$ret=menuder_pop($id,$va,$opt,$optb); $tt='select'; $s=440; break;
case('hidden'):req('spe'); $ret=hidslct_j($id,$va,$res?ajxg($res):$opt,$optb); $tt=$va; $s=550; break;
case('chkj'):req('spe'); $ret=chkslct_j($id,$va,$res?ajxg($res):$opt,$optb); $tt=$va; $s=550; break;
//conn
case('text'):$ret=substr($id,0,4)=='bpop'?div(atc('twit').ats('display:block; min-width:440px;'),sesr('temp',$va)):$id; $tt='text'; $s=440; break;
case('image'):$ret=image($id.'?'.randid(),$va,$opt,$optb); break;
case('overim'):$ret=overim($id,$va); $t=$id;
	$p=lj('','popup_photo__x_'.ajx($id).'_'.$va.'_'.$opt,picto('popup')); break;
case('video'):list($w,$h)=expl('-',$sz); $s=is_numeric($w)?$w:prma('content'); $tt=$id;
	//$ret=video::reader($id,video::providers($id),$w?$w-60:'',$h,$pgu); 
	$ret=video::call($id,$id,$w,3,0); break;
case('popmp3'):req('pop'); $t=$id; $ret=audio($id); break;
case('popmp4'):req('spe'); $t=strend($id,'/'); $ret=video_html($id); break;
case('popim'):list($w,$h)=getimagesize($id); $ret=photo_screen($id,$w,$h,$sz); break;
case('poptxt'):$ret=nl2br(cleanmail(read_file($id))); $t=$id; $s=440; break;
case('popmsql'):$r=msql_read($id,$va,$opt,1); if($r)$ret=divtable($r,1); $t=$id; $s=440; break;
case('popread'):req('pop,spe'); $t='article'; $ret=read_msg($id,3); break;
case('popvideo'):req('pop,spe'); $t='video'; $ret=video_html($id); break;
case('poppdf'):req('pop'); $ret=pdfreader_j($id,$sz); $t=$va?$va:'pdf'; break;
case('channel'):req('pop,spe,art,mod'); $ret=channel($id,$va,$opt,$optb); break;
case('shop'):req('pop,spe,art,mod');
	$_SESSION['cart'][$id]+=1; $ret=m_pubart($_SESSION['cart'],'',''); break;
case('buildtable'):$ret=mkta($id,$va,$opt,$res); break;
case('vview'):req('pop,spe'); $ret=video_viewer($id,$va,$opt); break;
case('rssj'):req('pop,spe'); $ret=rss::call($id,$va); break;
case('rssjb'):req('pop,spe'); $ret=rss::home($id,$va); $tt='Rss'; $s=450; break;
//msql
case('msqladm'):req('msql'); $ret=msql_adm($id,$va); $tt='msql admin'; break;
case('msqlmenu'):req('msql'); $ret=msql_menu($id,$va,$opt,$optb); $t='select table'; $s=320; break;
case('msqlfind'):req('msql'); $ret=msql_find($id,$va,$opt,$res); break;
case('msqlcall'):$r=msql_read($id,$va,$opt); if(auth(6))$ret=msqbt($id,$va,$opt).' '; else $ret='';
	$ret.=btn('small',nl2br($optb!==false?stripslashes($r[$optb]):$r)); break;
case('msqlread'):$ret=msql::goodtable_b($id.'_'.$va.'_'.$opt.'§'.$optb.'|'.$optb);
	if($res){req('pop,spe,art'); $ret=conn::parser(stripslashes($ret));} break;
case('popmsqt'):$rt=msql_read($id,$va,$opt); if(is_array($rt))$rt=$rt[$optb?$optb:0];
	if(auth(6))$ret=msqbt($id,$va,$opt).' '; else $ret='';
	$ret.=nl2br(stripslashes($rt)); $tt=$va.' '.$opt.' '.$optb; $s=440; break;
case('msqlp'):$r=msql_read($id,$va,$opt); $t='help'; $s=550;
	if(is_array($r))$ret=divtable($r,1); else $ret=$r; break;
case('syshelps'):req('pop'); 
	if(auth(6))$b=lj('','popup_editmsql___lang/fr/helps*txts_'.ajx($id),picto('msql')).' '; 
	$ret=divc('small',conn::parser($b.helps($id))); break;
//plug
case('radio'):reqp('radio'); req('pop'); $ret=audio(radio_song($id,$va),$opt); break;
case('radioedit'):reqp('radio'); $ret=radio_edit($id,$va,$opt,$optb); break;
//os
case('desktop'):req('spe'); $tt=$id?$id:'Desktop'; $s=440;
	$ret=desktop_root($id,$va,$opt,$optb); break;//desktop_apps
case('desk'):req('spe'); $ret=desktop_ico($id); break;//menus
case('appread'):req('spe'); $ret=apps_read($id); $tt=$id; break;
case('deskbkg'):$ret=desk_css(); break;
case('deskload'):req('spe'); req('spe'); $ret=desktop_load($id); break;
case('deskoff'):req('pop,spe,art,mod,boot'); $_GET[$id]=$va; 
	$ret=implode('',build_blocks()); Head::add('csscode','#desktop{opacity:0;}'); break;
case('finder'):req('spe'); $ret=finder::home($id,$va); if($opt)$t='Finder'; break;
case('fifunc'):req('spe'); $ret=finder::$id($va,$opt,$res); $s=640; $tt=$id; break;
//sys
case('alert'):$ret=divc('',picto('alert').' '.$id); $t='Alert'; break;
case('about'):req('pop,spe'); $ret=conn::parser(helps('philum_pub_txt')); $tt=nms(80); break;
case('gooduser'):req('pop'); if(login::isgoodhubname($id))$ret=$id.'0'; else $ret=$id; break;
case('slctmod'):req('boot'); select_mods(yesnoses('slctm')?$id:''); break;
case('dsnav'):$ret=plugin('dsnav',$id,$va); break;
case('chkbx'):$ret=offon($id,$va); break;
//call
case('popbub'):req('spe,art,pop,mod'); $ret=bubs::root($id,$va); break;
case('plugin'):if($id)$ret=plugin($id,$va,$opt,$optb,$res); $tt=$id; $s=cw(); break;
case('plupin'):if($id)$ret=plugin($id,$va,$opt,$optb,$res); $t=$id; $s=cw(); $p=$p1; break;
case('plug'):$ret=plugin_func($id,$va,$opt,$optb,$res); $tt=$id; $s=cw(); break;
case('plup'):$ret=plugin_func($id,$va,$opt,$optb,$res); $t=$id; $s=cw(); $p=$p1; break;
case('app'):$ret=$id::$va($opt,$optb,$res); $tt=$id; $s=cw(); break;
case('obj'):$d=new $id($va,$opt); $ret=$d($optb,$res); $tt=$id; $s=cw(); break;
//special
case('umrec'):reqp($app); $ret=umrec_call($id,$va,$opt); $tt=$id; break;
//actions
case('lang'):putses('lang',$id); ses('lng',$id!='all'?$id:prmb(25)); break;
case('sesmake'):putses($va,$id); break;
case('session'):$ret=$_SESSION[$id]; break;
case('togses'):$ret=offon(yesnoses($id)); break;
case('tog'):$ret=yesnoses($id); break;
case('dev'):putses('dev',$id); setprog(); break;
case('jump'):$ret=divc('console',$id); $tt=$va?$va:$app; $s=400; break;
case('lj'):$ret=$lj($opt,$id,$va); $tt=$va; break;
case('ret'):$ret=$id; break;}

if($app=='call' or $app=='callp'){if($app=='callp')$tt=$va;
	if($res)list($s,$h)=opt($res,'-'); $s=is_numeric($s)?$s:640; 
	if($id)req(str_replace('-',',',$id));
	//$ret=call_user_func_array($va,[$opt,$optb,$res]);
	$ret=$va($opt,$optb,$res);}
if($app=='plup' or $app=='plupin')$p=lkt('','/plug/'.$id.'/'.$va,picto('url')).' ';

//if(!$ret && function_exists($app))$ret=$app([$id,$va,$opt,$optb,$res]);//error if !$ret

//if(strpos('art popart popartmod',$app))eye();//api apij
if($app=='popart')eye();
if(rstr(22)){req('boot'); block_crawls();}//crawl
//memtmp();//purge memtmp if unused

if($ppu)$t=$tt?$tt:$t;
if($pgu)$ret=pagup($t,$ret,$p);
elseif($t)$ret=popup($t,$ret,$s,$p);

/*if(Head::$add && !$toj){
Head::add('meta',['http-equiv','Content-Type','text/html; charset='.$_SESSION['enc']]);
echo Head::generate();}
elseif(!$toj)header('Content-Type:text/html; charset='.$_SESSION['enc']);*/
echo ($ret);//utf
mysqli_close($_SESSION['qr']);
?>