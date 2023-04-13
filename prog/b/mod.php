<?php //modules
class mod{
static $r=['m','p','t','c','d','o','ch','hd','tp','bt','dv','pv','pp'];
static $rha=[];

/*static function find_mod($n){
foreach($_SESSION['mods'] as $k=>$v)if(key($v)==$n)return $v;}*/

#new protocole
static function mkcmd($p,$r=[],$o=0){if(!$r)$r=connmod($p);//p§bt:m
if($o)return array_combine(self::$r,arr($r,13));//build keys
else return valk($r,self::$r);}//verify keys

static function jsmap($nm){$r=self::$rha;
foreach($r as $k=>$v)$rt[]='["'.$k.'","'.$v.'"]';
return jscode('const '.$nm.'=new Map(['.implode(',',$rt).']);');}

//send only one command
static function btmod($p,$r=[]){$r=self::mkcmd($p,$r,1);
$tg=!empty($r['pp'])?'popup':'content'; $bt=$r['t']?$r['t']:'open'; unsetif($r,'bt');
$j=implode_k($r,',',':'); return lj('',$tg.'_mod,call___'.ajx($j),$bt);}

static function btmnu($r,$ik,$i,$ni,$k){$r=self::mkcmd('',$r,1);
$tg=!empty($r['pp'])?'popup':'content'; $t=$r['t']?$r['t']:'open'; unsetif($r,'bt');
$cmd=implode_k($r,',',':'); $g=ajx($cmd);//$tg.'_mod,callmod_'..'_'.$k.'_'.$ik.'_'.$i
self::$rha[$t]=$i; $c=active($i,$ni);
return tag('a',['onclick'=>'SaveBg('.$i.')','data-g'=>$g,'class'=>$c,'id'=>'n'.$i],$t);}

//a:p1,b:p2§bt:m//compatible p/t:m§bt:module
static function callmod($p){$r=self::mkcmd($p,[],0);
//if(is_numeric($r['m']))$p=$r['m'];
if(is_numeric($p)){$r=msql::row('',nod('mods_'.prmb(1)),$p);
	if($r){array_shift($r); return self::build($r);}}
elseif($r['bt'])return self::btmod('',$r);
elseif($r){['m'=>$m,'p'=>$p,'t'=>$t]=$r;
	if($m=='home' or $m=='cat' or $m=='read'){geta($m,$p);
		boot::deductions($p,''); boot::define_condition();}
	ses::$r['curdiv']='content';}
return self::build(array_values($r));}

static function call($p,$o='',$prm=[]){
$p=$prm[0]??$p; $ret=''; $r=explode(';',$p);
foreach($r as $k=>$v)$ret.=self::callmod($v);
return $ret;}

static function block($va,$cr,$bt=''){$ath=auth(6); $g=get('read'); //pr(ses::$r['get']);
$r=sesr('modc',$va); ses::$r['curdiv']=$va; $ret=''; $tg=$va; $ik=1; $i=-1; $ni=0;
if($r)foreach($r as $k=>$v){if(!$v[7] && (!$v[11] or $ath)){//hide/private
	if($v[9]??'')$re[$k]=self::btmod('',$v);
	elseif($bt){$i++;//menu
		$re[$k]=self::btmnu($v,$ik,$i,$ni,$k);
		if($i==$ni && !$g)ses::$loader=self::build($v);}//superflous if #
	elseif($v[6]){$mdc=sesr('mdc',$k);//cache
		if(!$mdc or $cr){$re[$k]=self::build($v); $_SESSION['mdc'][$k]=$re[$k];}
		else $re[$k]=$mdc;}
	//elseif($v[11]??'')$re[$k]=divd('mod'.$k,lj('txtcadr','mod'.$k.'_md::modj___'.$k.'_'.$va,$v[2]));
	//elseif($v[12]??'')Head::add('jscode',sj('popup_mod,callmod___'.$k));//better use apps
	else $re[$k]=self::build($v);
if($re[$k])$ret.=$re[$k]."\n";}}
ses::$r['curdiv']='content'; $h='';
if(self::$rha){$h=self::jsmap('rha'); self::$rha=[];}
return divd($va,$ret.$h);}

static function blocks(){
$r=explode(' ',$_SESSION['prma']['blocks']);
foreach($r as $k=>$v)$ret[$v]=self::block($v,'');
return $ret;}

static function playmod($g1,$g2,$prm){ses('frm','');
$g2=$prm[0]??$g2; if($g2)$_SESSION[$g1]=$g2; geta($g1,$g2);
boot::deductions(); boot::define_condition();
return self::block('content','');}

static function playcontext($g1,$g2,$g3){
$g2=utf8dec_b(urldecode($g2)); if($n=strpos($g2,'#'))$g2=substr($g2,0,$n);
geta($g1,$g2); if($g3)geta('dig',$g3);//str::protect_url
boot::deductions(); boot::define_condition(); boot::define_modc(); $rt=self::blocks(); //pr(ses('cond'));
return implode('',$rt);}

//mod,param,title,condition,command,option,(bloc),hide,template,nobr,div,ajxbtn
static function build($r){$cs='panel'; $csb='small';
$lin=[]; $load=[]; $api=[]; $ret=''; $prw=''; $id=''; $obj='';
[$m,$p,$t,$c,$d,$o,$ch,$hd,$tp,$bt,$dv,$pv,$pp]=arr($r,13);
if($bt)return self::btmod('',$r);
if($pv && auth(6) or !$pv)
switch($m){
//main
case('LOAD'):
	if($id=get('read'))$ret=art::read($id,$tp);
	elseif($frm=get('frm'))$ret=api::arts($frm,$o,$tp,$d);
	elseif($gmd=get('module'))$ret=mod::callmod($gmd);
	elseif($cmd=get('api'))$ret=api::call($cmd);
	elseif($ra=api::load_rq())$ret=api::load($ra);
	elseif($loader=ses::$loader)$ret=$loader; break;
case('BLOCK'):$ret=self::block($p,''); break;
case('MENU'):$ret=self::block($p,'',1); break;
case('ARTMOD'):$ret=self::block($p,''); break;
case('TABMOD'):$ret=self::artmod($p,$d); break;
case('ART'):$ret=self::block('article',''); break;
case('All'):$api=api::arts_rq($p,$o); $api['t']=$t?$t:nms(100); break;
//case('Home'):$ret=self::playcontext('home',''); break;//stupid
case('article'):$ret=art::read($p,$tp); break;
case('articles'):$load=api::mod_arts_row($p); $obj=1; break;
case('api'):$ret=api::call(str_replace(';',',',$p),$o); break;
case('api_arts'):$api=api::mod_arts_rq($p,$t,$d,$o,$tp); break;
case('api_mod'):$api=api::defaults_rq(explode_k($p,',',':')); break;//unused
case('Page_titles'):$ret=self::page_titles($o); break;
case('categories'):$ret=md::cat_mod_j($p,$o,$d,$tp); break;
case('category'):if($p==1 && !get('frm'))$p='All'; $ret=api::arts($p,$o,$tp); break;
case('catarts'):$p=$p!=1?$p:get('frm'); $t=$t!=$m?$t:$p; $load=ma::tri_rqt($p,1); break;
//case('catj'):$ret=md::cat_mod_j($p,$o,$d,$tp); break;//x
case('playconn'):$api=api::arts_rq('',''); $api['media']=$p; $api['nbyp']=10; $api['t']=$t; break;
case('gallery'):$ret=md::gallery($p,$o); break;//old
case('tracks'):$ret=md::trkarts($p,$t,$d,$o); break;//api::tracks($t)
case('trkrch'):$ret=md::trkrch($p); break;
case('last'):$ret=art::playb('last',3); break;
case('cover'):$ret=md::cover($p,$o,$tp); break;
case('friend_art'):$ret=md::friend_art($o); break;
case('friend_rub'):$ret=md::friend_rub($o); break;
case('related_arts'):$load=md::related_art($p); break;
case('related_by'):$load=md::related_by($p); break;
case('parent_art'):$load=md::parent_art($p); break;
case('child_arts'):$load=md::child_arts($p); break;
case('prev_next'):$ret=md::prevnext_art($d,$o,''); break;
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
case('most_polled'):$load=md::most_polled($p,$o); break;
case('score_datas'):$load=md::score_datas($p,$o); break;
case('same_title'):$load=md::same_title($p); break;
case('deja_vu'):$load=ses('mem'); break;
//com
case('context'):$ret=md::call_context($p); break;
case('rss_input'):if($p)$ret=rss::build(ajx($p,1)); break;
case('disk'):$_SESSION['dlmod']=$p; if($p && $p!='/')$pb='/'.$p;
	$ret=divd('dsnavds',finder::home('dl','users/'.ses('qb').$pb)); break;//!
case('finder'):$ra=['|','-']; $p=str_replace($ra,'/',$p); $o=str_replace($ra,'/',$o);
	$ret=finder::home($p,$o,$d); break;
case('channel'):$ret=channel::home($p,$t,$d,$o); $t=''; break;//old
case('hour'):timelang();
	if($p)$dat=date($p?$p:'ymd:Hm',ses('dayx')); else $dat=mkday('',1);
	if(!$d)$ret=btn($o,$dat); else $ret=divc($o,$dat); break;
case('cart'):$ret=lkc('txtcadr','/app/cart',$p!=1?$p:'Cart');
	$ret=divd('cart',self::m_pubart(ses('cart'),'scroll',7)); break; 
case('video'):$ret=video::any($p,'',3,''); break;
case('video_viewer'):$ret=usg::videoboard($p,$c,$o); break;
case('api_chan'):$ret=md::apichan($p,$t,$o,$tp); break;
case('special_polls'):$ret=md::special_polls($p,$t,$o); break;
case('quality_stats'):$ret=md::quality_stats($p,$t,$o); break;
//txt
case('text'):$ret=stripslashes(urldecode($p)); if($o)$ret=divc($o,$ret); break;
case('clear'):$ret=divc('clear',''); break;
case('connector'):if($t)$ret=self::title('',$t);
	if($o=='article')$ret.=tagc('article','justy',conn::read2($p,'',1));
	else $ret.=conn::read2($p,'',1); break;
case('codeline'):if($p)$ret=codeline::parse($p,'','template'); break;
case('conn'):$ret=conn::connectors($p,$o,'',''); break;
case('basic'):$ret=codeline::mod_basic($p,$o); break;
//lin
case('cats'):$lin=md::cat_mod($p,$o,$d); break;//x
case('tags'):$t=lj('menus','popup_tags,home__3_'.$p.'_1',pictxt('tag',$t?$t:$p));
	$lin=md::tag_mod($p,$o,$d); break;
case('clusters'):$lin=md::cluster_mod($p,$o,$d); break;
case('last_tags'):$lin=md::last_tags($p,$o); break;
case('frequent_tags'):$lin=md::frequent_tags($p,$o); break;
case('sources'):if($t)$t=lkc('','/module/source',$t); $lin=md::art_sources($p); break;
case('folder'):$lin=desk::vfolders($p); break;
//menus
case('link'):$ret=md::modlk($p,$t,$o); break;
case('app_popup'):Head::add('jscode',sj(desk::read(explode(',',$p)))); break;
case('overcats'):return mkbub(bubs::root('overcat','zero'),'inline','1'); break;
case('MenuBub'):return mkbub(bubs::root('menubub','zero',$p),'inline','1'); break;
case('timetravel'):return md::timetravel_m($p,$o); break;
case('submenus'):return md::bubble_menus($p,$o); break;
case('taxonomy'):$ret=md::mod_taxonomy($p,$o); break;
case('folders'):$load=md::supertriad_ask($p,$o); $prw=$o; $obj=63; break;//rstr(5)?2:1
case('desk'):$ret=desk::deskmod($p); break;
case('desktop_apps'):$r=desk::build_from_datas($o?$o:'desk','','','');
	$ret=desk::pane_icons($r,'icones'); break;
case('desktop_arts'):$ret=self::mdtitle($t).desk::deskarts($p,$o,'arts'); break;
case('desktop_varts'):$ret=self::mdtitle($t).desk::deskarts($p,$o,'varts'); break;
case('desktop_files'):$ret=self::mdtitle($t).desk::deskarts($p,$o,'files'); break;
case('hierarchics'):$in=md::suj_hierarchic('active',''); $ret=ul($in,$cs); break;
//cacheable
case('hubs'):$mn=$_SESSION['mn']; if(count($mn)>=2){$t=$p!=1?$p:$t;
	if($t)$t=lkc('',htac('module').'hubs',$t);
	$in=md::m_nodes_b($mn,$o); $ret=ul($in,$cs);} break;
case('tags_cloud'):$p=$p?$p:'tag';
	$ret=self::title('',lj('','popup_tags,home__3_'.$p.'_1',$t));
	$in=md::tags_cloud($p,10,22); $ret.=divc($cs,$in); break;
case('tag_arts'):[$p,$o]=split_one(':',$p); $load=ma::tag_arts($p,$o); break;
case('classtag_arts'):$load=md::classtag_arts($p); break;//class find id//$o=$p;
case('last_search'):$ret=md::last_search($p,$o); break;
case('see_also-tags'):$r=md::see_also_tags($p?$p:'tag'); 
	if($r)$ret=see_also($r,$p,$d,$o,$tp); break;
case('see_also-rub'):$t=$p!=1?$p:get('frm');
	if(get('read'))$load=md::see_also_rub($p); break;
case('see_also-source'):[$load,$t]=md::see_also_source($o); break;
case('siteclics'):$ret=md::siteclics($p); break;
case('rub_tags'):$ret=md::rub_tags($p); break;
case('rss'):$ret.=rss::home($p?$p:'rssurl'); break;
case('rssin'):$ret.=self::rssj_m($p,$o); break;
case('chat'):if($t)$t=lj('','cht'.$p.'_chat___'.$p,$t);
	$p=$p!=1?$p:'pub'; $in=chat::home($p,$o?$o:10); 
	if($in)$ret=divc($cs,$in); break;
case('stats'):$ret=stats::home('',''); break;
case('archives'):if($p==1)$p=$m; if($p)$ret=self::title('',$p);
	$in=divd('archives',few::archives('')); $ret.=tagc('ul',$cs,$in); break;
case('agenda'):$load=sql('ib,msg','qdd','kv',['val'=>'agenda']); $tim=time();
	if($load)foreach($load as $k=>$v)if(strtotime($v)<$tim)unset($load[$k]); break;
case('calendar'):$in=calendar(ses('daya')); if($p==1)$p=$m;//old
	if($p)$ret=self::title('',$p); $ret.=divc($cs,$in); break;
case('folders_varts'):$load=desk::varts($p); break;
case('searched_words'):$ret=searched::look($p); break;
case('searched_arts'):$load=searched::arts($p); break;
case('same_tags'):$load=md::same_tags($p); break;
case('cluster_tags'):$load=md::cluster_tags($p); break;
case('panel_arts'):$ret=panart::build($p); break;
case('birthday'):$load=md::birthday($p); break;
case('newsletter'):if($o)$ret=lj('txtcadr','popup_mailist,home__3_'.$p,'mailist');
	else $ret=mailist::home($p); break;
case('bridge'):$ret=md::bridge($p,$t); break;
case('fav_mod'):$ret=self::fav_mod($p,$t); break;
//users
case('login'):$ret=md::login_btn($p,$o); break;
case('login_popup'):$ret=self::login_btn_p($p,$o); break;
case('log-out'):if(ses('USE'))$ret.=lkc($csb,'/logout',picto('logout')).' '; break;
case('search'):$ret=search_btn($o); break;
//banner
case('Banner'):$ret=self::make_ban($p,$o,$t); break;
case('ban_art'):if($p!=1)$ret.=lk(subdomain(ses('qb')),ma::read_msg($p,'')); break;
//footer
case('credits'):$ret=lj('bevel','popup_md,about',picto('phi2')); break;
case('admin'):$ret=lkc($csb,'/admin/log/open',$t?$t:picto('admin')).' '; $t=''; break;
case('chrono'):$ret=btn('txtsmall2',round(microtime(1)-$_SERVER['REQUEST_TIME_FLOAT'],3).'s').' '; break;
case('contact'):if($p)$ret=tracks::form(ses('qb'),$t);
else $ret=contact($t,$o?$o:$csb).' '; break;
//plugs
case('iframe'):$ret=iframe::home('',''); break;
case('suggest'):$ret=self::mdtitle(nms(126)).suggest::home($o); break;
case('create_art'):$ret=edit::artform('',''); break;
case('twitter'):if($p)$ret=twit::call($p,$o); break;
//case('twits'):if($t)$ret=self::title('',$t,''); $ret.=twit::stream($p,$o); break;//too slow
case('webs'):if($t)$ret=self::title('',$t,''); $ret.=web::stream($p,$o); break;
//case('social'):$ret=social::home($p,$o); break;//empty
//case('profil'):$ret=profil::home($p,$o); break;
//special
case('module'):$ret=self::callmod($p); break;
case('command'):$ret=self::com_mod($p); break;
case('vacuum'):$ret=self::com_vacuum($p,$o); break;
case('app'):[$pa,$pb,$oa,$ob]=expl('_',$p,4); if($t)$ret=self::title('',$t,'');
	$ret.=appin($pa,$pb?$pb:'home',$oa,$ob); break;
case('close'):$ret='';
default:if(method_exists($m,'call'))$ret=$m::call($p,$o); break;}
if($lin)$ret=self::mod_lin($lin,$t,$d,$o);//menus
elseif($load)$ret=self::mod_load($load,$t,$d,$o,$obj,$prw,$tp,$id,$pp);//arts
elseif($api)$ret=api::load($api);//api
if(!$ret && !$lin && !$load && $p && $m){//user_mods
	$func=msql::val('',nod('modules'),$m);
	if($func && !is_array($func))$ret=codeline::cbasic($func,$p);}
if($ret){if($dv)return divc('mod',$ret); else return $ret;}}

//['button','type','process','param','option','condition','root','icon','hide','private']
static function mod_desk($r,$m){
return bubs::apps($r,$m,'','');}

//todo: modline, buildmod, fusion desk
static function mod_lin_build($re,$t,$d,$o){$limit=is_numeric($o)?50*$o:50;
if($d=='inline')$ret=implode('',$re);
elseif($d=='cols')$ret=divc('menus',pop::columns($re,$o,'','menus','','mall'));
elseif($d=='icons')$ret=desk::pane_icons($re,'icones').divc('clear','');
elseif($d=='scroll')$ret=$t.scroll($re,implode('',$re),(is_numeric($o)?$o:17));
else $ret=$t.divc('menus',implode('',$re));
return $ret;}

static function mod_lin($lin,$t,$d,$o){//mod_link_r//old
if($lin)foreach($lin as $k=>$v){
	if(strpos($v[0],':')!==false)$v[0]=strprm($v[0],1,':');
	if(strpos($v[2],'/')!==false)$vrf=strprm($v[2],0); else $vrf=$v[2];
	$css=$v[0]==$vrf&&$v[2]?'active':'';
	if($v[1]=='j')$re[]=lj($css,$v[2],$v[3]);
	elseif($v[1]=='SaveJc')$re[]=ljb($css,$v[1],$v[2],$v[3]);
	elseif($o=='popapi')$re[]=lj('','popup_api___'.$v[1].':'.ajx($v[2]),$v[3]);
	elseif($o=='popmod')$re[]=lj('','popup_mod,callmod___m:'.ajx($v[1]).',p:'.ajx($v[2]),$v[3]);
	else{
		if($v[2]=='Home'||$v[2]=='home')$lk='/home';
		elseif($v[1] && substr($v[2],0,1)!='/')$lk=$v[1].'/'.$v[2];
		elseif(is_numeric($v[2]))$lk='/'.$v[2];
		elseif($v[2])$lk='/module/'.$v[2];
		else $lk='';
		//$re[]=lk($lk,$v[3],atc($css).att($v[2]));
		$re[]=lh($lk,$v[3],atc($css).att($v[2]));}}
if($re)return self::mod_lin_build($re,$t,$d,$o);}

static function mod_load($load,$t,$d,$o,$obj,$prw,$tp,$id,$pp){$ret='';
if(!$prw)$prw='prw'; if($t)$t=self::title($load,$t,$obj); $mx=prmb(6);
if($d=='read')foreach($load as $id=>$prw)$ret.=divc('justy',ma::read_msg($id,3)).br();
elseif($d=='articles')$ret=ma::output_arts($load,$prw,$tp);
elseif($d=='viewer')$ret=md::art_viewer($load);
elseif($d=='multi'){geta('flow',1); $nl=get('nl'); $i=0; foreach($load as $id=>$md){$i++;
	if($i<$mx)$ret.=art::playb($id,$md,$tp,$nl,'');
	else $ret.=div(atd($id).atc($md),'');}}
elseif($d=='api')$ret=api::mod_call($load);
elseif($d=='icons')$ret=desk::pane_icons($load,'icones').divc('clear','');
elseif($d=='panel' && is_array($load))foreach($load as $k=>$v)$ret.=self::pane_art($k,$o,$tp,$pp);
elseif($load)$ret=self::m_pubart($load,$d,$o,$tp);
if($o=='scroll')$ret=scroll($load,$ret,10);
elseif($o=='cols')$ret=pop::columns($ret,240,'','');
elseif($o=='inline')$ret=divc('inline',$ret);
elseif($o=='blocks')$ret=divc('blocks',$ret);
elseif($o=='list')$ret=self::m_publist($load,$tp);
if($ret)return $t.$ret;}

#titles
static function mdtitle($d){if($d)return divd('titles',tagb('h3',$d));}

static function title($load,$t,$n='',$bt=''){$nb='';
$na=$load?count_r($load):''; if($na)$nb=btn('small',nbof($na,$n?$n:1)).' ';
return divd('titles',tagb('h3',$t).' '.$nb.$bt);}//pictxt('eye',)

#paneart
static function pane_art($id,$o,$tp='',$pp='',$ra=[]){
$o='auteurs'; if(!$tp)$tp='panart_j';
if($ra['tag']??'')$p[$o]=$ra['tag'];
else $p[$o]=sql::inner('tag','qdt','qdta','idtag','v',['cat'=>$o,'idart'=>$id]);
if($ra)$ra=vals($ra,['id','frm','suj','img','nod','thm','lu','name','host','mail','ib','re','lg']);//api
else $ra=ma::pecho_arts($id); if(!$ra)return;
[$day,$frm,$suj,$amg,$nod,$thm,$lu,$name,$nbc,$src,$ib,$re,$lg]=arr($ra,13);
$p['url']=urlread($id); $p['suj']=ma::suj_of_id($id);
$p['jurl']='content_mod,playmod__u_read_'.$id;
$p['purl']=(rstr(136)?'pagup':'popup').'_popart__3_'.$id.'_3'; if($pp)$p['jurl']=$p['purl'];
$p['cat']=catpict($frm,22); //$p+=art::tags($id,1);
$im=pop::art_img($amg,$id); if($im)$p['img1']='/imgc/'.art::make_thumb_css($im);
$p['sty']=$im?'background-image:url('.$p['img1'].')':'';
return art::template($p,$tp);}

#pubart
static function pub_art($id,$tpl=''){$rst=$_SESSION['rstr'];
$ra=ma::pecho_arts($id); if(!$ra)return;
[$day,$frm,$suj,$amg,$nod,$thm,$lu,$name,$nbc,$src,$ib,$re,$lg]=arr($ra,13);
$rt['url']=urlread($id); $rt['suj']=$suj;
$rt['jurl']='content_mod,playmod__u_read_'.$id;
$rt['purl']=(rstr(136)?'pagup':'popup').'_popart__3_'.$id.'_3';
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
elseif($o=='inline')return divc('inline',join('',$ret));
elseif($re)$ret=implode('',$re);
if($ret)return divc('panel',$ret)."\n";}}

static function m_publist($r,$tp){$ret='';
if(is_array($r))foreach($r as $k=>$v){
	$p['url']=urlread($k); $p['suj']=ma::suj_of_id($k); $p['id']=$k;
	$p['jurl']='content_mod,playmod__u_read_'.$k;
	$p['purl']=(rstr(136)?'pagup':'popup').'_popart__3_'.$k.'_3';
	$ret.=art::template($p,$tp);}
return divc('list',$ret);}

static function rssj_m($p){
return self::mdtitle('Rss').rssin::home('rssurl'.($p?'_'.$p:''));}

//page-title//les modules ont leur propres titles
static function find_navigation($id){$ib=ma::ib_of_id($id);
if(is_numeric($ib) && $ib!=$id && $ib){//$nav=self::pane_art($ib,'');
//$nav=tagb('h4',lka(urlread($ib),pictxt('sup',ma::suj_of_id($ib))).' '.ma::popart($ib));
$t=pictxt('sup',ma::suj_of_id($ib));
if(rstr(149))$lk=lh('/'.$ib,$t); else $lk=lk(urlread($ib),$t);
$nav=tagb('h4',$lk.' '.ma::popart($ib));
if($ib!=ses('read'))return self::find_navigation($ib).$nav;}}

static function page_titles($o='',$rid=''){//$o=parent
$frm=get('frm'); $read=ses('read'); $mod=get('module');
if($mod=='All'){$p['suj']=nms(100); $p['url']=htac('module').'All';}
elseif($frm){$p['suj']=$frm; $p['url']='cat/'.$frm; $p['float']=catpict($frm,72);}
elseif(!$frm)$p['suj']=nms(69);
if(rstr(149))$p['title']=lh($p['url'],$p['suj']); else $p['title']=lk($p['url'],$p['suj']);
if($read && $o)$p['parent']=self::find_navigation($read);//rstr(78)
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

static function artmod($id,$a){
if($a)$ico=sesmk2('mod','icotag');
$ra=sesr('modc','system'); $rm=[];
$r=sesr('modc',prma('ARTMOD')); $rt=[];
foreach($ra as $k=>$v)if($v[0]=='ARTMOD')$rm=$v; $d=$v[4]; $o=$v[5];
foreach($r as $k=>$v){$v[1]=$id; $k=$ico[$v[1]]??$v[2];
	$md=self::build($v); if($md)$rt[$k]=$md?scroll(0,$md,''):nmx([11,1]);}
if($d=='tabs')return tabs($rt,randid('tmd'));
return join('',$rt);}

static function fav_mod($p,$t){$ret='';
$r=msql_read('',nod('coms'),'',1); $r=array_reverse($r);
foreach($r as $k=>$v)if($v[3]){//if($p){if($v[1]==$p)$api=$v[2];}else 
	$ret.=lj('','popup_api___'.ajx($v[2].',t:'.$v[1]),divc('txtcadr',pictxt('articles',$v[1])));}
//if($api)return api::call($api);
return $ret;}

static function com_mod($p){
return input('cmod','','20').lj('txtbox','content_mod,callmod_cmod',picto('kright'));}

static function com_vacuum($p,$o){$rid=randid('vac');
if($p)return lj('','popup_sav,batchpreview__3_'.ajx($p),pictxt('popup',preplink($p)));
$j=$rid.'cb_sav,batchpreview_'.$rid.'_3';
$bt=inputj($rid,'',$j,'Url').lj('',$j,picto('ok'));
return $bt.divd($rid.'cb','');}

static function make_ban($p,$o,$t){
$t=divc('bantxt',conn::parser($t));
$im=$p?goodroot($p):'imgb/usr/'.ses('qb').'_ban.jpg'; $h=is_numeric($o)?$o:'120';
return div(ats('background-image:url('.$im.'); height:'.$h.'px;').atc('banim'),$t);}

static function footer(){
ses::$r['curdiv']='footer';
return self::call(':credits;:chrono;:log-out');}
}
?>