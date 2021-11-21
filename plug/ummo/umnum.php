<?php
//philum_plugin_umnum

function umnum_search($p,$o,$res=''){
$d=sql('msg','qdm','v','id='.$p);
$r=str_split($d);
foreach($r as $k=>$v){
	if(is_numeric($vb))$ret[$i].=$vb;
	else $i++;}
return tabler($ret);}

function umnum_build($p,$o){
$r=msql::row('',nod('umnum'),$p,1);
return tabler($r);}

function umnum_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=umnum_build($p,$o);
return $ret;}

function umnum_menu($p,$o,$rid){$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_umnum_umnum*j___inp',picto('ok')).' ';
$ret.=lj('','popup_plupin___msqedit_umnum*1_num,val,art',picto('edit')).' ';
return $ret;}

function plug_umnum($p,$o){$rid=randid('plg');
$bt=umnum_menu($p,$o,$rid);
//$ret=umnum_build($p,$o);
$bt.=msqbt('',nod('umnum'));
return $bt.divd($rid,$ret);}

?>