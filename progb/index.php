<?php //header('Content-Type: text/html; charset='.$_SESSION['enc']);
$ret='<!DOCTYPE HTML>'."\n";// PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
//"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
$ret.='<html lang="'.prmb(25).'"><head>'."\n";
$ret.='<meta charset="'.ses('enc').'">'."\n";
//$ret.=meta('charset',$_SESSION['enc'])."\n";
$ret.='<title>'.$meta['title'].'</title>'."\n";
$ret.=meta('http-equiv','Content-Type','text/html; charset='.ses('enc'));
$ret.='<link rel="shortcut icon" href="'.$meta['favicon'].'"><base href="'.$host.'/">'."\n";
//<link rel="image_src" href="'.$host.$meta["img"].'">
$ret.=meta('name','robots',($_SESSION['rstr'][22]==0?'index, follow':'nofollow'));
$ret.=meta('name','revisit-after','1 hour');
$ret.=meta('name','distribution','Global');
if(rstr(74)){
	$ret.=meta('property','og:title',$meta['title']);
	$ret.=meta('property','og:type',$read?'article':'website');
	$ret.=meta('property','og:image',$meta['img']??'');
	$ret.=meta('property','og:description',$meta['descript']??'');}
else{
	$ret.=meta('name','title',$meta['title']);
	$ret.=meta('name','image',$meta['img']??'');
	$ret.=meta('name','description',$meta['descript']??'');}
//$ret.=meta('name','author',$_SESSION['rqt'][$read][7]);
//$ret.=meta('name','language',$_SESSION['opts']['lang']);
$ret.=meta('name','category',ses('frm'));
$ret.=meta('name','generator','philum_'.ses('philum'));//needed
$ret.=meta('name','hub',ses('qb'));
//$ret.=meta('name','copyright','GNU/GPLv3');
$ret.=meta('name','viewport',prmb(4)?prmb(4):'user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1, width=device-width');//
$ret.=meta('apple-mobile-web-app-capable','yes');
$ret.=meta('mobile-web-app-capable','yes');
//$ret.=meta('theme-color',getclrs('',1));
$ret.=meta('name','google-site-verification',prms('goog'));
$ret.=csslink('/css/_global.css'.$cst);
$ret.=csslink('/css/_pictos.css'.$cst);
//$ret.=csslink('/css/_glyphs.css'.$cst);
$ret.=csslink('/css/_ascii.css'.$cst);
$ret.=csslink('/css/_oomo.css'.$cst);
//$ret.=csslink('/css/_fa.css'.$cst);
if($adm or $msq)$ret.=csslink('/css/_admin.css');
else $ret.=csslink('/css/'.$meta['css'].'.css'.$cst);
//if(prma('desktop')){$ret.=apps::deskbkg();}
$ret.=jscode('read="'.$read.'"; flow="'.$flow.'";');
$ret.=jslink('/prog'.$b.'/ajx.js'.$cst);//ajax
//$ret.=jslink('/prog'.$b.'/ajx2.js'.$cst);//ajax
$ret.=jslink('/prog'.$b.'/utils.js'.$cst);//js
$ret.=jscode('fixpop="'.$_SESSION['mobile'].'"; fulpop="1"; enc="'.$_SESSION['enc'].'";');
//if(rstr(100))$ret.=jslink('http://code.jquery.com/jquery-1.9.1.min.js');
if(ses('desgn'))$ret.=jslink('/js/live.js#css');
$ret.=Head::get();
$ret.='</head>'."\n";
//if($adm)$sp=' spellcheck="false"'; //'.atb('onload',$onload).'
$ret.='<body onclick="clpop(event)" onmousemove="popslide(event)">'."\n";//'.$sp.'
$ret.=divd('clbub','')."\n";
$ret.=$madmin;
$ret.=divd('desktop','')."\n";
$ret.=divd('popup','')."\n";
$ret.='<div id="page">'."\n";
if($out)$ret.=implode('',$out);
//if($rout)$ret.=$rout;
$ret.='</div>'."\n";
$ret.=divd('popw','')."\n";
//$ret.=divd('fs','')."\n";
$ret.=hidden('socket','')."\n";
//$ret.=sesj::render();
$ret.='</body></html>';
echo ($ret);//utf
?>