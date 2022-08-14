<?php //arts

function arts_j($p,$o,$res=''){
[$p,$o]=ajxp($res,$p,$o);
$r=['articles',$p,'Articles','','multi',''];
ses('nl');
$ret=mod::mkmods($r);
sesz('nl');
return $ret;}

function plug_arts($p,$o){$rid='plg'.randid();
Head::add('csslink','/css/'.ses('qb').'_design_'.ses('prmd'));
$p=$p?$p:'nbdays=2&preview=auto';//priority=>1&priority=<4
$ret.=input1('params',$p,30).' ';
$ret.=lj('',$rid.'_plug__3_arts_arts*j__nl_params',picto('ok')).' ';
return divd('page',$ret.divd($rid,divd('content',arts_j($p,'',''))));}

?>