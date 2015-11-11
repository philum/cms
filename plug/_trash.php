<?php
//troc

/*function radioj($r,$h,$rid){foreach($r as $k=>$v)$ret.=lj($k==$h?'active':'',$rid.'_call____radioj_'.ajx($k).'_'.ajx($v),$k); return $ret;}*/
//function radio_j($r,$h){$rid='radioj'.randid(); return divd($rid,radioj($r,$h,$rid));}

//trans
function troc_trtype($rid,$h,$id){$r=troc_transtype();
foreach($r as $k=>$v)$ret.=ljb($k==$h?'txtx':'txtblc','radioj',$rid.'\',\''.$v.'\',\''.$rid.'_plug___troc_troc*trtype*sav_'.$id.'_'.$rid.'-'.ajx($k),$k).' ';
return $ret;}
function troc_trtype_sav($id,$po){
list($rid,$v)=explode('-',$po); //echo $id.'_'.$v;
if($id && $v)update('prop','attr',$v,'id',$id);
return troc_trtype($rid,$v,$id);}

function troc_transaction($v,$id){
//$ret=select_j('inp','pfunc',$v,'troc/troc_transtype','select...','1');
//$ret.=togbub('plug','troc_troc*trtype',btn('popbt','select...'));
//$ret.=input(1,'inp',$v,'').' ';
//$ret.=divb('popbt|inp',$v).' ';
//$ret.=lj('','inp_plug__2_troc_troc*j___inp',picto('reload')).' ';
$rid='radioj'.randid(); //echo $id.'_'.$v;
$ret=btd($rid,troc_trtype($rid,$v,$id)); //echo $id;
$ret.=select_j('inp','pfunc',$v,'troc/troc_transtype',$v,'0');
//radio_j($r,$v,$rid);
return $ret;}


#props
/*function troc_prop($id,$rid){
return $ret;}*/

//propriétés de base
//$props=array(array($id,'transaction',''),array($id,ses('price'),''));
//if($id)insert('prop',mysqlrb($props)); 
//else return troc_add($rid);
//
/*function troc_define_obj($rid){
$ret=divc('',lj('popbt',$rid.'_plug___troc_troc*create*obj_'.$rid,pictxt('add','Nouveau Troc')));
return divc('form',$ret);}*/
//add obj
/*function troc_add($rid){
$ret=divc('',lj('popbt',$rid.'_plug___troc_troc*create*obj_'.$rid,pictxt('add','Nouveau Troc')));
return divc('form',$ret);}*/

?>