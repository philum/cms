<?php
//philum_specs 

#admin
function m_system(){$auth=$_SESSION['auth']; $id=ses('read'); $top=rstr(69)?'':'d'; $hv=1;
$ra=array(0=>'phi2',1=>'loading',2=>'admin',3=>'apps',4=>'download',5=>'search',6=>'articles',7=>'add',8=>'link',9=>'flag',10=>'time',11=>'phi',12=>'phi1',13=>'list',14=>'user',15=>'menu'); 
foreach($ra as $k=>$v)$ico[$k]=picto($v);
$ret['home']=popbub('home','',$ico[0],$top,$hv);//if(rstr(20))
if(rstr(94))$ret['menuB']=popbub('menubub','',$ico[15],$top,$hv);
if(rstr(95))$ret['menuO']=popbub('overcat','',$ico[15],$top,$hv);
if(rstr(51))$ret['apps']=popbub('apps','',$ico[3],$top,$hv);
if($auth>4)$ret['admin']=popbub('fadm','fastmenu',$ico[2],$top,$hv);
if(rstr(75)){
	if($top)$ret['search']=search_btn(nms(24),'right','',1);
	else $ret['search']=popbub('call','search',$ico[5],$top,$hv);}
if($auth>1){
	if(rstr(83))$ret['ucom']=popbub('call','ucom',$ico[8],$top,$hv);
	if($auth>3 && rstr(76))$ret['batch']=popbub('call','batch',$ico[4],$top,$hv);}
if($auth>2){
	if(rstr(79))$ret['addurl']=popbub('call','addart',$ico[7],$top,$hv);
	else $ret['addart']=li(lja('',sj('popup_addArt____1').' closebub(this);',$ico[7]));}
if(rstr(81))$ret['favs']=llj('','popup_modpop___favs:plug',picto('like'));//favs
if(rstr(80))$ret['arts']=popbub('','arts',$ico[6],$top,$hv);//arts
if($_SESSION['lang']!='all' or rstr(82))$ret['lang']=popbub('lang','lang',$ico[9],$top,$hv);//lang
if(abs(ses('dayx')-ses('daya'))>86400 or rstr(84))//back_in_time
	$ret['time']=popbub('timetravel','',$ico[10],$top,$hv);//archives
if(rstr(48)){if($top)$nm=' '.btn('small',ses('USE'));//usr
	$ret['user']=popbub('user','',$ico[14],$top,$hv);}
if($id && rstr(89))$ret['seek']=popbub('seek','',$ico[13],$top,$hv);//metas
if($id && auth(6))$ret['edit']=li(lj('','popup_metall___'.$id.'_3',picto('tag'))).li(lj('','popup_tit___'.$id.'_3',picto('localize'))).li(lj('','popup_artedit___'.$id.'___autosize',picto('edit')));//edit
if(auth(6) or $_SESSION['dev'])$ret['dev']=popbub('dev','dev',$_SESSION['dev']?$ico[11]:$ico[12],$top,$hv);//dev
$ret['fixit']=btd('fixtit',' ');
//$ret['alert']=' ';
$_POST['popadm']=array_merge_b($_POST['popadm'],$ret);}

//adminx/poplinks
function popadmin(){$top=rstr(69)?'':'d';
$adm=popbub('adhome','',picto('phi2'),$top,1);
foreach($_POST['popadm'] as $k=>$v){
	if(strstr('cache design hub alert log chrono srch',$k))$rtb.=$v;//user 
	else $rta.=$v;}
if($_GET['admin'])$rta=$adm.admin_menus();
elseif($_GET['msql'])$rta=msql_menus_j('');
if($top)$css='inline'; $_POST['popadm']='';
if($rta)$ret=mkbub($rta,$css,'','this.style.zIndex=popz+1;');
if($rtb)$ret.=bts('position:fixed; right:0;',$rtb);//
//if($rtb)$ret.=mkbub($rtb,$css,'left:50%;right:0;
if($top)Head::add('csscode','#page{padding-top:28px;}');
else Head::add('csscode','#page{margin-left:26px;}');
return $ret;}

#arts
function popart($d,$p='',$t=''){if(!$p)$p='articles';
	return lj('','popup_popart__3_'.ajx($d).'_3',pictxt($p,$t));}//pagup
function jread($c,$id,$v){$ic=find_art_link($id);
	if(!rstr(8) or !$ic)return lkc($c,urlread($id),$v);
	else return popart($id,'',$v);}

function pecho_arts($id){$id=find_id($id);
if($_SESSION['rqt'][$id])return $_SESSION['rqt'][$id];
else return sql('day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re','qda','r','id='.$id);}

function read_msg($d,$m){$id=find_id($d); if(!$id)return;
$ok=sql('id','qda','v','id='.$id.' and substring(frm,1,1)!="_" and re>0'); if(!$ok)return;
$ret=sql('msg','qdm','v','id='.$id);
if($m==2 or $m=="noimages" or $m=="nl")$ret=kmax($ret);
if($m!='brut')$ret=format_txt($ret,$m,$d);
return $ret;}

function rqt($id,$n=''){
$r=array('day'=>0,'frm'=>1,'suj'=>2,'img'=>3,'nod'=>4,'tag'=>5,'lu'=>6,'name'=>7,'host'=>8,'mail'=>9,'ib'=>10,'lu'=>11); if(!is_numeric($n))$n=$r[$n];
if($id)return $n?$_SESSION['rqt'][$id][$n]:$_SESSION['rqt'][$id];}

function find_id($id){
if($id=="last")return last_art_rqt();//id_is_public($id)
	elseif(!is_numeric($id))return id_of_suj($id); else return $id;}
function last_art_rqt(){if($_SESSION['rqt'])return key($_SESSION['rqt']);}
function last_art_day(){if($_SESSION['rqt'])$id=key($_SESSION['rqt']); return rqt($id,2);}
function last_art($lastdate){$ld=$lastdate?$lastdate:last_art_day();
return sql('id','qda','v','nod="'.ses('qb').'" AND frm!="_system" AND day>="'.$ld.'" AND re>="1" ORDER BY id DESC LIMIT 1');}
function id_of_suj($id){return sql('id','qda','v','suj="'.$id.'" AND nod="'.ses('qb').'" ORDER BY id DESC LIMIT 1');}//AND re>="1"
function ib_of_id($id){$ib=rqt($id,10); if($ib && $ib!='/')return $ib;
elseif(!$ib)return sql('ib','qda','v','id='.$id);}
function suj_of_id($id){$suj=rqt($id,2); 
return $suj?$suj:sql('suj','qda','v','id='.$id);}
function data_val($v,$id,$val,$m=''){$sq=$id?'ib="'.$id.'" and ':'';
return sql($v,'qdd',$m?$m:'v',$sq.'val="'.$val.'"');}
function count_art($suj,$frm){return sql('COUNT(id)','qda','v','nod="'.ses('qb').'" AND suj="'.$suj.'" AND frm="'.$frm.'" AND re>="1"');}
function cache_art($id){$ret=sql('day,frm,suj,img,nod,thm,lu,author,ip,mail,ib,re','qda','v','id="'.$id.'"'); $_SESSION['rqt'][$id]=$ret;}

function find_cat($nbj){$w='nod="'.ses('qb').'"';
if($_SESSION['prmb'][16])$w.=' AND day>'.calc_date($nbj?$nbj:30);
if($nbj)$r=sql('frm','qda','k',$w); else $r=$_SESSION['line'];
return $r;}

//thumbs
function thumb_name($d,$w,$h){
return 'imgc/'.$_SESSION['qb'].'_'.$w.'x'.$h.'_'.$d;}

function make_thumb_c($d,$size='',$s=''){
if(!$size)$size=prmb(27); list($w,$h)=split('/',$size);
$b=str_replace(array('users/','imgb/','icons','/'),'',$d);
if(substr($d,0,4)!='http')$jd='../';//is_dir($d)?'../'
$thumb=thumb_name(normalize($b),$w,$h.'-'.$s);
if(is_file($d))list($wo,$ho,$ty)=getimagesize($d);
if($wo<$w && $ho<$h){if(is_file($thumb))unlink($thumb); $thumb=$d;}
elseif(!file_exists($thumb) or $_GET['rebuild_img'])
	$thumb=make_mini($d,$thumb,$w,$h,$s);//$jd.
return '<img src="'.$jd.$thumb.'?'.randid().'">';}

function popim_w($im,$d){$sz=read_file('http://'.$d.'/plug/microsql.php?fwidth=../'.$im);
list($w,$h)=explode('_',$sz); $imj=ajx('http://'.$d.'/'.$im);
return ljb('','SaveBf','photo_'.$imj.'_'.($w).'_'.($h).'_'.$id,picto('img'));}
function popim($im,$v,$id=''){if(is_file($im))list($w,$h)=getimagesize($im);
return ljb('','SaveBf','photo_'.ajx($im).'_'.($w).'_'.($h).'_'.$id,pictxt('img',$v));}
function popthumb($f,$s=''){return popim($f,make_thumb_c($f,$s,1));}
function forbidden_img($nnm){$r=explode(' ',$_SESSION['prmb'][21]);
if($r)foreach($r as $v)if($v && strpos($nnm,$v)!==false)return false; return $nnm;}

function read_apps($v){switch($v[1]){//p/t/d/o/c/h/tp/br
case('ajax'): $ret=$v[2].'_'.$v[3].($v[4]?'_'.$v[4]:''); break;
case('art'): $ret='popup_popart__3_'.$v[3].'_3'; break;
case('desktop'): $ret='popup_desktop__3_'.$v[2].'_'.$v[3].'_'.$v[4]; break;//type
case('img'): $ret='popup_popim__3_users/'.ajx($v[3]).'___autosize'; break;
case('file'): $ret=read_apps_reader($v[3]); break;
case('finder'): $ret='popup_finder___'.$v[3].'_'.$v[4]; break;
case('admin'): $ret='popup_admin___'.$v[2].'_'.$v[3].'_'.$v[4]; break;
case('msql'): $ret='popup_msqlp___'.$v[2].'_'.$v[3].'*'.$v[4]; break;//ajx()
//case('iframe'): $ret='popup_plupin___iframe_'.ajx($v[3]).'_autosize'; break;
case('iframe'): $ret='popup_iframe___'.ajx($v[3]).'_iframe__autosize'; break;
case('link'): $ret='popup_iframe___'.ajx($v[3]).'_iframe__autosize'; break;
//case('link'): $ret='socket_ret__url_'.ajx($v[3]); break;
case('url'): $ret='socket_ret__url_'.ajx($v[3]); break;//host().//$v[2]=blank
case('plug'): $ret='popup_plupin___'.$v[2].'_'.$v[3].'_'.$v[4]; break;
case('plup'): $ret='popup_plugin___'.$v[2].'_'.$v[3].'_'.$v[4]; break;
case('plugfunc'): $ret='popup_plup___'.$v[2].'_'.$v[3].'_'.$v[4]; break;
case('api'): $ret='popup_apij___'.ajx($v[3]); break;//menubub
case('ajxlnk2'): $ret='popup_ajxlnk2___'.$v[2].'_'.ajx($v[3]); break;//menubub
case('module'): $ret='popup_modpop___'.ajx($v[3]).'_480'; break;//menubub
case('mod'): $ret='popup_modpop___'.ajx($v[3].'///'.$v[4].'/'.$v[7].'///1:'.$v[2]).'_480'; break;
case('app'): $ret='popup_openapp__3_'.ajx($v[2]).'_'.$v[3].'_'.$v[4]; break;
case('bub'): $ret='bubble_popbub__d'.randid().'_'.$v[2].'_'.$v[3]; break;//loos mod
}//ajax,art,file,finder,admin,msql,iframe,link,url,plug,plup,plugfunc,mod,bub
return $ret;}

//if($r)$r=virtual_array($r,$o); //$r=select_subarray($p,$r,$o);
function match_vdir($dr,$nd,$rv){
for($i=0;$i<$nd;$i++)if($dr[$i]!=$rv[$i])return false;
return true;} 

//0:button,1:type,2:process,3:param,4:opt,5:cond,6:root,7:icon,8:hide,9:private)
function m_apps($r,$cnd,$dir,$p='',$o=''){if($p)$p=ajx($p);
$dr=explode('/',$dir); $nd=$dir?count($dr):0;
if($r)foreach($r as $k=>$v){
if(strpos($v[5],$cnd)!==false && $cnd=='boot' && !$v[8])$ret[]=read_apps($v);
elseif(strpos($v[5],$cnd)!==false or !$v[5]){$t=$v[0];
	if($v[1]=='art'){if($v[2]=='auto')$t=suj_of_id($v[3]); else $t=$v[2];
		if($t)$v[7]=apps_arts_thumb($v[3],$v[7]);}
	elseif($v[1]=='file' && is_image($v[3]))$v[7]=make_thumb_c($v[3],'38/38',1);
	elseif($v[1]=='img')$v[7]=make_thumb_c('users/'.$v[3],'38/38',1);//
	$_SESSION['apico'][$t]=$v[7]; $rv=explode('/',$v[6]); $nv=$v[6]?count($rv):0;
	if($dir==$v[6])$is=true; else $is=match_vdir($dr,$nd,$rv);
	if($is && $nv==$nd+1 && !$v[8] && auth($v[9])){//dirs
		$ret[$rv[$nv-1]]='popup_desktop__2_'.$cnd.'_'.ajx($v[6]).'_'.$p.'_'.$o;}
	elseif($is && $rv[$nd] && !$v[8]){$v6=implode('/',array_slice($rv,0,$nd+1));
		$ret[$rv[$nd]]='popup_desktop__2_'.$cnd.'_'.ajx($v6).'_'.$p.'_'.$o;}
	if($is && $nv>$nd)$is=false;
	if($is && !$v[8] && (!$v[9] or auth($v[9]))){$j=read_apps($v);
		//if($v[1]=='link')$ret[$t]=array('link',$v[3]);
		if($j)$ret[$t]=$j;}}}
return $ret;}

function r_apps($p=''){$p=$p?$p:'apps';
if(rstr(61))$r=msql_read_b('system','default_apps','',1);
$rb=msql_read_b('',ses('qb').'_'.$p,'',1);
$ret=array_merge_p($r,$rb);
return $ret;}

function array_merge_p($r,$rb){if($rb)$kb=array_keys_r($rb,0,'k');
if($r)foreach($r as $k=>$v)if($n=$kb[$v[0]])$r[$k]=$rb[$n]; 
if($r)$ka=array_keys_r($r,0,'k'); 
if($rb)foreach($rb as $k=>$v)if(!$r[$ka[$v[0]]])$r[]=$v; 
return $r;}
function array_merge_px($r,$rb){if($r)$ka=array_keys_r($r,0,'k');
if($rb)foreach($rb as $k=>$v)if(!$r[$ka[$v[0]]])$r[]=$v; 
return $r;}

//arts
function apps_arts_thumb($d,$p=''){//$_GET['rebuild_img']=1;
$img=sql('img','qda','v','id='.$d); if($img)$f=strprm($img,1,'/');
if($f)return make_thumb_c('img/'.$f,'38/38',1); else return $p?$p:'articles';}

//call
function desktop_apps($id,$va,$opt,$o){
if($id=='varts')$r=apps_varts($id,$opt);
elseif($id=='arts')$r=apps_arts($id,$opt,$o);
elseif($id=='files')$r=apps_files($id,$opt,$o);
elseif($id=='explore')$r=apps_explore($va,$opt);
elseif($id=='menubub')$r=apps_menubub($va);
elseif($id=='overcats')$r=apps_overcats($va);
else $r=r_apps(); //pr($r);
return m_apps($r,$id?$id:'desk',$va,$opt,$o);}

function desk_icon($k,$j){$ic=$_SESSION['apico'][$k];
$ra=array('popart'=>'articles','msql'=>'server','plug'=>'get','desktop'=>'folder');
if($j)$ica=strprm($j,1,'_'); 
if($ica=='desktop' or !$ic)$ic=$ra[$ica]; return $ic;}

function icoart($k,$v,$c){
if(is_numeric($k)){$v='popup_popart___'.$k; $ic=apps_arts_thumb($k); $k=suj_of_id($k);}
else $ic=desk_icon($k,$v);
$ico=strpos($ic,'<')!==false?btn('small',$ic):mimes($k,$ic,32);
return lj('" title="'.$k,$v,divb($c,$ico.' '.bts('display:block',$k)));}

function desktop_build_ico($r,$c){
if($r)foreach($r as $k=>$v)$ret.=icoart($k,$v,$c);
return $ret;}

function app_list($r,$c,$cl=''){
if($r)foreach($r as $k=>$v){$ic=desk_icon($k,$v); $ico=mimes($k,$ic,'');
	$ret.=lj($cl.'" title="'.$k,$v,$ico,$c).' ';}
return $ret;}

function desktop_cond($p,$o=''){$r=m_apps(r_apps(),$p,'');
if($r)return $o?implode(';',$r):$r;}

function desktop_js($d){$r=desktop_cond($d);
if($d=='boot' && !$r)$r=array('desktop_desk___desk','page_deskbkg');
if($r)foreach($r as $k=>$v)$ret.=sj($v);//is_array($v)?sj($v[0]):
return $ret;}

function poplist(){$rid=randid('ppl');
$_SESSION['popm']=ljb('philum','poplist',$rid,btd($rid,'�')).' ';}

//mimes
function msqmimes(){return msql_read('system','edition_mimes');}
function mimes_types($d){$r=sesmk('msqmimes','',0); return $r[$d]!=false?$r[$d]:'less';}
function mimes($d,$t='',$sz=''){$ta=mimes_types($d);
if($ta && $ta!='less')$t=$ta; if(!$t)$t='file'; if($t)return picto($t,$sz);}
#meca
//param/title/command/option:module->target�button[,]
function val_to_mod_b($p){
$p=str_replace("\n","",$p); $r=explode(",",$p); $n=count($r);
for($i=0;$i<$n;$i++){//$d='scroll'; $o='12';
	list($comline,$t)=split_right('�',trim($r[$i]),1);
	list($code,$mod)=split_right(':',$comline,1);
	if(strpos($code,'/')!==false)
		list($p,$tb,$d,$o,$ch,$hd,$tp,$br,$dv,$aj)=explode("/",trim($code)); 
	else{$p=trim($code);$tb='';} if(!$t)$t=$tb?$tb:$p;
	$ret[$t?$t:$p]=array($mod,$p,$tb,$c,$d,$o,$ch,$hd,$tp,$br,$dv,$aj);}//($tb?$tb:$p)
return $ret;}

#access
function jcim($f,$o=''){if($o)$a=$f; 
if($o && substr($f,0,4)=='http')return $f;
return (strpos($f,'/')?'users/':'img/').$a;}//strip /

function goodroot($f,$h=''){//jcim()
if($h==1)$h=host().'/'; elseif($h)$h=http($h).'/';
if(substr($f,0,4)=='http')return $f;
elseif(substr($f,0,3)=='../')return $f;
elseif(strpos($f,'/')===false)return $h.'img/'.$f;
elseif(strpos($f,'users/')===false)return $h.'users/'.$f;//&&strpos($f,"img/")===false
else return root($f);}

#Menus
function make_menus_r($r){static $i; $i++;
$sty='border-left:1px dotted grey; margin:0 0 1px 0; padding-left:15px;';
foreach($r as $k=>$v){list($lk,$d)=submn_t($k); $ret.=divc('',lka($lk,$d));
if(is_array($v)){$ret.=divs($sty,make_menus_r($v)); $i--;}}
return $ret;}//'&#9500;&#9472;'.

//m_suj
function m_suj_r($r,$cs1,$cs2){$id=ses('read');
foreach($r as $k=>$v){
$csb=$id==$k?$cs1:$cs2;
$ret.=llk($csb,urlread($k),'� '.suj_of_id($k));
if(is_array($v)){
	if($id==$k or verif_array_exists_s($id,$v)){
		foreach($v as $ka=>$va){$csc=$id==$ka?$cs1:$cs2;
		$ret.=llk($csc,urlread($ka),'-- '.suj_of_id($ka));}}}}
return $ret;}

function m_suj_hierarchic($cs1,$cs2){
if(is_array($_SESSION['superline'])){
//$superline=collect_hierarchie($rev);
foreach($_SESSION['superline'] as $k=>$v){
$csb=$_SESSION['frm']==$k?$cs1:$cs2;
$ret.=llk($csb,htac('cat').$k,$k);
if($_SESSION['frm']==$k && is_array($v))$ret.=m_suj_r($v,$cs1,$cs2);}}
return $ret;}

function m_nodes($mn,$o){//arsort($mn);
if($o)$nb=sql('name,nbarts','qdu','kr','active="1"');
if($mn)foreach($mn as $k=>$v){$css=$k==ses('qb')?'active':'';
	if($o)$add=' ('.$nb[$k][0].')'; if(!$v && $k)$v=$k;
	if($k)$r[]=llk($css,subdom($k),$v.$add);}//#li
return $r;}
function m_nodes_b($mn,$o){
return scroll_b($mn,implode('',m_nodes($mn,$o)),20);}

#builders
#menus
function submn_t($va){list($k,$v)=explode('�',$va);
if(!is_numeric($k)){
	if(substr($k,0,1)=='?')return array($k,$v);
	//elseif(substr($k,0,1)=='/')return array($k,$v);
	elseif($_SESSION['line'][$v])return array(htac('cat').$k,$v);
	elseif($_SESSION['line'][$k])return array(htac('cat').$k,$k);
	elseif($v)return array($k,$v);
	elseif($k)return array('',$k);}
else{$tit=suj_of_id($k);
	if($v)return array(urlread($k),$v);
	elseif($_SESSION['line'][$k])return array(htac('cat').$k,$k);
	elseif($tit)return array(urlread($k),picto('file').' '.$tit);
	else return array(urlread($k),$k);}}//numeric name

function bubble_menus($t,$inl=''){//mods/submenus
if(!$t)return; $nbo=0; $n="\n"; $r=explode("\n",$t.$n);
foreach($r as $n=>$k){
	$nb=substr_count(substr($k,0,9),'-'); $tit=substr($k,$nb); $tit=trim($tit);
	if($tit){list($lk,$d)=submn_t($tit); $cat[$nb]=$tit; $ct='';
	$ct=$cat[0]; for($i=2;$i<=$nb;$i++)$ct.='/'.$cat[$i-1];
	$isdir=substr($r[$n+1],0,1)=='-'?1:0;
	if($nb==0 && $isdir)$ret.=popbub('bubses',ajx($d),$d,'d');
	elseif($nb==0)$ret.=li(lkc('',$lk,$d));
	else $ra[]=array($d,'link','',$lk,'','',$ct,'');}}
$_SESSION['bubses']=$ra;
return mkbub($ret,$inl,1,'');}

#hierarchies
//collect_hierarchie
function verif_array_exists_s($v,$r){foreach($r as $ka=>$va)if($ka==$v)return true;}
function in_array_k($v,$r){foreach($r as $ka=>$va)if(isset($va[$v]))return true;}
function find_in_subarray($r,$d){foreach($r as $k=>$v){if($k==$d)$ret=$v;
if(is_array($v) && !$ret)$ret=find_in_subarray($v,$d);} if($ret)return $ret;}

//hierarchic_line
function hierarchic_line($r,$line,$rev){
foreach($r as $k=>$v){if(is_array($v)){if(in_array_k($k,$line)!=true){
	$ret[$k]=hierarchic_line($v,$line,$rev);}}
	elseif(is_array(@$line[$v]))$ret[$k]=hierarchic_line($line[$v],$line,$rev);
	elseif(is_array(@$line[$k]))$ret[$k]=hierarchic_line($line[$k],$line,$rev);
	else $ret[$k]=$v;}
if($rev && $ret)krsort($ret);
return $ret;}
function supertriad(){//descend
if(is_array($_SESSION['rqt'])){
foreach($_SESSION['rqt'] as $k=>$v){
	if($v[10] && is_numeric($v[10]))$line[$v[1]][$v[10]][$k]=$v[2];}
return $line;}}

function collect_hierarchie($rev){//by_cat
	$superline=$_SESSION['line']; $r=supertriad();
	if(is_array($r))foreach($r as $k=>$v)$superline[$k]=hierarchic_line($v,$v,$rev);
	if($rev && $superline)ksort($superline);
return $superline;}

function supertriad_b(){//descend
if(is_array($_SESSION['rqt'])){
foreach($_SESSION['rqt'] as $k=>$v)
	if(is_numeric($v[10]))$line[$k][$v[10]][$k]=1;
return $line;}}

function collect_hierarchie_b($rev){//append
$r=supertriad_b(); if(is_array($r)){
	foreach($r as $k=>$v)$superline[$k]=hierarchic_line($v,$v,$rev);
	ksort($superline);}
return $superline;}

function collect_hierarchie_c($rev,$o){//no_cat
	$r=supertriad_c($o?$o:$_SESSION['dayb']);
	if(is_array($r)){$superline=hierarchic_line($r,$r,$rev);}
	if(is_array($superline)){if($rev)krsort($superline); else ksort($superline);}
return $superline;}

//if($_SESSION['frm']!='Home')$sq=' AND frm="'.$_SESSION['frm'].'"';
function id_of_ib($ib){return sql('id','qda','k','ib="'.$ib.'" limit 1');}
function verif_array_exists_r($r,$d){foreach($r as $k=>$v){if($k==$d)$ret=true;//ib exs
	if(is_array($v) && !$ret)$ret=verif_array_exists_r($v,$d);} return $ret;}//id exs

function ibofid_r($id,$r){$ib=rqt($id,10);//parent.parent...
if(!$ib)$ib=sql('ib','qda','v','id='.$id); 
if($ib && $ib!='/'){$r[$ib][$id]=1; $r=ibofid_r($ib,$r);}
//foreach($r as $k=>$v){$rb=id_of_ib($k); if($rb)$r[$k]+=$rb;}
return $r;}

function supertriad_compintime($r,$o){if($r)foreach($r as $k=>$v){$ib=ib_of_id($k); 
	if($ib && is_numeric($ib) && !verif_array_exists_r($r,$ib)){$r[$ib][$k]=1;
		$rb=id_of_ib($ib); if($rb)$r[$ib]+=$rb;}
	$rb=id_of_ib($k); if($rb)$r[$k]+=$rb;
	if($o)$r=ibofid_r($k,$r);}
return $r;}

function supertriad_c($d,$p=''){//descend
if($p=='Home' or $p=='user')$p=''; //$da=calc_date($d);
if($r=$_SESSION['rqt'])foreach($r as $k=>$v){
	if($v[10]>0 && (!$p or $v[1]==$p))// && $v[0]>$da
		$line[$v[10]][$k]=1;}
return $line;}

function collect_hierarchie_d($rev,$o=''){//dig
	$r=supertriad_c($_SESSION['dayb'],$_SESSION['frm']);//_d
	$r=supertriad_compintime($r,$o);
	if(is_array($r))$superline=hierarchic_line($r,$r,$rev);
	if(is_array($superline)){if($rev)krsort($superline); else ksort($superline);}
return $superline;}

//
function supertriad_ask(){ 
if(is_array($_SESSION['rqt'])){
foreach($_SESSION['rqt'] as $k=>$v)if($v[10]>0)$line[$v[10]]+=1;//up
	if(is_array($line))arsort($line);
return $line;}}

function supermenu($r){static $i; $i++;
if(is_array($r))foreach($r as $k=>$v){$ret.=nchar($i,"-");
	if(is_array($v))$ret.=$k."\n".supermenu($v); else $ret.=$k."\n";} $i--;
return $ret;}

#pages
function detect_uget($d=''){$ut=explode(' ',$d.' '.prmb(18));
if($ut)foreach($ut as $k=>$v)if($g=$_GET[eradic_acc($v)])
return array(eradic_acc($v),urldecode($g),urldecode($v));}

function recup_get($dr){
if($_POST['dig'])$_GET['dig']=$_POST['dig']; 
if($_GET['msql'])return'/msql/'.$_GET['msql'].'/page/';
if($_SESSION['htacc'] && !$dr){list($g,$u)=detect_uget('tag cat admin module');
	if($_GET['search']){return '/search/'.$_GET['search'].'/'.$_GET['dig'].'/page/';}
	elseif($_GET['module']){list($o,$p)=split_right(':',$_GET['module']);
		return '/module/'.$p.($o?'/'.$o:'').'/page/';}
	elseif($_GET['context'])return '/context/'.$_GET['context'].'/page/';
	elseif(!$g)return '/module/Home/page/';
	else return '/'.$g.'/'.$u.'/'.$_GET['dig'].'/page/';}
if($_GET['search'])$ret='search='.$_GET['search'];
elseif($_GET['module'])$ret='module='.$_GET['module'];
elseif($_GET)foreach($_GET as $k=>$v){if($k!='page' && $k!='callj' && $k!='res' && $k!='cat' && $k!='tag' && $k!='titles' && $k!='bool' && $k!='plug'){$ret.=$k.'='.$v.'&';}}
return '/'.$dr.'?'.$ret.'page=';}

//function nb_page_lk(){}
function nb_page($tot,$npg,$page,$no=''){$ng=2;
$anc='<a name="pages"></a>'; $inue=recup_get($no);
if($tot && $npg)$npgf=ceil($tot/$npg);
if($npgf>1){for($i=1;$i<=$npgf;$i++){$css=$i==$page?'active':'';
	if($i>$page-$ng && $i<$page+$ng)$ret.=lkc($css,$inue.$i,$i).' ';}
if($page>$ng){$reta=lka($inue.'1',"1").' '; $mip=round(($page-$ng)/2);
if($mip>1)$reta.=lka($inue.$mip,$mip).' ';}
$mib=$npgf-round(($npgf-($page+$ng))/2);
if($mib>$page+$ng)$retb=lka($inue.$mib,$mib).' ';
if($page+$ng<=$npgf)$retb.=lka($inue.$npgf,$npgf).' ';
if($i>=1)return $anc.divc('nb_pages',$reta.$ret.$retb);}}

#desktop
function read_apps_reader($f){$xt=xtb($f); $fj=ajx($f);//finder_reader
if($xt=='.mp3')return 'popup_popmp3___'.$fj;
if(strpos('.jpg.png.gif',$xt)!==false)return 'popup_popim___users/'.$fj.'___autosize';
return 'popup_fifunc___fi*reader*pop_'.$fj.'_';}

#outputs
function output_pages($otp,$md,$tp){$rch=get('search');
if(rstr(39) or $md=='flow'){$fw=1; $_POST['flow']=1;}
$npg=$_SESSION['prmb'][6]; $page=$_SESSION['page'];
$min=($page-1)*$npg; $max=$page*$npg; $md=slct_media($md);
if(is_array($otp))foreach($otp as $id=>$nb)if($id>0){$i++;
	if($md=='prw')$media=$nb; elseif($rch)$media='rch'; else $media=$md;
	if($i>=$min && $i<$max)$ret.=art_read_b($id,$nb,$media,$tp);
	elseif($fw)$ret.=div(atd($id).atc($media),'');}
if(!$fw)$nbpg=nb_page($i,$npg,$page);
return $nbpg.$ret.$nbpg;}

function output_pages_spe($otp,$media,$spe){
$npg=$_SESSION['prmb'][6]; $page=$_SESSION['page'];
$min=($page-1)*$npg; $max=$page*$npg;
	if(is_array($otp))foreach($otp as $id=>$nb)if(is_numeric($id)){$i++;
	//if($i>=$min && $i<$max){}
	if($spe=='track')$ret.=art_read_b($id,'',1,'').output_trk(read_idy($id,'ASC'));
	else $ret.=art_read_b($id,$nb,$media,'');}
//$n_pages=nb_page($i,$npg,$page);
return $n_pages.$ret.$n_pages;}

function import_art($d,$m){
list($dy,$nod,$frm,$suj)=sql('day,nod,frm,suj,img','qda','r','id="'.$d.'"');
$nde=$_SESSION['mn'][$nod];//.'#'.$id
$ret=lkc("txtsmall",urlread($d),$nde.' ('.$frm.') '.mkday($dy)).' ';
if($_GET['read']==$d)$m=3; $msg=read_msg($d,$m);
$msg=str_replace("<br />","",$msg);//if(rstr(13))
return $ret.$msg;}

function id_of_urlsuj($d){return sql('id','qda','v','nod="'.ses('qb').'" AND re>="1" AND suj LIKE "%'.$d.'%" LIMIT 1');}
function id_is_public($id){return sql('id','qda','v','id="'.$id.'" AND re>="1"');}

//trackback
function read_idy($id,$dsc){//i.nod
return sql('id','qdi','k','nod="'.ses('qb').'" AND frm="'.$id.'" ORDER BY day '.$dsc);}
	
#rqt

//tri_cache
function tri_rqt($vrf,$tri){
	if($_SESSION['rqt'])foreach($_SESSION['rqt'] as $k=>$v){
	if($vrf){if(strpos($v[$tri],$vrf)!==false)$curr=$vrf;} else $curr='';
	if($curr==$vrf)$ret[$k]=$v[$tri];}
	return $ret;}
function tri_rqbase($vrf,$tri,$nb,$dya,$dyb,$qb){//$tri=1;
	if($r=$_SESSION['rqt']){foreach($r as $k=>$v){
	if($vrf)$curr=$v[$tri]; if($qb)$vrfqb=$v[4]; 
	if($curr==$vrf && $vrfqb==$qb && $v[0]>=$dyb && $v[0]<=$dya && $v[$nb] && substr($v[1],0,1)!="_"){$i[$v[$nb]]++; 
	if($i[$v[$nb]]<100)$ret[$v[$nb]][$k]+=1;}}}
return $ret;}

# utils
function find_navigation($id){$ib=ib_of_id($id);
if(is_numeric($ib) && $ib!=$id && $ib){//$nav=pane_art($ib,'');
$nav=bal('h4',lka(urlread($ib),pictxt('topo',suj_of_id($ib))).' '.popart($ib));
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
		send_mail_html($kmail,$suj,nl2br($nmsg),$sender,urlread($id));}}

function send_mail_r($r,$format,$suj,$msg,$from,$lk){
if($r)foreach($r as $k=>$v){if($v){$ret.=btn("txtyl",$v);
send_mail($format,$v,$suj,$msg,$from,$lk);}}
return $ret;}

function send_track_to_user($id){
$sender=$_SESSION['qbin']['adminmail'];//i.
list($name,$day,$idt,$msg)=sql('name,day,frm,msg','qdi','r','id='.$id);
$by=helps('trackmail'); $msg=format_txt($msg,'',$idt)."\n\n";
$msg=nl2br($by."\n\n".'By: '.$name.', '.mkday($day)."\n\n".$msg);
$suj=sql('suj','qda','v','id='.$idt);
$rmails=sql('mail','qdi','k','frm="'.$idt.'"');
if($rmails)$r=array_keys_b($rmails);
if($r)send_mail_r($r,'html',$suj,$msg,$sender,$id);}

function htacb($d,$v,$n){//third_param
if($_SESSION['htacc'])return '/'.$d.'/'.$v.($n?'/':'');
else return '/?'.$d.'='.$v.($n?'&'.$n.'=':'');}

function colonize($re,$prm,$id,$cls,$w='',$b=''){$b=$b?'div':'ul';
$w=$w?$w:currentwidth()-10; $ret=onxcols($re,$prm,$w); 
$wb=atd($id).atc($cls).ats('width:100%;');//-($prm*5)
return balb($b,$wb,$ret).divc("clear","");}

function columns($re,$o,$id='',$b=''){
$ret=is_array($re)?implode('',$re):$re;
if($o>10)$s='auto '.$o.'px;'; else $s=(is_numeric($o)?$o:3).' auto;';
$sty='columns:'.$s.' -moz-columns:'.$s;
return div(atd($id).atc('cols'.$b).ats($sty),$ret);}

#images
//img_system
function make_thumb($mg,$prm){$ida='img';
if(!file_exists($ida.'/'.$mg))return;
if(substr($mg,0,4)!="http")$pre='imgc/'; else $pre="";
	if($prm=="h")$rpm='height="36" class="imgl"';
	elseif(is_numeric($prm))$rpm='title="'.rqt($prm,2).'"';
	elseif($prm=="nl"){$rpm='class="imgl"'; $preb=host();}
	elseif($prm=="hb")$rpm='height="32" class="imgl"';
	elseif($prm=="no")$rpm='';
	elseif($prm=="")$rpm='class="imgl"';
	else{$ida=$prm;$rpm='';}
$thumb=$pre.$mg;
if((!file_exists($thumb) && $mg && $pre) or $_GET['rebuild_img']){
	list($w,$h)=split('/',prmb(27)); $mode=$_SESSION['rstr'][16]?0:2; 
	make_mini($ida.'/'.$mg,$thumb,$w,$h,$mode);}
return '<img src="'.$preb.'/'.$thumb.'" '.$rpm.'>';}

function img_art_lk($im,$id){
if($im && is_file('img/'.$im))list($w)=getimagesize('img/'.$im); 
if($w>100)return lkc('',urlread($id),make_thumb($im,$id));}
function img_art($id,$o=''){$d=rqt($id,3);
if(!$d)$d=sql('img','qda','v','id='.$id); $r=explode("/",$d);
if($r)foreach($r as $v)if($v)$ret.=img_art_lk($v,$id);
return $ret;}
function outputimg($r){ 
if($r)foreach($r as $id=>$v)$ret.=img_art($id,1);
return $ret;}
function first_img($d){$r=explode('/',$d); $n=count($r);
for($i=0;$i<$n;$i++){$xt=substr($r[$i],-3);
if($xt=="jpg" or $xt=="gif" or $xt=="png")return $r[$i];}}
function best_img($d){$r=explode('/',$d); $n=count($r);
if($r)foreach($r as $v)if(is_file('img/'.$v)){list($w,$h)=getimagesize('img/'.$v);
if($w && $w<4000)$rb[$w]=$v;}
if($rb){krsort($rb); return current($rb);}}
function minimg($amg,$prm){if($prm=='no')return; $mg=first_img($amg); 
if($mg)return make_thumb($mg,$prm); elseif(rstr(87))return mini_empty($prm);}

function mini_empty($prm){
list($w,$h)=split("/",prmb(27)); $out='imgc/'.ses('qb').'_empty.jpg';
$clr=$_SESSION['clrs'][$_SESSION['prmd']][1];
if(!$prm or $prm=='nl')$c=atc('imgl');
if(!file_exists($out) or $_GET['rebuild_img'])graphics($out,$w,$h,'',$clr,'');
return image($out,'','',$c);}

function imgclr($im,$d,$a=''){$r=hexrgb_r($d);
if($a)return imagecolorallocatealpha($im,$r[0],$r[1],$r[2],$a);
else return imagecolorallocate($im,$r[0],$r[1],$r[2]);}
function imgclr_pack($im){$r=array('white'=>'ffffff','black'=>'000000','red'=>'ff0000','green'=>'00ff00','blue'=>'0000ff','yellow'=>'ffff00');
foreach($r as $k=>$v)$ret[]=imgclr($im,$v);
return $ret;}

function graphics($out,$w,$h,$bit,$c,$tx){$im=imagecreate($w,$h);
list($white,$black,$red,$green,$blue,$yel)=imgclr_pack($im); $clr=imgclr($im,$c);
imagecolortransparent($im,$white);
if($bit){$maxdac=max($bit); $nb_bars=count($bit);
if($nb_bars<$w/2)$esp=2; $ecart=$w/$nb_bars;
if($ecart<10)$tx="off"; $x1=0; $y1=$h-7;
foreach($bit as $k=>$v){$x2=$x1+$ecart; $vac=($v/$maxdac*$y1);//round
	ImageFilledRectangle($im,$x1,$y1-$vac,$x2-$esp,$y1,$clr);
	if($tx=="yes"){
		imagestring($im,1,$x2-$ecart,$y1,substr($k,2),$red);
		imagestring($im,1,$x2-$ecart,$y1-$vac,$v,$yel);}
	$x1+=$ecart;}}
imagepng($im,$out);}

#loads
function define_digr(){
if($_SESSION['digr'])return $_SESSION['digr'];
if(prmb(16)=='auto')$dy=ses('nbj');
else{$day=sql('day','qda','v','nod="'.$_SESSION['qb'].'" AND re>="1" ORDER BY id ASC LIMIT 1');
$dy=round(time()-$day)/86400;}
$r=array(1,7,30,90,365); for($i=5;$i<20;$i++)$r[]=$r[$i-1]+365;
for($i=0;$i<15;$i++){if($r[$i]<$dy)$_SESSION['digr'][$r[$i]]=$r[$i]<365?$r[$i]:$r[$i]/365;}
return $_SESSION['digr'];}

function dig_it_j($n,$go){$r=define_digr();//most_read
if(!$r[$n])$r[$n]=$n>365?round($n/365,2):$n; $nprev=time_prev($n);
$r[$n].=' '.($n<365?plurial($r[$n],3):plurial($r[$n],7));
if($n!=1 && $n!=7)$r[$n]=$r[$nprev].' '.nms(36).' '.$r[$n];//from
if($n>365)$r[$n]=date('Y',calc_date($n));//from
return divs('float:right;',slctmenus_sj($r,$go,$n));}

function noload($r){return $r?$r:array(1=>1);}

//tags
function artags($slct,$wh,$how,$z=''){
$qdt=ses('qdt'); $qdta=ses('qdta'); $qda=ses('qda');
$sql='select '.$slct.' from '.$qdt.' 
inner join '.$qdta.' on '.$qdt.'.id='.$qdta.'.idtag
inner join '.$qda.' on '.$qda.'.id='.$qdta.'.idart
where nod="'.ses('qb').'" '.$wh.'';
return sql_b($sql,$how,$z);}

function art_tags($id){
$wh='and '.ses('qda').'.id='.$id.' order by '.ses('qdta').'.id';
return artags('cat,tag',$wh,'kk');}

function tag_arts($tag,$cat='',$nbday='',$pday=''){
$wh='and tag="'.$tag.'"';
if($cat)$wh.=' and cat="'.$cat.'"';
if($nbday)$wh.=' and day>"'.calc_date($nbday).'"';
if($pday)$wh.=' and day<"'.calc_date($pday).'"';
if(prmb(9))$wh.=' order by '.ses('qda').'.'.prmb(9);
return artags('idart',$wh,'k');}

function tags_list($cat='tag',$nbday='30'){
$wh='and cat="'.$cat.'" and day>"'.calc_date($nbday).'" group by tag order by tag';
return artags('tag',$wh,'k');}

function tags_list_nb($cat,$nbday='30'){if($cat)$wh='and cat="'.$cat.'" ';
$wh.='and day>"'.calc_date($nbday).'" group by tag order by c desc';
return artags('tag,count(idart) as c',$wh,'kv');}

//load

#page-title//les modules ont leur propres titles
function page_titles($o='',$rid=''){//$o=parent
$frm=ses('frm'); $read=ses('read');
if(get('rssurl')){$p['suj']=nms(15);}//tits
elseif(get('module')=='All'){$p['suj']=get('module'); $p['url']=htac('module').'All';}
elseif($frm){$p['suj']=$frm; $p['url']=htac('cat').$frm;}
if($read && $o)$p['parent']=find_navigation($read);//rstr(78)
if($p['suj']=='Home')$p['suj']=nms(69);
return divd('titles',template($p,'titles'));}

//search
function good_rech($rch=''){
$ret=$rch?$rch:ajx(urldecode($_GET['search']),1); if(!$ret)return;
$ret=str_replace('�',"'",$ret); $ret=utflatindecode($ret); $ret=clean_acc($ret);
$ret=strip_tags($ret); stripslashes($ret); $ret=trim($ret); return $ret;}

function rech_internal($rech){$load=search_engine($rech);
$t=btn('',lka(htac('search').$rech,$rech));
if($load)return $t.m_pubart($load,"cols",3);}

#dates
//dayref
function dayref($cbl){
list($dat,$monh,$year)=explode("-",$cbl);
return mktime(0,0,0,$monh,$dat,$year);}//23,59,59

//calendar
function prep_calend($ref){
$month=date("m",$ref);$year=date("y",$ref);
$deb=mktime(0,0,0,$month,1,$year);$end=mktime(0,0,0,$month,$nb_j,$year);
$qda=$_SESSION['qda'];$qb=ses('qb');
$day=sql('day','qda','rv','nod="'.$qb.'" AND day<'.$end.' AND day>='.$deb);
for($i=1;$i<=$nb_j;$i++){$debd=mktime(0,0,0,$month,$i,$year);$endd=$debd+86400;
if($day[$i]>$dedb && $day[$i]<=$endd){$io[$i]+=1;}}
return $io;}

function calendar($date){
$gd=getdate($date); $dcible=date("d",$_SESSION['daya']); $dyam=$gd["mon"];
$ret.='<table style="font:smaller Arial; text-align:center;">';
$ret.='<tr><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td><td>D</td></tr><tr>';
$first=date("w",mktime(1,1,1,$dyam,1,$gd["year"])); if($first==0)$first=7;
$nbdy=date("t",mktime(1,1,1,$dyam,1,$gd["year"]));
for($a=1;$a<$first;$a++)$ret.='<td></td>';
for($i=1;$i<=$nbdy;$i++){$mk=mktime(0,0,0,$dyam,$i,$gd["year"]);
$dy=date("d",$mk); if($dy==$dcible)$cssb='style="background-color: #'.$_SESSION['clrs'][$_SESSION['prmd']][4].';'; else $cssb="";
if(is_arts("",$mk+86400,$mk)===true)$lnk=lkc('linc"'.$cssb,'/?module=Home&nbj=1&timetravel='.$dy.'-'.$dyam.'-'.$gd['year'],$dy)."\n";
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
$first=sql('day','qda','v','nod="'.ses('qb').'" AND re>0 LIMIT 1');
//$last=last_art('');
if(!$first)$first=0; 
$first_year=date("y",$first); 
$actual_year=date("y");
$ts_year=date("y",$_SESSION['daya']);
$nbsec_in_month=86400*30;//60*60*24;
$nbsec_in_year=31536000;//60*60*24*365=mktime(0,0,0,1,1,1);
$current_year=$cyear?$cyear:$ts_year;
	for($year=$actual_year;$year>=$first_year;$year--){
	$mk=mktime(0,0,0,1,1,$year);
	$y_name=date("Y",$mk);
	$nbay=nb_arts($mk+$nbsec_in_year,$mk);
	$css=date("y",$mk)==$current_year?'active':'';
	$ret.=balc("li",$css,lj("",'archives_archives___'.$year,$y_name.' ('.$nbay.')'));
	if($year==$current_year){
	$goto='/?module=All&nbj=30';
		for($ia=12;$ia>0;$ia--){
		$month=mktime(0,0,1,$ia,1,$year);
		$nbdayinmonth=date("t",$month);
		$m_name=date("M",$month); $m_nb=date("m",$month);
		$nbam=nb_arts($month+$nbsec_in_month,$month);//$monthbefore
		$css=date("Ym",$_SESSION['daya'])==$y_name.$m_nb?'active':'';
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