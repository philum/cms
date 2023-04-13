<?php 
class panart{

static function bigim($id){
$ims=sql('img','qda','v','id='.$id); $r=explode('/',$ims); 
if($r)foreach($r as $v)if(is_file('img/'.$v)){
	[$w,$h]=getimagesize('img/'.$v); $rb[$w]=$v;}
if($rb){krsort($rb); return current($rb);}}

static function pa_pane($id){
$imgs=sql('img','qda','v','id='.$id);
$im=pop::art_img($imgs,$id); $suj=ma::suj_of_id($id);//spe
return divs('background:url(/img/'.$im.') center; background-size:cover; height:180px;',divs('position:relative; background:rgba(0,0,0,0.4); color:rgba(255,255,255,0.8); font-shadow:1px 1px 2px rgba(0,0,0,0.8); font-size:22px; top:50%;',$suj));}

static function build($p,$o){
if(strpos($p,' '))$r=array_flip(explode(' ',$p));
elseif(is_numeric($p))$r[$p]=1;
else $r=api::mod($p);
foreach($r as $k=>$v)$ret.=pa_pane($k);
return $ret;}

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$ret=self::build($p,$o);
return $ret;}

static function menu($p,$o,$rid){
$ret.=input('inp',$p,'').' ';
$ret.=lj('',$rid.'_panart,call_inp',picto('ok')).' ';
return $ret;}

static function home($p,$o){$rid='plg'.randid();
$bt=self::menu($p,$o,$rid);
$ret=self::build($p,$o);
return $bt.divd($rid,$ret);}
}
?>