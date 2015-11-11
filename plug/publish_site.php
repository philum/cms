<?php
//philum_plugin_publish_software_updates
session_start();
error_reporting(6135);
//require_once('params/_connectx.php');
//require_once('progb/lib.php');

/*function tar(){include("tar/pclerror.lib.php");
include("tar/pcltrace.lib.php"); include("tar/pcltar.lib.php");}*/

function batch_dsgtables(){$d='msql/design/public_';//nb_of public_designs
for($i=1;$i<5;$i++){$ret[]=$d.'design_'.$i.'.php'; $ret[]=$d.'clrset_'.$i.'.php';
	$ret[]='css/public_design_'.$i.'.css';}
return $ret;}

function dirs(){$msqu='msql/users/public_';
$ra=array("index.php","ajax.php","plug.php","htaccess.txt","favicon.ico","install.php","readme.txt","robots.txt","user.ini",
$msqu.'defcons.php',$msqu.'connectors.php',$msqu.'modules.php',$msqu.'design.php',$msqu.'template.php',$msqu.'mods_1.php','msql/system','msql/lang',
'css/_global.css','css/_admin.css','css/_classic.css','css/_default.css',
'fla','imgb/icons/system','imgb/icons/flags','imgb/icons/finder','plug','prog','progb','pub','video',
'js/colorpicker','js/live.js','js/jquery.js',
'params/_connectx.php.txt',
'fonts/philum.woff','fonts/philum.eot','fonts/philum.svg','fonts/philum.ttf',);
//'bkg',,'avatar','fonts','css','video','gallery','gdf','.htaccess'
$rb=batch_dsgtables();
$ret=array_merge($ra,$rb); //p($ret);
return $ret;}

function copyif($f,$d){
if(is_file($f)){$fz=filesize($f); $ft=filemtime($f);}//else return false;
if(is_file($d)){$dz=filesize($d); $dt=filemtime($d);}
if($_SESSION['auth']<6)return 'need_auth';
//if($f=='plug/distribution.php')return 'illogical';
if(!$fz)return 'permission_error';
if(($dz!=$fz or $ft>$dt) && $fz){$ok=copy($f,$d); 
	if($ok)$c='_ok'; else $c='_error';
	if($dz!=$fz && $dz && $fz)return btn('txtyl','modified'.$c).'::';
	elseif($dz && $fz)return btn('txtyl','copied'.$c).'::';}
if(!$dz)return btn('txtyl','created'.$c).'::';}

function valid_ext($xt){
if($xt=='php' or $xt=='.js' or $xt=='swf' 
or $xt=='jpg' or $xt=='gif' or $xt=='png'
or $xt=='css' or $xt=='txt' or $xt=='ico')
//or $xt=='.gz' //or $xt=='off' or $xt=='eot' or $xt=='svg'
return true;}

function funcb($j,$k,$v,$io){$xt=substr($v?$v:$j,-3);
if(valid_ext($xt) or (strpos($j,'imgb/icons')!==false && $xt=='.gz')){
if((substr($j,0,1)!='_' && substr($v,0,1)!='_' && substr($v,-8,4)!='_sav' && strpos($j,'_notes/')===false) or $v=='_admin.css' or $v=='_global.css' or $v=='_default.css'){
$dir='_public/'.$j;
if(!is_dir($dir))mkdir_r($dir);
$f=$j; $fb=$dir; if($v){$f.='/'.$v; $fb.='/'.$v;}
$t=copyif($f,$fb);
echo $t.$fb.br();}}}

function funcc($j,$k,$v,$io){$xt=substr($v?$v:$j,-3);
if(valid_ext($xt) or ($j=='imgb/icons' && $xt=='.gz')){
$f=$j; $d=str_replace('_public/','',$j);
if($v){$f.='/'.$v; $d.='/'.$v;} 
if(is_file($f))$fz=filesize($f);//_public
if(is_file($d))$dz=filesize($d);
if($fz && !$dz){unlink($f); $t=btn('txtyl','deleted').'::';}
if($t)echo $t.$f.br();}}

function funcd($j,$k,$v,$io){$xt=substr($v?$v:$j,-3); //echo $v.br();
if($xt=='jpg' or $xt=='gif' or $xt=='png'){
$f=$j; $d=str_replace('_public/','',$j);
if($v){$f.='/'.$v; $d.='/'.$v;}
if(is_file($f) && is_file($d)){$dz=filemtime($d); $fz=filemtime($f);//_public
if($fz!=$dz)return 1;}}}

function tardir($v){//imgb/icons//avatar//bkg
list($dr,$dn)=split_right('/',$v,1);
$lk='_public/'.$v.'.tar.gz'; 
$r=walk_dir(''.$v,'funcd');
if($r)$sum=array_sum($r);
if($sum){PclTarCreate($lk,''.$v); echo lkc('txtyl',$lk,$lk.'modified').br();}
else echo 'lk='.$lk.br();}

function tardir_r($d){$r=explore(''.$d.'/','dirs');
if($r)foreach($r as $k=>$v){if(substr($k,0,1)!='_' && !is_numeric($v)){$rf=''; 
//$lk='_public/'.$d.'/'.$k.'.tar.gz'; $f=''.$d.'/'.$k; PclTarCreate($lk,$f);
tardir($d.'/'.$k);}}}//echo lka($lk,$f).br();

function update_msql(){$nm=date('ymd',time());$nmb=date('ym',time());//mensuel/quotidien
modif_vars('system','program_version',array($nm),1);
$exs=msql_read('system','program_updates_'.$nmb,'');
$r=array(date('md',time()),'publication'); $dfb['_menus_']=array('date','text');
if(!$exs)msql_modif('system','program_updates_'.$nmb,$r,$dfb,'push','');
$r=array('updates-table','ajax','popup','msql___system_program_updates*'.$nmb,'','menu','sys','server','','7');//menus
//modif_vars('system','default_apps_desk',$r,27);
}

function plug_publish_site(){$r=dirs(); //p($r);
if($_SESSION['auth']<6)return 'no';
if(!is_dir('_public'))mkdir('_public');
echo divc('panel','this will backup program files in public directory to let users upgrade Philum from this server - '.lka('/plug/_zip_prog.php?createzip=','tar.gz'));
echo update_msql();
echo plugin('coreflush').br();
echo plugin('philumsize').br();
foreach($r as $k=>$v){$xt=substr($v,-3);
	if($xt=='php' or $xt=='css' or $xt=='txt' or $xt=='.js' or strpos($v,'philum')){
		//$pos=strrpos($v,'/'); $j=substr($v,0,$pos); $va=substr($v,$pos+1);
		list($j,$va)=split_one('/',$v,1);
		funcb($j,$k,$va,'');
		funcc('_public/'.$j,$k,$va,'');}//del old
	//elseif($v=='avatar' or $v=='bkg')tardir($v);
	//elseif($v=='imgb/icons')tardir_r($v);
	else walk_dir(''.$v,'funcb');
	walk_dir('_public/'.$v,'funcc');}
}

?>