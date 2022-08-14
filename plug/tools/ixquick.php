<?php //ixquick

//$sty='" onkeypress="checkEnter(event,\'ixq\')';
function plug_ixquick($a,$b,$d=''){$d=ajxg($d); $ret.=input1('furl',$d,'','search');
$ret.=lj('txtbox','popup_plug__x_ixquick_plug*ixquick__760_furl',picto('search')).br();
$f='https://ixquick.com/do/search?q='.$d.'&l=francais';
if($d)$ret=iframe($f.'§740/500');
//if($d)$ret=read_file($f);
return $ret;}

?>