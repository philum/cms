<?php
//philum_plugin_htaccess
session_start();
error_reporting(6135);
//if(!function_exists('p'))require('prog/lib.php');

function htaccess_update(){
$txt=msql_read('system','default_htaccess',1);
$ok=write_file('.htaccess',$txt);
if($ok)return btn('txtyl',$ok).' '.hlpbt('htaccess');
return btn('txtyl',lkc('txtx','/?admin=htaccess','admin/htaccess'));}

function htaccess_mkdefault($var1,$var2,$res){$rb=ajxr($res);
$r=msql_modif('system','default_htaccess',$rb,$dfb,'one',1);
return btn('txtyl','saved');}

function htaccess_default(){
return stripslashes(msql_read('system','default_htaccess',1));}

function htaccess_j($var1,$var2,$res){
list($txt)=ajxr($res);
$ok=write_file('.htaccess',$txt);
if($ok)return btn('txtyl',$ok).' '.hlpbt('htaccess');
return lkc('txtyl','.htaccess','saved');}

function plug_htaccess($d){$here='htaccess';
$default=msql_read('system','default_htaccess',1);
$actual=read_file('.'.$here);
if(!$actual or $d){$actual=$default; $ret.=btn('txtyl','default_loaded').br();}
$ret.=picto('alert§24').' '.btn('txtcadr','critical_operations').' ';
$ret.=lj('txtbox','txt_plug__4_'.$here.'_'.$here.'*default','default').' ';
$ret.=lj('txtbox','cbk_plug__xd_'.$here.'_'.$here.'*mkdefault___txt','backup').' ';
$ret.=msqlink('system','default_htaccess').' ';
$ret.=lkc('txtx','.htaccess','link').' ';
$ret.=hlpbt('htaccess').' '.btd('cbk','').' ';
$ret.=btd('bts',lj('txtbox','cbk_plug__xd_'.$here.'_'.$here.'*j___txt','save')).br().br();
$ret.=txarea('txt',$actual,120,26).br();
$ret.=lkt('txtblc','http://htaccess.madewithlove.be/','tests');
return $ret;}

?>