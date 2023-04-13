<?php //spiline

class spiline{
static $max=118;
static $ratio=1;
static $mode=1;

function __construct($n,$m=1){self::$max=$n; self::$mode=$m;}

static function css(){$ret='';
for($i=1;$i<self::$max;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

static function js($j,$n=1,$o){return 'var n='.$n.';
addEvent(document,"DOMMouseScroll",function(){wheelcount(event,"'.$j.'","'.$o.'")});';}

static $clr0=[''=>'ccc','Nonmetals'=>'92FF10','Nobles Gasses'=>'05FFFF','Alkali Metals'=>'FF9801','Alkali Earth Metals'=>'BF6700','Metalloids'=>'91C9D6','Halogens'=>'FFFF00','Metals'=>'ABABB0','Transactinides'=>'C9C97A','Lanthanides'=>'B3D7AB','Actinides'=>'75ADAB','undefined'=>'ffffff'];

static $clr1=[''=>'ccc','Nonmetals'=>'e8592d','Nobles Gasses'=>'fbbf09','Alkali Metals'=>'c1cf00','Alkali Earth Metals'=>'95a112','Metalloids'=>'6b7612','Halogens'=>'52c2e9','Metals'=>'adaeac','Transactinides'=>'3d80be','Lanthanides'=>'4e68ab','Actinides'=>'a377ae','undefined'=>'ffffff'];

static $clr=[''=>'ccc','Nonmetals'=>'5FA92E','Nobles Gasses'=>'00D0F9','Alkali Metals'=>'FF0008','Alkali Earth Metals'=>'FF00FF','Metalloids'=>'1672B1','Halogens'=>'F6E617','Metals'=>'999999','Transactinides'=>'FF9900','Lanthanides'=>'666698','Actinides'=>'9D6568','undefined'=>'ffffff'];

static function legend(){$i=0; $ret='';
$r=self::$clr; $w=100; $h=20; $y=20; $x=60; $n=count($r); $nc=16500000/$n;
$sz=[1=>70,2=>100,3=>80,4=>110,5=>70,6=>70,7=>50,8=>90,9=>80,10=>60,11=>70];
foreach($r as $k=>$v)if($k){$i++; 
	$w=strlen($k)*8;
	$w=$sz[$i];
	$ret.='[#'.$v.',gray:attr]';
	$ret.='['.$x.','.$y.','.$w.','.$h.':rect]';
	$ret.='['.($x+4).','.($y+15).',12px§'.$k.':text]';
	$x+=$w;}
	$ret.='[50,1200,12px§@Davy2019:text]';
return $ret;}

static function layers(){
$u=20; $zeroy=3; $ret=''; $y=$zeroy*$u*self::$ratio;
$rd=['k'=>2,'l'=>5,'m'=>9,'n'=>14,'o'=>19,'p'=>23,'q'=>26];
$rh=['k'=>1,'l'=>2,'m'=>3,'n'=>4,'o'=>4,'p'=>3,'q'=>2];
foreach($rd as $k=>$v){$h=$rh[$k]*$u*self::$ratio;
	$ret.='[,black,1:attr][40,'.$y.',40,'.($y+$h).':line]';
	$ret.='[black,,:attr][20,'.($y+($h/2)).',12px§'.$k.':text]';
	$y+=$h+$u*self::$ratio;}
return $ret;}

static function findclr($d){$r=self::$clr;
return $r[$d]?$r[$d]:'ffffff';}

//positions
static function atompos($ring,$sub,$pos,$n,$v,$mode){
$u=20;//unit
$zerox=0; $zeroy=2; $ratio=self::$ratio;
//position on rings
$ry[1]=[1=>0,0];
$ry[2]=[1=>1,1,2,2,2,2];
$ry[3]=[1=>3,3,4,4,4,4,5,5,5,5];
$ry[4]=[1=>6,6,7,7,7,7,8,8,8,8,9,9,9,9];
$ry[5]=[1=>10,10,11,11,11,11,12,12,12,12,13,13,13,13,14,14,14,14];
$ry[6]=[1=>15,15,16,16,16,16,17,17,17,17,18,18,18,18,19,19,19,19,20,20,20,20];
$ry[7]=[1=>21,21,22,22,22,22,23,23,23,23,24,24,24,24,25,25,25,25,26,26,26,26,27,27,27,27];
//ring_height
$rd=[1=>0,2=>2,3=>5,4=>9,5=>14,6=>19,7=>23,8=>26,9=>29];
//angular pos
$rx[1]=[0=>0,14];
$ni=14/5; for($i=0;$i<6;$i++)$rx[2][$i]=$i*$ni;
$ni=14/9; for($i=0;$i<10;$i++)$rx[3][$i]=$i*$ni;
$ni=14/13; for($i=0;$i<14;$i++)$rx[4][$i]=$i*$ni;
//x,y,w,h
$valence=(count($ry[$sub])-$pos);
if(self::$mode==4)$x=((14-$valence)*3+$zerox)*$u;//inverted on right
elseif(self::$mode==2)$x=60+($valence*3+$zerox)*$u;//inverted on left
elseif(self::$mode==3)$x=((15-$pos)*3+$zerox)*$u;//on right
elseif(self::$mode==1)$x=($pos*3+$zerox)*$u;//on left
elseif(self::$mode==5)$x=(3+$rx[$sub][$pos-1]*3+$zerox)*$u;//angular
//if($ring==1 && $sub==1 && $pos==2)$x=(($pos+4)*3+$zerox)*$u;
$y=($rd[$ring]+($sub)+$zeroy)*$u*self::$ratio;
//if($n==11)echo $n.'-'.$rd[$ring].'-'.$ry[$sub][$pos].br();
$w=$u*3; $h=$u*self::$ratio;
$ret='[spl_spiline;call___'.$n.'_'.$mode.'§['.($x+4).','.($y+15).',12§'.$n.':text]:lj]';
if($ratio==2)$ret.='['.($x+4).','.($y+35).',12§'.$valence.':text]';
$ret.='[popup_spitable;infos___'.$n.'§['.($x+$w/($ratio==2?2:2)).','.($y+(15*$ratio)).','.(12*$ratio).'§'.$v.':text]:lj]';
//echo $x.'-'.$y.'-'.$w.'-'.$h.br();
return [$x,$y,$w,$h,$ret];}

//pos from coordinates
static function findpos2($i){
$r=[2,6,10,14]; $n=$i-self::$max;
foreach($r as $k=>$v)if($n-$v<0){$ring=8; $sub=$k; $pos=$n-$v;}
return [$ring,$sub,$pos];}

static function findpos($level,$i){
if($i>self::$max)return self::findpos2($i);
$ring=substr($level,0,1);
$subring=substr($level,1,1);
if($subring=='s')$sub=1; elseif($subring=='p')$sub=2; elseif($subring=='d')$sub=3; elseif($subring=='f')$sub=4; else $sub=5;
$pos=substr($level,2);
return [$ring,$sub,$pos];}

/*static function findpos_layer($level,$i){
$rg=[1=>2,8,18,32,32,18,8,2];
$r=explode('-',$level); $n=count($r);
$mx=$rg[$n]; $sub=$mx-$r[$n-1];
echo $i.';'.$level.';n:'.$n,';ring:'.$ring.';sub:'.$sub.br();
return [$ring,$sub,$pos];}*/

static function build_level($i){//7p6
$ra=['s','p','d','f','g',''];}

static function act($r,$ring){static $rx;
[$name,$sym,$fam,$layer,$level]=$r;
$ra=explode('-','-'.$layer);
$max=val($ra,$ring); $rx[$ring][]=1;//count elemenrs in rings
return count($rx[$ring])<=$max?0:1;}

//atom
static function atom($r,$i,$mode,$p){
[$name,$sym,$fam,$layer,$level]=val($r,$i,['','','','','']);
[$ring,$subring,$pos]=self::findpos($level,$i);
//[$ring,$subring,$pos]=self::findpos_layer($layer,$i);
[$x,$y,$w,$h,$t]=self::atompos($ring,$subring,$pos,$i,$sym,$mode);
$clr=self::findclr($fam);
$hide=self::act(val($r,$p),$ring);//anomalies
$bdr=$p==$i?'red':($hide?'gray':'black'); $sz=$p==$i?'2':'1'; $alpha=$hide?'0.1':'1';
$atr='[#'.$clr.','.$bdr.','.$sz.',,'.$alpha.':attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.':rect]';
return $atr.$rect.$t;}

//build
static function build($p,$o){//$o=0;
$r=msql::read('','public_atomic','',1);
if(!$o)$o=self::$mode;
$w=1000; $h=600*self::$ratio; $sz=$w.'/'.$h;
$bt=self::nav($p,$o,'spl');
$rb[0]=self::legend();
$rb[1]=self::layers();
for($i=1;$i<=self::$max;$i++)$rb[]=self::atom($r,$i,$o,$p);
$ret=implode("\n",$rb);
if($ret)$ret=svg::home($ret,$sz);//render
return $bt.$ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
if($o)self::$mode=$o;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$j=$rid.'_spiline,call_inpln_2__'.$o; $pr=['onchange'=>sj($j)];
$ret=inputj('inpln',$p,$j,'',4,$pr,'number').lj('',$j,picto('ok')).' ';
return $ret;}

static function nav($p,$o,$rid){$ret=''; $bt='';
$js1=atmp(atjr('jumpvalue',['inpln',$p-1]));
$js2=atmp(atjr('jumpvalue',['inpln',$p+1]));
if($p>0)$ret.=lj('',$rid.'_spiline,call__2_'.($p-1).'_'.$o,picto('before'),$js1).' ';
else $ret.=btn('grey',picto('before'));
if($p<self::$max)$ret.=lj('',$rid.'_spiline,call__2_'.($p+1).'_'.$o,picto('after'),$js2).' ';
else $ret.=btn('grey',picto('after'));
$ra=[1=>'left','valences/left','right','valences/right'];//,'angular'
foreach($ra as $k=>$v)$bt.=lj(active($k,$o),$rid.'_spiline,call__2_'.$p.'_'.$k,$v);
$ret.=btn('nbp',$bt);
$ret.=msqbt('','public_atomic');
$ret.=hlpbt('spitable');
$ret.=lk('/app/spt',picto('organigram'));
return $ret;}

static function home($p,$o){
new spiline(118);
$rid='spl'; $p=$p?$p:self::$max;
Head::add('csscode',self::css());
//Head::add('jscode',spiline::js($rid.'_spiline,call__2_',$p,$o));
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>