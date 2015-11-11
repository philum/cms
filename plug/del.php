<?php
//philum_plugin_delfiles
session_start();
ini_set('display_errors','1');
error_reporting(6135);//E_ALL//

function delj($p,$o,$res){list($f)=ajxr($res);
if(!auth(7))return 'no';
if($p=='file')if(is_file($f))unlink($f); else return 'error';
if($p=='dir' && $f && strpos($f,'/')!=false)if(is_dir($f))rmdir_r($f); else return 'error';//rmdir($d);
return btn('txtyl',$p.' '.$f.': deleted');}

function del_com($p,$o){$rid='plg'.randid(); $id='del'.$o;
$ret.=autoclic($id,$p?$p:$o,44,1000,'',1);
$ret.=lj('popsav',$rid.'_plug__xd_del_delj_'.$o.'__'.$id,'delete').' ';
$ret.=btd($rid,'').br();
return $ret;}

function plug_del($f,$d){
if($res)list($p,$o)=ajxr($res);
return del_com($f,'file').del_com($d,'dir');}

?>