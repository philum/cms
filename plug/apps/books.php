<?php
//philum_app_books

class books{
static $a=__CLASS__;

static function build($p,$o){
list($p,$o)=ajxp($res,$p,$o);
//$r=msql::read_b('',nod('books_1'));//p($r);
$ret=$p.'-'.$o;
return $ret;}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $bt.$ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_app__2_books_call___inp',picto('ok')).' ';
//$cols='ib,val,to';//create table, name cols
//$ret.=lj('','popup_plupin___msqedit_books*1_'.$cols,picto('edit'));
return $ret;}

static function home($p,$o){
$rid=randid(self::$a);
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('books_1'));
return $bt.divd($rid,$ret);}

}

function plug_books($p,$o){
return book::home($p,$o);}

?>