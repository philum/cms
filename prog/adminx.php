<?php
//philum_ajx_functions

#master_config//(3)
//$r=['mb','mm','mp','mt','mc','md','mo','mh','mv','me','mr','mi','mj','pp'];
function master_config($block,$mod,$act,$res){req('boot'); $r=ajxr($res);
for($i=0;$i<12;$i++)$r[$i]=$r[$i]??'';
$cond=substr($r[4],0,1)!='-'?$r[4]:''; if($act=='add')$cond=$r[2];
$r[5]=$r[5]!='-'?$r[5]:''; $r[4]=$r[4]!='-'?$r[4]:''; $r[9]=$r[9]!='-'?$r[9]:'';//4cond,5com,6opt,9tmpl,10pop
$nod=$_SESSION['modsnod']; $ret=[];
if($cond)$_SESSION['cond']=determine_cond($cond);
if($act=='sav' or $act=='savb'){
	$ret[$mod]=$r; array_shift($r); $_SESSION['mods'][$block][$mod]=$r; 
	$ret=msql::modif('',$nod,$ret,'mdf'); define_modc();}
elseif($act=='add'){
	$md=$mod?$mod:$r[1]; $pos=$r[0]; $cnd=$r[2]=='-'?'':$r[2];
	$ret=[$block,$md,'','',$cnd,'','','','','',''];
	$cmd=define_modc_b($block);
	if($cmd){$keys=array_keys($cmd); $i=0; $nmd=[];
	foreach($cmd as $k=>$v){//existants
		$nv=$v; array_unshift($nv,$block);
		$nk=$keys[$i]??''; if($nk==0)$nk='push';
		if($k==$pos){$nmd[$nk]=$nv; $i++; $nk=$keys[$i]??''; 
			if($nk==0)$nk='push'; $nmd[$nk]=$ret;}
		else $nmd[$nk]=$nv; $i++;}} 
	else $nmd[]=$ret;
	$r=msql::modif('',$nod,$nmd,'mdf');
	define_mods('',$r); define_modc(); define_prma();}
elseif($act=='new'){$nv=$r; $nv[0]=$block; $r=msql::modif('',$nod,$nv,'push'); 
	define_mods('',$r); define_modc(); define_prma();}
elseif($act=='del'){unset($_SESSION['mods'][$block][$mod]); msql::modif('',$nod,$mod,'del');
	define_modc(); define_prma();}
elseif($act)$_SESSION['cond']=determine_cond($act);
if($block=='newsletter'){define_mods('');}
return console::block($block,$ret);}

function bar_add_mod($vl){
$r=msql_read('system','admin_modules','',1);
if($r)foreach($r as $k=>$v)$defs[$v[0]][$k]=$v[1];
$re=prep_cond_mods($vl); $df=[];
list($defb,$defc,$defd)=whose_mods($re,$vl,$defs);
$def=array_merge($defc,$defd);
$ret=btn('txtsmall','module:'); ksort($def); 
$ret.=select(atn('bar').atd('modbar'),$def,'kk');
$ret.=btn('txtsmall','context:');
$cond=$_SESSION['cond'][0]; $cndr=['-','home','cat','art']; //$cndr[]=$cond;
$ret.=select(atn('cond').atd('modcond'),$cndr,'vv',$cond);
$ret.=btn('txtsmall','position:');
if(!is_array($re))$re=['-'=>'-']; end($re); $pos=current($re);//select last
$ret.=select(atn('pos').atd('modpos'),array_flip($re),'kv',$pos).' ';
$ret.=lj('popsav','mdls'.$vl.'_modules__x_'.$vl.'__add__modpos|modbar|modcond',nms(92)).br().br();
$ret.=divc('imgr',hlpbt('modules'));
$hlp=msql_read('lang','admin_modules','');//help
foreach($def as $k=>$v){$cat=valr($r,$k,0); if(!$cat)$cat='user';
	if(!sesr('line',$k))$df[$cat][]=div('',lj('popbt','mdls'.$vl.'_modules__x_'.$vl.'_'.ajx($k).'_add__modpos|modbar|modcond',$k).btn('txtsmall',valr($hlp,$k,0)));}
$ret.=make_tabs($df);
return $ret;}

#config_mod
function user_mods(){$ret=[];
$r=msql_read('',ses('qb').'_modules','',1);
if($r)foreach($r as $k=>$v){$ret[$k]=[$k,1];}
return $ret;}

//mod_edit (create_comline)
function mod_edit_pop($o){$c=$o?'module':'ajax';
$inject=assistant('mp','insert_jc',$c.'\',\'mp','','');
return mod_edit('',$o).$inject;}

function admhlp($c,$t,$e){
//return bubble($c,'popmsqt','lang_admin*modules_'.$t.'_'.$e,picto('info'));
return togbub('msqlcall','lang_admin*modules_'.$t.'_'.$e,picto('help'),'grey');}

function mod_edit_j($v,$o,$pa,$id=''){if(!$id)$id='mp';
if($pa)$pa=ajx(substr($pa,0,-1),1); $r=msql::row('system','admin_modules',$v,1); 
$ret=admhlp('imgr',ajx($v),'description');
$ra=['param','title','command','option','module']; $d='"size="11" id="mde';
if(!$o)$ra[]='button';
for($i=0;$i<count($ra);$i++){$cm[]='mde'.$i; $vb=$ra[$i]; 
	if($ra[$i]=='module')$va=$v; elseif($ra[$i]=='param')$va=$pa; else $va='';
	if(($vb!='command' && $r[$vb]!='0') or $r[$vb]){
		if($vb=='command' or $vb=='option')$hlp=btn('txtsmall2',$r[$vb]); else $hlp='';
		if($vb=='button' && !$o)$va=$v;
		if(substr($va,-1)=='&')$va=substr($va,0,-1);
		$rb[$vb]=input2($d.$i,ajx($va,1)).$hlp;}
	else $ret.=hidden($d.$i,'','');}
$rb[' ']=ljb('popsav','popup',implode('|',$cm).'\',\''.$id.'','add :'.$v);
$ret.=on2cols($rb,470,5);
return $ret;}

function mod_edit($p,$o,$id=''){
$ret=btn('txtcadr','command-line').' ';
$rb=msql_read('system','admin_modules','',1); 
foreach($rb as $k=>$v){if($v[0]!='system')$ra[$k]=$k;}
$ret.=btn('txtsmall2','module: ');
$ret.=select(['id'=>'sdx','onchange'=>sj('moded_medit_sdx__'.$o.'__'.$id)],$ra,'kk');
$ret.=divd('moded','');
return $ret;}

//comline (submod normaux)
function comline_sav($na,$res){$ra=ajxr($res); $prm='';
for($i=3;$i<15;$i++)$prm.=($ra[$i]??'').'/'; $prm.=':';
$prm=str_replace(['/////:','////:','///:','//:','/:'],':',$prm);
$prm.=$ra[1].'§'.$ra[2]; if(substr($prm,0,1)==':')$prm=substr($prm,1);
$r=explode(',',str_replace("\n",'',$ra[0])); $r[$na]=$prm;
return implode(",\n",$r);}

function comline_del($na,$res){$r=explode(',',ajxg($res));
foreach($r as $k=>$v){if($k!=$na)$ret.=$v.',';}
return substr($ret,0,-1);}

function comline_txt($p,$id){
$ret=btn('txtx',helps('scripts')).br();
$ret.=goodarea('edt'.$id,$p,62).br();
$ret.=ljb('popbt','SaveJb',$id.'_submds___'.$id.'__cmpsav__edt'.$id.'\',\'sbm'.'_submds____'.$id.'_cmlin__'.$id,nms(66));
return popup('edit_param',$ret);}

function comline_edit($v,$na,$id,$res){$rid=randid();
if($res)return comline_sav($na,$res);
list($cod,$mod,$t)=$ra=decompact_mod($v); $r=explode('/',trim($cod));
$ids=$id.'|medm'.$rid.'|medb'.$rid.'|';
$arb=msql::row('system','admin_modules',$mod,1);
$rb['module']=hidden('','medm'.$rid,$mod).submod_comline('medm'.$rid,$mod); 
$hlp=msql::row('lang','admin_modules',$mod,1);
$rb['usage']=divc('small',$hlp['description']??'');
$rb['button']=input('medb'.$rid,$t); $rb['toggles']='';
$rk=['param','title','command','option','cache','hide','template','nobr','div','ajxbtn'];
foreach($rk as $k=>$v){$ids.='med'.$k.$rid.'|'; $jmp=''; $com=$arb[$v]??'';
if($v=='param' or $v=='title' or $v=='command' or $v=='option' or $v=='template'){
	if($com && $v!='param' && $v!='template')
		$jmp=select_j('med'.$k.$rid,'- '.ajx($com),$com,1,picto('kdown'),0);
	if($v=='param')$jmp=' '.admhlp('grey',ajx($mod),'help');
	if($v=='template'){$ra=msql_read('',nod('template'),'',1); 
		if($ra)$tmp=implode(' ',array_keys($ra)); else $tmp='';
		$jmp=select_j('med'.$k.$rid,'- '.ajx($tmp),$com,1,picto('kdown'),0);}
	$rb[$v]=input('med'.$k.$rid,$r[$k]??'').$jmp;}
else $rb['toggles'].=checkbox_j('med'.$k.$rid,$r[$k]??'',$v);}
$sv=$id.'_submds__4x_'.$na.'__cmdel__'.$id.'\',\'sbm'.'_submds____'.$id.'_cmlin__'.$id;
$bt=ljb('popdel','SaveJb',$sv,nms(43)).' ';
$sv=$id.'_comline__4x__'.$na.'___'.$ids.'\',\'sbm_submds____'.$id.'_cmlin__'.$id;
$bt.=ljb('popbt','SaveJb',$sv,nms(66));
$ret=on2cols($rb,300,4).$bt.br();
return popup('comline',$ret,320);}

function cmlin($p,$id,$res=''){
if($res)$p=ajxg($res); $ret='';
$p=str_replace('\n','',$p); $r=explode(',',$p); $n=count($r);
for($i=0;$i<$n;$i++){$ra=decompact_mod($r[$i]);
	$v=ajx(trim($r[$i])); $bt=$ra[2]; $t=att($ra[1]);
	if($r[$i])$ret.=lj('popbt','popup_comline___'.$v.'_'.$i.'_'.$id,$bt,$t).' ';}
	//if($r[$i])$ret.=lj('popbt','popup_submds___'.$v.'_subdt_'.$i.'_'.$id,$bt).br();
$ret.=hidden('',$id,$p);
return $ret;}

//comline
function comline($p,$id){$n=substr_count($p,',')+2;
$ret=lj('','sbm'.'_submds____'.$id.'_cmlin__'.$id,picto('reload')).' ';
$ret.=lj('','popup_comline___param:module§button_'.$n.'_'.$id,picto('add')).' ';
$ret.=lj('','popup_submds____'.$id.'_cmprm__'.$id,picto('edit'));
$ret.=divd('sbm',cmlin($p,$id));
return $ret;}

//app_menu
function aplin($p,$id,$res=''){if($res)$p=ajxg($res);
$p=str_replace('\n','',$p); $r=explode(',',$p); $n=count($r);
for($i=0;$i<$n;$i++){$ra=decompact_mod($r[$i]);
	$v=ajx(trim($r[$i])); $bt=$ra[2]?$ra[2]:$ra[1]; //$bt=ajx($bt,1);
	if($r[$i])$ret.=lj('popbt','popup_comline___'.$v.'_'.$i.'_'.$id,$bt).br();}
	//if($r[$i])$ret.=lj('popbt','popup_submds___'.$v.'_subdt_'.$i.'_'.$id,$bt).br();
$ret.=hidden('',$id,$p);
return $ret;}

function appmenu($p,$id){$n=substr_count($p,',')+2;
return textarea($id,$p,40,10);
$ret.=lj('','sbm'.'_submds____'.$id.'_aplin__'.$id,picto('reload')).' ';
$ret.=lj('','popup_comline___param:module§button_'.$n.'_'.$id,picto('add')).' ';
$ret.=lj('','popup_submds____'.$id.'_cmprm__'.$id,picto('edit'));
$ret.=divd('sbm',aplin($p,$id));}

//submods
function submds($d,$id,$o,$ob,$res){$r=[];//comline hangar
//echo $d.'-'.$id.'-'.$o.'-'.$ob.'-'.$res;
if($o=='cmprm')return comline_txt(ajxg($res),$id);
if($o=='cmlin')return cmlin('',$id,$res);
if($o=='aplin')return aplin('',$id,$res);//
//if($o=='cmsav')return comline_sav($d,$res);
if($o=='cmdel')return comline_del($d,$res);
if($o=='cmpsav')return ajxg($res);
//mods
if($o=='mpos')return mod_pos($d,$id);
if($o=='mps')return mod_mps($d,$id,$ob);
//submods
if($o=='sav')$r=submod_sav($d,$id,$res);
if($o=='del')$r=submod_del($d,$id);
if($o=='adc')return submod_adc($d,$id,$res);
if($o=='ads'){$r=submod_ads($d,$ob); $ob='';}
if($o=='revert')$r=submod_revert($d);
if($o=='pos')return submod_pos($d,$id);
if($o=='psb'){if($d!=$ob)$r=submod_psb($d,$ob); $ob='';}
if($o=='add')return submod_add($id,$d);
if($o=='edit')return submod_edit($d,$id,$ob);
if($o=='move')$r=submod_move($d);
if($o=='from')$r=submod_from($d);
if($o=='pcto')return submod_picto($d);
if($o=='deft'){msql::copy('users',ses('qb').'_apps','users',ses('qb').'_apps_sav');
	msql::copy('system','default_apps_users','users',ses('qb').'_apps');}
return adm_desktop($id,$ob,'',$r);}

//modpos
function mod_pos($ka,$vl){$r=define_modc_b($vl); $ret='';
	foreach($r as $k=>$v){$t=console::build_mod_subname($v);
	if($k==$ka)$ret.=lj('active','',$t).br();
	else $ret.=lj('','mdls'.$vl.'_submds__x_'.$ka.'_'.$vl.'_mps_'.$k,$t).br();}
	return popup('position',divc('nbp',$ret),240);}
function mod_mps($ka,$vl,$va){if($ka==$va)return; req('boot');
	$r=msql_read('',$_SESSION['modsnod']); $ra=msql::move($r,$ka,$va);
	msql::modif('',$_SESSION['modsnod'],$ra,'mdf','',''); 
	define_mods(''); define_condition(); return console::block($vl);}

//submod (msql)
function locapps($p='',$n=''){return msql_read('',nod('apps'),$p,$n);}//optional n?
function submod_comline($id,$v){$r=msql_read('system','admin_modules','',1); 
	$rb=user_mods(); if($rb)$r+=$rb; ksort($r); $rt=implode(' ',array_keys($r)); 
	return menuderj_prep($rt,$id,$v,'1');}
function submod_pos($ka,$id){$r=locapps($p,1); 
	foreach($r as $k=>$v){if($k==$ka)$ret.=lj('active','',$v[0]).' ';
	else $ret.=lj('','sbm'.'_submds__x_'.$ka.'_'.$id.'_psb_'.$k,$v[0]).' ';}
	return popup('Apps position',divc('nbp',$ret),240);}
function submod_psb($ka,$va){$ra=msql::move(locapps(),$ka,$va);
	return msql::modif('',ses('qb').'_apps',$ra,'mdf','','');}
function submod_sav($p,$id,$res){$r=ajxr($res);
	for($i=0;$i<=9;$i++)$ra[]=$r[$i];
	return msql::modif('',ses('qb').'_apps',$ra,'one','',$p);}
function submod_del($d,$id){
	return msql::modif('',ses('qb').'_apps','','del','',$d);}
function submod_ads($d,$v){$r=msql::row('system','default_apps'.($v?'_'.$v:''),$d);
	if($r)return msql::modif('',nod('apps'),$r,'push');}
function submod_adc($d,$id,$res){$r=['new',$d,'','','','desk','','','',''];
	$ra=msql::modif('',ses('qb').'_apps',$r,'push');
	foreach($ra as $k=>$v)$key=$k; return submod_edit($k,$id,'');}
function submod_from($d){$r=locapps($d);
	if($r)return msql::modif('',ses('qb').'_apps',$r,'push');}
function submod_revert($m){echo btn('txtalert','empty table '.$m.': default copied');
	return msql::copy('system','default_apps'.$m,'users',ses('qb').'_apps');}
function submod_move($d){$r=locapps(); $ra=$r[$d-1]; $r[$d-1]=$r[$d]; $r[$d]=$ra;
	return msql::modif('',ses('qb').'_apps',$r,'mdf','','');}
function submod_picto($d){$r=msql_read('system','edition_pictos','',1); $ret='';
	foreach($r as $k=>$v)$ret.=lj('','___jx_'.$d.'_'.$k,picto($k,24)).' '; 
	return popup('pictos',$ret,320);}

function submod_add($id,$d){
	$top=hlpbt('apps_add').' '; if($d)$ver='_'.$d; $j='sbm'.'_submds__x_';
	$top.=ljp(att(nms(104)),'sbm'.'_submds____'.$id.'_deft',picto('update')).' ';
	$top.=msqbt('system','default_apps').' '; 
	$top.=lj(active($d,''),'popup_submds__x__'.$id.'_add','defaults').' ';
	$top.=lj(active($d,'desk'),'popup_submds__x_home_'.$id.'_add','home').' ';
	$top.=lj(active($d,'desk'),'popup_submds__x_desk_'.$id.'_add','desk').' ';
	$top.=lj(active($d,'dev'),'popup_submds__x_dev_'.$id.'_add','dev').' ';
	$r=msql_read('system','default_apps'.$ver,'',1); if($r)$ra=array_flip(msql::cat($r,1));
	if($ra)foreach($ra as $va){$bt=picto('file',32).' '.$va;
		$rb[$va].=lj('sicon','popup_submds__x_'.$va.'_'.$id.'_adc',$bt).' ';
		foreach($r as $k=>$v){$bt=picto($v[7],32).' '.$v[0];
			if($v[1]==$va)$rb[$va].=lj('sicon',$j.$k.'_'.$id.'_ads_'.$d,$bt).' ';}}
return popup(nms(92).' Apps',$top.make_tabs($rb).divc('clear',''),320);}

function submod_edit($p,$id,$cnd){$rid=randid(); if($p)$r=locapps($p);
if($r['type']=='mod')$arb=msql::row('system','admin_modules',$r['process']);
$h=msql::row('system','admin_tools',$r['type']); $ids=''; $ret='';
foreach($r as $k=>$v){$ids.=$k.$rid.'|'; $hk=$h[$k]??'';
if($hk!='0'){
	if($k=='hide')$rb[$k][]=checkbox_j($k.$rid,$v,''); 
	elseif($k=='private')$rb[$k][]=checkbox_j($k.$rid,$v,''); 
	elseif($r['type']=='mod'){$no=''; $h[$k]=$arb[$k]??'';
		if($k=='option' && ($arb['option']??'')=='0')$no=1;
		if(!$no)$rb[$k][]=input($k.$rid,$v); else $rb[$k][]=hidden('',$k.$rid,'');
		if($k=='type')$rb[$k][]=hlpbt('submod_types');
		if($k=='process'){$rb[$k][]=submod_comline($k.$rid,$v);
			if($v)$rb[$k][]=admhlp('grey',ajx($v),'description');}
		if($k=='param')$rb[$k][]=admhlp('grey',ajx($r['process']),'help');}
	else $rb[$k][]=input($k.$rid,$v);
	if($k=='condition')$rb[$k][]=' '.jump_btns($k.$rid,'menu|desk|boot|home|user',' ');//|favs
	if($k=='icon')$rb[$k][]=' '.lj('txtx','popup_submds___'.$k.$rid.'__pcto','pictos');
	$rb[$k][]=' '.btn('txtsmall2',$h[$k]??'');}
else $ret=hidden('',$k.$rid,$v);}
$bt=lj('popbt','sbm'.'_submds__x_'.$p.'_'.$id.'_from_'.$cnd,nms(44)).' ';
$bt.=lj('popbt','sbm'.'_submds___'.$p.'_'.$id.'_sav_'.$cnd.'_'.$ids,nms(66)).' ';
$bt.=lj('popsav','sbm'.'_submds__x_'.$p.'_'.$id.'_sav_'.$cnd.'_'.$ids,nms(57));
$bt.=lj('popbt','popup_appread___'.$p,nms(65)).' ';
$bt.=lj('popdel','sbm'.'_submds__x_'.$p.'_'.$id.'_del_'.$cnd,pictit('del',nms(43)));
$ret.=on2cols($rb,300,4).divs('',$bt);
return popup('Apps ('.$p.')',$ret,320);}

function adm_desktop($id,$cnd,$sys='',$r=''){//id=dir;cnd=;sys=;
$rid=randid('mp'); $m='apps'; $j='sbm_submds___';  $ar=[];
$top=lj('',$j.'__'.$sys,picto('reload')).'';
$top.=lj('txtx',$j.'_'.$id.'_'.$sys,'root').'';
$ra=explode('/',$id); foreach($ra as $k=>$v){$idb[]=$v;
	if($v)$top.=lj('txtx',$j.'_'.implode('/',$idb),$v).'';}
$top.=' '.admhlp('grey',$m,'help').' ';
foreach(['menu','desk','boot','home','user'] as $v)//,'favs'
	$top.=lj($cnd==$v?'txtaa':'txtab',$j.'_'.$id.'__'.$v,$v).' ';
$top.=ljp(att(nms(103)),'popup_submds____'.$id.'_add',picto('plus')).' ';
$top.=msqbt('',ses('qb').'_'.$m).' ';
if(rstr(61) && $m=='apps')$top.=hlpbt('apps','alert');
$top.=msqbt('system','default_apps').' ';
$top.=lj('txtsmall2','popup_admin___apps_1','sys').' ';
if($sys)$r=msql::read_b('system','default_apps','',0);
elseif(!$r)$r=msql_read('',nod($m),'',0);
//$ar[]=['','button','root','type','condition',nms(105)];
if(!$r)$r=submod_revert('');
foreach($r as $k=>$v)if(($cnd && strpos($v[5],$cnd)!==false) or !$cnd){
	$prv=$v[9]?picto('lock'):''; $jp='popup_submds___'.$k.'_'.$id.'_';
	$up=lj('',$jp.'pos',picto('up',10)).' ';
	$bt=lj($v[8]?'grey':'',$jp.'edit_'.$cnd,pictxt($v[7],$v[0]));
	$cd=strpos($v[5],'menu')!==false?picto('submenu'):'';
	$cd.=strpos($v[5],'desk')!==false?picto('desktop'):'';
	$cd.=strpos($v[5],'boot')!==false?picto('caution'):'';
	$cd.=strpos($v[5],'home')!==false?picto('home'):'';
	$cd.=strpos($v[5],'user')!==false?picto('user'):'';
	$dir=$v[6]?lj('',$j.'_'.$v[6].'_'.$cnd.'_'.$sys,$v[6]):'';
	if(substr($v[6],0,strlen($id))==$id or !$id)
		$ar[$k]=[$up,$bt,$dir,$v[1],$cd,$prv];}//,$v[2],$v[5]
$ret=tabler($ar,1).hidden('',$id,'');
return divd('sbm',$top.$ret);}

function submod_pop(){return popup('Apps',adm_desktop('',''),460);}
//function dskbk_slct(){$r=msql('system','edition_desktop','',1);}

//artmod_edit
function artmod_edit_t($a,$b,$d){$r=ajxr($d); return $r[0].','.$r[1].':'.$r[2];}
function artmod_edit_l($a,$b,$d){$d=ajx($d,1);
$r=['-'=>'','id'=>'id1|id2','cat'=>'cat1|cat2','nocat'=>'cat','tag'=>1,'(utag)'=>1,'minday'=>'7','hours'=>'12','from'=>'01-01-12','until'=>'01-12-12','limit'=>'10','preview'=>'true/false/full/auto','priority'=>'1|2|3|4','nbchars'=>'<4000','order'=>'day desc','lang'=>'en','search'=>'word','template'=>'read','cols'=>'3','nodig'=>'1','nopages'=>'1']; $sj=sj('amc_call___adminx_artmod*edit*l_'.$a.'__sdx');
$ret=select(atd('sdx').atb('onchange',$sj),$r,'kk',$d);
if($d){$ret.=hidden('','amca',$d).input('amcb',$r[$d]);
$ret.=ljc('popbt',$a,'adminx_artmod*edit*t___'.$a.'|amca|amcb','add',4);
$ret.=' '.hlpbt('call_arts');}
return $ret;}
function artmod_edit($d,$id=''){$ret.=btn('txtcadr','edit_art_mod');
$ret.=divd('amc',artmod_edit_l('edm','','')); $ret.=input('edm','');
$ret.=ljc('popbt','amed','adminx_mod*edit*j_articles_1_edm','edit_mod');
$ret.=divd('amed',''); $ret.=assistant('mp','insert_jc','articles\',\'mp','','');
return $ret;}

//config_mod
function config_mod($mnb,$option){
$rm=msql::row('',$_SESSION['modsnod'],$mnb,1); if(!$rm)return;
$mod=$rm['module']; $bloc=$rm['block']; $param=$rm['param'];
if(strpos($param,',') && $mod!='connector'){$param=str_replace(', ',",\n",$param);
	$param=preg_replace("/(\n){2,}/","\n",$param);}
$arb=msql::row('system','admin_modules',$mod,1);//props
	if(!$arb)return lj('popdel','mdls'.$bloc.'_modules__x_'.$bloc.'_'.$mnb.'_del',nms(43));
	$type=$arb['category']; $prm=$arb['param']; $opt=$arb['option'];
	$com=$arb['command']; $com=str_replace('scroll','scroll scrold',$com);
$arc=msql::row('lang','admin_modules',$mod,1); $fhlp=$arc['description'];
if(strpos(prma('blocks'),$mod)!==false && $mod){
	$type='div'; $fhlp=$fhlp?$fhlp:nms(90); $prm=3; $arb['title']=1;}
elseif(!$type && $mod!='system'){$type='user_mod'; $fhlp='obsolete';}
elseif($mod=='Page_titles')$fhlp.=' '.hlpbt('breadcrumb');
if($bloc=='menus'){$type='menu_link'; $fhlp='menu link';}
if($arc['help'])$phlp=admhlp('grey',ajx($mod),'help').' '; else $phlp='';
if($arc['option'])$ohlp=admhlp('grey',ajx($mod),'option').' '; else $ohlp='';
if($arc['command'])$dhlp=admhlp('grey',ajx($mod),'command').' '; else $dhlp='';
//usage
$rc=['module'=>balb('strong',$mod).' ('.$type.') '.$mnb,'usage'=>divc('small',$fhlp)];
if(sesr('line',$param))$rc['article']=lkt('',htac('cat').$param,$param);
elseif($prm==2){//wait_ID
	if(!is_numeric($param))$id=find_id($param); else $id=$param;
		if(is_numeric($id) && $param>3){list($dy,$frm,$suj,$amg)=pecho_arts($id);//art
		$rc['article']=lkt('','/'.$id,$suj);}}
$rid=randid(); $rds=['mb','mm','mp','mt','mc','md','mo','mh','mv','me','mr','mi','pv','pp']; $dvs='';
foreach($rds as $k=>$v){$rvs[$v]=$v.$rid; $dvs.=$v.$rid.'|';}
$sty='" onkeypress="checkEnter(event,\'savmod\')';
$form=hidden('',$rvs['mm'],$mod);
//edit
if($mod=='submenus'){require_once('spe.php'); $rc['edit']=menus_h($mnb); 
	if($option)$param=menu_h_g($option);}
elseif($mod=='MenuBub'){
	$da='root,action,type,button,icon,auth'; $phlp=hlpbt('menubub'); $param=$param?$param:1;
	//$rc['edit']=msqedit::call('menubub_'.$param,$da);
	$rc['edit']=lj('','popup_msqedit,call___menubub*'.$param.'_'.$da,picto('edit')).' '.hlpbt('menubub_edit');}
if($mod=='Banner')$rc['edit']=lkc('popbt','/admin/banner','edit_banner');
elseif($mod=='user_menu')$rc['edit']=jump_btns($rvs['mp'],spelinks(),' ');
elseif($mod=='app_menu'){$rc['edit']=btn('console','button/type/process/param/option/condition/root/icon/hide/private§display[,]');}
elseif($mod=='link' or $mod=='url'){$arr=explode('|',spelinks());
	if($_SESSION['line'])$arr+=array_flip($_SESSION['line']);
	$rs=['id'=>'mps','onchange'=>'jumpslct(\''.$rvs['mp'].'\',this)','style'=>'width:90px;'];
	$rc['edit']=select($rs,$arr,'vv');}
elseif($mod=='template'){$ra=msql_read('',nod('template'),'',1); 
	if($ra){$rb=array_keys_r($ra,1,'k'); $rc['edit']=jump_btns($rvs['mp'],$rb,'');}}
elseif($mod=='msql_links')$rc['edit']=jump_btns($rvs['mp'],'links|rssurl|deploy','');
elseif($mod=='connector'){req('art'); $rc['edit']=connedit($rvs['mp']);}
elseif($mod=='desktop')$rc['edit']=hlpbt('desklr');
elseif($mod=='cssfonts')$rc['edit']=jump_btns($rvs['mp'],'fontphilum|fontmicrosys|',' ');
elseif($mod=='columns')$rc['edit']=mod_edit('',1,$rvs['mp']);
elseif($mod=='api_chan'){$prm2=is_numeric($param)?$param:1; $da='api,button,icon,color,hide';
	$rc['edit']=lj('','popup_msqedit,call___apichan*'.$prm2.'_'.$da,picto('edit'));}
elseif($mod=='folders_varts'){req('meta');
	$rc['edit']=lj('poph','popup_virtualfolder___'.$rvs['mp'],nms(73));}
elseif($mod=='articles' or $mod=='api_arts')
	$rc['edit']=divd('amc',artmod_edit_l($rvs['mp'],'',''));
elseif($mod=='design' && prmb(5))$rc['edit']=picto(alert).helps('prmb5');
//param
if($mod=='tab_mods' or $mod=='MenusJ' or $mod=='art_mod')$rc['param']=comline($param,$rvs['mp']);
elseif($mod=='app_menu')$rc['param']=appmenu($param,$rvs['mp']);
elseif($mod=='submenus')$rc['param']=textarea($rvs['mp'],$param,42,4);
elseif($prm!='0')$rc['param']=goodarea($rvs['mp'],$param,42);
else{$rc['param']=''; $form.=hidden('',$rvs['mp'],'');}
if($mod=='desktop'){$rc['edit']=$phlp; $rc['param'].=' '.hlpbt('desklr');}//dskbk_slct().
elseif($rc['param'] && $mod!='apps' && $phlp)$rc['param'].=' '.$phlp;
//title
if($prm!='1' && !$arb['title']){
	if($mod=='Banner')$rc['title']=textarea($rvs['mt'],$rm['title'],42,4);
	else $rc['title']=input1($rvs['mt'],$rm['title'],'42'.$sty);}
else $form.=hidden('',$rvs['mt'],'');
//bloc
if($bloc!='system' && $bloc!='newsletter' && $bloc!='gsm'){
$rc['bloc']=select_j($rvs['mb'],'system '.prma('blocks'),$bloc,1,$bloc,0);}
else $form.=hidden('',$rvs['mb'],$bloc);
//condition
if($bloc!='newsletter')$rc['context']=select_j($rvs['mc'],'- home cat art '.ajx($rm['condition']),$rm['condition'],3,$rm['condition'],0).' '.hlpbt('mod_cond');
else $form.=hidden('',$rvs['mc'],'');
//command
if($com)$rc['command']=select_j($rvs['md'],'- '.ajx($com),$rm['command'],1,$rm['command'],0).' '.$dhlp;
else $form.=hidden('',$rvs['md'],'');
//option
if($opt!='0'){
	$rc['option']=select_j($rvs['mo'],'- '.$opt,$rm['option'],3,$rm['option'],0).' ';
	if($mod=='LOAD')$rc['option'].=hlpbt('art_render'); else $rc['option'].=$ohlp;}
else $form.=hidden('',$rvs['mo'],'');
//template
if($arb['template']){$tmp='';
	$ara=msql_read('',nod('template'),'',1); if($ara)$tmp=implode(' ',array_keys($ara));
	$rc['template']=select_j($rvs['me'],'- '.ajx($tmp),$rm['template'],1,$rm['template'],0);}
else $form.=hidden('',$rvs['me'],'');
//cache
$rc['toggles']='';
if($arb['cacheable'])$rc['toggles']=checkbox_j($rvs['mh'],$rm['cache'],'cache');
else $form.=hidden('',$rvs['mh'],'');
$rc['toggles'].=checkbox_j($rvs['mv'],$rm['hide'],nms(30));//hide
if($arb['nobr']!='0')$rc['toggles'].=checkbox_j($rvs['mr'],$rm['nobr'],'nobr');//nobr
else $form.=hidden('',$rvs['mr'],'');
if(($arb['div']??'')!='0')$rc['toggles'].=checkbox_j($rvs['mi']??'',$rm['div']??'','div');//divmod
else $form.=hidden('',$rvs['mi'],'');
if(($arb['prv']??'')!='0')$rc['toggles'].=checkbox_j($rvs['pv']??'',$rm['prv']??'','prv');//prv
else $form.=hidden('',$rvs['pv'],'');
if($arb['pop']!='0')$rc['toggles'].=checkbox_j($rvs['pp']??'',$rm['pop']??'','pop');//pop
else $form.=hidden('',$rvs['pp'],'');
//save
$bt=lj('popbt','mdls'.$bloc.'_modules___'.$bloc.'_'.$mnb.'_savb__'.$dvs,nms(66));//apply
$bt.=lj('popsav','mdls'.$bloc.'_modules__x_'.$bloc.'_'.$mnb.'_sav__'.$dvs,nms(57));//master_config
$bt.=lj('popbt','mdls'.$bloc.'_modules__x_'.$bloc.'_'.$mnb.'_new__'.$dvs,nms(44));
$bt.=lj('popdel','mdls'.$bloc.'_modules__x_'.$bloc.'_'.$mnb.'_del__'.$dvs,nms(43));
$bt.=lj('popbt','popup_submds___'.$mnb.'_'.$bloc.'_mpos',nms(158));
//script
if($type!='system'){
$bt.=lj('popbt','popup_modsee__3_'.$mnb.'_1','script').hlpbt('comline').' ';
$bt.=lj('popbt','popup_modsee__3_'.$mnb,nms(65)).' ';}
$bt.=msqbt('system','admin_modules',$mod);
//render
$ret=$form.on2cols($rc,470,5);
$ret.=div('',$bt);
return $ret;}//popup('Module',,460)

function spelinks(){return'home|All|hubs|cat|context|plan|taxonomy|tracks|gallery|rss|disk|time|lang|root|desk|desktop|deskboot|folder|search|contact|credits|admin|/module/|tablet|home§home:picto|mod§4-gsm|apps§14:default|br';}

#add_mod
function prep_cond_mods($vl){$r=define_modc_b($vl); $ret=[];
if($r)foreach($r as $k=>$v)$ret[$v[0]]=$k; return $ret;}

#good_array

//defd=constantes//defb=onetime//defc=restantes 
function whose_mods($re,$vl,$defs){//(4412)
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
$mod=user_mods(); if($defd && $mod)$defd+=$mod; elseif($mod)$defd=$mod;
if($defb)$defc=array_combine_sub($defb,$re);//php4
//if($defb)$defc=array_diff_key($defb,$re);//php5 
if($defc && $defd)$defc+=$defd; else $defc=$defd;}
return [$defb,$defc,$defd];}

#actions
function adm_actions($p,$o){
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
case('bckp_rstr'):rstr::backup_rstr('backup'); break;
case('restore_rstr'):rstr::backup_rstr('restore'); break;
case('reset_rstr'):rstr::backup_rstr('defaults'); break;
case('mkdefaults_rstr'):rstr::backup_rstr('mkdflts'); break;
//backup_console
case('slct_mods'):req('boot'); select_mods($o); break;
case('newfrom_mods'):req('boot'); newmodfrom($o); select_mods($o); break;
case('adopt_mods'):foreach($_SESSION['prmb'] as $k=>$v)$vaue.=$v.'#';
	update('qdu','config',$vaue,'name',ses('qb')); break;
case('backup_mods'):copy('msql/users/'.$nod.'.php',$f); break;
case('mk_default'):msql::copy('users',$nod,'system','default_mods');
msql::copy('users',$nod,'users','public_mods_1'); alert('system/default_mods;public_mods_1'); break;
case('restore_mods'):copy($f,$base.$nod.'.php'); define_mods(''); define_condition(); break;
case('refresh_mods'):req('boot'); define_mods(''); define_condition(); break;
case('make_copy'):msql::copy('users',ses('qb').'_mods_'.ses('prmb1'),'users',$nod);
	define_mods('');define_condition(); break;
case('default_mods'):msql::copy('system','default_mods','users',$nod);
	req('boot'); define_mods(''); define_condition(); break;
case('set_cond'):req('boot'); $_SESSION['cond']=determine_cond($o); define_modc(); define_prma();
	return adm_console(ses('auth')); break;
case(''):; break;}
return $ret;}

function admactbt($p,$t,$x='',$o='',$tt='',$c='txtx'){
if($x=='self'){$tg='socket'; $x='';} elseif(!$x){$tg='popup'; $x='xx';} else{$tg=$x; $c='';}
return lj($c,$tg.'_admin__'.$x.'_action_'.ajx($p).'_'.ajx($o),$t,att($tt)).' ';}

//menuh
function menus_h($k){$j='popup_module__pop_'.$k.'_';
$ret.=lj('popbt',$j.'collect','collect_structure').' ';
$ret.=lj('popbt',$j.'collect|1','reverse').' - ';
$ret.=lj('popbt',$j.'nocat','no_cat').' ';
$ret.=lj('popbt',$j.'nocat|1','reverse').' - ';
$ret.=lj('popbt',$j.'append','append').' ';
$ret.=lj('popbt',$j.'append|1','reverse').' ';
return $ret;}
function menu_h_g($d){$p=explode('|',$d);
	if($p[0]=='append')$r=collect_hierarchie_b($p[1]);
	elseif($p[0]=='nocat')$r=collect_hierarchie_c($p[1],'');
	elseif($p[0]=='collect')$r=collect_hierarchie($p[1]);
if($r)foreach($r as $k=>$v){$ret.=$k."\n".supermenu($v);}
return $ret;}

?>