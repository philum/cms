<?php
class spiatom{

static $clr=['ccc','Nonmetals'=>'5FA92E','Nobles Gasses'=>'00D0F9','Alkali Metals'=>'FF0008','Alkali Earth Metals'=>'FF00FF','Metalloids'=>'1672B1','Halogens'=>'F6E617','Metals'=>'999999','Transactinides'=>'FF9900','Lanthanides'=>'666698','Actinides'=>'9D6568','undefined'=>'ffffff'];

static function js($j,$n=1,$o){return 'var n='.$n.';
addEvent(document,"DOMMouseScroll",function(){wheelcount(event,"'.$j.'","'.$o.'")});';}

static function css(){$ret='';
for($i=1;$i<118;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

static function findclr($d){$r=self::$clr;
return $r[$d]?$r[$d]:'ffffff';}

static function pos($ring,$sub,$pos,$i,$v,$mode){
$zerox=1; $zeroy=4; $u=10;//unit
//position on rings
$rx[1]=[1=>-1,0];
$ry[1]=[1=>0,0];
$rx[2]=[1=>0,-2,-2,-2,0,1];
$ry[2]=[1=>-1,-1,0,2,2,0];
$rx[3]=[1=>2,2=>0,3=>-2,4=>-3,5=>-3,6=>-3,7=>-2,8=>0,9=>2,10=>2];
$ry[3]=[1=>-2,2=>-2,3=>-2,4=>-2,5=>0,6=>2,7=>3,8=>3,9=>2,10=>0];
$rx[4]=[1=>3,2=>2,3=>0,4=>-2,5=>-4,6=>-4,7=>-4,8=>-4,9=>-4,10=>-2,11=>0,12=>2,13=>3,14=>3];
$ry[4]=[1=>-2,2=>-3,3=>-3,4=>-3,5=>-3,6=>-2,7=>0,8=>2,9=>4,10=>4,11=>4,12=>4,13=>2,14=>0];
//ring_distance//if linear
$rd=[1=>1,2=>5,3=>11,4=>19,5=>28,6=>36,7=>42,8=>48];
//ring distant//vertical
$rdx=[1=>1,2=>5,3=>11,4=>19,5=>4,6=>12,7=>18,8=>22];
$rdy=[1=>0,2=>0,3=>0,4=>0,5=>8,6=>8,7=>8,8=>8];
//atom angle
$rg[1]=str_split('011');
$rg[2]=str_split('0001001');
$rg[3]=str_split('01001110011');
$rg[4]=str_split('010000111000011');
//mode
if($mode==='linear'){$addx=($rd[$ring]*$u); $addy=0;}
else{$addx=($rdx[$ring]*$u); $addy=($rdy[$ring]*$u);}
//x,y,w,h
$x=($rx[$sub][$pos]+$zerox)*$u+$addx;
$y=($ry[$sub][$pos]+$zeroy)*$u+$addy;
//t, vertical-horizontal
if($rg[$sub][$pos]){$w=$u;$h=$u*2;
$t1='[spt_spiatom,call___'.$i.'§['.($x+10).','.($y+22).'§'.$i.':text]:lj]';
$t2='[popup_spitable;infos___'.$i.'§['.($x+10).','.($y+$h-16).'§'.$v.':text]:lj]';}
else{$w=$u*2;$h=$u;
$t1='[spt_spiatom;call___'.$i.'§['.($x+10).','.($y+22).'§'.$i.':text]:lj]';
$t2='[popup_spitable;infos___'.$i.'§['.($x+$w/2+6).','.($y+24).'§'.$v.':text]:lj]';}
//$ret='[popup_svg;call§[20,20§'.$t2.':text]:lj]';
$ret='';//$t1.$t2;
//echo $x.'-'.$y.'-'.$w.'-'.$h.br();
return [$x,$y,$w,$h,$ret];}

static function findpos2($i){
$r=[2,6,10,14]; $n=$i-118;
foreach($r as $k=>$v)if($n-$v<0){$ring=8; $sub=$k; $pos=$n-$v;}
return [$ring,$sub,$pos];}

static function findpos($level,$i){
if($i>118)return self::findpos2($i);
$ring=substr($level,0,1); $sub=0;
$subring=substr($level,1,1);
if($subring=='s')$sub=1;
elseif($subring=='p')$sub=2;
elseif($subring=='d')$sub=3;
elseif($subring=='f')$sub=4;
$pos=substr($level,2);
return [$ring,$sub,$pos];}

static function act($r,$ring){static $rx;
[$name,$sym,$fam,$layer,$level]=$r;
$ra=explode('-','-'.$layer);
$max=val($ra,$ring); $rx[$ring][]=1;//count elemenrs in rings
return count($rx[$ring])<=$max?0:1;}

static function atom($r,$i,$mode,$p){if(!isset($r[$i]))return;
[$name,$sym,$fam,$layer,$level]=arr($r[$i],5); //echo $name.'-'.$sym.'-'.$fam.'-'.$level.br();
[$ring,$subring,$pos]=self::findpos($level,$i); //echo $ring.'-'.$subring.'-'.$pos.br();
[$x,$y,$w,$h,$t]=self::pos($ring,$subring,$pos,$i,$sym,$mode);
//$clr=self::findclr($fam);
$clr=msql::val('','public_atomic_3',$i,4);
//$hide=$i<=$p?0:1;
$hide=self::act(val($r,$p),$ring);//anomalies
$bdr=$p==$i?'red':($hide?'gray':'black'); $sz=$p==$i?'2':'1'; $alpha=$hide?'0.1':'1';
$atr='[#'.$clr.','.$bdr.','.$sz.',,'.$alpha.':attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.':rect]';
return $atr.$rect;}//.$t

//build
static function spisearch($r,$p){
foreach($r as $k=>$v)if($v[0]==$p or $v[1]==$p)return $k;}

static function build($r,$p,$o=1){$u=10;//unit
if($o){$mode='linear'; $w=48*$u; $h=10*$u;}//mode linear
else{$mode=0; $w=25*$u; $h=18*$u;}//w/h
//connectivity
$ra=[1=>2,2=>6,3=>10,4=>14,5=>18];
$rb=self::findpos($r[$p][4],$p);//free emplacaments
[$ring,$sub,$pos]=$rb; $lmax=$ra[$sub]; $free=$lmax-$pos;//free electrons
$max=118;
//$max=$p+$free+$ra[$sub+1];//highlight last subring
//$limit=$p&&$p<=$max?$p:$max;
for($i=1;$i<=$max;$i++)$rb[]=self::atom($r,$i,$mode,$p);
$h+=24;
$ret='[white,gray:attr][0,0,'.$w.','.$h.':rect]';
$t=$p.' - '.$r[$p][0].' ('.$r[$p][1].') : '.$pos.' electron(s) - '.$free.' free socket(s)';
$ret.='[black,gray:attr][popup_spitable;infos___'.$i.'§[10,'.($h-14).'§'.$t.':text]:lj]';
$ret.=implode("\n",$rb);
if($ret)$ret=svg::home($ret,$w.'/'.$h);
return $ret;}//$bt.

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o); if($p>118)$p=118;
$bt=self::nav($p,$o,'spt'); //self::frees();
$r=msql::read('','public_atomic','',1);
if(!is_numeric($p))$p=self::spisearch($r,$p);
return $bt.self::build($r,$p,$o);}

//build public_atomic_3
static function frees(){
$ra=[1=>2,2=>6,3=>10,4=>14,5=>18]; //
$r=msql::read('','public_atomic','',1);
for($i=1;$i<=118;$i++){$rb=self::findpos($r[$i][4],$i);//free emplacaments
	[$ring,$sub,$pos]=$rb; $lmax=$ra[$sub]; $free=$lmax-$pos;
	//$deg=floor(($pos/$lmax)*360);
	$quad=$sub*90; $deg=floor(($pos/$lmax)*90)+$quad-90;
	$satur=round(100/$sub); $lum=floor(($pos/$lmax)*50); $lum=50;
	$clr=hsl2rgb($deg-1,$satur,$lum);
	//$clr=self::findclr($r[$i][2]);
	//echo bts('background-color:#'.$clr,$i.':'.$lum).' ';
	$rc[$i]=[$r[$i][1],$pos,$free,round($pos/$lmax,2),$clr];}//free electrons
msql::save('','public_atomic_3',$rc,['sym','pos','free','deg','clr']);}

static function menu($p,$o,$rid){
$j=$rid.'_spiatom,call_inp___'.$o;
$ret=inputj('inp',$p,$j);
//$ret.=bar($rid,$p,$step=1,$min=1,$max=117,$js='spiatom','360px');
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function nav($p,$o,$rid){
$ret=self::menu($p,$o,$rid);
if($p>0)$ret.=lj('',$rid.'_spiatom,call___'.($p-1).'_'.$o,picto('previous')).' ';
if($p<118)$ret.=lj('',$rid.'_spiatom,call___'.($p+1).'_'.$o,picto('next')).' ';
$ret.=hlpbt('spitable');
$ret.=msqbt('','public_atomic');
$ret.=lk('/app/spt',picto('filelist'));
return $ret;}

static function home($p,$o){$rid='spt'; $p=$p?$p:118; $o=1;//linear
Head::add('csscode',self::css());
Head::add('jscode',self::js('spt_spiatom,call',$p,$o));
$ret=self::call($p,$o);
return divd($rid,$ret);}
}
?>