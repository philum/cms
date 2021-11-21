<?php 
//philum_plugin_share

function good_gb($k,$i,$t){
$btn=lj('','tn'.$k.'_plug__2_taxonav_taxonav*read_'.$k.'|'.$i.'|',$t).' ';
$ret=lj('','popup_popart__3_'.$k.'_3',suj_of_id($k));
return $btn.$ret;}

function make_menus_rb($arr,$here,$open,$o){
static $i; $i++; static $a; $a++; $ret=''; $o=0;
$css='" style="padding:0 0 0 0px;'; 
$csa='" style="list-style-type:none;';
if(is_array($arr))foreach($arr as $k=>$v){$o++; $re='';
	if(is_array($v)){$nb=btn('txtsmall2','('.count($v).')');
	$re=balc('li',$csa,'&#9500;&#150;'.good_gb($k,$i,'&#9658;').' '.$nb);
	$re.=make_menus_rb($v,'',0,0);}
	elseif($open)$re.=balc('li',$csa,'&#9500;&#150; '.lj('','popup_popart__3_'.$k.'_3',suj_of_id($k)));
if($re)$ret.=divd('tn'.$k,$re);}
$a--;
return divc($css,ul($ret));}//9658//9660

function make_menus_rbub($arr,$here,$open,$o){static $i; $i++; static $a; $a++;
if(is_array($arr))foreach($arr as $k=>$v){$o++; $re='';
	if(is_array($v)){$nb=btn('small','('.count($v).')');
	$re=balc('li',$csa,'&#9500;&#150;'.good_gb($k,$i,'&#9658;').' '.$nb);
	$re.=make_menus_rb($v,'',0,0);}
	elseif($open)$re.=lj('','popup_popart__3_'.$k.'_3',suj_of_id($k));
if($re)$ret.=divd('tn'.$k,$re);}
$a--;
return divc($css,$ret);}//9658//9660

function tri_hierarchic($r,$h){$ret='';
foreach($r as $k=>$v){if($k==$h)$ret=$v;
	if(is_array($v) && !$ret)$ret=tri_hierarchic($v,$h);}
return $ret;}

//
function verif_array_exists_r($r,$d){$ret=''; foreach($r as $k=>$v){if($k==$d)$ret=true;//ib exs
	if(is_array($v) && !$ret)$ret=verif_array_exists_r($v,$d);} return $ret;}//id exs

function ibofid_r($id,$r){$ib=rqt($id,'ib');//parent.parent...
if(!$ib)$ib=sql('ib','qda','v','id='.$id); 
if($ib && $ib!='/'){$r[$ib][$id]=1; $r=ibofid_r($ib,$r);}
return $r;}

function supertriad_compintime($r,$o){if($r)foreach($r as $k=>$v){$ib=ib_of_id($k); 
	if($ib && is_numeric($ib) && !verif_array_exists_r($r,$ib)){$r[$ib][$k]=1;
		$rb=id_of_ib($ib); if($rb)$r[$ib]+=$rb;}
	$rb=id_of_ib($k); if($rb)$r[$k]+=$rb;
	if($o)$r=ibofid_r($k,$r);}
return $r;}

function collect_hierarchie_d($rev,$o=''){//dig
	$r=supertriad_c($_SESSION['dayb'],'Home');//_d//$_SESSION['frm']
	$r=supertriad_compintime($r,$o);
	if(is_array($r))$rb=hierarchic_line($r,$r,$rev);
	if(is_array($rb)){if($rev)krsort($rb); else ksort($rb);}
return $rb;}

function taxonav_read($p){req('spe');
list($h,$i,$o)=explode('|',$p); $op='';
$r=collect_hierarchie_d('reverse');
$r=tri_hierarchic($r,$h); //p($r);
if(substr($i,0,1)=='x'){$i=substr($i,1);} else{$i='x'.$i; $op='x';}
if($op)$p='&#9660;'; else $p='&#9658;';//down-right //
$nb=btn('txtsmall2','('.count($r).')');
$ret=balc('li','" style="list-style-type:none;','&#9500;&#150;'.good_gb($h,$i,$p).' '.$nb);
if($r)return $ret.balc('ul','taxonomy',make_menus_rb($r,$h,$op,$o));}

function plug_taxonav($p,$o){req('mod,spe'); $o=yesno($o);
$r=collect_hierarchie_d('reverse',$o); $ret='';
if(is_numeric($p))$r=$r[$p];
if($r){$ret=build_titl($r,$p>0?suj_of_id($p):$p,1);
$ret.=balc('ul','taxonomy',make_menus_rb($r,'',1,$o));}
//$ret.=lkc('','/module/taxonav/'.ajx($p).'/'.yesno($o),offon($o).' '.nms(129));
//$ret.=lj('','txnv_plugin___taxonav_'.ajx($p).'_'.yesno($o),offon($o).' '.nms(129));
else $ret=nms(11).' '.nms(16);
return divd('txnv',$ret);}

?>