<?php
//philum_plugin_distribution
//this is the same page on client and father_servers
//donut change anything
session_start();
error_reporting(6135);
ini_set('display_errors','1');

$_SESSION['sdir']=!is_dir("plug")?"../":"";
if($_GET["distant"] && !is_dir($_SESSION['sdir'].'_public'))$sd="../";
$cnx='params/_connectx.php';
if(is_file($cnx))require($cnx); elseif(is_file('../'.$cnx))require('../'.$cnx);
else require('../../'.$cnx);
require($sd.$_SESSION['sdir'].'plug/lib.php');

function mkdir_rb($d){$r=explode("/",$d);
foreach($r as $k=>$v){if(strpos($v,'.')===false)$dir.=$v.'/'; $di=substr($dir,0,-1); $i++;
	if(!is_dir($di) && $i<10)mkdir($di);}
return $ret;}

function name_of_files(){//1=_sys,2=php,3=no_php
$dr=$_SESSION['sdir'].$_SESSION['dest']; $drb=str_replace('../','',$dr);
//if(!is_dir($dr) && $dr){mkdir($dr);}
$authorized=array("app","progb","prog","msql","plug","js","gallery","fla","gdf","bkg","css","imgb/icons","fonts");//,"avatar"
if(!in_array($_SESSION['dest'],$authorized))return;
if($drb=='imgb/icons' or $drb=='bkg' or $drb=='avatar')
	$rep=scrut_files_only($dr); else $rep=scrut_dirb($dr);
if($rep)$re=explode_dird($rep,$dr); 
if($re){ksort($re);
foreach($re as $k=>$v){
$f=str_replace($dr.'/',"",$k); $ra=explode('/',$k); $xt=substr($f,-3);
	if($f && substr($f,-8,4)!="_sav" && !is_dir($k) && strpos($k,".")!==false
	&& ((substr($f,0,1)!="_" && $dr!="css") or $f=="_admin.css" or $f=="_global.css" or $f=="_classic.css" or $f=="_default.css") 
	&& (strpos($k,"msql/users")===false or strpos($k,"msql/users/public")!==false) 
	&& (strpos($k,"msql/design")===false or strpos($k,"msql/design/public")!==false) 
	&& strpos($k,"msql/cache")===false && strpos($k,"msql/clients")===false 
	&& strpos($k,"msql/gallery")===false && strpos($k,"msql/radio")===false 
	&& strpos($k,"msql/stats")===false && strpos($k,"msql/server")===false 
	&& strpos($k,"plug/_data")===false && strpos($k,"plug/img")===false 
	&& strpos($k,"plug/imgb")===false && strpos($k,"gallery/cache")===false 
	&& strpos($k,"gallery/mini")===false && strpos($f,"_notes")===false 
	&& (strpos($k,"b/icons")===false or (strpos($k=="b/icons")==false && $xt=='.gz'))
	&& (strpos($k,"bkg")===false or (strpos($k,"bkg")!==false && $xt=='.gz'))
	&& (strpos($k,"avatar")===false or (strpos($k,"avatar")!==false && $xt=='.gz'))
	&& (strpos($k,"fonts")===false or strpos($k,"philum")!==false or strpos($k,"microsys4")!==false)
	&& strpos($k,"userdl.tar.gz")===false && strpos($k,"<")===false){$ret[$f]=2;}}}
//p($ret); exit();
return $ret;}

/*---------------------*/#server

function verif_version(){
require('../msql/system/program_version.php'); return $r[1][0];}

function give_maj_servermtime(){$r=name_of_files();//sourcedir
foreach($r as $k=>$v){if($k)$ret.=$k.'::'.filemtime('../'.$_SESSION['dest'].'/'.$k).';';}
return $ret;}

function distribution($p){
$ret="\n".'//philum_'.$p.' from '.maj_server()."\n";
$sql='SELECT name,func FROM _sys WHERE page="'.$p.'"';//day="'.$v.'" AND 
$req=mysql_query($sql);
if($req)while($data=mysql_fetch_array($req)){$ret.=$data["func"]."\n\n";}
return $ret;}

function give_page(){
return scrut_txt_b('../'.$_SESSION['dest'].'/'.$_GET["page"]);}

function give_gz(){
$t=scrut_txt_b('../'.$_SESSION['dest'].'/'.$_GET["gz"]);
if($_GET["b64"])return base64_encode($t);
else return bzcompress($t);}

function calltar(){
include_once($_SESSION['sdir'].'plug/tar/pclerror.lib.php');
include_once($_SESSION['sdir'].'plug/tar/pcltrace.lib.php');
include_once($_SESSION['sdir'].'plug/tar/pcltar.lib.php');}

/*function give_tar_x(){calltar();
$r=explode(';',$_GET["getzip"]);
foreach($r as $k=>$v){$rb[]='../'.$v;}
PclTarCreate('userdl.tar.gz',$rb,'','','');
return scrut_txt_b('userdl.tar.gz');}*/

function give_tar(){$f='userdl.tar.gz'; calltar(); require('tar.php');
$r=explode(';',$_GET['getzip']);
foreach($r as $k=>$v){$v='../'.$v;
	if(is_file($v))$ret[]=$v; elseif(is_dir($v))$ret=read_dir($v);}//print_r($ret);	
PclTarCreate($f,$ret,'','',''); //echo $f; //$f=targz('userdl.tar',$r); 
return scrut_txt_b($f);}

function scrut_dir_files($dr){
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
		if($f!='..' && $f!='.' && $f){
			if(is_dir($drb))scrut_dir_files($drb);
			else echo $drb.';';}}}
return $ret;}

/*---------------------*/#client

function maj_server(){return philum();}

function distime($f){
$f=maj_server().'/plug/microsql.php?fdate='.$f;
$d=read_file($f); return date('ymdhi',$d);}

function maj_index($t){$f='../_public/'.$t.'.php';
if($_GET["updroot"]==$t){$rot='/_public/plug/distribution.php?gz=../';
	$fc=read_file(maj_server().$rot.''.$t.'.php&b64=='); 
	write_file(''.$t.'.php',base64_decode($fc));}
$upc=ftime($t.'.php','ymdhi'); $dpc=distime($f);
if($upc<$dpc)$ret=lkc("txtyl",'/?admin=update&updroot='.$t,'update_'.$t).' ';
else $ret=btn('txtbox',$t.': ok').' ';
$ret.=btn('small','local:'.$upc.', distant:'.$dpc);
return $ret.br().br();}

function maj_picto_ty($t){$f='/_public/fonts/'.$t.'.tar.gz'; calltar();
if($_GET['upload']=='pictos'){$ra=array('woff','eot','svg','ttf');
	foreach($ra as $k=>$v){unlink('fonts/'.$t.'.'.$v);}
	PclTarExtract(maj_server().$f,'/','','');}
$upc=filemtime('fonts/'.$t.'.woff'); $upcb=date('d/m/y h:i',$upc);
$upd=read_file(maj_server().'/plug/microsql.php?fdate=../fonts/'.$t.'.woff'); 
$updb=date('d/m/y h:i',$upd);
if($upd>$upc)$dl='download'; else $dl='ok';
return array($t,$upcb,$updb,lkc('txtbox','/?admin=update&upload=pictos',$dl));}

function maj_pictos(){
$arr[]=array('pictos','local','distant','update');
$arr[]=maj_picto_ty('philum');
$arr[]=maj_picto_ty('microsys4');
return make_table($arr,'txtred','txtx').br();}

function maj_fonts(){$dr='fonts/'; $updt=$_GET["update"]; calltar();
$go='/?admin=update&update==&upload=';//&dest=fonts
$r=msql_read('system','edition_typos','',1); 
$favs=lka('/?admin=update&update=1&upload='.$v[0],'favs'); 
$arr[]=array('dir','fonts (woff, eot, svg)','category','accents',$favs,'update');
foreach($r as $k=>$v){
	if(!is_file($dr.$v[0].'.woff')){
		if($_GET["upload"]==$v[0] or $updt=="all" or $updt==$v[3])
				PclTarExtract(maj_server().'/_public/fonts/'.$v[0].'.tar.gz','/','','');
		$dl=lkc('txtbox',$go.$v[0],'download');}
	else $dl='ok';
	$arr[]=array($dr,$v[0],$v[1],$v[2],$v[3],$dl);}
return make_table($arr,'txtred','txtx').br();}

//http://philum.net/_public/plug/distribution.php?filedate=prog&distant==&dest=prog
//http://philum.net/_public/plug/distribution.php?gz=_admin.css&distant==&dest=css
//http://philum.net/_public/plug/distribution.php?page=_admin.css&distant==&dest=css
function require_distant($type,$load){
$t='/_public/plug/distribution.php?';
if(!function_exists('bzdecompress'))$b64='&b64==';
$f=maj_server().$t.$type.'='.$load.'&distant=='.$b64;
if($type!="datapage")$f.='&dest='.$_SESSION['dest'];
if(substr($load,-3)==".gz")return implode("",gzfile($f));
return $ret=scrut_txt_b($f);}

function verif_maj(){
$ret=require_distant("version","=");
if($ret>$_SESSION["philum"])return $ret;//'new version: '.
else return $ret;}

function create_empty_file($d){
	write_file($d.'/empty.txt','used for initialization of new dir');}

function recup_maj_servermtime($d){
$d=require_distant("filedate",$d); $r=explode(";",$d);
if($r)foreach($r as $k=>$v){list($file,$day)=split("::",$v); $ret[$file]=$day; 
	$dir=substr($file,0,strrpos($file,'/')); 
	if($dir && substr($dir,0,1)!='<')$rep[$dir]=$_SESSION['dest'];}
if($rep)foreach($rep as $k=>$v){
	if(!is_dir($v.'/'.$k)){mkdir_rb($v.'/'.$k); create_empty_file($v.'/'.$k);}}
return $ret;}

/*function maj_page($p,$d,$f){//p=page//literal
mkdir_rb($f); $t=require_distant($p,$d);
if(substr($f,-4)==".php")$t='<'.'?php'.$t.'?'.'>';
if(strpos($t,"<b>Warning</b>")!==false) return btn("txtyl","error!").' ';
elseif(!is_dir($f))return write_file($f,$t);}*/

function maj_tar($d){calltar();
$f=maj_server().'/'.$d;
$t=read_file($f); write_file($d,$t);
PclTarExtract($d,'/','','');}

function maj_page_gz($p,$d,$f){$t=require_distant($p,$d);//mkdir_rb($f);
if(strpos($t,"failed to open stream")===false){//$_SESSION['dlnb']++;
	if(function_exists('bzdecompress'))$t=bzdecompress($t);//,true
	else $t=base64_decode($t);
if(!is_dir($f))return write_file($f,$t);}}

function find_new_files($r,$d){
foreach($d as $k=>$v)if(!$r[$k] && $k)$ret[$k]=$v; return $ret;}

function maj_system($t){$r=name_of_files();
if(!is_dir($t))mkdir($t);
$dates=recup_maj_servermtime($t);
$diff=find_new_files($r,$dates);
if($r && $diff)$r+=$diff; else if($diff)$r=$diff;//p($r);
$ret[]=array('root','file','size','local','distant','action');
if($r)foreach($r as $k=>$v){$i++; $maj=''; $xt=substr($k,-3);
	$goto='?admin=update&update==&upload='.$k;
	if($v==1){$p="datapage"; $file=$k.'.php';}//from_sql
	else{$p="gz"; $file=$k;}//$p="page";
	$f=$t.'/'.$file;
	if($_GET["upload"]==$k && $_GET["delete"] && $_SESSION['auth']>6){
		if(is_dir($f))rmdir($f); else unlink($f); relod('/?admin=update#'.$i);}
	elseif($_GET["upload"]==$k or $_GET["update"]=="all"){//dl
		if($xt=='.gz')$maj=maj_tar($f); else $maj=maj_page_gz($p,$k,$f);}
	if(file_exists($f)){$localf=filemtime($f); $flz=filesize($f)/1000;}
	else $localf=$flz="";
	$distantf=$dates[$k];
	if($localf)$info1=date("d/m/Y h:i",$localf); else $info1='not_exists';
	if($distantf)$info2=date("d/m/Y h:i",$distantf); else $info2='not_exists';//obsolete
	if($_SESSION['auth']>=6 && !$maj){// && $_GET["admin"]
		$goup=($k=='distribution.php'?'?admin=update&updater==':$goto);
		if($localf && !$distantf && !is_dir($f)){//no
			if(strpos($f,'/users')===false && strpos($f,'/design')===false 
				&& $_SESSION['auth']>6){if($_GET["update"]=="del")unlink($f);
				$maj=lien_b('txtbox',$goto.'&delete==','delete');}}
		elseif((!$localf or $localf<$distantf) && $distantf){
			if($_GET["update"]!='=')$_SESSION['dlnb']++;
			if($_GET["update"]=="program")$_SESSION['tarf'][]=$f;
			if($k=='distribution.php')$_SESSION['updfirst']=1;
			if($_GET["upload"]=='distribution.php')$_SESSION['updfirst']='';
			$maj=lien_b("txtbox",$goup,"download"); $getzip.=$f.';';}
		elseif($distantf)$maj=lien_b('" title="force_download',$goup,"ok");}
		if($flz==0)$flz=btn('txtyl','error!'); $dz='<a name="'.$i.'"></a>';
		$ps=strrpos($f,'/'); $fa=substr($f,0,$ps); $fb=substr($f,$ps+1); 
	if($localf or $distantf)$ret[]=array($dz.$fa,$fb,round($flz,2),$info1,$info2,$maj);}
if($_GET["update"]=='program' && $_SESSION['fnb']<7){
	$_SESSION['fnb']+=1; $_SESSION['dest']=$_SESSION['folders'][$_SESSION['fnb']]; 
	$ret=maj_system($_SESSION['dest']);}//echo $_SESSION['dest'].': ok'.'<br>';
else return make_table($ret,'txtbox','').'<br>';}

////////////

//define_s("dest","distrib/prog");
$_SESSION['dest']=$_GET["dest"]?$_GET["dest"]:$_SESSION['dest'];
$_SESSION['dest']=$_SESSION['dest']?$_SESSION['dest']:"prog";
$_SESSION['updfirst']='';

#server
if($_GET["version"])$ret=verif_version();
if($_GET["filedate"]){$_SESSION['dest']=$_GET["filedate"]; $ret=give_maj_servermtime();}
if($_GET["datapage"]){$ret=distribution($_GET["datapage"]);}
if($_GET["page"]){$ret=give_page();}//sourcedir
if($_GET["gz"]){$ret=give_gz();}
if($_GET["datapage"] or $_GET["page"]){
	//if($_GET["b64"])$ret=base64_encode($ret);
	$ret=str_replace(array('<'.'?php','?'.'>'),"",$ret);}
if($_GET["dir"])scrut_dir_files('../'.$_GET["dir"]);//_public/
if($_GET["getzip"])$ret=give_tar();

#client
if($_SESSION['auth']>6 && $_GET["update"]){$dest=$_SESSION['dest'];
if($_GET["update"]=='program'){$_SESSION['fnb']=0; $_SESSION['tarf']=''; calltar();
	$_SESSION['folders']=array("progb","prog","msql","plug","js","gallery","fla",'css');
	$_SESSION['dest']=$_SESSION['folders'][$_SESSION['fnb']]; 
	$ret=maj_system($_SESSION['dest']);
	if($_SESSION['tarf'])$files=implode(';',$_SESSION['tarf']);
	if($files)$t=read_file(maj_server().'/_public/plug/distribution.php?getzip='.$files);
	if($t)$er=write_file('userdl.tar.gz',$t);
	if(!$er)PclTarExtract('userdl.tar.gz','','','');}
elseif($_SESSION['dest']=='fonts')$ret=maj_fonts();
elseif($_SESSION['dest']=='pictos')$ret=maj_pictos();
elseif($_SESSION['dest']=='/'){$rb=array('index','ajax','plug');
	foreach($rb as $v)$ret.=maj_index($v);}
//elseif($dest=='avatar' or $dest=='imgb/icons' or $dest=='bkg')$ret=maj_tar($dest);
else $ret=maj_system($_SESSION['dest']);
if($_GET["upload"] or $_GET["update"]=="all" or ($_GET["update"]=="program" && $_GET["admin"]))
	relod('/?admin=update&updated=ok');
elseif($_GET["update"]=="program"){$_SESSION['philum']=$maj;}//relod('/?id==');
}//auth
if($_GET["verif"])$ret=verif_maj();

if($_GET["admin"])$plug_output=$ret; else echo $ret;

?>