<?php
//philum_plugin_imgtxtb

function gdf_nblines($t,$maxl){$n=0; 
$t=str_replace("\n"," \n",$t); $r=explode(' ',$t);
foreach($r as $k=>$v){$len=strlen($v); $nb+=$len+1; $pos=strpos($v,"\n");
	if($nb>$maxl){$v; $pos=strlen($v); $ret[$n].=substr($v,0,$pos); $n++;
		$vb=substr($v,$pos); $nb=strlen($vb); 
		if($nb>$maxl){$nbb=floor($nb/$maxl);//todo:saut de ligne
			for($i=0;$i<$nbb;$i++){$ret[$n]=substr($vb,$maxl*$i,$maxl); $n++;}}
		else $ret[$n]=$vb.' ';}
	elseif($pos!==false){$ret[$n].=substr($v,0,$pos); $n++;
		$ret[$n]=substr($v,$pos+1).' '; $nb=strlen($ret[$n]);}
	else $ret[$n].=trim($v).' ';}
return $ret;}

/*function imt_mk($p,$n){ 
$l=50; $s=strlen($p); $n=ceil($s/$l); $sz=$s<$l?($s/5)*40:400;
for($i=0;$i<$n;$i++){$v=substr($p,$i*$l,$l); $pos=strpos($v,"\n");
	if($pos!==false){$r[]=substr($v,0,$pos); $r[]=substr($p,$pos+1);}
	else $r[]=$v;}
return $r;}*/

function imgtxt_mk($t,$fx,$fy,$lac,$hac,$fnt,$clr,$dest){
$t=str_replace("&nbsp;",' ',$t);
$nb_chars=strlen($t); $width=400;//currentwidth();
if($lac && $width)$maxl=floor($width/$lac); else $maxl=400;
$la=$nb_chars*$lac; 
$la=$la>$width-8?$width-8:$la;
if($nb_chars>$maxl or strpos($t,"\n")!==false)$r=gdf_nblines($t,$maxl);
//$r=imt_mk($t); 
$ha=$r?$hac*count($r):($hac?$hac:20); $clr=$clr?$clr:'000000';
$rh=hexdec(substr($clr,0,2));$gh=hexdec(substr($clr,2,2));$bh=hexdec(substr($clr,4,2));
$image=imagecreate($la,$ha);
$blanc=imagecolorallocate($image,255,255,255);
$color=imagecolorallocate($image,$rh,$gh,$bh);
$font=imageloadfont($fnt);
if($r)foreach($r as $k=>$v){$fx=$k*lac; $fy=$k*$hac;
	imagestring($image,$font,1,$fy,$v,$color);}
else imagestring($image,$font,$fx?$fx:0,$fy?$fy:0,$t,$color);
imagecolortransparent($image,$blanc);
imagepng($image,$dest);}

function plug_imgtxt($t,$fnt,$cod=''){
$t=str_replace('/','|',$t);//nodirs
$t=$t?$t:'error'; $fnt=$fnt?$fnt:'Fixedsys';
$font='gdf/'.$fnt.'.gdf';
$clr=$_SESSION['clrs'][$_SESSION['prmd']][7];
if($cod=='out'){$f=ses('out'); $f=str_replace('/plug/','',$f); $jp='plug/';}
elseif($cod or $fnt=='crackman')$f='imgb/cod'.$t.'.png';
else $f='imgb/'.ses('read').'_imgtxt.png';
$r=msql_read('system','edition_fontes',$fnt,'k');
if(!is_array($r[3]) && is_file($font)){
	if(!file_exists($f) or $cod or $_GET['rebuild_img'])//
	if($r)imgtxt_mk($t,$r[0],$r[1],$r[2],$r[3],$font,$clr,$jp.$f);
list($w,$h)=getimagesize($jp.$f);
return image('/'.$jp.$f.'?'.randid(),$w,$h);}
else return $t;}

?>