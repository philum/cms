<?php
//philum/b/search
class search{
static $rp=[];

//spe
static function next_sptime($d){//,4015,4380,4745,5110,5475,5840
$r=array(1,7,30,90,365); for($i=5;$i<22;$i++){$r[]=$r[$i-1]+365;}
$k=in_array_b($d,$r);
if($rk1=$r[$k+1]??'')return $_GET['dig']=$rk1;}

static function dig_h($n,$rid){$r=define_digr(); $nprev=time_prev($n);
if(!$rn=$r[$n]??'')$r[$n]=$n>=365?round($n/365,2):$n; $cur=$rn;
if($n!=1 && $n!=7)$r[$n]=($r[$nprev]??'').' '.nms(36).' '.$rn;//from
$r[$n].=' '.($n<365?plurial($cur,3):plurial($cur,7));
if($n>365)$r[$n]=date('Y',calc_date($n));//from
return menuder_h($r,'srdig',$n,atj('Search2',$rid));}

static function pag_h($tot,$rid){$pg=$_SESSION['page'];
$nbp=ceil($tot/$_SESSION['prmb'][6]);
if($nbp>1)for($i=1;$i<=$nbp;$i++)$r[$i]=$i;
if($nbp>1)return menuder_h($r,'srpag',$pg,atj('Search2',$rid));
else return hidden('','srpag',1);}

static function mkurl($r){$n=count($r); $ret='';
for($i=0;$i<$n;$i++){if($g=get($r[$i]))$ret.='&'.$r[$i].'='.$g;}
return $ret;}

//titles
static function titles($rech,$dig,$opt,$cac,$cat,$tag,$lim,$lng,$vrf,$tot){
list($bol,$ord,$tit,$seg,$pag)=opt($opt,'-',5); $ret='';
$load=ses('load'); $days=get('dig',$dig); //$rf=self::$rf;
//if(strpos($rech,','))$bol=1;
$_GET['bool']=$bol; $_GET['seg']=$seg;
//$ret.=btn('search',input1('search',$rech,32,'','',150)).' ';
$rid=randid('search');
$js='onkeyup="checksearch2(event,\''.$rid.'\')"';
$inp=input1($rid,$rech,32,'','',150,$js);
$ret.=btn('search',$inp).' ';
//$rmd=explode(' ','word tag '.prmb(18)); if(auth(6))$ret.=select(atd('mode'),$rmd);
$ret.=ljb('popsav','Search2',$rid,picto('search').' '.nms(24)).' '.hlpbt('search').' ';
$rg=sql('cat','qdt','rv','tag="'.$rech.'"');//if($dig==7){}
	$rp=array_combine(explode(' ','tag '.prmb(18)),explode(' ','tag '.prmb(19)));
	if($rg)foreach($rg as $k=>$v)$ret.=lj('popbt','popup_api__3_'.$v.':'.ajx($rech),pictxt($rp[$v]),att($v));
if($cac)$ret.=blj('popbt','srcac','search,rech___'.$vrf,picto('del'),att('del cache'));
if(strpos($rech,','))$api='search:'.$rech; else $api='search:'.$rech.',cat:'.str_replace('+','|',$cat).',tag:'.str_replace('+','|',$tag);
$ret.=toggle('txtx','apicom_plug_apicom_apicom*search_'.ajx($api).'_'.$rid,pictxt('atom','Api')).' ';
if($load)$ret.=btn('txtnoir',nbof(count($load),1));//if(auth(6))$ret.=nbof(array_sum_r($load),16);
if(rstr(3))$ret.=br().self::dig_h($days,$rid); else $ret.=hidden('','srdig','');//days//maxdays()
if(!isset($_SESSION['rstr62']))$_SESSION['rstr62']=rstr(62);
if(rstr(3))$ret.=togses('rstr62',pictit('after',nms(134))).' ';//dig
$urg=self::mkurl(['bool','titles','cat','tag']);
if($rech)$ret.=lkc('',htac('search').protect_url($rech).($dig?'/'.$dig:''),picto('link')).' ';//.$urg
if(ses('qb')=='ummo'){$ret.=lj('popbt','popup_plupin___umvoc_'.ajx($rech).'_1','vocables');//bdvoc
	$ret.=lj('popbt','popup_plupin__3_umrec_'.ajx($rech),'twits');}
$ret.=br();
$bt=checkact('srord',$ord,nms(165)).' ';
$bt.=checkact('srtit',$tit,nms(72)).' ';
$bt.=checkact('srbol',$bol,nms(70)).' ';//.''.hlpbt('bool')
$bt.=checkact('srseg',$seg,nms(180)).' ';
$bt.=self::slct_cases('srlng','lang',$lng,1,nms(162)).' ';//
$bt.=self::slct_cases('srcat','cat',$cat,1,nms(9)).' ';//chkslct_j
$bt.=self::slct_cases('srtag','tag',$tag,'','tag').' ';//prm4=catag; 0=all
$ret.=btn('nbp',$bt);
$ret.=hlpbt('search_cases').' ';
$ret.=select_j('limit','-|1|2|3|4|5|10|20|50',$lim,'1',$lim?$lim:'limit').' ';
if(auth(4))$ret.=togbub('call','meta_tagall*slct_'.ajx($vrf).'_'.ajx($rech),picto('paste')).' ';
if(auth(4))$ret.=lj('','popup_searched,home__3_'.ajx($rech),picto('enquiry'));
if($nboc=get('nboc'))$ret.=btn('txtbox',nbof($nboc,16));
$ret.=div('',self::pag_h($tot,$rid));//pages
return $ret;}

//motor
static function except_words($d){$r=['de','des','du','dans','le','les','la','un','a','à','ou','où','on','en','y','«','»',"'",'"',':','-','!','?'];
if(!in_array($d,$r))return true;}

static function tag($tag,$catag){
$qda=ses('qda'); $qdta=ses('qdta'); $rtag=explode('~',$tag); $rta=[]; $rtb=[];
foreach($rtag as $v){$ad=substr($v,0,1);
	if($ad=='+')$rta[]=substr($v,1); elseif($ad=='-')$rtb[]=substr($v,1);}
if($rta){$w='where tag in ("'.implode('","',$rta).'")';
	$rtg=sql_inner('idart','qdt','qdta','idtag','rv',$w);
	$tg=' and '.$qda.'.id in ("'.implode('","',$rtg).'")';}
if($rtb){$w='where tag in ("'.implode('","',$rtb).'")';
	$rtg=sql_inner('idart','qdt','qdta','idtag','rv',$w);
	$tg.=' and '.$qda.'.id not in ("'.implode('","',$rtg).'")';}
return ' inner join '.$qdta.' on '.$qda.'.id='.$qdta.'.idart '.$tg;}

static function lng($tag){
$qda=ses('qda'); $qdd=ses('qdd'); $r=explode('~',$tag); $lgs=prmb(25);
foreach($r as $v){$ad=substr($v,0,1); $slg=substr($v,1);
	if($ad=='+')$rta[]=$slg; elseif($ad=='-')$rtb[]=$slg;}
if($rta)$tg=' and lg in ("'.implode('","',$rta).'")';
if(isset($rtb))$tg.=' and lg not in ("'.implode('","',$rtb).'")';
return $tg;}

static function call($rch,$days=''){
$tit=get('titles')?1:0;
$ord=get('ord'); $cat=get('cat'); $tag=get('tag'); //if($tag=='tag')$tag='';
$lim=get('lim'); if($lim=='-')$lim='';
$lng=get('lng'); if($lng=='-')$lng='';
$qb=ses('qb'); $qda=ses('qda'); $qdm=ses('qdm'); $qdt=ses('qdt'); $qdta=ses('qdta');
//sql
$fr='k';//filter
$ft='';//fulltext//score:1->11//bool:nb of verified words
//if($_SERVER['HTTP_HOST']=='oumo.fr')
//$ft='MATCH (msg) AGAINST ("'.$rch.'")';//'.(get('bool')?' IN BOOLEAN MODE':'').'//method of intersect
if(rstr(3)){$days=$days?$days:ses('nbj'); $sq['daymin']='day>'.calc_date($days);}
$daya=time_prev($days); $daya=$daya?calc_date($daya):ses('daya');
$sq['daymax']='day<'.$daya;
$sqnd['suj']='suj LIKE "%'.$rch.'%" ';
$sq['nod']='nod="'.$qb.'"';
$sq['frm']='substring(frm,1,1)!="_"';
$sq['re']='re>0';
if(!$tit && $rch){
	//$sqin['msg']='inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id';
	$sqin['msg']='natural join '.$qdm;
	if($ft)$sqnd['msg']=$ft;
	elseif(get('seg'))$sqnd['msg']=$qdm.'.msg REGEXP "[[:<:]]'.$rch.'[[:>:]]"';
	else $sqnd['msg']=$qdm.'.msg LIKE "%'.$rch.'%" ';}
if($cat){
	$rcat=explode('~',$cat); $rca=[]; $rcb=[];
	foreach($rcat as $v){$ad=substr($v,0,1);
	if($ad=='+')$rca[]=substr($v,1); elseif($ad=='-')$rcb[]=substr($v,1);}
	if($rca)$sq['cat']='frm in ("'.implode('","',$rca).'")';
	if($rcb)$sq['nocat']='frm not in ("'.implode('","',$rcb).'")';}
if($tag)$sqin['tag']=self::tag($tag,'tag');
if($lng)$sqin['lng']=self::lng($lng);
//$rchb=get('seg')?'[[:<:]]'.$rch.'[[:>:]]':$rch;//REGEXP_REPLACE//(?i) //mariadb is sensitive
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
$ret=sql_b($sql,$fr,0);//auth(6)?1:
if($ord && $ret)arsort($ret);
//loop
//if(auth(6))echo ses('rstr62').'-'.count($ret);
if(!$ret && $rch && (rstr(62) or ses('rstr62'))){
	$ndig=self::next_sptime($days); if($ndig)get('dig',$ndig);
	if($ndig)return self::call($rch,$ndig);}
return $ret;}

static function rechday($d){
$first=sql('day','qda','v','day>'.$d.' limit 1'); //if(auth(6))echo date('y m d',$first);
$ret=sql_b('select '.ses('qda').'.id from '.ses('qda').' where nod="'.ses('qb').'" and substring(frm,1,1)!="_" and day<='.$first.' order by day desc limit 200','k',0);//auth(6)?1:
return $ret;}

static function slct_cases($id,$f,$v='',$o='',$t=''){$rid=randid();//hidslct_j
$hid='bt'.$id; $j=$id.'_'.$f.'_'.ajx($v).'_'.ajx($o).'_'.$id;
$c=$v?'active':''; $t=$t?$t:($v?$v:'...'); $h=hidden($id,$id,$v);
return lj($c.'" id="'.$hid,'popup_chkj__'.$hid.'_'.$j,$t).$h;}

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

static function home($d,$n,$opt='',$res=''){chrono();
[$b,$o,$t,$sg,$pg]=opt($opt,'-',5); $_SESSION['page']=$pg?$pg:1;
$rech=good_rech($d); $_GET['search']=$rech; [$cat,$tag,$lim,$lng]=ajxr($res,4);
$rech=str_replace(["’",'«','»',"&nbsp;"],["'",'"','"',' '],trim($rech));
if(!$n)$n=$_SESSION['nbj'];  $cac=''; $nb=0;
$_GET['dig']=$n; $_GET['ord']=$o; $_GET['cat']=$cat; $_GET['tag']=$tag; $_GET['lim']=$lim; //if(strpos($rech,','))$b=1; 
$lg=ses('lang'); if(!$lng && $lg!='all')$lng='+'.$lg; $_GET['lng']=$lng; 
$_GET['bool']=$b; $_GET['titles']=$t; $_GET['seg']=$sg;
//self::$rp=['dig'=>$n,'bool'=>$b,'ord'=>$o,'titles'=>$t,'seg'=>$sg,'page'=>$pg,'cat'=>$cat,'tag'=>$tag,'lim'=>$lim,'lng'=>$lng,'cac'=>'','nb'=>0,'nboc'=>0];
$vrf=($rech.$n.$b.$o.$t.$sg.$cat.$tag.$lim.$lng);
if(!isset($_SESSION['recache']))$_SESSION['recache'][$vrf]=[];
$maxid=lastid('qda');
if(!is_numeric($rech) && strlen($rech>7))$isdate=strtotime($rech);
if($rech=='1'){$id=$maxid; $load[$id]=1; return art_read_b($id,3);}
//if(is_numeric($rech) && $rech<=$maxid)return art_read_b($rech,3); //$load[$rech]=1;
elseif(strpos($rech,',') && strpos($rech,':')){
	$ra=explode_k($rech,',',':');
	foreach($ra as $k=>$v)//{//inform motor
		if($k=='search' or $k=='')$_GET['search']=$v;
		//if($k=='cat')$_GET['cat']=$cat='+'.str_replace('|','~+',$v);
		//if($k=='tag')$_GET['tag']=$tag='+'.str_replace('|','~+',$v);}
	$ra['idlist']=1; $ra['nbyp']='1000'; $ra['lang']=$lng;
	$ra=api::defaults_rq($ra,1,''); if($ra)$load=api::callr($ra);}
elseif(!empty($_SESSION['recache'][$vrf])){$load=$_SESSION['recache'][$vrf]; $cac=$vrf;}
elseif(!empty($isdate)){$n=daysfrom($isdate); $_GET['dig']=$n; $load=self::rechday($isdate);}
elseif($b){//=='x'
	$parts=explode(' ',$rech); $cp=count($parts);
	foreach($parts as $v)if($v)$ra[]=self::call(trim($v),$n);
	$load=self::array_intersect_d($ra);}
elseif($vrf==normalize($rech.$n,['-']) && !ses('rstr62'))$load=searched::search_add($rech,$n);
else $load=self::call($rech,$n);
if(is_numeric($rech) && $rech<=$maxid)$load[abs($rech)]=1;
if($load && !is_array($load))$load=[];
//if(!$load && $sg){$_GET['seg']=1; $load=self::call($rech,$n); $opt='---1';}//less fast
//if($sg)$opt='---1';
if($load){$_SESSION['load']=$load; $_SESSION['recache'][$vrf]=$load; $nb=count($load);} //if(auth(6))p($load);
if($pg>ceil($nb/$_SESSION['prmb'][6]) or ses('oldig')!=$n)$_SESSION['page']=1;
if(isset($load[0]))unset($load[0]); if(isset($load[1]))unset($load[1]);
if($load)$res=output_arts($load,'rch','art');
$ret=self::titles($rech,$n,$opt,$cac,$cat,$tag,$lim,$lng,$vrf,$nb);
$ret.=divd('apicom','');
$_SESSION['popm']=chrono('search'); $_SESSION['oldig']=$n;
if($load)$ret.=scroll($load,divd($vrf,$res),2,'',400);
return $ret;}

}
?>