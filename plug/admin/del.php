<?php //del

function delj($p,$o,$res){$f=ajxg($res);
if(!auth(7))return 'no';
if($p=='file'){if(is_file($f))unlink($f); else return 'error';}
if($p=='dir' && $f && strpos($f,'/')!=false){echo $f; if(is_dir($f))rmdir_r($f); else return 'error';}
return btn('txtyl',$p.' '.$f.': deleted');}

function del_com($p,$o){$rid='plg'.randid(); $id='del'.$o;
$ret=input('inp'.$o,$p?$p:'/'.$o,atz(44)).' ';
$ret.=lj('popsav',$rid.'_plug___del_delj_'.$o.'__inp'.$o,'delete').' ';
$ret.=btd($rid,'').br();
return $ret;}

function plug_del($p,$o){
return del_com($p,'file').del_com($o,'dir');}

?>