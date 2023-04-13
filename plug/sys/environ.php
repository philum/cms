<?php 
class environ{

static function art($id){//return desk::icoart($ib,'','icones');
$lj=lj('','popup_environ,build___'.$id,picto('get'));
$lk=lk(urlread($id),picto('url'));
$lp=ma::popart($id,1);
//$ln=mod::pane_art($id);
return divc('',$lp.' '.$lk.' '.$lj);}

static function build($id,$o){
$ret=self::art($id);
$ib=ma::ib_of_id($id);
if($ib)$ret.=divc('',divc('txtcadr','parent').self::art($ib));
$r=ma::art_tags($id); //pr($r);
if($r)foreach($r as $k=>$v){
	foreach($v as $ka=>$va){$ret.=divc('txtcadr',$ka); $rb=ma::tag_arts($ka,$k,7);
		if($rb)foreach($rb as $kb=>$vb)$ret.=self::art($kb);}}
$r=art::metart($id); //pr($r);
foreach($r as $k=>$v){if(is_numeric($v)){$t=divc('txtcadr',$k); $d=self::art($v);
	$ret.=divc('',$t.$d);}}
return $ret;}

static function j($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_environ,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>