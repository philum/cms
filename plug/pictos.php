<?php
//philum_plugin_pictos

function pictos_see($id){
$r=explore('imgb/icons/svg/noun'); asort($r);
foreach($r as $k=>$v){$im=svg('/noun/'.substr($v,0,-4).'�24').' ';
	$ret.=ljb('popbt','jumpvalue',$id.'_noun/'.$v,$im).' ';}
return divd('scroll',$ret);}

function pictos_edit($k){//echo $k;
$d=msql_read('system','program_pictos',$k); 
$ret=btn('txtsmall',$k).' '.input(1,'edit'.$k.'" size="30',$d);
$ret.=lj('txtbox','ico'.$k.'_plug__x_pictos_pictos*save_'.$k.'__edit'.$k,'save').' ';
$ret.=lj('txtyl','ico'.$k.'_plug__x_pictos_pictos*save_'.$k,'del').br().br();
//$ret.=sesmk('pictos_see','edit'.$k,0);
return popup('edit_picto',$ret);}

function pictos_save($k,$d,$res){
$file=ajxg(trim($res)); $r=array($file);
$r=msql_modif('system','program_pictos',$r,'','one',$k);
$_SESSION['icons'][$k]=$file;
return ico($file);}

function pictos_refresh($k,$d,$res){
$_SESSION['icons']=msql_read('system','program_pictos','');
$_SESSION['picto']=msql_read('system','edition_pictos','');
return ico($file);}

function plug_pictos($d,$id){$rid='bld'.randid();
$ret=lj('popbt',$rid.'_plug___pictos_pictos*refresh',picto('reload')).' ';
$ret.=hlpbt('pictos').' '.msqlink('system','program_pictos').br();
$r=msql_read('system','program_pictos','',1);
foreach($r as $k=>$v){list($p,$c)=split(':',$v);
	if($c=='icon')$ico=icon($p,$k); elseif(is_numeric($c))$ico=icosys($p,$c);
	elseif($c=='svg')$ico=svg($p); else $ico='';
	$edit=lj('popbt','popup_plug___pictos_pictos*edit_'.$k,$k).' ';
	$rb[]=div('',picto($k,24).' '.$edit.btd('ico'.$k,$ico));}
$ret.=onxcols($rb,4,680);
return divd($rid,$ret);}

?>