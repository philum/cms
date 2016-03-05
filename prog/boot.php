<?php
//philum_boot 

#master_params//qd
function master_params($fb,$qd,$aqb,$subd){$filname=$fb.'_config.txt';
if(is_file($filname))$prms=explode('#',read_file($filname));
//else restore_mprm($filname);
if(!$qd){if(!$prms[0])$qd='pub'; else $qd=$prms[0];}//master_of_puppets
if($_GET['qd']){$qdb=$_GET['qd']; $bqd=rse('id',$qdb.'_user',' LIMIT 1');//master_node
	if(!$bqd && !$_POST['create_hub'] && !$_POST['create_node'])
	$qd=$prms[0]; else $qd=$qdb;}
$_SESSION['qd']=$qd; $_SESSION['qds']='_sys'; 
$r=array('qda'=>'art','qdm'=>'txt','qdd'=>'data','qdu'=>'user','qdi'=>'idy','qdp'=>'ips','qdv'=>'live','qdv2'=>'live2','qds'=>'stat','qdt'=>'meta','qdta'=>'meta_art','qdpl'=>'poll');
foreach($r as $k=>$v)$_SESSION[$k]=$qd.'_'.$v;
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
sesr('prms','uplimit',$prms[12]?$prms[12]:'250');
sesr('prms','aupdate',$prms[13]);}

function restore_mprm($f){
$d=sql('struct','qdu','v','id="'.ses('USE').'"');
write_file($f,$d);}

function define_hubs(){
$_SESSION['mn']=''; $USE=$_SESSION['USE'];
$exists=sql('id','qdu','v','id=1');
if(!$exists){$_SESSION['stsys']='no'; $_SESSION['first']=1; alert(loged('','','superadmin'));}
$req=sq('name,hub,id,active','qdu','where active="1" order by nbarts DESC');
if($req)while($r=mysql_fetch_row($req)){// && ($r[3] or auth(6))
	$hub=$r[1]?$r[1]:$r[0]; $ret[$r[0]]=$hub; $rtb[$r[0]]=$r[2];}
$_SESSION['mn']=$ret; $_SESSION['mnd']=$rtb;
if(!$_SESSION['mn'][$USE] && $USE)define_closed_hub($USE);}

function define_closed_hub($hub){
$v=sql('hub','qdu','v','name="'.$hub.'"');
if($v)$_SESSION['mn'][$hub]=$v;}

function define_subdomain(){
$r=explode('.',$_SERVER['HTTP_HOST']);
if($r[2]){$aqb=$r[0]!='www'?$r[0]:$r[1]; 
if($aqb!=$_SESSION['qb'])$_GET['id']=$aqb;}}

function define_qb(){
if($_SESSION['sbdm'])define_subdomain($cache); $id=$_GET['id'];
$r=$_SESSION['mn']; $defo=prms('default_hub'); //if(!$id)$id=$defo;
if($id && $id!='=' && $_SESSION['mn'][$id]){$aqb=$id; $qbd=$_SESSION['mnd'][$id];}
elseif($defo && !$_SESSION['qb'])
	list($qbd,$aqb)=sql('id,name,hub','qdu','r','name="'.$defo.'"');
if(isset($aqb)){$_SESSION['qb']=$aqb; $_SESSION['qbd']=$qbd;}
elseif($id!='=' && $id!='dev' && $id!='lab')$_GET['read']=$id;
if(!$_SESSION['qbd'])$_SESSION['qbd']=sql('id','qdu','v','name="'.ses('qb').'"');}

function define_cats_rqt(){$r=$_SESSION['rqt'];
if($r)foreach($r as $k=>$v)if($v[1] && substr($v[1],0,1)!='_')@$ret[$v[1]]+=1;
$_SESSION['line']=$ret;}

function prmb_defaults($pm){
//if(!$pm[0])$pm[0]=$_SESSION['qb'];//hub
if(!$pm[1] or !is_numeric($pm[1]))$pm[1]='1';//mods
if($pm[2])if(auth_ip())$pm[1]=$pm[2];//devmods
if(!$pm[3])$pm[3]=400;//kmax
if(!$pm[6])$pm[6]=20;//nb_arts_by_page
if(!$pm[9])$pm[9]='id DESC';//order 
if(!$pm[17])$pm[17]='ymd.Hi';//date 
if(!$pm[24])$pm[24]='http://philum.net';//server 
if(!$pm[25])$pm[25]='fr';//lang 
return $pm;}

function define_config(){
$qbn=sql('mail,rstr,mbrs,config,dscrp','qdu','a','name="'.$_SESSION['qb'].'"');
$_SESSION['rstr']=strsplit($qbn['rstr']); unset($_SESSION['rstr'][0]);
//$_SESSION['rstr']=msql_read('',$_SESSION['qb'].'_rstr','',1);
$prmb=explode('#',$qbn['config']); $_SESSION['prmb']=prmb_defaults($prmb);//config
$qbin['adminmail']=$qbn['mail']; //$qbin['struct']=$qbn['struct'];
$qbin['membrs']=tab_members($qbn['mbrs']);
$qbin['dscrp']=$qbn['dscrp'];
$_SESSION['qbin']=$qbin;
$_SESSION['modsnod']=$_SESSION['qb'].'_mods_'.prmb(1);
if($_SESSION['prmb'][5])auto_design();
define_mods('');
$_SESSION['nms']=msql_read('lang','helps_nominations','',1);
$_SESSION['picto']=msql_read('system','edition_pictos','',1);
$_SESSION['icons']=msql_read('system','program_pictos','',1);
$_SESSION['art_options']=array('related','folder','lang','template','authlevel','tracks','2cols','fav','like','poll');
$_SESSION['node_clr']=$_SESSION['qb'];
$_SESSION['mobile']=mobile();
$_SESSION['switch']=''; $_SESSION['prma']='';
$_SESSION['ip']=sesmk('hostname');}

function alternate_design($node_clr){$_SESSION['switch']=1; 
$_SESSION['tab']=''; define_mods($node_clr);
$qbinb=sql('rstr,config','qdu','r','name="'.$node_clr.'"');
$prmb=explode('#',$qbinb['config']); $_SESSION['prmb']=prmb_defaults($prmb); 
$_SESSION['node_clr']=$node_clr;
$_SESSION['rstr']=strsplit($qbinb['rstr']);}

function reset_mjx(){for($i=1;$i<12;$i++)$_SESSION['heremjx'.$i]='';}
function reset_ses(){reset_mjx(); $r=array('tab','mem','plgs','digr','admb','icotag','pagewidth','jscode','recache','adminauthes','csslayer','prog','msqmimes','negcss','temp','scanplug');
$n=count($r); for($i=1;$i<$n;$i++)$_SESSION[$r[$i]]='';}
//notempty
/*function setget(){
$r=array('module','log','nbj','timetravel','read','dev','continue'); $n=count($r);
for($i=1;$i<$n;$i++)if(!isset($_GET[$r[$i]]))$_GET[$r[$i]]=NULL;}*/

#time_system
function time_system($cache){$prmb16=$_SESSION['prmb'][16];
if(isset($_GET['nbj'])){$_SESSION['nbj']=$_GET['nbj']; $cache='ok';}
if((!$_SESSION['nbj'] or $cache=='ok') && !$_GET['nbj'] && !$_GET['continue']){
	if($_SESSION['rstr'][3]=='0' or $prmb16=='auto')
		$_SESSION['nbj']=dayslength($_SESSION['qb'],50);
	else $_SESSION['dayb']=$_SESSION['nbj']=0;
	if(is_numeric($prmb16))$_SESSION['nbj']=$prmb16;}
if(!$_SESSION['daya'] or date('dmy',$_SESSION['daya'])==date('dmy',$_SESSION['dayx']) or $cache=='ok')$_SESSION['daya']=$_SESSION['dayx'];
if(isset($_GET['timetravel'])){$_SESSION['daya']=dayref($_GET['timetravel']); $cache='ok';}
if($_SESSION['nbj'])$_SESSION['dayb']=calc_date($_SESSION['nbj']);
$_SESSION['sqlimit']='AND day < '.$_SESSION['daya'];
if($_SESSION['dayb'])$_SESSION['sqlimit'].=' AND day > '.$_SESSION['dayb'];
return $cache;}

function dayslength($qb,$limit){
$r=array(1,7,10,90,365,720,1440,2920,5840,11680);//16y,32,64//,23360,46720
for($i=0;$i<9;$i++){$nbj=$r[$i];
	$nb=sql('count(id)','qda','v','nod="'.ses('qb').'" and day>"'.calc_date($nbj).'"');
	if($nb>$limit)$i=9;}
return $nbj;}

#current
function deductions_from_read($read,$cache){$qda=$_SESSION['qda'];
if(!is_numeric($read) && $read){$read=$_GET['read']=id_of_urlsuj($read);}
if(is_numeric($read)){$_SESSION['module']='';
	list($day,$frm,$raed,$img,$pb,$them,$lu,$re)=pecho_arts($read);
	if($pb!=$_SESSION['qb'] && $_SESSION['mn'][$pb]){reset_ses();
		$cache=$_GET['id']='ok'; $_SESSION['qb']=$pb; $_SESSION['author']=$author;}
	if($raed){$_SESSION['frm']=$frm; $_SESSION['read']=$read; $_SESSION['raed']=$raed;
	if($_SESSION['art_options'])$_SESSION['opts']=art_opts($read);
	$_SESSION['artags']=art_tags($id);
	$_SESSION['mem'][$read]+=1;}
	else{$_GET['read']=''; $_GET['continue']=''; $_SESSION['artags']='';
		$_SESSION['read']=''; $_SESSION['raed']=''; $_SESSION['frm']='Home';}}
else{$_SESSION['read']=''; $_SESSION['raed']=''; $_SESSION['frm']='Home';
	$_SESSION['opts']=''; $_SESSION['module']='';}
if(isset($_GET['module'])){$_SESSION['module']=$_GET['module']; $_SESSION['frm']='Home';}
return $cache;}

function define_frm(){$ret=$_SESSION['frm'];
$m=stripslashes(urldecode($_GET['cat']));
if(!$m)$m=stripslashes(urldecode($_GET['section']));
if($m)$ret=$m; return $ret;}

function repair_mods($nod){
$r=read_vars('msql/users/',$nod.'_sav','');
if($r){$r=msq_copy('users',$nod.'_sav','users',$nod);
	if(auth(2))alert('backup mods restored');}
if(!$r){$r=read_vars('msql/system/','default_mods','');
	if($r)$r=msq_copy('system','default_mods','users',$nod);
	if(auth(4))alert('using minimal config '.lkc('txtx','/admin/hubs&reinit==','reinit?'));} 
return $r;}

function define_mods($q='',$r=''){
$nod=($q?$q:$_SESSION['qb']).'_mods_'.prmb(1);
$r=$r?$r:msql_read('',$nod,'',1);
if(!$r)$r=repair_mods($nod); 
if($r)foreach($r as $k=>$v){if($v[0]=='system' && $v[2])$vrf[$v[1]]=$k;
	$key=array_shift($v); $ret[$key][$k]=$v;}
if(!$vrf['blocks']){//alert('block: using default');
	$ret['system'][]=array('blocks','banner menu content footer');}
if(!$vrf['design']){$ret['system'][]=array('design','2');}
if(!$vrf['content'])$ret['system'][]=array('content',640);
if(!$vrf['content'])$ret['system'][]=array('content',sesmk('pagewidth',''));
$_SESSION['mods']=$ret;}

function define_modc(){//define_mods_cond
$r=$_SESSION['mods']; $cnd=$_SESSION['cond']; //p($cnd);
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)if($va[7]!=1){
if($va[3]==$cnd[0] or $va[3]==$cnd[1] or !$va[3]){
if($va[0]=='LOAD' && $rb[$va[0]])$ka=$rb[$va[0]];//substitute
$ret[$k][$ka]=$va; $rb[$va[0]]=$ka;}} //p($ret);
if($ret)ksort($ret); $_SESSION['modc']=$ret;}

#css
function define_clr(){
$r=msql_read('design',$_SESSION['qb'].'_clrset_'.$_SESSION['prmd'],'');
$_SESSION['clrs'][$_SESSION['prmd']]=$r;}

function csslayer($n){if($n=='classic')return '_classic';
elseif(is_numeric($n))return 'public_design_'.$n; elseif(is_numeric($n))return '_'.$n;}

function auto_design(){$n=$_SESSION['prmb'][5]; $phi=ses('philum');
$d=msql_read_b('',ses('qb').'_autodesign',$phi,'',array($phi=>array(1)));
if(!$d){req('styl');// or get(id)
if($n<4)$r=msql_read('system','default_css_'.$n);
elseif(is_numeric($n))$r=msql_read('design','public_design_'.$n);
$f='css/'.ses('qb').'_auto.css';
build_css('css/'.ses('qb').'_auto.css',$r);
msql_modif('users',ses('qb').'_autodesign',array(1),'','one',$phi);
alert('css_auto re-generated');}}

function negcss(){
if($n=$_SESSION['prmb'][5])$nod=ses('qb').'_auto';
else $nod=ses('qb').'_design_'.$_SESSION['prmd'];
$clr=$_SESSION['clrs'][$_SESSION['prmd']];
foreach($clr as $k=>$v)if($v)$klr[$k]=invert_color($v,0);
$_SESSION['clrs'][$_SESSION['prmd'].'_neg']=$klr;
$f='css/'.$nod.'_neg.css'; $tima=ftime('css/'.$nod.'.css','ymdhi'); $timb=ftime($f,'ymdhi');
if($tima>$timb){req('styl');
if($n){if($n<4)$r=msql_read('system','default_css_'.$n);
	elseif(is_numeric($n))$r=msql_read('design','public_design_'.$n);}
else $r=msql_read('design',$nod);
build_css($f,$r,$klr);}}

function define_design(){$nod=$_SESSION['node_clr'].'_design';
if($_SESSION['desgn'])$nod.='_dev';
if($_SESSION['switch'])$nod.='_'.$_SESSION['switch']; else $nod.='_'.$_SESSION['prmd'];
if($_SESSION['prmb'][5] && !$_SESSION['desgn'])$nod=$_SESSION['qb'].'_auto';
if($_SESSION['tablet'])Head::add('csscode',plugin('tablet'));
if(!$_SESSION['node_clr'])$nod='_classic'; 
if($_SESSION['negcss']){$nod.='_neg'; negcss();}
return $nod;}

#config
function define_prma(){$r=$_SESSION['modc']['system'];
if($r)foreach($r as $k=>$v){$_SESSION['prma'][$v[0]]=$v[1]; 
if($v[0]=='design'){$_SESSION['prmd']=$v[1]; sesf('csslayer',$v[5],1);}}}

function define_condition(){
if($_SESSION['read'])$cnd=array('art',$_SESSION['read']);
elseif($_GET['context'])$cnd=array($_GET['context']);
elseif($_SESSION['frm']=='Home')$cnd=array('home');
elseif($_SESSION['frm'])$cnd=array('cat',$_SESSION['frm']); else $cnd=array('cat','');
$_SESSION['cond']=$cnd; define_modc(); define_prma();}

function select_mods($d=''){
if($d){$_SESSION['prmb1']=prmb(1); $_SESSION['prmb'][1]=$d;}
elseif($_SESSION['prmb1'])$_SESSION['prmb'][1]=$_SESSION['prmb1'];
reset_mjx(); $_SESSION['modsnod']=$_SESSION['qb'].'_mods_'.prmb(1); 
define_mods(''); define_condition();}

#users
//log
function log_mods(){$use=ses('USE');
if(!isset($_GET['log']))return;
switch($_GET['log']){
case('on'): $usr=$_POST['user']?$_POST['user']:'login';
	$ret=login($usr,$_POST['pass'],$_POST['mail']); break;
case('in'): $ret=loged('','',''); break;
case('out'): $_SESSION['USE']=''; $_SESSION['auth']=''; $dayz=$_SESSION['dayx']-86400;
	setcookie('use',$use,$dayz); $_COOKIE['use']=''; $_COOKIE['iq']='';
	setcookie('iq',$_SESSION['iq'],$dayz); $_SESSION['nuse']=1; break;
case('reboot'): reboot(); relod('/'); break;
case('create_hub'): $_POST['create_hub']=ses('qb'); 
	$ret=login(ses('qb'),'pass',''); break;
case('off'): $qd=$_SESSION['qd']; $dev=$_SESSION['dev']; session_destroy();
	$_SESSION['qd']=$qd; $_SESSION['dev']=$dev; relod('/?qd='.$qd); break;
case('down'): session_destroy(); relod('/'); break;}
if($ret)alert($ret);
elseif(!$use && rstr(59) && !$_SESSION['nuse']){
	if($_COOKIE['use']){$iq=verif_user($_COOKIE['use'],'');
		if($_COOKIE['iq']==$iq && $iq){$_SESSION['USE']=$_COOKIE['use'];
			$_SESSION['iq']=$_COOKIE['iq'];}}}}

//auth
//0=no;1=read;2=tracks;3=propose;4=publish;5=edit;6=admin;7=host;
function tab_members($d){$r=explode(',',$d);
foreach($r as $k=>$v){list($ath,$muser)=explode('::',$v); if($muser)$ret[$muser]=$ath;}
return $ret;}

function define_auth(){
$USE=$_SESSION['USE'];
$mmbr=$_SESSION['qbin']['membrs'];
if($USE){if($USE==$_SESSION['master'])$auth=7;
	elseif(is_numeric($mmbr[$USE]))$auth=$mmbr[$USE];
	elseif($USE==$_SESSION['qb'])$auth=6;
	else $auth=1;}
else $auth=0;
return $auth;}

//stats
function eye_iq(){$ip=ses('ip');
$iq=sql('id','qdp','v','ip="'.$ip.'" LIMIT 1');
if(!$iq){$iq=$_COOKIE['iq']; if($iq)update('qdp','ip',$ip,'id',$iq);}
if(!$iq){$nav=addslashes($_SERVER['HTTP_USER_AGENT']); $ref=$_SERVER['HTTP_REFERER'];
$iq=insert('qdp','("","'.$ip.'","'.$nav.'","'.$ref.'","1",NOW())');
setcookie('iq',$iq,$_SESSION['dayx']+(86400*30));}
return $iq;}

#update
function verif_update(){
if($_SESSION['auth']>5 && !$_SESSION['dlnb'] && !prms('aupdate')){
	$maj=sesmk('checkupdate','');
	if($maj>ses('philum')){$_GET['update']='program';
		require_once('plug/distribution.php');}}}

function define_fonts($t){//echo prma('csscode');
$r=explode(' ',prma('cssfonts')); $n=count($r); //$srvr=prms('upservr');
for($i=0;$i<$n;$i++){switch($r[$i]){
case('fontphilum'): $ret.="@font-face {font-family: 'philum';
src: url('/fonts/philum.eot?iefix') format('eot'), url('/fonts/philum.woff?".$t."') format('woff'), url('/fonts/philum.svg#philum') format('svg'), url('/fonts/philum.ttf') format('truetype');}\n"; break;
case('fontmicrosys'): $ret.="@font-face {font-family: 'microsys';
src: url('/fonts/microsys4.eot?iefix') format('eot'), url('/fonts/microsys4.woff?".$t."') format('woff'), url('/fonts/microsys4.svg#microsys4') format('svg'), url('/fonts/microsys4.ttf') format('truetype');}\n"; break;
case('desktop_img'): $ret.=''; break;}}
if($ret)return css_code($ret);}

#blocks
function build_content(){$p=$_GET['plug']; $gmd=$_GET['module']; $ra=api_load_rq();
	if($p)$content=plugin($p,get('p'),get('o'));
	elseif($ra)$content=api_load($ra);
	elseif($gmd && $gmd!='Home')$content=build_mod_r($gmd);
	else $content=build_modules('content','');
return $content;}

function build_blocks(){
$r=explode(' ',$_SESSION['prma']['blocks']);
foreach($r as $k=>$v){
	if($v=='content')$ret[$v]=divd($v,build_content())."\n";
	else $ret[$v]=divd($v,build_modules($v,$cache))."\n";}
$ret=str_replace('</p>',"</p>\n",$ret);
return $ret;}

#cache
function cache_arts(){
$nod=$_SESSION['qb'].'_cache'; $main=msql_read_b('',$nod,'',1);
	if($main)$last=current($main); $lastart=last_art($last[0]);
if((!is_array($main[$lastart]) && $lastart) or get('refresh')){
	$ret['_menus_']=array('date','cat','title','img','hub','tag','lu','author','length','url','ib','re');
	//if(!ses('dayb'))ses('dayb',calc_date(ses('nbj')));
	$slct='id,day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re';
	$r=sq($slct,'qda','where nod="'.ses('qb').'" and day>"'.ses('dayb').'" order by '.prmb(9));
	if($r)while($rb=mysql_fetch_row($r)){$k=array_shift($rb); $rb[3]=first_img($rb[3]);
	$rtb[$k]=$rb; if($rtb)$ret+=$rtb;}
	$ok='cache reloaded'; msql_save('',$nod,$ret); $_SESSION['rqt']=$rtb;}
else $_SESSION['rqt']=$main;
return lka('/reload/'.ses('qb'),'reload');}

#utils
function block_crawls(){$ip=ses('ip');//proxad
$r=array('msnbot','googlebot','spider','wowrack','netestate','tralex'); $n=count($r);
for($i=0;$i<$n;$i++)if(strpos($ip,$r[$i]!==false))exit;}

function auth_ip(){$ip=ses('ip');//proxad
$r=msql_read('',ses('qb').'_authip','',1); $r[]='85-170-69-142';
if($r)foreach($r as $k=>$v)if(strpos($ip,$v)!==false)$ok=1;
if(!$ok)return true;}

function dev2prod(){$r=explore('progb','files',1); 
$old='_old/'.date('ymd').'/'; mkdir_r($old);
$olb='_old/'.date('ym').'/'; mkdir_r($olb);
foreach($r as $k=>$v){if($v!='_trash.php'){
	$fa='progb/'.$v; $da=filemtime($fa); $sa=filesize($fa);
	$fb='prog/'.$v; $db=filemtime($fb); $sb=filesize($fb);
	if(date('d')=='01')copy($fb,$olb.$v);
	if($sa!=$sb or $da>$db){copy($fb,$old.$v); copy($fa,$fb); $ret.=strdeb($v,'.').' ';}}}
return $ret;}

function tests(){//chrono('test');
p(get_defined_functions());}

?>