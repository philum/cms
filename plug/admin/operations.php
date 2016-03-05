<?php
//philum_plugin_operations

//plugin_func('operations','operations_build',$p,$o);
function operations_build($p,$o){reqp('mysql'); //$ret=$p.'-'.$o;
//$r=plugin('mysql',$p,$o); p($r);
$msq=new mysql('qda'); //echo $msq->b;
$msq->read('id,day','kv','frm="oaxiiboo 6" order by day ASC');
$r=$msq->ret; 
setlocale(LC_ALL,"fr_FR");

$dr=array('jan'=>'jan','fev'=>'feb','mars'=>'mar','avr.'=>'apr','mai'=>'may','juin'=>'jun','juil'=>'jul','août'=>'aug','sept'=>'sep','oct'=>'oct','nov'=>'nov','déc'=>'dec');

foreach($r as $k=>$v){$nb++;
//14.12.28 00.50 (122)
//$suj=date('y.m.d H.i',$v).' ('.$nb.')';
//20:41 - 19 juin 2015
$suj=date("H:i - d M Y",$v); 
//$suj=strftime("%R - %e %b %G",$v); 
//$suj=date('H:i - d m Y',$v).' ('.$nb.')';
$suj=strtolower($suj);
$suj=str_replace(array_values($dr),array_keys($dr),$suj);
$suj.=' ('.$nb.')';
echo $suj.br();
//$msq->update('suj',$suj,'id',$k);
}
//p($r);
return $ret;}

function operations_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);//$resultant des champs
$ret=operations_build($p,$o);
return $ret;}

function operations_menu($p,$o,$rid){
$ret=input(1,'inp',$p,'').' '.input(1,'ino',$o,'').' ';
$ret.=lj('',$rid.'_plug__2_operations_operations*j___inp|ino',picto('reload')).' ';
return $ret;}

//plugin('operations',$p,$o)
function plug_operations($p,$o){$rid='plg'.randid();
$ret=operations_menu($p,$o,$rid);
return $ret.divd($rid,operations_j($p,$o));}
//$ret.=msqlink('',ses('qb').'_operations').' ';

?>