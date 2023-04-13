<?php //add an entry to a table
class msqadd{
static function build($p,$o,$prm){
[$p,$o]=prmp($prm,$p,$o);
$dfb['_menus_']=['day','text'];
$nod=nod($p); $rb=explode(',',$msg);
$r=msql::modif('',$nod,$rb,'push',$dfb);
$bt=msqbt('users',$nod);
return $bt.self::call($p);}

static function call($p){
$r=msql::read('',nod($p),'',1);
return tabler($r,1,1);}

static function home($p,$o){$p=$p?$p:'1';
$bt=inputb('nod','nod','',1).' ';
$bt.=lj('txtbox','cbk_msqadd,build_nod,txt__'.ajx($p),'add').br();
$bt.=textarea('txt','',60,10).br();
$ret=self::call($p);
return $bt.divd('cbk',$ret);}
}
?>