<?php
//philum_plugin_
session_start();
error_reporting(6135);
//[Panorama;7;58d1f0;raleway_thin§_.jpg:overpop]

//rideau
function overpop($t,$id,$clr,$typo,$opac,$w=320,$h=240){$randid=randid();
$ov='document.getElementById(\'crt1'.$randid.'\').style.backgroundColor=\''.hexrgb($clr,0).'\'; document.getElementById(\'crt2'.$randid.'\').style.backgroundColor=\''.hexrgb($clr,0.9).'\';';
$ot='document.getElementById(\'crt1'.$randid.'\').style.backgroundColor=\''.hexrgb($clr,$opac).'\'; document.getElementById(\'crt2'.$randid.'\').style.backgroundColor=\''.hexrgb($clr,1).'\';';
$go=is_numeric($id)?'href="'.urlread($id).'"':atb('onclick',$id);
//title
$title=div('id="crt2'.$randid.'" style="font-family:'.$typo.'; font-size:24px; text-align:center; color:#'.invert_color($clr,1).'; padding:10px; width:140px; background-color:#'.$clr.'; margin:100px auto; vertical-align:middle; box-shadow:0 0 5px #'.$clr.'; text-shadow: 0 0 3px #'.invert_color($clr,0).';"',$t);// transition: all 1s ease;
//rideau
$sty='position:absolute; width:'.($w?$w:320).'px; height:'.($h?$h:240).'px; background-color:'.hexrgb($clr,$opac).'; text-align-center; vertical-align:middle; transition: all 1s ease; box-shadow:2px 2px 5px '.hexrgb('000000',0.5).'; display:inline-block;';
$ret=div('style="'.$sty.'" id="crt1'.$randid.'"',$t?$title:'');
$ret='<a '.$go.atb('onmouseover',$ov).atb('onmouseout',$ot).'>'.$ret.'</a>';
return $ret;}

//curtain
//pop/maker_mini_c
function plug_overpop($doc,$t){
$opac=0.5;
list($v,$src)=split_one('§',$doc,1); 
list($t,$id,$clr,$typo)=split(';',$v);
//list($w,$h)=getimagesize($src);
//$im=goodroot($src); list($w,$h)=getimagesize($im); echo $w.'-'.$h;
list($w,$h)=split('/',$_SESSION['prmb'][27]);
$img=make_thumb_d($src,$_SESSION['prmb'][27]);
$ret=overpop($t,$id,$clr,$typo,$opac,$w,$h);
return $ret.$img;}

?>