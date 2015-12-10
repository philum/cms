<?php
//philum_specs 

#admin
function m_system(){$auth=$_SESSION['auth']; $id=ses('read'); $top=rstr(69)?'':'d'; $hv=1;
$ra=array(0=>'phi2',1=>'loading',2=>'admin',3=>'apps',4=>'download',5=>'search',6=>'articles',7=>'add',8=>'link',9=>'flag',10=>'time',11=>'phi',12=>'phi1',13=>'list',14=>'user'); 
foreach($ra as $k=>$v)$ico[$k]=picto($v);
$ret['home']=popbub('home','',$ico[0],$top,$hv);//if(rstr(20))
if(rstr(51))$ret['apps']=popbub('apps','',$ico[3],$top,$hv);
if($auth>4)$ret['admin']=popbub('fadm','fastmenu',$ico[2],$top,$hv);
//if(rstr(75))$ret['search']=popbub('call','search',$ico[5],$top,$hv);
if(rstr(75))$ret['search']=search_btn(nms(24),'right','',1);
if($auth>1){
	if(rstr(83))$ret['ucom']=popbub('call','ucom',$ico[8],$top,$hv);
	if($auth>3 && rstr(76))$ret['batch']=popbub('call','batch',$ico[4],$top,$hv);}
if($auth>2){
	if(rstr(79))$ret['addurl']=popbub('call','addart',$ico[7],$top,$hv);
	else $ret['addart']=li(ljb('',sj('popup_addArt____1').' closebub(this);','',$ico[7]));}
if(rstr(80))$ret['arts']=popbub('','arts',$ico[6],$top,$hv);//arts
if(rstr(81))$ret['favs']=llj('','popup_modpop___favs:plug',picto('like'));//favs
if($_SESSION['lang']!='all' or rstr(82))$ret['lang']=popbub('lang','lang',$ico[9],$top,$hv);//lang
if(abs(ses('dayx')-ses('daya'))>86400 or rstr(84))//back_in_time
	$ret['time']=popbub('timetravel','',$ico[10],$top,$hv);//archives
if(rstr(48))$ret['user']=popbub('user','',$ico[14].' '.btn('small',ses('USE')),$top,$hv);//usr
if($id && rstr(89))$ret['seek']=popbub('seek','',$ico[13],$top,$hv);//metas
if($id && auth(6))$ret['edit']=llj('','popup_tit___'.$id,picto('tag')).llj('','popup_artedit___'.$id,picto('edit'));//edit
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
//if($rtb)$rta.=$rtb;
if($rta)$ret=mkbub($rta,$css,'','this.style.zIndex=popz+1;');
if($rtb)$ret.=bts('position:fixed; right:0;',$rtb);//
//if($rtb)$ret.=mkbub($rtb,$css,'left:50%;right:0; text-align:right;','this.style.zIndex=popz+1;');
if($top)$ret.=divc('admnu',' ');
else $_SESSION['head_r'][]['csscode']='#page{margin-left:30px;}';
return $ret;}

#arts
function popart($d,$p='',$t=''){$p=picto($p?$p:'articles');
	return lj('','popup_popart__3_'.ajx($d).'_3',$p.$t);}
function jread($c,$id,$v){$ic=find_art_link($id);
	if(!rstr(8) or !$ic)return lkc($c,urlread($id),$v);
	else return popart($id,'',$v);}

function pecho_arts($id){$id=find_id($id);
if($_SESSION['rqt'][$id])return $_SESSION['rqt'][$id];
else return ser("day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re",$_SESSION['qda'].' WHERE id="'.$id.'"');}

function read_msg($d,$m){$id=find_id($d); if(!$id)return;
$ok=sql('id','qda','v','id='.$id.' and substring(frm,1,1)!="_" and re>0'); if(!$ok)return;
$ret=sql('msg','qdm','v','id='.$id);
if($m==2 or $m=="noimages" or $m=="nl")$ret=kmax($ret);
if($m!='brut')$ret=format_txt($ret,$m,$d);
return $ret;}

function rqt($id,$n=''){
$r=array('day'=>0,'frm'=>1,'suj'=>2,'img'=>3,'nod'=>4,'tag'=>5,'lu'=>6,'name'=>7,'host'=>8,'mail'=>9); if(!is_numeric($n))$n=$r[$n];
return $n?$_SESSION['rqt'][$id][$n]:$_SESSION['rqt'][$id];}

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
function data_val($v,$id,$cat,$val){$ib=$id?'ib="'.$id.'" AND ':'';
return sql($v,'qdd','v',$ib.'cat="'.$cat.'" AND val="'.$val.'"');}
function count_art($suj,$frm){return sql('COUNT(id)','qda','v','nod="'.ses('qb').'" AND suj="'.$suj.'" AND frm="'.$frm.'" AND re>="1"');}
function cache_art($id){$ret=rse('day,frm,suj,img,nod,thm,lu,author,ip,mail,ib,re',$_SESSION['qda'].' WHERE id="'.$id.'" LIMIT 1');//if(substr($ret[2],0,1)!='_')
$_SESSION['rqt'][$id]=$ret;}

//thumbs
function thumb_name($d,$w,$h){
return 'imgc/'.$_SESSION['qb'].'_'.$w.'x'.$h.'_'.$d;}

function make_thumb_c($d,$size='',$s=''){
if(!$size)$size=prmb(27); list($w,$h)=split('/',$size);
$b=str_replace(array('users/','imgb/','icons','/'),'',$d);
if(substr($d,0,4)!='http')$jd='../';//is_dir($d)?'../'
$thumb=thumb_name(normalize($b),$w,$h.'-'.$s);
if(is_file($d))list($wo,$ho,$ty)=getimagesize($d);
if($wo<140 && $ho<100){if(is_file($thumb))unlink($thumb); $thumb=$d;}
elseif(!file_exists($thumb) or $_GET['rebuild_img'])
	$thumb=make_mini($d,$thumb,$w,$h,$s);//$jd.
return '<img src="'.$jd.$thumb.'">';}

function popim_w($im,$d){$sz=read_file('http://'.$d.'/plug/microsql.php?fwidth=../'.$im);
list($w,$h)=explode('_',$sz); $imj=ajx('http://'.$d.'/'.$im);
return ljb('','SaveBf','photo_'.$imj.'_'.($w).'_'.($h).'_'.$id,picto('img'));}
function popim($im,$v,$id=''){if(is_file($im))list($w,$h)=getimagesize($im);
return ljb('','SaveBf','photo_'.ajx($im).'_'.($w).'_'.($h).'_'.$id,pictxt('img',$v));}
function popthumb($f,$s=''){return popim($f,make_thumb_c($f,$s,1));}
function forbidden_img($nnm){$r=explode(" ",$_SESSION['prmb'][21]);
if($r)foreach($r as $v)if($v && strpos($nnm,$v)!==false)return false; return $nnm;}

#pages
function save_get(){if($_GET)return $_SESSION['gets']=implode_k($_GET,'=','&');}
function rebuild_get(){$r=explode_k($_SESSION['gets'],'&','=');
if($r)foreach($r as $k=>$v)$_GET[$k]=$v;}

function by_pages($r,$p){$n=count($r); $page=$p?$p:1; $npg=10;
$ret=nb_page($n,$npg,$page); $min=($page-1)*$npg; $max=$page*$npg;
for($i=0;$i<$n;$i++){if($i>=$min && $i<$max)$ret.=$r[$i];}
return $ret;}

function detect_uget($d){$ut=explode(' ',$d.' '.prmb(18));
if($ut)foreach($ut as $k=>$v)if($g=$_GET[eradic_acc($v)])
return array(eradic_acc($v),urldecode($g),$v);}

function recup_get($dr){
if($_POST['dig'])$_GET['dig']=$_POST['dig']; 
if($_GET['msql'])return'/msql/'.$_GET['msql'].'/page/';
if($_SESSION['htacc'] && !$dr){list($g,$u)=detect_uget('tag section admin module');
	if($_GET['search'])return '/search/'.$_GET['search'].'/page/'; 
	elseif($_GET['module']){list($o,$p)=split_right(':',$_GET['module']);
		return '/module/'.$p.($o?'/'.$o:'').'/page/';}
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

function read_apps($v){switch($v[1]){//p/t/d/o/c/h/tp/br
case('ajax'): $ret=$v[2].'_'.$v[3].($v[4]?'_'.$v[4]:''); break;
case('art'): $ret='popup_popart__3_'.$v[3].'_3'; break;
case('file'): $ret=read_apps_reader($v[3]); break;
case('finder'): $ret='popup_finder___'.$v[3].'_'.$v[4]; break;
case('admin'): $ret='popup_admin___'.$v[2].'_'.$v[3].'_'.$v[4]; break;
case('msql'): $ret='popup_msqlp___'.$v[2].'_'.$v[3].'*'.$v[4]; break;//ajx()
//case('iframe'): $ret='popup_plupin___iframe_'.ajx($v[3]).'_autosize'; break;
case('iframe'): $ret='popup_iframe___'.ajx($v[3]).'_iframe__autosize'; break;
case('link'): $ret='popup_iframe___'.ajx($v[3]).'_iframe__autosize'; break;
case('url'): $ret='socket_jump__url_'.ajx($v[3]); break;//host().//$v[2]=blank
case('plug'): $ret='popup_plupin___'.$v[2].'_'.$v[3].'_'.$v[4]; break;
case('plup'): $ret='popup_plugin___'.$v[2].'_'.$v[3].'_'.$v[4]; break;
case('plugfunc'): $ret='popup_plup___'.$v[2].'_'.$v[3].'_'.$v[4]; break;
case('mod'): $ret='popup_modpop__3_'.ajx($v[3].'///'.$v[4].'/'.$v[7].'///1:'.$v[2]).'_480'; break;
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
		if($t)$v[7]=apps_arts_thumb($v[3]);}
	if($v[1]=='file' && is_image($v[3]))$v[7]=make_thumb_c('users/'.$v[3],'38/38');
	$_SESSION['apico'][$t]=$v[7]; $rv=explode('/',$v[6]); $nv=$v[6]?count($rv):0;
	if($dir==$v[6])$is=true; else $is=match_vdir($dr,$nd,$rv);
	if($is && $nv==$nd+1 && !$v[8] && auth($v[9])){//dirs

		$ret[$rv[$nv-1]]='popup_desktop__3_'.$cnd.'_'.ajx($v[6]).'_'.$p.'_'.$o;}
	elseif($is && $rv[$nd] && !$v[8]){$v6=implode('/',array_slice($rv,0,$nd+1));
		$ret[$rv[$nd]]='popup_desktop__3_'.$cnd.'_'.ajx($v6).'_'.$p.'_'.$o;}
	if($is && $nv>$nd)$is=false;
	if($is && !$v[8] && (!$v[9] or auth($v[9]))){$j=read_apps($v); 
		//if($v[1]=='htmlink')$ret[$t]=array('link',$v[3]);
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
function apps_arts_thumb($d){
$img=sql('img','qda','v','id='.$d); if($img)$f=strprm($img,1,'/');
if($f)return make_thumb_c('img/'.$f,'38/38'); else return 'articles';}

//call
function desktop_apps($id,$va,$opt,$o){
if($id=='varts')$r=apps_varts($id,$opt); 
elseif($id=='arts')$r=apps_arts($id,$opt,$o); 
elseif($id=='files')$r=apps_files($id,$opt,$o); 
else $r=r_apps();
return m_apps($r,$id?$id:'desk',$va,$opt,$o);}

function desk_icon($k,$j){$ic=$_SESSION['apico'][$k];
$ra=array('popart'=>'articles','msql'=>'server','plug'=>'get','desktop'=>'folder');
if($j)$ica=strprm($j,1,'_'); 
if($ica=='desktop' or !$ic)$ic=$ra[$ica]; return $ic;}

function desktop_build_ico($r,$c){
if($r)foreach($r as $k=>$v){$ic=desk_icon($k,$v);
	$ico=strpos($ic,'<')!==false?btn('small',$ic):mimes($k,$ic,32);
	$ret.=lj('" title="'.$k,$v,divb($c,$ico.' '.bts('display:block',$k)));}
return $ret;}

function app_list($r,$c,$cl=''){
if($r)foreach($r as $k=>$v){$ic=desk_icon($k,$v); $ico=mimes($k,$ic,'');
	$ret.=lj($cl.'" title="'.$k,$v,$ico,$c).' ';}
return $ret;}

function desktop_cond($p,$o=''){$r=m_apps(r_apps(),$p,'');
if($r)return $o?implode(';',$r):$r;}

function desktop_js($d){$r=desktop_cond($d);//p($r);
if($d=='boot' && !$r)$r=array('desktop_desk___desk','page_deskbkg');//
if($r)foreach($r as $k=>$v)$ret.=sj($v);//is_array($v)?sj($v[0]):
if($ret)return js_code($ret);}

function poplist(){$rid='ppl'.randid();
$_SESSION['popm']=ljb('philum','poplist(\''.$rid.'\')','',btd($rid,'l')).' ';}

//mimes
function msqmimes(){return msql_read('system','edition_mimes');}
function mimes_types($d){$r=sesmk('msqmimes','',0); return $r[$d]!=false?$r[$d]:'less';}
function mimes($d,$t='',$sz=''){$ta=mimes_types($d);
if($ta && $ta!='less')$t=$ta; if(!$t)$t='file'; if($t)return picto($t,$sz);}
#meca
//param/title/command/option:module->target§button[,]
function val_to_mod_b($p){
$p=str_replace("\n","",$p); $r=explode(",",$p); $n=count($r);
for($i=0;$i<$n;$i++){//$d='scroll'; $o='12';
	list($comline,$t)=split_right('§',trim($r[$i]),1);
	list($code,$mod)=split_right(':',$comline,1);
	if(strpos($code,'/')!==false)
		list($p,$tb,$d,$o,$ch,$hd,$tp,$br)=explode("/",trim($code)); 
	else{$p=trim($code);$tb='';} if(!$t)$t=$tb?$tb:$p;
	$ret[$t?$t:$p]=array($mod,$p,$tb,$c,$d,$o,$ch,$hd,$tp,$br);}//($tb?$tb:$p)
return $ret;}

function define_modc_b($vl){$r=$_SESSION['mods'][$vl]; $cnd=$_SESSION['cond'];
if($r)foreach($r as $k=>$v){//$c=determine_cond($v[3]);
if($v[3]==$cnd[0] or $v[3]==$cnd[1] or !$v[3])$ret[$k]=$v;}
return $ret;}

#access
function jcim($f,$o=''){if($o)$a=$f; 
if($o && substr($f,0,4)=='http')return $f;
return (strpos($f,'/')?'users/':'img/').$a;}

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
$ret.=llk($csb,urlread($k),'• '.suj_of_id($k));
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
$ret.=llk($csb,htac('section').$k,$k);
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
function submn_t($va){list($k,$v)=explode("§",$va);
if(!is_numeric($k)){
	if(substr($k,0,1)=="?")return array($k,$v);
	elseif($v)return array(htac('section').$k,$v);
	elseif($k)return array(htac('section').$k,$k);}
else{$tit=suj_of_id($k);
	if($v)return array(urlread($k),$v);
	elseif($_SESSION['line'][$k])return array(htac('section').$k,$k);
	elseif($tit)return array(urlread($k),picto('file').' '.$tit);
	else return array(urlread($k),$k);}}//numeric name

function bubble_menus($t,$inl=''){//mods/submenus
if(!$t)return; $nbo=0; $n="\n"; $r=explode("\n",$t.$n); //$id=randid();
foreach($r as $k){$nb=substr_count($k,"-"); $tit=substr($k,$nb); $tit=trim($tit);
	if($tit){list($lk,$d)=submn_t($tit); $cat[$nb]=$tit; $ct='';
	$ct=$cat[0]; for($i=2;$i<=$nb;$i++)$ct.='/'.$cat[$i-1];
	if($nb==0)$ret.=popbub('bubses',ajx($d),$d,'d');
	else $ra[]=array($d,'link','',$lk,'','',$ct,'');}}
$_SESSION['bubses']=$ra;
return div(atc($inl).atd('bub').ats('position:relative; text-decoration:none;'),ul($ret));}

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
foreach($_SESSION['rqt'] as $k=>$v){
	if(is_numeric($v[10]))$line[$v[10]]+=1;}//up
	if(is_array($line))arsort($line);
return $line;}}

function supermenu($r){static $i; $i++;
if(is_array($r))foreach($r as $k=>$v){$ret.=nchar($i,"-");
	if(is_array($v))$ret.=$k."\n".supermenu($v); else $ret.=$k."\n";} $i--;
return $ret;}

#outputs
function output_load($r){$rid=randid();
return divd('load'.$rid,page_titles(0,$rid).output_pages($r,'',''));}

function output_pages($otp,$md,$tp){
if(rstr(39) or $md=='flow'){$fw=1; $_POST['flow']=1;}
$npg=$_SESSION['prmb'][6]; $page=$_SESSION['page'];
$min=($page-1)*$npg; $max=$page*$npg; $md=slct_media($md);
if(is_array($otp))foreach($otp as $id=>$nb)if($id>0){$i++;
	if($md=='prw')$media=$nb; else $media=$md;
	if($i>=$min && $i<$max)$ret.=art_read_b($id,$nb,$media,$tp);
	elseif($fw)$ret.=div(atd($id).atc($media),'');}
if(!$fw)$nbpg=nb_page($i,$npg,$page);
return $nbpg.$ret.$nbpg;}

function output_pages_spe($otp,$media,$spe){
$npg=$_SESSION['prmb'][6]; $page=$_SESSION['page'];
$min=($page-1)*$npg; $max=$page*$npg;
	if(is_array($otp))foreach($otp as $id=>$nb)if(is_numeric($id)){$i++;
	if($i>=$min && $i<$max){
	if($spe=='track')$ret.=art_read_b($id,$nb,1,'').output_trk(read_idy($id,"ASC"));
	else $ret.=art_read_b($id,$nb,$media,'');}}
$n_pages=nb_page($i,$npg,$page);
return $n_pages.$ret.$n_pages;}

function import_art($d,$m){
list($dy,$nod,$frm,$suj)=ser("day,nod,frm,suj,img",$_SESSION['qda'].' WHERE id="'.$d.'"');
$nde=$_SESSION['mn'][$nod];//.'#'.$id
$ret=lkc("txtsmall",urlread($d),$nde.' ('.$frm.') '.mkday($dy)).' ';
if($_GET['read']==$d)$m=3; $msg=read_msg($d,$m);
$msg=str_replace("<br />","",$msg);//if(rstr(13))
return $ret.$msg;}

function id_of_urlsuj($d){return rse('id',$_SESSION['qda'].' WHERE nod="'.ses('qb').'" AND re>="1" AND suj LIKE "%'.$d.'%" LIMIT 1');}
function id_is_public($id){return sql('id','qda','v','id="'.$id.'" AND re>="1"');}

//trackback
function read_idy($id,$dsc){$qb=ses('qb');$qdi=$_SESSION['qdi'];
if($id==$qb && !$_SESSION['USE'])$limit=' LIMIT 1'; else $limit=' LIMIT 100';
return sql('id','qdi','k',"nod='$qb' AND frm='$id' ORDER BY day $dsc $limit");}
	
#rqt

function tri_rqt_d($vrf,$tri,$dya,$dyb){if(!$dyb)$dyb=1; if(!$vrf)return;
if($dya)$wh=' AND day < '.$dya.' AND day > '.$dyb.'';
if($tri=='thm' or $tri=='mail')$wh.=' AND '.$tri.' LIKE "%'.$vrf.'%"'; 
else $wh.=' AND '.$tri.'="'.$vrf.'"';
$ret=sql('id,'.$tri,'qda','kv','nod="'.ses('qb').'"'.$wh.' ORDER BY '.prmb(9).' LIMIT 1000');
return $ret;}

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
function tri_rqt_one($d,$n){
foreach($_SESSION['rqt'] as $k=>$v)if($v[$n]==$d)$ret[$k]+=1;
return $ret;}
function tri_rqt_lists($dya,$dyb){
	if(isset($_SESSION['rqt']))foreach($_SESSION['rqt'] as $k=>$v)$ret[]=$k;
	return $ret;}
function tri_rqt_rubtags($vrf,$tri,$dya,$dyb){
	if(isset($_SESSION['rqt']))foreach($_SESSION['rqt'] as $k=>$v) 
	if($v[1]==$vrf && $v[4]==ses('qb') && $v[0]>=$dyb && $v[0]<=$dya)$ret[$k]=$v[$tri];
	return $ret;}
function tri_rub_tags($r,$b){
if(is_array($r))foreach($r as $k=>$v)if(strpos($v,$b)!==false && $b)$ret[$k]+=1;
if(is_array($ret))krsort($ret); return $ret;}
function tri_tags_r($r){
if(is_array($r))foreach($r as $k=>$v){$unkill=explode(",",$v);
	foreach($unkill as $su){$su=trim($su);
	if($su && $su!=" ")@$ret[$su][$k]+=1;}}
return $ret;}

function array_to_count($r){
foreach($r as $k=>$fa)$ret[$k]=count($fa); return $ret;}
function rqt_compact($p){
foreach($_SESSION['rqt'] as $k=>$v)$ret[$v[$p]]+=1; return $ret;}

# utils
function find_navigation($id){$ib=ib_of_id($id);
if(is_numeric($ib) && $ib!=$id){
list($idb,$suj)=ser("id,suj",$_SESSION['qda'].' WHERE id="'.$ib.'"');
if($suj)$nav=bal('h4',lka(urlread($idb),pictxt('paste',$suj)).' '.popart($idb));
if($idb!=ses('read'))return find_navigation($idb).$nav;}}

function find_art_link($d){
if(is_numeric($d))$wh='WHERE id="'.$d.'"'; else $wh='WHERE suj="'.$d.'"';
return rse('id',$_SESSION['qda'].' '.$wh.' AND nod="'.ses('qb').'"');}

function send_user_mail($id,$lgtxt){//send_to_author
$sender=$_SESSION['qbin']["adminmail"];
list($kem,$suj)=ser('name,suj',$_SESSION['qda'].' WHERE id="'.$id.'"');
if($kem!=$_SESSION['USE']){
$nmsg=helps($lgtxt);//.br().br().$suj
	$kmail=rse('mail',$_SESSION['qdu'].' WHERE name="'.$kem.'"');
	if($kmail!=$_SESSION['qbin']["adminmail"])
		send_mail_html($kmail,$suj,nl2br($nmsg),$sender,urlread($id));}}

function send_mail_r($r,$format,$suj,$msg,$from,$lk){
if($r)foreach($r as $k=>$v){if($v){$ret.=btn("txtyl",$v);
send_mail($format,$v,$suj,$msg,$from,$lk);}}
return $ret;}

function send_track_to_user($id){
$sender=$_SESSION['qbin']["adminmail"];
list($name,$day,$idt,$msg)=sql('name,day,frm,msg','qdi','r','id='.$id);
$by=helps('trackmail'); $msg=format_txt($msg,'',$idt)."\n\n";
$msg=nl2br($by."\n\n".'By: '.$name.', '.mkday($day)."\n\n".$msg);
$suj=sql('suj','qda','v','id='.$idt);
$rmails=sql('mail','qdi','k','frm="'.$idt.'"');
if($rmails)$r=array_keys_b($rmails);
if($r)send_mail_r($r,'html',$suj,$msg,$sender,$id);}

function publish_art($publish,$read,$bs){
if(auth(4)){$base=$_SESSION[$bs];
if($publish=="on"){update($bs,"re",1,"id",$read);
send_user_mail($_SESSION['read'],'published_art');
if($bs=='qdi')send_track_to_user($read);}
elseif($publish=="off")update($bs,"re",0,"id",$read);}
else alert(btn("txtalert","bruu you cant do that"));}

function htacb($d,$v,$n){//third_param
if($_SESSION['htacc'])return '/'.$d.'/'.$v.($n?'/':'');
else return '/?'.$d.'='.$v.($n?'&'.$n.'=':'');}

function colonize($re,$prm,$id,$cls,$w='',$b=''){$b=$b?'div':'ul';
$w=$w?$w:currentwidth()-10; $ret=onxcols($re,$prm,$w); 
$wb=atd($id).atc($cls).ats('width:100%;');//-($prm*5)
return balb($b,$wb,$ret).divc("clear","");}

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
if((!file_exists($thumb) && $mg && $pre) or $_GET["rebuild_img"]){//
	list($w,$h)=split("/",prmb(27)); $mode=$_SESSION['rstr'][16]?0:2; 
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

function first_img($d){$r=explode("/",$d); $n=count($r);
for($i=0;$i<$n;$i++){$xt=substr($r[$i],-3);
if($xt=="jpg" or $xt=="gif" or $xt=="png")return $r[$i];}}

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
else{$day=rse("day",$_SESSION['qda'].' WHERE nod="'.$_SESSION['qb'].'" AND re>="1" ORDER BY id ASC LIMIT 1');//msqstorage
$dy=round(time()-$day)/86400;//$dy=$dy/10;
$r=array(1,7,30,90,365); for($i=5;$i<20;$i++)$r[]=$r[$i-1]+365;
for($i=0;$i<15;$i++){if($r[$i]<$dy)$_SESSION['digr'][$r[$i]]=$r[$i]<365?$r[$i]:$r[$i]/365;}
return $_SESSION['digr'];}}

function dig_it($n,$send,$rid=''){$r=define_digr(); $g=$_GET[$send];
if(!$r[$n])$r[$n]=$n>=365?round($n/365,2):$n; $cur=$r[$n]; //$to=$to?$to:$_GET[$send];
$r[$n].=' '.($n<365?plurial($cur,3):plurial($cur,7));
if($n!=1 && $n!=7)$r[$n]=$r[time_prev($n)].' '.nms(36).' '.$r[$n];//from
$dig=$_GET['dig']?$_GET['dig']:$_SESSION['nbj'];
if($_SESSION['rstr'][3]!='1')
if($rid)$ret=slctmenusja($r,'load'.$rid.'_getcontent___'.$send.'_'.ajx($g).'_',$dig);
else $ret=slct_menus($r,htacb($send,$g,'dig'),$n,"active","","");
return btn('nb_pages',$ret);}

function dig_it_j($n,$go){$r=define_digr();//most_read
if(!$r[$n])$r[$n]=$n>365?round($n/365,2):$n;
$r[$n].=' '.($n<365?plurial($r[$n],3):plurial($r[$n],7));
//if($n!=1 && $n!=7)$r[$n]=$r[time_prev($n)].' '.picto('kright').' '.$r[$n];//from
return divs('float:right;',slctmenus_sj($r,$go,$n));}

/*function dig_hb($n){$r=define_digr();
if(!$r[$n])$r[$n]=$n>=365?round($n/365,2):$n; $cur=$r[$n];
if($n!=1 && $n!=7)$r[$n]=$r[time_prev($n)].' '.picto('kright').' '.$r[$n];//from
$r[$n].=' '.($n<365?plurial($cur,3):plurial($cur,7));
return menuder_h($r,'srdig',$n);}*/

function noload($r){return $r?$r:array(1=>1);}

function utload($u,$daya,$dayb,$c){if($c)$wh='AND val="'.$c.'" ';
$load=sql('ib','qdd','k','qb="'.ses('qb').'" AND day<'.$daya.' AND day>'.$dayb.' AND cat="tables" '.$wh.'AND msg LIKE "%'.$u.'%" ORDER BY '.prmb(9));
if($load)krsort($load); return noload($load);}

function ut_load($daya,$dayb){list($g,$v,$gb)=detect_uget('');
if($g)return utload($v,$daya,$dayb,$gb);}

function tag_load($daya,$daybb){$tag=get('tag'); $_SESSION['frm']="";
if($_GET["dig"])$load=tri_rqt_d($tag,'thm',$daya,$daybb);
elseif(count($_SESSION['interm'][$tag])>0)$load=$_SESSION['interm'][$tag];
else{$_GET["dig"]=365; $load=tri_rqt_d($tag,"thm",$daya,calc_date(365));}
return noload($load);}

function define_load(){$rech=good_rech();//active console
$days=getorpost('dig',ses('nbj')); $dayb=calc_date($days); 
$pday=time_prev($days); if($pday==1)$pday=0; $daya=calc_date($pday);
if(get('tag'))$load=tag_load($daya,$dayb);
elseif($rech){$_SESSION['frm']=''; if(!get('search'))$load=$_SESSION["recache"][$vrf]; 
	if(!$load){require('plug/search.php'); $load=rech($rech,$days);}
	if(is_array($load)){if(get('bydate'))krsort($load);}// else arsort($load);
	$_SESSION["recache"][$vrf]=$load;}
elseif(get('source')){$_SESSION['frm']='';
	if(get('dig'))$load=tri_rqt_d(get('source'),'mail',$daya,$dayb);
	elseif($_SESSION['rqt'])foreach($_SESSION['rqt'] as $k=>$v)
		if(strpos($v[9],get('source'))!==false)$load[$k]=1;}
elseif(get('usertag'))$load=utload(get('usertag'),$daya,$dayb,'');
elseif(get('parent'))$load=sql('id','qda','k','ib='.get('parent'));
elseif(get('rub_tag')){$rub_t=get('rub_tag'); 
	$rbtags=tri_rqt_rubtags(ses('frm'),5,$daya,$dayb);
	$load=tri_rub_tags($rbtags,$rub_t);}
elseif(get('author'))$load=tri_rqt_d(get('author'),'name',$daya,$dayb);
else $load=ut_load($daya,$dayb);
if($load)save_get();
return $load;}

#page-title//les modules ont leur propres titles
function page_titles($o='',$rid=''){$load=ses('load');//$o=parent
$days=getorpost('dig',ses('nbj')); $daybb=calc_date($days);
$rech=good_rech(); $nms=ses('nms'); $frm=ses('frm'); $read=ses('read');
list($utg,$utv)=detect_uget('');
if($rech){$ico=btn("txtcadr",pictxt('search',$rech)); if(get('targ'))return;
	if(is_array($load))$p['nbarts']=nbof(count($load),1).' ('.nbof(array_sum($load),16).') / '.nbof($days,3); $p['opt']=lj('','popup_search___'.$rech,picto('popup'));
	if($pg=$_SESSION['page']>1)$p['opt']=btn('txtsmall','page '.$pg);
	$p['suj']=$rech; $p['url']='search/'.$rech.'/'.$days;}
elseif(get('rub_tag'))$rub_t=get('rub_tag'); 
elseif(get('rssurl')){$p['suj']=$nms[15];}//tits
elseif($par=get('parent')){$read=1;
	$p['suj']=suj_of_id($par); $p['url']=urlread($par);}
elseif($tag=get('usertag')){$p['suj']=$tag; $_SESSION['frm']='';
	$p['date']=dig_it($days,'usertag',$rid).' '; $p['url']='tag/'.$tag.'/'.$days;}
elseif($utg){$p['suj']=$utv;$_SESSION['frm']='';
	$p['date']=dig_it($days,$utg,$rid).' '; $p['url']=htac($utg).$utv;}
elseif($tag=get('source')){$p['suj']=$tag; $_SESSION['frm']='';
	$p['date']=dig_it($days,'source',$rid).' '; $p['url']='source/'.$tag.'/'.$days;}
elseif($tag=get('tag')){$p['suj']=$tag; $p['url']='tag/'.$tag.'/'.$days;
	$p['date']=dig_it($days,'tag',$rid).' '.lkc('txtx',htac('tag').$tag,picto('url')).' ';
	$p['date'].=lj('txtx','popup_search__3_'.ajx($tag).'_'.$days,picto('search'));}
elseif(get('module')=='All'){$p['suj']=get('module'); $p['url']=htac('module').get('module');}
elseif($frm){$p['suj']=$frm; $p['url']=htac('section').$frm;}
if(!$read){//nav//nbarts
	if(get('usertag') or $utv or $tag or $rub_t or get('source')){
		if($load){$nbarts=count($load); if(!$rub_t)$_SESSION['frm']='';}}
	elseif($frm!="Home" && get('module')!="All" && $frm){
		if(get('dig') or $_SESSION['lang']){$r=load_arts($frm,'',''); $nbarts=count($r);}
		else $nbarts=$_SESSION['line'][$frm];}
	elseif(ses('line'))foreach($_SESSION['line'] as $k=>$v)$nbarts+=$v;}
if($frm && $frm!='Home' && $frm!='All' && !$read && !$p['date'])$p['date']=dig_it($days,'section',$rid).' ';// && !$rech
if(!$read && !$p['nbarts'])$p['nbarts']=nbof($nbarts,1).(rstr(3)?' / '.nbof($days,3):'');
if($page=ses('page') && $page>1)$p['nbarts'].=' (page '.$page.') ';
if(!$load && $o)$p['parent']=find_navigation(ses('read'));//rstr(78)
if($_GET['rub_tag']){$p['tag']=rub_tags('');
	$p['opt']=lkc('txtx',htac('tag').$rub_t,'&#9658;'.$rub_t);}
if($p['suj']=='All')$p['suj']=ses('nbj').' '.nms(4);
if($p['suj']=='Home')$p['suj']=nms(69);
//if($_GET['module'])$p['suj']=nms(100)
return divd('titles',template($p,'titles'));}

//search
function good_rech($rch=''){
$ret=$rch?$rch:ajx(urldecode($_GET['search']),1); if(!$ret)return;
$ret=str_replace('’',"'",$ret); $ret=utflatindecode($ret); $ret=clean_acc($ret);
$ret=strip_tags($ret); stripslashes($ret); $ret=trim($ret); return $ret;}

function rech_internal($rech){$load=search_engine($rech);
$t=btn("",lka(htac('search').$rech,$rech));
if($load)return $t.m_pubart($load,"cols",3);}

function rech_meta($k,$nbj=''){$w='nod="'.ses('qb').'"';
if($_SESSION['prmb'][16])$w.=' AND day>'.calc_date($nbj?$nbj:30);
switch($k){case('cat'):if($nbj)$r=sql('frm','qda','k',$w); else $r=$_SESSION['line']; break;
case('tag'):if($nbj)$r=sql('thm','qda','ktag',$w); else $r=$_SESSION['interm']; break;}
return $r;}

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
$day=res("day",$qda.' WHERE nod="'.$qb.'" AND day < '.$end.' AND day >= '.$deb.'');
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
if($frm)$fr='AND frm="'.$frm.'" '; if($dayb)$df='AND day > "'.$dayb.'" ';
$n=rse("id",$_SESSION['qda'].' WHERE nod="'.ses('qb').'" '.$fr.' AND day < "'.$daya.'" '.$df.' ORDER BY day DESC LIMIT 1'); 
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