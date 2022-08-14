<?php //starmap4

class starvue{
static $default='88601,dist<30';
static $w=400;
static $clr=['#ffffff','#000000','#ff0000','#00ff00','#0000ff','#ffff00','#00ffff','#ff9900','#cccccc','#666666'];
static $dims=[];

static function legend($r){$w=self::$w; $h=$w; $sz=16; $x=40; $y=0; $i=0;
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
svg::text(10,$x,$y+12,'Zones',$white);}

static function dots($r,$p){$n=count($r); $p=strto($p,',');
$w=self::$w; $h=$w; $mw=$w/24; $mh=$h/12; $sz=6; $xs=12; $rp=[];
if($n>50)$sz=6; if($n>200)$sz=4; if($n>500)$sz=2;
//$rc=starlib::proportion(array_keys_r($r,'dist'),0.2,1,500,1);
$rz=starlib::proportion(array_keys_r($r,'dist'),1,4,500,1);
//$rz=['O'=>12,'B'=>10,'A'=>9,'F'=>8,'G'=>7,'K'=>6,'M'=>5,'L'=>4,'T'=>3,'Y'=>'2',''=>5];
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;
if($r)foreach($r as $k=>$v){
	$x=$v['x']; $y=$v['y']; $st=$v['star']??''; $pl=$v['planet']??''; $stt=$v['status']??''; $ds=$v['dist']??'';
	$nm=$st?$st:($v['hd']?'HD'.$v['hd']:''); $spc=substr($v['spect'],0,1);
	$clr=starlib::sttclr($stt,$white);
	//$sz=$rz[$spc];
	$sz=$rz[$k];
	$opac=1;//$rc[$k];
	$bdr='none'; if($p==$v['hip'])$bdr=$white;
	//svg::circle($x,$y,$sz,$clr,'none',2);
	$circ='['.$clr.','.$bdr.',1,,'.round($opac,2).':attr]['.$x.','.$y.','.round($sz,2).':circle]';
	$tx='Hip'.$v['hip'].' ('.round($ds,2).' LY)';
	//svg::$ret[]='['.$clr.',none,1:attr][strv_starvue;call__2_'.$v['hip'].'§'.$t.':lj]';
	svg::$ret[]='['.$tx.',star;info___'.$v['hip'].'_hip§'.$circ.':bubj2]';
	$l=strlen($nm)*6; $xb=$x-26; $yb=$y+20;
	if($xb+$l>$w){$xb=$x-$l;}
	if($n<50)svg::lj($xb,$yb,$xs,$white,'popup_star;info___'.$v['hip'].'_hip',$nm);
	//$bt='['.$x.','.$y.','.$sz.':circle]';
	//svg::tog($x,$y,$xs,$clr,$nm,'hhgj');
}}

static function map($r){$w=self::$w; $h=$w;
[$white,$black,$red,$green,$blue,$yellow,$cyan,$orange,$silver,$gray]=self::$clr;
[$ray,$wd,$hd,$ra0,$ra1,$dc0,$dc1,$wm,$hm,$right,$left,$top,$bottom,$wr,$hr]=self::$dims;
$cx=30; $cy=10;//increments
$diffx=abs($right-round($right));//corrections
$diffy=abs($bottom-round($bottom));
for($i=0;$i<=$wd;$i++)if($i%$cx==0){
	$x=$wr*$i+($diffx*$wr); $hdec=($right-$diffx+(($wd-$i)/60));
	$hour=floor($hdec); $min=round(($hdec-$hour)*60); $t=$hour.'h'.str_pad($min,2,0,STR_PAD_LEFT);
	svg::line($x,0,$x,$h,$i==12?$white:$gray);
	svg::text(10,$x-12,10,$t,$yellow);}
for($i=0;$i<=$hd;$i++)if($hr*$i%$cy==0){
	$y=$hr*$i-($diffy*$hr); $t=round($bottom+($hd-$i));
	svg::line(0,$y,$w,$y,$t==0?$white:$gray);
	svg::text(10,0,$y+4,$t,$yellow);}}

static function draw($r,$sq,$p){
$w=self::$w; $h=$w; $im=new svg($w,$h);
[$white,$black]=self::$clr;
svg::rect(0,0,$w,$h,$black);
self::map($r,$sq);
self::dots($r,$p);
//self::legend($r);
return svg::draw();}

//local projection
static function positions($r){$w=self::$w; $h=$w;
[$ray,$wd,$hd,$ra0,$ra1,$dc0,$dc1,$wm,$hm,$right,$left,$top,$bottom,$wr,$hr]=self::$dims;
if($r)foreach($r as $k=>$v){
$x=($left-$v['ra'])*60*$wr;
$y=$h-(abs($bottom-$v['dc'])*$hr);
$r[$k]['x']=$x; $r[$k]['y']=$y;} //pr($r);
return $r;}

static function prep($r,$ra){new maths(20); $w=self::$w; $h=$w;
[$ray,$wd,$hd,$ra0,$ra1,$dc0,$dc1,$wm,$hm,$right,$left,$top,$bottom,$wr,$hr]=self::$dims;
$rc=array_flip(array_keys_r($ra,8)); //pr($rc);
$cols=['hd','hip','rarad','decrad','dist','spect','mag','lum','ra','dc'];//
if($r)foreach($r as $k=>$v){
$rb[$k]=array_combine($cols,$v);
$x=($left-$v[8])*60*$wr;
$y=$h-(abs($bottom-$v[9])*$hr);
$rb[$k]['x']=$x; $rb[$k]['y']=$y;
//if($ra)$rb[$k]['star']=$rb[$v[1]];
if($ra){$rk=$rc[$v[1]]??''; if($rk)$rd=$ra[$rk]; else $rd=[];
	if($rd)$rb[$k]+=['star'=>$rd[0],'status'=>$rd[5],'planet'=>$rd[6]];}
if($rb[$k]['hip']==999999){$rb[$k]['hip']='Oomo';}
if($rb[$k]['hip']=='0'){$rb[$k]['status']='galaxy'; $rb[$k]['star']='Galactic Center';}} //pr($rb);
return $rb;}

static function dims($sq){$d=$sq['radius'];
$w=self::$w; $h=$w; $wi=$w/2; $hi=$h/2; $wr=$w/24; $hr=$h/180;
$ra0=substr($sq['ra'][0],1); $ra1=substr($sq['ra'][1],1); 
$dc0=substr($sq['dc'][0],1); $dc1=substr($sq['dc'][1],1);
$wd=($ra1-$ra0)/360*(24*60); $hd=$dc1-$dc0;//diff in deg
$wr=$w/$wd; $hr=$h/$hd;//ratios for 1 min/deg
$wm=$ra1-($ra1-$ra0)/2; $hm=$dc1-($dc1-$dc0)/2;//middles in deg
$right=($wm-$d)/15; $left=($wm+$d)/15; $top=($dc1); $bottom=($dc0);//limits in hours/deg
$r=[$d,$wd,$hd,$ra0,$ra1,$dc0,$dc1,$wm,$hm,$right,$left,$top,$bottom,$wr,$hr]; //pr($r);
//[$ray,$wd,$hd,$ra0,$ra1,$dc0,$dc1,$wm,$hm,$right,$left,$top,$bottom,$wr,$hr]=self::$dims;
self::$dims=$r;}

static function build($p,$o){$ra=[];
$ra=msql::read('','ummo_exo_5','',1);
//if(!$p)$p=self::$default;
//$r=star::build($p,1);
if(strpos($p,'radius')===false)$p.=',radius=1h';
if(strpos($p,'dist')===false)$p.=',dist<300';
$sq=star::sq($p); //pr($sq);
self::dims($sq);
$r=star::build($sq,1); //pr($r);
$rb=starlib::prep($r,$ra,$p); //pr($rb);
$rb=self::positions($rb);
$ret=self::draw($rb,$sq,$p);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if(!$p)$p=self::$default;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_starvue,call_inp_2';
$ret=inputj('inp',$p?$p:self::$default,$j).' ';
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lk('/app/starmap4',picto('url'));
return $ret;}

static function home($p,$o){
$rid=('strv');
$bt=self::menu($p,$o,$rid);
if(!$p)$p=self::$default;
$ret=self::build($p,$o);
$bt.=msqbt('',nod('exo_4'));
return $bt.divd($rid,$ret);}
}
?>