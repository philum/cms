<?php
//philum_app_spiline

class spiline{

/*static function css(){$ret='';
for($i=1;$i<118;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}*/

static function clr(){return array(''=>'ccc','Nonmetals'=>"92FF10",'Nobles Gasses'=>"05FFFF",'Alkali Metals'=>"FF9801",'Alkali Earth Metals'=>"BF6700",'Metalloids'=>"91C9D6",'Halogens'=>"FFFF00",'Metals'=>"ABABB0",'Transactinides'=>"C9C97A",'Lanthanides'=>"B3D7AB",'Actinides'=>"75ADAB",'undefined'=>"ffffff");}

static function legend(){$i=0; $ret='';
$r=self::clr(); $w=100; $h=20; $y=20; $x=60;
$sz=array(1=>70,2=>100,3=>80,4=>110,5=>70,6=>70,7=>50,8=>90,9=>80,10=>60,11=>70);
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
$rd=array('k'=>2,'l'=>5,'m'=>9,'n'=>14,'o'=>19,'p'=>23,'q'=>26);
$rh=array('k'=>1,'l'=>2,'m'=>3,'n'=>4,'o'=>4,'p'=>3,'q'=>2);
foreach($rd as $k=>$v){$h=$rh[$k]*$u;
	$ret.='[,black,1:attr][40,'.$y.',40,'.($y+$h).':line]';
	$ret.='[black,,:attr][20,'.($y+($h/2)).',12px§'.$k.':text]';
	$y+=$h+$u;
}
return $ret;}

static function findclr($d){$r=self::clr();
return $r[$d]?$r[$d]:'ffffff';}

//positions
static function pos($ring,$sub,$pos,$i,$v,$mode){
$u=20;//unit
$zerox=0; $zeroy=2;
//position on rings
$ry[1]=array(1=>0,0);
$ry[2]=array(1=>1,1,2,2,2,2);
$ry[3]=array(1=>3,3,4,4,4,4,5,5,5,5);
$ry[4]=array(1=>6,6,7,7,7,7,8,8,8,8,9,9,9,9);
//ring_height
$rd=array(1=>0,2=>2,3=>5,4=>9,5=>14,6=>19,7=>23,8=>26);
//x,y,w,h
$x=($pos*3+$zerox)*$u;
if($ring==1 && $sub==1 && $pos==2)$x=(($pos+4)*3+$zerox)*$u;
$y=($rd[$ring]+($sub)+$zeroy)*$u;
//if($i==11)echo $i.'-'.$rd[$ring].'-'.$ry[$sub][$pos].br();
$w=$u*3;$h=$u;
$t1='[spl_app__2_spiline_call_'.$i.'§['.($x+4).','.($y+15).',12§'.$i.':text]:lj]';
$t2='[popup_plup___spitable_spi*infos_'.$i.'§['.($x+$w/2+2).','.($y+15).',12§'.$v.':text]:lj]';
$ret=$t1.$t2;
//echo $x.'-'.$y.'-'.$w.'-'.$h.br();
return array($x,$y,$w,$h,$ret);}

static function findpos2($i){
$r=array(2,6,10,14); $n=$i-118;
foreach($r as $k=>$v)if($n-$v<0){$ring=8; $sub=$k; $pos=$n-$v;}
return array($ring,$sub,$pos);}

static function findpos($level,$i){
if($i>118)return self::findpos2($i);
$ring=substr($level,0,1);
$subring=substr($level,1,1);
if($subring=='s')$sub=1; elseif($subring=='p')$sub=2; elseif($subring=='d')$sub=3; elseif($subring=='f')$sub=4;
$pos=substr($level,2);
return array($ring,$sub,$pos);}

static function findpos_layer($level,$i){
$rg=array(1=>2,8,18,32,32,18,8,2);
$r=explode('-',$level); $n=count($r);
$mx=$rg[$n]; $sub=$mx-$r[$n-1];
echo $i.';'.$level.';n:'.$n,';ring:'.$ring.';sub:'.$sub.br();
return array($ring,$sub,$pos);}

//atom
static function atom($r,$i,$mode,$hide=''){
list($name,$sym,$fam,$layer,$level)=$r[$i]; //
//echo $name.'-'.$sym.'-'.$fam.'-'.$level.br();
list($ring,$subring,$pos)=self::findpos($level,$i);
//list($ring,$subring,$pos)=self::findpos_layer($layer,$i);
//echo $ring.'-'.$subring.'-'.$pos.br();
list($x,$y,$w,$h,$t)=self::pos($ring,$subring,$pos,$i,$sym,$mode);
$clr=self::findclr($fam);
$atr='[#'.$clr.',black,1:attr]';
if($hide)$atr='[#'.$clr.',gray,,,0.2:attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.':rect]';
return $atr.$rect.$t;}

//build
static function build($p,$o){//$o=0;
$r=msql::read('','public_atomic','',1);
$bt=self::nav($p,$o,'spl');
//mode linear
if($o){$mode='linear'; $sz='1900/400';} else{$mode=0; $sz='1000/600';}
//$ret='[rand,black,1:attr]';
//$txt1='[popup_plup___svg§[20,20§hello:text]:lj]';
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

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_app__2_spiline_call___inp',picto('ok')).' ';
return $ret;}

static function nav($p,$o,$rid){
$ret=self::menu($p,$o,$rid);
if($p>0)$ret.=lj('',$rid.'_app__2_spiline_call_'.($p-1).'_'.$o,picto('previous')).' ';
if($p<118)$ret.=lj('',$rid.'_app__2_spiline_call_'.($p+1).'_'.$o,picto('next')).' ';
$ret.=msqbt('','public_atomic');
$ret.=hlpbt('spitable');
$ret.=lk('/plug/spt',picto('filelist'));
return $ret;}

}

function plug_spiline($p,$o){
$rid='spl'; $p=$p?$p:118; reqp('spt');
Head::add('csscode',spt::css());
$ret=spiline::build($p,$o);
return divd($rid,$ret);}

?>