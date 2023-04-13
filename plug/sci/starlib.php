<?php

class starlib{
static $w=1400;

static $clr=['#ffffff','#000000','#ff0000','#00ff00','#0000ff','#ffff00','#00ffff','#ff9900','#cccccc','#666666'];
//static $clr2=['O'=>'#93B6FF','B'=>'#A7C3FF','A'=>'#D5E0FF','F'=>'#F9F5FF','G'=>'#FFECDF','K'=>'#FFD6AC','M'=>'#FFAA58','L'=>'FF7300','T'=>'FF3500','Y'=>'999999'];
static $clr2=['O'=>'#4277e4','B'=>'#6894f1','A'=>'#859fea','F'=>'#c09df3','G'=>'#ffc9a4','K'=>'#ffb366','M'=>'#ff9b3b','L'=>'#FF7300','T'=>'#FF3500','Y'=>'#999999'];
static $clr3=['#2a635c','#a62a00','#530002','#4a5305'];
static $rz=['O'=>12,'B'=>10,'A'=>9,'F'=>8,'G'=>7,'K'=>6,'M'=>5,'L'=>4,'T'=>3,'Y'=>'2',''=>5];

static function sttclr($stt,$o=''){
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;
//[$c1,$c2,$c3,$c4]=self::$clr3;
if($stt=='amical')$clr=$green;
elseif($stt=='inamical')$clr=$orange;
elseif($stt=='danger')$clr=$red;
elseif($stt=='neutre')$clr=$yellow;
elseif($stt=='inconnu')$clr=$silver;
elseif($stt=='none')$clr=$black;
elseif($stt=='proba')$clr=$silver;
elseif($stt=='galaxy')$clr=$blue;
else $clr=$o?$o:$gray;
return $clr;}

static function minmax($r){$rb=[]; $min=false; $max=false;
foreach($r as $k=>$v)if(is_numeric($v)){if($min===false or $v<$min)$min=$v; if($max===false or $v>$max)$max=$v;}
return [$min,$max];}

static function scale($r,$a,$o=''){$rb=[]; $m='';
[$min,$max]=self::minmax($r); if($o)$max=$o; if($max)$m=$a/$max;
if($m)foreach($r as $k=>$v)$rb[$k]=$v*$m;
return $rb;}

static function proportion($r,$a,$b,$l,$o){$c=$b-$a;
if($l)foreach($r as $k=>$v)if($v>$l)$r[$k]=$l;
[$min,$max]=self::minmax($r); $diff=$max-$min; if(!$diff)return; $m=$c/$diff; $rb=[]; $ca=1/$diff;
foreach($r as $k=>$v){if(!is_numeric($v))$n=0.5; else $n=($v-$min)*$ca;//*$m
	if($o)$n=1-$n; $n=$n*$c+$a; $rb[$k]=$n;}
return $rb;}

static function sz($r){$rb=[];
//$r0=array_column($r,'star'); pr($r0);
$r1=self::proportion(array_keys_r($r,'radius'),2,12,50,0); //pr($r1);
$r2=self::proportion(array_keys_r($r,'dist'),2,12,100,1); //pr($r2);
if($r)foreach($r as $k=>$v)$rb[$k]=round((($r1[$k]??10)+$r2[$k])/3,2); //pr($rb);
return $rb;}

static function zpt(){
//g1:autres voisins amis ou neutres (gauche)
$r[0]=['18/50','15.5/51','15.5/52','14/52','14/45','13.5/45','13.5/50','12.5/50','12.5/30','11/30','11/35','10.9/35','10.9/38','10.5/38','10.5/42','9.7/42','9.7/38','9.5/38','9.5/30','8.2/30','8/10','7.3/10','7.3/0','8.3/0','8.3/-10','8.5/-10','8.5/-15','9.5/-15','9.5/-20','11/-35','13/-35','13/-30','16/-30','16/-43','17/-43','17/-45','18/-45','18/-30','17.7/-30','17.7/-15','18.5/-15','18.5/-5','18.8/-5','18.8/0','19/0','19/5','18.8/5','18.8/12','19/12','19/25','18.5/25','18.5/30','18.3/30','18/50'];
//g2:Reptiliens (centre)
$r[1]=['7.7/30','7.6/30','7.6/35','7.5/35','7.5/45','7/45','7/50','6/55','5.1/55','5.1/51','4.9/51','4.9/36','4.7/36','4.7/30','3.4/30','3.4/0','4.8/0','4.8/-5','5.2/-5','5.2/-10','5/-10','5/-25','6.5/-25','6.5/-10','8.3/-10','8.3/0','7.3/0','7.3/10','8/10','8.2/30'];
//g3=hostiles (droite)
$r[2]=['3.4/30','2.7/30','1.8/25','1.5/25','1.5/28','1.5/33','0.8/33','0.8/24','0.9/24','0.9/20','0.2/20','0.2/30','23.5/32','23.5/34','22/36','22/28','21.3/28','21.3/20','20.3/20','20.3/5','20.5/5','20.5/-15','21.5/-15','21.5/-8','22/-8','22/-25','1.8/-20','1.8/-19','2.8/-19','2.8/0','3.4/0','3.4/30'];
//g4:Roswell Aliens dominion (bas)
$r[3]=['3.4/0','2.8/0','2.8/-19','1.8/-19','1.8/-40','23.5/-40','23.5/-55','22.2/-55','22.2/-50','21.8/-50','21.8/-45','20.5/-45','20.5/-60','21.8/-60','21.8/-75','20/-75','20/-90','19.99/-90','19.99/-75','18.5/-75','18.5/-68','17.4/-68','17/-60','15.5/-60','15.5/-55','14.8/-55','14.8/-65','11.5/-65','11.5/-75','6.3/-75','6.36/-63','6/-63','6/-61','5.5/-61','5/-57','4.5/-55','4.5/-50','4.2/-50','4.2/-37','4.65/-37','4.65/-30','4.8/-30','4.8/-27','5/-27','5/-10','5.2/-10','5.2/-5','4.8/-5','4.8/0','3.4/0'];
return $r;}

static function months(){$w=self::$w; $h=$w/2; $eq=77.19;//day of equinox
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;
$mw=$w/12; $ratio=round($w/360,2);//projection
$rt=['Jan','Fev','Mars','Avr','Mai','Juin','Juil','Aout','Sept','Oct','Nov','Dec']; $rx=[];
foreach($rt as $k=>$v){$a=180+$eq-(30*$k); if($a<0)$a+=360; $b=$a*$ratio; $rx[]=$a;
svg::line($b,0,$b,$h,$gray,'','','8');
svg::text(10,$b+4,$h-1,$v,$silver);}}

static function solstices(){
$d0=new DateTime('1999-12-22 07:44:00');
$d1=new DateTime('2000-03-20 07:35:00');//88
$d2=new DateTime('2000-06-21 01:48:00');//92
$d3=new DateTime('2000-09-22 17:27:00');//93
$d4=new DateTime('2000-12-21 13:37:00');//89
$rd=$d1->diff($d0); echo $ret=$rd->days;}

static function declinaison($a,$n,$i,$o){
if($o==1 or $o==3)$i=$n-$i;
if($o==2 or $o==3)$a=0-$a;
//return sin($i/($n/(M_PI/2)))*$a;
$pi=M_PI/2; $p1=$n/$pi;
return sin($i/$p1)*$a;}

static function sun(){$r=[]; $rb=[]; $eq=77.19; $a=-23.44; $dg=0.9863;//degbyday
$n=89; for($i=0;$i<$n;$i++)$r[]=self::declinaison($a,$n,$i,4);//fourth
$n=88; for($i=0;$i<$n;$i++)$r[]=self::declinaison($a,$n,$i,1);//first
$n=90.5; for($i=0;$i<$n;$i++)$r[]=self::declinaison($a,$n,$i,2);//second
$n=93; for($i=0;$i<$n;$i++)$r[]=self::declinaison($a,$n,$i,3);//third
$r=array_reverse($r); //if(auth(6))pr($r);
$w=self::$w; $h=$w/2; $mw=$w/365.2422; $mh=$h/180; $hm=$h/2;
foreach($r as $k=>$v)$rb[]=round($k*$mw,2).'/'.round($hm-$v*$mh,2);
svg::polyline($rb,'','#ffff00',1,1);}

static function galaxy(){$a=61.466;
$w=self::$w; $h=$w/2; $mw=$w/360; $mh=$h/180; $hm=$h/2;
$n=90; for($i=0;$i<$n;$i++)$r[]=self::declinaison($a,$n,$i,3);
$n=80; for($i=0;$i<$n;$i++)$r[]=self::declinaison($a,$n,$i,4);
$n=80; for($i=0;$i<$n;$i++)$r[]=self::declinaison($a,$n,$i,1);
$n=80; for($i=0;$i<$n;$i++)$r[]=self::declinaison($a,$n,$i,2);
$n=100; for($i=0;$i<24;$i++)$r[]=self::declinaison($a,$n,$i,3);
foreach($r as $k=>$v)$rb[]=round(($k)*$mw,2).'/'.round($hm-$v*$mh,2);
svg::polyline($rb,'','#00ff00',1,1);}

static function galx(){
$w=self::$w; $h=$w/2; $mw=$w/360; $mh=$h/180; $hm=$h/2; $wm=$w/4;
$p='M 0/'.$hm.' C'.($h).'/_400 '.($h).'/'.($wm*3).' '.$w.'/'.$hm.'';
//M 0,350 C700,-400 700,1050 1400,350
//M 0,350 C700, 400 700,1050 1400,350
return svg::path($p,'none','green',1);}

static function positions($r){//linear projection
$w=self::$w; $h=$w/2; $wi=$w/2; $hi=$h/2; $wr=$w/24; $hr=$h/180;
if($r)foreach($r as $k=>$v){
$x=$wi+$w-(($v['ra']*$wr)); if($x>$w)$x-=$w;//north
//$x=$wi+($v['ra']*$wr); if($x>$w)$x-=$w;//south
$y=$h+(-1*(($v['dc']+90)*$hr));
$r[$k]['x']=round($x); $r[$k]['y']=round($y);}
return $r;}

static function prep($r,$ra,$p1){new maths(20); $rb=[]; $rt=[]; //pr($r);
$w=self::$w; $h=$w/2; $wi=$w/2; $hi=$h/2; $wr=$w/24; $hr=$h/180; $r2=[];
$cols=['hd','hip','rarad','decrad','dist','spect','mag','lum','ra','dc'];//
$cra=current($ra); if(count($cra)>8){
$rc=array_flip(array_keys_r($ra,8)); //pr($rc);
//$rc=array_column($ra,0,8); $rcb=array_column($ra,0,5); pr($rcb);
foreach($ra as $k=>$v){//known
	$rad=maths::ra2deg($v[2]); $rag=deg2rad($rad); $rah=$rad/15;
	$dcd=maths::dec2deg($v[3]); $dcg=deg2rad($dcd);
	$rb[$k]=[$v[1],$v[8],$rag,$dcg,$v[4],'','','',$rah,$dcd];}} //pr($rb);
	//$r[]=['','0',4.7705666221178,-0.47449684597553,26100,'',0,0,273.33,-27.1867];//Galactic center/Sagitarius A
	//$r[]=['','999999',3.2799099968103,0.15751596499249,14.31,'G2V',0,0,12.5283,9.025];//Yooma 187.925°=12.52j
//if($p1=='knownstars' or $p1=='allstars')$r=$rb;
if($r)foreach($r as $k=>$v){$kb=$rc[$v[1]]??randid();//hipparcos
	$rt[$kb]=array_combine($cols,$v);
	$x=$wi+$w-(($v[8]*$wr)); if($x>$w)$x-=$w;//north
	//$x=$wi+($v[8]*$wr); if($x>$w)$x-=$w;//south
	$y=$h+(-1*(($v[9]+90)*$hr));
	$rt[$kb]['x']=$x; $rt[$kb]['y']=$y;
	//$rt[$kb]['star']='HD'.$v[0];
	$rt[$kb]['radius']=1;//$v[7];
	if(!$rt[$kb]['dist'])unset($rt[$kb]);} //pr($rt);
$rcb=array_flip(array_keys_r($rt,'hip')); //pr($rcb);
if($p1=='knownstars' or $p1=='allstars')$r2=array_diff($rc,$rcb);//add known to hip
elseif($p1){$sq=self::sq($p1); $rb1=array_column($rb,1); $rb2=array_column($rb,0); $r2a=[]; $r2b=[]; //pr($rb1);
	if(isset($sq['hip']))foreach($sq['hip'] as $k=>$v)$r2a[]=array_search($v,$rb1); //pr($r2a);
	if(isset($sq['hd']))foreach($sq['hd'] as $k=>$v)$r2b[]=array_search($v,$rb2); //pr($r2b);
	$r2=array_merge($r2a,$r2b);}
if($r2)foreach($r2 as $k=>$v)if(!isset($rt[$v]) && isset($rb[$v]))$rt[$v]=array_combine($cols,$rb[$v]);
$rd=['star'=>0,'status'=>5,'planet'=>6,'radius'=>7];//add props
if($rt)foreach($rt as $k=>$v){if(isset($ra[$k]))foreach($rd as $ka=>$va)if($ra[$k][$va])$rt[$k][$ka]=$ra[$k][$va];
	if($v['hip']==999999){$rt[$k]['star']='Yooma'; $rt[$k]['mag']=10; $rt[$k]['spect']='G2V';}
	if($v['hip']=='0'){$rt[$k]['star']='Galactic Center';}}
return $rt;}

#init
static function knownstars($p1){
if($p1=='knownstars' or $p1=='allstars')$ra=sqldb::read('db/public/stars/1',1);
if($p1=='allstars'){$rb=msql::read('','ummo_exo_5',1); $ra=array_merge($ra,$rb);}
return implode(',',array_keys_r($ra,8));}

static function sq($p1){
$p1=str_replace(["\n","\t","&#nbsp;",' '],'',strtolower($p1));
$r=explode(',',$p1); $sq=[];
if($r)foreach($r as $k=>$v){
	if(substr($v,0,2)=='hd')$sq['hd'][]=substr($v,2);
	elseif(substr($v,0,3)=='hip')$sq['hip'][]=substr($v,3);
	elseif($v=='yooma')$sq['hip'][]='999999';
	elseif(is_numeric($v))$sq['hip'][]=$v;}
return $sq;}

static function build($p,$o=0){$wr=[];
if($p['hip']??'')$wr[]='hip in("'.implode('","',$p['hip']).'")';
if($p['hd']??'')$wr[]='hd in("'.implode('","',$p['hd']).'")';
$w=implode(' or ',$wr); $r=[];
$cls='hd,hip,rarad,decrad,round(dist*3.261564,2) as dist,spect,mag,round(lum,2),ra,dc';
if($w)$r=sql($cls,'hipparcos',$o?'':'rr','where '.$w.''); 
return $r;}

static function play($p){
$ra=self::sq($p['com']??'');
$r=self::build($ra,0);
if($r)foreach($r as $k=>$v){
	$r[$k]['rarad']=maths::deg2ra(rad2deg($v['rarad']));
	$r[$k]['decrad']=maths::deg2dec(rad2deg($v['decrad']));
	$r[$k]['dist']=($v['dist']);}//oc2al
if($r)array_unshift($r,array_keys(current($r))); //pr($r);
return $r;}

static function info($p){$ret=''; $p1=$p['com']; $p2=$p['opt']??''; 
$rh=['hd','hip','ra','dec','dist (Ly)','spect','mag','lum','radeg','dcdeg'];
$r=self::play($p); if($r)$ret=tabler($r,1);
if($p2){$ra=msql::read('','public_stars_1');
	$k=in_array_r($p1,$ra,8);
	if($ra[$k]??'')$ret.=tabler(array_combine($ra['_'],$ra[$k]),1,1);}
if(!$ret)$ret=help('no element','txt');
return $ret;}

}
?>