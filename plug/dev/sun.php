<?php 
class sun{

static function sunstim($d){
for($i=0;$i<12;$i+=2)$r[]=substr($d,$i,2);
return $r;}

static function build($p,$o){$ret=$p.'-'.$o;
if($p)$t=strtotime($p); else $t=time(); $d=date('ymdHis',$t); 
$r=sunstim($d); [$dy,$dm,$dd,$dh,$di,$ds]=$r; //p($r);
$posx=($dh*(100/24)).'%'; if($dm>6)$dm=(12-$dm); $posy=($dm*(90/6)).'%';
$ret=divs('position:absolute; width:20px; height:20px; border-radius:20px; box-shadow:0 0 4px silver; left:'.$posx.'; top:'.$posy.'; background:orange; border:1px solid white;','');
return divs('width:100%; height:auto; background:linear-gradient(to bottom, blue, pink) no-repeat fixed 0 0;',$ret);}//

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p?$p:mkday('','ymdHis'),'').' ';
$ret.=lj('',$rid.'_sun,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid); $ret=self::::call($p,$o);
//$bt.=msqbt('',ses('qb').'_sun');
return $bt.divd($rid,$ret);}
}
?>