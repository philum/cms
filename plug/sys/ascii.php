<?php
//philum_ascii 
//used to build edition_chars

function ascii_arr($o){$r=explode(' ',$o); asort($r,SORT_NUMERIC); $i=0; $ret='';
	foreach($r as $k=>$v){$i++; $spc='&#'.$v.';'; //$spc=chr($v);
	if($v)$ret.='$r["'.$v.'"]=[\''.htmlentities($spc).'\'];'.br();}
return $ret;}

function ascii_menu($s,$l){$s=$s?$s:128; $l=$l?$l:1000; if($s>200000)$l=100000;
	$ret=lj('popbt','ascii_plug___ascii_ascii*j_'.($s-$l).'-'.$l,chr_b(9664));
	$ret.=lj('popbt','ascii_plug___ascii_ascii*j_'.($s+$l).'-'.$l,chr_b(9658));
	$r=[1,128,8208,11904,13312,40960,42128,43968,63744,64533,73728,77824,119040,126976,131072,178205];
	foreach($r as $v)$ret.=lj($s>=$v?'popsav':'popbt','ascii_plug___ascii_ascii*j_'.$v.'-'.$l,chr_b($v),att($v));
	$j='ascii_plug__2_ascii_ascii*j___inp1';
	$ret.=inputj('inp1',$s.'-1000',$j); $ret.=lj('',$j,picto('ok')).' ';
	$ret.=lkc('','/plug/ascii/'.$s.'-'.$l,picto('link')).' ';
	$ret.=ljb('popsav','insert','&#'.$s.';',chr_b($s),'','insert');
return $ret;}

function ascii_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); $bt='';
if($o){$ret=ascii_arr($o); $r=explode(' ',$o);}
else{$ret='';
	if($p)list($start,$length)=expl('-',$p); else{$start=128; $length=1000;}
	if(!is_numeric($start) or !is_numeric($length))return $p;
	for($i=$start;$i<=$start+$length;$i++)$r[]=$i;
	$ret.=ascii_menu($start,$length);}
//signs
foreach($r as $k=>$v)if($v){
	if(auth(6))$bt.=ljb('','insert_b',[$v.' ','ascarea'],chr_b($v),'',att($v)).' ';
	else $bt.=ljb('','insert','&#'.$v.';',chr_b($v),'',att($v)).' ';}
$ret.=divs('font-size:large; line-height:140%;',$bt);
return $ret;}

function ascii_jb($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
return ascii_j('',$p);}

function plug_ascii($p,$o='',$res=''){$bt='';
if(auth(6))$bt=input1('ascarea','',60).' '.lj('popw','ascii_plug___ascii_ascii*jb___ascarea',picto('ok'));
return $bt.divd('ascii',ascii_j($p,$o,$res));}

?>