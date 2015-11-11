<?php
//philum_clrset
session_start();
require('../prog/lib.php');
require('../prog/styl.php');

function clrpckr_js_r(){$f='../js/colorpicker/';
$r[]['css']=$f.'css/colorpicker.css';
$r[]['css']=$f.'css/layout.css';
$r[]['js']=$f.'js/jquery.js';
$r[]['js']=$f.'js/colorpicker.js';
$r[]['js']=$f.'js/eye.js';
$r[]['js']='../prog/ajx.js';
$r[]['js']='../prog/utils.js';
$r[]['jscode']=clrpckr_layout();
return $r;}

$r=clrpckr_js_r();
$r[]['css']='../css/_global.css';
$r[]['css']='../css/_admin.css';
	$rhead[]['js']='../prog'.$g.'/ajx.js';
$r[]['js']='../js/live.js#css';
echo headers_r('css_builder',$r);
echo div('panel',f_inp_clr_manage_j());
?>