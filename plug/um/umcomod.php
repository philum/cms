<?php //umcomod
class umcomod{
static function call($p,$o){
$p=$p?$p:ses('read');
$d=sql('frm','qda','v','id='.ses('read'));
$r=['Oaxiiboo 6','Oolga Waam','Oomo Toa','Oyagaa Ayoo Yissaa'];
if(in_array($d,$r))$ret=lj('','popup_umcom,call___'.$p,pictxt('cube',$p));
if(isset($ret))return btn('txtx',$ret);}
static function home($p,$o){return self::call($p,$o);}
}
?>