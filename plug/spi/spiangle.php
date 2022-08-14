<?php //spiangle
class spiangle{
static function css(){$ret='';
for($i=1;$i<118;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

static function clr(){return [''=>'ccc','Nonmetals'=>"92FF10",'Nobles Gasses'=>"05FFFF",'Alkali Metals'=>"FF9801",'Alkali Earth Metals'=>"BF6700",'Metalloids'=>"91C9D6",'Halogens'=>"FFFF00",'Metals'=>"ABABB0",'Transactinides'=>"C9C97A",'Lanthanides'=>"B3D7AB",'Actinides'=>"75ADAB",'undefined'=>"ffffff"];}

static function legend(){$i=0; $ret='';
$r=self::clr(); $w=100; $h=20; $y=20; $x=60;
$sz=[1=>70,2=>100,3=>80,4=>110,5=>70,6=>70,7=>50,8=>90,9=>80,10=>60,11=>70];
foreach($r as $k=>$v)if($k){$i++; 
	$w=strlen($k)*8;
	$w=$sz[$i];
	$ret.='[#'.$v.',gray:attr]';
	$ret.='['.$x.','.$y.','.$w.','.$h.':rect]';
	$ret.='['.($x+4).','.($y+15).',12px§'.$k.':text]';
	$x+=$w;}
	$ret.='[50,590,12px§@Davy2016:text]';
return $ret;}

static function layers(){
$u=20; $zeroy=3; $ret=''; $y=$zeroy*$u;
$rd=['k'=>2,'l'=>5,'m'=>9,'n'=>14,'o'=>19,'p'=>23,'q'=>26];
$rh=['k'=>1,'l'=>2,'m'=>3,'n'=>4,'o'=>4,'p'=>3,'q'=>2];
foreach($rd as $k=>$v){$h=$rh[$k]*$u;
	$ret.='[,black,1:attr][40,'.$y.',40,'.($y+$h).':line]';
	$ret.='[black,,:attr][20,'.($y+($h/2)).',12px§'.$k.':text]';
	$y+=$h+$u;}
return $ret;}

static function findclr($d){$r=self::clr();
return $r[$d]?$r[$d]:'ffffff';}

//positions
static function pos($ring,$sub,$pos,$n,$v,$mode){
$u=20;//unit
$zerox=3; $zeroy=2;
//position on rings
$ry[1]=[1=>0,0];
$ry[2]=[1=>1,1,2,2,2,2];
$ry[3]=[1=>3,3,4,4,4,4,5,5,5,5];
$ry[4]=[1=>6,6,7,7,7,7,8,8,8,8,9,9,9,9];
//x
$rx[1]=[0=>0,14];
$ni=14/5; for($i=0;$i<6;$i++)$rx[2][$i]=$i*$ni;
$ni=14/9; for($i=0;$i<10;$i++)$rx[3][$i]=$i*$ni;
$ni=14/13; for($i=0;$i<14;$i++)$rx[4][$i]=$i*$ni;
//ring_height
$rd=[1=>0,2=>2,3=>5,4=>9,5=>14,6=>19,7=>23,8=>26];
//ring angle
$rg=[1=>90,2=>15,3=>10,4=>6,42857,5=>5];
$angle=$rg[$sub]*($pos-1);
//x,y,w,h
//$x=($pos*3+$zerox)*$u;
$x=($rx[$sub][$pos-1]*3+$zerox)*$u;
$y=($rd[$ring]+($sub)+$zeroy)*$u;
//if($n==11)echo $n.'-'.$rd[$ring].'-'.$ry[$sub][$pos].br();
$w=$u*3;$h=$u;
$t1='[spg_spiangle;call___'.$n.'§['.($x+4).','.($y+14).',12px§'.$n.':text]:lj]';
$t2='[popup_spitable;infos___'.$n.'§['.($x+$w/2+2).','.($y+14).',12§'.$v.':text]:lj]';
$ret=$t1.$t2;
//echo $x.'-'.$y.'-'.$w.'-'.$h.br();
return [$x,$y,$w,$h,$ret];}

static function findpos2($i){
$r=[2,6,10,14]; $n=$i-118;
foreach($r as $k=>$v)if($n-$v<0){$ring=8; $sub=$k; $pos=$n-$v;}
return [$ring,$sub,$pos];}

static function findpos($level,$i){
if($i>118)return self::findpos2($i);
$ring=substr($level,0,1);
$subring=substr($level,1,1);
if($subring=='s')$sub=1; elseif($subring=='p')$sub=2; elseif($subring=='d')$sub=3; elseif($subring=='f')$sub=4;
$pos=substr($level,2);
return [$ring,$sub,$pos];}

static function findpos_layer($level,$i){
$rg=[1=>2,8,18,32,32,18,8,2];
$r=explode('-',$level); $n=count($r);
$ring=$rg[$n]; $sub=$ring-$r[$n-1];
echo $i.';'.$level.';n:'.$n,';ring:'.$ring.';sub:'.$sub.br();
return [$ring,$sub,$n];}

//atom
static function atom($r,$i,$mode,$hide=''){
[$name,$sym,$fam,$layer,$level]=$r[$i]; //
//echo $name.'-'.$sym.'-'.$fam.'-'.$level.br();
[$ring,$subring,$pos]=self::findpos($level,$i);
//[$ring,$subring,$pos]=self::findpos_layer($layer,$i);
//echo $ring.'-'.$subring.'-'.$pos.br();
[$x,$y,$w,$h,$t]=self::pos($ring,$subring,$pos,$i,$sym,$mode);
$clr=self::findclr($fam);
$atr='[#'.$clr.',black,1:attr]';
if($hide)$atr='[#'.$clr.',gray,,,0.2:attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.':rect]';
return $atr.$rect.$t;}

//build
static function build($p,$o){//$o=0;
$r=msql::read('','public_atomic','',1);
$bt=self::nav($p,$o,'spg');
//mode linear
if($o){$mode='linear'; $sz='1900/400';} else{$mode=0; $sz='1000/600';}
//$ret='[rand,black,1:attr]';
//$txt1='[popup_svg;call§[20,20§hello:text]:lj]';
$max=118;
$limit=$p?$p:$max;
$rb[0]=self::legend();
$rb[1]=self::layers();
for($i=1;$i<=$limit;$i++)$rb[]=self::atom($r,$i,$mode);
if($limit<$max)for($i=$limit+1;$i<=$max;$i++)$rb[]=self::atom($r,$i,$mode,1);
//render
$ret=implode("\n",$rb);//echo 
if($ret)$ret=svg::home($ret,$sz);
return $bt.$ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_spiangle,call_inp',picto('ok')).' ';
return $ret;}

static function nav($p,$o,$rid){
$ret=self::menu($p,$o,$rid);
if($p>0)$ret.=lj('',$rid.'_spiangle,call___'.($p-1).'_'.$o,picto('previous')).' ';
if($p<118)$ret.=lj('',$rid.'_spiangle,call___'.($p+1).'_'.$o,picto('next')).' ';
$ret.=msqbt('','public_atomic');
$ret.=hlpbt('spitable');
$ret.=lk('/app/spt',picto('filelist'));
return $ret;}

static function home($p,$o){$rid='spg'; $p=$p?$p:118; //$o=1;
Head::add('csscode',self::css());
//$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return divd($rid,$ret);}
}
?>