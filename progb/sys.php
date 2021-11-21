<?php
//philum_system
//income:$g;$aqb;$db
#Boot
$cache='';
secure_inputs();
//echo $_SERVER['REQUEST_TIME_FLOAT'];
//$_SESSION=[];
$_SESSION['stime']=$stime; $_SESSION['dayx']=substr($stime,0,10); $_SESSION['nl']='';
if(!isset($_SESSION['qb']) or isset($_GET['qd']) or (isset($_GET['id']) && $_GET['id']!='imgc/') or isset($_GET['nbj']) or isset($_GET['hub']) or isset($_GET['refresh'])){$cache='ok'; reset_ses(); setprog();}//or !isset($_SESSION['qd']) or !isset($_SESSION['qda']) or !isset($_SESSION['mods']) or 
if(isset($_GET['dev'])){$_SESSION['dev']='b'; setprog(); relod('/reload');}
//master_params
if(!isset($_SESSION['qd']) or $cache)master_params('params/_'.$db);
if(!isset($_SESSION['philum']))$_SESSION['philum']=checkversion();
date_default_timezone_set(prms('timez'));
if(isset($_SESSION['dev']))error_report();
if(!isset($_SESSION['mn']) or $cache)define_hubs();
if($cache)define_qb();//qb::need $mn
if($bim=get('rebuild_img'))ses('rebuild_img',$bim);
$cache=deductions_from_read(getb('read'),$cache);//art
$read=get('read');
if(!ses('qbin') or $cache)define_config();//qb_in
if(!rstr(22))block_crawls();//crawl
//if(isset($_GET['switch_design']))$_SESSION['switch']=$_GET['switch_design'];
if(!ses('iq'))eye_iq();//eye
log_mods(); define_auth();//login
#environment
$cache=time_system($cache);//time_system
seslng();//lang
#rqt
if(!isset($_SESSION['rqt']) or $cache)cache_arts($cache);
if(!isset($_SESSION['line']) or $cache)define_cats_rqt();
define_frm();//frm
#page
$_SESSION['page']=get('page',1);//page
if(get('plug'))$_SESSION['frm']='';//reset_frm
//Home
if(!$_SESSION['frm'] && !$_GET)$_GET['module']='Home';
//condition
$adm=get('admin'); $msq=get('msql');
//if(!$adm)
define_condition();
m_system();//admin
#Design
if(!getclrs() or $cache)define_clr();
if(ses('desgn')){$wth=!$adm?' watch:'.$_SESSION['prmd']:'';
	$_POST['popadm']['design']=btn('txtyl','design:'.ses('desgn').$wth).' ';}
#back_in_time
if(abs(ses('dayx')-ses('daya'))>86400){setpost('popadm',[]);
	$_POST['popadm']['timetravel']=lkc('txtyl','/reload',nms(82).' '.date('Y',ses('daya')));}
#Eye
if(!ses('stsys'))eye();
#structure
$out=[];
if($adm){req('admin'); $out['content']=admin();}
elseif($msq){req('msql'); $out['content']=msql_adm();}
elseif(rstr(85))$out['content']=build_deskpage($read);
elseif($p=get('plug'))$out['content']=plugin($p,get('p'),get('o'));
//elseif($read && rstr(72))$rout=cache_html($read);
else $out=build_blocks();
//admin
if(ses('dev'))$_POST['popadm']['chrono']=btn('small',round(microtime(1)-$stime,3));
if(!rstr(98) or auth(4))$madmin=popadmin();
//meta
$host=host();
$meta['favicon']='favicon.ico';
if($adm){$meta['title']=$adm;}
	//$meta['favicon']=uicon('screen_4to3_16','picol/16');
elseif($msq){$meta['title']=$msq;}
	//$meta['favicon']=uicon('database_16','picol/16');
elseif($_SESSION['read']){$meta['title']=$_SESSION['raed'];
	$meta['descript']=post('descript');
	if($_SESSION['imgrel'])$meta['img']=$host.'/img/'.$_SESSION['imgrel'];}
else{$mn=ses('mn'); $meta['title']=$mn?val($mn,ses('qb')):'';
	$meta['descript']=$_SESSION['qbin']['dscrp'];}
	//$meta['img']=host().'/imgb/ban_'.$_SESSION['qb'].'.jpg';
$cst='?'.randid();//ses('desgn')?'?'.randid():'';//
if(rstr(63))$_SESSION['negcss']=1;
$meta['css']=define_design();
verif_update();
if(post('flow') or rstr(39))$flow=1; else $flow=0;
?>