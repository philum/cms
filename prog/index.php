<?php 
header('Content-Type: text/html; charset='.$enc);
$ret='<!DOCTYPE HTML>'."\n";
$ret.='<html lang="'.prmb(25).'"><head>'."\n";
$ret.='<meta charset="'.$enc.'">'."\n";
//$ret.=meta('http-equiv','Content-Type','text/html; charset='.$enc);
$ret.='<title>'.$meta['title'].'</title>'."\n";
$ret.='<link rel="shortcut icon" href="'.$meta['favicon'].'"><base href="'.$host.'/">'."\n";
//<link rel="image_src" href="'.$host.$meta["img"].'">
$ret.=meta('name','robots',(rstr(22)?'index, follow':'nofollow'));
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
$ret.=meta('name','category',get('frm'));
$ret.=meta('name','generator','philum_'.ses('philum'));//needed
$ret.=meta('name','hub',ses('qb'));
//$ret.=meta('name','copyright','GNU/GPLv3');
$ret.=meta('name','viewport',prmb(4)?prmb(4):'user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1, width=device-width');//
$ret.=meta('apple-mobile-web-app-capable','yes');
$ret.=meta('mobile-web-app-capable','yes');
$ret.=meta('name','google-site-verification',prms('goog'));
$ret.=csslink('/css/_global.css'.$cst);
$ret.=csslink('/css/_pictos.css'.$cst);
//$ret.=csslink('/css/_ascii.css'.$cst);
$ret.=csslink('/css/_oomo.css'.$cst);
$ret.=csslink('/css/'.$meta['css'].'.css'.$cst);
$ret.=jscode('read="'.$read.'"; flow="'.$flow.'";
fixpop="'.ses('mobile').'"; fulpop="1"; enc="'.$enc.'";
state='.json_encode(ses::$st).';');
$ret.=jslink('/prog'.$b.'/j/lib.js'.$cst);
$ret.=jslink('/prog'.$b.'/j/ajx.js'.$cst);
$ret.=jslink('/prog'.$b.'/j/utils.js'.$cst);
if(ses('desgn'))$ret.=jslink('/js/live.js#css');
$ret.=Head::get();
$ret.='</head>'."\n";
$ret.='<body onclick="clpop(event)" onmousemove="popslide(event)">'."\n";
$ret.=divd('clbub','')."\n";
$ret.=$madmin;
$ret.=divd('trkdsk','')."\n";
$ret.=divd('desktop','')."\n";
$ret.=divd('popup','')."\n";
$ret.='<div id="page">'."\n";
if($out)$ret.=implode('',$out);
$ret.='</div>'."\n";
$ret.=divd('popw','')."\n";
$ret.=hidden('socket','')."\n";
//$ret.=jscode('');
$ret.='</body></html>';
echo ($ret);//utf
echo '<!--
generated in '.(round(microtime(1)-$stime,3)).' seconds
-->';
?>