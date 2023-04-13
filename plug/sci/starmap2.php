<?php //starmap (svg)

class starmap2{
static $conn=1;
static $default='2021,8102,7981,99461,Yooma,64394,88601';//81693,99461,88601
static $w=800;
static $subd=5;
static $rtx=[];

static function legend($r,$p1,$p2,$ob){
$w=self::$w; $h=$w; $mid=$h/2; $sz=16; $p1b=ajx($p1); $n=self::$subd; $scale=$p2/$n;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=starlib::$clr;
$rc=starlib::$clr2; $i=1; $l=($mid-40)/$n; $x=40; $y=$mid;
svg::text(11,$w-35,$mid,$p2.' Ly',$gray); svg::text(11,5,$mid,$p2.' Ly',$gray);//scale
svg::line($x,$y,$l+40,$y,$white); svg::line($x,$y-4,$x,$y+4,$white); svg::line($l+40,$y-4,$l+40,$y+4,$white);
svg::text(11,50,$y-6,$scale.' Ly',$silver);//unit
foreach($rc as $k=>$v){$i++;
	$clr=$v; $y=$i*$sz;
	svg::circle(20,$y-5,5,$clr);
	svg::text(11,20+$sz-2,$y,$k,$white);}
$x=60; $j='stm2_starmap2;call__2_'.$p1.'_'.$p2.'-';
$i=2; $y=$i*$sz; svg::lj($x,$y,11,$silver,$j.'0','0d');
$x+=18; svg::lj($x,$y,11,$silver,$j.'1','90d');
$x+=24; svg::lj($x,$y,11,$silver,$j.'2','180d');
$x+=32; svg::lj($x,$y,11,$silver,$j.'3','270d');
$x=60; $j='stm2_starmap2;call__2_'.$p1.'_';
$i+=2; $y=$i*$sz; svg::lj($x,$y,11,$silver,$j.'20-'.$ob,'20Ly');
$i++; $y=$i*$sz; svg::lj($x,$y,11,$silver,$j.'60-'.$ob,'60Ly');
$i++; $y=$i*$sz; svg::lj($x,$y,11,$silver,$j.'200-'.$ob,'200Ly');
$i++; $y=$i*$sz; svg::lj($x,$y,11,$silver,$j.'-'.$ob,'auto');}

static function dots($r,$p1,$p2){
$w=self::$w; $h=$w; $mid=$h/2; $mx=$mid; $my=$mid; $mx+=20; $my+=20; $sb=4; $rc=starlib::$clr2; $rz=starlib::sz($r);
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=starlib::$clr;//spe
$ra=['hip','hd','x','y','star','planet','status','dist','radius','mag','spect','hs','rg'];
foreach($r as $k=>$v){
	[$hip,$hd,$x,$y,$st,$pl,$stt,$ds,$ray,$mg,$spc,$hs,[$xa1,$ya1,$xa2,$ya2]]=vals($v,$ra);
	$nm=$st?$st:($hd?'HD'.$hd:''); $spc=substr($v['spect'],0,1); $ds=$v['dist']??30; $ray=$v['radius']??1;
	$clr=$rc[$spc]??'#999999'; //$clr=starlib::sttclr($stt);
	//svg::line($mid,$mid,$x,$y,$silver);//radial
	$clin=$hs>0?$green:$orange; if($ds>$p2)$clin=$gray;
	$sz=$rz[$k]; if($sz<4)$sz=4;
	svg::line($xa1,$ya1,$xa2,$ya2,$clin,'');//mark
	svg::line($x,$y,$x,$y-$hs,$clin,'','','4');//link
	svg::circle($x,$y-$hs,$sz,$clr,$black,1);
	$tx=$nm.' ('.round($ds,2).' LY) ';//'HD'.$v['hd']
	$len=self::len($nm);
	$xb=$x+$sb+4; if($xb+$len>$w)$xb=$x-$sb-$len;
	$yb=$y-$hs+4; self::$rtx[$hip]=[$xb,$yb];
	//svg::text($font,$xb,$yb,$v['star']!='-'?$v['star']:$v['name'],$white);
	//svg::lj($xb,$yb,12,$white,'popup_star,call___'.$hip.'_1','HIP '.$hip);
	//svg::bubj($xb,$yb,12,$white,'star;info___'.$v['hip'].'_hip',$nm);
	$clr=$ds>$p2?'gray':'white';
	svg::$ret[]='['.$clr.':attr]['.$tx.',star;info___'.$hip.'_hip§['.$xb.','.$yb.',12§'.$nm.':text]:bubj2]';}}
	
static function len($d){$r=str_split($d); $n=0;
foreach($r as $k=>$v)if(strstr('itl ',$v))$n+=3; else $n+=8;
return $n;}

static function ellipse($a,$n,$i,$o){
if($o==1 or $o==3)$i=$n-$i;
if($o==2 or $o==3)$a=0-$a;
return sin($i/($n/(M_PI/2)))*$a;}

static function arc($d,$a){
return [$x=$d*cos(deg2rad($a)),$y=$d*sin(deg2rad($a))];}

static function maxray($r){if(!$r)return;
$rd=array_keys_r($r,'dist'); $d=max($rd); $n=100000;
for($i=$n;$i>0;$i/=5)if($d<$i)$n=$i;
return ceil($d/$n)*$n;}

static function map($r,$p2,$ob){$n=self::$subd;
$w=self::$w; $h=$w; $wb=$w/2-40; $hb=$wb/4; $mid=$w/2; $mx=$mid; $my=$mid; $sz=11;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=starlib::$clr; $clrg='#777';
for($i=1;$i<=$n;$i++){$w2=round($wb/$n*$i,2);
	svg::ellipse($mx,$my,$w2,$w2/4,'',$clrg);
	$t=round($p2/$n*$i,2); $x=$mid+$w2; $y=$mid-($w2/4);}
//svg::ellipse($mx,$my,$wb,$hb,'none',$white);
//if($p2){svg::text(11,$w-40,$my,$p2.' Ly',$gray); svg::text(11,5,$my,$p2.' Ly',$gray);}
$ax=$wb*cos(deg2rad(45)); $ay=$wb*sin(deg2rad(45))/4;
svg::line(40,$my,$w-40,$my,$clrg);
svg::line($mx,$my-$hb,$mx,$my+$hb,$clrg);
svg::line($mx-$ax,$my-$ay,$mx+$ax,$my+$ay,$clrg);
svg::line($mx-$ax,$my+$ay,$mx+$ax,$my-$ay,$clrg);
$rx=['0h','6h','12h','18h']; if($ob)$rx=array_merge(array_slice($rx,4-$ob),array_slice($rx,0,4-$ob));
svg::text($sz,$mx+$ax+5,$my+$ay+10,$rx[0],$gray);
svg::text($sz,$mx+$ax+2,$my-$ay-2,$rx[1],$gray);
svg::text($sz,$mx-$ax-20,$my-$ay-2,$rx[2],$gray);
svg::text($sz,$mx-$ax-16,$my+$ay+10,$rx[3],$gray);}

static function draw($r,$p1,$p2,$ob){
$w=self::$w; $h=$w; $im=new svg($w,$h);
[$white,$black]=starlib::$clr;
svg::rect(0,0,$w,$h,$black);
self::map($r,$p2,$ob);
self::dots($r,$p1,$p2);//stars
self::legend($r,$p1,$p2,$ob);
return svg::draw();}

static function positions($r,$p2,$ob){//spherical projection
$w=self::$w; $h=$w/2; $wi=$w/2; $hi=$h/2; $wb=$w/2-40; $hb=$wb/4; $hr=$wb/90;
$r1=starlib::scale(array_keys_r($r,'dist'),$wb,$p2);
$as=45; if($ob)$as+=$ob*-90;
if($r)foreach($r as $k=>$v){
$ad=$v['ra']*15; $dc=$v['dc']; $ds=$r1[$k]; if($ds>$wb)$ds=$wb;
$a=deg2rad(360-$ad+$as); $b=deg2rad($dc-$as); $hs=round($dc*$hr,2);
$op=function($wi,$a,$ds,$n){return [$wi+round(cos($a)*($ds+$n),2),$wi+round((sin($a)*($ds+$n))/4,2)];};
[$xa,$ya]=$op($wi,$a,$ds,0); [$xa1,$ya1]=$op($wi,$a,$ds,-5); [$xa2,$ya2]=$op($wi,$a,$ds,5);
$r[$k]['x']=$xa; $r[$k]['y']=$ya; $r[$k]['hs']=$hs; $r[$k]['rg']=[$xa1,$ya1,$xa2,$ya2];} //pr($r);
return $r;}

static function build($p1,$p2,$ob){
if(!$p1)$p1=self::$default;
$ra=msql::read('','ummo_exo_5','',1); $pb=$p1;
if($p1=='knownstars')$pb=implode(',',array_keys_r($ra,8));
if($p1=='allstars'){$rb=msql::read('','ummo_exo_stars','',1);
	$ra=array_merge($ra,$rb); $pb=implode(',',array_keys_r($ra,8));}
$sq=star::sq($pb); //pr($sq);
$r=star::build($sq,1); //pr($r);
$rb=starlib::prep($r,$ra,$p1); //pr($rb);
$p2a=self::maxray($rb); $p2=$p2>$p2a||!$p2?$p2a:$p2;
$rb=self::positions($rb,$p2,$ob);
$ret=self::draw($rb,$p1,$p2,$ob);
return $ret;}

static function call($p1,$p2,$prm=[]){
[$p1,$p2]=prmp($prm,$p1,$p2);
[$p2,$ob]=expl('-',$p2);
//if($p3)self::$w=$p3;
$ret=self::build($p1,$p2,$ob);
return $ret;}

static function menu($p1,$p2,$rid){
$j=$rid.'_starmap2,call_p1,p2_xr';
$ret=inputj('p1',$p1?$p1:self::$default,$j,'',36);
$ret.=lj('',$j,picto('ok')).hlpbt('starmap').' ';
$ret.=inputj('p2',$p2?$p2:50,$j,'distance',4,['step'=>10,'type'=>'number']);
$ret.=label('p2',btn('small','(limit horizon)')).' ';
//$ret.=inputj('p3',1400,$j,'',4).label('p3','size').' ';
$ret.=lj('txtx',$rid.'_starmap2,call__2_'.self::$default,'default').' ';
$ret.=lj('txtx',$rid.'_starmap2,call__2_knownstars_50','known').' ';
$ret.=lj('txtx',$rid.'_starmap2,call__2_allstars_50','all').' ';
//$ret.=lj('txtx',$rid.'_starmap2,call_2__HD20766,HD61606,HD32923,HD217877,HD23065','serpo').' ';
return tag('header','',$ret);}

static function home($p1,$p2){
$rid=('stm2'); $bt=''; $ret='';
$bt=self::menu($p1,$p2,$rid);
if(!$p1)$p1=self::$default;
$ret=self::call($p1,$p2);
//ses::$r['popw']=self::$w+20;
//$s='width:'.(self::$w+20).'px';
return $bt.divb($ret,'',$rid);}
}
?>