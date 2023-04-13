<?php 
class captdatas{

static function capture($p){}

static function build($p,$o){
$key=nohttp(domain($p));
$r=msql::col('',nod('captdatas'),$key,0,1); //p($r);
$d=get_file($p); if(!$r)return 'no';
if(empty($r['end']))$rec=html_detect($d,$r['start']);
else $rec=between($d,$r['start'],$r['end']);
$reb=conv::call($rec); //echo $reb;
$pos=strpos($reb,'[');//ici la clef est le premier élément du tableau 2D
if($pos!==false){$ka=trim(substr($reb,0,$pos)); $reb=substr($reb,$pos);}
//$reb=codeline::parse($reb,'striplink','correct');
$reb=codeline::parse($reb,'','delconn'); //echo $reb;
//$rb=inject_defs('',$reb);
$rb=explode_r($reb,'¬','|'); //pr($rb);
if($r)foreach($rb as $k=>$v)if(isset($v[1]))$rc[$v[0]]=$v[1]; //echo $o;
$rd=msql::modif('',nod('captdatas_'.$o),array_values($rc),'one',array_keys($rc),$ka); //pr($rd);
$ret=$reb;
return $ret;}

static function call($p,$o,$prm=[}){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' '.input('ino',$p).' ';
$ret.=lj('',$rid.'_captdatas,call_inp,ino_3',picto('ok')).' ';
$ret.=msqbt('',nod('captdatas'));
return $ret;}

static function install($b){
ses($b,qd($b));//name of table
//1=drop table on change $r !
$r=['tit'=>'var','txt'=>'text','day'=>'int'];
sqlop::install($b,$r,0);}

static function home($p,$o){
$rid=randid('captdatas'); $ret='';
//self::install('captdatas');
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>