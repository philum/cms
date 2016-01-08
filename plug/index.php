<?php 
//philum_plugin_index

function plug_index(){$ico=picto('editxt'); $dir='plug/';
$plug=msql_read('system','program_plugs','');
$help=msql_read('lang','program_plugs','');
$mt=msql_read_prep('system','program_plugs_types'); 
$re=explore($dir,'files',1); sort($re);
$rt=array('url','plugin','open','edit','do','usage','tag','private','interface','dev','old','modified');
foreach($re as $k=>$v){$va=substr($v,0,-4); $plg=$plug[$va];
	if(auth(4))$fi=lj('','popup_editmsql___system/program*plugs_'.ajx($va).'__1',$ico).' ';
	if(auth(4))$hlp=lj('','popup_editmsql___lang/fr/program*plugs_'.ajx($va).'__1',$ico).' ';
	$do=$help[$va][0]; if($do)
	$dobt=lj('','popup_popmsq___lang_program*plugs_'.ajx($va).'_usage',picto('view')); 
	//$dobt=bubble('','popmsq','lang_program*plugs_'.ajx($va).'_usage',picto('help')); 
	else $dobt='';
	$edt=lj('','popup_plupin__3_codev_plug_'.$va,picto('conn'));
	$mkc='-'; $pb=$plg[3]?$plg[3]:'-';
	if($plg[2]==1)$op=lj('','popup_plupin__3_'.$va,picto('get')); else $op='';
	$lk=lkt('txtx','/plugin/'.$va,picto('link'));
	$tim=filemtime($dir.$v); $dat=date($d?$d:'ymd',$tim);
	if(substr($v,0,1)!='_' && substr($v,-4)=='.php' && $va){$ra['all'][]=$rv;
	$ssh=$plg[4]; $dev=$plg[5];
		$rv=array($lk,$fi.$va,$op,$edt,$hlp.$dobt,$plg[0],$plg[1],$pb,$ssh,$dev,$plg[6],$dat);
		if(strpos($plg[1],' ')){$kr=explode(' ',$plg[1]); 
			for($i=0;$i<count($kr);$i++)$ra[$kr[$i]][]=$rv;}
		elseif($plg[1])$ra[$plg[1]][]=$rv;
		else $ra['new'][]=$rv;}}
foreach($ra as $k=>$v){$rd=array_merge(array($rt),$v);
	if($k=='all')$rb[$k].=msqlink('system','program_plugs');
	elseif($mt[$k])$rb[$k].=divc('',current($mt[$k])).br();
	$rb[$k].=make_table($rd,'txtcadr','');}
return make_tabs($rb);}

?>