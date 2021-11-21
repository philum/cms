<?php 
//philum_plugin_index

function index_r(){
$r=['backup','backupim','codev','coreflush','exec','pictocss','updateimg','cssedit','genpswd','know','star','xhtml','test','operations','ops','sun','connectors','indent','msqadd','spt','atomic','microform','superpoll','chat','chatxml','crypt','phi','svg','tar','vacuum'];
return array_combine($r,$r);}

function plug_exec($plg,$p='',$rid='',$res=''){
if($res)list($plg,$p,$o)=ajxr($res);
//$ret=select_j('plugin','plug','','','','2').' ';
$ret=select_j('plugin','pfunc','','index/index_r','','2');
$j=$rid.'_plug__3_plug_plug*call__'.$rid.'_plugin|plugp';
$ret.=inputj('plugin',$plg?$plg:'plugin',$j,'',1).' ';
$ret.=lj('',$j,picto('ok'));
$ret.=input1('plugp',$p?$p:'param','','',1).' ';
//$ret.=input1('plugo',$o?$o:'option','','',1).' ';
return $ret;}

function plug_index(){$ico=picto('editxt'); $dir='plug';
$plug=msql_read('system','program_plugs','');
$help=msql_read('lang','program_plugs','');
$mt=msql::prep('system','program_plugs_types'); 
//$re=explore($dir,'files',1); sort($re);
$re=scandir_r($dir); //eco($re);
$rt=['url','plugin','open','edit','do','usage','tag','private','interface','dev','old','modified'];
foreach($re as $k=>$v){$va=portion($v,'/','.',1,1); $plg=arr(val($plug,$va),7);
	if(auth(4))$fi=lj('','popup_editmsql___system/program*plugs_'.ajx($va).'__1',$ico).' ';
	if(auth(4))$hlp=lj('','popup_editmsql___lang/fr/program*plugs_'.ajx($va).'__1',$ico).' ';
	$do=valr($help,$va,0);
	if($do)$dobt=lj('','popup_popmsq___lang_program*plugs_'.ajx($va).'_usage',picto('view')); 
	//$dobt=bubble('','popmsq','lang_program*plugs_'.ajx($va).'_usage',picto('help')); 
	else $dobt='';
	$edt=lj('','popup_plupin__3_codev_plug_'.$va,picto('conn'));
	$mkc='-'; $pb=val($plg,3,'-');
	if($plg[2]==1)$op=lj('','popup_plupin__3_'.$va,picto('get')); else $op='';
	$lk=lkt('txtx','/plugin/'.$va,picto('link'));
	$tim=filemtime($v); $dat=date('ymd',$tim); $rv='';
	if(substr($v,0,1)!='_' && substr($v,-4)=='.php' && $va){
		$ssh=$plg[4]; $dev=$plg[5];
		$rv=array($lk,$fi.$va,$op,$edt,$hlp.$dobt,$plg[0],$plg[1],$pb,$ssh,$dev,$plg[6],$dat);
		$ra['all'][]=$rv;
		if(strpos($plg[1],' ')){$kr=explode(' ',$plg[1]); 
			for($i=0;$i<count($kr);$i++)$ra[$kr[$i]][]=$rv;}
		elseif($plg[1])$ra[$plg[1]][]=$rv;
		else $ra['new'][]=$rv;}}
foreach($ra as $k=>$v){$rd=array_merge(array($rt),$v);
	if($k=='all')$rb[$k][]=msqbt('system','program_plugs');
	elseif($mtk=val($mt,$k))$rb[$k][]=divc('',current($mtk)).br();
	$rb[$k][]=tabler($rd,'txtcadr','');}
//exec
$rid=randid('plg');
$ret=make_tabs($rb);
$bt=plug_exec('','',$rid);
$ret=divd($rid,$ret);
return $bt.$ret;}

?>