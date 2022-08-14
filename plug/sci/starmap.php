<?php //starmap (svg)

class starmap{
static $default='knownstars';//81693,99461,88601
static $clr=['#ffffff','#000000','#ff0000','#00ff00','#0000ff','#ffff00','#00ffff','#ff9900','#cccccc','#666666'];

static function legend($r,$ha,$font){$h=$ha-40; $mid=$h/2; $sz=16;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;//spe
$r=starlib::$clr2; $i=0;
foreach($r as $k=>$v){
	$clr=$v; $x=$h; $y=$sz+$i*$sz; $i++;
	svg::rect($x,$y,$sz,$sz,$clr);
	svg::text($font,$h+$sz+6,$y+$sz,$k,$white);}}

static function dots($r,$ha,$font){
$h=$ha-40; $mid=$h/2; $mx=$mid; $my=$mid; $mx+=20; $my+=20; $sz=6;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;
$rc=starlib::$clr2;
if($r)foreach($r as $k=>$v){
	[$hip,$star,$dist,$mag]=vals($v,['name','star','dist','mag']);
	$ad=$v['ad']; $ad-=90; 
	$dc=$v['dc']; $mxb=$dc<0?$mx+$h:$mx;
	if($dc<0){$dc=abs($dc); $ad=180-$ad;}
	$ray=$mid-(($mid/90)*$dc);
	$a=deg2rad($ad); $b=deg2rad($dc); 
	$x=$mxb+round(cos($a)*$ray,4); $y=$my+round(sin($a)*$ray,4);
	$spc=substr($v['spec'],0,1); $clr=$rc[$spc];
	//svg::circle($x,$y,$sz,$clr,$black,2);
	$circ='['.$clr.',black,1:attr]['.$x.','.$y.','.$sz.':circle]';
	$tx=round($dist,2).' Al';
	svg::$ret[]='['.$tx.',star;info___'.$hip.'_hip§'.$circ.':bubj2]';
	//svg::$ret[]='['.$tx.'§'.$circ.':bub]';
	svg::lj($x+6,$y+6,12,$white,'popup_star;call___'.$hip.'_1',$star);}}

static function map($r,$ha,$font,$hemi=1){
$h=$ha-40; $mid=$h/2; $mx=$hemi==2?$h+$mid:$mid; $my=$mid; $mx+=20; $my+=20;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;//spe
svg::circle($mx,$my,$h/2,'',$white);
for($i=1;$i<=6;$i++){$hb=round($h/6*$i,2)/2;
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

//$rh=['hd','hip','RA (h-m-s)','dec (d-m-s)','dist (al)','spect','mag'];
static function prep($r){$rb=[];
if($r)foreach($r as $k=>$v){
$rb[$k]['star']=$v[0];//hd
$rb[$k]['name']=$v[1];//hip
$rb[$k]['spec']=$v[5];
$rb[$k]['mag']=$v[6];
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
$rn=[]; $rc=[]; if(!$p)$p='knownstars';
if($p=='knownstars'){
$ra=msql::read('','ummo_exo_5','',1); if($ra)$p=implode(',',array_keys_r($ra,8));
if($ra)foreach($ra as $k=>$v)if($v[8])$rn[$v[8]]=$v[6]?$v[6]:$v[0];
if($ra)foreach($ra as $k=>$v)if($v[8])$rc[$v[8]]=$v[5];}
$sq=star::sq($p);
$r=star::build($sq,0); //p($r);
//if($rn)foreach($r as $k=>$v)$r[$k][1]=$rn[$v[1]]??$v[1];
$rb=self::prep($r); //pr($rb);
$ret=self::draw($rb,600);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
ses::$r['popw']='1200';
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_starmap,call_insm_xr';
$ret=inputj('insm',$p,$j,'knownstars').' ';
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$rid=randid('starmap'); $bt=''; $ret='';
$bt=self::menu($p,$o,$rid);
if(!$p)$p=self::$default;
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}
?>