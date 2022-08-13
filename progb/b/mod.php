<?php //modules
class mod{

/*static function find_mod($n){
foreach($_SESSION['mods'] as $k=>$v)if(key($v)==$n)return $v;}*/

static function mkmodr($set){$ret='';
if(is_numeric($set)){$r=msql::row('',nod('mods_'.prmb(1)),$set);
	if($r)array_shift($r); return self::mkmods($r);}
else $r=self::val_to_mod($set);
$_SESSION['cur_div']='content';
foreach($r as $k=>$v)$ret.=self::mkmods($v);
return $ret;}

//param/title/command/option:module[,]
static function val_to_mod($d){$r=explode(',',$d);
$t='';$cmd='';$o='';$ch='';$hd='';$tp='';$br='';$dv='';$aj='';$pop='';
foreach($r as $k=>$v){[$val,$conn]=split_right(':',$v,1);
	if(strpos($val,'*')!==false)$val=str_replace('*','/',$val);
	if(strpos($val,'/')!==false){$rb=explode('/',$val);
		[$val,$t,$cmd,$o,$ch,$hd,$tp,$br,$dv,$aj]=vals($rb,[0,1,2,3,4,5,6,7,8,9]);}
	$ret[]=[$conn,$val,$t,'',$cmd,$o,$ch,$hd,$tp,$br,$dv,$aj,$pop];}
return $ret;}

//param/title/command/option:module->target§button[,]
static function val_to_mod_b($p,$id=''){$ret=[];
$p=str_replace("\n",'',$p); $r=explode(',',$p); $n=count($r);
for($i=0;$i<$n;$i++){//$d='scroll'; $o='12';
	[$comline,$t]=split_right('§',trim($r[$i]),1);
	if(is_numeric($comline)){$rb=msql::row('',nod('mods_'.prmb(1)),$comline);
		if($rb)array_shift($rb); $mod=array_shift($rb);
		[$p,$tb,$d,$c,$o,$ch,$hd,$tp,$br,$dv,$aj]=$rb;}
	else{
		[$code,$mod]=split_right(':',$comline,1);
		$d=$o=$ch=$hd=$tp=$br=$dv=$aj='';
		if(strpos($code,'/')!==false)
			[$p,$tb,$d,$o,$ch,$hd,$tp,$br,$dv,$aj]=expl('/',trim($code),10);
		else{$p=trim($code);$tb='';}}
	if(!$t)$t=$tb?$tb:$p;
	$p=$p=='id'?$id:$p;
	$ret[$t?$t:$p]=[$mod,$p,$tb,'',$d,$o,$ch,$hd,$tp,$br,$dv,$aj];}
return $ret;}

static function build_modules($va,$cr){
$r=sesr('modc',$va); $_SESSION['cur_div']=$va; $ret=''; //pr($r);
if($r)foreach($r as $k=>$v){if(!$v[7]){//hide
	if($v[6]){//cache
		if(!sesr('tab',$k) or $cr){$re[$k]=self::mkmods($v); 
			$_SESSION['tab'][$k]=$re[$k];}
		else $re[$k]=$_SESSION['tab'][$k];}
	elseif(!empty($v[11]))$re[$k]=divd('mod'.$k,lj('txtcadr','mod'.$k.'_md::modj___'.$k.'_'.$va,$v[2]));
	elseif(!empty($v[12]))Head::add('jscode',sj('popup_mod,mkmodr___'.$k));
	else $re[$k]=self::mkmods($v);
if($re[$k])$ret.=$re[$k]."\n";}}
$_SESSION['cur_div']='content';
return $ret;}

static function mkmods($r){
$cs='panel'; $csb='small'; $lin=[]; $load=[]; $api=''; $ret=''; $prw=''; $id=''; $obj='';
//mod,param,title,condition,command,option,(bloc),hide,template,nobr,div,ajxbtn
[$m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr,$dv,$pv]=arr($r,12);
$t=stripslashes($t);
if($pv && auth(6) or !$pv)
switch($m){
//main
case('LOAD'):if($_SESSION['read'])$ret=art::read($tp);
	else $ret=api::arts(ses('frm'),$o,$tp); break;
case('article'): $_SESSION['read']=$p; $ret=art::read($tp); break;
case('Page_titles'):$ret=self::page_titles($o); break;
case('All'):$api=api::arts_rq($p,$o); $api['t']=$t?$t:nms(100); break;
case('category'):if($p==1 && ses('frm')=='Home')$p='All'; 
	$ret=api::arts($p,$o,$tp); break;
case('Board'):$ret=md::collect_board($p); break;
case('plan'):$ret=self::arts_plan($m,$p,$o); break;
case('Hubs'):$ret=self::arts_plan($m,$p,$o); break;
case('gallery'):$ret=self::arts_plan($m,$p,$o); break;
case('tracks'):$ret=md::trkarts($p,$t,$d,$o); break;//api::tracks($t)
case('trkrch'):$ret=trkrch($p); break;
case('MenusJ'):$ret=self::ajxlink($p,'mjx',$o,$d); break;
case('api'):$ret=api::call(str_replace(';',',',$p),$o); break;
case('api_mod'):$api=api::defaults_rq(explode_k(str_replace(';',',',$p),',',':')); break;//:,
case('api_arts'):$api=api::mod_arts($p,$t,$tp); if($d=='panel')$api['cmd']=$d; $api['cols']=$o; break;
case('articles'):$load=api::mod_arts_row($p); $obj=1; break;
//case('articles'):$api=api::mod_rq($p.'&t=x'); break;//&=
case('tab_mods'):$ret=self::tab_mods($p); break;
case('last'):$ret=art::playb('last',3); break;
case('cover'):$ret=md::cover($p,$o,$tp); break;//:,
case('player'):$ret=flash_prep('',$p); break;
case('friend_art'):$ret=md::friend_art($o); break;
case('friend_rub'):$ret=md::friend_rub($o); break;
case('related_arts'):$load=md::related_art($p); break;
case('related_by'):$load=md::related_by($p); break;
case('child_arts'):$load=md::child_art($p); break;
case('parent_art'):$load=md::parent_art($p); break;
case('prev_next'):$ret=md::prevnext_art($d,$o,''); break;
case('cat_arts'):$p=$p!=1?$p:ses('frm'); $t=$t!=$m?$t:$p; $load=ma::tri_rqt($p,1); break;
case('priority_arts'):$load=ma::tri_rqt($p,'lu'); $t=$t!=$m?$t:$p; break;
case('recents'):$load=md::recents_arts($p,$o); $obj=1; break;
case('read'):$ret=divc($o,ma::read_msg($p,3)); break;
case('popart'):$ret=pop::btart($p); break;
case('pub_art'):$ret=md::pub_art_b($p,$t,$o); break;
case('pub_arts'):$load=array_flip(explode(' ',$p)); break;
case('pub_img'):$ret=md::pub_img($p); break;
case('taxo_arts'):$load=md::taxo_arts($p); if($t>1)$t=ma::suj_of_id($t); break;
case('taxo_nav'):$ret=taxonav::call($p,$o); break;
case('read_art'):$ret=md::read_art($p,$t,$o); $t=''; break;
case('short_arts'):$load=md::short_arts($p); if($o<=3)$prw=$o; break;
case('most_read'):$ret=md::most_read_mod($p,$t,$d,$o,$m,$tp); $t=''; break;
case('most_polled'):$load=md::most_polled($p,$o); break;
case('score_datas'):$load=md::score_datas($p,$o); break;
case('same_title'):$load=md::same_title($p); break;
case('deja_vu'):$load=ses('mem'); break;
//com
case('context'):$ret=md::call_context($p); break;
case('rss_input'):if($p)$ret=rss::call(ajx($p,1)); break;
case('disk'):$_SESSION['dlmod']=$p; if($p && $p!='/')$pb='/'.$p;
	$ret=divd('dsnavds',finder::ds_nav('dl','users/'.ses('qb').$pb)); break;//!
case('finder'):$ra=['|','-']; $p=str_replace($ra,'/',$p); $o=str_replace($ra,'/',$o);
	$ret=finder::home($p,$o,$d); break;
case('channel'):$ret=plugin('channel',$p,$t,$d,$o); $t=''; break;
case('hour'):timelang();//%A%d%B%G%T
	if($p)$dat=strftime($p?$p:'%y%m%d:%H%M',$_SESSION['dayx']); else $dat=mkday('',1);
	if(!$d)$ret=btn($o,$dat); else $ret=divc($o,$dat); break;
case('cart'):$ret=lkc('txtcadr','/?plug=cart',$p!=1?$p:'Cart');
	$ret=divd('cart',self::m_pubart($_SESSION['cart'],'scroll',7)); break; 
case('video'):$ret=video::any($p,'',3,''); break;
case('video_viewer'):$ret=usg::videoboard($p,$c,$o); break;
case('conn_playlist'):$api=api::arts_rq('',''); $api['media']=$p; $api['t']=$t; break;
case('api_chan'):$ret=md::apichan($p,$t,$o,$tp); break;
case('special_polls'):$ret=md::special_polls($p,$t,$o); break;
case('quality_stats'):$ret=md::quality_stats($p,$t,$o); break;
//txt
case('text'):$ret=stripslashes(urldecode($p)); if($o)$ret=divc($o,$ret); break;
case('clear'):$ret=divc('clear',''); break;
case('hr'):$ret='<hr'.atc($p).' />'; break;
case('br'):$ret=br(); break;
case('connector'):if($t)$ret=self::build_titl('',$t);
	if($o=='article')$ret.=balc('article','justy',conn::read($p,'',''));
	else $ret.=conn::read($p,'',''); break;
case('codeline'):if($p)$ret=codeline::parse($p,'','template'); break;
case('conn'):$ret=conn::connectors($p,$o,'',''); break;
case('basic'):$ret=codeline::mod_basic($p,$o); break;
//menus
//case('ajax'):$ret=lj('',$p,$t); break;
case('link'):if($d=='noli')$ret=md::special_link($p,$o); else{
	if(strpos($p,'§'))[$p,$t]=split_one('§',$p,0); $lin[]=self::mod_link_r($p,$t);} break;
case('user_menu'):$ret=md::user_menu($p); break; //mod_link
case('app_link'):$ret=self::read_apps_link($p,$d,$o); break;
case('app_menu'):$r=self::build_apps($p,$d); $ra=apps::build($r,'menu','');
	if($o=='icons')$ret=apps::ico($ra,'icones'); 
	else $ret=apps::applist($ra,'',$o); $ret.=divc('clear',''); break;
case('app_popup'):Head::add('jscode',sj(apps::read(explode(',',$p)))); break;
case('categories'):$line=ses('line'); if($line){ksort($line);
	$d=$d?$d:'lines'; if($d=='cols' && !$o)$o=4;
	if($o=='home')$lin[]=[get('frm'),'cat','Home',nms(69)];//
	foreach($line as $k=>$va){
		if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
		if(rstr(112))$ka=catpic($k,20);
		$lin[]=[ses('frm'),'cat',$k,$ka];}} break;
case('categories2'):$line=sql('cat,id','qdc','kv',['qb'=>ses('qb')]); if($line){asort($line);
	$d=$d?$d:'lines'; if($d=='cols' && !$o)$o=4;
	if($o=='home')$lin[]=[get('frm'),'cat','Home',nms(69)];//
	foreach($line as $k=>$va){$ka=$k;
		if($o=='nb')$ka.=' ('.$va.')'; 
		if(rstr(112))$ka=catpic($k,20);
		$lin[]=[ses('frm'),'catid',$va,$ka];}} break;
case('overcats'):return mkbub(bubs::root('overcat','zero'),'inline','1'); break;
case('MenuBub'):return mkbub(bubs::root('menubub'.$p,'zero'),'inline','1'); break;
case('timetravel'):return md::timetravel_m($p,$o); break;
case('submenus'):return md::bubble_menus($p,$o); break;
case('taxonomy'):$ret=md::mod_taxonomy($p,$o); break;
case('rub_taxo'):$ret=md::rub_taxo($p,$t); $t=''; break;
case('folders'):$load=md::supertriad_ask($p,$o); $prw=$o; $obj=63; break;//rstr(5)?2:1
case('desk'):$ret=apps::deskmod($p); break;
case('desktop_apps'):$r=apps::build_from_datas($o?$o:'desk','','','');//apps::desktop($o?$o:'desk','','','')
	$ret=apps::ico($r,'icones'); break;
case('desktop_arts'):$ret=self::mdtitle($t).apps::deskarts($p,$o,'arts'); break;
case('desktop_varts'):$ret=self::mdtitle($t).apps::deskarts($p,$o,'varts'); break;
case('desktop_files'):$ret=self::mdtitle($t).apps::deskarts($p,$o,'files'); break;
case('hierarchics'):$in=md::suj_hierarchic('active',''); $ret=balc('ul',$cs,$in); break;
//cacheable
case('hubs'):$mn=$_SESSION['mn']; if(count($mn)>=2){$t=$p!=1?$p:$t;
	if($t)$t=lkc('',htac('module').'hubs',$t);
	$in=md::nodes_b($mn,$o); $ret=balc('ul',$cs,$in);} break;
case('cats'):$lin=md::cat_mod($p,$o,$d); break;
case('catj'):$ret=md::cat_mod_j($p,$o,$d); break;
case('tags'):
	$t=lj('menus','popup_tags,home__3_'.$p.'_1',pictxt('tag',$t?$t:$p));
	$lin=md::tag_mod($p,$o,$d); break;
case('clusters'):$lin=md::cluster_mod($p,$o,$d); break;
case('tags_cloud'):$p=$p?$p:'tag';
	$ret=self::build_titl('',lj('','popup_tags,home__3_'.$p.'_1',$t));
	$in=md::tags_cloud($p,10,22); $ret.=divc($cs,$in); break;
case('tag_arts'):[$p,$o]=split_one(':',$p); $load=ma::tag_arts($p,$o); break;
case('classtag_arts'):$load=md::classtag_arts($p); break;//class find id//$o=$p;
case('last_tags'):$lin=md::last_tags($p,$o); break;
case('last_search'):$ret=md::last_search($p,$o); break;
case('frequent_tags'):$lin=md::frequent_tags($p,$o); break;
case('see_also-tags'):$r=md::see_also_tags($p?$p:'tag'); 
	if($r)$ret=see_also($r,$p,$d,$o,$tp); break;
case('see_also-rub'):$t=$p!=1?$p:ses('frm');
	if(get('read'))$load=md::see_also_rub($p); break;
case('see_also-source'):[$load,$t]=md::see_also_source($o); break;
case('siteclics'):$ret=md::siteclics($p); break;
case('rub_tags'):$ret=md::rub_tags($p); break;
case('sources'):if($t)$t=lkc('','/module/source',$t); $lin=md::art_sources($p); break;
case('msql_links'):if($o=='rss')$l='/app/rssin';
	elseif($o=='mail')$l='mailto:'; else $l=''; $ret=self::msql_links($p,$o,$l,$d,$t); $t=''; break;
case('rss'):$ret.=balc('ul','panel',divd('rssj',rss::home($p?$p:'rssurl',$o))); break;
case('rssin'):$ret.=self::rssj_m($p,$o); break;
case('chat'):if($t)$t=lj('','cht'.$p.'_chat___'.$p,$t);
	$p=$p!=1?$p:'pub'; $in=plugin('chat',$p,$o?$o:10); 
	if($in)$ret=divc($cs,$in); break;
case('stats'):$ret=plugin('stats','',''); break;
case('archives'):if($p==1)$p=$m; if($p)$ret=self::build_titl('',$p);
	$in=divd('archives',few::archives('')); $ret.=balc('ul',$cs,$in); break;
case('agenda'):$load=sql('ib,msg','qdd','kv','val="agenda"'); $tim=time();
	if($load)foreach($load as $k=>$v)if(strtotime($v)<$tim)unset($load[$k]); break;
case('calendar'):$in=calendar(ses('daya')); if($p==1)$p=$m;
	if($p)$ret=self::build_titl('',$p); $ret.=divc($cs,$in); break;
case('folder'):$lin=apps::vfolders($p); break;
case('folders_varts'):$load=apps::varts($p); break;
case('searched_words'):$ret=searched::look($p); break;
case('searched_arts'):$load=searched::arts($p); break;
case('same_tags'):$load=md::same_tags($p); break;
case('cluster_tags'):$load=md::cluster_tags($p); break;
case('panel_arts'):$ret=plugin_func('panart','panart_build',$p); break;
case('birthday'):$load=md::birthday($p); break;
case('newsletter'):if($o)$ret=lj('txtcadr','popup_mailist,home__3_'.$p,'mailist');
	else $ret=mailist::home($p); break;
case('bridge'):$ret=md::bridge($p,$t); break;
case('fav_mod'):$ret=self::fav_mod($p,$t); break;
case('columns'):$ret=self::mod_columns($p,$o); break;
//users
case('login'):$ret=md::login_btn($p,$o); break;
case('login_popup'):$ret=self::login_btn_p($p,$o); break;
case('log-out'):if(ses('USE'))$ret.=lkc($csb,'/logout',picto('logout')).' '; break;
case('search'):$ret=search_btn($o); break;
//case('social'):$ret=social::home($p,$o); break;//empty
//banner
case('Banner'):$ret=self::make_ban($p,$o,$t); break;
case('ban_art'):if($p!=1)$ret.=lk(subdomain(ses('qb')),ma::read_msg($p,'')); break;
//footer
case('credits'):$ret=lj('bevel','popup_md,about',picto('phi2')); break;
case('admin'):$ret=lkc($csb,'/admin/log/open',$t?$t:picto('admin')).' '; $t=''; break;
case('chrono'):$ret=btn('txtsmall2',round(microtime(1)-$_SESSION['stime'],2).'s').' '; break;
case('contact'):if($p)$ret=plugin_func('tracks','track_form',ses('qb'),$t);
else $ret=contact($t,$o?$o:$csb).' '; break;
//plugs
case('iframe'):$ret=plugin('ifram','',''); break;
case('suggest'):$ret=self::mdtitle(nms(126)).suggest::home($o); break;
case('create_art'):$ret=edit::artform('',''); break;
case('twitter'):if($p)$ret=twit::call($p,$o); break;
case('twits'):if($t)$ret=self::build_titl('',$t,''); $ret.=twit::stream($p,$o); break;
case('webs'):if($t)$ret=self::build_titl('',$t,''); $ret.=web::stream($p,$o); break;
case('profil'):$ret=plugin_func('profil',$p,$o); break;
//special
case('BLOCK'):$ret=self::build_modules($p,''); break;
case('module'):$ret=self::mkmodr($p); break;
case('command'):$ret=self::com_mod($p); break;
case('vacuum'):$ret=self::com_vacuum($p,$o); break;
case('app'):[$pa,$pb,$oa,$ob]=expl('_',$p,4); if($t)$ret=self::build_titl('',$t,'');
	$ret.=appin($pa,$pb?$pb:'home',$oa,$ob); break;
case('plug'):[$pp,$po]=expl('-',$o); if($t)$ret=self::build_titl('',$t,'');
	$ret.=plugin($p,$pp,$po); break;
case('close'):$ret='';
default:if(method_exists($m,'call'))$ret=$m::call($p,$o); else $ret=plugin($m,$p,$o); break;}
if($lin)$ret=self::mod_lin($lin,$t,$d,$o);//menus
elseif($load)$ret=self::mod_load($load,$ret,$t,$d,$o,$obj,$prw,$tp,$id);//arts
elseif($api)$ret=api::load($api);//api
if(!$ret && !$lin && !$load && $p && $m){//user_mods
	$func=msql::val('',nod('modules'),$m);
	if($func && !is_array($func))$ret=codeline::cbasic($func,$p);}
$br=!$nbr?br():'';
if($ret){if($dv)return divc('mod',$ret).$br; else return $ret.$br;}}

static function mod_lin_build($re,$t,$d,$o){$limit=is_numeric($o)?50*$o:50;
if($_SESSION['cur_div']=='menu' or $d=='inline')$ret=implode('',$re);
elseif($d=='cols')$ret=divc('menus',pop::columns($re,$o,'','menus','','mall'));
//elseif($d=='pictos')$ret=apps::ico($re,'');
elseif($d=='icons')$ret=apps::ico($re,'icones').divc('clear','');//
elseif($d=='scroll')$ret=$t.scroll($re,implode('',$re),(is_numeric($o)?$o:17));
else $ret=$t.divc('menus',implode('',$re));
return $ret;}

static function mod_lin($lin,$t,$d,$o){//mod_link_r
if($lin)foreach($lin as $k=>$v){//.($o=='nospace'?'':' ')
	if(strpos($v[0],':')!==false)$v[0]=strprm($v[0],1,':');
	if(strpos($v[2],'/')!==false)$vrf=strprm($v[2],0); else $vrf=$v[2];
	$css=$v[0]==$vrf&&$v[2]?'active':'';
	if($v[1]=='j')$re[]=lj($css,$v[2],$v[3]);
	elseif($v[1]=='SaveJc')$re[]=ljb($css,$v[1],$v[2],$v[3]);
	elseif($o=='popapi')$re[]=lj('','popup_api___'.$v[1].':'.ajx($v[2]),$v[3]);
	elseif($o=='ajxlnk2')$re[]=lj('','popup_mod,ajxlnk2___'.ajx($v[1]).'_'.ajx($v[2]),$v[3]);
	else{
		if($v[2]=='Home')$lk='/home';
		elseif($v[2]=='home')$lk='/home';
		elseif($v[1] && substr($v[2],0,1)!='/')$lk=$v[1].'/'.$v[2];
		elseif($v[2])$lk='/module/'.$v[2]; 
		elseif(is_numeric($v[2]))$lk='/'.$v[2];
		else $lk='';
		$re[]=lk($lk,$v[3],atc($css).atb('title',$v[2]));}}
if($re)return self::mod_lin_build($re,$t,$d,$o);}

static function mod_load($load,$ret,$t,$d,$o,$obj,$prw,$tp,$id){$ret='';
if(!$prw)$prw='prw'; if($t)$t=self::build_titl($load,$t,$obj); $mx=prmb(6);
if($d=='read')foreach($load as $id=>$prw)$ret.=divc('justy',ma::read_msg($id,3)).br();
elseif($d=='articles')$ret=ma::output_arts($load,$prw,$tp);
elseif($d=='viewer')$ret=md::art_viewer($load);
elseif($d=='multi'){geta('flow',1); $nl=ses('nl'); $i=0; foreach($load as $id=>$md){$i++;
	if($i<$mx)$ret.=art::playb($id,$md,$tp,$nl,'');
	else $ret.=div(atd($id).atc($md),'');}}
elseif($d=='api')$ret=api::mod_call($load);
elseif($d=='icons')$ret=apps::ico($load,'icones').divc('clear','');
elseif($d=='panel' && is_array($load))foreach($load as $k=>$v)$ret.=self::pane_art($k,$o,$tp);
elseif($load)$ret=self::m_pubart($load,$d,$o,$tp);
if($o=='scroll')$ret=scroll($load,$ret,10);
elseif($o=='cols')$ret=pop::columns($ret,240,'','');//width
elseif($o=='blocks')$ret=divc('blocks',$ret);
elseif($o=='list')$ret=self::m_publist($load,$tp);
//elseif($o=='icons')$ret=apps::ico($load,'icones').divc('clear','');
if($ret)return $t.$ret;}

#commands
static function mdtitle($d){if($d)return divd('titles',balb('h3',$d));}

static function build_titl($load,$t,$n='',$bt=''){$nb='';
$na=$load?count_r($load):''; if($na)$nb=btn('small',nbof($na,$n?$n:1)).' ';
return divd('titles',btn('txtcadr',$t).' '.$nb.$bt);}//pictxt('eye',)

#paneart
static function pane_art($id,$o,$tp=''){$o='auteurs'; if(!$tp)$tp='panart_j';
$ra=ma::pecho_arts($id); if(!$ra)return;
[$day,$frm,$suj,$amg,$nod,$thm,$lu,$name,$nbc,$src,$ib,$re,$lg]=arr($ra,13);
$p['url']=urlread($id); $p['suj']=ma::suj_of_id($id);//spe
$p['jurl']='content_mod,ajxlnk2__2_read_'.$id;
if(rstr(136))$p['purl']='pagup_popart__3_'.$id.'_3'; else $p['purl']='popup_popart__3_'.$id.'_3';
$p['cat']=catpict($frm,22);
//$ims=sql('img','qda','v',$id); 
$im=pop::art_img($amg,$id); if($im)$p['img1']='/imgc/'.art::make_thumb_css($im); //$p+=art::tags($id,1);
$p['sty']=$im?'background-image:url('.$p['img1'].')':'';
$p[$o]=sql_inner('tag','qdt','qdta','idtag','v','where cat="'.$o.'" and idart="'.$id.'"');
return art::template($p,$tp);}

#pubart
static function pub_art($id,$tpl=''){$rst=$_SESSION['rstr'];
$ra=ma::pecho_arts($id); if(!$ra)return;
[$day,$frm,$suj,$amg,$nod,$thm,$lu,$name,$nbc,$src,$ib,$re,$lg]=arr($ra,13);
$rt['url']=urlread($id); $rt['suj']=$suj;
$rt['jurl']='content_mod,ajxlnk2__2_read_'.$id;
$rt['purl']='popup_popart__3_'.$id.'_3';
if($rst[32]!=1 && $amg)$rt['img1']=pop::art_img($amg,$id);
if($rst[36]!=1){$rt['back']=art::back($id,$ib,$frm,0); $rt['cat']=$frm;}
if($rst[7]!=1)$rt['date']=mkday($day);
if($rst[4]!=1){$r=art::tags($id,1); if($r)$rt+=$r;}
if(!$tpl)$tpl=$rst[8]?'pubart':'pubart_j';
if($re)return divc('pubart',art::template($rt,$tpl));}

static function m_pubart($r,$o,$p,$tp=''){$re=[]; $ret='';
if(is_array($r)){foreach($r as $k=>$v){$d=self::pub_art($k,$tp); if($d)$re[$k]=$d;}
if($o=='scroll'){$ret=scroll($r,implode('',$re),$p?$p:10);}
elseif($o=='cols')return pop::columns($re,$p,'board','pubart');
elseif($re)$ret=implode('',$re);
if($ret)return divc('panel',$ret)."\n";}}

static function m_publist($r,$tp){$ret='';
if(is_array($r))foreach($r as $k=>$v){
	$p['url']=urlread($k); $p['suj']=ma::suj_of_id($k); $p['id']=$k;
	$p['jurl']='content_mod,ajxlnk2__2_read_'.$k;
	$p['purl']='popup_popart__3_'.$k.'_3';
	$ret.=art::template($p,$tp);}
return divc('list',$ret);}

#links
static function mod_link_r($m,$v){//m§v:picto
$qb=ses('qb'); [$va,$vb]=expl(':',$v);
switch($m){
case('credits'):return ['bevel','j','popup_md,about',picto('phi2')]; break;
case('admin'):return ['','','/?admin==&log=open',picto('admin')]; break;
case('root'):return ['','j','popup_deskroot___desk',picto('folder2')]; break;
case('desk'):return ['','j','desktop_desk',picto('folder')]; break;
case('deskboot'):return ['','SaveJc',apps::desktop_cond('boot',1),picto('desktop')]; break;
case('desktop'):return ['','SaveJc','page_deskbkg;popup_site___desktop_ok',picto('window')]; break;
case('folder'):return ['','j','popup_mod,mkmodr__3_local|real//////folder2///1:desktop*files_480',picto('folder')]; break;
case('art'):return ['','j','popup_popart__3_'.$va.'_3',picto('articles')]; break;
case('search'):return ['','j','popup_search,home',picto('search')]; break;
case('taxonav'):return ['','j','popup_taxonav,call',picto('topo')]; break;
case('rss'):return ['','','rss'.$qb,$v?$v:picto('rss')]; break;
case('contact'):return ['','j','popup_tracks,form___'.$qb,picto('mail')]; break;
case('tablet'):return ['','j','socket_tog__self_tablet',picto('gsm')]; break;
case('hub'):return ['','',prep_host($m),($v?$v:prep_host($m)),'']; break;
case('apps')://apps§14:users
	if($vb)$r=msql::row('system','default_apps'.($vb=='default'?'':'_'.$vb),$va,1);
	elseif($va)$r=msql::row('',nod('apps'),$va,1);
	$r=[$r['button'],$r['type'],$r['process'],$r['param'],$r['option'],'','',$r['icon'],'',$r['private']]; return ['','j',apps::read($r),$r[7]?picto($r[7]):$r[0]]; break;
case('mod'):[$va,$vb]=explode('-',stripslashes($v));
	return [get('slct_mods'),'slct_mods',$va,$vb?picto($vb):'Design','']; break;
case('ajax'):return ['','j',$va,$vb]; break;}
//user_menus
if($vb=='picto')$v=picto($va); elseif($vb=='icon')$v=ico($va);
//modules
if(substr($m,0,1)=='/'){
	[$action,$lk]=split_one('/',substr($m,1),0);
	switch($action){
	case('module'):return [get('module'),'module',$lk,$v?$v:$m,'']; break;
	case('plug'):$v=$vb=='picto'?$v:strend($m,'/');
		return [get('plug'),'plug',$lk,$v]; break;
	case('plugin'):$v=$vb=='picto'?$v:strend($m,'/');
		return [get('plugin'),'plugin',$lk,$v]; break;
	case('app'):return [get('app'),'app',$lk,$v?$v:$m,'']; break;
	default:return [get($action),$action,$lk,$v?$v:$m,'']; break;}}
elseif(sesr('line',$m))return [ses('frm'),'cat',$m,($v?$v:$m),''];
elseif(is_numeric($m)){if(!$v)$v=$_SESSION['rqt'][$v][2]; 
	return [get('read'),htacc('read'),$m,$v,'art'];}
elseif($m=='home' or $m=='all'){return [strtolower(get('module','home')),'',$m,($v?$v:$m),''];}
else return [get('context'),'context',$m,($v?$v:$m)];}

static function read_apps_link($d,$vr='',$c=''){
[$p,$o]=explode('§',$d);
if(is_numeric($p)){
	if($vr)$r=msql::row('system','default_apps'.($vr=='system'?'':'_'.$vr),$p,1);
	else $r=msql_read('',nod('apps'),$p);
	$r=[$r['button'],$r['type'],$r['process'],$r['param'],$r['option'],'','',$r['icon'],'',$r['private']];}
else $r=explode(';',$p);
$t=$r[7]?picto($r[7]):$r[0];
return lj($c,apps::read($r),$o?$o:$t);}

//0:button/1:type/2:proces/3:param/4:option/5:condition/6:root/7:icon/8:hide/9:private 
static function build_apps($p,$d){//newer than special_links
if(strpos($p,','))$r=explode(',',$p); else $r=explode(' ',$p);
$ra=msql::read_b('system','default_apps_'.($d?$d:menu),'',1); if($ra)$keys=msql::cat($ra,0);
foreach($r as $v){[$m,$o]=split_one('§',trim($v),0); $m=str_replace('+',' ',$m);
[$bt,$app,$func,$p,$o,$c,$root,$icon,$hid,$ath]=explode('/',$m);
if($ra[$m])$ret[]=$ra[$m]; elseif($keys[$m])$ret[]=$ra[$keys[$m]];
elseif($m && strpos('home all hubs plan taxonomy agenda taxonav',$m)!==false)
	$ret[]=[$v,'url','','/module/'.$o,'','menu','','link'];
elseif($m=='lang')foreach(explode(' ',prmb(26).' all') as $va)
		$ret[]=[$v,'url','','lang/'.$va,'','menu','','flag'];
elseif(is_numeric($m)){if(!$o)$o=$_SESSION['rqt'][$m][2]; 
	$ret[]=[$o,'art','',$m,'','menu','','articles'];}
elseif([$m])$ret[]=[$m,'url','','/cat/'.$m,'','menu','',$o?$o:'list'];
elseif($m=='module' && $o)$ret[]=[$o,'url','','/module/'.$o,'','menu','','link'];
elseif($m=='hub')$ret[]=[$o,'url','',$m?$m:prep_host($m),'','menu','','home'];
elseif($m=='mod')$ret[]=[$o,'url','','/?slct_mods='.$o,'','menu','','home'];
elseif($m=='rss')$ret[]=[$o,'url','blank','/rss/'.ses('qb'),'','menu','','rss'];
elseif($m=='plug')$ret[]=[$o,'plug',ajx($o),'','','menu','','get'];
elseif($m=='categories'){$line=ses('line'); if($line){ksort($line);
	foreach($line as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
		$ret[]=[$ka,'url','','/cat/'.$k,'','menu','','list'];}}}
elseif(substr($m,0,1)=='/')$ret[]=[$o,'url','',$m,'','menu','','get'];}
return $ret;}

static function rssj_m($p,$o){return self::mdtitle('Rss').divd('rssj',rssin::home('rssurl'.($p?'_'.$p:''),$o));}

static function msql_links($p,$o,$l,$d,$t){
$defs=msql_read('',nod($p),'',1);
if($defs)foreach($defs as $k=>$v){
	if($o=='mail'){$v[0]=$va=$k;}
	elseif($v[1]=='_' or !$v[1])$va=preplink($v[0]); else $va=$v[1];
	if($v)$ret.=llk('',$l.$v[0],$va);}
if($d=='scroll')$ret=scroll($defs,$ret,$o);
if($ret)return $t.balc('ul','panel',$ret);}

//page-title//les modules ont leur propres titles
static function find_navigation($id){$ib=ma::ib_of_id($id);
if(is_numeric($ib) && $ib!=$id && $ib){//$nav=self::pane_art($ib,'');
$nav=balb('h4',lka(urlread($ib),pictxt('sup',ma::suj_of_id($ib))).' '.ma::popart($ib));
if($ib!=ses('read'))return self::find_navigation($ib).$nav;}}

static function page_titles($o='',$rid=''){//$o=parent
$frm=ses('frm'); $read=ses('read');
if(get('rssurl')){$p['suj']=nms(15);}//tits
elseif(get('module')=='All'){$p['suj']=get('module'); $p['url']=htac('module').'All';}
elseif($frm){$p['suj']=$frm; $p['url']=htac('cat').$frm;
	$p['float']=catpict($frm,72);}
if($read && $o)$p['parent']=self::find_navigation($read);//rstr(78)
if($p['suj']=='Home')$p['suj']=nms(69);
return divd('titles',art::template($p,'titles'));}

//usables
static function login_btn_p($p,$o){$t=$p?$p:"login"; 
$jx='popup_login,form___'.ses('USE').'_'.ses('iq').'_'.ajx(nms(54)).'_1';
return lj('txtcadr',$jx,$t);}//if(!ses('USE'))

static function icotag(){
$t='related_arts related_by see_also-source source rub_taxo taxo_arts same_title tags '.prmb(18); $r=explode(' ',$t); $n=count($r);
$t='up down home home topo-open topo articles tag '.prmb(19); $ico=explode(' ',$t);
for($i=0;$i<$n;$i++)$ret[$r[$i]]=picto($ico[$i]);
return $ret;}

static function tab_mods($p){
$r=self::val_to_mod_b($p); $ico=sesmk2('mod','icotag'); $rc=[]; p($r);
foreach($r as $k=>$v){$md=self::mkmods($v);
	$k=isset($ico[$k])?$ico[$k]:$k;
	if($md)$rc[$k]=$md;}
return make_tabs($rc,randid('tmod'));}

static function art_mod($p,$d,$o,$id){
if(is_numeric($o))cwset($o);
if($d=='tabmods')return self::tab_mods($p);
elseif($d=='menusJ')return self::ajxlink($p,'mjx',0,0);
elseif($d=='togup')return self::ajxlink($p,'mjx',0,'togup');
$r=self::val_to_mod_b($p,$id); $ret=''; //pr($r);
foreach($r as $k=>$v){if(!$v[1])$v[1]=$id; $ret.=self::mkmods($v);}
return $ret;}

static function rartmod(){$r=$_SESSION['modc']['system'];
foreach($r as $k=>$v)if($v[0]=='art_mod')return $v;}

static function build_artmod($id,$a=''){$ra=self::rartmod();
[$m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr]=arr($ra,10);//$o=$o?$o:140;
$ret=self::art_mod($p,$d,$o,$id);
if($ret && $t)$ret=divc('txtcadr',stripslashes($t)).$ret;
if($ret && $a)$ret=divb($ret,'right','artmod','max-width:'.($o?$o:180).'px');
return $ret?scroll(0,$ret):nmx([11,1]);}

/*static function build_artmod_bub($id){$ra=self::rartmod(); $ret=[];//unused
[$m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$nbr]=arr($ra,10);
$r=self::val_to_mod_b($p,$id);
foreach($r as $k=>$v)$ret[]=[$v[0],$v[1]?$v[1]:$id,$v[4]];
return $ret;}*/

//pop=popup,onplace,o=closeable,closed,css
static function ajxlink($d,$id,$o,$pop){$ret=''; $clb=''; $cld=''; $ter='';
static $i; $i++; $here='here'.$id.$i; $d=str_replace("\n",'',$d); $ik=0;
if(strpos($o,'notcloseable')!==false)$clb=1; if(strpos($o,'closed')!==false)$cld=1;
$cs='nbp'; if($pop=='togup')$cld=1; $sp=' ';
if(strpos($d,',')!==false){$r=explode(',',$d); $sh=ses($here);
	if(!$sh && !$cld)$_SESSION[$here]=struntil($r[0],'§');
	foreach($r as $k=>$v){$hid=strprm($v,5);
	if($v && !$hid){
		if($pop=='popup')$ret.=pop::poplk($v,$here).$sp;//$pop=0??
		elseif($pop=='togup')$ret.=pop::toglk($v).$sp;
		else $ret.=self::ajxlk(trim($v),$here,$clb,$ik,'SaveBg').$sp; $ik++;}}}
else{if($pop=='popup')$ret.=pop::poplk($d,$here).$sp;
	elseif($pop=='togup')$ret.=pop::toglk($d).$sp;
	else $ret=self::ajxlk($d,$here,$clb,$ik,'SaveBg');}
$ret=div(atd('mnu'.$here).atc($cs),$ret);
if($pop!='popup' && $_SESSION[$here])$ter=self::mkmodr($_SESSION[$here]);
$ter=str_replace("\n",' ',$ter);
return $ret.btd($here,$ter);}

static function ajxlk($d,$here,$o,$n,$op=''){
[$lk,$t]=split_right('§',$d,1); if($op)$op='SaveBg';//SaveTg
[$l,$k]=expl('->',$lk); if(!$k)$k=$here;
$j=$k.'_mod,ajxlnk_'.ajx($l).'_'.$here.'_'.$n.'_'.$o;
$c=($_SESSION[$here]==$lk?'active':'');
$r=explode(':',$t); if($r[0]=='picto')$t=picto($r[1]);
$tb=isset($r[1])?'" title="'.$r[1]:'';
return ljb($c.$tb,$op,$j,$t);}

static function fav_mod($p,$t){$ret='';
$r=msql_read('',nod('coms'),'',1); $r=array_reverse($r);
foreach($r as $k=>$v)if($v[3]){//if($p){if($v[1]==$p)$api=$v[2];}else 
	$ret.=lj('','popup_api___'.ajx($v[2].',t:'.$v[1]),divc('txtcadr',pictxt('articles',$v[1])));}
//if($api)return api::call($api);
return $ret;}

static function mod_columns($p,$o){$r=self::val_to_mod($p);
foreach($r as $k=>$v)$re[]=self::mkmods($v);
return pop::columns($re,count($re),'','');}

static function com_mod($p){
return input1('cmod','','20').lj('txtbox','content_mod,ajxlnk_cmod',picto('kright'));}

static function com_vacuum($p,$o){$rid=randid('vac');
if($p)return lj('','popup_sav,batchpreview__3_'.ajx($p),pictxt('popup',preplink($p)));
$j=$rid.'cb_sav,batchpreview_'.$rid.'_3'; $bt=inputj($rid,'',$j,'http...').lj('',$j,picto('ok'));
return $bt.divd($rid.'cb','');}

//plan
static function home_plan($load,$n){
if($load){ksort($load); $i=0; $ret=[];
foreach($load as $cat=>$ids){$i++;
	$line=sesr('line',$cat); $mn=sesr('mn',$cat);
	if($n==2)$re=img::outputimg($ids); else $re=self::m_pubart($ids,'scroll','10000');
	if($cat!='_system' && $re && ($line or $mn)){
		if($n==2)$nib=10; else $nib=7;
		if($line)$got=htac('cat').$cat; else $got=subdomain($cat);
	$nbrt=btn('small',nbof(count($ids),1));
	$ret[$i]=lkc('txtcadr',$got,$cat).' '.$nbrt.br();
	$ret[$i].=divc('tab',scroll($ids,$re,$nib,'',280)).br();}}
if($ret){if(count($ret)<2 or $n==2) $prm=1; else $prm=2;
return pop::columns($ret,$prm,'board','pubart');}}}

static function arts_plan($conn,$p,$o=''){$t=$p!=1?$p:$conn;
if($conn=='plan' or $conn=='hubs')$n=1; else $n=2;
if($conn=='hubs')$load=self::see_hubs();
elseif($conn=='gallery'){// && !rstr(3)
	$r=sql('frm,id,img','qda','kkv','nod="'.ses('qb').'" and re>"0" and lg="'.ses('lng').'"');
	foreach($r as $ka=>$va)foreach($va as $k=>$v)if($v){$rb=explode('/',$v);
		if($rb)foreach($rb as $vb)if($vb && !is_numeric($vb)){
			$f='img/'.$vb; $s=is_file($f)?filesize($f):0;
			if($s>20480 or ($o && $s<20480))$load[$ka][$k][]=$vb;}}}
else $load=ma::tri_rqb('','nod','frm');
if($load)$rb=self::home_plan($load,$n);
if($rb)return self::build_titl($load,$t,61).$rb;}

static function see_hubs(){
if($ra=$_SESSION['mn']){foreach($ra as $k=>$v){
$r=msql_read('users',$k.'_cache','');
if($r)foreach($r as $ka=>$va){$ret[$k][$ka]+=1;}}}
return $ret;}

static function make_ban($p,$o,$t){
$t=divc('bantxt',conn::parser($t));
$im=$p?goodroot($p):'imgb/ban_'.ses('qb').'.jpg'; $h=is_numeric($o)?$o:'120';
return div(ats('background-image:url('.$im.'); height:'.$h.'px;').atc('banim'),$t);}

static function footer(){
$_SESSION['cur_div']='footer';
$r=self::val_to_mod('credits,chrono,log-out');
foreach($r as $k=>$v){$ret.=self::mkmods($v);}
return $ret;}

#callbacks
static function popartmod($g1){
boot::deductions($g1,''); boot::define_modc(); ses('read',$g1);
return self::build_artmod($g1);}

static function playmod($g1,$g2){
return $ret=self::mkmodr($g1.'///scroll:'.$g2);}

static function ajxlnk($g1,$g2,$prm){
$g1=$prm[0]??$g1; if($g2)$_SESSION[$g2]=$g1;
if($g1!='close')return self::mkmodr($g1);}

static function ajxlnk2($g1,$g2,$prm){geta($g1,$g2); 
if($g1=='read')boot::deductions($g2,''); boot::define_frm(); boot::define_condition(); 
return self::build_modules('content','');}
}
?>