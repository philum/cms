<?php //b/search
class search{
static $rp=[];
static $rch='';

//bt
static function next_sptime($d){//,4015,4380,4745,5110,5475,5840
$r=[1,7,30,90,365]; for($i=5;$i<22;$i++){$r[]=$r[$i-1]+365;}
$k=in_array_b($d,$r);
if($rk1=$r[$k+1]??'')return self::$rp['dig']=$rk1;}

static function dropmenu($r,$id,$d,$j){$i=0; $rt='';
foreach($r as $k=>$v){$jx=atjr('jumpvalue',[$id,$k]).' ';
	$jx.=atjr('active_list',['div'.$id,$i,'active','']).' '.$j; $i++;
	$rt.=btj($v,$jx,active($d,$k)).' ';}
$ret=span(atd('div'.$id).atc('nbp'),$rt).hidden($id,$d);
return $ret;}

static function dig($n,$rid){$r=pop::define_digr(); $nprev=time_prev($n);
if(!$rn=$r[$n]??'')$r[$n]=$n>=365?round($n/365,2):$n; $cur=$rn;
if($n!=1 && $n!=7)$r[$n]=($r[$nprev]??'').' '.nms(36).' '.$rn;//from
$r[$n].=' '.($n<365?plurial($cur,3):plurial($cur,7));
if($n>365)$r[$n]=date('Y',timeago($n));//from
return self::dropmenu($r,'srdig',$n,atj('Search2',$rid));}

static function pages($tot,$rid){$pg=get('page');
$nbp=ceil($tot/$_SESSION['prmb'][6]);
if($nbp>1)for($i=1;$i<=$nbp;$i++)$r[$i]=$i;
if($nbp>1)return self::dropmenu($r,'srpag',$pg,atj('Search2',$rid));
else return hidden('srpag',1);}

static function mkurl($r){$n=count($r); $ret='';
for($i=0;$i<$n;$i++){if($g=self::$rp[$r[$i]])$ret.='&'.$r[$i].'='.$g;}
return $ret;}

static function pictag($d,$t=''){
$r=array_combine(explode(' ','tag '.prmb(18)),explode(' ','tag '.prmb(19)));
return pictxt($r[$d]??'tag',$t);}

//titles
static function titles($vrf,$tot,$cac){$rt3='';
[$rech,$dig,$bol,$ord,$tit,$seg,$pag,$cat,$tag,$lim,$lng,$pri,$len]=arb(self::$rp);
$load=ses('load'); $rid=randid('search');
$rj=['onkeyup'=>atj('checksearch',$rid)];
$rt1=btn('search',inputb($rid,$rech,32,'',150,$rj)).' ';
//$rmd=explode(' ','word tag '.prmb(18)); if(auth(6))$rt1.=select(['id'=>'mode'],$rmd);
$rt1.=ljb('popsav','Search2',$rid,picto('search').' '.nms(24)).' '.hlpbt('search').' ';
$rg=sql('cat','qdt','rv','tag="'.$rech.'"');
if($rg)foreach($rg as $k=>$v)$rt1.=lj('popbt','popup_api__3_'.$v.':'.ajx($rech),self::pictag($v),att($v));
if($cac)$rt1.=blj('popbt','srcac','search,rech___'.$vrf,picto('del'),att('del cache'));
if($rech && strpos($rech,','))$api='search:'.$rech; else $api='search:'.$rech.',cat:'.str_replace('+','|',$cat).',tag:'.str_replace('+','|',$tag);
$rt1.=toggle('txtx','apicom_apicom,search___'.ajx($api).'_'.$rid,pictxt('atom','Api')).' ';
if($load)$rt1.=btn('txtnoir',nbof(count($load),1));//if(auth(6))$rt1.=nbof(array_sum_r($load),16);
$ret=div('',$rt1);
//2
$bt=checkact('srord',$ord,nms(165)).' ';
$bt.=checkact('srtit',$tit,nms(72)).' ';
$bt.=checkact('srbol',$bol,nms(70)).' ';//.''.hlpbt('bool')
$bt.=checkact('srseg',$seg,nms(180)).' ';
$rt2=btn('nbp',$bt);
$rt2.=slct_cases('srlng','lang',$lng,1,nms(162)).' ';//
$rt2.=slct_cases('srcat','cat',$cat,1,nms(9)).' ';//chkslct_j
$rt2.=slct_cases('srtag','tag',$tag,'','tag').' ';//prm4=catag; 0=all
$rt2.=hlpbt('search_cases').' ';
$rt2.=select_j('limit','-|1|2|3|4|5|10|20|50',$lim,'1',$lim?$lim:'limit').' ';
$rt2.=select_j('srlen','-|10|20|30|60|more',$len,'1',$len?$len:'length').' ';
$rt2.=slct_cases('srpri','pri',$pri,'','stars').' ';
if(auth(4))$rt2.=togbub('meta,tagall*slct',ajx($vrf).'_'.ajx($rech),picto('paste')).' ';
if(auth(4))$rt2.=lj('','popup_searched,home__3_'.ajx($rech),picto('enquiry'));
if($nboc=ses::$nb)$rt2.=btn('txtbox',nbof($nboc,16));
$ret.=div('',$rt2);
//3
if(rstr(3) && !isset(self::$rp['nodig']))$rt3=self::dig($dig,$rid); else $rt3.=hidden('srdig','');//days//ma::maxdays()
if(!isset($_SESSION['rstr62']))$_SESSION['rstr62']=rstr(62);
if(rstr(3))$rt3.=togses('rstr62',pictit('after',nms(134),16)).' ';//dig
//$urg=self::mkurl(['bool','titles','cat','tag']);
if($rech)$rt3.=lh('search/'.$rech.($dig?'/'.$dig:''),picto('link',16)).' ';//.$urg
if(ses('qb')=='ummo'){$rt3.=lj('popbt','popup_umvoc,home___'.ajx($rech).'_1','vocables');//bdvoc
	$rt3.=lj('popbt','popup_umrec,home__3_'.ajx($rech),'twits');}
	$ret.=div('',$rt3);
$ret.=div('',self::pages($tot,$rid));//pages
return $ret;}

//motor
static function except_words($d){$r=['de','des','du','dans','le','les','la','un','a','?','ou','o?','on','en','y','?','?',"'",'"',':','-','!','?'];
if(!in_array($d,$r))return true;}

static function tag($tag,$catag){
$qda=ses('qda'); $qdta=ses('qdta'); $rtag=explode('~',$tag); $rta=[]; $rtb=[]; $tg='';
foreach($rtag as $v){$ad=substr($v,0,1);
	if($ad=='+')$rta[]=substr($v,1); elseif($ad=='-')$rtb[]=substr($v,1);}
if($rta){$w=['tag in'=>$rta];
	$rtg=sql::inner('idart','qdt','qdta','idtag','rv',$w);
	$tg=' and '.$qda.'.id in ("'.implode('","',$rtg).'")';}
if($rtb){$w=['tag in'=>$rtb];
	$rtg=sql::inner('idart','qdt','qdta','idtag','rv',$w);
	$tg.=' and '.$qda.'.id not in ("'.implode('","',$rtg).'")';}
return ' inner join '.$qdta.' on '.$qda.'.id='.$qdta.'.idart '.$tg;}

static function adds($tag,$col){$sq=[]; $rta=[]; $rtb=[];
$qda=ses('qda'); $r=explode('~',$tag); $lgs=prmb(25);
foreach($r as $v){$ad=substr($v,0,1); $slg=substr($v,1);
	if($ad=='+'){$rta[]=$slg; if($slg==$lgs)$rta[]='';}
	elseif($ad=='-'){$rtb[]=$slg; if($slg==$lgs)$rtb[]='';}}
if($rta)$sq[]=$col.' in ("'.implode('","',$rta).'")';
if($rtb)$sq[]=$col.' not in ("'.implode('","',$rtb).'")';
return $sq;}

static function call($rch,$days=''){$rp=self::$rp;
[$rech,$dig,$bol,$ord,$tit,$seg,$pag,$cat,$tag,$lim,$lng,$pri,$len]=arb(self::$rp);
$tit=$tit?1:0; //if($tag=='tag')$tag='';
$qb=ses('qb'); $qda=ses('qda'); $qdm=ses('qdm'); $qdt=ses('qdt'); $qdta=ses('qdta');
//sql
$fr='k';//filter
$ft='';//fulltext//score:1->11//bool:nb of verified words
//if(ses('qb')=='ummo')
//$ft='MATCH (msg) AGAINST ("'.$rch.'")';//'.($bol?' IN BOOLEAN MODE':'').'//method of intersect
if(rstr(3)){$days=$days?$days:ses('nbj'); $sq['daymin']='day>'.timeago($days);}
$daya=time_prev($days); $daya=$daya?timeago($daya):ses('daya');
$sq['daymax']='day<'.$daya;
$sqnd['suj']='suj LIKE "%'.$rch.'%" ';
$sq['nod']='nod="'.$qb.'"';
$sq['frm']='substring(frm,1,1)!="_"';
$sq['re']='re>0';
if(!$tit && $rch){
	//$sqin['msg']='inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id';
	$sqin['msg']='natural join '.$qdm;
	if($ft)$sqnd['msg']=$ft;
	elseif($seg)$sqnd['msg']=$qdm.'.msg REGEXP "[[:<:]]'.$rch.'[[:>:]]"';
	else $sqnd['msg']=$qdm.'.msg LIKE "%'.$rch.'%" ';}
if($cat){
	$rcat=explode('~',$cat); $rca=[]; $rcb=[];
	foreach($rcat as $v){$ad=substr($v,0,1);
	if($ad=='+')$rca[]=substr($v,1); elseif($ad=='-')$rcb[]=substr($v,1);}
	if($rca)$sq['cat']='frm in ("'.implode('","',$rca).'")';
	if($rcb)$sq['nocat']='frm not in ("'.implode('","',$rcb).'")';}
if($tag)$sqin['tag']=self::tag($tag,'tag');
if($lng)$sq['lng']=implode(' and ',self::adds($lng,'lg'));
if($pri)$sq['re']=implode(' and ',self::adds($pri,'re'));
if($len){if($len==60)$min=30; elseif($len=='more'){$min=60; $len=1000;} else $min=$len-10;
$sq['host']='(host between '.($min*1400).' and '.($len*1400).')';}
//$rchb=$seg?'[[:<:]]'.$rch.'[[:>:]]':$rch;//REGEXP_REPLACE//(?i) //mariadb is sensitive
$counter='FLOOR((LENGTH('.$qdm.'.msg)-LENGTH(REPLACE(lower('.$qdm.'.msg),lower("'.$rch.'"),"")))/(LENGTH("'.$rch.'")))';
if($lim)$sq['lim']=$counter.'>='.$lim;
//req
$wh=implode(' and ',$sq);
if($sqnd['suj'] && isset($sqnd['msg']))$wh.=' and ('.$sqnd['msg'].' or '.$sqnd['suj'].')';
elseif($sqnd['suj'])$wh.=' and '.$sqnd['suj']; elseif($sqnd['msg']) $wh.=' and '.$sqnd['msg'];
if(isset($sqin))$inner=implode('',$sqin); else $inner='';
$slct[]=$qda.'.id';
//if($ft)$slct[]=$ft.' as score';//change $fr
$w=' where '.$wh.' order by '.$qda.'.'.prmb(9);
if($ord){$fr='kv'; $slct[]=$counter.' as nb';}//scores
$sql='select '.implode(',',$slct).' from '.$qda.' '.$inner.$w;
$ret=sql::call($sql,$fr,0);
if($ord && $ret)arsort($ret);
//loop
//if(auth(6))echo ses('rstr62').'-'.count($ret);
if(!$ret && $rch && (rstr(62) or ses('rstr62'))){
	$ndig=self::next_sptime($days); if($ndig)self::$rp['dig']=$ndig;
	if($ndig)return self::call($rch,$ndig);}
return $ret;}

static function rechday($d){
$first=sql('day','qda','v','day>"'.$d.'" limit 1');
$ret=sql::call('select '.ses('qda').'.id from '.ses('qda').' where nod="'.ses('qb').'" and substring(frm,1,1)!="_" and day<="'.$first.'" order by day desc limit 200','k',0);//auth(6)?1:
return $ret;}

static function array_intersect_c($r){$rt=[]; $rb=[]; $mx=1;
if($r)foreach($r as $k=>$v)if($v)foreach($v as $ka=>$va)$rb[$ka]=radd($rb,$ka,1); if($rb)$mx=max($rb);
if($rb)foreach($rb as $k=>$v)if($v==$mx)$rt[$k]=1;
return $rt;}

static function array_intersect_d($r){$n=count($r); $rb=$r[0];
for($i=1;$i<$n;$i++)$rb=array_intersect_key($rb,$r[$i]);//array_intersect_assoc
return $rb;}

static function rech($p){
if(isset($_SESSION['recache'][$p])){$_SESSION['recache'][$p]=[]; return 'x';}
elseif(isset($_SESSION['recache']))$_SESSION['recache']=[]; return 'xx';}

static function good_rech($d){if(!$d)return; $d=str::utflatindecode($d); $d=str::clean_acc($d);
$d=str_replace("&nbsp;",' ',$d); $d=strip_tags($d); $d=stripslashes($d); return trim($d);}

static function home($d0,$n0,$prm=[]){chrono(); $load=[]; $ret='';
[$d,$n,$b,$o,$t,$sg,$pg,$cat,$tag,$lim,$lng,$pri,$len]=arr($prm,13); $d=$d?$d:$d0; $n=$n?$n:$n0;
$rech=self::good_rech($d); $pg=$pg?$pg:1; if(!$n)$n=ses('nbj'); $cac=''; $nb=0;
if($lim=='-')$lim=''; if($lng=='-')$lng=''; if($pri=='-')$pri=''; if($len=='-')$len='';
geta('search',$rech); geta('page',$pg);
self::$rp=['rech'=>$rech,'dig'=>$n,'bool'=>$b,'ord'=>$o,'titles'=>$t,'seg'=>$sg,'page'=>$pg,'cat'=>$cat,'tag'=>$tag,'lim'=>$lim,'lng'=>$lng,'pri'=>$pri,'len'=>$len];
$vrf=($rech.$n.$b.$o.$t.$sg.$cat.$tag.$lim.$lng.$pri.$len); ses::$r['seg']=$sg;
if(!isset($_SESSION['recache']))$_SESSION['recache'][$vrf]=[];
$maxid=ma::lastart();
//if(is_float($rech))echo $rech=(string) $rech; 
if(!is_numeric($rech) && strlen($rech>7))$isdate=strtotime($rech);
if($rech=='1'){$id=$maxid; $load[$id]=1; return popart($id);}
//if(is_numeric($rech) && $rech<=$maxid)return art::playb($rech,3);
elseif($rech && strpos($rech,',') && strpos($rech,':')){
	$ra=explode_k($rech,',',':');
	foreach($ra as $k=>$v)//{//inform motor
		if($k=='search' or $k=='')self::$rp['search']=$v;
		//if($k=='cat')self::$rp['cat']=$cat='+'.str_replace('|','~+',$v);
		//if($k=='tag')self::$rp['tag']=$tag='+'.str_replace('|','~+',$v);}
	//self::$rp['nodig']=1; 
	$ra['idlist']=1; $ra['lang']=$lng; $ra['dig']=$n; 
	if($t)$ra['title']=self::$rp['search']; $ra['nbyp']='10000';//tip
	$ra=api::defaults_rq($ra,['pg'=>1]); if($ra)$load=api::callr($ra);}
elseif(!empty($_SESSION['recache'][$vrf])){$load=$_SESSION['recache'][$vrf]; $cac=$vrf;}
elseif(!empty($isdate)){$n=daysfrom($isdate); self::$rp['dig']=$n; $load=self::rechday($isdate);}
elseif($b){//=='x'
	$parts=explode(' ',$rech); $cp=count($parts);
	foreach($parts as $v)if($v)$ra[]=self::call(trim($v),$n);
	$load=self::array_intersect_d($ra);}
elseif($rech && $vrf==normalize($rech.$n,1) && !ses('rstr62') && !is_numeric($rech))
	$load=searched::add($rech,$n);
else $load=self::call($rech,$n);
if(is_numeric($rech) && strpos($rech,'.')===false && $rech<=$maxid)$load[abs($rech)]=1;
if($load && !is_array($load))$load=[];
//if(!$load && $sg){self::$rp['seg']=1; $load=self::call($rech,$n);}//less fast
if($load){$_SESSION['load']=$load; $_SESSION['recache'][$vrf]=$load; $nb=count($load);}
if($pg>ceil($nb/$_SESSION['prmb'][6]) or ses('oldig')!=$n)geta('page',1);
if(isset($load[0]))unset($load[0]); if(isset($load[1]))unset($load[1]);
if($load)$res=ma::output_arts($load,'rch','art');
$ret=self::titles($vrf,$nb,$cac);
$ret.=divd('apicom','');
ses::$r['popm']=chrono('search'); $_SESSION['oldig']=$n;
if($load)$ret.=scroll($load,divd($vrf,$res),2,'',400);
return $ret;}

}
?>