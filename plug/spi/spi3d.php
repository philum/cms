<?php //spi3d
class spi3d{
static function build($p,$o){
$f='http://logic.ovh/frame/scene/'.$p;//17,18
$ret=iframe($f,'',600);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function home($p,$o){$rid=randid('plg');
$p=$p?$p:17;//18
$bt=lk('/app/spt',picto('filelist'));
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('spi3d'));
return $bt.divd($rid,$ret);}
}
?>