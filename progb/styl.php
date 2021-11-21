<?php
//philum_css_builder

function css_actions($p,$o,$b,$res){
$bd='design'; $bs='system'; req('admin,adminx');
clrpckr_js(); $qb=ses('qb'); $lh=sesmk('csslang');
$defsb=['div','class','element','color','bkg','border','free'];
$numb=ses('desgn');//desgn
//echo $_SESSION['desgn'];
if($numb && $numb!='='){$_SESSION['desgn']=$numb; $_SESSION['clrset']=$numb;
	$_SESSION['clrs'][$numb]=msql_read('design',$qb.'_clrset_'.$numb,'');
	$defs=msql::read_b('design',nod('design_'.$_SESSION['desgn']),'','',$defsb);}
	//pr($defs);
$desgn=$_SESSION['desgn']; $prmd=$_SESSION['prmd'];
$clrset=$_SESSION['clrset']=ses('clrset',$prmd);
$nod=$qb.'_design_'.$desgn; $noc=$qb.'_clrset_'.$clrset;
$fcss='css/'.$nod.'.css'; $ftmp='css/'.$qb.'_design_dev_'.$desgn.'.css';
switch($p){
//case(''):; break;
case('new_from'):$tbn=msql::findlast('design',$qb,'design');
	msql::save($bd,$qb.'_design_'.$tbn,$defs);
	msql::copy('design',$noc,'design',$qb.'_clrset_'.$tbn);
	$_SESSION['clrs'][$tbn]=$_SESSION['clrs'][$_SESSION['desgn']];
	$_SESSION['desgn']=$_SESSION['clrset']=$tbn;
	$nod=$qb.'_design_'.$tbn; $noc=$qb.'_clrset_'.$tbn;
	msql::modif('','public_design',dsnam_arr(desname($qb,$desgn)),'one','',$tbn);
	build_css('css/'.$qb.'_design_dev_'.$tbn.'.css',$defs); 
	return '/admin/css&design='.$tbn; break;
case('make_public'):if($o)$tbn=$desgn;
	else $tbn=msql::findlast('design','public','design');
	msql::save($bd,'public_design_'.$tbn,$defs);
	msql::copy('design',$noc,'design','public_clrset_'.$tbn);
	msql::modif('','public_design',dsnam_arr(desname($qb,$desgn)),'one','',$desgn);
	build_css('css/public_design_'.$tbn.'.css',$defs);
	alert('created: public_design_'.$tbn); break;
case('make_admin'):build_css('css/_admin.css',$defs);
	msql::save($bs,'default_css_3',$defs); 
	alert('modified: system/default_css_3, _admin.css'); break;
case('make_global'):build_css('css/_global.css',$defs);
	msql::save($bs,'default_css_1',$defs);
	msql::copy('design',$noc,'system','default_clr_1'); 
	alert('modified: system/default_css_1, _global.css'); break;
case('make_default'):build_css('css/_classic.css',$defs);
	msql::save($bs,'default_css_2',$defs);
	msql::copy('design',$noc,'system','default_clr_2');
	$defse=empty_design($defs,'clr'); build_css('css/_default.css',$defse);
	alert('modified: table system/default_css_2, _classic.css, _default.css (no colors)'); break;
case('reset_clr'):$_SESSION['clrs'][$clrset]=msql_read('system','default_clr_2',''); 
	save_clr($noc); break;
case('reset_default'):$defs=css_default(); unset($defs['_menus_']);
	msql::save($bd,$nod,$defs); build_css($ftmp,$defs); break;
case('reset_global'):$defs=css_default(1); unset($defs['_menus_']);
	msql::save($bd,$nod,$defs); build_css($ftmp,$defs); break;
case('public_clr'):$_SESSION['clrs'][$clrset]=msql_read('design','public_clrset_'.$o,'');
	save_clr($noc); break;
case('public_design'):$defs=msql_read('design','public_design_'.$o,''); unset($defs['_menus_']);
	msql::save($bd,$nod,$defs); build_css($ftmp,$defs); break;
case('empty_design'):$defs=empty_design($defs,'css');
	msql::save($bd,$nod,$defs); build_css($ftmp,$defs); break;
case('null_clr'):$_SESSION['clrs'][$clrset]=['','','','','','','',''];
	save_clr($noc); break;
case('null_design'):$defs=css_default(); $defs=empty_design($defs,'css');
	msql::save($bd,$nod,$defs); build_css($ftmp,$defs); break;
case('append'):$defsc=css_default(); unset($defsc['_menus_']);
	$defs=array_append_css($defs,$defsc); msql::save($bd,$nod,$defs);
	build_css($ftmp,$defs); break;
case('append_global'):$defsc=css_default(); unset($defsc['_menus_']);
	$defs=array_append_css($defs,$defsc); msql::save($bd,$nod,$defs);
	build_css($ftmp,$defs); break;
case('inject_global'):$defsc=css_default(); unset($defsc['_menus_']);
	$defs=append_design($defs,$defsc); msql::save($bd,$nod,$defs);
	build_css($ftmp,$defs); break;
case('reset_this'):$defsc=css_default(); $ecb=find_value($defsc,$defs[$o]);
	if($ecb){$defs[$o]=$defsc[$ecb]; msql::save($bd,$nod,$defs);
	build_css($ftmp,$defs);} break;
case('open_design'):$_SESSION['desgn']=$o; $_SESSION['clrset']=$o;
	return '/admin/css&design='.$o; break;
case('herit_design'):list($qbb,$nbd)=explode('_',$o);
	$defs=msql::read_b('design',$qbb.'_design_'.$nbd,'','',$defsb);
	msql::save($bd,$nod,$defs); build_css($ftmp,$defs); break;
case('herit_clrset'):list($qbb,$nbd)=explode('_',$o);
	$_SESSION['clrs'][$clrset]=msql_read('design',$qbb.'_clrset_'.$nbd,'');;
	save_clr($noc); build_css($ftmp,$defs); break;
case('addff'):$defs=defs_adder_ff($defs,$o);
	msql::save($bd,$nod,$defs); build_css($ftmp,$defs); break;
case('save_img'):$defs=img_adder($defs); msql::save($bd,$nod,$defs);
	build_css($ftmp,$defs); break;
case('invert_clr'):$_SESSION['clrs'][$clrset]=invert_defsclr();
	save_clr($noc); build_css($ftmp,$defs); break;
case('erase'):$defs=save_css_j_del($defs,$o); 
	msql::save($bd,$nod,$defs); break;
case('newfrom'):$defs=save_css_newfrom($defs,$o);
	msql::save($bd,$nod,$defs); break;
case('atpos'):$n=count($defs); $defs=save_css_displace($defs,$res,$o);
	if(count($defs)==$n)msql::save($bd,$nod,$defs); break;
case('save'):msql::save($bd,$nod,$defs);
	build_css($ftmp,$defs); build_css($fcss,$defs); break;
case('backup'):msql::save($bd,$nod.'_sav',$defs,1); save_clr($noc.'_sav'); break;
case('apply'):msql::save($bd,$nod,$defs); save_clr($noc);
	build_css($fcss,$defs); informe_config_design(); break;
case('test_design'):$_SESSION['prmd']=$_SESSION['desgn']; break;
//case('apply_font'):$defs=defs_face($defs,$o); msql::save($bd,$nod,$defs); break;
//case('build_css'):build_css($ftmp,$defs); break;
case('restore_design'):$defs=msql::read_b('design',$nod.'_sav','',1,$defsb);
	msql::save($bd,$nod,$defs); build_css($ftmp,$defs); break;
case('restore_clrset'):$r=msql::read_b('design',$noc.'_sav'); $clrst[0]='';
	if($r)foreach($r as $k=>$v)$clrst[]=$v[0]; $_SESSION['clrs'][$desgn]=$clrst; save_clr($noc); 
	build_css($ftmp,$defs); break;
case('exit_design'):sesz('desgn'); $_SESSION['clrset']='';
	req('boot'); define_mods(''); define_condition(); define_clr(); $_POST['popadm']['design']='';
	return '/admin/console'; break;//reset hneg
case('displaycss'):return nl2br(read_file($fcss)); break;
case('displaycsstmp'):return nl2br(read_file($ftmp)); break;
}
return btn('txtyl',$p.': ok');}

function cssactbt($p,$t,$x='',$o='',$tt='',$id=''){if($tt)$tt='" title="'.$tt;
if($p=='exit_design')$c='popsav'; elseif($p=='save')$c='popsav';
elseif($p=='erase')$c='txtyl'; else $c='txtx';
if($x=='self' or $x=='url')$tg='socket';
else{$tg='popup'; if($p!='displaycss' && $p!='displaycsstmp')$x='xx';}
return lj($c.$tt,$tg.'_stylact__'.$x.'_'.ajx($p).'_'.ajx($o).'___'.$id,$t);}
//$ret.=cssactbt('action',$bt,'self',$o,'title',$res);

function edit_css(){
clrpckr_js(); $qb=ses('qb'); $lh=sesmk('csslang'); $defs='';
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
unset($defs[0]); $defs=reorder_keys($defs);
if(!is_file($ftmp))build_css($ftmp,$defs);
#body
$ret=lkc('txtcadr','/admin/css',$nod).' ';
$ret.=msql_desnam($qb,$desgn,'');
$ret.=hlpbt('design').' ';
$ret.=msqbt('design',$qb.'_design_'.$desgn).' ';
$ret.=cssactbt('exit_design',pictxt('logout',nms(112)),'url','','');//'','','');
if(prmb(5))$ret.=picto('alert').helps('prmb5').' ';
$ret.=hlpbt('designcond');
$ret.=br();
$ret.=lj('txtbox','popup_styls___select','design:'.$desgn.'/clrset:'.$clrset).' ';//
//$ret.=lj('txtbox','bubble_call___sty_charge*sets','design:'.$desgn.'/clrset:'.$clrset).' ';
$ret.=cssactbt('backup','backup','self','','');//'','',''
if(is_file(msql::url('design',$nod))){
	$ret.=cssactbt('restore_design',nms(95).' design','self','');
	$ret.=cssactbt('restore_clrset',nms(95).' clr','self','');}
if($_SESSION['prmd']!=$_SESSION['desgn'])
	$ret.=cssactbt('test_design','test design '.$desgn,'self','');
if($_SESSION['desgn']!=$_SESSION['prma']['design'])
	$ret.=cssactbt('apply',nms(66).' (mods:'.prmb(1).'-'.$_SESSION['prma']['design'].')','self','sav');
$ret.=cssactbt('save',nms(57),'','','');
//$ret.=cssactbt('build_css',nms(93),'','');//rebuild
$ret.=br();
$ret.=cssactbt('new_from',nms(44),'url','');//url
$ret.=cssactbt('empty_design',nms(46),'self','');
$ret.=cssactbt('invert_clr',nms(115),'self','');
$ret.=cssactbt('make_public',$lh[4],'','');//make_public
$ret.=cssactbt('make_public',$lh[5],'','1');//inform_public
if($_SESSION['auth']>5){$r=msql::row('',$qb.'_design',$desgn); 
	$desgname=!empty($r[0])?$r[0]:val($r,'name');
	if($desgname=='admin')$make='make_admin';
	elseif($desgname=='global')$make='make_global';
	else $make='make_default';
	$ret.=cssactbt($make,$make,'','','');}
$ret.=br();
$ret.=cssactbt('reset_default',nms(96).' design','self','');
$ret.=cssactbt('reset_clr',nms(96).' clr','self','');
$ret.=cssactbt('reset_global','global design','self','');
$ret.=cssactbt('public_clr','global clr','self','1');
$ret.=cssactbt('public_design','classic design','self','2');
$ret.=cssactbt('public_clr','classic clr','self','2');
$ret.=cssactbt('null_design','null','self','');
$ret.=cssactbt('null_clr','clr','self','2');
$ret.=lj('txtx','popup_stylsff___1','@font-face');
$ret.=br();
$ret.=cssactbt('append',nms(92).' defaults','self','');
$ret.=cssactbt('append_global',nms(92).' global','self','');
$ret.=cssactbt('inject_global',$lh[9],'self','');
$ret.=cssactbt('displaycss',$lh[10],'3','');
$ret.=cssactbt('displaycsstmp',$lh[11],'3','');
$ret.=lj('txtx','popup_styls___clr','clrset').' ';
$ret.=btn('txtx',count($defs).' '.nms(117)).' ';
$ret.=btn('txtx',mkday(filemtime(msql::url('design',$nod)))).' ';
$ret.=br().br();
$ret.=clrset_edit().br();//colors
if($defs)$ret.=design_edit($defs,$defsb,'',1).br().br();//edit_css
return $ret;}

#builders
function css_default($o=''){$o=$o?$o:'2';
return msql_read('system','default_css_'.$o,'');}

function save_clr($nod){$r=$_SESSION['clrs'][$_SESSION['clrset']]; 
if($r)foreach($r as $k=>$v)if($v)$rb[$k]=[$v]; $rb[]=[];
if($rb)msql::save('design',$nod,$rb); return $rb;}

function reorder_keys($r){$i=0; $ret=[];
if($r)foreach($r as $k=>$v){if($k!='_menus_'){$i++; $k=$i;} $ret[$k]=$v;}
return $ret;}
//append
function array_pop_b($r,$va,$n){$i=0;
foreach($r as $k=>$v){$i++; $ret[$i]=$v; if($k==$n){$i++; $ret[$i]=$va;}}
return $ret;}
function array_append_css($a,$b){
	foreach($b as $k=>$v){$n='';
	$ka=trim($v[0]).trim($v[1]).trim($v[2]);
		foreach($a as $kb=>$vb){
		$kba=trim($vb[0]).trim($vb[1]).trim($vb[2]);
		if($kba==$ka)$n=$kb;}
	if(!$n)$a=array_pop_b($a,$v,$k);}
return $a;}
//inject
function app_des_free($da,$db){
$a=explode(';',str_replace(['; ',";\n","\n"],[';',';',''],$da)); 
$b=explode(';',str_replace(['; ',";\n","\n"],[';',';',''],$db)); 
if($b)foreach($b as $k=>$v){if($a)$in=in_array($v,$a); 
	if(trim($v) && (($a && !$in) or !$a))$a[]=trim($v);}
if($a){$n=count($a); for($i=0;$i<$n;$i++)if($a[$i])$ret.=$a[$i].'; ';
return $ret;}}

function append_design($a,$b){
foreach($a as $k=>$v){$va=trim($v[0].$v[1].$v[2]); $vrf[$va]=$k;}
foreach($b as $k=>$v){$va=trim($v[0].$v[1].$v[2]); $kb=$vrf[$va];
	if($kb){//$a[$k][3]=$v[3]; $a[$k][4]=$v[4]; $a[$k][5]=$v[5]; //colors
		$a[$k][6]=app_des_free($a[$k][6],$v[6]);}
	else $a[]=$v;}
return $a;}

function empty_design($r,$p){
foreach($r as $k=>$v){
	list($v0,$v1,$v2,$v3,$v4,$v5,$v6)=arr($v,7);
	if($p=='all')$r[$k]=[$v0,$v1,$v2,'||','||','||',''];
	elseif($p=='clr')$r[$k]=[$v0,$v1,$v2,'||','||','||',$v6];
	elseif($p=='css')$r[$k][6]='';}
return $r;}
function invert_defsclr(){
$r=getclrs();
foreach($r as $k=>$v)if($v)$r[$k]=invert_color($v,0);
return $r;}

#select_design
function charge_sets(){$qb=$_SESSION['qb'];
$r=explore('msql/design/','files',1); asort($r);
if($r){foreach($r as $k=>$v){$v=substr($v,0,-4); list($nd,$dr,$nb,$sv)=opt($v,'_',4);
	if($sv!='sav' && $nd && is_numeric($nb) && ($nd==$qb or ($nd=='public' or $_SESSION['auth']>6)))
		$rb[$nd][$nb][$dr]=$nb;}
$tab[]=['open','herit','colors']; 
if($rb)foreach($rb as $k=>$v){
	if(is_array($v)){$taba=[]; $tabb=[];
	$ra=msql_read('users',$k.'_design','');
	foreach($v as $nb=>$bs){
		$ds=val($bs,'design'); $cl=val($bs,'clrset');
		$na=isset($ra[$nb][0])?$ra[$nb][0]:$ds;//name
		if($k==$qb)$tabt[$nb]=cssactbt('open_design',$na,'url',$ds);
		else $tabt[$nb]=$nb;
		if($ds)$taba[$nb]=cssactbt('herit_design',$nb,'self',$k.'_'.$ds);
		if($cl){$bt=clrset_view($k.'_clrset_'.$cl);
			$tabb[$nb]=cssactbt('herit_clrset',$bt,'self',$k.'_'.$ds);}}
	if($taba)$nbd=count($taba); if($tabb)$nbc=count($tabb);
	$tab[]=[btn('txtcadr',$k),'','']; $nb=count($taba);
	for($i=0;$i<=$nb;$i++){$tab[]=[val($tabt,$i),val($taba,$i),val($tabb,$i)];}}}}
return scroll_b($tab,tabler($tab),20,320,320);}//txtblc//txtx

function clrset_view($d){
$r=msql_read('design',$d,''); $ret='';
if(is_array($r))foreach($r as $k=>$v){
if($k>0){$sty='"style="color:#'.invert_color($v,1).'; background-color:#'.$v.'; ';
if(!$v)$v='none'; $ret.=btn($sty,'__').' ';}}
return $ret;}

function clrset_edit(){$ret='';
$ndc=$_SESSION['clrset']?$_SESSION['clrset']:$_SESSION['prmd'];
$clr=msql_read('design',nod('clrset_'.$ndc),''); $nb=count($clr);
$clrn=['','bkg','border','bloc','identity','active','art_bkg','art_txt','txt'];
for($i=1;$i<=$nb;$i++){$name=$i.(isset($clrn[$i])?':'.$clrn[$i]:'');
$ret.=div(atc('clrp').atd('colorpick'.$i).ats('color:#'.invert_color($clr[$i],1)),divs('background-color: #'.$clr[$i].';',$name.input1('colorpickerField'.$i,$clr[$i],5)));}
return $ret.br().ljb('txtbox','SaveClr',$nb,nms(57)).divd('clrreponse','');}

#editor
function name_classe($p){$ret='';
list($p0,$p1,$p2)=arr($p,3);
if($p0)$ret.='#'.$p0.' ';
if($p1)$ret.='.'.$p1.' ';
if($p2)$ret.=$p2.' ';
return $ret;}

function petit_clr($t,$clr){
if(!$t)$t=0; $a=explode('|',$t); $ret='';
foreach($a as $v){if(!$v)$v='-'; $c=isset($clr[$v])?$clr[$v]:'';
	$ret.=btn('" style="background:#'.$c.'; color:#'.invert_color($c,1).'; padding:0; float:left; width:8px;',$v);}
return $ret;}

function divname_cls($t){return 'css'.str_replace(['.','#',' '],'',$t);}

function name_line_j($k,$p,$op,$clrb=''){
$csa='txtnoir'; $t=name_classe($p);
$css=get('edit_css')==$k?' active':'';
if($clrb==1)$clr=msql_read('system','default_clr_1','');
elseif($clrb==2)$clr=msql_read('system','default_clr_2','');
else $clr=getclrs();
$sty='" style="float:left; text-align:left; margin:1px; width:';
if($k)$ret=toggle($csa.$css.$sty.'190px;','css'.$k.'_styls_edit_'.$k,$t);
else $ret=btn($csa.$sty.'190px;',$t);
for($i=3;$i<6;$i++)$ret.=btn($csa.$sty.'50px',petit_clr($p[$i]??'-',$clr));
if($op){$pb=isset($p[6])?etc(str_replace('; ',';'.br(),stripslashes($p[6])),1000):'-';
$ret.=btn($csa.$sty.'250px; text-align:left;',$pb);}
return divc('clear',$ret);}

function design_edit($r,$defsb,$edit,$op){
$ret=name_line_j(0,$defsb,$op).br();//keys
$ra=['divs'=>$ret,'classes'=>$ret,'elements'=>$ret];
if($r){foreach($r as $k=>$v){$ret='<a name="'.$k.'"></a>';
	if($k){$ret.=name_line_j($k,$v,$op).br();//if(!$edit) 
	if($edit==$k)$t=form_facilities($r,$edit); else $t='';}
$ret.=divd('css'.$k,$t);
if($v[0])$ra['divs'].=$ret; elseif($v[1])$ra['classes'].=$ret; 
elseif($v[2])$ra['elements'].=$ret;}}
return divs('min-width:440px',make_tabs($ra,'css'.$edit));}

function save_clr_j($tosave){$qb=$_SESSION['qb'];
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
$ndc=$_SESSION['clrset']?$_SESSION['clrset']:$_SESSION['prmd'];
$nod=$qb.'_design_'.$ndd; $f_c=$qb.'_clrset_'.$ndc;
if(!$_SESSION['desgn'])$f_css_temp='css/'.$qb.'_design_'.$ndd.'.css';
else $f_css_temp='css/'.$qb.'_design_dev_'.$ndd.'.css';
$defs=msql::read_b('design',$nod,'',1);
$tosave=str_replace('/','_',$tosave);
if(substr($tosave,-1)=='_')$tosave=substr($tosave,0,-1);
setclrs(opt($tosave,'_',9));
if($_SESSION["auth"]>=6)save_clr($f_c);
build_css($f_css_temp,$defs);
return btn('popdel','saved');}

#ajax

function clrpckr_layout(){$var='';
$rc=getclrs(); $nb=$rc?count($rc):7;
for($i=1;$i<=$nb;$i++)$var.="
	$('#colorpickerField".$i."').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el){
			$(el).val(hex);
			$(el).ColorPickerHide();
			$('#colorpick".$i." div').css('backgroundColor', '#' + hex);
			SaveClr(10);},
		onBeforeShow: function(){ $(this).ColorPickerSetColor(this.value);},
		onShow: function(colpkr){ $(colpkr).fadeIn(200); return false;},
		onHide: function(colpkr){ $(colpkr).fadeOut(200); return false;}})";
$ret="
	(function($){var initLayout=function(){".$var."};
	EYE.register(initLayout,'init');})(jQuery)";
$ret.="
function SaveClr(nb){var clrs='/';
	for(i=1;i<=nb;i++){
	var va=document.getElementById('colorpickerField'+i).value ;
		if(i<=7)var clrs=clrs+va+'/' ;
		else if(i>7 || va)var clrs = clrs + va + '/' ;}
	var ajax=new AJAX(jurl()+'saveclr_'+clrs,'clrreponse');
	var x=setTimeout('Close(\'clrreponse\')',3000);}";
return $ret;}

function clrpckr_js(){$jsp='/js/colorpicker/';
Head::add('csslink',$jsp.'css/colorpicker.css');
Head::add('csslink',$jsp.'css/layout.css');
Head::add('jslink',$jsp.'js/jquery.js');
Head::add('jslink',$jsp.'js/colorpicker.js');
Head::add('jslink',$jsp.'js/eye.js');
Head::add('jscode',clrpckr_layout());}

//see_css
function styls($d,$edit){$qb=$_SESSION['qb'];
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
$ndc=$_SESSION['clrset']?$_SESSION['clrset']:$_SESSION['prmd'];
$nod=$qb.'_design_'.$ndd; $ndc=$qb.'_clrset_'.$ndc;
if($d=='select')$ret=popup('select design ('.$_SESSION['prmd'].')',charge_sets($d),440);
if($d=='edit'){$rb=msql::read_b('design',$nod);
	$ret=form_facilities($rb,$edit);}
//if($d=='css1')$ret=nl2br(read_file('css/'.$qb.'_design_'.$_SESSION['cond'][0].'.css'));
if($d=='css2')$ret=nl2br(read_file('css/'.$nod.'.css'));
if($d=='clr')$r=msql::read_b('design',$ndc);
if(isset($r))$ret=popup('colors',tabler($r,'txtblc','txtx'),340);
return $ret;}

function save_css_j_del($r,$n){//vrf n
foreach($r as $k=>$v)if($k!=$n)$ret[]=$v;//$k
return $ret;}

function save_css_newfrom($r,$n){
foreach($r as $k=>$v){$i++;
	if($k==$n){$ret[$i]=$v; $i++; $ret[$i]=$v;}
	else $ret[$i]=$v;}
return $ret;}

function save_css_displace($r,$n,$p){
$ra=$r[$n]; unset($r[$n]);
foreach($r as $k=>$v){$i++;
	if($k==$p){$ret[$i]=$v; $i++; $ret[$i]=$ra;}
	elseif($v)$ret[$i]=$v;}
return $ret;}

function save_css_clname($defs,$k,$v){$r=ajxr($v);
$defs[$k][0]=$r[0]; $defs[$k][1]=$r[1]; $defs[$k][2]=$r[2];
if(is_numeric($k))return $defs;}

function save_css_clr($defs,$k,$v){$r=explode('_',$v);
	$defs[$k][3]=$r[0].'|'.$r[1].'|'.$r[2];
	$defs[$k][4]=$r[3].'|'.$r[4].'|'.$r[5];
	$defs[$k][5]=$r[6].'|'.$r[7].'|'.$r[8];
return $defs;}

function save_css_tst($r,$k,$va){
$va=affect_rgba($va,getclrs()); $ret=divc('console',$va);
$ret.=divb($va,$r[1],$r[0]).divc('clear','').br().br();
return popup('test css '.$k,$ret,320);}

function save_css_j($k,$v,$c){//facil_css//stylsav
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
$bd='design'; $nod=nod('design_'.$ndd);
if($_SESSION['desgn'])$nodb=$_SESSION['qb'].'_design_dev_'.$ndd; else $nodb=$nod;
$defs=msql::read_b('design',$nod);
if($c==1)$defs=save_css_clr($defs,$k,$v);//clr
elseif($c==2)$defs=save_css_bkg($defs,$k,$v);//img
elseif($c==3)$defs=save_css_clname($defs,$k,$v);//classname
elseif($c==4)return save_css_tst($defs[$k],$k,$v);//tst
//elseif($c=='x')$defs=save_css_j_del($defs,$k);//del
else $defs=save_css($defs,$k,$v);//css
if($defs){msql::save($bd,$nod,$defs); build_css('css/'.$nodb.'.css',$defs);}
return form_facilities($defs,$k);}

function save_css_bkg($defs,$k,$v){$val=$defs[$k][6];
$css='background-image:url(/'.$v.'); ';
if(strpos($val,'background:url')!==false){
$defs=modif_css($defs,$k,'background:url',';',$css);}
else{$defs=modif_css($defs,$k,'background-image:',';',$css);}
return $defs;}

#font-face
function css_ff($v){$f='/fonts/'.$v;//$f=fonts_link($v);
$ret="font-family: '".str_replace('-webfont','',$v)."'; src: url('".$f.".woff') format('woff'), url('".$f.".svg#".$v."') format('svg');";//src: url("'.$f.'.eot");, url("'.$src.'.ttf") format("truetype")
return $ret;}

function valid_formats($va){$f='fonts/'.$va; $r=['.woff'=>'Firefox/Chrome','.eot'=>'IE','.svg'=>'Safari/mobiles','.ttf'=>'browsers']; $ret='';
foreach($r as $k=>$v){if(is_file($f.$k))$ret.=btn('txtsmall" title="'.$v,$k).' ';}
return $ret;}

function preview_ff_edit($k,$c,$p,$fb){$fb=ajxg($fb);
if($k)$r=msql::row('server','edition_typos',$k,1);
if($c=='acc' && $p)$r['accents']=($p=='no'?1:'');
if($c=='fav' && $p)$r['fav']=($p=='no'?1:'');
if($c=='cat' && $fb && $fb!='-'){$r['category']=$fb;
	if(!$_SESSION['fntcat'][$fb])$_SESSION['fntcat'][$fb]=1;}
if($k && $_SESSION['auth']>5)msql::modif('server','edition_typos',$r,$k);
foreach($r as $ka=>$v){$rb[]=$v;}
return preview_ff_p($k,$rb,$pn,$p);}

function font_source($v){
if($v==1)return lkt('txtsmall2','http://fontsquirrel.com/fontface','fontsquirrel').' ';
if($v==2)return lkt('txtsmall2','http://fontspring.com/fontface','fontspring').' ';
if($v==3)return lkt('txtsmall2','http://new.myfonts.com/','myfonts').' ';}

function font_set_cat($k,$v,$go){
$ret=br(); $ml['-']=1; if($_SESSION['fntcat'])$ml+=$_SESSION['fntcat'];
$ret.=select(' style="width:80px;" onchange="jumpslct(\'fntcat'.$k.'\',this)"',$ml,'kk');
$ret.=input2('fntcat" id="fntcat'.$k,$v,'8');
$ret.=lj('popsav',$go.'_cat___fntcat'.$k,'ok').' ';
return $ret;}

function preview_ff_p($k,$v){$go='fnt'.$k.'_ffedit___'.$k; $sz='';
$f='fonts/'.$v[0].'.woff'; if(is_file($f))$sz=round(filesize($f)/1000);
$ret=$v[0].' '.cssactbt('addff',pictxt('add','Add'),'self',$v[0],'').' '.$sz.'Ko ';
//lkc('txtbox','/?admin=css&addff='.$v[0],pictxt('add','Add'));
$acc=($v[2]?'yes':'no'); $fav=($v[3]?'ok':'no');
$ret.=lj($v[2]?'txtred':'txtx',$go.'_acc_'.$acc,'accents: '.$acc).' ';
$ret.=lj($v[3]?'txtred':'txtx',$go.'_fav_'.$fav,'fav').' ';
$ret.=valid_formats($v[0]);
$ret.=font_source($v[4]);
$ret.=lj('txtx','pop_stylsff___1_'.$v[1],$v[1]).' ';
if($_SESSION['auth']>5)$ret.=font_set_cat($k,$v[1],$go);
return $ret;}

function preview_ff($k,$v,$c){
$nm=str_replace('-webfont','',$v[0]); 
$str=ses('ffstr','AaBbCcDdEe0123��;!');
//$seeall=lj('txtx','pop_stylsall___','set');
$opt=div(atd('fnt'.$k),preview_ff_p($k,$v)).br().br();
return divs('font-family:'.$nm.'; font-size:'.$c.'px; line-height:'.round($c*1.2).'px;',$str).br().$opt;}

function css_fontface($p,$b='',$c='',$o='',$s='',$u=''){//page,cat,size,opt 
$csa='txtx'; $csb='txtred'; $jx='pop_'; if(!$b)$b='all'; $mnu='';
$r=msql_read('server','edition_typos','',1); $n=count($r); asort($r);
$rb['all']=1; $b=$b==''?'unclassed':$b; $gf='stylsff___'; //$s=substr($s,0,-1);
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
$mnu.=lj(($k==$b?$csb:$csa),$jx.$gf.'1_'.ajx($k).'_'.$c.'_'.$o,$k).' ';}
$mnu.=br(); $b=$b=='unclassed'?'':$b;
$pk=substr($o,0,3); $pv=substr($o,3); if($pv)$pp[$pk]=$pv; else $pp=[];
//rech
$srch=input2('srch',val($pp,'rch','search'),8,'','','','srchfnt');
$srch.=' '.lj('popbt',$jx.$gf.'1_'.$b.'_'.$c.'_'.$o.'_srchfnt','ok').' ';
$srch.=lj('popbt',$jx.$gf.'1_all','x');
//tri
$rc=[]; foreach($r as $k=>$v){
if(!$pv or (($pp['acc'] && $pp['acc']==$v[2]) or ($pp['fav'] && $pp['fav']==$v[3]) or ($pp['fam'] && $pp['fam']==$v[4]) or ($pp['rch'] && stristr($v[0],$pp['rch'])!==false))){
	if($v[1]==$b or $b=='all')$rc[$k]=$v;}}
$n=count($rc);
//pages
$no=20; $np=10; $min=$p-$np; $max=$p+$np; $nb=ceil($n/$no); 
$bb=ajx($b); $rtp='';
for($i=1;$i<=$nb;$i++){if($i==1 or $i==$nb or ($i>$min && $i<$max))
	//$rtp.=lj(($i==$p?'active':''),$jx.$gf.$i.'_'.$bb.'_'.$c.'_'.$o,$i);
	$rtp.=lj(($i==$p?'active':''),$jx.$gf.$i.'_'.$bb.'_'.$c.'_'.$o,$i).' ';
	if(($i==2 && $min>2) or ($i==$nb-1 && $max<$nb-1))$rtp.='... ';}
$nbp=divc('nbp',$rtp); $c=(is_numeric($c)?$cb=$c:48);
$arz=[12,24,36,48,72]; $siz='';
foreach($arz as $k=>$v){//size
$siz.=lj(($v==$c?$csb:$csa),$jx.$gf.$p.'_'.$b.'_'.$v.'_'.$o,$v).' ';}
//label
$go=$gf.$p.'_'.$bb.'__'; $prp='';
if(isset($rd))foreach($rd as $k=>$v){
$prp.=lj(($pp['fam']==$k?$csb:$csa),$jx.$go.'fam'.($pp['fam']==$k?'':$k),$v).' ';}
$prp.=lj((isset($pp['acc'])?$csb:$csa),$jx.$go.'acc'.(isset($pp['acc'])?'':1),'accents').' ';
$prp.=lj((isset($pp['fav'])?$csb:$csa),$jx.$go.'fav'.(isset($pp['fav'])?'':1),'favs').' ';
//render
$max=$p*$no; $min=$max-$no; $ia=0; $rta=''; $rtb='';
if($rc)foreach($rc as $k=>$v){$ia++; if($ia>=$min && $ia<$max && $v[0]){
	$rta.='@font-face {'.css_ff($v[0]).'}'."\n"; $rtb.=preview_ff($k,$v,$c);}}
$ret.=css_code($rta).$mnu.$hlp.$siz.$prp.$srch.br().br();
$ret.=input1('ffwr',$_SESSION['ffstr']?$_SESSION['ffstr']:'AaBbCcDdEe0123��','44');
$ret.=lj('txtx','ffwr_sesmake_ffwr__ffstr','set');
$ret.=divd('scroll',divd('pop',$nbp.br().$rtb.$nbp)).br();
if($u)return popup('create font-face',divs('width:640px;',$ret));
else return css_code($rta).$nbp.br().$rtb.$nbp;}

function defs_adder_ff($r,$o){$i=0;
$ra=['','','@font-face','','','',css_ff($o)];
foreach($r as $k=>$v){$i++;
	if($i==1){$ret[$i]=$ra; $i++;}
	$ret[$i]=$v;}
return $ret;}

#facilities

//inform_config
function find_value($defs,$css){//array div/css/elem
if(substr($css[0],0,1)=="#")$css[0]=substr($css[0],1);
if(substr($css[1],0,1)==".")$css[1]=substr($css[1],1);
if($defs)foreach($defs as $k=>$v)//find
	if($v[0]==$css[0] && $v[1]==$css[1] && $v[2]==$css[2])return $k;}

function obtain_values($defs,$css,$vl,$vb){
$k=find_value($defs,$css); $val=$defs[$k][6];
return embed_detect($val,$vl,$vb,'');}

function obtain_set($st){$set=explode(" ",$st); 
foreach($set as $k=>$v)$set[$k]=str_replace('px','',$v);
return $set;}

function obtain_css_widths($defs,$css,$attribut){
$crr=obtain_values($defs,$css,$attribut,";");
	list($h,$d,$b,$g)=obtain_set($crr); 
	if($g=='')$t=$d*2; if($d=='')$t=$h*2;
return $t;}

function informe_config_width($defs){
$w=obtain_values($defs,['#page'],'width:',';');
$w-=obtain_css_widths($defs,['#page'],'padding:');
$r=define_modc_b('system');
foreach($r as $k=>$v)if($v[0]=='content'){msql::modif('',ses('modsnod'),$w,$k);
$_SESSION['mods']['content'][$k]=$w;}}

function informe_config_design(){
$cnd=$_SESSION['cond']; $cndb=$cnd[1]?$cnd[1]:$cnd[0]; $r=define_modc_b('system');
foreach($r as $k=>$v)if($v[0]=='design'){
	$v[1]=$_SESSION['desgn']; $_SESSION['prma'][$v[0]]=$v[1]; $_SESSION['prmd']=$v[1];
	//if(get('cr_mod') && $v[3]!=$cndb){$v[3]=$cndb; $k='push';}
	if($k=='push')$_SESSION['mods']['system'][]=$v; else $_SESSION['mods']['system'][$k]=$v;
	array_unshift($v,'system');
	msql::modif('',$_SESSION['modsnod'],$v,$k);}}

# facilities
function treat_funcs_bkgs($j,$k,$v,$i){if($v)return $j.'/'.$v.'#';}
function facil_fonts($defs,$k,$url){
foreach($defs as $ka=>$va){
	if(strpos($va[6],'font-family')!==false){$va=name_classe($va);
	if($va!='@font-face')$t.=cssactbt('apply_font',$va,'self',$ka);}}
$ff=embed_detect($val,'font-family:',';');
return $t;}
	
function facil_images($k,$url,$val){
$ret=btn('txtx',toggle('','bkg'.$k.'_dsnav_bkg_'.$k,'backgrounds')).' ';
if(strpos($val,':url(/')!==false)$ret.=lkc('txtred',$url.'&save_img='.$k.'&erase_img==','delete_background');
$ret.=btd('bkg'.$k,''); $t_ims='';
$mnu_bkg=['','no-repeat','repeat-x','repeat-y','repeat'];
$mnu_im_align=['','left','right','center'];
$mnu_im_valign=['','top','bottom','center'];
if(strpos($val,'background:url')!==false)$t_ims=embed_detect($val,'background:url',';','');
list($urb,$reap,$fixd,$alg,$vlg)=opt($t_ims,' ',5);
if($fixd){$chk=' checked';}
if($urb){$urb=substr($urb,1,-1); $ret.=lkt('txtx',$urb,'open').br();}
$ret.=upload_j('upl','css',$k).' ';
return $ret;}

function facil_names($defs,$k){
$sty='" size="20'; $ids='cl1'.$k.'|cl2'.$k.'|cl3'.$k;
$ret=btn('txtsmall2','div:').input('cl1'.$k.$sty,$defs[$k][0]).br();
$ret.=btn('txtsmall2','class:').input('cl2'.$k.$sty,$defs[$k][1]).br();
$ret.=btn('txtsmall2','element:').input('cl3'.$k.$sty,$defs[$k][2]).' ';
$ret.=lj('popbt','css'.$k.'_stylsav____'.$k.'_3__'.$ids,nms(66)).br().br();
return $ret;}

function select_clr($p,$n){//stylclr
$r=getclrs(); $n=count($r); $ret='';
for($i=0;$i<=$n;$i++){$ri=val($r,$i); $t=mnu_line_t($ri,$i);
	$ret.=lj('','bt'.$p.'_stylsetclr___'.$ri.'_'.$i.'_'.$p,$t);}
return $ret;}

function mnu_line_t($clr,$t,$o=''){
$cb=$clr?invert_color($clr,1):'';
$s=$o?'border:1px solid gray; ':'';
return divs($s.'padding:2px 4px; color:#'.$cb.'; background-color:#'.$clr,$t);}

function mnu_line_bt($clr,$n,$p){//stylsetclr
$h=hidden('',$p,$n); $t=mnu_line_t($clr,$n);
return togbub('stylclr',$p.'_'.$n,$t).$h;}

function mnu_line_color($d,$p){$r=explode('|',$d);//txt|link|hover/a.c.hover
$kr=getclrs(); $n=count($kr); $ret='';
for($i=0;$i<=3;$i++){$ri=val($r,$i);
	$clrn=$ri=='undefined'||!$ri?'0':$ri; $nid=$i+1;
	$kl=isset($kr[$clrn])?$kr[$clrn]:'';
	$ret.=span(atc('cell').atd('bt'.$p.$nid),mnu_line_bt($kl,$clrn,$p.$nid));}
return $ret;}

function facil_colors($defs,$k,$url){
$t=divc('row',btn('cell','').btn('cell','text').btn('cell','a').btn('cell','hover').btn('cell','a:hover'));
$t.=divc('row',btn('cell','color').mnu_line_color($defs[$k][3],'clr'.$k));
$t.=divc('row',btn('cell','backg').mnu_line_color($defs[$k][4],'bkg'.$k));
$t.=divc('row',btn('cell','border').mnu_line_color($defs[$k][5],'bdr'.$k));
$ret=divc('table',$t); $rt='';
foreach(['clr','bkg','bdr'] as $va){$rt.=$va.$k.'1|'.$va.$k.'2|'.$va.$k.'3|';}
$ret.=lj('popbt','css'.$k.'_stylsav____'.$k.'_1__'.$rt,nms(66)).br();
return $ret;}

function facil_css($k,$url,$v){//save_css_j//stylsav
$v=str_replace("} ","}\n",$v);//smart_css//{{
$v=str_replace("; ",";\n",$v);
$t=form_edit_css($k);
$t.=textarea('cssarea'.$k,$v,60,10,atc('console')).' ';
return form($url.'#'.$k,$t);}

function facil_globalc($k,$nc){$r=css_default(1);
$ret=btn('txtcadr','herit from _global.css').' ';
$ret.=msqbt('design','public_design_1').br().br();
if($r)foreach($r as $k=>$v){$ncb=name_classe($v);
	if($ncb==$nc)$ret.=name_line_j($k,$v,1,1);}
return $ret;}

function facil_reset($k,$nc){$ret=btn('txtcadr','default').' ';
$ret.=lkc('txtx','/?admin=css&edit_css='.$k.'&reset_this==#'.$k,'reset').br().br();
$r=css_default();
if($r)foreach($r as $k=>$v){$ncb=name_classe($v);
	if($ncb==$nc)$ret.=name_line_j($k,$v,1,2);}
return $ret;}

function facil_pos($defs,$k){
$ret=cssactbt('erase','delete','self',$k);
$ret.=cssactbt('newfrom',nms(44),'self',$k);
foreach($defs as $ka=>$v)$rb[$ka]=name_classe($v);
$ret.=btn('txtx','position:').select(atd('sdx'.$k),$rb,'kv',$k);
$ret.=cssactbt('atpos','ok','self',$k,'','sdx'.$k);
return $ret;}

function form_facilities($defs,$k){
if(!$defs[$k])return;
$val=stripslashes($defs[$k][6]);//freecss
$nc=name_classe($defs[$k]);
$url='/?admin=css&edit_css='.$k; $end=divc('clear','');
$ret=btn('txtcadr',trim($nc)).' '.btn('txtsmall2','#'.$k.'').' ';
$rt['classe']=facil_css($k,$url,$val).$end;//css_free
$rt['colors']=facil_colors($defs,$k,$url).$end;//colors
$rt['default']=facil_reset($k,$nc).$end;//reset
$rt['global']=facil_globalc($k,$nc).$end;//global
//if($nc=='@font-face '){$ret.=facil_fonts($defs,$k,$url).$end;}//fonts
$rt['images']=facil_images($k,$url,$val).$end;//images
$rt['name']=facil_names($defs,$k);//classname
$rt['tools']=facil_pos($defs,$k).$end;//pos
//$ret.=divc('imgr',facil_pos($defs,$k));
$ret.=make_tabs($rt,'csf'.$k);
return div(atc('clear').ats('padding:10px; width:550px;'),$ret);}

function form_edit_css($d){
$ret=lj('','popup_plup___cssedit__'.$d.'_330',picto('plus')).' ';
$ret.=ljb('',"insert_b",'\n\',\'cssarea'.$d,picto('back')).' ';
$ret.=lj('','popup_stylsav_cssarea'.$d.'__'.$d.'_4',picto('export')).' ';
$ret.=lj('popsav','css'.$d.'_stylsav_cssarea'.$d.'__'.$d,nms(66)).' ';
return divc('',$ret);}

#save
function modif_css($defs,$k,$deb,$end,$new){$val=$defs[$k][6];
	if(strpos($val,$deb)===false){$defs[$k][6].=' '.$new;}
	else{$old=embed_detect($val,$deb,$end,'');
	$defs[$k][6]=str_replace($deb.$old.$end,$new,$val);}
return $defs;}

function save_img_b($spe){
	$fich=$_FILES['fichier']['name'];
	$fich=normalize($fich);
	if(!$fich){$exp_out.="empty";}
	if(stristr(".jpg.png.gif",substr($fich,-4))!==false)
	return '../imgb/css_'.$_SESSION['qb'].'_'.$fich;}

function img_adder($defs){
$k=get('save_img'); $val=$defs[$k][6];
if(get('erase_img')!="ok"){
	if($im=get('im')=="on")$mg=save_img_b('css');
	if($adm=get('add_img'))$mg=$$adm;
	$css='background-image:url('.$mg.'); ';}
if($im=='on'){	
$alg='background-position:'.post('align').' '.post('valign').'; ';
$rpt='background-repeat:'.post('repeat').'; ';
$fxd='background-attachment:'.post('fixed').'; ';
$defs=modif_css($defs,$k,"background-repeat:",";",$rpt);
$defs=modif_css($defs,$k,"background-position:",";",$alg);
$defs=modif_css($defs,$k,"background-attachment:",";",$fxd);}
if(strpos($val,"background:url")!==false){
$defs=modif_css($defs,$k,"background:url",";",$css);}
else{$defs=modif_css($defs,$k,"background-image:",";",$css);}
return $defs;}

function defs_fonts($defs){$k=get('edit_css');
	if($fnt=post('font')){$css='font-family:'.$fnt.';';
	$defs=modif_css($defs,$k,"font-family:",";",$css);}
	if($sz=post('size')){$css="font-size:".$sz.'px;';
	$defs=modif_css($defs,$k,"font-size:",";",$css);}
	if($alg=post('align')){$css="align:".$alg.';';
	$defs=modif_css($defs,$k,"align:",";",$css);}
return $defs;}

function defs_face($defs,$k){
	if($k){$css='font-family:'.post('facefont').';';
	$defs=modif_css($defs,$k,"font-family:",";",$css);}
return $defs;}

function defs_clrst($defs){$k=get('edit_css');
	$defs[$k][3]=post('clr1').'|'.post('clr2').'|'.post('clr3');
	$defs[$k][4]=post('bkg1').'|'.post('bkg2').'|'.post('bkg3');
	$defs[$k][5]=post('bdr1').'|'.post('bdr2').'|'.post('bdr3');
return $defs;}

function save_css($defs,$k,$v){
if(post('erase_'.$k)=='ok')unset($defs[$k]);
else{
$v=str_replace("}\n","} ",$v);//smart_css//{{
$v=str_replace(";\n","; ",$v);
$v=str_replace("; \n",";\n",$v);
$v=str_replace(["\n","\r"],'',$v);
$defs[$k][6]=preg_replace('/( ){2,}/',' ',$v);}
return $defs;}

#build
	
//building
function write_css_c($fcss,$r){
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
$ret.=substr($ter,0,-2).'{'.$k.'}'."\n";}
$ret=str_replace([' ,','  ','a a'],[',',' ','a'],$ret);//clean
write_file($fcss,$ret);}

function write_css($fcss,$r){$ret=''; $re=[];
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

function affect_rgba($d,$clr){$ret='';
$r=explode('#',$d); $n=count($r); $clr[0]=''; for($i=0;$i<$n;$i++){$ri=val($r,$i);
if(substr($ri,0,1)=='_'){$klr=strnext($ri,';,) '); $vlr=substr(trim($klr),1);
	if(strpos($vlr,'.')){list($abs,$alp)=explode('.',$vlr);
		$ret.=str_replace($klr,hexrgb(val($clr,$abs),$alp/10),$ri);}
	else $ret.='#'.str_replace($klr,val($clr,$vlr),$ri);}
elseif($i)$ret.='#'.$ri; else $ret.=$ri;}
return $ret;}

function build_css($fcss,$defs,$clr=''){unset($defs['_menus_']);
$clr=$clr?$clr:getclrs(); $ret=[];
$sheets=[3=>'color',4=>'background-color',5=>'border-color',''];
$attributes=['','a','a:hover',''];
if($defs)foreach($defs as $k=>$v){$css_name=name_classe($v); $v=arr($v,7);
	if($css_name!='#div .class element '){
		for($i=3;$i<6;$i++){
		$conn=expl('|',$v[$i],4);
			for($o=0;$o<=3;$o++){$cn=isset($conn[$o])?$conn[$o]:'';
				if(is_numeric($cn))$cur='#'.val($clr,$cn).';';
				//elseif(is_numeric(hexdec($cn)))$cur='#'.$cn.';';
				elseif($cn)$cur='#'.$cn.';';
				else $cur='';
				$ret[]=[$css_name,$attributes[$o],$sheets[$i],$cur,$o];}}
	$ret[]=[$css_name,'','',affect_rgba($v[6],$clr),'','',''];}}
if(get('cmpq'))write_css_c($fcss,$ret); else write_css($fcss,$ret);
return $ret;}

?>