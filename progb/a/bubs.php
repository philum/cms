<?php //b/bubs
class bubs{
//['button','type','process','param','option','condition','root','icon','hide','private']
//popbub($d=indicatif,$cat=$dir=root,$t=button,$c='call',1='over')
//function rightarrow(){return; bts('float:right;','&#9658;');}

//addart_fast
static function addart_btn(){//sav::newartcat
$p=['onclick'=>'SaveIeb()','oncontextmenu'=>'SaveIeb()','onchange'=>'SaveIeb()','onpaste'=>'SaveIeb()'];
$t=inputb('addsrc','',43,'url',256,$p);
$t.=lj('','popup_edit,artform',picto('add',14));
return span(atc('search').atd('adb'),$t);}

//ucom
static function ucom_btn(){//obs
$j='sjtime(\'ucom\',\'socket_ucom_ucom_url\');';
$ret=inputj('ucom','',$j,'command');
return divc('search',$ret);}
//lang
static function langs(){$r=explode(' ',prmb(26));
$ico=$_SESSION['lang']=='all'?'valid':'link';//setlang
$ret[]=[nms(100),'ajax','socket','lang__self_all','admsq','','lang',$ico];
$rb=msql::kv('lang','helps_langs'); $lg=ses('lang');
foreach($r as $v){$ico=$v==$lg?'valid':'link';
	$ret[]=[$rb[$v]??'','ajax','socket','lang__self_'.$v,'admsq','','lang',$ico];}
return $ret;}
//plug
//0:usage/1:dir/2:loadable/3:callable/4:interface/5:state/6:private
static function plug($dr){$qb=ses('qb'); $ath=auth(6); $dr=strprm($dr);
$r=msql::read('system','program_plugs','','1');
foreach($r as $k=>$v){//if($v[2])//loadable //if($v[3])//callable //if($v[4])//interface
	if(!$v[5] or $ath)//state
	if(substr($v[1],0,6)!='system')//sys
	if(!$v[6] or $ath or $v[6]==$qb or substr($v[1],0,6)=='public')//private
	//if($k && $v[2] && (!$v[5] or $ath) && ($v[6]==$qb or (!$v[6] or $ath)) && substr($v[1],0,6)!='system' && substr($v[1],0,4)!='host' && substr($v[1],0,3)!='old')
	if($dr=='plugin')$ret[]=[$k,'link','','/plug/'.$k,'','',$dr.'/'.$v[1],'link'];
	else $ret[]=[$k,'plug',$k,'','','',$dr.'/'.$v[1],'conn'];}
return $ret;}

//dev
static function dev(){$ret=[];
if(auth(4) or ses('dev')){
	$ret[]=['dev','ajax','socket','dev__self_b','','','dev','circle-full'];
	//$ret[]=['lab','ajax','socket','dev__self_c','','','dev','circle-half'];
	$ret[]=['prod','ajax','socket','dev__self_','','','dev','circle-empty'];}
if(auth(6)){
	if(rstr(99))$ret[]=['twitletter','ajax','popup','tweetfeed,batch__3','','','dev','tw2'];
	if(prms('srvmirror'))
	$ret[]=['transport','app','transport','','','','dev','exchange'];
	$ret[]=['push','ajax','popup','dev2prod,call__3xx','','','dev','upload'];
	$ret[]=['publish','ajax','popup','pubdate,call','','','dev','export'];
	if(!prms('aupdate'))
	$ret[]=['update','ajax','popup','software,home','','','dev','update'];
	$ret[]=['cron','ajax','popup','cron,play','','','dev','bot'];
	if(ses('rebuild_img')){$bt='-off'; $n=0;} else{$bt=''; $n=1;}
	$ret[]=['mini'.$bt,'ajax','socket','sesmake___rebuild*img_'.$n,'','','dev','img'];
	$ret[]=['refresh','ajax','socket','reset__self','','','dev','refresh'];}
$ret[]=['cache','ajax','popup','rebuild__3','','','dev','reload'];
if(auth(2))$ret[]=['push','ajax','popup','dev2prod,call__3xx','','','dev','down'];
if(auth(2))$ret[]=['last','ajax','popup','popart__3_last','','','dev','article'];
return $ret;}

//time
static function timetravel(){$r=pop::timetravel(); $travel=date('Y',ses('daya'));
$ret[]=[date('Y'),'link','','/reload','','','','logout'];//nms(83)
foreach($r as $k=>$v)$ret[]=[$k,'link','',art::target_date($v),'','','',$travel==$k?'clock':'hour'];
return $ret;}

//arts
static function adm_arts($dir){$r=ses('rqt'); //if($r)$r=array_reverse($r,true);
$ret[]=[$dir,'link','','/'.$dir,'','','Categorie',sesr('catpic',$dir),'',''];
if($r)foreach($r as $k=>$v)if($v[1]==$dir)$ret[]=[$v[2],'art','',$k,'','',$v[1],'txt'];
return $ret;}
static function adm_arts_fast(){$r=ses('rqt'); if($r)$r=array_reverse($r,true);
if($r)foreach($r as $k=>$v)if(substr($v[1],0,1)!='_')$ra[$v[1]]=1;
$rb=ses('catpic',[]); $ret='';
if($ra)foreach($ra as $k=>$v){$ic=$rb[$k]??'folder';
	$ret.=popbub('arts',ajx($k),picto($ic).'&nbsp;'.$k,'c',1);}
return $ret;}

#seek
//tag find arts
static function seek_art($d){[$cat,$tag]=explode('-',$d);
$r=ma::tag_arts($tag,$cat,7); unset($r[ses('read')]);
if($r)foreach($r as $k=>$v)
	$ret[]=[ma::suj_of_id($k),'art','',$k,$d,'',$d,'article'];
return $ret;}
//class find tags
static function seek_tag($d){$id=ses('read');
$r=md::classtag_arts($d);
if($id && $r)$r=array_flip($r);
if($r)foreach($r as $k=>$v)if($k)//id
	//$ret[]=[$k,'bub','seekart',$d.'-'.$k,'','',$d,'tag'];
	$ret[]=[$k,'ajax','popup_api___'.$d.':'.$k,'','','',$d,'tag'];
return $ret;}
//id find classes
static function seek_merge($d,$ret){$id=ses('read');
$r=ma::art_tags($d); //p($r);
if($r)foreach($r as $k=>$v)if($k)//id
	$ret[]=[$k,'bub','seekart',$d.'-'.$k,'','','','tag'];
	//$ret[]=[$k,'ajax','popup_api___'.$d.':'.$k,'','','','','tag'];
return $ret;}
static function seek(){
$r=explode(' ','tag '.prmb(18)); $rt=[];
foreach($r as $k=>$v)$rt=self::seek_merge($v,$rt);
//if($v)$rt[]=[$v,'bub','seektag',ajx($v),'','','','folder2'];
return $rt;}

//mods
/**/static function adm_mods($d){//mod::block($va,$cr);
return mod::call($d);}

//hubs
static function hubs_fast(){$r=ses('mn'); $ret=[];
if(is_array($r))foreach($r as $k=>$v)$ret[]=[$v,'link','',subdomain($k),'','','hubs','node'];
return $ret;}

//bub selector
static function slct($j){
[$d,$id,$rid,$o]=explode('.',$j); 
if(strpos($d,'|'))$r=explode('|',$d); else $r=usg::slct_r($d,$o);
//$ret[]=['-','js','','','','','bub',''];//close
$ret[]=['nothing','js','jumpval',$id.'_','','','bub',''];//del
if($r)foreach($r as $k=>$v)
	$ret[]=[$v,'js','jumpval',$id.'_'.addslashes($v),'','','bub',''];
return $ret;}

//msql
static function msql($cat,$a,$b,$c){
$r=msql::choose($a,$b,$c); $j='msql___'.$a.'_'.$b.'_'; if($c && $r)sort($r);
if($r)foreach($r as $k=>$v){if(is_array($v)){sort($v); $kp=in_array_b('php',$v);
	if($kp!==false){unset($v[$kp]);
		$ret[]=['This','ajax','popup',$j.$k,'','',$cat.'/'.$k,'msql'];}
	if(count($v)<1)$ret[]=[$k,'ajax','popup',$j.$k,'','',$cat,'msql'];
	else foreach($v as $ka=>$va){if($a!='design')$k=$b.'/'.$k;
		$ret[]=[$va,'ajax','popup',$j.$k.'*'.$va,'','',$cat.'/'.$k,'msql'];}}
else{if($v=='php')$ret[]=['This','ajax','popup',$j.$c,'','',$cat,'msql'];
	else $ret[]=[$v,'ajax','popup',$j.$c.'*'.$v,'','',$cat,'msql'];}}
return $ret;}

static function msql_dir($cat){
$qb=ses('qb'); $prfx=strprm($cat,1); $tabl=strprm($cat,2); switch($prfx){
case($qb):$dir='users'; $nod=$_SESSION['qb']; break;
case('public'):$dir='users'; $nod='public'; break;
case('design'):$dir='design'; $nod=$qb; break;
//case('gallery'):$dir='gallery'; $nod=$qb; break;
case('admin'):$dir='lang/fr'; $nod='admin'; break;
case('system'):$dir='system'; $nod='admin'; break;
case('program'):$dir='system'; $nod='program'; break;
case('connectors'):$dir='system'; $nod='connectors'; break;
case('helps'):$dir='lang/fr'; $nod='helps'; break;}
return self::msql($cat,$dir,$nod,$tabl);}

static function msql_fast($r,$cat){$qb=ses('qb');
$r[]=['backoffice','linkt','','/msql/users','','',$cat,'link'];
$r[]=['popup','ajax','popup','msql___users_'.ses('qb'),'','',$cat,'window'];
$r[]=[$qb,'ajax','bubble','bubs,root','msql','',$cat.'/'.$qb,''];
if(auth(6)){
$r[]=['system','ajax','bubble','bubs,root','msql','',$cat.'/system',''];
$r[]=['helps','ajax','bubble','bubs,root','msql','',$cat.'/helps',''];}
return $r;}

#admsq
static function msq_select_b($dr,$pr,$nd){
$r=explore('msql/'.$dr,'files',1); $n=count($r);
for($i=0;$i<$n;$i++){$rb=opt(substr($r[$i],0,-4),'_',4);
if($rb[2]!='sav' && $rb[3]!='sav'){
	if($pr && $nd){if($rb[0]==$pr && $rb[1]==$nd)$ret[]=$rb;}
	elseif($pr && !$nd){if($rb[0]==$pr)$ret[]=$rb;}
	else $ret[]=$rb;}}
return $ret;}

static function admsq_lang_sub(){$r=explore('msql/lang','dirs','1');
[$b,$d,$p,$t,$ver,$def]=$_SESSION['murl']; 
if($p)$lk='/'.$p; if($t)$lk.='_'.$t; if($ver)$lk='_'.$ver;
foreach($r as $k=>$v)
	$ret[]=[$v,'link','','/?msql=lang/'.$v.$lk,'admsq','','lang','msql'];
return $ret;}

static function admsq_dirs(){$r=['users','design'];
if(auth(6))$r=['clients','design','lang','server','system','users'];//'gallery','radio','stats',
foreach($r as $k=>$v){$vb=$v=='lang'?$v:'';
	$ret[]=[$v,'link','','/?msql='.$v,'admsq','',$vb,''];}
return $ret;}

static function admsq($d){
if(!$d)return self::admsq_dirs();
[$bs,$pr,$nd,$vr]=opt($d,'/',4); $ret=[];
if($bs=='lang' && !$pr)return self::admsq_lang_sub();
elseif($bs=='lang'){$bs.='/'.$pr; $pr=$nd; $nd=$vr;}
$r=self::msq_select_b($bs,$pr,$nd); if($r)sort($r); $qb=ses('qb');//
$lk='/?msql='.$bs; if(isset($dr))$lk.='/'.$dr; if($pr)$lk.='/'.$pr.'_';
if($r)foreach($r as $k=>$v){[$prf,$nod,$ver]=$v;
if((($bs=='users' or $bs='design') && ($prf=='public')) or auth(4)){//$prf==$qb or 
	if(!$pr){$bt=$prf; $lnk=$lk.'/'.$prf; $root=$d.'/'.$prf;} 
	elseif(!$nd){$bt=$nod; $lnk=$lk.$nod; $root=$d.'/'.$nod;} 
	elseif($ver){$bt=$ver; $lnk=$lk.$nod.'_'.$ver; $root=$d;}
	else{$bt='This'; $lnk=$lk.$nod; $root=$d;}
	if($bt)$ret[]=[$bt,'link','',$lnk,'admsq','',$d,''];}}//$root
return $ret;}

#admin
static function adminauthes2(){
if(isset($_SESSION['admath']))return $_SESSION['admath'];
$r=msql::prep('system','admin_authes');
foreach($r as $k=>$v)foreach($v as $ka=>$va)
if($va<=$_SESSION['auth'])$ret[$k][$ka]=$va;
$_SESSION['admath']=$ret; return $ret;}

static function fastmenu(){//$arw=rightarrow();$arw.
$r=msql::kv('lang','admin_menus',1); $ret='';
foreach($r as $k=>$v)$ret.=popbub('admin',$k,mimes($k).'&nbsp;'.$v,'',1);
return $ret;}

//login
static function exec($d){
if($d=='login'){login::call('','',''); return div(atd('nob'),login::form('','1',''));}
if($d=='cache'){$_SESSION['rqt']=[]; return li(boot::cache_arts(1));}}

//taxo
static function bubtaxo_root($r,$ib){
foreach($r as $k=>$v)
	if($k==$ib)$dir=self::bubtaxo_root($r,$v[10]);
if($ib)return $dir.'/'.$ib;}

static function taxo($dir,$ret){$r=$_SESSION['rqt'];
if(is_array($r))foreach($r as $k=>$v)if($v[10]){
	$root=$dir.self::bubtaxo_root($r,$v[10]);
	$ret[]=[$v[2],'art','',$k,'','',$root,'article','',''];}
return $ret;}
	
//overcat
static function overcats($d,$ret=''){//mods/overcats
if($ret)$root=$d.'/';//inclusion in self::menu
$r=ma::surcat_list();
if($r)foreach($r as $k=>$v)$ret[]=[$k,'link','cat','/cat/'.$k,'','',$root.$v,'url'];
return $ret;}

//desk
//'button','type','process','param','option','condition','root','icon','hide','private'
static function menubub($d,$n){//root,action,type,button,icon,auth
$r=msql::read('users',nod('menubub_'.($n?$n:'1')),'',1); $ret=[];
if(!ses('line'))boot::define_cats_rqt();
if($r)foreach($r as $k=>$v){//if(strpos($v[0],$d)!==false)
	[$v0,$v1,$v2,$v3,$v4,$v5]=arr($v,6);
	$bt=$v[3]?$v[3]:$v[1];
	//if($v[2]=='bub')p($v);
	if($v[2]=='app')$ret[]=[$v[3],$v[2],$v[1],'','','',$v[0],$v[4],'',$v[5]];
	elseif($v[2]=='appjs')$ret[]=[$v[3],$v[2],$v[1],'','','',$v[0],$v[4],'',$v[5]];
	//elseif($v[2]=='appin')$ret[]=[$v[3],$v[2],$v[1],'','','',$v[0],$v[4],'',$v[5]];
	elseif($v[2]=='module')$ret[]=[$v[3],(rstr(85)?'modpop':'modin'),'',$v[1],'','',$v[0],$v[4],'',$v[5]];
	elseif($v[2]=='mod')$ret[]=[$v[3],'mod','',$v[1],'','',$v[0],$v[4],'',$v[5]];
	elseif($v[2]=='ajax')$ret[]=[$v[3],'ajax','',$v[1],'','',$v[0],$v[4],'',$v[5]];//sysonly
	elseif($v[2]=='content')$ret[]=[$v[3],'ajax','content',$v[1],'','',$v[0],$v[4],'',$v[5]];
	elseif($v[2]=='popup')$ret[]=[$v[3],'popup',$v[1],'','','',$v[0],$v[4],'',$v[5]];
	//elseif($v[2]=='bub')$ret[]=[$v[3],'bubble',$v[0],$v[1],$v[0],$v[4],'',$v[5]];
	//elseif($v[2]=='taxo')$ret=self::taxo($v[0],$ret);
	elseif($v[2]=='msql')$ret[]=[$v[3],'msql',$v[1],'','','',$v[0],$v[4],'',$v[5]];
	elseif($v[2]=='arts')$ret[]=[$v[3],'arts',$v[1],'','','',$v[0],$v[4],'',$v[5]];
	elseif($v[2]=='overcat' && $v[5]<=ses('auth'))$ret=self::overcats($v[0],$ret);
	elseif($v[2])$ret[]=[$v[3],$v[2],'',$v[1],'','',$v[0],$v[4],'',$v[5]];
	else{if(sesr('line',$v[1]))$lk=htac('cat').$v[1];
		elseif(is_numeric($v[1]))$lk='/'.$v[1];	else $lk=$v[1];
		$ret[]=[$v[3],'link','',$lk,'','',$v[0],$v[4],'',$v[5]];}}
return $ret;}

//user
static function adm_user_fast(){
if(ses('USE'))$ret=popbub('user','',mimes('login').'&nbsp;'.ses('USE'),'',1);
return $ret;}
static function adm_user(){$rb=msql::read('system','default_apps_user','',1);
$r=msql::read_b('system','default_apps','',1); $r=self::r_apps_cond('user'); if($r)$r=$rb+$r;
if(ses('USE'))$r=unsetk($r,'login',0); else $r=unsetk($r,'logout',0);
return $r;}

static function adm_console($ret,$dir){
$r=explode(' ','system '.prma('blocks'));
$ret[]=['console','ajax','popup','admin__3_console_','','',$dir,'window',''];
if($r)foreach($r as $k=>$v){
if($v)$ret[]=[$v,'ajax','popup','admin__3_console_'.$v,'','',$dir,'window',''];
$rb=boot::context_mods($v);
if(is_array($rb))foreach($rb as $kb=>$vb){[$m,$p,$t,$c,$e,$g,$ch,$h]=$vb;//module
	if($m=='apps')$ret[]=['Apps','ajax','popup','admx,submod*pop','','',$dir.'/'.$v,'apps'];
	else $ret[]=[$m,'ajax','popup','admx,configmod__3_'.$kb,'','',$dir.'/'.$v,'divide'];}}
return $ret;}

static function adm_rstr($ret,$p,$o,$t){$dir=$p.'/'.$o;
$r=msql::prep('system','admin_restrictions');
$h=msql::read('lang','admin_restrictions');
$ret[]=[$t,'ajax','popup','admin__3_restrictions','','',$dir,'true'];
foreach($r as $k=>$v){
$ret[]=[$k,'ajax','popup','admx,rstrsav__3_','','',$dir,'divide'];
	foreach($v as $ka=>$va){$ico=rstr($ka)?'true':'false';
	$ret[]=[$va,'ajax','popup','rstr__xx_'.$ka,'','',$dir.'/'.$k,$ico];}}
if(auth(6))$ret[]=['msql','ajax','popup','msql__3_system_admin_restrictions','','',$dir,'msql'];
return $ret;}

//admin_menu //if rstr(98)
static function adm_admin($dir){//case:admin
$r=self::adminauthes2(); $rm=msql::kv('lang','admin_authes',1);
$ret[]=['office','ajax','popup','admin___all','','','Global','popup'];
$ret[]=['backoffice','linkt','','/admin/console','','','Global','link'];
$mn=ses('mn');
if($r)foreach($r as $k=>$v){
if(strto($k,'/')==strto($dir,'/')){
	if($k=='Microsql')$ret=self::msql_fast($ret,$k);
	else foreach($v as $ka=>$va){
	if($va<=$_SESSION['auth']){$t=$rm[$ka]?$rm[$ka]:$ka; $ico=mime($ka);
		if($ka=='css'){//name,j,root,ico,lk
			$mlt='page_desk,deskbkg;popup_admin__3_css;popup_site___desktop_ok';
			$ret[]=['edition','link','blank','/admin/'.$ka,'','',$k.'/'.$ka,'link'];
			$ret[]=['desktop','js','SaveJc',$mlt,'','',$k.'/'.$ka,'popup','',''];
			$ret[]=['design','ajax','popup','admin__3_design','','',$k.'/'.$ka,$ico,''];
			$ret[]=['colors','ajax','popup','admin__3_colors','','',$k.'/'.$ka,$ico,''];}
		elseif(strtolower($ka)=='hubs' && auth(5) && is_array($mn))foreach($mn as $kb=>$vb)
			$ret[]=[$vb?$vb:$kb,'link','',subdomain($kb),'','',$k.'/'.$ka,$ico];
		elseif($ka=='console')$ret=self::adm_console($ret,$k.'/'.$ka);
		elseif($ka=='restrictions')$ret=self::adm_rstr($ret,$k,$ka,$t,$ico);
		elseif($ka=='tickets')$ret[]=[$t,'app','chatxml,home','tickets','','',$k,'chat'];
		elseif($ka=='update')$ret[]=[$t,'ajax','popup','admin__3_'.ajx($ka),'','',$k,'download',''];
		else $ret[]=[$t,'ajax','popup','admin__3_'.ajx($ka),'','',$k,$ico,''];}}}}
return $ret;}

static function adm_admn($dir){
$r=self::adminauthes2(); $rm=msql::kv('lang','admin_authes',1);
$ret[]=['backoffice','link','blank','/?msql=users','','','Microsql','link'];
$r[]=[ses('murl'),'ajax','bubble','bubs,root','msql','',ses('murl'),''];
$ret[]=['hub','ajax','popup','msql___users_'.ses('qb'),'','','Microsql','window'];
if(auth(6))$ret[]=['lang','ajax','popup','msql___lang','','','Microsql','window'];
if(auth(6))$ret[]=['system','ajax','popup','msql___system','','','Microsql','window'];
foreach($r as $k=>$v){if($k==$dir)foreach($v as $ka=>$va){$t=$rm[$ka]??$ka;
	if($k!='Microsql')$ret[]=[$t,'ajax','popup','admin___'.ajx($ka),'','',$k,mime($ka)];
	else $ret[]=[$t,'ajax','popup','msql___users_'.ses('qb').'_'.$ka,'','',$k,'window'];}}
return $ret;}

//build
//apps=['button','type','process','param','option','condition','root','icon'];
//$rc=[$v[0],$v[1],$v[2],$v[3],$v[4],$v[5],$v[6],$v[7]];
static function apps($r,$d,$dir,$cond){//$r,,dir,cond
if($dir=='zero'){$dir=''; $dd='d';} else $dd=''; $rb=[]; $ret=''; //p($r);
$dr=explode('/',$dir); $nd=$dir?count($dr):0;
if($r)foreach($r as $k=>$v){$rc=array_flip(explode(' ',' '.$v[5]));
if($rc[$cond?$cond:'menu']??'' or !$v[5]){$t=$v[0];
	$rv=explode('/',$v[6]); $nv=$v[6]?count($rv):0;
	$ico=$v[7]?picto($v[7],'').'&nbsp;':''; $rvb=$rv[$nv-1]??'';
	if($v[1]=='art' && $icb=sesr('catpic',$v[3]))$ico=$icb;
	if($dir==$v[6])$is=true; else $is=desk::match_vdir($dr,$nd,$rv);
	if($is && $nv>=$nd+1 && empty($v[8]) && auth($v[9]??'')){$root=$v[6];//dirs
		if($nv>=$nd+1){$rvb=$rv[$nd]; $rot=[];
			for($i=0;$i<=$nd;$i++)$rot[]=$rv[$nd-$i]; $rot=array_reverse($rot);
			if($rot)$root=implode('/',$rot);}
		$pc=picto('kright','20px').'&nbsp;'.$rvb;
		if($dd)$pc=$rvb;
		$rb[$rvb]=popbub($v[4]?$v[4]:$d,ajx($root),$pc,$dd,1);}
	if($is && $nv>$nd)$is=false;
	if($is && empty($v[8]) && (empty($v[9]) or auth($v[9]??''))){//noj*
		if($v[1]=='link')$rb[$t]=ljbub($ico.$t,$v[3],'','','','');
		elseif($v[1]=='linkt')$rb[$t]=ljbub($ico.$t,$v[3],'','','','1');
		elseif($v[1]=='js')$rb[$t]=ljbub($ico.$t,'',atj($v[2],$v[3]));
		elseif($v[1]=='bub')$rb[$t]=popbub($v[2],$v[3],$ico.$t,'c',1);//d
		elseif($v[1]=='arts')$rb[$t]=popbub('','arts',$ico.$t,'d',0);
		elseif($v[1]=='mod')$rb[$t]=mod::callmod($v[3]);
		elseif($v[1]=='modbt')$rb[$t]=mod::btmod($v[3].',t:'.$t);
		else{$j=desk::read($v); $rb[$t]=ljbub($ico.$t,'',sj($j));}}}}
if($rb)$ret=implode('',$rb);
//if($d=='arts')//$ret=desk::pane_icons($rb,'icones');
//$ret=scroll($rb,$ret,19);
return $ret;}

//rooter
static function r_apps_cond($d){$r=msql::read_b('',nod('apps'),'',1); $ret=[];
if($r)foreach($r as $k=>$v)if($v[5]==$d){$v[5]=''; $ret[$k]=$v;} return $ret;}

static function r_apps_home($o){
$r=msql::read_b('system','default_apps_home','',1); if($o)return $r; 
$rb=self::r_apps_cond('home'); if(!rstr(56))$r=unsetk($r,'hubs',0);
//if(!rstr(48))$r=unsetk($r,'boot',6);
return array_merge_b($rb,$r);}

static function root($d,$dir='',$n=''){$r=[];
switch($dir){//pre-rendered, intercepte navigation
case('batch'):return sav::batch('','c');break;
case('fastmenu'):return self::fastmenu();break;
case('fastmenu2'):return adm::fastmenu(1);break;
case('search'):return search_btn();break;
case('addart'):return self::addart_btn();break;
case('ucom'):return self::ucom_btn();break;
case('arts'):return self::adm_arts_fast(); break;
case('user'):return self::adm_user_fast(); break;
case('exec'):return self::exec($d); break;
case('hubs'):$r=self::hubs_fast(); break;
case('bub'):$r=self::slct($d); break;}
switch($d){
case('home'):$r=self::r_apps_home(0); break;
case('adhome'):$r=self::r_apps_home(1); break;
case('admin'):$r=self::adm_admin($dir); break;
case('admn'):$r=self::adm_admn($dir); break;
case('desk'):$r=desk::datas(); break;
case('arts'):$r=self::adm_arts($dir); break;
case('seek'):$r=self::seek(); break;
case('seektag'):$r=self::seek_tag($dir); break;
case('seekart'):$r=self::seek_art($dir); break;
//case('mods'):$r=self::adm_mods($dir); break;
case('msql'):$r=self::msql_dir($dir); break;
case('admsq'):$r=self::admsq($dir); break;
//case('admsqb'):$r=self::admsq_b($dir); break;
case('table'):$r=msql::read('',nod($dir),'',1); break;
case('lang'):$r=self::langs(); break;
case('timetravel'):$r=self::timetravel(); break;
case('dev'):$r=self::dev(); break;
case('user'):$r=self::adm_user(); break;
//case('plug'):$r=self::plug($dir); break;
case('overcat'):$r=self::overcats($dir); break;
case('menubub'):$r=self::menubub($dir,$n); break;
case('bubses'):$r=$_SESSION['bubses']; break;}
return self::apps($r,$d,$dir,'');}
}
?>