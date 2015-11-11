<?php
//philum_plugin_addfonts
session_start();
error_reporting(6135);

function calltar(){
include_once('plug/tar/pclerror.lib.php');
include_once('plug/tar/pcltrace.lib.php');
include_once('plug/tar/pcltar.lib.php');}

function addf_copy($u,$f){
if(!is_file($f)){$d=read_file($u); write_file($f,$d); return lka($f);}
else return $f.' '.btn('txtyl','already_exists');}

function addf_inject(){calltar();
$ra=msql_read('server','edition_typos','');
if($ra)$vra=array_keys_r($ra,0,'k');
$r=msql_read('','public_addfonts',''); if($r){$vr=array_shift($r);}
$dir='fonts/'; $diru='users/'.$_SESSION['qb'].'/fonts/'; if(!is_dir($diru))mkdir($diru);
if($r)foreach($r as $k=>$v){$font=normalize($v[0]); 
	if(!$vra[$font]){$rb=array($font,'','','',''); 
		for($i=1;$i<count($v);$i++){$f=$font.'.'.$vr[$i]; $rc[]=$dir.$f; 
			$ret.=addf_copy($v[$i],$dir.$f).br();}//u
		//msql_modif('server','edition_typos',$rb,$dfb,'push','');
		//modif_vars('','public_addfonts',$k,'del');
		if($rc)PclTarCreate($diru.$font.'.tar.gz',$rc,'','','');
		$ret.=btn('txtblc',lka($diru.$font.'.tar.gz')).' '.btn('txtx','saved').br();}
	else $ret.=$font.' already_exists'.br();}
//if($rb)msql_modif('server','edition_typos',$rb,$dfb,'add','');
$ret.=lkc('txtbox','/?admin=fonts&inject==','inject datas (admin/fonts)').br();
return $ret;}

function addfonts_j($var1,$var2,$res){
$r=msql_read('','public_addfonts',''); if($r)$rk=array_keys_r($r,0,'k');
$res=ajx(substr($res,0,-1),1); $res=embed_detect($res,'{','}','');
$res=str_replace(array('"',"'",' ',"\n","\r","\t","?#iefix","?","!"),'',$res);
$ra=explode(';',$res); $nb=count($ra);
for($i=0;$i<$nb;$i++){
list($attrb,$value)=split_right(':',$ra[$i],0);
	if($attrb=='font-family')$rb['name']=$value;
	$rab=explode(',',$ra[$i]); if($rab)foreach($rab as $k=>$va){
		$rt=embed_detect($va,'url(',')',''); //echo $rt.br().br();
		if($rt && !$rk[$rb['name']]){$rs=split_only('#',$rt,0,0); $xt=strrchr_b($rt,'.');
			if($xt && substr($rs,0,4)=='http' && $xt!='eot?')$rb[$xt]=$rs;
			else $noturl=1;}}}
if($rb[0])$rb=msq_reorder($rb); //p($rb);
$dfb['_menus_']=array('name','eot','woff','svg','ttf');
if(count($rb)>1){$r=msql_modif('users','public_addfonts',$rb,$dfb,'push',''); //p($rb);
	return addf_read($r);}
else return btn('txtred',$noturl?'not absolte url':'already_exists');}

function addf_read($r){$n=count($r)-1;
if($n>0)$ret=lj('txtbox','cbk_plug___addfonts_addf*inject','add '.$n.' typos').br().br();//xd
return $ret.make_table($r,'txtblc','txtx');}

function plug_addfonts($d){$here='addfonts';
//$ret=headers_r($here,array(array('css'=>'../css/_admin.css'),array('js'=>'../progb/ajx.js'),array('js'=>'../progb/utils.js'),array('csscode'=>''),array('jscode'=>'')));
$r=msql_read('','public_addfonts','');
$ret.=divc('txtalert','coller la classe @face-font (avec url absolue)').br();
$ret.=txarea('txt','',60,10);
$ret.=lj('txtbox','cbk_plug___'.$here.'_addfonts*j_1_2_txt','save').br().br();//xd
if($_SESSION['auth']>4)$ret.=divd('cbk',addf_read($r));
$ret.=msqlink('','public_addfonts');
$ret=divd('page',divd('content',$ret));
return $ret;}

?>