<?php 
class msqarts{

//twitter date
//07:01 - 13 juin 2015
static function clean_day_tw($d){//echo $d.br();
$dr=['jan'=>'01','fev'=>'02','mars'=>'03','avr.'=>'04','mai'=>'05','juin'=>'06','juil'=>'07','août'=>'08','sept'=>'09','oct'=>'10','nov'=>'11','déc'=>'12','Dec'=>'12'];
[$h,$y]=split_right('-',$d); 
$hr=explode(':',trim($h)); //echo $h.br();
$yr=explode(' ',trim($y)); 
$yr[0]=strlen($yr[0])==1?'0'.$yr[0]:$yr[0];
$yr[1]=str_replace(array_keys($dr),array_values($dr),$yr[1]);
//echo $y.br(); //p($hr);
$month=is_numeric($yr[1])?$yr[1]:$dr[strtolower($yr[1])];
$hour=is_numeric($hr[0])?$hr[0]:strend($hr[0],' ');
$tim=@mktime($hour,$hr[1],0,$month,$yr[0],$yr[2]);
//if(!$tim)p($hr);
return $tim;}

//15.06.06 07.10 (143)
static function clean_day($d){//echo $d.br();
$d=str_replace("&nbsp;",'',$d);
for($i=0;$i<15;$i+=3)$r[]=substr($d,$i,2); //p($r);
$tim=mktime($r[3],$r[4],0,$r[1],$r[2],$r[0]);
//if(!$tim)p($r);
return $tim;}

static function clean_msg($d){
$d=str_replace(array('[',']'),'',$d);
$d=str_replace("\n",' :n: ',$d);
$r=explode(' ',$d);
//$rm=['jan.','fév.','mars','avr.','mai','juin','juil.','août','sept.','oct.','nov.','déc.'];
foreach($r as $k=>$v){
	//$v=str_replace($rm,'',$v);
	if(strpos($v,':b'))$v=strto($v,':');
	if(strpos($v,'§'))$v=strto($v,'§');
	//if(substr($v,0,1)!='@')
	if(strpos($v,'/status/')!==false)$lnk=$v; 
	elseif(substr($v,0,1)!='@')$ret.=$v.' ';}
$ret=str_replace(':n:',"\n",$ret);
return [$ret,$lnk];}

static function treat($r){
$ret=[];
if($r)foreach($r as $k=>$v){
	[$msg,$lnk]=self::clean_msg($v[2]);
	$tim=self::clean_day_tw($v[1]);//format twitter
	$day=mkday($tim,'ymdhi');
	//$day=self::clean_day($v[1]);//format oaxii
	$ret[]=[$v[0],$day,$msg,$lnk];}
return $ret;}

static function arts($wh){if($wh)$wh='where '.$wh;
$qda=$_SESSION['qda']; $qdm=$_SESSION['qdm']; $ret=''; $b='';
$sql='select '.$qda.'.id,suj,'.$qdm.'.msg from '.$qda.' 
inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id '.$wh.' order by day ASC';
if($b)echo $sql; $rq=qr($sql);
if($rq)while($r=sql::qrw($rq))$ret[]=$r;
if($rq)sql::qrf($rq);
return $ret;}

static function build($p,$o){
$r=self::arts('frm="'.$p.'"');
return $r;}

static function name($p){
return ses('qb').'_arts_'.normalize($p);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o); if(!$p)return 'no';
$r=self::build($p,$o); //p($r);
$r=self::treat($r); //pr($r);
$nod=self::name($p);
if(auth(6))$r=msql::modif('',$nod,$r,'arr');
return msqbt('users',$nod).' '.btn('txtsmall2',$nod);}

//static function r(){return ['aa'=>'a','bb'=>'b'];}
//$ret=select_j('inp','pclass','','msqarts/r','','2');
//$ret.=togbub('msqarts','r',btn('popbt','select...'));

static function menu($p,$o,$rid){
$ret=input('inp',$p,'').' ';
$ret.=lj('',$rid.'_msqarts,call_inp',picto('ok')).' ';
return $ret;}

//
static function home($p,$o){$rid='plg'.randid(); //if(!$p)$p='Oyagaa Ayoo Yissaa';
$nod=self::name($p);
msql::read('',$nod,'','',['id','suj','msg']);
$bt=self::menu($p,$o,$rid); $ret=self::call($p,$o);
//$bt.=msqbt('',$nod);
return $bt.divd($rid,$ret);}
}
?>