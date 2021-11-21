<?php
//philum_plugin_studymod

function plug_studymod($p,$o){
$r=msql_read('',nod('study_'.ses('read')),'');
if(isset($r[1]))$ret=lj('','popup_plup___study_study*j_'.ses('read'),pictxt('study',nms(175)));
if(isset($ret))return btn('txtx',$ret);}

?>