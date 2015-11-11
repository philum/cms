<?php
//philum_plugin_msqads
session_start();
error_reporting(6135);

function msqads_j($p,$o,$res){$r=ajxr($res);//form
reqp('msql'); $msq=new msql();
$msq->def('',$p?$p:'msqads');
$msq->load();//$msq->format($r);
$msq->modif('add','',$r);
$msq->save();//p($msq->ret);
return make_table(msq_invert($msq->ret),'txtblc','txtx');}

function plug_com($p,$o){$rid='plg'.$p.$o;
if($res)list($p,$o)=ajxr($res);
$ret.=lj('','pop_plupin___msqads____p|o',picto('reload')).' ';
$ret.=autoclic('p',$p?$p:'param',10,244,'',1);
$ret.=autoclic('o',$o?$o:'option',10,244,'',1);
return $ret;}

function plug_msqads($p,$o){$rid='plg'.randid(); $p=$p?$p:'msqads';
reqp('msql'); $msq=new msql('',$p);//table
$rb=array('day','quest','resp'); $msq->create($rb);
$ret.=input(1,$rb[0],$rb[0],'',1).br().txarea($rb[1],'',40,4).txarea($rb[2],'',40,4);
$ret.=lj('txtbox',$rid.'_plug___msqads_msqads*j_'.$p.'__'.implode('|',$rb),'save').' ';
$ret.=msqlink('users',ses('qb').'_'.$p);
$msq->read('i');
return $ret.divd($rid,make_table($msq->ret,'txtblc','txtx'));}

?>