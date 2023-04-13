<?php //spisvg
class spisvg{
static $max=118;
static $unit=40;
static $mode='radial';

static function js($n=1,$o=''){//self::patch();
$j='spt_spisvg,call__2';
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

function spiatom(id,n){
	getbyid(id).value=n;
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

function coloriz2(n){
if(n==1||n==2)return coloriz(n); var r=atoms_clr(n);
for(i=1;i<=120;i++)window["id"+i].style.fill=r[i];}

function anim(n){n++; x=setTimeout(function(){play(n)},500);}
function play(n=0,p){
	if(n==0 && typeof x=="number"){clearTimeout(x); n=120; x="";}
	SaveJ("spt_spisvg,call__2_"+n+"_"+p);
	if(n<120)anim(n);}
';}

static function css(){$ret='rect:hover{box-shadow:0px 0px 4px #aaa;}';
//for($i=1;$i<=self::$max;$i++)$ret.='#id'.$i.':hover{background:rgba(255,255,255,0.4);}'."\n";
return $ret;}

static $clr=['Nonmetals'=>'5FA92E','Nobles Gasses'=>'00D0F9','Alkali Metals'=>'FF0008','Alkali Earth Metals'=>'FF00FF','Metalloids'=>'1672B1','Halogens'=>'F6E617','Metals'=>'999999','Transactinides'=>'FF9900','Lanthanides'=>'666698','Actinides'=>'9D6568','undefined'=>'ffffff'];

static $origin_clr=[1=>'ff0000',2=>'ff2222',3=>'ff4444',4=>'ff6666',5=>'ff8888',6=>'ffaaaa',7=>'ffcccc',8=>'ffeeee'];
static $origin_names=[1=>'Big Bang',2=>'cosmic ray collisions',3=>'dying low-mass stars',4=>'dying high-mass stars',5=>'white dwarf supernovae',6=>'merging neutron stars',7=>'radioactive decay',8=>'human-made'];
static $rc=[];//legends

static function legend($o){$rt=[]; $bt='';
if($o==5 or $o==6 or $o==8 or $o==9 or $o==10)$r=self::$rc;
elseif($o==12)$r=array_combine(self::$origin_names,self::$rc);//self::$origin_clr
elseif($o==2){$r=self::clr2(); $r=array_keys(array_flip($r));}
else $r=self::$clr;
$s='display:inline-block; color:black; padding:4px; border:1px solid black;';
foreach($r as $k=>$v)$rt[]=bts('background:#'.$v.'; '.$s,$k);
if($o==5 or $o==6)$bt='C°'; elseif($o==8)$bt='g/L'; elseif($o==9)$bt='g/Mol';
elseif($o==10)$bt='isotopes'; elseif($o==2)$bt='positions'; elseif($o==12)$bt='origin';
if($bt)$rt[]=bts('background:#ffffff; '.$s,$bt);
return divb(join('',$rt));}

//atom
static function atompos($ring,$sub,$pos,$i,$v,$o){
$u=self::$unit;//unit
[$mode,$clr]=expl('-',$o);
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
$rdy=[1=>0,2=>0,3=>0,4=>0,5=>7,6=>7,7=>7,8=>7,9=>7];
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
$t1='[spt_spisvg;call__2_'.$i.'_'.$o.'§['.($x+$mg).','.($y+$mg2).','.$sz.'px§'.$i.':text]:lj]';
$t2='[popup_spitable;infos___'.$i.'§['.($x+$mg).','.($y+$h-$mg2).','.$sz.'px§'.$v.':text]:lj]';}
else{$w=$u*2; $h=$u;
$t1='[spt_spisvg;call__2_'.$i.'_'.$o.'§['.($x+$mg).','.($y+$mg2).','.$sz.'px§'.$i.':text]:lj]';
$t2='[popup_spitable;infos___'.$i.'§['.($x+$w/2+6).','.($y+$mg2).','.$sz.'px§'.$v.':text]:lj]';;
//$t2='[popup_spitable;infos___'.$i.'§['.($x+$w/2+6).','.($y+$mg2).','.$sz.'§'.$v.':text]:bubj]';
}
//$ret='[popup_svg;call§[20,20§'.$t2.':text]:lj]';
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
[$name,$sym,$fam,$layer,$level]=arr($r,5);
$ra=explode('-','-'.$layer);
$max=val($ra,$ring); $rx[$ring][]=1;//count elemenrs in rings
return count($rx[$ring])<=$max?0:1;}

static function atom($r,$i,$p,$o,$rc){
[$name,$sym,$fam,$layer,$level]=arr(val($r,$i),5); //echo $name.'-'.$sym.'-'.$fam.'-'.$level.br();
[$ring,$subring,$pos]=self::findpos($level,$i); //echo $ring.'-'.$subring.'-'.$pos.br();
[$x,$y,$w,$h,$t]=self::atompos($ring,$subring,$pos,$i,$sym,$o); //echo $x.'-'.$y.'-'.$w.'-'.$h;
$clr=self::$clr[$fam]??'ffffff'; if($rc)$clr=$rc[$i];
$hide=$i<=$p?0:1; $hide=self::active(val($r,$p),$ring);//anomalies
$bdr=$p==$i?'white':($hide?'gray':'black'); $sz=$p==$i?'2':'1'; $alpha=$hide?'0.2':'1';
$atr='[#'.$clr.','.$bdr.','.$sz.',,'.$alpha.':attr]';
$rect='['.$x.','.$y.','.$w.','.$h.',,id'.$i.',bt:rect]';
return $atr.$rect.$t;}

//clrs
static function combine_clr($a,$b){
$ra=hexrgb_r($a); $rb=hexrgb_r($b); $rt=[];
for($i=0;$i<3;$i++)$rt[]=dechex(hexdec($ra[$i])+hexdec($rb[$i]));
return rgb2hex($rt);}

static function clr4(){$rt=[];
$r=msql::col('','public_atomic_5',1);
$rc=self::$origin_clr;
foreach($r as $k=>$v){
if(strpos($v,'/')){[$a,$b]=expl('/',$v); 
$c=round(($a+$b)/2);
//$rt[]=self::combine_clr($rc[$a],$rc[$b]);
$rt[]=str_pad('ff',6,$c);}
else $rt[]=$rc[$v];} //p($rt);
return $rt;}

static function build_clr($v,$min,$ratio,$ratio1,$ratio2){
if(!is_numeric($v)){$red=127; $green=127; $blue=127;}
elseif($min<0){
	if($v>=0){$d=round($v*$ratio1); $red=255; $green=$d; $blue=$green;}
	else{$d=0-round($v*$ratio2); $red=255-$d; $green=$red; $blue=255;}}
elseif($min>=0){$d=round(($v-$min)*$ratio); $red=255; $green=255-$d; $blue=$green;}
return rgb2hex([$red,$green,$blue]);}

static function build_hsl($v,$ratio,$l=360){
if(!is_numeric($v))$h=0; else $h=round($v*$ratio);
return rgb2hex(hsl2rgb($l-$h,50,50));}

static function clr3($r,$col){
$ra=array_keys_r($r,$col); $min=0; $max=0; $rb=[]; $rc=[]; $ratio=1; $ratio1=1; $ratio2=1;
foreach($ra as $k=>$v){$v=str_replace(',','.',$v);
	if($v=='N/A' or $v=='---')$v='-';
	elseif(strpos($v,'@')!==false)$v=substr($v,0,strpos($v,'@'));
	elseif(strpos($v,'±')!==false)$v=substr($v,0,strpos($v,'±'));
	elseif(strpos($v,' ')!==false)$v=substr($v,0,strpos($v,' '));
	elseif(strpos($v,'/')!==false)$v=substr($v,0,strpos($v,'/'));
	if(intval($v)<$min)$min=$v; if(intval($v)>$max)$max=$v; $ra[$k]=$v;}//pr($ra);
//$min=min($ra); $max=max($ra); 
$diff=$max-($min); $ratio=255/$diff; $ratio1=255/$max; if($min)$ratio2=255/(0-$min);//rgb
//$diff=$max-($min); $ratio=360/$diff; $ratio1=360/$max; if($min)$ratio2=360/(0-$min);//hsl
foreach($ra as $k=>$v)
	//$rb[$k]=self::build_clr($v,$min,$ratio,$ratio1,$ratio2);
	$rb[$k]=self::build_hsl($v,$ratio,255);
$n=20; if($n>$diff)$n=$diff; $sec=round($diff/$n);
for($i=1;$i<=$n;$i++){$k=round($min+($sec*$i));
	//$clr=self::build_clr($k,$min,$ratio,$ratio1,$ratio2);
	$clr=self::build_hsl($k,$ratio,255);
	self::$rc[$k]=$clr;}
return $rb;}

static function clr2(){
return msql::col('','public_atomic_3',4);
//$r=msql::read_b('','public_atomic_3','',1);
return array_keys_r($r,4);}

static function patch(){
$r=msql::read_b('','public_atomic_2','',1); $rb=self::$clr;
$rh=['Nom','Symbole','Famille','Couche','Niveau orbital','Fusion','Ebulition (C°)','Découverte','Masse','Masse atomique (u)','Isotopes','Numéro atomique','clr','pos','free','deg','clr2'];
foreach($r as $k=>$v)$r[$k][12]=$rb[$v[2]];
msql::save('','public_atomic_2',$r,$rh);}

//build
static function build($p,$o){//$o=0;
$r=msql::read('','public_atomic_1','',1);
[$mode,$clr]=expl('-',$o);
$u=self::$unit;//unit
if($mode=='linear'){$u=self::$unit=30; $w=49*$u; $h=10*$u;}
else{$mode='radial'; $u=self::$unit=40; $w=25*$u; $h=17*$u;}//w/h
$max=self::$max; //p($r[$p]);
if($clr==1)$rc=[];//self::$clr;
elseif($clr==2)$rc=self::clr2(); //p($rc);
//elseif($clr==12)$rc=self::clr4($r);
elseif($clr)$rc=self::clr3($r,$clr);
else $rc=[];
//if($clr && $clr!=1)$p=120;
for($i=1;$i<=$max;$i++)$rb[]=self::atom($r,$i,$p,$o,$rc);
$ret='[white,black,1:attr][0,0,'.$w.','.$h.':rect]';
$ret=implode("\n",$rb);
if($ret)$ret=svg::home($ret,$w.'/'.$h);
$bt=self::nav($p,$o,'spt');
//if($clr && $clr!=1)$bt='';
$bt.=self::legend($clr);
return $bt.$ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o); if($p>self::$max)$p=self::$max;
return self::build($p,$o);}

static function menu($p,$o,$rid){$mx=self::$max;
//$ret=bar('barsvg',$p,$step=1,$min=1,$mx,$js='spiatom','236px').br();
$j=$rid.'_spisvg,call_inpsvg,inpmod_2__'.$o;
//$ret=inputj('inpsvg',$p,$j,'',4,[],'number');
$ret=inputb('inpsvg',$p,4,'number','',['onchange'=>sj($j)]);
$ret.=lj('',$j,picto('ok')).' ';
$ret.=lj('popbt','spt_spisvg,call_inpsvg_2_118_radial','radial');
$ret.=lj('popbt','spt_spisvg,call_inpsvg_2_118_linear','linear'); $ret.='|';
$rm=[1=>'clr1',2=>'clr2',5=>'fusion',6=>'ebulition',8=>'mass',9=>'atomic mass',10=>'isotopes',12=>'origin'];
foreach($rm as $k=>$v)$ret.=lj('popbt','spt_spisvg,call__2_'.$mx.'_'.$o.'-'.$k,$v); $ret.='|';
//foreach($rm as $k=>$v)$ret.=btj($v,'coloriz2('.$k.')','txtx');
$ret.=btn('txtx','Davy@2021');
$ret.=hlpbt('spitable');
$ret.=msqbt('','public_atomic_1');
$ret.=lk('/app/spt',picto('organigram'));
return $ret;}

static function nav($p,$o,$rid){$ret='';
//$ret.=bar('barsvg',$p,$step=1,$min=1,self::$max,$js='spiatom','236px');
$js1=atmp(atjr('jumpvalue',['inpsvg',$p-1]));
$js2=atmp(atjr('jumpvalue',['inpsvg',$p+1]));
if($p>0)$ret.=lj('',$rid.'_spisvg,call__2_'.($p-1).'_'.$o,picto('before'),$js1).' ';
else $ret.=btn('grey',picto('before'));
if($p<self::$max)$ret.=lj('',$rid.'_spisvg,call__2_'.($p+1).'_'.$o,picto('after'),$js2).' ';
else $ret.=btn('grey',picto('after'));
$ret.=hidden('inpmod',$o);
return $ret;}

static function home($p,$o){$rid='spt';
$p=$p?$p:self::$max; //$o=1;
Head::add('csscode',self::css());
Head::add('jscode',self::js($p,$o));
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divb($ret,'small',$rid);}
}
?>