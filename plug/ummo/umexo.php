<?php
//philum_plugin_umexo

//function verbose($r){echo implode(br(),$r).hr();}
/*function hexrgb_r($d){
for($i=0;$i<3;$i++)$r[]=hexdec(substr($d,$i*2,2)); return $r;}*/
function volume($n){return bcdiv(4,3)*M_PI*bcpow($n,3);}
function sqrt_b($v,$n){return pow((float)$v,bcdiv(1,$n));}
function ray_of_volume($n){return pow((float)(3*$n)/(4*M_PI),1/3);}
function ray_of_volume_b($n){$a=bcmul($n,3); $b=bcmul(M_PI,4);
$c=bcdiv($a,$b); return sqrt_b($c,3);} //verbose([$n,$a,$b,$c,$d,$e]);
function ray_of_volume2($n){return pow(((float)$n/M_PI)*3/4,1/3);}//((V/p)(3/4))^1/3
function ray_of_volume2_b($n){$a=bcdiv((float)$n,M_PI); $b=bcdiv(3,4);
$c=bcmul($a,$b); $d=bcdiv(1,3); return bcpow($c,$d);}

//
//IMOO : R(n) = 16,79*(3^(n-1))^(1/3) ; N =< 2^n 
//WOAM : R(n) = 13,36*(Pi^(n-1))^(1/3); N >= 2^n ?

function umx_manu_draw($out,$r,$b){
$w=800; $h=300; $mx=$my=40; $im=imagecreate($w+$mx,$h+$my);
list($white,$black,$red,$green,$blue,$yellow)=imgclr_pack($im);
$font=imageloadfont('gdf/Fixedsys.gdf');
ImageFilledRectangle($im,0,0,$w,$h,$white);
//foreach($r as $k=>$v)
$max1=max($r['imoo']); $max2=max($r['woam']); $max=$max1>$max2?$max1:$max2; $ratiox=$w/$max;
$n=count($r['imoo']); $ratioy=$h/$n;
//$rc=umx_clr($r['imoo']); $rc=array_reverse($rc); //pr($rc);
//verbose([$max,$n,$w,$ratio]);
$n=count($r['imoo']); $xab='';
for($i=0;$i<$n;$i++){$nb=$i*$b;
	//mise � l'�chelle
	//echo $r['imoo'][$i].'-';
	$xa=round($r['imoo'][$i]*$ratiox)+$mx;
	$xb=round($r['woam'][$i]*$ratiox)+$mx;
	$ya=round($i*$ratioy,2);
	$yb=round($i*$ratioy,2);
	$stock[$i]=[$xa,$ya,$xb,$yb];
	//echo $xa.'-';
	imagefilledellipse($im,$xa,$h-$ya,2,2,$red);//imoo
	//imagestring($im,1,$xa-2,$h-$ya+2,$i,$black);//nb
	imagefilledellipse($im,$xb,$h-$yb,2,2,$black);//woam
	//imagestring($im,1,$xb,$h-$yb+4,round($r['imoo'][$i]),$black);
	//x=nb
	imagestring($im,1,$xb,$h-$yb+4,round($r['woam'][$i]),$black);
		imageline($im,$mx-6,$h-$ya,$mx,$h-$ya,$black);
	if(substr($i,-1)=='0' or substr($i,-1)=='5')
		imagestring($im,2,7,$h-$ya-7,$nb,$black);
	//y=al
	if(substr($xa,0,-1)!=substr($xab,0,1)){
		imageline($im,$xa,$h,$xa,$h+6,$black);
		//imagestring($im,2,$xa,$h+12,round($r['imoo'][$i]),$black);
		imagestring($im,2,$xa,$h+12,round($r['imoo'][$i]),$red);
	}
	$xab=$xa;}
//p($stock);
imageline($im,$mx,0,$mx,$h,$black);//x
imagestring($im,$font,$mx-22,2,'nb',$black);
imageline($im,$mx,$h-1,$w+$mx,$h-1,$black);//y
imagestring($im,$font,$w-24,$h+4,'al',$black);
//imagefilledellipse($im,$ctr,$ctr,10,10,$white);
//imageellipse($im,$ctr,$ctr,10,10,$black);
imagepng($im,$out);
return image('/'.$out.'?'.randid());}

//draw
function umx_clr($r){$ra=['2387d5','2387d5','85b933','85b933','8a50c8','8a50c8','f2c627','f2c627','e11419','e11419'];
foreach($r as $k=>$v){
	$clr=isset($ra[$k])?$ra[$k]:dechex(round($v*16000000)); 
	//if($k/2==round($k/2))$clr=$clr;
	$ret[$k]=hexrgb_r($clr);}
return $ret;}

function umx_dots($im,$a,$b,$n,$ctr,$white,$black){
for($i=0;$i<$n;$i++){$ray=rand($a,$b)/2; $ang=deg2rad(rand(0,360));
	$x=$ctr+cos($ang)*$ray; $y=$ctr+sin($ang)*$ray;
	//verbose([$ray,$ang,$x,$y]);
	imagefilledellipse($im,$x,$y,10,10,$white);
	imageellipse($im,$x,$y,10,10,$black);}}

/*function imgclr($im,$d,$a=''){$r=hexrgb_r($d);
if($a)return imagecolorallocatealpha($im,$r[0],$r[1],$r[2],$a);
else return imagecolorallocate($im,$r[0],$r[1],$r[2]);}*/

/*function imgclr_pack($im){$r=['white'=>'ffffff','black'=>'000000','red'=>'ff0000','green'=>'00ff00','blue'=>'0000ff','yellow'=>'ffff00'];
foreach($r as $k=>$v)$ret[]=imgclr($im,$v);
return $ret;}*/

//umx_draw('_datas/umexo.png',$r,'600');
function umx_draw($out,$r,$rk,$w){$h=$w; $im=imagecreate($w,$h); //p($r);
list($white,$black,$red,$green,$blue,$yellow)=imgclr_pack($im);
$whit5=imagecolorallocatealpha($im,0,0,0,30); //imagecolortransparent($im,$white); 
$font=imageloadfont('gdf/Fixedsys.gdf');
ImageFilledRectangle($im,0,0,$w,$h,$white);
$max=max($r); $n=count($r); $ratio=$w/$max; $ctr=$w/2;
$rb=umx_clr($r); $rb=array_reverse($rb); $ta=''; $vald=0;//pr($rb); //pr($r);
//verbose([$max,$n,$w,$ratio]);
foreach($r as $k=>$v){
	$val=ceil($v*$ratio)-1; $vlb=$val/2;//mise � l'�chelle
	$bis=$rk[$k]==$ta?1:0; $ta=$rk[$k]; $t=$ta.' '.$v;//titres
	if(!$bis)umx_dots($im,$vald,$val,$ta,$ctr,$white,$black);//plan�tes
	if($bis)$alpha=20; else $alpha=40;
	$clr=imagecolorallocatealpha($im,$rb[$k][0],$rb[$k][1],$rb[$k][2],$alpha);
	//verbose([$v,$max,$val,$ctr,$x,$y]);
	imagefilledellipse($im,$ctr,$ctr,$val,$val,$clr);
	imageellipse($im,$ctr,$ctr,$val,$val,$black);
	if($bis)$cl=$red; else $cl=$yellow;
	ImageFilledRectangle($im,$ctr-5,$ctr-$vlb+2,$ctr+5,$ctr-$vlb,$cl);
	imagestring($im,$font,$ctr-5,$ctr-$vlb,$t,$black);
	if(!$bis)$vald=$val;}
imagefilledellipse($im,$ctr,$ctr,10,10,$white);
imageellipse($im,$ctr,$ctr,10,10,$black);
imagepng($im,$out);
return image('/'.$out.'?'.randid());}

//
function umx_algo_manu($p,$b,$out){//echo $p;
$ra[]=['volume unitaire','IMOO','WOAM'];
for($i=0;$i<100;$i++){
	//((3^(n-1))*(16,76^3))^(1/3)
	/*$r['imoo'][$i]=pow(pow(3,$i-1)*pow(16.79,3),1/3);
	$r['woam'][$i]=pow(pow(M_PI,$i-1)*pow(13.36,3),1/3);*/
	//IMOO : R(n) = 16,79*(3^(n-1))^(1/3) ; N =< 2^n 
	$r['imoo'][$i]=pow(16.79*pow(3,$i-1),1/3);
	$r['woam'][$i]=pow(13.36*pow(M_PI,$i-1),1/3);
	$ra[]=[$i,$r['imoo'][$i],$r['woam'][$i]];
	if($r['imoo'][$i]>$p)$i=100;
	//if($r['imoo'][$i]>$p)
	//echo $r['imoo'][$i].' ';
	}
//p($r['imoo']);
$ret=tabler($ra,1);
$ret.=umx_manu_draw($out,$r,$b);
return $ret;}

//p=rayon en al, o=nb mondes
function umx_algo($p,$b,$m){$ret=[];
if($m=='imoo'){$al=16.79; $mu=3;}
if($m=='woam'){$al=13.36; $mu=M_PI;}
$unit=round(bcdiv($p,$al)); $n=$unit;
$volume_unitaire=volume($al);
$al_estimated=ray_of_volume_b($volume_unitaire);//test
//verbose([$volume_unitaire,$volume_espace,$ratio,$unit]);
$ret[]=['unit','nb','volume','al','sub'];
/*//sph�re bleue
$blue=round($volume_unitaire)/3;
$ret[]=[0,0,round($blue),round(ray_of_volume_b($blue),2),''];*/
$a=1; $ret[]=[$a,$b,round($volume_unitaire),round($al_estimated,2),''];
for($i=1;$i<=$n;$i++){
	$a=bcmul($a,$mu);//unit
	$bb=bcmul($b,2); $ba=$bb-$b; $b=$bb;//stars
	$volume=$volume_unitaire*$a;
	//$al_estimated=ray_of_volume_b($volume);
	$al_estimated=ray_of_volume2($volume);
	//if(!$al_estimated)return $ret;
	$ret[]=[(int)$b,round($a,4),round($volume),round($al_estimated,2),$ba];
	if($al_estimated>$p)$i=$n;}
return $ret;}

//call
function umexo_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); req('spe'); bcscale(20);
$ra=umx_algo($p,$o,'imoo');
$rb=umx_algo($p,$o,'woam');
$rh=['nb stars','unit','volume','al','sub'];
unset($ra[0]);unset($rb[0]); 
for($i=1;$i<=count($ra);$i++){
	$r[]=$rb[$i][3]; $r[]=$ra[$i][3];
	$rk[]=$ra[$i][0]; $rk[]=$ra[$i][0];}
rsort($r); rsort($rk); //pr($r);
$ret=btn('txtcadr','WAAM IMOO').' '.tabler($ra,$rh);
$ret.=btn('txtcadr','WAAM WOAM').' '.tabler($rb,$rh);
//if(auth(6))return $ret;
//$ret=divc('right',$ret);
$f='_datas/umexo'.$p.$o.'.png';
$ret.=umx_draw($f,$r,$rk,600).br().br();
$f='_datas/umexo_graph'.$p.$o.'.png';
$ret.=umx_algo_manu($p,$o,$f);
return $ret;}

//load
function plug_umexo($p,$o){req('spe');
$rid='plg'.randid(); $p=$p?$p:60; $o=$o?$o:1;
$ret='ray (LY) '.input1('umx',$p,'');
$ret.=hidden('','umo',1); //$ret.=input1('umo',$o,'').' exoplanets ';
//$ret.=lj('',$rid.'_plug__2_umexo_umexo*j_1_1_umx|umo',picto('no'));
$ret.=lj('',$rid.'_plug__2_umexo_umexo*j_1_1_umx|umo',picto('ok'));
$ret.=divc('txtcadr','algo: pow(16.79*pow(3,$n),1/3) ; pow(13.36*pow(M_PI,$n),1/3)');
//req('pop'); $pub=popim('http://oumo.fr/img/ummo_1327_314705.jpg',picto('img'));
$pub=popart(1327,'O6-133');
return $ret.divd($rid,umexo_j($p,$o)).$pub.br();}

?>