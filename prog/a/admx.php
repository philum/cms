<?php 
class admx{
#master_config//(3)
//b,m,p,t,c,d,o,ch,hd,tp,bt,dv,pv,pp
static function modsav($block,$mod,$act,$r=[]){$nod=ses('modsnod');
for($i=0;$i<12;$i++){$r[$i]=$r[$i]??''; if($r[$i]=='-')$r[$i]='';}
$cond=substr($r[4],0,1)!='-'?$r[4]:''; if($act=='add')$cond=$r[2];
if($cond)boot::setcond($cond,1);
if($act=='sav' or $act=='savb'){$rt[$mod]=$r; $rt=msql::modif('',$nod,$rt,'mdf');}
elseif($act=='add'){
	$md=$mod?$mod:$r[0]; $cnd=$r[1]=='-'?'':$r[1]; //$pos=$r[2]?$r[2]:0;
	$_SESSION['cond'][0]=$cnd; $nw=randid();
	$rt[$nw]=[$block,$md,'','',$cnd,'','','','','','','','',''];
	//$r=msql::modif('',$nod,$rt,'after','',$pos);
	$r=msql::modif('',$nod,$rt[$nw],'next');}
elseif($act=='new'){$rn=$r; $rn[0]=$block; $r=msql::modif('',$nod,$rn,'push');}
elseif($act=='del'){$rm=sesr('mods',$block); $bb=$rm[$mod][0];
	if($bb=='BLOCK' or $bb=='MENU' or $bb=='ARTMOD' or $bb=='TABMOD'){$d='delsub'; $t='del_submods';}
	else{$d='delmod'; $t='del_module';}
	return lj('popdel','mdls'.$block.'_modsav__x_'.$block.'_'.$mod.'_'.$d,voc($t).' '.$mod);}
elseif($act=='delmod')msql::modif('',$nod,$mod,'del');
elseif($act=='delsub'){$rm=sesr('modc',$block); $bb=$rm[$mod][1]; $rb=ses('mods'); $rs=$rb[$bb];
	if($rs)foreach($rs as $k=>$v)msql::modif('',$nod,$k,'del'); msql::modif('',$nod,$mod,'del');}
elseif($act){boot::define_mods(); boot::define_condition(); boot::setcond($act,1);}
if($act=='sav' or $act=='savb' or $act=='add' or $act=='new' or substr($act,0,3)=='del'){
	boot::define_mods(); boot::define_modc(); boot::define_prma();}
elseif($block=='newsletter')boot::define_mods();
return console::block($block);}

#config_mod
static function user_mods(){$rt=[];
$r=msql::read('',nod('modules'),'',1);
if($r)foreach($r as $k=>$v)$rt[$k]=[$k,1];
return $rt;}

//mod_edit (create_comline)
static function modeditpop($o){$c=$o?'module':'ajax';
$inject=mc::assistant('mp','insert_jc',[$c,'mp'],'','');
return self::mod_edit('',$o).$inject;}

static function admhlp($t,$k){$j='lang_admin*modules_'.ajx($t).'_'.$k;
//return bubble('grey','usg,popmsqt',$j,picto('info'));
return togbub('msqa,msqcall',$j,picto('help'),'grey');}

static function modEditSav($v,$o,$pa,$id=''){if(!$id)$id='mp';
if($pa)$pa=ajx(substr($pa,0,-1),1); $r=msql::row('system','admin_modules',$v,1); 
$ret=self::admhlp($v,'description');
$ra=['param','title','command','option','module']; $d='"size="11" id="mde';
if(!$o)$ra[]='button';
for($i=0;$i<count($ra);$i++){$cm[]='mde'.$i; $vb=$ra[$i]; 
	if($ra[$i]=='module')$va=$v; elseif($ra[$i]=='param')$va=$pa; else $va='';
	if(($vb!='command' && $r[$vb]!='0') or $r[$vb]){
		if($vb=='command' or $vb=='option')$hlp=btn('txtsmall2',$r[$vb]); else $hlp='';
		if($vb=='button' && !$o)$va=$v;
		if(substr($va,-1)=='&')$va=substr($va,0,-1);
		$rb[$vb]=input($d,ajx($va,1),'',['name'=>$d]).$hlp;}
	else $ret.=hidden($d.$i,'');}
$rb[' ']=ljb('popsav','popup',[implode('|',$cm),$id],'add :'.$v);
$ret.=on2cols($rb,680,5);
return $ret;}

static function mod_edit($p,$o,$id=''){
$ret=btn('txtcadr','command-line').' ';
$rb=msql::read('system','admin_modules','',1); 
foreach($rb as $k=>$v){if($v[0]!='system')$ra[$k]=$k;}
$ret.=btn('txtsmall2','module: ');
$ret.=select(['id'=>'sdx'],$ra,'kk','moded_admx,modEditSav_sdx__'.$o.'__'.$id.'_',);
$ret.=divd('moded','');
return $ret;}

//modpos
static function mpos($ka,$vl){$r=boot::context_mods($vl); $ret='';
	foreach($r as $k=>$v){$t=console::mod_name($v);
	if($k==$ka)$ret.=lj('active','',$t).br();
	else $ret.=lj('','mdls'.$vl.'_admx,mps__x_'.$ka.'_'.$vl.'_'.$k,$t).br();}
	ses::$r['popw']=240; ses::$r['popt']='position'; return divc('nbp',$ret);}
static function mps($ka,$vl,$va){if($ka==$va)return;
	$r=msql::read('',ses('modsnod')); $ra=msql::move($r,$ka,$va);
	msql::modif('',ses('modsnod'),$ra,'arr','',''); 
	boot::define_mods(); boot::define_condition();
	return console::block($vl);}

#submods (desk)
static function deft(){
	msql::copy('users',ses('qb').'_apps','users',ses('qb').'_apps_sav');
	msql::copy('system','default_apps_users','users',ses('qb').'_apps');}
static function locapps($p='',$n=''){return msql_read('',nod('apps'),$p,$n);}//optional n?
static function modsmenu($id,$v){$r=msql::read('system','admin_modules','',1); 
	$rb=self::user_mods(); if($rb)$r+=$rb; ksort($r); $rt=implode(' ',array_keys($r)); 
	return dropmenu($rt,$id,$v,'1');}
static function sbmpos($ka,$id){$r=self::locapps('',1); $ret='';
	foreach($r as $k=>$v){if($k==$ka)$ret.=lj('active','',$v[0]).' ';
	else $ret.=lj('','sbm_submds__x_'.$ka.'_'.$id.'_sbmpsb_'.$k,$v[0]).' ';}
	ses::$r['popw']=240; ses::$r['popt']='position'; return divc('nbp',$ret);}
static function sbmpsb($ka,$va){$ra=msql::move(self::locapps(),$ka,$va);
	return msql::modif('',ses('qb').'_apps',$ra,'mdf','','');}
static function sbmsav($p,$id,$r){for($i=0;$i<=10;$i++)$ra[]=$r[$i]??'';
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
static function sbmrev($m){echo btn('frame-blue','empty table '.$m.': default copied');
	return msql::copy('system','default_apps'.$m,'users',ses('qb').'_apps');}
static function sbmove($d){$r=self::locapps(); $ra=$r[$d-1]; $r[$d-1]=$r[$d]; $r[$d]=$ra;
	return msql::modif('',ses('qb').'_apps',$r,'mdf','','');}
static function sbmpct($d){$r=msql::read('system','edition_pictos','',1); $ret='';
	foreach($r as $k=>$v)$ret.=lj('','___jx_'.$d.'_'.$k,picto($k,24)).' ';
	ses::$r['popw']=320; ses::$r['popt']='pictos'; return $ret;}
static function pictodrop($id){$r=msql::read('system','edition_pictos','',1);
	$vals=implode(' ',array_keys($r)); return dropmenu($vals,$id,'pictos','1');}

static function submds($d,$id,$o,$ob,$prm){$r=[];
if($o=='sbmsav')$r=self::sbmsav($d,$id,$prm);
if($o=='sbmdel')$r=self::sbmdel($d,$id);
if($o=='sbmads'){$r=self::sbmads($d,$ob); $ob='';}
if($o=='revert')$r=self::sbmrev($d);//?
if($o=='sbmpsb'){if($d!=$ob)$r=self::sbmpsb($d,$ob); $ob='';}
if($o=='sbmove')$r=self::sbmove($d);//?
if($o=='sbmfrom')$r=self::sbmfrom($d);
if($o=='deft')self::deft();
return self::desktop($id,$ob,'',$r);}

/**/static function sbmadd($id,$d){$ver=''; $rb=[]; //pr($d);
	$top=hlpbt('apps_add').' '; if($d)$ver='_'.$d;
	$top.=ljp(att(nms(104)),'sbm_submds____'.$id.'_deft',picto('update')).' ';
	$top.=msqbt('system','default_apps').' '; 
	$top.=lj(active($d,''),'popup_admx,sbmadd__x__'.$id,'defaults').' ';
	$top.=lj(active($d,'desk'),'popup_submds__x_home_'.$id.'_sbmadd','home').' ';
	$top.=lj(active($d,'desk'),'popup_admx,sbmadd__x_desk_'.$id,'desk').' ';
	$top.=lj(active($d,'dev'),'popup_admx,sbmadd__x_dev_'.$id,'dev').' ';
	$r=msql::read_b('system','default_apps'.$ver,'',1); if($r)$ra=msql::cat($r,1,1);
	if($ra)foreach($ra as $va){$bt=picto('file',32).$va;
		$rb[$va][]=lj('sicon','popup_admx,sbmadc__x_'.$va.'_'.$id,$bt).' ';
		foreach($r as $k=>$v){$bt=picto($v[7],32).$v[0];
			if($v[1]==$va)$rb[$va][]=lj('sicon','sbm_submds__x_'.$k.'_'.$id.'_sbmads_'.$d,$bt).' ';}}
ses::$r['popw']=320; ses::$r['popt']=nms(92).' Apps';
return $top.tabs($rb).divc('clear','');}

static function sbmedt($p,$id,$cnd){$rid=randid(); $r=self::locapps($p);
if($r['type']=='mod')$arb=msql::read('system','admin_modules',$r['process']);
$rh=msql::row('system','admin_tools',$r['type']); $ri=[]; $rb=[]; $ret=''; //pr($r);
foreach($r as $k=>$v){$ri[]=$k.$rid; $hk=$rh[$k]??'';
if($hk!='0'){
	if($k=='hide')$rb[$k]=checkbox_j($k.$rid,$v,''); 
	elseif($k=='private')$rb[$k]=checkbox_j($k.$rid,$v,''); 
	elseif($r['type']=='mod'){$no=''; $rh[$k]=$arb[$k]??'';
		if($k=='option' && ($arb['option']??'')==='0')$no=1;
		if(!$no)$rb[$k]=input($k.$rid,$v); else $rb[$k]=hidden($k.$rid,'');
		if($k=='type')$rb[$k]=hlpbt('submod_types');
		if($k=='process'){$rb[$k]=self::modsmenu($k.$rid,$v);
			if($v)$rb[$k]=self::admhlp($v,'description');}
		if($k=='param')$rb[$k]=self::admhlp($r['process'],'help');}
	else $rb[$k]=input($k.$rid,$v);
	if($k=='condition')$rb[$k].=' '.jump_btns($k.$rid,'menu|desk|boot|home|user',' ');//|favs
	if($k=='context')$rb[$k].=' '.jump_btns($k.$rid,'home|art|cat',' ');//|cntx
	if($k=='icon')$rb[$k].=' '.lj('txtx','popup_admx,sbmpct___'.$k.$rid,'pictos');
	$rb[$k].=' '.btn('txtsmall2',$rh[$k]??'');}
else $ret=hidden($k.$rid,$v);}
$ids=implode(',',$ri);
$bt=lj('popbt','sbm_submds__x_'.$p.'_'.$id.'_sbmfrom_'.$cnd,nms(44)).' ';
$bt.=lj('popbt','sbm_submds_'.$ids.'__'.$p.'_'.$id.'_sbmsav_'.$cnd,nms(66)).' ';
$bt.=lj('popsav','sbm_submds_'.$ids.'_x_'.$p.'_'.$id.'_sbmsav_'.$cnd,nms(27));
$bt.=lj('popbt','popup_desk,play___'.$p,nms(65)).' ';
$bt.=lj('popdel','sbm_submds__x_'.$p.'_'.$id.'_sbmdel_'.$cnd,pictit('del',nms(43)));
$ret.=on2cols($rb,300,4); $ret.=divs('',$bt);
ses::$r['popw']=320; ses::$r['popt']='Apps ('.$p.')';
return $ret;}

static function desktop($id,$cnd,$sys='',$r=[]){//id=dir;cnd=;sys=;
$rid=randid('mp'); $m='apps'; $ar=[];
$top=lj('','sbm_submds_____'.$sys,picto('reload')).'';
$top.=lj('txtx','sbm_submds____'.$id.'_'.$sys,'root').'';
$ra=explode('/',$id); foreach($ra as $k=>$v){$idb[]=$v;
	if($v)$top.=lj('txtx','sbm_submds____'.implode('/',$idb),$v).'';}
$top.=' '.self::admhlp($m,'help').' ';
foreach(['menu','desk','boot','home','user'] as $v)//,'favs'
	$top.=lj($cnd==$v?'txtaa':'txtab','sbm_submds____'.$id.'__'.$v,$v).' ';
$top.=ljp(att(nms(103)),'popup_admx,sbmadd____'.$id,picto('plus')).' ';
$top.=msqbt('',ses('qb').'_'.$m).' ';
if(rstr(61) && $m=='apps')$top.=hlpbt('apps','alert');
$top.=msqbt('system','default_apps').' ';
$top.=lj('txtsmall2','popup_admin___apps_1','sys').' ';
if($sys)$r=msql::read_b('system','default_apps','',0);
elseif(!$r)$r=msql::read('',nod($m),'',0);
if(!$r)$r=self::sbmrev('');
//$ar[]=['','button','root','type','condition',nms(105)];
foreach($r as $k=>$v)if(($cnd && strpos($v[5],$cnd)!==false) or !$cnd){
	$prv=$v[9]?picto('lock'):'';
	$up=lj('','popup_admx,sbmpos___'.$k.'_'.$id,picto('up',10)).' ';
	$bt=lj($v[8]?'grey':'','popup_admx,sbmedt___'.$k.'_'.$id.'_'.$cnd,pictxt($v[7],$v[0]));
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

static function deskcall($nod,$cnd){
$r=msql::read_b('',$nod,'',0);
return self::desktop('',$cnd,'',$r);}

#add_mod
static function addmod($vl){$rm=[]; $rt=[];
$r=msql::read('system','admin_modules','',1); $rb=array_keys($r);
foreach($r as $k=>$v)$rm[$v[0]][]=$k;
$ru=self::user_mods(); $rm['user']=array_keys($ru);
$ret=label('modbar','module','txtsmall'); ksort($rb);
$ret.=select(['id'=>'modbar','name'=>'bar'],$rm,'kk').' ';
$ret.=label('modcon','condition','txtsmall');
$cond=$_SESSION['cond'][0]; $cndr=['-','home','cat','art']; //$cndr[]=$cond;
$ret.=select(['id'=>'modcond','name'=>'cond'],$cndr,'vv',$cond);
/*$ret.=label('modpos','position','txtsmall');
if(!is_array($re))$re=['-'=>'-']; end($re); $pos=current($re);//select last
$ret.=select(['id'=>'modpos','name'=>'pos'],array_flip($re),'kv',$pos).' ';*/
$ret.=lj('popsav','mdls'.$vl.'_modsav_modbar,modcond_x_'.$vl.'__add',nms(92)).br().br();//,modpos
$ret.=divc('imgr',hlpbt('modules'));
$rh=msql::read('lang','admin_modules','');//help
foreach($rm as $k=>$v)foreach($v as $ka=>$va){
	$j='mdls'.$vl.'_modsav_modbar,modcond_x_'.$vl.'_'.ajx($va).'_add';//,modpos
	$rt[$k][]=divc('panel',lj('popbt',$j,$va).' '.btn('txtsmall',$rh[$va][0]??''));}
$ret.=tabs($rt);
return $ret;}

#config_mod
static function configmod($mid,$option){//return self::configmod0($mid,$option);
$rm=msql::row('',ses('modsnod'),$mid,1); if(!$rm)return;
$mod=$rm['module']; $bloc=$rm['block']; $p=$rm['param'];
$sys=''; $tog=''; $hid=''; $rh=[]; $rc=[]; $rd=[];
$arb=msql::row('system','admin_modules',$mod,1);//props
$arc=msql::row('lang','admin_modules',$mod,1);
if(!$arb)return lj('popdel','mdls'.$bloc.'_modsav__x_'.$bloc.'_'.$mid.'_del',nms(43));
$type=$arb['category']; $prm=$arb['param']; $opt=$arb['option']; $com=$arb['command'];
if($type=='system')$sys=1; //if($sys)$prm=3;
//usage
$rid=randid(); 
$rds=['mb'=>'block','mm'=>'module','mp'=>'param','mt'=>'title','mc'=>'condition','md'=>'command','mo'=>'option','mh'=>'cache','mv'=>'hide','me'=>'template','mr'=>'bt','mi'=>'div','pv'=>'prv','pp'=>'pop'];//legal
foreach($rds as $k=>$v){$rvs[$k]=$k.$rid; $rc[$v]='';}//hidden($rvs[$k],$rm[$k]??'')
//edit
$edit='';
$edtapi=toggle('popbt','amc_apicom,build___'.ajx($p).'_'.$rvs['mp'],pictxt('emission','Api command')).divd('amc','');
switch($mod){
case('BLOCK'):$edit=divb(console::block($p?$p:$mod.$mid),'frame-white','mdls'.$p);break;
case('MENU'):$edit=divb(console::block($p?$p:$mod.$mid),'frame-white','mdls'.$p);break;
case('ARTMOD'):$edit=divb(console::block($p?$p:$mod.$mid),'frame-white','mdls'.$p);break;
case('submenus'):$edit=self::menus_h($mid); if($opt)$p=self::menu_h_g($opt);break;
case('Banner'):$edit=lkc('popbt','/admin/banner','edit_banner');break;
case('template'):$ra=msql::row('',nod('template'),'',1); 
	if($ra){$rb=array_keys_r($ra,1,'k'); $edit=jump_btns($rvs['mp'],$rb,'');}break;
case('msql_links'):$edit=jump_btns($rvs['mp'],'links|rssurl|deploy','');break;
case('connector'):$edit=connbt($rvs['mp']);break;
case('cssfonts'):$edit=jump_btns($rvs['mp'],'fontphilum|fontmicrosys|',' ');break;
case('desktop'):$edit=self::deskcall('menubub_'.$p,'');break;
case('MenuBub'):$da='root,action,type,button,icon,auth'; $p=$p?$p:1;
	//$edit=self::deskcall('menubub_'.$p,'');
	$edit=msqedit::call('menubub_'.$p,$da);	break;
case('api_chan'):$vb=is_numeric($p)?$p:1; $da='api,button,icon,color,hide';
	//$edit=self::deskcall('menubub_'.$p,'');
	$edit=msqedit::call('apichan_'.$p,$da);	break;
case('folders_varts'):$edit=lj('poph','popup_meta,virtualfolder___'.$rvs['mp'],nms(73));break;
case('articles'):$edit=$edtapi;break;
case('api'):$edit=$edtapi;break;
case('api_arts'):$edit=$edtapi;break;
case('api_mod'):$edit=$edtapi;break;
case('design'):$edit=picto('alert').helps('prmb5');break;
case('submenus'):$edit=textarea($rvs['mp'],$p,42,4);break;}
//exceptions
$rx=[];
foreach($rds as $k=>$v){$rx[$v]=''; switch($v){
case('param'):if($arb[$v]=='1')$rx[$v]=1;break;
case('title'):if($arb[$v]=='1')$rx[$v]=1;break;
case('template'):if(!$arb[$v])$rx[$v]=1;break;
case('command'):if(!$arb[$v])$rx[$v]=1;break;
case('option'):if(!$arb[$v])$rx[$v]=1;break;
case('cache'):if($arb[$v]=='1')$rx[$v]=1;break;
case('bt'):if($arb[$v]=='1')$rx[$v]=1;break;
case('div'):if($arb[$v]=='1')$rx[$v]=1;break;
case('prv'):if($arb[$v]=='1')$rx[$v]=1;break;
case('pop'):if($arb[$v]=='1')$rx[$v]=1;break;}}
if($sys)foreach(['block','template','cache','hide','bt','div','prv','pop'] as $k=>$v)$rx[$v]=1;
//helps//$rh
foreach($rds as $k=>$v){$rh[$v]=''; switch($v){
case('block'):$rh[$v]=hlpbt($v);break;
case('module'):if($mod=='Page_titles')$rh[$v]=hlpbt('breadcrumb');
	if($mod=='MenuBub')$rh[$v].=hlpbt('menubub').hlpbt('menubub_edit');
	elseif($mod=='desktop')$rh[$v].=hlpbt('desklr');break;
case('param'):if($arc[$v])$rh[$v]=self::admhlp($mod,$v);break;
case('title'):;break;
case('condition'):$rh[$v]=hlpbt('mod_cond');break;
case('command'):if($arc[$v])$rh[$v]=self::admhlp($mod,$v);break;
case('option'):if($arc[$v])$rh[$v]=self::admhlp($mod,$v);
	if($mod=='LOAD')$rh[$v].=hlpbt('art_render');break;
case('template'):$rh[$v]=hlpbt($v);break;}}
//fields//$rc
foreach($rds as $k=>$v)switch($v){//if(!$rc[$v])
case('block'):if($bloc!='system' && $bloc!='newsletter' && $bloc!='tweetfeed')
	$rc[$v]=select_j($rvs[$k],'system '.prma('blocks'),$bloc,3,$bloc,0);break;
case('module'):$rc[$v]=self::modsmenu($rvs[$k],$mod).' '.$mid;break;
case('param'):$rc[$v]=goodarea($rvs[$k],$p,42);break;
case('title'):if($bloc=='Banner')$rc[$v]=textarea($rvs[$k],$rm[$v],42,4);
	else $rc[$v]=input($rvs[$k],$rm[$v],42);break;
case('condition'):if($bloc!='newsletter')
	$rc[$v]=select_j($rvs[$k],'- home cat art '.ajx($rm[$v]),$rm[$v],3,$rm[$v],0);break;
case('command'):if($com)$rc[$v]=select_j($rvs[$k],'- '.ajx($com),$rm[$v],1,$rm[$v],0);break;
case('option'):$rc[$v]=select_j($rvs[$k],'- '.$opt,$rm[$v],3,$rm[$v],0);break;
case('template'):$tmp='';
	$rtm=msql::kv('',nod('template'),0,1)+msql::kv('system','default_template',0,1);
	if($rtm)$tmp=implode(' ',array_keys($rtm));
	$rc[$v]=select_j($rvs[$k],'- '.ajx($tmp),$rm[$v],3,$rm[$v],0);break;
case('cache'):$rc[$v]=checkbox_j($rvs[$k],$rm[$v],$v);break;
case('hide'):$rc[$v]=checkbox_j($rvs[$k],$rm[$v],voc($v));break;
case('bt'):$rc[$v]=checkbox_j($rvs[$k],$rm[$v],$v);break;
case('div'):$rc[$v]=checkbox_j($rvs[$k],$rm[$v],$v);break;
case('prv'):$rc[$v]=checkbox_j($rvs[$k],$rm[$v],voc($v));break;
case('pop'):$rc[$v]=checkbox_j($rvs[$k],$rm[$v],$k);break;}
//specials//$rc
$rs=['description','edit','article'];
foreach($rs as $k=>$v)switch($v){
case('description'):if($arc[$v])$rc[$v]=divc('small',$arc[$v]);break;
case('edit'):$rc[$v]=$edit;break;
case('article'):
	if(sesr('line',$p))$rc[$v]=lkt('',htac('cat').$p,$p);
	elseif($prm==2){
		if(!is_numeric($p))$id=ma::find_id($p); else $id=$p;
		if(is_numeric($id))$rc[$v]=ma::popart($id,1);}break;}
//del_empty//$hid
foreach($rds as $k=>$v)if(!$rc[$v] or $rx[$v]??''){$hid.=hidden($rvs[$k],$rm[$v]); unset($rc[$v]);}
//togs
$rg=['cache','hide','bt','div','prv','pop']; //pr($rds);
foreach($rg as $k=>$v)if($rc[$v]??''){$tog.=$rc[$v].' '; unset($rc[$v]);} $rc['toggle']=$tog;
//add hlp
foreach($rc as $k=>$v)if($rh[$k]??'')$rc[$k].=' '.$rh[$k];
//ordering
$ro=['module','description','edit','article','param','title','block','condition','command','option','template','toggle'];
foreach($ro as $k=>$v)if($rc[$v]??'')$rd[$v]=$rc[$v];
//save
$dvs=join(',',$rvs);
$bt=lj('popbt','mdls'.$bloc.'_modsav_'.$dvs.'__'.$bloc.'_'.$mid.'_savb_',nms(66));//apply
$bt.=lj('popsav','mdls'.$bloc.'_modsav_'.$dvs.'_x_'.$bloc.'_'.$mid.'_sav_',nms(27));//save
$bt.=lj('popbt','mdls'.$bloc.'_modsav_'.$dvs.'_x_'.$bloc.'_'.$mid.'_new_',nms(98));//dupl
$bt.=blj('popdel','del'.$bloc,'modsav_'.$dvs.'__'.$bloc.'_'.$mid.'_del_',nms(43));
$bt.=lj('popbt','popup_admx,mpos___'.$mid.'_'.$bloc,nms(158));
//script
if($type!='system'){
$bt.=lj('popbt','popup_md,modsee__3_'.$mid,'script').hlpbt('comline').' ';
$bt.=lj('popbt','popup_mod,callmod__3_'.$mid,nms(65)).' ';}
$bt.=msqbt('',ses('modsnod'),$mid);
$bt.=msqbt('system','admin_modules',$mod);
//render
$ret=on2cols($rd,680,5).$hid;
$ret.=div('',$bt);
return $ret;}

#retrictions
static function defaults_rstr($u){
if($u)$r=msql::row('users',nod('rstr'),'',1);
else $r=msql::row('system','default_rstr','',1);
return arr($r,140);}

static function edit_rstr(){
$ret=msqbt('users',ses('qb').'_rstr');
$ret.=console::admactbt('bckp_rstr','backup');
$ret.=console::admactbt('restore_rstr','restore');
$ret.=msqbt('system','default_rstr');
$ret.=console::admactbt('reset_rstr','reset');
$ret.=console::admactbt('mkdefaults_rstr','mkdefaults');
if(auth(6))$ret.=msqbt('system','admin_restrictions');
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
$w=$w?$w:cw()-10; $ret=onxcols($re,$prm,$w); $p=atd($id).atc($cls);
return tag($b,$p,$ret).divc('clear','');}

static function showparams($slct,$restrict){$rb=[];
$r=msql::prep('system','admin_restrictions');
$h=msql::read('lang','admin_restrictions');
if($slct && auth(6))self::modifparams($slct,$restrict);
foreach($r as $k=>$v)$rb[$k]=self::showparamscat($v,$h); ksort($rb);
return tabs($rb,'rst');}

static function getrstr($b){
if($b=='defaults')$_SESSION['rstr']=self::defaults_rstr(0);
elseif($b=='restore')$_SESSION['rstr']=self::defaults_rstr(1);
$r=$_SESSION['rstr']; if(!$r)$r=self::defaults_rstr(0);
return $r;}

static function rstrsav($d){
if($d)$_SESSION['rstr'][$d]=rstr($d)?'1':'0';
if(auth(6))self::backup_rstr('save');
return 'rstr'.$d.': '.offon(rstr($d));}

static function backup_rstr($b){$r=self::getrstr($b);
if($b!='restore' && $b!='defaults')self::backup_rstr_msql($r);
if(is_array($r))array_unshift($r,'0');
if($b!='=' && is_array($r))sql::upd('qdu',['rstr'=>implode('',$r)],['name'=>ses('qb')]);}

static function restrictions(){
$edt=divc('nbp',self::edit_rstr());
$prm=self::showparams(get('slct'),get('restrict'),'');
return $edt.divd('rstr',$prm);}

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
if($r)foreach($r as $k=>$v)$ret.=$k."\n".md::supermenu($v);
return $ret;}
}
?>