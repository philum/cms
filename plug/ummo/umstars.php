<?php //umstars
class umstars{

static function clr($im){//imgclr_pack
$r=['2387d5','2387d5','85b933','85b933','8a50c8','8a50c8','f2c627','f2c627','e11419'];
foreach($r as $k=>$v){$clr=dechex(round($v*16000000)); $rb=hexrgb_r($clr);
	$ret[]=imagecolorallocate($im,$rb[0],$rb[1],$rb[2]);}
return $ret;}

static function legend($r,$im,$ha,$font){$h=$ha-16; $mid=$h/2; $sz=16;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray]=img::clrpack($im);//spe
$r=['amical','neutre','inamical','hostile'];
foreach($r as $k=>$v){
	if($v=='amical')$clr=$green;
	elseif($v=='inamical')$clr=img::imgclr($im,'ff9900');
	elseif($v=='hostile')$clr=$red;
	elseif($v=='neutre')$clr=$yellow;
	else $clr=$white;
	$x=$h-$sz; $y=$sz+$k*$sz;
	ImageFilledRectangle($im,$x,$y,$x+$sz,$y+$sz,$clr);
	imagestring($im,$font,$h+2,$y,$v,$white);}}

/*  [star] => HD 150680
	[name] => Zeta Herculis
	[planet] => Dookaïa
	[status] => amical
	[ad] => 240.68
	[dc] => 31.36
	[dist] => 35*/

static function dots($r,$im,$ha,$font){
$h=$ha-16; $mid=$h/2; $mx=$mid; $my=$mid; $sz=10;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray]=img::clrpack($im);//spe
//[$good,$bad,$neutral,$bigstar,$hostile]=self::clr($im); //pr($r);
if($r)foreach($r as $k=>$v){
	$ad=$v['ad']; $ad-=90; 
	$dc=$v['dc']; $mxb=$dc<0?$mx+$h:$mx;
	if($dc<0){$dc=abs($dc); $ad=180-$ad;}
	$ray=$mid-(($mid/90)*$dc);
	$a=deg2rad($ad); $x=$mxb+round(cos($a)*$ray,4); $y=$my+round(sin($a)*$ray,4);
	//verbose([$ray,$a,$x,$y]);
	$stt=$v['status'];
	if($stt=='amical')$clr=$green;
	elseif($stt=='inamical')$clr=img::imgclr($im,'ff9900');
	elseif($stt=='hostile')$clr=$red;
	elseif($stt=='neutre')$clr=$yellow;
	elseif($stt=='galaxy')$clr=$blue;
	else $clr=$white;
	imagefilledellipse($im,$x,$y,$sz,$sz,$clr);
	//imagefilledellipse($im,$x,$y,$sz,$sz,$black);
	imageellipse($im,$x,$y,$sz,$sz,$white);
	if($v['hip']=='32578')$rp=[$x-40,$y-40]; else $rp=[$x-8,$y+8];
	imageline($im,$rp[0]+10,$rp[1]+10,$x,$y,$white);
	imagestring($im,$font,$rp[0],$rp[1],$v['name']?$v['name']:$v['star'],$clr);
	//if($v['dist'])imagestring($im,$font,$rp[0],$rp[1],$v['dist'].' Al',$silver);
	imagestring($im,$font,$rp[0],$rp[1]+12,$v['planet'],$clr);}}

static function map($r,$im,$ha,$font,$hemi=1){
$h=$ha-16; $mid=$h/2; $mx=$hemi==2?$h+$mid:$mid; $my=$mid;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$silver,$gray]=img::clrpack($im);//spe
for($i=1;$i<=6;$i++){$hb=round($h/6*$i,2);
	imageellipse($im,$mx,$my,$hb,$hb,$gray);
	$t=$i*15; $mb=$mid/6; $y=($mb*$i);
	if($t<90)imagestring($im,$font,$mx,$y,$t,$gray);}
imageellipse($im,$mx,$my,$h,$h,$white);
for($i=0;$i<24;$i++){$a=$i*15; $a=deg2rad($a); //15=360/24:
	$x=$mx+round(cos($a)*$mid,4); $y=$my+round(sin($a)*$mid,4);
	imageline($im,$mx,$my,$x,$y,$gray);
	$a=$i*15-90; $a=deg2rad($a); $t=$hemi==2?24-$i:$i; if($t==24)$t=0;
	$x=$mx+round(cos($a)*$mid,4); $y=$my+round(sin($a)*$mid,4);
	imagestring($im,$font,$x,$y,$t,$gray);}}

static function draw($out,$r,$h){$w=$h*2; $im=imagecreate($w,$h); //p($r);
[$white,$black,$red,$green,$blue,$yellow,$cyan]=img::clrpack($im);//spe
$font=imageloadfont('gdf/Fixedsys.gdf');
ImageFilledRectangle($im,0,0,$w,$h,$black);
self::map($r,$im,$h,$font);
self::map($r,$im,$h,$font,2);
self::dots($r,$im,$h,$font);//stars
self::legend($r,$im,$h,$font);
imagepng($im,$out);
return $out;}

static function datas($r){
foreach($r as $k=>$v){
$rb[$k]['star']=$v[1];
$rb[$k]['name']=$v[0];
$rb[$k]['planet']=$v[6];
$rb[$k]['status']=$v[5];
$rb[$k]['hip']=$v[8];
$ad=$v[2];//16h41m
//if(!$ad)break;
$ad1=substr($ad,0,2); if(!is_numeric($ad1))$ad1=0;
$ad2=mb_substr($ad,3,2); if(!is_numeric($ad2))$ad2=0;
$ad=round($ad1/24*360+$ad2/60,2);
//$rb[$k]['ada']=$v[2];
$rb[$k]['ad']=$ad;
$dc=$v[3];//+31°36'
//$rb[$k]['dca']=$v[3];
$sign=substr($dc,0,1);
$dc1=substr($dc,1,2); if(!is_numeric($dc1))$dc1=0;
$dc2=mb_substr($dc,4,2); if(!is_numeric($dc2))$dc2=0;
$dc=$dc1+($dc2/100);
if($sign=='-')$dc=0-$dc;
$rb[$k]['dc']=$dc;
$ds=str_replace(',','.',$v[4]);//14,2
$rb[$k]['dist']=$ds;}
return $rb;}

static function build($p,$o){
$r=msql::read_b('',nod('exo_4'),'',1); //p($r);
$rb=self::datas($r);
$f='_datas/umstars.png';
$ret=self::draw($f,$rb,900);
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p;
$im=self::build($p,$o);
$ret=image('/'.$im.'?'.randid());
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_umstars,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid('umstars'); 
//$bt=self::menu($p,$o,$rid);
$im=self::build($p,$o);
$im=$im.'?'.randid();
$ret=btim($im,1400);
//$ret=image($im,1400);
$bt=msqbt('',nod('exo_4'));
return divd($rid,$ret).$bt;}

}
?>