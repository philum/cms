<?php
//philum_plugin_html

//plugin_func('html','html_build',$p,$o);
function html_build($p,$o){
$ret=$p;
return $ret;}

function html_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=html_build($p,$o);
return $ret;}

function html_menu($p,$o,$rid){
$j=$rid.'_plug__2_html_html*j___inp'; $sj='SaveJ(\''.$j.'\')';
$ret=divc('" onkeyup="'.$sj.'" onclick="'.$sj,txarea('inp',$p,60,10,atc('console'))).' ';
//$ret.=lj('',$j,picto('reload'));
return $ret;}

//plugin('html',$p,$o)
function plug_html($p,$o){$rid='plg'.randid();
$ret=html_menu($p,$o,$rid);
return $ret.divd($rid,html_j($p,$o));}
//$ret.=msqlink('',ses('qb').'_html').' ';

?>