<?php
//philum_plugin_notepad

function np_j($id){return 'mem_storage(\''.$id.'_m'.$d.'_1_1\')';}

function pad_write($p,$o,$res){$pad='pad'.ses('USE').date('ymd');
$f='plug/_data/'.$pad.'.txt'; write_file($f,ajxg($res)); return lkt('popbt',root().$f,$pad);}

//$ret.=ljb($c,'mem_storage',$id.'_'.$i.'_1_1_ckb',$i);
//$ret.=lj($c,'np_plug__2_notepad_plug*notepad_'.$i,$i+1);
function np_sav($d,$id){$ret=hidden('','cka','m'.$d);
for($i=1;$i<=9;$i++){$c=$i==$d?'active':'';
	$ret.=ljb(''.$c.'" id="ckb'.$i,'mem_storage',$id.'_m'.$i.'_1_1_ckb'.$i.'_memnu',$i);}
$ret.=ljb('" id="ckc','mem_storage',$id.'_cka__1_ckc',nms(57));
$ret.=lj('','popup_plup___pad_pad*write___'.$id.'',picto('export'));
return divc('nb_pages',divd('memnu',$ret.hlpbt('memstorage')));}

function plug_pad($d){
Head::add('csscode','
#content{width:100%;}
.tab{font-size:large; border:0; margin:4px auto; padding:16px; min-width:440px; max-width:90%; line-height:1.2em; min-height:400px; max-height:90vh;}');
$d=$d?$d:2; $id='np'.randid(); 
$ret.=np_sav($d,$id);
$ret.=divedit($id,'tab justy','',$j,$txt);
$_SESSION['onload']='document.getElementById(\''.$id.'\').innerHTML=localStorage[\'m'.$d.'\']';
//$_SESSION['onload']='mem_storage(\''.$id.'_m'.$d.'_1_1_ckb\');';
return divd('np',$ret);}

?>