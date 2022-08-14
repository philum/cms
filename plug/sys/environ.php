<?php //environ

function environ_art($id){//return apps::icoart($ib,'','icones');
$lj=lj('','popup_plug___environ_environ*build_'.$id,picto('get'));
$lk=lk(urlread($id),picto('url'));
$lp=ma::popart($id,1);
//$ln=mod::pane_art($id);
return divc('',$lp.' '.$lk.' '.$lj);}

function environ_build($id,$o){//
$ret=environ_art($id);
$ib=ma::ib_of_id($id);
if($ib)$ret.=divc('',divc('txtcadr','parent').environ_art($ib));
$r=ma::art_tags($id); //pr($r);
if($r)foreach($r as $k=>$v){
	foreach($v as $ka=>$va){$ret.=divc('txtcadr',$ka); $rb=ma::tag_arts($ka,$k,7);
		if($rb)foreach($rb as $kb=>$vb)$ret.=environ_art($kb);}}
$r=art::metart($id); //pr($r);
foreach($r as $k=>$v){if(is_numeric($v)){$t=divc('txtcadr',$k); $d=environ_art($v);
	$ret.=divc('',$t.$d);}}
return $ret;}

function environ_j($p,$o,$res=''){
[$p,$o]=ajxp($res,$p,$o);
$ret=environ_build($p,$o);
return $ret;}

function environ_menu($p,$o,$rid){
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_environ_environ*j___inp',picto('ok')).' ';
return $ret;}

function plug_environ($p,$o){$rid='plg'.randid();
$bt=environ_menu($p,$o,$rid);
$ret=environ_build($p,$o);
return $bt.divd($rid,$ret);}

?>