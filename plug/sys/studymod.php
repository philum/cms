<?php 
class studymod{

static function home($p,$o){
$r=msql::read('',nod('study_'.ses('read')),'');
if(isset($r[1]))$ret=lj('','popup_study,call___'.ses('read'),pictxt('study',nms(175)));
if(isset($ret))return btn('txtx',$ret);}
}
?>