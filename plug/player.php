<?php
//philum_plugin_flash-rss_Player 
session_start();
require_once('progb/lib.php');
//require_once('../progb/pop.php');
//require_once('../progb/spe.php');
require_once('sys.php');

/*function embed_flsh($fl,$xf,$yf,$fvar){
return '<embed src="'.$fl.'" width="'.$xf.'" height="'.$yf.'" wmode="transparent" FlashVars="'.$fvar.'" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" />';}// allowScriptAccess="always"*/

function embed_flsh_obj($fl,$xf,$yf,$fvar){//$emb=embed_flsh($fl,$xf,$yf,$fvar);
return '<object data="'.$fl.'" width="'.$xf.'" height="'.$yf.'"><param name="movie" value="'.$fl.'"><param name="wmode" value="transparent"><param name="allowFullScreen" value="true"><param name="FlashVars" value="'.$fvar.'"> <param name="type" value="application/x-shockwave-flash">'.$emb.'</object>';}// <param name="allowScriptAccess" value="always">

function script_for_flash_b($movie,$sizh,$sizl,$fvar){return "
	if (AC_FL_RunContent == 0){alert(\"AC_RunActiveContent.js. missing\");}
	else{ AC_FL_RunContent(
		'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
		'width', '".$sizl."',
		'height', '".$sizh."',
		'src', '".$movie."',
		'quality', 'high',
		'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
		'align', 'middle',
		'play', 'true',
		'loop', 'true',
		'scale', 'noscale',
		'wmode', 'window',
		'devicefont', 'true',
		'id', '".$movie."',
		'name', '".$movie."',
		'menu', 'true',
		'FlashVars', '".$fvar."',
		'allowFullScreen', 'true',
		'allowScriptAccess','sameDomain',
		'movie', '".$movie."',
		'salign', ''
		); //end AC code}";}

function plug_player(){
$movie='../fla/rss.swf';
//$js=script_for_flash_b($movie,"100%","100%",$fvar);
//Head::add('jscode',$js);
$clr=$_SESSION['clr'][$_SESSION['prmd']];
$clr=msql_read('design',$_SESSION["qb"].'_clrset_1','');
if(!$clr)$clr=msql_read('system','default_clr',''); //p($clr);
$fvar='&servr=http://'.$_SERVER['HTTP_HOST'].'/&hub='.$_SESSION["qb"].'&clr1='.$clr[1].'&clr2='.$clr[2].'&clr3='.$clr[3].'&clr4='.$clr[4].'&clr5='.$clr[5].'&clr6='.$clr[6].'&clr7='.$clr[7].'&clr8='.$clr[8];//.'&read_art=&category=&background_img=&order=day_DESC''&nbj='.$_GET['nbj'].
//$ret=embed_flsh($movie,"100%","100%",$fvar);
$ret=embed_flsh_obj($movie,"100%","100%",$fvar);////player
return $ret;}
?>


