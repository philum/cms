<?php 
class ixquick{
static function home($a,$b,$prm=[]){$d=$prm[0]??$a;
//$sty='" onkeypress="checkEnter(event,\'ixq\')';
$ret=input('furl',$d,'','search');
$ret.=lj('txtbox','popup_ixquick,home_furl_x_760',picto('search')).br();
$f='https://ixquick.com/do/search?q='.$d.'&l=francais';
if($d)$ret=iframe($f.'§740/500');
//if($d)$ret=read_file($f);
return $ret;}
}
?>