<?php
//philum_clrset
session_start();
require('../'.prog().'/lib.php');
require('../'.prog().'/styl.php');

function clrpckr_js_r(){$f='../js/colorpicker/';
Head::add('csslink',$f.'css/colorpicker.css');
Head::add('csslink',$f.'css/layout.css');
Head::add('csslink',$f.'js/jquery.js');
Head::add('jslink',$f.'js/colorpicker.js');
Head::add('jslink',$f.'js/eye.js');
Head::add('jslink','../'.prog().'/ajx.js');
Head::add('jslink','../'.prog().'/utils.js');
Head::add('jscode',clrpckr_layout());}

Head::add('tag',['title','css_builder']);
clrpckr_js_r();
Head::add('jslink','../css/_global.css');
Head::add('jslink','../css/_admin.css');
Head::add('jslink','../prog'.$g.'/ajx.js');
Head::add('jslink','../js/live.js#css');
echo Head::get();
echo divc('panel',form_clr_manage_j());
?>