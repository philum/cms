<?php
#philum_admin_system 

#references
function conn_help(){$qb=ses('qb');
	$ret=helps('conn_help_txt');
	$ret=br().balc('blockquote','tabd',$ret).br().br();
	$arr=array('auto','basic','all','codeline',$qb);
	foreach($arr as $v){$d='lang'; $nod='connectors_'.$v;
	$r=msql_read($d,$nod,'',1); $nb+=count($r);
	$ret.=make_tables(array($v,'description'),$r,'txtred','txtblc').br();}
return $nb.' connectors'.br().$ret;}

#edit_microsql
//node_decompil($nod)
function node_decompil($d){$r=split_one('/',$d,1);
if(!$r[1])$r=array($r[0]?$r[0]:'users',$r[1]);
return $r;}

function edit_msql_sav($id,$rg,$res){$_GET['msql']=$id;
list($dir,$node)=node_decompil($id); $r=ajxr($res);
return modif_vars($dir,$node,$r,$rg);}

function edit_msql_del($id,$va){$arr=ajxr($res);
list($dir,$node)=node_decompil($id);
return modif_vars($dir,$node,$va,'del');}

function edit_microsql($nod,$r=''){
list($dir,$node)=node_decompil($nod);
$defs=$r?$r:msql_read_b($dir,$node,'');
if($defs)$ret=draw_table($defs,$nod,1);
return $ret;}

function edit_msql_j_defcons(){return 'line:1|line:last|line:title|del:|linewith:|boldline:1|linenolink:1|del-link:|striplink:|delconn:s|deltables|delqmark|delblocks|cleanmail|-??|???';}
function clean_code($d){if(strpos($d,'<')!==false)$d=parse($d); return stripslashes_b($d);}
function imput_good($k,$v){$v=clean_code($v); return goodarea_b($v,$k,'','',40,20);}

function edit_msql_j($nod,$va,$o,$ob){$qb=$_SESSION['qb']; $tg=$ob?'socket':'editmsql';
list($dir,$node)=node_decompil($nod); $nod=ajx($nod);
if($va=='add'){$keys='new_entry'; $r[$keys]=imput_good($keys,'');}
else{$ra=msql_read($dir,$node); if($ra['_menus_'])$ntkp=1;
	if($ra)$nxtk=msq_findnext_entry($ra,$ntkp); $idn=randid();
	if($ra){foreach($ra as $k=>$v){$i++; if($k==$va){$n=$i; $key=$k; $def=$v;}}
	$keys=array_keys($ra); $kyb=ajx($key); $na=$n-$ntkp;
	if($keys[$na-1] && $keys[$na-1]!='_menus_')
		$pn.=lj('txtx','popup_'.$tg.'__x_'.$nod.'_'.($keys[$na-1]),picto('left')); 
	if($keys[$na+1])$pn.=lj('txtx','popup_'.$tg.'__x_'.$nod.'_'.($keys[$na+1]),picto('right'));}
	$ra=msql_read($dir,$node,$key);//$v
	if(is_array($ra)){$i=0;//$r['_menus_']=imput_good($idn.'_menus_',$key);
		foreach($ra as $k=>$v){$kys[]=$idn.$k; $i++;
		if(substr($node,-7)=='defcons'){
			if($k=='post-treat')$opt=br().jump_btns($idn.$k,edit_msql_j_defcons(),'|'); 
			else $opt=''; if($k=='last-update')$v=date('ymdhi',time());}
		else $opt=msql_slct($idn,$k,$dir.'/'.$node.':'.($i-1));
		if(!is_array($v))$r[$k]=imput_good($idn.$k,msq_data($v)).$opt;}
	$keys=ajx(implode('|',$kys));}
	else{$keys=$idn.$k; $opt=msql_slct($idn,$k,$dir.'/'.$node.'-0');
		$r[$va-$ntkp]=imput_good($keys,$def).$opt; $keys=ajx($keys);}}
//render
$ret.=btn('txtbox',$key).br().br();
$ret.=on2cols($r,470,5);
if(auth(6)){
	$jx=$nod.'_'.$kyb.'_'.$ob.'__'.$keys;
	$btn.=lj('popsav',$tg.'_savmsql__x_'.$jx,nms(57)).' ';//sav
	$btn.=lj('popbt',$tg.'_savmsql___'.$jx,nms(66)).' ';//apply
	$btn.=lj('popdel',$tg.'_delmsql___'.$jx,pictit('del',nms(76))).' ';}//del
	$btn.=lj('popbt',$tg.'_savmsql__x_'.$nod.'_'.$nxtk.'___'.$keys,nms(44)).' ';//new
$btn.=$pn;
$ret=divs('padding-bottom:4px',btd('bts','').$btn).$ret;
return popup($dir.'/'.$node.'§'.$key,$ret,550);}

#editbrain
function editbrain($brd){//descript//goog
$qdu=$_SESSION['qdu'];$qb=ses('qb');
if($_POST['goog']!=''){$set='clr'; $modif=$_POST['goog'];}
if($_POST['keys']!=''){$set='dscrp'; $modif=$_POST['keys'];}
if($_POST['menus']!='' or ($_GET['admin']=='menus' && $_POST['Submit'])){
	$set='menus'; $modif=$_POST['menus'];}
if($set && $modif){//save
if($modif==' ')$modif=''; $modif=str_replace(array("\r","\n\n"),array("\n","\n"),$modif);
$mdfr=explode(',',$modif); foreach($mdfr as $k=>$v)$mdfr[$k]=trim($v); 
$modif=implode(",\n",$mdfr);
update('qdu',$set,$modif,'name',$qb);
relod('/?admin='.$brd.'&editor==#editor');}
if($brd=='descript'){//field
	$dscrp=sql('dscrp','qdu','v','name="'.$qb.'"');
	$tfield.='meta "description" in Home: [,]<br>';
	$tfield.=txarea('keys',($dscrp),60,10);}
if($brd=='google'){
	$gan=sql('clr','qdu','v','name="'.$qb.'"');
	$tfield.=lkc('txtx','https://www.google.com/webmasters/tools/home?hl=fr','google-site-verification').' '.btn('txtsmall','meta balise used by google').br();
	$tfield.=input2('text" size="40','goog',$gan,'txtblc');}
if($brd=='descript' or $brd=='google'){//form
	$ret=form('/?admin='.$_GET['admin'].'&editor==',$tfield.br().input2('submit','Submit" style="clear:left;',nms(27),''));}
return $ret;}

#codeline
//core
function core_view_edit($rb,$s){return on2cols(array('function'=>$rb[0],'variables'=>$rb[1],'usage'=>stripslashes($rb[2]),'return'=>$rb[3],'context'=>$rb[4]),300,5).
input(1,'crvw',str_replace(',','/',$rb[1]).'§'.$s.':core','txtx').
ljb('txtbox','jumpText_insert_b','crvw\',\'txarea','insert').br();}

function core_view($d,$s){$js='crv_call___admin_core*view_';
$r=msql_read('system','program_core','',1); $cat=msq_cat($r,4);
$ret.=slctmenusj($cat,$js,$d,' ').br();
if($d){$r=msq_tri($r,4,$d); $cat=msq_cat($r,0);
	if($s){$rb=$r[$cat[$s]]; return core_view_edit($rb,$s);}
	foreach($r as $k=>$v)$ret.=divc('row',lj('popbt','popup_callp___admin_core*view_'.$d.'_'.ajx($v[0],''),$v[0].'('.$v[1].')').btn('poph" title="returns: '.$v[3],$v[2]));}
return $ret;}

//conn
function conn_view($d,$s){$js='cnv_call___admin_conn*view_';
$r=msql_read('system','connectors_all','',1); $r=msq_tri($r,0,'embed'); $cat=msq_cat($r,2);
$ret.=slctmenusj($cat,$js,$d,' ').br().br(); $cat=msq_tri($r,2,$d);//p($cat);
if($d){$r=msq_tri($r,2,$d);
	if($s){$ret.=divc('',nl2br(stripslashes(msql_read('lang','connectors_all',$s)))).br();
	$ins='§'.$s.':conn'; if($_SESSION['cur_cl']=='template')$ins='[value'.$ins.']';
	$ret.=input(1,'cnvw',$ins,'txtx');
	$ret.=ljb('txtbox','jumpText_insert_b','cnvw\',\'txarea','insert').br();
	$ret.=btn('txtsmall2','use value§option if needed').br().br();}
	$ret.=slctmenusj($cat,$js.$d.'_',$s,br()).br();}
return $ret;}

//codeline_edit
function codeline_editor($d,$type,$slct){$_SESSION['cur_cl']=$type;
$r=msql_read('system','connectors_codeline','',1);
$rb=msql_read('lang','connectors_codeline','');
foreach($r as $k=>$v){$hlp='" title="'.$rb[$k];
$menu.=lj('txtx'.$hlp,'editcl_clview___'.$k.'_'.$type,$k).' ';}
$re['preview']=clview_basic($d,$type,$slct);
$re['codeline']=$menu.br().br().divd('editcl','').divd('seecl','');
if($type=='template'){$re['structure']=correct_txt($d,'','clpreview');
	$re['vars']=clview_vars();}
else{$re['core']=divd('crv',core_view('',''));}
$re['connectors']=divd('cnv',conn_view('',''));
$ret=make_tabs($re,'cdl');
return div(atc('imgr').ats('width:300px; padding:10px;'),$ret);}

//variables
function clview_vars(){$r=template_vars();
foreach($r as $k=>$v){$ret.=ljb('txtx'.$hlp,'insert_b',$v.'\',\'txarea',$k).' ';}
return $ret;}
//structure
function clpreview($v){$r=decompact_conn_b($v);
if($r[0])$ret.=divc('txtx',btn('txtblc','value').' '.$r[0]); 
if($r[1])$ret.=divc('txtx',btn('txtblc','option').' '.$r[1]); 
$ret.=divc('txtx',btn('txtblc','connector').' '.$r[2]);
return div(atc('txtbox').ats('margin:4px;'),$ret);}
//codeline
function clview($v,$t){
$p=msql_read('system','connectors_codeline',$v); $r=explode('§',$p);
$hlp=msql_read('lang','connectors_codeline',$v);
$val=$r[0].($r[1]?'§'.$r[1]:'').':'.$v; if($t=='template')$val='['.$val.']';
$ret=divc('',$hlp).br().input(1,'clvw',$val,'txtblc');
$ret.=ljb('txtbox','jumpText_insert_b','clvw\',\'txarea','insert').br();
return $ret;}
//clbasic_preview
function clview_basic_j($t,$s,$res){
list($p,$re)=ajxr($res); $re=ajx($re,1);//ajxr(
if(!$re)$re=msql_read('users',$_SESSION['qb'].'_'.$t,$s); //chrono('');
if($t=='template' && $re)$ret=correct_txt($re,'','codeline');//connectors
else $ret=cbasic($re,$p); //$tim=chrono('chrono');
if(strpos($ret,'<br')===false)$ret=nl2br($ret);
return divc('track',$ret).br().txarea('',$ret,40,5).$tim;}

function clview_basic($d,$type,$slct){
$type=ajx($type,''); $slct=ajx($slct,'');
$j='admin,pop,tri,mod,spe,art_clview*basic*j_'.$type.'_'.$slct.'_clvb|txarea';
$ret=input(1,'clvb','','txtblc').' '.ljc('popsav','clva',$j,'preview').br().br();
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

function data_brain_save($bs,$type,$slct,$msg){$dfb=array('function');
msql_modif('',$bs.'_'.$type,array(addslashes($msg)),$dfb,'one',$slct);}

function data_brain_sav($bs,$type,$res){list($slct,$msg)=ajxr($res);
$msg=str_replace('"',"'",$msg);
//save_in_datas($type,$slct,$msg);//if(!$forbid)
data_brain_save($bs,$type,$slct,$msg); 
return btn('txtyl','ok');}

function data_brain($type){$slct=$_GET['slct'];
if($_POST['titl'])$slct=$_POST['titl'];
$goto='/?admin='.($type=='template'?'templates':$type);
if($type=='template'){$lisb=array('articles','tracks','titles','pubart','book');
	$ret.=hlpbt('templates').' ';} else $ret.=hlpbt('clbasic').' ';
$ret.=btn_switch('pubase',1,$goto.'&slct='.$slct,'public').' ';
$bs=($_SESSION['pubase']?'public':ses('qb')); $nod=$bs.'_'.$type;
$ret.=msqlink('',$bs.'_'.$type).' ';
$ra=msql_read('',$nod,'',1); if($ra)$list=array_keys($ra); 
$csa=$_GET['local']?'popdel':'popsav';
if($lisb)$ret.=slct_menus($lisb,$goto.'&local=1&slct=',$slct,$csa,'popbt','v').' ';
$ret.=lkc('txtx',$goto.'&slct=new',picto('add')).br();
$csa=!$_GET['local']?'txtyl':'txtred';
if($ra)$ret.=slct_menus($list,$goto.'&slct=',$slct,$csa,'txtx','v').' ';
if($type!='template')$forbid=data_forbidden_names($slct,$nod); $ret.=$forbid.br();
if($_GET['erase'] && $slct){modif_vars('users',$nod,$slct,'del'); relod($goto);}
if($_GET['erase'] && $type=='template')$_SESSION['template'][$slct]='';
if($slct){//save
$msg=$ra[$slct]; $rmsg=array(addslashes($msg));
	if($slct=='pubart' && !rstr(55))$ret.=pictxt('alert','rstr(55)');
	if($slct=='tracks' && !rstr(65))$ret.=pictxt('alert','rstr(65)');
	if($slct=='titles' && !rstr(66))$ret.=pictxt('alert','rstr(66)');
	if($slct=='book' && !rstr(67))$ret.=pictxt('alert','rstr(67)');
if($_GET['mkpub'])modif_vars('users','public_'.$type,$rmsg,$slct);
if($_GET['mkpriv'])modif_vars('users',ses('qb').'_'.$type,$rmsg,$slct);
if($type=='template' && $_GET['local']){
	if($slct=='articles')$msg=template_art();
	elseif($slct=='meta')$msg=template_meta();
	elseif($slct=='rssin')$msg=template_rss();
	elseif($slct=='pubart')$msg=template_pubart();
	elseif($slct=='tracks')$msg=template_tracks();
	elseif($slct=='titles')$msg=template_titles();
	elseif($slct=='book')$msg=template_book();
	elseif($slct=='products')$msg=template_product();}
$ret.=codeline_editor($msg,$type,$slct);
if(!$_SESSION['pubase'] && !$_GET['mkpub'])
	$ret.=br().lkc('txtx',$goto.'&slct='.$slct.'&mkpub==','make public').' ';
elseif($_SESSION['pubase'] && !$_GET['mkpriv'])
	$ret.=br().lkc('txtx',$goto.'&slct='.$slct.'&mkpriv==','make private').' ';
$ret.=input(1,'titl',$slct).' ';
$ret.=lj('popsav','dtb_call__xd_admin_data*brain*sav_'.$bs.'_'.$type.'_titl|txarea',nms(57)).' '.btd('dtb','').' ';//sav
if($slct!='default')$ret.=lkc('txtyl',$goto.'&slct='.$slct.'&erase==','x').br();
$ret.=jmp_btn_cb().br(); 
$sj=sj('clva_call___admin,pop,tri,mod,spe,art_clview*basic*j_'.$type.'_'.$slct.'_clvb|txarea');
$ret.=txarea('txarea',stripslashes($msg),44,14,atc('console').atb('onclick',$sj));}
return divd('',$ret);}

function jmp_btn_cb(){
$r=array('?','!','+','-','_1','_PARAM','/','<-');
foreach($r as $va){if($va=="<-")$vb='\n'; else $vb=$va;
	$ret.=ljb('txtx','insert_b',$vb.'\',\'txarea',$va).' ';}
return $ret;}

//ban
function ban_sav($d){copy($d,'img/ban_'.ses('qb').'.jpg');return btn('txtyl','saved: '.$d);}
function ban_dir($id){
if(substr($id,0,4)=='http'){$d=read_file($id); 
	write_file('img/ban_'.ses('qb').'.jpg',$d);}
elseif($id && !is_numeric($id)){
	$dir='users/'; $dirb=ses('qb').'/'.$id.'/';
	$r=explore($dir.$dirb,'files',1);}
elseif($id){$dir='img/'; 
	$d=sql('img','qda','v','id='.$id); $r=explode('/',$d);}
if($r)foreach($r as $k=>$v){$im=$dirb.$v;
	if(strpos(' .jpg.png.gif',substr($v,-3))){$ret.=make_mini_b($im,'');
	$ret.=lj('txtbox','banslct_bansav___'.ajx($dir.$im,''),'select').br();}}
return $ret;}

function ban_slct(){
$ret=btn('small','ID, Url, or directory').' '.input(1,'banimart','').' ';
$ret.=lj('txtbox','banslct_banslct_banimart','open').br().br();
$ret.=divd('banslct',ban_dir(''));
return $ret;}

function favicon_sav($d){copy('imgb/icons/system/philum/16/'.$d.'.png','favicon.ico'); 
return btn('txtyl','saved: '.$d);}
function favicon_slct(){$dr='imgb/icons/system/philum/16';
$r=explore($dr,'files',1); $ret=btn('small','favicon').' ';
if($r)foreach($r as $k=>$v){$v=strdeb($v,'.'); $ico=icon($v.'§system/philum/16').' ';
	$ret.=lj('','favc_call__xd_admin_favicon*sav_'.$v,$ico);}
return $ret.divd('favc','');}

function set_password($USE){
if($_POST['oldpassw']==sql('pass','qdu','v','name="'.$USE.'"')){
	update('qdu','pass',$_POST['passw'],'name',$USE);}
$valu=input2('text','oldpassw','old_password'.'" maxlength="50').'|';
$valu.=input2('text','passw','new_password" maxlength="50').' ';
$valu.=input2('submit','Submit','ok','');
if(auth(7) && get('seepass'))$ret=make_table(sql('name,pass','qdu','vv',''));
return form($goto,$valu).$ret;}

function set_ban(){$banim='img/ban_'.$_SESSION['node_clr'].'.jpg';
if(file_exists($banim)){list($ban_w,$ban_h)=getimagesize($banim);
$ret.=lkt('',$banim,image($banim,($ban_w/2),($ban_h/2))).' ';
$ret.=lkc('txtblc','/?admin=banner&add_ban=ko','delete').br().br();}
if($_GET['add_ban']=='ko'){unlink('img/ban_'.$_SESSION['node_clr'].'.jpg');relod('/?admin=banner');}
$ret.=imgform('/?admin=banner&mode=banim','','(jpg or png!)').br();
return $ret.ban_slct().favicon_slct();}

//sqladmin
function backups($wh,$bkf,$rep,$qb){
	$pba=$_SESSION['qd'].'_art';
	$pbt=$_SESSION['qd'].'_txt';
$arr=array('ib','name','mail','day','nod','frm','suj','re','lu','img','thm','host');
$arb=array('id','msg');
	$bckup='INSERT INTO `'.$pba.'` (id,'.implode(',',$arr).') VALUES ';
	$bckub='INSERT INTO `'.$pbt.'` ('.implode(',',$arb).') VALUES ';
$rq=sql('*','qda','q',$wh.'id>'.$bkf);
while($row=mysql_fetch_array($rq)){$part='';  
	$row['msg']=sql('msg','qdm','v','id='.$row['id']);
	foreach($arr as $val){$part.=str_replace("'","''",$row[$val])."', '";}
	if($_POST['no_id']!='ok')$rid=$row['id'];
	$bckup.="('$rid', '".substr($part,0,-3)."),"."\n";
	$bckub.="('$rid', '".str_replace("'","''",$row['msg'])."'),"."\n";}
$bckup=substr($bckup,0,-2).';';
$bckub=substr($bckub,0,-2).';';
$fa=$rep.'/'.$qb.'_backup_'.$_SESSION['qda'].'_from_'.$bkf.'.txt';
$fb=$rep.'/'.$qb.'_backup_'.$_SESSION['qdm'].'_from_'.$bkf.'.txt'; 
//chmod($fa,0777); 
$err=write_file($fa,$bckup); 
$erb=write_file($fb,$bckub); 
//$ret=txarea('insertsql',$bckup,'70','15',atc('console'));
if(!$err){$ret=lkc('txtyl',$fa,$fa).br();}
if(!$erb){$ret.=lkc('txtyl',$fb,$fb);}
return $ret;}

//conditions
function see_conds_b(){$go='/?admin='.$_GET['admin']; 
if($cnd=$_GET['set_cond']){$_SESSION['cond']=determine_cond($cnd); define_modc(); define_prma();
	if($_GET['admin']=='css')relod('/?admin=css&desgn='.$_SESSION['prmd']);}
$r=$_SESSION['mods']['system']; $cnd=$_SESSION['cond'];
$ra=array_flip(array('','home','cat','art'));
if($r){foreach($r as $k=>$v)$ra[$v[3]]+=1;
foreach($ra as $k=>$v)if($k){$c=$k==$cnd[0] && !$cnd[1]?'active':'';
$ret.=lkc($c,$go.'&set_cond='.$k,$k);}}
if($ret){$all=lkc($cnd[0]==''?'active':'',$go.'&set_cond=all',nms(100));
return btn('nbp',$all.$ret).hlpbt('console_cond').' ';}}

#css_builder
function adm_css(){req('styl'); //echo js_link('js/live.js');
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
if(!$_SESSION['desgn'])$ret=divc('tab',helps('public_design')).br();
$r=msql_read_b('design',$_SESSION['qb'].'_design_'.$ndd); 
if($r)unset($r['_menus_']);
return $ret.divd('scroll',f_inp_plugs($r,'','',0));}

function desname($qb,$desgn){$r=msql_read('users',$qb.'_design',$desgn); 
return $r[0]?$r[0]:$r['name'];}
function dsnam_arr($res){$md=prmb(1);
return array($res,array_part($_SERVER['HTTP_HOST'],'.',0),date('ymdHi',time()),$md);}
function msql_desnam($qb,$desgn,$res){
$jv='admin_msql*desnam_'.$qb.'_'.$desgn;
if($res)$res=ajxg($res); $ret=desname($qb,$desgn);
if($res=='init')return formj('rnt',$jv,'',$ret?$ret:'table_name');
$defb=array('_menus_'=>array('name','site','last-update','mods'));
$r=dsnam_arr($res);
if($res && $res!='init'){msql_modif('users',$qb.'_design',$r,$defb,'one',$desgn);
	return formj('rnt',$jv,$res,'');}
return formj('rnt',$jv,$ret,'');}

function formj($id,$jv,$p,$v){
if(!$p){static $i; $i++; $ret.=input(1,'inp'.$i,$v,'').' ';
$ret.=ljc('txtbox',$id,$jv.'_inp'.$i,'ok');}
else $ret=ljc('txtblc',$id,$jv.'_zero',$p);
return hidden('','zero','init').btd($id,$ret);}

function adm_colors(){return balb('iframe',' src="plug/clrset.php" frameborder="0" width="700" height="220"','');}
function adm_finder($p,$o){if(!$p){$p=ses('qb'); $o='disk';}
	return divs('min-width:550px;',call_finder($p,$o));}
function adm_share(){return plugin('share','','');}
function adm_msql(){return iframe('/?msql=/&wsz=700§720/500');}
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
save_vars('msql/server/','edition_typos',$rb);
save_vars('msql/system/','edition_typos',$rb);
$ret.='table server/edition_typos updated'.br().br();
$ret.=count($add).' elements added: '.br().($add?implode(br(),$add).br():'').br();
$ret.=count($del).' elements deleted:'.br().($del?implode(br(),$del).br():'').br();
return $ret;}

function inject_typos($v){$dr='plug/tar/'; include($dr.'pclerror.lib.php'); 
include($dr.'pcltrace.lib.php');include($dr.'pcltar.lib.php');
PclTarExtract($v,'fonts','','');
return lka($v).' installed'.br();}

function edit_fonts(){$dir='users/'.ses('qb').'/fonts';
$ret.=divc('panel',helps('fontserver')).br();
if($_GET['install_packfont'])$ret.=inject_typos($dir.'/'.$_GET['install_packfont']);
if($_GET['inject'])$ret.=inject_fonts().br();
$r=explore($dir); if($r)$ret.='packages_found: ';
if($r)$ret.=slct_menus($r,'/?admin=fonts&install_packfont=','','txtx','txtx','v').br().br();
$ret.=lkc('txtbox','/?admin=fonts&inject==','inject').' ';
$ret.=lkt('txtx','/plug/addfonts','add_from_web').' ';
$ret.=lj('txtx','popup_stylsff___1','Font-Face').' ';
$ret.=msqlink('server','edition_typos');
return $ret;}

function adm_newsletter($ok){req('adminx'); 
$t='newsletter'; $voc=helps('see_'.$t,$t);
$r['batch']=call_plug_f('popsav','popup',$t,'batch','',nms(28)).' ';
$r['batch'].=call_plug('txtbox','popup','mailist','read',$voc).' ';
$r['batch'].=msqlink('users',ses('qb').'_mails');
$r['mails']=plugin($t,'edit');
$r['edit']=divd('modules'.$t,console_block($t,1));
return make_tabs($r,'nl');}

#adm
function adm_messages(){require_once('art.php'); require_once('spe.php');
	if($_SESSION['auth']<1)return contact(nms(84),'txtcadr');
	elseif($_SESSION['auth']>6)$ml=ses('qb'); else $ml=ses('USE');
	$r=read_idy($ml,'DESC'); return divs('width:550px;',output_trk($r));}

function adm_admin($adm,$va){
$st=$_SESSION['admin']?$_SESSION['admin']:'=';
return iframe('index.php?admin='.($adm?$adm:$st).'§680/500');}

function adm_console($d){req('adminx');
if($d && !is_numeric($d) && auth(6))return divd('modules'.$d,console_block($d,1));
$ret.=see_conds_b();//conditions
$ret.=select_mods_m();//mods
if($d>=6)$ret.=backup_console().br();
$ret.=console_nav().divc('clear','');
return $ret;}

function adm_editor(){return iframe('plug/editor.php§640/500','');}
function adm_plugin(){return plugin('index');}
//function adm_msql_b(){req('msql'); return msql_adm('users');}

function hublist(){if(!auth(7))$wh='active=1';
$r=sql('name,hub,active','qdu','',$wh);
if($r)foreach($r as $k=>$v)$ret[]=array(lkc('','/'.$v[0],$v[1]?$v[1]:$v[0]),offon($v[2]));
return make_table($ret);}

function adm_hubs($auth){$goto='/?admin=hubs';
$qb=ses('qb'); $qdu=ses('qdu'); $USE=ses('USE');
	if($mna && $auth>=5)$mna=$_SESSION['mn']+$mna; else $mna=ses('mn');
	//if($mna)$ret.=balc('ul','panel',m_nodes_b($mna,1));
	$ret.=hublist().br();
	if(($auth>=6 && prms('create_hub')=='on') or $auth>=7){
	$ret.=loged('','','create new hub').br();}
if($_GET['rename_hub'] && $auth>=5){//renmae_hub
	if($_POST['hub_name']){
		$newname=trim($_POST['hub_name']);
		$_SESSION['mn'][$qb]=$newname;
		update('qdu','hub',$newname,'name',$qb);}	
	$valu=input2('text','hub_name',$_SESSION['mn'][$qb],'txtx');
	$valu.=input2('submit','Submit','rename_hub','');
	$ret.=form($goto.'&rename_hub==',btn('panel',$valu)).br();}
elseif($auth>=5) $ret.=lkc('popsav',$goto.'&rename_hub==',nms(87)).' ';
//kill_hub
if($auth>=6 && $_GET['kill_hub']=='ok'){$f='users/'.ses('qb');
	walk_dir($f,'remove'); rmdir($f);
	$f='msql/users/'.$qb.'_cache.php'; if(is_file($f))unlink($f);
	for($i=1;$i<10;$i++){
		$f='msql/design/'.$qb.'_design_'.$i.'.php'; if(is_file($f))unlink($f);
		$f='msql/design/'.$qb.'_clrset_'.$i.'.php'; if(is_file($f))unlink($f);
		$f='msql/users/'.$qb.'_mods_'.$i.'.php'; if(is_file($f))unlink($f);}
	msquery('DELETE FROM '.$qdu.' WHERE name="'.$qb.'" LIMIT 1');
	$_SESSION['USE']=''; relod(subdom(prms('default_hub')));}
//reinit_hub
if($auth>=6 && $_GET['reinit_hub']=='ok')makenew(ses('qb'),1);
//publish
if($auth>=6){
	if($_GET['publish']){
		if($_GET['publish']=='off')$actv=0; else $actv=1;
			update('qdu','active',$actv,'name',$qb);}
		$opened=sql('active','qdu','v','name="'.$qb.'"');
		if($opened=='1'){$ere='off';$st=nms(130);}else{$ere='on';$st=nms(131);}
	$ret.=lkc('popsav',$goto.'&publish='.$ere.'#'.$id,offon($opened).' '.$st).' ';
	$ret.=lkc('popsav',$goto.'&reinit==',nms(95).' '.nms(103)).' ';}
if($_GET['reinit']=='=')$ret.=btn('txtx','restore all defaults ?').lkc('txtyl',$goto.'&reinit_hub=ok','ok').' ';
if($auth>=6){$ret.=lkc('txtyl',$goto.'&kill_hub==',nms(76).' '.nms(100)).' ';
	if($_GET['kill_hub']=='=')$ret.=btn('txtx','All datas will be lost').lkc('txtyl',$goto.'&kill_hub=ok','ok');}
return $ret.br();}

function adm_nodes($auth,$goto){connect();
$valu=autoclic('qd','node','15','255','').' ';
$valu.=submitj('txtbox','create_node','create_node');
$ret.=form($goto.'&node=install" id="create_node',btn('panel',$valu)).br();
$ret.='this will create a new Node of Hubs, at url: /?qd=node'.br();
$ret.='write $qd="pub"; in _connectx to assign a domaine name to this node'.br().br();
$dblist=lstrc(rcptb($db)); //p($dblist);	
if(is_array($dblist) && auth(7)){
	foreach($dblist as $k)$qds[substr($k,0,strpos($k,'_'))]+=1;
	foreach($qds as $k=>$b){$csb=$k==$_SESSION['qd']?'active':'';
		if($k)$ret.=lkc($csb,'/?qd='.$k,$k).br();}}
	if($_GET['node']=='install'){$_SESSION['first']=1; 
		$ret.=plugin('install',$_POST['qd']);}
return $ret;}

function adm_restrictions(){req('adminx');
$edt=div('',edit_rstr()).br();
$prm=show_params($_GET['slct'],$_GET['restrict'],'');
return $edt.divd('rstr',$prm);}

function adm_disk(){return plugin('disk','','');}

function adm_edit_plug(){}

//update
function update_ok(){$ret.=lkc('popbt','/?id==',helps('update_ok')).' ';
if($_SESSION['dlnb'])$ret.='('.$_SESSION['dlnb'].' '.nms(52).')'.br().br();
$upd=helps('update_ok_alert'); if($upd)$ret.=divc('alert',ico('alert').' '.$upd).br();
$patch='160101';
if($patch){$pok=msql_read('server','program_patches',$patch);
	if($pok==0)$ret.=lkc('popdel','/admin/update','patch!').br();}
$ret.=adm_update_notes($_SESSION['philum']); $_SESSION['dlnb']='';
$_SESSION['philum']=msql_read('system','program_version',1);
return $ret;}

function adm_update_notes($phi,$n=''){
$updm=$_GET['updt_month']?$_GET['updt_month']:date('ym',time());
$r=msql_read('system','program_updates_'.$updm,'',1);
$phi=$phi?substr($phi,2):substr(2,$updm).'01';
$ret=btn('txtcadr',nms(81)).' '.msqlink('system','program_updates_'.$updm).br().br();
if($r){krsort($r); foreach($r as $k=>$v){if($v[0]>=$phi-1){$rn[]=1;
	$ret.=divc('',nl2br(stripslashes($v[0]."\n".$v[1]))).br();}}}
return $n?$ret:scroll($rn,$ret,4,'',200);}

function adm_update(){$goto='/?admin=update';
$_GET['update']=$_GET['update']?$_GET['update']:'='; 
if($_GET['updater']){$pdst='plug/distribution';
	$d=read_file('http://philum.net/'.$pdst.'.php?page=../'.$pdst.'.php');
	write_file($pdst.'.php','<'.'?php'.$d.'?'.'>');}//update_updater
if($_GET['updated']=='ok')$uret.=update_ok(); else{$_SESSION['dlnb']=0; 
	$uret.=picto('update',32).' '.lkc('txtbox',$goto.'&update=program',nms(59));}
//$uret.=lj('txtx','popup_update','ok').' ';
if(!is_file('fonts/philum.woff'))
	$uret.=icon('alert§system/com').' '.helps('updpictos').br().br();
$maj=checkupdate();
if($maj!=$_SESSION['philum'])$maj='local/distant='.$_SESSION['philum'].'/'.$maj;
$uret.=btn('popw',$maj).' ';//helps('update_help')
$uret.=lkc('txtsmall2','/?dev=dev','dev (progb)').' ';
$uret.=lkc('txtsmall2','/?admin=update_notes',picto('txt')).br().br();
require_once('plug/distribution.php'); //echo $_SESSION['dlnb'];
if($_SESSION['updfirst'])$uret.=lkc('txtyl',$goto.'&updater==','update_updater').' ';
$uret.=btn('nbp',slct_menus(array('/','prog','progb','msql','plug','js','gallery','fla','gdf','bkg','fonts','pictos','css','imgb/icons'),$goto.'&dest=',$_SESSION['dest'],'active','','v')).' ';
$uret.=lkc('txtbox',$goto.'&update=all',picto('update').' '.$_SESSION['dest']).' ';
if($_SESSION['dest']=='fonts'){$uret.=hlpbt('updfonts').' '.lkc('txtbox',$goto.'&update=del','del_obsoletes');}
$uret.=br().br();
$patch='160101';//patches//set update_ok//150521
if($patch){$pok=msql_read('server','program_patches',$patch);
	$ptch=msql_read('system','program_patches',$patch);
	if($pok==0 or $_GET['force']){
		if($_GET['patch']){$uret.=plugin('patchs',$ptch['function']);
			if($uret)modif_vars('server','program_patches',array(1),$patch);}
		else $uret.=divc('txtalert',lkc('txtyl',$goto.'&patch==',stripslashes($ptch['function'])).' '.$ptch['explics']).br();}}
//files
$uret.=$plug_output;
return $uret;}

function adm_updb(){$_GET['admin']='update'; return adm_admin('update');}

//params
function newmodfrom($d){
$nd=$_SESSION['qb'].'_mods_'; $_SESSION['modsnod']=$nd.$d;
if($d!=prmb(1) && !is_file('msql/users/'.$nd.$d.'.php')){
msq_copy('users',$nd.prmb(1),'users',$nd.$d);
echo btn('txtyl','_mods_'.$d.' created from _mods_'.prmb(1));}}

function adm_params($curauth,$rep){$auth=ses('auth'); $goto='/?admin=params'; $qb=ses('qb');
req('boot,adminx'); connect();//$db
if($auth>6 && $_GET['m_cnfg']=='='){$mcfg='&m_cnfg=='; $f='params/_'.$db.'_config.txt';
	if(is_file($f))$prms=explode('#',read_file($f));
	$arr=msql_read_prep('system','admin_config'); $hl='lang_admin*config_';}	
else{$prms=$_SESSION['prmb']; $prmb=sql('config','qdu','v','name="'.ses('qb').'"');
	$prms=explode('#',$prmb); $prms=prmb_defaults($prms);
	$arr=msql_read_prep('system','admin_params'); $hl='lang_admin*params_';}
if($_GET['params']=='save' && $auth>=$curauth){
	for($i=0;$i<=$_POST['valmax'];$i++){
		$prms[$i]=$_POST['pms'.$i]; $vaue.=$prms[$i].'#';}
	if($prms[1]!=prmb(1) && !$_GET['m_cnfg'])newmodfrom($prms[1]);
	if($_GET['m_cnfg']=='='){write_file($f,$vaue);
		update('qdu','struct',$vaue,'name',$qb);
		master_params('params/_'.$db,$qd,$aqb,$subd);
		alert(lkt('txtyl',$f,$db.'_config'));}
	else{$_SESSION['prmb']=$prms; update('qdu','config',$vaue,'name',$qb);}}
$sty='" style="width:200px;';//read
foreach($arr as $t=>$ak){foreach($ak as $i=>$v){if($i!=22){
	if($valmax<$i)$valmax=$i; $attr=array('name'=>'pms'.$i,'style'=>'width:200px;');
	if($i==11 && !$_GET['m_cnfg'])
		$r[$t].=select($attr,affect_auth($auth),'kv',$prms[$i]);
	elseif($i==25){$lc='msql/lang/'; $dirs=explore($lc,'dirs',1); 
		$dirs=str_replace($lc,'',$dirs); 
		$r[$t].=select($attr,$dirs,'vv',$prms[$i]);}
	elseif($i==21)$r[$t].=txarea('pms'.$i,$prms[$i],31,5).' ';
	else $r[$t].=input2('text" size="34','pms'.$i,$prms[$i],'').' ';
	$r[$t].=btn('txtblc',$v).' '.btn('txtsmall2',bubble('grey','popmsqt',$hl.$i,$i)).br();}}}
$r[$t].=hidden('valmax','',$valmax).br();
$ret=form($goto.$mcfg.'&params=save',make_tabs($r,'prm').input2('submit','Submit',nms(27),'')).br();
if($auth>6 && !$mcfg)$ret.=lkc('txtbox',$goto.'&m_cnfg==','server').' '.backup_config();
return $ret;}

function avatar($u){$f='/imgb/avatar_'.$u.'.gif'; 
if(!is_file($f))$f='/avatar/Gems/EmeraldSquare.gif';
return $f;}

function avatar_sav($dr,$p){$avat=$dr.'/'.$p;
$f='imgb/avatar_'.ses('USE').'.gif';
if($p=='ko')@unlink($f); elseif($p)copy('avatar/'.$avat,$f);
return image(avatar(ses('USE')).'?'.randid(),'48','48');}

function avatar_slct($dir){
$dr='avatar/'.$dir; $r=explore($dr.'/','files',1);
foreach($r as $k=>$v){$xt=substr($v,-3);
	if($xt=='gif' or $xt=='jpg'){$img=image('/'.$dr.'/'.$v,'48','48');
	$ret.=lj('','avatar_call___admin_avatar*sav_'.ajx($dir).'_'.ajx($v),$img);}}
return $ret;}

function adm_avatar($o){
$f='/imgb/avatar_'.ses('USE').'.gif'; if(!is_file($f))$f='avatar/Gems/EmeraldSquare.gif';
if(!$o)$ret=divd('avatar',image($f,'48','48')).br();
$r=explore('avatar/','dirs');
foreach($r as $k=>$v)$rt[$k]=avatar_slct($k);
$rt['upload']=imgform('/?admin=avatar&avnim=ok','','(48*48)');
$rt['upload'].=lj('txtx','avatar_call___admin_avatar*sav__ko','none');
return $ret.make_tabs($rt);}

function adm_stats($p,$o){return plugin('stats',$p,$o);}

function adm_backup($qb,$auth,$goto,$rep){
$r=msql_read('',$qb.'_cache','',1); $bkf=min(array_keys($r));
if($auth==7){$xt_end=checkbox('xtend','ok','all_hubs',0).checkbox('no_id','ok','no_ID',0);}
if($_GET['bkp_from']==''){$ret=form($goto.'&bkp_from==',autoclic('from',$bkf,'5','6','').input2('submit','Submit','from','').$xt_end);
	if($auth>6)$ret.=' '.lkc('txtx',$goto.'&bkp_sql==','insert');}
else{$bkf=$_POST['from']; if(!$bkf){$bkf=1;} //echo $qb;
if($auth==7 && $_POST['xtend']!='ok'){$wh='nod="'.$qb.'" AND ';}
$ret.=backups($wh,$bkf,$rep,$qb);}
if($auth>6){
	if($_GET['bkp_sql'])$ret.=form($goto.'&bkp_sql==&save=ok',balb('textarea',' name="insertsql" cols="50" rows="10"','').input2('submit','Submit','insert',''));
	if($_GET['save']=='ok'){$toinsert=stripslashes($_POST['insertsql']);
	$verif=msquery($toinsert);
	if(!$verif)$ret.='error'; else $ret.=btn('txtyl','saved');}
$ret.=br();
$ret.=lkc('txtblc','plug/export.php','master_backup').br();
$ret.=btn('txtblc','master_dump:').' ';
$ret.=lkc('txtblc','plug/dump.php?tb='.ses('qda'),'_art').' ';
$ret.=lkc('txtblc','plug/dump.php?tb='.ses('qdi'),'_txt').' ';
$ret.=lkc('txtblc','plug/dump.php?tb='.ses('qdu'),'_idy').br().br();
$ret.=lkc('txtbox',$goto.'&backup_msql==','backup_msql');
if($_GET['backup_msql']){require('plug/backup_msql.php'); $ret.=make_archive_msql('');}}
return $ret;}

function adm_mod_hlp($goto){
if(!$_GET['help'])return lkc('txtblc',$goto.'&help==','modules_info').br();
$mod=msql_read_prep('system','admin_modules'); 
$hlp=msql_read('lang','admin_modules','');
foreach($mod as $k=>$v){$nb_mod+=count($v); $arr='';
	foreach($v as $ka=>$va)$arr[$ka]=$hlp[$ka][0];
	$modtab.=make_tables(array($k,'usage'),$arr,'txtblc','').br();}
$ret.=$nb_mod.' modules'.br().$modtab;
return $ret;}

function adm_members_a($auth,$goto){//newuser save
$arr=affect_auth($auth); $mmbrs=$_SESSION['qbin']['membrs'];
$qdu=ses('qdu'); $qb=ses('qb'); $USE=ses('USE'); 
if($_POST['newuser'] && $_POST['newuser']!='newuser'){
	$usrd=adduser($qb,$_POST['newuser'],$_POST['pass'],$_POST['mail']);
	$tosave=sql('mbrs','qdu','v','name="'.$qb.'"'); 
	$tosave.=$_POST['adlv'].'::'.$_POST['newuser'].',';
	$_SESSION['qbin']['membrs']=tab_members($tosave);
	update('qdu','mbrs',$tosave,'name',$qb);
	relod($goto);}
elseif($_POST['Submit']){//modifuser
foreach($mmbrs as $k=>$v){
	if($_POST['del$k']!=$k){
	if($_POST[$k]){$tosave.=$_POST[$k].'::'.$k.',';}else{$tosave.=$v.'::'.$k.',';}}}
if($_POST['addu']) $tosave.=$_POST['adlv'].'::'.$_POST['addu'].',';
update('qdu','mbrs',$tosave,'name',$qb);//mbrs
$_SESSION['qbin']['membrs']=tab_members($tosave);
relod($goto);}
if($mmbrs){//readusers
	foreach($mmbrs as $k=>$v){
		if($k!=$USE && $v<=$auth){//$v=authlevel(nb)
			//$rc[$k]=menuder_form_kv($arr,$k,$v,'kv');
			$rc[$k]=select(atn($k),$arr,'kv',$v);
			$rc[$k].=' '.checkbox('del'.$k,$k,'delete','').br();}
		elseif($k==$USE)$rc[$k]=btn('txtx',$k.' :: auth_level: '.$v).br();}
	if($rc)$inp=on2cols($rc,470,5);
	if($rc){$inp.=br().input2('submit','Submit','Apply','');
	$ret.=form($goto,$inp).br();}}
if($auth>4)$ret.=lkc('txtbox','/?admin=members&adduser==','add_user').br().br();
if($_GET['adduser']=='='){//show_list
	$uss=sql('name','qdu','k',''); $mmbrs[$qb]=$auth;
	$usrs=array_combine_sub($uss,$mmbrs);
	if($usrs){
		//$inp=menuder_form_kv($usrs,'addu',$v,'kk').menuder_form_kv($arr,'adlv',$v,'kv');
		$inp=select(atn('addu'),$usrs,'kk',$v).select(atn('adlv'),$arr,'kv',$v);
		$inp.=input2('submit','Submit','Apply','');
		$ret.=form($goto,$inp);}
	if($auth>4){
	$cls='" size="10" maxlength="50';//adduser
	$inp=input2('text','newuser','newuser'.$cls,'').' ';
	$inp.=input2('text','pass','password'.$cls,'').' ';
	$inp.=input2('text','mail','mail'.$cls,'').' ';
	//$inp.=menuder_form_kv($arr,'adlv',$v,'kv').' ';
	$inp.=select(atn('adlv'),$arr,'kv',$v);
	$valu=$inp.' '.input2('submit','Submit','add_user','');
	$ret.=br().form($goto.'&adduser==',$valu);}}
return $ret;}

function adm_members_b(){$mmbrs=$_SESSION['qbin']['membrs'];
$qdu=ses('qdu'); $qb=ses('qb'); $USE=ses('USE'); 
if($_GET['register']=='=' && prmb(11)>=2){//register
	$tosave=qsl('mbrs','qdu','v','name="'.$qb.'"'); 
	$tosave.='2::'.$_SESSION['USE'].','; update('qdu','mbrs',$tosave,'name',$qb);} 
if($mmbrs[$USE])$ret.=btn('txtblc','registered_user as level: '.$mmbrs[$USE]);
else $ret.=lkc('txtblc','/?admin=members&register==','become member');
return $ret;}

#articles

function make_artlist($qr){
$sqlm=$_SESSION['sqlimit']; $admin=$_GET['admin'];
$dig=$_GET['dig']?$_GET['dig']:$_SESSION['nbj'];
if($dig)$sqlm='AND day>"'.calc_date($dig).'" AND day<"'.calc_date(time_prev($dig)).'"';
else $sqlm='AND day <"'.$_SESSION['daya'].'" ';
if($admin=='all_arts')$wh='';
elseif($admin=='my_arts')$wh.='AND name="'.$_SESSION['USE'].'"' ;// AND re>='1'
elseif($admin=='users_arts')$wh.='AND name!="'.$_SESSION['USE'].'"' ;
elseif($admin=='sys_arts'){$wh.='AND frm="_system"'; $sqlm='';}
elseif($admin=='trash'){$wh.='AND frm="_trash"'; $sqlm='';}
elseif($admin=='not_published')$wh.='AND re="0"' ;
if($_GET['cat'])$wh=' AND frm="'.$_GET['cat'].'" AND re>="1"';
if($_GET['triart']) $tri=$_GET['triart']; else $tri='id';
if($_GET['triorder']==1)$tri.=' ASC'; elseif($_GET['triorder']==2)$tri.=' DESC'; 
else $tri.=' DESC';
$ordr=$tri?' ORDER BY '.$tri:'';
if($admin=='categories'){$sqlm=''; $ordr='';}
$sql='nod="'.ses('qb').'" '.$wh.' '.$sqlm.$ordr;
$req=sq(implode(',',$qr),'qda','where '.$sql); 
while($data=mysql_fetch_array($req))
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
$ret.=txarea('edit'.$id,$msg,64,20,atc('console'));
return popup('article '.$id,$ret);}

function admin_art_sav($res,$id){
	$ret=mysql_real_escape_string(stripslashes($res));
if($id && $ret && $_SESSION['auth']>5)update('qdm','msg',$ret,'id',$id);}

function admin_articles($r){
$ye=btn('" style="color:green;',picto('true')).' '; 
$no=btn('" style="color:#bd0000;',picto('false')).' ';
foreach($_GET as $ka=>$va){$goto.=$ka.'='.$va.'&';} $goto.='publish=';
foreach($r as $id=>$va){$cid='&art='.$id.'#'.$id;
foreach($va as $k=>$v){
switch($k){
case("id"):$v='<a name="'.$v.'"></a>'.lkt("",'/?read='.$id,$v); break;
case("day"):$v=mkday($v,1); break;
case("suj"):$v=lj('','popup_editbrut___'.$id,$v); break;
case("img"):$v=""; break;
case("re"):
	if($v)$v=lkc("",'/?'.$goto.'off'.$cid,$ye);
	else $v=lkc("",'/?'.$goto.'on'.$cid,$no); break;
case("host"):$v=art_length($v); break;}
$ret[$id][$k]=$v;}}
return $ret;}

function make_table_titles($r){
$ordr='&triorder=1';
foreach($r as $k=>$v){
	if($_GET["cat"]) $cat='&cat='.$_GET["cat"];
	if($_GET["triart"]==$k && $_GET["triorder"]==1)$ordr='&triorder=2';
	$goto='/?admin='.$_GET["admin"].$ordr.$cat.'&triart='.$k;
	$ret[]=lkc('',$goto,$v);}
return $ret;}

function make_tables_pages($otp,$qrt){
list($p,$page)=explode('/',$_GET['set']);
$rtt=make_table_titles($qrt);
$npg=41; $page=$page?$page:1;
$min=($page-1)*$npg; $max=$page*$npg;
if(is_array($otp))foreach($otp as $id=>$va){$i++; if($i>=$min && $i<$max)$rtr[]=$va;}
$n_pages=nb_page($i,$npg,$page);
$ret=make_tables($rtt,$rtr,'bkg','');
return $n_pages.$ret.$n_pages;}

function edit_categories(){
$rub=urldecode($_GET['modif']);
$old_rub=$_POST['old_rub'];
if($_SESSION['auth']>=6){//save
	if($_POST['hide']){$rub='_'.$_POST['old_rub'];}
	elseif($_POST['publish'] && substr($old_rub,0,1)=="_"){$rub=substr($old_rub,1);}
	elseif($_POST['modif']){$rub=$_POST['modif'];}
	if($_POST['hide'] or $_POST['publish'] or $_POST['modif'])msquery('UPDATE '.$_SESSION['qda'].' SET frm="'.$rub.'" WHERE nod="'.ses('qb').'" and frm="'.$old_rub.'"');}
if($rub){//champs
	$valu=input2('text" size="15" maxlength="255','modif',$rub,"").hidden('old_rub','',$rub).' '.input2('submit','Submit','modif',"").' ';
	if(substr($rub,0,1)!="_")$valu.=input2('submit','hide','hide',"").' '; 
	else $valu.=input2('submit','publish','publish').' ';
	$inp=br().btn("",$valu);
	$ret.=lkc('txtx',htac('cat').$rub,'go_to').' ';
	$ret.=lkc('txtx','/?admin=all_arts&cat='.$rub,'all_arts_of:'.$rub).br();
	$ret.=form('/?admin=categories&modif='.$rub,$inp);}
return $ret.br();}

function catarts(){
if($_SESSION['auth']>=6)$ret=edit_categories();
$csa='txtbox" align="center'; $css='txtx';
$r=sql('frm','qda','k','nod="'.ses('qb').'" ORDER BY frm');
$rt=balc("tr","",balc("td",$csa,nms(9)).balc("td",$csa,'nb'));
if($_SESSION['auth']>=6)$lk='/?admin=categories&modif='; else $lk='/cat/';
if($r)foreach($r as $k=>$v){$lnkcat=lka($lk.$k,$k);
$rt.=bal("tr",balc("td",$css,$lnkcat).balc("td",$css,$v));}		
$ret.=bal("table",$rt);
return $ret;}

function adminarts(){
//if($_GET["publish"])publish_art($_GET["publish"],$_GET["art"],'qda');
$qr=array("id","suj","frm","day","name","re");
$qrt=array("id"=>"ID","suj"=>"Title (edit)","frm"=>"Category","day"=>"Date","name"=>"Author","re"=>"Published");
$r=make_artlist($qr);
if($r)$r=admin_articles($r);
$nbjj=$_GET["dig"]?$_GET["dig"]:$_SESSION["nbj"];
$nbjj=$nbjj?$nbjj:9999;
if(rstr(3))$ret.=dig_it($nbjj,'admin');
$ret.=make_tables_pages($r,$qrt);
return $ret;}

#admin

function adminauthes(){
$af=msql_read_prep('system','admin_authes');
foreach($af as $k=>$v)foreach($v as $ka=>$va)
if($va<=$_SESSION["auth"])$ret[$k][$ka]=$va;
return $ret;}

function admin_menus(){$top=rstr(69)?'':'d';
$rico=array('Global'=>'admin','Articles'=>'articles','User'=>'user','Builders'=>'builders','Microsql'=>'server','Actions'=>'like'); $r=sesmk('adminauthes');
foreach($r as $k=>$v)if($rico[$k])$ret.=popbub('admn',$k,picto($rico[$k]),$top,1);
return $ret;}

#
#
#admin
function admin(){
$qb=ses('qb'); $qda=ses('qda'); $qdu=ses('qdu'); $USE=ses('USE'); $auth=ses('auth');
$admin=$_GET['admin']?$_SESSION['admin']=$_GET['admin']:$_SESSION['admin'];
if($_GET['set'])$_SESSION['set']=$_GET['set'];
if($USE!=""){
$hubname=sql('hub','qdu','v','name="'.$qb.'"');
if(!$hubname)$hubname=$qb;
list($autologok,$userhub)=sql('name,hub','qdu','r','ip="'.hostname().'"');}
$rep="params";
//verif_user
if($USE!=$qb && $USE!="" && $userhub)$hub=lka('/'.$USE,$USE);
elseif($USE!=$qb && $USE!="" && $autologok!=$USE && $autologok)
	$alert.=lkc('txtx','/?log=on','autolog').' ';
elseif($USE==$qb && !$userhub && prmb(11)>=4)
	$alert.=lkc("txtred","/?log=create_hub","create_hub!");
elseif($USE=="")$reta=lkc('txtx',htac('module').'Home',$qb).br().br().loged($USE,$_SESSION['iq'],'').br();
//admin_menu
$aff=adminauthes();
if($admin=="=")$_SESSION['set']=$_GET['set']=$USE?"Global":"User";
//defaults
if($aff[$_GET['set']])$admin=key($aff[$_GET['set']]);
$_SESSION['admin']=$admin; $goto='/?admin='.$admin;
//if(!$userhub){unset($aff['User']['mail']); unset($aff['User']['password']);}
//auto_select_category
foreach($aff as $k=>$v){if($v[$admin]){$_SESSION['set']=$k; $curauth=$v[$admin];}
	$raf=array_merge_b($raf,array_keys($v));}
if($curauth===false)$curauth=7;
//login
if($USE){
	$w.=lkc('popw',htac('module').'Home',pictxt('home',$hubname)).' ';
	$w.=btn("popbt",pictxt('user',$USE.' '.asciinb($auth)).' ('.nameofauthes($auth).')');}
//fastmenu
$fmn=array('console','params','restrictions','apps','tags','css','templates','connectors','plugin','msql','finder','pictos','stats','update');
foreach($raf as $v){if(in_array($v,$fmn))
	$tit.=lkc(active($admin,$v),htac('admin').$v,pictit(mimes_types($v),$v)).' ';}
$reta.=divc('right',$w.$alert); $tit.=lkc('txtit',htac('admin').$admin,$admin).' ';
if($admin!="=")$reta.=div('',$tit);
if($auth>=7 && $admin=='update')$ret=adm_update();
if($auth>=$curauth && $curauth){
switch($admin){
//global
case('console'):$ret=adm_console($auth); break;
case('apps'):require_once('adminx.php'); $ret=adm_apps($_GET['set'],'',$_GET['dig']); break;
case('messages'):if($qb==$USE or $auth>=$curauth)$ret=adm_messages();
	else $ret=contact(nms(84),'txtcadr'); break;
case('hubs'):$ret=adm_hubs($auth); break;
case('nodes'):$ret=adm_nodes($auth,$goto); break;
case('stats'):list($p,$o)=explode('/',$_GET['set']); $ret=plugin('stats',$p,$o); break;
case('newsletter'):$ret=adm_newsletter($_GET['send']); break;
case('disk'):$ret=plugin('disk','',''); break;
case('share'):$ret=plugin('share','',''); break;
case('tickets'):$ret=plugin('tickets','',''); break;
case('faq'):$r=msql_read('system','program_faq','');
	$ret=nl2br(stripslashes(make_divtable($r,1))); break;}
//articles
if($_SESSION['set']=='Articles'){switch($admin){
	case('create'):$ret=f_inp('',''); break;
	case('categories'):$ret=catarts(); break;
	case('trackbacks'):req('mod,art'); $ret=trkarts(''); break;
	default:$ret=adminarts(); break;}}
switch($admin){
case('chat'):require_once('art.php'); $ret=output_trk(read_idy('microchat','DESC')); break;
case('shop'):$ret=helps('shop_class'); break;
case('book'):$ret=lkc('txtblc','/plug/book.php','book'); break;}
//configs
switch($admin){
case('restrictions'):$ret=adm_restrictions(); break;
case('params'):$ret=adm_params($curauth,rep); break;
case('avatar'):if($USE)$ret=adm_avatar(0); break;
case('mail'):
	if($_POST['amail']){if($USE==$qb)$_SESSION['qbin']['adminmail']=$_POST['amail'];
		update('qdu','mail',$_POST['amail'],'name',$USE);}
	$ml=sql('mail','sql','v','name="'.$USE.'"');
	if($ml)$valu=input2('text','amail',$ml.'" size="35" maxlength="50').' '.input2('submit','Submit','modif_mail','');
	$ret=form($goto,$valu); break;
case('password'):$ret=set_password($USE); break;
case('banner'):$ret=set_ban(); break;
case('descript'):$ret=editbrain($admin); break;
case('google'):$ret=editbrain($admin); break;
case('members'):$ret=adm_members_a($auth,$goto); break;
case('authes'):$titles=array('fonction','auth');
	if(auth(6))$ret=msqlink('system','admin_authes').br();
	foreach($aff as $k=>$v){$datas=''; arsort($v);
		foreach($v as $ka=>$va)$datas[$ka]=array($va);
		$outre[$k]=make_tables($titles,$datas,'txtblc','');}
		$ret.=make_tabs($outre,'at'); break;}
//constructors
switch($admin){
case('css'):$ret=adm_editcss(); break;
case('fonts'):$ret=edit_fonts(); break;
case('connectors'):$ret=data_brain('connectors').br().br();
	$ret.=lkc('txtblc',$goto.'&help==','connectors_infos').br();
	if($_GET['help'])$ret.=conn_help().br(); break;
case('modules'):$ret=data_brain('modules').br().br().adm_mod_hlp($goto); break;
case('templates'):$ret=data_brain('template'); break;
case('plugin'):$ret=adm_plugin(); break;
case('msql'):$ret=adm_msql(); break;
case('dev'):$ret=plugin('dev','',''); break;
case('tags'):req('meta'); $ret=admin_tags(get('set')); break;
case('finder'):$ret=call_finder($qb,'disk'); break;
case('backup'):$ret=adm_backup($qb,$auth,$goto,$rep); break;
case('update_notes'):$ret.=adm_update_notes('',1); break;
case('plug'):$ret.=adm_edit_plug(); break;}
if($admin && !$ret && $auth>=$curauth)//editbrain
	$ret=plugin($admin,$_GET['p'],$_GET['o']);
}//end if auth
else switch($admin){case('members'):$ret=adm_members_b(); break;}

#render
if($_SESSION['admin'] && !$_GET['callj'])$head=$reta.br();
else $head=bal('h2',lka('/admin/'.$_SESSION['admin'],$_SESSION['admin'])).br();
return $head.$ret;}

?>