<?php
//philum_dev

#read
function scrut_func($r,$i,$deb,$end){
	$deb+=substr_count($r[$i],'{');
	$end+=substr_count($r[$i],'}');
	if($r[$i]) $ret.=$r[$i]."\n";
	if($deb>$end){
		$reb=scrut_func($r,$i+1,$deb,$end);
		if($reb[0]) $ret.=$reb[0];
		$i=$reb[1];}
return array($ret,$i);}

function splitfuncs($v){$r=explode("\n",$v);
for($i=0;$i<count($r);$i++){$v=$r[$i]; 
	if(substr($v,0,2)=='//'){$ret[$i]=$v."\n";}
	if(substr($v,0,1)=='#'){$ret[$i]=$v."\n";}
	if($v==''){$ret[$i]="\n";}
	if(substr($v,0,8)=='function'){
		$c=embed_detect_b($v,'function ',')','').')';
		$rec[$c]=embed_detect_b($v,'function ','(','');
		$reb=scrut_func($r,$i,0,0);
		$ret[$i]=$reb[0]; 
		$i=$reb[1];}}
if(is_array($ret))$rea=implode('',$ret);
return array($rea,$rec);}

function find_end($ret,$start,$a,$b){
	$posa=strpos($ret,$start);
	$posb=strpos($ret,'}',$posa);
	$temp=subtopos($ret,$posa,$posb);
	$nbop=substr_count($temp,'{');
	for($i=1;$i<$nbop;$i++){$posb=strpos($ret,'}',$posb+1);
		$temp=subtopos($ret,$posa,$posb);
		$nbop=substr_count($temp,'{');}
	return subtopos($ret,$posa,$posb+1);}

function treat_funcs($j,$k,$v,$i){
$view=strpos($_GET['view'],'params/')===false?$_GET['view']:'';//protect_logs
if(is_file($k) && $view==$k){//echo $k.' ';
	$v=scrut_txt_b($k);
	$reb=splitfuncs($v);
	$rea=$reb[0];
	if(is_array($reb[1]))$_SESSION['rec']+=$reb[1];
	if($_GET['func']){
		$ret=find_end($rea,'function '.$_GET['func'].'(','{','}');
		$ret=str_replace(array('<'.'?php','?'.'>'),'',$ret);}//$ret=htmlentities($ret);
	else $ret=$v;}
return $ret;}

function functions_list($view,$f){
$_SESSION['rec']=array();
if($view)$_GET['view']=$view;
if($f)$_GET['func']=$f;
$dr=str_extract('/',$view,1,0);
if(!$view)$dr='plug';
if(substr($dr,-1)=='/')$dr=substr($dr,0,-1);
$rep=scrut_dirb($dr); if($rep)ksort($rep);
$ret=explode_dirc($rep,$dr,'treat_funcs');
//if($_SESSION['rec'])asort($_SESSION['rec']);
return array($rep,$ret);}

function clean_f($d){
return str_replace(array('progb/','plug/','msql/','js/','.php'),'',$d);}

#cancel
function cancel_preview($d){
$r=msql_read('server','program_dev',$d);
return divc('txtblc',nl2br($r[3]));}

function cancel_menu($del){
$r=msql_read('server','program_dev',''); //1=>array('','','')
if($del=='all'){$r=array(); modif_vars('server','program_dev',$r,'repl');}
if($del){unset($r[$del]); modif_vars('server','program_dev',$del,'del');}
//$ret.=lj('txtx','popup_plup__2_dev_cancel*menu_all','empty').br();
if($r)foreach($r as $k=>$v){$i++; $jx=ajx($v[0].'|'.$v[1].'|'.$v[2],'');
$ret.=toggle('txtblc',$k.'_plug_dev_cancel*preview_'.$k,$i.'-'.$v[2],0).' ';
$ret.=lj('txtx','edc_plug__2_dev_func*edit*j_'.$jx,'edit').' ';
$ret.=lj('txtx','edc_plug__2_dev_func*edit*jr_'.$k,'restore').' ';
$ret.=lj('txtx','popup_plup__2_dev_cancel*menu_'.$k,'x').' ';
$ret.=btd($k,'').br();}
return $ret;}

#edit
/*function function_aff($va,$view,$func){
//$go='/?admin=code&view='.$view.'&func=';
//foreach($_SESSION['rec'] as $k=>$v){$ra[]=$v; $rb[]=lka($go.$v,$v);}
$view=strrchr($view,'/');
if(substr($va,0,2)!='<'.'?php')$va='<'."? //philum$view\n\n//$func\n$va\n\n//end\n?".'>';
$reb=highlight_string($va,true); //$reb=str_replace($ra,$rb,$reb);
return div('style="max-width:600px; max-height:400px; overflow:auto; wrap:true; padding:10px; border:1px solid black;"',$reb);}*/

function func_sav($fa,$fb,$va){
if(!auth(6))return;
if($fa)list($d,$p,$f)=explode('|',$fa);
$fb=$d.'/'.$p.'.php'; $va=substr(ajx($va,1),0,-1);
if(is_file($fb)){//echo $fab;
	$t=read_file($fb);
	$od=find_end($t,'function '.$f.'(','{','}');
	$t=str_replace($od,$va.'}',$t); //echo txarea('',$od,40,20);
		$va=str_replace("\r","\n",$va);
	$defs=array($d,$p,$f,$va);
	msql_modif('server','program_dev',$defs,$dfb,'one',time());
	echo write_file($fb,$t);}
return btn('txtyl','saved');}

function func_edit_j($s){
if($s)list($d,$p,$f)=explode('|',$s); $view=$d.'/'.$p.'.php'; 
//$_SESSION['crdir']=$f;
if($view!='=')list($rep,$res)=functions_list($view,$f);
return func_edit($res,$d,$p,$f);}

function func_edit_jr($d){//restore
$r=msql_read('server','program_dev',$d);
return func_edit(stripslashes($r[3]),$r[0],$r[1],$r[2]);}

function func_hist_del($f){$_SESSION['crfnc'][$f]='';}

function findev($p){return btn('poph',$p).' '.
lj('','results_plug___codeview_findfunc_'.ajx($p),picto('search')).
lj('','results_plug__14_coremap_coremap_'.ajx($p),picto('topo-open'));}

function func_edit($v,$d,$p,$f){$view=$d.'/'.$p.'.php';
//if($p)$_SESSION['crpag'][$p]=$d;
if($f)$_SESSION['crfnc'][$f]=array($d,$p,$f);
if($d)$fd=round(filesize($view)/1024,2).'Ko'; //$vb=clean_f($view);
$ret.=btn('txtcadr',$d.'/'.$p.'/'.$f.' ('.$fd.')').' ';
$jx='edsv_plug__xd_dev_func*sav_'.$d.'|'.$p.'|'.ajx($f,'').'__txtarea';
if(auth(6))$ret.=lj('popsav',$jx,'save');//save
$ret.=btd('edsv','').' ';
$ret.=lj('popbt','popup_plup___dev_cancel*menu_','history').' ';
//$ret.=lj('txtx','edc_plug__2_dev_func*edit*j_'.$d.'|'.$p.'|'.ajx($f,''),'refresh');
//$ret.=openpages();
//$db=$_SESSION['crdir']?$_SESSION['crdir']:'progb||';//func_menus
$ret.=lj('popbt','popup_plup___dev_func*menus_'.$d,'open').' ';
$ret.=hlpbt('dev').br().br();
$ret.=openfuncs();
//if($d=='progb')$ret.=ljb('txt','SaveJ','edc_plug___dev_func*copy','prod').' ';
$ret.=txarea('txtarea" onclick="detctfunc(this)" ondblclick="findfunc(this)" wrap="on',parse($v),'64',20,'console');
//$v=parse($v); $v=highlight_string('<'.'?php'.$v.'?'.'>',true);
//$v=str_replace(array('FF8000','007700','0000BB','DD0000','0000BB'),array('FF8000','00ee00','afafff','eeeeee','ffbf00'),$v);
//$sj='SaveG(this,event,\'txarec_plug_dev_dev*render\')'; 
//$ret.=divedit('txarec','console','width:545px;',$sj,$v);
return $ret;}

/*function openpages(){$r=$_SESSION['crpag']; if($r)foreach($r as $k=>$v){
$ret.=lj('txtx','funcmenu_plug___dev_func*menus_'.$v.'|'.ajx($k,''),$k).' ';}
return $ret;}*/
function close_page($p){unset($_SESSION['crfnc'][$p]); return func_edit_j('');}
function openfuncs(){$r=$_SESSION['crfnc']; $jx='edc_plug__2_dev_func*edit*j_';
if($r)foreach($r as $k=>$v){
if($v[2])$ret.=btn('txtab',lj('',$jx.$v[0].'|'.ajx($v[1]).'|'.ajx($v[2]),$v[2]).' '.
lj('txtx','edc_plug__2_dev_close*page_'.ajx($k),'x')).' ';}
return divc('small',$ret);}

function func_copy(){
$r=scrut_dirb('progb'); //p($r);
//foreach($r as $k=>$v){copy($k,str_replace('progb','prog',$k));}
return btn('txtyl','modifs are now public (false)');}

#menus
function d_menus($d){return divs('overflow-y:scroll; max-height:400px;',divc('list',$d));}
function funcmenu_fnc($r,$d,$p){//p($r);
foreach($r as $k=>$v){$pb=clean_f($p);
$ret.=lj('','edc_plug__2_dev_func*edit*j_'.$d.'|'.$pb.'|'.ajx($v,''),$v);}
return d_menus($ret);}
function funcmenu_pag($r,$d,$p){
if($r)foreach($r as $k=>$v){$ka=clean_f($k); if(!is_dir($k))
if($ka)$ret.=lj('','funcmenu_plug__2_dev_func*menus_'.$d.'|'.ajx($ka,''),$ka);}
return d_menus($ret);}
function funcmenu_dir($r,$d){
foreach($r as $k=>$v){$ret.=lj('','funcmenu_plug___dev_func*menus_'.$v,$v);}
return d_menus($ret);}

function func_menus($s){//echo $s;
if($s)list($d,$p,$f)=explode('|',$s);
if($d)$_SESSION['crdir']=$d;
if($p)$vw=$d.'/'.$p.'.php'; else $vw=$d; 
list($rep,$res)=functions_list($vw,$f);
$cs1=$cs2=$cs3='txtx'; $rec=$_SESSION['rec']; $nb=count($rec);
if($p && $nb>1)$cs3='popsav';elseif($d)$cs2='popsav';else $cs1='popsav';
$ret.=lj($cs1,'funcmenu_plug___dev_func*menus','dirs',0).' ';
if($d)$ret.=lj($cs2,'funcmenu_plug___dev_func*menus_'.$d,$d,0).' ';//pages
if($p)$ret.=lj($cs3,'funcmenu_plug___dev_func*menus_'.$d.'|'.$p,$p,0).' ';//funcs
if($p && $nb>1)$ret.=funcmenu_fnc($rec,$d,$p);
elseif($d)$ret.=funcmenu_pag($rep,$d,$p);
else $ret.=funcmenu_dir(array('progb','plug','msql','js'),$d);
return divd('funcmenu',$ret);}

function dev_render($a,$b,$res){
//$res=substr($res,0,-1);
$res=ajx($res,1); 
//$res=highlight_string($res,true);
//$res=htmlentities($res);
return $res;}

function plug_dev(){
$_SESSION['rec']=array();
$ret.=div('id="edc" style="display:inline-block; width:50%;"',func_edit('hello_world','progb','lib','p'));
$ret.=div('id="results" style="float:right; width:40%; margin-left:10px;"','');
$ret.=divc('clear','');
$ret.=lkc('txtx','/plug/exec','exec').' ';
$ret.=lkc('txtx','/plug/codev','codev');
$ret.=divc('clear','');
return $ret;}



?>