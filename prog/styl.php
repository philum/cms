<?php
//philum_css_builder

function edit_css(){$base="msql/design/"; $basy="msql/system/";
clrpckr_js(); $qb=ses('qb'); $lh=sesmk('csslang');
$defsb["_menus_"]=array("div","class","element","color","bkg","border","free");
$edit=$_GET["edit_css"]?$_GET["edit_css"]:$_POST["edit_css"];
if(!$_SESSION['desgn'])$_SESSION['desgn']=$_SESSION['prmd'];
$numb=$_GET["desgn"];//desgn
if($numb && $numb!="="){$_SESSION['desgn']=$numb;
	$_SESSION['clrset']=$numb; $_SESSION['prmd']=$numb;
	$_SESSION['clrs'][$numb]=msql_read('design',$qb.'_clrset_'.$_SESSION['clrset'],'');
	$defs=read_vars($base,$qb.'_design_'.$_SESSION['desgn'],$defsb);}
$desgn=$_SESSION['desgn']; $prmd=$_SESSION['prmd'];
$clrset=$_SESSION['clrset']=$_SESSION['clrset']?$_SESSION['clrset']:$prmd;
$f_dsn=$qb.'_design_'.$desgn;
$f_clr=$qb.'_clrset_'.$clrset;
$basecss='css/'.$f_dsn.'.css';
$basecss_temp='css/'.$qb.'_design_dev_'.$prmd.'.css';
#load
if(!$defs)$defs=read_vars($base,$f_dsn,$defsb); unset($defs['_menus_']);//good_nb
unset($defs[0]); $defs=reorder_keys($defs);
if(!is_file($basecss_temp))build_css($basecss_temp,$defs);
#sav
if($nd=$_GET["newdiv"]){
	$defs=defs_addnew($defs,$_GET["from"],array($nd,'','','','','','')); //p($defs);
	save_vars($base,$f_dsn,$defs); $edit=find_value($defs,array($nd));}
if($_GET["new_from"]){$tbn=msq_find_last('design',$qb,'design');
	save_vars($base,$qb.'_design_'.$tbn,$defs);
	msq_copy('design',$f_clr,'design',$qb.'_clrset_'.$tbn);
	//msq_copy('design',$qb.'_blocks_'.$desgn,'design',$qb.'_blocks_'.$tbn);
	$_SESSION['clrs'][$tbn]=$_SESSION['clrs'][$_SESSION['desgn']];
	$_SESSION['desgn']=$_SESSION['clrset']=$tbn;
	$f_dsn=$qb.'_design_'.$tbn; $f_clr=$qb.'_clrset_'.$tbn;
	msql_modif('users','public_design',dsnam_arr(desname($qb,$desgn)),'','one',$tbn);
	build_css('css/'.$qb.'_design_dev_'.$tbn.'.css',$defs);}
if($_GET["make_public"]){if($_GET["inform"])$tbn=$desgn;
	else $tbn=msq_find_last('design','public','design');
	save_vars($base,'public_design_'.$tbn,$defs);
	msq_copy('design',$f_clr,'design','public_clrset_'.$tbn);
	msql_modif('users','public_design',dsnam_arr(desname($qb,$desgn)),'','one',$desgn);
	build_css('css/public_design_'.$tbn.'.css',$defs);
	alert('created: public_design_'.$tbn);}
if($_GET["make_admin"]){build_css('css/_admin.css',$defs);
	save_vars($basy,'default_css_3',$defs); 
	alert('modified: system/default_css_3, _admin.css');}
if($_GET["make_global"]){build_css('css/_global.css',$defs);
	save_vars($basy,'default_css_1',$defs);
	msq_copy('design',$f_clr,'system','default_clr_1'); 
	alert('modified: system/default_css_1, _global.css');}
if($_GET["make_default"]){build_css('css/_classic.css',$defs);
	save_vars($basy,'default_css_2',$defs);
	msq_copy('design',$f_clr,'system','default_clr_2');
	$defse=empty_design($defs,'clr'); build_css('css/_default.css',$defse);
	alert('modified: table system/default_css_2, _classic.css, _default.css (no colors)');}
//clrset
if($_GET["clrset"]){$_SESSION['clrset']=$clrset=$_GET["clrset"]; 
	$f_clr=$qb.'_clrset_'.$clrset;
	$_SESSION['clrs'][$prmd]=msql_read('design',$f_clr,'');
	build_css($basecss_temp,$defs);}
//import_clrset
if($_GET["import_clrset"]){
	$_SESSION['clrs'][$prmd]=explode("_",$_GET["import_clrset"]); 
	if($_SESSION["auth"]>=6)save_clr($qb.'_'.$clrset);}
if($_GET["add_clrset"])save_clr($qb.'_'.$_GET["clrset"]);
//reset
if($_GET["reset_clr"] or $_GET["add_design"]){
	$_SESSION['clrs'][$prmd]=msql_read('system',"default_clr_2",''); 
	save_clr($f_clr);}
if($_GET["reset_default"] or $_GET["add_design"]){
	$defs=css_default(); unset($defs['_menus_']);
	save_vars($base,$f_dsn,$defs); build_css($basecss_temp,$defs);}
if($_GET["reset_global"] or $_GET["add_design"]){
	$defs=css_default(1); unset($defs['_menus_']);
	save_vars($base,$f_dsn,$defs); build_css($basecss_temp,$defs);}
//public
if($pub=$_GET["public_clr"]){
	$_SESSION['clrs'][$prmd]=msql_read('design','public_clrset_'.$pub,'');
	save_clr($f_clr);}
if($pub=$_GET["public_design"]){
	$defs=msql_read('design','public_design_'.$pub,''); unset($defs['_menus_']);
	save_vars($base,$f_dsn,$defs); build_css($basecss_temp,$defs);}
//null
if($_GET["empty_design"]){$defs=empty_design($defs,'css');
	save_vars($base,$f_dsn,$defs); build_css($basecss_temp,$defs);}
if($pub=$_GET["null_clr"]){$_SESSION['clrs'][$prmd]=array('','','','','','','','');
	save_clr($f_clr);}
if($pub=$_GET["null_design"]){$defs=css_default(); $defs=empty_design($defs,'css');
	save_vars($base,$f_dsn,$defs); build_css($basecss_temp,$defs);}
//append
if($_GET["append"]){$defsc=css_default(); unset($defsc['_menus_']);
	$defs=array_append($defs,$defsc); save_vars($base,$f_dsn,$defs);
	build_css($basecss_temp,$defs);}
if($_GET["append_global"]){$defsc=css_default(); unset($defsc['_menus_']);
	$defs=array_append($defs,$defsc); save_vars($base,$f_dsn,$defs);
	build_css($basecss_temp,$defs);}
if($_GET["inject_global"]){$defsc=css_default(); unset($defsc['_menus_']);
	$defs=append_design($defs,$defsc); save_vars($base,$f_dsn,$defs);
	build_css($basecss_temp,$defs);}
if($_GET["reset_this"]){$ec=$_GET["edit_css"];
	$defsc=css_default(); $ecb=find_value($defsc,$defs[$ec]);
	if($ecb){$defs[$ec]=$defsc[$ecb]; save_vars($base,$f_dsn,$defs);
	build_css($basecss_temp,$defs);}}
//restore_design
if($_GET["restore"]=="design"){
	$defs=read_vars($base,$f_dsn.'_sav',$defsb); unset($defs['_menus_']);
	save_vars($base,$f_dsn,$defs); build_css($basecss_temp,$defs);}
//restore_clrset
if($_GET["restore"]=="clrset"){
	$r=read_vars($base,$f_clr.'_sav',''); 
	foreach($r as $k=>$v)$clrst[]=$v[0];
	$_SESSION['clrs'][$prmd]=$clrst; save_clr($f_clr); 
	build_css($basecss_temp,$defs);}
//herits
if($_GET["herit_desgn"]){list($qbb,$nbd)=explode('_',$_GET["herit_desgn"]);
	$defs=read_vars($base,$qbb.'_design_'.$nbd,$defsb);
	//$_SESSION['clrs'][$desgn]=msql_read("design",$qbb.'_clrset_'.$nbd,'');
	//save_clr($f_clr);
	save_vars($base,$f_dsn,$defs); build_css($basecss_temp,$defs);}
if($_GET["herit_clrset"]){list($qbb,$nbd)=explode('_',$_GET["herit_clrset"]);
	$_SESSION['clrs'][$desgn]=msql_read("design",$qbb.'_clrset_'.$nbd,'');
	save_clr($f_clr); build_css($basecss_temp,$defs);}
//ff
if($_GET['addff']){$defs=defs_adder_ff($defs);
	save_vars($base,$f_dsn,$defs); build_css($basecss_temp,$defs);}
//save//add
if($_POST["save"] or $_GET["save_img"] or $_GET["save"]){
	$defs=save_defs($base,$f_dsn,$defs,$defsb["_menus_"]);
	build_css($basecss_temp,$defs);
	if($_POST["saveblocks"] or $_GET["save"])build_css($basecss,$defs);}
if($_GET["invert_clr"]){
	$_SESSION['clrs'][$prmd]=invert_defsclr();
	save_clr($f_clr); build_css($basecss_temp,$defs);}
//sav
if($_GET["erase"]){$defs=save_css_j_del($defs,$_GET["erase"]); 
	save_vars($base,$f_dsn,$defs);}
if($_GET["newfrom"]){$defs=save_css_newfrom($defs,$_GET["newfrom"]); 
	//if($newdiv=$_GET["newdiv"])$defs[$edit]=array($newdiv);
	save_vars($base,$f_dsn,$defs);}
if($_GET["atpos"]){$n=count($defs);
	$defs=save_css_displace($defs,$_GET["atpos"],$_POST["pos"]);
	if(count($defs)==$n)save_vars($base,$f_dsn,$defs);}
if($_GET['sav']){save_vars($base,$f_dsn.'_sav',$defs,1); save_clr($f_clr);}//_sav
if($_GET["apply"]){save_vars($base,$f_dsn,$defs); save_clr($f_clr);
	build_css($basecss,$defs); informe_config_design();}//informe_config_width($defs);
//build_css
if($_GET["build_css"]){build_css($basecss_temp,$defs);}
#body
$go='/?admin=css';
$ret.=lkc("txtcadr",$go,$f_dsn).' ';
$ret.=msql_desnam($qb,$desgn,'')."\n";
$ret.=hlpbt('design').' ';
$ret.=msqlink('design',$qb.'_design_'.$desgn).' ';
$ret.=lkc('popsav',"/?admin=console&exit_design==",pictxt('logout',nms(112)));
//$ret.=lj('popbt','page_deskbkg','desk').lj('popbt','popup_site___desktop_ok__autosize','site');
//icon('exit')
$ret.=br().br();
if(prmb(5))$ret.=picto(alert).helps('prmb5').br().br();
//$ret.=btn_switch('desgn',$prmd,'/?admin=css','live_edit');
$ret.=see_conds_b().' ';
//$ret.=lkc('txtx','/?admin=css&apply==cr_mod==','create conditionnal design').' ';
$ret.=hlpbt('designcond').br().br();
$ret.=btn("txtsmall","save:").' ';
$ret.=lkc('txtx',$go.'&sav==',"backup").' ';
if($_SESSION['prmd']!=$_SESSION['desgn'])
	$ret.=lkc('txtx',$go.'&apply==','test design '.$desgn).' ';
$ret.=lkc('txtx',$go.'&apply=save',nms(66).' (mods:'.prmb(1).')').' ';
$ret.=lkc("popsav",$go.'&save==',nms(57)).' ';
//$ret.=lkc("txtx",$go.'&save_inverted==','black').' ';
$ret.=br();
$ret.=btn("txtsmall",nms(111)).' ';//select
$ret.=lj("txtbox",'popup_styls___select','design:'.$desgn.'/clrset:'.$clrset).' ';
$ret.=lj('txtx','popup_styls___herit',$lh[3]).' | ';//herit
$ret.=lkc('txtx',$go.'&build_css==',nms(93)).' | ';//rebuild
//$ret.=lkc('txtx',$go.'&build_css==&cmpq==',"cmpq").' ';
$ret.=lj('txtx','popup_stylsff___1','@font-face').br();
$ret.=btn("txtsmall",nms(113)).' ';//make
$ret.=lkc('txtx',$go.'&new_from==',nms(44)).' ';
$ret.=lkc('txtx',$go.'&empty_design==',nms(46)).' ';
$ret.=lkc('txtx',$go.'&invert_clr==',nms(115)).' ';
$ret.=lkc('txtx',$go.'&make_public==',$lh[4]).' ';//make_public
$ret.=lkc('txtx',$go.'&make_public==&inform==',$lh[5]).' ';//inform_public
if($_SESSION['auth']>5){$r=msql_read('users',$qb.'_design',$desgn); 
	$desgname=$r[0]?$r[0]:$r['name'];
	if($desgname=='admin')$make='make_admin';
	elseif($desgname=='global')$make='make_global';
	else $make='make_default';
	$ret.=lkc('txtbox',$go.'&'.$make.'==',$make);}
$ret.=br();
$ret.=btn("txtsmall",nms(95)).' ';//restore
if(is_file($base.$f_dsn.'_sav.php'))
	$ret.=lkc('txtx',$go.'&restore=design','design').' ';//restore
$ret.=lkc('txtx',$go.'&restore=clrset','clr').' | ';
$ret.=lkc('txtx',$go.'&reset_default==',nms(96)).' ';//defaults
$ret.=lkc('txtx',$go.'&reset_clr==',"clr").' | ';
$ret.=lkc('txtx',$go.'&reset_global=1',"global").' ';
$ret.=lkc('txtx',$go.'&public_clr=1',"clr").' | ';
$ret.=lkc('txtx',$go.'&public_design=2',"public").' ';//public
$ret.=lkc('txtx',$go.'&public_clr=2',"clr").' | ';
$ret.=lkc('txtx',$go.'&null_design==',"null").' ';
$ret.=lkc('txtx',$go.'&null_clr==',"clr").br();
$ret.=btn("txtsmall",nms(92)).' ';//append
$ret.=lkc('txtx',$go.'&append==',nms(96)).' ';//default
$ret.=lkc('txtx',$go.'&append_global==',"global").' ';
$ret.=lkc('txtx',$go.'&inject_global==',$lh[9]).br();//inject_globals
$ret.=btn("txtsmall",nms(45)).' ';//see
$ret.=lkt('txtx',$basecss,$lh[10]).' ';
$ret.=lkt('txtx',$basecss_temp,$lh[11]).' ';
//$ret.=lkt('txtx',$f_clr,"clr").' ';
$ret.=lj('txtx','popup_styls___clr',"clrset").' ';
$ret.=btn('txtx',count($defs).' '.nms(117)).' ';
$ret.=btn('txtx',mkday(filemtime($base.$f_dsn.'.php'))).' ';
$ret.=br().br();
$ret.=f_inp_clr_manage_j().br();//colors
//plugin('csswidth'); $ret.=f_inp_widths($defs);//widths
if($defs)$ret.=f_inp_plugs($defs,$defsb["_menus_"],$edit,1).br().br();//edit_css
return $ret;}

#builders
function css_default($o=''){$o=$o?$o:'2';
return msql_read('system','default_css_'.$o,'');}

function save_clr($nod){$r=$_SESSION['clrs'][$_SESSION['prmd']]; 
if($r)foreach($r as $k=>$v)if($v)$rb[$k]=array($v); $rb[]=array();
if($rb)save_vars('msql/design/',$nod,$rb);}

function reorder_keys($r){
foreach($r as $k=>$v){if($k!='_menus_'){$i++; $k=$i;} $ret[$k]=$v;}
return $ret;}
//append
function array_pop_b($r,$va,$n){
foreach($r as $k=>$v){$i++; $ret[$i]=$v; if($k==$n){$i++; $ret[$i]=$va;}}
return $ret;}
function array_append($a,$b){
	foreach($b as $k=>$v){$n='';
	$ka=trim($v[0]).trim($v[1]).trim($v[2]);
		foreach($a as $kb=>$vb){
		$kba=trim($vb[0]).trim($vb[1]).trim($vb[2]);
		if($kba==$ka)$n=$kb;}
	if(!$n)$a=array_pop_b($a,$v,$k);}
return $a;}
//inject
function app_des_free($da,$db){
$a=explode(';',str_replace(array('; ',";\n","\n"),array(';',';',''),$da)); 
$b=explode(';',str_replace(array('; ',";\n","\n"),array(';',';',''),$db)); 
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
foreach($r as $k=>$v)
	if($p=='all')$r[$k]=array($v[0],$v[1],$v[2],'||','||','||','');
	elseif($p=='clr')$r[$k]=array($v[0],$v[1],$v[2],'||','||','||',$v[6]);
	elseif($p=='css')$r[$k][6]='';
return $r;}
function invert_defsclr(){
$r=$_SESSION['clrs'][$_SESSION['prmd']];
foreach($r as $k=>$v)if($v)$r[$k]=invert_color($v,0);
return $r;}

#colors

#clr_system

function charge_sets($d){//select-herit
$qb=$_SESSION['qb']; $go='/?admin=css&';
if($d=="herit")$ht="herit_";
$r=explore("msql/design/",'files',1); asort($r);
if($r){foreach($r as $k=>$v){$v=substr($v,0,-4); list($nd,$bs,$nb,$sv)=split("_",$v);
	if($sv!="sav" && $nd && is_numeric($nb) && 
	($nd==$qb or ($d=="herit" && ($nd=="public" or $_SESSION['auth']>6)))){
		$rb[$nd][$nb][$bs]=$nb;}}
$tab[]=array('hub','design','clrset');
if($rb)foreach($rb as $k=>$v){
	if(is_array($v)){$taba=''; $tabb='';
	foreach($v as $nb=>$bs){
	$ra=msql_read('users',$k.'_design',''); $na=$ra[$nb][0]?$ra[$nb][0]:$bs["design"];
	if($d=="herit")$nd=$k.'_'; else $nd=''; $tabt[$nb]=$nb;
	if($bs["design"])$taba[$nb]=lkc("txtbox",$go.$ht.'desgn='.$nd.$bs["design"],$na);
	if($bs["clrset"])$tabb[$nb]=lkc("txtbox",$go.$ht.'clrset='.$nd.$bs["clrset"],clrset_view($k.'_clrset_'.$bs["clrset"]));}
	if($taba)$nbd=count($taba); if($tabb)$nbc=count($tabb);
	if($d=="select"){$add=lkc("txtbox",$go.'desgn='.($nbd+1).'&add_design==',"add_design"); $adc=lkc("txtbox",$go.'clrset='.($nbc+1).'&add_clrset==',"add_colorset");}
	$tab[]=array(btn('txtcadr',$k),$add,$adc); $nb=count($taba);
	for($i=0;$i<=$nb;$i++){$tab[]=array($tabt[$i],$taba[$i],$tabb[$i]);}}}}
return scroll_b($tab,make_table($tab),20,320,320);}//txtblc//txtx

function clrset_view($d){
$r=msql_read('design',$d,'');
if(is_array($r))foreach($r as $k=>$v){
if($k>0){$sty='"style="color:#'.invert_color($v,1).'; background-color:#'.$v.'; ';
if(!$v)$v="none"; $ret.=btn($sty,"__").' ';}}
return $ret;}

function f_inp_clr_manage_j(){
$ndc=$_SESSION['clrset']?$_SESSION['clrset']:$_SESSION['prmd'];
$clr=msql_read('design',$_SESSION['qb'].'_clrset_'.$ndc,''); $nb=count($clr);
$clrn=array('',"bkg","border","bloc","identity","active","art_bkg","art_txt","txt");
for($i=1;$i<=$nb;$i++){$name=$i.($clrn[$i]?':'.$clrn[$i]:'');
$inp=input2('text','" size="5" id="colorpickerField'.$i,$clr[$i],'');
$ret.=div(atc('clrp').atd('colorpick'.$i).ats('color:#'.invert_color($clr[$i],1)),divs('background-color: #'.$clr[$i].';',$name.$inp));}
return $ret.br().ljb('txtbox','SaveClr',$nb,nms(57)).divd("clrreponse",'');}

#editor

//editor
function name_classe($p){
if($p[0])$t.="#".$p[0].' ';
if($p[1])$t.=".".$p[1].' ';
if($p[2])$t.=$p[2].' ';
return $t;}

function petit_clr($t,$clr){
if(!$t)$t=0; $a=explode("|",$t);
foreach($a as $v){if(!$v)$v="-";
$ret.=btn('" style="background:#'.$clr[$v].'; color:#'.invert_color($clr[$v],1).'; padding:0; float:left; width:8px;',$v);}
return $ret;}

function divname_cls($t){return 'css'.str_replace(array(".","#"," "),'',$t);}

function name_line_j($k,$p,$op,$clrb=''){
$csa='txtnoir'; $t=name_classe($p);
$css=$_GET["edit_css"]==$k?' active':'';
if($clrb==1)$clr=msql_read('system','default_clr_1','');
elseif($clrb==2)$clr=msql_read('system','default_clr_2','');
else $clr=$_SESSION['clrs'][$_SESSION['prmd']];
$sty='" style="float:left; text-align:left; margin:1px; width:';
if($k)$ret=toggle($csa.$css.$sty.'190px;','css'.$k.'_styls_edit_'.$k,$t);
else $ret.=btn($csa.$sty.'190px;',$t);
for($i=3;$i<6;$i++){$ret.=btn($csa.$sty.'50px',petit_clr($p[$i]?$p[$i]:"-",$clr));}
if($op){$pb=$p[6]!=''?str_replace('; ',';'.br(),stripslashes($p[6])):"-";
$ret.=btn($csa.$sty.'250px; text-align:left;',$pb);}
return divc('clear',$ret);}

function f_inp_plugs($r,$defsb,$edit,$op){
$ret=name_line_j(0,$defsb,$op).br();//keys
$ra=array('divs'=>$ret,'classes'=>$ret,'elements'=>$ret);
if($r){foreach($r as $k=>$v){$ret='<a name="'.$k.'"></a>';
	if($k){$ret.=name_line_j($k,$v,$op).br();//if(!$edit) 
	if($edit==$k)$t=f_inp_facilities($r,$edit); else $t='';}
$ret.=divd('css'.$k,$t);
if($v[0])$ra['divs'].=$ret; elseif($v[1])$ra['classes'].=$ret; 
elseif($v[2])$ra['elements'].=$ret;}}
return divs('min-width:440px',make_tabs($ra,'css'.$edit));}

#ajax

function clrpckr_layout(){
$nb=count($_SESSION['clrs'][$_SESSION['prmd']]);
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
$ret.="
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
function styls($d,$edit){$qb=$_SESSION['qb']; $base='msql/design/';
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
$ndc=$_SESSION['clrset']?$_SESSION['clrset']:$_SESSION['prmd'];
$nod=$qb.'_design_'.$ndd; $ndc=$qb.'_clrset_'.$ndc;
if($d=="select" or $d=="herit")$ret=popup('select design',charge_sets($d),340);
if($d=="edit"){$rb=read_vars('msql/design/',$nod,'');
	$ret=f_inp_facilities($rb,$edit);}
//if($d=="css1")$ret=nl2br(read_file('css/'.$qb.'_design_'.$_SESSION['cond'][0].'.css'));
if($d=="css2")$ret=nl2br(read_file('css/'.$nod.'.css'));
if($d=="clr"){$r=msql_read_b('design',$ndc);}
	if($r)$ret=popup('colors',make_table($r,'txtblc','txtx'),340);
return $ret;}

function save_css_j_del($r,$n){
foreach($r as $k=>$v)if($k!=$n)$ret[$k]=$v;
return $ret;}

function save_css_newfrom($r,$n){
foreach($r as $k=>$v){$i++;
	if($k==$n){$ret[$i]=$v; $i++; $ret[$i]=$v;}
	else $ret[$i]=$v;}
return $ret;}

function save_css_displace($r,$n,$p){$ra=$r[$n]; unset($r[$n]);
foreach($r as $k=>$v){$i++;
	if($k==$p){$ret[$i]=$ra; $i++; $ret[$i]=$v;}
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
$va=affect_rgba($va,$_SESSION['clrs'][$_SESSION['prmd']]); $ret=divc('console',$va);
$ret.=divb($r[1].'|'.$r[0],$va).divc('clear','').br().br();
return popup('test css '.$k,$ret,320);}

function save_css_j($k,$v,$c){//facil_css//stylsav
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
$base='msql/design/'; $nod=$_SESSION['qb'].'_design_'.$ndd;
if($_SESSION['desgn'])$nodb=$_SESSION['qb'].'_design_dev_'.$ndd; else $nodb=$nod;
$defs=read_vars($base,$nod,'');
if($c==1)$defs=save_css_clr($defs,$k,$v);//clr
elseif($c==2)$defs=save_css_bkg($defs,$k,$v);//img
elseif($c==3)$defs=save_css_clname($defs,$k,$v);//classname
elseif($c==4)return save_css_tst($defs[$k],$k,$v);//tst
//elseif($c=='x')$defs=save_css_j_del($defs,$k);//del
else $defs=save_css($defs,$k,$v);//css
if($defs){save_vars($base,$nod,$defs); build_css('css/'.$nodb.'.css',$defs);}
return f_inp_facilities($defs,$k);}

function save_css_bkg($defs,$k,$v){$val=$defs[$k][6];
$css='background-image:url(/'.$v.'); ';
if(strpos($val,"background:url")!==false){
$defs=modif_css($defs,$k,"background:url",";",$css);}
else{$defs=modif_css($defs,$k,"background-image:",";",$css);}
return $defs;}

#font-face
function css_ff($v){$f='/fonts/'.$v;//$f=fonts_link($v);
$ret="font-family: '".str_replace('-webfont','',$v)."'; src: url('".$f.".eot?iefix') format('eot'), url('".$f.".woff') format('woff'), url('".$f.".svg#".$v."') format('svg');";//src: url("'.$f.'.eot");, url("'.$src.'.ttf") format("truetype")
return $ret;}

function valid_formats($va){$f='fonts/'.$va; $r=array('.woff'=>'Firefox/Chrome','.eot'=>'IE','.svg'=>'Safari/mobiles','.ttf'=>'browsers');
foreach($r as $k=>$v){if(is_file($f.$k))$ret.=btn('txtsmall" title="'.$v,$k).' ';}
return $ret;}

function preview_ff_edit($k,$c,$p,$fb){$fb=ajxg($fb);
if($k)$r=msql_read('server','edition_typos',$k);
if($c=='acc' && $p)$r['accents']=($p=='no'?1:'');
if($c=='fav' && $p)$r['fav']=($p=='no'?1:'');
if($c=='cat' && $fb && $fb!='-'){$r['category']=$fb;
	if(!$_SESSION['fntcat'][$fb])$_SESSION['fntcat'][$fb]=1;}
if($k && $_SESSION['auth']>5)modif_vars('server','edition_typos',$r,$k);
foreach($r as $ka=>$v){$rb[]=$v;}
return preview_ff_p($k,$rb,$pn,$p);}

function font_source($v){
if($v==1)return lkt('txtsmall2','http://fontsquirrel.com/fontface','fontsquirrel').' ';
if($v==2)return lkt('txtsmall2','http://fontspring.com/fontface','fontspring').' ';
if($v==3)return lkt('txtsmall2','http://new.myfonts.com/','myfonts').' ';}

function font_set_cat($k,$v,$go){
$ret=br(); $ml['-']=1; if($_SESSION['fntcat'])$ml+=$_SESSION['fntcat'];
$ret.=select(' style="width:80px;" onchange="jumpslct(\'fntcat'.$k.'\',this)"',$ml,'kk');
$ret.=input2('text','fntcat" size="8" id="fntcat'.$k,$v,'');
$ret.=lj('popsav',$go.'_cat___fntcat'.$k,'ok').' ';
return $ret;}

function preview_ff_p($k,$v){$go='fnt'.$k.'_ffedit___'.$k;
$f='fonts/'.$v[0].'.woff'; if(is_file($f))$sz=round(filesize($f)/1000);
$ret.=$v[0].' '.lkc('txtbox','/?admin=css&addff='.$v[0],pictxt('add','Add')).' '.$sz.'Ko ';
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
$str=$_SESSION['ffstr']?$_SESSION['ffstr']:'AaBbCcDdEe0123יא;!';
//$seeall=lj('txtx','pop_stylsall___','set');
$opt=div(atd('fnt'.$k),preview_ff_p($k,$v)).br().br();
return divs('font-family:'.$nm.'; font-size:'.$c.'px; line-height:'.round($c*1.2).'px;',$str).br().$opt;}

function css_fontface($p,$b,$c,$o,$s,$u){//page,cat,size,opt 
$csa='txtx'; $csb='txtred'; $jx='pop_'; if(!$b)$b='all';
$r=msql_read('server','edition_typos','',1); $n=count($r); asort($r);
$rb['all']=1; $b=$b==''?'unclassed':$b; $gf='stylsff___'; $s=substr($s,0,-1);
if($s)$o='rch'.$s;
if(!is_file('msql/server/edition_typos.php'))$ret.=lkc('txtyl','?admin=fonts','update server_table').br().br();
//rb//rd
$ard=array('','fontsquirrel','fontspring','myfonts');
if($r)foreach($r as $k=>$v){if($v[1])$rb[$v[1]]=1; 
	if(is_numeric($v[4]))$rd[$v[4]]=$ard[$v[4]];} // else $rd[$v[4]]=$v[4];
$rb['unclassed']=1; ksort($rb); $_SESSION['fntcat']=$rb;
//cat
if($b && $b!='unclassed' && $b!='all')$hlp=divc('panel',helps($b,'typos')).br();
foreach($rb as $k=>$v){
$mnu.=lj(($k==$b?$csb:$csa),$jx.$gf.'1_'.ajx($k).'_'.$c.'_'.$o,$k).' ';}
$mnu.=br(); $b=$b=='unclassed'?'':$b;
$pk=substr($o,0,3); $pv=substr($o,3); if($pv)$pp[$pk]=$pv;
//rech
$srch.=input2('text','srch" size="8" id="srchfnt',($pp['rch']?$pp['rch']:'search'),'');
$srch.=' '.lj('popbt',$jx.$gf.'1_'.$b.'_'.$c.'_'.$o.'_srchfnt','ok').' ';
$srch.=lj('popbt',$jx.$gf.'1_all','x');
//tri
foreach($r as $k=>$v){
if(!$pv or (($pp['acc'] && $pp['acc']==$v[2]) or ($pp['fav'] && $pp['fav']==$v[3]) or ($pp['fam'] && $pp['fam']==$v[4]) or ($pp['rch'] && stristr($v[0],$pp['rch'])!==false))){
	if($v[1]==$b or $b=='all')$rc[$k]=$v;}}
$n=count($rc);
//pages
$no=20; $np=10; $min=$p-$np; $max=$p+$np; $nb=ceil($n/$no); 
$bb=ajx($b);
for($i=1;$i<=$nb;$i++){if($i==1 or $i==$nb or ($i>$min && $i<$max))
	//$rtp.=lj(($i==$p?'active':''),$jx.$gf.$i.'_'.$bb.'_'.$c.'_'.$o,$i);
	$rtp.=lj(($i==$p?'active':''),$jx.$gf.$i.'_'.$bb.'_'.$c.'_'.$o,$i).' ';
	if(($i==2 && $min>2) or ($i==$nb-1 && $max<$nb-1))$rtp.='... ';}
$nbp=divc('nb_pages',$rtp); $c=(is_numeric($c)?$cb=$c:48);
$arz=array(12,24,36,48,72);
foreach($arz as $k=>$v){//size
$siz.=lj(($v==$c?$csb:$csa),$jx.$gf.$p.'_'.$b.'_'.$v.'_'.$o,$v).' ';}
//label
$go=$gf.$p.'_'.$bb.'__';
if($rd)foreach($rd as $k=>$v){
$prp.=lj(($pp['fam']==$k?$csb:$csa),$jx.$go.'fam'.($pp['fam']==$k?'':$k),$v).' ';}
$prp.=lj(($pp['acc']?$csb:$csa),$jx.$go.'acc'.($pp['acc']?'':1),'accents').' ';
$prp.=lj(($pp['fav']?$csb:$csa),$jx.$go.'fav'.($pp['fav']?'':1),'favs').' ';
//render
$max=$p*$no; $min=$max-$no;
if($rc)foreach($rc as $k=>$v){$ia++; if($ia>=$min && $ia<$max && $v[0]){
	$rta.='@font-face {'.css_ff($v[0]).'}'."\n"; $rtb.=preview_ff($k,$v,$c);}}
$ret.=css_code($rta).$mnu.$hlp.$siz.$prp.$srch.br().br();
$ret.=input(1,'ffwr',$_SESSION['ffstr']?$_SESSION['ffstr']:'AaBbCcDdEe0123יא','" size="44');
$ret.=lj('txtx','ffwr_sesmake_ffwr__ffstr','set');
$ret.=divd('scroll',divd('pop',$nbp.br().$rtb.$nbp)).br();
if($u)return popup('create font-face',divs('width:640px;',$ret)); 
else return css_code($rta).$nbp.br().$rtb.$nbp;}

function defs_adder_ff($r){
$ra=array('','','@font-face','','','',css_ff($_GET['addff']));
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
$w=obtain_values($defs,array("#page"),"width:",";");
$w-=obtain_css_widths($defs,array("#page"),"padding:");
$r=define_modc_b('system');
foreach($r as $k=>$v)if($v[0]=='content'){modif_vars('users',ses('modsnod'),$w,$k);
$_SESSION['mods']['content'][$k]=$w;}}

function informe_config_design(){
$cnd=$_SESSION['cond']; $cndb=$cnd[1]?$cnd[1]:$cnd[0]; $r=define_modc_b('system');
foreach($r as $k=>$v)if($v[0]=='design'){
	$v[1]=$_SESSION['desgn']; $_SESSION['prma'][$v[0]]=$v[1];
	//if($_GET['cr_mod'] && $v[3]!=$cndb){$v[3]=$cndb; $k='push';}
	if($k=='push')$_SESSION['mods']['system'][]=$v; else $_SESSION['mods']['system'][$k]=$v;
	array_unshift($v,'system');
	if($_GET["apply"]=='save')modif_vars('users',$_SESSION['modsnod'],$v,$k);}}

# facilities
function treat_funcs_bkgs($j,$k,$v,$i){if($v)return $j.'/'.$v.'#';}
function facil_fonts($defs,$k,$url){
foreach($defs as $ka=>$va){
	if(strpos($va[6],'font-family')!==false){$va=name_classe($va);
	if($va!='@font-face')$mnu_divs[$ka]=$va;}}
$ff=embed_detect($val,'font-family:',';','');
$ff=str_replace(array(" ","'",'"'),'',$ff);
$t.=hidden('facefont','',$ff);
$t.=select(atn('applyfont'),$mnu_divs,'kv',$t_size);
$t.=input2('submit','save',"Apply_font",'').br();
return form($url.'#'.$k,$t);}
	
function facil_images($k,$url,$val){
$ret.=btn('txtx',toggle('','bkg'.$k.'_dsnav_bkg_'.$k,'backgrounds')).' ';
if(strpos($val,':url(/')!==false)$ret.=lkc("txtred",$url.'&save_img='.$k.'&erase_img==','delete_background');
$ret.=btd('bkg'.$k,'');
	$mnu_bkg=array('',"no-repeat","repeat-x","repeat-y","repeat");
	$mnu_im_align=array('',"left","right","center");
	$mnu_im_valign=array('',"top","bottom","center");
	if(strpos($val,"background:url")!==false){
		$t_ims=embed_detect($val,"background:url",";",'');}
	list($urb,$reap,$fixd,$alg,$vlg)=explode(" ",$t_ims);
	if($fixd){$chk=' checked';}
	if($urb){$urb=substr($urb,1,-1); $ret.=lkt('txtx',$urb,'open').br();}
	$mnu.=select(atn('repeat'),$mnu_bkg,'vv',$reap).' ';
	$mnu.=select(atn('align'),$mnu_im_align,'vv',$alg).' ';
	$mnu.=select(atn('valign'),$mnu_im_valign,'vv',$vlg).' ';
	$mnu.=checkbox('fixed','fixed','fixed',$chk);
//$upl=upload_btn('upl',$url.'&save_img='.$k,'upload').br();
return $ret.imgform($url.'&save_img='.$k,$mnu,'');}

function facil_names($defs,$k){
$sty='" size="20'; $ids='cl1'.$k.'|cl2'.$k.'|cl3'.$k;
$ret.=btn('txtsmall2','div:').input(1,'cl1'.$k.$sty,$defs[$k][0],'').br();
$ret.=btn('txtsmall2','class:').input(1,'cl2'.$k.$sty,$defs[$k][1],'').br();
$ret.=btn('txtsmall2','element:').input(1,'cl3'.$k.$sty,$defs[$k][2],'').' ';
$ret.=lj('popbt','css'.$k.'_stylsav____'.$k.'_3__'.$ids,'save').br().br();
return $ret;}

function select_clr($p,$n){//stylclr
$r=$_SESSION['clrs'][$_SESSION['prmd']]; $n=count($r);
for($i=0;$i<=$n;$i++){$t=mnu_line_t($r[$i],$i);
	$ret.=lj('','bt'.$p.'_stylsetclr___'.$r[$i].'_'.$i.'_'.$p,$t);}
return $ret;}

function mnu_line_t($clr,$t,$o=''){if($clr)$cb=invert_color($clr,1);
if($o)$s='border:1px solid gray; ';
return divs($s.'padding:2px 4px; color:#'.$cb.'; background-color:#'.$clr,$t);}

function mnu_line_bt($clr,$n,$p){//stylsetclr
$h=hidden('',$p,$n); $t=mnu_line_t($clr,$n);
return togbub('stylclr',$p.'_'.$n,$t).$h;}

function mnu_line_color($d,$p){$r=explode('|',$d);//txt|link|hover
$kr=$_SESSION['clrs'][$_SESSION['prmd']]; $n=count($klr);
for($i=0;$i<3;$i++){$clrn=$r[$i]=='undefined'||!$r[$i]?'0':$r[$i]; $nid=$i+1;
	$ret.=span(atc('cell').atd('bt'.$p.$nid),mnu_line_bt($kr[$clrn],$clrn,$p.$nid));}
return $ret;}

function facil_colors($defs,$k,$url){
$t=divc('row',btn('cell','').btn('cell','text').btn('cell','link').btn('cell','hover'));
$t.=divc('row',btn('cell','color').mnu_line_color($defs[$k][3],'clr'.$k));
$t.=divc('row',btn('cell','backg').mnu_line_color($defs[$k][4],'bkg'.$k));
$t.=divc('row',btn('cell','border').mnu_line_color($defs[$k][5],'bdr'.$k));
$ret=divc('table',$t);
foreach(array('clr','bkg','bdr') as $va){$rb.=$va.$k.'1|'.$va.$k.'2|'.$va.$k.'3|';}
$ret.=lj('popbt','css'.$k.'_stylsav____'.$k.'_1__'.$rb,'save').br();
return $ret;}

function facil_css($k,$url,$v){//save_css_j//stylsav
$v=str_replace("} ","}\n",$v);//smart_css//{{
$v=str_replace("; ",";\n",$v);
$t=f_inp_edit_css($k);
$t.=txarea('cssarea'.$k,$v,60,10,atc('console')).' ';
return form($url.'#'.$k,$t);}

function facil_globalc($k,$nc){$r=css_default(1);
$ret.=btn('txtcadr','herit from _global.css').' ';
$ret.=msqlink('design','public_design_1').br().br();
if($r)foreach($r as $k=>$v){$ncb=name_classe($v);
	if($ncb==$nc)$ret.=name_line_j($k,$v,1,1);}
return $ret;}

function facil_reset($k,$nc){$ret.=btn('txtcadr','default').' ';
$ret.=lkc('txtx','/?admin=css&edit_css='.$k.'&reset_this==#'.$k,'reset').br().br();
$r=css_default();
if($r)foreach($r as $k=>$v){$ncb=name_classe($v);
	if($ncb==$nc)$ret.=name_line_j($k,$v,1,2);}
return $ret;}

function facil_pos($defs,$k){$u='/?admin=css&';
//$ret.=lkc("txtnoir",$u.'edit_css='.$k.'&append_this==#'.$k,'append_this').' ';
$ret.=lkc('txtyl',$u.'erase='.$k.'#'.($k-1),'delete').' ';
$ret.=lkc('txtbox',$u.'newfrom='.$k.'&edit_css='.($k+1).'#'.($k+1),nms(44)).' ';
foreach($defs as $ka=>$v){$rb[$ka]=name_classe($v);}
//$t.=btn('txtx','position:').menuder_form_kv($rb,'pos',$k,"kv");
$t.=btn('txtx','position:').select(atn('pos'),$rb,'kv',$k);
$t.=input2('submit','save',"ok");
$ret.=form($u.'&atpos='.$k,$t);
return $ret;}

function f_inp_facilities($defs,$k){
if(!$defs[$k])return;
$val=stripslashes($defs[$k][6]);//freecss
$nc=name_classe($defs[$k]);
$url='/?admin=css&edit_css='.$k; $end=divc('clear','');
$ret.=btn("txtcadr",trim($nc)).' '.btn('txtsmall2','#'.$k.'').' ';
$rt['classe']=facil_css($k,$url,$val).$end;//css_free
$rt['colors']=facil_colors($defs,$k,$url).$end;//colors
$rt['default']=facil_reset($k,$nc).$end;//reset
$rt['global']=facil_globalc($k,$nc).$end;//global
if($nc=="@font-face "){$ret.=facil_fonts($defs,$k,$url).$end;}//fonts
$rt['images']=facil_images($k,$url,$val).$end;//images
$rt['name']=facil_names($defs,$k);//classname
$rt['tools']=facil_pos($defs,$k).$end;//pos
//$ret.=divc('imgr',facil_pos($defs,$k));
$ret.=make_tabs($rt,'csf'.$k);
return div(atc('clear').ats('padding:10px; width:550px;'),$ret);}

function f_inp_edit_css($d){
$ret.=lj('','popup_plup___cssedit__'.$d.'_330',picto('plus')).' ';
$ret.=ljb('',"insert_b",'\n\',\'cssarea'.$d,picto('back')).' ';
$ret.=lj('','popup_stylsav_cssarea'.$d.'__'.$d.'_4',picto('export')).' ';
$ret.=lj('popsav','css'.$d.'_stylsav_cssarea'.$d.'__'.$d,'save').' ';
return divc('',$ret);}

#save
function defs_compiler($defs,$defsb){
foreach($defs as $k=>$v){
foreach($defsb as $ka=>$va){
if($_POST['erase_'.$k]=="ok"){unset($defs[$k]);}
elseif(($_POST[$va.'_'.$k]!=$v[$ka])){
$defs[$k][$ka]=$_POST[$va.'_'.$k];}}}
return $defs;}

function defs_addnew($r,$d,$ra){$ka=find_value($r,$r[$d]);
foreach($r as $k=>$v){if($ka==$k)$ret[]=$ra; if($v)$ret[]=$v;}
return $ret;}

function defs_adder($r,$defsb){$ret[]='';
foreach($defsb as $ka=>$va){
if($_POST[$va]!=$va) $ra[$ka]=$_POST[$va];}
if($_POST["divs"]!="0")$ra[0]=$_POST["divs"]; 
elseif($_POST["divs_"]!="div")$ra[0]=$_POST["divs_"];
if($_POST["clas"]!="0")$ra[1]=$_POST["clas"]; 
elseif($_POST["clas_"]!="class")$ra[1]=$_POST["clas_"];
if($_POST["elem"]!="0")$ra[2]=$_POST["elem"]; 
elseif($_POST["elem_"]!="element")$ra[2]=$_POST["elem_"];
//$ka=find_value($r,$r[$_POST['pos']]);
//foreach($r as $k=>$v){if($ka==$k)$ret[]=$ra; if($v)$ret[]=$v;}
$ret=defs_addnew($r,$_POST['pos'],$ra);
return $ret;}

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
$k=$_GET["save_img"];$val=$defs[$k][6];
if($_GET["erase_img"]!="ok"){
	if($_GET["im"]=="on"){$mg=save_img_b('css');}
	if($_GET["add_img"]){$mg=$_GET["add_img"];}
	$css='background-image:url('.$mg.'); ';}
if($_GET["im"]=="on"){	
$alg='background-position:'.$_POST["align"].' '.$_POST["valign"].'; ';
$rpt='background-repeat:'.$_POST["repeat"].'; ';
$fxd='background-attachment:'.$_POST["fixed"].'; ';
$defs=modif_css($defs,$k,"background-repeat:",";",$rpt);
$defs=modif_css($defs,$k,"background-position:",";",$alg);
$defs=modif_css($defs,$k,"background-attachment:",";",$fxd);}
if(strpos($val,"background:url")!==false){
$defs=modif_css($defs,$k,"background:url",";",$css);}
else{$defs=modif_css($defs,$k,"background-image:",";",$css);}
return $defs;}

function defs_fonts($defs){$k=$_GET["edit_css"];
	if($_POST["font"]){$css='font-family:'.$_POST["font"].';';
	$defs=modif_css($defs,$k,"font-family:",";",$css);}
	if($_POST["size"]){$css="font-size:".$_POST["size"].'px;';
	$defs=modif_css($defs,$k,"font-size:",";",$css);}
	if($_POST["align"]){$css="align:".$_POST["align"].';';
	$defs=modif_css($defs,$k,"align:",";",$css);}
return $defs;}

function defs_face($defs){$k=$_POST['applyfont'];
	if($_POST["applyfont"]){$css='font-family:'.$_POST["facefont"].';';
	$defs=modif_css($defs,$k,"font-family:",";",$css);}
return $defs;}

function defs_clrst($defs){$k=$_GET["edit_css"];
	$defs[$k][3]=$_POST["clr1"].'|'.$_POST["clr2"].'|'.$_POST["clr3"];
	$defs[$k][4]=$_POST["bkg1"].'|'.$_POST["bkg2"].'|'.$_POST["bkg3"];
	$defs[$k][5]=$_POST["bdr1"].'|'.$_POST["bdr2"].'|'.$_POST["bdr3"];
return $defs;}

function save_css($defs,$k,$v){
if($_POST['erase_'.$k]=="ok")unset($defs[$k]);
else{
$v=str_replace("}\n","} ",$v);//smart_css//{{
$v=str_replace(";\n","; ",$v);
$v=str_replace(array("\n","\r")," ",$v);
$defs[$k][6]=ereg_replace("[ ]{2,}"," ",$v);}
return $defs;}

function save_defs($base,$desgn,$defs,$defsb){
	if($_GET["save_img"])$defs=img_adder($defs);
	if($_POST["save"]=="save")$defs=defs_compiler($defs,$defsb);
	if($_POST["save"]=="apply_widths")$defs=defs_csswidths($defs);
	if($_POST["save"]=="save_fonts")$defs=defs_fonts($defs);
	if($_POST["save"]=="save_clrst")$defs=defs_clrst($defs);
	if($_POST["save"]=="save_css"){
		$defs=save_css($defs,$_GET['edit_css'],$_POST['free_css']);//obsolete
		if($_POST['erase_'.$_GET['edit_css']]=="ok")$relod='/?admin=css';}
	if($_POST["save"]=="add_css"){$defs=defs_adder($defs,$defsb); 
		$relod='/?admin=css&edit_css='.($_POST['pos']).'#'.($_POST['pos']);}
	if($_POST["save"]=="Apply_font"){$defs=defs_face($defs); 
		$relod='/?admin=css&edit_css='.($_POST['applyfont']).'#'.$_POST['applyfont'];}
	save_vars($base,$desgn,$defs); if($relod)relod($relod);
return $defs;}

#build
	
//building
function write_css_c($basecss,$r){
foreach($r as $k=>$v){
if($v[2] && $v[3]){
	if($v[1]=="a"){
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
$ret=str_replace(array(" ,","  ","a a"),array(","," ","a"),$ret);//clean
write_file($basecss,$ret);}

function write_css($basecss,$r){
if($r)foreach($r as $k=>$v){
	if($v[2] && $v[3]){$re[$v[0].$v[1]][]=$v[2].':'.$v[3].' ';}
	elseif($v[3])$re[$v[0].$v[1]][]=$v[3].'';}
if($r)foreach($re as $k=>$v){$ter='';//groupe par css
	foreach($v as $ka=>$va){
		if(strpos($k,"font-face"))$ret.=$k.' {'.$va.'}'."\n"; else $ter.=$va;}
	if($ter)$ret.=$k.' {'.$ter.'}'."\n";}
$ret=str_replace(array(" ,","  ","a a"," }"),array(","," ","a","}"),$ret);//clean//{{
write_file($basecss,$ret);}

function affect_rgba($d,$clr){
$r=explode('#',$d); $n=count($r); $clr[0]=''; for($i=0;$i<$n;$i++){
if(substr($r[$i],0,1)=='_'){$klr=str_until($r[$i],';,) '); $vlr=substr(trim($klr),1);
	if(strpos($vlr,'.')){list($abs,$alp)=explode('.',$vlr);
		$ret.=str_replace($klr,hexrgb($clr[$abs],$alp/10),$r[$i]);}
	else $ret.='#'.str_replace($klr,$clr[$vlr],$r[$i]);}
elseif($i)$ret.='#'.$r[$i]; else $ret.=$r[$i];}
return $ret;}

function build_css($basecss,$defs,$clr=''){unset($defs['_menus_']);
$clr=$clr?$clr:$_SESSION['clrs'][$_SESSION['prmd']];
$sheets=array(3=>"color",4=>"background-color",5=>"border-color",'');
$attributes=array('',"a","a:hover",'');
	if($defs)foreach($defs as $k=>$v){$css_name=name_classe($v);
	if($css_name!='#div .class element '){
		for($i=3;$i<6;$i++){
		$conn=explode("|",$v[$i]);
			for($o=0;$o<3;$o++){
				if(is_numeric($conn[$o]))$cur='#'.$clr[$conn[$o]].';';
				//elseif(is_numeric(hexdec($conn[$o])))$cur='#'.$conn[$o].';';
				elseif($conn[$o])$cur='#'.$conn[$o].';';
				else $cur='';
				$ret[]=array($css_name,$attributes[$o],$sheets[$i],$cur);}}
	$ret[]=array($css_name,'','',affect_rgba($v[6],$clr));}}
if($_GET["cmpq"])write_css_c($basecss,$ret); else write_css($basecss,$ret);
return $ret;}

?>