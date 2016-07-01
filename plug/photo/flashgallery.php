<?php
//philum_plugin_flashgallery

function embed_gallery($f,$id){
$w=currentwidth(); $h=$w*(3/4);
if(!$f)$cachefile=$id;else $cachefile=$f;
$fvars='&servr='.host().'/&rot='.$cachefile.'&clr='.$_SESSION['clrs'][$_SESSION['prmd']][6];
$file='gallery/cache/'.str_replace("/","--",$cachefile.'/').'.php';
$goto='gallery/gal.php?root='.$f.'&pid='.$id.'&rebuild==';
if(!is_file($file))return lkt('red',$goto,picto('alert'));
if($_SESSION['USE']) $add=lkt('',$goto,picto('builders'));
return embed_flsh('fla/gallery.swf',$w,$h,$fvars).$add;}

function plug_flashgallery($f,$id){//list($r,$f)=decide_source($f,$id); p($f);	
if($_SESSION['read'] or rstr(41)){$ret=embed_gallery($f,$id).$add;}
else{$ret=btn('txtx',"PhotoGallery");}
if(!$_SESSION['nl'])return $ret;}

?>