<?php
//philum_app_know

class know{

static function build($p,$o){
list($p,$o)=ajxp($res,$p,$o);
//$r=msql::read_b('',nod('know_1'));//p($r);
$ret=$p.'-'.$o;
return $ret;}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $bt.$ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_app__2_know_call___inp',picto('ok')).' ';
$cols='nfo,ref,url';//create table, name cols
$ret.=lj('','popup_plupin___msqedit_know*1_'.$cols,picto('edit')).' ';
return $ret;}

static function home($p,$o){$rid=randid('know');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
$bt.=msqbt('',nod('know_1'));
return $bt.divd($rid,$ret);}

}

function plug_know($p,$o){
return know::home($p,$o);}

?>