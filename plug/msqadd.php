<?php
//philum_plugin_msqadd
session_start();
#fr:sert à ajouter une entrée à une table
#eng:used to add an entry to a table

function msqadd_j($p,$o,$res){
list($p,$msg)=ajxp($res,$p,$o);
$dfb['_menus_']=array('day','text');
$nod=ses('qb').'_msqadd_'.$p;
if($msg)$rb=array(mkday(),$msg);
//if($rb)$r=msql_modif('users',$nod,$rb,$dfb,'push','');
if($rb)$r=modif_vars('users',$nod,$rb,'push',$dfb);
$bt=msqlink('users',$nod);
return lj('popbt','plugmsqadd_plug___msqadd_msqadd*read_'.ajx($p),'reload').' '.$bt;}

function msqadd_read($p){
$r=msql_read('',ses('qb').'_msqadd_'.$p,'',1);
return make_table($r,'txtblc','txtx');}

function plug_msqadd($p,$o){$p=$p?$p:'1';
$bt.=balisb('input',array(1=>'text',3=>'nod',4=>$p,7=>1000,16=>'padding:4px;'),'').' ';
$bt.=lj('txtbox','cbk_plug___msqadd_msqadd*j_'.ajx($p).'__nod|txt','save').' ';
$bt.=btd('cbk','').br();//callback
$bt.=txarea('txt','',60,10,'" style="font-size:medium; padding:4px; width:340px; height:300px;').br();
$ret=msqadd_read('msqadd_'.$p);
return $bt.divd('plugmsqadd',$ret);}

?>