<?php //arraydiff

class arraydiff{
static function diff($ra,$rb,$n){$ret['banned']=[]; $ret['added']=[]; $n=$n-1;
if($ra)foreach($ra as $v)if(!in_array_r($rb,$v[$n],$n))$ret['banned'][]=$v;
if($rb)foreach($rb as $v)if(!in_array_r($ra,$v[$n],$n))$ret['added'][]=$v;
return $ret;}

static function build($p,$o,$n=1){
if(!$p or !$o)return;
$ra=msql::read('',$p,'',1);
$rb=msql::read('',$o,'',1);
$r=self::diff($ra,$rb,$n);
$ret=divc('txtit','added: '.count($r['added']));
$ret.=tabler($r['added']);
$ret.=divc('txtit','removed: '.count($r['banned']));
$ret.=tabler($r['banned']);
return $ret;}

static function call($p,$o,$res=''){
[$p,$o,$n]=ajxr($res);
$ret=self::build($p,$o,$n);
return $ret;}

static function menu($p,$o,$rid){
$ret=input1('inp1',$p?$p:'table 1').' '.input('inp2',$o?$o:'table 2').' '.input('inp3',1,atz(2)).' ';
$ret.=lj('',$rid.'_arraydiff,call__2_____inp1|inp2|inp3',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}

?>