<?php
//philum_bubs
session_start();
//apps=array('button','type','process','param','option','condition','root','icon');

function rightarrow(){return; bts('float:right;','&#9658;');}
function bub_adm($t,$j,$root,$ico){
return array($t,'ajax','popup','admin__3_'.$j,$opt,$cond,$root,$ico,$hide);}
function bub_l($t,$lk,$j,$root,$ico){return array($t,$lk,'',$j,'','',$root,$ico);}
//popbub($d=indicatif,$cat=$dir=root,$t=button,$c='call',1='over')

//search
/*function bal_search($n,$v,$sz,$mx,$c,$h=''){return '<search'.atb('type','text').atb('placeholder',$v).atd($n).atb('size',$sz).atb('maxlength',$mx).atb('required pattern',$h).' />';}*/
function bub_search_btn($va,$o,$id='',$d=''){
if($id)$di='ada'; else $id='srch'; $t=$va?$va:nms(24); 
if($o>1)$s=$o; else{$s=10; $c=' '.$o;}
$j='SearchT(\''.$id.'\')';
$js='onClick="'.$j.'" onkeyup="'.$j.'" onContextMenu="'.$j;
$ret=autoclic('search" id="'.$id.'" role="search" '.$js,$t,$s,'100','');
return divb('search|'.$di,$ret);}
//addart_fast
function bub_addart_btn(){req('ajxf');
return bub_adm_addart();}

//ucom
function bub_ucom_btn(){$j='sjtime(\'ucom\',\'socket_ucom_ucom_url\');';
$js='onClick="'.$j.'" onContextMenu="'.$j;
$ret=autoclic('ucom" id="ucom" '.$js,'command',16,'100','');
return divc('search',$ret);}
//lang
function bub_langs(){$r=explode(' ',prmb(26));
$ret[]=bub_l('all','link','/lang/all&module=All','lang','link');
foreach($r as $v)if($v!=$_SESSION['lang'])$ret[]=bub_l($v,'link','/lang/'.$v.'&module=All','lang','link');
return $ret;}
//plug
//0:usage/1:dir/2:loadable/3:callable/4:interface/5:state/6:private
function bub_plug($dr){$qb=ses('qb'); $ath=auth(6); $dr=strprm($dr);
$r=msql_read('system','program_plugs','','1'); 
foreach($r as $k=>$v){
	//if($v[2])//loadable
	//if($v[3])//callable
	//if($v[4])//interface
	if(!$v[5] or $ath)//state
	if(substr($v[1],0,6)!='system')//sys
	if(!$v[6] or $ath or $v[6]==$qb or substr($v[1],0,6)=='public')//private
	//if($k && $v[2] && (!$v[5] or $ath) && ($v[6]==$qb or (!$v[6] or $ath)) && substr($v[1],0,6)!='system' && substr($v[1],0,4)!='host' && substr($v[1],0,3)!='old')
	if($dr=='plugin')$ret[]=bub_l($k,'link','/plug/'.$k,$dr.'/'.$v[1],'link');
	else $ret[]=array($k,'plug',$k,'','','',$dr.'/'.$v[1],'conn');}
return $ret;}

//dev
function bub_dev(){$r=array('dev','lab','prod');
//$ret[]=array('cache','ajax','popup','rebuild__3xx','','','dev','reload');
foreach($r as $k=>$v)$ret[]=bub_l($v,'link','/dev/'.$v,'dev','phi2');
if(auth(6))$ret[]=bub_l('pub','link','/?dev2prod==','dev','down');
//if(auth(7))$ret[]=bub_l('publish','linkt','/plug/publish_site','dev','export');
return $ret;}
//time
function bub_timetravel(){req('spe,art'); $r=timetravel(); $travel=date('Y',ses('daya'));
$ret[]=bub_l(date('Y'),'link','/reload/'.ses('qb'),'','logout');//nms(83)
foreach($r as $k=>$v)$ret[]=bub_l($k,'link',target_date($v),'','time');
return $ret;}

//arts
function bub_adm_arts($dir){$r=ses('rqt');
if($r)foreach($r as $k=>$v){$ret[]=array($v[2],'art','',$k,'','',$v[1],'txt');}
return $ret;}
function bub_adm_arts_fast(){$r=ses('rqt'); 
if($r)foreach($r as $k=>$v)if(substr($v[1],0,1)!='_')$ra[$v[1]]=1;
if($ra)foreach($ra as $k=>$v)$ret.=popbub('arts',ajx($k),picto('folder').'&nbsp;'.$k,'c',1);
return $ret;}

//seek
//tag find arts
function bub_seek_art($d){req('mod'); list($cat,$tag)=explode('-',$d); 
if($cat=='tag')$r=sesr('interm',$tag); else $r=usertag_arts($tag); unset($r[ses('read')]);
if($r)foreach($r as $k=>$v)
	$ret[]=array(suj_of_id($k),'art','',$k,$d,'',$d,'article');
return $ret;}
//class find tags
function bub_seek_tag($d){req('mod'); $id=ses('read');
if($id){req('art'); if($d=='tag')$r=tri_tag(rqt($id,5)); else $r=utags_v($id,$d);}
else{if($d=='tag')$r=tags_list(); else $r=usertags($d);}
if($id && $r)$r=array_flip($r);
if($r)foreach($r as $k=>$v)if($k)//id
	//$ret[]=array($k,'bub','seekart',$d.'-'.$k,'','',$d,'tag');
	$ret[]=array($k,'ajax','popup_getcontent___'.$d.'_'.$k,'','','',$d,'tag');
return $ret;}
//id find classes
function seek_merge($d,$ret){$id=ses('read');
if($d=='tag')$r=tri_tag(rqt($id,5)); else $r=utags_v($id,$d); if($r)$r=array_flip($r);
if($r)foreach($r as $k=>$v)if($k)//id
	$ret[]=array($k,'bub','seekart',$d.'-'.$k,'','','','tag');
	//$ret[]=array($k,'ajax','popup_getcontent___'.$d.'_'.$k,'','','','','tag');
return $ret;}
function bub_seek(){$r=explode(' ','tag '.prmb(18)); req('art');
	foreach($r as $k=>$v)$ret=seek_merge($v,$ret);
	//if($v)$ret[]=array($v,'bub','seektag',ajx($v),'','','','folder2');
return $ret;}

//mods
function bub_adm_mods($d){req('mod'); //build_modules($va,$cr);
return build_mods(val_to_mod($d));}

//hubs
function bub_hubs_fast(){$r=ses('mn');
if($r)foreach($r as $k=>$v)$ret[]=bub_l($v,'link',subdom($k),'hubs','smile');
return $ret;}

//bub selector
function bub_slct($j){req('ajxf');
list($d,$id,$rid,$o)=explode('.',$j); 
if(strpos($d,'|'))$r=explode('|',$d); else $r=slct_r($d,$o);
//$ret[]=array('-','js','','','','','bub','');//close
$ret[]=array('nothing','js','jumpvalue',$id.'_','','','bub','');//del
if($r)foreach($r as $k=>$v)
	$ret[]=array($v,'js','jumpvalue',$id.'_'.addslashes($v),'','','bub','');
return $ret;}

//msql
function bub_msql($cat,$a,$b,$c){
$r=msq_select($a,$b,$c); $j='msql___'.$a.'_'.$b.'_'; if($c)sort($r);
if($r)foreach($r as $k=>$v){if(is_array($v)){sort($v); $kp=in_array_b('php',$v);
	if($kp!==false){unset($v[$kp]);
		$ret[]=array('This','ajax','popup',$j.$k,'','',$cat.'/'.$k,'msql');}
	if(count($v)<1)$ret[]=array($k,'ajax','popup',$j.$k,'','',$cat,'msql');
	else foreach($v as $ka=>$va){if($a!='design')$k=$b.'/'.$k;
		$ret[]=array($va,'ajax','popup',$j.$k.'*'.$va,'','',$cat.'/'.$k,'msql');}}
else{if($v=='php')$ret[]=array('This','ajax','popup',$j.$c,'','',$cat,'msql');
	else $ret[]=array($v,'ajax','popup',$j.$c.'*'.$v,'','',$cat,'msql');}}
return $ret;}

function bub_msql_dir($cat){
$qb=ses('qb'); $prfx=strprm($cat,1); $tabl=strprm($cat,2); switch($prfx){
case($qb): $dir='users'; $nod=$_SESSION['qb']; break;
case('public'): $dir='users'; $nod='public'; break;
case('design'): $dir='design'; $nod=$qb; break;
case('gallery'): $dir='gallery'; $nod=$qb; break;
case('admin'): $dir='lang/fr'; $nod='admin'; break;
case('system'): $dir='system'; $nod='admin'; break;
case('program'): $dir='system'; $nod='program'; break;
case('connectors'): $dir='system'; $nod='connectors'; break;
case('helps'): $dir='lang/fr'; $nod='helps'; break;}
return bub_msql($cat,$dir,$nod,$tabl);}

function bub_msql_fast($r,$cat){$qb=ses('qb');
$r[]=array('backoffice','link','blank','/msql/users','','',$cat,'link');
$r[]=array('popup','ajax','popup','msql___users_'.ses('qb'),'','',$cat,'window');
$r[]=array($qb,'ajax','bubble','popbub','msql','',$cat.'/'.$qb,'');
$r[]=array('design','ajax','bubble','popbub','msql','',$cat.'/design','');
$r[]=array('gallery','ajax','bubble','popbub','msql','',$cat.'/gallery','');
$r[]=array('public','ajax','bubble','popbub','msql','',$cat.'/public','');
if(auth(6)){
$r[]=array('admin','ajax','bubble','popbub','msql','',$cat.'/admin','');
$r[]=array('connectors','ajax','bubble','popbub','msql','',$cat.'/connectors','');
$r[]=array('program','ajax','bubble','popbub','msql','',$cat.'/program','');
$r[]=array('system','ajax','bubble','popbub','msql','',$cat.'/system','');
$r[]=array('program','ajax','bubble','popbub','msql','',$cat.'/helps','');}
return $r;}

#admsq
function msq_select_b($dr,$pr,$nd){
$r=explore('msql/'.$dr,'files',1); $n=count($r);
for($i=0;$i<$n;$i++){$rb=explode('_',substr($r[$i],0,-4));
if($rb[2]!='sav' && $rb[3]!='sav'){
	if($pr && $nd){if($rb[0]==$pr && $rb[1]==$nd)$ret[]=$rb;}
	elseif($pr && !$nd){if($rb[0]==$pr)$ret[]=$rb;}
	else $ret[]=$rb;}}
return $ret;}

function bub_admsq_lang_sub(){$r=explore('msql/lang','dirs','1');
list($b,$d,$p,$t,$ver,$def)=$_SESSION['murl']; 
if($p)$lk='/'.$p; if($t)$lk.='_'.$t; if($ver)$lk='_'.$ver;
foreach($r as $k=>$v)
	$ret[]=array($v,'link','','/msql/lang/'.$v.$lk,'admsq','','lang','msql');
return $ret;}

function bub_admsq_dirs(){$r=array('users','design'); if(auth(6))$r=array('clients','design','gallery','lang','radio','server','stats','system','users');
foreach($r as $k=>$v){$vb=$v=='lang'?$v:'';
	$ret[]=array($v,'link','','/msql/'.$v,'admsq','',$vb,'');}
return $ret;}

function bub_admsq($d){
if(!$d)return bub_admsq_dirs();
list($bs,$pr,$nd,$vr)=split('/',$d);
if($bs=='lang' && !$pr)return bub_admsq_lang_sub();
elseif($bs=='lang'){$bs.='/'.$pr; $pr=$nd; $nd=$vr;}
$r=msq_select_b($bs,$pr,$nd); if($r)sort($r); $qb=ses('qb');
$lk='/msql/'.$bs; if($dr)$lk.='/'.$dr; if($pr)$lk.='/'.$pr.'_';
if($r)foreach($r as $k=>$v){list($prf,$nod,$ver)=$v;
if((($bs=='users' or $bs='design') && ($prf=='public')) or auth(4)){//$prf==$qb or 
	if(!$pr){$bt=$prf; $lnk=$lk.'/'.$prf; $root=$d.'/'.$prf;} 
	elseif(!$nd){$bt=$nod; $lnk=$lk.$nod; $root=$d.'/'.$nod;} 
	elseif($ver){$bt=$ver; $lnk=$lk.$nod.'_'.$ver; $root=$d;}
	else{$bt='This'; $lnk=$lk.$nod; $root=$d;}
	if($bt)$ret[]=array($bt,'link','',$lnk,'admsq','',$d,'');}}//$root
return $ret;}

#admin
function adminauthes(){
$af=msql_read_prep('system',"admin_authes");
foreach($af as $k=>$v)foreach($v as $ka=>$va)
if($va<=$_SESSION['auth'])$ret[$k][$ka]=$va;
return $ret;}
function bub_adm_admin_fast(){//$arw=rightarrow();
$r=msql_read('lang','admin_menus','',1);
foreach($r as $k=>$v)$ret.=popbub('admin',$k,$arw.mimes($k).'&nbsp;'.$v,'',1);
return $ret;}

//user
function bub_adm_user_fast(){
if(ses('USE'))$ret=popbub('user','',mimes('login').'&nbsp;'.ses('USE'),'',1);
return $ret;}
function bub_adm_user(){$rb=msql_read('system','default_apps_user','',1);
$r=msql_read_b('system','default_apps','',1); $r=r_apps_cond('user'); if($r)$r=$rb+$r;
if(ses('USE'))$r=unset_in($r,'login',0); else $r=unset_in($r,'logout',0);
return $r;}

function bub_adm_console($ret,$dir){
$r=explode(' ','system '.prma('blocks'));
$ret[]=bub_adm('console','console_',$dir,'window');
if($r)foreach($r as $k=>$v){if($v)$ret[]=bub_adm($v,'console_'.$v,$dir.'/'.$v,'window');
$rb=define_modc_b($v);
if(is_array($rb))foreach($rb as $kb=>$vb){list($m,$p,$t,$c,$e,$g,$ch,$h)=$vb;//module
	if($m=='apps')$ret[]=array('Apps','ajax','popup','call___adminx_submod*pop','','',$dir.'/'.$v,'apps');
	else $ret[]=array($m,'ajax','popup','module__3_'.$kb,$opt,$cond,$dir.'/'.$v,'divide');}}
return $ret;}

function bub_adm_rstr($ret,$p,$o,$t){$dir=$p.'/'.$o;
$r=msql_read_prep('system','admin_restrictions');
$h=msql_read('lang','admin_restrictions');
$ret[]=array($t,'ajax','popup','admin__3_restrictions','','',$dir,'window');
foreach($r as $k=>$v){
$ret[]=array($k,'ajax','popup','rstr__3_','','',$dir,'divide');
	foreach($v as $ka=>$va){$ico=rstr($ka)?'true':'false';
	$ret[]=array($va,'ajax','popup','rstr__xx_'.$ka,'','',$dir.'/'.$k,$ico);}}
if(auth(6))$ret[]=array('msql','ajax','popup','msql__3_system_admin_restrictions','','',$dir,'msql');
return $ret;}

//admin-menu
function bub_adm_admin($dir){//case:admin
$r=sesmk('adminauthes','',1); $rm=msql_read('lang','admin_authes','',1);
$ret[]=array('backoffice','link','blank','/admin/console','','','Global','link');
if($r)foreach($r as $k=>$v){
if(strdeb($k,'/')==strdeb($dir,'/')){
	if($k=='Microsql')$ret=bub_msql_fast($ret,$k);
	else foreach($v as $ka=>$va){
	if($va<=$_SESSION['auth']){$t=$rm[$ka]?$rm[$ka]:$ka; $ico=mimes_types($ka);
		if($ka=='css'){//name,j,root,ico,lk
			$mlt='page_deskbkg;popup_admin__3_css;popup_site___desktop_ok__autosize';
			$ret[]=array('edition','link','blank','/admin/'.$ka,'','',$k.'/'.$ka,'link');
			$ret[]=array('desktop','js','SaveJc',$mlt,'','',$k.'/'.$ka,'popup','','');
			$ret[]=bub_adm('design','design',$k.'/'.$ka,$ico);
			$ret[]=bub_adm('colors','colors',$k.'/'.$ka,$ico);}
		elseif(strtolower($ka)=='hubs' && auth(5))foreach($_SESSION['mn'] as $kb=>$vb)
			$ret[]=bub_l($vb?$vb:$kb,'link',subdom($kb),$k.'/'.$ka,$ico);
		elseif($ka=='console')$ret=bub_adm_console($ret,$k.'/'.$ka);
		elseif($ka=='restrictions')$ret=bub_adm_rstr($ret,$k,$ka,$t,$ico);
		elseif($ka=='tickets')$ret[]=array($t,'plug','chatxml','tickets','','',$k,'chat');
		elseif($ka=='update')$ret[]=bub_adm($t,ajx($ka),$k,'download');
		else $ret[]=bub_adm($t,ajx($ka),$k,$ico);}}}}
return $ret;}

function bub_adm_admn($dir){
$r=sesmk('adminauthes'); $rm=msql_read('lang',"admin_authes",'',1);
$ret[]=array('backoffice','link','blank','/msql/users','','','Microsql','link');
$ret[]=array('hub','ajax','popup','msql___users_'.ses('qb'),'','','Microsql','window');
//$ret[]=array('system','ajax','popup','msql___system','','','Microsql','url');
foreach($r as $k=>$v){if($k==$dir)foreach($v as $ka=>$va){$t=$rm[$ka]?$rm[$ka]:$ka;
	if($k!='Microsql')$ret[]=bub_l($t,'link',htac('admin').$ka,$k,mimes_types($ka));
	else $ret[]=array($t,'ajax','popup','msql___users_'.ses('qb').'_'.$ka,'','',$k,'window');}}
return $ret;}

//build
//apps=array('button','type','process','param','option','condition','root','icon');
//$rc=array($v[0],$v[1],$v[2],$v[3],$v[4],$v[5],$v[6],$v[7]);
function bub_apps($r,$d,$dir,$cond){//$r,,dir,cond//p($r); echo 'oo';
$dr=explode('/',$dir); $nd=$dir?count($dr):0;
if($r)foreach($r as $k=>$v){$rc=array_flip(explode(' ',' '.$v[5]));
if($rc[$cond?$cond:'menu'] or !$v[5]){
	$rv=explode('/',$v[6]); $nv=$v[6]?count($rv):0; $t=$v[0]; 
	$ico=$v[7]?picto($v[7]).'&nbsp;':''; $rvb=$rv[$nv-1];
	if($dir==$v[6])$is=true; else $is=match_vdir($dr,$nd,$rv);
	if($is && $nv==$nd+1 && !$v[8] && auth($v[9])){//dirs
		$rb[$rvb]=popbub($v[4]?$v[4]:$d,$v[6],picto('kright').'&nbsp;'.$rvb,$dd,1);}
	if($is && $nv>$nd)$is=false;
	if($is && !$v[8] && (!$v[9] or auth($v[9]))){//noj
		if($v[1]=='link')$rb[$t]=ljbub($ico.$t,$v[3],'','','','');
		elseif($v[1]=='linkt')$rb[$t]=ljbub($ico.$t,$v[3],'','','','1');
		elseif($v[1]=='js')$rb[$t]=ljbub($ico.$t,'',atj($v[2],$v[3]));
		elseif($v[1]=='bub')$rb[$t]=popbub($v[2],$v[3],$ico.$t,'c',1);//d
		else{$j=read_apps($v); $rb[$t]=ljbub($ico.$t,'',sj($j));}}}}
if($rb)$ret=implode('',$rb);
//if($d=='arts')//$ret=desktop_build_ico($rb,'icones');
$ret=scroll($rb,$ret,19);
return $ret;}

//rooter
function r_apps_cond($d){$r=msql_read_b('',ses('qb').'_apps','',1);
if($r)foreach($r as $k=>$v)if($v[5]==$d){$v[5]=''; $ret[$k]=$v;} return $ret;}

function r_apps_home($o){
$r=msql_read_b('system','default_apps_home','',1); if($o)return $r; $rb=r_apps_cond('home');
if(!rstr(56))$r=unset_in($r,'hubs',0);
//if(!rstr(48))$r=unset_in($r,'boot',6);
return array_merge_b($rb,$r);}

function bub_root_slct($d,$dir){switch($d){
case('home'): return r_apps_home(0); break;
case('adhome'): return r_apps_home(1); break;
case('admin'): return bub_adm_admin($dir); break;
case('admn'): return bub_adm_admn($dir); break;
case('apps'): return r_apps(); break;
case('arts'): return bub_adm_arts($dir); break;
case('seek'): return bub_seek(); break;
case('seektag'): return bub_seek_tag($dir); break;
case('seekart'): return bub_seek_art($dir); break;
//case('mods'): return bub_adm_mods($dir); break;
case('msql'): return bub_msql_dir($dir); break;
case('admsq'): return bub_admsq($dir); break;
case('admsqb'): return bub_admsq_b($dir); break;
case('table'): return msql_read('',ses('qb').'_'.$dir,'',1); break;
case('lang'): return bub_langs(); break;
//case('hubs'): return bub_hubs_fast(); break;
case('timetravel'): return bub_timetravel(); break;
case('dev'): return bub_dev(); break;
case('user'): return bub_adm_user(); break;
case('plug'): return bub_plug($dir); break;
case('bubses'): return $_SESSION['bubses'][$dir]; break;}}

function bub_root($d,$dir){switch($dir){//pre-rendered, intercepte navigation
case('batch'): req('tri,pop,ajxf'); return batch('','c');break;
case('fastmenu'): return bub_adm_admin_fast();break;
case('search'): return bub_search_btn('',18,'srchb');break;
case('addart'): return bub_addart_btn();break;
case('ucom'): return bub_ucom_btn();break;
case('arts'): return bub_adm_arts_fast(); break;
case('user'): return bub_adm_user_fast(); break;
case('hubs'): $r=bub_hubs_fast(); break;
case('bub'): $r=bub_slct($d); break;}
if(!$r)$r=bub_root_slct($d,$dir); //if($d==navs)p($r);
return bub_apps($r,$d,$dir,$cond);}

?>