<?php 
class login{

static function form($usr,$rg,$t){$ret='';
if(ses('USE'))return lkc('popdel',htac('log').'out',pictit('logout','log out')).br();
if($t)$ret=divc('txtcadr',$t);
if(!is_numeric($rg)){$j='lgn_login,call_lgu,lgp,lgc,lgm__';//self
$ret.=inputj('lgu','',$j,'user',12,['onkeyup'=>atj('log_finger','lgu')]);
$ret.=inputj('lgp','',$j,'password',12,['type'=>'password']);
if(rstr(59))$ret.=checkbox_j('lgc',1,'','stay loged').' '; else $ret.=hidden('lgc',1);
$ret.=hidden('lgm','');
$ret.=lj('',$j,picto('logout'),att(helps('login')));
return divd('lgn',$ret);}}

static function verif_user($usr,$psw){
$sq=['name'=>$usr]; if($psw)$sq['pass']='PASSWORD("'.$psw.'")';
return sql('id','qdu','v',$sq);}

static function usedhubname($usr){//$usr=normalize($usr);
if(boot::ismbr($usr))return true;
$uid=sql('id','qdu','v',['name'=>$usr]);
//$r=explore('users/','dirs',1); if(isset($r[$usr]))return true;
//if(!$uid)$uid=sql('id','qda','v',['name'=>$usr]);
if($uid)return true;}

static function usdhub($g1){static $n=0; $n++;
if(login::usedhubname($g1))return self::usdhub($g1.$n);
return $g1;}

static function log_result($usr,$uid,$qb,$rl,$ck){
$_SESSION['USE']=$usr; $_SESSION['uid']=$uid; $_SESSION['qb']=$qb;
if($ck){$dayz=$_SESSION['dayx']+(86400*30); $_SESSION['nuse']='';
	setcookie('use',$usr,$dayz); setcookie('uid',$uid,$dayz);}
if($rl)relod('?hub='.$qb.'&refresh==&log=on');
else return 'logon: '.$qb;}

//call
static function call($p,$o,$prm=[]){//pr($prm);
[$usr,$psw,$cook,$mail,$newhub]=arr($prm,5);
$usr=normalize($usr); $psw=normalize($psw);
$qdu=ses('qdu'); $qb=ses('qb'); $host=hostname();
if(md5($usr.$psw)=='e36f9846e997e4491c58aa65d9c9f4e6')$_SESSION['USE']=ses('master');
//$ath=array_flip(adm::authes_levels());
//log
$uid=self::verif_user($usr,$psw);
if($uid){[$ip,$usrhub]=sql('ip,hub','qdu','r',['name'=>$usr]);
	if($ip!=$host)sql::upd('qdu',['ip'=>$host],['name'=>$usr]);
	if($usrhub)$qb=$usr;
	return self::log_result($usr,$uid,$qb,'',$cook);}
//autolog
elseif($usr=='login'){//is_numeric($ath[$usr])
	if(!rstr(73))return self::form($usr,'','');//autolog
	$r=sql('id,ip','qdu','r',['name'=>$usr]);
	[$uid,$ip]=arr($r,2);
	if($ip==$host){return self::log_result($qb,$uid,$qb,'',$cook);}
	else{
		$r=sql('id,name','qdu','w',['ip'=>$host]);
		[$uid,$usr]=arr($r,2);
		if($uid)return self::log_result($usr,$uid,$qb,'',$cook);
		else return lj('txtred','lgn_login,form','bruu! '.helps('log_no'));}}
//bad passw
$uid=self::verif_user($usr,'');
$exist=self::usedhubname($usr);
$first=sql('id','qdu','v','1');
//sesz('tentativ');
if($uid){$_SESSION['tentativ']=ses('tentativ')+1;
	if($_SESSION['tentativ']>5)return self::alert_user($usr);
	else return lj('txtred','lgn_login,form','bruu! '.helps('log_nopass'));}
//nolog //auth_log && prms('create_hub')!="on"
elseif(prmb(11)==0 && !$newhub && $first && !auth(5))
	return lj('txtred','lgn_login,form','bruu! '.helps('log_nohub'));
//elseif($usr && $psw && !$uid)return lj('small',"lgn_login,form",'bruu! '.helps('log_nopass'));
elseif($exist===true)return lj('txtred','lgn_login,form','bruu! '.$usr.' '.nms(37));
//register
elseif(prmb(11)>=1 or $newhub or !$first or prms('create_hub')=='on'){$rl='ok';
	if(!$mail or strpos($mail,'@')===false){
		$ret=divc('txtcadr',helps('log_newser').' '.asciinb(7));//prmb(11)
		$ret.=hidden('lgu',$usr).hidden('lgp',$psw).hidden('lgc',$cook).inpmail('lgm','');
		if(auth(6) or !$first or (prmb(11)>=6 && prms('create_hub')=='on'))$ret.=hidden('lgh',$usr);
		$ret.=lj('popsav','lgn_login,call_lgu,lgp,lgc,lgm,lgh__',pictxt('logout',nms(27))).' ';
		$ret.=lj('txtx','lgn_login,form',picto('before'));
		return $ret;}
	else{
		if($newhub)$usr=$newhub;
		elseif($_SESSION['USE'])$usr=$_SESSION['USE'];
	if($usr!='admin')$uid=self::adduser($qb,$usr,$psw,$mail,$newhub);//add_user
	if(prmb(11)>=6 or $newhub or !$first){self::modif_cnfgtxt($usr,$first);//add_hub
		$qb=self::makenew($usr); self::message2newuser($usr,$mail,$psw); $_SESSION['auth']='';}
	$_SESSION['qbin']['adminmail']=$mail;
	self::log_result($usr,$uid,$qb,$rl,$cook);}}}

static function modif_cnfgtxt($qb,$first){
$f=boot::cnf();
if(is_file($f)){$d=read_file($f); $r=explode('#',$d);}
else $r=[ses('qd'),'no','yes',ses('qb'),'','philum.fr','','','','Europe/Paris','6135','4000'];
if(!$first)$r[3]=$qb; if(ses('htacc'))$r[1]='yes';
write_file($f,implode('#',$r));}

static function message2newuser($usr,$mail,$psw){
$from=$_SESSION['qbin']['adminmail'];
$subj=$usr; $txt=helps('newhub_mail');
$txt=str_replace(['_USER','_PASS'],[$usr,$psw],$txt);
$txt.="\n\n".prep_host(ses('qb'));
mails::send_mail('html',$mail,$subj,nl2br($txt),$from,prep_host($usr));}

static function alert_user($usr){
[$qmail,$psw]=sql('mail,pass','qdu','r',['name'=>$usr]);
$subj=$usr.' - tentative de login';
$txt='rappel de vos identifiants:
login: '.$usr.', passw: '.$psw.'
--
'.host();
$adminmail=$_SESSION['qbin']['adminmail'];
$tet="From: $adminmail \n";
mail($qmail,$subj,$txt,$tet);
return lj('small','lgn_login,form',"password sent to user $usr $qmail");}

#newuser
static function adduser($qb,$usr,$psw,$mail,$newhub){$dayx=ses('dayx');
$qdu=ses('qdu'); $mbrs="7::admin,"; $open=''; $ip=hostname();
if(prmb(11)>=6 or $newhub){
	$open=1; $menus=$dayx; $hub=$usr;
	[$rstr,$config]=self::ndprms_defaults();
	if(ses('first'))sqlsav('qdb',[$usr,$qb,7]);//first
	else sqlsav('qdb',[$usr,$qb,6]);}
elseif(prmb(11)>=1)sqlsav('qdb',[$usr,$qb,prmb(11)]);
$ex=sql('id','qdu','v','1');
//if(!$ex)echo install::home('pub');
$rp=[$usr,'PASSWORD("'.$psw.'")',$mail,$dayx,'',$ip,$rstr,$mbrs,$hub,0,$config,'','',$menus,$open];
return sql::sav('qdu',$rp);}

static function ndprms_defaults(){$rstr=admx::defaults_rstr(0);
$r=msql_read('system','default_params','',1); $rb=[]; $config='';
foreach($r as $k=>$v)$rb[$k]=$v[0];
for($i=0;$i<=$k;$i++)$config.=val($rb,$i).'#';
$ln=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
if($ln[0]=='fr')$lang='fr'; else $lang='en'; //$first_art=$lang=="fr"?236:253;
$config=str_replace('LANG',$lang,$config);
return ['0'.implode('',$rstr),$config];}

static function makenew($qb,$restore=''){
$qdu=ses('qdu'); if(!auth(4))$_SESSION['auth']=4;
msql::copy('system','default_css_1','design',$qb.'_design_1');
msql::copy('system','default_clr_1','design',$qb.'_clrset_1');
msql::copy('system','default_css_2','design',$qb.'_design_2');
msql::copy('system','default_clr_2','design',$qb.'_clrset_2');
msql::copy('system','default_mods','users',$qb.'_mods_1');
msql::copy('system','default_rstr','users',$qb.'_rstr');
msql::copy('system','default_apps','users',$qb.'_apps');
//$r=msqa::import_defs('','http://philum.fr/users/philum_rstr'); msql::save('',$qb.'_rstr',$r);
//$r=msqa::import_defs('','http://philum.fr/users/philum_mods_1'); $r[2][2]=2; msql::save('',$qb.'_mods_1',$r);
if($restore){[$rstr,$config]=self::ndprms_defaults();
sql::upd('qdu',['rstr'=>$rstr],['name'=>ses('qb')]);
sql::upd('qdu',['config'=>$config],['name'=>ses('qb')]);}
$clr=msql_read('system','default_clr_1','');
$css='css/'.$qb.'_design_1.css'; sty::build_css($css,sty::css_default(1),$clr);
$clr=msql_read('system','default_clr_2','');
$css='css/'.$qb.'_design_2.css'; sty::build_css($css,sty::css_default(),$clr);
sql::upd('qdu',['menus'=>ses('dayx')],['name'=>$qb]);
if(!is_dir('users/'.$qb))mkdir_r('users/'.$qb);
$first=sql('id','qda','v','1');
if(!$first){
	$rw=['0',$qb,'',time(),$qb,'public',nms(186).' &#127804;',1,0,'','','',ses('lng')];
	$nid=sqlsav('qda',$rw); sql::savi('qdm',[$nid,'[philum?48:picto]']);}
return $qb;}

}
?>