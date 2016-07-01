<?php
//philum_plugin_environ

function environ_art($id){//return icoart($ib,'','icones');
$lj=lj('','popup_plup___environ_environ*build_'.$id,picto('get'));
$lk=lk(urlread($id),atc(''),picto('url'));
$lp=popart($id,'',suj_of_id($id));
//$ln=pane_art($id);
return divc('',$lp.' '.$lk.' '.$lj);}

function environ_build($id,$o){req('spe,art');//,mod,pop,tri
$ret=environ_art($id);
$ib=ib_of_id($id);
if($ib)$ret.=divc('',divc('txtcadr','parent').environ_art($ib));
$r=art_tags($id); //pr($r);
if($r)foreach($r as $k=>$v){
	foreach($v as $ka=>$va){$ret.=divc('txtcadr',$ka); $rb=tag_arts($ka,$k,7);
		if($rb)foreach($rb as $kb=>$vb)$ret.=environ_art($kb);}}
$r=art_opts($id); //pr($r);
foreach($r as $k=>$v){if(is_numeric($v)){$t=divc('txtcadr',$k); $d=environ_art($v);
	$ret.=divc('',$t.$d);}}
return $ret;}

function environ_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=environ_build($p,$o);
return $ret;}

function environ_menu($p,$o,$rid){
$ret.=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_environ_environ*j___inp',picto('reload')).' ';
return $ret;}

function plug_environ($p,$o){$rid='plg'.randid();
$bt=environ_menu($p,$o,$rid);
$ret=environ_build($p,$o);
return $bt.divd($rid,$ret);}

?>