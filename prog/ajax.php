<?php
//philum_ajax_hangar
session_start();
error_report();
$_SESSION['onload']='';
if(!$_SESSION['stime']){req('boot,art,spe'); master_params('params/_'.$db,$qd,$aqb,$subd);
	define_hubs(); define_qb(); define_config(); time_system($cache);
	cache_arts(); define_cats_rqt(); define_condition(); define_clr();}
if(!$_SESSION['picto'])$_SESSION['picto']=msql_read('system','edition_pictos','',1);
$res=($_GET['res']); if(substr($res,-1)=='_')$res=substr($res,0,-1);
list($n,$id,$va,$opt,$optb)=ajxr($_GET['callj']); $sz=$_GET['sz']; $pp=$_GET['popup'];
$ar=array('plug'=>1,'plup'=>1,'plugin'=>1,'plupin'=>1,'titsav'=>1,'popbub'=>1,'call'=>1,'callp'=>1);
if(!$ar[$n])require_once('prog'.$b.'/ajxf.php');//

//ljb('','expand','',picto('expand')).' './/fsopen
function popbt($o){return ljb('','Close','popup',picto('close')).' '.ljb('','poprepos','',picto('ktop')).' '.ljb('','reduce','',picto('less')).' '.ljb('','fixelem','',picto('fix')).' '.$o.$_SESSION['popm'];}
//function popbt($o){return ljb('','Close','popup','&#9209;').' '.ljb('','poprepos','','&#9899;').' '.ljb('','reduce','','&#9650;').' '.ljb('','fixelem','','&#9660;').' '.$o.$_SESSION['popm'];}
function popa($t,$o='',$s=''){return div(atd('popa').atc('popa'),popbt($o).balb('small',ats('cursor:move;').atb('onmouseup','stop_drag(event); noslct(1);').atb('onmousedown','noslct(0);'),$t?etc($t,70):'popup'));}
function popup($t,$d,$w='',$p=''){if($w)$s='max-width:'.($w+16).'px;';
if($p==1)$p=lj('','page_deskbkg',picto('desktop')).' ';
if($p==2)$p=ljb('','pagrepos','',picto('expand')).' ';
$popa=popa($t,$p,$s); $_SESSION['popm']='';// onresize="poprepos()"
return div(atc('popup').ats($s).atb('onmouseup','stop_drag(event)'),$popa.div(atd('popu').atc('popu'),$d));}
function pagup($d){$x=ljb('','Close','popup',picto('close'));
return divc('popup',$x.divd('popu',$d));}

#private
if($_SESSION['auth']>1)switch($n){
//art
case("tit"):req('meta,spe'); $t='meta:'.$id; $s=480; 
	if($_GET['frm1'])save_tits_j($id); $ret=edit_tits($id,$va); break;
case("titsav"):req('art,pop,spe,mod,tri,meta'); save_tits_j($id); 
	$ret=art_read_d($id,'',$va,$opt); break;
case("urlsrc"):req('tri,spe'); $ret=art_import($res); break;//meta
case("artedit"):req('spe'); $ret=artedit($id); $t='edit:'.$id; $s=0; break;
case("artwedit"):req('spe'); $ret=artwedit($id); $t='wyswyg'; $s=prma('content'); break;//req('spe'); 
case("addCat"):req('meta'); $ret=slct_category($id,$va,$opt); $t=nms(9); $s=440; break;
case("addfolder"):req('meta'); $ret=slct_folder($id); $t='folder'; $s=440; break;
case("addArt"):req('art,tri,spe'); $_GET['continue']=''; $p=1;
	$ret=f_inp("",$id); if($va==1)$t='Article'; $s=550; break; 
case("saveart"):req('tri,pop,spe,sav'); $msg=modif_art($va,$id); 
	if($opt!='no')$ret=txarea1($msg); break;
case("newart"):req('art,pop,tri,spe,mod,sav'); $ret=addart_new($id,$va,$res); break;
case("addurlsav"):req('pop,art,tri,spe'); $ret=addart_sav($id,$va,$opt,$optb); break;
case("placeim"):$ret=placeim($id); break;
case("recenseim"):$ret=recenseim($id); break;
//meta
case("autolang"):req('meta'); $ret=lang_arts_auto($id,$va); break;
case("chday"):req('meta'); $ret=edit_day($id,$va); break;
case("upload"):$ret=plugin('upload',$id,$va); break;
case("upimg"):if($id)write_file('users/'.ses('qb').'/'.$va,base64_decode($id)); break;
//meta::new
case("metall"):req('meta'); $ret=meta_all($id); break;
case("editag"):req('meta'); $ret=edit_tags($id,$va,$opt); break;
case("addtag"):req('meta'); $ret=addtag($id,$va,$opt,$optb); break;
case("deltag"):req('meta'); $ret=deltag($id,$va,$opt,$optb); break;
case("slctag"):req('meta'); $ret=slctag($id,$va,$opt); break;
case("savtag"):req('meta'); $ret=savtag($id,$va,$opt); break;
case("matchtag"):req('pop,tri,spe,meta'); $ret=match_tags($id,$va); break;
case("slctfrm"):req('meta'); $ret=slct_frm($id,$va); break;
//read
case("readart"):sleep(1); req('pop,spe,mod,tri,art'); 
	$_GET["continue"]=1; $_SESSION["read"]=$id; $ret=read_msg($id,3); break;
//batch
case("batch"):req('tri,pop'); $ret=batch($id,$va); if(!$va)$t=$n; $s=550; break;
case("batchfbi"):req('tri'); $ret=batchfbi(); break;
case("batchprep"):req('tri'); $ret=batch_prep($id); break;
case("cmption"):req('spe,meta'); $ret=cmption_call($id,$va,$opt,$optb); if(!$optb)$t=$id; 
	$s=440; break;
//admin
case("banslct"):req('admin,spe'); $ret=ban_dir($id); break;
case("bansav"):req('admin'); $ret=ban_sav($id); break;
case("admin"):req('admin,pop,spe,tri'); if($id=='newsletter')req('mod,art');
	$ret=admin_call($id,$va,$opt); break;
case("admn"):req('spe'); $ret=m_admin_b(); break;
case("update"):req('admin'); $ret=update_ok(); $t=nms(59); $s=400; break;
case("params"):req('adminx,spe'); $ret=show_params($id,$va); break;
case("rstr"):req('adminx'); $ret=rstr_sav($id); $t='rstr'; $s=100; break;
case("module"):req('adminx,tri,spe'); $ret=config_mod($id,$va); $tt='mod.'.$id; break;
case("modules"):req('adminx,tri,spe'); $ret=master_config($id,$va,$opt,$res); break; 
case("modadd"):req('adminx,tri,spe'); $ret=bar_add_mod($id); $tt='new module'; break;
case("medit"):req('adminx'); $ret=mod_edit_j($id,$va,$opt,$optb); break;
case("submds"):req('adminx,spe'); $ret=submds($id,$va,$opt,$optb,$res); break;
case("comline"):req('adminx'); $ret=comline_edit($id,$va,$opt,$res); break;
case("modsee"):req('pop,spe,art,tri,mod');
	$r=msql_read('users',$_SESSION['modsnod'],$id,1); $rb=array_shift($r);
	$t='module:'.$r[0]; $ret=$va?modsee($r):build_mods($r); $s=720;
	if(!$ret)$ret=nms(11).' '.nms(16); break;
//styl
case("saveclr"):$ret=save_clr_j($id); break;
case("styls"):req('styl'); $ret=styls($id,$va); break;
case("stylsav"):req('styl'); if(!$id)$id=$res; $ret=save_css_j($va,$id,$opt); break;
case("stylsff"):req('styl'); $ret=css_fontface($id,$va,$opt,$optb,$res,1); break;
case("stylsfb"):req('styl'); $ret=css_fontface($id,$va,$opt,$optb,$res,0); break;
case("ffedit"):req('styl'); $ret=preview_ff_edit($id,$va,$opt,$res); break;
case("setcond"):req('adminx'); $_SESSION['cond']=determine_cond($id); break;
case("clview"):req('admin,tri'); $ret=clview($id,$va); break;
//msql
case("editmsql"):req('admin'); $ret=edit_msql_j($id,$va,$opt,$optb); break;
case("savmsql"):req('admin,msql'); $r=edit_msql_sav($id,$va,$res); $_GET['def']=$va;
	if(!$opt)$ret=edit_microsql($id,$r); break;
case("delmsql"):req('admin,msql'); $r=edit_msql_del($id,$va); $ret=edit_microsql($id,$r); break;
case("msqledit"):req('msql'); $ret=medit_shot($id,$va,$opt,$optb,$res); $tt='edit'; break;
case("msqlmodif"):msql_modif($id,$va,ajxg($res),$optb,'shot',$opt); $ret=nl2br(ajxg($res)); break;
case("msql"):req('spe'); if($optb)$optb=':'.ajxg($optb); list($w,$h)=explode('-',$sz);
	$url='/msql/'.($id=='lang'?$id.'/'.prmb(25):$id).'/'.$va.($opt?'_'.$opt.$optb:''); 
	$ret=iframe($url,$w-20,$h-40); if(!$ret)$ret=$url; $t='msql'; $s=$w?$w:720; break;
//plugs
case("favs"):req('mod'); $ret=vfavs_sav($id); break;
case("artstats"):$ret=plugin_func('stats','stat_graph','nba',$id,'400_40_'.$va); 
	$t='stats'; break;
case("livestats"):$ret=plugin_func('stats','stat_live'); $t=$id; break;
case("slider"):require('plug/slider.php'); $ret=slider_build($id,$va,$opt); break;
case("radio"):req('pop'); $ret=audio(radio_song($id,$va),$opt); break;
case("radioedit"):require('plug/radio.php'); $ret=radio_edit($id,$va,$opt,$optb); break;
case("radiosav"):require('plug/radio.php'); $ret=radio_edit($id,$va,$opt); break;
//html
case("menuder"):$ret=menuder_pop($id,$va,$opt,$optb); $t='select'; $s=440; break;
case("hidden"):req('spe'); $ret=hidslct_j($id,$va,$res?ajxg($res):$opt,$optb); $tt=$va; $s=550; break;
case("formail"):$ret=plugin_func('tracks','formail',$id,$res); break;
//sys
case("rebuild"):req('boot,spe,art'); $_SESSION['rqt']=''; $_GET['refresh']=1; 
	$ret=cache_arts(); $t='cache'; break;
//edit
case("codeline"):req('pop,art,tri'); $ret=correct_txt($id,"",'codline'); break;
case("filters"):req('tri'); $msg=$id;
	if($va=='cleanbr')$rt=clean_br($id);
	if($va=='cleanmail')$rt=convertmail($id);
	if($va=='cleanpunct')$rt=clean_punct($id); $rt=clean_punct_b($rt);
	if($va=='converthtml'){$rt=converthtml(nl2br($id)); $rt=repair_post_treat($rt);}
	if($va=='easytables')$rt=str_replace('¬','¬'."\n",$id);
	if($va=='addlines')$rt=add_lines($id);
	if($va=='addanchors')$rt=add_anchors($id);
	if($va=='deltables')$rt=del_tables($id);
	if($va=='delqmark')$rt=del_qmark($id);
	if($va=='imglabel')$rt=add_comments($id);
	if($va=='oldconn'){req(pop); $rt=retape('<br>'.$id,'');}
	if($va=='replace'){list($rep,$by)=ajxr($res); $rt=str_replace($rep,$by,$id);}
	//if($va=='table'){$rt=ajxg($res);}
	if($va=='randim'){$_POST['randim']=1; $_GET['continue']=1; $read=$_SESSION['read'];
		$id=mysql_real_escape_string(stripslashes($id));
		if(is_numeric($read))update('qdm','msg',$id,'id',$read);
		req('spe'); req('pop'); $ret=format_txt($id,3,$read);
		$rt=sql('msg','qdm','v','id='.$read);}
	if($va=='revert')$rt=sql('msg','qdm','v','id='.$_SESSION['read']);
	if($va=='postreat')$rt=post_treat_batch($id,$va,$opt);
	$ret=txarea1($rt); break;
case("backup"):$optb=sql('msg','qdm','v','id='.$_SESSION['read']); //$t='backup';
	modif_vars('users',$id,$opt?$opt:array($optb),$va); $ret=navs('backup'); break;
case("restore"):$ret=txarea1(stripslashes(msql_read($id,$va,$opt))); break;
}

#public
switch($n){
//sys
case("login"):req('pop,tri'); $ret=login($id,$va,$opt,$optb); break;
case("loged"):req('pop'); $ret=loged($id,$va,$opt); if($optb)$t='login'; break;
//readers
case("art"):req('pop,spe,art,tri'); $ret=art_read_c($id,$va,$opt); break;
case("artone"):req('art,pop,spe,tri'); $ret=art_read_b($id,'',$va,$opt); break;
case("load"):req('art,pop,spe,tri'); $ret=play_arts('','','',$id); break;
case("popart"):req('pop,spe,art,tri,mod,boot'); //$_SESSION['read']=$id;
	$_SESSION['cur_div']='content'; deductions_from_read($id,''); $p=2;
	if(auth(6))ses('popm',lj('','popup_tit___'.$id,picto('tag')).' '.lj('','popup_artedit___'.$id,picto('edit'))); $t=suj_of_id($id); $s=prma('content')+20;
	$nl='nlpop'; $ret=art_read_b($id,'',3,''); break;
case("popartmod"):req('mod,spe,art,pop,tri,boot'); deductions_from_read($id,'');
	$ret=build_art_mod(''); $t=nms(39); $s=440; break;
case("divcontent"):req('pop,spe,art,tri,mod,boot'); 
	$_GET[$id]=$va; $ret=build_content(); break;
case("getcontent"):req('pop,spe,art,tri,mod'); $_GET[eradic_acc($id)]=$va;
	if(is_numeric($opt))$_GET['dig']=$opt; elseif($opt)$_GET[$opt]=$optb; 
	$_SESSION['load']=define_load(); $tt=$id.':'.$va; $s=prma('content');
	$ret=output_load($_SESSION['load'],slct_media()); break;
case("modj"):req('mod,pop,art,spe,tri'); $ret=modj($id,$va); break;
case("site"):list($w,$h)=explode('-',$sz); $w=currentwidth(); $h=$h?$h-80:640;
	if($id)$go='?'.$id.'='.$va; $ret=iframe('index.php'.$go.'§'.($w+24).'/'.($h),''); 
	$t=$_SESSION['qb']; break;
case("ucom"):$ret='module/'.$id; if($va)$t=$va; break;
case("modpop"):req('pop,spe,art,tri,mod'); $t=strprm($id,1); 
	$t=$t?$t:strrchr_b($id,':'); $t=$t?$t:$id; $s=$va?$va:640; $ret=build_mod_r($id); break;
case("ajxlnk"):req('pop,spe,art,tri,mod');
	$_SESSION[$va]=$id; if($id!='close')$ret=build_mod_r($id); break;
case("ajxlnk2"):req('pop,spe,art,tri,mod,boot');
	if($id=='art'){deductions_from_read($va,$cache); define_condition();}
	if($id=='one')$ret=build_mod_r($va); else $ret=build_modules('content',''); break;
case("rssart"):req('pop,tri,spe'); $t=$id; $s=640; $ret=rss_art($id,$va,1); break;
case("archives"):req('spe'); $ret=m_archives($id); break;
case("editbrut"):req('admin,spe'); if($va)admin_art_sav($id,$va); 
	$ret=admin_art_edit($va?$va:$id); break;
//content
case("webpage"):require('plug/suggest.php');
	$t=preplink($id); $ret=suggest_import($id); break;
case("convhtml"):req('spe,tri'); $_GET['urlsrc']=host().'/'; $ret=convhtml_b($id); break;
case("convconn"):req('pop,tri');//wwig
	$ret=format_txt_r(ajx($id,1),3,'test'); break;
case("iframe"):$s=strdeb($res,'-'); $s=is_numeric($s)?$s:720; 
	$s=$s>prma('content')?prma('content'):$s; $ret=iframe($id,($s-20)); $t=$va; break;
//case("inframe"):$ret=inframe($id,$va,$opt,$optb); break;
//nav
case("search"):req('pop,spe,art,tri,mod'); require('plug/search.php'); 
	$ret=plug_search($id,$va,$opt,$res); $t=nms(24); $s=640; break;
case("words"):req('pop,spe,tri,meta'); $ret=u_words($id); $t=nms(47); $s=440; break;
//case("meta"):req('pop,spe,tri,meta'); $ret=u_words($id); $t=nms(47); $s=440; break;//
//tracks
case("track"):req('pop,spe'); $ret=plugin_func('tracks','f_inp_track',$id,$va);
	if(substr($id,0,4)=='wall')$t=nms(29); //$s=440;
	else $t=$id>0?nms(21):nms(34).' '.nms(36).' '.$id; break;
case("tracks"):req('pop,spe,art,tri'); $id=(convhtml_b(nl2br($id),1)); //ajx()
	reqp('tracks'); $ret=save_track($id,$va,$opt,$optb); break;
case("trkpreview"):req('pop,spe,art,tri'); $t=nms(65); $s=550;
	$msg=miniconn(del_n($id),2,'test'); 
	$ret=divc('track',correct_txt($msg,'','sconn')); break;
case("trckpop"):req('pop,spe,art,tri'); $_SESSION['read']=$id; $t='Tracks';
	$ret=divs('width:550px;',output_trk(read_idy($id,"DESC"))); break;
case("trkedit"):req('pop,spe,art,tri');
	if($va)$ret=plugin_func('tracks','trk_redit_sav',$id,$va);
	else{$ret=plugin_func('tracks','trk_redit',$id,$va); $t='reedit';} break;
//conn
case("conn"):req('pop,spe,art,tri,mod'); $ret=format_txt_r($id,$va,$opt); break;
case("conn2"):req('pop,spe,art,tri,mod'); $ret=sql('msg','qdm','v','id='.$id); 
	$ret=format_txt($ret,'nl',$id); $ret=str_replace('</p>',"</p>\n",$ret); break;
case("delconn"):req('tri'); $rt=sql('msg','qdm','v','id='.$id); 
	$rt=html_entity_decode($rt,true,$_SESSION['enc']);
	$ret=correct_txt($rt,'','delconn'); $ret=clean_firstspace($ret); break;
case("navs"):$ret=navs($id); if(!$va)$tt=$id; $s=500; break;
case("vmail"):$ret=vmail($id); $t='mail article:'.$id; $s=320; break;
case("vmailsend"):req('pop,spe,tri,mod'); $ret=vmailsend($id,$res); break;
case("extractid"):req('tri'); $ret=auto_video($id,$va,$opt,$optb); break;
//medias
case("gallery"):$ret=plugin('gallery',$id); $t='gallery'; break;
case("photo"):$ret=photo_screen($id,$va,$opt,$optb); break;
case("viewer"):$ret=photo_viewer($id,$va,$opt,$optb); break;
case("chat"):$ret=plugin_func($n,$id,$va,$opt,$res); break;
case("chatxml"):$ret=plugin_func($n,$id,$va,$opt,$res); break;
//sys
case("offon"):$ret=offon($id); break;
case("nbp"):req('pop,spe,tri'); $ret=nbp($id,$va); $t='footnote #'.$id; $s=400; break;
case("export"):$ret=exportation($id,$va,$opt,$optb); $t='export:'.$id; $s=440; break;
case("deploy"):$ret=plugin('deploy',$id); $t='deployement: '.$id; $s=440; break;
//j
case("embed"):$ret=input2('text','" size="40',$id,'txtblc'); $tt=$va; break;
case("url"):$ret=mbd_url(); $tt='url'; break;
case("emdpop"):$ret=mbd_conn($id,$va,$opt); $tt=$id?$id:'edit'; break;
//conn
case("text"):$msg=substr($id,0,4)=='bpop'?sesr('temp',$va):$id; $t=$va;
	$ret=divb($opt.'||'.$optb.' max-width:440px;',$msg); break;
case("image"):$ret=image($id,$va,$opt,$optb); break;
case("overim"):$ret=overim($id,$va); $t=$id; break;
case("video"):req('pop,spe'); list($w,$h)=explode('-',$sz); $s=$w;
	$ret=video_auto($id.'§'.$w.'/'.$h,'','',3); $t=$id; break;
case("popflv"):req('pop'); $ret=jwplayer($id,$va); $t='flv_video'; break;
case("popmp3"):req('pop'); $t=$id;
	$ret=embed_flsh_obj('fla/mp3.swf',300,40,'soundFile='.$id); break;
case("popim"):list($w,$h)=getimagesize($id); $ret=photo_screen($id,$w,$h,$res); break;
case("poptxt"):req('tri'); $ret=nl2br(convertmail(read_file($id))); $t=$id; $s=440; break;
case("popmsql"):$r=msql_read($id,$va,$opt,1); p($r); if($r)$ret=make_divtable($r,1); $t=$id; $s=440; break;
case("popread"):req('pop,spe,tri'); $t='article'; $ret=read_msg($id,3); break;
case("popvideo"):req('pop,spe,tri'); $t='video'; $ret=jwplayer($id,400); break;//
case("poppdf"):$ret=pdfreader_j($id,$va); break;
case("swf"):req('pop'); $t='swf'; $ret=embed_flsh($id,$va,$opt,''); break;
case("galj"):req('pop'); $ret=gallery_j_slct($va,$id,$opt); break;
case("channel"):req('pop,spe,art,tri,mod'); $ret=channel($id,$va,$opt,$optb); break;
case("shop"):req('pop,spe,art,mod');
	$_SESSION['cart'][$id]+=1; $ret=m_pubart($_SESSION['cart'],'',''); break;
case("mktable"):$ret=$id?mktc($id,$va,$opt,$res):mktb($id,$va,$res); break;
case("vview"):req('pop,spe'); $ret=video_viewer($id,$va,$opt); break;
case("rssj"):req('pop,tri,spe'); $ret=rssin($id,$va); break;
case("rssjb"):req('pop,tri'); $ret=rssj($id,$opt); if($va)$t='Rss'; $s=450; break;
//msql
case("msqlmenu"):req('msql'); $ret=msql_menu($id,$va,$opt,$optb); $t='select table'; $s=320; break;
case("msqlfind"):req('msql'); $ret=msql_find($id,$va,$opt,$res); break;
case("msqlcall"):$r=msql_read($id,$va,$opt); if(auth(6))$ret=msqlink($id,$va,$opt).' ';
	$ret.=$optb!==false?stripslashes($r[$optb]):$r; break;
case("msqlread"):$ret=msq_goodtable($id.'_'.$va.'_'.$opt.'_'.$optb.'§'.$optb);
	if($res){req('pop,spe,art,tri'); $ret=format_txt_r(stripslashes($ret),'','');} break;
case("popmsqt"):$rt=msql_read($id,$va,$opt); if(is_array($rt))$rt=$rt[$optb?$optb:0];
	if(auth(6))$ret=msqlink($id,$va,$opt).' ';
	$ret.=nl2br(stripslashes($rt)); $t=$va.' '.$opt.' '.$optb; $s=440; break;
case("msqlp"):$r=msql_read($id,$va,$opt); $t='help'; $s=550;
	if(is_array($r))$ret=make_divtable($r,1); else $ret=$r; break;
case("syshelps"):req('pop,tri'); 
	if(auth(6))$b=lj('small','popup_msql__3_lang_helps_txts_'.ajx($id),$id).' '; 
	$ret=divc('small',format_txt_r($b.helps($id),'','')); break; 
//os
case("desktop"):req('spe'); $ret=desktop_root($id,$va,$opt,$optb); $t=$va?$va:'Desktop'; $s=400;break;
case("desk"):req('spe'); $ret=desktop_ico($id); break;//menus
case("deskbkg"):$ret=desk_css(); break;
case("deskload"):req('spe'); req('spe'); $ret=desktop_load($id); break;
case("deskoff"):req('pop,spe,art,tri,mod,boot'); $_GET[$id]=$va; 
	$ret=implode('',build_blocks()); break;
case("finder"):req('finder,spe'); $ret=finder($id,$va); if($opt)$t='Finder'; break;
case("fifunc"):req('finder,spe'); $ret=call_user_func($id,$va,$opt,$res); if($optb)$t=$id; break;
//sys
case("alert"):$ret=divc('',picto('alert').' '.$id); $t='Alert'; break;
case("about"):req('pop,tri,spe'); $ret=philum_pub(); $t=nms(80); break;
case("gooduser"):req('pop'); if(isgoodhubname($id))$ret=$id.'0'; else $ret=$id; break;
case("slctmod"):req('boot'); select_mods(yesnoses('slctm')?$id:''); break;
case("dsnav"):$ret=plugin('dsnav',$id,$va); break;
case("chkbx"):$ret=offon($id); break;
//call
case("popbub"):req('bubs,spe'); $ret=bub_root($id,$va); break;
case("plugin"):if($id)$ret=plugin($id,$va,$opt,$optb,$res); break;
case("plupin"):if($id)$ret=plugin($id,$va,$opt,$optb,$res); $t='/plug/'.$id;
	$s=$id=='iframe'?720:550; $p=2; break;
case("plug"):$ret=plugin_func($id,$va,$opt,$optb,$res); break;
case("plup"):if($optb>200 && $optb<1000){$s=$optb; $optb='';} else $s=550; $p=2;
	$ret.=plugin_func($id,$va,$opt,$optb,$res); $t='/plug/'.$id; break;
case("openapp"):$ret=openapp($id,$va,$opt); $t=$id; break;
case("sesmake"):if(forbidden_sessions($va))$_SESSION[$va]=$id; break;
case("session"):$ret=$_SESSION[$id]; break;
case("togses"):$ret=offon(yesnoses($id)); break;
case("tog"):$ret=yesnoses($id); break;
case("jump"):$ret=$id; if($va)$t=$va; break;
case("lj"):$ret=$lj($opt,$id,$va); $tt=$va; break;}

if($n=='call' or $n=='callp'){if($n=='callp')$t=$va;
	if($res)list($s,$h)=split('-',$res); $s=$s?$s:640; 
	if($id)req(str_replace('-',',',$id));
	$ret=call_user_func_array($va,array($opt,$optb,$res));}

$eye=array('art','popart','popartmod');
if($eye[$n])eye();

if($tt && $pp)$t=$tt;
if($t=='pagup')$ret=pagup($ret);
elseif($t)$ret=popup($t,$ret,$s,$p);
//
if(Head::$add){
Head::add('meta',array('http-equiv','Content-Type','text/html; charset='.$_SESSION['enc']));
echo Head::generate();}
else header('Content-Type:text/html; charset='.$_SESSION['enc']);
echo utf($ret);
mysql_close();
?>