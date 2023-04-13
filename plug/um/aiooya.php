<?php 

class aiooya{

static function door_aiooya($x,$ra,$rb){
if($x==array_intersect($ra,$rb))return 'yes'; else return 'no';}

static function door_and($a,$b){if($a && $b)return 1; else return 0;}
static function door_or($a,$b){if($a or $b)return 1; else return 0;}
static function door_nand($a,$b){if(!$a or !$b)return 1; else return 0;}
static function door_nor($a,$b){if(!$a && !$b)return 1; else return 0;}
static function door_xor($a,$b){if(($a && !$b) or (!$a && $b))return 1; else return 0;}
static function door_xnor($a,$b){if((!$a && !$b) or ($a && $b))return 1; else return 0;}

static function pattern_intersect($ra,$rb,$door){$n=count($ra);
for($i=0;$i<$n;$i++)if($door($ra[$i],$rb[$i]))return 1;}

static function pattern_diff($ra,$rb,$door){$n=count($ra);
for($i=0;$i<$n;$i++)if($door($ra[$i],$rb[$i]))return 0;}

static function build($p,$o){
//$r=msql::read('',nod('umnum'),$p);
$ra=[1,1,1,1,0,0,1];
$rb=[0,0,0,1,1,1,0];
$ra=['blue','red','green'];
$rb=['blue','black','green'];
//$ret=self::door_aiooya(1,$ra,$rb);
//intersection de tableaux
$res1=array_intersect($ra,$rb);//renvoie $ra
//diff�rence entre des tableaux
$res2=array_diff($ra,$rb);//renvoie []
//diff�rence entre le r�sultat et la question
$ret=array_diff($ra,$res1);//renoie []
return tabler($ret);}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function r(){
return ['aa'=>'a','bb'=>'b'];}

static function menu($p,$o,$rid){
$ret=select_j('inp','pclass','aiooya','r','','2');
//$ret.=togbub('aiooya','r',btn('popbt','select...'));
$ret=input('inp',$p).' ';
$ret.=lj('',$rid.'_aiooya,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
//$bt.=msqbt('',nod('aiooya'));
return $bt.divd($rid,$ret);}
}
?>