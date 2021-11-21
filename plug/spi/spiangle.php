<?php
//philum_plugin_spiangle

function spg_css(){$ret='';
for($i=1;$i<118;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

function spg_clr(){return array(''=>'ccc','Nonmetals'=>"92FF10",'Nobles Gasses'=>"05FFFF",'Alkali Metals'=>"FF9801",'Alkali Earth Metals'=>"BF6700",'Metalloids'=>"91C9D6",'Halogens'=>"FFFF00",'Metals'=>"ABABB0",'Transactinides'=>"C9C97A",'Lanthanides'=>"B3D7AB",'Actinides'=>"75ADAB",'undefined'=>"ffffff");}

function spg_legend(){$i=0; $ret='';
$r=spg_clr(); $w=100; $h=20; $y=20; $x=60;
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

function spg_layers(){
$u=20; $zeroy=3; $ret=''; $y=$zeroy*$u;
$rd=array('k'=>2,'l'=>5,'m'=>9,'n'=>14,'o'=>19,'p'=>23,'q'=>26);
$rh=array('k'=>1,'l'=>2,'m'=>3,'n'=>4,'o'=>4,'p'=>3,'q'=>2);
foreach($rd as $k=>$v){$h=$rh[$k]*$u;
	$ret.='[,black,1:attr][40,'.$y.',40,'.($y+$h).':line]';
	$ret.='[black,,:attr][20,'.($y+($h/2)).',12px§'.$k.':text]';
	$y+=$h+$u;
}
return $ret;}

function spg_findclr($d){$r=spg_clr();
return $r[$d]?$r[$d]:'ffffff';}

//positions
function spg_pos($ring,$sub,$pos,$n,$v,$mode){
$u=20;//unit
$zerox=3; $zeroy=2;
//position on rings
$ry[1]=array(1=>0,0);
$ry[2]=array(1=>1,1,2,2,2,2);
$ry[3]=array(1=>3,3,4,4,4,4,5,5,5,5);
$ry[4]=array(1=>6,6,7,7,7,7,8,8,8,8,9,9,9,9);
//x
$rx[1]=array(0=>0,14);
$ni=14/5; for($i=0;$i<6;$i++)$rx[2][$i]=$i*$ni;
$ni=14/9; for($i=0;$i<10;$i++)$rx[3][$i]=$i*$ni;
$ni=14/13; for($i=0;$i<14;$i++)$rx[4][$i]=$i*$ni;
//ring_height
$rd=array(1=>0,2=>2,3=>5,4=>9,5=>14,6=>19,7=>23,8=>26);
//ring angle
$rg=array(1=>90,2=>15,3=>10,4=>6,42857,5=>5);
$angle=$rg[$sub]*($pos-1);
//x,y,w,h
//$x=($pos*3+$zerox)*$u;
$x=($rx[$sub][$pos-1]*3+$zerox)*$u;
$y=($rd[$ring]+($sub)+$zeroy)*$u;
//if($n==11)echo $n.'-'.$rd[$ring].'-'.$ry[$sub][$pos].br();
$w=$u*3;$h=$u;
$t1='[spg_plug__2_spiangle_spiangle*j_'.$n.'§['.($x+4).','.($y+14).',12px§'.$n.':text]:lj]';
$t2='[popup_plup___spitable_spi*infos_'.$n.'§['.($x+$w/2+2).','.($y+14).',12§'.$v.':text]:lj]';
$ret=$t1.$t2;
//echo $x.'-'.$y.'-'.$w.'-'.$h.br();
return array($x,$y,$w,$h,$ret);}

function spg_findpos2($i){
$r=array(2,6,10,14); $n=$i-118;
foreach($r as $k=>$v)if($n-$v<0){$ring=8; $sub=$k; $pos=$n-$v;}
return array($ring,$sub,$pos);}

function spg_findpos($level,$i){
if($i>118)return spg_findpos2($i);
$ring=substr($level,0,1);
$subring=substr($level,1,1);
if($subring=='s')$sub=1; elseif($subring=='p')$sub=2; elseif($subring=='d')$sub=3; elseif($subring=='f')$sub=4;
$pos=substr($level,2);
return array($ring,$sub,$pos);}

function spg_findpos_layer($level,$i){
$rg=array(1=>2,8,18,32,32,18,8,2);
$r=explode('-',$level); $n=count($r);
$mx=$rg[$n]; $sub=$mx-$r[$n-1];
echo $i.';'.$level.';n:'.$n,';ring:'.$ring.';sub:'.$sub.br();
return array($ring,$sub,$pos);}

//atom
function spg_atom($r,$i,$mode,$hide=''){
list($name,$sym,$fam,$layer,$level)=$r[$i]; //
//echo $name.'-'.$sym.'-'.$fam.'-'.$level.br();
list($ring,$subring,$pos)=spg_findpos($level,$i);
//list($ring,$subring,$pos)=spg_findpos_layer($layer,$i);
//echo $ring.'-'.$subring.'-'.$pos.br();
list($x,$y,$w,$h,$t)=spg_pos($ring,$subring,$pos,$i,$sym,$mode);
$clr=spg_findclr($fam);
$atr='[#'.$clr.',black,1:attr]';
if($hide)$atr='[#'.$clr.',gray,,,0.2:attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.':rect]';
return $atr.$rect.$t;}

//build
function spiangle_build($p,$o){//$o=0;
$r=msql::read('','public_atomic','',1);
$bt=spg_nav($p,$o,'spg');
//mode linear
if($o){$mode='linear'; $sz='1900/400';} else{$mode=0; $sz='1000/600';}
//$ret='[rand,black,1:attr]';
//$txt1='[popup_plup___svg§[20,20§hello:text]:lj]';
$max=118;
$limit=$p?$p:$max;
$rb[0]=spg_legend();
$rb[1]=spg_layers();
for($i=1;$i<=$limit;$i++)$rb[]=spg_atom($r,$i,$mode);
if($limit<$max)for($i=$limit+1;$i<=$max;$i++)$rb[]=spg_atom($r,$i,$mode,1);
//render
$ret=implode("\n",$rb);//echo 
if($ret)$ret=svg::home($ret,$sz);
return $bt.$ret;}

function spiangle_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=spiangle_build($p,$o);
return $bt.$ret;}

function spg_menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_spiangle_spiangle*j___inp',picto('ok')).' ';
return $ret;}

function spg_nav($p,$o,$rid){
$ret=spg_menu($p,$o,$rid);
if($p>0)$ret.=lj('',$rid.'_plug__2_spiangle_spiangle*j_'.($p-1).'_'.$o,picto('previous')).' ';
if($p<118)$ret.=lj('',$rid.'_plug__2_spiangle_spiangle*j_'.($p+1).'_'.$o,picto('next')).' ';
$ret.=msqbt('','public_atomic');
$ret.=hlpbt('spitable');
$ret.=lk('/plug/spt',picto('filelist'));
return $ret;}

function plug_spiangle($p,$o){$rid='spg'; $p=$p?$p:118; //$o=1;
Head::add('csscode',spg_css());
//$bt=spg_menu($p,$o,$rid);
$ret=spiangle_build($p,$o);
return divd($rid,$ret);}

?>