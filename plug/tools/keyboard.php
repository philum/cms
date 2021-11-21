<?php
//philum_plugin_keyboard

function kbtog($d,$t){$id='oo'.randid(); $v=ses($d);
return lj('',$id.'_togses___'.$d,btd($id,offon($v)).$t);}

function kb_build($id,$o){$ret=''; $i=0;
if($o)$r=array('²1234567890°+','AZERTYUIOP¨£','QSDFGHJKLM%µ','WXCVBN?./§','¬#{[|`\^@]}€<>');
else $r=array('&é"\'(-è_çà)=','azertyuiop^$','qsdfghjklmù*','wxcvbn,;:!');
$cap=lj($o?'active':'','kbd_plug___keyboard_kb*build_'.$id.'_'.yesno($o),picto('maj'));
foreach($r as $v){$ra=str_split($v); $i++;
foreach($ra as $va)$ret.=lja('popbt','insert_b(\''.$va.'\',\''.$id.'\')',$va).' ';
if($i==1)$ret.=ljb('','conn',$id.'_del',picto('backspace'));
if($i==2)$ret.=ljb('','insert_b','\n\',\''.$id,picto('newline'));
if($i==3)$ret.=$cap;
if($i==4)$ret.=lja('popbt','insert_b(\' \',\''.$id.'\')','--');
$ret.=br();}
return $ret;}

function kb_j($id,$o,$res=''){
if($id=='kbv'){$ret=input1('kbv',$res);}
//$ret.=ljb('popw','insert_value',[$id,'kbv'],'ok');
$ret=divd('kbd',kb_build($id,$o,$res));
return $ret;}

//plugin('keyboard',$p,$o)
function plug_keyboard($id,$o){if(!$id)$id='kbv';
$ret=lj('','popup_plup___keyboard_kb*j_'.$id,picto('cursor'));
return $ret;}

?>