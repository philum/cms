<?php
//philum_plugin_read

function plug_read($p){if(!$p)return;
req('art,pop,tri,spe');
sesone('nl','nl');
$ret=art_read_b($p,'','3','');
sesone('nl','');
return $ret;}

?>