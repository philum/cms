<?php
//philum_plugin_iframe
function plug_iframe($d,$s,$siz=''){
$s=$siz?str_replace('-','/',$siz):$s;
return iframe($d.'§'.($s?$s:'720/500'));}
?>