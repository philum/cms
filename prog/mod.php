<?php
//philum_mods 

#modules

function build_mod_r($sets){$r=val_to_mod($sets);
$_SESSION['cur_div']='content';
foreach($r as $k=>$v)$ret.=build_mods($v);
return $ret;}

//param/title/command/option:module[,]
function val_to_mod($d){$r=explode(",",$d);
foreach($r as $k=>$v){list($val,$conn)=split_right(':',$v,1);
	if(strpos($val,'/')!==false)list($val,$t,$d,$o,$ch,$hd,$tp,$br,$dv,$aj)=explode("/",$val);
	$ret[]=array($conn,$val,$t,'',$d,$o,$ch,$hd,$tp,$br,$dv,$aj);}
return $ret;}

function build_modules($va,$cr){
$r=$_SESSION['modc'][$va]; $_SESSION['cur_div']=$va;
if($r)foreach($r as $k=>$v){if(!$v[7]){//hide
	if($v[6]){//cache
		if(!$_SESSION['tab'][$k] or $cr){$re[$k]=build_mods($v); 
			$_SESSION['tab'][$k]=$re[$k];}
		else $re[$k]=$_SESSION['tab'][$k];}
//elseif($v[11])$re[$k]=divd('mod'.$k,js_code('SaveJ(\'mod'.$k.'_modj___'.$k.'_'.$va.'\')'));
	elseif($v[11])$re[$k]=divd('mod'.$k,lj('txtcadr','mod'.$k.'_modj__3_'.$k.'_'.$va,$v[2]));
	else $re[$k]=build_mods($v);
if($re[$k])$ret.=$re[$k]."\n";}}//.(!$v[9]&&!$v[11]?br():'')
$_SESSION['cur_div']='content';
return $ret;}

function build_mods($r){//p($r);
$ptit_css="txtcadr"; $pbdy_css="panel"; $smcss="txtsmall2";
//mod,param,title,condition,command,option,(bloc),hide,template,nobr,div,ajxbtn
list($m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr,$dv,$jbt)=$r; $t=stripslashes($t);
switch($m){
//main
case('LOAD'): if($_SESSION['read'])$ret=art_read($tp);
	else $ret=play_arts('',$o,$tp); break;
case('Page_titles'): $ret=page_titles($o); break;
case('All'): $ret=page_titles(1).play_arts($m,$o,$tp); break;
case('category'): if($p==1 && $_SESSION['frm']=='Home')$p='All'; 
	$ret=play_arts($p,$o,$tp); break;
case('Board'): $ret=collect_board($p); break;
case('plan'): $ret=arts_plan($m,$p); break;
case('Hubs'): $ret=arts_plan($m,$p); break;
case('gallery'): $ret=arts_plan($m,$p); break;
case('tracks'): $ret=trkarts($p); break;
case('MenusJ'): $ret=ajxlink($p,'mjx',$o,$d); break;
case('Wall'): $ret=wall_arts($t,$p); break;//
case('articles'): $load=make_list_arts($p,$o); $obj=1; break;
case('tab_mods'): $ret=tab_mods($p); break;
case('last'): $ret=art_read_b('last',$n,3,''); break;
case('player'): $ret=flash_prep('',$p); break;
case('friend_art'):$ret=friend_art($o); break;
case('friend_rub'):$ret=friend_rub($o); break;
case('related_arts'):$load=related_art(); break;
case('related_by'):$load=related_art_by(); break;
case('prev_next'):$ret=prevnext_art($d,$p,$o); break;
case('cat_arts'): $p=$p!=1?$p:$_SESSION['frm']; $t=$t!=$m?$t:$p;
	$load=tri_rqt($p,1,$_SESSION['dayx']); break;
case('priority_arts'): $load=tri_rqt($p,11); $t=$t!=$m?$t:$p; break;
case('recents'):$load=recents_arts($p,$o); $obj=1; break;
case('read'): $ret=divc($o,read_msg($p,3)); break;
case('popart'):$ret=pop_art($p); break;
case('pub_art'):$ret=pub_art_b($p,$o); break;
case('pub_arts'):$load=array_flip(explode(" ",$p)); break;
case('pub_img'):$ret=pub_img($p); break;
case('taxo_arts'):$load=taxo_arts($p); if($t>1)$t=suj_of_id($t); break;
case('read_art'):$ret=read_art($p,$t); $t=''; break;
case('short_arts'): $load=short_arts($p); if($o<=3)$prw=$o; break;
case('most_read'): $ret=most_read_mod($p,$t,$d,$o,$m,$tp); $t=''; break;
case('same_title'): $load=same_title(); break;
case('deja_vu'): if($_SESSION['mem'])$load=$_SESSION['mem']; break;
//com
case('rss_input'):if($p)$ret=rssin(ajx($p,1)); break;
case('disk'): require_once('ajxf.php'); $_SESSION['dlmod']=$p;if($p && $p!='/')$pb='/'.$p;
	$ret=divd('dsnavds',ds_nav('dl','users/'.ses('qb').$pb)); break;
case('finder'):$ra=array('|','-');$p=str_replace($ra,'/',$p);$o=str_replace($ra,'/',$o);
	req('finder'); $ret=finder($p,$o,$d); break;
case('channel'): if($o){$n=$o*1000; $j='SaveD("chan_channel_'.$p.'_'.$t.'_'.$d.'_'.$o.'");';
	$ret=temporize('channeltimer',$j,$n);}
	$ret.=divd('chan',channel($p,$t,$d,$o)); $t=''; break;
case('hour'): setlocale(LC_TIME,"fr_FR");//%A%d%B%G%T
	if($p)$dat=strftime($p?$p:'%y%m%d:%H%M',$_SESSION['dayx']); else $dat=mkday('',1);
	if(!$d)$ret=btn($o,$dat); else $ret=divc($o,$dat); break;
case('cart'): $ret=lkc("txtcadr","/?plug=cart",$p!=1?$p:"Cart");
	$ret.=divd('cart',m_pubart($_SESSION['cart'],'scroll',7)); break; 
case('video'): $ret=video_auto($p,'','',3); break;
case('video_playlist'): $load=videoplaylist($p); $obj=1; $prw='vd'; break;
case('video_viewer'): $ret=videoboard($p,$c,$o); break;
//txt
case('text'): $ret=stripslashes(urldecode($p)); if($o)$ret=divc($o,$ret); break;
case('connector'): if(substr($p,0,1)!="[" && substr($p,-1,1)!="]")$p='['.$p.']';
	$ret=nl2br(format_txt_r($p,'','')); 
	if($o=='article')$ret=balc('article','justy',format_txt($p,'','')); break;
case('codeline'): if($p)$ret=correct_txt($p,"",'codeline'); break;
case('clear'):$ret=divc("clear",""); break;
case('hr'):$ret='<hr'.atc($p).' />'; break;
case('br'):$ret=br(); break;
//menus
//case('ajax'): $ret=lj('',$p,$t); break;
case('conn'): $ret=connectors($p,$o,''); break;
case('link'): if(strpos($p,'§'))list($p,$t)=split_one('§',$p,0);
	if($d=='noli')$ret=special_link($p,$o); else $lin[]=mod_link_r($p,$t); break;
case('user_menu'): $ret=divb($o?$o:'usermenu',user_menu($p)); break; //mod_link
case('app_link'):$ret=read_apps_link($p,$d,$o); break;
case('app_menu'):$r=build_apps($p,$d); $ra=m_apps($r,'menu','');
	if($o=='icons')$ret=desktop_build_ico($ra,'icones'); 
	else $ret=app_list($ra,'',$o); $ret.=divc('clear',''); break;
case('categories'): $line=$_SESSION['line']; if($line){ksort($line); 
	$d=$d?$d:'lines'; if($d=='cols' && !$o)$o=4;
	if($o=='home')$lin[]=array($_GET['module'],htac('module'),'Home','Home');
	foreach($line as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
		$lin[]=array($_SESSION['frm'],htac('section'),$k,$ka);}} break;
case('timetravel'): return timetravel($p,$o); break;
case('submenus'): return bubble_menus($p,$o); break;
case('taxonomy'): $ret=taxonomy($p,$o); break;
case('rub_taxo'): $ret=rub_taxo($p,$t); $t=''; break;
case('folders'): $load=supertriad_ask(); $prw=$o; $obj=63; break;
case('hierarchics'): $in=m_suj_hierarchic('active','');
	$ret=balc("ul",$pbdy_css,$in); break;
case('desk'): $ret=deskmod($p); break;
case('desktop_arts'): $ret=desktop_arts($p,$o,'arts'); break;
case('desktop_varts'): $ret=desktop_arts($p,$o,'varts'); break;
case('desktop_files'): $ret=desktop_arts($p,$o,'files'); break;
//cacheable
case('hubs'): $mn=$_SESSION['mn']; if(count($mn)>=2){$t=$p!=1?$p:$t;
	if($t)$t=lkc('',htac('module').'hubs',$t);
	$in=m_nodes_b($mn,$o); $ret=balc("ul",$pbdy_css,$in);} break;
case('tags'): $p=$p?$p:'tag'; $r=tags_list($p,ses('nbj')); $d=$d?$d:'lines'; 
	if($t)$t=lkc('','/plugin/tags/'.$p.'/1',$t);
	if($r)foreach($r as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
		if($dig=get('dig'))$k.='/'.$dig;
		$lin[]=array($_GET[eradic_acc($p)],htac(eradic_acc($p)),$k,$ka);} break;
case('tags_cloud'): $p=$p?$p:'tag'; $ret=btn($ptit_css,lkc('',"/plug/tags",$p));
	$line=tags_list($p,ses('nbj')); $in=tags_cloud($line,10,22,' ',$p); 
	$ret.=divc($pbdy_css,$in); break;
case('tag_arts'): list($p,$o)=split_one(':',$p); $load=tag_arts($p,$o); break;
case('classtag_arts'): $load=classtag_arts($p); break;//class find id
case('see_also-tags'): $r=see_also_tags($p?$p:'tag'); 
	if($r)$ret=see_also($r,$p,$d,$o,$tp); break;
case('see_also-rub'): $t=$p!=1?$p:$_SESSION['frm'];
	if($_GET['read'])$load=see_also_rub($p); break;
case('see_also-source'): list($load,$t)=see_also_source(); break;
case('rub_tags'): $ret=rub_tags($p); break;
case('sources'):if($t)$t=lkc('','/module/source',$t); $lin=art_sources($p); break;
case('msql_links'): if($o=='rss')$l='/?plug=rssin&rssurl=';
	elseif($o=='mail')$l='mailto:'; else $l=''; $ret=msql_links($p,$o,$l,$d,$t); $t=''; break;
case('rss'): $ret.=balc('ul','panel',divd('rssj',rssj($p?$p:'rssurl',$o))); break;
case('rssin'): $ret.=rssj_m($p,$o); break;
case('chat'): if($t)$t=ljb('','SaveD','cht'.$p.'_chat_'.$p,$t);
	$p=$p!=1?$p:'pub'; $in=plugin('chat',$p,$o?$o:10); 
	if($in)$ret=divc($pbdy_css,$in); break;
case('stats'): $n=$p?$p:$_SESSION['nbj'];
	require('plug/stats.php'); $ret=divd('graph',stat_canvas($o,$n,$res)); break;
case('archives'): if($p==1)$p=$m; if($p)$ret=btn($ptit_css,$p);
	$in=divd("archives",m_archives("")); $ret.=balc('ul',$pbdy_css,$in); break;
case('agenda'): $load=tri_rqt_d("","day",10000000,ses('daya'));
	if($load){ksort($load);} break;
case('calendrier'):	$in=calendar(ses('daya')); if($p==1)$p=$m;
	if($p)$ret=btn($ptit_css,$p); $ret.=divc($pbdy_css,$in); break;
case('newsletter'):
	if($o)$ret=call_plug($ptit_css,'popup','mailist',$p,$p).' ';
	else $ret=plugin('mailist','',$p); break;
case('bridge'): $_GET['urlsrc']=$p='http://'.$p.'/'.ajx($t,1); 
	$rea=vacuum($p,''); $po['suj']=$rea[0]; 
	$po['msg']=format_txt($rea[1],3,$id); 
	$po['source']=picto('link').' '.pub_link($p);
	$ret=template($po,''); break;
case('columns'): $ret=mod_columns($p,$o); break;
//users
case('login'): $ret=login_btn($p,$o); break;
case('login_popup'): $ret=login_btn_p($p,$o); break;
case('log-out'): if(ses('USE'))$ret.=lkc($smcss,'/logout',picto('logout')).' '; break;
case('search'): $ret=search_btn($p,$o,'',$d); break;
case('social'): $ret=plugin('social',$p,$o); break;
//banner
case('Banner'): $ret.=make_ban($here,$t); $t=''; break;
case('ban_art'): if($p!=1)$ret.=lka(subdom(ses('qb')),read_msg($p,"")); break;
//footer
case('credits'): $ret=lj('bevel','popup_about',picto('phi2')); break;
case('admin'): $ret=lkc($smcss,'/admin/log/open',$t?$t:picto('admin')).' '; $t=''; break;
case('chrono'): $ret=btn('txtsmall2',round(mtime()-$_SESSION['stime'],2).'s').' '; break;
case('contact'): $ret=contact($p,$o?$o:$smcss).' '; break;
//plugs
case('taxonav'): return plugin('taxonav',$p,$t); $t=''; break;
case('iframe'): $ret=plugin('ifram','',''); break;
case('suggest'): $ret=pluginside(nms(126),'suggest',$p,$o); break;
case('create_art'): $ret=f_inp('',''); break;
case('twitter'): if($p)$ret=plugin('twitter',$p,$o); break;
case('profil'): $ret=plugin_func('profil',$p,$o); break;
//special
case('BLOCK'): $ret=build_modules($p,''); break;
case('command'): $ret=com_mod($p); break;
case('plug'): list($pp,$po)=split('-',$o); $ret=plugin($p,$pp,$po); break;
case('pluf'): list($pp,$po)=split('-',$p); list($op,$oo)=split('-',$o); 
	$ret=plugin_func($pp,$po,$op,$oo); break;
case('plup'): return lj('','popup_plupin___'.$p.'_'.$o.'_',$t?$t:$p); break;
case('close'): $ret='';
default: if($p && $m)$reb=connectors($p.($o?'§'.$o:'').':'.$m,"","");
	if($reb && $reb!='['.$p.':'.$m.']')$ret=$reb; 
	else{$reb=plugin($m,$p,$o); if($reb)$ret=build_titl('',$m,'').$reb;} break;}
//menus
if($lin)$re=mod_lin($lin,$d,$o);
if($re)$ret=mod_lin_build($re,$t,$d,$o);
//arts
if($load)//command
$ret=mod_load($load,$ret,$t,$d,$o,$obj,$prw,$tp,$id);
//umods
if(!$ret && !$lin && !$load && $p && $m){//user_mods
	$func=msql_read("",$_SESSION['qb'].'_modules',$m);
	if($func && !is_array($func))$ret=cbasic($func,$p);}
if(!$nbr)$br=br();
if($ret){if($dv)return divc('mod',$ret).$br; else return $ret.$br;}}

function mod_lin($lin,$d,$o){//mod_link_r
if($lin)foreach($lin as $k=>$v){//$va=str_replace(' ',"&nbsp;",$v[3]);
	if(strpos($v[0],':')!==false)$v[0]=strprm($v[0],1,':');
	if(strpos($v[2],'/')!==false)$vrf=strprm($v[2],0); else $vrf=$v[2];
	if($v[2])$css=$v[0]==$vrf?'active':'';
	if($v[1]=='j')$re[]=lj($css,$v[2],$v[3]);
	elseif($v[1]=='SaveJc')$re[]=ljb($css,$v[1],$v[2],$v[3]);
	else $re[]=lk($v[1].$v[2],atc($css).atb('title',$v[2]),$v[3]).($o=='nospace'?'':' ');}//todo:innocent menu
//if($d=='cols')foreach($re as $k=>$v)$re[$k]=li($v);
return $re;}

function mod_lin_build($re,$t,$d,$o){$limit=is_numeric($o)?50*$o:50;
if($_SESSION['cur_div']=='menu' or $d=='inline')$ret=implode('',$re);
elseif($d=='cols')$ret=divc('menus',scroll_b($re,columns($re,$o,'','menus','','mall'),(int)$limit));
elseif($d=='pictos')$ret=desktop_build_ico($re,'');//
elseif($d=='icons')$ret=desktop_build_ico($re,'icones');//
elseif($d=='scroll')$ret=$t.scroll_b($re,implode('',$re),(is_numeric($o)?$o:17));
else $ret=$t.divc('menus',implode('',$re));
return $ret;}

function mod_load($load,$ret,$t,$d,$o,$obj,$prw,$tp,$id){
if(!$prw)$prw='prw'; if($t)$t=build_titl($load,$t,$obj); $mx=prmb(6);
if($d=='read'){foreach($load as $id=>$prw){
	$ret.=divc('justy',read_msg($id,3)).br();}}
elseif($d=='articles')$ret=output_pages($load,$prw,$tp);
elseif($d=='viewer')$ret=art_viewer($load);
elseif($d=='multi'){foreach($load as $id=>$md){$i++; $_POST['flow']=1;
	if($i<$mx){$art=art_read_b($id,$_SESSION['nl'],$md,$tp); $rt[]=$art; $ret.=$art;}
	else $ret.=div(atd($id).atc($md),'');}}
elseif($load) return $t.m_pubart($load,$d,$o);
if($o=='scroll')$ret=scroll_b($load,$ret,10);
elseif($o=='scrold')$ret=scroll($load,$ret,10);
elseif($o=='cols')$ret=columns($rt,$o,'','');
elseif($o=='icons')$ret=desktop_build_ico($load,'icones');//
//else $ret=m_pubart($load,$d,$o);//echo $ret;
if($ret)return $t.$ret;}

#Commands
function title($d){return divd('titles',bal('h3',$d));}
function build_titl($load,$t,$n){
if($load)$nb=count_r($load).' '; $p['suj']=$t!=1000000?$t:'';
if(rstr(14) && $n)$p['nbarts']=' '.nbof($nb,$n?$n:1);
if($t)return divd('titles',template($p,'titles'));}
function pluginside($t,$d,$p,$o){return title($t).plugin($d,$p,$o);}

#pubart
function pub_art($id){$rst=$_SESSION['rstr'];
list($day,$frm,$suj,$amg,$nod,$thm,$lu,$re)=pecho_arts($id);
$panout['url']=urlread($id); $panout['suj']=$suj; 
$panout['jurl']='content_ajxlnk2__2_art_'.$id;
$panout['purl']='popup_popart__3_'.$id.'_3';
if($rst[32]!=1 && $amg)$panout['img1']=first_img($amg);
if($rst[36]!=1){$panout['back']=art_back($id,$ib,$frm); $panout['cat']=$frm;}
if($rst[7]!=1)$panout['date']=mkday($day);
if($rst[4]!=1){$r=tag_maker($id,1); if($r)$panout+=$r;}
if($re)return divc('pubart',template($panout,'pubart'));}

function m_pubart($r,$o,$p){
if(is_array($r)){foreach($r as $k=>$v)$re[$k]=pub_art($k);
if($o=='scroll'){$ret=scroll_b($r,implode('',$re),$p?$p:10);}
elseif($o=='scrold')$ret=scroll($r,implode('',$re),$p);
elseif($o=='cols')return columns($re,$p,'board','pubart');
else $ret=implode('',$re);
if($ret)return divc('panel',$ret)."\n";}}

#mods
function mk_rq_sub($d,$p){$r=explode('|',$d); $n=count($r); 
if($n<2)return 'AND '.$p.'="'.$d.'" ';
else{for($i=0;$i<$n;$i++){$ret.=$p.'="'.$r[$i].'" OR ';}
return 'AND ('.substr($ret,0,-4).') ';}}

function make_list_arts($v,$o=''){
$v=str_replace('~','&',$v); $der=explode("&",$v); $prw=2;
foreach($der as $va){
if(strpos($va,'STAR')!==false)$va=ajx($va,1);//why?
list($vaa,$vab)=explode("=",$va);
switch($vaa){
case('id'):$wh.='AND id="'.$vab.'" '; break;
case('priority'):$d=substr($vab,0,1); if($d=='>' or $d=='<')$vab=$d.'"'.substr($vab,1).'"'; 
	elseif(is_numeric($vab))$vab='="'.$vab.'"'; $wh.='AND re'.$vab.' '; break;
case('nopriority'):$wh.='AND re!="'.$vab.'" '; break;
//case('tag'):$wh.='AND thm LIKE "%'.$vab.'%" '; $tag[]=$vab; break;//
//case('notag'):$notag[$vab]=1; break;
case('cat'):$wh.=mk_rq_sub($vab,'frm'); break;
case('nocat'):$wh.='AND frm!="'.$vab.'" '; break;
case('lenght'):$wh.='AND host"'.$vab.'" '; break;//<
case('nbdays'): list($vaba,$vabb)=split_right('-',$vab,1); break;
case('nbhours'): list($vaba,$vabb)=split_right('-',$vab,1); $vaba/=24; $vabb/=24; break;
case('from'):$wh.='AND day > "'.dayref($vab).'" '; break;
case('until'):$wh.='AND day < "'.dayref($vab).'" '; break;
case('lasts'):$whb.='LIMIT '.str_replace("-",", ",$vab).' '; break;
case('limit'):$whb.='LIMIT '.$vab.' '; break;
case('list'):$wh.=mk_rq_sub($vab,'id'); break;
case('orderby'):$ordr=$vab; break;
case('preview'):if($vab=="false")$prw=1; elseif($vab=="full")$prw=3; 
	elseif($vab=='auto')$prx=1; else $prw=$o?$o:$vab; break;}}
$vaba=$vaba?calc_date($vaba):$_SESSION["daya"];
$vabb=$vabb?calc_date($vabb):$_SESSION["dayb"];
$wh.='AND day < "'.($vaba).'" '; $wh.='AND day > "'.$vabb.'" ';
$ordr=$ordr?$ordr:(prmb(9)?prmb(9):"id DESC");
//if($_SESSION['lang']!='all')$inner=lang_req();//
$sql=$inner.' WHERE nod="'.$_SESSION['qb'].'" AND re>0 AND substring(frm,1,1)!="_" '.$wh.' ORDER BY '.$ordr.' '.$whb;
$rq=sq('id,re','qda',$sql);//thm,
if($rq)while($data=mysql_fetch_row($rq)){
	if($prx)$prw=$data[1]>2?2:1; $id=$data[0];
	$ret[$id]=$prw;}
return $ret;}

function channel($p,$t,$d,$o){
if($d=='cols')$o=$o?$o:3; $ra=explode(" ",$p);
foreach($ra as $ka=>$va){list($kab,$vab)=split(":",$va);$sc[$vab]=$kab;}
if($sc['site']){require_once('plug/microxml.php');
$site='http://'.$sc['site']; $t=lka($site,$sc['site'].'/'.$sc['hub']);
$load=clkt($sc['site'].'/msql/users/'.$sc['hub'].'_cache');}
else $load=msql_read("users",$sc['hub'].'_cache','',1);
if($load){
	if($sc['cat'])$load=channel_tri($load,$sc['cat'],1);
	if($sc['parent'])$load=channel_tri($load,$sc['art'],10);
	if($sc['art'])$load=channel_tri($load,$sc['art'],'');
	if($sc['tag'])$load=channel_tri($load,$sc['tag'],5);
	if($sc['last'])$load=splice($load,$sc['last']);
	$t=build_titl($load,(!$t?$sc['hub']:$t),1);
	if($d=='articles'){
		if($site)$ret.=output_pages_from_cache($site,$load);
		else $ret.=output_pages($load,2,'');}
	elseif($load){
		foreach($load as $k=>$v){
		$re[]=llk('',$site.'/'.$k,html_entity_decode($v[2]));}
		if($d=="scroll")$ret=scroll_b($re,implode("",$re),$o);
		elseif($d=="cols")return $t.columns($re,$o,'','pubart');
		else $ret=implode('',$re);
		$ret=balc('ul','panel pubart',$ret);}}
return $t.$ret;}

function channel_tri($r,$d,$n){
foreach($r as $k=>$v){
	if(strpos($d,$v[$n])!==false or $k==$d)$ret[$k]=$v;}
return $ret;}

function output_pages_from_cache($http,$otp){
$npg=$_SESSION['prmb'][6]; $page=$_SESSION["page"];
$min=($page-1)*$npg; $max=$page*$npg;
	if(is_array($otp)){foreach($otp as $id=>$nb){if(is_numeric($id)){$i++; 
	if($i>=$min && $i<$max){$mg=$http.'/imgc/'.first_img($nb[3]);
		if(is_link($mg))$ret.=btn('imgl',image($mg,'',50));
		$ret.=bal("h2",lka($http.'/'.$id,$nb[2]));
		$ret.=btn('txtx',$nb[1]).' ';
		if(rstr(27))$ret.=btn("txtsmall",mkday($nb[0],1)).' '.pub_link($nb[9]).' ';
		if(rstr(25))$ret.=btn("txtsmall",art_lenght($nb[8]));
		$ret.=br().br();}}}}
$n_pages=nb_page($i,$npg,$page);
return $n_pages.$ret.$n_pages;}

#links
function mod_link_r($m,$v){//m§v:picto
$qb=ses('qb'); list($va,$vb)=explode(':',$v);
switch($m){
case('credits'): return array('bevel','j','popup_about',picto('phi2')); break;
case('admin'): return array('','','/?admin==&log=open',picto('admin')).' '; break;
case('root'):return array('','j','popup_desktop___desk',picto('folder2')); break;
case('desk'):return array('','j','desktop_desk',picto('folder')); break;
case('deskboot'):return array('','SaveJc',desktop_cond('boot',1),picto('desktop')); break;
case('desktop'):return array('','SaveJc','page_deskbkg;popup_site___desktop_ok__autosize',picto('window')); break;
case('folder'):return array('','j','popup_modpop__3_local|real//////folder2///1:desktop*files_480',picto('folder')); break;
case('art'):return array('','j','popup_popart__3_'.$va.'_3',picto('articles')); break;
case('search'):return array('','j','popup_search',picto('search')); break;
case('taxonav'):return array('','j','popup_plup___taxonav',picto('topo')); break;
case('rss'):return array('','','/rss/'.$qb,picto('rss')); break;
case('contact'):return array('','j','popup_track___'.$qb,picto('mail')); break;
case('tablet'):return array('','j','socket_tog__self_tablet',picto('gsm')); break;
case('hub'): return array('','',prep_host($m),($v?$v:prep_host($m)),''); break;
case('apps')://apps§14:users
	if($vb)$r=msql_read('system','default_apps'.($vb=='default'?'':'_'.$vb),$va);
	elseif($va)$r=msql_read('',$_SESSION['qb'].'_apps',$va);
	$r=array($r['button'],$r['type'],$r['process'],$r['param'],$r['option'],'','',$r['icon'],'',$r['private']);return array('','j',read_apps($r),$r[7]?picto($r[7]):$r[0]); break;
case('mod'): list($va,$vb)=explode("-",stripslashes($v));
	return array($_GET['slct_mods'],htac('slct_mods'),$va,$vb?picto($vb):'Design',''); break;
case('ajax'): return array('','j',$va,$vb); break;}
//user_menus
if($vb=='picto')$v=picto($va); elseif($vb=='icon')$v=ico($va);
//modules
if(substr($m,0,1)=='/'){
list($action,$lk)=split_one('/',substr($m,1),0);
switch($action){
case('module'):return array($_GET['module'],htac('module'),$lk,$v?$v:$m,''); break;
case('plug'):$v=$vb=='picto'?$v:strrchr_b($m,'/');
	return array($_GET['plug'],htac('plug'),$lk,$v); break;
case('plugin'):$v=$vb=='picto'?$v:strrchr_b($m,'/');
	return array($_GET['plugin'],htac('plugin'),$lk,$v); break;
case('app'):return array($_GET['app'],htac('app'),$lk,$v?$v:$m,''); break;}}
elseif($_SESSION['line'][$m])
	return array($_SESSION['frm'],htac('section'),$m,($v?$v:$m),'');
elseif(is_numeric($m)){if(!$v)$v=$_SESSION['rqt'][$v][2]; 
	return array($_GET['read'],htacc('read'),$m,$v,'art');}
elseif($m=='home' or $m=='all')return array(strtolower(get('module')),'',$m,($v?$v:$m),'');
else return array('','',$m,($v?$v:$m));}

function special_link($d,$o=''){
list($m,$v)=split_one('§',$d,0);
switch($m){
case('lang'): $ra=explode(' ',prmb(26).' all');
	return slct_menus($ra,'/?lang=',$_SESSION['lang'],"active","","v"); 
	if($_GET['lang'])return lkc('txtx','/?module=All&refresh==',nms(60)); break; 
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
if(!$p)$p='Home hubs plan'; $r=explode(' ',$p); $n=count($r);
for($i=0;$i<$n;$i++)$ret.=special_link($r[$i],'').' ';
return $ret;}

function read_apps_link($d,$vr='',$c=''){
list($p,$o)=explode('§',$d);
if(is_numeric($p)){
	if($vr)$r=msql_read('system','default_apps'.($vr=='system'?'':'_'.$vr),$p);
	else $r=msql_read('',$_SESSION['qb'].'_apps',$p);
	$r=array($r['button'],$r['type'],$r['process'],$r['param'],$r['option'],'','',$r['icon'],'',$r['private']);}
else $r=explode(';',$p);
$t=$r[7]?picto($r[7]):$r[0];
return lj($c,read_apps($r),$o?$o:$t);}

//0:button/1:type/2:proces/3:param/4:option/5:condition/6:root/7:icon/8:hide/9:private 
function build_apps($p,$d){//newer than special_links
if(strpos($p,','))$r=explode(',',$p); else $r=explode(' ',$p);
$ra=msql_read_b('system','default_apps_'.($d?$d:menu),'',1); $keys=msq_cat($ra,0);
foreach($r as $v){list($m,$o)=split_one('§',trim($v),0); $m=str_replace('+',' ',$m);
list($bt,$app,$func,$p,$o,$c,$root,$icon,$hid,$ath)=explode('/',$m);
if($ra[$m])$ret[]=$ra[$m]; elseif($keys[$m])$ret[]=$ra[$keys[$m]];
elseif($m && strpos('home all hubs plan taxonomy agenda taxonav',$m)!==false)
	$ret[]=array($v,'url','','/module/'.$o,'','menu','','link');
elseif($m=='lang')foreach(explode(' ',prmb(26).' all') as $va)
		$ret[]=array($v,'url','','lang/'.$va,'','menu','','flag');
elseif(is_numeric($m)){if(!$o)$o=$_SESSION['rqt'][$m][2]; 
	$ret[]=array($o,'art','',$m,'','menu','','articles');}
elseif($_SESSION['line'][$m])$ret[]=array($m,'url','','/section/'.$m,'','menu','',$o?$o:'list');
elseif($m=='module' && $o)$ret[]=array($o,'url','','/module/'.$o,'','menu','','link');
elseif($m=='hub')$ret[]=array($o,'url','',$m?$m:prep_host($m),'','menu','','home');
elseif($m=='mod')$ret[]=array($o,'url','','/?slct_mods='.$o,'','menu','','home');
elseif($m=='rss')$ret[]=array($o,'url','blank','/rss/'.ses('qb'),'','menu','','rss');
elseif($m=='plug')$ret[]=array($o,'plug',ajx($o),'','','menu','','get');
elseif($m=='categories'){$line=$_SESSION['line']; if($line){ksort($line);
	foreach($line as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
		$ret[]=array($ka,'url','','/section/'.$k,'','menu','','list');}}}
elseif(substr($m,0,1)=='/')$ret[]=array($o,'url','',$m,'','menu','','get');}
return $ret;}

function rssj_m($p,$o){return title('Rss').divd('rssj',rssj('rssurl'.($p?'_'.$p:''),$o));}

function msql_links($p,$o,$l,$d,$t){
$defs=msql_read('',$_SESSION['qb'].'_'.$p,'',1);
if($defs)foreach($defs as $k=>$v){
	if($o=='mail'){$v[0]=$va=$k;}
	elseif($v[1]=='_' or !$v[1])$va=preplink($v[0]); else $va=$v[1];
	if($v)$ret.=llk("",$l.$v[0],$va);}
if($d=='scroll')$ret=scroll_b($defs,$ret,$o);
if($ret)return $t.balc("ul","panel",$ret);}

function recents_arts($d,$o){$o=$o?$o:10; 
$wh=' nod="'.ses('qb').'"';//slowlog
if($d=='auto')$wh.=' AND frm="'.$_SESSION['frm'].'"'; 
elseif($d!='all' && $d!=1 && $d)$wh.=' AND frm="'.$d.'"';
if($_SESSION['auth']<4)$wh.=' AND re>="1"';
return sql('id','qda','k',$wh.' ORDER BY id DESC LIMIT '.$o);}

function pub_art_b($id,$o){
list($dy,$frm,$suj,$amg)=pecho_arts($id);
if(rstr(32))$img=minimg($amg,"hb"); $lnk=urlread($id);
return divc("txtcadr",lkc("",$lnk,$suj)).divc("panel",read_msg($id,$o?$o:2));}

function pub_img($id){
list($dy,$frm,$suj,$amg)=$_SESSION['rqt'][$id];
if(!$dy){$amg=sql('img','qda','v','id='.$id);}
return lkc("",urlread($id),minimg($amg,'ban'));}

function read_art($n,$t){$in=read_msg($n,"");
if(strlen($in)>1000)$nbc=array("1","1");
if(is_numeric($n))$tit=suj_of_id($n); else $tit=$n;
if($t)$ret=divc("txtcadr",$t==1?$tit:$t); $ret.=divc("panel",scroll_b($nbc,$in,0));
if(trim($in))return $ret;}

function wall_arts($t,$p){$id='wall'.$p;
if($t)$ret=btn('txtcadr',$t).br().br();
$ret.=lj('','popup_track___'.$id,picto('chat§32').picto('add')).br().br();
$ret.=divd('track'.$id,output_trk(read_idy($id,'DESC')));
return $ret;}

function friend_rub($o){
$id=id_of_suj($_SESSION['frm']);
$ok=sql('id','qda','v','id='.$id.' and re>"0"');
$ret=sql('msg','qdm','v','id='.$id);
if(auth(4))$bt=popart($id);
if($ok)return $bt.divc($o,format_txt($ret,'',''));}

function friend_art($o){
if($_SESSION['read']){$id=id_of_suj($_SESSION['read']); $in=read_msg($id,1,"");}
if(is_numeric($id)) return divc($o,$in);}

function timetravel_m(){$r=timetravel();
$travel=date('Y',ses('daya'));
foreach($r as $k=>$v){$c=$k==$travel?'active':'';
	$ret.=lkc($c,target_date($v),$k).' ';}
$ret=lkc('popdel','/reload/'.ses('qb'),nms(82)).' '.btn('nbp',$ret);
return $ret;}

function taxonomy($p,$o){$p=$p?$p:'taxonomy';
$superline=collect_hierarchie_c("reverse",$o);
if($superline){$ret=build_titl($superline,$p,63); 
$ret.=divc("taxonomy",make_menus_r($superline));}
return $ret;}

function rub_taxo($p,$t){$id=ses('read');
if($p==1)$p=$_SESSION['frm']; elseif($p=='art')$p=ib_of_id($id);
if($p)$taxcat=supertriad_dig($p);//permanent//$_SESSION['superline'][$p];//cache
if($p>1){$t=lka(urlread($p),suj_of_id($p)).br();
	$hie=collect_hierarchie_c(0,''); $taxcat=find_in_subarray($hie,$p);}
$t=build_titl($taxcat,$t,1);
if(is_array($taxcat))return $t.divc('taxonomy',make_menus_r($taxcat));}

function taxo_arts($p){
if($p==1)$v=$_SESSION['frm']; if(!$p)$p=ib_of_id(ses('read'));
if(!is_numeric($p)){$taxcat=$_SESSION['superline'][$p];}
elseif(is_numeric($p)){$hie=supertriad_c($_SESSION['dayb']); $taxcat=$hie[$p];}
return $taxcat;}

//desktop
function apps_files_build($r,$rb,$dr){
foreach($r as $k=>$v){
	if(is_array($v))$rb=apps_files_build($v,$rb,$dr.'/'.$k);
	else $rb[]=array($dr.'/'.$v,$dr);}
return $rb;}

function apps_files_dir($o){$qb=ses('qb');
if(substr($o,0,strlen($qb))!=$qb)$o=$qb.($o?'/'.$o:'');
$r=explore('users/'.$o); $rb=array();
if($r)return apps_files_build($r,$rb,$o);}

function apps_files($cnd,$p,$o){
if(!$p)$p='local|real'; $rb=explode('|',$p); if($o)$o=str_replace('|','/',$o);
if($rb[0]=='global')$r=msql_read('server','shared_files','',1);
elseif($rb[1]=='real')$r=apps_files_dir($o);
else $r=msql_read('users',$_SESSION['qb'].'_shared','',1);
if($r)foreach($r as $k=>$v){
if(!$o or substr($v[0],0,strlen($o))==$o){list($dir,$nm)=split_one('/',$v[0],1); 
	if($rb[1]=='virtual')$dir=$v[1]; else $dir=strchr_b($dir,'/');
	$rc[]=array($nm,'file','',$v[0],$cnd,'',$dir,mimes_types(xt($nm)));}}
return $rc;}

function apps_varts($cnd,$p){
if($p){if($p=='cache')$ra=$_SESSION['rqt']; else $ra=make_list_arts($p);}
$wh='qb="'.ses('qb').'" AND val="folder"';
$rb=sql('ib,msg','qdd','kv',$wh); 
if($rb)foreach($rb as $k=>$v){if(($p && $ra[$k]) or !$p)
		$rc[]=array($k,'art','auto',$k,$cnd,'',$v,'articles');}
return $rc;}

function apps_arts($cnd,$p,$o){
if($p)$r=make_list_arts($p); else $r=$_SESSION['rqt'];
if($r)foreach($r as $k=>$v){list($day,$frm)=pecho_arts($k);
	if(substr($frm,0,1)!='_')
		$rb[]=array($k,'art','auto',$k,$cnd,'',$frm,'articles');}
return $rb;}

function desktop_arts($p,$o,$cnd,$no=''){poplist();
if($o)$ob=str_replace('|','/',$o); $ob=strchr_b($ob,'/');
$r=desktop_apps($cnd,$ob,$p,$o); 
return desktop_build_ico($r,'icones').divc('clear','');}

function art_viewer($r){$rid='artv'.randid(); $id=key($r); $ret=art_read_b($id,'',2,'');
if(count($r)>1)foreach($r as $k=>$v){$i++; $m.=lj('',$rid.'_artone___'.$k.'_2',$i);}
return divc('nb_pages',$m).divd($rid,$ret);}

function deskmod($p){req('ajxf'); 
$ret=desktop_ico('desk'); $sty='position:relative; width:100%;';
return divc('desk',$ret);}

//sources
function recup_srcs_b(){$r=$_SESSION['rqt'];
if($r)foreach($r as $k=>$v)if($v[9] && $v[9]!="mail"){$purl=http_domain($v[9]); 
	$purl=str_replace(array('.wordpress','.blogspot','.pagesperso-orange'),'',$purl);
	if($purl)$ret[$purl]+=1;} return $ret;}
function art_sources($o){$r=recup_srcs_b(); if($r){arsort($r);
foreach($r as $k=>$v){if($o)$ad=' ('.$v.')'; 
$lin[]=array($k,htac('source').strdeb($k,'.'),'',$k.$ad);}}
return $lin;}

//tags
function classtag_arts($cat){
if(ses('nbj'))$dy=' and day<"'.ses('daya').'" AND day>"'.ses('dayb').'"';
$wh='and cat="'.$cat.'"'.$dy.' order by day desc';
return artags('idart',$wh,'k');}

function tags_cloud($line,$smin,$smax,$sep,$go){
if($line){arsort($line); $ratio=($smax-$smin)/log(max($line));
foreach($line as $k=>$fa){$size=round((log($fa)*$ratio)+$smin);
$css='popbt" style="font-size:'.$size.'px;';
$ret.=lkc($css,htac($go).$k,$k."&nbsp".'('.$fa.')').$sep."\n";}}
return $ret;}

function most_read($dyb,$mx=''){
$dayb=$dyb?calc_date($dyb):$_SESSION['dayb']; $mx=$mx?$mx:50;
return sql('id,lu','qda','kv','nod="'.ses('qb').'" AND re>="1" AND day>'.$dayb.' ORDER BY lu DESC LIMIT '.$mx);}

function most_read_mod($p,$t,$d,$o,$m,$tp){
list($dyb,$mx)=explode('-',$p); $r=most_read($dyb,$mx); unset($r[80301]);
$ta=dig_it_j($dyb,'mostread_ajxlnk___VAR-'.$mx.'/'.ajx($t).'/'.$d.'/'.$o.':'.ajx($m));
$t=lkc('','/module/most_read/'.$p.'/'.$t.'/'.$d,$t!=1?$t:'most_read');
if($r)return divd('mostread',$ta.mod_load($r,'',$t,$d,$o,1,$o,$tp,''));}

function short_arts($p=4000){$dayb=$dyb?calc_date($dyb):$_SESSION['dayb'];
return sql('id','qda','k','nod="'.ses('qb').'" AND re>="1" AND day>'.$dayb.' AND host<'.$p.' ORDER BY '.prmb(9));}

function trkarts($t){
$nbdays=$_SESSION['nbj']; $daybb=calc_date($nbdays); //getorpost('dig',)
$load=sql('frm','qdi','k','nod="'.ses('qb').'" AND day>'.$daybb.' AND day<'.ses('daya').' ORDER BY day DESC');
if($load){$ret=build_titl($load,'Tracks',34); 
	if($_GET['admin'])$ret.=dig_it($nbdays,'admin/trackbacks');
	$ret.=output_pages_spe($load,1,'track');
return $ret;}}

function related_art(){$val=@$_SESSION['opts']['related'];
if($val)return array_flip(explode(" ",$val));}

function related_art_by(){if(ses('read'))return sql('ib','qdd','k','qb="'.ses('qb').'" AND val="related" AND msg="'.ses('read').'"');}

function same_title(){return sql('id','qda','k','suj="'.ses('read').'" AND nod="'.ses('qb').'" AND id!="'.ses('read').'" ORDER BY id DESC');}

function see_also_rub($p){$frm=$p!=1?$p:$_SESSION['frm'];
$frmline=tri_rqbase($frm,1,1,ses('daya'),ses('dayb'),ses('qb'));
return $frmline[$frm];}

function see_also($r,$p,$d='',$o='',$tp=''){
foreach($r as $kb=>$pb){$t=lka(htac(eradic_acc($p)).$kb,$kb);
	if($pb)$rc[$kb]=mod_load($pb,'',$t,$d,$o,0,'',$tp,'');}
if(count($rc)>1)$ret=make_tabs($rc,'mod'.randid()); else $ret=$rc[$kb];
return $ret;}

function see_also_tags($cat,$nbdays='30'){$id=ses('read');
$r=ses('artags'); $r=$r?$r:art_tags($id); $rtag=$r[$cat];
if($rtag)foreach($rtag as $tag=>$v){
	$r=tag_arts($tag,$cat,$nbdays); if(!$r)$r=tag_arts($tag,$cat);
	if($r)foreach($r as $k=>$v)if($k!=$id)$ret[$tag][$k]+=1;}
return $ret;}

function see_also_source($o=''){$o=$o?$o:10;
$id=ses('read'); $src=$_SESSION['rqt'][$id][9];
if(!$src)$src=sql('mail','qda','v','id='.ses('read'));
if($src){$src=preplink($src);
foreach($_SESSION['rqt'] as $k=>$v)if(preplink($v[9])==$src)$ret[$k]+=1;
if(!$ret && $src)$ret=sql('id','qda','k','mail LIKE "%'.$src.'%" limit '.$o);
if($ret){unset($ret[$id]);
return array($ret,lka(htac('source').strdeb($src,'.'),$src));}}}

function rub_tags($t){$t=$t?btn('txtcadr',$t):'';//not tested
$dayb=$_GET['dig']?calc_date($_GET['dig']):$_SESSION['dayb'];
$r=tag_arts($tag,$cat,$dayb);
if($r)$tags=slct_menus($r,htac('rub_tag'),$_GET['rub_tag'],'active','','k');
return $t.btn("nb_pages",$tags).br();}

function prevnext_art($b,$t,$o){
$ra=explode("|",$t); $htacc=htacc('read'); $id=$_GET['read'];
$ta=$ra[0]?$ra[0]:callico('kleft'); $tb=$ra[1]?$ra[1]:callico('kright'); 
if($_SESSION['rqt']){krsort($_SESSION['rqt']);
	foreach($_SESSION['rqt'] as $k=>$v){
		if($b=="rub"){if($v[1]==$_SESSION['frm'])$r[]=$k;} else $r[]=$k;}}
if($r)$rb=array_flip($r); //if(!in_array($id,$r))
if(!$rb[$id]){$dt=sql('day','qda','v','id='.$id);
	$w='nod="'.ses('qb').'" AND day>'.($dt-86400).' AND day<'.($dt+86400).' ORDER BY '.prmb(9);
	$r=sql('id','qda','vr',$w);}
if($r)foreach($r as $k=>$v){if($v==$id){
$k1=$r[$k+1]?$r[$k+1]:""; $k2=$r[$k-1]?$r[$k-1]:""; $prnx=array($k1,$k2,$v);}}
$prevnext.=lkc(($prnx[0]?'':'hide'),$htacc.($prnx[0]?$prnx[0]:$prnx[2]),$ta).' ';
$prevnext.=lkc(($prnx[1]?'':'hide'),$htacc.($prnx[1]?$prnx[1]:$prnx[2]),$tb);
if($prevnext)return btn('nb_pages '.($o?$o:'right'),$prevnext);}

function search_btn($va,$o,$id='',$d=''){
if($id)$di='ada'; else $id='srch'; $t=$va!=1?$va:nms(24); 
if($o>1)$s=$o; else{$s=10; if($o){if(strpos($o,';')===false)$c=atc($o); else $c=ats($o);}}
$j='SearchT(\''.$id.'\')'; $js='onClick="'.$j.'" onkeyup="'.$j.'" onContextMenu="'.$j.'';
$ret=autoclic($id.'" '.$js,$t,$s,'100','');
if(!$d)$ret=div('id="'.$di.'"'.$c.'',$ret);
return $ret;}

function login_btn($va,$o){$t=$p!=1?$p:""; 
$ret=loged(ses('USE'),$_SESSION['iq'],$t);
if($o)$ret=divc("imgr",$ret);
return $ret;}

function login_btn_p($p,$o){$t=$p?$p:"login"; 
$jx='popup_loged___'.ses('USE').'_'.$_SESSION['iq'].'_'.ajx(nms(54)).'_1';
return lj('txtcadr',$jx,$t);}//if(!ses('USE'))

function search_conn($ra,$min,$cn){
$req=sq('id,msg','qdm','where id>="'.$min.'" AND msg LIKE "%'.$cn.'%" ORDER BY id DESC');
while($rq=mysql_fetch_row($req)){if(in_array($rq[0],$ra)){
	$r=explode($cn,$rq[1]); $n=count($r); if(!$r[1])return; 
	else{for($i=0;$i<$n-1;$i++){$s=strrpos($r[$i],'['); 
		if($s!==false)$ret[]=array($rq[0],substr($r[$i],$s+1));}}}}
return $ret;}

function videoplaylist($p=7){$qda=ses('qda'); $qdm=ses('qdm');//$ra=$_SESSION['rqt'];
return sql_b('select '.$qda.'.id from '.$qda.' inner join '.$qdm.' on '.$qda.'.id='.$qdm.'.id where nod="'.ses('qb').'" and re>="1" and day>'.calc_date($p?$p:ses('nbj')).' and '.$qdm.'.msg like "%:video%" order by id desc','k');}

function videoboard($p,$c,$o){static $iv; $iv++; $ra=array(); 
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
$thr=tri_rqt('4',11); $two=tri_rqt('3',11); $one=tri_rqt('2',11);
if($two){if($one)$one+=$two; else $one=$two;}	
if($one){foreach($one as $id=>$nb){
	if($_SESSION['rqt'][$id][1]==$frm or $frm=="Home"){
		if($_SESSION['rqt'][$id][0]>=$dad){$v=pub_art($id); if($v)$re[$id]=$v;}}}
if($re){krsort($re); $ret.=build_titl($re,'24h',1);
$ret.=columns($re,$prm,'board','panel pubart').br();}}
if($two){$re=""; foreach($two as $id=>$nb){
	if($_SESSION['rqt'][$id][1]==$frm or $frm=="Home"){
		if($_SESSION['rqt'][$id][0]<$dad){$v=pub_art($id); if($v)$re[$id]=$v;}}}
if($re){krsort($re); $ret.=build_titl($re,nbof($_SESSION['nbj'],3),1);
	$ret.=columns($re,$prm,'board','pubart').br();}}
if($thr){$re=""; foreach($thr as $id=>$nb){
	if($_SESSION['rqt'][$id][1]==$frm or $frm=="Home"){
		$v=pub_art($id); if($v)$re[$id]=$v;}}
	if($re){krsort($re); $ret.=build_titl($re,'***',1);
	$ret.=columns($re,$prm,'board','pubart').br();}}
if($ret){return $ret;}}

function icotag(){
$t='related_arts related_by see_also-source source rub_taxo taxo_arts same_title tags '.prmb(18); $r=explode(' ',$t); $n=count($r);
$t='up down home home topo-open topo articles tag '.prmb(19); $ico=explode(' ',$t);
for($i=0;$i<$n;$i++)$ret[$r[$i]]=picto($ico[$i]);
return $ret;}

function tab_mods($p){$r=val_to_mod_b($p); $ico=sesmk('icotag');
foreach($r as $k=>$v){$md=build_mods($v);
	$k=$ico[$k]?$ico[$k]:$k;
	if($md)$rc[$k]=$md;}
return make_tabs($rc,'tmod'.randid());}

function art_mod($p,$d,$o){curwidth_set($o);
if($d=='tabmods')return tab_mods($p);
elseif($d=='menusJ')return ajxlink($p,'mjx',0,0);
elseif($d=='togup')return ajxlink($p,'mjx',0,'togup');
$r=val_to_mod_b($p);
foreach($r as $k=>$v)$ret.=build_mods($v);
return $ret;}

function mod_columns($p,$o){$r=val_to_mod($p);
foreach($r as $k=>$v)$re[]=build_mods($v);
return columns($re,count($re),'','');}

function rartmod(){$r=$_SESSION['modc']['system'];
foreach($r as $k=>$v)if($v[0]=='art_mod')return $v;}

function build_art_mod($in){$ra=rartmod();
list($m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr)=$ra;//$o=$o?$o:140;
$ret=art_mod(ajx($p,1),$d,$o);
if(trim(strip_tags($ret))){
	if($t)$reb=divc('txtcadr',stripslashes($t));
	$ret=$reb.$ret.($nbr?br():'');}//
$_SESSION['cur_div']='content';
if($in)return divb('right|artmod|width:'.$o.'px; margin-left:10px;',$ret);
else return divs('width:100%',$ret);}

function build_artmod_bub(){$ra=rartmod();
list($m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr)=$ra;//$o=$o?$o:140;
$r=val_to_mod_b($p); foreach($r as $k=>$v)$ret[]=array($m,$p,$d);
return $ret;}

function usited_words($p){$p=$p?$p:ses('read');
$msg=sql('msg','qdm','v','id="'.$p.'"');
$r=explode(' ',$msg); foreach($r as $k=>$v){$ret[$v]+=1;}
arsort($ret); return $ret;}

function com_mod($p){
return input(1,'cmod','" size="20').lj('txtbox','content_ajxlnk_cmod',picto('kright'));}

//plan
function home_plan($load,$n){if($load){ksort($load);
foreach($load as $mrf=>$ids){$i++; 
	$line=$_SESSION['line'][$mrf]; $mn=$_SESSION['mn'][$mrf]; 
	if($n==2)$re=outputimg($ids); else $re=m_pubart($ids,"scroll","10000");
	if($mrf!="user" && $mrf!="_system" && $re && ($line or $mn)){
		if($n==2)$nib=25; else $nib=7;
		if($line)$got=htac('section').$mrf; else $got=subdom($mrf);
	$nbrt=btn("txtsmall2",nbof(count($ids),1));
	$ret[$i]=lkc('txtcadr',$got,$mrf).' '.$nbrt.br();
	$ret[$i].=divc("tab",scroll($ids,$re,$nib)).br();}}
if($ret){if(count($ret)<2 or $n==2) $prm=1; else $prm=2;
return columns($ret,$prm,'board','pubart');}}}

function arts_plan($conn,$v){$t=$v!=1?$v:$conn; 
if($conn=="plan" or $conn=="hubs")$n=1; else $n=2;
if($conn=="hubs")$load=see_hubs();
else $load=tri_rqbase("",4,1,ses('daya'),ses('dayb'),ses('qb'));
$rb=home_plan($load,$n); if($rb)return build_titl($load,$t,61).$rb;}

function see_hubs(){
if($ra=$_SESSION['mn']){foreach($ra as $k=>$v){
$r=msql_read("users",$k.'_cache','');
if($r)foreach($r as $ka=>$va){$ret[$k][$ka]+=1;}}}
return $ret;}

function make_ban($here,$t){$qb=ses('qb');
$htacc=subdom($qb); $banim='img/ban_'.$qb.'.jpg';
if(file_exists($banim))return lkc("",$htacc,img($banim));
else return bal('h1',lka($htacc,$t?$t:$_SESSION['mn'][$qb]));}

function footer(){
$_SESSION['cur_div']='footer';
$r=val_to_mod('credits,chrono,log-out');
foreach($r as $k=>$v){$ret.=build_mods($v);}
return $ret;}

?>