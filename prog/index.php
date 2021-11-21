<?php
//header('Content-Type: text/html; charset='.$_SESSION['enc']);
$ret='<!DOCTYPE HTML>'."\n";// PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
//"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
$ret.='<html lang="'.prmb(25).'"><head>'."\n";
$ret.='<meta charset="'.$_SESSION['enc'].'">'."\n";
//$ret.=meta('charset',$_SESSION['enc'])."\n";
$ret.='<title>'.$meta['title'].'</title>'."\n";
$ret.=meta('http-equiv','Content-Type','text/html; charset='.$_SESSION['enc']);
$ret.='<link rel="shortcut icon" href="'.$meta['favicon'].'"><base href="'.$host.'/">'."\n";
//<link rel="image_src" href="'.$host.$meta["img"].'">
$ret.=meta('name','robots',($_SESSION['rstr'][22]==0?'index, follow':'nofollow'));
$ret.=meta('name','revisit-after','1 hour');
$ret.=meta('name','distribution','Global');
if(rstr(74)){
	$ret.=meta('property','og:title',$meta['title']);
	$ret.=meta('property','og:type',$read?'article':'website');
	$ret.=meta('property','og:image',val($meta,'img',''));
	$ret.=meta('property','og:description',val($meta,'descript'));}
else{
	$ret.=meta('name','title',$meta['title']);
	$ret.=meta('name','image',val($meta,'img'));
	$ret.=meta('name','description',val($meta,'descript'));}
//$ret.=meta('name','author',$_SESSION['rqt'][$read][7]);
//$ret.=meta('name','language',$_SESSION['opts']['lang']);
$ret.=meta('name','category',$_SESSION['frm']);
$ret.=meta('name','generator','philum_'.$_SESSION['philum']);//needed
$ret.=meta('name','hub',ses('qb'));
//$ret.=meta('name','copyright','GNU/GPLv3');
$ret.=meta('name','viewport',prmb(4)?prmb(4):'user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1, width=device-width');//
$ret.=meta('apple-mobile-web-app-capable','yes');
$ret.=meta('mobile-web-app-capable','yes');
$ret.=meta('theme-color',getclrs('',1));
$ret.=meta('name','google-site-verification',prms('goog'));
$ret.=css_link('/css/_global.css'.$cst);
$ret.=css_link('/css/_pictos.css'.$cst);
//$ret.=css_link('/css/_glyphs.css'.$cst);
$ret.=css_link('/css/_ascii.css'.$cst);
$ret.=css_link('/css/_oomo.css'.$cst);
//$ret.=css_link('/css/_fa.css'.$cst);
if($adm or $msq)$ret.=css_link('/css/_admin.css');
else $ret.=css_link('/css/'.$meta['css'].'.css'.$cst);
	//if(prma('desktop')){req('ajxf');$ret.=desk_css();}
$ret.=js_code('read="'.$read.'"; flow="'.$flow.'";');
$ret.=js_link('/prog'.$b.'/ajx.js');//ajax
//$ret.=js_link('/prog'.$b.'/ajx2.js');//ajax
$ret.=js_link('/prog'.$b.'/utils.js');//js
$ret.=js_code('cutat='.$_SESSION['jbuffer'].'; fixpop="'.$_SESSION['mobile'].'"; fulpop="1"; enc="'.$_SESSION['enc'].'";');
//if(rstr(100))$ret.=js_link('http://code.jquery.com/jquery-1.9.1.min.js');
if(ses('desgn'))$ret.=js_link('/js/live.js#css');
$ret.=Head::get();
$ret.='</head>'."\n";
//if($_GET['admin'])$sp=' spellcheck="false"'; //'.atb('onload',$onload).'
$ret.='<body onclick="clpop(event)" onmousemove="popslide(event)">'."\n";//'.$sp.'
$ret.=divd('clbub','')."\n";
$ret.=$madmin;
$ret.=divd('desktop','')."\n";
$ret.='<div id="page">'."\n";
if($out)$ret.=implode('',$out);
//if($rout)$ret.=$rout;
$ret.='</div>'."\n";
$ret.=divd('popup','')."\n";
$ret.=divd('popw','')."\n";
//$ret.=divd('fs','')."\n";
$ret.=hidden('','socket','')."\n";
//$ret.=sesj::render();
$ret.='</body></html>';
echo ($ret);//utf
?>