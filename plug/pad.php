<?php
//philum_plugin_notepad

function np_j($id){return 'mem_storage(\''.$id.'_m'.$d.'_1_1\')';}

//$ret.=ljb($c,'mem_storage',$id.'_'.$i.'_1_1_ckb',$i);
//$ret.=lj($c,'np_plug__2_notepad_plug*notepad_'.$i,$i+1);
function np_sav($d,$id){$ret=hidden('','cka','m'.$d);
for($i=1;$i<=9;$i++){$c=$i==$d?'active':'';
	$ret.=ljb($c.'" id="ckb'.$i,'mem_storage',$id.'_m'.$i.'_1_1_ckb'.$i.'_memnu',$i);}
$ret.=ljb('" id="ckc','mem_storage',$id.'_cka__1_ckc','save');
return div(atc('nbp').atd('memnu'),$ret.hlpbt('memstorage'));}

function plug_pad($d){
Head::add('csscode','
#content{width:100%;}
.tab{font-size:large; border:0; margin:4px auto; padding:16px; width:90vw; height:80vh; overflow-y:auto; line-height:1.2em;}');
$d=$d?$d:2; $id='np'.randid(); 
$ret.=np_sav($d,$id).br();
$ret.=divedit($id,'tab justy','',$j,$txt);
$_SESSION['onload']='document.getElementById(\''.$id.'\').innerHTML=localStorage[\'m'.$d.'\']';
//$_SESSION['onload']='mem_storage(\''.$id.'_m'.$d.'_1_1_ckb\');';
return divd('np',$ret);}

?>