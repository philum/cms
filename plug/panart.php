<?php
//philum_plugin_panart

function bigim($id){
$ims=sql('img','qda','v','id='.$id); $r=explode('/',$ims); 
if($r)foreach($r as $v)if(is_file('img/'.$v)){
	list($w,$h)=getimagesize('img/'.$v); $rb[$w]=$v;}
if($rb){krsort($rb); return current($rb);}}

function pane_art($id){
$im=best_img(sql('img','qda','v','id='.$id)); $suj=suj_of_id($id);//spe
return divs('background:url(/img/'.$im.') center; background-size:cover; height:180px;',divs('position:relative; background:rgba(0,0,0,0.4); color:rgba(255,255,255,0.8); font-shadow:1px 1px 2px rgba(0,0,0,0.8); font-size:22px; top:50%;',$suj));}

function panart_build($p,$o){req('api,spe');
if(strpos($p,' '))$r=array_flip(explode(' ',$p));
elseif(is_numeric($p))$r[$p]=1;
else $r=api_mod($p);
foreach($r as $k=>$v)$ret.=pane_art($k);
return $ret;}

function panart_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=panart_build($p,$o);
return $ret;}

function panart_menu($p,$o,$rid){
$ret.=input(1,'inp',$p,'').' ';
$ret.=lj('',$rid.'_plug__2_panart_panart*j___inp',picto('reload')).' ';
return $ret;}

function plug_panart($p,$o){$rid='plg'.randid();
$bt=panart_menu($p,$o,$rid);
$ret=panart_build($p,$o);
return $bt.divd($rid,$ret);}

?>