<?php
//philum_plugin_umcomod

function plug_umcomod($p,$o){$p=$p?$p:ses('read');
$d=sql('frm','qda','v','id='.ses('read'));
$r=['Oaxiiboo 6','Oolga Waam','Oomo Toa','Oyagaa Ayoo Yissaa'];
if(in_array($d,$r))$ret=lj('','popup_plupin___umcom_'.$p,pictxt('cube',$p));
if(isset($ret))return btn('txtx',$ret);}

?>