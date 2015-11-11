<?php
//philum_plugin_favs
session_start();

/*function favs_edt_b($id){if($_SESSION['favs'][$id])$c='color:#428a4a;';
return lj('','popup_modpop___favs:plug',picto('like',$c));}*/

function fav_sav($d){//id
$bs='msql/users/'; $nod=$_SESSION['qb'].'_fav'; req('art');
$r=plug_motor($bs,$_SESSION['qb'].'_fav',''); //p($r);
$_SESSION['favs']=array_flip(explode(' ',$r[$_SESSION['iq']][0]));
if(strpos($r[$_SESSION['iq']][0],$d)===false){
	$r[$_SESSION['iq']][0].=$d.' '; $_SESSION['favs'][$d]=1;}
write_file($bs.$nod.'.php',dump($r,$nod));
return favs_edt($d);}

function fav_del($d){$nod=$_SESSION['qb'].'_fav';
$r=plug_motor('msql/users/',$nod,'');
$da=$r[$_SESSION['iq']][0];
$da=str_replace(array(' '.$d,$d.' ',$d),'',$da); if($d=='all')$da='';
$r[$_SESSION['iq']][0]=$da; unset($_SESSION['favs'][$d]);
write_file('msql/users/'.$nod.'.php',dump($r,$nod));
return fav_read($da);}

/*function fav_book(){$nod=$_SESSION['qb'].'_fav';
$n=msq_find_last('users',$_SESSION['qb'],'fav');
msq_copy('users',$nod,'users',$nod.'_'.$n);
return btn('txtalert',$nod.'_'.$n.' created').' '.msqlink('',$_SESSION['qb'].'_fav_'.$n);}*/

function fav_log(){
$ret.=lj('txtx','popup_plupin__x_favs____favid',picto('logout'));
$ret.=input1('favid',ses('iq'),'4').hlpbt('flog');
return $ret;}

function fav_export(){
$d=msql_read('users',$_SESSION['qb'].'_fav',$_SESSION['iq']);
return popup('export',txarea('',$d,60,4));}

function fav_read($d){
req('pop,art,spe,tri');
$r=explode(' ',trim($d));
if($r)foreach($r as $v){
	$del=lj('','plgfavs_plug___favs_fav*del_'.$v,picto('sclose')).' ';//'(x)'
	$_SESSION['plgs']=$del;
	//if($v)$li.=balc('li','',$del.lkc('',htac('read').$v,suj_of_id($v)));
	//if($v)$arts.=$del.lj('txtcadr','popup_popart__3_'.$v.'_3',suj_of_id($v)).br();
	if($v)$arts.=art_read_d($v,'','1','fastart');}
if($arts){$ret=lj('txtx','plgfavs_plug___favs_fav*read_'.$d,picto('reload')).' ';
	$ret.=lj('txtx','popup_plup___favs_fav*read*content',picto('view')).' ';
	//$ret.=lj('txtx','plgfavs_plug___favs_fav*del_all',picto('no')).' ';
	$ret.=lj('txtx','popup_plup__3_book__'.$d.'_640',picto('export')).' ';
	if($_SESSION['USE']){//$ret.=lj('txtx','plgfavs_plug___favs_fav*export','book').' ';
		$ret.=lj('txtx','popup_plug___favs_fav*export',picto('txt')).' ';
		$ret.=msqlink('',$_SESSION['qb'].'_fav').' ';}}
$ret.=br().br(); $_SESSION['plgs']='';
return $ret.$arts;}

function fav_read_content(){req('spe,art,tri,pop,mod');
$da=msql_read('',$_SESSION['qb'].'_fav',$_SESSION['iq']);
$load=array_flip(explode(' ',$da));
$ret=output_pages($load,2,'');
return $ret;}

function plug_favs($p,$o,$ob='',$res=''){$res=ajxg($res); connect();
if($res)if(!is_numeric($res))$_SESSION['iq']=sql('id','qdp','v','ip="'.ses(ip).'" LIMIT 1'); 
else $_SESSION['iq']=$res;
//$_SESSION['plgs']=btd('pgbt_ID',lj('" title="'.nms(108),'pgbt_ID_plug__xd_favs_fav*sav__ID',picto('like')));//plgfavs
if($iq=$_SESSION['iq'])$v=msql_read('',ses('qb').'_fav',$iq);
if($v)$ret.=fav_read($v); else $ret.=divc('track',helps('favs'));
return fav_log().divd('plgfavs',$ret);}

?>