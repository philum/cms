<?php 
class boot{

static function cnf(){return 'cnfg/_'.sql::$db.'_config.txt';}
static function cnc(){return 'cnfg/'.str_replace('www.','',$_SERVER['HTTP_HOST']).'.php';}
static function reset_mjx(){for($i=1;$i<12;$i++)$_SESSION['heremjx'.$i]='';}
static function reset_ses(){self::reset_mjx(); $r=['dev','prog','mdc','mem','digr','icotag','recache','adminauthes','msqmimes','negcss','delaytext','scanplug','simplified','connedit','lang','lng','flags','murl'];
$n=count($r); for($i=1;$i<$n;$i++)unset($_SESSION[$r[$i]]);}

#master_cnfg//qd
static function master_params(){$f=self::cnf();
$qd=ses('qd'); $aqb=ses('aqb'); $subd=ses('subd');
$d=is_file($f)?read_file($f):''; $prms=expl('#',$d,16);
//else self::restore_mprm($f);
if(!$qd){if(!$prms[0])$qd='pub'; else $qd=$prms[0];}//master_of_puppets
if($qdb=get('qd')){$bqd=sqb('id',$qdb.'_user','v','limit 1');//master_node
	if(!$bqd && !post('create_hub') && !post('create_node'))$qd=$prms[0]; else $qd=$qdb;}
$_SESSION['qd']=$qd;
$r=sqldb::$rt;//defs
foreach($r as $k=>$v)$_SESSION[$k]=$qd.'_'.$v;
//if(ses('dev')=='b')$_SESSION['qda']=$qd.'_art_b';//
$_SESSION['htacc']=$prms[1]=='yes'?1:'';
sesr('prms','create_hub',$prms[2]=='yes'?'on':'off');
sesr('prms','default_hub',$aqb?$aqb:($prms[3]?$prms[3]:''));//1
$_SESSION['sbdm']=$prms[4]=='yes'&&!$subd?1:'';
sesr('prms','srvup',$prms[5]?$prms[5]:'philum.fr');//updates
sesr('prms','nogdf',$prms[6]=='no'?1:'');
sesr('prms','goog',$prms[7]);
sesr('prms','timez',$prms[8]?$prms[8]:'Europe/Paris');
sesr('prms','error',$prms[9]?$prms[9]:'NULL');
//sesr('prms','enc',ses::$enc);//defined by cnfg
sesr('prms','uplimit',$prms[12]?$prms[12]:'2500');
sesr('prms','aupdate',$prms[13]);
sesr('prms','srvmirror',$prms[14]);
sesr('prms','srvimg',http($prms[15]));}

static function restore_mprm($f){
$d=sql('struct','qdu','v','id="'.ses('USE').'"');
write_file($f,$d);}

static function define_hubs(){
$ret=[]; $rtb=[];
$exists=sql('id','qdu','v',1);
if(!$exists){$_SESSION['stsys']=1; $_SESSION['first']=1;
	Head::add('jscode',sj('popup_login,form'));}
$wh='active="1" ';//if(!auth(7))
$req=sql::com('name,hub,id','qdu',$wh.'order by nbarts desc');
if($req)while($r=sql::qrw($req)){// && ($r[3] or auth(6))
	$hub=$r[1]?$r[1]:$r[0]; $ret[$r[0]]=$hub; $rtb[$r[0]]=$r[2];}
if($ret)$_SESSION['mn']=$ret; $_SESSION['mnd']=$rtb;}

//use need to be declared after $rstr, declared in config(), whose declare $mn, needed to hubs() 
static function define_closed_hub(){$use=ses('USE');
if($use && !isset($_SESSION['mn'][$use])){
	$v=sql('hub','qdu','v',['name'=>$use]);
	if($v)$_SESSION['mn'][$use]=$v;}}

static function define_subdomain(){
$r=explode('.',$_SERVER['HTTP_HOST']);
if($r[2]){$aqb=$r[0]!='www'?$r[0]:$r[1]; 
if($aqb!=$_SESSION['qb'])geta('hub',$aqb);}}

static function define_qb(){$hub=get('hub');
$r=ses('mn'); $defo=prms('default_hub'); //if(!$hub)$hub=$defo;
if($hub && $hub!='=' && isset($_SESSION['mn'][$hub])){$aqb=$hub; $qbd=$_SESSION['mnd'][$hub];}
elseif($defo && !ses('qb'))[$qbd,$aqb]=arr(sql('id,name,hub','qdu','r','name="'.$defo.'"'),2);
if(isset($aqb)){$_SESSION['qb']=$aqb; $_SESSION['qbd']=$qbd;}
if(!ses('qbd') && ses('qb'))$_SESSION['qbd']=sql('id','qdu','v','name="'.$_SESSION['qb'].'"');}

static function prmb_defaults($cnfg){
$pm=opt($cnfg,'#',28);
//if(!$pm[0])$pm[0]=$_SESSION['qb'];//hub
if(!$pm[1] or !is_numeric($pm[1]))$pm[1]='1';//mods
if(!$pm[3])$pm[3]=400;//kmax
if(!$pm[6])$pm[6]=20;//nb_arts_by_page
if(!$pm[7])$pm[7]='1 2 3 4';//typarts
if(!$pm[8])$pm[8]='phi';//logo
if(!$pm[9])$pm[9]='id desc';//order
if(!$pm[10])$pm[10]=nms(21).'/'.nms(171).'/'.nms(91).'/'.nms(182);//tracks
if(!$pm[17])$pm[17]='ymd.Hi';//date
//if(!$pm[19])$pm[19]='fr en es';//langs
if(!$pm[24])$pm[24]='http://philum.fr';//server
if(!$pm[25])$pm[25]='fr';//lang
return $pm;}

static function define_config(){$qb=ses('qb');
$qbn=sql('mail,config,dscrp','qdu','a','name="'.$qb.'"');
$rst=msql::col('',$qb.'_rstr',0,1); if(!$rst)$rst=msql::col('system','default_rstr',0,1);
$_SESSION['rstr']=arr($rst,150);
$_SESSION['prmb']=self::prmb_defaults($qbn['config']??'');
$qbin['adminmail']=$qbn['mail']??'';
$qbin['dscrp']=$qbn['dscrp']??'';
$_SESSION['qbin']=$qbin;
$_SESSION['modsnod']=$qb.'_mods_'.prmb(1);
if($_SESSION['prmb'][5])self::auto_design();
self::define_mods();
$_SESSION['nms']=msql::col('lang','helps_nominations',0,1);
if(rstr(112))$_SESSION['catpic']=msql::two('',nod('pictocat'),'',1);
$_SESSION['art_options']=['related','folder','agenda','lang','template','authlevel','password','tracks','2cols','fav','like','poll','bckp','artstat','quote','lastup','plan','mood','agree'];
$_SESSION['mobile']=mobile(); $_SESSION['switch']=''; $_SESSION['prma']=[];}

static function define_use(){
if(rstr(59) && !ses('nuse')){
	if($cuse=cookie('use')){$uid=login::verif_user($cuse,'');//id of usr
		setcookie('uid',$uid,$_SESSION['dayx']+(86400*30));
		if(cookie('uid')==$uid && $uid){$_SESSION['USE']=$cuse; $_SESSION['uid']=$uid;}}}
self::define_closed_hub();}

#time_system
static function time_system($cache){$prmb16=prmb(16); $gnbj=get('nbj'); $snbj=ses('nbj');
if($gnbj){$_SESSION['nbj']=$gnbj; $cache='ok';}
if((!$snbj or $cache=='ok') && !$gnbj){
	if(rstr(3) or $prmb16=='auto')$_SESSION['nbj']=self::dayslength($_SESSION['qb'],50);
	else{$_SESSION['dayb']=0; $_SESSION['nbj']='';}
	if(is_numeric($prmb16))$_SESSION['nbj']=$prmb16;}
if(!ses('daya') or date('d',$_SESSION['daya'])==date('d',$_SESSION['dayx']) or $cache=='ok')
	$_SESSION['daya']=$_SESSION['dayx'];
if($gtim=get('timetravel')){$_SESSION['daya']=inpday($gtim); $cache='ok';}
if($_SESSION['nbj'])$_SESSION['dayb']=timeago($_SESSION['nbj']);
return $cache;}

static function dayslength($qb,$limit){
$r=[1,7,10,90,365,720,1440,2920,5840,11680,23360,46720,93440];//16y,32,64,128y!
for($i=0;$i<9;$i++){$nbj=$r[$i];
	$nb=sql('count(id)','qda','v','nod="'.ses('qb').'" and day>"'.timeago($nbj).'"');
	if($nb>$limit)$i=9;}
return $nbj;}

static function seslng(){if(empty($_SESSION['lang'])){
	$hal=isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])?$_SERVER['HTTP_ACCEPT_LANGUAGE']:'';
	$lg=substr($hal,0,2); $syslg=$_SESSION['prmb'][25];
	if(!rstr(53))$lg='all'; elseif(!$lg)$lg=$syslg; $_SESSION['lang']=$lg;
	$_SESSION['lng']=$lg!='all'?$lg:$syslg;}//translations
return $_SESSION['lang'];}

#current
static function deductions($cache=''){$qb=ses('qb'); $rs=['',''];
$qda=ses('qda'); $read=get('read'); $art=get('art'); $mod=get('module'); $ctx=get('context');
$_SESSION['read']=''; $_SESSION['frm']='';
if(!is_numeric($read) && $read)$art=$read;
if($art){$read=ma::id_of_urlsuj($art); if($read)geta('read',$read);}
if(is_numeric($read)){
	[$day,$frm,$raed,$img,$pb,$them,$lu,$re]=ma::pecho_arts($read);
	if($pb!=$qb){
		if(rstr(96))return getz('read');//prison
		if(rstr(105)){//interhub//self::define_qb();
			if(!isset($_SESSION['mn'][$pb]))return;
			if(!rstr(97)){self::reset_ses(); $_SESSION['qb']=$pb; $cache=geta('id','ok');}}}
	if($raed){geta('frm',$frm); $_SESSION['read']=$read; ses::$r['raed']=$raed;
		$_SESSION['mem'][$read]=1; $rs=['art',$read];}
	else{getz('read'); $rs=['context','home'];}}
elseif($mod)$rs=['module',$mod];
//elseif($_SESSION['line'][$read]??''){geta('frm',$read) $rs=['cat',$read];}
elseif($cat=str::protect_url(get('cat'),1)){geta('frm',$cat); $rs=['cat',$cat];}
//elseif($cid=get('catid')){geta('frm',$cid); $rs=['cat',$cid];}
else $rs=['context','home'];
ses::$st=['a'=>$rs[0],'p'=>$rs[1]];//,'j'=>self::state()
return $cache;}

static function repair_mods($nod){
$r=msql::read_b('',$nod.'_sav');
if($r){$r=msql::copy('users',$nod.'_sav','users',$nod);
	if(auth(2))alert('backup mods restored');}
if(!$r){$r=msql::read_b('system','default_mods');
	if($r)$r=msql::copy('system','default_mods','users',$nod);
	if(auth(4))alert('using minimal config '.lkc('txtx','/admin/hubs&reinit==','reinit?'));} 
return $r;}

static function define_mods(){$nod=ses('qb').'_mods_'.prmb(1);
$r=msql::read('',$nod,'',1); if(!$r)$r=self::repair_mods($nod); $tmp=[];
if($r)foreach($r as $k=>$v){
	if($v[0]=='system' && $v[1]=='template')$tmp[$v[4]]=$v[2];
	if($v[0]=='system' && $v[2])$vrf[$v[1]]=$k;
	$key=array_shift($v); $ret[$key][$k]=$v;}
if(!$vrf['blocks'])$ret['system'][]=['blocks','banner menu content footer'];
if(!$vrf['design'])$ret['system'][]=['design','2'];
if(!$vrf['content'])$ret['system'][]=['content','800'];
$_SESSION['mods']=$ret;
$_SESSION['tmpc']=$tmp;}

static function define_modc(){//define_mods_cond
$r=$_SESSION['mods']; $cnd=$_SESSION['cond']; $ret=[];
if(is_array($r))foreach($r as $k=>$v)if(is_array($v))foreach($v as $ka=>$va)if(isset($va[7]) && $va[7]!=1){
if($va[3]==$cnd[0] or (isset($cnd[1]) && $va[3]==$cnd[1]) or !$va[3]){
if($va[0]=='LOAD' && isset($rb[$va[0]]))$ka=$rb[$va[0]];//substitute
$ret[$k][$ka]=$va; $rb[$va[0]]=$ka;}}
if($ret)ksort($ret); $_SESSION['modc']=$ret;}

#config
static function define_prma(){$r=sesr('modc','system'); $_SESSION['prma']=[];
if($r)foreach($r as $k=>$v){
if($v[0]=='design' && empty($_SESSION['desgn'])){$_SESSION['prmd']=$v[1];
	if($v[5])Head::add('jslink','/css/'.self::csslayer($v[5]).'.css');}
if($v[0]=='csscode' && $v[1])Head::add('csscode',$v[1]);
elseif($v[0]=='jscode' && $v[1])Head::add('jscode',$v[1]);
elseif($v[0]=='jslink' && $v[1])Head::add('jslink',$v[1]);
elseif($v[1])$_SESSION['prma'][$v[0]]=$v[1];}}

static function define_condition(){
$cnt=get('context'); $gmd=get('module'); $frm=get('frm'); $read=get('read');
if($read)$cnd=['art',$read];
elseif($gmd)$cnd=['module',$gmd];
elseif($cnt)$cnd=[$cnt,''];
elseif($frm)$cnd=['cat',$frm];
elseif(!$frm)$cnd=['home',''];//else $cnd=['cat',''];
$_SESSION['cond']=$cnd; self::define_modc(); self::define_prma();}

static function setcond($cnd,$o=''){
if($cnd=='home')$r=['home',''];
if(is_numeric($cnd))$r=['art',$cnd];
elseif($cnd=='cat' or $cnd=='art')$r=[$cnd,''];
elseif(substr($cnd,0,3)=='cat')$r=['cat',substr($cnd,3)];
elseif($cnd!='all')$r=[$cnd,''];
else $r=['',''];
if($o)$_SESSION['cond']=$r; else return $r;}

static function select_mods($d=''){
if($d){$_SESSION['prmb1']=prmb(1); $_SESSION['prmb'][1]=$d;}
elseif($_SESSION['prmb1']){$_SESSION['prmb'][1]=$_SESSION['prmb1']; $_SESSION['prmb1']='';}
self::reset_mjx(); $_SESSION['modsnod']=$_SESSION['qb'].'_mods_'.prmb(1); 
self::define_mods(); self::define_condition();}

#context
static function context_mods($vl){$r=sesr('mods',$vl); $cnd=ses('cond'); $ret=[];
if($r)foreach($r as $k=>$v)if(isset($v[3])){[$ka,$kb]=self::setcond($v[3]);
if($v[3]==$cnd[0].$cnd[1] or ($ka==$cnd[0] && !$kb) or ($kb && $kb==$cnd[1]) or !$v[3])$ret[$k]=$v;}
return $ret;}

#css
static function define_clr(){$k=ses('prmd');
$r=msql::col('design',nod('clrset_'.$k),0,1);
$_SESSION['clrs'][$k]=$r; return $r;}

static function auto_design(){$n=ses('prmd'); $phi=ses('philum'); $qb=ses('qb');
$d=msql::read_b('',$qb.'_autodesign',$phi,'',[$phi=>[1]]);
if(!$d){
if($n<4)$r=msql::read('system','default_css_'.$n);
elseif(is_numeric($n))$r=msql::read('design','public_design_'.$n);
$f='css/'.$qb.'_auto.css';
sty::build_css('css/'.$qb.'_auto.css',$r);
msql::modif('',$qb.'_autodesign',[1],'one','',$phi);
alert('css_auto re-generated');}}

static function negcss(){
$_SESSION['night']=1;
if($n=$_SESSION['prmb'][5])$nod=ses('qb').'_auto';
else $nod=ses('qb').'_design_'.ses('prmd');
$f='css/'.$nod.'_neg.css'; $tima=ftime('css/'.$nod.'.css','ymdHi'); $timb=ftime($f,'ymdHi');
if($tima>$timb){$clr=getclrs(); $klr=sty::invertclrs($clr);
	$_SESSION['clrs'][$_SESSION['prmd'].'_neg']=$klr;
	if($n){if($n<4)$r=msql::read('system','default_css_'.$n);
		elseif(is_numeric($n))$r=msql::read('design','public_design_'.$n);}
	else $r=msql::read('design',$nod);
	//foreach($r as $k=>$v)if($v[2]=='img')$r[$k][6]='filter:invert(100%);';
	sty::build_css($f,$r,$klr);}}

static function night(){
$r=ses::$r['night']??[]; //if($r)return $r;//from meteo
$r=date_sun_info(ses('dayx'),48.839,2.237);
return [$r['sunrise'],$r['sunset']];}

static function define_design(){
if(rstr(63))$_SESSION['negcss']=1;
$qb=ses('qb'); if(!$qb)$qb='public'; $nod=$qb.'_design';
if(ses('desgn'))$nod.='_dev';
if($sw=ses('switch'))$nod.='_'.$sw; else $nod.='_'.ses('prmd');
if(prmb(5) && !isset($_SESSION['desgn']))$nod=nod('auto');
if(ses('tablet'))Head::add('csscode',tablet::home());
if(ses('negcss')){$nod.='_neg'; self::negcss();}
elseif(rstr(122)){[$h1,$h2]=self::night(); $dt=ses('dayx');//sesmk2('boot','night','')
	if($dt>$h2 or $dt<$h1){$nod.='_neg'; if(!ses('night'))self::negcss();}}
return $nod;}

static function csslayer($n){if($n=='classic')return '_classic';
elseif(is_numeric($n))return 'public_design_'.$n;}

#users
//log
static function log_mods($log){$use=ses('USE'); $ret='';
switch($log){
case('on'): $usr=post('user','login');
	$ret=login::call($usr,post('pass'),post('mail')); break;
case('in'): $ret=login::form('','',''); break;
case('out'): $_SESSION['USE']=''; $_SESSION['auth']=''; $dayz=$_SESSION['dayx']-86400;
	setcookie('use',$use,$dayz); setcookie('uid',ses('uid'),$dayz); $_SESSION['nuse']=1;  relod('/'); break;
case('reboot'): $r=['qd','qb','USE','uid','iq','dev']; $rb=[];
	foreach($r as $v)$rb[$v]=ses($v); $_SESSION=$rb; relod('/'); break;
case('create_hub'): $_POST['create_hub']=ses('qb'); 
	$ret=login::call(ses('qb'),'pass',''); break;
case('off'): $qd=$_SESSION['qd']; $dev=$_SESSION['dev']; session_destroy();
	$_SESSION['qd']=$qd; $_SESSION['dev']=$dev; relod('/?qd='.$qd); break;
case('down'): session_destroy(); relod('/'); break;}
if($ret)alert($ret);}

//auth
//0=no;1=read;2=tracks;3=propose;4=publish;5=edit;6=admin;7=host;
static function ismbr($d){return sql('auth','qdb','v',['hub'=>ses('qb'),'name'=>$d]);}
//static function members(){return sql('name,auth','qdb','kv','hub="'.ses('qb').'"');}
static function define_auth(){$use=ses('USE');
if(!ses('master'))$_SESSION['master']=sql('name','qdu','v',['name'=>prms('default_hub')]);
if($use){if($use==$_SESSION['master'])$auth=7;
	elseif($use==$_SESSION['qb'])$auth=6;
	elseif($ath=self::ismbr($use))$auth=$ath;
	else $auth=1;}
else $auth=0;
$_SESSION['auth']=$auth;}

//cookie
static function cookie_accept(){
$ret=btn('txtred',nms(188)).' ';
$j='cook_usg,cookprefs___';
$ret.=lj('',$j.'1',picto('ok'));
$ret.=lj('',$j.'-1',picto('no'));
$ret.=hlpbt('cookie');
return btd('cook',$ret);}

//stats
static function define_iq(){$ip=sesmk('hostname');
$iq=sql('id','qdp','v','ip="'.$ip.'" limit 1');
if(!$iq){$iq=cookie('iq');
	if($iq)sqlup('qdp',['ip'=>$ip],['id'=>$iq]);}
if(!$iq){$nav=addslashes($_SERVER['HTTP_USER_AGENT']??''); $ref=$_SERVER['HTTP_REFERER']??'';
	$iq=sql::sav('qdp',[$ip,$nav,$ref,1,'NOW()']);}
$_SESSION['iqa']=sql('ok','qdk','v',['iq'=>$iq],0);
$_SESSION['ip']=$ip; $_SESSION['iq']=$iq;}

#update
static function verif_update(){
if($_SESSION['auth']>5 && !prms('aupdate')){
	$localver=checkversion(2); $distver=sesmk('checkupdate',2,1);//ses('philum')
	if($distver>$localver)Head::add('jscode',sj('popup_software,call___1'));
	if(!isset($_SESSION['verifs'])){
	if(prms('srvmirror'))Head::add('jscode',sj('popup_transport,batch__3'));}
$_SESSION['verifs']=1;}}

#state
static function state(){
$read=get('read'); $gmd=get('module'); $ret='';
if($read)$ret='popart___'.$read;
elseif($cat=get('cat'))$ret='api___cat:'.ajx($cat);
elseif($gmd)$ret='mod,callmod__3_'.ajx($gmd);//m:'.$gmd.',p:'.get('p');
elseif($a=get('app'))$ret=$a.',home___'.get('p');
elseif($cnt=get('context'))$ret='mod,block__3_'.$cnt;
elseif($ra=api::load_rq())$ret='api,callj___'.implode_k($ra,',',':');
//else $ret='mod,block__3_home';
return $ret;}

static function deskpage(){
Head::add('jscode',desk::desktop_js('boot')); 
$ret=self::state();
if($ret)Head::add('jscode',sj('popup_'.$ret));}

#cache
static function cache_arts($x=''){$lastart=''; $rtb=[]; $ret=[]; $main=[]; $nod=ses('qb').'_cache';
if($x)msql::del('',$nod); else $main=msql::read_b('',$nod,'',1); //$_SESSION['rqt']=[];
if($main){$last=current($main); $lastart=ma::lastart($last[0]);}
if(($lastart && !isset($main[$lastart])) or $x){
	$rh=['_menus_'=>['date','cat','title','img','hub','url','lu','author','length','src','ib','re','lg']];
	$slct='id,day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re,lg';
	if(ses('dayb'))$wh=' and day>"'.ses('dayb').'"'; else $wh=' and day>"'.calctime(360).'"';
	$r=sql::com($slct,'qda','nod="'.ses('qb').'"'.$wh.' and substring(frm,1,1)!="_" and re>"0" order by '.prmb(9));
	if($r)while($rb=sql::qrw($r)){$k=array_shift($rb); $rb[3]=pop::art_img($rb[3]); $ret[$k]=$rb;}
	$ok='cache reloaded'; msql::save('',$nod,$rh+$ret); $_SESSION['rqt']=$ret;}
elseif($main)$_SESSION['rqt']=$main;
return lk('/reload/'.ses('qb'),'reload');}

static function define_cats_rqt(){$ret=[];
if(rstr(3)){$r=$_SESSION['rqt']??[];
	if($r)foreach($r as $k=>$v)if($v[1] && $v[11])$ret[$v[1]]=radd($ret,$v[1]);} 
//elseif(rstr(123))$ret=sql('cat,id','qdc','kv',['qb'=>ses('qb')]);
else $ret=sql('distinct(frm)','qda','k','nod="'.ses('qb').'" and re>0 and substring(frm,1,1)!="_"');
$_SESSION['line']=$ret;}

#ignition
static function init(){self::master_params(); $_SESSION['philum']=checkversion();
self::define_hubs(); self::define_qb(); self::define_config();}

static function reboot(){self::reset_ses(); $_SESSION['dayx']=time();
self::init(); self::define_use(); self::define_iq(); self::define_auth(); self::seslng(); self::time_system('ok'); self::cache_arts(); self::define_cats_rqt(); self::define_condition(); self::define_clr();}
//$_SESSION['rstr']=msql::col('',nod('rstr'),0,1);

static function rebuild(){$_SESSION['rqt']=[]; 
return self::cache_arts(1); $_SESSION['dayx']=time();}

#utils
static function block_crawls(){$ip=ses('ip');//hostname()//proxad
$r=['msnbot','googlebot','spider','wowrack','netestate','tralex','ipvnow','semrush','webnx','static','crawl'];
$n=count($r); for($i=0;$i<$n;$i++)if(strpos($ip,$r[$i])!==false)exit;}

}
?>