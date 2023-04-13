<?php //uban

class uban{
static $dr='users/ummo/banners';

static function build($p,$o){
[$a,$b]=expl('-',$p); $rid='ub';
$r=scandir_b(self::$dr); //pr($r);
$ima='/'.self::$dr.'/'.$r[$a];
$imb='/'.self::$dr.'/'.$r[$b];
$rt=divb(img($ima),'','im1','position:absolute;');
if(!$o)$rt.=divb(img($imb),'','im2','position:absolute;');
//$ret=divc('txtcadr',$r[$a].'/'.$r[$b]);
$ret=lj('',$rid.'_uban,call__2_'.$a.'-'.$b.'_'.($o?0:1),picto($o?'arrow-down':'arrow-top'));
$ret.=div('',$rt);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::menu($p,$o);
$ret.=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid=''){$ret=''; $rt=[]; $rid='ub';
[$a,$b]=expl('-',$p);
$r=scandir_b(self::$dr);//pr($r);
foreach($r as $k=>$v){$t=strprm(strto($v,'.'),2,'_');
	$rt[1][]=$ret=lj(active($k,$a),$rid.'_uban,call__2_'.$k.'-'.$b.'_'.$o,$t).' ';
	$rt[2][]=$ret=lj(active($k,$b),$rid.'_uban,call__2_'.$a.'-'.$k.'_'.$o,$t).' ';}
return divc('nbp',impl($rt[1])).divc('nbp',impl($rt[2]));
return $ret;}

static function home($p,$o){
$rid='ub'; $p=$p?$p:'2-3';
$ret=self::menu($p,$o,$rid);
$ret.=self::build($p,$o);
return divd($rid,$ret);}
}
?>