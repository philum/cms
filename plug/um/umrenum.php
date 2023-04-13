<?php //umrenum
class umrenum{
static function twit_time($u){
$p=strend($u,'/'); //echo $u.' - ' .$p.br();
$t=new Twitter;
$q=$t->read($p);
$time=strtotime($q['created_at']);
//$date=date('Y-d-m-H-i',$time);
return $time;}

static function req_arts_y($p){
$qda=ses('qda'); $qdm=ses('qdm'); $qdi=ses('qdi');
$wh=$qda.'.frm="'.implode('" or '.$qda.'.frm="',explode(',',$p)).'"';
$sql='select distinct '.$qda.'.id,'.$qda.'.day,'.$qda.'.suj,'.$qda.'.mail,'.$qdm.'.msg from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$wh.' and re>0 group by id order by day ASC';
return sql::call($sql,'','');}

static function req_arts_yb($p){$qda=ses('qda'); $w=sql::atmra(explode(',',$p));
$sql='select id,day,suj,mail from '.$qda.' where frm in '.$w.' and re>0 order by day ASC';
return sql::call($sql,'','');}

static function build($p,$o,$ob=''){
//require_once('plug/tiers/Twitter.php'); //timelang();
//$r=sql('id,day,suj,mail','qda','','frm="'.$p.'" order by day ASC');// and re>"0"
$r=self::req_arts_yb($p); $rc=[]; //pr($r);
if($p=='Oaxiiboo 6'){$d='O6'; $nm='oaxiiboo6';}
elseif($p=='Oolga Waam'){$d='OW'; $nm='olga_waam';}
elseif($p=='Oomo Toa'){$d='OT'; $nm='oomo_toa';}
elseif($p=='Oyagaa Ayoo Yissaa'){$d='OAY'; $nm='oyagaaayuyisaa';}
elseif($p=='312oay'){$d='312'; $nm='312oay';}
elseif($p=='Unio Mentalis'){$d='Um'; $nm='unio_mentalis';}
$rk=['title','temp title','new title','diff date','msg','diff link'];
//$na=0; $nac=0; $nad=0; $nae=0; 
$nb0=0; $nb1a=0; $nb1b=0; $nb2=0; $nb3=0; $time=''; $nf1=1; $nf2=1; $nf3=1; $nf4=1;
$date2b1=0; $date2b2=0; $date2b3=0; $date2b4=0;
if($r)foreach($r as $k=>$v){
	//$id=$v[0]; $day=$v[1]; $suj=$v[2]; $lk=$v[3]; $msg=$v[4];
	[$id,$day,$suj,$lk,$msg]=arr($v,5);
	//$msg=sql('msg','qdm','v','id='.$id);
	$suj=str_replace('@'.$nm.' ','',$suj);
	$newtit=$suj;
	//date from twitter
	//if(!$_SESSION['twtime'][$id])$_SESSION['twtime'][$id]=self::twit_time($v[2]);
	//if($_SESSION['twtime'][$id])sql::upd('qda',['day'=>$_SESSION['twtime'][$id]],$id);
	//$date=strftime("%R - %e %b %G",$day);//deprecated
	$date2a=date('ymd',$day);
	$rb=ma::art_tags($id); //echo $id.'-'; p($rb['info']);
	//fullnum
	/*if($d=='O6' or $d=='OW'){$na++;
		if($rb['info']['favoris']){$nac++; $newtit='['.$d.'-'.$na.'][Like '.$nac.']';}//.$date
		elseif($rb['info']['retweet']){$nad++; $newtit='['.$d.'-'.$na.'][Retweet '.$nad.']';}//.$date
		elseif($rb['info']['status']){$nae++; $newtit='['.$d.'-Status '.$nae.']';}//.$date
		else{$newtit='['.$d.'-'.$na.']';}//.$date
	}
	else*/
	if($d=='OT' or $d=='OAY' or $d=='O6' or $d=='OW' or $d=='312' or $d=='Um'){//
		if(valr($rb,'info','favoris')){$nb1a++;
			if($date2a==$date2b1){$nf1++; $date2=$date2a.'-'.$nf1;} else{$nf1=1; $date2=$date2a;}
			$newtit='['.$d.'-Like '.$nb1a.'] '.$date2; $newtit2=$newtit;
			$date2b1=$date2a;}
		elseif(valr($rb,'info','retweet') && ($d=='OW' or $d=='OAY')){$nb1b++;//
			if($date2a==$date2b1){$nf1++; $date2=$date2a.'-'.$nf1;} else{$nf1=1; $date2=$date2a;}
			$newtit='['.$d.'-Retweet '.$nb1b.']'; $newtit2=$newtit;}
		elseif(valr($rb,'info','status')){$nb2++;
			if($date2a==$date2b2){$nf2++; $date2=$date2a.'-'.$nf2;} else{$nf2=1; $date2=$date2a;}
			$newtit='['.$d.'-Status '.$nb2.'] '.$date2; $newtit2=$newtit;
			$date2b2=$date2a;}
		elseif(valr($rb,'info','pinned')){$nb3++;
			if($date2a==$date2b4){$nf4++; $date2=$date2a.'-'.$nf4;} else{$nf4=1; $date2=$date2a;}
			$newtit='['.$d.'-Pinned '.$nb3.'] '.$date2; $newtit2=$newtit;
			$date2b4=$date2a;}
		/*elseif(valr($rb,'info','bis')){
			$date2=$date2a;
			$newtit='['.$d.'-'.$nb0.' Bis] '.$date2; $newtit2=$newtit;
			$date2b4=$date2a;}*/
		else{$nb0++;
			if($date2a==$date2b3){$nf3++; $date2=$date2a.'-'.$nf3;} else{$nf3=1; $date2=$date2a;}
			$newtit='['.$d.'-'.$nb0.'] '.$date2; $newtit2=$newtit;
			$date2b3=$date2a;}
	}
	/*elseif($d=='312'){$nb0++;//
		if($date2a==$date2b3){$nf3++; $date2=$date2a.'-'.$nf3;} else{$nf3=1; $date2=$date2a;}
		$newtit='['.$d.'-'.$nb0.'] '.$date2; $newtit2=$newtit;
		$date2b3=$date2a;}*/
	/*else{//old with
		$suj=str_replace('&nbsp;',' ',$suj);
		if(strpos($suj,'::')){[$num,$tit]=explode('::',$suj);
			$newtit='['.strtoupper(trim($num)).'] '.trim($tit);}
		else $newtit=$suj;}*/
	else{[$num,$tit]=explode(']',$suj); $newtit=strtoupper(trim($num)).'] '.trim($tit);}
	$rc[$id]=$newtit;
	//if(strpos($suj,'@')===false){}
	#sql::upd('qda',['suj'=>$newtit],$id);
	//$ret[]=[ma::popart($id,$newtit),$time,$msg];
	if(auth(6))$bt=blj('','k'.$id,'umrenum,sav___'.$id.'_'.ajx($newtit),pictxt('save',$newtit));
	if($newtit!=$suj)$sav=$bt; else $sav='';
	$ret[$day]=[ma::popart($id,$suj),$sav,$newtit2,$time,divs('width:400px;',$msg)];
	//$ret[$day]=[$newtit,$sav,$newtit2,$time,divs('width:400px;',$msg)];
}
krsort($ret);
//ksort($ret);
if($ob)return $rc[$ob];//give asked
return tabler($ret,$rk);}

static function sav($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
sql::upd('qda',['suj'=>$o],$p);
return 'ok';}

static function last($p,$o){
if(!$p)$p='Oyagaa Ayoo Yissaa';
$ret=self::build($p,'',$o);
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$ret=self::build($p,$o);
return $ret;}

static function r(){
foreach(umrec::$cats as $v)$ret[$v]=$v;
return $ret;}

static function menu($p,$o,$rid){
if(!$p)$p='Oyagaa Ayoo Yissaa';//Oomo Toa//oaxiiboo 6//
$ret=select_j('inp','pclass','','umrenum/r','','2');
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_umrenum,call_inp',picto('ok')).' ';
$ret.=hlpbt('umrennum');
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
if(!$p)$p='Oyagaa Ayoo Yissaa';
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>