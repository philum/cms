<?php
//philum_plugin_umcom

function umcom_j($p,$o,$res=''){req('spe,tri');
list($p,$o)=ajxp($res,$p,$o);
if(!is_numeric($p))$p=id_of_urlsuj('['.$p.']');
//$_SESSION['memcom'][$p]+=1;
if(!$p)return 'nothing';
if(!rstr(8))$com='com2'; else $com='com';
$ret=umrec::call($p,$o,$com); $ret=delbr($ret); //if(auth(6))eco($ret);
if(!rstr(8))return balb('blockquote',$ret);
$bt=divc('right',lkt('','/app/umcom/'.$p,picto('chain')));
return balb('blockquote',$bt.divd('umrec'.$p,$ret));}

function umcom_menu($p,$o,$rid){
$j=$rid.'_plug__3_umcom_umcom*j___inp';
$ret=inputj('inp',$p,$j).' ';
$ret.=lj('',$j,picto('ok'));
return divc('',$ret).br();}

function plug_umcom($p,$o){req('spe,tri');
//if(strpos($p,'§'))list($p,$t)=explode('§',$p); else $t='';
//ummo_aliens_4
if(strpos($p,'_')){$ret=''; $r=msql::col('',$p,0); foreach($r as $k=>$v)if($v)$ret.=plug_umcom($v,$o); return $ret;}
if(strpos($p,',')){$ret=''; $r=explode(',',$p); foreach($r as $k=>$v)$ret.=plug_umcom($v,$o); return $ret;}
if(!is_numeric($p) && $p && !$o)$p=id_of_urlsuj('['.$p.']');
//if(!$p)$p=ses('read');
$rid='umcom'.$p; $bt=''; $ret='';
if(!$p)$bt=umcom_menu($p,$o,$rid);
//elseif($t)return lj('','popup_plupin___umcom_'.ajx($p),$t);
elseif($o){
	if($o==1)$o=is_numeric($p)?suj_of_id($p):$p;//p§o
	return lj('','popup_plupin___umcom_'.$p,pictxt('cube',$o)).' ';}
else $ret=umcom_j($p,$o);
return $bt.divd($rid,$ret);}

?>