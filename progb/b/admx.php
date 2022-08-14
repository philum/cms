<?php //ajx_static functions
class admx{
#master_config//(3)
//$r=['mb','mm','mp','mt','mc','md','mo','mh','mv','me','mr','mi','mj','pp'];
static function modsav($block,$mod,$act,$r=[]){//pr($r);
for($i=0;$i<12;$i++)$r[$i]=$r[$i]??'';
$cond=substr($r[4],0,1)!='-'?$r[4]:''; if($act=='add')$cond=$r[2];
$r[5]=$r[5]!='-'?$r[5]:''; $r[4]=$r[4]!='-'?$r[4]:''; $r[9]=$r[9]!='-'?$r[9]:'';//4cond,5com,6opt,9tmpl,10pop
$nod=$_SESSION['modsnod']; $ret=[];
if($cond)setcond($cond,1);
if($act=='sav' or $act=='savb'){
	$ret[$mod]=$r; array_shift($r); $_SESSION['mods'][$block][$mod]=$r; 
	$ret=msql::modif('',$nod,$ret,'mdf'); boot::define_modc();}
elseif($act=='add'){
	$md=$mod?$mod:$r[0]; $cnd=$r[1]=='-'?'':$r[1]; $pos=$r[2];
	$ret=[$block,$md,'','',$cnd,'','','','','',''];
	$cmd=define_modc_b($block);
	if($cmd){$keys=array_keys($cmd); $i=0; $nmd=[];
	foreach($cmd as $k=>$v){//existants
		$nv=$v; array_unshift($nv,$block);
		$nk=$keys[$i]??0; if($nk==0)$nk='push';
		if($k==$pos){$nmd[$nk]=$nv; $i++;
			$nk=$keys[$i]??0; if($nk==0)$nk='push'; $nk;$nmd[$nk]=$ret;}
		else $nmd[$nk]=$nv; $i++;}} 
	else $nmd[]=$ret;
	$r=msql::modif('',$nod,$nmd,'mdf');
	boot::define_mods('',$r); boot::define_modc(); boot::define_prma();}
elseif($act=='new'){$nv=$r; $nv[0]=$block; $r=msql::modif('',$nod,$nv,'push'); 
	boot::define_mods('',$r); boot::define_modc(); boot::define_prma();}
elseif($act=='del'){unset($_SESSION['mods'][$block][$mod]); msql::modif('',$nod,$mod,'del');
	boot::define_modc(); boot::define_prma();}
elseif($act)setcond($act,1);
if($block=='newsletter')boot::define_mods();
return console::block($block,$ret);}

static function addmod($vl){
$r=msql_read('system','admin_modules','',1);
if($r)foreach($r as $k=>$v)$defs[$v[0]][$k]=$v[1];
$re=self::prep_cond_mods($vl); $df=[];
[$defb,$defc,$defd]=self::whose_mods($re,$vl,$defs);
$def=array_merge($defc,$defd);
$ret=btn('txtsmall','module:'); ksort($def); 
$ret.=select(['id'=>'modbar','name'=>'bar'],$def,'kk');
$ret.=btn('txtsmall','context:');
$cond=$_SESSION['cond'][0]; $cndr=['-','home','cat','art']; //$cndr[]=$cond;
$ret.=select(['id'=>'modcond','name'=>'cond'],$cndr,'vv',$cond);
$ret.=btn('txtsmall','position:');
if(!is_array($re))$re=['-'=>'-']; end($re); $pos=current($re);//select last
$ret.=select(['id'=>'pos','nme'=>'modpos'],array_flip($re),'kv',$pos).' ';
$ret.=lj('popsav','mdls'.$vl.'_modsav_modpos,modbar,modcond_x_'.$vl.'__add',nms(92)).br().br();
$ret.=divc('imgr',hlpbt('modules'));
$hlp=msql_read('lang','admin_modules','');//help
foreach($def as $k=>$v){$cat=valr($r,$k,0); if(!$cat)$cat='user';
	if(!sesr('line',$k))$df[$cat][]=div('',lj('popbt','mdls'.$vl.'_modsav_modpos,modbar,modcond_x_'.$vl.'_'.ajx($k).'_add__',$k).btn('txtsmall',valr($hlp,$k,0)));}
$ret.=make_tabs($df);
return $ret;}

#config_mod
static function user_mods(){$ret=[];
$r=msql_read('',ses('qb').'_modules','',1);
if($r)foreach($r as $k=>$v){$ret[$k]=[$k,1];}
return $ret;}

//mod_edit (create_comline)
static function mod_edit_pop($o){$c=$o?'module':'ajax';
$inject=mc::assistant('mp','insert_jc',$c.'\',\'mp','','');
return self::mod_edit('',$o).$inject;}

static function admhlp($c,$t,$e){
//return bubble($c,'usg,popmsqt','lang_admin*modules_'.$t.'_'.$e,picto('info'));
return togbub('msqa,msqcall','lang_admin*modules_'.$t.'_'.$e,picto('help'),'grey');}

static function modEditSav($v,$o,$pa,$id=''){if(!$id)$id='mp';
if($pa)$pa=ajx(substr($pa,0,-1),1); $r=msql::row('system','admin_modules',$v,1); 
$ret=self::admhlp('imgr',ajx($v),'description');
$ra=['param','title','command','option','module']; $d='"size="11" id="mde';
if(!$o)$ra[]='button';
for($i=0;$i<count($ra);$i++){$cm[]='mde'.$i; $vb=$ra[$i]; 
	if($ra[$i]=='module')$va=$v; elseif($ra[$i]=='param')$va=$pa; else $va='';
	if(($vb!='command' && $r[$vb]!='0') or $r[$vb]){
		if($vb=='command' or $vb=='option')$hlp=btn('txtsmall2',$r[$vb]); else $hlp='';
		if($vb=='button' && !$o)$va=$v;
		if(substr($va,-1)=='&')$va=substr($va,0,-1);
		$rb[$vb]=input2($d.$i,ajx($va,1)).$hlp;}
	else $ret.=hidden($d.$i,'');}
$rb[' ']=ljb('popsav','popup',implode('|',$cm).'\',\''.$id.'','add :'.$v);
$ret.=on2cols($rb,470,5);
return $ret;}

static function mod_edit($p,$o,$id=''){
$ret=btn('txtcadr','command-line').' ';
$rb=msql_read('system','admin_modules','',1); 
foreach($rb as $k=>$v){if($v[0]!='system')$ra[$k]=$k;}
$ret.=btn('txtsmall2','module: ');
$ret.=select(['id'=>'sdx','onchange'=>sj('moded_admx,modEditSav_sdx__'.$o.'__'.$id)],$ra,'kk');
$ret.=divd('moded','');
return $ret;}

//comline (submod normaux)
static function cmvld($na,$ra){$p='';
for($i=3;$i<15;$i++)$p.=($ra[$i]??'').'/'; $p.=':';
$p=str_replace(['/////:','////:','///:','//:','/:'],':',$p);
$p.=$ra[1].'?'.$ra[2]; if(substr($p,0,1)==':')$p=substr($p,1);
$r=explode(',',str_replace("\n",'',$ra[0])); $r[$na]=$p;
return implode(",\n",$r);}

static function cmdel($na,$r){$rt=[];
foreach($r as $k=>$v){if($k!=$na)$rt[]=$v;}
return implode(',',$rt);}

static function cmprm($id,$o,$prm=[]){
$ret=btn('txtx',helps('scripts')).br();
$ret.=goodarea('edt'.$id,$prm[0]??'',62).br();
$ret.=ljb('popbt','SaveJb',$id.'_submds_edt'.$id.'__'.$id.'_cmpsav\',\'sbm_submds_'.$id.'___'.$id.'_cmlin',nms(66));
return $ret;}

static function cmedt($v,$na,$id){$rid=randid();
//if($prm)return self::cmvld($na,$prm);
[$cod,$mod,$t]=$ra=decompact_mod($v); $r=explode('/',trim($cod)); $ri=[];
$ids=[$id,'medm'.$rid,'medb'.$rid];
$arb=msql::row('system','admin_modules',$mod,1);
$rb['module']=hidden('medm'.$rid,$mod).self::submod_comline('medm'.$rid,$mod); 
$hlp=msql::row('lang','admin_modules',$mod,1);
$rb['usage']=divc('small',$hlp['description']??'');
$rb['button']=input('medb'.$rid,$t); $rb['toggles']='';
$rk=['param','title','command','option','cache','hide','template','nobr','div','ajxbtn'];
foreach($rk as $k=>$v){$ri[]='med'.$k.$rid; $jmp=''; $com=$arb[$v]??'';
if($v=='param' or $v=='title' or $v=='command' or $v=='option' or $v=='template'){
	if($com && $v!='param' && $v!='template')
		$jmp=select_j('med'.$k.$rid,'- '.ajx($com),$com,1,picto('kdown'),0);
	if($v=='param')$jmp=' '.self::admhlp('grey',ajx($mod),'help');
	if($v=='template'){$ra=msql_read('',nod('template'),'',1); 
		if($ra)$tmp=implode(' ',array_keys($ra)); else $tmp='';
		$jmp=select_j('med'.$k.$rid,'- '.ajx($tmp),$com,1,picto('kdown'),0);}
	$rb[$v]=input('med'.$k.$rid,$r[$k]??'').$jmp;}
else $rb['toggles'].=checkbox_j('med'.$k.$rid,$r[$k]??'',$v);}
$j=$id.'_submds_'.$id.'_4x_'.$na.'__cmdel\',\'sbm_submds_'.$id.'___'.$id.'_cmlin';
$bt=ljb('popdel','SaveJb',$j,nms(43)).' ';
$j=$id.'_submds_'.implode(',',$ri).'_4x__'.$na.'_cmvld\',\'sbm_submds_'.$id.'___'.$id.'_cmlin';
$bt.=ljb('popbt','SaveJb',$j,nms(66));
$ret=on2cols($rb,300,4).$bt.br();
return $ret;}

static function cmlin($p,$id,$prm=[]){$p=$prm[0]??$p; $ret='';
$p=str_replace('\n','',$p); $r=explode(',',$p); $n=count($r);
for($i=0;$i<$n;$i++){$ra=decompact_mod($r[$i]);
	$v=ajx(trim($r[$i])); $bt=$ra[2]; $t=att($ra[1]);
	if($r[$i])$ret.=lj('popbt','popup_submds_'.$id.'__'.$v.'_'.$i.'_cmedt_'.$id,$bt,$t).' ';}
$ret.=hidden($id,$p);
return $ret;}

//comline
static function comline($p,$id){$n=substr_count($p,',')+2;
$ret=lj('','sbm'.'_submds____'.$id.'_cmlin__'.$id,picto('reload')).' ';
$ret.=lj('','popup_submds___param:module?button_'.$n.'_cmvld_'.$id,picto('add')).' ';
$ret.=lj('','popup_submds_'.$id.'_2__'.$id.'_cmprm',picto('edit'));
$ret.=divd('sbm',self::cmlin($p,$id));
return $ret;}

//app_menu
static function aplin($p,$id,$prm=[]){$p=$prm[0]??$p; $ret='';
$p=str_replace('\n','',$p); $r=explode(',',$p); $n=count($r);
for($i=0;$i<$n;$i++){$ra=decompact_mod($r[$i]);
	$v=ajx(trim($r[$i])); $bt=$ra[2]?$ra[2]:$ra[1]; //$bt=ajx($bt,1);
	if($r[$i])$ret.=lj('popbt','popup_submds___'.$v.'_'.$i.'_cmvld_'.$id,$bt).br();}
	//if($r[$i])$ret.=lj('popbt','popup_submds___'.$v.'_subdt_'.$i.'_'.$id,$bt).br();
$ret.=hidden($id,$p);
return $ret;}

static function appmenu($p,$id){return textarea($id,$p,40,10);}
/*$n=substr_count($p,',')+2; 
$ret=lj('','sbm'.'_submds____'.$id.'_aplin__'.$id,picto('reload')).' ';
$ret.=lj('','popup_submds___param:module?button_'.$n.'_cmvld_'.$id,picto('add')).' ';
$ret.=lj('','popup_submds_'.$id.'___'.$id.'_cmprm',picto('edit'));
$ret.=divd('sbm',self::aplin($p,$id));*/

//submods
static function submds($d,$id,$o,$ob,$prm){$r=[];//comline hangar
//echo $d.'-'.$id.'-'.$o.'-'.$ob.'-'.$prm[0].br();
if($o=='cmprm')return self::cmprm($id,'',$prm);
if($o=='cmlin')return self::cmlin('',$id,$prm);
if($o=='aplin')return self::aplin('',$id,$prm);
if($o=='cmedt')return self::cmedt($d,$id,$ob);
if($o=='cmvld')return self::cmvld($id,$prm);
if($o=='cmdel')return self::cmdel($d);
if($o=='cmpsav')return $prm[0]??'';
//mods
if($o=='mpos')return self::mpos($d,$id);
if($o=='mps')return self::mps($d,$id,$ob);
//submods
if($o=='sbmsav')$r=self::sbmsav($d,$id,$prm);
if($o=='sbmdel')$r=self::sbmdel($d,$id);
if($o=='sbmadc')return self::sbmadc($d,$id,$prm);
if($o=='sbmads'){$r=self::sbmads($d,$ob); $ob='';}
if($o=='revert')$r=self::sbmrev($d);//?
if($o=='sbmpos')return self::sbmpos($d,$id);
if($o=='sbmpsb'){if($d!=$ob)$r=self::sbmpsb($d,$ob); $ob='';}
if($o=='sbmadd')return self::sbmadd($id,$d);
if($o=='sbmedt')return self::sbmedt($d,$id,$ob);
if($o=='sbmove')$r=self::sbmove($d);//?
if($o=='sbmfrom')$r=self::sbmfrom($d);
if($o=='sbmpct')return self::sbmpct($d);
if($o=='deft')self::deft();
return self::desktop($id,$ob,'',$r);}

static function deft(){
msql::copy('users',ses('qb').'_apps','users',ses('qb').'_apps_sav');
msql::copy('system','default_apps_users','users',ses('qb').'_apps');}

//modpos
static function mpos($ka,$vl){$r=define_modc_b($vl); $ret='';
	foreach($r as $k=>$v){$t=console::build_mod_subname($v);
	if($k==$ka)$ret.=lj('active','',$t).br();
	else $ret.=lj('','mdls'.$vl.'_submds__x_'.$ka.'_'.$vl.'_sbmps_'.$k,$t).br();}
	ses::$r['popw']=240; ses::$r['popt']='position'; return divc('nbp',$ret);}
static function mps($ka,$vl,$va){if($ka==$va)return;
	$r=msql_read('',$_SESSION['modsnod']); $ra=msql::move($r,$ka,$va);
	msql::modif('',$_SESSION['modsnod'],$ra,'mdf','',''); 
	boot::define_mods(); boot::define_condition(); return console::block($vl);}

//submod (msql)
static function locapps($p='',$n=''){return msql_read('',nod('apps'),$p,$n);}//optional n?
static function submod_comline($id,$v){$r=msql_read('system','admin_modules','',1); 
	$rb=self::user_mods(); if($rb)$r+=$rb; ksort($r); $rt=implode(' ',array_keys($r)); 
	return dropmenuprep($rt,$id,$v,'1');}
static function sbmpos($ka,$id){$r=self::locapps('',1); $ret='';
	foreach($r as $k=>$v){if($k==$ka)$ret.=lj('active','',$v[0]).' ';
	else $ret.=lj('','sbm_submds__x_'.$ka.'_'.$id.'_sbmpsb_'.$k,$v[0]).' ';}
	ses::$r['popw']=240; ses::$r['popt']='position'; return divc('nbp',$ret);}
static function sbmpsb($ka,$va){$ra=msql::move(self::locapps(),$ka,$va);
	return msql::modif('',ses('qb').'_apps',$ra,'mdf','','');}
static function sbmsav($p,$id,$r){for($i=0;$i<=9;$i++)$ra[]=$r[$i]??'';
	return msql::modif('',ses('qb').'_apps',$ra,'one','',$p);}
static function sbmdel($d,$id){
	return msql::modif('',ses('qb').'_apps','','del','',$d);}
static function sbmads($d,$v){$r=msql::row('system','default_apps'.($v?'_'.$v:''),$d);
	if($r)return msql::modif('',nod('apps'),$r,'push');}
static function sbmadc($d,$id,$prm){$r=['new',$d,'','','','desk','','','',''];
	$ra=msql::modif('',ses('qb').'_apps',$r,'push');
	foreach($ra as $k=>$v)$key=$k; return self::sbmedt($k,$id,'');}
static function sbmfrom($d){$r=self::locapps($d);
	if($r)return msql::modif('',ses('qb').'_apps',$r,'push');}
static function sbmrev($m){echo btn('txtalert','empty table '.$m.': default copied');
	return msql::copy('system','default_apps'.$m,'users',ses('qb').'_apps');}
static function sbmove($d){$r=self::locapps(); $ra=$r[$d-1]; $r[$d-1]=$r[$d]; $r[$d]=$ra;
	return msql::modif('',ses('qb').'_apps',$r,'mdf','','');}
static function sbmpct($d){$r=msql_read('system','edition_pictos','',1); $ret='';
	foreach($r as $k=>$v)$ret.=lj('','___jx_'.$d.'_'.$k,picto($k,24)).' '; 
	ses::$r['popw']=320; ses::$r['popt']='pictos'; return $ret;}

static function sbmadd($id,$d){$ver=''; $rb=[]; pr($d);
	$top=hlpbt('apps_add').' '; if($d)$ver='_'.$d;
	$top.=ljp(att(nms(104)),'sbm_submds____'.$id.'_deft',picto('update')).' ';
	$top.=msqbt('system','default_apps').' '; 
	$top.=lj(active($d,''),'popup_submds__x__'.$id.'_sbmadd','defaults').' ';
	$top.=lj(active($d,'desk'),'popup_submds__x_home_'.$id.'_sbmadd','home').' ';
	$top.=lj(active($d,'desk'),'popup_submds__x_desk_'.$id.'_sbmadd','desk').' ';
	$top.=lj(active($d,'dev'),'popup_submds__x_dev_'.$id.'_sbmadd','dev').' ';
	$r=msql::read_b('system','default_apps'.$ver,'',1); if($r)$ra=msql::cat($r,1,1);
	if($ra)foreach($ra as $va){$bt=picto('file',32).$va;
		$rb[$va][]=lj('sicon','popup_submds__x_'.$va.'_'.$id.'_sbmadc',$bt).' ';
		foreach($r as $k=>$v){$bt=picto($v[7],32).$v[0];
			if($v[1]==$va)$rb[$va][]=lj('sicon','sbm_submds__x_'.$k.'_'.$id.'_sbmads_'.$d,$bt).' ';}}
ses::$r['popw']=320; ses::$r['popt']=nms(92).' Apps';
return $top.make_tabs($rb).divc('clear','');}

static function sbmedt($p,$id,$cnd){$rid=randid(); if($p)$r=self::locapps($p);
if($r['type']=='mod')$arb=msql::row('system','admin_modules',$r['process']);
$h=msql::row('system','admin_tools',$r['type']); $ri=[]; $rb=[]; $ret='';
foreach($r as $k=>$v){$ri[]=$k.$rid; $hk=$h[$k]??'';
if($hk!='0'){
	if($k=='hide')$rb[$k]=checkbox_j($k.$rid,$v,''); 
	elseif($k=='private')$rb[$k]=checkbox_j($k.$rid,$v,''); 
	elseif($r['type']=='mod'){$no=''; $h[$k]=$arb[$k]??'';
		if($k=='option' && ($arb['option']??'')==='0')$no=1;
		if(!$no)$rb[$k]=input($k.$rid,$v); else $rb[$k]=hidden($k.$rid,'');
		if($k=='type')$rb[$k]=hlpbt('submod_types');
		if($k=='process'){$rb[$k]=self::submod_comline($k.$rid,$v);
			if($v)$rb[$k]=self::admhlp('grey',ajx($v),'description');}
		if($k=='param')$rb[$k]=self::admhlp('grey',ajx($r['process']),'help');}
	else $rb[$k]=input($k.$rid,$v);
	if($k=='condition')$rb[$k]=' '.jump_btns($k.$rid,'menu|desk|boot|home|user',' ');//|favs
	if($k=='icon')$rb[$k]=' '.lj('txtx','popup_submds___'.$k.$rid.'__sbmpct','pictos');
	$rb[$k].=' '.btn('txtsmall2',$h[$k]??'');}
else $ret=hidden($k.$rid,$v);}
$ids=implode(',',$ri);
$bt=lj('popbt','sbm_submds__x_'.$p.'_'.$id.'_sbmfrom_'.$cnd,nms(44)).' ';
$bt.=lj('popbt','sbm_submds_'.$ids.'__'.$p.'_'.$id.'_sbmsav_'.$cnd,nms(66)).' ';
$bt.=lj('popsav','sbm_submds_'.$ids.'_x_'.$p.'_'.$id.'_sbmsav_'.$cnd,nms(57));
$bt.=lj('popbt','popup_apps,play___'.$p,nms(65)).' ';
$bt.=lj('popdel','sbm_submds__x_'.$p.'_'.$id.'_sbmdel_'.$cnd,pictit('del',nms(43)));
$ret.=on2cols($rb,300,4); $ret.=divs('',$bt);
ses::$r['popw']=320; ses::$r['popt']='Apps ('.$p.')';
return $ret;}

static function desktop($id,$cnd,$sys='',$r=''){//id=dir;cnd=;sys=;
$rid=randid('mp'); $m='apps'; $ar=[];
$top=lj('','sbm_submds_____'.$sys,picto('reload')).'';
$top.=lj('txtx','sbm_submds____'.$id.'_'.$sys,'root').'';
$ra=explode('/',$id); foreach($ra as $k=>$v){$idb[]=$v;
	if($v)$top.=lj('txtx','sbm_submds____'.implode('/',$idb),$v).'';}
$top.=' '.self::admhlp('grey',$m,'help').' ';
foreach(['menu','desk','boot','home','user'] as $v)//,'favs'
	$top.=lj($cnd==$v?'txtaa':'txtab','sbm_submds____'.$id.'__'.$v,$v).' ';
$top.=ljp(att(nms(103)),'popup_submds____'.$id.'_sbmadd',picto('plus')).' ';
$top.=msqbt('',ses('qb').'_'.$m).' ';
if(rstr(61) && $m=='apps')$top.=hlpbt('apps','alert');
$top.=msqbt('system','default_apps').' ';
$top.=lj('txtsmall2','popup_admin___apps_1','sys').' ';
if($sys)$r=msql::read_b('system','default_apps','',0);
elseif(!$r)$r=msql_read('',nod($m),'',0);
//$ar[]=['','button','root','type','condition',nms(105)];
if(!$r)$r=self::sbmrev('');
foreach($r as $k=>$v)if(($cnd && strpos($v[5],$cnd)!==false) or !$cnd){
	$prv=$v[9]?picto('lock'):'';
	$up=lj('','popup_submds___'.$k.'_'.$id.'_sbmpos',picto('up',10)).' ';
	$bt=lj($v[8]?'grey':'','popup_submds___'.$k.'_'.$id.'_sbmedt_'.$cnd,pictxt($v[7],$v[0]));
	$cd=strpos($v[5],'menu')!==false?picto('submenu'):'';
	$cd.=strpos($v[5],'desk')!==false?picto('desktop'):'';
	$cd.=strpos($v[5],'boot')!==false?picto('caution'):'';
	$cd.=strpos($v[5],'home')!==false?picto('home'):'';
	$cd.=strpos($v[5],'user')!==false?picto('user'):'';
	$dir=$v[6]?lj('','sbm_submds____'.$v[6].'_'.$cnd.'_'.$sys,$v[6]):'';
	if(substr($v[6],0,strlen($id))==$id or !$id)
		$ar[$k]=[$up,$bt,$dir,$v[1],$cd,$prv];}//,$v[2],$v[5]
$ret=tabler($ar,1).hidden($id,'');
return divd('sbm',$top.$ret);}

static function submod_pop(){
ses::$r['popw']=460; ses::$r['popt']='Apps';
return self::desktop('','');}
//static function dskbk_slct(){$r=msql('system','edition_desktop','',1);}

//artmod_edit
static function artmod_edit_t($a,$b,$prm){$r=arr($prm,3); return $r[0].','.$r[1].':'.$r[2];}
static function artmodEditJ($a,$b,$prm){$d=$prm[0]??'';
$r=['-'=>'','id'=>'id1|id2','cat'=>'cat1|cat2','nocat'=>'cat','tag'=>1,'(utag)'=>1,'minday'=>'7','hours'=>'12','from'=>'01-01-12','until'=>'01-12-12','limit'=>'10','preview'=>'true/false/full/auto','priority'=>'1|2|3|4','nbchars'=>'<4000','order'=>'day desc','lang'=>'en','search'=>'word','template'=>'read','cols'=>'3','nodig'=>'1','nopages'=>'1']; $sj=sj('amc_call___adminx_artmodEditJ_'.$a.'__sdx');
$ret=select(['id'=>'sdx','onchange'=>$sj],$r,'kk',$d);
if($d){$ret.=hidden('amca',$d).input('amcb',$r[$d]);
$ret.=lj('popbt',$a.'_admx,artmod*edit*t_'.$a.',amca,amcb','add',4);
$ret.=' '.hlpbt('call_arts');}
return $ret;}
static function artmod_edit($d,$id=''){$ret=btn('txtcadr','edit_art_mod');
$ret.=divd('amc',self::artmodEditJ('edm','','')); $ret.=input('edm','');
$ret.=lj('popbt','amed_adminx,mod*edit*j_articles_1_edm','edit_mod');
$ret.=divd('amed',''); $ret.=mc::assistant('mp','insert_jc','articles\',\'mp','','');
return $ret;}

//config_mod
static function configmod($mnb,$option){
$rm=msql::row('',$_SESSION['modsnod'],$mnb,1); if(!$rm)return;
$mod=$rm['module']; $bloc=$rm['block']; $param=$rm['param'];
if(strpos($param,',') && $mod!='connector'){$param=str_replace(', ',",\n",$param);
	$param=preg_replace("/(\n){2,}/","\n",$param);}
$arb=msql::row('system','admin_modules',$mod,1);//props
	if(!$arb)return lj('popdel','mdls'.$bloc.'_modsav__x_'.$bloc.'_'.$mnb.'_del',nms(43));
	$type=$arb['category']; $prm=$arb['param']; $opt=$arb['option'];
	$com=$arb['command']; $com=str_replace('scroll','scroll scrold',$com);
$arc=msql::row('lang','admin_modules',$mod,1); $fhlp=$arc['description'];
if(strpos(prma('blocks'),$mod)!==false && $mod){
	$type='div'; $fhlp=$fhlp?$fhlp:nms(90); $prm=3; $arb['title']=1;}
elseif(!$type && $mod!='system'){$type='user_mod'; $fhlp='obsolete';}
elseif($mod=='Page_titles')$fhlp.=' '.hlpbt('breadcrumb');
if($bloc=='menus'){$type='menu_link'; $fhlp='menu link';}
if($arc['help'])$phlp=self::admhlp('grey',ajx($mod),'help').' '; else $phlp='';
if($arc['option'])$ohlp=self::admhlp('grey',ajx($mod),'option').' '; else $ohlp='';
if($arc['command'])$dhlp=self::admhlp('grey',ajx($mod),'command').' '; else $dhlp='';
//usage
$rc=['module'=>balb('strong',$mod).' ('.$type.') '.$mnb,'usage'=>divc('small',$fhlp)];
if(sesr('line',$param))$rc['article']=lkt('',htac('cat').$param,$param);
elseif($prm==2){//wait_ID
	if(!is_numeric($param))$id=ma::find_id($param); else $id=$param;
		if(is_numeric($id) && $param>3){[$dy,$frm,$suj,$amg]=ma::pecho_arts($id);//art
		$rc['article']=lkt('','/'.$id,$suj);}}
$rid=randid(); $rds=['mb','mm','mp','mt','mc','md','mo','mh','mv','me','mr','mi','pv','pp'];
foreach($rds as $k=>$v)$rvs[$v]=$v.$rid; $dvs=join(',',$rvs);
$form=hidden($rvs['mm'],$mod);
//edit
if($mod=='submenus'){require_once('spe.php'); $rc['edit']=self::menus_h($mnb); 
	if($option)$param=self::menu_h_g($option);}
elseif($mod=='MenuBub'){
	$da='root,action,type,button,icon,auth'; $phlp=hlpbt('menubub'); $param=$param?$param:1;
	//$rc['edit']=msqedit::call('menubub_'.$param,$da);
	$rc['edit']=lj('','popup_msqedit,call___menubub*'.$param.'_'.$da,picto('edit')).' '.hlpbt('menubub_edit');}
if($mod=='Banner')$rc['edit']=lkc('popbt','/admin/banner','edit_banner');
elseif($mod=='user_menu')$rc['edit']=jump_btns($rvs['mp'],self::spelinks(),' ');
elseif($mod=='app_menu'){$rc['edit']=btn('console','button/type/process/param/option/condition/root/icon/hide/private?display[,]');}
elseif($mod=='link' or $mod=='url'){$arr=explode('|',self::spelinks());
	if($_SESSION['line'])$arr+=array_flip($_SESSION['line']);
	$rs=['id'=>'mps','onchange'=>'jumpslct(\''.$rvs['mp'].'\',this)','style'=>'width:90px;'];
	$rc['edit']=select($rs,$arr,'vv');}
elseif($mod=='template'){$ra=msql_read('',nod('template'),'',1); 
	if($ra){$rb=array_keys_r($ra,1,'k'); $rc['edit']=jump_btns($rvs['mp'],$rb,'');}}
elseif($mod=='msql_links')$rc['edit']=jump_btns($rvs['mp'],'links|rssurl|deploy','');
elseif($mod=='connector'){$rc['edit']=connbt($rvs['mp']);}
elseif($mod=='desktop')$rc['edit']=hlpbt('desklr');
elseif($mod=='cssfonts')$rc['edit']=jump_btns($rvs['mp'],'fontphilum|fontmicrosys|',' ');
elseif($mod=='columns')$rc['edit']=self::mod_edit('',1,$rvs['mp']);
elseif($mod=='api_chan'){$prm2=is_numeric($param)?$param:1; $da='api,button,icon,color,hide';
	$rc['edit']=lj('','popup_msqedit,call___apichan*'.$prm2.'_'.$da,picto('edit'));}
elseif($mod=='folders_varts'){
	$rc['edit']=lj('poph','popup_meta,virtualfolder___'.$rvs['mp'],nms(73));}
elseif($mod=='articles' or $mod=='api_arts')
	$rc['edit']=divd('amc',self::artmodEditJ($rvs['mp'],'',''));
elseif($mod=='design' && prmb(5))$rc['edit']=picto('alert').helps('prmb5');
//param
if($mod=='tab_mods' or $mod=='MenusJ' or $mod=='art_mod')$rc['param']=self::comline($param,$rvs['mp']);
elseif($mod=='app_menu')$rc['param']=self::appmenu($param,$rvs['mp']);
elseif($mod=='submenus')$rc['param']=textarea($rvs['mp'],$param,42,4);
elseif($prm!='0')$rc['param']=goodarea($rvs['mp'],$param,42);
else{$rc['param']=''; $form.=hidden($rvs['mp'],'');}
if($mod=='desktop'){$rc['edit']=$phlp; $rc['param'].=' '.hlpbt('desklr');}//dskbk_slct().
elseif($rc['param'] && $mod!='apps' && $phlp)$rc['param'].=' '.$phlp;
//title
if($prm!='1' && !$arb['title']){
	if($mod=='Banner')$rc['title']=textarea($rvs['mt'],$rm['title'],42,4);
	else $rc['title']=input1($rvs['mt'],$rm['title'],ats(42).' onkeypress="checkEnter(event,\'savmod\');"');}
else $form.=hidden($rvs['mt'],'');
//bloc
if($bloc!='system' && $bloc!='newsletter' && $bloc!='gsm'){
$rc['bloc']=select_j($rvs['mb'],'system '.prma('blocks'),$bloc,1,$bloc,0);}
else $form.=hidden($rvs['mb'],$bloc);
//condition
if($bloc!='newsletter')$rc['context']=select_j($rvs['mc'],'- home cat art '.ajx($rm['condition']),$rm['condition'],3,$rm['condition'],0).' '.hlpbt('mod_cond');
else $form.=hidden($rvs['mc'],'');
//command
if($com)$rc['command']=select_j($rvs['md'],'- '.ajx($com),$rm['command'],1,$rm['command'],0).' '.$dhlp;
else $form.=hidden($rvs['md'],'');
//option
if($opt!='0'){
	$rc['option']=select_j($rvs['mo'],'- '.$opt,$rm['option'],3,$rm['option'],0).' ';
	if($mod=='LOAD')$rc['option'].=hlpbt('art_render'); else $rc['option'].=$ohlp;}
else $form.=hidden($rvs['mo'],'');
//template
if($arb['template']){$tmp='';
	$ara=msql_read('',nod('template'),'',1); if($ara)$tmp=implode(' ',array_keys($ara));
	$rc['template']=select_j($rvs['me'],'- '.ajx($tmp),$rm['template'],1,$rm['template'],0);}
else $form.=hidden($rvs['me'],'');
//cache
$rc['toggles']='';
if($arb['cacheable'])$rc['toggles']=checkbox_j($rvs['mh'],$rm['cache'],'cache');
else $form.=hidden($rvs['mh'],'');
$rc['toggles'].=checkbox_j($rvs['mv'],$rm['hide'],nms(30));//hide
if($arb['nobr']!='0')$rc['toggles'].=checkbox_j($rvs['mr'],$rm['nobr'],'nobr');//nobr
else $form.=hidden($rvs['mr'],'');
if(($arb['div']??'')!='0')$rc['toggles'].=checkbox_j($rvs['mi']??'',$rm['div']??'','div');//divmod
else $form.=hidden($rvs['mi'],'');
if(($arb['prv']??'')!='0')$rc['toggles'].=checkbox_j($rvs['pv']??'',$rm['prv']??'','prv');//prv
else $form.=hidden($rvs['pv'],'');
if($arb['pop']!='0')$rc['toggles'].=checkbox_j($rvs['pp']??'',$rm['pop']??'','pop');//pop
else $form.=hidden($rvs['pp'],'');
//save
$bt=lj('popbt','mdls'.$bloc.'_modsav_'.$dvs.'__'.$bloc.'_'.$mnb.'_savb_',nms(66));//apply
$bt.=lj('popsav','mdls'.$bloc.'_modsav_'.$dvs.'_x_'.$bloc.'_'.$mnb.'_sav_',nms(57));
$bt.=lj('popbt','mdls'.$bloc.'_modsav_'.$dvs.'_x_'.$bloc.'_'.$mnb.'_new_',nms(44));
$bt.=lj('popdel','mdls'.$bloc.'_modsav_'.$dvs.'_x_'.$bloc.'_'.$mnb.'_del_',nms(43));
$bt.=lj('popbt','popup_submds___'.$mnb.'_'.$bloc.'_mpos',nms(158));
//script
if($type!='system'){
$bt.=lj('popbt','popup_md,modsee__3_'.$mnb.'_1','script').hlpbt('comline').' ';
$bt.=lj('popbt','popup_md,modsee__3_'.$mnb,nms(65)).' ';}
$bt.=msqbt('system','admin_modules',$mod);
//render
$ret=$form.on2cols($rc,470,5);
$ret.=div('',$bt);
return $ret;}

static function spelinks(){return'home|All|hubs|cat|context|plan|taxonomy|tracks|gallery|rss|disk|time|lang|root|desk|desktop|deskboot|folder|search|contact|credits|admin|/module/|tablet|home?home:picto|mod?4-gsm|apps?14:default|br';}

#retrictions
static function defaults_rstr($u){
if($u)$r=msql_read('users',nod('rstr'),'',1);
else $r=msql_read('system','default_rstr','',1);
return arr($r,140);}

static function edit_rstr(){
$ret=msqbt('users',ses('qb').'_rstr');
$ret.=console::admactbt('bckp_rstr','backup');
$ret.=console::admactbt('restore_rstr','restore');
$ret.=msqbt('system','default_rstr');
$ret.=console::admactbt('reset_rstr','reset');
$ret.=console::admactbt('mkdefaults_rstr','mkdefaults');
if($bcp=get('backup') && auth(6))self::backup_rstr($bcp);
return $ret;}

static function backup_rstr_msql($r){$rc=[]; $max=max(array_keys($r));
for($i=1;$i<=$max;$i++)$rc[$i]=!empty($r[$i])?[1]:[0];
	if(get('backup')=='mkdflts'){$bs='system'; $nd='default';}
	else{$bs='users'; $nd=ses('qb');}
msql::save($bs,$nd.'_rstr',$rc,['rstr']);}

static function modifparams($slct,$restrict){
$_SESSION['rstr'][$slct]=$restrict;
if($_SESSION['rstr'][63]==1)$_SESSION['negcss']=0;
self::backup_rstr('save');}

static function showparamscat($r,$h){$ron=1;$fon=0; $j='lang_admin*restrictions_';
foreach($r as $k=>$v){
//$hlp=bubble('txtsmall2','usg,popmsqt',$j.$k.'_description',$k);
$hlp=togbub('usg,popmsqt',$j.$k.'_description',$k,'txtsmall2');
$t=$h[$k][0]??$v; if(rstr($k)){$n=1; $c='';} else {$n=0; $c='active';}
$ret[]=togon($n).' '.btn('',lj('','rstr_admx,showparams___'.$k.'_'.$n,$t)).$hlp.br();}
return divc('nbp cols',implode('',$ret));
return divc('nbp',self::colonize($ret,3,'','',550));}

static function colonize($re,$prm,$id,$cls,$w='',$b=''){$b=$b?'div':'ul';
$w=$w?$w:cw()-10; $ret=onxcols($re,$prm,$w); 
$wb=atd($id).atc($cls).ats('');
return bal($b,$wb,$ret).divc('clear','');}

static function showparams($slct,$restrict){$rb=[];
$r=msql::prep('system','admin_restrictions');
$h=msql::read('lang','admin_restrictions');
if($slct && auth(6))self::modifparams($slct,$restrict);
foreach($r as $k=>$v)$rb[$k]=self::showparamscat($v,$h);
if(auth(6))$bt=msqbt('system','admin_restrictions','','imgr'); ksort($rb);
//foreach($rb as $k=>$v)$ret.=balb('h4',$k).divc('nbp',$v).br(); return $bt.$ret;
return $bt.make_tabs($rb,'rst');}

static function getrstr($b){
if($b=='defaults')$_SESSION['rstr']=admx::defaults_rstr(0);
elseif($b=='restore')$_SESSION['rstr']=admx::defaults_rstr(1);
$r=$_SESSION['rstr']; if(!$r)$r=admx::defaults_rstr(0);
return $r;}

static function rstrsav($d){
if($d)$_SESSION['rstr'][$d]=rstr($d)?'1':'0';
if(auth(6))admx::backup_rstr('save');
return 'rstr'.$d.': '.offon(rstr($d));}

static function backup_rstr($b){$r=self::getrstr($b);
if($b!='restore' && $b!='defaults')self::backup_rstr_msql($r);
if(is_array($r))array_unshift($r,'0');
if($b!='=' && is_array($r))update('qdu','rstr',implode('',$r),'name',ses('qb'));}

static function restrictions(){
$edt=div('',self::edit_rstr()).br();
$prm=self::showparams(get('slct'),get('restrict'),'');
return $edt.divd('rstr',$prm);}

#add_mod
static function prep_cond_mods($vl){$r=define_modc_b($vl); $ret=[];
if($r)foreach($r as $k=>$v)$ret[$v[0]]=$k; return $ret;}

#good_array
//defd=constantes//defb=onetime//defc=restantes 
static function whose_mods($re,$vl,$defs){//(4412)
if($defs){
if($vl=='system'){$defd=$defs['system'];
	$addr=explode(' ',prma('blocks').' template');
	foreach($addr as $k=>$v){if(!$defd[$v] && $v)$defd[$v]=3;}}
elseif($vl=='menu'){$defb=$defs['once']; $defd=$defs['multi']+$defs['connectors'];}
elseif($vl=='leftbar' or $vl=='rightbar'){$defb=$defs['once'];
	$defd=$defs['multi']+$defs['connectors']+$defs['articles'];}
elseif($vl=='content'){$defb=$defs['content']+$defs['once']; 
	$defd=$defs['multi']+$defs['connectors']+$defs['articles'];
	$defd+=['chat'=>$defs['once']['chat']];}
elseif($vl=='newsletter'){$defb=$defs['content']+$defs['once'];
	$defd=$defs['multi']+$defs['connectors']+$defs['articles'];}
elseif($vl=='banner'){$defb=$defs['multi']+$defs['once']; $defd=$defs['connectors']+$defs['articles'];}
elseif($vl=='footer'){$defb=$defs['multi']+$defs['footer']+$defs['once']; $defd=$defs['connectors']+$defs['articles'];}
else{$defb=$defs['once']; $defd=$defs['content']+$defs['articles']+$defs['multi']+$defs['connectors']+$defs['footer']+$defs['articles'];}
$mod=self::user_mods(); if($defd && $mod)$defd+=$mod; elseif($mod)$defd=$mod;
if($defb)$defc=array_combine_sub($defb,$re);//php4
//if($defb)$defc=array_diff_key($defb,$re);//php5 
if($defc && $defd)$defc+=$defd; else $defc=$defd;}
return [$defb,$defc,$defd];}

//menuh
static function menus_h($k){$j='popup_admx,configmod__pop_'.$k.'_';
$ret=lj('popbt',$j.'collect','collect_structure').' ';
$ret.=lj('popbt',$j.'collect|1','reverse').' - ';
$ret.=lj('popbt',$j.'nocat','no_cat').' ';
$ret.=lj('popbt',$j.'nocat|1','reverse').' - ';
$ret.=lj('popbt',$j.'append','append').' ';
$ret.=lj('popbt',$j.'append|1','reverse').' ';
return $ret;}
static function menu_h_g($d){$p=explode('|',$d); $ret='';
	if($p[0]=='append')$r=md::collect_hierarchie_b($p[1]);
	elseif($p[0]=='nocat')$r=md::collect_hierarchie_c($p[1],'');
	elseif($p[0]=='collect')$r=md::collect_hierarchie($p[1]);
if($r)foreach($r as $k=>$v){$ret.=$k."\n".md::supermenu($v);}
return $ret;}

#actions
static function call($p,$o){
$f='params/'.ses('qb').'_saveconfig.txt'; $ret=$p.':ok';
$base='msql/users/'; $nod=ses('modsnod'); $f=$base.$nod.'_sav.php';
switch($p){
//backup_config
case('bckp_cnfg'):write_file($f,implode('#',$_SESSION['prmb'])); $ret='saved'; break;
case('restore_cnfg'):$config=read_file($f); $_SESSION['prmb']=explode('#',$config);
	update('qdu','config',$config,'name',ses('qb'));
	$ret='old config restored'; break;
case('reset_cnfg'):$prmdef=login::ndprms_defaults(); $config=ses('qb').$prmdef[1];
	$_SESSION['prmb']=explode('#',$config);
	update('qdu','config',$config,'name',ses('qb')); break;
case('cnfgxt'):$ret=read_file($f); break;
//edit_rstr
case('bckp_rstr'):admx::backup_rstr('backup'); break;
case('restore_rstr'):admx::backup_rstr('restore'); break;
case('reset_rstr'):admx::backup_rstr('defaults'); break;
case('mkdefaults_rstr'):admx::backup_rstr('mkdflts'); break;
//backup_console
case('slct_mods'):boot::select_mods($o); break;
case('newfrom_mods'):adm::newmodfrom($o); boot::select_mods($o); break;
case('adopt_mods'):$d=''; foreach($_SESSION['prmb'] as $k=>$v)$d.=$v.'#';
	update('qdu','config',$d,'name',ses('qb')); break;
case('backup_mods'):copy('msql/users/'.$nod.'.php',$f); break;
case('mk_default'):msql::copy('users',$nod,'system','default_mods');
msql::copy('users',$nod,'users','public_mods_1'); alert('system/default_mods;public_mods_1'); break;
case('restore_mods'):copy($f,$base.$nod.'.php'); boot::define_mods(); boot::define_condition(); break;
case('refresh_mods'):boot::define_mods(); boot::define_condition(); break;
case('make_copy'):msql::copy('users',ses('qb').'_mods_'.ses('prmb1'),'users',$nod);
	boot::define_mods(); boot::define_condition(); break;
case('default_mods'):msql::copy('system','default_mods','users',$nod);
	boot::define_mods(); boot::define_condition(); break;
case('set_cond'):setcond($o,1); boot::define_modc(); boot::define_prma();
	return adm::console(ses('auth')); break;
case(''):; break;}
return $ret;}
}
?>