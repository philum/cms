<?php
//philum_plugin_model

function model_build($p,$o){
$ret=$p.'-'.$o;
return $ret;}

function model_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=model_build($p,$o);
return $ret;}

function model_r(){
return array('aa'=>'a','bb'=>'b');}

function model_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','model/model_r','','2');
//$ret.=togbub('plug','model_model*r',btn('popbt','select...'));
$ret.=inp('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_model_model*j___inp',picto('reload')).' ';
return $ret;}

function plug_model($p,$o){$rid=randid('plg');
$bt=model_menu($p,$o,$rid);
$ret=model_build($p,$o);
//$bt.=msqlink('',nod('model'));
return $bt.divd($rid,$ret);}

?>