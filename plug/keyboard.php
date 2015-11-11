<?php
//philum_plugin_keyboard

function kbtog($d,$t){$id='oo'.randid(); $v=ses($d);
return lj('',$id.'_togses___'.$d,btd($id,offon($v)).$t);}

function kb_build($id,$o){
if($o)$r=array('²1234567890°+','AZERTYUIOP¨£','QSDFGHJKLM%µ','WXCVBN?./§','~#{[|`\^@]}€<>');
else $r=array('&é"\'(-è_çà)=','azertyuiop^$','qsdfghjklmù*','wxcvbn,;:!');
$cap=lj($o?'active':'','kbd_plug___keyboard_kb*build_'.$id.'_'.yesno($o),picto('up'));
foreach($r as $v){$ra=strsplit($v); $i++;
foreach($ra as $va)$ret.=lja('insert_b(\''.$va.'\',\''.$id.'\')',$va,'popbt').' ';
if($i==1)$ret.=ljb('popw','conn',$id.'_del',picto('no'));
if($i==2)$ret.=ljb('popw','insert_b','\n\',\''.$id,picto('back'));
if($i==3)$ret.=$cap;
if($i==4)$ret.=lja('insert_b(\' \',\''.$id.'\')','--','popbt');
$ret.=br();}
return $ret;}

function kb_j($id,$o,$res=''){
if($id=='kbv'){$ret=input(1,'kbv',$res);}
//$ret.=lc('insert_value(\''.$id.'\',\'kbv\');','ok','popw');
$ret.=divd('kbd',kb_build($id,$o,$res));
return $ret;}

//plugin('keyboard',$p,$o)
function plug_keyboard($id,$o){if(!$id)$id='kbv';
$ret=lj('','popup_plup___keyboard_kb*j_'.$id,picto('i'));
return $ret;}

?>