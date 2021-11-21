<?php
//philum_app_spisvg2

class spisvg2{
static $max=118;
static $unit=40;
static $mode='2lines';

static function js($j,$n=1,$o){//self::patch();
return 'var n='.$n.';
//addEvent(document,"DOMMouseScroll",function(){wheelcount(event,"'.$j.'","'.$o.'")});

function checkArrows(e,id){
var n=getbyid(\'bar\'+id).value; //alert(n);
if(e && e.which)var c=e.which; else var c=e.keyCode; //alert(c);
if(c==37)var nb=n-1; if(c==39)var nb=n-(-1); //alert(nb);
getbyid(\'bar\'+id).value=nb;
getbyid(\'lbl\'+id).innerHTML=nb;
SaveJ(\''.$j.'_\'+(nb)+\'_\'+\''.$o.'\');}
addEvent(document,\'keypress\',function(event){checkArrows(event,id)});

function spiatom(n,id){
	getbyid(\'bar\'+id).value=n;
	getbyid(\'lbl\'+id).innerHTML=n;
	SaveJ(\''.$j.'_\'+n+\'_\'+\''.$o.'\');}

atoms='.msql::json('','public_atomic_2','',1).'; //atoms[1][2];
//import atoms from ./js/atoms.js;

function coloriz(n){n=n==1?12:16;
for(i=1;i<=120;i++)window["id"+i].style.fill="#"+atoms[i][n];}

function atoms_clr(n){
var r=[]; var min=0; var max=0; var ratio=1; var diff=0; var res=0; var ret=0;
for(i=1;i<=120;i++){
	ret=atoms[i][n]; //alert(ret);
	ret=ret.replace(",","."); //ret=parseFloat(ret); //var ret=ret*1; //alert(n);
	if(ret=="N/A" || ret=="---")ret="-";
	else if(ret.indexOf("?")!=-1)ret=ret.substr(0,ret.indexOf("?"));
	else if(ret.indexOf("@")!=-1)ret=ret.substr(0,ret.indexOf("@"));
	else if(ret.indexOf("±")!=-1)ret=ret.substr(0,ret.indexOf("±"));
	else if(ret.indexOf(" ")!=-1)ret=ret.substr(0,ret.indexOf(" "));
	ret=parseFloat(ret);
	if(ret<min)min=ret; if(ret>max)max=ret; r[i]=ret;}
	//console.log(i+":"+ret+"="+max);
//if(!min)min=Math.min(r); if(!max)var max=Math.max(r); 
var diff=max-min; var ratio=255/diff; var ratio1=255/max; if(min)var ratio2=255/min;
var red=255; var green=255; var blue=255;
for(i=1;i<=120;i++){
	if(min<0){
		if(r[i]>=0){res=Math.round(r[i]*ratio1); red=255; green=res; blue=res;}
		else{res=Math.round(r[i]*ratio2); red=255-res; green=255-res; blue=255;}}
	else if(min>=0){res=Math.round((r[i]-min)*ratio); red=255; green=255-res; blue=255-res;}
	else{red=127; green=127; blue=127;}
	r[i]="rgb("+red+","+green+","+blue+")";
	r[i]="#"+dec2hex(red)+""+dec2hex(green)+""+dec2hex(blue);
	//console.log(i+":"+r[i]+"="+res+" clr:"+red+","+green+","+blue);
	}
return r;}

function coloriz2(n){var r=atoms_clr(n); //alert(r);
for(i=1;i<=120;i++)window["id"+i].style.fill=r[i];}

function anim(n){n++; x=setTimeout(function(){play(n)},500);}
function play(n=0,p){
	if(n==0 && typeof x=="number"){clearTimeout(x); n=120; x="";}
	SaveJ("spt_app__2_spisvg2_call_"+n+"_"+p);
	if(n<120)anim(n);}
';}

static function css(){$ret='rect:hover{box-shadow:0px 0px 4px #aaa;}';
//for($i=1;$i<=self::$max;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

static function clr(){return [''=>'ccc','Nonmetals'=>'5FA92E','Nobles Gasses'=>'00D0F9','Alkali Metals'=>'FF0008','Alkali Earth Metals'=>'FF00FF','Metalloids'=>'1672B1','Halogens'=>'F6E617','Metals'=>'999999','Transactinides'=>'FF9900','Lanthanides'=>'666698','Actinides'=>'9D6568','undefined'=>'ffffff'];}

static function findclr($d){$r=self::clr();
return $r[$d]?$r[$d]:'ffffff';}

static function options($d){
return;}

static function legend($o){$i=0; $ret='';
$r=self::clr(); $w=100; $h=20; $y=1; $x=1; $max=self::$max;
list($mode,$clr,$size)=opt($o,'-',3);
$sz=[1=>70,2=>100,3=>80,4=>110,5=>70,6=>70,7=>50,8=>90,9=>80,10=>60,11=>70];
foreach($r as $k=>$v)if($k){$i++;
	$w=$sz[$i];//$w=strlen($k)*8;
	$ret.='[#'.$v.',gray:attr]';
	$ret.='['.$x.','.$y.','.$w.','.$h.':rect]';
	$ret.='['.($x+4).','.($y+15).',12px§'.$k.':text]';
	$x+=$w;}
$ret.='['.($x+10).',16,12px§@Davy2019:text]';
$j='';
if($mode=='linear')$ret.='[spt_app__2_spisvg2_call_'.$max.'_2lines§[0,40,12px§radial:text]:lj]';
else $ret.='[spt_app__2_spisvg2_call_'.$max.'_linear§[0,40,12px§linear:text]:lj]';
$ret.='[spt_app__2_spisvg2_call_'.$max.'_'.$mode.'-1§[40,40,12px§clr1:text]:lj]';
$ret.='[spt_app__2_spisvg2_call_'.$max.'_'.$mode.'-2§[65,40,12px§clr2:text]:lj]';
$ret.='[spt_app__2_spisvg2_call_'.$max.'_'.$mode.'-3§[100,40,12px§atomic mass:text]:lj]';
$ret.='[spt_app__2_spisvg2_call_'.$max.'_'.$mode.'-4§[180,40,12px§mass:text]:lj]';
$ret.='[spt_app__2_spisvg2_call_'.$max.'_'.$mode.'-5§[220,40,12px§fusion:text]:lj]';
$ret.='[spt_app__2_spisvg2_call_'.$max.'_'.$mode.'-6§[260,40,12px§ebulition:text]:lj]';
if(auth(6)){
$ret.='[coloriz(1)§[40,60,12px§clr1:text]:js]';
$ret.='[coloriz(2)§[65,60,12px§clr2:text]:js]';
$ret.='[coloriz2(9)§[100,60,12px§atomic mass:text]:js]';
$ret.='[coloriz2(8)§[180,60,12px§mass:text]:js]';
$ret.='[coloriz2(5)§[220,60,12px§fusion:text]:js]';
$ret.='[coloriz2(6)§[260,60,12px§ebulition:text]:js]';
$ret.='[play(0)§[320,40,12px§anim:text]:js]';}
return $ret;}

static function atompos($ring,$sub,$pos,$i,$v,$o){
$u=self::$unit;//unit
list($mode,$clr,$size)=opt($o,'-',3);
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
$rd=[1=>1,2=>5,3=>11,4=>19,5=>28,6=>36,7=>42,8=>46];
//ring distant//vertical
$rdx=[1=>2,2=>6,3=>12,4=>20,5=>4,6=>12,7=>18,8=>22,9=>26];
$rdy=[1=>1,2=>1,3=>1,4=>1,5=>8,6=>8,7=>8,8=>8,9=>8];
//atom angle
$rg[1]=str_split('011');
$rg[2]=str_split('0001001');
$rg[3]=str_split('01001110011');
$rg[4]=str_split('010000111000011');
//mode
if($mode=='linear'){$addx=($rd[$ring]*$u); $addy=20;}
else{$addx=($rdx[$ring]*$u); $addy=($rdy[$ring]*$u);}
//x,y,w,h
$x=($rx[$sub][$pos]+$zerox)*$u+$addx;
$y=($ry[$sub][$pos]+$zeroy)*$u+$addy;
//t, vertical-horizontal
$mg=round($u/4)-3; $mg2=round($u/2)+4; $sz=10+($u/10);
if($rg[$sub][$pos]){$w=$u; $h=$u*2;//horizontal
$t1='[spt_app__2_spisvg2_call_'.$i.'_'.$o.'§['.($x+$mg).','.($y+$mg2).','.$sz.'px§'.$i.':text]:lj]';
$t2='[popup_plup___spitable_spi*infos_'.$i.'§['.($x+$mg).','.($y+$h-$mg2).','.$sz.'px§'.$v.':text]:lj]';}
else{$w=$u*2; $h=$u;
$t1='[spt_app__2_spisvg2_call_'.$i.'_'.$o.'§['.($x+$mg).','.($y+$mg2).','.$sz.'px§'.$i.':text]:lj]';
$t2='[popup_plup___spitable_spi*infos_'.$i.'§['.($x+$w/2+6).','.($y+$mg2).','.$sz.'px§'.$v.':text]:lj]';}
//$ret='[popup_plup___svg§[20,20§'.$t2.':text]:lj]';
$ret=$t1.$t2;
//echo $x.'-'.$y.'-'.$w.'-'.$h.br();
return [$x,$y,$w,$h,$ret];}

static function findpos2($i){
$r=[1=>2,6,10,14,18]; $n=$i-118; $sub=0;
if($n<=2)$ring=8; elseif($n<=20)$ring=5; elseif($n<=34)$ring=6;
elseif($n<=44)$ring=7; elseif($n<=52)$ring=8; elseif($n<=54)$ring=9;
foreach($r as $k=>$v)if($n<=$v && !$sub){$sub=$k; $pos=$n;}
return [$ring,$sub,$pos];}

static function findpos($level,$i){
//if($i>118)return self::findpos2($i);
$ring=substr($level,0,1); $sub=0;
$subring=substr($level,1,1);
$pos=substr($level,2);
if($subring=='s')$sub=1;
elseif($subring=='p')$sub=2;
elseif($subring=='d')$sub=3;
elseif($subring=='f')$sub=4;
elseif($i==119)return [8,1,1];
elseif($i==120)return [8,1,2];
return [$ring,$sub,$pos];}

static function active($r,$ring){static $rx;
list($name,$sym,$fam,$layer,$level)=arr($r,5);
$ra=explode('-','-'.$layer);
$max=val($ra,$ring); $rx[$ring][]=1;//count elemenrs in rings
return count($rx[$ring])<=$max?0:1;}

static function atom($r,$i,$p,$o,$rc){
list($name,$sym,$fam,$layer,$level)=arr(val($r,$i),5); //echo $name.'-'.$sym.'-'.$fam.'-'.$level.br();
list($ring,$subring,$pos)=self::findpos($level,$i); //echo $ring.'-'.$subring.'-'.$pos.br();
list($x,$y,$w,$h,$t)=self::atompos($ring,$subring,$pos,$i,$sym,$o); //echo $x.'-'.$y.'-'.$w.'-'.$h;
$clr=self::findclr($fam); $hide=$i<=$p?0:1; if($rc)$clr=$rc[$i];
$hide=self::active(val($r,$p),$ring);//anomalies
$bdr=$p==$i?'red':($hide?'gray':'black'); $sz=$p==$i?'2':'1'; $alpha=$hide?'0.2':'1';
$atr='[#'.$clr.','.$bdr.','.$sz.',,'.$alpha.':attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.',bt:rect]';
return $atr.$rect.$t;}

static function clr3($r,$col){
$ra=array_keys_r($r,$col); $min=0; $max=0;
foreach($ra as $k=>$v){$v=str_replace(',','.',$v);
	if($v=='N/A' or $v=='---')$v='-';
	elseif(strpos($v,'@')!==false)$v=substr($v,0,strpos($v,'@'));
	elseif(strpos($v,'±')!==false)$v=substr($v,0,strpos($v,'±'));
	elseif(strpos($v,' ')!==false)$v=substr($v,0,strpos($v,' '));
	if(intval($v)<$min)$min=$v; if(intval($v)>$max)$max=$v; $ra[$k]=$v;}//pr($ra);
//$min=min($ra); $max=max($ra); 
$diff=$max-($min); $ratio=255/$diff; $ratio1=255/$max; if($min)$ratio2=255/(0-$min);
foreach($ra as $k=>$v){
	if(!is_numeric($v)){$red=127; $green=127; $blue=127;}
	elseif($min<0){
		if($v>=0){$d=round($v*$ratio1); $red=255; $green=$d; $blue=$green;}
		else{$d=0-round($v*$ratio2); $red=255-$d; $green=$red; $blue=255;}}
	elseif($min>=0){$d=round(($v-$min)*$ratio); $red=255; $green=255-$d; $blue=$green;}
	$rb[$k]=rgb2hex([$red,$green,$blue]);}
return $rb;}

static function clr2(){
$r=msql::read_b('','public_atomic_3','',1);
return array_keys_r($r,4);}

static function patch(){
$r=msql::read_b('','public_atomic_2','',1);
$rb=self::clr();
$rh=['Nom','Symbole','Famille','Couche','Niveau orbital','Fusion','Ebulition (C°)','Découverte','Masse','Masse atomique (u)','Isotopes','Numéro atomique','clr','pos','free','deg','clr2'];
foreach($r as $k=>$v)$r[$k][12]=$rb[$v[2]];
msql::save('','public_atomic_2',$r,$rh);}

//build
static function build($p,$o){//$o=0;
$r=msql::read('','public_atomic','',1);
list($mode,$clr,$size)=opt($o,'-',3);
$bt=self::nav($p,$o,'spt');
$u=self::$unit;//unit
if($mode=='linear'){$u=self::$unit=30; $w=49*$u; $h=10*$u;}
else{$mode='2lines'; $u=self::$unit=40; $w=25*$u; $h=18*$u;}//w/h
$max=self::$max; //p($r[$p]);
if($clr==2)$rc=self::clr2(); //p($rc);
elseif($clr==3)$rc=self::clr3($r,9);
elseif($clr==4)$rc=self::clr3($r,8);
elseif($clr==5)$rc=self::clr3($r,5);
elseif($clr==6)$rc=self::clr3($r,6);
else $rc=[];
for($i=1;$i<=$max;$i++)$rb[]=self::atom($r,$i,$p,$o,$rc);
$ret='[white,black,1:attr][0,0,'.$w.','.$h.':rect]';
$ret=implode("\n",$rb);
$ret.=self::legend($o);
if($ret)$ret=svg::home($ret,$w.'/'.$h);
return $bt.$ret;}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); if($p>self::$max)$p=self::$max;
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){return;
$ret.=bar('barsvg',$p,$step=1,$min=1,self::$max,$js='spiatom','236px');
return $ret;}

static function nav($p,$o,$rid){
$j=$rid.'_app__2_spisvg2_call__'.$o.'_inpsvg';
$ret=inputj('inpsvg',$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
//$ret.=bar('barsvg',$p,$step=1,$min=1,self::$max,$js='spiatom','236px');
if($p>0)$ret.=lj('',$rid.'_app__2_spisvg2_call_'.($p-1).'_'.$o,picto('previous')).' ';
if($p<self::$max)$ret.=lj('',$rid.'_app__2_spisvg2_call_'.($p+1).'_'.$o,picto('next')).' ';
$ret.=hlpbt('spitable');
$ret.=msqbt('','public_atomic');
$ret.=lk('/plug/spt',picto('filelist'));
return $ret;}

}

function plug_spisvg2($p,$o){$rid='spt'; $p=$p?$p:spisvg2::$max; //$o=1;
Head::add('csscode',spisvg2::css());
Head::add('jscode',spisvg2::js('spt_app__2_spisvg2_call',$p,$o));
$bt=spisvg2::menu($p,$o,$rid);
$ret=spisvg2::build($p,$o);
//$bt.=msqbt('',nod('public_atomic'));
return $bt.div(atd($rid).atc('panel small'),$ret);}

?>