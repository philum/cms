<?php //um3d
class um3d{
static $clr=['#ffffff','#000000','#ff0000','#00ff00','#0000ff','#ffff00','#00ffff','#ff9900','#cccccc','#666666'];

static function legend($r,$ha,$font){$h=$ha-40; $mid=$h/2; $sz=16;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;//spe
$r=['amical','neutre','pas amical','hostiles'];
foreach($r as $k=>$v){
	if($v=='amical')$clr=$green;
	elseif($v=='pas amical')$clr=$orange;
	elseif($v=='hostiles')$clr=$red;
	else $clr=$yellow;
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

static function projection($v,$h,$max){$mid=$h/2;
$x=$v/2-$mid; $y=$v/2;  
return [$x,$y];}

static function dots($r,$h,$font,$side){
$mid=$h/2; $mx=$mid; $my=$mid; $sz=16; if($side==2)$mx+=$h;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;//spe
foreach($r as $k=>$v)$rz[]=$v['dist']; $max=max($rz); $ratio=$mid/$max;
foreach($r as $k=>$v){
	//[$x,$y]=self::projection($v,$h,$max);
	$ad=$v['ad']; $dc=$v['dc']; $ds=$v['dist']*$ratio; if($side==2)$ad-=90;
	$a=deg2rad($ad); $x=$mx+round(sin($a)*$ds,4); $z=$my+round(cos($a)*$ds,4);
	$y=$my+round(sin(deg2rad($dc))*$ds,4);
	//$x+=$z/2; $y+=$z/2;
	//verbose([$ds,$x,$y,$z]);
	$stt=$v['status'];
	if($stt=='amical')$clr=$green;
	elseif($stt=='pas amical')$clr=$orange;
	elseif($stt=='hostiles')$clr=$red;
	else $clr=$yellow;
	//svg::circle($x,$y,$sz*2,$clr);
	svg::circle($x,$y,$sz,$clr,$black,2);
	svg::text($font,$x-20,$y+16,$v['star']!='-'?$v['star']:$v['name'],$white);
	if($v['dist'])svg::text($font,$x-10,$y+28,$v['dist'].' Al',$yellow);
	if($v['planet'])svg::text($font,$x-10,$y+38,$v['planet'],$clr);}}

static function map($r,$h,$side){
$mid=$h/2; $mx=$mid; $my=$mid; if($side==2)$mx+=$h;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;//spe
svg::line($mx,0,$mx,$h,$green);
svg::line(0,$my,$h,$my,$red);
svg::line(0,$h,$h,0,$blue);
$unit=$h/40;
for($i=1;$i<=40;$i++){$u=$unit*$i;
	$x=$mx-5; $y=$u; $x2=$mx+5; $y2=$u;
	svg::line($x,$y,$x2,$y2,$gray);
	$x=$u-5; $y=$my+5; $x2=$u+5; $y2=$my-5;
	svg::line($x,$y,$x2,$y2,$gray);
	$x=$u-5; $y=$h-$u; $x2=$u+5; $y2=$h-$u;
	svg::line($x,$y,$x2,$y2,$gray);}}

static function map2($r,$h,$side){
$mid=$h/2; $mx=$mid+$h; $my=$mid; $zero=$h;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;//spe
svg::line($mx,0,$mx,$h,$green);
svg::line($zero,$my,$zero+$h,$my,$blue);
svg::line($zero,$h,$zero+$h,0,$red);
$unit=$h/40;
for($i=1;$i<=40;$i++){$u=$unit*$i;
	$x=$zero+$mx-5; $y=$u; $x2=$zero+$mx+5; $y2=$u;
	svg::line($x,$y,$x2,$y2,$gray);
	$x=$zero+$u-5; $y=$my+5; $x2=$zero+$u+5; $y2=$my-5;
	svg::line($x,$y,$x2,$y2,$gray);
	$x=$zero+$u-5; $y=$h-$u; $x2=$zero+$u+5; $y2=$h-$u;
	svg::line($x,$y,$x2,$y2,$gray);}}

static function draw($r,$h){$w=$h*2; $im=new svg($w,$h); //p($r);
[$white,$black,$red,$green,$blue,$yellow,$cyan]=self::$clr;//spe
$font=10;//size
svg::rect(0,0,$w,$h,$black);
self::map($r,$h,$font);
self::dots($r,$h,$font,1);//stars
self::map2($r,$h,$font);
self::dots($r,$h,$font,2);//stars
//self::legend($r,$h,$font);
return svg::draw();}

static function datas($r,$h){
$mid=$h/2; $mx=$mid; $my=$mid;
foreach($r as $k=>$v)if($v[5] && $v[5]<300){//300Al
$rb[$k]['star']=$v[1];
$rb[$k]['name']=$v[0];
$rb[$k]['planet']=$v[6];
$rb[$k]['status']=$v[4];
$ad=$v[2];//16h41m
$ad1=substr($ad,0,2); $ad2=substr($ad,3,2);
$ad=round($ad1/24*360+$ad2/60,2);
//$rb[$k]['ada']=$v[2];
$rb[$k]['ad']=$ad;
$dc=$v[3];//+31°36'
//$rb[$k]['dca']=$v[3];
$sign=substr($dc,0,1); $dc=substr($dc,1,2)+(substr($dc,4,2)/100); if($sign=='-')$dc=0-$dc;
$rb[$k]['dc']=$dc;
$ds=str_replace(',','.',$v[5]);//14,2
$rb[$k]['dist']=$ds;}
return $rb;}

static function build($p,$o){$p=$p?$p:600;
$r=msql::read_b('','ummo_exo_2','',1); //p($r);
$rb=self::datas($r,$p); //pr($rb);
$ret=self::draw($rb,$p);
return $ret;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$$p;
$ret=self::build($p,$o);
return $bt.$ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_um3d,call_inp',picto('ok')).' ';
return $ret;}

static static function home($p,$o){
$rid=randid('um3d');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
$bt.=msqbt('','ummo_um3d_1');
return $bt.divd($rid,$ret);}

}
?>