<?php
//philum_plugin_search

//spe
function next_sptime($d){//,4015,4380,4745,5110,5475,5840
$r=array(1,7,30,90,365); for($i=5;$i<20;$i++){$r[]=$r[$i-1]+365;}
$k=in_array_b($d,$r);
if($r[$k+1])return $_GET['dig']=$r[$k+1];}

function dig_h($n){$r=define_digr(); $nprev=time_prev($n);
if(!$r[$n])$r[$n]=$n>=365?round($n/365,2):$n; $cur=$r[$n];
if($n!=1 && $n!=7)$r[$n]=$r[$nprev].' '.nms(36).' '.$r[$n];//from
$r[$n].=' '.($n<365?plurial($cur,3):plurial($cur,7));
if($n>365)$r[$n]=date('Y',calc_date($n));//from
return menuder_h($r,'srdig',$n,'Search2();');}

function mkurl($r){$n=count($r); 
for($i=0;$i<$n;$i++){if($_GET[$r[$i]])$ret.='&'.$r[$i].'='.$_GET[$r[$i]];}
return $ret;}

function except_words($d){
$r=array('de','des','du','dans','le','les','la','un','a','à','ou','où','on','en','y',"«","»","'",'"',":","-","!","?");
if(!in_array($d,$r))return true;}

function rech_prep_suj($rch,$cp,$parts){
	if($cp>1){foreach($parts as $k=>$v)
		if(except_words($v))
			$r[]='suj LIKE "%'.($v).'%"';
		$wh='('.implode(' or ',$r).')';}
	else $wh='suj LIKE "%'.$rch.'%" ';
return $wh;}

function rech_prep_msg($rch,$cp,$parts){
	if($cp>1){foreach($parts as $k=>$v)
		if(except_words($v))
			$r[]='msg LIKE "%'.($v).'%"';
		$wh='('.implode(' or ',$r).')';}
	else $wh='msg LIKE "%'.$rch.'%" ';
return $wh;}

function rech($rch,$days=''){
if(get('bool'))$bool=1; if(get('titles'))$titl=1;
if(substr($rch,-1)=='*'){$rch=substr($rch,0,-1); $bool=1;}
$cat=$_GET['cat']; if($cat==nms(9))$cat=''; $tag=$_GET['tag']; if($tag=='tag')$tag='';
$qb=ses('qb'); $qda=ses('qda'); $qdm=ses('qdm'); $qdt=ses('qdt'); $qdta=ses('qdta');
if($bool){$parts=explode(' ',$rch); $cp=count($parts);}
//sql
$days=$days?$days:ses('nbj');
if(rstr(3))$sq['daymin']='day>'.calc_date($days);
$daya=time_prev($days); $daya=$daya?calc_date($daya):ses('daya');
$sq['daymax']='day<'.$daya;
$sqnd['suj']=rech_prep_suj($rch,$cp,$parts);
$sq['nod']='nod="'.$qb.'"';
$sq['frm']='substring(frm,1,1)!="_"';
$sq['re']='re>0';
if(!$titl && $rch){
	$sqin['msg']='inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id';
	$sqnd['msg']=rech_prep_msg($rch,$cp,$parts);}
if($cat)$sq['cat']='frm="'.$cat.'"';
if($tag)$sqin['tag']='
	inner join '.$qdta.' on '.$qda.'.id='.$qdta.'.idart
	inner join '.$qdt.' on '.$qdt.'.id='.$qdta.'.idtag and tag="'.$tag.'"';
//req
$wh=implode(' and ',$sq); 
if($sqnd['suj'] && $sqnd['msg'])$wh.=' and ('.$sqnd['msg'].' or '.$sqnd['suj'].')';
elseif($sqnd['suj'])$wh.=' and '.$sqnd['suj']; elseif($sqnd['msg']) $wh.=' and '.$sqnd['msg'];
if($sqin)$inner=implode('',$sqin);
$ret=sql_b('select '.$qda.'.id from '.$qda.' '.$inner.' where '.$wh.' order by '.ses('qda').'.id desc','k',0);//auth(6)?1:
//reload
if(!$ret && $rch && (rstr(62) or ses('rstr62'))){
	$ndig=next_sptime($days); if($ndig)get('dig',$ndig);
	if($ndig)return rech($rch,$ndig);}
return $ret;}

//titles
function rech_titles($rech,$dig,$opt,$cac,$cat,$tag,$tag2){
list($bol,$ord,$tit,$pho)=split("-",$opt);
$load=$_SESSION['load']; $days=geta('dig',$dig);
$bol=substr($rech,-1)=='*'?1:get('bool',$bol); $_GET['bool']=$bol; //$_GET['pho']=$pho;
$ret.=btn('search',input(1,'search',$rech.'" size="32" maxlength="150','')).' ';
$ret.=ljb('popsav','Search2();','',nms(24)).' ';
$ret.=hlpbt('search').' ';
if($cac)$ret.=blj('popbt','srcac','plug___search_rech*reset_'.$cac,picto('del'));
if($load)$ret.=btn("popw",nbof(count($load),1));//.', '.nbof(array_sum($load),19).' '
if(rstr(3))$ret.=br().dig_h($days); else $ret.=hidden('','srdig',1000);//days
if(!isset($_SESSION['rstr62']))sesr('rstr62',rstr(62)); 
if(rstr(3))$ret.=togses('rstr62',pictit('right',nms(134))).' ';//dig
$urg=mkurl(array('bool','titles','cat','tag'));
if($rech)$ret.=lkc('',htac('search').$rech.'/'.$dig,picto('link')).' ';//.$urg
$ret.=br().checkact('srord',$ord,nms(18)).' ';
$ret.=checkact('srtit',$tit,nms(72)).' ';
//$ret.=checkact('srpho',get('pho'),'').' ';//nms(123)
$ret.=checkact('srbol',$bol,nms(70)).''.hlpbt('bool').' ';
$ret.=select_j('srcat','category',$cat?$cat:nms(9),1).' ';//hidslct_j
$ret.=select_j('srtag','tag',$tag?$tag:'tag','');
//$ret.=select_j('srtag2','thèmes',$tag3,'thèmes');
return divc('titles',$ret);}

function array_intersect_b($a,$b){$load=$a+$b;
foreach($a as $k=>$v)$r[$k]=1;
foreach($b as $k=>$v)$r[$k]+=1;
if($r)foreach($r as $k=>$v)if($v>1)$ret[$k]=$load[$k];
return $ret?$ret:$load;}

function rech_catag($cat,$tag,$utg,$n){
$wh='select '.ses('qda').'.id from '.ses('qda').'';
if($tag){$idtag=sql('id','qdt','v','tag="'.$tag.'"');
$wh.=' inner join '.ses('qdta').' on '.ses('qdta').'.idart='.ses('qda').'.id and '.ses('qdta').'.idtag="'.$idtag.'"';}
$wh.=' where nod="'.ses('qb').'" and re>0 and day>"'.calc_date($n).'"'; 
if($n>7)$wh.=' and day<"'.calc_date(time_prev($n)).'"'; 
if($cat)$wh.=' and frm="'.$cat.'"';
if($cat or $tag)$rb=sql_b($wh.' order by '.ses('qda').'.id desc','k');
return $rb;}

function rech_script($d){$sp=strpos($d,';')?';':' '; $r=explode($sp,$d); $n=count($r);
for($i=0;$i<$n;$i++){list($o,$p)=split(':',$r[$i]); if($p=='tag')$tag=$o; 
	elseif($p=='cat')$cat=$o; elseif($p)$utg=$p.':'.$o; elseif(!$p)$rech.=$o.' ';}
return array($rech,$cat,$tag,$utg);}

function rech_reset($p){unset($_SESSION['recache'][$p]);}

function plug_search($d,$n,$opt='',$res=''){list($b,$o,$t,$ph)=split('-',$opt); chrono();
$rech=good_rech($d); $_GET['search']=$rech; list($cat,$tag)=ajxr($res);
$rech=str_replace(array("’",'«','»',"&nbsp;"),array("'",'"','"',' '),trim($rech));
if(!$n)$n=$_SESSION['nbj']; $_GET['dig']=$n; $_GET['cat']=$cat; $_GET['tag']=$tag; 
$_GET['bool']=$b; $_GET['titles']=$t; //$_GET['pho']=$ph; 
$vrf=normalize($rech.$n.$b.$o.$t.$ph.$res);
if($rech=='last'){$id=lastid('qda'); $load[$id]=1;}
elseif(isset($_SESSION['recache'][$vrf])){$load=$_SESSION['recache'][$vrf]; $cac=$vrf;}
elseif($d && is_numeric($d) && $d<lastid('qda'))$load[$d]=1;
elseif(strpos($rech,';') && strpos($rech,':'))list($rch,$cat,$tag,$utg)=rech_script($rech);
elseif(strpos($rech,'='))$load=make_list_arts($rech);
else $load=rech($rech,$n); if($load && !is_array($load))$load='';
if(!$load && ($cat or $tag or $utg))$load=rech_catag($cat,$tag,$utg,$n);
$_SESSION['load']=$load; $_SESSION['recache'][$vrf]=$load;
$ret=rech_titles($rech,$n,$opt,$cac,$cat,$tag,$tag2); $_SESSION['page']=1;
$_SESSION['popm']=chrono('search');
if($load[0])unset($load[0]); if($load[1])unset($load[1]);
if($load)$ret.=scroll($load,divd($vrf,output_pages($load,'','')),2,'',400);
return $ret;}

?>