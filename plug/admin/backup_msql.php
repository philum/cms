<?php
//philum_plugin_backup_msql

function plug_backup_msql(){reqp('tar');
$f='_backup/msql/'.date('ymd',time()).'.tar.gz'; //unlink($f);
$r=tar::scan('msql'); //p($r);
if(auth(6))tar::folder($f,$r);
if(is_file($f))return lkt('txtyl',$f,$f); else return 'brrrr';}

?>