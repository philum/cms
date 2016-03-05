<?php
//philum_plugin_backup_msql

function plug_backup_msql(){require('plug/tar.php');
$f='plug/_data/msql_backup_'.date('ymd',time()).'.tar.gz'; //unlink($f);
$r=read_dir('msql'); //p($r);
if(auth(6))tar($f,$r);
if(is_file($f))return lkt('txtyl',$f,$f); else return 'brrrr';}

?>