<?php 
class color{
static function call($p,$o,$prm=[]){
$r=msql::read('system','edition_colors','','1');
foreach($r as $k=>$v){$ret.=divs('background-color:#'.$v,$k);}
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=msqbt('','system/edition_colors');
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>