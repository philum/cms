<?php //starsky2

class starsky2{
static $default='dist<100';
static $w=1400;
static $clr=['#ffffff','#000000','#ff0000','#00ff00','#0000ff','#ffff00','#00ffff','#ff9900','#cccccc','#666666'];
static $clr2=['O'=>'#93B6FF','B'=>'#A7C3FF','A'=>'#D5E0FF','F'=>'#F9F5FF','G'=>'#FFECDF','K'=>'#FFD6AC','M'=>'#FFAA58','L'=>'FF7300','T'=>'FF3500','Y'=>'999999'];

static function legend($r){$w=self::$w; $h=$w/2; $sz=16; $x=40; $y=0; $i=0;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;
$r=['amical'=>$green,'neutre'=>$yellow,'inamical'=>$orange,'danger'=>$red,'indéfini'=>$white];
$i++; $y=$sz+$i*$sz;
svg::text(10,$x,$y+12,'Stars',$white);
svg::text(10,$w-100,$y+12,mkday('','d/m/Y'),$white);
foreach($r as $k=>$v){$i++;
	$y=$sz+$i*$sz;
	svg::circle($x+8,$y+8,10,$v,$black);
	svg::text(12,$x+$sz+8,$y+12,$k,$white);}
$i++; $y=$sz+$i*$sz;
svg::text(10,$x,$y+12,'Zones',$white);
$r=['Hostiles'=>'#530002','Roswell New Dominion'=>'#4f5900','Ancien Aliens Dominion'=>'#a62a00','Friends or Neutral'=>'#025100'];
foreach($r as $k=>$v){$i++; $y=$sz+$i*$sz;
	svg::rect($x,$y,$sz,$sz,$v,$black);
	svg::text(12,$x+$sz+8,$y+12,$k,$white);}}

static function sttclr($stt){
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;
if($stt=='amical')$clr=$green;
elseif($stt=='inamical')$clr=$orange;//img::imgclr($im,'ff9900')
elseif($stt=='danger')$clr=$red;
elseif($stt=='neutre')$clr=$yellow;
elseif($stt=='galaxy')$clr=$blue;
elseif($stt=='galaxy')$clr=$blue;
else $clr=$gray;
return $clr;}

static function dots($r,$o){$n=count($r); //$klr=self::$clr;
$w=self::$w; $h=$w/2; $mw=$w/24; $mh=$h/12; $sz=10; $xs=$o?16:12; $decaly=$o?20:16;//pr($r);
//[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=$klr;
$rz=['O'=>10,'B'=>7,'A'=>5,'F'=>4,'G'=>3,'K'=>2,'M'=>1,'L'=>0.8,'T'=>0.5,'Y'=>'0.2']; $klr=self::$clr2;
if($r)foreach($r as $k=>$v){
	$x=$v['x']; $y=$v['y']; $st=$v['star']??''; 
	//$pl=$v['planet']??''; $stt=$v['status']??'';
	//$nm=$st?$st:($v['hd']?'HD'.$v['hd']:''); //$pl?$pl: //$nm='HD'.$v['hd'];
	$spc=substr($v['spect'],0,1);
	//$clr=self::sttclr($stt);
	$clr=$klr[$spc]??'#ffffff';
	$sz=$rz[$spc]??1;
	//$sz*=log(10000-$v['dist']);
	svg::circle($x,$y,$sz,$clr,'none',2);
	//$xb=$x-20; $yb=$y+$decaly;
	//if($nm=='6 G. Piscium' or $nm=='38 Piscium' or $nm=='Iota Piscium' or $nm=='Gliese 250'){$xb=$x+8; $yb=$y+6;}
	//if($v['hd']=='217877'){$xb=$x+8; $yb=$y+5;}//OOYAAUYIEE WEE
	//if($v['hd']=='114710'){$xb=$x-60;}//Berenice
	//if($n<100)svg::lj($xb,$yb,$xs,$white,'popup_star;info___'.$v['hip'].'_hip',$nm);
}}

static function correct($v,$cx){
$w=self::$w; $h=$w/2; $mw=$w/24; $mh=$h/180; $cy=90;
[$x,$y]=explode('/',$v);
if($x>=20 && $x<=24)$x-=24;//next time, use iu
$x+=$cx; $y+=$cy;
$x=0-$x+24; if($x<0)$x=0; if($x>24)$x=24;
$y=(0-$y)+180; if($y<0)$y=0; if($y>180)$y=180;
return round($x*$mw).'/'.round($y*$mh);}

static function zpt(){
//g1:autres voisins amis ou neutres (gauche)
$r[0]=['18/50','15.5/51','15.5/52','14/52','14/45','13.5/45','13.5/50','12.5/50','12.5/30','11/30','11/35','10.9/35','10.9/38','10.5/38','10.5/42','9.7/42','9.7/38','9.5/38','9.5/30','8.2/30','8/10','7.3/10','7.3/0','8.3/0','8.3/-10','8.5/-10','8.5/-15','9.5/-15','9.5/-20','11/-35','13/-35','13/-30','16/-30','16/-43','17/-43','17/-45','18/-45','18/-30','17.7/-30','17.7/-15','18.5/-15','18.5/-5','18.8/-5','18.8/0','19/0','19/5','18.8/5','18.8/12','19/12','19/25','18.5/25','18.5/30','18.3/30','18/50'];
//g2:Reptiliens (centre)
$r[1]=['7.7/30','7.6/30','7.6/35','7.5/35','7.5/45','7/45','7/50','6/55','5.1/55','5.1/51','4.9/51','4.9/36','4.7/36','4.7/30','3.4/30','3.4/0','4.8/0','4.8/-5','5.2/-5','5.2/-10','5/-10','5/-25','6.5/-25','6.5/-10','8.3/-10','8.3/0','7.3/0','7.3/10','8/10','8.2/30'];
//g3=hostiles (droite)
$r[2]=['3.4/30','2.7/30','1.8/25','1.5/25','1.5/28','1.5/35','1/35','1/20','0.2/20','0.2/30','22/45','22/28','21.3/28','21.3/20','20.3/20','20.3/5','20.5/5','20.5/-15','21.5/-15','21.5/-8','22/-8','22/-25','1.8/-20','1.8/-19','2.8/-19','2.8/0','3.4/0','3.4/30'];
//g4:Roswell Aliens dominion (bas)
$r[3]=['3.4/0','2.8/0','2.8/-19','1.8/-19','1.8/-40','23.5/-40','23.5/-55','22.2/-55','22.2/-50','21.8/-50','21.8/-45','20.5/-45','20.5/-60','21.8/-60','21.8/-75','20/-75','20/-90','19.99/-90','19.99/-75','18.5/-75','18.5/-68','17.4/-68','17/-60','15.5/-60','15.5/-55','14.8/-55','14.8/-65','11.5/-65','11.5/-75','6.3/-75','6.36/-63','6/-63','6/-61','5.5/-61','5/-57','4.5/-55','4.5/-50','4.2/-50','4.2/-37','4.65/-37','4.65/-30','4.8/-30','4.8/-27','5/-27','5/-10','5.2/-10','5.2/-5','4.8/-5','4.8/0','3.4/0'];
return $r;}

static function zones(){
[$r0,$r1,$r2,$r3]=self::zpt(); $r0b=$r0; $r3b=$r3; $cx=12;
foreach($r0 as $k=>$v)$r0[$k]=self::correct($v,$cx); svg::poly($r0,'#025100');//p($r0);
foreach($r0b as $k=>$v)$r0b[$k]=self::correct($v,-12); svg::poly($r0b,'#025100');//p($r0b);
foreach($r1 as $k=>$v)$r1[$k]=self::correct($v,$cx); svg::poly($r1,'#a62a00');//p($r1);
foreach($r2 as $k=>$v)$r2[$k]=self::correct($v,$cx); svg::poly($r2,'#530002');//p($r2);
foreach($r3 as $k=>$v)$r3[$k]=self::correct($v,$cx); svg::poly($r3,'#4f5900');
foreach($r3b as $k=>$v)$r3b[$k]=self::correct($v,-12); svg::poly($r3b,'#4f5900');}

static function months(){$w=self::$w; $h=$w/2; $xp=77.19;//day of equinox
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;
$mw=$w/12; $ratio=round($w/360,2);//projection
$rt=['Jan','Fev','Mars','Avr','Mai','Juin','Juil','Aout','Sept','Oct','Nov','Dec']; $rx=[];
foreach($rt as $k=>$v){$a=180+$xp-(30*$k); if($a<0)$a+=360; $b=$a*$ratio; $rx[]=$a;
svg::line($b,0,$b,$h,$gray,'','','8');
svg::text(10,$b+4,$h-1,$v,$silver);}}

static function map($r){$w=self::$w; $h=$w/2; $mw=$w/24; $mh=$h/12;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;
for($i=0;$i<=24;$i++){$x=$mw*(24-$i);
	svg::line($x,0,$x,$h,$i==12?$white:$gray); $t=12+$i; if($t>=24)$t-=24;
	svg::text(10,$x-12,10,$t,$yellow);}
for($i=0;$i<=12;$i++){$y=$mh*$i;
	svg::line(0,$y,$w,$y,$i==6?$white:$gray); $t=90-$i*15;
	svg::text(10,0,$y,$t,$yellow);}
self::months();}

static function draw($r,$o=''){
$w=self::$w; $h=$w/2; $im=new svg($w,$h);
[$white,$black]=self::$clr;
svg::rect(0,0,$w,$h,$black);
//self::zones();
//self::map($r);
self::dots($r,$o);//stars
//self::legend($r);
return svg::draw();}

static function prep($r,$ra,$p){new maths(20);
$w=self::$w; $h=$w/2; $wi=$w/2; $hi=$h/2; $wr=$w/24; $hr=$h/180;
$rc=array_flip(array_keys_r($ra,8)); //pr($rc);
//$rc=array_column($ra,0,8); $rcb=array_column($ra,0,5); //pr($rb);
$hips=array_keys_r($r,1); //pr($hips);
if($p=='knownstars' or $p=='allstars')foreach($ra as $k=>$v){if(!in_array($v[8],$hips)){
$rad=maths::ra2deg($v[2]); $rag=deg2rad($rad); $rah=$rad/15;;
$dcd=maths::dec2deg($v[3]); $dcg=deg2rad($dcd);
$spc=$v[8]=='999999'?'G2V':''; //if($v[8]=='999999')echo $v[2].'-'.$rad;
if($v[2] && $v[8]!=='')$r[]=[$v[1],$v[8],$rag,$dcg,$v[4],$spc,'','',$rah,$dcd];}} //pr($r);
//$r[]=['','999998',4.7705666221178,-0.47449684597553,26100,'',0,0,273.33,-27.1867];//Galactic center/Sagitarius A
//$r[]=['','999999',3.2799099968103,0.15751596499249,14.31,'G2V',0,0,12.5283,9.025];//Yooma 187.925°=12.52j
//pr($r);
$cols=['hd','hip','rarad','decrad','dist','spect','mag','lum','ra','dc'];//
if($r)foreach($r as $k=>$v){
$rb[$k]=array_combine($cols,$v);
$x=$wi+$w-(($v[8]*$wr)); if($x>$w)$x-=$w;//north
//$x=$wi+($v[8]*$wr); if($x>$w)$x-=$w;//south
$y=$h+(-1*(($v[9]+90)*$hr));
$rb[$k]['x']=$x; $rb[$k]['y']=$y;
//if($ra)$rb[$k]['star']=$rb[$v[1]];
if($ra){$rk=$rc[$v[1]]??''; if($rk)$rd=$ra[$rk]; else $rd=[];
	if($rd)$rb[$k]+=['star'=>$rd[0],'status'=>$rd[5],'planet'=>$rd[6]];}
if($rb[$k]['hip']==999999){$rb[$k]['hip']='Oomo';}
if($rb[$k]['hip']=='0'){$rb[$k]['status']='galaxy'; $rb[$k]['star']='Galactic Center';}
} //pr($rb);
//pr($rb);
return $rb;}

static function build($p,$o){$ra=[];
$ra=msql::read('','ummo_exo_5','',1); $pb=$p;
if($p=='knownstars')$pb=implode(',',array_keys_r($ra,8));
if($p=='allstars'){$rb=msql::read('','ummo_exo_stars','',1);
	$ra=array_merge($ra,$rb); $pb=implode(',',array_keys_r($ra,8));}
$sq=star::sq($pb);
$r=star::build($sq,1); //pr($r);
$rb=self::prep($r,$ra,$p); //pr($rb);
$ret=self::draw($rb,$o);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if(!$p)$p=self::$default;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_starsky2,call_inp_2_';
$ret=inputj('inp',$p?$p:self::$default,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lk('/app/starsky2',picto('url'));
return $ret;}

static function home($p,$o){
$rid=randid('sky2');
$bt=self::menu($p,$o,$rid);
if(!$p)$p=self::$default;
$ret=self::build($p,$o);
$bt.=msqbt('',nod('exo_5'));
return $bt.divd($rid,$ret);}
}
?>