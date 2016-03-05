<?php
//philum_plugin_msqtemplate

function conform_order($r,$rb){
foreach($rb as $k=>$v){$ret[$k]=$r[$k];}
return $ret;}

function msqt_build_from_template($nod,$tmp){req('pop,tri');
list($dr,$nod)=split_right('/',$nod,0); if(!$dr)$dr='users';
$r=read_vars('msql/'.$dr.'/',$nod,''); $mnu=$r['_menus_']; unset($r['_menus_']);
//$rb=array_keys_r($r,0); asort($rb); $r=conform_order($r,$rb);
if($r)foreach($r as $k=>$v){$tpl=$tmp;
	if(is_array($v)){$n=count($v)-1;
	for($i=$n;$i>=0;$i--){
		if($v[$i])$tpl=str_replace(array('_'.$i,'_'.$mnu[$i]),$v[$i],$tpl);
		else $tpl=str_replace(array('_'.$i,'_'.$mnu[$i]),'',$tpl);}}
	else $tpl=str_replace(array('_0','_'.$mnu),$v,$tpl);
	$tpl=str_replace('_key',$k,$tpl);
	$ret.=correct_txt($tpl,"",'codeline');}
return format_txt_r($ret,'','');}

function msqt_read($nod,$p){
$r=read_vars('msql/users/',$nod,'');
if(isset($r['_menus_'])){$mnu=$r['_menus_']; unset($r['_menus_']);}
if(substr($p,0,1)=='x')$p=substr($p,1); else $o='x';
$rb=array_keys_r($r,$p); if($o)arsort($rb); else asort($rb); $r=conform_order($r,$rb);
foreach($mnu as $k=>$v){$pb=ajx($o.$v,0);
	$tts[]=lj('','msqt_plug___msqtemplate_msqt*read_'.ajx($nod,0).'_'.$o.$k,$v);}
foreach($r as $k=>$v){
	if($v)foreach($v as $ka=>$va){
		if($mnu[$ka]=='date')$va=date('d/m/Y',$va);
	$r[$k][$ka]=$va;}}
array_unshift($r,$tts);
return make_table($r,'txtred','txtx');}

function plug_msqtemplate($nod,$tmp){
//require_once('plug/msqads.php');
$ret=lj('txtbox','msqt_plug___msqtemplate_plug*msqtemplate_'.ajx($nod).'_'.ajx($tmp),picto('reload')).br();
if($tmp){$tpl=msql_read('users',$_SESSION['qb'].'_template',$tmp);
	if(!$tpl)$tpl=msql_read('users','public_template',$tmp);
	$ret.=msqt_build_from_template($nod,$tpl);}
elseif($nod)$ret.=msqt_read($nod,0);
return divd('msqt',stripslashes($ret));}

?>