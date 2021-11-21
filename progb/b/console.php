<?php //philum/b/console
class console{

static function select_mods_m(){
$r=msql::choose('users',ses('qb'),'mods'); if($r)sort($r); $nw=msql::nextnod($r);
$ret=slctmenusj($r,'socket_admin__self_action_slct*mods_',prmb(1),' ','v');
$ret.=admactbt('newfrom_mods','','self',$nw,nms(99).':'.$nw);//new
$prmb=sql('config','qdu','v','name="'.ses('qb').'"');
if($prmb)$prmb1=strprm($prmb,1,'#'); else $prmb1='';
if($prmb1!=prmb(1))$ret.=admactbt('adopt_mods',nms(66),'self');//apply
return btn('nbp',btn('txtsmall','mods').' '.$ret).hlpbt('console_mods').' ';}

static function backup_console(){//(421)
$base='msql/users/'; $nod=$_SESSION['modsnod']; $f=$base.$nod.'_sav.php'; $ret='';
$rt=['backup'=>'save2','restore'=>'rollback','refresh'=>'refresh','copy'=>'copy','default'=>'file','mkdef'=>'export']; foreach($rt as $k=>$v)$rt[$k]=picto($v);
$ret.=admactbt('backup_mods',$rt['backup'],'','',nms(94));
if(is_file($f))$ret.=admactbt('restore_mods',$rt['restore'],'self','',nms(95));
$ret.=admactbt('refresh_mods',$rt['refresh'],'self','',nms(97));
if($p1=ses('prmb1'))$ret.=admactbt('make_copy',$rt['copy'],'','',nms(132));
$ret.=admactbt('default_mods',$rt['default'],'','',nms(96));
$ret.=admactbt('mk_default',$rt['mkdef'],'','',nms(113));
$ret.=hlpbt('console').' ';
$ret.=msqbt('',ses('qb').'_mods_'.prmb(1));
$ret.=msqbt('system','admin_modules');
return $ret.br();}

static function backup_config(){
$f='params/'.ses('qb').'_saveconfig.txt';
$ret=admactbt('bckp_cnfg','backup');
if(is_file($f))$ret.=admactbt('restore_cnfg','restore','self');
$ret.=admactbt('reset_cnfg','reset','self');
$ret.=admactbt('cnfgxt','txt');
return $ret;}

//conditions
static function see_conds($vl){$sp='';
$r=sesr('mods',$vl); $cnd=$_SESSION['cond']; $ra=[]; $ret='';
if($r){foreach($r as $k=>$v)if(isset($v[3]))$ra[$v[3]]=radd($ra,$v[3]);//cat list
	foreach($ra as $k=>$v){list($ka,$kb)=split_r($k,3);
	if($kb && (isset($_SESSION['line'][$kb]) or is_numeric($kb)))$kc=$kb; else $kc=$k;
	if($k==$cnd[0].$cnd[1] or ($ka==$cnd[0] && !$kb) or ($kb && $kb==$cnd[1]))
		$css='active'; else $css='';//as in define_modc_b()
	if($k)$ret.=lj($css,'mdls'.$vl.'_modules___'.$vl.'__'.ajx($k),$kc).' ';}
if($ret)$ret=lj($cnd[0]?'':'active','mdls'.$vl.'_modules___'.$vl.'__all','-').$ret;
return divc('nbp',$ret);}}

static function see_conds_b(){
$r=$_SESSION['mods']['system']; $cnd=$_SESSION['cond'];
$ra=array_flip(['','home','cat','art']); $ret='';
if($r){foreach($r as $k=>$v)if(isset($v[3]))$ra[$v[3]]=radd($ra,$v[3]);
foreach($ra as $k=>$v)if($k){$c=$k==$cnd[0] && !$cnd[1]?'active':'';
$ret.=admactbt('set_cond',$k,'admcnt',$k,'',$c);}}
if($ret){$all=admactbt('set_cond',nms(100),'admin','all');
return btn('nbp',$all.$ret).hlpbt('console_cond').' ';}}

//build
static function build_mod_subname($v){
list($m,$p,$t,$c,$e,$g,$ch,$h)=$v;
$t=strto($t,':');
if(strpos($p,'§'))$p=strfrom($p,'§');
if(strpos($p,'__'))$p=strfrom($p,'__'); 
$p=strto($p,':'); $p=strto($p,','); $p=strto($p,' '); $p=strto($p,'_'); if($m=='app')$m=$p;
$mb=mimes($m,'file-config'); return $mb.' '.$m;}

static function console_module($k,$v,$vl){//(4411)
list($m,$p,$t,$c,$e,$g,$ch,$h)=$v; $cnd=$_SESSION['cond'];
if($k){$ret='';//lj('','popup_submds___'.$k.'_'.$vl.'_mpos',ascii(10140));
if(($c==$cnd[0] && !$cnd[1]) or ($c && $c==$cnd[1]))$css='popw'; else $css='popbt'; if($h)$css.=' hide';
$css.='" title="'.stripslashes(is_array($p)?implode(' ',$p):$p);
//if($m=='apps')$ret.=lj($css,'popup_call___adminx_submod*pop_'.$k,$m); else 
$ret.=lj($css,'popup_module___'.$k,self::build_mod_subname($v));}
return $ret;}

static function console_system(){$r=['blocks','design','content'];
foreach($r as $k=>$v)if(!prma($v))$ret[]=$v;
if(isset($ret))return btn('txtalert',pictxt('alert','missing: '.implode(', ',$ret)));}

static function block($vl){$r=define_modc_b($vl); $ret=self::see_conds($vl).' ';
$ret.=lj('','popup_modadd___'.$vl,picto('plus')).' ';//bar_add_mod
if(is_array($r))foreach($r as $k=>$v)$ret.=self::console_module($k,$v,$vl).' ';//defd
if($vl=='system')$ret.=self::console_system($r);
return $ret;}

static function console_nav(){
$r=explode(' ','system '.prma('blocks')); $ret='';
foreach($r as $k=>$v)if($v && $v!='clear'){if($v=='system')$hlp=hlpbt('blocsystem');
	elseif($v=='menu')$hlp=hlpbt('blocmenu'); else $hlp='';
	$ret.=lj('txtx','mdls'.$v.'_modules___'.$v.'__'.$_SESSION['cond'][0],$v).$hlp;
	$ret.=divc('menu',divd('mdls'.$v,self::block($v)));}
$ret.=lj('txtx','mdlsdev_modules_dev',nms(148)).hlpbt('bloctest');
$ret.=divc('menu',divd('mdlsdev',self::block('dev')));
return $ret;}//.divb('','cell','modedit')

static function home($p){req('adminx'); 
if($p && !is_numeric($p) && auth(6))return divd('mdls'.$p,self::block($p,1));
$ret=self::select_mods_m();//mods
if(auth(6))$ret.=self::backup_console().br();
$ret.=self::see_conds_b();//conditions
$ret.=div('',self::console_nav()).divc('clear','');
return $ret;}

}
?>