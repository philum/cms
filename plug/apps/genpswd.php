<?php
//philum_plugin_genpswd

class genpswd{

function build($p,$o){
$a='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; if($o==1)$a.='$£%*µ,?;.:/!&#{[-|_)]=}+';
$r=str_split($a); $n=count($r)-1;
for($i=0;$i<$p;$i++)$ret.=$r[rand(0,$n)];
return $ret;}

function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $ret;}

function menu($p,$o,$rid){
$ret.=input(1,'inp',$p).' '.checkbox_j('opt',$o,'complexity').' ';
$ret.=lj('',$rid.'_app___genpswd_call___inp|opt',picto('reload')).' ';
return $ret;}

}

function plug_genpswd($p,$o){$rid='plg'.randid(); if(!$p)$p=8;
$bt=genpswd::menu($p,$o,$rid); $ret=genpswd::build($p,$o);
return $bt.divd($rid,$ret);}

?>