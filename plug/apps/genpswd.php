<?php //genpswd

class genpswd{

static function build($p,$o){$ret='';
$a='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789012345678901234567890123456789'; 
if($o==1)$a.='$£%*µ,?;.:/!&#{[-|_)]=}+';
$r=str_split($a); $n=count($r)-1;
for($i=0;$i<$p;$i++)$ret.=$r[rand(0,$n)];
return $ret;}

static function call($p,$o,$res=''){
[$p,$o]=ajxr($res);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$ret=input1('inp',$p).' '.checkbox_j('opt',$o,'complexity').' ';
$ret.=lj('',$rid.'_app___genpswd_call___inp|opt',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid(); if(!$p)$p=12;
$bt=self::menu($p,$o,$rid); $ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}

function plug_genpswd($p,$o){
return genpswd::home($p,$o);}

?>