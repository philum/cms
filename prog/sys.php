<?php
//philum_system 
//income:$g;$aqb;$db
//tests();
#Boot
secure_inputs(); setget();
//$_SESSION='';
$_SESSION['stime']=$stime; $_SESSION['dayx']=time();
$_SESSION['headr']=''; $_SESSION['head_r']=''; $_SESSION['jscode']='';
if($_GET['rl']=='=' && $_SESSION['sbdm'])//good_subdom
	relod(subdom($_GET['id']).'/'.$_GET['id'].'/logon');
//reload
if(!$_SESSION['qb'] or !$_SESSION['qd'] or !$_SESSION['qda'] or $_GET['qd'] or $_GET['id'] or $_GET['nbj'] or !$_SESSION['mods'] or $_GET['refresh']){$cache='ok'; reset_ses(); prog($g);}
if($_GET['dev']){$_SESSION['dev']=$_GET["dev"]; relod('/?id==');}
//master_params
if(!$_SESSION['qd'] or $cache)master_params('params/_'.$db,$qd,$aqb,$subd);
if(!$_SESSION['master'])$_SESSION['master']=rse('name',$_SESSION['qdu'].' WHERE id="1"');
if(!$_SESSION['philum'])$_SESSION['philum']=msql_read('system','program_version',1);//philum
date_default_timezone_set(prms('timez'));//php5
if($_SESSION['dev'])error_report();
if(!$_SESSION['mn'] or $cache)define_hubs();//hubs
if(!$_GET['nbj'] && $cache)define_qb();//qb::need $mn
if(isset($_GET['rebuild_img']))$_GET['read']=$_SESSION['read'];
$read=$_GET['read'];
$cache=deductions_from_read($read,$cache);//deductions
if(!$_SESSION['qbin'] or $cache)define_config();//qb_in
if($_SESSION['rstr'][22])block_crawls();//crawl
if(isset($_GET['herit_design']))alternate_design($_GET['herit_design']);//herit_design
if(isset($_GET['switch_design']))$_SESSION['switch']=$_GET['switch_design'];
if(!$_SESSION['iq'])$_SESSION['iq']=eye_iq();//eye
$log=log_mods();//login
$_SESSION['auth']=define_auth();
#environment
$cache=time_system($cache);//time_system
//patch($db);
define_s('lang','all');//cache_system
if(!isset($_SESSION['rqt']) or $cache)cache_arts();
if(!is_array($_SESSION['line']) or $cache or $_GET["continue"]=="edit")define_cats_rqt();//cats
$_SESSION['frm']=define_frm();//frm
if(!isset($_SESSION['interm']) or $cache)define_interm();//interm
//hierarchics
if((!isset($_SESSION['superline']) or $cache) && is_array($_SESSION['line']))
	$_SESSION['superline']=collect_hierarchie('');
$_SESSION["page"]=$_GET['page']?$_GET['page']:1;//page
if($_GET['plug'])$_SESSION['frm']='';//reset_frm
//Home
if(!$_SESSION['frm'] && !$_GET)$_GET['module']="Home";
#sav
if($_SESSION['auth']>=2 && ($_GET['continue'] or @$_GET['publish'] or @$_GET['idy_hide'] or @$_GET['idy_erase'] or @$_GET['insert'] or @$_GET['im'] or @$_GET['deploy'] or @$_GET['trash_art'] or @$_GET['delete_art'])){req('sav'); sav_actions($read);}
//condition
if(!$_GET['admin'])define_condition();
m_system();//admin
if($_GET['slct_mods'])select_mods($_GET['slct_mods']);
#Design
if(!$_SESSION['clrs'][$_SESSION['prmd']] or $cache)define_clr();
if($_GET['desgn'])$_SESSION['desgn']=$_GET['desgn'];
if($_GET['admin']=='css' && !$_SESSION['desgn'])$_SESSION['desgn']=$_SESSION['prmd'];
if($_GET['exit_design']){$_SESSION['desgn']=''; $_SESSION['clrset']='';
	define_mods(''); define_condition(); $_POST['popadm']['design']='';}
if($_SESSION['desgn']){if(!$_GET['admin'])$wth=' watch:'.$_SESSION['prmd'];
	$_POST['popadm']['design']=lkc('txtyl','/?exit_design==','design:'.$_SESSION['desgn'].$wth).' ';}
//dev
$_POST['popadm']['alert']=$_GET['dev2prod']?dev2prod():btd('alert','');
if(ses('dev'))$_POST['popadm']['chrono']=btn('small',round(mtime()-$stime,3));
#Load
$_SESSION['load']=define_load();
#Eye
if($_SESSION['stsys']!='no')eye();
#structure
if($_GET['admin']){req('admin'); $out['content']=admin();}
elseif($_GET['msql']){req('msql'); $out['content']=msql_adm();}
elseif($p=$_GET['plug']){$out['content']=divd('content',plugin($p,get('p'),get('o')));}
elseif(rstr(85)){$_SESSION['headr'].=desktop_js('boot');//$_SESSION['desktop']=1;
	if($read)$_SESSION['headr'].=js_code(sj('popup_popart___'.$read.'_3'));}
//elseif($read && rstr(72))$rout=cache_html($read);
else $out=build_blocks();
//meta
$host=host();
$meta['favicon']=favicon();
if($_GET["admin"])$meta["title"]=$_GET['admin'];
elseif($_GET["msql"])$meta["title"]=$_GET['msql'];
elseif($_SESSION["read"]){$meta["title"]=$_SESSION["raed"];
	$meta["descript"]=$_SESSION["descript"];
	$meta["img"]=$host.'/imgc/'.$_SESSION["imgrel"];}
else{$meta["title"]=$_SESSION['mn'][$_SESSION['qb']];
	$meta["descript"]=$_SESSION['qbin']["dscrp"];}
	//$meta["img"]=host().'/img/ban_'.$_SESSION['qb'].'.jpg';
$cst=$_SESSION['desgn']?'?'.randid():'';
if($_SESSION['mobile'] && rstr(63))$_SESSION['negcss']=1;
$meta["css"]=define_design();
verif_update();//update
if($_SESSION['dlnb'])$_SESSION['headr'].=js_code(sj('popup_update'));
#back_in_time
if(abs(ses('dayx')-ses('daya'))>86400)
	$_POST['popadm']['timetravel']=lkc('txtyl','/reload/'.ses('qb'),nms(82));
?>