<?php
//philum_plugin_spisvg

function spisvg_js($j,$n=1,$o){return 'var n='.$n.';
//addEvent(document,"DOMMouseScroll",function(){wheelcount(event,"'.$j.'","'.$o.'")});

function checkArrows(e,id){
var n=getbyid(\'bar\'+id).value; //alert(n);
if(e && e.which)var c=e.which; else var c=e.keyCode; //alert(c);
if(c==37)var nb=n-1; if(c==39)var nb=n-(-1); //alert(nb);
getbyid(\'bar\'+id).value=nb;
getbyid(\'lbl\'+id).innerHTML=nb;
SaveJ(\''.$j.'_\'+(nb)+\'_\'+id);}
addEvent(document,\'keypress\',function(event){checkArrows(event,\''.$o.'\')});

function spiatom(n,id){
	getbyid(\'bar\'+id).value=n;
	getbyid(\'lbl\'+id).innerHTML=n;
	SaveJ(\''.$j.'_\'+n+\'_\'+\''.$o.'\');}
';}

function spt_css(){$ret='';
for($i=1;$i<=118;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

function spt_clr(){return [''=>'ccc','Nonmetals'=>'5FA92E','Nobles Gasses'=>'00D0F9','Alkali Metals'=>'FF0008','Alkali Earth Metals'=>'FF00FF','Metalloids'=>'1672B1','Halogens'=>'F6E617','Metals'=>'999999','Transactinides'=>'FF9900','Lanthanides'=>'666698','Actinides'=>'9D6568','undefined'=>'ffffff'];}

function spt_findclr($d){$r=spt_clr();
return $r[$d]?$r[$d]:'ffffff';}

function spt_legend(){$i=0; $ret='';
$r=spt_clr(); $w=100; $h=20; $y=1; $x=1;
$sz=[1=>70,2=>100,3=>80,4=>110,5=>70,6=>70,7=>50,8=>90,9=>80,10=>60,11=>70];
foreach($r as $k=>$v)if($k){$i++;
	$w=$sz[$i];//$w=strlen($k)*8;
	$ret.='[#'.$v.',gray:attr]';
	$ret.='['.$x.','.$y.','.$w.','.$h.':rect]';
	$ret.='['.($x+4).','.($y+15).',12px§'.$k.':text]';
	$x+=$w;}
	$ret.='[0,40,12px§@Davy2019:text]';
return $ret;}

function spt_pos($ring,$sub,$pos,$i,$v,$mode){
$u=40;//unit
$zerox=1; $zeroy=4;
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
$t1='[spt_plug__2_spisvg_spisvg*j_'.$i.'§['.($x+10).','.($y+22).'§'.$i.':text]:lj]';
$t2='[popup_plup___spitable_spi*infos_'.$i.'§['.($x+10).','.($y+$h-16).'§'.$v.':text]:lj]';}
else{$w=$u*2;$h=$u;
$t1='[spt_plug__2_spisvg_spisvg*j_'.$i.'§['.($x+10).','.($y+22).'§'.$i.':text]:lj]';
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
$ring=substr($level,0,1); $sub=0;
$subring=substr($level,1,1);
if($subring=='s')$sub=1;
elseif($subring=='p')$sub=2;
elseif($subring=='d')$sub=3;
elseif($subring=='f')$sub=4;
$pos=substr($level,2);
return [$ring,$sub,$pos];}

function spt_act($r,$ring){static $rx;
list($name,$sym,$fam,$layer,$level)=$r;
$ra=explode('-','-'.$layer);
$max=val($ra,$ring); $rx[$ring][]=1;//count elemenrs in rings
return count($rx[$ring])<=$max?0:1;}

function spt_atom($r,$i,$mode,$p,$rc){
list($name,$sym,$fam,$layer,$level)=arr($r[$i],5); //echo $name.'-'.$sym.'-'.$fam.'-'.$level.br();
list($ring,$subring,$pos)=spt_findpos($level,$i); //echo $ring.'-'.$subring.'-'.$pos.br();
list($x,$y,$w,$h,$t)=spt_pos($ring,$subring,$pos,$i,$sym,$mode);
$clr=spt_findclr($fam); $hide=$i<=$p?0:1; if($rc)$clr=$rc[$i];
$hide=spt_act(val($r,$p),$ring);//anomalies
$bdr=$p==$i?'red':($hide?'gray':'black'); $sz=$p==$i?'2':'1'; $alpha=$hide?'0.2':'1';
$atr='[#'.$clr.','.$bdr.','.$sz.',,'.$alpha.':attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.':rect]';
return $atr.$rect.$t;}

function spi_clr3($r,$col){
$ra=array_keys_r($r,$col); $min=0;
$ra=array_flip($ra); unset($ra['']); unset($ra['N/A']); $ra=array_flip($ra);
foreach($ra as $k=>$v)if(strpos($v,'@')!==false)echo $ra[$k]=substr($v,0,strpos($v,'@'));
	elseif(strpos($v,'±')!==false)$ra[$k]=substr($v,0,strpos($v,'±')); //pr($ra);
foreach($ra as $k=>$v)$ra[$k]=str_replace(',','.',$v);
foreach($ra as $k=>$v)if(intval($v)<$min)$min=$v;
if(!$min)$min=min($ra); $max=max($ra); $diff=$max-$min; $ratio=255/$diff;
foreach($ra as $k=>$v)if(strpos($v,'@')===false && strpos($v,'±')===false){
	$d=dechex(255-round(($v-$min)*$ratio)); $rb[$k]='ff'.$d.$d;} //pr($rb);
return $rb;}

function spi_clr2(){
$r=msql::read_b('','public_atomic_3','',1);
return array_keys_r($r,4);}

//build
function spisvg_build($p,$o){//$o=0;
$r=msql::read('','public_atomic','',1);
$bt=spt_nav($p,$o,'spt');
$u=40;//unit
if($o){$mode='linear'; $w=48*$u; $h=10*$u;} else{$mode=0; $w=25*$u; $h=18*$u;}//w/h
$max=118; //p($r[$p]);
$rc=[]; //$rc=spi_clr2(); //p($rc);
//if(auth(6))$rc=spi_clr3($r,9);
for($i=1;$i<=$max;$i++)$rb[]=spt_atom($r,$i,$mode,$p,$rc);
$ret=implode("\n",$rb);
$ret.=spt_legend();
if($ret)$ret=svg::home($ret,$w.'/'.$h);
return $bt.$ret;}

function spisvg_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); if($p>118)$p=118;
$ret=spisvg_build($p,$o);
return $ret;}

function spt_menu($p,$o,$rid){
$ret.=bar('barsvg',$p,$step=1,$min=1,$max=118,$js='spiatom','360px');
return $ret;}

function spt_nav($p,$o,$rid){
$j=$rid.'_plug__2_spisvg_spisvg*j___inpsvg';
$ret=inputj('inpsvg',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
if($p>0)$ret.=lj('',$rid.'_plug__2_spisvg_spisvg*j_'.($p-1).'_'.$o,picto('previous')).' ';
if($p<118)$ret.=lj('',$rid.'_plug__2_spisvg_spisvg*j_'.($p+1).'_'.$o,picto('next')).' ';
$ret.=hlpbt('spitable');
$ret.=msqbt('','public_atomic');
$ret.=lk('/plug/spt',picto('filelist'));
return $ret;}

function plug_spisvg($p,$o){$rid='spt'; $p=$p?$p:118; //$o=1;
//Head::add('csscode',spt_css());
Head::add('jscode',spisvg_js('spt_plug__2_spisvg_spisvg*j',$p,$o));
$bt=spt_menu($p,$o,$rid);
$ret=spisvg_build($p,$o);
//$bt.=msqbt('',nod('public_atomic'));
return $bt.div(atd($rid).atc('panel small'),$ret);}

?>