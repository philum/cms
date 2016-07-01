<?php
//philum_plugin_

//pop/maker_mini_c
function plug_rollovertopop($doc,$t){
$id='curtain'.randid(); 
//return imgico($a.'" onmouseover="this.src=\''.$b.'\'" onmouseout="this.src=\''.$a.'\'');
list($v,$p)=split_one('§',$doc,1); $img=make_thumb_d($v,$p);//
$im=goodroot($v); list($l,$h)=getimagesize($im);
$send='photo_'.str_replace("_","*",$im).'_'.$l.'_'.$h;
if($_SESSION['nl'])$thumb=image($im,currentwidth(),'');
//$ret=ljb("","SaveBf",$send,$img);
$oc='SaveBf(\''.$send.'\')';
$ov='getbyid(\''.$id.'\').style.background-color:rgba(0,0,0,0);';
$ret=lkh($oc,$ov,$thumb);
$sty='position:absolute; width:340px; height:240px; background-color:rgba(0,0,0,0.5); text-align-center; vertical-align:center;';
$title=divs('width:140px; height:40px; background-color:#;',$t);
$ret.=div(' style="'.$sty.'" id="'.$id.'"','');
//return imgico($a.'" onmouseover="this.src=\''.$b.'\'" onmouseout="this.src=\''.$a.'\'');
return $ret;}

?>