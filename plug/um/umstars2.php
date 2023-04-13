<?php //umstars2 (svg)
class umstars2{
static $clr=['#ffffff','#000000','#ff0000','#00ff00','#0000ff','#ffff00','#00ffff','#ff9900','#cccccc','#666666'];

static function legend($r,$ha,$font){$h=$ha-40; $mid=$h/2; $sz=16;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;//spe
$r=['amical','neutre','inamical','hostile'];
foreach($r as $k=>$v){
	if($v=='amical')$clr=$green;
	elseif($v=='inamical')$clr=$orange;
	elseif($v=='hostile')$clr=$red;
	elseif($v=='neutre')$clr=$yellow;
	else $clr=$white;
	$x=$h; $y=$sz+$k*$sz;
	svg::rect($x,$y,$sz,$sz,$clr);
	svg::text($font,$h+$sz+2,$y+$sz,$v,$white);}}

/*  [star] => HD 150680
	[name] => Zeta Herculis
	[planet] => Dookaïa
	[status] => amical
	[ad] => 240.68
	[dc] => 31.36
	[dist] => 35*/

static function dots($r,$ha,$font){
$h=$ha-40; $mid=$h/2; $mx=$mid; $my=$mid; $mx+=20; $my+=20; $sz=16; //pr($r);
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;//spe
foreach($r as $k=>$v){
	$ad=$v['ad']; $ad-=90; 
	$dc=$v['dc']; $mxb=$dc<0?$mx+$h:$mx;
	if($dc<0){$dc=abs($dc); $ad=180-$ad;}
	$ray=$mid-(($mid/90)*$dc);
	$a=deg2rad($ad); $b=deg2rad($dc); 
	$x=$mxb+round(cos($a)*$ray,4); $y=$my+round(sin($a)*$ray,4);
	//verbose([$ray,$a,$x,$y]);
	$stt=$v['status'];
	if($stt=='amical')$clr=$green;
	elseif($stt=='inamical')$clr=$orange;
	elseif($stt=='hostile')$clr=$red;
	elseif($stt=='neutre')$clr=$yellow;
	elseif($stt=='galaxy')$clr=$blue;
	else $clr=$white;
	//svg::circle($x,$y,$sz*2,$clr);
	svg::circle($x,$y,$sz,$clr,$black,2);
	//svg::tog($x,$y,$sz,$black,$v['star'],$v['dist'].' '.$v['planet']);
	[$hip,$name,$planet,$dist,$source]=vals($v,['hip','name','planet','dist','source']);
	//$tx=ajx($hip.' - HD'.$star.' - '.$planet.n().$dist.' AL - '.$source);
	//svg::lj($x,$y+16,12,$white,'popup_usg,txt___'.$tx,$v['hip']);
	svg::lj($x,$y+16,12,$white,'popup_star,call___'.$hip.'_1',$name);
	if($dist)svg::text($font,$x-10,$y+28,round($dist,2).' Al',$yellow);
	//svg::text($font,$x-20,$y+16,$v['hip'].' - '.$v['star'],$white);
	//if($v['dist'])svg::text($font,$x-10,$y+28,$v['dist'].' Al',$yellow);
	//if($v['planet'])svg::text($font,$x-10,$y+38,$planet,$clr);
	}}

static function map($r,$ha,$font,$hemi=1){
$h=$ha-40; $mid=$h/2; $mx=$hemi==2?$h+$mid:$mid; $my=$mid; $mx+=20; $my+=20;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;//spe
svg::circle($mx,$my,$h,'',$white);
for($i=1;$i<=6;$i++){$hb=round($h/6*$i,2);
	svg::circle($mx,$my,$hb,'',$gray);
	$t=$i*15; $mb=$mid/6; $y=($mb*$i);
	if($t<90)svg::text($font,$mx-7,$y+14,$t,$gray);}
for($i=0;$i<24;$i++){$a=$i*15; $a=deg2rad($a); //15=360/24:
	$x=$mx+round(cos($a)*$mid,4); $y=$my+round(sin($a)*$mid,4);
	svg::line($mx,$my,$x,$y,$gray);
	$a=$i*15-90; $a=deg2rad($a); $t=$hemi==2?24-$i:$i; if($t==24)$t=0;
	$x=$mx-4+round(cos($a)*($mid-8),4); $y=$my+4+round(sin($a)*($mid-8),4);
	svg::text($font,$x,$y,$t,$gray);}}

static function draw($r,$h){$w=$h*2; $sz=$w.'/'.$h; $im=new svg($w,$h); //p($r);
[$white,$black,$red,$green,$blue,$yellow,$cyan]=self::$clr;//spe
$font=10;//size
svg::rect(0,0,$w,$h,$black);
self::map($r,$h,$font);
self::map($r,$h,$font,2);
self::dots($r,$h,$font);//stars
self::legend($r,$h,$font);
return svg::draw();}

static function datas($r){
foreach($r as $k=>$v){
$rb[$k]['star']=$v[1];//hd
$rb[$k]['name']=$v[0];
$rb[$k]['planet']=$v[6];
$rb[$k]['status']=$v[5];
$rb[$k]['hip']=$v[8];
$ad=$v[2];//16h41m
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
$rb=self::datas($r); //pr($rb);
$ret=self::draw($rb,$p?$p:900);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_umstars2,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$bt='';
$rid=randid('umstars2');;
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
$bt.=msqbt('',nod('exo_4'));
return $bt.divd($rid,$ret);}

}
?>