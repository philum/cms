<?php
//philum_boot

#master_params//qd
function master_params($dr){$f=$dr.'_config.txt';
$qd=ses('qd'); $aqb=ses('aqb'); $subd=ses('subd');
$d=is_file($f)?read_file($f):''; $prms=expl('#',$d,16);
//else restore_mprm($f);
if(!$qd){if(!$prms[0])$qd='pub'; else $qd=$prms[0];}//master_of_puppets
if($qdb=get('qd')){$bqd=sqb('id',$qdb.'_user','v','limit 1');//master_node
	if(!$bqd && !post('create_hub') && !post('create_node'))$qd=$prms[0]; else $qd=$qdb;}
$_SESSION['qd']=$qd;
$r=['qdy'=>'_sys','qda'=>'art','qdm'=>'txt','qdd'=>'data','qdu'=>'user','qdi'=>'trk','qdb'=>'mbr','qdp'=>'ips','qdv'=>'live','qdv2'=>'live2','qds'=>'stat','qdt'=>'meta','qdta'=>'meta_art','qdtc'=>'meta_clust','qdtm'=>'meta_mul','qdf'=>'favs','qdsr'=>'search','qdsra'=>'search_art','ynd'=>'yandex','qdw'=>'web','qdtw'=>'twit','qdg'=>'img','qdc'=>'cat','qdk'=>'iqs'];//'qdh'=>'hub','qdt-en'=>'meta_en',
foreach($r as $k=>$v)$_SESSION[$k]=$qd.'_'.$v;
//if(ses('dev')=='b')$_SESSION['qda']=$qd.'_art_b';//
$_SESSION['htacc']=$prms[1]=='yes'?1:'';
sesr('prms','create_hub',$prms[2]=='yes'?'on':'off');
sesr('prms','default_hub',$aqb?$aqb:($prms[3]?$prms[3]:''));//1
$_SESSION['sbdm']=$prms[4]=='yes'&&!$subd?1:'';
sesr('prms','upservr',$prms[5]);
sesr('prms','nogdf',$prms[6]=='no'?1:'');
sesr('prms','goog',$prms[7]);
sesr('prms','timez',$prms[8]?$prms[8]:'Europe/Paris');
sesr('prms','error',$prms[9]?$prms[9]:'NULL');
$_SESSION['jbuffer']=$prms[10]?$prms[10]:'2000';
$_SESSION['enc']=$prms[11]==1?'utf-8':'iso-8859-1';
sesr('prms','uplimit',$prms[12]?$prms[12]:'2500');
sesr('prms','aupdate',$prms[13]);
sesr('prms','srvmirror',http($prms[14]));
sesr('prms','srvimg',http($prms[15]));}

function restore_mprm($f){
$d=sql('struct','qdu','v','id="'.ses('USE').'"');
write_file($f,$d);}

function define_hubs(){//$_SESSION['mn']=[];
$USE=ses('USE'); $ret=[]; $rtb=[];
$exists=sql('id','qdu','v','');
if(!$exists){$_SESSION['stsys']=1; $_SESSION['first']=1;
	Head::add('jscode',sj('popup_loged___'));}
$wh='where active="1" ';//if(!auth(7))
$req=sqr('name,hub,id','qdu',$wh.'order by nbarts DESC');
if($req)while($r=qrw($req)){// && ($r[3] or auth(6))
	$hub=$r[1]?$r[1]:$r[0]; $ret[$r[0]]=$hub; $rtb[$r[0]]=$r[2];}
if($ret)$_SESSION['mn']=$ret; $_SESSION['mnd']=$rtb;
if($USE && !isset($_SESSION['mn'][$USE]))define_closed_hub($USE);}

function define_closed_hub($hub){
$v=sql('hub','qdu','v','name="'.$hub.'"');
if($v)$_SESSION['mn'][$hub]=$v;}

function define_subdomain(){
$r=explode('.',$_SERVER['HTTP_HOST']);
if($r[2]){$aqb=$r[0]!='www'?$r[0]:$r[1]; 
if($aqb!=$_SESSION['qb'])$_GET['hub']=$aqb;}}

function define_qb(){
if($_SESSION['sbdm'])define_subdomain(); $id=get('hub');
$r=ses('mn'); $defo=prms('default_hub'); //if(!$id)$id=$defo;
if($id && $id!='=' && isset($_SESSION['mn'][$id])){$aqb=$id; $qbd=$_SESSION['mnd'][$id];}
elseif($defo && !ses('qb'))list($qbd,$aqb)=arr(sql('id,name,hub','qdu','r','name="'.$defo.'"'),2);
if(isset($aqb)){$_SESSION['qb']=$aqb; $_SESSION['qbd']=$qbd;}
elseif($id!='=' && $id!='b' && $id!='c')$_GET['read']=$id?$id:get('id');
//elseif(!$defo)$_SESSION['qb']='public';
if(!ses('qbd') && ses('qb'))$_SESSION['qbd']=sql('id','qdu','v','name="'.$_SESSION['qb'].'"');}

function define_cats_rqt(){$ret=[];
if(rstr(3)){$r=$_SESSION['rqt'];
	if($r)foreach($r as $k=>$v)if($v[1] && $v[11])$ret[$v[1]]=radd($ret,$v[1]);} 
//elseif(rstr(123))$ret=sql('cat,id','qdc','kv',['qb'=>ses('qb')]);
else $ret=sql('distinct(frm)','qda','k','nod="'.ses('qb').'" and re>0 and substring(frm,1,1)!="_"');// and frm!="_system"
$_SESSION['line']=$ret;}

function prmb_defaults($cnfg){
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
if(!$pm[24])$pm[24]='http://philum.fr';//server
if(!$pm[25])$pm[25]='fr';//lang
return $pm;}

function define_config(){$qb=ses('qb');
$qbn=sql('mail,config,dscrp','qdu','a','name="'.$qb.'"');
$rst=msql::col('',$qb.'_rstr',0,1);
if(!$rst)$rst=msql::col('system','default_rstr',0,1);
$_SESSION['rstr']=arr($rst,140);
$_SESSION['prmb']=prmb_defaults($qbn['config']??'');
$qbin['adminmail']=$qbn['mail']??'';
$qbin['dscrp']=$qbn['dscrp']??'';
$_SESSION['qbin']=$qbin;
$_SESSION['modsnod']=$qb.'_mods_'.prmb(1);
if($_SESSION['prmb'][5])auto_design();
define_mods('');
$_SESSION['nms']=msql_read('lang','helps_nominations','',1);
if(rstr(112))$_SESSION['catpic']=msql::kv('',nod('pictocat'),'',1);
$_SESSION['art_options']=['related','folder','agenda','lang','template','authlevel','password','tracks','2cols','fav','like','poll','bckp','artstat','quote','lastup','plan','mood'];
$_SESSION['mobile']=mobile(); $_SESSION['switch']=''; $_SESSION['prma']=[];
$_SESSION['ip']=sesmk('hostname');}

function reset_mjx(){for($i=1;$i<12;$i++)$_SESSION['heremjx'.$i]='';}
function reset_ses(){reset_mjx(); $r=['dev','prog','tab','mem','plgs','digr','admb','icotag','pw','tmpu','jscode','recache','adminauthes','prog','msqmimes','negcss','temp','scanplug','mnbb','simplified','conn_edit','opts','lang','lng','flags','murl'];
$n=count($r); for($i=1;$i<$n;$i++)unset($_SESSION[$r[$i]]);}

#time_system
function time_system($cache){$prmb16=prmb(16); $gnbj=get('nbj'); $snbj=ses('nbj');
if($gnbj){$_SESSION['nbj']=$gnbj; $cache='ok';}
if((!$snbj or $cache=='ok') && !$gnbj){
	if(rstr(3) or $prmb16=='auto')$_SESSION['nbj']=dayslength($_SESSION['qb'],50);
	else{$_SESSION['dayb']=0; $_SESSION['nbj']='';}
	if(is_numeric($prmb16))$_SESSION['nbj']=$prmb16;}
if(!ses('daya') or date('d',$_SESSION['daya'])==date('d',$_SESSION['dayx']) or $cache=='ok')
	$_SESSION['daya']=$_SESSION['dayx'];
if($gtim=get('timetravel')){$_SESSION['daya']=dayref($gtim); $cache='ok';}
if($_SESSION['nbj'])$_SESSION['dayb']=calc_date($_SESSION['nbj']);
return $cache;}

function dayslength($qb,$limit){
$r=[1,7,10,90,365,720,1440,2920,5840,11680,23360,46720,93440];//16y,32,64,128y!
for($i=0;$i<9;$i++){$nbj=$r[$i];
	$nb=sql('count(id)','qda','v','nod="'.ses('qb').'" and day>"'.calc_date($nbj).'"');
	if($nb>$limit)$i=9;}
return $nbj;}

function seslng(){if(empty($_SESSION['lang'])){
	$hal=isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])?$_SERVER['HTTP_ACCEPT_LANGUAGE']:'';
	$lg=substr($hal,0,2); $syslg=$_SESSION['prmb'][25];
	if(!rstr(53))$lg='all'; elseif(!$lg)$lg=$syslg; $_SESSION['lang']=$lg;
	$_SESSION['lng']=$lg!='all'?$lg:$syslg;}//translations
return $_SESSION['lang'];}

#current
function deductions_from_read($read,$cache){$qda=$_SESSION['qda'];
if(!is_numeric($read) && $read){$read=id_of_urlsuj($read); if($read)$_GET['read']=$read;}
if(is_numeric($read)){$_SESSION['module']='';
	list($day,$frm,$raed,$img,$pb,$them,$lu,$re)=pecho_arts($read);
	if($pb!=$_SESSION['qb']){
		if(rstr(96))return $_GET['read']='';//prison
		if(rstr(105)){//interhub//define_qb();
			if(!isset($_SESSION['mn'][$pb])){$_SESSION['read']=''; $_SESSION['frm']='Home'; return;}
			if(!rstr(97)){reset_ses(); $_SESSION['qb']=$pb; $cache=$_GET['id']='ok';}}}
	if($raed){$_SESSION['frm']=$frm; $_SESSION['read']=$read; $_SESSION['raed']=$raed;
		//if($_SESSION['art_options'])art_opts($read);
		//$_SESSION['artags']=art_tags($read);//[$read]
		$_SESSION['mem'][$read]=1;}//radd(ses('mem'),$read)
	else{$_GET['read']=''; $_SESSION['artags']='';
		$_SESSION['read']=''; $_SESSION['raed']=''; $_SESSION['frm']='Home';}}
else{$_SESSION['read']=''; $_SESSION['raed']=''; 
	$_SESSION['frm']=$read&&isset($_SESSION['line'][$read])?$read:'Home';
	if($read)$_SESSION['opts'][$read]=''; $_SESSION['module']='';}
if($mod=get('module')){$_SESSION['module']=$mod; $_SESSION['frm']='Home';}
return $cache;}

function define_frm(){$d=protect_url(get('cat'),1); //$d=rawurldecode($d);
if($d)$_SESSION['frm']=$d;
elseif($cid=get('catid'))$_SESSION['frm']=$cid;}

function repair_mods($nod){
$r=msql::read_b('',$nod.'_sav');
if($r){$r=msql::copy('users',$nod.'_sav','users',$nod);
	if(auth(2))alert('backup mods restored');}
if(!$r){$r=msql::read_b('system','default_mods');
	if($r)$r=msql::copy('system','default_mods','users',$nod);
	if(auth(4))alert('using minimal config '.lkc('txtx','/admin/hubs&reinit==','reinit?'));} 
return $r;}

function define_mods($q='',$r=''){
$nod=($q?$q:ses('qb')).'_mods_'.prmb(1);
$r=$r?$r:msql_read('',$nod,'',1);
if(!$r)$r=repair_mods($nod); 
if($r)foreach($r as $k=>$v){if($v[0]=='system' && $v[2])$vrf[$v[1]]=$k;
	$key=array_shift($v); $ret[$key][$k]=$v;}
if(!$vrf['blocks']){//alert('block: using default');
	$ret['system'][]=['blocks','banner menu content footer'];}
if(!$vrf['design']){$ret['system'][]=['design','2'];}
if(!$vrf['content'])$ret['system'][]=['content',640];
if(!$vrf['content'])$ret['system'][]=['content',sesmk('pw','')];
$_SESSION['mods']=$ret;}

function define_modc(){//define_mods_cond
$r=$_SESSION['mods']; $cnd=$_SESSION['cond']; $ret=[];
if(is_array($r))foreach($r as $k=>$v)if(is_array($v))foreach($v as $ka=>$va)if(isset($va[7]) && $va[7]!=1){
if($va[3]==$cnd[0] or (isset($cnd[1]) && $va[3]==$cnd[1]) or !$va[3]){
if($va[0]=='LOAD' && isset($rb[$va[0]]))$ka=$rb[$va[0]];//substitute
$ret[$k][$ka]=$va; $rb[$va[0]]=$ka;}}
if($ret)ksort($ret); $_SESSION['modc']=$ret;}

#css
function define_clr(){
$r=msql_read('design',nod('clrset_'.$_SESSION['prmd']),'');
$_SESSION['clrs'][$_SESSION['prmd']]=$r;}

function auto_design(){$n=$_SESSION['prmd']; $phi=ses('philum'); $qb=ses('qb');
$d=msql::read_b('',$qb.'_autodesign',$phi,'',[$phi=>[1]]);
if(!$d){req('styl');// or get(id)
if($n<4)$r=msql_read('system','default_css_'.$n);
elseif(is_numeric($n))$r=msql_read('design','public_design_'.$n);
$f='css/'.$qb.'_auto.css';
build_css('css/'.$qb.'_auto.css',$r);
msql::modif('',$qb.'_autodesign',[1],'one','',$phi);
alert('css_auto re-generated');}}

function negcss($a=''){
if($n=$_SESSION['prmb'][5])$nod=ses('qb').'_auto';
else $nod=ses('qb').'_design_'.$_SESSION['prmd'];
$f='css/'.$nod.'_neg.css'; $tima=ftime('css/'.$nod.'.css','ymdhi'); $timb=ftime($f,'ymdhi');
if($tima>$timb){req('styl'); $clr=getclrs();
	foreach($clr as $k=>$v)if($v)$klr[$k]=invert_color($v,0);
	$_SESSION['clrs'][$_SESSION['prmd'].'_neg']=$klr;
	if($n){if($n<4)$r=msql_read('system','default_css_'.$n);
		elseif(is_numeric($n))$r=msql_read('design','public_design_'.$n);}
	else $r=msql_read('design',$nod);
	//foreach($r as $k=>$v)if($v[2]=='img')$r[$k][6]='filter:invert(100%);';
	build_css($f,$r,$klr);}}

function night(){$dy=date('m-d-H',ses('dayx'));
list($m,$d,$h)=explode('-',$dy); $d+=0; $m+=0; $dt=date('Hi',ses('dayx'));
$r=msql::row('','public_sunhour_1',$d,1); $h1=2000; $h2=700;
$morning=$r[$m.'a']; $h1=str_replace(':','',$morning);
$evening=$r[$m.'b']; $h2=str_replace(':','',$evening);
if($dt>$h2 or $dt<$h1)return [$morning,$evening];
else return false;}

function define_design(){
$qb=ses('qb'); if(!$qb)$qb='public'; $nod=$qb.'_design';
if(ses('desgn'))$nod.='_dev';
if(ses('switch'))$nod.='_'.$_SESSION['switch']; else $nod.='_'.$_SESSION['prmd'];
if($_SESSION['prmb'][5] && !isset($_SESSION['desgn']))$nod=$_SESSION['qb'].'_auto';
if(ses('tablet'))Head::add('csscode',plugin('tablet'));
if(ses('negcss')){$nod.='_neg'; negcss();}
if(rstr(122)){if(sesmk('night','')){$nod.='_neg'; negcss();}}
return $nod;}

function csslayer($n){if($n=='classic')return '_classic';
elseif(is_numeric($n))return 'public_design_'.$n;}

#config
function define_prma(){$r=sesr('modc','system'); $_SESSION['prma']=[];
if($r)foreach($r as $k=>$v){
if($v[0]=='design' && empty($_SESSION['desgn'])){$_SESSION['prmd']=$v[1];
	if($v[5])Head::add('jslink','/css/'.csslayer($v[5]).'.css');}
if($v[0]=='csscode' && $v[1])Head::add('csscode',$v[1]);
elseif($v[0]=='jscode' && $v[1])Head::add('jscode',$v[1]);
elseif($v[0]=='jslink' && $v[1])Head::add('jslink',$v[1]);
elseif($v[1])$_SESSION['prma'][$v[0]]=$v[1];}}

function define_condition(){
if($read=ses('read'))$cnd=['art',$read];
elseif($cnt=get('context'))$cnd=[$cnt,''];
elseif(ses('frm')=='Home')$cnd=['home',''];
elseif($frm=ses('frm'))$cnd=['cat',$frm]; else $cnd=['cat',''];
$_SESSION['cond']=$cnd; define_modc(); define_prma();}

function select_mods($d=''){
if($d){$_SESSION['prmb1']=prmb(1); $_SESSION['prmb'][1]=$d;}
elseif($_SESSION['prmb1'])$_SESSION['prmb'][1]=$_SESSION['prmb1'];
reset_mjx(); $_SESSION['modsnod']=$_SESSION['qb'].'_mods_'.prmb(1); 
define_mods(''); define_condition();}

#users
//log
function log_mods(){$use=ses('USE'); $log=get('log'); $ret='';
if($log)switch($log){
case('on'): $usr=post('user','login');
	$ret=login::call($usr,post('pass'),post('mail')); break;
case('in'): $ret=login::form('','',''); break;
case('out'): $_SESSION['USE']=''; $_SESSION['auth']=''; $dayz=$_SESSION['dayx']-86400;
	setcookie('use',$use,$dayz); $_COOKIE['use']=''; $_COOKIE['iq']='';
	setcookie('iq',$_SESSION['iq'],$dayz); $_SESSION['nuse']=1;  relod('/'); break;
case('reboot'): $r=['qd','qb','USE','iq','dev']; $ret=[];
	foreach($r as $v)$ret[$v]=ses($v); $_SESSION=$ret; relod('/'); break;
case('create_hub'): $_POST['create_hub']=ses('qb'); 
	$ret=login::call(ses('qb'),'pass',''); break;
case('off'): $qd=$_SESSION['qd']; $dev=$_SESSION['dev']; session_destroy();
	$_SESSION['qd']=$qd; $_SESSION['dev']=$dev; relod('/?qd='.$qd); break;
case('down'): session_destroy(); relod('/'); break;}
if($ret)alert($ret);
elseif(!$use && rstr(59) && !ses('nuse')){
	if($cuse=cookie('use')){$iq=login::verif_user($cuse,'');
		if(cookie('iq')==$iq && $iq){$_SESSION['USE']=$cuse; $_SESSION['iq']=$iq;}}}}

//auth
//0=no;1=read;2=tracks;3=propose;4=publish;5=edit;6=admin;7=host;
function ismbr($d){return sql('auth','qdb','v','hub="'.ses('qb').'" and name="'.$d.'"');}
function members(){return sql('name,auth','qdb','kv','hub="'.ses('qb').'"');}
function define_auth(){$use=ses('USE');
if(!ses('master'))$_SESSION['master']=sql('name','qdu','v','name="'.prms('default_hub').'"');
if($use){if($use==$_SESSION['master'])$auth=7;
	elseif($use==$_SESSION['qb'])$auth=6;
	elseif($ath=ismbr($use))$auth=$ath;
	else $auth=1;}
else $auth=0;
$_SESSION['auth']=$auth;}

//cookie
function cookie_accept(){
$ret=btn('txtred',nms(188)).' ';
$j='cook_call___ajxf_cookprefs';
$ret.=lj('',$j.'_1',picto('ok'));
$ret.=lj('',$j.'_-1',picto('no'));
$ret.=hlpbt('cookie');
return btd('cook',$ret);}

//stats
function eye_iq(){$ip=ses('ip'); $iq=ses('iq');
if(!$iq)$iq=sql('id','qdp','v','ip="'.$ip.'" limit 1');
$_SESSION['iqa']=sql('ok','qdk','v',['iq'=>$iq]);
if(!$iq){$iq=cookie('iq'); if($iq)update('qdp','ip',$ip,'id',$iq);}
if(!$iq){$nav=addslashes($_SERVER['HTTP_USER_AGENT']);
	$ref=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
	$iq=insert('qdp','(NULL,"'.$ip.'","'.$nav.'","'.$ref.'","1",NOW())');
	if($_SESSION['iqa']==1)cookie('iq',$iq);}
$_SESSION['iq']=$iq;}

#update
function verif_update(){
if($_SESSION['auth']>5 && !prms('aupdate')){
	$localver=checkversion(2); $distver=sesmk('checkupdate',2,1);//ses('philum')
	if($distver>$localver)Head::add('jscode',sj('popup_software,call___1'));
	if(!isset($_SESSION['verifs'])){
	if(prms('srvmirror'))Head::add('jscode',sj('popup_plug__3_transport_transport*batch'));}
$_SESSION['verifs']=1;}}

#blocks
function build_content(){
$gmd=get('module'); $api=get('api'); $ra=api::load_rq();
//if($p=$_GET['plug'])$ret=plugin($p,get('p'),get('o')); else
if($ra)$ret=api::load($ra);
elseif($gmd && $gmd!='Home')$ret=build_mod_r($gmd);
elseif($api)$ret=api::call($api);
else $ret=build_modules('content','');
return $ret;}

function build_blocks(){
$r=explode(' ',$_SESSION['prma']['blocks']);
foreach($r as $k=>$v){
	if($v=='content')$ret[$v]=divd($v,build_content())."\n";
	else $ret[$v]=divd($v,build_modules($v,''))."\n";}
//$ret=str_replace('</p>',"</p>\n",$ret);
return $ret;}

function build_deskpage($read){$gmd=get('module');
Head::add('jscode',desktop_js('boot')); $ret='';
if($read)$ret='popup_ajxlnk2___'.$read;//'popup_popart___'.$read.'_3'
elseif($cat=get('cat'))$ret='popup_ajxlnk2___cat_'.ajx($cat);//'popup_modpop___:LOAD'
elseif($gmd && $gmd!='Home')$ret='popup_modpop__3_'.get('p').':'.$gmd;
elseif($plg=get('plug'))$ret='popup_plupin___'.$plg.'_'.get('p');
elseif($ra=api::load_rq())$ret='popup_apij___'.implode_k($ra,',',':');
elseif($cnt=get('context'))$ret='popup_ajxlnk2__3_context_'.$cnt;
if($ret)Head::add('jscode',sj($ret));}//js_code(sj($ret));

#cache
function cache_arts($x=''){$lastart=''; $rtb=[]; $ret=[]; $main=[]; $nod=ses('qb').'_cache';
if($x)msql::del('',$nod); else $main=msql::read_b('',$nod,'',1); //$_SESSION['rqt']=[];
if($main){$last=current($main); $lastart=last_art($last[0]);}
if(($lastart && !isset($main[$lastart])) or $x){
	$rh=['_menus_'=>['date','cat','title','img','hub','url','lu','author','length','src','ib','re','lg']];
	$slct='id,day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re,lg';
	if(ses('dayb'))$wh=' and day>"'.ses('dayb').'"'; else $wh=' and day>"'.calctime(360).'"';
	$r=sqr($slct,'qda','where nod="'.ses('qb').'"'.$wh.' and substring(frm,1,1)!="_" and re>"0" order by '.prmb(9));
	if($r)while($rb=qrw($r)){$k=array_shift($rb); $rb[3]=art_img($rb[3]); $ret[$k]=$rb;}
	$ok='cache reloaded'; msql::save('',$nod,$rh+$ret); $_SESSION['rqt']=$ret;}
elseif($main)$_SESSION['rqt']=$main;
return lk('/reload/'.ses('qb'),'reload');}

#reboot
function reboot(){require('params/_connectx.php'); req('art,spe,pop'); reset_ses();
master_params('params/_'.$db,'','',''); $_SESSION['dayx']=time(); setprog();
define_hubs(); define_qb(); define_config(); eye_iq(); log_mods(); define_auth(); seslng();
time_system('ok'); cache_arts(); define_cats_rqt(); define_condition(); define_clr();}

#utils
function block_crawls(){$ip=ses('ip');//hostname()//proxad
$r=['msnbot','googlebot','spider','wowrack','netestate','tralex','ipvnow','semrush','webnx','static','crawl'];
$n=count($r); for($i=0;$i<$n;$i++)if(strpos($ip,$r[$i])!==false)exit;}

function tests(){//chrono('test');
p(get_defined_functions());}

?>