<?php
//philum_plugin_superpoll
session_start();
error_reporting(6135);//E_ALL/E_NOTICE/NULL/2147483647/30719/6135
if(!is_dir('plug'))$jc='../';
if(!function_exists('p'))require($jc.'progb/lib.php');
$_SESSION['dayx']=time();
$root=define_s('root',$_SERVER['PHP_SELF']);
define(root,$root);

function spp_verif($r,$d){
foreach($r as $k=>$v){if($v[0]==$d)return true;}}

function spp_sav($var1,$var2,$res){
$nod=$_SESSION['sppnod'];
$r=msql_read('users',$nod,'');
$rb=explode('_',$res); $nb=count($rb);
for($i=0;$i<$nb;$i++){$rb[$i]=ajx($rb[$i],1);}
if(spp_verif($r,$rb[0])!=true){if(count($r)==1)$r[1]=$rb; else $r[]=$rb;
	if($rb[0])write_file('msql/users/'.$nod.'.php',dump($r,$nod));
	return btn('txtred','saved');}
else return btn('txtred','already_exists');}

function spp_verifuser($k,$p){
$jc=$_GET['plug']?'plug/':''; $f=$jc.'data/'.$_SESSION['sppnod'].'.txt';
$t=read_file($f); $ip=hostname(); $r=explode('#',$t);
foreach($r as $i=>$v){
	list($ipa,$ka,$pa)=explode('/',$v);
	if($ipa==$ip && $ka==$k){
		if($pa!=$p){$ta.='#'.$ip.'/'.$k.'/'.$p; $ok='change';}
		else{$ta.='#'.$v; $ok='no';}} 
	elseif($v)$ta.='#'.$v;}
$t=$ta;
if(!$ok){$t.='#'.$ip.'/'.$k.'/'.$p; write_file($f,$t);}
elseif($ok=='change')write_file($f,$t);
elseif($ok=='no')return true;}

function spp_poll($k,$p){
$nod=$_SESSION['sppnod'];
$r=msql_read('users',$nod,'');
if($p==1)$r[$k][1]+=1; else $r[$k][1]-=1;
if($k && !spp_verifuser($k,$p))write_file('msql/users/'.$nod.'.php',dump($r,$nod));
return $r[$k][1];}

function spp_read($k){
$r=msql_read('',$_SESSION['sppnod'],$k); //p($r);
unset($r['projet']); unset($r['poll']);
return on2cols($r,500,5);}

function spp_del($d){
modif_vars('users/',$_SESSION['sppnod'],$d,'del');
return btn('txtred',$k.' deleted');}

function spp_table(){$dfb['_menus_']=array('projet','poll');
$r=plug_motor('msql/users/',$_SESSION['sppnod'],$dfb); unset($r['_menus_']); //p($r);
if($r){$ra=array_keys_r($r,1); arsort($ra);
foreach($ra as $k=>$v){
$bt=ljb('txtbox','SaveJb','ob'.$k.'_plug___superpoll_spp*poll_'.$k.'_0\',\'res_plug___superpoll_spp*table','-').' ';
$bt.=btn('txtred" id="ob'.$k,($r[$k][1]?$r[$k][1]:0));
$bt.=ljb('txtbox','SaveJb','ob'.$k.'_plug___superpoll_spp*poll_'.$k.'_1\',\'res_plug___superpoll_spp*table','+').' ';
if($_SESSION['auth']>4)$bt.=ljb('txtbox','SaveJb','res_plug___superpoll_spp*del_'.$k.'\',\'res_plug___superpoll_spp*table','x').' ';
$ret.=divc('txtcadr',divc('imgr',$bt).$r[$k][0]);}}
return divd('res',$ret);}

function spp_add($r){
$ret.=txarea('p1','',40,1);
$ret.=ljb('txtbox','SaveJb','add_plug__xd_superpoll_spp*sav___p1\',\'res_plug___superpoll_spp*table','save').' ';
$ret.=ljb('txtyl','SaveJ','add_plug','x').br().br();//icon('close')
return $ret;}

function plug_superpoll($d){
$_SESSION['sppnod']='public_superpoll_'.($d?$d:1);
$ret=divd('popup" style="position:fixed; width:0; height:0;',"");
$ret.=lj('','add_plug___superpoll_spp*add',icon('add'));
$ret.=divd('add','');
$ret.=spp_table();
$ret.=ljb('txtx','SaveJ','res_plug___source_plug*source_superpoll','source');
$ret.=msqlink('','public_superpoll_1');
$ret.=lkc('txtx','microxml.php?table=users/public_superpoll_1','xml');
return $ret;}

?>