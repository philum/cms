<?php
//philum_specs

#admin
function m_system(){$auth=$_SESSION['auth']; $id=ses('read');
$rst=ses('rstr'); $top=!$rst[69]?'':'d'; $hv=1;
$ra=[0=>prmb(8),1=>'loading',2=>'admin',3=>'desktop',4=>'download',5=>'search',6=>'articles',7=>'add',8=>'link',9=>'language',10=>'time',11=>'circle-full',12=>'circle-empty',13=>'list',14=>'user',15=>'menu']; 
foreach($ra as $k=>$v)$ico[$k]=picto($v);
$ret['home']=popbub('home','',$ico[0],$top,$hv);//if(!$rst[20])
if(!$rst[94])$ret['menuB']=popbub('menubub','',$ico[15],$top,$hv);
if(!$rst[95])$ret['menuO']=popbub('overcat','',$ico[15],$top,$hv);
if(!$rst[51])$ret['desk']=popbub('desk','',$ico[3],$top,$hv);
if($auth>4){
	if(!$rst[120])$ret['admin']=popbub('fadm','fastmenu',$ico[2],$top,$hv);
	else $ret['admin']=llj('','popup_admin___all',$ico[2]);}
if(!$rst[75]){
	if($top)$ret['search']=search_btn(1);
	else $ret['search']=popbub('call','search',$ico[5],$top,$hv);}
if($auth>1){
	if(!$rst[83])$ret['ucom']=popbub('call','ucom',$ico[8],$top,$hv);
	if($auth>3 && !$rst[76])$ret['batch']=popbub('call','batch',$ico[4],$top,$hv);}
if($auth>2){
	if(!$rst[79])$ret['addurl']=popbub('call','addart',$ico[7],$top,$hv);
	else $ret['addart']=li(lja('',sj('popup_addArt____1').' closebub(this);',$ico[7]));}
if(!$rst[81])$ret['favs']=llj('','popup_favs,home',picto('bookmark2'));//favs
if(!$rst[80])$ret['arts']=popbub('','arts',$ico[6],$top,$hv);//arts
if(!$rst[82])$ret['lang']=popbub('lang','lang',$ico[9],$top,$hv);//lang
if(abs(ses('dayx')-ses('daya'))>86400 or !$rst[84])//back_in_time
	$ret['time']=popbub('timetravel','',$ico[10],$top,$hv);//archives
if(!$rst[48]){if($top)$nm=' '.btn('small',ses('USE'));//usr
	$ret['user']=popbub('user','',$ico[14],$top,$hv);}//user on prm1=app user, on prm2=bubfast
if($id && !$rst[89])$ret['seek']=popbub('seek','',$ico[13],$top,$hv);//metas
if($id && auth(6)){
	$tag=lj('','popup_metall___'.$id.'_3',picto('tag'));
	$tit=lj('','popup_tit___'.$id.'_3',picto('meta'));
	$edt=lj('','popup_artedit___'.$id.'___autosize',picto('edit'));
	$edt2=lja('',atj('editart',$id),picto('editor'));
	//if(!$rst[1])$trk=li(lj('','popup_track___'.$id,picto('forum')));
	$ret['edit']=li($tag).li($tit).li($edt).bal('li',atd('adt2'.$id),$edt2);}//.$trk
$dev=ses('dev'); $ic=$dev=='b'||$dev=='c'?$ico[11]:$ico[12];
if(auth(6) or $dev)$ret['dev']=popbub('dev','dev',$ic,$top,$hv);//dev
$ret['fixit']=span(atd('fixtit').atc('etc'),' ');
//$ret['alert']=' ';
$_POST['popadm']=array_merge_b(post('popadm'),$ret);}

//adminx/poplinks
function popadmin(){
$top=rstr(69)?'':'d'; $ret=''; $rta=''; $rtb='';
if(get('admin')){$top='d';
	$adm=popbub('adhome','',picto('phi2'),$top,1);
	$rta=$adm.admin_menus();}
elseif(get('msql')){$top='d'; $rta=msql_menus_j('');}
else foreach($_POST['popadm'] as $k=>$v){
	if(strstr('cache design hub alert log chrono srch',$k))$rtb.=$v;//user 
	else $rta.=$v;}
$css=$top?'inline':''; $_POST['popadm']=[];
if($rta)$ret=mkbub($rta,$css,'','this.style.zIndex=popz+1;');
if(!ses('iqa'))$rtb.=cookie_accept();
if($rtb)$ret.=bts('position:fixed; right:0;',$rtb);//
//if($rtb)$ret.=mkbub($rtb,$css,'left:50%;right:0;
if($top)Head::add('csscode','#page{padding-top:28px;}');
else Head::add('csscode','#page{margin-left:28px;}');
return $ret;}

#arts
function popart($id,$t=''){$t=pictxt('articles',$t);
if(!rstr(8))return lkc('',$id,$t);
return lj('','popup_popart__3_'.$id.'_3',$t);}//pagup
function jread($c,$id,$t){$ic=find_art_link($id);
if(!rstr(8) or !$ic)return lkc($c,urlread($id),$t);
else return popart(is_numeric($ic)?$ic:$id,$t);}

function pecho_arts($id){$id=find_id($id);
if(isset($_SESSION['rqt'][$id]))return $_SESSION['rqt'][$id];
$r=sql('day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re,lg','qda','r','id='.$id);
return arr($r,13);}

function read_msg($d,$m){$id=find_id($d); if(!$id)return;// and substring(frm,1,1)!='_'
$ok=sql('id','qda','v','id='.$id.' and (re>0 or name="'.ses('USE').'")'); if(!$ok)return;
$ret=sql('msg','qdm','v','id='.$id);
if($m==2 or $m=='noimages' or $m=='nl')$ret=kmax($ret);
if($m=='inner')$ret=conn::parser($ret,$m,$d);
elseif($m!='brut')$ret=conn::read($ret,$m,$d);
return $ret;}

function rqt($id,$n=''){
$r=['day'=>0,'frm'=>1,'suj'=>2,'img'=>3,'nod'=>4,'tag'=>5,'lu'=>6,'name'=>7,'host'=>8,'mail'=>9,'ib'=>10,'lu'=>11]; if(!is_numeric($n))$n=$r[$n]; $r=isset($_SESSION['rqt'][$id])?$_SESSION['rqt'][$id]:'';
if($id)return $n&&isset($r[$n])?$r[$n]:$r;}

function find_id($id){
if($id=='last')return last_art_id();//id_is_public($id)
	elseif(!is_numeric($id))return id_of_suj($id); else return $id;}
function last_art_id(){if(is_array($_SESSION['rqt']))return key($_SESSION['rqt']);}
function last_art_day(){if(isset($_SESSION['rqt'])){$id=key($_SESSION['rqt']); return rqt($id,'suj');}}
function last_art($lastdate){$ld=$lastdate?$lastdate:last_art_day();
return sql('id','qda','v','nod="'.ses('qb').'" AND frm!="_system" AND day>="'.$ld.'" AND re>="1" ORDER BY id DESC LIMIT 1');}
function oldest_art(){return sql('day','qda','v','nod="'.ses('qb').'" AND re>="1" AND frm!="_system" ORDER BY day ASC LIMIT 1');}
function maxdays(){$d=sesmk('oldest_art'); return round((ses('daya')-$d)/84600);}
function maxyears(){return ceil(maxdays()/365);}
function id_of_suj($id){return sql('id','qda','v','suj="'.$id.'" AND nod="'.ses('qb').'" ORDER BY id ASC LIMIT 1');}//AND re>="1"
function ib_of_id($id){$ib=rqt($id,'ib'); if($ib && $ib!='/')return $ib;
elseif(!$ib)return sql('ib','qda','v','id='.$id);}
function id_of_ib($ib){return sql('id','qda','k','ib="'.$ib.'" limit 1');}
function frm_of_id($id){$frm=rqt($id,'ib'); if($frm)return $frm;
else return sql('frm','qda','v','id='.$id);}
function suj_of_id($id){$suj=rqt($id,'suj'); if($suj)return $suj;
$suj=sql('suj','qda','v','id='.$id); if(is_string($suj))return $suj;}
function data_val($v,$id,$val,$m=''){$sq=$id?'ib="'.$id.'" and ':'';
return sql($v,'qdd',$m?$m:'v',$sq.'val="'.$val.'"');}
function count_art($suj,$frm){return sql('COUNT(id)','qda','v','nod="'.ses('qb').'" AND suj="'.$suj.'" AND frm="'.$frm.'" AND re>="1"');}
function cache_art($id){$ret=sql('day,frm,suj,img,nod,thm,lu,author,ip,mail,ib,re','qda','v','id="'.$id.'"'); $_SESSION['rqt'][$id]=$ret;}

function find_cat($nbj){$w='nod="'.ses('qb').'"';
if($_SESSION['prmb'][16])$w.=' AND day>'.calc_date($nbj?$nbj:30);
if($nbj)$r=sql('frm','qda','k',$w); else $r=$_SESSION['line'];
return $r;}

#desktop
function read_apps($v){switch($v[1]){//p/t/d/o/c/h/tp/br
case('ajax'):$ret=$v[2].'_'.$v[3].($v[4]?'_'.$v[4]:''); break;
case('art'):$ret='popup_popart__3_'.$v[3].'_3'; break;
case('desktop'):$ret='popup_desktop__3_'.$v[2].'_'.$v[3].'_'.$v[4]; break;//type
case('img'):$ret='popup_popim__3_users/'.ajx($v[3]).'___autosize'; break;
case('file'):$ret=read_apps_reader($v[3]); break;
case('finder'):$ret='popup_finder___'.$v[3].'_'.$v[4]; break;
case('admin'):$ret='popup_admin___'.$v[2].'_'.$v[3].'_'.$v[4]; break;
case('msql'):$ret='popup_msqlp___'.$v[2].'_'.$v[3].($v[4]?'*'.$v[4]:''); break;//ajx()
//case('iframe'):$ret='popup_plupin___iframe_'.ajx($v[3]).'_autosize'; break;
case('iframe'):$ret='popup_iframe___'.ajx($v[3]).'_iframe__autosize'; break;
case('link'):$ret='popup_iframe___'.ajx($v[3]).'_iframe__autosize'; break;
//case('link'):$ret='socket_ret__url_'.ajx($v[3]); break;
case('url'):$ret='socket_ret__url_'.ajx($v[3]); break;//host().//$v[2]=blank
case('plug'):$ret='popup_plupin__3_'.$v[2].'_'.$v[3].'_'.$v[4].'___injectjs'; break;
case('plup'):$ret='popup_plugin__3_'.$v[2].'_'.$v[3].'_'.$v[4].'___injectjs'; break;
case('plugfunc'):$ret='popup_plup__3_'.ajx($v[2]).'_'.ajx($v[3]).'_'.$v[4]; break;
case('apps'):$ret='popup_app__3_'.ajx($v[2]).'_home_'.ajx($v[3]).'_'.ajx($v[4]).'__injectjs'; break;//old
case('app'):$ret='popup_'.ajx($v[2]).',home__3_'.ajx($v[3]).'_'.ajx($v[4]).'__injectjs';break;
case('appin'):$ret='popup_'.$v[3].'__3___injectjs'; break;
case('api'):$ret='popup_apij__3_'.ajx($v[3]); break;
case('ajxlnk'):$ret='content_ajxlnk__3_'.ajx($v[3]); break;//module
case('ajxlnk2'):$ret='popup_ajxlnk2__3_'.$v[2].'_'.ajx($v[3]); break;//module_art
case('module'):$ret='popup_modpop__3_'.ajx($v[3]).'_480'; break;//module_pop
case('mod'):if(strpos($v[4],'/')===false)$opt='/'.$v[4]; else $opt=$v[4];//cmd
	$ret='popup_modpop__3_'.ajx($v[3].'//'.$opt.'/'.$v[7].'///1:'.$v[2]).'_480'; break;
//case('app'):$ret='popup_openapp__3_'.ajx($v[2]).'_'.$v[3].'_'.$v[4]; break;
case('bub'):$ret='bubble_popbub__d'.randid().'_'.$v[2].'_'.$v[3]; break;//loos mod
}//ajax,art,file,finder,admin,msql,iframe,link,url,plug,plup,plugfunc,mod,bub
return $ret;}

//if($r)$r=virtual_array($r,$o); //$r=select_subarray($p,$r,$o);
function match_vdir($dr,$nd,$rv){
for($i=0;$i<$nd;$i++)if(val($dr,$i)!=val($rv,$i))return false;
return true;} 

//0:button,1:type,2:process,3:param,4:opt,5:cond,6:root,7:icon,8:hide,9:private)
function m_apps($r,$cnd,$dir,$p='',$o=''){if($p)$p=ajx($p); $ret=[];
$dr=explode('/',$dir); $nd=$dir?count($dr):0; $mn=val($_SESSION['rstr'],16,1);//0=adapt,2=crop,3=center
if($r)foreach($r as $k=>$v){
if(strpos($v[5],$cnd)!==false && $cnd=='boot' && !$v[8])$ret[]=read_apps($v);
elseif(strpos($v[5],$cnd)!==false or !$v[5]){$t=$v[0];
	if($v[1]=='art'){if($v[2]=='auto')$t=suj_of_id($v[3]); else $t=$v[2];
		if($t)$v[7]=apps_arts_thumb($v[3],$v[7]);}
	elseif($v[1]=='file' && is_image($v[3]))$v[7]=make_thumb_c($v[3],'50/38',$mn);
	elseif($v[1]=='img')$v[7]=make_thumb_c('users/'.$v[3],'50/38',$mn);//
	sesr('apico',$t,$v[7]); $rv=explode('/',$v[6]); $nv=$v[6]?count($rv):0;
	if($dir==$v[6])$is=true; else $is=match_vdir($dr,$nd,$rv);
	if($is && $nv==$nd+1 && empty($v[8]) && !empty($v[9]) && auth($v[9])){//dirs
		$ret[$rv[$nv-1]]='popup_desktop__2_'.$cnd.'_'.ajx($v[6]).'_'.$p.'_'.$o;}
	elseif($is && !empty($rv[$nd]) && empty($v[8])){$v6=implode('/',array_slice($rv,0,$nd+1));
		$ret[$rv[$nd]]='popup_desktop__2_'.$cnd.'_'.ajx($v6).'_'.$p.'_'.$o;}
	if($is && $nv>$nd)$is=false;
	if($is && empty($v[8]) && (empty($v[9]) or auth($v[9]))){$j=read_apps($v);
		//if($v[1]=='link')$ret[$t]=array('link',$v[3]);
		if($j)$ret[$t]=$j;}}}
return $ret;}

function r_apps($p=''){$p=$p?$p:'apps';
if(rstr(61))$r=msql::read('system','default_apps','',1);
$rb=msql::read('',nod($p),'',1);
if(isset($r))$rb=array_merge_p($r,$rb);
return $rb;}

function read_apps_reader($f){$xt=xtb($f); $fj=ajx($f);//finder_reader
if($xt=='.mp3')return 'popup_popmp3___'.$fj;
if(strpos('.jpg.png.gif',$xt)!==false)return 'popup_popim___users/'.$fj.'___autosize';
return 'popup_fifunc___fi*reader*pop_'.$fj.'_';}

function array_merge_p($r,$rb){if($rb)$kb=array_keys_r($rb,0,'k');
if($r)foreach($r as $k=>$v)if(isset($kb[$v[0]]))$r[$k]=$rb[$kb[$v[0]]]; 
if($r)$ka=array_keys_r($r,0,'k'); 
if($rb)foreach($rb as $k=>$v)if(isset($ka[$v[0]]) && !$r[$ka[$v[0]]])$r[]=$v; 
return $r;}
function array_merge_px($r,$rb){if($r)$ka=array_keys_r($r,0,'k');
if($rb)foreach($rb as $k=>$v)if(!$r[$ka[$v[0]]])$r[]=$v; 
return $r;}

//arts
function apps_arts_thumb($id,$p=''){//ses('rebuild_img',1);
$img=sql('img','qda','v','id='.$id); if($img)$f=art_img($img,$id);
if(isset($f)){if($f && !is_file('img/'.$f))conn::recup_image($f);
return make_thumb_c('img/'.$f,'50/38',1);} else return $p?$p:'articles';}

//call
function desktop_apps($id,$va,$opt,$o){
if($id=='varts')$r=apps_varts($id,$opt);
elseif($id=='arts')$r=apps_arts($id,$va,$opt,$o);
elseif($id=='files')$r=apps_files($id,$opt,$o);
elseif($id=='explore')$r=apps_explore($va,$opt);
elseif($id=='menubub')$r=apps_menubub($va);
elseif($id=='overcats')$r=apps_overcats($va);
else $r=r_apps();
return m_apps($r,$id?$id:'desk',$va,$opt,$o);}

function desk_icon($k,$j){$ic=sesr('apico',$k);
$ra=['popart'=>'articles','msql'=>'server','plug'=>'get','desktop'=>'folder','popim'=>'img'];
if($j)$ica=strprm($j,1,'_'); else $ica='';
if($ica=='popim')$ic=make_thumb_c(ajx(strprm($j,4,'_'),1),'50/38','ico');
if($ica=='desktop' or !$ic)$ic=val($ra,$ica);
return $ic;}

function icoart($k,$v,$c){
if(is_numeric($k)){$v='popup_popart__3_'.$k; $ic=apps_arts_thumb($k); $k=suj_of_id($k);}
else $ic=desk_icon($k,$v);
$ico=strpos($ic,'<')!==false?btn('small',$ic):mimes($k,$ic,32);
return ljp(att($k),$v,divc($c,$ico.' '.bts('display:block',$k)));}

function desktop_build_ico($r,$c){$ret='';
if(is_array($r))foreach($r as $k=>$v)$ret.=icoart($k,$v,$c);
return $ret;}

function app_list($r,$c,$cl=''){$ret='';
if($r)foreach($r as $k=>$v){$ic=desk_icon($k,$v); $ico=mimes($k,$ic,'');
	$ret.=ljp(atc($cl).att($k),$v,$ico,$c).' ';}
return $ret;}

function desktop_cond($p,$o=''){$r=m_apps(r_apps(),$p,'');
if($r)return $o?implode(';',$r):$r;}

function desktop_js($d){$r=desktop_cond($d); $ret='';
if($d=='boot' && !$r)$r=array('desktop_desk___desk','page_deskbkg');
if($r)foreach($r as $k=>$v)$ret.=sj($v);//is_array($v)?sj($v[0]):
return $ret;}

function poplist(){$rid=randid('ppl');
$_SESSION['popm']=ljb('philum','poplist',$rid,btd($rid,'='));}

//mimes
function msqmimes(){return msql_read('system','edition_mimes');}
function mime($d,$o=''){$r=sesmk('msqmimes','',0); return $r[$d]??($o?$o:'less');}
function mimes($d,$t='',$sz=''){$ta=mime($d,$t);
if($ta && $ta!='less')$t=$ta; if(!$t)$t='file'; if($t)return picto($t,$sz);}

#meca
//param/title/command/option:module->target§button[,]
function val_to_mod_b($p,$id=''){$ret=[];
$p=str_replace("\n",'',$p); $r=explode(',',$p); $n=count($r);
for($i=0;$i<$n;$i++){//$d='scroll'; $o='12';
	list($comline,$t)=split_right('§',trim($r[$i]),1);
	if(is_numeric($comline)){$rb=msql::row('',nod('mods_'.prmb(1)),$comline);
		if($rb)array_shift($rb); $mod=array_shift($rb);
		list($p,$tb,$d,$c,$o,$ch,$hd,$tp,$br,$dv,$aj)=$rb;}
	else{
		list($code,$mod)=split_right(':',$comline,1);
		$d=$o=$ch=$hd=$tp=$br=$dv=$aj='';
		if(strpos($code,'/')!==false)
			list($p,$tb,$d,$o,$ch,$hd,$tp,$br,$dv,$aj)=opt(trim($code),'/',10);
		else{$p=trim($code);$tb='';}}
	if(!$t)$t=$tb?$tb:$p;
	$p=$p=='id'?$id:$p;
	$ret[$t?$t:$p]=[$mod,$p,$tb,'',$d,$o,$ch,$hd,$tp,$br,$dv,$aj];}
return $ret;}

#Menus
function make_menus_r($r){
$sty='border-left:1px dotted grey; margin:0 0 1px 0; padding-left:15px;';
foreach($r as $k=>$v){list($lk,$d)=submn_t($k); $ret.=divc('',lka($lk,$d));
if(is_array($v)){$ret.=divs($sty,make_menus_r($v));}}
return $ret;}//'&#9500;&#9472;'.

//m_suj
function m_suj_r($r,$cs1,$cs2){
$id=ses('read'); $ret='';
foreach($r as $k=>$v){
$csb=$id==$k?$cs1:$cs2;
$ret.=llk($csb,urlread($k),'• '.suj_of_id($k));
if(is_array($v)){
	if($id==$k or verif_array_exists_s($id,$v)){
		foreach($v as $ka=>$va){$csc=$id==$ka?$cs1:$cs2;
		$ret.=llk($csc,urlread($ka),'-- '.suj_of_id($ka));}}}}
return $ret;}

function m_suj_hierarchic($cs1,$cs2){
$rb=collect_hierarchie($rev); $ret='';
if($rb)foreach($rb as $k=>$v){
$csb=$_SESSION['frm']==$k?$cs1:$cs2;
$ret.=llk($csb,htac('cat').$k,$k);
if($_SESSION['frm']==$k && is_array($v))$ret.=m_suj_r($v,$cs1,$cs2);}
return $ret;}

function m_nodes($mn,$o){//arsort($mn);
if($o)$nb=sql('name,nbarts','qdu','kr','active="1"'); $ret='';
if($mn)foreach($mn as $k=>$v){$css=$k==ses('qb')?'active':'';
	if($o)$add=' ('.$nb[$k][0].')'; if(!$v && $k)$v=$k;
	if($k)$r[]=llk($css,subdomain($k),$v.$add);}//#li
return $r;}
function m_nodes_b($mn,$o){
return scroll_b($mn,implode('',m_nodes($mn,$o)),20);}

#builders
#menus
function submn_t($va){list($k,$v)=explode('§',$va);
if(!is_numeric($k)){
	if(substr($k,0,1)=='?')return [$k,$v];
	//elseif(substr($k,0,1)=='/')return [$k,$v];
	elseif($_SESSION['line'][$v])return [htac('cat').$k,$v];
	elseif($_SESSION['line'][$k])return [htac('cat').$k,$k];
	elseif($v)return [$k,$v];
	elseif($k)return ['',$k];}
else{$tit=suj_of_id($k);
	if($v)return [urlread($k),$v];
	elseif($_SESSION['line'][$k])return [htac('cat').$k,$k];
	elseif($tit)return [urlread($k),picto('file').' '.$tit];
	else return [urlread($k),$k];}}//numeric name

function bubble_menus($t,$inl=''){//mods/submenus
if(!$t)return; $nbo=0; $n="\n"; $r=explode("\n",$t.$n);
foreach($r as $n=>$k){
	$nb=substr_count(substr($k,0,9),'-'); $tit=substr($k,$nb); $tit=trim($tit);
	if($tit){list($lk,$d)=submn_t($tit); $cat[$nb]=$tit; $ct='';
	$ct=$cat[0]; for($i=2;$i<=$nb;$i++)$ct.='/'.$cat[$i-1];
	$isdir=substr($r[$n+1],0,1)=='-'?1:0;
	if($nb==0 && $isdir)$ret.=popbub('bubses',ajx($d),$d,'d');
	elseif($nb==0)$ret.=li(lkc('',$lk,$d));
	else $ra[]=[$d,'link','',$lk,'','',$ct,''];}}
$_SESSION['bubses']=$ra;
return mkbub($ret,$inl,1,'');}

#hierarchies
//collect_hierarchie
function verif_array_exists_s($v,$r){foreach($r as $ka=>$va)if($ka==$v)return true;}
function in_array_k($v,$r){foreach($r as $ka=>$va)if(isset($va[$v]))return true;}
function find_in_subarray($r,$d){foreach($r as $k=>$v){if($k==$d)$ret=$v;
if(is_array($v) && !$ret)$ret=find_in_subarray($v,$d);} if($ret)return $ret;}

//hierarchic_line
function hierarchic_line($r,$line,$rev){$ret=[];
foreach($r as $k=>$v){
	if(is_array($v)){if(in_array_k($k,$line)!=true)$ret[$k]=hierarchic_line($v,$line,$rev);}
	elseif($lv=val($line,$v))$ret[$k]=hierarchic_line($lv,$line,$rev);
	elseif($lk=val($line,$k))$ret[$k]=hierarchic_line($lk,$line,$rev);
	else $ret[$k]=$v;}
if($rev && $ret)krsort($ret);
return $ret;}

function supertriad(){//descend
if(is_array($_SESSION['rqt']))foreach($_SESSION['rqt'] as $k=>$v)
	if($v[10] && is_numeric($v[10]))$line[$v[1]][$v[10]][$k]=$v[2];
return $line;}

function collect_hierarchie($rev){//by_cat
$rb=$_SESSION['line']; $r=supertriad();
if(is_array($r))foreach($r as $k=>$v)$rb[$k]=hierarchic_line($v,$v,$rev);
if($rev && $rb)ksort($rb);
return $rb;}

function supertriad_b(){//descend
if(is_array($_SESSION['rqt']))foreach($_SESSION['rqt'] as $k=>$v)
if(is_numeric($v[10]))$line[$k][$v[10]][$k]=1;
return $line;}

function collect_hierarchie_b($rev){//append
$r=supertriad_b(); if(is_array($r)){
	foreach($r as $k=>$v)$rb[$k]=hierarchic_line($v,$v,$rev);
	ksort($rb);}
return $rb;}

function supertriad_c($d,$p=''){//descend
if($p=='Home'||$p=='user')$p='';
if($r=$_SESSION['rqt'])foreach($r as $k=>$v){
	if($v[10]>0 && (!$p or $v[1]==$p))$line[$v[10]][$k]=1;}
return $line;}

function collect_hierarchie_c($rev,$o){//no_cat
$r=supertriad_c($o?$o:$_SESSION['dayb']);
if(is_array($r)){$rb=hierarchic_line($r,$r,$rev);}
if(is_array($rb)){if($rev)krsort($rb); else ksort($rb);}
return $rb;}

function supertriad_ask($p,$o){
if(!is_numeric($p) or !$p)$p=ses('nbj'); if(!$p)$p=90;
$r=sql('id,ib','qda','kv','day>'.calctime($p)); $rb=[];
if(is_array($r))foreach($r as $k=>$v)if($v>0)$rb[$v]=radd($rb,$v);
if(is_array($rb))arsort($rb);
return $rb;}

function supermenu($r){static $i; $i++;
if(is_array($r))foreach($r as $k=>$v){$ret.=nchar($i,"-");
	if(is_array($v))$ret.=$k."\n".supermenu($v); else $ret.=$k."\n";} $i--;
return $ret;}

#taxonomy//mk_plan
function make_ul($r,$rt,$ul='',$o=''){$ret='';
if($r)foreach($r as $k=>$v){$bt=$rt[$k];
	if(is_array($v))$bt.=make_ul($v,$rt,$ul,$o);
	$ret.=bal('li',atb('type',$o),$bt);}
return balb($ul,$ret);}

function make_ulb($r,$rt,$ul='',$o=''){$ret=''; $i=0;//topologic
foreach($r as $k=>$v){$bt=$rt[$k]; $i++;
	if(is_array($v))$bt.=make_ulb($v,$rt,$ul,($o?$o.'.':'').$i.'');
	$ret.=balb('li',($o?$o.'.':'').$i.'. '.$bt);}
return balb($ul,$ret);}

function taxo_clean(&$r,$rb){
if($rb)foreach($rb as $k=>$v)if(isset($r[$v]))unset($r[$v]);}

function taxo_find(&$rx,$ra,$rb){$ret=[];
foreach($rb as $k=>$v){
	if(isset($ra[$k])){
		if(is_array($ra[$k]))
			$ret[$k]=taxo_find($rx,$ra,$ra[$k]);
		else $ret[$k]=$ra[$k];
		$rx[]=$k;}
	else $ret[$k]=$v;}
return [$rx,$ret];}

//$r[idp][id]=1
function taxonomy($r){$ra=$r; $rx=''; $ret=[];
foreach($r as $k=>$v){
	if(is_array($v))
		$ret[$k]=taxo_find($rx,$ra,$v);
	else $ret[$k]=$v;}
taxo_clean($ret,$rx);
return $ret;}

#pages
function detect_uget($d=''){$ut=explode(' ',$d.' '.prmb(18));
if($ut)foreach($ut as $k=>$v){$vb=eradic_acc($v); if($g=get($vb))
	return [$vb,urldecode($g),urldecode($v)];}}

function btpages_nb($nbp,$pg){
$cases=5; $left=$pg-1; $right=$nbp-$pg; $r[1]=1; $r[$nbp]=1;
for($i=0;$i<$left;$i++){$r[$pg-$i]=1; $i*=2;}
for($i=0;$i<$right;$i++){$r[$pg+$i]=1; $i*=2;}
if($r)ksort($r);
return $r;}

function btpages($nbyp,$pg,$nbarts,$j){$ret='';
if($nbarts>$nbyp){$nbp=ceil($nbarts/$nbyp); if($nbp)$rp=btpages_nb($nbp,$pg);}
if(isset($rp))foreach($rp as $k=>$v)$ret.=lj($k==$pg?'active':'',$j.ajx($k),$k).' ';
if($ret)return btn('nbp',$ret);}

#dig
function define_digr(){$n=maxyears()+5;//25=20y
if($digr=ses('digr'))return $digr;
if(prmb(16)=='auto')$dy=ses('nbj'); else $dy=maxdays();
$r=[1,7,30,90,365]; for($i=5;$i<$n;$i++)$r[]=$r[$i-1]+365;
for($i=0;$i<$n;$i++)if($r[$i]<$dy)$ret[$r[$i]]=$r[$i]<365?$r[$i]:($r[$i]/365);
$_SESSION['digr']=$ret;
return $ret;}

function dig_it_j_nb($r,$n){$nb=count($r); $i=0; $rb=[]; $na=10;
foreach($r as $k=>$v){$i++; if($k==$n)$a=$i;} $i=0;
foreach($r as $k=>$v){$i++; if($i>$a-$na && $i<$a+$na)$rb[$k]=$v;}
return $rb;}

function dig_it_j($n,$j){$r=define_digr(); $ra=dig_it_j_nb($r,$n);//most_read,trk
if(!isset($ra[$n]))$ra[$n]=$n>365?round($n/365,2):$n; $nprev=time_prev($n);
$ra[$n].=' '.($n<365?plurial($ra[$n],3):plurial($ra[$n],7));
if($n!=1 && $n!=7)$ra[$n]=val($ra,$nprev).' '.nms(36).' '.$ra[$n];//from
if($n>365)$ra[$n]=date('Y',calc_date($n));//from
//return btpages(1,$n,count($r),$j);
return slctmenusj($ra,$j,$n);}//divc('float:right;',)

#outputs
function output_arts($r,$md,$tp,$j=''){$rch=getb('search');
if(rstr(39) or $md=='flow'){$fw=$j?0:1; $_POST['flow']=1;}
$npg=prmb(6); $page=$_SESSION['page']; $ret='';
$min=($page-1)*$npg; $max=$page*$npg; $md=slct_media($md); $i=0;
if(is_array($r))foreach($r as $id=>$nb)if($id>0){$i++;
	if($md=='prw')$media=$nb; elseif($rch)$media='rch'; else $media=$md;
	if($i>=$min && $i<$max)$ret.=art_read_b($id,$media,$tp,'',$nb);
	elseif($fw)$ret.=div(atd('d'.$id).atb('data-prw',$media),'');}
$nbpg=!$fw?btpages($npg,$page,$i,$j):'';
return $nbpg.$ret.$nbpg;}

function output_arts_trk($r,$mode,$page,$j,$re,$ord){
$npg=prmb(6); $ret=''; $min=($page-1)*$npg; $max=$page*$npg; $i=0;
if($r)foreach($r as $k=>$v){$id=$mode?$v:$k;
	if(is_numeric($id)){$i++;
	if($i>=$min && $i<$max){
		$rt=read_idy($id,$ord,'',$re,$mode?$k:'');
		$ret.=art_read_t($id,$rt,'');}}}
$nbpg=btpages($npg,$page,$i,$j);
return $nbpg.$ret;}

function read_idy($ib,$o,$frm=0,$re='',$id=''){
$w='ib="'.$ib.'"'.($frm?' and frm="'.$frm.'"':'').''.($re?' and re="'.$re.'"':'').' '.($id?' and id="'.$id.'"':'').' order by day '.$o;
return sql('id,ib,name,mail,day,nod,frm,suj,msg,re,host,lg','qdi','',$w);}

//arts
function import_art($d,$m){
list($dy,$nod,$frm,$suj)=sql('day,nod,frm,suj,img','qda','r','id="'.$d.'"');
$ret=popart($d,$suj).n().n(); //echo $m;
//if($_GET['read']==$d)$m=3; 
//$ret.=read_msg($d,'inner');
return $ret;}

function id_of_urlsuj($d){$id='';
$id=sql('id','qda','v','nod="'.ses('qb').'" and thm="'.$d.'"');//if(rstr(38))
if(!$id){$id=sql('id','qda','v','nod="'.ses('qb').'" and re>="1" and suj like "%'.$d.'%" limit 1');
	if($id){$suj=suj_of_id($id); $thm=hardurl($suj); update('qda','thm',$thm,'id',$id);}}
return $id;}

function id_is_public($id){return sql('id','qda','v','id="'.$id.'" AND re>="1"');}
	
#rqt
function tri_norqt($vrf,$tri){
$ra=['day','frm','suj','img','nod','tag','lu','name','host','mail','ib','lu'];
$cl=is_numeric($tri)?$ra[$tri]:$tri; $dyb=ses('dayb');
$w=$vrf?' and '.$cl.'="'.$vrf.'"':''; $w.=$dyb?' and day>"'.$dyb.'"':'';
return sql('id,'.$cl,'qda','k','nod="'.ses('qb').'" and frm!="_system" and re>0 and substring(frm,1,1)!="_"'.$w.' order by '.prmb(9));}

function tri_rqt($vrf,$tri){
if(!rstr(3))return tri_norqt($vrf,$tri);
$r=$_SESSION['rqt']; $ret='';
if($r)foreach($r as $k=>$v){$vb=$v[$tri]??'';
	if($vrf && $vb==$vrf)$ret[$k]=$vrf;
	elseif(!$vrf)$ret[$k]=$vb;}
return $ret;}

function tri_rqb($vrf,$tri,$trb){
$ret=[]; $dya=ses('daya'); $dyb=ses('dayb'); $qb=ses('qb');
$w=$vrf?' and '.$tri.'="'.$vrf.'"':''; $w.=$dyb?' and day>"'.$dyb.'"':'';
return sql('id,'.$tri.','.$trb,'qda','kkv','nod="'.ses('qb').'" and frm!="_system" and re>0 and substring(frm,1,1)!="_"'.$w.' order by '.prmb(9));
return $ret;}

#utils
function find_navigation($id){$ib=ib_of_id($id);
if(is_numeric($ib) && $ib!=$id && $ib){//$nav=pane_art($ib,'');
$nav=balb('h4',lka(urlread($ib),pictxt('sup',suj_of_id($ib))).' '.popart($ib));
if($ib!=ses('read'))return find_navigation($ib).$nav;}}

function find_art_link($d){
if(is_numeric($d))$wh='id="'.$d.'"'; else $wh='suj="'.$d.'"';
return sql('id','qda','v',$wh.' AND nod="'.ses('qb').'"');}

function send_user_mail($id,$lgtxt){//send_to_author
$sender=$_SESSION['qbin']["adminmail"];
list($kem,$suj)=sql('name,suj','qda','r','id="'.$id.'"');
if($kem!=$_SESSION['USE']){
$nmsg=helps($lgtxt);//.br().br().$suj
	$kmail=sql('mail','qdu','v','name="'.$kem.'"');
	if($kmail!=$_SESSION['qbin']["adminmail"])
		mails::send_html($kmail,$suj,nl2br($nmsg),$sender,urlread($id));}}

function send_mail_r($r,$format,$suj,$msg,$from,$lk){$ret='';
if($r)foreach($r as $k=>$v){if($v){$ret.=btn("txtyl",$v);
send_mail($format,$v,$suj,$msg,$from,$lk);}}
return $ret;}

function send_track_to_user($id){
$sender=$_SESSION['qbin']['adminmail'];//i.
list($name,$day,$idt,$msg)=sql('name,day,frm,msg','qdi','r','id='.$id);
$by=helps('trackmail'); $msg=conn::read($msg,'',$idt)."\n\n";
$msg=nl2br($by."\n\n".'By: '.$name.', '.mkday($day)."\n\n".$msg);
$suj=sql('suj','qda','v','id='.$idt);
$rmails=sql('mail','qdi','k','frm="'.$idt.'"');
if($rmails)$r=array_keys_b($rmails);
if(isset($r))send_mail_r($r,'html',$suj,$msg,$sender,$id);}

function htacb($d,$v,$n){//third_param
if($_SESSION['htacc'])return '/'.$d.'/'.$v.($n?'/':'');
else return '/?'.$d.'='.$v.($n?'&'.$n.'=':'');}

function colonize($re,$prm,$id,$cls,$w='',$b=''){$b=$b?'div':'ul';
$w=$w?$w:cw()-10; $ret=onxcols($re,$prm,$w); 
$wb=atd($id).atc($cls).ats('');//-($prm*5)
return bal($b,$wb,$ret).divc("clear","");}

function columns($re,$o,$id='',$b=''){
$ret=is_array($re)?implode('',$re):$re;
if($o>10)$s='auto '.$o.'px;'; else $s=(is_numeric($o)?$o:3).' auto;';
$sty='columns:'.$s.'; column-gap:16px:';
return div(atd($id).atc('cols'.$b).ats($sty),$ret);}

#images
//img_system
function make_thumb($mg,$prm){$ida='img';
if(!file_exists($ida.'/'.$mg))return; $preb='';
if(substr($mg,0,4)!='http')$pre='imgc/'; else $pre='';
	if($prm=='h')$rpm='height="36" class="imgl"';
	elseif(is_numeric($prm))$rpm='title="'.rqt($prm,'suj').'"';
	elseif($prm=='nl'){$rpm='class="imgl"'; $preb=host();}
	elseif($prm=='hb')$rpm='height="32" class="imgl"';
	elseif($prm=='no')$rpm='';
	elseif(!$prm)$rpm='class="imgl"';
	else{$ida=$prm;$rpm='';}
$thumb=$pre.$mg;
if((!file_exists($thumb) && $mg && $pre) or ses('rebuild_img')){
	list($w,$h)=explode('/',prmb(27)); $mode=$_SESSION['rstr'][16]?0:1;//0=outsize
	make_mini($ida.'/'.$mg,$thumb,$w,$h,$mode);}
return '<img src="'.$preb.'/'.$thumb.'" '.$rpm.'>';}

//xsmall
function make_thumb_c($d,$size='',$s=''){
if(!$size)$size=prmb(27); list($w,$h)=explode('/',$size); $jd='';
if(strpos($d,'?'))$d=strto($d,'?'); $wo=0; $x=ses('rebuild_img');
if(substr($d,0,4)=='http')$b=substr(md5($d),0,6).'.'.strend($d,'.');
else{$b=str_replace(['users/','img/','imgb/','icons','/'],'',$d); $jd='/';}
$thumb=img::thumbname($b,$w,$h.($s?'-'.$s:'')); //$d=jcim($b).$b;//deleted for external imgb/icons
if(is_file($thumb) && !$x)return '<img src="'.$jd.$thumb.'">';//.'?'.randid()
//if(is_file($d))list($wo,$ho,$ty)=getimagesize($d); if($wo){
//if($wo<$w && $ho<$h){if(is_file($thumb))unlink($thumb); $thumb=$d;}
//	elseif(!file_exists($thumb) or ses('rebuild_img'))//}//$jd.
if(is_file($d) or $x)make_mini($d,$thumb,$w,$h,$s);//case of tw img not detected but exists
if(is_file($thumb))return '<img src="'.$jd.$thumb.'">';}//.'?'.randid()

function img_art_lk($im,$id){//list($w)=getimagesize('img/'.$im); if($w>100)
if($im && is_file('img/'.$im))return lj('','popup_popart__3_'.$id.'_3',make_thumb($im,$id));}

function outputimg($r){$ret=''; if($r)foreach($r as $id=>$ra){
if($ra)foreach($ra as $k=>$im)if(is_image($im))$ret.=img_art_lk($im,$id);}
return $ret;}

function art_img($d,$id='',$n=''){
$r=explode('/',$d); $n=$n?$n:$r[0]; if($n===0)return; $srv=prms('srvimg');
if(is_numeric($n) && isset($r[$n]))$rb[1]=$r[$n];
elseif($r)foreach($r as $k=>$v)if(is_file('img/'.$v)){
	list($w,$h)=@getimagesize('img/'.$v); if($w>220 && $h>120 && $w<6400){$rb[$w]=$v; $rk[$w]=$k;}}
	elseif($v && !is_numeric($v) && $srv && is_file($srv.'/img/'.$v))copy($srv.'/img/'.$v,'img/'.$v);
if(isset($rb)){krsort($rb); $ret=current($rb);
	if(!$n && $id && $ret)update('qda','img',$rk[key($rb)].$d,'id',$id);
	return $ret;}}

function minimg($amg,$prm){if($prm=='no')return; $mg=art_img($amg); 
if($mg)return make_thumb($mg,$prm); elseif(rstr(87))return mini_empty($prm);}

function mini_empty($prm){
list($w,$h)=explode('/',prmb(27)); $out='/imgc/'.ses('qb').'_empty.jpg';
$clr=getclrs('',1); if($prm=='nl'||!$prm)$c=atc('imgl');
if(!file_exists($out) or ses('rebuild_img'))graphics($out,$w,$h,'',$clr,'');
return image($out,'','',$c);}

function imgclr($im,$d,$a=''){$r=hexrgb_r($d);
if($a)return imagecolorallocatealpha($im,$r[0],$r[1],$r[2],$a);
else return imagecolorallocate($im,$r[0],$r[1],$r[2]);}

function imgclr_pack($im,$a=''){
$r=['ffffff','000000','ff0000','00ff00','0000ff','ffff00','00ffff','cccccc','999999','ff9900','ff0099','00ff99','0099ff','9900ff','99ff00'];
foreach($r as $k=>$v)$ret[]=imgclr($im,$v,$a);
return $ret;}

function graphics($out,$w,$h,$bit,$c,$tx){$im=imagecreate($w,$h);
list($white,$black,$red,$green,$blue,$yel)=imgclr_pack($im); $clr=imgclr($im,$c);
imagecolortransparent($im,$white); $esp=0;
if($bit){$maxdac=max($bit); $nb_bars=count($bit);
if($nb_bars<$w/2)$esp=2; $ecart=$w/$nb_bars;
if($ecart<10)$tx='off'; $x1=0; $y1=$h-7;
foreach($bit as $k=>$v){$x2=$x1+$ecart;$vac=($v/$maxdac*$y1);//round
	ImageFilledRectangle($im,$x1,$y1-$vac,$x2-$esp,$y1,$clr);
	if($tx=='yes'){
		imagestring($im,1,$x2-$ecart,$y1,substr($k,2),$red);
		imagestring($im,1,$x2-$ecart,$y1-$vac,$v,$yel);}
	$x1+=$ecart;}}
imagepng($im,$out);}

function noload($r){return $r?$r:[1=>1];}

//tags
function artags($slct,$wh,$how,$z=''){
$qdt=ses('qdt'); $qdta=ses('qdta'); $qda=ses('qda');
$sql='select '.$slct.' from '.$qdt.' 
inner join '.$qdta.' on '.$qdt.'.id='.$qdta.'.idtag
inner join '.$qda.' on '.$qda.'.id='.$qdta.'.idart
where nod="'.ses('qb').'" '.$wh.'';
return sql_b($sql,$how,$z);}

function art_tags($id,$o=''){
$wh='and '.ses('qda').'.id='.$id.' order by '.ses('qdta').'.id';
return artags('cat,tag,idtag',$wh,$o?$o:'kkv');}

function tag_arts($tag,$cat='',$nbday='',$pday=''){
$wh='and tag="'.$tag.'"';
if($cat)$wh.=' and cat="'.$cat.'"';
if($nbday)$wh.=' and day>"'.calc_date($nbday).'"';
if($pday)$wh.=' and day<"'.calc_date($pday).'"';
if(prmb(9))$wh.=' order by '.ses('qda').'.'.prmb(9);
return artags('idart',$wh,'k');}

function tags_list($cat='tag',$nbday='',$rub=''){$w='';
if($nbday)$w='and day>"'.calc_date($nbday).'" ';
if($rub)$w.='and frm="'.$rub.'" ';
$wh='and cat="'.$cat.'" '.$w.'group by tag order by tag';
return artags('tag',$wh,'k');}

function tags_list_nb($cat,$nbday='30'){$wh=$cat?'and cat="'.$cat.'" ':'';
$wh.='and day>"'.calc_date($nbday).'" group by tag order by c desc';
return artags('tag,count(idart) as c',$wh,'kv');}

function surcat_list(){$rb=[];
$r=sql('msg','qdd','rv','ib="'.ses('qbd').'" and val="surcat"');
if($r)foreach($r as $k=>$v){list($over,$cat)=split_right('/',$v,1); $rb[$cat]=$over;}
return $rb;}

function cluster_tag($p){//unused now
$r=sql_inner('idtag,tag','qdt','qdtc','idtag','kv',['word'=>$p]);//p($r);
return $r;}

#load
//page-title//les modules ont leur propres titles
function page_titles($o='',$rid=''){//$o=parent
$frm=ses('frm'); $read=ses('read');
if(getb('rssurl')){$p['suj']=nms(15);}//tits
elseif(get('module')=='All'){$p['suj']=get('module'); $p['url']=htac('module').'All';}
elseif($frm){$p['suj']=$frm; $p['url']=htac('cat').$frm;
	$p['float']=catpict($frm,72);}
if($read && $o)$p['parent']=find_navigation($read);//rstr(78)
if($p['suj']=='Home')$p['suj']=nms(69);
return divd('titles',template($p,'titles'));}

//search
function good_rech($rch=''){
$ret=$rch?$rch:ajx(urldecode(get('search')),1); if(!$ret)return;
$ret=str_replace('’',"'",$ret); $ret=utflatindecode($ret); $ret=clean_acc($ret);
$ret=strip_tags($ret); stripslashes($ret); return trim($ret);}

#calendar
/*function prep_calend($ref){
$month=date('m',$ref);$year=date('y',$ref);
$deb=mktime(0,0,0,$month,1,$year);$end=mktime(0,0,0,$month,$nb_j,$year);
$qda=$_SESSION['qda'];$qb=ses('qb');
$day=sql('day','qda','rv','nod="'.$qb.'" AND day<'.$end.' AND day>='.$deb);
for($i=1;$i<=$nb_j;$i++){$debd=mktime(0,0,0,$month,$i,$year);$endd=$debd+86400;
if($day[$i]>$dedb && $day[$i]<=$endd){$io[$i]+=1;}}
return $io;}*/

function calendar($date){
$gd=getdate($date); $dcible=date('d',$_SESSION['daya']); $dyam=$gd['mon'];
$ret.='<table style="font:smaller Arial; text-align:center;">';
$ret.='<tr><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td><td>D</td></tr><tr>';
$first=date('w',mktime(1,1,1,$dyam,1,$gd['year'])); if($first==0)$first=7;
$nbdy=date('t',mktime(1,1,1,$dyam,1,$gd['year']));
for($a=1;$a<$first;$a++)$ret.='<td></td>';
for($i=1;$i<=$nbdy;$i++){$mk=mktime(0,0,0,$dyam,$i,$gd['year']);
$dy=date('d',$mk); if($dy==$dcible)$cssb='style="background-color: #'.getclrs('',4).';'; else $cssb="";
if(is_arts('',$mk+86400,$mk)===true)$lnk=lkc('linc"'.$cssb,'/?module=Home&nbj=1&timetravel='.$dy.'-'.$dyam.'-'.$gd['year'],$dy)."\n";
else $lnk=btn('lina"'.$cssb,$dy)."\n";
$ret.='<td>'.$lnk.'</td>'; 
$a++;if($a==8){$a=1;$ret.='</tr><tr>';}}
$ret.='</tr></table>';
return $ret;}

function is_arts($frm,$daya,$dayb){
if($frm)$fr='AND frm="'.$frm.'" '; if($dayb)$df='AND day>"'.$dayb.'" ';
$n=sql('id','qda','v','nod="'.ses('qb').'" '.$fr.' AND day<"'.$daya.'" '.$df.' ORDER BY day DESC LIMIT 1'); 
if($n)return true;}

function nb_arts($daya,$dayb){return sql('COUNT(id)','qda','v','nod="'.ses('qb').'" AND re>0 AND day<'.$daya.' AND day>'.$dayb.'');}

function m_archives($cyear){
$first=oldest_art();
//$last=last_art('');
if(!$first)$first=0; 
$first_year=date('y',$first); 
$actual_year=date('y');
$ts_year=date('y',$_SESSION['daya']);
$nbsec_in_month=86400*30;//60*60*24;
$nbsec_in_year=31536000;//60*60*24*365=mktime(0,0,0,1,1,1);
$current_year=$cyear?$cyear:$ts_year;
	for($year=$actual_year;$year>=$first_year;$year--){
	$mk=mktime(0,0,0,1,1,$year);
	$y_name=date('Y',$mk);
	$nbay=nb_arts($mk+$nbsec_in_year,$mk);
	$css=date('y',$mk)==$current_year?'active':'';
	$ret.=balc('li',$css,lj('','archives_archives___'.$year,$y_name.' ('.$nbay.')'));
	if($year==$current_year){
	$goto='/?module=All&nbj=30';
		for($ia=12;$ia>0;$ia--){
		$month=mktime(0,0,1,$ia,1,$year);
		$nbdayinmonth=date('t',$month);
		$m_name=date('M',$month); $m_nb=date('m',$month);
		$nbam=nb_arts($month+$nbsec_in_month,$month);//$monthbefore
		$css=date('Ym',$_SESSION['daya'])==$y_name.$m_nb?'active':'';
		if($nbam)$ret.=llk($css,$goto.'&timetravel='.$nbdayinmonth.'-'.$ia.'-'.$year,'- '.$m_name.' ('.$nbam.')');}}}
return $ret;}

function cache_html($read){if(!is_dir('cache'))mkdir('cache');
$f='cache/'.$read.'_'.mkday().'.txt';// or $_SESSION['USE']
if(!is_file($f) or $_GET['rebuild_cachart']){$out=build_blocks(); 
	$rout=implode('',$out); write_file($f,$rout); return $rout;}
else return read_file($f);
$f='cache/'.$read.'_'.mkday(calc_date(1)).'.txt';
if(is_file($f))unlink($f);}

?>