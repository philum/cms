<?php
//philum_ascii 
//that help to build edition_chars mtable

function chr_b($d){return '&#'.$d.';';}

function ascii_arr($o){$r=explode(' ',$o); asort($r,SORT_NUMERIC);
	foreach($r as $k=>$v){$i++; $spc='&#'.$v.';'; //$spc=chr($v);
	if($v)$ret.='$r["'.$v.'"]=array(\''.htmlentities($spc).'\');'.br();}
return $ret;}

function ascii_menu($s,$l){$s=$s?$s:128; $l=$l?$l:1000;
	$ret.=lj('','ascii_plug___ascii_ascii*j_'.($s-$l).'-'.$l,chr_b(9664));
	$ret.=lj('','ascii_plug___ascii_ascii*j_'.($s+$l).'-'.$l,chr_b(9658));
	$ret.=lkc('','/plug/ascii/'.$s.'-'.$l,$s.'-'.($s+$l)).' ';
return $ret;}

function ascii_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
//build
if($o){$ret=ascii_arr($o); $r=explode(' ',$o);}
else{
	if($p)list($start,$lenght)=split("-",$p); else{$start=128; $lenght=1000;}
	for($i=$start;$i<=$start+$lenght;$i++)$r[]=$i;
	$ret.=ascii_menu($start,$lenght);}
//signs
foreach($r as $k=>$v)if($v)$bt.=ljb('','insert',$v.' ',chr_b($v)).' ';
$ret.=divs('font-size:medium; line-height:140%;',$bt);
return $ret;}

function ascii_jb($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
return ascii_j('',$p);}

function plug_ascii($p,$o='',$res=''){
$ret.=input1('txtarea','',60).' ';
$ret.=lj('popw','ascii_plug___ascii_ascii*jb___txtarea','ok').br();
$ret.=divd('ascii',ascii_j($p,$o,$res));
return $ret;}


?>