<?php
//philum_plugin_umrenum

function twit_time($u){
$p=strend($u,'/'); //echo $u.' - ' .$p.br();
$t=new Twitter;
$q=$t->read($p);
$time=strtotime($q['created_at']);
//$date=date('Y-d-m-H-i',$time);
return $time;}

function req_arts_y($p){
$qda=$_SESSION['qda']; $qdm=$_SESSION['qdm']; $qdi=$_SESSION['qdi'];
$wh=$qda.'.frm="'.implode('" or '.$qda.'.frm="',explode(',',$p)).'"';
$sql='select distinct '.$qda.'.id,'.$qda.'.day,'.$qda.'.suj,'.$qda.'.mail,'.$qdm.'.msg from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$wh.' and re>0 group by id order by day ASC';
return sql_b($sql,'','');}

function req_arts_yb($p){$qda=$_SESSION['qda'];
$wh=$qda.'.frm="'.implode('" or frm="',explode(',',$p)).'"';
$sql='select distinct id,day,suj,mail from '.$qda.' where '.$wh.' and re>0 group by id order by day ASC';
return sql_b($sql,'','');}

function umrenum_build($p,$o,$ob=''){req('spe');
//require_once('plug/tiers/Twitter.php'); //timelang();
//$r=sql('id,day,suj,mail','qda','','frm="'.$p.'" order by day ASC');// and re>"0"
$r=req_arts_yb($p); $rc=[]; //pr($r);
if($p=='Oaxiiboo 6'){$d='O6'; $nm='oaxiiboo6';}
elseif($p=='Oolga Waam'){$d='OW'; $nm='olga_waam';}
elseif($p=='Oomo Toa'){$d='OT'; $nm='oomo_toa';}
elseif($p=='Oyagaa Ayoo Yissaa'){$d='OAY'; $nm='oyagaaayuyisaa';}
elseif($p=='312oay'){$d='312'; $nm='312oay';}
$ret[]=['title','temp title','new title','diff date','msg','diff link'];
//$na=0; $nac=0; $nad=0; $nae=0; 
$nb=0; $nc=0; $nd=0; $ne=0; $time=''; $nf1=1; $nf2=1; $nf3=1;
$date2b1=0; $date2b2=0; $date2b3=0;
if($r)foreach($r as $k=>$v){
	//$id=$v[0]; $day=$v[1]; $suj=$v[2]; $lk=$v[3]; $msg=$v[4];
	list($id,$day,$suj,$lk,$msg)=arr($v,5);
	//$msg=sql('msg','qdm','v','id='.$id);
	$suj=str_replace('@'.$nm.' ','',$suj);
	$newtit=$suj;
	//date from twitter
	//if(!$_SESSION['twtime'][$id])$_SESSION['twtime'][$id]=twit_time($v[2]);
	//if($_SESSION['twtime'][$id])update('qda','day',$_SESSION['twtime'][$id],'id',$id);
	$date=strftime("%R - %e %b %G",$day);
	$date2a=date('ymd',$day);
	$rb=art_tags($id); //echo $id.'-'; p($rb['info']);
	//fullnum
	/*if($d=='O6' or $d=='OW'){$na++;
		if($rb['info']['favoris']){$nac++; $newtit='['.$d.'-'.$na.'][Like '.$nac.']';}//.$date
		elseif($rb['info']['retweet']){$nad++; $newtit='['.$d.'-'.$na.'][Retweet '.$nad.']';}//.$date
		elseif($rb['info']['status']){$nae++; $newtit='['.$d.'-Status '.$nae.']';}//.$date
		else{$newtit='['.$d.'-'.$na.']';}//.$date
	}
	else*/
	if($d=='OT' or $d=='OAY' or $d=='O6' or $d=='OW' or $d=='312'){//
		if(valr($rb,'info','favoris')){$nc++;
			if($date2a==$date2b1){$nf1++; $date2=$date2a.'-'.$nf1;} else{$nf1=1; $date2=$date2a;}
			$newtit='['.$d.'-Like '.$nc.'] '.$date2; $newtit2=$newtit;
			$date2b1=$date2a;}
		elseif(valr($rb,'info','retweet') && $d=='OW'){$nd++;
			if($date2a==$date2b1){$nf1++; $date2=$date2a.'-'.$nf1;} else{$nf1=1; $date2=$date2a;}
			$newtit='['.$d.'-Retweet '.$nd.']'; $newtit2=$newtit;}
		elseif(valr($rb,'info','status')){$ne++;
			if($date2a==$date2b2){$nf2++; $date2=$date2a.'-'.$nf2;} else{$nf2=1; $date2=$date2a;}
			$newtit='['.$d.'-Status '.$ne.'] '.$date2; $newtit2=$newtit;
			$date2b2=$date2a;}
		else{$nb++;
			if($date2a==$date2b3){$nf3++; $date2=$date2a.'-'.$nf3;} else{$nf3=1; $date2=$date2a;}
			$newtit='['.$d.'-'.$nb.'] '.$date2; $newtit2=$newtit;
			$date2b3=$date2a;}
	}
	/*elseif($d=='312'){$nb++;//
		if($date2a==$date2b3){$nf3++; $date2=$date2a.'-'.$nf3;} else{$nf3=1; $date2=$date2a;}
		$newtit='['.$d.'-'.$nb.'] '.$date2; $newtit2=$newtit;
		$date2b3=$date2a;}*/
	/*else{//old with
		$suj=str_replace('&nbsp;',' ',$suj);
		if(strpos($suj,'::')){list($num,$tit)=explode('::',$suj);
			$newtit='['.strtoupper(trim($num)).'] '.trim($tit);}
		else $newtit=$suj;}*/
	else{list($num,$tit)=explode(']',$suj); $newtit=strtoupper(trim($num)).'] '.trim($tit);}
	$rc[$id]=$newtit;
	//if(strpos($suj,'@')===false){}
	#update('qda','suj',$newtit,'id',$id);
	//$ret[]=[popart($id,$newtit),$time,$msg];
	if(auth(6))$bt=blj('','k'.$id,'plug___umrenum_umrenum*sav_'.$id.'_'.ajx($newtit),pictxt('save',$newtit));
	if($newtit!=$suj)$sav=$bt; else $sav='';
	$ret[$day]=[popart($id,$suj),$sav,$newtit2,$time,divs('width:400px;',$msg)];
	//$ret[$day]=[$newtit,$sav,$newtit2,$time,divs('width:400px;',$msg)];
}
krsort($ret);
//ksort($ret);
if($ob)return $rc[$ob];//give asked
return tabler($ret);}

function umrenum_sav($p,$o,$res=''){//req('spe');
list($p,$o)=ajxp($res,$p,$o);
update('qda','suj',$o,'id',$p);
return 'ok';}

function umrenum_last($p,$o){
if(!$p)$p='Oyagaa Ayoo Yissaa';
$ret=umrenum_build($p,'',$o);
return $ret;}

function umrenum_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=umrenum_build($p,$o);
return $ret;}

function umrec_r(){
foreach(umrec::$cats as $v)$ret[$v]=$v;
return $ret;}

function umrenum_menu($p,$o,$rid){
if(!$p)$p='Oyagaa Ayoo Yissaa';//Oomo Toa//oaxiiboo 6//
$ret=select_j('inp','pfunc','','umrenum/umrenum_r','','2');
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_umrenum_umrenum*j___inp',picto('ok')).' ';
$ret.=hlpbt('umrennum');
return $ret;}

function plug_umrenum($p,$o){$rid=randid('plg');
$bt=umrenum_menu($p,$o,$rid);
if(!$p)$p='Oyagaa Ayoo Yissaa';
$ret=umrenum_build($p,$o);
return $bt.divd($rid,$ret);}

?>