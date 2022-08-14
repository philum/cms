<?php //phi
class phi{
static $conn=1;
static function calcul($float){static $i; $i++;
if($i==$float)return 1;
//return 1+1/phi();
return bcadd(1,bcdiv(1,self::calcul($float)));}

static function fibo(){$a=1; $b=1; $max=100;
for($i=1;$i<$max;$i++){
$c=bcadd($a,$b); $ret=bcdiv($c,$b); $a=$b; $b=$c;}
return $ret;}

static function home($d){$float=$d?$d:1000;
bcscale($float); 
//$ret=(sqrt(5)+1)/2;
//$math=bcdiv(bcadd(bcsqrt(5),1),2);
$phi=self::calcul($float);
//$fibo=self::fibo();
//$comp=bccomp($phi,$fibo);
//$ret=$math.br().$phi.br().$fibo.br().$comp;
return $phi;}
}
?>