<?php
//philum_plugin_model

function model_build($p,$o){
$r=msql_read('',nod('model'),$p);
return tabler($r);}

function model_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=model_build($p,$o);
return $ret;}

function model_r(){//option/value
return ['aa'=>'a','bb'=>'b'];}

function model_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','model/model_r','','2');
//$ret.=togbub('plug','model_model*r',btn('popbt','select...'));
$j=$rid.'_plug__2_model_model*j__'.$rid.'_inp';
$ret.=inputj('inp',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
//$ret.=lj('','popup_plupin___msqedit_model*1_id,val',picto('edit')).' ';
return $ret;}

function plug_model($p,$o){$rid=randid('plg');
$bt=model_menu($p,$o,$rid);
$ret=model_build($p,$o);
//$bt.=msqbt('',nod('model'));
return $bt.divd($rid,$ret);}

?>