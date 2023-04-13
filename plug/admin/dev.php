<?php //dev
class dev{
#files
static function scrut_txt_b($f){$fp=fopen($f,'r'); if(!$fp)return; $ret='';
while(!feof($fp)){$ret.=fread($fp, 8192);}//fgets//fgetc=chars//fread
fclose($fp); return $ret;}

static function recup_fileinfob($doc){
if(is_file($doc))return date('d-m-Y',filemtime($doc)).'-'.round(filesize($doc)/1024).'Ko';}

static function scrut_dirb($dr){$ret=[];//dev
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f;
	if(is_dir($drb) && $f!='..' && $f!='.' && $f)$ret[$f]=self::scrut_dirb($drb);
	elseif(is_file($drb))$ret[$drb]=self::recup_fileinfob($drb);}}
return $ret;}

static function explode_dirc($rep,$j,$func){
static $i; $i++; $io=0; $ret='';
if(is_array($rep)){
foreach($rep as $k=>$v){$io++;
	if(!is_array($v))$ret.=self::$func($j,$k,$v,$i.'_'.$io);
	else{$ret.=self::explode_dirc($v,$j.'/'.$k,$func);$i--;}}
return $ret;}}

#read
static function scrut_func($r,$i,$deb,$end){$ret='';
$deb+=substr_count($r[$i],'{');
$end+=substr_count($r[$i],'}');
if($r[$i])$ret=$r[$i]."\n";
if($deb>$end){
	$reb=self::scrut_func($r,$i+1,$deb,$end);
	if($reb[0]) $ret.=$reb[0];
	$i=$reb[1];}
return [$ret,$i];}

static function splitfuncs($v){
$r=explode("\n",$v); $rec=[];
for($i=0;$i<count($r);$i++){$v=$r[$i]; 
	if(substr($v,0,2)=='//'){$ret[$i]=$v."\n";}
	if(substr($v,0,1)=='#'){$ret[$i]=$v."\n";}
	if(!$v){$ret[$i]="\n";}
	if(substr($v,0,8)=='static function'){
		$c=between($v,'static function ',')').')';
		$rec[$c]=between($v,'static function ','(');
		$reb=self::scrut_func($r,$i,0,0);
		$ret[$i]=$reb[0]; 
		$i=$reb[1];}}
if(is_array($ret))$rea=implode('',$ret);
return [$rea,$rec];}

static function find_end($ret,$start,$a,$b){
	$posa=strpos($ret,$start);
	$posb=strpos($ret,'}',$posa);
	$temp=subtopos($ret,$posa,$posb);
	$nbop=substr_count($temp,'{');
	for($i=1;$i<$nbop;$i++){$posb=strpos($ret,'}',$posb+1);
		$temp=subtopos($ret,$posa,$posb);
		$nbop=substr_count($temp,'{');}
	return subtopos($ret,$posa,$posb+1);}

static function treat_funcs($j,$k,$v,$i){$ret=''; $g=get('view');
$view=strpos($g,'params/')===false?$g:'';//protect_logs
if(is_file($k) && $view==$k){//echo $k.' ';
	$v=self::scrut_txt_b($k);
	$reb=self::splitfuncs($v);
	$rea=$reb[0];
	if(is_array($reb[1]))$_SESSION['rec']+=$reb[1];
	if(get('func')){
		$ret=self::find_end($rea,'static function '.$_GET['func'].'(','{','}');
		$ret=str_replace(array('<'.'?php','?'.'>'),'',$ret);}//$ret=htmlentities($ret);
	else $ret=$v;}
return $ret;}

static function functions_list($view,$f){
$_SESSION['rec']=array();
if($view)$_GET['view']=$view;
if($f)$_GET['func']=$f;
$dr=struntil($view,'/');
if(!$view)$dr='plug';
if(substr($dr,-1)=='/')$dr=substr($dr,0,-1);
$rep=self::scrut_dirb($dr); if($rep)ksort($rep);
$ret=self::explode_dirc($rep,$dr,'treat_funcs');
//if($_SESSION['rec'])asort($_SESSION['rec']);
return [$rep,$ret];}

static function clean_f($d){
return str_replace(array('progb/','plug/','msql/','js/','.php'),'',$d);}

#cancel
static function cancel_preview($d){
$ret=msql::val('server','program_dev',$d,3);
return divc('txtblc',nl2br($ret));}

static function cancel_menu($del){$i=0; $ret='';
$r=msql::read('server','program_dev',''); //1=>array('','','')
if($del=='all'){$r=array(); msql::modif('server','program_dev',$r,'arr');}
if($del){unset($r[$del]); msql::modif('server','program_dev',$del,'del');}
//$ret.=lj('txtx','popup_dev,cancel*menu___all','empty').br();
if($r)foreach($r as $k=>$v){$i++; $jx=ajx($v[0].'|'.$v[1].'|'.$v[2],'');
$ret.=toggle('txtblc',$k.'_dev,cancel*preview___'.$k,$i.'-'.$v[2],0).' ';
$ret.=lj('txtx','edc_dev,editj___'.$jx,'edit').' ';
$ret.=lj('txtx','edc_dev,editjr___'.$k,'restore').' ';
$ret.=lj('txtx','popup_dev,cancel*menu___'.$k,'x').' ';
$ret.=btd($k,'').br();}
return $ret;}

#edit
/*static function aff($va,$view,$func){
//$go='/?admin=code&view='.$view.'&func=';
//foreach($_SESSION['rec'] as $k=>$v){$ra[]=$v; $rb[]=lka($go.$v,$v);}
$view=strrchr($view,'/');
if(substr($va,0,2)!='<'.'?php')$va='<'."? //philum$view\n\n//$func\n$va\n\n//end\n?".'>';
$reb=highlight_string($va,true); //$reb=str_replace($ra,$rb,$reb);
return div(ats('max-width:600px; max-height:400px; overflow:auto; wrap:true; padding:10px; border:1px solid black;'),$reb);}*/

static function func_sav($fa,$fb,$prm){$va=$prm[0]??'';
if(!auth(6))return;
if($fa)[$d,$p,$f]=explode('|',$fa);
$fb=$d.'/'.$p.'.php'; $va=substr(ajx($va,1),0,-1);
if(is_file($fb)){//echo $fab;
	$t=read_file($fb);
	$od=self::find_end($t,'static function '.$f.'(','{','}');
	$t=str_replace($od,$va.'}',$t);
		$va=str_replace("\r","\n",$va);
	$defs=[$d,$p,$f,$va];
	msql::modif('server','program_dev',$defs,'one',[],time());
	write_file($fb,$t);}
return btn('txtyl','saved');}

static function editj($s){
if($s)[$d,$p,$f]=explode('|',$s); $view=$d.'/'.$p.'.php'; 
//$_SESSION['crdir']=$f;
if($view!='=')[$rep,$res]=self::functions_list($view,$f);
return self::edit($res,$d,$p,$f);}

static function editjr($d){//restore
$r=msql::row('server','program_dev',$d);
return self::edit(stripslashes($r[3]),$r[0],$r[1],$r[2]);}

static function delhistory($f){$_SESSION['crfnc'][$f]='';}

static function findev($p){return btn('poph',$p).' '.
lj('','results_codeview,findfunc___'.ajx($p),picto('search')).
lj('','results_coremap,map__14_'.ajx($p),picto('topo-open'));}

static function edit($v,$d,$p,$f){$view=$d.'/'.$p.'.php';
//if($p)$_SESSION['crpag'][$p]=$d;
if($f)$_SESSION['crfnc'][$f]=[$d,$p,$f];
if($d)$fd=round(filesize($view)/1024,2).'Ko'; //$vb=self::clean_f($view);
$ret=btn('txtcadr',$d.'/'.$p.'/'.$f.' ('.$fd.')').' ';
$jx='edsv_dev,sav_txtarea_xd_'.$d.'|'.$p.'|'.ajx($f,'');
if(auth(6))$ret.=lj('popsav',$jx,'save');//save
$ret.=btd('edsv','').' ';
$ret.=lj('popbt','popup_dev,cancel*menu___','history').' ';
//$ret.=lj('txtx','edc_dev,editj___'.$d.'|'.$p.'|'.ajx($f,''),'refresh');
//$ret.=openpages();
//$db=$_SESSION['crdir']?$_SESSION['crdir']:'progb||';//func_menus
$ret.=lj('popbt','popup_dev,menus___'.$d,'open').' ';
$ret.=hlpbt('dev').br().br();
$ret.=self::openfuncs();
//if($d=='progb')$ret.=lj('txt','edc_dev,copy','prod').' ';
$ret.=textarea('txtarea',str::htmlentities_b($v),64,20,['class'=>'console','onclick'=>'detctfunc(this)','ondblclick'=>'findfunc(this)','wrap'=>'on']);
//$v=str::htmlentities_b($v); $v=highlight_string('<'.'?php'.$v.'?'.'>',true);
//$v=str_replace(array('FF8000','007700','0000BB','DD0000','0000BB'),array('FF8000','00ee00','afafff','eeeeee','ffbf00'),$v);
//$sj='SaveG(this,event,\'txarec_dev,render\')'; 
//$ret.=divedit('txarec','console','width:545px;',$sj,$v);
return $ret;}

/*static function openpages(){$r=$_SESSION['crpag']; if($r)foreach($r as $k=>$v){
$ret.=lj('txtx','funcmenu_dev,menus___'.$v.'|'.ajx($k,''),$k).' ';}
return $ret;}*/
static function close_page($p){unset($_SESSION['crfnc'][$p]); return self::edit('','','','');}
static function openfuncs(){$ret='';
$r=$_SESSION['crfnc']; $jx='edc_dev,editj___';
if($r)foreach($r as $k=>$v){
if($v[2])$ret.=btn('txtab',lj('',$jx.$v[0].'|'.ajx($v[1]).'|'.ajx($v[2]),$v[2]).' '.
lj('txtx','edc_dev,close*page___'.ajx($k),'x')).' ';}
return divc('small',$ret);}

static function copy(){
$r=self::scrut_dirb('progb'); //p($r);
//foreach($r as $k=>$v){copy($k,str_replace('progb','prog',$k));}
return btn('txtyl','modifs are now public (false)');}

#menus
static function d_menus($d){return divs('overflow-y:scroll; max-height:400px;',divc('list',$d));}
static function funcmenu_fnc($r,$d,$p){//p($r);
foreach($r as $k=>$v){$pb=self::clean_f($p); $ret='';
$ret.=lj('','edc_dev,editj___'.$d.'|'.$pb.'|'.ajx($v,''),$v);}
return self::d_menus($ret);}
static function funcmenu_pag($r,$d,$p){$ret='';
if($r)foreach($r as $k=>$v){$ka=self::clean_f($k); if(!is_dir($k))
if($ka)$ret.=lj('','funcmenu_dev,menus___'.$d.'|'.ajx($ka,''),$ka);}
return self::d_menus($ret);}
static function funcmenu_dir($r,$d){$ret='';
foreach($r as $k=>$v){$ret.=lj('','funcmenu_dev,menus___'.$v,$v);}
return self::d_menus($ret);}

static function menus($s){//echo $s;
[$d,$p,$f]=opt($s,'|',3);
if($d)$_SESSION['crdir']=$d;
if($p)$vw=$d.'/'.$p.'.php'; else $vw=$d; 
[$rep,$res]=self::functions_list($vw,$f);
$cs1=$cs2=$cs3='txtx'; $rec=$_SESSION['rec']; $nb=count($rec);
if($p && $nb>1)$cs3='popsav';elseif($d)$cs2='popsav';else $cs1='popsav';
$ret=lj($cs1,'funcmenu_dev,menus','dirs',0).' ';
if($d)$ret.=lj($cs2,'funcmenu_dev,menus___'.$d,$d,0).' ';//pages
if($p)$ret.=lj($cs3,'funcmenu_dev,menus___'.$d.'|'.$p,$p,0).' ';//funcs
if($p && $nb>1)$ret.=self::funcmenu_fnc($rec,$d,$p);
elseif($d)$ret.=self::funcmenu_pag($rep,$d,$p);
else $ret.=self::funcmenu_dir(array('progb','plug','msql','js'),$d);
return divd('funcmenu',$ret);}

static function render($a,$b,$prm=[]){
$res=$prm[0]??''; 
//$res=highlight_string($res,true);
//$res=htmlentities($res);
return $res;}

static function home(){
$_SESSION['rec']=[];
$ret=divb(self::edit('hello_world','progb','lib','p'),'','edc','display:inline-block; width:50%;');
$ret.=divb('','','results','float:right; width:40%; margin-left:10px;');
$ret.=divc('clear','');
$ret.=lkc('txtx','/app/exec','exec').' ';
$ret.=lkc('txtx','/app/codev','codev');
$ret.=divc('clear','');
return $ret;}
}
?>