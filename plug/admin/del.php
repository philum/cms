<?php //del
class del{
static function call($p,$o,$prm=[]){
$f=$prm[0]??$p; if(!auth(7))return 'no';
if($p=='file'){if(is_file($f))unlink($f); else return 'error';}
if($p=='dir' && $f && strpos($f,'/')!=false){echo $f; if(is_dir($f))rmdir_r($f); else return 'error';}
return btn('txtyl',$p.' '.$f.': deleted');}

static function com($p,$o){$rid='plg'.randid(); $id='del'.$o;
$ret=input('inp'.$o,$p?$p:'/'.$o,atz(44)).' ';
$ret.=lj('popsav',$rid.'_del,call_inp'.$o.'__'.$o,'delete').' ';
$ret.=btd($rid,'').br();
return $ret;}

static function home($p,$o){
return self::com($p,'file').self::com($o,'dir');}
}
?>