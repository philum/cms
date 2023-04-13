<?php //css_builder
class sty{

static function actions($p,$o,$prm){$res=$prm[0]??'';
$bd='design'; $bs='system'; $qb=ses('qb'); $lh=sesmk2('adm','csslang');
$defsb=['div','class','element','color','bkg','border','free'];
$numb=ses('desgn');//desgn
if($numb && $numb!='='){$_SESSION['desgn']=$numb; $_SESSION['clrset']=$numb;
	$_SESSION['clrs'][$numb]=msql_read('design',$qb.'_clrset_'.$numb,'');
	$defs=msql::read_b('design',nod('design_'.ses('desgn')),'','',$defsb);}
$desgn=ses('desgn'); $prmd=ses('prmd');
$clrset=$_SESSION['clrset']=ses('clrset',$prmd);
$nod=$qb.'_design_'.$desgn; $noc=$qb.'_clrset_'.$clrset;
$fcss='css/'.$nod.'.css'; $ftmp='css/'.$qb.'_design_dev_'.$desgn.'.css';
switch($p){
case('new_from'):$tbn=msql::findlast('design',$qb,'design');
	msql::save($bd,$qb.'_design_'.$tbn,$defs);
	msql::copy('design',$noc,'design',$qb.'_clrset_'.$tbn);
	$_SESSION['clrs'][$tbn]=$_SESSION['clrs'][$desgn];
	$_SESSION['desgn']=$_SESSION['clrset']=$tbn;
	$nod=$qb.'_design_'.$tbn; $noc=$qb.'_clrset_'.$tbn;
	msql::modif('','public_design',self::dsnam_arr(self::desname($qb,$desgn)),'one','',$tbn);
	self::build_css('css/'.$qb.'_design_dev_'.$tbn.'.css',$defs); 
	return '/admin/css&design='.$tbn; break;
case('make_public'):if($o)$tbn=$desgn;
	else $tbn=msql::findlast('design','public','design');
	msql::save($bd,'public_design_'.$tbn,$defs);
	msql::copy('design',$noc,'design','public_clrset_'.$tbn);
	msql::modif('','public_design',self::dsnam_arr(self::desname($qb,$desgn)),'one','',$desgn);
	self::build_css('css/public_design_'.$tbn.'.css',$defs);
	alert('created: public_design_'.$tbn); break;
case('make_admin'):self::build_css('css/_admin.css',$defs);
	msql::save($bs,'default_css_3',$defs); 
	alert('modified: system/default_css_3, _admin.css'); break;
case('make_global'):self::build_css('css/_global.css',$defs);
	msql::save($bs,'default_css_1',$defs);
	msql::copy('design',$noc,'system','default_clr_1'); 
	alert('modified: system/default_css_1, _global.css'); break;
case('make_default'):self::build_css('css/_classic.css',$defs);
	msql::save($bs,'default_css_2',$defs);
	msql::copy('design',$noc,'system','default_clr_2');
	$defse=self::empty_design($defs,'clr'); self::build_css('css/_default.css',$defse);
	alert('modified: table system/default_css_2, _classic.css, _default.css (no colors)'); break;
case('reset_clr'):$_SESSION['clrs'][$clrset]=msql_read('system','default_clr_2',''); 
	self::save_clr($noc); break;
case('reset_default'):$defs=self::css_default(); unset($defs['_menus_']);
	msql::save($bd,$nod,$defs); self::build_css($ftmp,$defs); break;
case('reset_global'):$defs=self::css_default(1); unset($defs['_menus_']);
	msql::save($bd,$nod,$defs); self::build_css($ftmp,$defs); break;
case('public_clr'):$_SESSION['clrs'][$clrset]=msql_read('design','public_clrset_'.$o,'');
	self::save_clr($noc); break;
case('public_design'):$defs=msql_read('design','public_design_'.$o,''); unset($defs['_menus_']);
	msql::save($bd,$nod,$defs); self::build_css($ftmp,$defs); break;
case('empty_design'):$defs=self::empty_design($defs,'css');
	msql::save($bd,$nod,$defs); self::build_css($ftmp,$defs); break;
case('null_clr'):$_SESSION['clrs'][$clrset]=['','','','','','','',''];
	self::save_clr($noc); break;
case('null_design'):$defs=self::css_default(); $defs=self::empty_design($defs,'css');
	msql::save($bd,$nod,$defs); self::build_css($ftmp,$defs); break;
case('append'):$defsc=self::css_default(); unset($defsc['_menus_']);
	$defs=self::array_append_css($defs,$defsc); msql::save($bd,$nod,$defs);
	self::build_css($ftmp,$defs); break;
case('append_global'):$defsc=self::css_default(); unset($defsc['_menus_']);
	$defs=self::array_append_css($defs,$defsc); msql::save($bd,$nod,$defs);
	self::build_css($ftmp,$defs); break;
case('inject_global'):$defsc=self::css_default(); unset($defsc['_menus_']);
	$defs=self::append_design($defs,$defsc); msql::save($bd,$nod,$defs);
	self::build_css($ftmp,$defs); break;
case('reset_this'):$defsc=self::css_default(); $ecb=self::find_value($defsc,$defs[$o]);
	if($ecb){$defs[$o]=$defsc[$ecb]; msql::save($bd,$nod,$defs);
	self::build_css($ftmp,$defs);} break;
case('open_design'):$_SESSION['desgn']=$o; $_SESSION['clrset']=$o;
	return '/admin/css&design='.$o; break;
case('herit_design'):[$qbb,$nbd]=explode('_',$o);
	$defs=msql::read_b('design',$qbb.'_design_'.$nbd,'','',$defsb);
	msql::save($bd,$nod,$defs); self::build_css($ftmp,$defs); break;
case('herit_clrset'):[$qbb,$nbd]=explode('_',$o);
	$_SESSION['clrs'][$clrset]=msql_read('design',$qbb.'_clrset_'.$nbd,'');;
	self::save_clr($noc); self::build_css($ftmp,$defs); break;
case('addff'):$defs=self::defs_adder_ff($defs,$o);
	msql::save($bd,$nod,$defs); self::build_css($ftmp,$defs); break;
case('save_img'):$defs=self::img_adder($defs); msql::save($bd,$nod,$defs);
	self::build_css($ftmp,$defs); break;
case('invert_clr'):$_SESSION['clrs'][$clrset]=self::invert_defsclr();
	self::save_clr($noc); self::build_css($ftmp,$defs); break;
case('erase'):$defs=self::save_css_j_del($defs,$o); 
	msql::save($bd,$nod,$defs); break;
case('newfrom'):$defs=self::save_css_newfrom($defs,$o);
	msql::save($bd,$nod,$defs); break;
case('atpos'):$n=count($defs); $defs=self::save_css_displace($defs,$res,$o);
	if(count($defs)==$n)msql::save($bd,$nod,$defs); break;
case('save'):msql::save($bd,$nod,$defs); //if(rstr(63))
	self::build_css($ftmp,$defs); self::build_css($fcss,$defs); self::build_css($fcss,$defs,1); break;
case('backup'):msql::save($bd,$nod.'_sav',$defs,1); self::save_clr($noc.'_sav'); break;
case('apply'):msql::save($bd,$nod,$defs); self::save_clr($noc);
	self::build_css($fcss,$defs); self::informe_config_design(); break;
case('test_design'):$_SESSION['prmd']=ses('desgn'); break;
case('restore_design'):$defs=msql::read_b('design',$nod.'_sav','',1,$defsb);
	msql::save($bd,$nod,$defs); self::build_css($ftmp,$defs); break;
case('restore_clrset'):$r=msql::read_b('design',$noc.'_sav'); $clrst[0]='';
	if($r)foreach($r as $k=>$v)$clrst[]=$v[0]; $_SESSION['clrs'][$desgn]=$clrst; self::save_clr($noc); 
	self::build_css($ftmp,$defs); break;
case('exit_design'):sesz('desgn'); $_SESSION['clrset']=''; ses::$adm['design']='';
	boot::define_mods(); boot::define_condition(); boot::define_clr(); return '/admin'; break;
case('displaycss'):return nl2br(read_file($fcss)); break;
case('displaycsstmp'):return nl2br(read_file($ftmp)); break;}
return btn('txtyl',$p.': ok');}

static function exitbt(){
ses::$adm['design']=lj('popbt','socket_sty,actions__url_exit*design','design:'.ses('desgn'));}

//cssactbt('atpos','ok','self',$k,'','sdx'.$k);
static function cssactbt($p,$t,$x='',$o='',$tt='',$id=''){if($tt)$tt='" title="'.$tt;
if($p=='exit_design')$c='popsav'; elseif($p=='save')$c='popsav';
elseif($p=='erase')$c='txtyl'; else $c='txtx';
if($x=='self' or $x=='url')$tg='socket';
else{$tg='popup'; if($p!='displaycss' && $p!='displaycsstmp')$x='xx';}
return lj($c.$tt,$tg.'_sty,actions_'.$id.'_'.$x.'_'.ajx($p).'_'.ajx($o),$t);}

static function home($on=''){self::clrpckr_js();//if($on)
$qb=ses('qb'); $lh=sesmk2('adm','csslang'); $defs='';
$defsb=['div','class','element','color','bkg','border','free'];
$numb=sesif('desgn',$_SESSION['prmd']);
//$numb=get('desgn');
if($numb && $numb!='='){$_SESSION['desgn']=$numb;
	$_SESSION['clrset']=$numb; $_SESSION['prmd']=$numb;
	$_SESSION['clrs'][$numb]=msql_read('design',$qb.'_clrset_'.$numb,'');
	$defs=msql::read_b('design',$qb.'_design_'.$numb,'','',$defsb);}
$prmd=$_SESSION['prmd']; $desgn=$_SESSION['desgn']; //if(strpos($desgn,'_neg'))$desgn=substr($desgn,0,-4);
$clrset=sesif('clrset',$prmd);
$nod=$qb.'_design_'.$desgn;
$noc=$qb.'_clrset_'.$clrset;
$fcss='css/'.$nod.'.css';
$ftmp='css/'.$qb.'_design_dev_'.$prmd.'.css';
#load
if(!$defs)$defs=msql::read_b('design',$nod,'',1,$defsb);//good_nb
unset($defs[0]); $defs=self::reorder_keys($defs);
if(!is_file($ftmp))self::build_css($ftmp,$defs);
#body
$ret=lkc('txtcadr','/admin/css',$nod).' ';
$ret.=self::dsnamedt($qb,$desgn,[]);
$ret.=hlpbt('design').' ';
$ret.=msqbt('design',$qb.'_design_'.$desgn).' ';
$ret.=self::cssactbt('exit_design',pictxt('logout',nms(112)),'url','','');//'','','');
if(prmb(5))$ret.=picto('alert').helps('prmb5').' ';
$ret.=hlpbt('designcond');
$ret.=br();
$ret.=lj('txtbox','popup_sty,chargesets','design:'.$desgn.'/clrset:'.$clrset).' ';
$ret.=self::cssactbt('backup','backup','self','','');//'','',''
if(is_file(msql::url('design',$nod))){
	$ret.=self::cssactbt('restore_design',nms(95).' design','self','');
	$ret.=self::cssactbt('restore_clrset',nms(95).' clr','self','');}
if($_SESSION['prmd']!=$_SESSION['desgn'])
	$ret.=self::cssactbt('test_design','test design '.$desgn,'self','');
if($_SESSION['desgn']!=$_SESSION['prma']['design'])
	$ret.=self::cssactbt('apply',nms(66).' (mods:'.prmb(1).'-'.$_SESSION['prma']['design'].')','self','sav');
$ret.=self::cssactbt('save',nms(27),'','','');
//$ret.=self::cssactbt('build_css',nms(93),'','');//rebuild
$ret.=br();
$ret.=self::cssactbt('new_from',nms(44),'url','');//url
$ret.=self::cssactbt('empty_design',nms(46),'self','');
$ret.=self::cssactbt('invert_clr',nms(115),'self','');
$ret.=self::cssactbt('make_public',$lh[4],'','');//make_public
$ret.=self::cssactbt('make_public',$lh[5],'','1');//inform_public
if($_SESSION['auth']>5){$r=msql::row('',$qb.'_design',$desgn); 
	$desgname=!empty($r[0])?$r[0]:val($r,'name');
	if($desgname=='admin')$make='make_admin';
	elseif($desgname=='global')$make='make_global';
	else $make='make_default';
	$ret.=self::cssactbt($make,$make,'','','');}
$ret.=br();
$ret.=self::cssactbt('reset_default',nms(96).' design','self','');
$ret.=self::cssactbt('reset_clr',nms(96).' clr','self','');
$ret.=self::cssactbt('reset_global','global design','self','');
$ret.=self::cssactbt('public_clr','global clr','self','1');
$ret.=self::cssactbt('public_design','classic design','self','2');
$ret.=self::cssactbt('public_clr','classic clr','self','2');
$ret.=self::cssactbt('null_design','null','self','');
$ret.=self::cssactbt('null_clr','clr','self','2');
$ret.=lj('txtx','popup_fontface___1','@font-face');
$ret.=br();
$ret.=self::cssactbt('append',nms(92).' defaults','self','');
$ret.=self::cssactbt('append_global',nms(92).' global','self','');
$ret.=self::cssactbt('inject_global',$lh[9],'self','');
$ret.=self::cssactbt('displaycss',$lh[10],'3','');
$ret.=self::cssactbt('displaycsstmp',$lh[11],'3','');
$ret.=lj('txtx','popup_sty,chargeclr','clrset').' ';
$ret.=btn('txtx',count($defs).' '.nms(117)).' ';
$ret.=btn('txtx',mkday(filemtime(msql::url('design',$nod)))).' ';
$ret.=br().br();
$ret.=self::clrset_edit().br();//colors
if($defs)$ret.=self::design_edit($defs,$defsb,'',1).br().br();
return $ret;}

#builders
static function css_default($o=''){$o=$o?$o:'2';
return msql_read('system','default_css_'.$o,'');}

static function save_clr($nod){$r=$_SESSION['clrs'][$_SESSION['clrset']]; 
if($r)foreach($r as $k=>$v)if($v)$rb[$k]=[$v]; $rb[]=[];
if($rb)msql::save('design',$nod,$rb); return $rb;}

static function reorder_keys($r){$i=0; $ret=[];
if($r)foreach($r as $k=>$v){if($k!='_menus_'){$i++; $k=$i;} $ret[$k]=$v;}
return $ret;}

//append
static function array_pop_b($r,$va,$n){$i=0;
foreach($r as $k=>$v){$i++; $ret[$i]=$v; if($k==$n){$i++; $ret[$i]=$va;}}
return $ret;}

static function array_append_css($a,$b){
	foreach($b as $k=>$v){$n='';
	$ka=trim($v[0]).trim($v[1]).trim($v[2]);
		foreach($a as $kb=>$vb){
		$kba=trim($vb[0]).trim($vb[1]).trim($vb[2]);
		if($kba==$ka)$n=$kb;}
	if(!$n)$a=self::array_pop_b($a,$v,$k);}
return $a;}

//inject
static function app_des_free($da,$db){$ret='';
$a=explode(';',str_replace(['; ',";\n","\n"],[';',';',''],$da)); 
$b=explode(';',str_replace(['; ',";\n","\n"],[';',';',''],$db)); 
if($b)foreach($b as $k=>$v){if($a)$in=in_array($v,$a); 
	if(trim($v) && (($a && !$in) or !$a))$a[]=trim($v);}
if($a){$n=count($a); for($i=0;$i<$n;$i++)if($a[$i])$ret.=$a[$i].'; ';
return $ret;}}

static function append_design($a,$b){
foreach($a as $k=>$v){$va=trim($v[0].$v[1].$v[2]); $vrf[$va]=$k;}
foreach($b as $k=>$v){$va=trim($v[0].$v[1].$v[2]); $kb=$vrf[$va];
	if($kb)$a[$k][6]=self::app_des_free($a[$k][6],$v[6]);
	else $a[]=$v;}
return $a;}

static function empty_design($r,$p){
foreach($r as $k=>$v){
	[$v0,$v1,$v2,$v3,$v4,$v5,$v6]=arr($v,7);
	if($p=='all')$r[$k]=[$v0,$v1,$v2,'||','||','||',''];
	elseif($p=='clr')$r[$k]=[$v0,$v1,$v2,'||','||','||',$v6];
	elseif($p=='css')$r[$k][6]='';}
return $r;}

static function invert_defsclr(){$r=getclrs();
foreach($r as $k=>$v)if($v)$r[$k]=invert_color($v,0);
return $r;}

#rename
static function desname($qb,$desgn){
return msql::val('users',$qb.'_design',$desgn);}
static function dsnam_arr($res){$md=prmb(1);
return [$res,array_part($_SERVER['HTTP_HOST'],'.',0),date('ymdHi',time()),$md];}
static function dsnamedt($qb,$desgn,$prm=[]){$res=$prm[0]??'';
$nd=$qb.'_'.$desgn; $ret=self::desname($qb,$desgn);
if($res=='init')return self::dsnmform('rnt',$nd,'',$ret?$ret:'table_name');
$defb=['_menus_'=>['name','site','last-update','mods']];
$r=self::dsnam_arr($res);
if($res && $res!='init'){
	msql::modif('',$qb.'_design',$r,'one',$defb,$desgn);
	return self::dsnmform('rnt',$nd,$res,'');}
return self::dsnmform('rnt',$nd,$ret,'');}

static function dsnmform($id,$nd,$p,$v){ $ret='';
if(!$p){static $i; $i++; $ret.=input('inp'.$i,$v).' ';
$ret.=lj('txtbox',$id.'_sty,dsnamedt_inp'.$i.'__'.$nd,'ok');}
else $ret=lj('txtblc',$id.'_sty,dsnamedt_zero__'.$nd,$p);
return hidden('zero','init').btd($id,$ret);}

#select_design
static function clrset_view($d){
$r=msql_read('design',$d,''); $ret='';
if(is_array($r))foreach($r as $k=>$v){
if($k>0){$sty='"style="color:#'.invert_color($v,1).'; background-color:#'.$v.'; ';
if(!$v)$v='none'; $ret.=btn($sty,'__').' ';}}
return $ret;}

static function chargesets(){$qb=$_SESSION['qb'];
$r=explore('msql/design/','files',1); asort($r);
if($r){foreach($r as $k=>$v){$v=substr($v,0,-4); [$nd,$dr,$nb,$sv]=opt($v,'_',4);
	if($sv!='sav' && $nd && is_numeric($nb) && ($nd==$qb or ($nd=='public' or $_SESSION['auth']>6)))
		$rb[$nd][$nb][$dr]=$nb;}
$tab[]=['open','herit','colors']; 
if($rb)foreach($rb as $k=>$v){
	if(is_array($v)){$taba=[]; $tabb=[];
	$ra=msql_read('users',$k.'_design','');
	foreach($v as $nb=>$bs){
		$ds=val($bs,'design'); $cl=val($bs,'clrset');
		$na=isset($ra[$nb][0])?$ra[$nb][0]:$ds;//name
		if($k==$qb)$tabt[$nb]=self::cssactbt('open_design',$na,'url',$ds);
		else $tabt[$nb]=$nb;
		if($ds)$taba[$nb]=self::cssactbt('herit_design',$nb,'self',$k.'_'.$ds);
		if($cl){$bt=self::clrset_view($k.'_clrset_'.$cl);
			$tabb[$nb]=self::cssactbt('herit_clrset',$bt,'self',$k.'_'.$ds);}}
	if($taba)$nbd=count($taba); if($tabb)$nbc=count($tabb);
	$tab[]=[btn('txtcadr',$k),'','']; $nb=count($taba);
	for($i=0;$i<=$nb;$i++){$tab[]=[val($tabt,$i),val($taba,$i),val($tabb,$i)];}}}}
return scroll($tab,tabler($tab),20,320,320);}//txtblc//txtx

static function clrset_edit(){$ret='';
$ndc=$_SESSION['clrset']?$_SESSION['clrset']:$_SESSION['prmd'];
$clr=msql_read('design',nod('clrset_'.$ndc),''); $nb=count($clr);
$clrn=['','bkg','border','bloc','identity','active','art_bkg','art_txt','txt'];
for($i=1;$i<=$nb;$i++){$name=$i.(isset($clrn[$i])?':'.$clrn[$i]:'');
$ret.=div(atc('clrp').atd('colorpick'.$i).ats('color:#'.invert_color($clr[$i],1)),divs('background-color: #'.$clr[$i].';',$name.input('colorpickerField'.$i,$clr[$i],5)));}
return $ret.br().ljb('txtbox','SaveClr',$nb,nms(27)).divd('clrreponse','');}

#editor
static function name_classe($p){$ret='';
[$p0,$p1,$p2]=arr($p,3);
if($p0)$ret.='#'.$p0.' ';
if($p1)$ret.='.'.$p1.' ';
if($p2)$ret.=$p2.' ';
return $ret;}

static function petit_clr($t,$clr){
if(!$t)$t=0; $a=explode('|',$t); $ret='';
foreach($a as $v){if(!$v)$v='-'; $c=isset($clr[$v])?$clr[$v]:'';
	$ret.=btn('" style="background:#'.$c.'; color:#'.invert_color($c,1).'; padding:0; float:left; width:8px;',$v);}
return $ret;}

static function name_line_j($k,$p,$op,$clrb=''){
$csa='txtnoir'; $t=self::name_classe($p);
$css=get('edit_css')==$k?' active':'';
if($clrb==1)$clr=msql_read('system','default_clr_1','');
elseif($clrb==2)$clr=msql_read('system','default_clr_2','');
else $clr=getclrs();
$s='float:left; text-align:left; margin:1px; width:';
if($k)$ret=toggle($csa.$css,'css'.$k.'_sty,editcss___'.$k,$t,'',ats($s.'190px;'));
else $ret=span(atc($csa).ats($s.'190px;'),$t);
for($i=3;$i<6;$i++)$ret.=span(atc($csa).ats($s.'50px;'),self::petit_clr($p[$i]??'-',$clr));
if($op){$pb=isset($p[6])?etc(str_replace('; ',';'.br(),stripslashes($p[6])),1000):'-';
$ret.=span(atc($csa).ats($s.'250px;'),$pb);}
return divc('clear',$ret);}

static function design_edit($r,$defsb,$edit,$op){
$ret=self::name_line_j(0,$defsb,$op).br();//keys
$ra=['divs'=>$ret,'classes'=>$ret,'elements'=>$ret];
if($r){foreach($r as $k=>$v){$ret='<a name="'.$k.'"></a>';
	if($k){$ret.=self::name_line_j($k,$v,$op).br();//if(!$edit) 
	if($edit==$k)$t=self::form_facilities($r,$edit); else $t='';}
$ret.=divd('css'.$k,$t);
if($v[0])$ra['divs'].=$ret; elseif($v[1])$ra['classes'].=$ret; 
elseif($v[2])$ra['elements'].=$ret;}}
return divs('min-width:440px',tabs($ra,'css'.$edit));}

static function saveclr($p){$qb=ses('qb'); $tosave=$p[0];
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
$ndc=$_SESSION['clrset']?$_SESSION['clrset']:$_SESSION['prmd'];
$nod=$qb.'_design_'.$ndd; $f_c=$qb.'_clrset_'.$ndc;
if(!$_SESSION['desgn'])$f_css_temp='css/'.$qb.'_design_'.$ndd.'.css';
else $f_css_temp='css/'.$qb.'_design_dev_'.$ndd.'.css';
$defs=msql::read_b('design',$nod,'',1);
$tosave=str_replace('/','_',$tosave);
if(substr($tosave,-1)=='_')$tosave=substr($tosave,0,-1);
setclrs(opt($tosave,'_',9));
if($_SESSION["auth"]>=6)self::save_clr($f_c);
self::build_css($f_css_temp,$defs);
return btn('popdel','saved');}

#ajax
static function clrpckr_layout(){$var='';
$rc=getclrs(); $nb=$rc?count($rc):7;
for($i=1;$i<=$nb;$i++)$var.='$("#colorpickerField'.$i.'").ColorPicker({
onSubmit: function(hsb,hex,rgb,el){$(el).val(hex); $(el).ColorPickerHide();
$("#colorpick'.$i.' div").css("backgroundColor","#"+hex); SaveClr(10);},
onBeforeShow: function(){ $(this).ColorPickerSetColor(this.value);},
onShow: function(colpkr){ $(colpkr).fadeIn(200); return false;},
onHide: function(colpkr){ $(colpkr).fadeOut(200); return false;}})';
$ret='(function($){var initLayout=function(){'.$var.'}; EYE.register(initLayout,"init");})(jQuery)';
$ret.='
function SaveClr(nb){var clrs="/"; for(i=1;i<=nb;i++){
var va=document.getElementById("colorpickerField"+i).value; clrs+=va+"/";}
bjcall("clrreponse|sty,saveclr||"+clrs);
var x=setTimeout("Close(\"clrreponse\")",3000);}';
return $ret;}

static function clrpckr_js(){$jsp='/js/colorpicker/';
Head::add('jslink',$jsp.'js/jquery.js');
Head::add('jslink',$jsp.'js/colorpicker.js');
Head::add('jslink',$jsp.'js/eye.js');
Head::add('csslink',$jsp.'css/colorpicker.css');
Head::add('csslink',$jsp.'css/layout.css');
Head::add('jscode',self::clrpckr_layout());}

//see_css
static function editcss($d){$qb=ses('qb'); $prmd=ses('prmd'); $nod=$qb.'_design_'.sesb('desgn',$prmd);
$r=msql::read_b('design',$nod); return self::form_facilities($r,$d);}
static function chargeclr(){$qb=ses('qb'); $prmd=ses('prmd'); $ndc=$qb.'_clrset_'.sesb('clrset',$prmd);
$r=msql::read_b('design',$ndc); return tabler($r,'txtblc','txtx');}

static function save_css_j_del($r,$n){//vrf n
foreach($r as $k=>$v)if($k!=$n)$ret[]=$v;//$k
return $ret;}

static function save_css_newfrom($r,$n){$i=0;
foreach($r as $k=>$v){$i++;
	if($k==$n){$ret[$i]=$v; $i++; $ret[$i]=$v;}
	else $ret[$i]=$v;}
return $ret;}

static function save_css_displace($r,$p,$n){
$ra=$r[$n]; unset($r[$n]); $i=0;
foreach($r as $k=>$v){$i++;
	if($k==$p){$ret[$i]=$v; $i++; $ret[$i]=$ra;}
	elseif($v)$ret[$i]=$v;}
return $ret;}

static function save_css_clname($defs,$k,$r){
$defs[$k][0]=$r[0]; $defs[$k][1]=$r[1]; $defs[$k][2]=$r[2];
if(is_numeric($k))return $defs;}

static function save_css_clr($defs,$k,$r){
	$defs[$k][3]=$r[0].'|'.$r[1].'|'.$r[2];
	$defs[$k][4]=$r[3].'|'.$r[4].'|'.$r[5];
	$defs[$k][5]=$r[6].'|'.$r[7].'|'.$r[8];
return $defs;}

static function save_css_tst($r,$k,$va){
$va=self::affect_rgba($va,getclrs()); $ret=divc('console',$va);
$ret.=divb($va,$r[1],$r[0]).divc('clear','');
return $ret;}

static function savcss($k,$c,$prm=[]){//facil_css//stylsav
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
$bd='design'; $nod=nod('design_'.$ndd); $v=$prm[0];
if($_SESSION['desgn'])$nodb=$_SESSION['qb'].'_design_dev_'.$ndd; else $nodb=$nod;
$defs=msql::read_b('design',$nod);
if($c==1)$defs=self::save_css_clr($defs,$k,$prm);//clr
elseif($c==2)$defs=self::save_css_bkg($defs,$k,$v);//img
elseif($c==3)$defs=self::save_css_clname($defs,$k,$prm);//classname
elseif($c==4)return self::save_css_tst($defs[$k],$k,$v);//tst
//elseif($c=='x')$defs=self::save_css_j_del($defs,$k);//del
else $defs=self::save_css($defs,$k,$v);//css
if($defs){msql::save($bd,$nod,$defs); self::build_css('css/'.$nodb.'.css',$defs);}
return self::form_facilities($defs,$k);}

static function save_css_bkg($defs,$k,$v){$val=$defs[$k][6];
$css='background-image:url(/'.$v.'); ';
if(strpos($val,'background:url')!==false){
$defs=self::modif_css($defs,$k,'background:url',';',$css);}
else{$defs=self::modif_css($defs,$k,'background-image:',';',$css);}
return $defs;}

#font-face
static function css_ff($v){$f='/fonts/'.$v;//$f=fonts_link($v);
$ret="font-family: '".str_replace('-webfont','',$v)."'; src: url('".$f.".woff') format('woff'), url('".$f.".svg#".$v."') format('svg');";//src: url("'.$f.'.eot");, url("'.$src.'.ttf") format("truetype")
return $ret;}

static function valid_formats($va){$f='fonts/'.$va; $r=['.woff'=>'Firefox/Chrome','.eot'=>'IE','.svg'=>'Safari/mobiles','.ttf'=>'browsers']; $ret='';
foreach($r as $k=>$v){if(is_file($f.$k))$ret.=btn('txtsmall" title="'.$v,$k).' ';}
return $ret;}

static function ffeditprw($k,$c,$p,$prm=''){$fb=$prm[0]??'';
if($k)$r=msql::row('server','edition_typos',$k,1);
if($c=='acc' && $p)$r['accents']=($p=='no'?1:'');
if($c=='fav' && $p)$r['fav']=($p=='no'?1:'');
if($c=='cat' && $fb && $fb!='-'){$r['category']=$fb;
	if(!$_SESSION['fntcat'][$fb])$_SESSION['fntcat'][$fb]=1;}
if($k && $_SESSION['auth']>5)msql::modif('server','edition_typos',$r,$k);
foreach($r as $ka=>$v){$rb[]=$v;}
return self::preview_ff_p($k,$rb,'',$p);}

static function ffeditcall($k,$c,$prm){
return self::ffeditprw($k,$c,'',$prm);}

static function font_source($v){
if($v==1)return lkt('txtsmall2','http://fontsquirrel.com/fontface','fontsquirrel').' ';
if($v==2)return lkt('txtsmall2','http://fontspring.com/fontface','fontspring').' ';
if($v==3)return lkt('txtsmall2','http://new.myfonts.com/','myfonts').' ';}

static function font_set_cat($k,$v){
$ret=br(); $ml['-']=1; if($_SESSION['fntcat'])$ml+=$_SESSION['fntcat'];
$ret.=select(['style'=>'width:80px;','onchange'=>atjr('jumpslct',['fntcat'.$k,'\'+this+\''])],$ml,'kk');
$ret.=input('fntcat'.$k,$v,'8',['nme'=>'fntcat']);
$ret.=lj('popsav','fnt'.$k.'_sty,ffeditcall_fntcat'.$k.'__'.$k.'_cat','ok').' ';
return $ret;}

static function preview_ff_p($k,$v){$go='fnt'.$k.'_sty,ffeditprw___'.$k; $sz='';
$f='fonts/'.$v[0].'.woff'; if(is_file($f))$sz=round(filesize($f)/1000);
$ret=$v[0].' '.self::cssactbt('addff',pictxt('add','Add'),'self',$v[0],'').' '.$sz.'Ko ';
//lkc('txtbox','/?admin=css&addff='.$v[0],pictxt('add','Add'));
$acc=($v[2]?'yes':'no'); $fav=($v[3]?'ok':'no');
$ret.=lj($v[2]?'txtred':'txtx',$go.'_acc_'.$acc,'accents: '.$acc).' ';
$ret.=lj($v[3]?'txtred':'txtx',$go.'_fav_'.$fav,'fav').' ';
$ret.=self::valid_formats($v[0]);
$ret.=self::font_source($v[4]);
$ret.=lj('txtx','popup_fontface__x_1_'.$v[1],$v[1]).' ';
if($_SESSION['auth']>5)$ret.=self::font_set_cat($k,$v[1]);
return $ret;}

static function preview_ff($k,$v,$c){
$nm=str_replace('-webfont','',$v[0]); 
$str=ses('ffstr','AaBbCcDdEe0123יא;!');
//$seeall=lj('txtx','pop_stylsall___','set');
$opt=div(atd('fnt'.$k),self::preview_ff_p($k,$v)).br().br();
return divs('font-family:'.$nm.'; font-size:'.$c.'px; line-height:'.round($c*1.2).'px;',$str).br().$opt;}

static function fontface($p,$b,$c,$o,$s=''){//page,cat,size,opt
$csa='txtx'; $csb='txtred'; if(!$b)$b='all'; $mnu='';
$r=msql_read('server','edition_typos','',1); $n=count($r); asort($r);
$rb['all']=1; $b=$b==''?'unclassed':$b;
if($s)$o='rch'.$s; $ret='';
if(!is_file('msql/server/edition_typos.php'))$ret.=lkc('txtyl','?admin=fonts','update server_table').br().br();
//rb//rd
$ard=['','fontsquirrel','fontspring','myfonts'];
if($r)foreach($r as $k=>$v){if($v[1])$rb[$v[1]]=1; 
	if(is_numeric($v[4]))$rd[$v[4]]=$ard[$v[4]];} // else $rd[$v[4]]=$v[4];
$rb['unclassed']=1; ksort($rb); $_SESSION['fntcat']=$rb;
//cat
if($b && $b!='unclassed' && $b!='all')$hlp=divc('panel',helps($b,'typos')).br(); else $hlp='';
foreach($rb as $k=>$v){
$mnu.=lj(($k==$b?$csb:$csa),'popup_fontface__x_1_'.ajx($k).'_'.$c.'_'.$o,$k).' ';}
$mnu.=br(); $b=$b=='unclassed'?'':$b;
$pk=substr($o,0,3); $pv=substr($o,3); if($pv)$pp[$pk]=$pv; else $pp=[];
//rech
$srch=input('srchfnt',$pp['rch']??'',8,'search');
$srch.=' '.bj('popbt','popup|sty,ffcall|x|1,'.$b.','.$c.','.$o.'|srchfnt','ok').' ';
$srch.=lj('popbt','popup_fontface__x_1_all','x');
//tri
$rc=[]; foreach($r as $k=>$v){
if(!$pv or (($pp['acc'] && $pp['acc']==$v[2]) or ($pp['fav'] && $pp['fav']==$v[3]) or ($pp['fam'] && $pp['fam']==$v[4]) or ($pp['rch'] && stristr($v[0],$pp['rch'])!==false))){
	if($v[1]==$b or $b=='all')$rc[$k]=$v;}}
$n=count($rc);
//pages
$no=20; $np=10; $min=$p-$np; $max=$p+$np; $nb=ceil($n/$no); 
$bb=ajx($b); $rtp='';
for($i=1;$i<=$nb;$i++){
	if($i==1 or $i==$nb or ($i>$min && $i<$max))
		$rtp.=lj(active($i,$p),'popup_fontface__x_'.$i.'_'.$bb.'_'.$c.'_'.$o,$i).' ';
	if(($i==2 && $min>2) or ($i==$nb-1 && $max<$nb-1))$rtp.='... ';}
$nbp=divc('nbp',$rtp); $c=(is_numeric($c)?$cb=$c:48);
$arz=[12,24,36,48,72]; $siz='';
foreach($arz as $k=>$v){//size
$siz.=lj(($v==$c?$csb:$csa),'popup_fontface__x_'.$p.'_'.$b.'_'.$v.'_'.$o,$v).' ';}
//label
$go='popup_fontface__x_'.$p.'_'.$bb.'_'; $prp='';
if(isset($rd))foreach($rd as $k=>$v){
$prp.=lj(($pp['fam']==$k?$csb:$csa),$go.'_fam'.($pp['fam']==$k?'':$k),$v).' ';}
$prp.=lj((isset($pp['acc'])?$csb:$csa),$go.'_acc'.(isset($pp['acc'])?'':1),'accents').' ';
$prp.=lj((isset($pp['fav'])?$csb:$csa),$go.'_fav'.(isset($pp['fav'])?'':1),'favs').' ';
//render
$max=$p*$no; $min=$max-$no; $ia=0; $rta=''; $rtb='';
if($rc)foreach($rc as $k=>$v){$ia++; if($ia>=$min && $ia<$max && $v[0]){
	$rta.='@font-face {'.self::css_ff($v[0]).'}'."\n"; $rtb.=preview_ff($k,$v,$c);}}
$ret.=csscode($rta).$mnu.$hlp.$siz.$prp.$srch.br().br();
$ret.=input('ffwr',$_SESSION['ffstr']??'AaBbCcDdEe0123יא','44');
$ret.=lj('txtx','ffwr_sesmake_ffwr__ffstr','set');
$ret.=divd('scroll',divd('pop',$nbp.br().$rtb.$nbp)).br();
//return csscode($rta).$nbp.br().$rtb.$nbp;
return $ret;}

static function ffcall($g,$prm=[]){[$p,$b,$c,$o]=arr($g,4); $s=$prm[0]??'';
return self::fontface($p,$b,$c,$o,$s);}

static function defs_adder_ff($r,$o){$i=0;
$ra=['','','@font-face','','','',self::css_ff($o)];
foreach($r as $k=>$v){$i++;
	if($i==1){$ret[$i]=$ra; $i++;}
	$ret[$i]=$v;}
return $ret;}

#facilities

//inform_config
static function find_value($defs,$css){//array div/css/elem
if(substr($css[0],0,1)=="#")$css[0]=substr($css[0],1);
if(substr($css[1],0,1)==".")$css[1]=substr($css[1],1);
if($defs)foreach($defs as $k=>$v)//find
	if($v[0]==$css[0] && $v[1]==$css[1] && $v[2]==$css[2])return $k;}

static function informe_config_design(){
$cnd=$_SESSION['cond']; $cndb=$cnd[1]?$cnd[1]:$cnd[0]; $r=boot::context_mods('system');
foreach($r as $k=>$v)if($v[0]=='design'){
	$v[1]=$_SESSION['desgn']; $_SESSION['prma'][$v[0]]=$v[1]; $_SESSION['prmd']=$v[1];
	if($k=='push')$_SESSION['mods']['system'][]=$v; else $_SESSION['mods']['system'][$k]=$v;
	array_unshift($v,'system');
	msql::modif('',$_SESSION['modsnod'],$v,$k);}}

#facilities	
static function facil_images($k,$url,$val){
$ret=btn('txtx',toggle('','bkg'.$k.'_dsnav,home_bkg_'.$k,'backgrounds')).' ';
if(strpos($val,':url(/')!==false)$ret.=lkc('txtred',$url.'&save_img='.$k.'&erase_img==','delete_background');
$ret.=btd('bkg'.$k,''); $t_ims='';
$mnu_bkg=['','no-repeat','repeat-x','repeat-y','repeat'];
$mnu_im_align=['','left','right','center'];
$mnu_im_valign=['','top','bottom','center'];
if(strpos($val,'background:url')!==false)$t_ims=between($val,'background:url',';','');
[$urb,$reap,$fixd,$alg,$vlg]=opt($t_ims,' ',5);
if($fixd){$chk=' checked';}
if($urb){$urb=substr($urb,1,-1); $ret.=lkt('txtx',$urb,'open').br();}
$ret.=upload_j('upl','css',$k).' ';
return $ret;}

static function facil_names($defs,$k){
$sty='" size="20'; $ids='cl1'.$k.',cl2'.$k.',cl3'.$k;
$ret=btn('txtsmall2','div:').input('cl1'.$k.$sty,$defs[$k][0]).br();
$ret.=btn('txtsmall2','class:').input('cl2'.$k.$sty,$defs[$k][1]).br();
$ret.=btn('txtsmall2','element:').input('cl3'.$k.$sty,$defs[$k][2]).' ';
$ret.=lj('popbt','css'.$k.'_sty,savcss_'.$ids.'__'.$k.'_3',nms(66)).br().br();
return $ret;}

static function mnu_line_t($clr,$t,$o=''){
$cb=$clr?invert_color($clr,1):'';
$s=$o?'border:1px solid gray; ':'';
return divs($s.'padding:2px 4px; color:#'.$cb.'; background-color:#'.$clr,$t);}

static function selectclr($p,$n){//stylclr
$r=getclrs(); $n=$r?count($r):0; $ret='';
for($i=0;$i<=$n;$i++){$ri=val($r,$i); $t=self::mnu_line_t($ri,$i);
	$ret.=lj('','bt'.$p.'_sty,setclr___'.$ri.'_'.$i.'_'.$p,$t);}
return $ret;}

static function setclr($clr,$n,$p){
$h=hidden($p,$n); $t=self::mnu_line_t($clr,$n);
return togbub('sty,selectclr',$p.'_'.$n,$t).$h;}

static function mnu_line_color($d,$p){$r=explode('|',$d);//txt|link|hover/a.c.hover
$kr=getclrs(); $n=$kr?count($kr):0; $ret='';//pr($r);
for($i=0;$i<=3;$i++){$ri=val($r,$i);
	$clrn=$ri=='undefined'||!$ri?'0':$ri; $nid=$i+1;
	$kl=isset($kr[$clrn])?$kr[$clrn]:'';
	$ret.=span(atc('cell').atd('bt'.$p.$nid),self::setclr($kl,$clrn,$p.$nid));}
return $ret;}

static function facil_colors($defs,$k,$url){
$t=divc('row',btn('cell','').btn('cell','text').btn('cell','a').btn('cell','hover').btn('cell','a:hover'));
$t.=divc('row',btn('cell','color').self::mnu_line_color($defs[$k][3],'clr'.$k));
$t.=divc('row',btn('cell','backg').self::mnu_line_color($defs[$k][4],'bkg'.$k));
$t.=divc('row',btn('cell','border').self::mnu_line_color($defs[$k][5],'bdr'.$k));
$ret=divc('table',$t); $rt=[];
foreach(['clr','bkg','bdr'] as $va)$rt[]=$va.$k.'1,'.$va.$k.'2,'.$va.$k.'3';
$ret.=lj('popbt','css'.$k.'_sty,savcss_'.implode(',',$rt).'__'.$k.'_1',nms(66)).br();
return $ret;}

static function facil_css($k,$url,$v){//render
$v=str_replace('} ','}'."\n",$v);//{{
$v=str_replace('; ',';',$v);
$v=str_replace(';',';'."\n",$v);
$t=self::form_edit_css($k);
$t.=textarea('cssarea'.$k,$v,60,10,['class'=>'console']).' ';
return form($url.'#'.$k,$t);}

static function facil_globalc($k,$nc){$r=self::css_default(1);
$ret=btn('txtcadr','herit from _global.css').' ';
$ret.=msqbt('design','public_design_1').br().br();
if($r)foreach($r as $k=>$v){$ncb=self::name_classe($v);
	if($ncb==$nc)$ret.=self::name_line_j($k,$v,1,1);}
return $ret;}

static function facil_reset($k,$nc){$ret=btn('txtcadr','default').' ';
$ret.=lkc('txtx','/?admin=css&edit_css='.$k.'&reset_this==#'.$k,'reset').br().br();
$r=self::css_default();
if($r)foreach($r as $k=>$v){$ncb=self::name_classe($v);
	if($ncb==$nc)$ret.=self::name_line_j($k,$v,1,2);}
return $ret;}

static function facil_pos($defs,$k){
$ret=self::cssactbt('erase','delete','self',$k);
$ret.=self::cssactbt('newfrom',nms(44),'self',$k);
foreach($defs as $ka=>$v)$rb[$ka]=self::name_classe($v);
$ret.=label('sdx'.$k,'position:','txtx').select(['id'=>'sdx'.$k],$rb,'kv',$k);
$ret.=self::cssactbt('atpos','ok','self',$k,'','sdx'.$k);
return $ret;}

static function form_facilities($defs,$k){
if(empty($defs[$k]))return;
$val=stripslashes($defs[$k][6]);//freecss
$nc=self::name_classe($defs[$k]);
$url='/?admin=css&edit_css='.$k; $end=divc('clear','');
$ret=btn('txtcadr',trim($nc)).' '.btn('txtsmall2','#'.$k.'').' ';
$rt['classe']=self::facil_css($k,$url,$val).$end;//css_free
$rt['colors']=self::facil_colors($defs,$k,$url).$end;//colors
$rt['default']=self::facil_reset($k,$nc).$end;//reset
$rt['global']=self::facil_globalc($k,$nc).$end;//global
//if($nc=='@font-face '){$ret.=self::facil_fonts($defs,$k,$url).$end;}//fonts
$rt['images']=self::facil_images($k,$url,$val).$end;//images
$rt['name']=self::facil_names($defs,$k);//classname
$rt['tools']=self::facil_pos($defs,$k).$end;//pos
//$ret.=divc('imgr',self::facil_pos($defs,$k));
$ret.=tabs($rt,'csf'.$k);
return div(atc('clear').ats('padding:10px; width:550px;'),$ret);}

static function form_edit_css($d){
$ret=lj('','popup_cssedt,home__'.$d.'_330',picto('plus')).' ';
$ret.=ljb('','insert_b',['\n','cssarea'.$d],picto('back')).' ';
$ret.=lj('','popup_sty,savcss_cssarea'.$d.'__'.$d.'_4',picto('export')).' ';
$ret.=lj('popsav','css'.$d.'_sty,savcss_cssarea'.$d.'__'.$d,nms(66)).' ';
return divc('',$ret);}

#save
static function modif_css($defs,$k,$deb,$end,$new){$val=$defs[$k][6];
if(strpos($val,$deb)===false){$defs[$k][6].=' '.$new;}
else{$old=between($val,$deb,$end,'');
$defs[$k][6]=str_replace($deb.$old.$end,$new,$val);}
return $defs;}

static function save_img_b($spe){
$fich=$_FILES['fichier']['name'];
$fich=normalize($fich);
if(!$fich)return "empty";
if(stristr(".jpg.png.gif",substr($fich,-4))!==false)
return '/imgb/usr/'.ses('qb').'_css_'.$fich;}

static function img_adder($defs){
$k=get('save_img'); $val=$defs[$k][6];
if(get('erase_img')!="ok"){
	if($im=get('im')=="on")$mg=self::save_img_b('css');
	if($adm=get('add_img'))$mg=$$adm;
	$css='background-image:url('.$mg.'); ';}
if($im=='on'){	
$alg='background-position:'.post('align').' '.post('valign').'; ';
$rpt='background-repeat:'.post('repeat').'; ';
$fxd='background-attachment:'.post('fixed').'; ';
$defs=self::modif_css($defs,$k,'background-repeat:',';',$rpt);
$defs=self::modif_css($defs,$k,'background-position:',';',$alg);
$defs=self::modif_css($defs,$k,'background-attachment:',';',$fxd);}
if(strpos($val,'background:url')!==false){
$defs=self::modif_css($defs,$k,'background:url',';',$css);}
else{$defs=self::modif_css($defs,$k,'background-image:',';',$css);}
return $defs;}

static function save_css($defs,$k,$v){
if(post('erase_'.$k)=='ok')unset($defs[$k]);
else{
$v=str_replace("}\n","} ",$v);//smart_css//{{
$v=str_replace(";\n","; ",$v);
$v=str_replace("; \n",";\n",$v);
//$v=str_replace(["\n","\r"],'',$v);
$v=preg_replace('/( ){2,}/',' ',$v);
$defs[$k][6]=trim($v);}
return $defs;}

#build
	
//building
static function write_css_c($fcss,$r){
foreach($r as $k=>$v){
if($v[2] && $v[3]){
	if($v[1]=='a'){
	/*$re[$v[0].$v[1].':link'][]=$v[2].':'.$v[3].' ';	
	$re[$v[0].$v[1].':visited'][]=$v[2].':'.$v[3].' ';*/
	$re[$v[0].$v[1]][]=$v[2].':'.$v[3].' ';}
	else $re[$v[0].$v[1]][]=$v[2].':'.$v[3].' ';}
elseif($v[3]) $re[$v[0].$v[1]][]=$v[3].' ';}
foreach($re as $k=>$v){$ter='';//groupe par attributs cummuns
	foreach($v as $ka=>$va)$ter.=$va;
$rte[$ter][]=$k;}
foreach($rte as $k=>$v){$ter='';//$rte
	foreach($v as $ka=>$va)$ter.=$va.', ';
$ret=substr($ter,0,-2).'{'.$k.'}'."\n";}
$ret=str_replace([' ,','  ','a a'],[',',' ','a'],$ret);//clean
write_file($fcss,$ret);}

static function write_css($fcss,$r){$ret=''; $re=[];
if($r)foreach($r as $k=>$v){
	//if($v[4]==3){$re['a'.$v[0].':hover'][]=$v[2].':'.$v[3].' ';} else
	if($v[2] && $v[3]){$re[$v[0].$v[1]][]=$v[2].':'.$v[3].' ';}
	elseif($v[3])$re[$v[0].$v[1]][]=$v[3].'';}
if($re)foreach($re as $k=>$v){$ter='';//groupe par css
	foreach($v as $ka=>$va){
		if(strpos($k,'font-face'))$ret.=$k.' {'.$va.'}'."\n"; else $ter.=$va;}
	if($ter)$ret.=$k.' {'.$ter.'}'."\n";}
$ret=str_replace([' ,','  ','a a',' }'],[',',' ','a','}'],$ret);//clean//{{
write_file($fcss,$ret);}

static function affect_rgba($d,$clr){$ret='';
$r=explode('#',$d); $n=count($r); $clr[0]=''; for($i=0;$i<$n;$i++){$ri=val($r,$i);
if(substr($ri,0,1)=='_'){$klr=strnext($ri,';,) '); $vlr=substr(trim($klr),1);
	if(strpos($vlr,'.')){[$abs,$alp]=explode('.',$vlr);
		$ret.=str_replace($klr,hexrgb(val($clr,$abs),$alp/10),$ri);}
	else $ret.='#'.str_replace($klr,val($clr,$vlr),$ri);}
elseif($i)$ret.='#'.$ri; else $ret.=$ri;}
return $ret;}

static function invertclrs($r){
foreach($r as $k=>$v)if($v)$r[$k]=invert_color($v,0);
return $r;}

static function build_css($f,$defs,$neg=''){
unset($defs['_menus_']); $clr=getclrs(); $ret=[];
if($neg){$f=str_replace('.css','_neg.css',$f); $clr=self::invertclrs($clr);}
$sheets=[3=>'color',4=>'background-color',5=>'border-color',''];
$attributes=['','a','a:hover',''];
if($defs)foreach($defs as $k=>$v){$css_name=self::name_classe($v); $v=arr($v,7);
	if($css_name!='#div .class element '){
		for($i=3;$i<6;$i++){
		$conn=expl('|',$v[$i],4);
			for($o=0;$o<=3;$o++){$cn=isset($conn[$o])?$conn[$o]:'';
				if(is_numeric($cn))$cur='#'.val($clr,$cn).';';
				//elseif(is_numeric(hexdec($cn)))$cur='#'.$cn.';';
				elseif($cn)$cur='#'.$cn.';';
				else $cur='';
				$ret[]=[$css_name,$attributes[$o],$sheets[$i],$cur,$o];}}
	$ret[]=[$css_name,'','',self::affect_rgba($v[6],$clr),'','',''];}}
if(get('cmpq'))self::write_css_c($f,$ret); else self::write_css($f,$ret);
return $ret;}
}
?>