<?php
//philum_plugin_poll

//plugin_func('poll','poll_build',$p,$o);
function poll_build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

function poll_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=poll_build($p,$o);
return $ret;}

function poll_r(){
return array('aa'=>'a','bb'=>'b');}

function poll_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','poll/poll_r','','2');
//$ret.=togbub('plug','poll_poll*r',btn('popbt','select...'));
$ret.=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_poll_poll*j___inp',picto('reload')).' ';
return $ret;}

//plugin('poll',$p,$o)
function plug_poll($p,$o){$rid='plg'.randid();
$bt=poll_menu($p,$o,$rid); $ret=poll_j($p,$o);
//$bt.=msqlink('',ses('qb').'_poll');
return $bt.divd($rid,$ret);}

?>