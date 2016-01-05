<?php
//philum_plugin_color
function color_j($p,$o,$res=''){
$r=msql_read('system','edition_colors','','1');
foreach($r as $k=>$v){$ret.=divs('background-color:#'.$v,$k);}
return $ret;}

function plug_color($p,$o){$rid='plg'.randid();
$ret=color_j($p,$o);
$bt.=msqlink('','system/edition_colors');
return $bt.divd($rid,$ret);}

?>