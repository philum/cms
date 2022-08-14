<?php //phi
//http://www.piday.org/million/
class pi{
static $conn=1;
//$pi4=1-1/3+1/5-1/7+1/9-1/11...
static function pi1($n){
static $pi4; if(!$pi4)$pi4=1;
static $i; $i+=2;
static $o; $o=$o?0:1;
//$current=1/(1+$i);
$current=bcdiv(1,1+$i,99);
if($o)$pi4-=$current; else $pi4+=$current;
//if($o)echo $pi4.'+'.$current.br(); else echo $pi4.'-'.$current.br();
if($i<$n)return self::pi1($n); else return $pi4;}

static function home($p){
bcscale(20);//nb after comma
//$pi=msql::val('','public_pi',1); $pi=substr($pi,0,$p);
//$math=bcdiv(bcadd(bcsqrt(5),1),2);//phi
$pi4=self::pi1($p?$p:40000);
$ret=$pi4*4;
return $ret;}
}
?>