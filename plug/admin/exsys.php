<?php
class exsys{

static function sys($p,$o,$prm=[]){if($prm)[$p,$o]=$prm;
//$p='mysqldump -h"'.$su.'" -u"'.$sn.'" -p"'.$pw.'" '.$db.' '.$file.' > '.$file.'.sql';
//$p='tar -zcvf /home/philum/users/philum/maj/philum140707.tar.gz /home/philum/_public';
if(auth(6))return exc($p);}

static function home($p,$o){$rid='plg'.$p;
$ret=inputb('param',$p,10,'',244,[]);
$ret.=lj('',$rid.'_exsys,sys_param',picto('ok'));
return $ret.divd($rid,$ret);}
}
?>