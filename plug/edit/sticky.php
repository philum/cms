<?php 
class sticky{

static function js($id,$n=2){
return 'document.getElementById(\''.$id.'\').innerHTML=localStorage[\'m'.$n.'\']';}

static function home($n){$n=$n?$n:1; $id='np'.randid(); $ret=hidden('cka','m'.$n);
$ret.=ljb('popbt','mem_storage',$id.'_m'.$n.'__1_ckc','save',atd('ckc'));
$ret.=ljb('popbt','mem_storage',$id.'_m'.$n.'_1_1_ckb'.$n.'_memnu','restore',atd('ckb'.$n));
//$ret.=ljb('','mem_storage',$id.'_cka__1_ckc',picto('save'),atd('ckc')).' ';
//$ret.=ljb('','mem_storage',$id.'_m'.$n.'_1_1_ckb'.$n,picto('reload'),atd('ckb')).' ';
$ret.=divedit($id,'','height:240px; overflow-x:hidden; overflow-y:auto; padding:10px;','','');
$ret.=jscode(self::js($id,$n));
return div(atd('popu').ats('width:320px; background-color:#ffd500; color:#000; padding:4px;'),$ret);}
}
?>