<?php
#philum_admin_system
class adm{
#references
static function conn_help(){$qb=ses('qb');
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
static function hubprm_sav($p,$o,$prm=[]){
$res=prm[0]??''; if($res==' ')$res='';
if($p=='descript')$col='dscrp';
elseif($p=='google')$col='clr';
elseif($p=='menus')$col='menus';
$r=explode("\n",$res); foreach($r as $k=>$v)$r[$k]=trim($v); $res=implode("\n",$r);
update('qdu',$col,$res,'name',ses('qb'));
return btn('txtyl',$p.': saved');}

static function hubprm($p){
if($p=='descript'){//field
	$d=sql('dscrp','qdu','v','name="'.ses('qb').'"');
	$ret='meta "description" in Home: [,]<br>';
	$ret.=textarea('hbp',$d,60,10);}
if($p=='google'){
	$d=sql('clr','qdu','v','name="'.ses('qb').'"');
	$ret.=lkc('txtx','https://www.google.com/webmasters/tools/home?hl=fr','google-site-verification').' '.btn('txtsmall','meta balise used by google').br();
	$ret.=input1('hbp',$d,40,'txtblc');}
$ret.=lj('popsav','hubprm_adm,hubprm*sav_hbp_xx_'.ajx($p),nms(57));
return divd('hubprm',$ret);}

#codeline
//core
static function core_view_edit($rb,$s){
$r=['static function'=>$rb[0],'variables'=>$rb[1],'usage'=>stripslashes($rb[2]),'return'=>$rb[3],'context'=>$rb[4]];
$inp=input1('crvw',str_replace(',','/',$rb[1]).'�'.$s.':core','','txtx');
$bt=ljb('txtbox','jumpText_insert_b','crvw\',\'txarea','insert');
return on2cols($r,300,5).$inp.$bt.br();}

static function core_view($d,$s){$js='crv_adm,core*view___';
$r=msql::read('system','program_core','',1); if($r)$cat=msql::cat($r,4);
$ret=slctmenusj($cat,$js,$d,' ').br();
if($d){$r=msql::tri($r,4,$d); if($r)$cat=msql::cat($r,0);
	if($s){$rb=$r[$cat[$s]]; return self::core_view_edit($rb,$s);}
	foreach($r as $k=>$v)$ret.=divc('row',lj('popbt','popup_adm,core*view___'.$d.'_'.ajx($v[0],''),$v[0].'('.$v[1].')').btn('poph" title="returns: '.$v[3],$v[2]));}
return $ret;}

//conn
static function conn_view($d,$s){$js='cnv_admconn*view___';
$r=msql::read('system','connectors_all','',1);
$r=msql::tri($r,0,'embed'); if($r)$cat=msql::cat($r,2);
$ret=slctmenusj($cat,$js,$d,' ').br().br(); $cat=msql::tri($r,2,$d);//p($cat);
if($d){$r=msql::tri($r,2,$d);
	if($s){$ret.=divc('',nl2br(msql::val('lang','connectors_all',$s))).br();
	$ins='�'.$s.':conn'; if($_SESSION['cur_cl']=='template')$ins='[value'.$ins.']';
	$ret.=input('cnvw',$ins);
	$ret.=ljb('txtbox','jumpText_insert_b','cnvw\',\'txarea','insert').br();
	$ret.=btn('txtsmall2','use value�option if needed').br().br();}
	$ret.=slctmenusj($cat,$js.$d.'_',$s,br()).br();}//!
return $ret;}

//codeline_edit
static function codeline_editor($d,$type,$slct){
$_SESSION['cur_cl']=$type; $menu='';
$r=msql::kv('system','connectors_codeline');
$rb=msql::kv('lang','connectors_codeline');
foreach($r as $k=>$v){$hlp=att($rb[$k]??'');
$menu.=lj('txtx','editcl_adm,clview___'.$k.'_'.$type,$k,$hlp).' ';}
$re['preview']=self::clview_basic($d,$type,$slct);
$re['codeline']=$menu.br().br().divd('editcl','').divd('seecl','');
if($type=='template'){$re['structure']=codeline::parse($d,'','clpreview');
	$re['vars']=self::clview_vars();}
else{$re['core']=divd('crv',self::core_view('',''));}
$re['connectors']=divd('cnv',self::conn_view('',''));
$ret=make_tabs($re,'cdl');
return div(atc('imgr').ats('width:300px; padding:10px;'),$ret);}

//variables
static function clview_vars(){$r=sesmk2('tmp','vars','',0); $ret='';
foreach($r as $k=>$v){$ret.=ljb('txtx','insert_b',$v.'\',\'txarea',$k).' ';}
return $ret;}
//structure
static function clpreview($v){$r=decompact_conn_b($v); $ret='';
if($r[0])$ret.=divc('txtx',btn('txtblc','value').' '.$r[0]);
if($r[1])$ret.=divc('txtx',btn('txtblc','option').' '.$r[1]);
$ret.=divc('txtx',btn('txtblc','connector').' '.$r[2]);
return div(atc('txtbox').ats('margin:4px;'),$ret);}
//codeline
static function clview($v,$t){
$p=msql::val('system','connectors_codeline',$v); [$p,$o]=opt($p,'�');
$hlp=msql::val('lang','connectors_codeline',$v);
$val=$p.($o?'�'.$o:'').':'.$v; if($t=='template')$val='['.$val.']';
$ret=divc('',$hlp).br().input('clvw',$val);
$ret.=ljb('txtbox','jumpText_insert_b','clvw\',\'txarea','insert').br();
return $ret;}
//clbasic_preview
static function clview_basic_j($t,$s,$pr=[]){[$p,$re]=$pr;
if(!$re)$re=msql::val('users',nod($t),$s);
if($t=='template' && $re)$ret=codeline::parse($re,'','template');
else $ret=codeline::cbasic($re,$p);
if(strpos($ret,'<br')===false)$ret=nl2br($ret);
return divc('track',$ret).br().textarea('',$ret,40,5);}

static function clview_basic($d,$type,$slct){
$type=ajx($type,''); $slct=ajx($slct,'');
$j='clva_adm,clview*basic*j_clvb,txarea__'.$type.'_'.$slct;
$ret=input('clvb','').' '.lj('popsav',$j,'preview').br().br();
$ret.=divd('clva',self::clview_basic_j($type,$slct,'param_'));
return $ret;}

#connectors/modules/templates
/*static function data_forbidden_names($d,$nod){$ks=ses('conns'); if(!$ks){
$r=msql::read('system','connectors_all',''); $ks=array_keys($r);
$r=msql::read('system','connectors_basic',''); $ks+=array_keys($r);
$r=msql::read('system','connectors_codeline',''); $ks+=array_keys($r);
$r=msql::read('','public_connectors',''); $ks+=array_keys($r);
$r=msql::read('',$nod,''); if($r)$ks+=array_keys($r); ses('conns',$ks);}
if(in_array($d,$ks))return btn('txtyl',$d.' '.nms(37));}*/

#cortex
static function cortexset($p,$o,$prm=[]){ses($p,$o);
if($p=='slctlocal'){ses('slct',$o); ses('local',1);}
if($p=='slct')sesz('local');
if($p=='titl')ses('slct',$prm);
$slct=ses('slct');
$ty=ses('type')=='templates'?'template':ses('type');//shit
$bs=ses('pubase')?'public':ses('qb'); $nod=$bs.'_'.$ty;
if($p=='sav'){[$t,$d]=$prm; ses('slct',$t); msql::modif('',$nod,[$d],$t);}
if($p=='erase'){$r=msql::modif('',$nod,$slct,'del'); sesz('slct');}
if($p=='mkpub')msql::modif('','public_'.$ty,msql::row('',$nod,$slct),$slct);
if($p=='mkpriv')msql::modif('',ses('qb').'_'.$ty,msql::row('',$nod,$slct),$slct);
return self::cortex(ses('type'));}

static function cortex($type=''){
$rid=randid('tmp');
$j=$rid.'_adm,cortexset___';
$type=ses('type',$type); $ty=$type=='templates'?'template':$type;
$pubase=ses('pubase');//public base
$local=ses('local'); $slct=ses('slct');
$ret=hlpbt($type).' ';
$tmpl=['articles','tracks','titles','pubart','panart','cover'];
$bs=ses('pubase')?'public':ses('qb'); $nod=$bs.'_'.$ty;
$ret.=lj($pubase==1?'txtyl':'txtx',$j.'pubase_'.($pubase==1?0:1),'public').' ';
$ret.=msqbt('',$nod).' ';
$ra=msql::kv('',$nod);
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
		if($slct=='articles')$msg=tmp::art();
		elseif($slct=='meta')$msg=tmp::meta();
		elseif($slct=='rssin')$msg=tmp::rss();
		elseif($slct=='pubart')$msg=tmp::pubart();
		elseif($slct=='tracks')$msg=tmp::tracks();
		elseif($slct=='titles')$msg=tmp::titles();
		elseif($slct=='panart')$msg=tmp::panart();
		elseif($slct=='products')$msg=tmp::product();}
	$ret.=self::codeline_editor($msg,$type,$slct).br();
	if(!$pubase)$ret.=lj('txtx',$j.'mkpub_'.$slct,'make public').' ';
	else $ret.=lj('txtx',$j.'mkpriv_'.$slct,'make private').' ';
	$ret.=input('titl',$slct).' ';
	$ret.=lj('popsav',$rid.'_adm,cortexset_titl,txarea__sav',nms(57)).' ';//sav
	if($slct!='default')$ret.=lj('txtyl',$j.'erase_'.$slct,'x').br();
	$ret.=self::jmp_btn_cb().br();
	$sj=sj('clva_adm,clview*basic*j_clvb,txarea__'.$type.'_'.$slct);
	$ret.=textarea('txarea',stripslashes($msg),44,14,atc('console').atb('onclick',$sj));}
return divd($rid,$ret);}

static function jmp_btn_cb(){$ret='';
$r=['?','!','+','-','_1','_PARAM','/','<-'];
foreach($r as $va){if($va=="<-")$vb='\n'; else $vb=$va;
	$ret.=ljb('txtx','insert_b',$vb.'\',\'txarea',$va).' ';}
return $ret;}

//ban
static function bansav($d){copy($d,'imgb/ban_'.ses('qb').'.jpg');return btn('txtyl','saved: '.$d);}
static function bandir($id){$r=[]; $ret='';
if(substr($id,0,4)=='http'){$d=read_file($id);
	write_file('imgb/ban_'.ses('qb').'.jpg',$d);}
elseif($id && !is_numeric($id)){
	$dir='users/'; $dirb=ses('qb').'/'.$id.'/';
	$r=explore($dir.$dirb,'files',1);}
elseif($id){$dir='img/';
	$d=sql('img','qda','v','id='.$id); $r=explode('/',$d);}
if($r)foreach($r as $k=>$v){$im=$dirb.$v;
	if(strpos(' .jpg.png.gif',substr($v,-3))){$ret.=mk::mini_b($im,'');
	$ret.=lj('txtbox','banslct_adm,bansav___'.ajx($dir.$im,''),'select').br();}}
return $ret;}

static function banslct(){
$ret=btn('small','ID, Url, or directory').' '.input('banimart','').' ';
$ret.=lj('txtbox','banslct_adm,bandir_banimart','open').br().br();
$ret.=divd('banslct',self::bandir(''));
return $ret;}

static function faviconsav($d){$f='imgb/icons/system/philum/16/'.$d.'.png';
copy($f,'favicon.ico'); return image($f);}
static function favicon_slct(){$dr='imgb/icons/system/philum/16';
$r=explore($dr,'files',1); $ret=btn('small','favicon').' : '.btd('favc',image('favicon.ico')).br();;
if($r)foreach($r as $k=>$v){$v=strto($v,'.'); $ico=imgico($dr.'/'.$v.'.png').' ';
	$ret.=lj('','favc_adm,faviconsav_'.$v,$ico);}
return divc('bkg',$ret);}

/*static function setpass_sav($use,$old,$pass){$ret=''; $goto=''; $use=ses('USE');
if($old==sql('pass','qdu','v','name="'.$use.'"'))update('qdu','pass',$pass,'name',$use);}*/

static function set_password($USE){$ret=''; $goto='';
if(post('oldpassw')==sql('pass','qdu','v','name="'.$USE.'"')){
	update('qdu','pass',post('passw'),'name',$USE);}
$valu=input2('oldpassw','old_password','','','',50).'|';
$valu.=input2('passw','new_password','','','','50').' ';
$valu.=submit('Submit','ok','');
if(auth(7) && get('seepass'))$ret=tabler(sql('name,pass','qdu','vv',''));
return form($goto,$valu).$ret;}

static function set_ban($p=''){$banim='imgb/ban_'.$_SESSION['qb'].'.jpg';
if($p=='ko')unlink($banim); $ret='';
if(file_exists($banim)){[$ban_w,$ban_h]=getimagesize($banim);
$ret=lkt('',$banim,image($banim,($ban_w/2),($ban_h/2))).' ';
$ret.=lj('txtblc','setban_adm,set*ban___ko','delete').br().br();}
$ret.=upload_j('banupl','banim').br();
return divd('setban',$ret.self::banslct().self::favicon_slct());}

#css_builder
static function adm_css(){//echo jslink('js/live.js');
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
if(!$_SESSION['desgn'])$ret=divc('tab',helps('public_design')).br();
$r=msql::read_b('design',nod('design_'.$ndd),'',1);
return $ret.divd('admcss',styl::design_edit($r,'','',0));}

static function colors(){return iframe('app/clrset','700','220');}
static function finder($p,$o){if(!$p){$p=ses('qb'); $o='disk';}
	return divs('min-width:640px;',finder::home($p,$o));}
//static function share(){return plugin('share','','');}
//static function adm_msql_b(){return iframe('/?msql=/&wsz=700�720/500');}
static function msql($m){return msqa::home($m?$m:(auth(6)?'system':'users'));}
static function csslang(){return msql::col('lang','helps_css',0,1);}
static function editcss(){return styl::edit_css();}

#admin_static functions
static function inject_fonts(){$dr='fonts/';
$ra=msql::read('server','edition_typos',''); $vra=array_keys_r($ra,0);
$rb=msql::read('system','edition_typos',''); $vrb=array_keys_r($rb,0);
$rc=explore($dr,'files',1); $vrf[]=1;
if($rc)foreach($rc as $k=>$v){[$nm,$xt]=split_right('.',$v,1,1);//add
	if($xt=='woff' or $xt=='eot' or $xt=='svg'){// or $xt=='ttf'
	if(!in_array($nm,$vra) && !in_array($nm,$vrb) && !in_array($nm,$vrf)){
		$rb[]=[$nm,'user','','','']; $vrf[]=$nm; $add[]=$nm;}
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

static function inject_typos($v){$dr='plug/tar/'; include($dr.'pclerror.lib.php');
include($dr.'pcltrace.lib.php');include($dr.'pcltar.lib.php');
PclTarExtract($v,'fonts','','');
return lka($v).' installed'.br();}

static function edit_fonts(){$dir='users/'.ses('qb').'/fonts';
$ret=divc('panel',helps('fontserver')).br();
if($ins=get('install_packfont'))$ret.=self::inject_typos($dir.'/'.$ins);
if(get('inject'))$ret.=self::inject_fonts().br();
$r=explore($dir); if($r)$ret.='packages_found: ';
if($r)$ret.=slct_menus($r,'/?admin=fonts&install_packfont=','','txtx','txtx','v').br().br();//
$ret.=lkc('txtbox','/?admin=fonts&inject==','inject').' ';
$ret.=lkt('txtx','/plug/addfonts','add_from_web').' ';
$ret.=lj('txtx','popup_stylsff___1','Font-Face').' ';
$ret.=msqbt('server','edition_typos');
return $ret;}

static function newsletter(){
$t='newsletter'; $voc=helps('see_'.$t,$t);
$r['batch']=lj('popsav','popup_plug__3_'.$t.'_'.$t.'*batch',nms(28)).' ';
$r['batch'].=lj('txtbox','popup_plug__3_'.$t.'_'.$t.'*read',nms(65)).' ';
$r['batch'].=msqbt('users',ses('qb').'_mails');
$r['mails']=plugin($t,'edit');
$r['edit']=divd('mdls'.$t,console::block($t,1));
return make_tabs($r,'nl');}

#adm
static function messages(){
if($_SESSION['auth']<1)return contact(nms(84),'txtcadr');
elseif($_SESSION['auth']>6)$ml=ses('qb'); else $ml=ses('USE');
$r=ma::read_idy($ml,'DESC');
return art::output_trk($r);}

static function ifradmin($adm,$va){$st=get('admin','=');
return iframe('index.php?admin='.($adm?$adm:$st).'�680/500');}

static function console($d){return console::home($d);}
//static function editor(){return iframe('plug/editor.php�640/500','');}
//static function plugin(){return plugin('index');}

static function modhlp($p=''){$ret=''; $nb=0;
$mod=msql::prep('system','admin_modules');
$hlp=msql::read('lang','admin_modules','');
if($p)foreach($mod as $k=>$v){$nb+=count($v); $arr=[];
	foreach($v as $ka=>$va)$arr[$ka]=[$ka,valr($hlp,$ka,0)];
	if($arr)array_unshift($arr,[$k,'usage']);
	$ret.=tabler($arr,1).br();}
if($nb)$ret.=$nb.' modules'.br().$ret;
return $ret;}
static function adm_tcm($n){$ret='';
foreach(['templates','connectors','modules'] as $k=>$v)$ret.=lj(active($k,$n),'admcnt_admin___'.$v,$v);
return divc('nbp',$ret);}
static function connectors(){
$lk=lj('txtblc','popup_adm,conn*help',pictxt('info','connectors_infos'));
return self::adm_tcm(1).self::cortex('connectors').br().$lk;}
static function templates(){return self::adm_tcm(0).self::cortex('templates');}
static function modules(){
$lk=lj('txtblc','popup_adm,modhlp___1',pictxt('info','modules_info'));
return self::adm_tcm(2).self::cortex('modules').br().$lk;}

static function hublist(){$wh=!auth(7)?'active=1':'';
$r=sql('name,hub,active','qdu','',$wh); $qb=ses('qb');
if($r)foreach($r as $k=>$v){
	$opn=sql('active','qdu','v','name="'.$v[0].'"');
	$t=offon($opn).' '.nms($opn==1?130:131);
	if(auth(7) or $v[0]==$qb)
		$bt=lj('','admhb_adm,savhub___publish_'.ajx($v[0]),$t);
	else $bt=btn('txtsmal2',$t);
	$ret[]=[lkc('','/hub/'.$v[0],$v[1]?$v[1]:$v[0]),$bt];}
return tabler($ret);}

static function killhub(){
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

static function savhub($p,$o,$prm){
$qb=ses('qb'); $res=$prm[0]??'';
if(auth(6))switch($p){
case('rename'):update('qdu','hub',$res,'name',$qb); $_SESSION['mn'][$qb]=$res; break;
//case('kill'):self::killhub(); break;
//case('reinit'):makenew(ses('qb'),1); break;
case('publish'):$opn=sql('active','qdu','v','name="'.$o.'"');
	update('qdu','active',$opn==1?0:1,'name',$o);
	msqa::define_hubs(); break;}
return self::adm_hubs();}

static function edithub($p,$o){$qb=ses('qb');
switch($p){
case('create'):$ret=login::form('','','create new hub'); break;
case('rename'):$ret=input('renamed',$_SESSION['mn'][$qb]);
	$ret.=lj('popsav','admhb_adm,savhub_renamed_x_rename',picto('save')); break;
case('kill'):$ret=lj('popdel','admhb_adm,savhub__x_kill_ok','Everything will be lost!!'); break;
case('reinit'):$ret=lj('popdel','admhb_adm,savhub__x_reinit_ok','restore all defaults ?'); break;}
return $ret;}

static function adm_hubs(){$qb=ses('qb');
boot::define_auth(); $ret='';
if((auth(6) && prms('create_hub')=='on') or auth(7))
	$ret.=lj('popbt','popup_adm,edithub___create',nms(99));
$ret.=lj('popbt','popup_adm,edithub___rename',nms(87));
if(auth(6))$ret.=lj('popbt','popup_adm,edithub___kill',nmx([76,100]));
if(auth(5))$ret.=lj('popbt','popup_adm,edithub___reinit',nms(103));
$opn=sql('active','qdu','v','name="'.$qb.'"');
$ret.=lj('popbt','admhb_adm,savhub___publish_'.ajx($qb),offon($opn).' '.nms($opn==1?130:131));
return divd('admhb',$ret.br().br().self::hublist());}

static function nodes($a='',$b='',$prm=[]){$qdb=$prm[0]??''; $ret=divc('panel',helps('nodes'));
$ret.=input('qd','node').' '.lj('','qdnd_adm,nodes_qd',picto('ok')).br();
$db=connect(); $r=lstrc(rcptb($db)); $rb=[];
if(is_array($r) && auth(7)){
foreach($r as $v)$rb[]=strprm($v,0,'_'); $rb=array_flip($rb);
if($rb)foreach($rb as $k=>$v)if($k)$ret.=lkc(active($k,$_SESSION['qd']),'/?qd='.$k,$k).br();}
if(get('node')=='install'){$_SESSION['first']=1; $ret.=install::home($qdb);}
return $ret;}

//static function adm_disk(){return plugin('disk','','');}
//static function adm_update($p){return software::home($p,'');}

//params
static function newmodfrom($d){
$nd=$_SESSION['qb'].'_mods_'; $_SESSION['modsnod']=$nd.$d;
if($d!=prmb(1) && !is_file('msql/users/'.$nd.$d.'.php')){
msql::copy('users',$nd.prmb(1),'users',$nd.$d);
echo btn('txtyl','_mods_'.$d.' created from _mods_'.prmb(1));}}

//adm_params
static function prmsav($sup,$max,$r=[]){
$dn2=get('dn2'); $rn=explode(',',$dn2); $rb[0]='';
for($i=0;$i<$max;$i++)if($rn[$i]??'')$ra[]=substr($rn[$i],3);
foreach($ra as $k=>$v)$rb[$v]=$r[$k];
for($i=0;$i<$max;$i++)if(!isset($rb[$i]))$rb[$i]=''; ksort($rb);
$vals=implode('#',$rb);
if($sup && auth(7)){$db=connect(); $f='params/_'.$db.'_config.txt';
	write_file($f,$vals); update('qdu','struct',$vals,'name',ses('qb'));
	boot::master_params('params/_'.$db,ses('qd'),ses('qb'),'');//subd
	alert(lkt('txtyl',$f,$db.'_config'));}
elseif(!$sup){$_SESSION['prmb']=$rb; update('qdu','config',$vals,'name',ses('qb')); msql::save('',nod('config'),$rb);}
return self::params($sup);}

static function prmform($ra,$prms,$sup){$max='';
if($sup)$hl='lang_admin*config_'; else $hl='lang_admin*params_'; $lc='msql/lang/';
foreach($ra as $t=>$ak)foreach($ak as $i=>$v)if($i!=22){
	if($max<$i)$max=$i;
	$attr=['id'=>'pms'.$i,'style'=>'width:200px;'];
	if($i==11 && !$sup)$r[$t][]=select($attr,self::affect_auth(ses('auth')),'kv',$prms[$i]);
	elseif($i==25){$dirs=explore($lc,'dirs',1); $dirs=str_replace($lc,'',$dirs);
		$r[$t][]=select($attr,$dirs,'vv',$prms[$i]);}
	elseif($i==21)$r[$t][]=textarea('pms'.$i,$prms[$i],31,5).' ';
	else $r[$t][]=input1('pms'.$i,$prms[$i]??'','34').' ';
	$r[$t][]=btn('txtblc',$v).' '.btn('txtsmall2',togbub('usg,popmsqt',$hl.$i,$i,'grey')).br();
	$rm[$i]='pms'.$i;}
for($i=1;$i<=$max;$i++)$rmb[$i]=$rm[$i]??''; $mv=implode(',',$rmb);
$bt=lj('popsav','admprm_adm,prmsav_'.$mv.'__'.$sup.'_'.$max,picto('ok'));
return make_tabs($r,'prm').$bt;}

static function params($sup){
$db=connect();
if($sup){$f='params/_'.$db.'_config.txt';
	if(is_file($f))$prms=explode('#',read_file($f));
	$ra=msql::prep('system','admin_config');}
else{$pm=sql('config','qdu','v','name="'.ses('qb').'"');//$pm=$_SESSION['prmb'];
	$prms=boot::prmb_defaults($pm); $ra=msql::prep('system','admin_params');}
$ret=self::prmform($ra,$prms,$sup);
if($sup)$ret.=lj('txtbox','admprm_adm,params','hub').' ';
elseif(auth(7))$ret.=lj('txtbox','admprm_adm,params___1','server').' ';
if(!$sup)$ret.=console::backup_config();
$ret.=msqbt('system','admin_params');
return divd('admprm',$ret);}

static function authes_levels(){return [0=>'login',1=>'tracks',2=>'post',3=>'publish',4=>'edit',5=>'design',6=>'admin',7=>'host',8=>'dev'];}
static function nameofauthes($i){if(!is_numeric($i))$i=0;
$ath=self::authes_levels(); return $ath[$i];}
static function affect_auth($auth){$ath=self::authes_levels();
for($i=0;$i<=$auth;$i++){$arf[$i]=$i.'::'.$ath[$i];}
return $arf;}

//avatar
static function avatarimg($u){$f='imgb/avatar_'.$u.'.gif';
if(!is_file($f))$f=root().'imgb/avatar/Gems/EmeraldSquare.gif';
return '/'.$f.'?'.randid();}

static function avatarsav($dr,$p){$avat=root().$dr.'/'.$p;
$f=root().'imgb/avatar_'.ses('USE').'.gif';
if($p=='ko')@unlink($f); elseif($p)copy('imgb/avatar/'.$avat,$f);
return image(self::avatarimg(ses('USE')),'48','48');}

static function avatarslct($dir){$ret='';
$dr='imgb/avatar/'.$dir; $r=explore($dr,'files',1);
if($r)foreach($r as $k=>$v){$xt=substr($v,-3);
	if($xt=='gif' or $xt=='jpg'){$img=image('/'.$dr.'/'.$v,'48','48');
	$ret.=lj('','avatar_adm,avatarsav_'.ajx($dir).'_'.ajx($v),$img);}}
return $ret;}

static function avatar($o){$f=self::avatarimg(ses('USE'));
if(!$o)$ret=divd('avatar',image($f,'48','48')).br();
$r=explore('imgb/avatar','dirs');
foreach($r as $k=>$v)$rt[$k]=self::avatarslct($k);
$rt['upload'][]=upload_j('upl','avnim').' ';
$rt['upload'][]=lj('popbt','avatar_usg,img___'.ajx('imgb/avatar_'.ses('USE').'.gif'),picto('refresh')).' ';
$rt['upload'][]=lj('popdel','avatar_adm,avatarsav____ko',picto('del'));
return $ret.make_tabs($rt);}

static function backup($p,$o,$prm=[]){
if(!auth(6))return; $qb=ses('qb');
[$id,$db]=arr($prm,2); $bt=''; $ret='';
if($id && $p!=1)return backup::build($db,$id);
if($db)$id=sql_b('select id from '.qd($db).' order by id DESC limit 1','v');
$rdb=['art','txt','trk','meta','meta_art','search','search_art','poll','twit','user','web','yandex'];
$bt=select(['id'=>'db'],$rdb,'vv','art').lj('txtbox','bckp_adm,backup_fid,db__1','select');
if($db)return input('fid',$id).lj('popsav','bckp_adm,backup_fid,db','export');
return $bt.divd('bckp','');}

#members
static function mbr_become($p,$o='',$prm=[]){
$use=ses('USE'); $qb=ses('qb');
if($p){sqlsav('qdb',[$p,$qb,2]); return 'Thank You!';}
$ex=sql('id','qdb','v',['name'=>$use]);
if(!$ex)$ret=lj('popsav','mbrbc_adm,mbr*become_mbradu__'.$use,'become member');
else $ret='You are already a member';
return divd('mbrbc',$ret);}

static function mbr_sav($p,$o,$prm=[]){$res=$prm[0]??'';
if($res)sqlup('qdb',['auth'=>$res],'id',$p?$p:'0');
return self::members();}

static function mbr_del($p,$o){
if(!$o)return lj('txtyl','mbrcb_adm,mbr*del___'.$p.'_1','really?');
sqldel('qdb',$p); return self::members();}

static function addu_sav($p,$o,$prm=[]){
sqlsav('qdb',[$prm[0]??'',ses('qb'),2]);
return self::members();}

static function mbr_addu($p,$o){
$r=sql('name','qdu','rv','');
$ret=select(['id'=>'mbradu'],$r,'vv','');
$ret.=lj('','mbrcb_adm,addu*sav_mbradu',picto('save2'));
return $ret;}

static function members(){$rb=[]; $qb=ses('qb'); $ath=ses('auth');
$r=sql('id,name,auth','qdb','','hub="'.ses('qb').'"');
$ra=[1=>'login',2=>'tracks',3=>'publish',4=>'editor',5=>'designer',6=>'admin',7=>'host'];
if($r)foreach($r as $k=>$v){
	$sav=lj('','mbrcb_adm,mbr*sav_mbru'.$v[0].'__'.$v[0],picto('save2'));
	$del=lj('','mbrcb_adm,mbr*del___'.$v[0],picto('del'));
	$slct=$v[1]!=$qb && $ath>=$v[2]?select(['id'=>'mbru'.$v[0]],$ra,'kv',$v[2]).$sav.$del:$ra[$v[2]];
	$rb[]=[pictxt('p'.$v[2],$v[1]),$slct];}
$ret=tabler($rb,['name','auth']);
$ret.=divd('admadu',lj('popsav','admadu_adm,mbr*addu','add user'));
//$ret.=lj('popdel','admadu_adm,mbr*patch','patch',att('new members system'));
return divd('mbrcb',$ret);}

static function mbr_patch(){reqp('patchs'); patch_mbr();}

#articles
static function artlist($qr,$admin,$dig){$wh=''; $ret=[]; $_SESSION['daya']=time();
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

static function artedit($id){
$msg=sql('msg','qdm','v','id='.$id);
$ath=ma::data_val('msg',$id,'authlevel');
if($ath>$_SESSION['auth']){ses::$r['popw']=320; ses::$r['popt']='article '.$id; return nms(55);}
$j='popup_usg,editbrut_edit'.$id.'_x_'.$id;
if(auth(5))$ret=btn('',lj('popsav',$j,'save')).' ';
$ret.=lj('txtbox','pop_usg,editbrut___'.$id,'connectors').' ';
$ret.=lj('txtbox','edit'.$id.'_usg,delconn__4_'.$id,'text').' ';
$ret.=lj('txtbox','edit'.$id.'_usg,conn2__4_'.$id,'html').' ';
$ret.=hlpbt('conn_pub').br();
$ret.=textarea('edit'.$id,$msg,64,20,atc('console'));
ses::$r['popt']='article '.$id;
return $ret;}

static function artsav($d,$id){
if($id && $d && $_SESSION['auth']>5)update('qdm','msg',$d,'id',$id);}

static function list_articles($r){$goto='';
$ye=btn('" style="color:green;',picto('true')).' ';
$no=btn('" style="color:#bd0000;',picto('false')).' ';
foreach($_GET as $ka=>$va){$goto.=$ka.'='.$va.'&';} $goto='publish=';
foreach($r as $id=>$va){$cid='&art='.$id.'#'.$id;
foreach($va as $k=>$v){
switch($k){
case('id'):$v='<a name="'.$v.'"></a>'.lkt('',urlread($id),$v); break;
case('day'):$v=mkday($v,1); break;
case('suj'):$v=lj('','popup_usg,editbrut___'.$id,$v); break;
case('img'):$v=''; break;
case('re'):$v=$v?$ye:$no; break;
case('host'):$v=art::length($v); break;}
$ret[$id][$k]=$v;}}
return $ret;}

static function adminarts_pages($otp,$qrt,$admin,$dig,$page){
$page=$page?$page:1; $nbp=40; $min=($page-1)*$nbp; $max=$page*$nbp; $i=0; $rtr=[];
if(is_array($otp))foreach($otp as $id=>$va){$i++; if($i>=$min && $i<$max)$rtr[]=$va;}
$btpg=pop::btpages($nbp,$page,$i,'admarts_adm,articles___'.ajx($admin).'_'.$dig.'_');
$ret=tabler($rtr,0);
return $btpg.$ret.$btpg;}

static function cat2tag($d,$tg='tag'){
$r=sql('id','qda','k','nod="'.ses('qb').'" and frm="'.$d.'"');
foreach($r as $k=>$v)meta::sav_tag('',$k,$tg,$d);
return btn('txtred','all articles of this category have been taged with the name of the category');}

static function admcat_ops($p,$o,$prm=[]){
$res=$prm[0]??''; $cat='';
if($o=='hide')$cat='_'.$p;
elseif($o=='publish' && substr($p,0,1)=='_')$cat=substr($p,1);
elseif($o=='modif')$cat=$res;
elseif($o=='totag')return self::cat2tag($p);
if($cat)qr('UPDATE '.ses('qda').' SET frm="'.$cat.'" WHERE nod="'.ses('qb').'" and frm="'.$p.'"');
return self::categories();}

static function edit_cats($cat){//plugin('maintainance','fixtag');
if(!auth(5))return; $ret='';
$j='edtcat_adm,admcat*ops_oldcat__'.ajx($cat).'_';
if($cat){//champs
	$ret=btn('txtcadr',$cat);
	$ret.=input1('oldcat',$cat,15,'','',255);
	if(substr($cat,0,1!='_'))$ret.=lj('popbt',$j.'hide','hide');
	else $ret.=lj('popbt',$j.'publish','publish');
	$ret.=lj('popsav',$j.'modif','modif');
	$ret.=lj('popbt',$j.'totag','to:tag');
	$ret.=lkc('txtx',htac('cat').$cat,pictxt('url','go'));
	//$ret.=lj('txtx','admcnt_admin___all*arts',pictxt('view',$rub)).br();
	$ret.=lkc('txtx','/?admin=all_arts&cat='.$cat,picto('view')).br();}
return $ret.br();}

static function categories(){
$r=sql('frm','qda','k','nod="'.ses('qb').'" ORDER BY frm');
$rt[]=[nms(9),'nb'];
//if($_SESSION['auth']>=6)$lk='/?admin=categories&modif='; else $lk='/cat/';
if($r)foreach($r as $k=>$v){
	if(auth(6))$lk=lj('','edtcat_adm,edit*cats_'.ajx($k),$k); else $lk=$k;
	$rt[]=[$lk,$v];}
return divd('edtcat',tabler($rt));}

//overcat
static function overcatsav($cat,$id,$prm=[]){$over=$prm[0]??'';
if($id)update('qdd','msg',$over.'/'.$cat,'id',$id);
else insert('qdd','(NULL,"'.ses('qbd').'","surcat","'.$over.'/'.$cat.'")');
return self::overcat();}
static function overcatdel($id){if(auth(6))sqldel('qdd',$id); return self::overcat();}

static function overcat(){
$r=sql('id,msg','qdd','kv','ib="'.ses('qbd').'" and val="surcat"');
if($r)foreach($r as $k=>$v){[$ov,$cat]=split_right('/',$v,1); $rb[$cat]=[$ov,$k];}
$r=sql('frm','qda','k','nod="'.ses('qb').'" and substring(frm,1,1)!="_" order by frm');
$jb='scat_adm,overcatdel___';
$ret=helps('overcat').hlpbt('overcats_menu').br().br();
if($r)foreach($r as $k=>$v){$id=randid();
	$rbk1=valr($rb,$k,1);
	$j='scat_adm,overcatsav_'.$id.'__'.ajx($k).'_'.$rbk1;
	if($rbk1)$ret.=lj('popdel',$jb.$rbk1,picto('del')).' ';
	$ret.=$k.' '.input($id,valr($rb,$k,0));
	$ret.=lj('popbt',$j,picto('ok')).' ';
	if(isset($rb[$k]))unset($rb[$k]);
	$ret.=br();}
//if($rb)pr($rb);//unused cats
if($rb)foreach($rb as $k=>$v)$ret.=lj('popdel',$jb.$rb[$k][1],pictxt('del',$cat)).' ';
return $ret;}

static function edit_overcat(){return divd('scat',self::overcat());}

static function pictocat_fill(){
$r=sql('frm','qda','k','');
if($r)foreach($r as $k=>$v)$rb[]=[$k,''];
msql::save('',nod('pictocat'),$rb);}

static function pictocat($o=''){$da='cat,picto';//catpic
if($o)self::pictocat_fill();
$ret=lj('','popup_pictography,home',picto('icon')).' ';
$ret.=lj('','popup_adm,pictocat___1',picto('reload')).' ';
$ret.=msqedit::call('pictocat',$da);
return $ret;}

//arts
static function articles($admin,$dig='',$page=''){$bt='';
$rb=['categories','all_arts','my_arts','users_arts','sys_arts','not_published','trash','trackbacks','chat','overcat','pictocat'];
foreach($rb as $v)$bt.=lj('','admarts_admin___'.ajx($v),$v);
$ret=divc('nbp',$bt);
if($admin=='create')$ret.=edit::artform('','');
elseif($admin=='categories')$ret.=adm_categories();
elseif($admin=='overcat')$ret.=self::edit_overcat();
elseif($admin=='pictocat')$ret.=self::pictocat();
elseif($admin=='trackbacks'){$ret.=md::trkarts('','Tracks',0,1);}
else{
$qr=['id','suj','frm','day','name','re'];
$qrt=['id'=>'ID','suj'=>'Title (edit)','frm'=>'Category','day'=>'Date','name'=>'Author','re'=>'Published'];
$dig=$dig?$dig:$_SESSION['nbj']; $nbj=$dig?$dig:9999;
$r=self::artlist($qr,$admin,$dig); if($r)$r=self::list_articles($r);
if(rstr(3))$ret.=pop::dig_it_j($nbj,'admarts_adm,articles___'.ajx($admin).'_').br();
$ret.=self::adminarts_pages($r,$qrt,$admin,$dig,$page);}
return divd('admarts',$ret);}

#admin

static function adminauthes(){$ret=[];
$af=msql::prep('system','admin_authes');
foreach($af as $k=>$v)foreach($v as $ka=>$va)
if($va<=$_SESSION['auth'])$ret[$k][$ka]=$va;
return $ret;}

static function menus(){$top='d';//rstr(69)?'':'d';
$rico=['Global'=>'admin','Articles'=>'articles','User'=>'user','Builders'=>'builders','Microsql'=>'server','txt'=>'editxt','pad'=>'txt']; $r=sesmk2('adm','adminauthes',0,1); $ret='';
if($r)foreach($r as $k=>$v)if(isset($rico[$k]))$ret.=popbub('admn',$k,picto($rico[$k]),$top,1);
return $ret;}

#

#admin
static function home($nohead=''){
if(!$_SESSION['dayx'])boot::reboot();
$qb=ses('qb'); $qda=ses('qda'); $qdu=ses('qdu'); $USE=ses('USE'); $auth=ses('auth'); $hubname='';
//reboot after quit cssedit
$admin=get('admin'); if(!$admin)$admin='console';
if($set=get('set'))$_SESSION['set']=$set; $alert=''; $reta=''; $tit=''; $ret='';
if($USE){
	$hubname=sql('hub','qdu','v','name="'.$qb.'"');
	if(!$hubname)$hubname=$qb;
	$r=sql('name,hub','qdu','r','ip="'.hostname().'"');
	[$autologok,$userhub]=arr($r,2);}
//verif_user
if($USE!=$qb && $USE && $userhub)$hub=lk('/'.$USE,$USE);
elseif($USE!=$qb && $USE && $autologok!=$USE && $autologok)
	$alert.=lkc('txtx','/?log=on','autolog').' ';
elseif($USE==$qb && !$userhub && prmb(11)>=4)
	$alert.=lkc('txtred','/?log=create_hub','create_hub!');
elseif(!$USE)$reta=lkc('txtx','/home',$qb).br().br().login::form($USE,ses('iq'),'').br();
//admin_menu
$set=ses('set');
if($admin=='=')$_SESSION['set']=$set==$USE?'Global':'User';
//defaults
$aff=sesmk2('adm','adminauthes','',0);//$aff=self::adminauthes();
if(isset($aff[$set]) && !$admin){$admin=key($aff[$set]); geta('admin',$admin);}
$goto='/?admin='.$admin; $curauth=0;
//$admin_lg=voc($admin,'admin_authes');
//auto_select_category
if($aff)foreach($aff as $k=>$v){
	if(isset($v[$admin])){$_SESSION['set']=$k; $curauth=$v[$admin];}
	foreach($v as $ka=>$va)if($auth>=$va)$raf[]=$ka;}
else $raf=[];
//if($curauth===false)$curauth=7;
//login
$w=lkc('popbt','/home',pictxt('home',$hubname));//asciinb($auth)
if($USE)$w.=lkc('popbt','/admin',pictxt('user',$USE.' '.picto('p'.$auth)).' ('.self::nameofauthes($auth).')');
//fastmenu
$rm=['console','desktop','rstr','params','tags','articles','pictography','css','finder','connectors','Microsql','stats','software','api','twit','plugin','txt','pad','exec','test','members','others'];//,'plug'//,'modules','templates'
$reta.=divc('',$w.$alert); //$tit=lkc('txtit',htac('admin').$admin,$admin_lg).' ';
foreach($rm as $v){$x=$v=='css'?'url':'';//
	if($raf)if(in_array($v,$raf))
		$tit.=lj('txtx','admcnt_admin__'.$x.'_'.ajx($v),pictit(pop::mime($v,'file-config'),$v,22));}
if($admin!='=')$reta.=divc('',$tit);
if($auth>=7 && $admin=='software')$ret=software::home('=','');
if($auth>=$curauth && $curauth){
switch($admin){//global
case('console'):$ret=console::home(); break;
case('desktop'):$ret=admx::desktop($set,'',get('dig')); break;
case('Microsql'):$ret=msqa::home(msqa::murlboot()); break;
case('messages'):
	if($qb==$USE or $auth>=$curauth)$ret=self::messages();
	else $ret=contact(nms(84),'txtcadr'); break;
case('hubs'):$ret=adm_hubs($auth); break;
case('nodes'):$ret=self::nodes(); break;
case('stats'):[$pa,$oa]=explode('/',$set); $ret=stats::home($pa,$oa); break;
case('newsletter'):$ret=self::newsletter(); break;
case('tweetfeed'):$ret=tweetfeed::home(); break;
//case('disk'):$ret=plugin('disk','',''); break;
//case('share'):$ret=plugin('share','',''); break;
case('tickets'):$ret=plugin('tickets','',''); break;
case('faq'):$r=msql::read('system','program_faq','');
	$ret=nl2br(stripslashes(divtable($r,1))); break;}
if($_SESSION['set']=='Articles')$ret=self::articles($admin,get('dig'),get('page'));//articles
switch($admin){//configs
//case('chat'):$ret=art::output_trk(ma::read_idy('microchat','DESC')); break;
case('shop'):$ret=helps('shop_class'); break;//unused
case('book'):$ret=plugin('book'); break;
case('rstr'):$ret=admx::restrictions(); break;
case('params'):$ret=self::params(0); break;
case('avatar'):if($USE)$ret=self::avatar(0); break;
case('mail')://too old
	if(post('amail') && auth(6)){update('qdu','mail',post('amail'),'name',$USE);
		if($USE==$qb)$_SESSION['qbin']['adminmail']=post('amail');}
	$ml=sql('mail','qdu','v','name="'.$USE.'"');
	$valu=input2('amail',$ml,15,'','',50).' '.submit('Submit','modif_mail');
	$ret=form($goto,$valu); break;
case('password'):$ret=self::set_password($USE); break;
case('banner'):$ret=self::set_ban(); break;
case('description'):$ret=self::hubprm($admin); break;
case('google'):$ret=self::hubprm($admin); break;
case('members'):$ret=self::members($auth,$goto); break;
case('authes'):$titles=['fonction','auth'];
	if(auth(6))$ret=msqbt('system','admin_authes').br();
	foreach($aff as $k=>$v){$datas=[]; arsort($v);
		foreach($v as $ka=>$va)$datas[$ka]=[$va];
		if($datas)array_unshift($datas,$titles);
		$out[$k]=tabler($datas,1,1);}
		$ret.=make_tabs($out,'at'); break;
//constructors
case('css'):$ret=self::editcss(); break;
case('fonts'):$ret=self::edit_fonts(); break;
case('connectors'):$ret=self::connectors(); break;
case('templates'):$ret=self::templates(); break;
case('modules'):$ret=self::modules(); break;
case('plugin'):$ret=plugin('index'); break;
case('msql'):$ret=self::msql(); break;
case('dev'):$ret=plugin('dev','',''); break;
case('tags'):$ret=meta::admin_tags(get('set')); break;
case('finder'):$ret=finder::home($qb,'disk'); break;
case('backup'):$ret=self::backup('',''); break;
case('software'):$ret=software::home('=',''); break;
case('update_notes'):$ret=adm_update_notes('',1); break;
case('pictography'):$ret=pictography::home('',''); break;
//case('plug'):$ret=adm_edit_plug(); break;
case('api'):$ret=apicom::home('',1); break;
case('others'):$rm=['nodes','newsletter','banner','dev','backup','htaccess','links','rssurl','mail','password','descrption','icons','authes','avatar','messages'];
	foreach($rm as $v)$ret.=lj('txtx','admcnt_admin___'.$v,pictit(pop::mime($v),$v,22));
	break;}
if($admin && !$ret && $auth>=$curauth){
	if(method_exists($admin,'home'))$ret=$admin::home('','');
	else $ret=plugin($admin,get('p'),get('o'));}
}//end if auth
else switch($admin){case('members'):$ret=self::mbr_become(''); break;}
#render
if(!$nohead)$head=$reta; else $head='';
return $head.divd('admcnt',$ret);}

static function call($d,$va,$opt){geta('admin',$d);
if($d=='all')return self::home();
if($d=='design')$d='css';
if($d=='desktop'){$ret=admx::desktop('','',$va);}
elseif($d=='Microsql')$ret=msqa::home($va?$va:msqa::murlboot());
elseif($d=='editor'){$ret=plugin('editor');}
elseif($d=='action'){$ret=admx::call($va,$opt);}
elseif($d=='css')return '/admin/css';//reload
elseif($d=='css')$ret=self::editcss();
elseif($d=='conn_help')$ret=self::conn_help();
elseif($d=='tags')$ret=meta::admin_tags('');
elseif($d=='description')$ret=self::hubprm('descript');
elseif($d=='software' && auth(7))$ret=software::home('','');
elseif($d=='admin')$ret=self::ifradmin();//!
elseif($d=='plugin')$ret=plugin('index',$opt);
elseif(method_exists('adm',$d))$ret=self::$d($va,$opt);
elseif(method_exists($d,'home'))$ret=$d::home($va,$opt);
else return self::home('nohead');
$admin_lg=voc($d,'admin_authes');
$t=divc('txtit',lk('/admin/'.$d,$admin_lg));
return divd('admcnt',$t.$ret);}
}
?>