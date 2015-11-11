<?php
//philum_plugin_ajxtst
session_start();

function plug_ajxtst($a,$b){$f='/ajax.php?callj='.$a.'$nom='.$b; //echo $f;
//return read_file($f);
//echo date('ymd',$_SESSION['daya']);
return iframe($f,640);
}

?>