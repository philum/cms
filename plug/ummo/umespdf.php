<?php
//philum_plugin_umespdf

function plug_umespdf($p,$o){//if(!auth(6))return;
$d=sql('suj','qda','v','id='.ses('read'));
$vrf=embed_detect($d,'[',']'); $ret='';
$r=msql_read('',nod('es_3'),'');
$r=msql::tri($r,0,$vrf); if($r)$r=current($r);
if(!isset($r[0]))return;
if(!empty($r[1])){
	if(strpos($r[1],"\n")){$rb=explode("\n",$r[1]);
		foreach($rb as $k=>$v)if($v)$ret.=lj('','popup_iframe___'.ajx($v),pictxt('pdf','original')).' ';}
	else $ret.=lj('','popup_iframe___'.ajx($r[1]),pictxt('pdf','original')).' ';}
if(!empty($r[2]))$ret.=lkt('',$r[2],flag('es').'['.$vrf.']');
//if($r[1])$ret.=lkt('',$r[1],pictxt('pdf','original'));
if($ret)return btn('txtcadr','Original').br().btn('txtx',$ret);}

?>