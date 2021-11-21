<?php
//philum_app_captdatas

class captdatas{

static function capture($p){}

static function build($p,$o){
req('msql'); $key=nohttp(domain($p));
$r=msql::col('',nod('captdatas'),$key,0,1); //p($r);
$d=get_file($p); if(!$r)return 'no';
if(empty($r['end']))$rec=html_detect($d,$r['start']);
else $rec=embed_detect($d,$r['start'],$r['end']);
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

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){$ret=input('inp',$p).' '.input('ino',$p).' ';
$ret.=lj('',$rid.'_app__3_captdatas_call___inp|ino',picto('ok')).' ';
//$cols='ib,val,to';//create table, name cols
//$ret.=lj('','popup_plupin___msqedit_captdatas*1_'.$cols,picto('edit')).' ';
$ret.=msqbt('',nod('captdatas'));
return $ret;}

static function install($b){
ses($b,qd($b));//name of table
//1=drop table on change $r !
$r=['tit'=>'var','txt'=>'text','day'=>'int'];
mysql::install($b,$r,0);}

static function home($p,$o){
$rid=randid('captdatas'); $ret='';
//self::install('captdatas');
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}

}

function plug_captdatas($p,$o){
return captdatas::home($p,$o);}

?>