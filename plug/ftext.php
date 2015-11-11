<?php
//philum_plugin_stext
session_start();

function stext_log(){return $_SESSION['auth']>6?$_SESSION['qb']:'public';}

function ftext_j($n,$b,$res){$nd=stext_log(); $rb=ajxr($res);
$ra=array(mkday(),html_entity_decode_b($rb[0])); //p($ra);
msql_modif('users',$nd.'_txt_'.$n,$ra,'','one',1);
return btn('txtyl','ok');}

function plug_ftext($d,$tx){$nd=stext_log();
$ra=msql_read('',$nd.'_txt_ftxt','1');
$msg=stripslashes($ra[1]); $msg=html_entity_decode_b($msg);
if(!$ra && $nd)msql_modif('users',$nd.'_txt_ftxt',array('day','text'),'','one',1);
$ret.=btd('bts',lj('','bck_plug__xd_ftext_ftext*j_ftxt__ftxt',picto(save))).' ';
$ret.=btd('bck','').hlpbt('ftext').br();
if(!$tx)$ret.=txarea('ftxt',$msg,54,12);
return btd('plgtxt',$ret);}

?>