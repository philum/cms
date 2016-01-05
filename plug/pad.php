<?php
//philum_plugin_notepad

function np_j($id){return 'mem_storage(\''.$id.'_m'.$d.'_1_1\')';}

//$ret.=ljb($c,'mem_storage',$id.'_'.$i.'_1_1_ckb',$i);
//$ret.=lj($c,'np_plug__2_notepad_plug*notepad_'.$i,$i+1);
function np_sav($d,$id){$ret=hidden('','cka','m'.$d);
for($i=1;$i<=9;$i++){$c=$i==$d?'active':'';
	$ret.=ljb($c.'" id="ckb'.$i,'mem_storage',$id.'_m'.$i.'_1_1_ckb'.$i.'_memnu',$i);}
$ret.=ljb('" id="ckc','mem_storage',$id.'_cka__1_ckc','save');
return span(atc('nbp').atd('memnu'),$ret).hlpbt('memstorage');}

function plug_pad($d){
$d=$d?$d:2; $id='np'.randid(); 
$ret.=np_sav($d,$id).br();
$sty='font-size:large; border:1px dotted grey; margin:4px; padding:16px; min-width:320px; max-width:96%; min-height:220px; height:86%; overflow-y:auto;';
$ret.=divedit($id,'panel justy',$sty,$j,$txt);
$_SESSION['onload']='document.getElementById(\''.$id.'\').innerHTML=localStorage[\'m'.$d.'\']';
//$_SESSION['onload']='mem_storage(\''.$id.'_m'.$d.'_1_1_ckb\');';
return divd('np',$ret);}

?>