<?php //sticky

function popup_stick($d){
return div(atd('popu').ats('width:320px; background-color:#ffd500; color:#000; padding:4px;'),$d);}

function plug_sticky($d){$d=$d!=''?$d:1; $id='np'.randid(); $ret=hidden('cka','m'.$d);
//$ret.=ljb('popbt" id="ckc','mem_storage',$id.'_m'.$d.'__1_ckc','save');
//$ret.=ljb('popbt" id="ckb'.$d,'mem_storage',$id.'_m'.$d.'_1_1_ckb'.$d.'_memnu','restore');
$ret.=ljb('" id="ckc','mem_storage',$id.'_cka__1_ckc',picto('save')).' ';
$ret.=ljb('" id="ckb','mem_storage',$id.'_m'.$d.'_1_1_ckb'.$d,picto('reload')).' ';
//$ret=divs('float:right;',$ret);
$ret.=divedit($id,'','height:240px; overflow-x:hidden; overflow-y:auto; padding:10px;',$j,$txt);
$ret.=jscode('document.getElementById(\''.$id.'\').innerHTML=localStorage[\'m'.$d.'\']');
return popup_stick($ret);}

?>