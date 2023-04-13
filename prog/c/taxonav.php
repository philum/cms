<?php 
class taxonav{

static function lk($id){$t=ma::suj_of_id($id);
//return lj('','popup_popart__3_'.$k.'_3',$t);
return lh('/'.$id,$t);}

static function good_gb($k,$i,$t){
$btn=lj('','tn'.$k.'_taxonav,read__2_'.$k.'|'.$i.'|',$t).' ';
$ret=self::lk($k);
return $btn.$ret;}

static function make_menus_rb($arr,$here,$open,$o){
static $i; $i++; static $a; $a++; $ret=''; $o=0;
$css='" style="padding:0 0 0 0px;'; 
$csa='" style="list-style-type:none;';
if(is_array($arr))foreach($arr as $k=>$v){$o++; $re='';
	if(is_array($v)){$nb=btn('txtsmall2','('.count($v).')');
	$re=tagc('li',$csa,'&#9500;&#150;'.self::good_gb($k,$i,'&#9658;').' '.$nb);
	$re.=self::make_menus_rb($v,'',0,0);}
	elseif($open)$re.=tagc('li',$csa,'&#9500;&#150; '.self::lk($k));
if($re)$ret.=divd('tn'.$k,$re);}
$a--;
return divc($css,ul($ret));}//9658//9660

static function make_menus_rbub($arr,$here,$open,$o){static $i; $i++; static $a; $a++;
if(is_array($arr))foreach($arr as $k=>$v){$o++; $re=''; $ret='';
	if(is_array($v)){$nb=btn('small','('.count($v).')');
	$re=tagb('li','&#9500;&#150;'.self::good_gb($k,$i,'&#9658;').' '.$nb);
	$re.=self::make_menus_rb($v,'',0,0);}
	elseif($open)$re.=self::lk($k);
if($re)$ret.=divd('tn'.$k,$re);}
$a--;
return divc('',$ret);}//9658//9660

static function tri_hierarchic($r,$h){$rt=[];
foreach($r as $k=>$v){if($k==$h)$rt=$v;
	if(is_array($v) && !$rt)$rt=self::tri_hierarchic($v,$h);}
return $rt;}

//
static function verif_array_exists_r($r,$d){$ret=''; foreach($r as $k=>$v){if($k==$d)$ret=true;//ib exs
	if(is_array($v) && !$ret)$ret=self::verif_array_exists_r($v,$d);} return $ret;}//id exs

static function ibofid_r($id,$r){$ib=ma::rqt($id,'ib');//parent.parent...
if(!$ib)$ib=sql('ib','qda','v',$id); 
if($ib && $ib!='/' && $ib!=$id){$r[$ib][$id]=1; $r=self::ibofid_r($ib,$r);}//if($ib==$id)echo $id;
return $r;}

static function supertriad_compintime($r,$o){if($r)foreach($r as $k=>$v){$ib=ma::ib_of_id($k); 
	if($ib && is_numeric($ib) && !self::verif_array_exists_r($r,$ib)){$r[$ib][$k]=1;
		$rb=ma::id_of_ib($ib); if($rb)$r[$ib]+=$rb;}
	$rb=ma::id_of_ib($k); if($rb)$r[$k]+=$rb;
	if($o)$r=self::ibofid_r($k,$r);}
return $r;}

static function collect_hierarchie_d($rev,$o=''){//dig
	$r=md::supertriad_c(ses('dayb'));//_d
	$r=self::supertriad_compintime($r,$o); $rb=[];
	if(is_array($r))$rb=md::hierarchic_line($r,$r,$rev);
	if(is_array($rb)){if($rev)krsort($rb); else ksort($rb);}
return $rb;}

static function read($p){
[$h,$i,$o]=explode('|',$p); $op='';
$r=self::collect_hierarchie_d('reverse',1);
$r=self::tri_hierarchic($r,$h);
if(substr($i,0,1)=='x'){$i=substr($i,1);} else{$i='x'.$i; $op='x';}
if($op)$p='&#9660;'; else $p='&#9658;';//down-right
$nb=btn('txtsmall2','('.count($r).')');
$ret=tag('li',['style'=>'list-style-type:none;'],'&#9500;&#150;'.self::good_gb($h,$i,$p).' '.$nb);
if($r)return $ret.tagc('ul','taxonomy',self::make_menus_rb($r,$h,$op,$o));}

static function call($p,$o){$o=1;//$o=yesno($o);
$r=self::collect_hierarchie_d('reverse',$o); $ret='';
if(is_numeric($p))$r=$r[$p]??[];
if($r){$ret=md::title($r,$p>0?ma::suj_of_id($p):$p,1);
$ret.=tagc('ul','taxonomy',self::make_menus_rb($r,'',1,$o));}
//$ret.=lkc('','/module/taxonav/'.ajx($p).'/'.yesno($o),offon($o).' '.nms(129));
//$ret.=lj('','txnv_taxonav,call___'.ajx($p).'_'.yesno($o),offon($o).' '.nms(129));
else $ret=nms(11).' '.nms(16);
return divd('txnv',$ret);}
}
?>