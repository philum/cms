<?php 
class maths{
static $bcs=20;

function __construct($n=''){bcscale($n?$n:self::$bcs);}

static function powr($n){return pow($n,2);}
static function sqrt_b($v,$n){return pow((float)$v,bcdiv(1,$n,99));}
static function hypothenuse($ca,$co){return sqrt(self::powr($ca)+self::powr($co));}
static function pytha_cote($hy,$c){return sqrt(self::powr($hy)-self::powr($c));}
static function cercle_longueur($rayon){return M_PI*($rayon*2);}
static function cercle_surface($diametre){return (M_PI/4)*self::powr($diametre);}
static function sphere_surface($diametre){return M_PI*self::powr($diametre);}
static function sphere_volume($diametre){return (pi()/6)*pow($diametre,3);}
static function volume_rayon($n){return bcdiv(4,3,99)*M_PI*bcpow($n,3,99);}
static function volum2ray($n){$a=bcdiv($n,M_PI); $b=bcdiv(3,4); $c=bcmul($a,$b); return bcpow($c,1/3);}
static function area2ray($n){$a=bcmul(4,M_PI); return self::sqrt_b($n,$a);}

static function radian($a){return deg2rad($a);}
static function sinus($a){return sin(self::radian($a));}
static function cosinus($a){return cos(self::radian($a));}
static function tangente($a){return tan(self::radian($a));}
static function degres($radian){return rad2deg($radian);}
static function arcsin($a){return self::degres(asin($a));}
static function arccos($a){return self::degres(acos($a));}
static function arctan($a){return self::degres(atan($a));}
static function sin_rect($co,$hy){return $co/$hy;}//sinus = côté opposé / hypoténuse
static function cos_rect($ca,$hy){return $ca/$hy;}//cosinus = côté adjacent / hypoténuse
static function tan_rect($co,$ca){return $co/$ca;}//tangente = côté opposé / côté adjacent
static function cotan_rect($co,$ca){return $ca/$co;}//cotangente = inverse de tangente
static function ratan2($x,$y){return rad2deg(atan2($x,$y))+(($x<0)?180:0);}//compass

//astro
static function nm2thz($d){return self::lightspeed()/($d*pow(10,3));}//usable reciprocally
static function cm2hz($d){return self::soundspeed()/($d*pow(10,-2));}//w=c/f
static function parsec(){return 648000/M_PI;}
static function soundspeed(){return 345;}//m/s
static function lightspeed(){return 299792458;}//m/s
static function al2km($d){return bcmul($d,9460730472580,8);}
static function km2al($d){return bcdiv($d,9460730472580,8);}
static function pc2km($d){return bcmul($d,30856780000000,8);}
static function km2pc($d){return bcdiv($d,30856780000000,8);}
static function pc2al($d){return bcmul($d,3.261563777,8);}
static function al2pc($d){return bcdiv($d,3.261563777,8);}
static function sunsz($d,$o=1){return bcmul($d,1392000,2);}//sun size
static function mas2deg($d){return bcmul($d,0.00027777777777778,8);}
static function al2time($d){return bcmul($d,0.00027777777777778,8);}
static function deg2mas($d){return $d*3600;}
static function mas2rad($d){return deg2rad(self::mas2deg($d));}
static function mas2pc($d){return bcdiv(1,$d,8);}
static function pc2mas($d){return bcdiv(1,$d,8);}//
static function al2mas($d){return 1/self::al2pc($d);}
static function mas2al($d){return self::pc2al(1/($d*1e-3));}//mas
static function ra2deg($d){//00h00m00s
	$d=str_replace(' ','',$d);
	$ad1=(float)substr($d,0,2); $ad2=(float)substr($d,3,2); $ad3=(float)substr($d,6,2);//1h=15,1m=0.25
	$a=($ad1*15); $b=bcmul($ad2,0.25); $c=bcmul($ad3,0.25/60); //echo $a.'+'.$b.'+'.$c.'-  ';
	return $a+$b+$c;}//round,4
static function dec2deg($d){//+00°00'00"
	$d=str_replace('°','d',$d); $d=str_replace('&prime;','m',$d); $d=str_replace('&Prime;','s',$d);
	$d=str_replace(' ','',$d); if(substr($d,0,1)!='-' && substr($d,0,1)!='+')$d='+'.$d;
	$ad1=(float)substr($d,0,3); $ad2=(float)substr($d,4,2); $ad3=(float)substr($d,8,2);
	$a=$ad1; $b=bcdiv($ad2,60); $c=bcdiv($ad3,600); //echo $a.'--'.$b.'--'.$c.'-- ';
	return $a+$b+$c;}
static function deg2ra($d){$ha=$d/15; $h=floor($ha);//if(!is_int($d))echo $d=floatval($d);
	$hab=$ha-$h; if($hab)$ma=round(60*$hab,4); else $ma=0; $m=floor($ma);
	$mab=$ma-$m; if($mab)$sa=round(10*$mab,4); else $sa=0; $s=floor($sa);
	$sf=round((10*$mab)-$s,2)*100;
	$h=str_pad($h,2,'0',STR_PAD_LEFT);
	$m=str_pad($m,2,'0',STR_PAD_LEFT);
	$s=str_pad($s,2,'0',STR_PAD_LEFT).'.'.$sf;
	return $h.'h'.$m.'m'.$s.'s';}
static function deg2dec($d){$deg=floor($d);//+00°00'00"
	$m1=$d-$deg; $m2=$m1/10*60*10; $m=floor($m2);
	$s1=$m2-$m; $s2=$s1/10*60*10; $s=floor($s2);
	$sf=round($s2-$s,2)*60; //echo $deg.'+'.$m.'+'.$s.'-'.$sf.' ';
	$deg=str_pad($deg,2,'0',STR_PAD_LEFT);
	$m=str_pad($m,2,'0',STR_PAD_LEFT);
	$s=str_pad($s,2,'0',STR_PAD_LEFT).'.'.$sf;
	if($deg>0)$deg='+'.$deg;
	return $deg.'d'.$m.'m'.$s.'s';}
static function ra2rad($d){return deg2rad(self::ra2deg($d));}
static function dec2rad($d){return deg2rad(self::dec2deg($d));}
static function rad2ra($d){return self::ra2deg(rad2deg($d));}
static function rad2dec($d){return self::dec2deg(rad2deg($d));}

//bases
static function dec2base($dec,$b,$d=false){
if($b<2 or $b>256)die('Invalid Base: '.$b); bcscale(0); $v=''; if(!$d)$d=self::digits($b);
while($dec>$b-1){$rest=bcmod($dec,$b); $dec=bcdiv($dec,$b); $v=$d[$rest].$v;}
$v=$d[intval($dec)].$v;
return (string)$v;}

static function base2dec($v,$b,$d=false){
if($b<2 or $b>256)die('Invalid base: '.$b); bcscale(0);
if(!$d)$d=self::digits($b);
if($b<37)$v=strtolower($v);
$size=strlen($v); $dec='0';
for($loop=0;$loop<$size;$loop++){
$element=strpos($d,$v[$loop]); $power=bcpow($b,$size-$loop-1);
$dec=bcadd($dec,bcmul($element,$power));}
return (string) $dec;}

static function digits($b){$d='';
if($b>64)for($loop=0;$loop<256;$loop++)$d.=chr($loop);
else $d='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
return (string)substr($d,0,$b);}

//constants
static function pi2(){return bcdiv(4,bcsqrt(phi()));}
static function phi($n=10){$d=1; for($i=0;$i<10*$n;$i++)$d=bcadd(1,bcdiv(1,$d)); return $d;}//1e-40
static function phi2($n){static $i; $i++; if($i==$n)return 1; return bcadd(1,bcdiv(1,self::phi2($n)));}
static function fibo(){$a=1; $b=1; $max=100;
for($i=1;$i<$max;$i++){$c=bcadd($a,$b); $ret=bcdiv($c,$b); $a=$b; $b=$c;}
return $ret;}

//longueur d'une hélice //long,nb_spires,diam,haut
static function helice($l,$n,$d,$h){return sqrt(self::powr($l)+self::powr($n)+self::powr($d)+self::powr($h));}
static function centrifuge($d,$t){return 4*pow(pi(),2)*$d/pow($t,2);}

//renvoie angle en degrés
static function missing_angle($r){//adj/opp/hyp 
if(!$r[0])return self::arcsin(self::sin_rect($r[1],$r[2]));
if(!$r[1])return self::arccos(self::cos_rect($r[0],$r[2]));
if(!$r[2])return self::arctan(self::tan_rect($r[1],$r[0]));}

//renvoie la longueur manquante dans un triangle rectangle
static function missing_length($r){//adj/opp/hyp 
$a=self::missing_angle($r);
if(!$r[0])$r[0]=$r[2]*self::cosinus($a);
if(!$r[1])$r[1]=$r[2]*self::sinus($a);
if(!$r[2])$r[2]=$r[0]/self::cosinus($a);
return $r;}

//renvoie la longueur manquante dans un triangle rectangle
static function pythagore($r){//adj/opp/hyp 
if(!$r[0])$r[0]=self::pytha_cote($r[2],$r[1]);
if(!$r[1])$r[1]=self::pytha_cote($r[2],$r[0]);
if(!$r[2])$r[2]=self::hypothenuse($r[0],$r[1]);
return $r;}

static function bcfact($fact){if($fact==1)return 1;
return bcmul($fact,self::bcfact(bcsub($fact,'1')));}

static function bcsin($a){$or=$a;
$r=bcsub($a,bcdiv(bcpow($a,3),6)); $i=2;
while(bccomp($or,$r)){$or=$r; switch($i%2){
case 0:$r=bcadd($r,bcdiv(bcpow($a,$i*2+1),self::bcfact($i*2+1)));break;
default:$r=bcsub($r,bcdiv(bcpow($a,$i*2+1),self::bcfact($i*2+1)));break;}
$i++;}
return $r;}

static function bccos($a){$or=$a;
$r=bcsub(1,bcdiv(bcpow($a,2),2)); $i=2;
while(bccomp($or,$r)){$or=$r; switch($i%2){
case 0:$r=bcadd($r,bcdiv(bcpow($a,$i*2),self::bcfact($i*2)));break;
default:$r=bcsub($r,bcdiv(bcpow($a,$i*2),self::bcfact($i*2)));break;}
$i++;}
return $r;}

static function bcpi(){$r=2; $i=0; $or=0;
while(bccomp($or,$r)){$i++; $or=$r;
	$r=bcadd($r,bcdiv(bcmul(bcpow(self::bcfact($i),2),bcpow(2,$i+1)),self::bcfact(2*$i+1)));}
return $r;}

static function trigo($o,$a,$h){//3,4,5
if($o && $h){$sin=$o/$h; $o=$sin*$h; $h=$o/$sin; $d=asin($sin);}//0.6
if($a && $h){$cos=$a/$h; $a=$cos*$h; $h=$a/$cos; $d=acos($cos);}//0.8
if($o && $a){$tan=$o/$a; $o=$tan*$a; $a=$o/$tan; $d=atan($tan);}//0.75
if(!$o && $h)$o=sin($d)*$h; elseif(!$o && $a)$o=tan($d)*$h;
if(!$a && $h)$a=cos($d)*$h; elseif(!$a && $o)$a=$o/tan($d);
if(!$h && $o)$h=$o/sin($d); elseif(!$h && $a)$h=$a/cos($d);
return [$o,$a,$h];}

static function opposite_angle($tan){return atan(1/$tan);}//angle opposé
static function hypothenuse_from_oa($x,$y){return $x/cos(atan($y/$x));}
static function distance3d($r1,$r2){//v[(xA-xB)²+(yA-yB)²+(zA-zB)²]
return bcsqrt(bcpow($r1[0]-$r2[0],2)+bcpow($r1[1]-$r2[1],2)+bcpow($r1[2]-$r2[2],2));}

//3d coords from angles
static function xyz($a,$b,$ds,$o='',$ob=''){
if(!$ob){$a=deg2rad($a); $b=deg2rad($b);}
$x=(sin($a)*cos($b)); $y=(sin($a)); $z=cos($a);//works for calc distances
//$x=(sin($a)*cos($b)); $y=(sin($a)*sin($b)); $z=cos($a);//uh?
//$x=(sin($a)*sin($b)); $y=(sin($b)*cos($a)); $z=cos($a);//bab/#U6XMUF#9
//$x=sin($a); $y=cos($b); $z=sin($a-$b);//dav
//$x=0-sin($a)*cos($b); $y=sin($b); $z=cos($a);//star3d
//$x=0-sin($a)*sin($b); $y=sin($b)*cos($a); $z=cos($a);//test
if($o){$x=round($x,2); $y=round($y,2); $z=round($z,2);}
return [$x*$ds,$y*$ds,$z*$ds];}//,$a,$b

static function xyz2angles($x,$y,$z,$o=2){//o1,a,o2
$ad=atan(bcdiv($x,$z)); $dc=atan(bcdiv($y,$z));
//$ad=atan2($x,$z); $dc=atan2($y,$z);
//$ad=self::ratan2($x,$z); $dc=self::ratan2($y,$z);
$ds=sqrt(pow($x+$y,2)+pow($z,2));//$ds=$x/cos($ad);
//$ad=rad2deg($ad); $dc=rad2deg($dc);
return [$ad,$dc,$ds];}

//search opp/adj/hyp
static function triangle_lengths($a,$h){//alpha,hypotenuse
$a=deg2rad($a); $op=sin($a)*$h; $ad=cos($a)*$h;
return [$op,$ad,$h];}

static function star_xyz($r){
//if(is_numeric($r))return sql('x,y,z','umm.hipparcos','w',['hip'=>$r]);
//if(is_numeric($r))$r=sql('rarad,decrad,dist','umm.hipparcos','rv',['hip'=>$r]);
//if(is_numeric($r))$r=sql('ra,dc,dist','umm.hipparcos','rv',['hip'=>$r]);
if(!is_array($r)){
	if(strpos($r,' '))$r=explode(' ',$r);
	else $r=simbad::callr($r);}
$ad=self::ra2deg($r[0]); $dc=self::dec2deg($r[1]); $ds=$r[2];
return self::xyz($ad,$dc,$ds,1);}

static function stars_distance($r1,$r2){
$rx1=self::star_xyz($r1); //pr($rx1);
$rx2=self::star_xyz($r2); //pr($rx2);
[$x1,$y1,$z1]=$rx1;
//$ra=self::xyz2angles($x1,$y1,$z1,12); pr($ra);
return self::distance3d($rx1,$rx2);}

static function test(){
//$ret=self::pythagore(['',1,2]);//p($rb);
//$ret=self::phi_calcul($n);
//$ret=self::fibo();
//$ret=bccomp($phi,$fibo);
//$r=$m->trigo(4,3,'');
$m=new maths(40);
//$ret=$m->test();
$r0=[14.6,107.4443,96.885];//soluce
$r1=['12h30m14s',"+09°01'15",14.3];
//$r1=['00h00m00s',"+00°00'00",0];
$r2=['23h03m57',"-04°47'41",99.43];//hip 113896//hd 217877
$r2=['03h39m27',"-10°41'52",99.05];//hip 17265//hd 23065
//$d2='17265';
//$d2='113896';
//$d2='32578';
$ret=$m->stars_distance($r1,$r2);
return $ret;}

static function menu(){
$r=get_class_methods($this);
return tabler($r,'');}

static function home($p,$o){bcscale(self::$bcs);
if(method_exists($p))return self::$p($o);}
}
?>