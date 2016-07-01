<?php
//philum_plugin_social

function social_com($p,$o){list($p,$o)=ajxr($res);
return $ret;}

function social_j($p,$o,$res=''){list($p,$o)=ajxp($res,$p,$o);
return $p;}

//plugin('social',$p,$o)
function plug_social($p,$o){$rid='plg'.randid();
$j=$rid.'_plug__2_social_social*j___txtareb'; $sj='SaveJ(\''.$j.'\')';
$ret.=input(1,'search',$p,'').' ';
$ret.=txarea('txtareb',$p,61,18,atc('console').atb('onkeyup',$sj).atb('onclick',$sj));
$ret.=lj('',$j,picto('reload')).' ';
//$ret.=msqlink('clients',ses('qb').'_social').' ';
return $ret.divd($rid,social_j($p,$o));}

?>