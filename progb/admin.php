<?php
#philum_admin_system

#references
function conn_help(){$qb=ses('qb');
$ret=helps('conn_help_txt'); $nb=0;
$ret=br().balc('blockquote','tabd',$ret).br().br();
$arr=['auto','basic','all','codeline',$qb];
foreach($arr as $v){$d='lang'; $nod='connectors_'.$v;
	$r=msql::read_b($d,$nod,'',1); if($r)$nb+=count($r); $arr=[];
	if($r)foreach($r as $ka=>$va)$arr[]=[$ka,$va[0]];
	if($arr)array_unshift($arr,[$v,'description']);
	$ret.=tabler($arr,1).br();}
return $nb.' connectors'.br().$ret;}//

#hubprm
function hubprm_sav($p,$o,$res){ 
$res=ajxg($res); if($res==' ')$res='';
if($p=='descript')$col='dscrp';
elseif($p=='google')$col='clr';
elseif($p=='menus')$col='menus';
$r=explode("\n",$res); foreach($r as $k=>$v)$r[$k]=trim($v); $res=implode("\n",$r);
update('qdu',$col,$res,'name',ses('qb'));
return btn('txtyl',$p.': saved');}

function hubprm($p){
if($p=='descript'){//field
	$d=sql('dscrp','qdu','v','name="'.ses('qb').'"');
	$ret='meta "description" in Home: [,]<br>';
	$ret.=textarea('hbp',$d,60,10);}
if($p=='google'){
	$d=sql('clr','qdu','v','name="'.ses('qb').'"');
	$ret.=lkc('txtx','https://www.google.com/webmasters/tools/home?hl=fr','google-site-verification').' '.btn('txtsmall','meta balise used by google').br();
	$ret.=input1('hbp',$d,40,'txtblc');}
$ret.=lj('popsav','hubprm_callp__xx_admin_hubprm*sav_'.ajx($p).'__hbp',nms(57));
return divd('hubprm',$ret);}

#codeline
//core
function core_view_edit($rb,$s){
$r=['function'=>$rb[0],'variables'=>$rb[1],'usage'=>stripslashes($rb[2]),'return'=>$rb[3],'context'=>$rb[4]];
$inp=input1('crvw',str_replace(',','/',$rb[1]).'§'.$s.':core','','txtx');
$bt=ljb('txtbox','jumpText_insert_b','crvw\',\'txarea','insert');
return on2cols($r,300,5).$inp.$bt.br();}

function core_view($d,$s){$js='crv_call___admin_core*view_';
$r=msql_read('system','program_core','',1); if($r)$cat=msql::cat($r,4);
$ret=slctmenusj($cat,$js,$d,' ').br();
if($d){$r=msql::tri($r,4,$d); if($r)$cat=msql::cat($r,0);
	if($s){$rb=$r[$cat[$s]]; return core_view_edit($rb,$s);}
	foreach($r as $k=>$v)$ret.=divc('row',lj('popbt','popup_callp___admin_core*view_'.$d.'_'.ajx($v[0],''),$v[0].'('.$v[1].')').btn('poph" title="returns: '.$v[3],$v[2]));}
return $ret;}

//conn
function conn_view($d,$s){$js='cnv_call___admin_conn*view_';
$r=msql_read('system','connectors_all','',1); 
$r=msql::tri($r,0,'embed'); if($r)$cat=msql::cat($r,2);
$ret=slctmenusj($cat,$js,$d,' ').br().br(); $cat=msql::tri($r,2,$d);//p($cat);
if($d){$r=msql::tri($r,2,$d);
	if($s){$ret.=divc('',nl2br(msql::val('lang','connectors_all',$s))).br();
	$ins='§'.$s.':conn'; if($_SESSION['cur_cl']=='template')$ins='[value'.$ins.']';
	$ret.=input('cnvw',$ins);
	$ret.=ljb('txtbox','jumpText_insert_b','cnvw\',\'txarea','insert').br();
	$ret.=btn('txtsmall2','use value§option if needed').br().br();}
	$ret.=slctmenusj($cat,$js.$d.'_',$s,br()).br();}
return $ret;}

//codeline_edit
function codeline_editor($d,$type,$slct){
$_SESSION['cur_cl']=$type; $menu='';
$r=msql_read('system','connectors_codeline','',1);
$rb=msql_read('lang','connectors_codeline','');
foreach($r as $k=>$v){$hlp='" title="'.($rb[$k]??'');
$menu.=lj('txtx'.$hlp,'editcl_clview___'.$k.'_'.$type,$k).' ';}
$re['preview']=clview_basic($d,$type,$slct);
$re['codeline']=$menu.br().br().divd('editcl','').divd('seecl','');
if($type=='template'){$re['structure']=codeline::parse($d,'','clpreview');
	$re['vars']=clview_vars();}
else{$re['core']=divd('crv',core_view('',''));}
$re['connectors']=divd('cnv',conn_view('',''));
$ret=make_tabs($re,'cdl');
return div(atc('imgr').ats('width:300px; padding:10px;'),$ret);}

//variables
function clview_vars(){$r=template_vars(); $ret='';
foreach($r as $k=>$v){$ret.=ljb('txtx','insert_b',$v.'\',\'txarea',$k).' ';}
return $ret;}
//structure
function clpreview($v){$r=decompact_conn_b($v); $ret='';
if($r[0])$ret.=divc('txtx',btn('txtblc','value').' '.$r[0]); 
if($r[1])$ret.=divc('txtx',btn('txtblc','option').' '.$r[1]); 
$ret.=divc('txtx',btn('txtblc','connector').' '.$r[2]);
return div(atc('txtbox').ats('margin:4px;'),$ret);}
//codeline
function clview($v,$t){
$p=msql::val('system','connectors_codeline',$v); list($p,$o)=opt($p,'§');
$hlp=msql::val('lang','connectors_codeline',$v);
$val=$p.($o?'§'.$o:'').':'.$v; if($t=='template')$val='['.$val.']';
$ret=divc('',$hlp).br().input('clvw',$val);
$ret.=ljb('txtbox','jumpText_insert_b','clvw\',\'txarea','insert').br();
return $ret;}
//clbasic_preview
function clview_basic_j($t,$s,$res){
$pr=ajxr($res); list($p,$re)=$pr;
if(!$re)$re=msql::val('users',nod($t),$s);
if($t=='template' && $re)$ret=codeline::parse($re,'','codeline');
else $ret=codeline::cbasic($re,$p);
if(strpos($ret,'<br')===false)$ret=nl2br($ret);
return divc('track',$ret).br().textarea('',$ret,40,5);}

function clview_basic($d,$type,$slct){
$type=ajx($type,''); $slct=ajx($slct,'');
$j='admin,pop,tri,mod,spe,art_clview*basic*j_'.$type.'_'.$slct.'_clvb|txarea';
$ret=input('clvb','').' '.ljc('popsav','clva',$j,'preview').br().br();
$ret.=divd('clva',clview_basic_j($type,$slct,'param_'));
return $ret;}

#connectors/modules/templates
function data_forbidden_names($d,$nod){$ks=ses('conns'); if(!$ks){
$r=msql_read('system','connectors_all',''); $ks=array_keys($r);
$r=msql_read('system','connectors_basic',''); $ks+=array_keys($r);
$r=msql_read('system','connectors_codeline',''); $ks+=array_keys($r);
$r=msql_read('','public_connectors',''); $ks+=array_keys($r);
$r=msql_read('',$nod,''); if($r)$ks+=array_keys($r); ses('conns',$ks);}
if(in_array($d,$ks))return btn('txtyl',$d.' '.nms(37));}

#cortex
function cortex_set($p,$o,$res=''){sesa($p,$o);
if($p=='slctlocal'){ses('slct',$o); ses('local',1);}
if($p=='slct')sesa('local',0);
if($p=='titl')ses('slct',$res);
$slct=ses('slct');
$ty=ses('type')=='templates'?'template':ses('type');//shit
$bs=ses('pubase')?'public':ses('qb'); $nod=$bs.'_'.$ty;
if($p=='sav'){list($t,$d)=ajxr($res); ses('slct',$t); msql::modif('',$nod,[$d],$t);}
if($p=='erase'){$r=msql::modif('',$nod,$slct,'del'); sesz('slct');}
if($p=='mkpub')msql::modif('','public_'.$ty,msql::row('',$nod,$slct),$slct);
if($p=='mkpriv')msql::modif('',ses('qb').'_'.$ty,msql::row('',$nod,$slct),$slct);
return cortex(ses('type'));}

function cortex($type=''){
$rid=randid('tmp'); req('pop,art,spe,tri');
$j=$rid.'_call___admin_cortex*set_';
$type=ses('type',$type); $ty=$type=='templates'?'template':$type;
$pubase=ses('pubase');//public base
$local=ses('local'); $slct=ses('slct');
$ret=hlpbt($type).' ';
$tmpl=['articles','tracks','titles','pubart','panart','cover'];
$bs=ses('pubase')?'public':ses('qb'); $nod=$bs.'_'.$ty;
$ret.=lj($pubase==1?'txtyl':'txtx',$j.'pubase_'.yesno($pubase),'public').' ';
$ret.=msqbt('',$nod).' ';
$ra=msql_read('',$nod,'',1);
if($type=='templates')$ret.=slctmenusj($tmpl,$j.'slctlocal_',$slct,'','v');
$ret.=lj('txtx',$j.'slct_new',picto('add')).br();
if($ra)$ret.=slctmenusj($ra,$j.'slct_',$slct,'','k');
if($slct){//save
	$msg=$ra[$slct]??''; $rmsg=[addslashes($msg)];
	if($slct=='pubart' && !rstr(55))$ret.=pictxt('alert','rstr(55)');
	if($slct=='tracks' && !rstr(65))$ret.=pictxt('alert','rstr(65)');
	if($slct=='titles' && !rstr(66))$ret.=pictxt('alert','rstr(66)');
	if($slct=='book' && !rstr(67))$ret.=pictxt('alert','rstr(67)');
	if($local && $type=='templates'){
		if($slct=='articles')$msg=template_art();
		elseif($slct=='meta')$msg=template_meta();
		elseif($slct=='rssin')$msg=template_rss();
		elseif($slct=='pubart')$msg=template_pubart();
		elseif($slct=='tracks')$msg=template_tracks();
		elseif($slct=='titles')$msg=template_titles();
		elseif($slct=='panart')$msg=template_panart();
		elseif($slct=='products')$msg=template_product();}
	$ret.=codeline_editor($msg,$type,$slct).br();
	if(!$pubase)$ret.=lj('txtx',$j.'mkpub_'.$slct,'make public').' ';
	else $ret.=lj('txtx',$j.'mkpriv_'.$slct,'make private').' ';
	$ret.=input('titl',$slct).' ';
	$ret.=lj('popsav',$rid.'_call___admin_cortex*set_sav__titl|txarea',nms(57)).' ';//sav
	if($slct!='default')$ret.=lj('txtyl',$j.'erase_'.$slct,'x').br();
	$ret.=jmp_btn_cb().br(); 
	$sj=sj('clva_call___admin,pop,tri,mod,spe,art_clview*basic*j_'.$type.'_'.$slct.'_clvb|txarea');
	$ret.=textarea('txarea',stripslashes($msg),44,14,atc('console').atb('onclick',$sj));}
return divd($rid,$ret);}

function jmp_btn_cb(){$ret='';
$r=array('?','!','+','-','_1','_PARAM','/','<-');
foreach($r as $va){if($va=="<-")$vb='\n'; else $vb=$va;
	$ret.=ljb('txtx','insert_b',$vb.'\',\'txarea',$va).' ';}
return $ret;}

//ban
function ban_sav($d){copy($d,'imgb/ban_'.ses('qb').'.jpg');return btn('txtyl','saved: '.$d);}
function ban_dir($id){$r=[]; $ret='';
if(substr($id,0,4)=='http'){$d=read_file($id); 
	write_file('imgb/ban_'.ses('qb').'.jpg',$d);}
elseif($id && !is_numeric($id)){
	$dir='users/'; $dirb=ses('qb').'/'.$id.'/';
	$r=explore($dir.$dirb,'files',1);}
elseif($id){$dir='img/'; 
	$d=sql('img','qda','v','id='.$id); $r=explode('/',$d);}
if($r)foreach($r as $k=>$v){$im=$dirb.$v;
	if(strpos(' .jpg.png.gif',substr($v,-3))){$ret.=mk::mini_b($im,'');
	$ret.=lj('txtbox','banslct_bansav___'.ajx($dir.$im,''),'select').br();}}
return $ret;}

function ban_slct(){
$ret=btn('small','ID, Url, or directory').' '.input('banimart','').' ';
$ret.=lj('txtbox','banslct_banslct_banimart','open').br().br();
$ret.=divd('banslct',ban_dir(''));
return $ret;}

function favicon_sav($d){$f='imgb/icons/system/philum/16/'.$d.'.png';
copy($f,'favicon.ico'); return image($f);}
function favicon_slct(){$dr='imgb/icons/system/philum/16';
$r=explore($dr,'files',1); $ret=btn('small','favicon').' : '.btd('favc',image('favicon.ico')).br();;
if($r)foreach($r as $k=>$v){$v=strto($v,'.'); $ico=imgico($dr.'/'.$v.'.png').' ';
	$ret.=lj('','favc_call___admin_favicon*sav_'.$v,$ico);}
return divc('bkg',$ret);}

function setpass_sav($use,$old,$pass){$ret=''; $goto=''; $use=ses('USE');
if($old==sql('pass','qdu','v','name="'.$use.'"'))update('qdu','pass',$pass,'name',$use);}

function set_password($USE){$ret=''; $goto='';
if(post('oldpassw')==sql('pass','qdu','v','name="'.$USE.'"')){
	update('qdu','pass',post('passw'),'name',$USE);}
$valu=input2('oldpassw','old_password','','','',50).'|';
$valu.=input2('passw','new_password','','','','50').' ';
$valu.=submit('Submit','ok','');
if(auth(7) && get('seepass'))$ret=tabler(sql('name,pass','qdu','vv',''));
return form($goto,$valu).$ret;}

function set_ban($p=''){$banim='imgb/ban_'.$_SESSION['qb'].'.jpg';
if($p=='ko')unlink($banim); $ret='';
if(file_exists($banim)){list($ban_w,$ban_h)=getimagesize($banim);
$ret=lkt('',$banim,image($banim,($ban_w/2),($ban_h/2))).' ';
$ret.=lj('txtblc','setban_call___admin_set*ban_ko','delete').br().br();}
$ret.=upload_j('banupl','banim').br();
return divd('setban',$ret.ban_slct().favicon_slct());}

#css_builder
function adm_css(){req('styl'); //echo js_link('js/live.js');
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
if(!$_SESSION['desgn'])$ret=divc('tab',helps('public_design')).br();
$r=msql::read_b('design',nod('design_'.$ndd),'',1);
return $ret.divd('admcss',design_edit($r,'','',0));}

function desname($qb,$desgn){
return msql::val('users',$qb.'_design',$desgn);}
function dsnam_arr($res){$md=prmb(1);
return array($res,array_part($_SERVER['HTTP_HOST'],'.',0),date('ymdHi',time()),$md);}
function msql_desnam($qb,$desgn,$res){
$jv='admin_msql*desnam_'.$qb.'_'.$desgn;
if($res)$res=ajxg($res); $ret=desname($qb,$desgn);
if($res=='init')return formj('rnt',$jv,'',$ret?$ret:'table_name');
$defb=array('_menus_'=>array('name','site','last-update','mods'));
$r=dsnam_arr($res);
if($res && $res!='init'){
	msql::modif('',$qb.'_design',$r,'one',$defb,$desgn);
	return formj('rnt',$jv,$res,'');}
return formj('rnt',$jv,$ret,'');}

function formj($id,$jv,$p,$v){ $ret='';
if(!$p){static $i; $i++; $ret.=input('inp'.$i,$v).' ';
$ret.=ljc('txtbox',$id,$jv.'_inp'.$i,'ok');}
else $ret=ljc('txtblc',$id,$jv.'_zero',$p);
return hidden('','zero','init').btd($id,$ret);}

function adm_colors(){return bal('iframe','src="plug/clrset.php" frameborder="0" width="700" height="220"','');}
function adm_finder($p,$o){if(!$p){$p=ses('qb'); $o='disk';}
	return divs('min-width:550px;',finder::home($p,$o));}
function adm_share(){return plugin('share','','');}
//function adm_msql_b(){return iframe('/?msql=/&wsz=700§720/500');}
function adm_msql($m){req('msql'); return msql_adm($m?$m:(auth(6)?'system':'users'));}
function csslang(){return msql_read('lang','helps_css','');}
function adm_editcss(){req('styl'); return edit_css();}

#admin_functions
function inject_fonts(){$dr='fonts/';
$ra=msql_read('server','edition_typos',''); $vra=array_keys_r($ra,0);
$rb=msql_read('system','edition_typos',''); $vrb=array_keys_r($rb,0);
$rc=explore($dr,'files',1); $vrf[]=1;
if($rc)foreach($rc as $k=>$v){list($nm,$xt)=split_right('.',$v,1,1);//add
	if($xt=='woff' or $xt=='eot' or $xt=='svg'){// or $xt=='ttf'
	if(!in_array($nm,$vra) && !in_array($nm,$vrb) && !in_array($nm,$vrf)){
		$rb[]=array($nm,'user','','',''); $vrf[]=$nm; $add[]=$nm;}
	elseif(!in_array($nm,$vra) && in_array($nm,$vrb)){$kb=in_array_b($nm,$vrb);
		$rb[]=$ra[$kb]; $vrf[]=$nm; $add[]=$nm;}}}
foreach($rb as $k=>$v){if($k!='_menus_'){//del
	if(!is_file($dr.$v[0].'.woff') && !is_file($dr.$v[0].'.eot') && !is_file($dr.$v[0].'.svg')){unset($rb[$k]); $del[]=$v[0];}}}
if(!is_dir('msql/server'))mkdir('msql/server');//sav
msql::save('server','edition_typos',$rb);
msql::save('system','edition_typos',$rb);
$ret.='table server/edition_typos updated'.br().br();
$ret.=count($add).' elements added: '.br().($add?implode(br(),$add).br():'').br();
$ret.=count($del).' elements deleted:'.br().($del?implode(br(),$del).br():'').br();
return $ret;}

function inject_typos($v){$dr='plug/tar/'; include($dr.'pclerror.lib.php'); 
include($dr.'pcltrace.lib.php');include($dr.'pcltar.lib.php');
PclTarExtract($v,'fonts','','');
return lka($v).' installed'.br();}

function edit_fonts(){$dir='users/'.ses('qb').'/fonts';
$ret=divc('panel',helps('fontserver')).br();
if($ins=get('install_packfont'))$ret.=inject_typos($dir.'/'.$ins);
if(get('inject'))$ret.=inject_fonts().br();
$r=explore($dir); if($r)$ret.='packages_found: ';
if($r)$ret.=slct_menus($r,'/?admin=fonts&install_packfont=','','txtx','txtx','v').br().br();//
$ret.=lkc('txtbox','/?admin=fonts&inject==','inject').' ';
$ret.=lkt('txtx','/plug/addfonts','add_from_web').' ';
$ret.=lj('txtx','popup_stylsff___1','Font-Face').' ';
$ret.=msqbt('server','edition_typos');
return $ret;}

function adm_newsletter(){req('adminx');
$t='newsletter'; $voc=helps('see_'.$t,$t);
$r['batch']=lj('popsav','popup_plup__3_'.$t.'_'.$t.'*batch',nms(28)).' ';
$r['batch'].=lj('txtbox','popup_plup__3_'.$t.'_'.$t.'*read',nms(65)).' ';
$r['batch'].=msqbt('users',ses('qb').'_mails');
$r['mails']=plugin($t,'edit');
$r['edit']=divd('mdls'.$t,console::block($t,1));
return make_tabs($r,'nl');}

function adm_tweetfeed(){return plugin('tweetfeed');}

#adm
function adm_messages(){req('art,spe');
if($_SESSION['auth']<1)return contact(nms(84),'txtcadr');
elseif($_SESSION['auth']>6)$ml=ses('qb'); else $ml=ses('USE');
$r=read_idy($ml,'DESC');
return output_trk($r);}

function adm_admin($adm,$va){
$st=$_SESSION['admin']?$_SESSION['admin']:'=';
return iframe('index.php?admin='.($adm?$adm:$st).'§680/500');}

function adm_console($d){return console::home($d);}

function adm_editor(){return iframe('plug/editor.php§640/500','');}
function adm_plugin(){return plugin('index');}

function adm_mod_hlp($p=''){$ret=''; $nb=0;
$mod=msql::prep('system','admin_modules'); 
$hlp=msql_read('lang','admin_modules','');
if($p)foreach($mod as $k=>$v){$nb+=count($v); $arr=[];
	foreach($v as $ka=>$va)$arr[$ka]=[$ka,valr($hlp,$ka,0)];
	if($arr)array_unshift($arr,[$k,'usage']);
	$ret.=tabler($arr,1).br();}
if($nb)$ret.=$nb.' modules'.br().$ret;
return $ret;}
function adm_tcm($n){$ret='';
foreach(['templates','connectors','modules'] as $k=>$v)$ret.=lj(active($k,$n),'admcnt_admin___'.$v,$v);
return divc('nbp',$ret);}
function adm_connectors(){
$lk=lj('txtblc','popup_callp___admin_conn*help',pictxt('info','connectors_infos'));
return adm_tcm(1).cortex('connectors').br().$lk;}
function adm_templates(){return adm_tcm(0).cortex('templates');}
function adm_modules(){
$lk=lj('txtblc','popup_callp___admin_adm*mod*hlp_1',pictxt('info','modules_info'));
return adm_tcm(2).cortex('modules').br().$lk;}

function hublist(){$wh=!auth(7)?'active=1':'';
$r=sql('name,hub,active','qdu','',$wh); $qb=ses('qb');
if($r)foreach($r as $k=>$v){
	$opn=sql('active','qdu','v','name="'.$v[0].'"');
	$t=offon($opn).' '.nms($opn==1?130:131);
	if(auth(7) or $v[0]==$qb)
		$bt=lj('','admhb_call___admin_sav*hub_publish_'.ajx($v[0]),$t);
	else $bt=btn('txtsmal2',$t);
	$ret[]=[lkc('','/hub/'.$v[0],$v[1]?$v[1]:$v[0]),$bt];}
return tabler($ret);}

function adm_killhub(){
$qb=ses('qb'); $f='users/'.$qb; if(!auth(6))return;
walk_dir($f,'remove'); rmdir($f);
$f='msql/users/'.$qb.'_cache.php'; if(is_file($f))unlink($f);
for($i=1;$i<10;$i++){
	$f='msql/design/'.$qb.'_design_'.$i.'.php'; if(is_file($f))unlink($f);
	$f='msql/design/'.$qb.'_clrset_'.$i.'.php'; if(is_file($f))unlink($f);
	$f='msql/users/'.$qb.'_mods_'.$i.'.php'; if(is_file($f))unlink($f);}
update('qda','nod','_'.$qb,'nod',$qb);
//qr('DELETE FROM '.ses('qdm').' WHERE id=(select id from '.ses('qda').' where name="'.$qb.'")');
//qr('DELETE FROM '.ses('qda').' WHERE name="'.$qb.'"');
//qr('DELETE FROM '.$qdu.' WHERE name="'.$qb.'" LIMIT 1');
if($_SESSION['USE']==$qb)$_SESSION['USE']=''; relod(subdomain(prms('default_hub')));}

function sav_hub($p,$o,$res){
$qb=ses('qb'); $res=ajxg($res);
if(auth(6))switch($p){
case('rename'):update('qdu','hub',$res,'name',$qb); $_SESSION['mn'][$qb]=$res; break;
//case('kill'):adm_killhub(); break;
//case('reinit'):makenew(ses('qb'),1); break;
case('publish'):$opn=sql('active','qdu','v','name="'.$o.'"');
	update('qdu','active',$opn==1?0:1,'name',$o);
	req('boot'); define_hubs(); break;}
return adm_hubs();}

function edit_hub($p,$o){
$qb=ses('qb'); $j='admhb_call__x_admin_sav*hub';
switch($p){
case('create'):req('pop'); $ret=login::form('','','create new hub'); break;
case('rename'):$ret=input('renamed',$_SESSION['mn'][$qb]);
	$ret.=lj('popsav',$j.'_rename__renamed',picto('save')); break;
case('kill'):$ret=lj('popdel',$j.'_kill_ok','Everything will be lost!!'); break;
case('reinit'):$ret=lj('popdel',$j.'_reinit_ok','restore all defaults ?'); break;}
return $ret;}

function adm_hubs(){$qb=ses('qb');
req('boot'); define_auth(); $ret='';
if((auth(6) && prms('create_hub')=='on') or auth(7))
	$ret.=lj('popbt','popup_callp___admin_edit*hub_create',nms(99));
$ret.=lj('popbt','popup_callp___admin_edit*hub_rename',nms(87));
if(auth(6))$ret.=lj('popbt','popup_callp___admin_edit*hub_kill',nmx([76,100]));
if(auth(5))$ret.=lj('popbt','popup_callp___admin_edit*hub_reinit',nms(103));
$opn=sql('active','qdu','v','name="'.$qb.'"');
$ret.=lj('popbt','admhb_call___admin_sav*hub_publish_'.ajx($qb),offon($opn).' '.nms($opn==1?130:131));
return divd('admhb',$ret.br().br().hublist());}

function adm_nodes($a='',$b='',$res=''){$qdb=ajxg($res); $ret=divc('panel',helps('nodes'));
$ret.=input('qd','node').' '.lj('','qdnd_call___admin_adm*nodes___qd',picto('ok')).br();
$db=connect(); $r=lstrc(rcptb($db)); $rb=[];
if(is_array($r) && auth(7)){
foreach($r as $v)$rb[]=strprm($v,0,'_'); $rb=array_flip($rb);
if($rb)foreach($rb as $k=>$v)if($k)$ret.=lkc(active($k,$_SESSION['qd']),'/?qd='.$k,$k).br();}
if(get('node')=='install'){$_SESSION['first']=1; $ret.=plugin('install',$qdb);}
return $ret;}

function adm_restrictions(){return rstr::home();}
function adm_disk(){return plugin('disk','','');}
function adm_edit_plug(){}
function adm_pictos(){return plugin('pictography','','');}
function adm_update($p){return plugin('software',$p,'');}

//params
function newmodfrom($d){
$nd=$_SESSION['qb'].'_mods_'; $_SESSION['modsnod']=$nd.$d;
if($d!=prmb(1) && !is_file('msql/users/'.$nd.$d.'.php')){
msql::copy('users',$nd.prmb(1),'users',$nd.$d);
echo btn('txtyl','_mods_'.$d.' created from _mods_'.prmb(1));}}

//adm_params
function adm_prm_sav($sup,$max,$res){
$r=ajxr($res); $rb[0]=''; foreach($r as $k=>$v)$rb[$k+1]=$v; //pr($rb);
$vals=implode('#',$rb);
if($sup && auth(7)){req('boot'); $db=connect(); $f='params/_'.$db.'_config.txt';
	write_file($f,$vals); update('qdu','struct',$vals,'name',ses('qb'));
	master_params('params/_'.$db,ses('qd'),ses('qb'),'');//subd
	alert(lkt('txtyl',$f,$db.'_config'));}
elseif(!$sup){$_SESSION['prmb']=$rb; update('qdu','config',$vals,'name',ses('qb'));}
return adm_params($sup);}

function adm_prm_form($ra,$prms,$sup){$max='';
if($sup)$hl='lang_admin*config_'; else $hl='lang_admin*params_'; $lc='msql/lang/';
foreach($ra as $t=>$ak)foreach($ak as $i=>$v)if($i!=22){
	if($max<$i)$max=$i;
	$attr=['id'=>'pms'.$i,'style'=>'width:200px;'];
	if($i==11 && !$sup)$r[$t][]=select($attr,affect_auth(ses('auth')),'kv',$prms[$i]);
	elseif($i==25){$dirs=explore($lc,'dirs',1); $dirs=str_replace($lc,'',$dirs); 
		$r[$t][]=select($attr,$dirs,'vv',$prms[$i]);}
	elseif($i==21)$r[$t][]=textarea('pms'.$i,$prms[$i],31,5).' ';
	else $r[$t][]=input1('pms'.$i,$prms[$i]??'','34').' ';
	$r[$t][]=btn('txtblc',$v).' '.btn('txtsmall2',togbub('popmsqt',$hl.$i,$i,'grey')).br();
	$rm[$i]='pms'.$i;}
for($i=1;$i<=$max;$i++)$rmb[$i]=$rm[$i]??''; $mv=implode('|',$rmb);
$bt=lj('popsav','admprm_call___admin_adm*prm*sav_'.$sup.'__'.$mv,picto('ok'));
return make_tabs($r,'prm').$bt;}

function adm_params($sup){
req('boot,adminx'); $db=connect();
if($sup){$f='params/_'.$db.'_config.txt';
	if(is_file($f))$prms=explode('#',read_file($f));
	$ra=msql::prep('system','admin_config');}
else{$pm=sql('config','qdu','v','name="'.ses('qb').'"');//$pm=$_SESSION['prmb']; 
	$prms=prmb_defaults($pm); $ra=msql::prep('system','admin_params');}
$ret=adm_prm_form($ra,$prms,$sup);
if($sup)$ret.=lj('txtbox','admprm_call___admin_adm*params','hub').' ';
elseif(auth(7))$ret.=lj('txtbox','admprm_call___admin_adm*params_1','server').' ';
if(!$sup)$ret.=console::backup_config();
$ret.=msqbt('system','admin_params');
return divd('admprm',$ret);}

function authes_levels(){return array(0=>'login',1=>'tracks',2=>'post',3=>'publish',4=>'edit',5=>'design',6=>'admin',7=>'host',8=>'dev');}
function nameofauthes($i){if(!is_numeric($i))$i=0;
$ath=authes_levels(); return $ath[$i];}
function affect_auth($auth){$ath=authes_levels();
for($i=0;$i<=$auth;$i++){$arf[$i]=$i.'::'.$ath[$i];}
return $arf;}

//avatar
function avatar($u){$f='imgb/avatar_'.$u.'.gif'; 
if(!is_file($f))$f=root().'imgb/avatar/Gems/EmeraldSquare.gif';
return '/'.$f.'?'.randid();}

function avatar_sav($dr,$p){$avat=root().$dr.'/'.$p;
$f=root().'imgb/avatar_'.ses('USE').'.gif';
if($p=='ko')@unlink($f); elseif($p)copy('imgb/avatar/'.$avat,$f);
return image(avatar(ses('USE')),'48','48');}

function avatar_slct($dir){$ret='';
$dr='imgb/avatar/'.$dir; $r=explore($dr,'files',1);
if($r)foreach($r as $k=>$v){$xt=substr($v,-3);
	if($xt=='gif' or $xt=='jpg'){$img=image('/'.$dr.'/'.$v,'48','48');
	$ret.=lj('','avatar_call___admin_avatar*sav_'.ajx($dir).'_'.ajx($v),$img);}}
return $ret;}

function adm_avatar($o){$f=avatar(ses('USE'));
if(!$o)$ret=divd('avatar',image($f,'48','48')).br();
$r=explore('imgb/avatar','dirs');
foreach($r as $k=>$v)$rt[$k]=avatar_slct($k);
$rt['upload'][]=upload_j('upl','avnim').' ';
$rt['upload'][]=lj('popbt','avatar_image___'.ajx('imgb/avatar_'.ses('USE').'.gif'),picto('refresh')).' ';
$rt['upload'][]=lj('popdel','avatar_call___admin_avatar*sav__ko',picto('del'));
return $ret.make_tabs($rt);}

function adm_stats($p='',$o=''){return plugin('stats',$p,$o);}

function adm_backup($p,$o,$res=''){
if(!auth(6))return; $qb=ses('qb');
list($id,$db)=ajxr($res,2); $bt=''; $ret='';
if($id && $p!=1)return plugin_func('backup','backup_build',$db,$id);
if($db)$id=sql_b('select id from '.qd($db).' order by id DESC limit 1','v');
$rdb=['art','txt','trk','meta','meta_art','search','search_art','poll','twit','user','web','yandex'];
$bt=select(atd('db'),$rdb,'vv','art').lj('txtbox','bckp_call___admin_adm*backup_1__fid|db','select');
if($db)return input('fid',$id).lj('popsav','bckp_call___admin_adm*backup___fid|db','export');
return $bt.divd('bckp','');}

#members
function mbr_become($p){
$use=ses('USE'); $qb=ses('qb');
if($p){sqlsav('qdb',[$p,$qb,2]); return 'Thank You!';}
$ex=sql('id','qdb','v',['name'=>$use]);
if(!$ex)$ret=lj('popsav','mbrbc_call___admin_mbr*become_'.$use.'__mbradu','become member');
else $ret='You are already a member';
return divd('mbrbc',$ret);}

function mbr_sav($p,$o,$res){$res=ajxg($res);
sqlup('qdb',['auth'=>$res],'id',$p?$p:'0');
return adm_members();}

function mbr_del($p,$o){
if(!$o)return lj('txtyl','mbrcb_call___admin_mbr*del_'.$p.'_1','really?');
sqldel('qdb',$p); return adm_members();}

function addu_sav($p,$o,$res){$res=ajxg($res);
sqlsav('qdb',[$res,ses('qb'),2]);
return adm_members();}

function mbr_addu($p,$o){
$r=sql('name','qdu','rv','');
$ret=select(atd('mbradu'),$r,'vv','');
$ret.=lj('','mbrcb_call___admin_addu*sav___mbradu',picto('save2'));
return $ret;}

function mbr_patch(){reqp('patchs'); patch_mbr();}

function adm_members(){$rb=[]; $qb=ses('qb'); $ath=ses('auth');
$r=sql('id,name,auth','qdb','','hub="'.ses('qb').'"');
$ra=[1=>'login',2=>'tracks',3=>'publish',4=>'editor',5=>'designer',6=>'admin',7=>'host'];
if($r)foreach($r as $k=>$v){
	$sav=lj('','mbrcb_call___admin_mbr*sav_'.$v[0].'__mbru'.$v[0],picto('save2'));
	$del=lj('','mbrcb_call___admin_mbr*del_'.$v[0],picto('del'));
	$slct=$v[1]!=$qb && $ath>=$v[2]?select(atd('mbru'.$v[0]),$ra,'kv',$v[2]).$sav.$del:$ra[$v[2]];
	$rb[]=[pictxt('p'.$v[2],$v[1]),$slct];}
$ret=tabler($rb,['name','auth']);
$ret.=divd('admadu',lj('popsav','admadu_call___admin_mbr*addu','add user'));
//$ret.=lj('popdel','admadu_call___admin_mbr*patch','patch',att('new members system'));
return divd('mbrcb',$ret);}

#articles
function artlist($qr,$admin,$dig){$wh=''; $ret=[]; $_SESSION['daya']=time();
if($dig)$sqlm='AND day>"'.calc_date($dig).'" AND day<"'.calc_date(time_prev($dig)).'"';
else $sqlm='AND day<'.$_SESSION['daya'].' ';
if($admin=='all_arts')$wh='';
elseif($admin=='my_arts')$wh.='AND name="'.$_SESSION['USE'].'"' ;// AND re>='1'
elseif($admin=='users_arts')$wh.='AND name!="'.$_SESSION['USE'].'"' ;
elseif($admin=='sys_arts'){$wh.='AND frm="_system"'; $sqlm='';}
elseif($admin=='trash'){$wh.='AND frm="_trash"'; $sqlm='';}
elseif($admin=='not_published')$wh.='AND re="0"' ;
if($tr1=get('cat'))$wh=' AND frm="'.$tr1.'" AND re>="1"';
if($tr2=get('triart'))$tri=$$tr2; else $tri='id';
if($tr3=get('triorder')==1)$tri.=' ASC'; elseif($tr3==2)$tri.=' DESC'; 
else $tri.=' DESC';
$ordr=$tri?' ORDER BY '.$tri:'';
if($admin=='categories'){$sqlm=''; $ordr='';}
$sql='nod="'.ses('qb').'" '.$wh.' '.$sqlm.$ordr;
$req=sqr(implode(',',$qr),'qda','where '.$sql); 
while($data=qrr($req))
	foreach($qr as $v)$ret[$data['id']][$v]=$data[$v];
return $ret;}

function admin_art_edit($id){
$msg=sql('msg','qdm','v','id='.$id);
$ath=data_val('msg',$id,'authlevel');
if($ath>$_SESSION['auth'])return popup('article '.$id,nms(55));
//$msg=str_replace('['.ses('qb').'/','['.host().'/users/'.ses('qb').'/',$msg);
//$msg=str_replace('['.ses('qb'),'['.host().'/img/'.ses('qb'),$msg);
$j='popup_editbrut_edit'.$id.'_x_'.$id;
if(auth(5))$ret=btn('',btd('bts',lj('popsav',$j,'save'))).' ';
$ret.=lj('txtbox','pop_editbrut___'.$id,'connectors').' ';
$ret.=lj('txtbox','edit'.$id.'_delconn__4_'.$id,'text').' ';
$ret.=lj('txtbox','edit'.$id.'_conn2__4_'.$id,'html').' ';
$ret.=hlpbt('conn_pub').br();
$ret.=textarea('edit'.$id,$msg,64,20,atc('console'));
return popup('article '.$id,$ret);}

function admin_art_sav($d,$id){
if($id && $d && $_SESSION['auth']>5)update('qdm','msg',$d,'id',$id);}

function admin_articles($r){$goto='';
$ye=btn('" style="color:green;',picto('true')).' '; 
$no=btn('" style="color:#bd0000;',picto('false')).' ';
foreach($_GET as $ka=>$va){$goto.=$ka.'='.$va.'&';} $goto='publish=';
foreach($r as $id=>$va){$cid='&art='.$id.'#'.$id;
foreach($va as $k=>$v){
switch($k){
case('id'):$v='<a name="'.$v.'"></a>'.lkt('',urlread($id),$v); break;
case('day'):$v=mkday($v,1); break;
case('suj'):$v=lj('','popup_editbrut___'.$id,$v); break;
case('img'):$v=''; break;
case('re'):$v=$v?$ye:$no; break;
case('host'):$v=art_length($v); break;}
$ret[$id][$k]=$v;}}
return $ret;}

function adminarts_pages($otp,$qrt,$admin,$dig,$page){
$page=$page?$page:1; $nbp=40; $min=($page-1)*$nbp; $max=$page*$nbp; $i=0; $rtr=[];
if(is_array($otp))foreach($otp as $id=>$va){$i++; if($i>=$min && $i<$max)$rtr[]=$va;}
$btpg=btpages($nbp,$page,$i,'admarts_admarts___'.ajx($admin).'_'.$dig.'_');
$ret=tabler($rtr,0);
return $btpg.$ret.$btpg;}

function cat2tag($d){req('meta'); $tg=$_POST['rdtg'];
$r=sql('id','qda','k','nod="'.ses('qb').'" and frm="'.$d.'"');
foreach($r as $k=>$v)sav_tag('',$k,$tg?$tg:'tag',$d);
return btn('txtred','all articles of this category have been taged with the name of the category');}

function admcat_ops($p,$o,$res=''){
$res=ajxg($res); $cat='';
if($o=='hide')$cat='_'.$p;
elseif($o=='publish' && substr($p,0,1)=='_')$cat=substr($p,1);
elseif($o=='modif')$cat=$res;
elseif($o=='totag')return cat2tag($p);
if($cat)qr('UPDATE '.ses('qda').' SET frm="'.$cat.'" WHERE nod="'.ses('qb').'" and frm="'.$p.'"');
return adm_categories();}

function edit_cats($cat){//plugin('maintainance','fixtag');
if(!auth(5))return; $ret='';
$j='edtcat_call___admin_admcat*ops_'.ajx($cat).'_';
if($cat){//champs
	$ret=btn('txtcadr',$cat);
	$ret.=input1('oldcat',$cat,15,'','',255);
	if(substr($cat,0,1!='_'))$ret.=lj('popbt',$j.'hide_oldcat','hide');
	else $ret.=lj('popbt',$j.'publish_oldcat','publish');
	$ret.=lj('popsav',$j.'modif_oldcat','modif');
	$ret.=lj('popbt',$j.'totag_oldcat','to:tag');
	$ret.=lkc('txtx',htac('cat').$cat,pictxt('url','go'));
	//$ret.=lj('txtx','admcnt_admin___all*arts',pictxt('view',$rub)).br();
	$ret.=lkc('txtx','/?admin=all_arts&cat='.$cat,picto('view')).br();}
return $ret.br();}

function adm_categories(){
$r=sql('frm','qda','k','nod="'.ses('qb').'" ORDER BY frm');
$rt[]=[nms(9),'nb'];
//if($_SESSION['auth']>=6)$lk='/?admin=categories&modif='; else $lk='/cat/';
if($r)foreach($r as $k=>$v){
	if(auth(6))$lk=lj('','edtcat_call___admin_edit*cats_'.ajx($k),$k); else $lk=$k;
	$rt[]=[$lk,$v];}
return divd('edtcat',tabler($rt));}

//overcat
function overcatsav($cat,$id,$res){$over=ajxg($res);
if($id)update('qdd','msg',$over.'/'.$cat,'id',$id);
else insert('qdd','(NULL,"'.ses('qbd').'","surcat","'.$over.'/'.$cat.'")');
return overcat();}
function overcatdel($id){if(auth(6))sqldel('qdd',$id); return overcat();}

function overcat(){
$r=sql('id,msg','qdd','kv','ib="'.ses('qbd').'" and val="surcat"');
if($r)foreach($r as $k=>$v){list($ov,$cat)=split_right('/',$v,1); $rb[$cat]=array($ov,$k);}
$r=sql('frm','qda','k','nod="'.ses('qb').'" and substring(frm,1,1)!="_" order by frm');
$ja='scat_call___admin_overcatsav_'; $jb='scat_call___admin_overcatdel_';
$ret=helps('overcat').hlpbt('overcats_menu').br().br();
if($r)foreach($r as $k=>$v){$id=randid();
	$rbk1=valr($rb,$k,1);
	$j=$ja.ajx($k).'_'.$rbk1.'_'.$id;
	if($rbk1)$ret.=lj('popdel',$jb.$rbk1,picto('del')).' ';
	$ret.=$k.' '.input($id,valr($rb,$k,0));
	$ret.=lj('popbt',$j,picto('ok')).' ';
	if(isset($rb[$k]))unset($rb[$k]);
	$ret.=br();}
//if($rb)pr($rb);//unused cats
if($rb)foreach($rb as $k=>$v)$ret.=lj('popdel',$jb.$rb[$k][1],pictxt('del',$cat)).' ';
return $ret;}

function edit_overcat(){return divd('scat',overcat());}

function pictocat_fill(){
$r=sql('frm','qda','k','');
if($r)foreach($r as $k=>$v)$rb[]=[$k,''];
msql::save('',nod('pictocat'),$rb);}

function pictocat($o=''){$da='cat,picto';//catpic
if($o)pictocat_fill();
$ret=lj('','popup_admin___pictos',picto('icon')).' ';
$ret.=lj('','popup_callp__x_admin_pictocat_1',picto('reload')).' ';
$ret.=plugin('msqedit','pictocat',$da);
return $ret;}

//arts
function adm_articles($admin,$dig='',$page=''){$bt='';
$rb=['categories','all_arts','my_arts','users_arts','sys_arts','not_published','trash','trackbacks','chat','overcat','pictocat'];
foreach($rb as $v)$bt.=lj('','admarts_admin___'.ajx($v),$v);
$ret=divc('nbp',$bt);
if($admin=='create')$ret.=artform('','');
elseif($admin=='categories')$ret.=adm_categories();
elseif($admin=='overcat')$ret.=edit_overcat();
elseif($admin=='pictocat')$ret.=pictocat();
elseif($admin=='trackbacks'){req('mod,art'); $ret.=trkarts('');}
else{
$qr=['id','suj','frm','day','name','re'];
$qrt=['id'=>'ID','suj'=>'Title (edit)','frm'=>'Category','day'=>'Date','name'=>'Author','re'=>'Published'];
$dig=$dig?$dig:$_SESSION['nbj']; $nbj=$dig?$dig:9999;
$r=artlist($qr,$admin,$dig); if($r)$r=admin_articles($r);
if(rstr(3))$ret.=dig_it_j($nbj,'admarts_admarts___'.ajx($admin).'_').br();
$ret.=adminarts_pages($r,$qrt,$admin,$dig,$page);}
return divd('admarts',$ret);}

#admin

function adminauthes(){$ret=[];
$af=msql::prep('system','admin_authes');
foreach($af as $k=>$v)foreach($v as $ka=>$va)
if($va<=$_SESSION['auth'])$ret[$k][$ka]=$va;
return $ret;}

function admin_menus(){$top='d';//rstr(69)?'':'d';
$rico=['Global'=>'admin','Articles'=>'articles','User'=>'user','Builders'=>'builders','Microsql'=>'server','txt'=>'editxt','pad'=>'txt']; $r=sesmk('adminauthes'); $ret='';
if($r)foreach($r as $k=>$v)if(isset($rico[$k]))$ret.=popbub('admn',$k,picto($rico[$k]),$top,1);
return $ret;}

#

#admin
function admin($nohead=''){
if(!$_SESSION['dayx']){req('boot'); reboot();}
$qb=ses('qb'); $qda=ses('qda'); $qdu=ses('qdu'); $USE=ses('USE'); $auth=ses('auth'); $hubname='';
//reboot after quit cssedit
$admin=get('admin',ses('admin')); if(!$admin)$admin='console'; $_SESSION['admin']=$admin;
if($set=get('set'))$_SESSION['set']=$set; $alert=''; $reta=''; $tit=''; $ret='';
if($USE){
	$hubname=sql('hub','qdu','v','name="'.$qb.'"');
	if(!$hubname)$hubname=$qb;
	$r=sql('name,hub','qdu','r','ip="'.hostname().'"');
	list($autologok,$userhub)=arr($r,2);}
//verif_user
if($USE!=$qb && $USE && $userhub)$hub=lk('/'.$USE,$USE);
elseif($USE!=$qb && $USE && $autologok!=$USE && $autologok)
	$alert.=lkc('txtx','/?log=on','autolog').' ';
elseif($USE==$qb && !$userhub && prmb(11)>=4)
	$alert.=lkc('txtred','/?log=create_hub','create_hub!');
elseif(!$USE)$reta=lkc('txtx','/home',$qb).br().br().login::form($USE,$_SESSION['iq'],'').br();
//admin_menu
$set=ses('set');
if($admin=='=')$_SESSION['set']=$set==$USE?'Global':'User';
//defaults
$aff=sesmk('adminauthes','',0);//$aff=adminauthes();
if(isset($aff[$set]) && !$admin){$admin=key($aff[$set]); $_SESSION['admin']=$admin;}//
$goto='/?admin='.$admin; $curauth='';
//$admin_lg=voc($admin,'admin_authes');
//auto_select_category
if($aff)foreach($aff as $k=>$v){
	if(isset($v[$admin])){$_SESSION['set']=$k; $curauth=$v[$admin];}
	foreach($v as $ka=>$va)if($auth>=$va)$raf[]=$ka;}
else $raf=[];
//if($curauth===false)$curauth=7;
//login
$w=lkc('popbt','/home',pictxt('home',$hubname));//asciinb($auth)
if($USE)$w.=lkc('popbt','/admin',pictxt('user',$USE.' '.picto('p'.$auth)).' ('.nameofauthes($auth).')');
//fastmenu
$rm=['console','desktop','restrictions','params','tags','articles','pictos','css','finder','connectors','Microsql','stats','update','api','twit','plugin','txt','pad','exec','test','members','others'];//,'plug'//,'modules','templates'
$reta.=divc('',$w.$alert); //$tit=lkc('txtit',htac('admin').$admin,$admin_lg).' ';
foreach($rm as $v){$x=$v=='css'?'url':'';//
	if($raf)if(in_array($v,$raf))$tit.=lj('txtx','admcnt_admin__'.$x.'_'.ajx($v),pictit(mime($v,'file-config'),$v,22));}
if($admin!='=')$reta.=divc('',$tit);
if($auth>=7 && $admin=='update')$ret=adm_update('=');
if($auth>=$curauth && $curauth){
switch($admin){//global
case('console'):$ret=adm_console(''); break;
case('desktop'):req('adminx'); $ret=adm_desktop($set,'',$_GET['dig']); break;
case('Microsql'):req('msql'); $ret=msql_adm(murl_boot()); break;
case('messages'):
	if($qb==$USE or $auth>=$curauth)$ret=adm_messages();
	else $ret=contact(nms(84),'txtcadr'); break;
case('hubs'):$ret=adm_hubs($auth); break;
case('nodes'):$ret=adm_nodes(); break;
case('stats'):list($pa,$oa)=explode('/',$set); $ret=plugin('stats',$pa,$oa); break;
case('newsletter'):$ret=adm_newsletter(); break;
case('tweetfeed'):$ret=adm_tweetfeed(); break;
//case('disk'):$ret=plugin('disk','',''); break;
//case('share'):$ret=plugin('share','',''); break;
case('tickets'):$ret=plugin('tickets','',''); break;
case('faq'):$r=msql_read('system','program_faq','');
	$ret=nl2br(stripslashes(divtable($r,1))); break;}
if($_SESSION['set']=='Articles')$ret=adm_articles($admin,get('dig'),get('page'));//articles
switch($admin){//configs
//case('chat'):req('art'); $ret=output_trk(read_idy('microchat','DESC')); break;
case('shop'):$ret=helps('shop_class'); break;
case('book'):$ret=plugin('book'); break;
case('restrictions'):$ret=adm_restrictions(); break;
case('params'):$ret=adm_params(0); break;
case('avatar'):if($USE)$ret=adm_avatar(0); break;
case('mail')://too old
	if(post('amail') && auth(6)){update('qdu','mail',post('amail'),'name',$USE);
		if($USE==$qb)$_SESSION['qbin']['adminmail']=post('amail');}
	$ml=sql('mail','qdu','v','name="'.$USE.'"');
	$valu=input2('amail',$ml,15,'','',50).' '.submit('Submit','modif_mail');
	$ret=form($goto,$valu); break;
case('password'):$ret=set_password($USE); break;
case('banner'):$ret=set_ban(); break;
case('descript'):$ret=hubprm($admin); break;
case('google'):$ret=hubprm($admin); break;
case('members'):$ret=adm_members($auth,$goto); break;
case('authes'):$titles=array('fonction','auth');
	if(auth(6))$ret=msqbt('system','admin_authes').br();
	foreach($aff as $k=>$v){$datas=''; arsort($v);
		foreach($v as $ka=>$va)$datas[$ka]=array($va);
		if($datas)array_unshift($datas,$titles);
		$out[$k]=tabler($datas,1);}
		$ret.=make_tabs($out,'at'); break;
//constructors
case('css'):$ret=adm_editcss(); break;
case('fonts'):$ret=edit_fonts(); break;
case('connectors'):$ret=adm_connectors(); break;
case('templates'):$ret=adm_templates(); break;
case('modules'):$ret=adm_modules(); break;
case('plugin'):$ret=adm_plugin(); break;
case('msql'):$ret=adm_msql(); break;
case('dev'):$ret=plugin('dev','',''); break;
case('tags'):req('meta'); $ret=admin_tags(get('set')); break;
case('finder'):$ret=finder::home($qb,'disk'); break;
case('backup'):$ret=adm_backup('',''); break;
case('update_notes'):$ret=adm_update_notes('',1); break;
case('pictos'):$ret=adm_pictos(); break;
case('plug'):$ret=adm_edit_plug(); break;
case('api'):$ret=plugin('apicom','',1); break;
case('others'):$rm=['nodes','newsletter','banner','dev','backup','htaccess','links','rssurl','mail','password','descrption','icons','authes','avatar','messages'];
	foreach($rm as $v)$ret.=lj('txtx','admcnt_admin___'.$v,pictit(mime($v),$v,22));
	break;}
if($admin && !$ret && $auth>=$curauth){
	if(method_exists($admin,'home'))$ret=$admin::home('','');
	else $ret=plugin($admin,get('p'),get('o'));}
}//end if auth
else switch($admin){case('members'):$ret=mbr_become(''); break;}
#render
if(!$nohead)$head=$reta; else $head='';
return $head.divd('admcnt',$ret);}

?>