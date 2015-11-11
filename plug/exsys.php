<?php
//philum_plugin_exsys

function sys($p='',$o='',$res=''){if($res)list($p,$o)=ajxr($res);
//$p='mysqldump -h"'.$su.'" -u"'.$sn.'" -p"'.$pw.'" '.$db.' '.$file.' > '.$file.'.sql';
//$p='tar -zcvf /home/philum/users/philum/maj/philum140707.tar.gz /home/philum/_public';
if(auth(6))return exc($p);}

function plug_exsys($p,$o=''){$rid='plg'.$p;
$ret.=autoclic('param',$p,10,244,'',1).' ';
$ret.=lj('',$rid.'_plug___exsys_sys___param',picto('reload'));
return $ret.divd($rid,plugin($plg,$p,$o));}

?>