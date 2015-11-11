<?php
//philum_plugin_dirsize
session_start();
error_reporting(6135);
if(!function_exists('p'))require('../progb/lib.php');

function plug_dirsize($p){$dr=$p; $r=explore($dr,'files',1);
if($r)foreach($r as $k=>$v)if($v!='_trash.php')$ret+=filesize($dr.'/'.$v);
return round($ret/1024);}

?>