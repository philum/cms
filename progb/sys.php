<?php //system
$cache='';
gets();
$_SESSION['stime']=$stime; $_SESSION['dayx']=substr($stime,0,10); $_SESSION['nl']='';
if(!isset($_SESSION['qb']) or isset($_GET['hub']) or isset($_GET['refresh'])){
	$cache='ok'; boot::reset_ses();}
if(isset($_GET['dev'])){$_SESSION['dev']='b'; relod('/reload');}
if(!isset($_SESSION['qd']) or $cache)boot::master_params('params/_'.$db);
if(!isset($_SESSION['philum']))$_SESSION['philum']=checkversion();
date_default_timezone_set(prms('timez'));
if(isset($_SESSION['dev']))error_report();
if(!isset($_SESSION['mn']) or $cache)boot::define_hubs();
if($cache)boot::define_qb();
if(!ses('qbin') or $cache)boot::define_config();
if($log=get('log'))boot::log_mods($log);
if(!isset($_SESSION['USE']))boot::define_use();
$cache=boot::deductions(get('read'),$cache);
if($bim=get('rebuild_img'))ses('rebuild_img',$bim);
$read=get('read');
if(!isset($_SESSION['iqa']))boot::define_iq();
if(!rstr(22))boot::block_crawls();
#env
boot::define_auth();
$cache=boot::time_system($cache);
boot::seslng();
#rqt
if(!isset($_SESSION['rqt']) or $cache)boot::cache_arts($cache);
if(!isset($_SESSION['line']) or $cache)boot::define_cats_rqt();
boot::define_frm();//frm
#page
get('page',1);//page
if($plg=get('plug'))sesz('frm');//reset_frm
//Home
if(!ses('frm') && !$_GET)geta('module','Home');
//condition
$adm=get('admin'); $msq=get('msql');
boot::define_condition();
pop::m_system();//!!!!
#Design
if(!getclrs() or $cache)boot::define_clr();
if(ses('desgn')){$wth=!$adm?' watch:'.$_SESSION['prmd']:'';
	ses::$popadm['design']=btn('txtyl','design:'.ses('desgn').$wth).' ';}
#back_in_time
if(abs(ses('dayx')-ses('daya'))>86400){ses::$popadm=[];
	ses::$popadm['timetravel']=lkc('popdel','/reload',nms(82).' '.date('Y',ses('daya')));}
#Eye
if(!ses('stsys'))eye();
#structure
$out=[];
if($adm){$out['content']=adm::home();}
elseif($msq){$out['content']=msqa::home();}
elseif(rstr(85))$out['content']=boot::build_deskpage($read);
elseif($plg)$out['content']=plugin($plg,get('p'),get('o'));
//elseif($read && rstr(72))$rout=cache_html($read);
else $out=boot::build_blocks();
//admin
if(ses('dev'))ses::$popadm['chrono']=btn('small',round(microtime(1)-$stime,3));
//if(ses::r('tst'))ses::$popadm['chrono'].=divb(play_r(ses::r['tst']),'small');
		//if(auth(6))echo 'padm:'.ses('iqa').'-'.ses('iq').'-'.ses('ip');
if(!rstr(98) or auth(4))$madmin=pop::popadmin();
//meta
$host=host();
$meta['favicon']='favicon.ico';
if($adm)$meta['title']=$adm;
elseif($msq)$meta['title']=$msq;
elseif(ses::$r['raed']??''){$meta['title']=ses::$r['raed']; $meta['descript']=ses::$r['title']??'';
	$meta['img']=$host.'/img/'.ses::r('imgrel');}
else{$mn=ses('mn'); $meta['title']=$mn[ses('qb')]??'';
	$meta['descript']=$_SESSION['qbin']['dscrp'];}
$cst=ses('dev')?'?'.randid():'';
$meta['css']=boot::define_design();
boot::verif_update();
if(get('flow') or rstr(39))$flow=1; else $flow=0;
//alert(play_r(ses::r('spl')));
?>