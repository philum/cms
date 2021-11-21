<?php
//philum_mods

#modules
function find_mod($n){
foreach($_SESSION['mods'] as $k=>$v)if(key($v)==$n)return $v;}

function build_mod_r($set){$ret='';
if(is_numeric($set)){$r=msql::row('',nod('mods_'.prmb(1)),$set);
	if($r)array_shift($r); return build_mods($r);}
else $r=val_to_mod($set);
$_SESSION['cur_div']='content';
foreach($r as $k=>$v)$ret.=build_mods($v);
return $ret;}

//param/title/command/option:module[,]
function val_to_mod($d){$r=explode(',',$d);
$t='';$cmd='';$o='';$ch='';$hd='';$tp='';$br='';$dv='';$aj='';$pop='';
foreach($r as $k=>$v){list($val,$conn)=split_right(':',$v,1);
	if(strpos($val,'*')!==false)$val=str_replace('*','/',$val);
	if(strpos($val,'/')!==false){$rb=explode('/',$val);
		list($val,$t,$cmd,$o,$ch,$hd,$tp,$br,$dv,$aj)=vals($rb,[0,1,2,3,4,5,6,7,8,9]);}
	$ret[]=[$conn,$val,$t,'',$cmd,$o,$ch,$hd,$tp,$br,$dv,$aj,$pop];}
return $ret;}

function build_modules($va,$cr){
$r=sesr('modc',$va); $_SESSION['cur_div']=$va; $ret='';
if($r)foreach($r as $k=>$v){if(!$v[7]){//hide
	if($v[6]){//cache
		if(!sesr('tab',$k) or $cr){$re[$k]=build_mods($v); 
			$_SESSION['tab'][$k]=$re[$k];}
		else $re[$k]=$_SESSION['tab'][$k];}
	elseif(!empty($v[11]))$re[$k]=divd('mod'.$k,lj('txtcadr','mod'.$k.'_modj___'.$k.'_'.$va,$v[2]));
	elseif(!empty($v[12]))Head::add('jscode',sj('popup_modpop___'.$k));
	else $re[$k]=build_mods($v);
if($re[$k])$ret.=$re[$k]."\n";}}
$_SESSION['cur_div']='content';
return $ret;}

function build_mods($r){
$pbdy_css='panel'; $smcss='small'; $lin=[]; $load=[]; $api=''; $ret=''; $prw=''; $id=''; $obj='';
//mod,param,title,condition,command,option,(bloc),hide,template,nobr,div,ajxbtn
list($m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr,$dv,$pv)=arr($r,12);
$t=stripslashes($t);
if($pv && auth(6) or !$pv)
switch($m){
//main
case('LOAD'):if($_SESSION['read'])$ret=art_read($tp);
	else $ret=api::arts($_SESSION['frm'],$o,$tp); break;
case('article'): $_SESSION['read']=$p; $ret=art_read($tp); break;
case('Page_titles'):$ret=page_titles($o); break;
case('All'):$api=api::arts_rq($p,$o); $api['t']=$t?$t:nms(100); break;
case('category'):if($p==1 && $_SESSION['frm']=='Home')$p='All'; 
	$ret=api::arts($p,$o,$tp); break;
case('Board'):$ret=collect_board($p); break;
case('plan'):$ret=arts_plan($m,$p,$o); break;
case('Hubs'):$ret=arts_plan($m,$p,$o); break;
case('gallery'):$ret=arts_plan($m,$p,$o); break;
case('tracks'):$ret=trkarts($p,$t,$d,$o); break;//api::tracks($t)
case('trkrch'):$ret=trkrch($p); break;
case('MenusJ'):$ret=ajxlink($p,'mjx',$o,$d); break;
//case('Wall'):$ret=wall_arts($t,$p); break;
//case('api'):$ret=plugin('apicom',str_replace(';',',',$p),$o); break;
case('api'):$ret=api::call(str_replace(';',',',$p),$o); break;
case('api_mod'):$api=api::defaults_rq(explode_k(str_replace(';',',',$p),',',':')); break;//:,
case('api_arts'):$api=api::mod_arts($p,$t,$tp); if($d=='panel')$api['cmd']=$d; $api['cols']=$o; break;
case('articles'):$load=api::mod_arts_row($p); $obj=1; break;
//case('articles'):$api=api::mod_rq($p.'&t=x'); break;//&=
case('tab_mods'):$ret=tab_mods($p); break;
case('last'):$ret=art_read_b('last',3); break;
case('cover'):$ret=mod_cover($p,$o,$tp); break;//:,
case('player'):$ret=flash_prep('',$p); break;
case('friend_art'):$ret=friend_art($o); break;
case('friend_rub'):$ret=friend_rub($o); break;
case('related_arts'):$load=related_art($p); break;
case('related_by'):$load=related_by($p); break;
case('child_arts'):$load=child_art($p); break;
case('parent_art'):$load=parent_art($p); break;
case('prev_next'):$ret=prevnext_art($d,$p,$o); break;
case('cat_arts'):$p=$p!=1?$p:$_SESSION['frm']; $t=$t!=$m?$t:$p;
	$load=tri_rqt($p,1); break;
case('priority_arts'):$load=tri_rqt($p,'lu'); $t=$t!=$m?$t:$p; break;
case('recents'):$load=recents_arts($p,$o); $obj=1; break;
case('read'):$ret=divc($o,read_msg($p,3)); break;
case('popart'):$ret=pop_art($p); break;
case('pub_art'):$ret=pub_art_b($p,$t,$o); break;
case('pub_arts'):$load=array_flip(explode(' ',$p)); break;
case('pub_img'):$ret=pub_img($p); break;
case('taxo_arts'):$load=taxo_arts($p); if($t>1)$t=suj_of_id($t); break;
case('taxo_nav'):$ret=plugin('taxonav',$p,$o); break;
case('read_art'):$ret=read_art($p,$t,$o); $t=''; break;
case('short_arts'):$load=short_arts($p); if($o<=3)$prw=$o; break;
case('most_read'):$ret=most_read_mod($p,$t,$d,$o,$m,$tp); $t=''; break;
case('most_polled'):$load=most_polled($p,$o); break;
case('score_datas'):$load=score_datas($p,$o); break;
case('same_title'):$load=same_title($p); break;
case('deja_vu'):$load=ses('mem'); break;
//com
case('context'):$ret=call_context($p); break;
case('rss_input'):if($p)$ret=rss::call(ajx($p,1)); break;
case('disk'):require_once('ajxf.php'); $_SESSION['dlmod']=$p;if($p && $p!='/')$pb='/'.$p;
	$ret=divd('dsnavds',ds_nav('dl','users/'.ses('qb').$pb)); break;
case('finder'):$ra=['|','-']; $p=str_replace($ra,'/',$p); $o=str_replace($ra,'/',$o);
	$ret=finder::home($p,$o,$d); break;
case('channel'):$ret=plugin('channel',$p,$t,$d,$o); $t=''; break;
case('hour'):timelang();//%A%d%B%G%T
	if($p)$dat=strftime($p?$p:'%y%m%d:%H%M',$_SESSION['dayx']); else $dat=mkday('',1);
	if(!$d)$ret=btn($o,$dat); else $ret=divc($o,$dat); break;
case('cart'):$ret=lkc('txtcadr','/?plug=cart',$p!=1?$p:'Cart');
	$ret=divd('cart',m_pubart($_SESSION['cart'],'scroll',7)); break; 
case('video'):$ret=video::any($p,'',3,''); break;
case('video_viewer'):$ret=videoboard($p,$c,$o); break;
case('conn_playlist'):$api=api::arts_rq('',''); $api['media']=$p; $api['t']=$t; break;
case('api_chan'):$ret=mod_apichan($p,$t,$o,$tp); break;
case('special_polls'):$ret=special_polls($p,$t,$o); break;
case('quality_stats'):$ret=quality_stats($p,$t,$o); break;
//txt
case('text'):$ret=stripslashes(urldecode($p)); if($o)$ret=divc($o,$ret); break;
case('clear'):$ret=divc('clear',''); break;
case('hr'):$ret='<hr'.atc($p).' />'; break;
case('br'):$ret=br(); break;
case('connector'):if($t)$ret=build_titl('',$t);
	if($o=='article')$ret.=balc('article','justy',conn::read($p,'',''));
	else $ret.=conn::read($p,'',''); break;
case('codeline'):if($p)$ret=codeline::parse($p,'','codeline'); break;
case('conn'):$ret=conn::connectors($p,$o,'',''); break;
case('basic'):$ret=codeline::mod_basic($p,$o); break;
//menus
//case('ajax'):$ret=lj('',$p,$t); break;
case('link'):if($d=='noli')$ret=special_link($p,$o); else{
	if(strpos($p,'§'))list($p,$t)=split_one('§',$p,0); $lin[]=mod_link_r($p,$t);} break;
case('user_menu'):$ret=user_menu($p); break; //mod_link
case('app_link'):$ret=read_apps_link($p,$d,$o); break;
case('app_menu'):$r=build_apps($p,$d); $ra=m_apps($r,'menu','');
	if($o=='icons')$ret=desktop_build_ico($ra,'icones'); 
	else $ret=app_list($ra,'',$o); $ret.=divc('clear',''); break;
case('app_popup'):Head::add('jscode',sj(read_apps(explode(',',$p)))); break;
case('categories'):$line=$_SESSION['line']; if($line){ksort($line);
	$d=$d?$d:'lines'; if($d=='cols' && !$o)$o=4;
	if($o=='home')$lin[]=[get('frm'),'cat','Home',nms(69)];//
	foreach($line as $k=>$va){
		if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
		if(rstr(112))$ka=catpic($k,20);
		$lin[]=[$_SESSION['frm'],'cat',$k,$ka];}} break;
case('categories2'):$line=sql('cat,id','qdc','kv',['qb'=>ses('qb')]); if($line){asort($line);
	$d=$d?$d:'lines'; if($d=='cols' && !$o)$o=4;
	if($o=='home')$lin[]=[get('frm'),'cat','Home',nms(69)];//
	foreach($line as $k=>$va){$ka=$k;
		if($o=='nb')$ka.=' ('.$va.')'; 
		if(rstr(112))$ka=catpic($k,20);
		$lin[]=[$_SESSION['frm'],'catid',$va,$ka];}} break;
case('overcats'):return mkbub(bubs::root('overcat','zero'),'inline','1'); break;
case('MenuBub'):return mkbub(bubs::root('menubub'.$p,'zero'),'inline','1'); break;
//case('App'):return mkbub(bubs::root('appbub',$p),'inline','1'); break;//
case('timetravel'):return timetravel_m($p,$o); break;
case('submenus'):return bubble_menus($p,$o); break;
case('taxonomy'):$ret=mod_taxonomy($p,$o); break;
case('rub_taxo'):$ret=rub_taxo($p,$t); $t=''; break;
case('folders'):$load=supertriad_ask($p,$o); $prw=$o; $obj=63; break;//rstr(5)?2:1
case('desk'):$ret=deskmod($p); break;
case('desktop_apps'):$r=m_apps(r_apps(),$o?$o:'desk','','','');//desktop_apps($o?$o:'desk','','','')
	$ret=desktop_build_ico($r,'icones'); break;
case('desktop_arts'):$ret=title($t).desktop_arts($p,$o,'arts'); break;
case('desktop_varts'):$ret=title($t).desktop_arts($p,$o,'varts'); break;
case('desktop_files'):$ret=title($t).desktop_arts($p,$o,'files'); break;
case('hierarchics'):$in=m_suj_hierarchic('active',''); $ret=balc('ul',$pbdy_css,$in); break;
//cacheable
case('hubs'):$mn=$_SESSION['mn']; if(count($mn)>=2){$t=$p!=1?$p:$t;
	if($t)$t=lkc('',htac('module').'hubs',$t);
	$in=m_nodes_b($mn,$o); $ret=balc('ul',$pbdy_css,$in);} break;
case('cats'):$lin=cat_mod($p,$o,$d); break;
case('catj'):$ret=cat_mod_j($p,$o,$d); break;
case('tags'):if($t)$t=lkc('','/plugin/tags/'.$p.'/1',$t); $lin=tag_mod($p,$o,$d); break;
case('clusters'):$lin=cluster_mod($p,$o,$d); break;
case('tags_cloud'):$ret=build_titl('',lkc('','/plug/tags',$p));
	$in=tags_cloud($p?$p:'tag',10,22,' ',$p); $ret.=divc($pbdy_css,$in); break;
case('tag_arts'):list($p,$o)=split_one(':',$p); $load=tag_arts($p,$o); break;
case('classtag_arts'):$load=classtag_arts($p); break;//class find id//$o=$p;
case('last_tags'):$lin=last_tags($p,$o); break;
case('last_search'):$ret=last_search($p,$o); break;
case('frequent_tags'):$lin=frequent_tags($p,$o); break;
case('see_also-tags'):$r=see_also_tags($p?$p:'tag'); 
	if($r)$ret=see_also($r,$p,$d,$o,$tp); break;
case('see_also-rub'):$t=$p!=1?$p:$_SESSION['frm'];
	if(get('read'))$load=see_also_rub($p); break;
case('see_also-source'):list($load,$t)=see_also_source($o); break;
case('siteclics'):$ret=siteclics($p); break;
case('rub_tags'):$ret=rub_tags($p); break;
case('sources'):if($t)$t=lkc('','/module/source',$t); $lin=art_sources($p); break;
case('msql_links'):if($o=='rss')$l='/?plug=rssin&rssurl=';
	elseif($o=='mail')$l='mailto:'; else $l=''; $ret=msql_links($p,$o,$l,$d,$t); $t=''; break;
case('rss'):$ret.=balc('ul','panel',divd('rssj',rss::home($p?$p:'rssurl',$o))); break;
case('rssin'):$ret.=rssj_m($p,$o); break;
case('chat'):if($t)$t=lj('','cht'.$p.'_chat___'.$p,$t);
	$p=$p!=1?$p:'pub'; $in=plugin('chat',$p,$o?$o:10); 
	if($in)$ret=divc($pbdy_css,$in); break;
case('stats'):$ret=plugin('stats','',''); break;
case('archives'):if($p==1)$p=$m; if($p)$ret=build_titl('',$p);
	$in=divd('archives',m_archives('')); $ret.=balc('ul',$pbdy_css,$in); break;
case('agenda'):$load=sql('ib,msg','qdd','kv','val="agenda"'); $tim=time();
	if($load)foreach($load as $k=>$v)if(strtotime($v)<$tim)unset($load[$k]); break;
case('calendar'):$in=calendar(ses('daya')); if($p==1)$p=$m;
	if($p)$ret=build_titl('',$p); $ret.=divc($pbdy_css,$in); break;
case('folder'):$lin=vfolders($p); break;
case('folders_varts'):$load=mod_varts($p); break;
case('searched_words'):$ret=searched::look($p); break;
case('searched_arts'):$load=searched::arts($p); break;
case('same_tags'):$load=mod_same_tags($p); break;
case('cluster_tags'):$load=mod_cluster_tags($p); break;
case('panel_arts'):$ret=plugin_func('panart','panart_build',$p); break;
case('birthday'):$load=birthday($p); break;
case('newsletter'):if($o)$ret=lj('txtcadr','popup_plupin__3_mailist_'.$p,'mailist');
	else $ret=plugin('mailist','',$p); break;
case('bridge'):$ret=bridge($p,$t); break;
case('fav_mod'):$ret=fav_mod($p,$t); break;
case('columns'):$ret=mod_columns($p,$o); break;
//users
case('login'):$ret=login_btn($p,$o); break;
case('login_popup'):$ret=login_btn_p($p,$o); break;
case('log-out'):if(ses('USE'))$ret.=lkc($smcss,'/logout',picto('logout')).' '; break;
case('search'):$ret=search_btn($p,$o,'',$d); break;
case('social'):$ret=plugin('social',$p,$o); break;
//banner
case('Banner'):$ret=make_ban($p,$o,$t); break;
case('ban_art'):if($p!=1)$ret.=lk(subdomain(ses('qb')),read_msg($p,'')); break;
//footer
case('credits'):$ret=lj('bevel','popup_about',picto('phi2')); break;
case('admin'):$ret=lkc($smcss,'/admin/log/open',$t?$t:picto('admin')).' '; $t=''; break;
case('chrono'):$ret=btn('txtsmall2',round(microtime(1)-$_SESSION['stime'],2).'s').' '; break;
case('contact'):if($p)$ret=plugin_func('tracks','track_form',ses('qb'),$t);
else $ret=contact($t,$o?$o:$smcss).' '; break;
//plugs
case('iframe'):$ret=plugin('ifram','',''); break;
case('suggest'):$ret=pluginside(nms(126),'suggest',$p,$o); break;
case('create_art'):$ret=artform('',''); break;
case('twitter'):if($p)$ret=twit::call($p,$o); break;
case('twits'):if($t)$ret=build_titl('',$t,''); $ret.=twit::stream($p,$o); break;
case('webs'):if($t)$ret=build_titl('',$t,''); $ret.=web::stream($p,$o); break;
case('profil'):$ret=plugin_func('profil',$p,$o); break;
//special
case('BLOCK'):$ret=build_modules($p,''); break;
case('module'):$ret=build_mod_r($p); break;
case('command'):$ret=com_mod($p); break;
case('vacuum'):$ret=com_vacuum($p,$o); break;
case('app'):list($pa,$pb,$oa,$ob)=opt($p,'_',4); if($t)$ret=build_titl('',$t,'');
	$ret.=appin($pa,$pb?$pb:'home',$oa,$ob); break;
case('plug'):list($pp,$po)=opt($o,'-'); if($t)$ret=build_titl('',$t,'');
	$ret.=plugin($p,$pp,$po); break;
case('pluf'):list($pp,$po)=explode('-',$p); list($op,$oo)=opt($o,'-'); 
	$ret=plugin_func($pp,$po,$op,$oo); break;
case('plup'):return lj('','popup_plupin___'.$p.'_'.$o.'_',$t?$t:$p); break;
case('close'):$ret='';
default:if($p && $m){$cnn=$p.($o?'§'.$o:'').':'.$m;
	$reb=conn::connectors($cnn,3,'','');
	if($reb && $reb!='['.$p.':'.$m.']')$ret=$reb;}
	else{$reb=plugin($m,$p,$o); if($reb)$ret=build_titl('',$t?$t:$m,'').$reb;} break;}
if($lin)$ret=mod_lin($lin,$t,$d,$o);//menus
elseif($load)$ret=mod_load($load,$ret,$t,$d,$o,$obj,$prw,$tp,$id);//arts
elseif($api)$ret=api::load($api);//api
if(!$ret && !$lin && !$load && $p && $m){//user_mods
	$func=msql::val('',nod('modules'),$m);
	if($func && !is_array($func))$ret=codeline::cbasic($func,$p);}
$br=!$nbr?br():'';
if($ret){if($dv)return divc('mod',$ret).$br; else return $ret.$br;}}

function mod_lin_build($re,$t,$d,$o){$limit=is_numeric($o)?50*$o:50;
if($_SESSION['cur_div']=='menu' or $d=='inline')$ret=implode('',$re);
elseif($d=='cols')$ret=divc('menus',columns($re,$o,'','menus','','mall'));
//elseif($d=='pictos')$ret=desktop_build_ico($re,'');
elseif($d=='icons')$ret=desktop_build_ico($re,'icones').divc('clear','');//
elseif($d=='scroll')$ret=$t.scroll_b($re,implode('',$re),(is_numeric($o)?$o:17));
else $ret=$t.divc('menus',implode('',$re));
return $ret;}

function mod_lin($lin,$t,$d,$o){//mod_link_r
if($lin)foreach($lin as $k=>$v){//.($o=='nospace'?'':' ')
	if(strpos($v[0],':')!==false)$v[0]=strprm($v[0],1,':');
	if(strpos($v[2],'/')!==false)$vrf=strprm($v[2],0); else $vrf=$v[2];
	$css=$v[0]==$vrf&&$v[2]?'active':'';
	if($v[1]=='j')$re[]=lj($css,$v[2],$v[3]);
	elseif($v[1]=='SaveJc')$re[]=ljb($css,$v[1],$v[2],$v[3]);
	elseif($o=='popapi')$re[]=lj('','popup_api___'.$v[1].':'.ajx($v[2]),$v[3]);
	elseif($o=='ajxlnk2')$re[]=lj('','popup_ajxlnk2___'.ajx($v[1]).'_'.ajx($v[2]),$v[3]);
	else{
		if($v[2]=='Home')$lk='/home';
		elseif($v[2]=='home')$lk='/home';
		elseif($v[1] && substr($v[2],0,1)!='/')$lk=$v[1].'/'.$v[2];
		elseif($v[2])$lk='/module/'.$v[2]; 
		elseif(is_numeric($v[2]))$lk='/'.$v[2];
		else $lk='';
		$re[]=lk($lk,$v[3],atc($css).atb('title',$v[2]));}}
if($re)return mod_lin_build($re,$t,$d,$o);}

function mod_load($load,$ret,$t,$d,$o,$obj,$prw,$tp,$id){$ret='';
if(!$prw)$prw='prw'; if($t)$t=build_titl($load,$t,$obj); $mx=prmb(6);
if($d=='read')foreach($load as $id=>$prw)$ret.=divc('justy',read_msg($id,3)).br();
elseif($d=='articles')$ret=output_arts($load,$prw,$tp);
elseif($d=='viewer')$ret=art_viewer($load);
elseif($d=='multi'){$_POST['flow']=1; $nl=ses('nl'); $i=0; foreach($load as $id=>$md){$i++;
	if($i<$mx)$ret.=art_read_b($id,$md,$tp,$nl,'');
	else $ret.=div(atd($id).atc($md),'');}}
elseif($d=='api')$ret=api::mod_call($load);
elseif($d=='icons')$ret=desktop_build_ico($load,'icones').divc('clear','');
elseif($d=='panel' && is_array($load))foreach($load as $k=>$v)$ret.=pane_art($k,$o,$tp);
elseif($load)$ret=m_pubart($load,$d,$o,$tp);
if($o=='scroll')$ret=scroll_b($load,$ret,10);
elseif($o=='scrold')$ret=scroll($load,$ret,10);
elseif($o=='cols')$ret=columns($ret,240,'','');//width
elseif($o=='blocks')$ret=divc('blocks',$ret);
elseif($o=='list')$ret=m_publist($load,$tp);
//elseif($o=='icons')$ret=desktop_build_ico($load,'icones').divc('clear','');
if($ret)return $t.$ret;}

#commands
function title($d){if($d)return divd('titles',balb('h3',$d));}

function build_titl($load,$t,$n='',$bt=''){$nb='';
$na=$load?count_r($load):''; if($na)$nb=btn('small',nbof($na,$n?$n:1)).' ';
return divd('titles',btn('txtcadr',$t).' '.$nb.$bt);}//pictxt('eye',)

function pluginside($t,$d,$p,$o){return title($t).plugin($d,$p,$o);}

#paneart
function pane_art($id,$o,$tp=''){$o='auteurs'; if(!$tp)$tp='panart_j';
$ra=pecho_arts($id); if(!$ra)return;
list($day,$frm,$suj,$amg,$nod,$thm,$lu,$name,$nbc,$src,$ib,$re,$lg)=arr($ra,13);
$p['url']=urlread($id); $p['suj']=suj_of_id($id);//spe
$p['jurl']='content_ajxlnk2__2_read_'.$id;
$p['purl']='popup_popart__3_'.$id.'_3';
$p['cat']=catpict($frm,22);
//$ims=sql('img','qda','v',$id); 
$im=art_img($amg,$id); if($im)$p['img1']='/imgc/'.make_thumb_css($im); //$p+=tag_maker($id,1);
$p['sty']=$im?'background-image:url('.$p['img1'].')':'';
$p[$o]=sql_inner('tag','qdt','qdta','idtag','v','where cat="'.$o.'" and idart="'.$id.'"');
return template($p,$tp);}

#pubart
function pub_art($id,$tpl=''){$rst=$_SESSION['rstr'];
$ra=pecho_arts($id); if(!$ra)return;
list($day,$frm,$suj,$amg,$nod,$thm,$lu,$name,$nbc,$src,$ib,$re,$lg)=arr($ra,13);
$rt['url']=urlread($id); $rt['suj']=$suj;
$rt['jurl']='content_ajxlnk2__2_read_'.$id;
$rt['purl']='popup_popart__3_'.$id.'_3';
if($rst[32]!=1 && $amg)$rt['img1']=art_img($amg,$id);
if($rst[36]!=1){$rt['back']=art_back($id,$ib,$frm,0); $rt['cat']=$frm;}
if($rst[7]!=1)$rt['date']=mkday($day);
if($rst[4]!=1){$r=tag_maker($id,1); if($r)$rt+=$r;}
if(!$tpl)$tpl=$rst[8]?'pubart':'pubart_j';
if($re)return divc('pubart',template($rt,$tpl));}

function m_pubart($r,$o,$p,$tp=''){$re=[]; $ret='';
if(is_array($r)){foreach($r as $k=>$v){$d=pub_art($k,$tp); if($d)$re[$k]=$d;}
if($o=='scroll'){$ret=scroll_b($r,implode('',$re),$p?$p:10);}
elseif($o=='scrold')$ret=scroll($r,implode('',$re),$p);
elseif($o=='cols')return columns($re,$p,'board','pubart');
elseif($re)$ret=implode('',$re);
if($ret)return divc('panel',$ret)."\n";}}

function m_publist($r,$tp){$ret='';
if(is_array($r))foreach($r as $k=>$v){
	$p['url']=urlread($k); $p['suj']=suj_of_id($k); $p['id']=$k;
	$p['jurl']='content_ajxlnk2__2_read_'.$k;
	$p['purl']='popup_popart__3_'.$k.'_3';
	$ret.=template($p,$tp);}
return divc('list',$ret);}

#links
function mod_link_r($m,$v){//m§v:picto
$qb=ses('qb'); list($va,$vb)=opt($v,':',2);
switch($m){
case('credits'):return ['bevel','j','popup_about',picto('phi2')]; break;
case('admin'):return ['','','/?admin==&log=open',picto('admin')]; break;
case('root'):return ['','j','popup_desktop___desk',picto('folder2')]; break;
case('desk'):return ['','j','desktop_desk',picto('folder')]; break;
case('deskboot'):return ['','SaveJc',desktop_cond('boot',1),picto('desktop')]; break;
case('desktop'):return ['','SaveJc','page_deskbkg;popup_site___desktop_ok__autosize',picto('window')]; break;
case('folder'):return ['','j','popup_modpop__3_local|real//////folder2///1:desktop*files_480',picto('folder')]; break;
case('art'):return ['','j','popup_popart__3_'.$va.'_3',picto('articles')]; break;
case('search'):return ['','j','popup_search',picto('search')]; break;
case('taxonav'):return ['','j','popup_plup___taxonav',picto('topo')]; break;
case('rss'):return ['','','rss'.$qb,$v?$v:picto('rss')]; break;
case('contact'):return ['','j','popup_track___'.$qb,picto('mail')]; break;
case('tablet'):return ['','j','socket_tog__self_tablet',picto('gsm')]; break;
case('hub'):return ['','',prep_host($m),($v?$v:prep_host($m)),'']; break;
case('apps')://apps§14:users
	if($vb)$r=msql::row('system','default_apps'.($vb=='default'?'':'_'.$vb),$va,1);
	elseif($va)$r=msql::row('',nod('apps'),$va,1);
	$r=[$r['button'],$r['type'],$r['process'],$r['param'],$r['option'],'','',$r['icon'],'',$r['private']]; return ['','j',read_apps($r),$r[7]?picto($r[7]):$r[0]]; break;
case('mod'):list($va,$vb)=explode('-',stripslashes($v));
	return [get('slct_mods'),'slct_mods',$va,$vb?picto($vb):'Design','']; break;
case('ajax'):return ['','j',$va,$vb]; break;}
//user_menus
if($vb=='picto')$v=picto($va); elseif($vb=='icon')$v=ico($va);
//modules
if(substr($m,0,1)=='/'){
	list($action,$lk)=split_one('/',substr($m,1),0);
	switch($action){
	case('module'):return [get('module'),'module',$lk,$v?$v:$m,'']; break;
	case('plug'):$v=$vb=='picto'?$v:strend($m,'/');
		return [get('plug'),'plug',$lk,$v]; break;
	case('plugin'):$v=$vb=='picto'?$v:strend($m,'/');
		return [get('plugin'),'plugin',$lk,$v]; break;
	case('app'):return [get('app'),'app',$lk,$v?$v:$m,'']; break;
	default:return [get($action),$action,$lk,$v?$v:$m,'']; break;}}
elseif(sesr('line',$m))
	return [$_SESSION['frm'],'cat',$m,($v?$v:$m),''];
elseif(is_numeric($m)){if(!$v)$v=$_SESSION['rqt'][$v][2]; 
	return [get('read'),htacc('read'),$m,$v,'art'];}
elseif($m=='home' or $m=='all')return [strtolower(getb('module')),'',$m,($v?$v:$m),''];
else return [get('context'),'context',$m,($v?$v:$m)];}

function special_link($d,$o=''){
list($m,$v)=split_one('§',$d,0);
$m=str_replace('*',' ',$m);
switch($m){
case('lang'):$ra=explode(' ',prmb(26).' all');
	return slct_menus($ra,'/?lang=',$_SESSION['lang'],'active','','v'); 
	if(get('lang'))return lkc('txtx','/?module=All&refresh==',nms(60)); break; 
case('time'):$ra=define_digr(); $nbj=$_SESSION['nbj'];
	if($_SESSION['dayx']-$_SESSION['daya']>3600)$goto=target_date($_SESSION['daya']); 
	else $goto=htac('nbj'); foreach($ra as $k=>$v){
		if($k==$nbj)$nm=' '.($k<365?plurial($v,3):plurial($v,7)); else $nm='';
		if($v)return lkc($k==$nbj?'active':'',$goto.$k,$v.$nm).' ';} break;
case('br'):return br(); break;}
$r=mod_link_r($m,$v); $t=$r[3]; if($o)$sp=''; else $sp=($d=='cols'?br():' ');
if($r[1]=='j')return lj($r[0],$r[2],$t);
elseif($r[1]=='SaveJc')return ljb($r[0],$r[1],$r[2],$t);
else return lkc($r[0],$r[1].$r[2],$t).$sp;}//todo mang treatment

function user_menu($p){
if(!$p)$p='home hubs plan'; $r=explode(' ',$p); $n=count($r);
for($i=0;$i<$n;$i++)$ret.=special_link($r[$i],'').' ';
return $ret;}

function read_apps_link($d,$vr='',$c=''){
list($p,$o)=explode('§',$d);
if(is_numeric($p)){
	if($vr)$r=msql::row('system','default_apps'.($vr=='system'?'':'_'.$vr),$p,1);
	else $r=msql_read('',nod('apps'),$p);
	$r=[$r['button'],$r['type'],$r['process'],$r['param'],$r['option'],'','',$r['icon'],'',$r['private']];}
else $r=explode(';',$p);
$t=$r[7]?picto($r[7]):$r[0];
return lj($c,read_apps($r),$o?$o:$t);}

//0:button/1:type/2:proces/3:param/4:option/5:condition/6:root/7:icon/8:hide/9:private 
function build_apps($p,$d){//newer than special_links
if(strpos($p,','))$r=explode(',',$p); else $r=explode(' ',$p);
$ra=msql::read_b('system','default_apps_'.($d?$d:menu),'',1); if($ra)$keys=msql::cat($ra,0);
foreach($r as $v){list($m,$o)=split_one('§',trim($v),0); $m=str_replace('+',' ',$m);
list($bt,$app,$func,$p,$o,$c,$root,$icon,$hid,$ath)=explode('/',$m);
if($ra[$m])$ret[]=$ra[$m]; elseif($keys[$m])$ret[]=$ra[$keys[$m]];
elseif($m && strpos('home all hubs plan taxonomy agenda taxonav',$m)!==false)
	$ret[]=[$v,'url','','/module/'.$o,'','menu','','link'];
elseif($m=='lang')foreach(explode(' ',prmb(26).' all') as $va)
		$ret[]=[$v,'url','','lang/'.$va,'','menu','','flag'];
elseif(is_numeric($m)){if(!$o)$o=$_SESSION['rqt'][$m][2]; 
	$ret[]=[$o,'art','',$m,'','menu','','articles'];}
elseif($_SESSION['line'][$m])$ret[]=[$m,'url','','/cat/'.$m,'','menu','',$o?$o:'list'];
elseif($m=='module' && $o)$ret[]=[$o,'url','','/module/'.$o,'','menu','','link'];
elseif($m=='hub')$ret[]=[$o,'url','',$m?$m:prep_host($m),'','menu','','home'];
elseif($m=='mod')$ret[]=[$o,'url','','/?slct_mods='.$o,'','menu','','home'];
elseif($m=='rss')$ret[]=[$o,'url','blank','/rss/'.ses('qb'),'','menu','','rss'];
elseif($m=='plug')$ret[]=[$o,'plug',ajx($o),'','','menu','','get'];
elseif($m=='categories'){$line=$_SESSION['line']; if($line){ksort($line);
	foreach($line as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
		$ret[]=[$ka,'url','','/cat/'.$k,'','menu','','list'];}}}
elseif(substr($m,0,1)=='/')$ret[]=[$o,'url','',$m,'','menu','','get'];}
return $ret;}

function rssj_m($p,$o){return title('Rss').divd('rssj',rss::home('rssurl'.($p?'_'.$p:''),$o));}

function msql_links($p,$o,$l,$d,$t){
$defs=msql_read('',nod($p),'',1);
if($defs)foreach($defs as $k=>$v){
	if($o=='mail'){$v[0]=$va=$k;}
	elseif($v[1]=='_' or !$v[1])$va=preplink($v[0]); else $va=$v[1];
	if($v)$ret.=llk('',$l.$v[0],$va);}
if($d=='scroll')$ret=scroll_b($defs,$ret,$o);
if($ret)return $t.balc('ul','panel',$ret);}

function recents_arts($d,$o){
$o=is_numeric($o)?$o:10; 
$wh=' nod="'.ses('qb').'"';//slowlog
if($d=='auto')$wh.=' AND frm="'.$_SESSION['frm'].'"'; 
elseif($d!='all' && $d!=1 && $d)$wh.=' AND frm="'.$d.'"';
return sql('id','qda','k',$wh.' AND re>="1" ORDER BY id DESC LIMIT '.$o);}

function pub_art_b($id,$t,$o){
list($dy,$frm,$suj,$amg)=pecho_arts($id);
if(rstr(32))$img=minimg($amg,'hb'); $lnk=urlread($id);
return balb('h2',lkc('',$lnk,$suj)).divc('panel',read_msg($id,$o?$o:2));}

function pub_img($id){
list($dy,$frm,$suj,$amg)=$_SESSION['rqt'][$id];
if(!$dy){$amg=sql('img','qda','v','id='.$id);}
return lkc('',urlread($id),minimg($amg,'ban'));}

function read_art($n,$t,$o){$in=read_msg($n,'');
if(strlen($in)>1000)$nbc=['1','1']; $ret='';
if(is_numeric($n))$tit=suj_of_id($n); else $tit=$n;
if($o)$in=scroll_b($nbc,$in,0);
if($t)$ret=divc('txtcadr',$t==1?$tit:$t);
$ret.=divc('panel',$in);
if(trim($in))return $ret;}

function wall_arts($t,$p){$id='wall'.$p;
if($t)$ret=btn('txtcadr',$t).br().br();
$ret.=lj('','popup_track___'.$id,picto('chat§32').picto('add')).br().br();
$ret.=divd('track'.$id,output_trk(read_idy($id,'DESC')));
return $ret;}

function friend_rub($o){
$id=id_of_suj($_SESSION['frm']);
$ok=sql('id','qda','v','id='.$id.' and re>0');
$ret=sql('msg','qdm','v','id='.$id);
if(auth(4))$bt=popart($id);
if($ok)return divc($o,$bt.conn::read($ret,'',''));}

function friend_art($o){
if($_SESSION['read']){$id=id_of_suj($_SESSION['read']); $in=read_msg($id,1,'');}
if(is_numeric($id)) return divc($o,$in);}

function timetravel_m(){$r=timetravel();
$travel=date('Y',ses('daya')); $ret='';
foreach($r as $k=>$v){$c=$k==$travel?'active':''; $ic=$travel==$k?'clock':'hour';
	$ret.=lj('','content_api___maxtime:'.$v,pictxt($ic,date('Y',$v)));}
return divc('menus',$ret);}

function mod_taxonomy($p,$o){$p=$p?$p:'taxonomy';
$r=collect_hierarchie_c('reverse',$o);
if($r){$ret=build_titl($r,$p,63); 
$ret.=divc('taxonomy',make_menus_r($r));}
return $ret;}

function rub_taxo($p,$t){$id=ses('read');
if($p==1)$p=ses('frm'); elseif($p=='art')$p=ib_of_id($id);
if($p)$taxcat=supertriad_dig($p);//permanent
if($p>1){$t=lk(urlread($p),suj_of_id($p)).br();
	$hie=collect_hierarchie_c(0,''); $taxcat=find_in_subarray($hie,$p);}
$t=build_titl($taxcat,$t,1);
if(is_array($taxcat))return $t.divc('taxonomy',make_menus_r($taxcat));}

function taxo_arts($p){
if($p==1)$v=ses('frm'); if(!$p)$p=ib_of_id(ses('read'));
$superline=collect_hierarchie(0);
if(!is_numeric($p))$taxcat=$superline[$p];
elseif(is_numeric($p)){$hie=supertriad_c(ses('dayb')); $taxcat=$hie[$p];}
return $taxcat;}

function taxo_arts0($p){
$r=supertriad_c(ses('dayb'));
if(is_array($r))$r=hierarchic_line($r,$r,$rev);
if(is_array($r))krsort($r);
if(is_numeric($p))$r=$r[$p]; pr($r);
if($r)$ret=divc('taxonomy',make_menus_r($r));
return $ret;}

function birthday($p){if(!$p)$p=date('d-m-Y'); $time=strtotime($p); $d=date('d-m',$time);
list($day,$month)=explode('-',$d); $day=(int)$day; $month=frdate((int)$month);
//$rstr3=$_SESSION['rstr'][3]; $_SESSION['rstr'][3]=1; $_SESSION['rstr'][3]=$rstr3;
//echo $day.' '.$month;
$r=search_engine($day.' '.$month);
return $r;}

//desktop folder
function apps_files_build($r,$rb,$dr){
foreach($r as $k=>$v){
	if(is_array($v))$rb=apps_files_build($v,$rb,$dr.'/'.$k);
	else $rb[]=[$dr.'/'.$v,$dr];}
return $rb;}

function apps_files_dir($o){$qb=ses('qb');
if(substr($o,0,strlen($qb))!=$qb)$o=$qb.($o?'/'.$o:'');
$r=explore('users/'.$o); $rb=[];
if($r)return apps_files_build($r,$rb,$o);}

function apps_files($cnd,$p,$o){$rc=[];
if(!$p)$p='local|real'; $rb=explode('|',$p); if($o)$o=str_replace('|','/',$o);
if($rb[0]=='global')$r=msql_read('server','shared_files','',1);
elseif($rb[1]=='real')$r=apps_files_dir($o);
else $r=msql_read('users',$_SESSION['qb'].'_shared','',1);
if($r)foreach($r as $k=>$v){
if(!$o or substr($v[0],0,strlen($o))==$o){list($dir,$nm)=split_one('/',$v[0],1); 
	if($rb[1]=='virtual')$dir=$v[1]; else $dir=strfrom($dir,'/');
	$rc[]=[$nm,'file','',$v[0],$cnd,'',$dir,mime(xt($nm))];}}
return $rc;}

function apps_explore($dr,$vir){
if($vir)$r=msql_read('',nod('shared'),''); else $r=explore('users/'.$dr);
if($r)foreach($r as $k=>$v){
	if($vir){$t=strend($v[0],'/'); $f=$v[0]; $root=$v[1];}
	elseif(is_numeric($k)){$t=$v; $f=$dr.'/'.$v; $root=$dr;}
	else{$t=$k; $f=$dr.'/'.$k; $root=$dr.'/'.$k;}
	if(is_numeric($k)){
		if(is_image('users/'.$f))
			$rb[]=[$t,'img','',$f,'','',$root,'','',''];
		else $rb[]=[$t,'file','',$f,'','',$root,'','',''];}
	else $rb[]=[$t,'explore',$f,'','','',$root,'','',''];}
return $rb;}

function apps_menubub($dr){//root,action,type,button,icon,auth
$r=msql_read('users',nod('menubub_1'),'',1);
if(!$_SESSION['line']){req('boot'); reboot();}
if($r)foreach($r as $k=>$v){$bt=$v[3]?$v[3]:$v[1];
	if($v[2]=='plug')$ret[]=[$v[3],$v[2],$v[1],'','','',$v[0],$v[4],'',$v[5]];
	elseif($v[2]=='module')$ret[]=[$v[3],$v[2],$v[1],'','','',$v[0],'','',$v[5]];
	elseif($v[2]=='ajax')$ret[]=[$v[3],$v[2],$v[1],'','','',$v[0],$v[4],'',$v[5]];
	elseif($v[2])$ret[]=[$v[3],$v[2],'',$v[1],'','',$v[0],$v[4],'',$v[5]];
	else{if($_SESSION['line'][$v[1]]){$type='desktop'; $process='arts';}
		elseif(is_numeric($v[1]))$type='art'; else $type='url';
		$ret[]=[$v[3],$type,$process,$v[1],'','',$v[0],$v[4],'',$v[5]];}}
return $ret;}

function apps_overcats(){
$r=surcat_list(); $ret=[];//mods/overcats
if($r)foreach($r as $k=>$v)$ret[]=[$k,'desktop','arts',$k,'','',$v,'url'];
return $ret;}

function mod_varts($p){
if($p && !is_numeric($p))$w=' and msg="'.$p.'"'; else $w='';
return sql('ib,msg','qdd','kv','val="folder"'.$w.' order by ib desc');}

function vfolders($id){$r=sql('msg','qdd','k','val="folder"'); $p='folder';
if($r)foreach($r as $k=>$v)$lin[]=[get($p),$p,$k,$k];//'/folders_varts/'.
return $lin;}

function mod_cluster_tags($id){//arts with tags from cluster from tags from current art :)
$r=sql('idtag','qdta','rv',['idart'=>$id]); $rt=[];
$rc=sql('word,count(idtag) as nb','qdtc','rv','idtag in ('.implode(',',$r).') group by word order by nb desc'); 
if(isset($rc[0])){$rb=sql('idtag','qdtc','rv',['word'=>$rc[0]]);
	$r1=sql('idart,count(id) as nb','qdta','kv','idtag in ('.implode(',',$rb).') group by idart order by nb desc');}
if(isset($rc[1])){$rb=sql('idtag','qdtc','rv',['word'=>$rc[1]]);
	$r2=sql('idart,count(id) as nb','qdta','kv','idtag in ('.implode(',',$rb).') group by idart order by nb desc');}
if(isset($r1) && isset($r2)){foreach($r1 as $k=>$v)if(isset($r2[$k]))$r1[$k]+=$r2[$k]; arsort($r1);}
if(isset($r1)){$min=min($r1); $max=max($r1); foreach($r1 as $k=>$v)if($v>$min*3 && $k!=$id)$rt[$k]=$v;} 
return $rt;}

function mod_same_tags($id){
$ra=sql('idtag','qdta','rv',['idart'=>$id]);
//$ra=sql_inner('idtag','qdt','qdta','idtag','rv',['idart'=>$id,'cat'=>'tag']);
$rb=sql('idart,count(id) as nb','qdta','kv','idtag in ('.implode(',',$ra).') group by idart order by nb desc limit 20');//and idart!="'.$id.'" 
if(isset($rb[$id]))unset($rb[$id]);
return $rb;}

function apps_varts($cnd,$p){$r=mod_varts($p); $rc=[];
if($r)foreach($r as $k=>$v)$rc[]=[$k,'art','auto',$k,$cnd,'',$v,'articles'];
return $rc;}

function apps_arts($cnd,$cat,$p,$o){$rb=[];
if($p)$r=api::mod_arts_row($p); elseif(rstr(3))$r=$_SESSION['rqt'];
else $r=sql('id,day,frm','qda','kvv','nod="'.ses('qb').'" and frm!="_system" and re>0 and substring(frm,1,1)!="_" order by '.prmb(9));
if(is_array($r))foreach($r as $k=>$v){list($day,$frm)=$p?pecho_arts($k):$v;
	if(($cat && $cat==$frm) or !$cat)$rb[]=[$k,'art','auto',$k,$cnd,'',$frm,'articles'];}
return $rb;}

function desktop_arts($p,$o,$cnd,$no=''){poplist();
if($o){$ob=str_replace('|','/',$o); $ob=strfrom($ob,'/');} else $ob='';
$r=desktop_apps($cnd,$ob,$p,$o);//apps_(v)arts
return desktop_build_ico($r,'icones').divc('clear','');}

function art_viewer($r){$rid=randid('artv'); $id=key($r); $ret=art_read_b($id,2);
if(count($r)>1)foreach($r as $k=>$v){$i++; $m.=lj('',$rid.'_artone___'.$k.'_2',$i);}
return divc('nbp',$m).divd($rid,$ret);}

function deskmod($p){req('ajxf'); 
$ret=desktop_ico('desk'); $sty='position:relative; width:100%;';
return divc('desk',$ret);}

//sources
function recup_src(){$r=$_SESSION['rqt']; $ret=[];
if($r)foreach($r as $k=>$v)if($v[9] && $v[9]!='mail'){$purl=domain($v[9]); 
	$purl=str_replace(['.wordpress','.blogspot','.pagesperso-orange'],'',$purl);
	if($purl)$ret[$purl]=radd($ret,$purl,1);} return $ret;}
function art_sources($o){$r=recup_src(); if($r){arsort($r);
foreach($r as $k=>$v){$ad=$o?' ('.$v.')':''; 
$lin[]=[$k,'source',strto($k,'.'),$k.$ad];}}
return $lin;}

//tags
function tag_mod($p,$o,$d){$nbj=ses('nbj'); if($nbj==7 or $nbj=='auto')$nbj=30;
$p=$p?$p:'tag'; $r=tags_list($p,$nbj); $d=$d?$d:'lines'; $lin=[];//tags_list_nb
if($r)foreach($r as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
	if($dig=get('dig'))$k.='/'.$dig;
	$lin[]=[get(eradic_acc($p)),$p,$k,$ka];}
return $lin;}

function cluster_mod($p,$o,$d){$nbj=ses('nbj');
$r=sqb('word,count(idtag) as nb','qdtc','kv','group by word order by nb desc');
$d=$d?$d:'lines'; $lin=[];//tags_list_nb
if($r)foreach($r as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
	if($dig=get('dig'))$k.='/'.$dig;
	$lin[]=[get('cluster'),'cluster',$k,$ka];}
return $lin;}

function classtag_arts($cat){$dy='';
if(ses('nbj'))$dy=' and day<"'.ses('daya').'" AND day>"'.ses('dayb').'"';
$wh='and cat="'.$cat.'"'.$dy.' order by day desc';
return artags('idart',$wh,'k');}

function tags_cloud($r,$smin,$smax,$sep,$go){
if(!$r)$r=tags_list_nb($p,ses('nbj')); $ret='';
if($r){arsort($r); $ratio=($smax-$smin)/log(max($r));
foreach($r as $k=>$fa){$size=round((log($fa)*$ratio)+$smin);
$css='popbt" style="font-size:'.$size.'px;';
$ret.=lj($css,'popup_api__3_'.$go.':'.$k,$k."&nbsp".'('.$fa.')').$sep;}}
return $ret;}

function last_tags($p,$o){$p=$p?$p:10;
$ord='order by '.ses('qdt').'.id desc limit '.$p;
if($o!='nb')$r=sqb('tag,cat','qdt','',$ord);
else $r=sql_inner('tag,cat,count(idart)','qdt','qdta','idtag','','group by idtag '.$ord);
if($r)foreach($r as $k=>$v){if($o=='nb')$n=' ('.$v[2].')';
	$lin[]=[get(eradic_acc($v[1])),$v[1],$v[0],$v[0]];}//eradic_acc()
return $lin;}

function cat_mod($p,$o,$d){
$w='nod="'.ses('qb').'"'; $nbj=ses('nbj');
if($nbj==7 or $nbj=='auto')$w.=' and day>'.calctime(30);
$r=sql('distinct(frm)','qda','rv',$w); $d=$d?$d:'lines'; $lin=[]; $get=get('cat');
if($r)foreach($r as $k=>$v)$lin[]=[$get,'cat',$v,catpic($v,20)];//if(rstr(112))
return $lin;}

function cat_mod_j($p,$prw,$d){$rid=randid('cats');
$w='nod="'.ses('qb').'"'; $nbj=ses('nbj'); $bt='';
if($nbj==7 or $nbj=='auto')$w.=' and day>'.calctime(30);
$r=sql('distinct(frm)','qda','rv',$w); $d=$d?$d:'lines';
if($r)foreach($r as $k=>$v)$bt.=lj(active($v,$p),$rid.'_ajxlnk___'.ajx($v).'/'.$prw.'//////1:catj',catpic($v,20));
$prw=$prw?$prw:(rstr(41)?3:2);
$ret=api::arts($p,$prw,'');
return divd($rid,divc('nbp',$bt).$ret);}

function last_search($p,$o){$ret='';
$r=sqb('id,word','qdsr','kv','order by id desc');
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_search__3_'.$v,$v);
return divc('menus',$ret);}

function frequent_tags($p,$o){
$ra=$p?[$p]:explode(' ',prmb(18)); $r=[];
foreach($ra as $ka=>$va){$rb=tags_list_nb($va,ses('nbj')); if($rb){arsort($rb);
	foreach($rb as $kb=>$vb)$rc[$vb][]=['',$va,$kb,$kb.' ('.$vb.')'];}}
if($rc)krsort($rc);
foreach($rc as $k=>$v)foreach($v as $ka=>$va)$ret[]=$va;
return $ret;}

function most_read($dyb,$mx=''){
$dayb=$dyb?calc_date($dyb):$_SESSION['dayb']; $mx=$mx?$mx:50;
return sql('id,lu','qda','kv','nod="'.ses('qb').'" and re>="1" and day>'.$dayb.' order by cast(lu as integer) desc limit '.$mx);}//unsigned integer

function most_read_mod($p,$t,$d,$o,$m,$tp){
list($dyb,$mx)=explode('-',$p); $r=most_read($dyb,$mx); unset($r[80301]);
$ta=dig_it_j($dyb,'mostread_ajxlnk___VAR-'.$mx.'/'.ajx($t).'/'.$d.'/'.$o.':'.ajx($m));
$t=lkc('','/module/most_read/'.$p.'/'.$t.'/'.$d,$t!=1?$t:'most_read');
if($r)return divd('mostread',$ta.mod_load($r,'',$t,$d,$o,1,$o,$tp,''));}

function most_polled($p,$o){$qda=ses('qda'); if(!$o)$o=200;
$r=sql_inner($qda.'.id,count(poll) as nb','qda','qdf','ib','kv','order by cast(nb as integer) desc limit '.$o);
return $r;}

function score_datas($p,$o){$qda=ses('qda'); if(!$o)$o=200;
$r=sql_inner($qda.'.id,msg','qda','qdd','ib','kv','where val="'.$p.'" order by cast(msg as integer) desc limit '.$o);
return $r;}

function special_polls($id,$t,$o){
$n=sql('poll','qdf','v',['ib'=>$id,'type'=>$t,'iq'=>ses('iq')]);
$bt=btn('txtcadr',$t.' ['.str_replace('|',', ',$o).']');
$ret=favs_polls($id,$n,$t);
return $bt.divd($t.$id,$ret);}

function quality_stats($id,$t,$o){//dev
return $id.'-'.$t.'-'.$o.br();}

function short_arts($p=4000){$dayb=$dyb?calc_date($dyb):$_SESSION['dayb'];
return sql('id','qda','k','nod="'.ses('qb').'" AND re>="1" AND day>'.$dayb.' AND host<'.$p.' ORDER BY '.prmb(9));}

function trkarts($p,$t,$d,$o,$rch=''){//see also api cmd:tracks
$qda=ses('qda'); $qdi=ses('qdi'); $pg=$o?$o:1; $tri=$d==1?$qdi:$qda;
$p=get('dig',$p); $p=is_numeric($p)?$p:ses('nbj'); if(!$p)$p=30; $np=time_prev($p);
if($rch)$w=' and msg like "%'.$rch.'%"';
else{$w=' and '.$tri.'.day>'.calc_date($p); if($p!=7 && $p!=1)$w.=' and '.$tri.'.day<'.calc_date($np);}
$r=sql_inner($qdi.'.id,'.$qdi.'.ib','qda','qdi','ib','kv','where '.$qda.'.nod="'.ses('qb').'" and '.$qda.'.re>"0" and '.$qdi.'.re="1" '.$w.' and substring('.$qda.'.frm,1,1)!="_" order by '.$qdi.'.day desc');
if(!$d)$r=array_flip($r);//permut k and v in output_arts_trk
$bt=lj('txtbox','modtrk_ajxlnk___'.$p.'/'.ajx($t).'/'.yesno($d).'/'.$o.':tracks',nmx([185,$d?22:2]));
$bt.=inputj('trkrch',$rch,'modtrk_trkrch_trkrch__'.ajx($t));
$ret=build_titl($r,$t?$t:'Tracks',1,$bt);
if(auth(6))$ret.=dig_it_j($p,'modtrk_ajxlnk___VAR/'.ajx($t).'/'.$d.'/:tracks').br();
$j='modtrk_trknav___'.$p.'_'.$t.'_'.$d.'_';//$j='modtrk_ajxlnk___'.$p.'/'.$t.'//VAR:tracks';
if($r)$ret.=output_arts_trk($r,$d,$pg,$j,1,($d?'desc limit 1':'asc'));//
return divd('modtrk',$ret);}

function related_art($id){if(!$id)$id=ses('read');
$d=sql('msg','qdd','v','val="related" and ib="'.$id.'"');
if($d)return array_flip(explode(' ',$d));}

function related_by($id){if(!$id)$id=ses('read');//msg like "%'.ses('read').'%"');
return sql('ib','qdd','k','val="related" and (msg="'.$id.'" or msg like "'.$id.' %" or msg like "% '.$id.'")');}

function child_art($id){if(!$id)$id=ses('read');
return sql('id','qda','k','ib="'.$id.'"');}

function parent_art($id){if(!$id)$id=ses('read');
return sql('ib','qda','k','id="'.$id.'"');}

function same_title($id){if(!$id)$id=ses('read');
return sql('id','qda','k','suj="'.ses('read').'" AND nod="'.ses('qb').'" AND id!="'.ses('read').'" ORDER BY id DESC');}

function call_context($cntx){$r=$_SESSION['mods']; $ret='';//context as module
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)if($va[7]!=1 && $va[3]==$cntx)$ret.=build_mods($va);
return $ret;}

function see_also_rub($p){$frm=$p!=1?$p:$_SESSION['frm'];
$frmline=tri_rqb($frm,'frm','frm');
return $frmline[$frm];}

function see_also($r,$p,$d='',$o='',$tp=''){
foreach($r as $kb=>$pb){$t=lk(htac(eradic_acc($p)).$kb,$kb);
	if($pb)$rc[$kb]=mod_load($pb,'',$t,$d,$o,0,'',$tp,'','');}
if(count($rc)>1)$ret=make_tabs($rc,randid('mod')); else $ret=$rc[$kb];
return $ret;}

function see_also_tags($cat,$nbdays='30'){$id=ses('read');
$r=ses('artags'); $r=$r?$r:art_tags($id); $rtag=val($r,$cat); $ret=[];
if($rtag)foreach($rtag as $tag=>$v){$ret[$tag]=[];
	$r=tag_arts($tag,$cat,$nbdays); if(!$r)$r=tag_arts($tag,$cat);
	if($r)foreach($r as $k=>$v)if($k!=$id)$ret[$tag][$k]=radd($ret[$tag],$k);}
return $ret;}

function see_also_source($o=''){$o=$o?$o:10;
$id=ses('read'); $src=$_SESSION['rqt'][$id][9];
if(!$src)$src=sql('mail','qda','v','id='.ses('read'));
if($src){$src=preplink($src);
$r=$_SESSION['rqt']; $ret=[];
if($r)foreach($r as $k=>$v)if(preplink($v[9])==$src)$ret[$k]=radd($ret,$k);
if(!$ret && $src)$ret=sql('id','qda','k','mail like "%'.$src.'%" limit '.$o);
if($ret){unset($ret[$id]);
return [$ret,lk(htac('source').strto($src,'.'),$src)];}}}

function siteclics($src){
$id=ses('read'); if($id)$src=$_SESSION['rqt'][$id][9];
$r=sql('lu','qda','rv','mail like "%'.$src.'%"');
foreach($r as $k=>$v)$n+=$v;
return balb('h3',$src).divc('',$n.' vues');}

function rub_tags($cat){//
$dayb=get('dig')?calc_date(get('dig')):ses('dayb');
$r=tags_list($cat,$dayb,$_SESSION['frm']);
if($r)$tags=slct_menus($r,htac('rub_tag'),get('rub_tag'),'active','','k');
return divc('nbp',$tags);}

function prevnext_art($b,$t,$o){$wh=''; $rb=[];
$id=$_SESSION['read']; $ta=picto('kleft'); $tb=picto('kright'); $htacc=htacc('read');
if($b=='rub')$wh='and frm="'.$_SESSION['frm'].'" '; else $wh='and substring(frm,1,1)!="_"';
$ord=strtolower(prmb(9)); $col=strto($ord,' ');
$w='and nod="'.ses('qb').'" and re>"0" '.$wh;
if($col=='day'){$dy=sql('day','qda','v','id='.$id); $w1='day<"'.$dy.'"'; $w2='day>"'.$dy.'"';}
else{$w1='id<"'.$id.'"'; $w2='id>"'.$id.'"';}
$k1=sql('id','qda','v',$w1.' '.$w.' order by '.$col.' desc limit 1');
$k2=sql('id','qda','v',$w2.' '.$w.' order by '.$col.' asc limit 1');
if(!rstr(8)){$ret=lkc($k1?'':'hide',$htacc.$k1,$ta).' '.lkc($k2?'':'hide',$htacc.$k2,$tb);}
else{$j='content_ajxlnk2__u_read_';
$ret=lj($k1?'':'hide',$j.$k1.'__'.$k1,$ta).' ';
$ret.=lj($k2?'':'hide',$j.$k2.'__'.$k2,$tb);}
return btn('nbp '.($o?$o:'right'),$ret);}

function search_btn($o=''){
$id='srch'; $t=nms(24); $s=12; $j='SearchT(\''.$id.'\')';
$js='onClick="'.$j.'" onkeyup="checksearch(event,\''.$id.'\')" onContextMenu="'.$j.'"';
$ret=autoclic($id,$t,$s,'100','" role="search','',$js);
return $o?$ret:div(atc('search').atd('ada'),$ret);}

function login_btn($va,$o){$t=$p!=1?$p:""; 
$ret=login::form(ses('USE'),$_SESSION['iq'],$t);
if($o)$ret=divc("imgr",$ret);
return $ret;}

function login_btn_p($p,$o){$t=$p?$p:"login"; 
$jx='popup_loged___'.ses('USE').'_'.$_SESSION['iq'].'_'.ajx(nms(54)).'_1';
return lj('txtcadr',$jx,$t);}//if(!ses('USE'))

function search_conn($ra,$min,$cn){
$req=sqr('id,msg','qdm','where id>="'.$min.'" and msg like "%'.$cn.'%" order by id desc');
while($rq=qrw($req))if(in_array($rq[0],$ra)){
	$r=explode($cn,$rq[1]); $n=count($r); if(!$r[1])return; 
	for($i=0;$i<$n-1;$i++){$s=strrpos($r[$i],'['); 
		if($s!==false)$ret[]=[$rq[0],substr($r[$i],$s+1)];}}
return $ret;}

function mod_apichan($p,$t,$o,$tp){if(!$p)$p=1; $ret='';
$r=msql_read('',nod('apichan_'.$p),'',1);//api,button,icon,color,hide
if($r)foreach($r as $k=>$v)if(!$v[4])$ret.=lj('','apichan_api___'.ajx($v[0]),pictxt($v[2],$v[1],36),ats('background-color:#'.$v[3]));
return divc('apichan',$ret).divd('apichan','');}

function mod_cover($p,$o,$tp){
if(is_numeric($p))$p='id:'.$p; $r=api::mod_arts_row($p); //$ra=explode_k($p,',',':');
$ra['cmd']='panel'; $ra['template']=$tp?$tp:val($ra,'template','cover');//panart
if($p)return api::build($r,$ra);}

function videoboard($p,$c,$o){static $iv; $iv++; $ra=[]; 
require_once('ajxf.php'); list($pa,$pb)=split_right('-',$p,0);
if($pa=='priority')$pa=11; if($pa=='cat')$pa=1; if($pa=='tag')$pa=5; 
if(!is_numeric($pa)){$pb=$p; $pa=5;} if($pb==1)$pb=$_SESSION['frm'];
if(strpos($pb,'|')!==false){$rc=explode('|',$pb); $nc=count($rc);}
if($nc>0){foreach($rc as $k=>$v){$rab=tri_rqt((string)$v,$pa); if($rab)$ra=$rab;}}
elseif($pb)$ra=tri_rqt($pb,$pa); else $ra=$_SESSION['rqt'];
if($ra){$ra=array_keys($ra); $min=min($ra);
$r=search_conn($ra,$min,':video'); $_SESSION['iv'.$iv]=$r;
if($r)return divd('iv'.$iv,video_viewer($iv,$_SESSION['cur_div'],0));}}

function collect_board($prm){
$frm=$_SESSION['frm']; $dad=($_SESSION["daya"]-86400);
$thr=tri_rqt('4','lu'); $two=tri_rqt('3','lu'); $one=tri_rqt('2','lu');
if($two){if($one)$one+=$two; else $one=$two;}	
if($one){foreach($one as $id=>$nb){
	if($_SESSION['rqt'][$id][1]==$frm or $frm=='Home'){
		if($_SESSION['rqt'][$id][0]>=$dad){$v=pub_art($id); if($v)$re[$id]=$v;}}}
if($re){krsort($re); $ret.=build_titl($re,'24h',1);
$ret.=columns($re,$prm,'board','').br();}}
if($two){$re=""; foreach($two as $id=>$nb){
	if($_SESSION['rqt'][$id][1]==$frm or $frm=='Home'){
		if($_SESSION['rqt'][$id][0]<$dad){$v=pub_art($id); if($v)$re[$id]=$v;}}}
if($re){krsort($re); $ret.=build_titl($re,nbof($_SESSION['nbj'],3),1);
	$ret.=columns($re,$prm,'board','pubart').br();}}
if($thr){$re=""; foreach($thr as $id=>$nb){
	if($_SESSION['rqt'][$id][1]==$frm or $frm=='Home'){
		$v=pub_art($id); if($v)$re[$id]=$v;}}
	if($re){krsort($re); $ret.=build_titl($re,'***',1);
	$ret.=columns($re,$prm,'board','pubart').br();}}
if($ret){return $ret;}}

function icotag(){
$t='related_arts related_by see_also-source source rub_taxo taxo_arts same_title tags '.prmb(18); $r=explode(' ',$t); $n=count($r);
$t='up down home home topo-open topo articles tag '.prmb(19); $ico=explode(' ',$t);
for($i=0;$i<$n;$i++)$ret[$r[$i]]=picto($ico[$i]);
return $ret;}

function tab_mods($p){
$r=val_to_mod_b($p); $ico=sesmk('icotag'); $rc=[]; p($r);
foreach($r as $k=>$v){$md=build_mods($v);
	$k=isset($ico[$k])?$ico[$k]:$k;
	if($md)$rc[$k]=$md;}
return make_tabs($rc,randid('tmod'));}

function art_mod($p,$d,$o,$id){
if(is_numeric($o))cwset($o);
if($d=='tabmods')return tab_mods($p);
elseif($d=='menusJ')return ajxlink($p,'mjx',0,0);
elseif($d=='togup')return ajxlink($p,'mjx',0,'togup');
$r=val_to_mod_b($p,$id); $ret=''; //pr($r);
foreach($r as $k=>$v){if(!$v[1])$v[1]=$id; $ret.=build_mods($v);}
return $ret;}

function rartmod(){$r=$_SESSION['modc']['system'];
foreach($r as $k=>$v)if($v[0]=='art_mod')return $v;}

function build_artmod($id,$a=''){$ra=rartmod();
list($m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr)=arr($ra,10);//$o=$o?$o:140;
$ret=art_mod($p,$d,$o,$id);
if($ret && $t)$ret=divc('txtcadr',stripslashes($t)).$ret;
if($ret && $a)$ret=divb($ret,'right','artmod','max-width:'.($o?$o:180).'px');
return $ret?scroll(0,$ret):nmx([11,1]);}

function build_artmod_bub($id){$ra=rartmod(); $ret=[];//unused
list($m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr)=arr($ra,10);
$r=val_to_mod_b($p,$id);
foreach($r as $k=>$v)$ret[]=[$v[0],$v[1]?$v[1]:$id,$v[4]];
return $ret;}

//pop=popup,onplace,o=closeable,closed,css
function ajxlink($d,$id,$o,$pop){$ret=''; $clb=''; $cld=''; $ter='';
static $i; $i++; $here='here'.$id.$i; $d=str_replace("\n",'',$d); $ik=0;
if(strin($o,'notcloseable'))$clb=1; if(strin($o,'closed'))$cld=1;
$cs='nbp'; if($pop=='togup')$cld=1; $sp=' ';
if(strpos($d,',')!==false){$r=explode(',',$d); $sh=ses($here);
	if(!$sh && !$cld)$_SESSION[$here]=struntil($r[0],'§');
	foreach($r as $k=>$v){$hid=strprm($v,5);
	if($v && !$hid){
		if($pop=='popup')$ret.=poplk($v,$here).$sp;//$pop=0??
		elseif($pop=='togup')$ret.=toglk($v).$sp;
		else $ret.=ajxlk(trim($v),$here,$clb,$ik,'SaveBg').$sp; $ik++;}}}
else{if($pop=='popup')$ret.=poplk($d,$here).$sp;
	elseif($pop=='togup')$ret.=toglk($d).$sp;
	else $ret=ajxlk($d,$here,$clb,$ik,'SaveBg');}
$ret=div(atd('mnu'.$here).atc($cs),$ret);
if($pop!='popup' && $_SESSION[$here])$ter=build_mod_r($_SESSION[$here]);
$ter=str_replace("\n",' ',$ter);
return $ret.btd($here,$ter);}

function ajxlk($d,$here,$o,$n,$op=''){
list($lk,$t)=split_right('§',$d,1); if($op)$op='SaveBg';//SaveTg
list($l,$k)=opt($lk,'->'); if(!$k)$k=$here;
$j=$k.'_ajxlnk_'.ajx($l).'_'.$here.'_'.$n.'_'.$o;
$c=($_SESSION[$here]==$lk?'active':'');
$r=explode(':',$t); if($r[0]=='picto')$t=picto($r[1]);
$tb=isset($r[1])?'" title="'.$r[1]:'';
return ljb($c.$tb,$op,$j,$t);}

function bridge($p,$t){
$_GET['urlsrc']=$p='http://'.$p.'/'.ajx($t,1); 
$rea=conv::vacuum($p,''); $po['suj']=$rea[0]; 
$po['msg']=conn::read($rea[1],3,''); 
$po['source']=picto('link').' '.pub_link($p);
return template($po,'');}

function fav_mod($p,$t){$ret='';
$r=msql_read('',nod('coms'),'',1); $r=array_reverse($r);
foreach($r as $k=>$v)if($v[3]){//if($p){if($v[1]==$p)$api=$v[2];}else 
	$ret.=lj('','popup_api___'.ajx($v[2].',t:'.$v[1]),divc('txtcadr',pictxt('articles',$v[1])));}
//if($api)return api::call($api);
return $ret;}

function mod_columns($p,$o){$r=val_to_mod($p);
foreach($r as $k=>$v)$re[]=build_mods($v);
return columns($re,count($re),'','');}

function usited_words($p){$p=$p?$p:ses('read');
$msg=sql('msg','qdm','v','id="'.$p.'"');
$r=explode(' ',$msg); foreach($r as $k=>$v){$ret[$v]+=1;}
arsort($ret); return $ret;}

function com_mod($p){
return input1('cmod','','20').lj('txtbox','content_ajxlnk_cmod',picto('kright'));}

function com_vacuum($p,$o){$rid=randid('vac');
if($p)return lj('','popup_vacuum__3_'.ajx($p),pictxt('popup',preplink($p)));
$j=$rid.'cb_vacuum_'.$rid.'_3'; $bt=inputj($rid,'http...',$j,'',1).lj('',$j,picto('ok'));
return $bt.divd($rid.'cb','');}

//plan
function home_plan($load,$n){
if($load){ksort($load); $i=0; $ret=[];
foreach($load as $cat=>$ids){$i++;
	$line=sesr('line',$cat); $mn=sesr('mn',$cat);
	if($n==2)$re=outputimg($ids); else $re=m_pubart($ids,'scroll','10000');
	if($cat!='_system' && $re && ($line or $mn)){
		if($n==2)$nib=10; else $nib=7;
		if($line)$got=htac('cat').$cat; else $got=subdomain($cat);
	$nbrt=btn('small',nbof(count($ids),1));
	$ret[$i]=lkc('txtcadr',$got,$cat).' '.$nbrt.br();
	$ret[$i].=divc('tab',scroll($ids,$re,$nib,'',280)).br();}}
if($ret){if(count($ret)<2 or $n==2) $prm=1; else $prm=2;
return columns($ret,$prm,'board','pubart');}}}

function arts_plan($conn,$p,$o=''){$t=$p!=1?$p:$conn;
if($conn=='plan' or $conn=='hubs')$n=1; else $n=2;
if($conn=='hubs')$load=see_hubs();
elseif($conn=='gallery'){// && !rstr(3)
	$r=sql('frm,id,img','qda','kkv','nod="'.ses('qb').'" and re>"0" and lg="'.ses('lng').'"');
	foreach($r as $ka=>$va)foreach($va as $k=>$v)if($v){$rb=explode('/',$v);
		if($rb)foreach($rb as $vb)if($vb && !is_numeric($vb)){
			$f='img/'.$vb; $s=is_file($f)?filesize($f):0;
			if($s>20480 or ($o && $s<20480))$load[$ka][$k][]=$vb;}}}
else $load=tri_rqb('','nod','frm');
if($load)$rb=home_plan($load,$n);
if($rb)return build_titl($load,$t,61).$rb;}

function see_hubs(){
if($ra=$_SESSION['mn']){foreach($ra as $k=>$v){
$r=msql_read('users',$k.'_cache','');
if($r)foreach($r as $ka=>$va){$ret[$k][$ka]+=1;}}}
return $ret;}

function make_ban($p,$o,$t){
$t=divc('bantxt',conn::parser($t));
$im=$p?goodroot($p):'imgb/ban_'.ses('qb').'.jpg'; $h=is_numeric($o)?$o:'120';
return div(ats('background-image:url('.$im.'); height:'.$h.'px;').atc('banim'),$t);}

function footer(){
$_SESSION['cur_div']='footer';
$r=val_to_mod('credits,chrono,log-out');
foreach($r as $k=>$v){$ret.=build_mods($v);}
return $ret;}

function modsee($id,$va){$u='';
$r=msql::row('',$_SESSION['modsnod'],$id); $rb=array_shift($r);
if(!$va)return build_mods($r);
for($i=1;$i<12;$i++)if($i!=3)$u.=$r[$i].'/';//not use condition
$ret=divc('txtcadr','connector');
$ret.=str_replace(['/////:','////:','///:','//:','/:'],':',$u.':'.$r[0]).':module';
$ret.=divc('txtcadr','url');
$ret.='/module/'.$r[0].'/'.str_replace(',',';',$r[1]).'/'.$r[2].'/'.$r[4].'/'.$r[5]; //$lk=strto($lk,'§');
$ret.=divc('txtcadr','lj').'_modpop___'.ajx($r[1]).'/'.ajx($r[2]).'/'.ajx($r[4]).'/'.$r[5].':'.$r[0];
return $ret;}

function modj($id,$va){return build_mods($_SESSION['modc'][$va][$id]);}

?>