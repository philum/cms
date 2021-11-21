<?php
//philum_plugin_svgjs

//plugin_func('svgjs','svgjs_build',$p,$o);
function svgjs_build($p,$o){//$ret=js_code('cree_rectangle(event)');
return bal('svg',atb('xmlns','http://www.w3.org/2000/svg').atb('xmlns:xlink','http://www.w3.org/2000/svg').atb('onload','cree_rectangle(evt)'),$ret);}

function svgjs_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=svgjs_build($p,$o);
return $ret;}

function svgjs_menu($p,$o,$rid){$ret=textarea('inp',$p,40,4).' ';
$ret.=lj('',$rid.'_plug__2_svgjs_svgjs*j___inp',picto('ok')).' ';
return $ret;}

//plugin('svgjs',$p,$o)
function plug_svgjs($p,$o){$rid='plg'.randid();
//Head::add('js','/js/svg.min.js');
Head::add('js','/js/svg.js');
//$js="var draw = SVG('drawing').size(300, 300); var rect = draw.rect(100, 100).attr({ fill: '#f06' })";
//$js='cree_rectangle(event);';
//$_SESSION['onload']=$js;
//Head::add('jscode',$js);
$ret=svgjs_menu($p,$o,$rid);
return $ret.divd($rid,svgjs_j($p,$o));}
//$ret.=msqbt('',ses('qb').'_svgjs').' ';

?>