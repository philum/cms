<?php 
gets(); $cache=''; //pr($_GET);
$_SESSION['stime']=$stime; $_SESSION['dayx']=substr($stime,0,10); geta('nl',0);
if(!ses('qb') or get('hub') or get('refresh') or get('log')){$cache='ok'; boot::reset_ses();}
if(get('dev')){$_SESSION['dev']='b'; relod('/reload');}
if(get('module')=='Home')geta('module','');//old htaccess
if($cache)boot::init();
if(ses('dev'))error_report();
if($log=get('log'))boot::log_mods($log);
if(!ses('USE'))boot::define_use();
$cache=boot::deductions($cache);
if($bim=get('rebuild_img'))ses('rebuild_img',$bim);
$read=get('read'); $enc=ses::$enc;
if(!ses('iqa'))boot::define_iq();
if(!rstr(22))boot::block_crawls();
#env
boot::define_auth();
$cache=boot::time_system($cache);
boot::seslng();
#rqt
if($cache)boot::cache_arts($cache);
if($cache)boot::define_cats_rqt();
#Home
//if(!ses('frm'))geta('module','Home');
//condition
$adm=get('admin'); $msq=get('msql');
boot::define_condition();
pop::m_system();
//design
if($cache)boot::define_clr();
if(ses('desgn'))sty::exitbt();
//mods
$p1=ses('prmb1'); if($p1 && $p1!=prmb(1))ses::$adm['alert']='mod:'.prmb(1);
//back_in_time
if(abs(ses('dayx')-ses('daya'))>86400){ses::$adm=[];
	ses::$adm['timetravel']=lkc('','/reload',nms(82).' '.date('Y',ses('daya')));}
#eye
if(!ses('stsys'))eye();
#structure
$out=[];
if($adm)$out['content']=adm::home();
elseif($msq)$out['content']=msqa::home();
elseif(rstr(85) && (!rstr(146) or $_SESSION['cond'][0]=='home'))$out['content']=boot::deskpage();
else $out=mod::blocks();
#admin
if(ses('dev'))ses::$adm['chrono']=btn('small',round(microtime(1)-$stime,3));
//if(ses::r('tst'))ses::$adm['chrono'].=divb(play_r(ses::r['tst']),'small');
if(!rstr(98) or auth(4))$madmin=pop::popadmin();
#meta
$host=host();
$meta['favicon']='favicon.ico';
if($adm)$meta['title']=$adm;
elseif($msq)$meta['title']=$msq;
elseif(ses::$r['raed']??''){$meta['title']=ses::$r['raed']; $meta['descript']=ses::$r['descr']??'';
	$meta['img']=$host.'/img/'.ses::r('imgrel');}
else{$mn=ses('mn'); $meta['title']=$mn[ses('qb')]??'';
	$meta['descript']=$_SESSION['qbin']['dscrp'];}
$cst=ses('dev')?'?'.randid():'';
if($adm or $msq)$meta['css']='_admin';
else $meta['css']=boot::define_design();
boot::verif_update();
if(get('flow') or rstr(39))$flow=1; else $flow=0;
//alert(play_r(ses::r('spl')));
?>