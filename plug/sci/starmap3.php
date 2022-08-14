<?php //starmap3

class starmap3{
static $default='knownstars';
static $w=1400;

static function clr($im){//imgclr_pack
$r=['2387d5','2387d5','85b933','85b933','8a50c8','8a50c8','f2c627','f2c627','e11419'];
foreach($r as $k=>$v){$rb=hexrgb_r($v); $ret[]=imagecolorallocate($im,$rb[0],$rb[1],$rb[2]);}
return $ret;}

static function legend($r,$im,$klr,$font){$w=self::$w; $h=$w/2; $sz=16; $x=40; $i=0;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray,$orange]=$klr;
$r=['amical'=>$green,'neutre'=>$yellow,'inamical'=>$orange,'danger'=>$red,'indéfini'=>$white];
foreach($r as $k=>$v){$i++; $y=$sz+$i*$sz+16;
	ImageFilledRectangle($im,$x,$y,$x+$sz,$y+$sz,$v);
	imagestring($im,$font,$x+24,$y,$k,$white);}}

static function dots($r,$im,$klr,$font){
$w=self::$w; $h=round($w/2,2); $mw=round($w/24,2); $mh=round($h/12,2); $sz=6; //pr($r);
[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray,$orange,$c2,$c3,$c4,$c5,$c6]=$klr;
//[$amical,$inamical,$neutre,$galaxy,$hostile]=self::clr($im);
if($r)foreach($r as $k=>$v){
	$x=$v['x']; $y=$v['y']; $st=$v['star']??''; $pl=$v['planet']??''; $stt=$v['status']??'';
	$nm=$st?$st:('HD'.$v['hd']); //$pl?$pl: //$nm='HD'.$v['hd'];
	if($stt=='amical')$clr=$green;
	elseif($stt=='inamical')$clr=$orange;//img::imgclr($im,'ff9900')
	elseif($stt=='danger')$clr=$red;
	elseif($stt=='neutre')$clr=$yellow;
	elseif($stt=='galaxy')$clr=$blue;
	else $clr=$gray;
	imagefilledellipse($im,$x,$y,$sz,$sz,$clr);
	imageellipse($im,$x,$y,$sz,$sz,$white);
	$rp=[$x-8,$y+8];
	//imageline($im,$rp[0]+10,$rp[1]+10,$x,$y,$white);
	//imagestring($im,$font,$rp[0],$rp[1],$v['hip'],$clr);
	imagestring($im,$font,$rp[0],$rp[1],$nm,$clr);}}

static function zones($im,$klr){//echo $klr;
$w=self::$w; $h=$w/2; $mw=$w/24; $mh=$h/12;
$clr=imagecolorallocate($im,0,76,0);//z1
[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray]=$klr;
$r=[1.5,2,1.5,8,2,8,2,6,5.5,8,5.5,5,4,3.5,4,4.5,3,4.5,3,3];
foreach($r as $k=>$v)$r[$k]=$v=$k%2?round($v*$mh):round($v*$mw); //pr($r);
imagepolygon($im,$r,$blue); imagefilledpolygon($im,$r,$clr);}

static function map($r,$im,$klr,$font){$w=self::$w; $h=$w/2; $mw=$w/24; $mh=$h/12;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray]=$klr;
for($i=0;$i<24;$i++){$x=round($mw*(24-$i)); $y=round($mh*$i);
	imageline($im,$x,0,$x,$h,$i==12?$white:$gray); $t=12+$i; if($t>=24)$t-=24;
	imagestring($im,$font,$x,0,$t,$gray);}
for($i=0;$i<12;$i++){$x=round($mw*$i); $y=round($mh*$i);
	imageline($im,0,$y,$w,$y,$i==6?$white:$gray); $t=90-$i*15;
	imagestring($im,$font,0,$y,$t,$gray);}}

static function draw($out,$r){
$w=self::$w; $h=$w/2; $im=imagecreate($w,$h);
$klr=img::clrpack($im);//spe
[$white,$black,$red,$green,$blue,$yellow,$cyan]=$klr;
$font=imageloadfont('gdf/Fixedsys.gdf');
ImageFilledRectangle($im,0,0,$w,$h,$black);
self::map($r,$im,$klr,$font);
self::zones($im,$klr);
self::dots($r,$im,$klr,$font);//stars
self::legend($r,$im,$klr,$font);
imagepng($im,$out);
return $out;}

static function build($p,$o){$ra=[];
$ra=msql::read('','ummo_exo_5','',1); $pb=$p;
if($p=='knownstars')$pb=implode(',',array_keys_r($ra,8));
if($p=='allstars'){$rb=msql::read('','ummo_exo_stars','',1);
	$ra=array_merge($ra,$rb); $pb=implode(',',array_keys_r($ra,8));}
$sq=star::sq($pb);
$r=star::build($sq,1); //pr($r);
$rb=starlib::prep($r,$ra,$p); //pr($rb);
$rb=starlib::positions($rb);
$f='_datas/starmap3.png';
self::draw($f,$rb);
//$ret=image('/'.$f.'?'.randid());
$ret=btim(''.$f.'?'.randid(),self::$w);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
return self::build($p,$o);}

static function menu($p,$o,$rid){
$j=$rid.'_starmap3,call_inp';
$ret=inputj('inp',$p?$p:self::$default,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid('starmap3');
$bt=self::menu($p,$o,$rid);
if(!$p)$p=self::$default;
$ret=self::build($p,$o);
$bt.=msqbt('',nod('exo_4'));
return $bt.divd($rid,$ret);}

}
?>