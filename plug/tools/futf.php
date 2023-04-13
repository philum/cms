<?php 
class futf{

static function conv($dr,$k,$v){$f=$dr.'/'.$v;
file_put_contents($f,utf8enc(file_get_contents($f)));
return $f;}

static function renove($dr,$k,$v){
$v=str_replace('.php','',$v);
[$b,$d,$p,$t,$v]=msqa::murlread($v);
//
$nod=msqa::mnod($p,$t,$v);
$f=msql::url($d,$nod); if(is_file($f))//echo $d.';'.$p.';'.$t.';'.$v.' ';
msqa::tools($d,$nod,'repair_enc','');
return $nod;}

static function call($p,$o,$prm=[]){$r=[];
[$p,$o]=prmp($prm,$p,$o); //echo $p;
$r=scanwalk($p,'futf::renove');
return implode(' ',$r);}

static function menu($p){
$ret=inputb('fto',$p,18,'directory');
$ret.=lj('popbt','fut_futf,call_fto_',picto('ok'));
return $ret;}

static function home($p){
$bt=self::menu($p); $ret='';
if($p)$ret=self::call($p);
return $bt.divd('fut',$ret);}
}
?>