<?php //dbdoc

function dbdoc_build($p,$o){
$f='users/dav/WaletHumm.html';
$w=100000; $start=$p*$w;
echo $bt=btn('txtyl',$p);
//$d=file_get_contents($f);
//echo array_sum(count_chars($d));
$d=file_get_contents($f,NULL,NULL,$start,$w);
$ret=$d;
//$ret=conv::call($d);
//$ret=textarea('',$rets,44,8);
return $ret;}

function dbdoc_j($p,$o,$res=''){

[$p,$o]=ajxp($res,$p,$o);
$ret=dbdoc_build($p,$o);
return $ret;}

function dbdoc_menu($p,$o,$rid){
//$ret.=togbub('plug','dbdoc_dbdoc*r',btn('popbt','select...'));
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_dbdoc_dbdoc*j___inp',picto('ok')).' ';
$nb=5653807; $sz=100000; $n=$nb/$sz;
for($i=0;$i<$n;$i++)$ret.=lj('',$rid.'_plug__3_dbdoc_dbdoc*j_'.$i,$i).' ';
return divc('nbp',$ret);}

function plug_dbdoc($p,$o){$rid=randid('plg');
$bt=dbdoc_menu($p,$o,$rid);
//$ret=dbdoc_build($p,$o);
return $bt.divd($rid,$ret);}

?>