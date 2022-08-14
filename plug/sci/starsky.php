<?php //starsky

class starsky{
static $default='dist<500';
static $w=8000;

static function clr($im){$ret=[];//imgclr_pack
$r=['2387d5','2387d5','85b933','85b933','8a50c8','8a50c8','f2c627','f2c627','e11419'];
foreach($r as $k=>$v){$rb=hexrgb_r($v); $ret[]=imagecolorallocate($im,$rb[0],$rb[1],$rb[2]);}
return $ret;}

static function clr2($im,$a=''){$ret=[];
$r=['O'=>'93b6ff','B'=>'acc6ff','A'=>'d7e1ff','F'=>'f7f4fd','G'=>'ffece0','K'=>'ffd6ad','M'=>'ffaa54','white'=>'ffffff'];
$r=['O'=>'4277e4','B'=>'6894f1','A'=>'859fea','F'=>'c09df3','G'=>'ffc9a4','K'=>'ffb366','M'=>'ff9b3b','L'=>'FF7300','T'=>'FF3500','Y'=>'999999'];
foreach($r as $k=>$v){$rb=hexrgb_r($v); $ret[]=imagecolorallocate($im,$rb[0],$rb[1],$rb[2]);}
return $ret;}

static function legend($r,$im,$klr,$font){$w=self::$w; $h=$w/2; $sz=16; $x=40; $i=0;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray,$orange]=$klr;
//$r=['amical'=>$green,'neutre'=>$yellow,'inamical'=>$orange,'danger'=>$red,'indéfini'=>$white];
$r=['amical'=>$green,'neutre'=>$yellow,'inamical'=>$orange,'danger'=>$red,'indéfini'=>$white];
foreach($r as $k=>$v){$i++; $y=$sz+$i*$sz+16;
	ImageFilledRectangle($im,$x,$y,$x+$sz,$y+$sz,$v);
	imagestring($im,$font,$x+24,$y,$k,$white);}}

static function sttclr($stt,$klr){
[$amical,$inamical,$neutre,$galaxy,$hostile]=$klr;
if($stt=='amical')$clr=$green;
elseif($stt=='inamical')$clr=$orange;//img::imgclr($im,'ff9900')
elseif($stt=='danger')$clr=$red;
elseif($stt=='neutre')$clr=$yellow;
elseif($stt=='galaxy')$clr=$blue;
else $clr=$gray;
return $clr;}

//https://fr.wikipedia.org/wiki/Type_spectral
/**/static function spclr($spc,$mg,$klr){
[$co,$cb,$ca,$cf,$cg,$ck,$cm,$cw]=$klr;
if($spc=='O')$clr=$co; elseif($spc=='B')$clr=$cb; elseif($spc=='A')$clr=$ca; elseif($spc=='F')$clr=$cf; elseif($spc=='G')$clr=$cg; elseif($spc=='K')$clr=$ck; elseif($spc=='M')$clr=$cm; else $clr=$white;
return $clr;}

/*static function size($spc,$dist){
if($spc=='O' or $spc=='B')$sz=4;
elseif($spc=='A' or $spc=='F' or $spc=='G')$sz=3;
elseif($spc=='K')$sz=2; elseif($spc=='M')$sz=1; else $sz=1;
return $sz;}*/

static function dots($r,$im,$klr,$font){
$w=self::$w; $h=$w/2; $mw=$w/24; $mh=$h/12; $sz=6; $n=count($r);
//[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray]=$klr;
//$klr=self::clr($im);
$klr=self::clr2($im);//pr($klr);
[$co,$cb,$ca,$cf,$cg,$ck,$cm,$cw]=$klr;
$rz=['O'=>10,'B'=>7,'A'=>5,'F'=>4,'G'=>3,'K'=>2,'M'=>1];
if($r)foreach($r as $k=>$v){
	$x=$v['x']; $y=$v['y']; $st=$v['star']??''; $pl=$v['planet']??''; $stt=$v['status']??''; $ds=$v['dist']; $mg=$v['mag'];
	$spc=substr($v['spect'],0,1); 
	//$nm=$st?$st:('HD'.$v['hd']); //$pl?$pl: //$nm='HD'.$v['hd'];
	//if($ds<50)$clr2=$white; elseif($ds<500)$clr2=$silver; else $clr2=$gray;
	//if($n>1000)$sz=1;
	//$clr=self::sttclr($stt,$klr);
	//$clr=self::spclr($stt,$mg,$klr);
if($spc=='O')$clr=$co; elseif($spc=='B')$clr=$cb; elseif($spc=='A')$clr=$ca; elseif($spc=='F')$clr=$cf; elseif($spc=='G')$clr=$cg; elseif($spc=='K')$clr=$ck; elseif($spc=='M')$clr=$cm; else $clr=$cw;
	//$clr=$klr[$spc]??$klr['white'];
	$sz=$rz[$spc]??1;//$sz=self::size($spc,$dist); //$sz=1;
	//$sz=round($sz*log(1000-$ds));
	//$sz=round(($ds/$sz)*10); //echo $sz.' ';
	imagefilledellipse($im,$x,$y,$sz,$sz,$clr);
	//imageellipse($im,$x,$y,$sz,$sz,$clr2);
	//$rp=[$x-8,$y+8];
	//imagestring($im,$font,$rp[0],$rp[1],$nm,$clr);
	}}

static function poly($im,$r,$klr){$rb=[];
[$red,$green,$blue]=hexrgb_r($klr);
$clr=imagecolorallocate($im,$red,$green,$blue);
foreach($r as $k=>$v){[$w,$h]=explode('/',$v); $rb[]=$w; $rb[]=$h;} //pr($rb);
imagepolygon($im,$rb,$clr);}//imagefilledpolygon($im,$r,2,$clr);

static function zones($im,$klr){
[$r0,$r1,$r2,$r3]=starmap4::zpt(); $r0b=$r0; $r3b=$r3; $cx=12;
foreach($r0 as $k=>$v)$r0[$k]=starmap4::correct($v,$cx); self::poly($im,$r0,'025100');//p($r0);
foreach($r0b as $k=>$v)$r0b[$k]=starmap4::correct($v,-12); self::poly($im,$r0b,'025100');//p($r0b);
foreach($r1 as $k=>$v)$r1[$k]=starmap4::correct($v,$cx); self::poly($im,$r1,'a62a00');//p($r1);
foreach($r2 as $k=>$v)$r2[$k]=starmap4::correct($v,$cx); self::poly($im,$r2,'530002');//p($r2);
foreach($r3 as $k=>$v)$r3[$k]=starmap4::correct($v,$cx); self::poly($im,$r3,'4f5900');
foreach($r3b as $k=>$v)$r3b[$k]=starmap4::correct($v,-12); self::poly($im,$r3b,'4f5900');}

static function map($r,$im,$klr,$font){$w=self::$w; $h=$w/2; $mw=$w/24; $mh=$h/12;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray]=$klr;
for($i=0;$i<24;$i++){$x=$mw*(24-$i);
	imageline($im,$x,0,$x,$h,$i==12?$white:$gray); $t=12+$i; if($t>=24)$t-=24;
	imagestring($im,$font,$x,0,$t,$gray);}
for($i=0;$i<12;$i++){$y=$mh*$i;
	imageline($im,0,$y,$w,$y,$i==6?$white:$gray); $t=90-$i*15;
	imagestring($im,$font,0,$y,$t,$gray);}}

static function draw($out,$r){
$w=self::$w; $h=$w/2; $im=imagecreate($w,$h);
$klr=img::clrpack($im);//spe
[$white,$black,$red,$green,$blue,$yellow,$cyan]=$klr;
$font=imageloadfont('gdf/Fixedsys.gdf');
ImageFilledRectangle($im,0,0,$w,$h,$black);
//self::map($r,$im,$klr,$font);
//self::zones($im,$klr);
self::dots($r,$im,$klr,$font);//stars
//self::legend($r,$im,$klr,$font);
imagepng($im,$out);
return $out;}

static function prep($r,$ra=[]){
$w=self::$w; $h=$w/2; $wi=$w/2; $hi=$h/2; $wr=$w/24; $hr=$h/180;
$rc=array_flip(array_keys_r($ra,8)); //pr($rb);
$r[]=['','999999',0.15751596499249,3.2799099968103,14.31,'M2',0,0,12.5283,9.025];//Yooma 187.925°=12.52j
//$rc=array_column($ra,0,8); $rcb=array_column($ra,0,5); //pr($rb);
$cols=['hd','hip','rarad','decrad','dist','spect','mag','lum','ra','dc'];//
if($r)foreach($r as $k=>$v){
$rb[$k]=array_combine($cols,$v);
//$x=$wi+($v[2]/M_PI*$w); if($x>$w)$x-=$w;
//$y=$hi+($v[3]/M_PI*$h); if($y>$h)$y-=$h;
$x=$wi+$w-(($v[8]*$wr)); if($x>$w)$x-=$w;//north
//$x=$wi+($v[8]*$wr); if($x>$w)$x-=$w;//south
$y=$h+(-1*(($v[9]+90)*$hr));
$rb[$k]['x']=$x; $rb[$k]['y']=$y;
//if($ra)$rb[$k]['star']=$rb[$v[1]];
if($ra){$rk=$rc[$v[1]]??''; if($rk)$rd=$ra[$rk];  else $rd=[];
	if($rd)$rb[$k]+=['star'=>$rd[0],'status'=>$rd[5],'planet'=>$rd[6]];}
if($rb[$k]['hip']==999999)$rb[$k]['hip']='Oomo';
} //pr($rb);
return $rb;}

static function build($p,$o){$ra=[];
$ra=msql::read('','ummo_exo_5','',1); $pb=$p;
if($p=='knownstars')$pb=implode(',',array_keys_r($ra,8));
if($p=='allstars'){$rb=msql::read('','ummo_exo_stars','',1);
	$ra=array_merge($ra,$rb); $pb=implode(',',array_keys_r($ra,8));}
$sq=star::sq($pb);
$r=star::build($sq,1); //pr($r);
$rb=self::prep($r,$ra); //pr($rb);
$f='_datas/starsky.png';
self::draw($f,$rb);
$ret=image('/'.$f.'?'.randid());
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_starsky,call_inp_2';
$ret=inputj('inp',$p?$p:self::$default,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid('sky');
$bt=self::menu($p,$o,$rid);
if(!$p)$p=self::$default;
$ret=self::build($p,$o);
$bt.=msqbt('',nod('exo_4'));
return $bt.divd($rid,$ret);}
}
?>