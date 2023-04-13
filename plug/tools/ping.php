<?php 
class ping{

static function call($p,$o,$prm=[]){
$ret=chrono('ok');
return $ret;}

static function home($p,$o){
chrono();
$ret=self::call($p,$o);
return $ret;}
}
?>