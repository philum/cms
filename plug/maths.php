<?php
//philum_plugin_maths_trigo 

function bar($d){return '<img src="../bkg/shadow/_blk75.png" width="20" height="'.$d.'" />';}

function histo($r){$n=count($r);
for($i=0;$i<$n;$i++){$ret.=bar($r[$i]);}
return $ret;}

function batch_g($r,$func){$n=count($r);
for($i=0;$i<$n;$i++){$ret[$i]=call_user_func($func,$r[$i]);}
return $ret;}

function powr($n){return pow($n,2);}
function sqrt_b($v,$n){return pow((float)$v,bcdiv(1,$n,99));}
function hypothenuse($ca,$co){return sqrt(powr($ca)+powr($co));}
function pytha_cote($hy,$c){return sqrt(powr($hy)-powr($c));}
function cercle_longueur($rayon){return M_PI*($rayon*2);}
function cercle_surface($diametre){return (M_PI/4)*powr($diametre);}
function sphere_surface($diametre){return M_PI*powr($diametre);}
function sphere_volume($diametre){return (pi()/6)*pow($diametre,3);}
function volume_rayon($n){return bcdiv(4,3,99)*M_PI*bcpow($n,3,99);}
//longueur d'une hélice //long,nb_spires,diam,haut
function helice($l,$n,$d,$h){return sqrt(powr($l)+powr($n)+powr($d)+powr($h));}
function radian($angle){return deg2rad($angle);}
function sinus($angle){return sin(radian($angle));}
function cosinus($angle){return cos(radian($angle));}
function tangente($angle){return tan(radian($angle));}
function degres($radian){return rad2deg($radian);}
function arcsin($angle){return degres(asin($angle));}
function arccos($angle){return degres(acos($angle));}
function arctan($angle){return degres(atan($angle));}
function sin_rect($co,$hy){return $co/$hy;}//sinus = coté opposé / hypoténuse
function cos_rect($ca,$hy){return $ca/$hy;}//cosinus = coté adjacent / hypoténuse
function tan_rect($co,$ca){return $co/$ca;}//tangente = coté opposé / coté adjacent
function cotan_rect($co,$ca){return $ca/$co;}//cotangente = inverse de tangente

function funcs(){return array(0=>powr,1=>hypothenuse,2=>pytha_cote,3=>cercle_longueur,4=>cercle_surface,5=>sphere_surface,6=>sphere_volume,7=>helice,8=>sinus,9=>cosinus,10=>tangeante,11=>sin_rect,12=>cos_rect,13=>tan_rect,14=>cotan_rect);}

function tri_rect_angle($r){//adj/opp/hyp //renvoie angle en degrès
if(!$r[0])return arcsin(sin_rect($r[1],$r[2]));
if(!$r[1])return arccos(cos_rect($r[0],$r[2]));
if(!$r[2])return arctan(tan_rect($r[1],$r[0]));}

function triangle_rectangle($r){//adj/opp/hyp //renvoie la longueur manquante
$angle=tri_rect_angle($r);
if(!$r[0])$r[0]=$r[2]*cosinus($angle);
if(!$r[1])$r[1]=$r[2]*sinus($angle);
if(!$r[2])$r[2]=$r[0]/cosinus($angle);
return $r;}

function tri_rect_pythagore($r){//adj/opp/hyp //renvoie la longueur manquante
if(!$r[0])$r[0]=pytha_cote($r[2],$r[1]);
if(!$r[1])$r[1]=pytha_cote($r[2],$r[0]);
if(!$r[2])$r[2]=hypothenuse($r[0],$r[1]);
return $r;}

//

function tests(){
$r=array(1,2,3,4,5,6,7,8,9,10);
$funcs=funcs();
//echo $funcs[1];
//echo hypothenuse(1,2);
//$ret=batch_g($r,$funcs[3]);
//$ret=batch_g($r,$funcs[5]);
//p($ret);
//echo call_user_func_array($funcs[3],array(1));
echo histo(call_user_func_array("batch",array($r,$funcs[4])));
//echo arcsin(sinus(30));
//echo rad2deg(asin(0.5));
//echo tri_rect_angle(array("",4,5));
//echo tri_rect_angle(array(3,"",5));
//echo tri_rect_angle(array(3,4,""));
//$ret=triangle_rectangle(array("",4,5));
//$ret=triangle_rectangle(array(3,"",5));
//$ret=triangle_rectangle(array(3,4,"")); 
//$ret=tri_rect_pythagore(array("",4,5));
//$ret=tri_rect_pythagore(array(3,"",5));
//$ret=tri_rect_pythagore(array(3,4,"")); 
$ret=tri_rect_pythagore(array("",1,2));
//p($ret);
//echo powr($ret[0]);
}

//tests();


?>