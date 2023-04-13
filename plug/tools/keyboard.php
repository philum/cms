<?php //keyboard
class keyboard{
static function tog($d,$t){$id='oo'.randid(); $v=ses($d);
return lj('',$id.'_togses___'.$d,btd($id,offon($v)).$t);}

static function build($id,$o){$ret=''; $i=0;
if($o)$r=['²1234567890°+','AZERTYUIOP¨£','QSDFGHJKLM%µ','WXCVBN?./§','¬#{[|`\^@]}€<>'];
else $r=['&é"\'(-è_çà)=','azertyuiop^$','qsdfghjklmù*','wxcvbn,;:!'];
$cap=lj($o?'active':'','kbd_keyboard,build___'.$id.'_'.yesno($o),picto('maj'));
foreach($r as $v){$ra=str_split($v); $i++;
foreach($ra as $va)$ret.=btj($va,atjr('insert_b',[$va,$id]),'popbt').' ';
if($i==1)$ret.=ljb('','conn',$id.'_del',picto('backspace'));
if($i==2)$ret.=ljb('','insert_b',['\n',$id],picto('newline'));
if($i==3)$ret.=$cap;
if($i==4)$ret.=btj('--',atjr('insert_b',[' ',$id]),'popbt');
$ret.=br();}
return $ret;}

static function call($id,$o,$prm=[]){$p=$prm[0]??'';
if($id=='kbv'){$ret=input('kbv',$p);}
//$ret.=ljb('popw','insert_value',[$id,'kbv'],'ok');
$ret=divd('kbd',self::build($id,$o,$p));
return $ret;}

static function home($id,$o){if(!$id)$id='kbv';
$ret=lj('','popup_keyboard,call_'.$id,picto('cursor'));
return $ret;}
}
?>