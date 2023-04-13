<?php 
class rssurl{
static function home(){
$r=msql::read('',nod('rssurl'),'',1);
foreach($r as $k=>$v)$rt[$v[2]][]=divb($v[0]);
return tabs($rt);}
}
?>