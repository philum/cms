<?php
//philum_plugin_travelart

function plug_travel($d,$id){req('pop');
//http://w41k.info/plug/rss1.php?read=74453&preview=full
$ret=rss_read($d);
return $ret;}

?>