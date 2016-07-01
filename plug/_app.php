<?php
//philum_plugin_model

class model{

static function build($p,$o){
list($p,$o)=ajxp($res,$p,$o);
//$r=msql_read_b('',nod('model_1'));//p($r);
$ret=$p.'-'.$o;
return $ret;}

static function menu($p,$o,$rid){$ret=inp('inp',$p).' ';
$ret.=lj('',$rid.'_app__2_model_build___inp',picto('reload')).' ';
//$cols='ib,val,to';//create table, name cols
//$ret.=lj('','popup_plupin___msqedit_model*1_'.$cols,picto('edit'));
return $ret;}

}

function plug_model($p,$o){$rid=randid('model');
$bt=model::menu($p,$o,$rid);
$ret=model::build($p,$o);
//$bt.=msqlink('',nod('model_1'));
return $bt.divd($rid,$ret);}

?>