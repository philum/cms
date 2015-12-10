<?php 
//philum_plugin_share
session_start();

function good_gb($k,$i,$t){
$btn=lj('','tn'.$k.'_plug__2_taxonav_taxonav*read_'.$k.'|'.$i.'|'.$o,$t).' ';
$ret=lj('','popup_popart__3_'.$k.'_3',suj_of_id($k));
return $btn.$ret;}

function make_menus_rb($arr,$here,$open,$o){static $i; $i++; //if($open)$i=$open;
static $a; $a++; //$tr=str_pad('&#9658;',$a+7,'-',STR_PAD_LEFT);
$css='" style="padding:0 0 0 32px;'; 
$csa='" style="list-style-type:none;';
//if($open)$i='x'.$i;
if(is_array($arr))foreach($arr as $k=>$v){$o++; $re=''; //$a=$i.$o;
	if(is_array($v)){$nb=btn('txtsmall2','('.count($v).')');
	$re=balc("li",$csa,'&#9500;&#150;'.good_gb($k,$i,'&#9658;').' '.$nb);
	$re.=make_menus_rb($v,'',0,0);}
	elseif($open)$re.=balc("li",$csa,'&#9500;&#150; '.lj('','popup_popart__3_'.$k.'_3',suj_of_id($k)));
if($re)$ret.=divd('tn'.$k,$re);}
$a--;
return divc($css,$ret);}//9658//9660

function tri_hierarchic($r,$h){
foreach($r as $k=>$v){if($k==$h)$ret=$v;
	if(is_array($v) && !$ret)$ret=tri_hierarchic($v,$h);}
if($ret)return $ret;}

function taxonav_read($p){req('spe');
list($h,$i,$o)=explode('|',$p);
$r=collect_hierarchie_d("reverse");
$r=tri_hierarchic($r,$h); //p($r);
if(substr($i,0,1)=='x'){$i=substr($i,1);} else{$i='x'.$i; $op='x';}
if($op)$p='&#9660;'; else $p='&#9658;';//down-right //
$nb=btn('txtsmall2','('.count($r).')');
$ret=balc("li",'" style="list-style-type:none;','&#9500;&#150;'.good_gb($h,$i,$p).' '.$nb);
if($r)return $ret.balc("ul","taxonomy",make_menus_rb($r,$h,$op,$o));}

function plug_taxonav($p,$o){req('mod,spe');
$r=collect_hierarchie_d("reverse",$o);
if(is_numeric($p))$r=$r[$p];
if($r){$ret=build_titl($r,$p>0?suj_of_id($p):$p,1);
$ret.=balc("ul","taxonomy",make_menus_rb($r,'',1,$o));
$ret.=lkc('','/module/taxonav/'.ajx($p).'/'.yesno($o),offon($o).' '.nms(129));}
else $ret=nms(11).' '.nms(16);
return $ret;}

?>