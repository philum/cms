<?php
$ret='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">'."\n";
//"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
$ret.='<html lang="'.prmb(25).'"><head>'."\n";
$ret.='<title>'.$meta["title"].'</title>'."\n";
$ret.=meta('http-equiv','Content-Type','text/html; charset='.$_SESSION['enc']);
//$ret.=meta('charset',$_SESSION['enc']);
$ret.='<link rel="shortcut icon" href="'.$meta['favicon'].'"><base href="'.$host.'/">'."\n";
//<link rel="image_src" href="'.$host.$meta["img"].'">
$ret.=meta('name','robots',($_SESSION['rstr'][22]==0?'index, follow':'nofollow'));
$ret.=meta('name','revisit-after','1 hour');
$ret.=meta('name','distribution','Global');
if(rstr(74)){
	$ret.=meta('property','og:title',$meta["title"]);
	$ret.=meta('property','og:image',$meta["img"]);
	$ret.=meta('property','og:description',$meta["descript"]);}
else{
	$ret.=meta('name','title',$meta["title"]);
	$ret.=meta('name','image',$meta["img"]);
	$ret.=meta('name','description',$meta["descript"]);}
//$ret.=meta('name','author',$_SESSION['rqt'][$read][7]);
//$ret.=meta('name','language',$_SESSION['opts']['lang']);
$ret.=meta('name','category',$_SESSION['frm']);
$ret.=meta('name','generator','philum_'.$_SESSION['philum']);//needed
$ret.=meta('name','hub',$_SESSION['qb']);
//$ret.=meta('name','copyright','GNU/GPLv3');
$ret.=meta('name','viewport','user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1, width=device-width');//prmb(4)
$ret.=meta('name','google-site-verification',prms('goog'));
$ret.=css_link('/css/_global.css'.$cst);//css
$ret.=css_link('/css/_pictos.css'.$cst);//icons
if($_GET['admin'] or $_GET['msql'])$ret.=css_link('/css/_admin.css');
else $ret.=css_link('/css/'.$meta["css"].'.css'.$cst);
$ret.=js_code('cutat='.$_SESSION['jbuffer'].'; fixpop="'.$_SESSION['mobile'].'"; 
fulpop="1"; read="'.$read.'"; flow="'.$flow.'";');
$ret.=js_link('/prog'.$g.'/ajx.js');//ajax
$ret.=js_link('/prog'.$g.'/utils.js');//js
if(rstr(100))$ret.=js_link('http://code.jquery.com/jquery-1.9.1.min.js');
if($_SESSION['desgn'])$ret.=js_link('/js/live.js#css');
$ret.=Head::get();
$ret.='</head>'."\n";
if($_GET['admin'])$sp=' spellcheck="false"';
$ret.='<body'.atb('onload',$onload).' onclick="clpop(event)" onmousemove="popslide(event)"'.$sp.'>'."\n";//
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
$ret.='</body></html>';
echo utf($ret);
?>