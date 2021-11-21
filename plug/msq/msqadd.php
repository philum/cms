<?php
//philum_plugin_msqadd
#add an entry to a table

class msqadd{
static function build($p,$o,$res){
list($p,$msg)=ajxp($res,$p,$o);
$dfb['_menus_']=array('day','text');
$nod=nod($p); $rb=explode(',',$msg);
$r=msql::modif('',$nod,$rb,'push',$dfb);
$bt=msqbt('users',$nod);
return $bt.self::read($p);}

static function read($p){
$r=msql::read('',nod($p),'',1);
return tabler($r,1,1);}

static function call($p,$o){$p=$p?$p:'1';
$bt=input('nod','nod','',1).' ';
$bt.=lj('txtbox','cbk_msqadd,build___'.ajx($p).'____nod|txt','add').br();
$bt.=textarea('txt','',60,10).br();
$ret=self::read($p);
return $bt.divd('cbk',$ret);}
}

function plug_msqadd($p,$o){
return msqadd::call($p,$o);}

?>