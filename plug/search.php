<?php
//philum_plugin_search
session_start();

//spe
function next_sptime($d){//,4015,4380,4745,5110,5475,5840
$r=array(1,7,30,90,365); for($i=5;$i<20;$i++){$r[]=$r[$i-1]+365;}
$k=in_array_b($d,$r);//$_GET['dig']//getorpost('dig',$_SESSION['nbj'])
if($r[$k+1])return $_GET['dig']=$r[$k+1];}

function dig_h($n){$r=define_digr();
if(!$r[$n])$r[$n]=$n>=365?round($n/365,2):$n; $cur=$r[$n];
if($n!=1 && $n!=7)$r[$n]=$r[time_prev($n)].' '.nms(36).' '.$r[$n];//from
$r[$n].=' '.($n<365?plurial($cur,3):plurial($cur,7));
return menuder_h($r,'srdig',$n,'Search2();');}

function mkurl($r){$n=count($r); 
for($i=0;$i<$n;$i++){if($_GET[$r[$i]])$ret.='&'.$r[$i].'='.$_GET[$r[$i]];}
return $ret;}

function except_words($d){
$r=array('de','des','du','dans','le','les','la','un','a','à','ou','où','on','en','y',"«","»","'",'"',":","-","!","?");
if(!in_array($d,$r))return true;}

function rech_lower($d,$o){
return $o?strtolower($d):$d;}

//rech->load
function rech($rch,$days=''){$low=1;
if(get('bool'))$bool=1; if(get('titles'))$titl=1;
if(substr($rch,0,1)=='*'){$rch=substr($rch,1); $titl=1;}
if(substr($rch,-1)=='*'){$rch=substr($rch,0,-1); $bool=1;}
$rch=str_replace("’","'",$rch); $rchb=rech_lower($rch,$low);
if(!$days)$days=$_SESSION["nbj"];
if($days){$sqlm='AND day > '.calc_date($days);//limit
$dayba=time_prev($days); $dayba=$dayba?calc_date($dayba):$_SESSION["daya"];
$sqlm.=' AND day < '.$dayba;}
	//if(get('pho'))$rch=soundex($rch);
	$wh='suj LIKE "%'.($rch).'%" ';
	if($bool)$parts=explode(' ',$rchb); $cp=count($parts);
	if($cp>1){foreach($parts as $k=>$v){if(except_words($v)){
		if($titl)$whb.='suj LIKE "%'.($v).'%" OR ';
		else $whb.='msg LIKE "%'.($v).'%" OR ';}}
		$whb=substr($whb,0,-4);}
	elseif(!$titl)$whb='msg LIKE "%'.$rch.'%" ';
	if($_SESSION['rstr'][3]=="1")$sqlm="";
	if($_GET['cat'])$sqlm.=' AND frm="'.$_GET['cat'].'"';
	if($_GET['tag'])$sqlm.=' AND thm LIKE "%'.$_GET['tag'].'%"';
$rte=sql('id','qda','k','nod="'.$_SESSION['qb'].'" AND frm!="_system" AND re>="1" '.$sqlm.' '); 
	if($rte){$rtk=array_keys($rte); $dif=max($rtk)-min($rtk); 
	if($dif)$rtp=count($rte)/$dif;
		if($rtp<0.5)$whc='id="'.implode('" OR id="',$rtk).'"'; 
		else $whc='id>="'.min($rtk).'" AND id<="'.max($rtk).'"';}
	$rq=res("id,suj",$_SESSION['qda'].' WHERE '.$wh.' AND nod="'.$_SESSION['qb'].'" '.$sqlm.'');
	if($rq)while($data=mysql_fetch_row($rq)){$nbc=""; $suj=rech_lower($data[1],$low);
	if($cp>1){foreach($parts as $k=>$v){$n=0; 
		$nbd[$k]=substr_count($suj,trim($v)); if($nbd[$k])$n+=1;}
		if($n==$cp)$ret[$data[0]]+=array_sum($nbd);}
	else{$nbc=substr_count($suj,$rchb); if($nbc)$ret[$data[0]]+=$nbc;}}
if($titl)$rq=res("id,suj",$_SESSION['qda'].' WHERE ('.$whb.') AND ('.$whc.')');
else $rq=res("id,msg",$_SESSION['qdm'].' WHERE ('.$whb.') AND ('.$whc.')'); 
	if($rq)while($data=mysql_fetch_row($rq)){$nbc="";
	if($rte[$data[0]]){
	if(strpos($data[1],":import")!==false){$msg=format_txt($data[1],"","");}
	else $msg=$data[1]; $msg=rech_lower($msg,$low);
	if($cp>1){
		foreach($parts as $k=>$v){$n=0; 
			if(trim($v))$nbd[$k]=substr_count($msg,trim($v));}
		foreach($parts as $k=>$v){if($nbd[$k])$n+=1;} 
		if($n==$cp)$ret[$data[0]]+=array_sum($nbd);}
	else{$nbc=substr_count($msg,$rchb); if($nbc)$ret[$data[0]]+=$nbc;}}}
if($rch && !$ret && (rstr(62) or ses('rstr62'))){$ndig=next_sptime($days);
	if($ndig)return rech($rch,$ndig);}
return $ret;}

//titles
function rech_titles($rech,$dig='',$opt='',$cac='',$cat='',$tag=''){
list($bol,$ord,$tit,$pho)=split("-",$opt);
$load=$_SESSION['load']; $days=geta('dig',$dig);
$bol=substr($rech,-1)=='*'?1:get('bool',$bol); $_GET['bool']=$bol; //$_GET['pho']=$pho;
$ret.=btn('search',input(1,'search',$rech.'" size="32" maxlength="150','')).' ';
$ret.=ljb('popsav','Search2();','',nms(24)).' ';
$ret.=hlpbt('search').' ';
if($cac)$ret.=blj('popbt','srcac','plug___search_rech*reset_'.$cac,picto('del'));
if($load)$ret.=btn("popw",nbof(count($load),1).', '.nbof(array_sum($load),19)).' ';
if(rstr(3))$ret.=br().dig_h($days); else $ret.=hidden('','srdig',1000);//days
if(!isset($_SESSION['rstr62']))sesr('rstr62',rstr(62)); 
if(rstr(3))$ret.=togses('rstr62',pictit('right',nms(134))).' ';//dig
$urg=mkurl(array('bool','titles','cat','tag'));
if($rech)$ret.=lkc('',htac('search').$rech.'/'.$dig.$urg,picto('link')).' ';
$ret.=br().checkact('srord',$ord,nms(18)).' ';
$ret.=checkact('srtit',$tit,nms(72)).' ';
//$ret.=checkact('srpho',get('pho'),'').' ';//nms(123)
$ret.=checkact('srbol',$bol,nms(70)).''.hlpbt('bool').' ';
$ret.=select_j('srcat','category',$cat,1).' ';
$ret.=select_j('srtag','tag',$tag,1);
return divc('titles',$ret).br();}

//j
function array_intersect_c($a,$b,$c){$load=$a+$b+$c;
foreach($a as $k=>$v)$r[$k]=1;
foreach($b as $k=>$v)$r[$k]+=1;
foreach($c as $k=>$v)$r[$k]+=1;
if($r)foreach($r as $k=>$v)if($v>1)$ret[$k]=$load[$k];
return $ret?$ret:$load;}

function rech_ut($utg,$n){list($p,$o)=split(':',$utg); $dy=calc_date($n);
return sql('ib','qdd','k','qb="'.$_SESSION['qb'].'" AND day>"'.$dy.'" AND cat="tables" AND val="'.eradic_acc($p).'" AND msg LIKE "%'.$o.'%"'.' ORDER BY id DESC');}

function rech_catag($d,$cat,$tag,$utg,$n){
$rr=array(); if($d)$ra=rech($d,$n,$b);
$wh='nod="'.$_SESSION['qb'].'" AND re>0 AND day>"'.calc_date($n).'"'; 
if($n>7)$wh.=' AND day<"'.calc_date(time_prev($n)).'"'; 
if($cat)$wh.=' AND frm="'.$cat.'" '; if($tag)$wh.='AND thm LIKE "%'.$tag.'%"';
if($cat or $tag)$rb=sql('id','qda','k',$wh); if($utg)$rc=rech_ut($utg,$n);
if(!$ra)$ra=$rr; if(!$rb)$rb=$rr; if(!$rc)$rc=$rr; 
return array_intersect_c($ra,$rb,$rc);}

function rech_script($d){$sp=strpos($d,';')?';':' '; $r=explode($sp,$d); $n=count($r);
for($i=0;$i<$n;$i++){list($o,$p)=split(':',$r[$i]); if($p=='tag')$tag=$o; 
	elseif($p=='cat')$cat=$o; elseif(!$p)$rech.=$o.' '; elseif($p)$utg=$p.':'.$o;}
return array($rech,$cat,$tag,$utg);}

function rech_reset($p){unset($_SESSION['recache'][$p]);}

/*Search2
function Search2(){
	var src=ajxget(getbyid('search').value);
	var dig=getbyid('srdig').value;
	var bol=getbyid('srbol').value;
	var ord=getbyid('srord').value;
	var tit=getbyid('srtit').value;
	var cat=ajxget(getbyid('srcat').value);
	var tag=ajxget(getbyid('srtag').value);
	var cll=src+'_'+dig+'_'+bol+'-'+ord+'-'+tit+'&nom='+cat+(tag?'_'+tag:'');
	var ajax=new AJAX(jurl()+'search_'+cll,'popup',3);
	Close('popup');}*/

function plug_search($d,$n,$opt='',$res=''){list($b,$o,$t,$ph)=split("-",$opt);
$rech=good_rech($d); $_GET['search']=$rech; list($cat,$tag)=ajxr($res);
if(!$n)$n=$_SESSION['nbj']; $_GET['dig']=$n; $_GET['cat']=$cat; $_GET['tag']=$tag; 
$_GET['bool']=$b; $_GET['titles']=$t; //$_GET['pho']=$ph; 
$vrf=normalize($rech.$n.$b.$o.$t.$ph.$res);
if(isset($_SESSION['recache'][$vrf])){$load=$_SESSION['recache'][$vrf]; $cac=$vrf;}
//elseif($d && is_numeric($d) && $d<lastid('qda'))$load[$d]=1; 
elseif(strpos($rech,';') && strpos($rech,':'))list($rch,$cat,$tag,$utg)=rech_script($rech);
elseif(strpos($rech,'='))$load=make_list_arts($rech);
elseif($rech)$load=rech($rech,$n); if($load && !is_array($load))$load='';
if(!$load && ($cat or $tag or $utg))$load=rech_catag($rch,$cat,$tag,$utg,$n);
$_SESSION['load']=$load; $_SESSION['recache'][$vrf]=$load; save_get();
$ret=rech_titles($rech,$n,$opt,$cac,$cat,$tag); $_SESSION['page']=1;
if($load){if($o)krsort($load); else arsort($load); //$_GET['targ']=$vrf;
$ret.=scroll($load,divd($vrf,output_pages($load,'flow','')),1,400);}
return $ret;}

?>