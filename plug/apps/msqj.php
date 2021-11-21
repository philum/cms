<?php
//philum_app

class msqj{

static function build($p,$o){
list($dr,$nd)=split_right('|',$p);
return msql::json($dr,$nd);}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
return self::build($p,$o);}

static function home($p,$o){
return $ret=self::build($p,$o);}
}

function plug_msqj($p,$o){
return msqj::home($p,$o);}

?>