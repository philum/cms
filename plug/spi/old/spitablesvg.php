<?php
//philum_plugin_spitablesvg

function spt_css(){$ret='';
for($i=1;$i<118;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

/*function spi_mol($d){
$r=msql::read('','public_atomic','',1);
list($ring,$subring,$pos)=spt_findpos($r[$d][4],$d);
$rg=array(1=>2,2=>6,3=>10,4=>14);
$freesocks=$rg[$subring]-$pos;
return $ret;}*/

function spt_clr(){return array(''=>'ccc','Nonmetals'=>"5FA92E",'Nobles Gasses'=>"00D0F9",'Alkali Metals'=>"FF0008",'Alkali Earth Metals'=>"FF00FF",'Metalloids'=>"1672B1",'Halogens'=>"F6E617",'Metals'=>"999999",'Transactinides'=>"FF9900",'Lanthanides'=>"666698",'Actinides'=>"9D6568",'undefined'=>"ffffff");}

function spt_findclr($d){$r=spt_clr();
return $r[$d]?$r[$d]:'ffffff';}

function spt_order1(){
$rx[1]=[1=>-1,0];
$ry[1]=[1=>0,0];
$rx[2]=[1=>0,-2,-2,-2,0,1];
$ry[2]=[1=>-1,-1,0,2,2,0];
$rx[3]=[1=>2,2=>0,3=>-2,4=>-3,5=>-3,6=>-3,7=>-2,8=>0,9=>2,10=>2];
$ry[3]=[1=>-2,2=>-2,3=>-2,4=>-2,5=>0,6=>2,7=>3,8=>3,9=>2,10=>0];
$rx[4]=[1=>3,2=>2,3=>0,4=>-2,5=>-4,6=>-4,7=>-4,8=>-4,9=>-4,10=>-2,11=>0,12=>2,13=>3,14=>3];
$ry[4]=[1=>-2,2=>-3,3=>-3,4=>-3,5=>-3,6=>-2,7=>0,8=>2,9=>4,10=>4,11=>4,12=>4,13=>2,14=>0];
return [$rx,$ry];}

function spt_order2(){
$rx[1]=[1=>-1,0];
$ry[1]=[1=>0,0];
$rx[2]=[1=>-2,0,-2,0,-2,1];
$ry[2]=[1=>-1,-1,2,2,0,0];
$rx[3]=[1=>-2,2=>0,3=>-2,4=>0,5=>-3,6=>2,7=>-3,8=>2,9=>-3,10=>2];
$ry[3]=[1=>-2,2=>-2,3=>3,4=>3,5=>-2,6=>-2,7=>2,8=>2,9=>0,10=>0];
$rx[4]=[1=>-2,2=>0,3=>-2,4=>0,5=>-4,6=>2,7=>-4,8=>2,9=>-4,10=>3,11=>-4,12=>3,13=>-4,14=>3];
$ry[4]=[1=>-3,2=>-3,3=>4,4=>4,5=>-3,6=>-3,7=>4,8=>4,9=>-2,10=>-2,11=>2,12=>2,13=>0,14=>-0];
return [$rx,$ry];}

function spt_pos($ring,$sub,$pos,$i,$v,$mode){
$u=40;//unit
$zerox=1; $zeroy=4;
//position on rings
list($rx,$ry)=spt_order2();
//ring_distance//if linear
$rd=[1=>1,2=>5,3=>11,4=>19,5=>28,6=>36,7=>42,8=>48];
//ring distant//vertical
$rdx=[1=>1,2=>5,3=>11,4=>19,5=>4,6=>12,7=>18,8=>22];
$rdy=[1=>0,2=>0,3=>0,4=>0,5=>8,6=>8,7=>8,8=>8];
//atom angle
$rg[1]=str_split('011');
$rg[2]=str_split('0000011');
$rg[3]=str_split('00000111111');
$rg[4]=str_split('000000000111111');
//mode
if($mode==='linear'){$addx=($rd[$ring]*$u); $addy=0;}
else{$addx=($rdx[$ring]*$u); $addy=($rdy[$ring]*$u);}
//x,y,w,h
$x=($rx[$sub][$pos]+$zerox)*$u+$addx;
$y=($ry[$sub][$pos]+$zeroy)*$u+$addy;
//if($ring==8)echo 'n'.$i.'.ring'.$ring.'.sub'.$sub.'.pos'.$pos.'.rx'.$rx[$sub][$pos].'.ry'.$ry[$sub][$pos].br();//.'.rg'.$rg[$sub][$pos].'.rd'.$rd[$ring]
//t, vertical-horizontal
if($rg[$sub][$pos]){$w=$u;$h=$u*2;
$t1='[spt_plug__2_spitablesvg_spitablesvg*j_'.$i.'§['.($x+$w/2-10).','.($y+22).'§'.$i.':text]:lj]';
$t2='[popup_plup___spitable_spi*infos_'.$i.'§['.($x+$w/2-10).','.($y+$h-16).'§'.$v.':text]:lj]';}
else{$w=$u*2;$h=$u;
$t1='[spt_plug__2_spitablesvg_spitablesvg*j_'.$i.'§['.($x+$w/4-10).','.($y+24).'§'.$i.':text]:lj]';
$t2='[popup_plup___spitable_spi*infos_'.$i.'§['.($x+$w/2+6).','.($y+24).'§'.$v.':text]:lj]';}
//$ret='[popup_plup___svg§[20,20§'.$t2.':text]:lj]';
$ret=$t1.$t2;
//echo $x.'-'.$y.'-'.$w.'-'.$h.br();
return [$x,$y,$w,$h,$ret];}

function spt_findpos2($i){
$r=array(2,6,10,14); $n=$i-118;
foreach($r as $k=>$v)if($n-$v<0){$ring=8; $sub=$k; $pos=$n-$v;}
return [$ring,$sub,$pos];}

function spt_findpos($level,$i){
if($i>118)return spt_findpos2($i);
$ring=substr($level,0,1);
$subring=substr($level,1,1);
if($subring=='s')$sub=1; elseif($subring=='p')$sub=2; elseif($subring=='d')$sub=3; elseif($subring=='f')$sub=4;
$pos=substr($level,2);
return [$ring,$sub,$pos];}

function spt_atom($r,$i,$mode,$hide=''){
list($name,$sym,$fam,$layer,$level)=$r[$i]; //echo $name.'-'.$sym.'-'.$fam.'-'.$level.br();
list($ring,$subring,$pos)=spt_findpos($level,$i); //echo $ring.'-'.$subring.'-'.$pos.br();
list($x,$y,$w,$h,$t)=spt_pos($ring,$subring,$pos,$i,$sym,$mode);
$clr=spt_findclr($fam);
$atr='[#'.$clr.',black,1:attr]';
if($hide)$atr='[#'.$clr.',gray,,,0.2:attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.':rect]';
return $atr.$rect.$t;}

//build
function spitablesvg_build($p,$o){//$o=0;
$r=msql::read('','public_atomic','',1);
$bt=spt_nav($p,$o,'spt');
//mode linear
if($o){$mode='linear'; $sz='1900/400';} else{$mode=0; $sz='1000/700';}
//$ret='[rand,black,1:attr]';
//$txt1='[popup_plup___svg§[20,20§hello:text]:lj]';
$max=118;
$limit=$p?$p:$max;
for($i=1;$i<=$limit;$i++)$rb[]=spt_atom($r,$i,$mode);
if($limit<$max)for($i=$limit+1;$i<=$max;$i++)$rb[]=spt_atom($r,$i,$mode,1);
//render
$ret=implode("\n",$rb);//echo 
if($ret)$ret=svg::home($ret,$sz);
return $bt.$ret;}

function spitablesvg_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=spitablesvg_build($p,$o);
return $bt.$ret;}

function spt_menu($p,$o,$rid){$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_spitablesvg_spitablesvg*j___inp',picto('ok')).' ';
return $ret;}

function spt_nav($p,$o,$rid){
$ret=spt_menu($p,$o,$rid);
if($p>0)$ret.=lj('',$rid.'_plug__2_spitablesvg_spitablesvg*j_'.($p-1).'_'.$o,picto('previous')).' ';
if($p<118)$ret.=lj('',$rid.'_plug__2_spitablesvg_spitablesvg*j_'.($p+1).'_'.$o,picto('next')).' ';
$ret.=hlpbt('spitable');
$ret.=lk('/plug/spt',picto('menu'));
return $ret;}

function plug_spitablesvg($p,$o){$rid='spt'; $p=$p?$p:118; //$o=1;
Head::add('csscode',spt_css());
//$bt=spt_menu($p,$o,$rid);
$ret=spitablesvg_build($p,$o);
//$bt.=msqbt('',nod('public_atomic'));
return div(atd($rid).atc('panel small'),$ret);}

?>