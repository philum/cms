<?php //spielec
class spielec{
static function css(){$ret='';
for($i=1;$i<118;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

static function mol($d){
$r=msql::read('','public_atomic','',1);
[$ring,$subring,$pos]=self::findpos($r[$d][4],$d);
$rg=[1=>2,2=>6,3=>10,4=>14];
$freesocks=$rg[$subring]-$pos;
return $ret;}

static function clr(){return [''=>'ccc','Nonmetals'=>"5FA92E",'Nobles Gasses'=>"00D0F9",'Alkali Metals'=>"FF0008",'Alkali Earth Metals'=>"FF00FF",'Metalloids'=>"1672B1",'Halogens'=>"F6E617",'Metals'=>"999999",'Transactinides'=>"FF9900",'Lanthanides'=>"666698",'Actinides'=>"9D6568",'undefined'=>"ffffff"];}

static function findclr($d){$r=self::clr();
return $r[$d]?$r[$d]:'ffffff';}

static function pos($ring,$sub,$pos,$i,$v,$mode){
$u=20;//unit
$zerox=22; $zeroy=1;
//position on rings
$ry[1]=[1=>0,0];
$ry[2]=[1=>1,1,2,2,2,2];
$ry[3]=[1=>3,3,4,4,4,4,5,5,5,5];
$ry[4]=[1=>6,6,7,7,7,7,8,8,8,8,9,9,9,9];
$rx=[1=>-1,0,-2,1,-3,2,-4,3,-5,4,-6,5,-7,6,-8,7];
//$rx=[1=>-2,0,-4,2,-6,4,-8,6,-10,8,-12,10,-14,12,-16,14];
/*$rx[1]=[1=>-1,0];//centerded
$rx[2]=[1=>-3,-2,-1,0,1,2,3];
$rx[3]=[1=>-5,-4,-3,-2,-1,0,1,2,3,4,5];
$rx[4]=[1=>-7,-6,-5,-4,-3,-2,-1,0,1,2,3,4,5,6,7];*/
//ring_height
$rd=[1=>0,2=>2,3=>5,4=>9,5=>14,6=>19,7=>23,8=>26];
//x,y,w,h
$x=($rx[$pos]*3+$zerox)*$u;
$y=($rd[$ring]+($sub)+$zeroy)*$u;
//if($i==11)echo $i.'-'.$rd[$ring].'-'.$ry[$sub][$pos].br();
$w=$u*3;$h=$u;
$t1='[spe_spielec;call___'.$i.'§['.($x+6).','.($y+15).'§'.$i.':text]:lj]';
$t2='[popup_spitable;infos___'.$i.'§['.($x+$w/2).','.($y+15).'§'.$v.':text]:lj]';
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

static function atom($r,$i,$mode,$hide=''){
[$name,$sym,$fam,$layer,$level]=$r[$i]; //echo $name.'-'.$sym.'-'.$fam.'-'.$level.br();
[$ring,$subring,$pos]=self::findpos($level,$i); //echo $ring.'-'.$subring.'-'.$pos.br();
[$x,$y,$w,$h,$t]=self::pos($ring,$subring,$pos,$i,$sym,$mode);
$clr=self::findclr($fam);
$atr='[#'.$clr.',black,1:attr]';
if($hide)$atr='[#'.$clr.',gray,,,0.1:attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.':rect]';
return $atr.$rect.$t;}

//build
static function build($p,$o){//$o=0;
$r=msql::read('','public_atomic','',1);
$bt=self::nav($p,$o,'spe');
//mode linear
if($o){$mode='linear'; $sz='1900/400';} else{$mode=0; $sz='900/600';}
//$ret='[rand,black,1:attr]';
//$txt1='[popup_svg;call§[20,20§hello:text]:lj]';
$max=118;
$limit=$p?$p:$max;
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

static function nav($p,$o,$rid){
$ret=self::menu($p,$o,$rid);
if($p>0)$ret.=lj('',$rid.'_spielec,call___'.($p-1).'_'.$o,picto('previous')).' ';
if($p<118)$ret.=lj('',$rid.'_spielec,call___'.($p+1).'_'.$o,picto('next')).' ';
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_spielec,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='spe'; $p=$p?$p:118; //$o=1;
Head::add('csscode',self::css());
//$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('public_atomic'));
return div(atd($rid).atc('panel small'),$ret);}
}
?>