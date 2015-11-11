<?php
//philum_ajx_functions 

#master_config//(3)
function master_config($div,$va,$cond,$res){
require('boot.php'); $r=ajxr(substr($res,1));
$r[4]=substr($r[4],0,1)!='-'?$r[4]:''; $r[5]=$r[5]!='-'?$r[5]:''; 
$r[9]=$r[9]!='-'?$r[9]:'';//4cond 5com 6opt 9tmpl
if($r[1]=='blocks')$r[2]=str_replace(array('page','popup'),'bloc',$r[2]);//forbidden_blocks
$nod=$_SESSION['modsnod'];
$_SESSION['cond']=determine_cond($r[4]);
if($cond=="sav" or $cond=="savb"){
	$ret[$va]=$r; array_shift($r); $_SESSION['mods'][$div][$va]=$r; 
	$ret=modif_vars('users',$nod,$ret,"mdf");}
elseif($cond=="add"){
	$md=$r[1]?$r[1]:$va; $pos=$r[0];
	$cnd=$r[2]=='-'?'':$r[2];
	$ret=array($div,$md,'','',$cnd,'','','','','');
	$cmd=define_modc_b($div);
	if($cmd){$keys=array_keys($cmd); $i=0;
	foreach($cmd as $k=>$v){$nv=$v; array_unshift($nv,$div);
		$nk=$keys[$i]; if($nk==0)$nk='push';
		if($k==$r[0]){$nmd[$nk]=$nv; $i++; $nk=$keys[$i]; 
			if($nk==0)$nk='push'; $nmd[$nk]=$ret;}
		else $nmd[$nk]=$nv; $i++;}} 
	else $nmd[]=$ret;
	$r=modif_vars('users',$nod,$nmd,"mdf"); 
	define_mods('',$r); define_modc(); define_prma();}
elseif($cond=="new"){$nv=$r; $nv[0]=$div; $r=modif_vars('users',$nod,$nv,"push"); 
	define_mods('',$r); define_modc(); define_prma();}
elseif($cond=="del"){unset($_SESSION['mods'][$div][$va]); modif_vars('users',$nod,$va,"del");
	define_modc(); define_prma();}
elseif($cond)$_SESSION['cond']=determine_cond($cond);
if($div=='newsletter'){define_mods('');}
return console_block($div,$ret);}

#config_mod
function user_mods(){
$r=msql_read("",ses('qb').'_modules','',1);
if($r)foreach($r as $k=>$v){$ret[$k]=array($k,1);}
return $ret;}

//mod_edit (create_comline)
function mod_edit_pop($o){$c=$o?'module':'ajax';
$inject=assistant('mp','insert_jc',$c.'\',\'mp','','');
return mod_edit('',$o).$inject;}

function admhlp($c,$t,$e){
//return bubble($c,'popmsqt','lang_admin*modules_'.$t.'_'.$e,picto('info'));
return togbub('msqlcall','lang_admin*modules_'.$t.'_'.$e,picto('help'),'grey');}

function mod_edit_j($v,$o,$pa,$id=''){if(!$id)$id='mp';
if($pa)$pa=ajx(substr($pa,0,-1),1); $r=msql_read('system','admin_modules',$v); 
$ret=admhlp('imgr',ajx($v),'description');
$ra=array('param','title','command','option','module'); $d='"size="11" id="mde';
if(!$o)$ra[]='button';
for($i=0;$i<count($ra);$i++){$cm[]='mde'.$i; $vb=$ra[$i]; 
	if($ra[$i]=='module')$va=$v; elseif($ra[$i]=='param')$va=$pa; else $va='';
	if(($vb!='command' && $r[$vb]!='0') or $r[$vb]){
		if($vb=='command' or $vb=='option')$hlp=btn('txtsmall2',$r[$vb]); else $hlp='';
		if($vb=='button' && !$o)$va=$v;
		if(substr($va,-1)=='&')$va=substr($va,0,-1);
		$rb[$vb]=input2('text',$d.$i,ajx($va,1),'').$hlp;}
	else $ret.=hidden($d.$i,'','');}
$rb[' ']=ljb('popsav','popup',implode('|',$cm).'\',\''.$id.'','add :'.$v);
$ret.=on2cols($rb,470,5);
return $ret;}

function mod_edit($p,$o,$id=''){
$ret=btn('txtcadr','command-line').' ';
$rb=msql_read('system','admin_modules','',1); 
foreach($rb as $k=>$v){if($v[0]!='system')$ra[$k]=$k;}
$ret.=btn('txtsmall2','module: ');
$ret.=balise("select",array(3=>'sdx',5=>"",15=>sj('moded_medit_sdx__'.$o.'__'.$id)),batch_defil($ra));
$ret.=divd('moded','');
return $ret;}

//comline (submod normaux)
function comline_sav($na,$res){$ra=ajxr($res);
for($i=3;$i<9;$i++){$prm.=$ra[$i].'/';} $prm.=':';
$prm=str_replace(array('/////:','////:','///:','//:','/:'),':',$prm);
$prm.=$ra[1].'§'.$ra[2]; if(substr($prm,0,1)==':')$prm=substr($prm,1);
$r=explode(',',str_replace("\n",'',$ra[0])); $r[$na]=$prm;
return implode(",\n",$r);}

function comline_del($na,$res){$r=explode(',',ajxg($res));
foreach($r as $k=>$v){if($k!=$na)$ret.=$v.',';}
return substr($ret,0,-1);}

function comline_txt($p,$id){
$ret=btn('txtx',helps('scripts')).br();
$ret.=goodarea($p,'edt'.$id,'',$j,62).br();
$ret.=ljb('popbt','SaveJb',$id.'_submds__4x_'.$id.'__cmpsav__edt'.$id.'\',\'sbm'.'_submds____'.$id.'_cmlin__'.$id,nms(66));
return popup('edit_param',$ret);}

function comline_edit($v,$na,$id,$res){$rid=randid();
if($res)return comline_sav($na,$res);
list($cod,$mod,$t)=$ra=decompact_mod($v); $r=explode("/",trim($cod));
$ids=$id.'|medm'.$rid.'|medb'.$rid.'|';
$arb=msql_read('system',"admin_modules",$mod);
$rb['module']=input(0,'medm'.$rid,$mod).submod_comline('medm'.$rid,$mod); 
$hlp=msql_read('lang','admin_modules',$mod);
$rb['usage']=divc('small',$hlp['description']);
$rk=array('param','title','command','option');
foreach($rk as $k=>$v){$ids.='med'.$k.$rid.'|'; $jmp=''; $com=$arb[$v];
	if($com && $v!='param')$jmp=select_j('med'.$k.$rid,$com);
	//$jmp=jump_btns('med'.$k.$rid,str_replace(' ','|',$com),'');
	$rb[$v]=input(1,'med'.$k.$rid,$r[$k]).$jmp;
	if($v=='param')$rb[$v].=' '.admhlp('grey',ajx($mod),'help');}
$rb['button']=input(1,'medb'.$rid,$t);
$sv=$id.'_submds__4x_'.$na.'__cmdel__'.$id.'\',\'sbm'.'_submds____'.$id.'_cmlin__'.$id;
$bt=ljb('popdel','SaveJb',$sv,nms(43)).' ';
$sv=$id.'_comline__4x__'.$na.'___'.$ids.'\',\'sbm'.'_submds____'.$id.'_cmlin__'.$id;
$bt.=ljb('popbt','SaveJb',$sv,nms(66));
$ret=on2cols($rb,300,4).$bt.br();
return popup('comline',$ret,320);}

function cmlin($p,$id,$res=''){if($res)$p=ajxg($res);
$p=str_replace('\n','',$p); $r=explode(',',$p); $n=count($r);
for($i=0;$i<$n;$i++){$ra=decompact_mod($r[$i]);
	$v=ajx(trim($r[$i])); $bt=$ra[1]; $t='" title="'.$ra[2];
	if($r[$i])$ret.=lj('popbt'.$t,'popup_comline___'.$v.'_'.$i.'_'.$id,$bt).' ';}
	//if($r[$i])$ret.=lj('popbt','popup_submds___'.$v.'_subdt_'.$i.'_'.$id,$bt).br();
$ret.=hidden('',$id,$p);
return $ret;}

//comline
function comline($p,$id){$n=substr_count($p,',')+2;
$ret.=lj('','sbm'.'_submds____'.$id.'_cmlin__'.$id,picto('reload')).' ';
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
return txarea($id,$p,40,10);
$ret.=lj('','sbm'.'_submds____'.$id.'_aplin__'.$id,picto('reload')).' ';
$ret.=lj('','popup_comline___param:module§button_'.$n.'_'.$id,picto('add')).' ';
$ret.=lj('','popup_submds____'.$id.'_cmprm__'.$id,picto('edit'));
$ret.=divd('sbm',aplin($p,$id));}

//submods
function submds($d,$id,$o,$ob,$res){//comline hangar
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
if($o=='sav')submod_sav($d,$id,$res);
if($o=='del')submod_del($d,$id);
if($o=='adc')return submod_adc($d,$id,$res);
if($o=='ads'){submod_ads($d,$ob); $ob='';}
if($o=='revert')submod_revert($d);
if($o=='pos')return submod_pos($d,$id);
if($o=='psb'){if($d!=$ob)submod_psb($d,$ob); $ob='';}
if($o=='add')return submod_add($id,$d);
if($o=='edit')return submod_edit($d,$id,$ob);
if($o=='move')submod_move($d);
if($o=='from')submod_from($d);
if($o=='pcto')return submod_picto($d);
if($o=='deft'){msq_copy('users',ses('qb').'_apps','users',ses('qb').'_apps_sav');
	msq_copy('system','default_apps_users','users',ses('qb').'_apps');}
return adm_apps($id,$ob,'');}

//modpos
function mod_pos($ka,$vl){$r=define_modc_b($vl);
	foreach($r as $k=>$v){$t=build_mod_subname($v[1],$v[0]);
	if($k==$ka)$ret.=lj('active','',$t).br();
	else $ret.=lj('','modules'.$vl.'_submds__x_'.$ka.'_'.$vl.'_mps_'.$k,$t).br();}
	return popup('position',divc('nbp',$ret),240);}
function mod_mps($ka,$vl,$va){if($ka==$va)return; require('boot.php');
	$r=msql_read('users',$_SESSION['modsnod']); $ra=msq_move($r,$ka,$va);
	msql_modif('users',$_SESSION['modsnod'],$ra,'','add','mdf'); 
	define_mods(''); define_condition(); return console_block($vl);}

//submod (msql)
function locapps($p='',$n=''){return msql_read('',ses('qb').'_apps',$p,$n);}
function submod_comline($id,$v){$r=msql_read('system','admin_modules','',1); 
	$rb=user_mods(); if($rb)$r+=$rb; ksort($r); $rt=implode(' ',array_keys($r)); 
	return menuderj_prep($rt,$id,$v,'1');}
function submod_pos($ka,$id){$r=locapps($p,1); 
	foreach($r as $k=>$v){if($k==$ka)$ret.=lj('active','',$v[0]).' ';
	else $ret.=lj('','sbm'.'_submds__x_'.$ka.'_'.$id.'_psb_'.$k,$v[0]).' ';}
	return popup('Apps position',divc('nbp',$ret),240);}
function submod_psb($ka,$va){$ra=msq_move(locapps(),$ka,$va);
	msql_modif('users',ses('qb').'_apps',$ra,'','add','mdf');}
function submod_sav($p,$id,$res){$r=ajxr($res);
	for($i=0;$i<=9;$i++){$ra[]=$r[$i];}
	msql_modif('users',ses('qb').'_apps',$ra,'','one',$p);}
function submod_del($d,$id){
	$r=msql_modif('users',ses('qb').'_apps','','','del',$d);}
function submod_ads($d,$v){$r=msql_read('system','default_apps'.($v?'_'.$v:''),$d);
	if($r)msql_modif('users',ses('qb').'_apps',$r,'','push','');}
function submod_adc($d,$id,$res){$r=array('new',$d,'','','','desk','','','','');
	$ra=msql_modif('users',ses('qb').'_apps',$r,'','push','');
	foreach($ra as $k=>$v){$key=$k;} return submod_edit($k,$id,'');}
function submod_from($d){$r=locapps($d);
	if($r)msql_modif('users',ses('qb').'_apps',$r,'','push','');}
function submod_revert($m){echo btn('txtalert','empty table: default copied');
	return msq_copy('system','default_apps'.$m,'users',ses('qb').'_apps');}
function submod_move($d){$r=locapps(); $ra=$r[$d-1]; $r[$d-1]=$r[$d]; $r[$d]=$ra;
	msql_modif('users',ses('qb').'_apps',$r,'','add','mdf');}
function submod_picto($d){$r=$_SESSION['picto'];
	foreach($r as $k=>$v)$ret.=lj('','___jx_'.$d.'_'.$k,picto($k,24)).' '; 
	return popup('pictos',$ret,320);}

function submod_add($id,$d){
	$top=hlpbt('apps_add').' '; if($d)$ver='_'.$d; $j='sbm'.'_submds__x_';
	$top.=lj('" title="'.nms(104),'sbm'.'_submds____'.$id.'_deft',picto('update')).' ';
	$top.=msqlink('system','default_apps').' '; 
	$top.=lj(active($d,''),'popup_submds__x__'.$id.'_add','defaults').' ';
	$top.=lj(active($d,'desk'),'popup_submds__x_home_'.$id.'_add','home').' ';
	$top.=lj(active($d,'desk'),'popup_submds__x_desk_'.$id.'_add','desk').' ';
	$top.=lj(active($d,'dev'),'popup_submds__x_dev_'.$id.'_add','dev').' ';
	$r=msql_read('system','default_apps'.$ver,'',1); $ra=array_flip(msq_cat($r,1));
	foreach($ra as $va){$bt=picto('file',32).' '.$va;
		$rb[$va].=lj('sicon','popup_submds__x_'.$va.'_'.$id.'_adc',$bt).' ';
		foreach($r as $k=>$v){$bt=picto($v[7],32).' '.$v[0];
			if($v[1]==$va)$rb[$va].=lj('sicon',$j.$k.'_'.$id.'_ads_'.$d,$bt).' ';}}
return popup(nms(92).' Apps',$top.make_tabs($rb).divc('clear',''),320);}

function submod_edit($p,$id,$cnd){$rid=randid(); if($p)$r=locapps($p);
if($r['type']=='mod')$arb=msql_read('system','admin_modules',$r['process']);
$h=msql_read('system','admin_tools',$r['type']);
foreach($r as $k=>$v){$ids.=$k.$rid.'|';
if($h[$k]!='0'){
	if($k=='hide')$rb[$k]=checkbox_j($k.$rid,$v,''); 
	elseif($k=='private')$rb[$k]=checkbox_j($k.$rid,$v,''); 
	elseif($r['type']=='mod'){$no=''; $h[$k]=$arb[$k];
		if($k=='option' && $arb['option']=='0')$no=1;
		if(!$no)$rb[$k].=input(1,$k.$rid,$v); else $rb[$k]=input(0,$k.$rid,'');
		if($k=='type')$rb[$k].=hlpbt('submod_types');
		if($k=='process'){$rb[$k]=submod_comline($k.$rid,$v);
			if($v)$rb[$k].=admhlp('grey',ajx($v),'description');}
		if($k=='param')$rb[$k].=admhlp('grey',ajx($r['process']),'help');}
	else $rb[$k].=input(1,$k.$rid,$v);
	if($k=='condition')$rb[$k].=' '.jump_btns($k.$rid,'menu|desk|boot|home|user',' ');//|favs
	if($k=='icon')$rb[$k].=' '.lj('txtx','popup_submds___'.$k.$rid.'__pcto','pictos');
	$rb[$k].=' '.btn('txtsmall2',$h[$k]);}
else $ret.=input(0,$k.$rid,$v);}
$bt.=lj('popdel','sbm'.'_submds__x_'.$p.'_'.$id.'_del_'.$cnd,pictit('del',nms(43))).' ';
$bt.=lj('popbt','sbm'.'_submds__x_'.$p.'_'.$id.'_from_'.$cnd,nms(44)).' ';
$bt.=lj('popbt','sbm'.'_submds___'.$p.'_'.$id.'_sav_'.$cnd.'_'.$ids,nms(66)).' ';
$bt.=lj('popsav','sbm'.'_submds__x_'.$p.'_'.$id.'_sav_'.$cnd.'_'.$ids,nms(57));
$ret.=on2cols($rb,300,4).divs('',$bt);
return popup('Apps ('.$p.')',$ret,320);}

function adm_apps($id,$cnd,$sys=''){//id=dir;cnd=;sys=;
$rid='mp'.randid(); //echo $id.'-'.$sys; p($_GET);
$m='apps'; $j='sbm_submds___'; 
$top.=lj('',$j.'_'.$id.'_'.$sys.'__',picto('reload')).'';
$top.=lj('txtx',$j.'_'.$id.'_'.$sys,'root').'';
$r=explode('/',$id); foreach($r as $k=>$v){$idb[]=$v; //echo $v;
	if($v)$top.=lj('txtx',$j.'_'.implode('/',$idb),$v).'';}
$top.=' '.admhlp('grey',$m,'help').' ';
foreach(array('menu','desk','boot','home','user') as $v)//,'favs'
	$top.=lj($cnd==$v?'txtaa':'txtab',$j.'_'.$id.'__'.$v,$v).' ';
$top.=lj('" title="'.nms(103),'popup_submds____'.$id.'_add',picto('plus')).' ';
$top.=msqlink('',ses('qb').'_'.$m).' ';
if(rstr(61) && $m=='apps')$top.=hlpbt('apps','alert');
$top.=msqlink('system','default_apps').' ';
$top.=lj('txtsmall2','popup_admin___apps_1','sys').' ';
if($sys)$r=msql_read_b('system','default_apps','',1);
else $r=msql_read('',ses('qb').'_'.$m,'',1);
$ar[]=array('','icon',nms(71),'root','type','condition',nms(105));
if(!$r)$r=submod_revert('_users');
foreach($r as $k=>$v)if(($cnd && strpos($v[5],$cnd)!==false) or !$cnd){
	$prv=$v[9]?picto('lock'):''; $jp='popup_submds___'.$k.'_'.$id.'_';
	$up=lj('',$jp.'pos',picto('ktop§10')).' ';
	$bt=lj($v[8]?'grey':'',$jp.'edit_'.$cnd,$v[0]);
	$pt=lj($v[8]?'grey':'',$jp.'edit_'.$cnd,picto($v[7]));
	$cd=strpos($v[5],'menu')!==false?picto('admin'):'';
	$cd.=strpos($v[5],'desk')!==false?picto('desktop'):'';
	$cd.=strpos($v[5],'boot')!==false?picto('get'):'';
	$cd.=strpos($v[5],'home')!==false?picto('home'):'';
	$cd.=strpos($v[5],'user')!==false?picto('user'):'';
	$dir=$v[6]?lj('txtx',$j.'_'.$v[6].'_'.$cnd.'_'.$sys,$v[6]):'';
	if(substr($v[6],0,strlen($id))==$id or !$id)
		$ar[$k]=array($up,$pt,$bt,$dir,$v[1],$cd,$prv);}//,$v[2],$v[5]
$ret.=make_table($ar,'').hidden('',$id,'');
return divd('sbm',$top.$ret);}

function submod_pop(){return popup('Apps',adm_apps('',''),460);}

//function dskbk_slct(){$r=msql('system','edition_desktop','',1);}

//artmod_edit
//function artmod_edit_j($d){return popup('',artmod_edit($d));}
function artmod_edit_t($a,$b,$d){$r=ajxr($d); return $r[0].'&'.$r[1].'='.$r[2];}
function artmod_edit_l($a,$b,$d){$d=ajx($d,1);
$r=array('-'=>'','id'=>'1234','cat'=>'cat1|cat2','nocat'=>'cat','tag'=>1,'notag'=>1,'nbdays'=>'30-60','nbhours'=>'12','from'=>'01-01-12','until'=>'01-12-12','lasts'=>'0-10','preview'=>'true/false/full/auto','priority'=>'0-4','nopriority'=>'0-4','lenght'=>'<4000','orderby'=>'day desc','list'=>'id1|id2');
$rb=array(3=>'sdx',5=>"",15=>sj('amc_call___adminx_artmod*edit*l_'.$a.'__sdx'));
$ret.=balise("select",$rb,batch_defil_kv($r,$d,'kk'));
if($d){$ret.=hidden('','amca',$d).input(1,'amcb',$r[$d],'');
$ret.=ljc('popbt',$a,'adminx_artmod*edit*t___'.$a.'|amca|amcb','add',4);
$ret.=' '.hlpbt('call_arts');}
return $ret;}
function artmod_edit($d,$id=''){$ret.=btn('txtcadr','edit_art_mod');
$ret.=divd('amc',artmod_edit_l('edm','','')); $ret.=input(1,'edm','','');
$ret.=ljc('popbt','amed','adminx_mod*edit*j_articles_1_edm','edit_mod');
$ret.=divd('amed',''); $ret.=assistant('mp','insert_jc','articles\',\'mp','','');
return $ret;}

//config_mod
function config_mod($mnb,$option){
$rm=msql_read('users',$_SESSION['modsnod'],$mnb);//module
$mod=$rm['module']; $bloc=$rm['block']; $param=$rm['param'];
if(strpos($param,',')){$param=str_replace(', ',",\n",$param);
	$param=ereg_replace("[\n]{2,}","\n",$param);}
$arb=msql_read('system','admin_modules',$mod);//props
	$type=$arb['category']; $prm=$arb['param']; $opt=$arb['option'];
	$com=$arb["command"]; $com=str_replace('scroll','scroll scrold',$com);
$arc=msql_read('lang','admin_modules',$mod); $fhlp=$arc['description'];
if(strpos(prma('blocks'),$mod)!==false && $mod){
	$type="div"; $fhlp=$fhlp?$fhlp:nms(90); $prm=3;$arb["title"]=1;}
elseif(!$type && $mod!='system'){$type='user_mod'; $fhlp='obsolete';}
elseif($mod=='Page_titles')$fhlp.=' '.hlpbt('breadcrumb');
if($bloc=='menus'){$type='menu_link'; $fhlp='menu link';}
if($arc['help'])$phlp=admhlp('grey',ajx($mod),'help').' ';
if($arc['option'])$ohlp=admhlp('grey',ajx($mod),'option').' ';
if($arc['command'])$dhlp=admhlp('grey',ajx($mod),'command').' ';
//usage
$rc=array('module'=>bal('strong',$mod).' ('.$type.') '.$mnb,'usage'=>divc('small',$fhlp));
if($_SESSION['line'][$param])$rc["article"]=lkt('',htac('section').$param,$param);
elseif($prm==2){//wait_ID
	if(!is_numeric($param))$id=find_id($param); else $id=$param;
		if(is_numeric($id) && $param>3){list($dy,$frm,$suj,$amg)=pecho_arts($id);//art
		$rc["article"]=lkt('','/?read='.$id,$suj);}}
$l='modules_'.$bloc.'_'.$mnb; $rid=randid();
$rds=array('mb','mm','mp','mt','mc','md','mo','mh','mv','me','mr','mi');
foreach($rds as $k=>$v){$rvs[$v]=$v.$rid; $dvs.=$v.$rid.'|';}
//$dvs.=;
$sty='" onkeypress="checkEnter(event,\'savmod\')';
$form.=hidden('',$rvs['mm'],$mod);
//edit
if($mod=="submenus"){require_once('spe.php'); $rc["edit"]=menus_h($mnb); 
	if($option)$param=menu_h_g($option);}
if($mod=="Banner") $rc["edit"]=lkc("popbt",'/admin/banner','edit_banner');
elseif($mod=="user_menu")$rc["edit"]=jump_btns($rvs['mp'],spelinks(),' ');
elseif($mod=="app_menu"){//$rd=msql_read_prep('system','default_apps_menu');
	//jump_btns($rvs['mp'],array_keys($rd),' ');
	$rc["edit"]=btn('console','button/type/process/param/option/condition/root/icon/hide/private§display[,]');}
elseif($mod=='link' or $mod=="url"){$arr=explode('|',spelinks());
	if($_SESSION['line'])$arr+=array_flip($_SESSION['line']); $rc["edit"]=balise("select",array(3=>'mps',15=>'jumpslct(\''.$rvs['mp'].'\',this)',16=>"width:90px;"),batch_defil_kv($arr,'','vv'));}
elseif($mod=='template'){$ra=msql_read('',ses('qb').'_template','',1); 
	if($ra){$rb=array_keys_r($ra,1,'k'); $rc["edit"]=jump_btns($rvs['mp'],$rb,'');}}
elseif($mod=='tag_arts' && is_array($_SESSION['interm']))
	$rc["edit"]=jump_btns($rvs['mp'],array_keys($_SESSION['interm']),'');
elseif($mod=='usertags' && prmb(18))
	$rc["edit"]=jump_btns($rvs['mp'],str_replace(' ','|',prmb(18)),'');
elseif($mod=='msql_links')$rc["edit"]=jump_btns($rvs['mp'],'links|rssurl|deploy','');
elseif($mod=='connector'){req('art'); $rc["edit"]=conn_edit();
	$rc["edit"].=txarea('txtarea',$param,50,5,'txtnoir" onkeyup="transvalue(\''.$rvs['mp'].'\')" onclick="transvalue(\''.$rvs['mp'].'\')"; onblur="transvalue(\''.$rvs['mp'].'\');');}
elseif($mod=='desktop')$rc["edit"]=hlpbt('desklr');
elseif($mod=='cssfonts')$rc["edit"]=jump_btns($rvs['mp'],'fontphilum|fontmicrosys|',' ');
elseif($mod=='columns')$rc["edit"]=mod_edit('',1,$rvs['mp']);
elseif($mod=='articles')$rc["edit"]=divd('amc',artmod_edit_l($rvs['mp'],'',''));
elseif($mod=="design" && prmb(5))$rc["edit"]=picto(alert).helps('prmb5');
//param
if($mod=='tab_mods' or $mod=='MenusJ' or $mod=='art_mod')$rc["param"]=comline($param,$rvs['mp']);
elseif($mod=='app_menu')$rc["param"]=appmenu($param,$rvs['mp']);
elseif($mod=="submenus")$rc["param"]=txarea($rvs['mp'],$param,42,4);
elseif($prm!='0')$rc["param"]=goodarea($param,$rvs['mp'],'',$j,42);
else $form.=hidden('',$rvs['mp'],'');
if($mod=='desktop'){$rc["edit"]=$phlp; $rc["param"].=' '.hlpbt('desklr');}//dskbk_slct().
elseif($mod!='apps' && $phlp)$rc["param"].=' '.$phlp;
//title
if($prm!='1' && $arb["title"]=='')$rc["title"]=input(1,$rvs['mt'].'" size="42'.$sty,$rm['title'],""); else $form.=hidden('',$rvs['mt'],'');
//bloc
if($bloc!='system' && $bloc!='newsletter' && $bloc!='gsm'){
$rc["bloc"]=select_j($rvs['mb'],'system '.prma('blocks'),$bloc,1,$bloc,0);}
else $form.=hidden('',$rvs['mb'],$bloc);
//condition
if($bloc!='newsletter')$rc["condition"]=select_j($rvs['mc'],'- home cat art',$rm['condition'],3,$rm['condition'],0).' '.hlpbt('mod_cond');
else $form.=hidden('',$rvs['mc'],'');
//command
if($com)$rc["command"]=select_j($rvs['md'],'- '.ajx($com),$rm['command'],1,$rm['command'],0).' '.$dhlp;
else $form.=hidden('',$rvs['md'],'');
//option
if($opt!='0'){
	$rc["option"]=select_j($rvs['mo'],'-|'.$opt,$rm['option'],3,$rm['option'],0).' ';
	if($mod=='LOAD')$rc["option"].=hlpbt('art_render'); else $rc['option'].=$ohlp;}
else $form.=hidden('',$rvs['mo'],'');
//template
if($arb["template"]){
	$ara=msql_read('',ses('qb').'_template','',1); if($ara)$tmp=implode(' ',array_keys($ara));
	$rc["template"]=select_j($rvs['me'],'- '.ajx($tmp),$rm['template'],1,$rm['template'],0);}
else $form.=hidden('',$rvs['me'],'');
//cache
if($arb["cacheable"])$rc["cache"]=checkbox_j($rvs['mh'],$rm['cache'],'');
else $form.=hidden('',$rvs['mh'],'');
$rc["hide"]=checkbox_j($rvs['mv'],$rm['hide'],'');//hide
if($arb["nobr"]!='0')$rc["nobr"]=checkbox_j($rvs['mr'],$rm['nobr'],'');//nobr
else $form.=hidden('',$rvs['mr'],'');
if($arb["div"]!='0')$rc["div"]=checkbox_j($rvs['mi'],$rm['div'],'');//divmod
else $form.=hidden('',$rvs['mi'],'');
//script
if($type!='system'){
$oks=lj('popbt','popup_modsee__3_'.$mnb.'_1','script').hlpbt('comline').' ';
$oks.=lj('popbt','popup_modsee__3_'.$mnb,nms(65)).' ';}
//if($mod=='LOAD')$rc["edit"]=fast_sets('load');
//render
$bt.=ljb("popdel","SaveR",$l.'_del\',\''.$dvs,nms(43)).' ';
$bt.=ljb('popbt',"SaveR",$l.'_new\',\''.$dvs,nms(44)).' ';
$bt.=ljb('popbt',"SaveR",$l.'_savb\',\''.$dvs,nms(66)).' ';
$bt.=ljb('popsav',"SaveR",$l.'_sav\',\''.$dvs,nms(57)).' ';//master_config
$ret.='<form id="savmod" action="javascript:SaveR(\''.$l.'_sav\',\''.$dvs.'\')">'.$form;
$ret.=on2cols($rc,470,5);
$ret.='</form>';
$ret.=divs('',$bt.$oks);
return $ret;}//popup('Module',,460)

function spelinks(){return'hubs|home|All|plan|taxonomy|tracks|gallery|rss|disk|time|lang|root|desk|desktop|deskboot|folder|search|contact|credits|admin|tablet|home§home:picto|mod§4-gsm|apps§14:default|br';}

#add_mod
function prep_cond_mods($vl){$r=define_modc_b($vl);
if($r)foreach($r as $k=>$v)$ret[$v[0]]=$k; return $ret;}

function bar_add_mod($vl){
$r=msql_read('system',"admin_modules",'',1);
if($r)foreach($r as $k=>$v)$defs[$v[0]][$k]=$v[1];
$re=prep_cond_mods($vl); 
list($defb,$defc,$defd)=whose_mods($re,$vl,$defs);
$def=array_merge($defc,$defd);
$ret.=btn("txtsmall",'module:'); ksort($def); 
$ret.=menuder_form_kv($def,'bar" id="modbar',"","kk").' ';//defc
$ret.=btn("txtsmall",'condition:');
$here=$_SESSION['cond'][0];
$ret.=menuder_form_kv(array('-','home','cat','art'),'pos" id="modcond',$here,"vv").' ';
$ret.=btn("txtsmall",'position:');
if(!is_array($re))$re=array("-"=>array("-")); end($re); $here=current($re);//select last
$ret.=menuder_form_kv($re,'pos" id="modpos',$here,"vk").' ';
$ret.=ljb('popsav','SaveR','modules_'.$vl.'__add\',\'modpos|modbar|modcond',nms(92)).br();
$ret.='</form>'.br();
$ret.=divc('imgr',hlpbt('modules'));
$hlp=msql_read("lang","admin_modules","");//help
foreach($def as $k=>$v){$cat=$r[$k][0]; if(!$cat)$cat='user';
	if(!$_SESSION['line'][$k])$df[$cat][]=ljb('popbt','SaveR','modules_'.$vl.'_'.ajx($k).'_add\',\'modpos',$k).' '.btn('txtsmall2',$hlp[$k][0]);}
$ret.=make_tabs($df);
return $ret;}//popup('Add Module ('.$vl.'/'.$cnd.')',.divc('clear',''),550)

#good_array

//defd=constantes//defb=onetime//defc=restantes 
function whose_mods($re,$vl,$defs){//(4412)
if($defs){
if($vl=='system'){$defd=$defs['system'];
	$addr=explode(" ",prma('blocks').' template');
	foreach($addr as $k=>$v){if(!$defd[$v] && $v)$defd[$v]=3;}}
elseif($vl=="menu"){$defb=$defs["once"]; $defd=$defs["multi"]+$defs["connectors"];}
elseif($vl=="leftbar" or $vl=="rightbar"){$defb=$defs["once"];
	$defd=$defs["multi"]+$defs["connectors"]+$defs["articles"];}
elseif($vl=="content"){$defb=$defs["content"]+$defs["once"]; 
	$defd=$defs["multi"]+$defs["connectors"]+$defs["articles"];
	$defd+=array("chat"=>$defs["once"]["chat"]);}
elseif($vl=="newsletter"){$defb=$defs["content"]+$defs["once"];
	$defd=$defs["multi"]+$defs["connectors"]+$defs["articles"];}
elseif($vl=="banner"){$defb=$defs["multi"]+$defs["once"]; $defd=$defs["connectors"]+$defs["articles"];}
elseif($vl=="footer"){$defb=$defs["multi"]+$defs["footer"]+$defs["once"]; $defd=$defs["connectors"]+$defs["articles"];}
else{$defb=$defs["once"]; $defd=$defs["content"]+$defs["articles"]+$defs["multi"]+$defs["connectors"]+$defs["footer"]+$defs["articles"];}
$mod=user_mods(); if($defd && $mod)$defd+=$mod; elseif($mod)$defd=$mod;
if($defb)$defc=array_combine_sub($defb,$re);//php4
//if($defb)$defc=array_diff_key($defb,$re);//php5 
if($defc && $defd)$defc+=$defd; else $defc=$defd;}
return array($defb,$defc,$defd);}

#1st level
function see_conds($vl){$sp='';
$r=$_SESSION['mods'][$vl]; $cnd=$_SESSION['cond'];
if($r){foreach($r as $k=>$v)$ra[$v[3]]+=1;
foreach($ra as $k=>$v){list($ka,$kb)=split_r($k,3);
if($kb)$kc=str_replace(array('cat','art'),'',$k); else $kc=$k;
if($k)$ret.=ljb($k==$cnd[0]||$k==$cnd[1]?'active':'','SaveBb','modules_'.$vl.'__'.$k,$kc);}
if($ret){$all=ljb($cnd[0]?'':'active','SaveBb','modules_'.$vl.'__all',nms(100));
return divc('nbp',$all.$ret);}}}

#console_nav
function build_mod_subname($p,$m){
if(strpos($p,'§'))$p=split_only('§',$p,0,1);
if(strpos($p,'__'))$p=split_only('__',$p,0,1); 
$p=split_only(':',$p,0,0); $p=split_only(',',$p,0,0); $p=split_only(' ',$p,0,0);
$mb=mimes($m,$p); return ($mb?$mb.' ':'').$m;}

function console_module($k,$v,$vl){//(4411)
list($m,$p,$t,$c,$e,$g,$ch,$h)=$v; $cnd=$_SESSION['cond'];
if($k){$ret.=lj('','popup_submds___'.$k.'_'.$vl.'_mpos',picto('kright'));
if(($c==$cnd[0] && !$cnd[1]) or ($c && $c==$cnd[1]))$css='popw'; 
else $css='popbt'; if($h)$css.=' hide';
$css.='" title="'.stripslashes(is_array($p)?implode(' ',$p):$p);
//if($m=='apps')$ret.=lj($css,'popup_call___adminx_submod*pop_'.$k,$m); else 
$ret.=lj($css,'popup_module___'.$k,build_mod_subname($p,$m));}
return $ret;}

function console_system(){$r=array('blocks','design','content');
foreach($r as $k=>$v)if(!$_SESSION['prma'][$v])$ret[]=$v;
if($ret)return btn('txtalert',pictxt('alert','missing: '.implode(', ',$ret)));}

function console_block($vl){$r=define_modc_b($vl); $ret.=see_conds($vl).' '; 
$ret.=lj('','popup_modadd___'.$vl,picto('plus')).($o?br():' '); 
if(is_array($r))foreach($r as $k=>$v)$ret.=console_module($k,$v,$vl).($o?br():' ');//defd
if($vl=='system')$ret.=console_system($r);
return $ret;}

function console_nav(){
$r=explode(" ",'system '.prma('blocks'));
foreach($r as $k=>$v)if($v && $v!='clear'){if($v=='system')$hlp=hlpbt('blocsystem');
	elseif($v=='menu')$hlp=hlpbt('blocmenu'); else $hlp='';
	$ret.=ljb('txtx','SaveBb','modules_'.$v.'__',$v).$hlp;
	$ret.=divc('menu',divd('modules'.$v,console_block($v)));}//
$ret.=ljb('txtx','SaveBb','modules_dev__','test').hlpbt('bloctest').divc('menu',divd('modulesdev',console_block('dev')));
return $ret;}//.divb('cell|modedit','')

#rstr
function show_params_cat($r,$h){$ron=1;$fon=0; $j='lang_admin*restrictions_';
foreach($r as $k=>$v){$hlp=bubble('txtsmall2','popmsqt',$j.$k.'_description',$k);
$t=$h[$k][0]?$h[$k][0]:$v; if(rstr($k)){$n=1; $c='';} else {$n=0; $c='active';}
$ret[]=offon($n).' '.btn($cx,lj('','rstr_params___'.$k.'_'.$n,$t)).$hlp.br();}
return divc('nbp',colonize($ret,3,'','',550));}

function show_params($slct,$restrict){
$r=msql_read_prep('system','admin_restrictions');
$h=msql_read('lang','admin_restrictions');
if(auth(6))modif_params($slct,$restrict);
foreach($r as $k=>$v)$rb[$k]=show_params_cat($v,$h);
if(auth(6))$bt=msqlink('system','admin_restrictions','','imgr');
return $bt.make_tabs($rb,'rst');}

function modif_params($slct,$restrict){
$_SESSION['rstr'][$slct]=$restrict;
if($_SESSION['rstr'][63]==1)$_SESSION['negcss']=0;
backup_rstr('save');}

function backup_rstr_msql($r){
if($r)foreach($r as $k=>$v)$rc[$k]=array($v?1:0);
if($_GET['mkdflts']){$bs='system'; $nd='default';} else {$bs='users'; $nd=ses('qb');}
msql_save($bs,$nd.'_rstr',$rc,'');}

function get_rstr($b){
if($b=='defaults')$_SESSION['rstr']=default_rstr(0);
elseif($b=='restore')$_SESSION['rstr']=default_rstr(1);
$r=$_SESSION['rstr']; if(!$r)$r=default_rstr(0);
return $r;}

function backup_rstr($b){$r=get_rstr($b);
if($b!='restore' && $b!='defaults')backup_rstr_msql($r); $r[0]=0;
if($b!='=' && is_array($r))update('qdu','rstr',implode('',$r),'name',ses('qb'));}

function edit_rstr(){
$ret=msqlink('users',ses('qb').'_rstr');
$ret.=lkc('popbt','/?admin=restrictions&backup==','backup');
$ret.=lkc('popbt','/?admin=restrictions&backup=restore','restore');
$ret.=msqlink('system','default_rstr');
$ret.=lkc('popbt','/?admin=restrictions&backup=defaults','reset');
if(auth(6))$ret.=lkc('popbt','/?admin=restrictions&backup=mkdflts','set_default');
if($_GET['backup'] && auth(6))backup_rstr($_GET['backup']);
return $ret;}

#console
function select_mods_m(){
$r=msq_select('users',ses('qb'),'mods'); sort($r); $nw=msq_find_next($r);
$ret=slct_menus($r,'/?admin=console&slct_mods=',prmb(1),'active','','v').' ';
$ret.=lkc("popbt",'/?admin=console&newfrom_mods='.$nw,nms(99).':'.$nw).' ';//new
$prmb=sql('config','qdu','v','name="'.ses('qb').'"'); $prmb1=strprm($prmb,1,'#');
if($prmb1!=prmb(1))$ret.=lkc("txtyl",'/?admin=console&adopt_mods==',nms(66)).' ';//apply
return btn('nbp',btn('txtsmall','mods').' '.$ret).hlpbt('console_mods').' ';}

function backup_console(){//(421)
$base='msql/users/'; $nod=$_SESSION['modsnod']; $f=$base.$nod.'_sav.php';
$goto='/?admin=console';
if($d=$_GET["newfrom_mods"]){newmodfrom($d); select_mods($d);}
if($_GET["adopt_mods"]){foreach($_SESSION['prmb'] as $k=>$v)$vaue.=$v.'#';
	update("qdu","config",$vaue,"name",ses('qb'));}
if($_GET["backup_mods"])copy($base.$nod.'.php',$f);
if($_GET["mk_default"]){msq_copy('users',$nod,'system','default_mods');
msq_copy('users',$nod,'users','public_mods_1'); alert('system/default_mods;public_mods_1');}
if($_GET["restore_mods"]){copy($f,$base.$nod.'.php'); define_mods(''); define_condition();}
if($_GET["refresh_mods"]){define_mods(''); define_condition();}
if($_GET["make_copy"]){msq_copy('users',ses('qb').'_mods_'.ses('prmb1'),'users',$nod);
	define_mods('');define_condition();}
if($_GET["default_mods"]){msq_copy('system','default_mods','users',$nod);
	define_mods('');define_condition();}
$rt=array('backup'=>'save','restore'=>'left','refresh'=>'reload','copy'=>'copy','default'=>'file','mkdef'=>'export'); foreach($rt as $k=>$v)$rt[$k]=picto($v);
$ret=lkc('txtx" title="'.nms(94),$goto.'&backup_mods==',$rt['backup']);
if(is_file($f)){$ret.=lkc('txtx" title="'.nms(95),$goto.'&restore_mods==',$rt['restore']);}
$ret.=lkc('txtx" title="'.nms(97),$goto.'&refresh_mods==',$rt['refresh']);
if($p1=ses('prmb1'))$ret.=lkc('txtx" title="'.nms(132).':'.$p1,$goto.'&make_copy==',$rt['copy']);
$ret.=lkc('txtx" title="'.nms(96),$goto.'&default_mods==',$rt['default']);
if(auth(6))$ret.=lkc('txtx" title="'.nms(113),$goto.'&mk_default==',$rt['mkdef']).' ';
$ret.=hlpbt('console').' ';
$ret.=msqlink('',ses('qb').'_mods_'.prmb(1));
$ret.=msqlink('system','admin_modules');
return $ret.br();}

function backup_config(){
$f='params/'.ses('qb').'_saveconfig.txt';
$goto='/?admin='.$_GET["admin"];
$ret.=lkc("popbt",$goto.'&backup_config==',"backup_config").' ';
if(is_file($f)) $ret.=lkc("popbt",$goto.'&restore_config==',"restore_config").' ';
$ret.=lkt("popbt",$f,"config").' ';
if($_SESSION["auth"]>=5){
	if($_GET["backup_config"]){
$ret.=lkc("txtred",$goto.'&reset_config==',"!! default_config").' ';
		$tosave=implode("#",$_SESSION['prmb']);
		write_file($f,$tosave);}
	if($_GET["restore_config"]){
		$config=read_file($f);
		$_SESSION['prmb']=explode('#',$config);
		update("qdu","config",$config,"name",ses('qb'));
		$ret.=lkc("popdel",$goto,"old_config_restored");
		relod($goto);}
	if($_GET["reset_config"]){
		$prmdef=ndprms_defaults();
		$config=ses('qb').$prmdef[1];
		$_SESSION['prmb']=explode('#',$config);
		update("qdu","config",$config,"name",ses('qb'));
		relod($goto);}}
return $ret;}

//menuh
function menus_h($k){$j='popup_module__pop_'.$k.'_';
$ret.=lj('popbt',$j.'collect',"collect_structure").' ';
$ret.=lj('popbt',$j.'collect|1',"reverse").' - ';
$ret.=lj('popbt',$j.'nocat',"no_cat").' ';
$ret.=lj('popbt',$j.'nocat|1',"reverse").' - ';
$ret.=lj('popbt',$j.'append',"append").' ';
$ret.=lj('popbt',$j.'append|1',"reverse").' ';
return $ret;}
function menu_h_g($d){$p=explode("|",$d);
	if($p[0]=="append")$r=collect_hierarchie_b($p[1]);
	elseif($p[0]=="nocat")$r=collect_hierarchie_c($p[1],'');
	elseif($p[0]=="collect")$r=collect_hierarchie($p[1]);
if($r)foreach($r as $k=>$v){$ret.=$k."\n".supermenu($v);}
return $ret;}

?>