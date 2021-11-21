<?php
//philum_plugin_snifr

function snifr_header($rid){
Head::add('jscode','
var lapsetime=60000;
function twlive(e){var inp=getbyid("inp").value;
	SaveJ("'.$rid.'_app__14_twit_call_"+inp);
	setTimeout("twlive()",lapsetime);}
setTimeout("twlive()",10);//
');}

function snifr_build($p,$o){
$ret=twit::call($p,$o);
return $ret;}

function snifr_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=snifr_build($p,$o);
return $ret;}

function snifr_menu($p,$o,$rid){
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_snifr_snifr*j___inp',picto('ok')).' ';
return $ret;}

function plug_snifr($p,$o){$rid=randid('plg');
snifr_header($rid);
$bt=snifr_menu($p,$o,$rid);
$ret=snifr_build($p,$o);
//$bt.=msqbt('',nod('snifr'));
return $bt.divd($rid,$ret);}

?>