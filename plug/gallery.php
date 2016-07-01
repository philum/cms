<?php
//philum_plugin_gallery

function plug_gallery($q){if($q=="gl")$q="";
$img_d=sql('img','qda','v','id="'.$_SESSION['read'].'"');
$img_d=substr($img_d,0,1)=='/'?substr($img_d,1):$img_d;
$img_d=str_replace("/",",",$img_d); 
if($q=="auto")$s="";
elseif($q=="manual"){$s=$q; $imgs=str_replace(",",",\n",$img_d); }
elseif($q=="dir"){$s=$q; $dirs=br().plugin('dsnav','gl','users/'.$_SESSION['qb']);}
else $s=$q;
$ret.=bal("b","source:").' ';
if(!$q){//gallerygl
	if($img_d){$ret.=lj('popbt','popup_gallery__x_auto',"auto").' ';
		$ret.=lj('popbt','popup_gallery__x_manual',"manual").' ';}
	$ret.=lj('popbt','popup_gallery__x_dir',"user/directory");}
else $ret.=lj("popbt",'popup_gallery',$q=="dir"?"user_directory":$q);
if($imgs)$ret.=br().txarea('dpl',$imgs,40,10,atd('source').atc('popw').ats('border:1px solid black'));//pb name=src
if($dirs)$ret.=$dirs;
if($q!="dir" && $q){
	$ret.=br().bal("b","type:").' ';
	$ret.=ljb("popbt","insert_photo",$s.'\',\'',"Thumbnails").' ';
	$ret.=ljb("popbt","insert_photo",$s.'\',\'2',"Ajax").' ';
	$ret.=ljb("popbt","insert_photo",$s.'\',\'1',"Flash").' ';
	$ret.=lj("popbt",'popup_slider_'.($s=='manual'?'source':'').'_3x_'.$s.'_'.$_SESSION['read'],"Slider").' ';}
return $ret;}

?>