<?php //a/login
class login{

static function form($usr,$rg,$t){$ret='';
if($t)$ret=btn('popw',$t).' ';
if(!ses('USE') or !is_numeric($rg)){//nameofauthes(prmb(11))
$nam='login'; $sty='" style="width:100px;';
$ret.=autoclic('user" id="lgg" onkeyup="log_finger(\'lgg\');',$nam,8,100,'search',1);
$ret.=inpsw('pass','pass',atn('pass').atz(8).atc('search').atb('placeholder','password'));
if(rstr(59))$ret.=checkbox_j('cook',1,'','stay loged').' '; else $ret.=hidden('cook',1);
$ret.=submitj('" title="'.helps('login').'','log',picto('logout'));
return divd('valid','<form id="log" name="log" action="javascript:login(\'log\')" onKeyPress="checkEnter(event,\'log\')">'.$ret.'</form>');}
else return lkc('popdel',htac('log').'out',pictit('logout','log out')).br();}

static function verif_user($user,$pasw){$wh='';
if($pasw)$wh=' AND pass=PASSWORD("'.$pasw.'")';
$uid=sql('id','qdu','v','name="'.$user.'"'.$wh);
return $uid;}

static function usedhubname($user){//$user=normalize($user);
if(boot::ismbr($user))return true;
$uid=sql('id','qdu','v','name="'.$user.'"');
//$r=explore('users/','dirs',1); if(isset($r[$user]))return true;
if(!$uid)$uid=sql('id','qda','v','name="'.$user.'"'); if($uid)return true;}

static function usdhub($g1){static $n=0; $n++;
if(login::usedhubname($g1))return self::usdhub($g1.$n);
return $g1.($ex?$ex:'');}

static function log_result($Use,$uid,$qb,$rl,$ck){
$_SESSION['USE']=$Use; $_SESSION['uid']=$uid; $_SESSION['qb']=$qb;
if($ck){$dayz=$_SESSION['dayx']+(86400*30); $_SESSION['nuse']='';
	setcookie('use',$Use,$dayz); setcookie('uid',$uid,$dayz);}
if($rl)relod('?id='.$qb.'&refresh==&log=on');//prep_host($qb).
else return 'logon: '.$qb;}

//call
static function call($user,$pasw,$mail,$cook=''){
$user=normalize($user); $pasw=normalize($pasw);
$newhub=get('create_hub'); $qdu=ses('qdu'); $qb=ses('qb'); $host=hostname();
if(md5($user.$pasw)=='e36f9846e997e4491c58aa65d9c9f4e6')$_SESSION['USE']=ses('master');
//$ath=array_flip(adm::authes_levels());
//log
$uid=self::verif_user($user,$pasw);
if($uid){[$ip,$userhub]=sql('ip,hub','qdu','r','name="'.$user.'"');
	if($ip!=$host)update('qdu','ip',$host,'name',$user);
	if($userhub)$qb=$user;
	return self::log_result($user,$uid,$qb,'',$cook);}
//autolog
elseif($user=='login'){//is_numeric($ath[$user])
	if(!rstr(73))return self::form($user,'','');//autolog
	$r=sql('id,ip','qdu','r','name="'.$qb.'"');
	[$uid,$ip]=arr($r,2);
	if($ip==$host){return self::log_result($qb,$uid,$qb,'',$cook);}
	else{
		$r=sql('id,name','qdu','r','ip="'.$host.'"');
		[$uid,$USE]=arr($r,2);
		if($uid)return self::log_result($USE,$uid,$qb,'',$cook);
		else return lj('small','valid_login,form','bruu! '.helps('log_no'));}}
//bad passw
$uid=self::verif_user($user,'');
$exist=self::usedhubname($user);
$first=sql('id','qdu','v','id=1');
//sesz('tentativ');
if($uid){$_SESSION['tentativ']=ses('tentativ')+1;
	if($_SESSION['tentativ']>5)return self::alert_user($user);
	else return lj('small','valid_login,form','bruu! '.helps('log_nopass'));}
//nolog //auth_log && prms('create_hub')!="on"
elseif(prmb(11)==0 && !$newhub && $first && !auth(5))
	return lj('small','valid_login,form','bruu! '.helps('log_nohub'));
//elseif($user && $pasw && !$uid)return lj('small',"valid_login,form",'bruu! '.helps('log_nopass'));
elseif($exist===true)return lj('small','valid_login,form','bruu! '.$user.' '.nms(37));
//register
elseif(prmb(11)>=1 or $newhub or !$first or prms('create_hub')=='on'){$rl='ok';
	if(!$mail or strpos($mail,'@')===false){
		$tfield=divc('txtcadr',helps('log_newser').' '.asciinb(7));//prmb(11)
		$tfield.=hidden('user',$user).hidden('pass',$pasw);
		if(auth(6) or !$first or (prmb(11)>=6 && prms('create_hub')=='on'))
			$tfield.=hidden('create_hub',$user);
		$tfield.=autoclic('mail','mail?','20','100','').' ';
		$tfield.=submit('envoyer','ok','txtbox').' ';
		$tfield.=lj('txtx','valid_login,form',picto('before'));
		return form('/?log=on',$tfield);}
	else{
		if($_POST['mail'] or $newhub){$user=$newhub?$newhub:$user;}
		elseif($_SESSION['USE']){$user=$_SESSION['USE'];}
	if($user!='admin')$uid=self::adduser($qb,$user,$pasw,$mail);//add_user
	if(prmb(11)>=6 or $newhub or !$first){self::modif_cnfgtxt($user,$first);//add_hub
		$qb=self::makenew($user); self::message2newuser($user,$mail,$pasw); $_SESSION['auth']='';}
	$_SESSION['qbin']['adminmail']=$mail;
	self::log_result($user,$uid,$qb,$rl,$cook);}}}

static function modif_cnfgtxt($qb,$first){
$db=connect(); $f='params/_'.$db.'_config.txt';
if(is_file($f)){$d=read_file($f); $r=explode('#',$d);}
else $r=[ses('qd'),'no','yes',ses('qb'),'','philum.fr','','','','Europe/Paris','6135','4000'];
if(!$first)$r[3]=$qb; if(ses('htacc'))$r[1]='yes';
write_file($f,implode('#',$r));}

static function message2newuser($user,$mail,$pasw){
$from=$_SESSION['qbin']['adminmail'];
$subj=$user; $txt=helps('newhub_mail');
$txt=str_replace(['_USER','_PASS'],[$user,$pasw],$txt);
$txt.="\n\n".prep_host(ses('qb'));
mails::send_mail('html',$mail,$subj,nl2br($txt),$from,prep_host($user));}

static function alert_user($user){
[$qmail,$pss]=sql('mail,pass','qdu','r','name="'.$user.'"');
$subj="$qb - tentative de login";
$txt='rappel de vos identifiants:
login: '.$user.', passw: '.$pss.'
--
'.host();
$adminmail=$_SESSION['qbin']['adminmail'];
$tet="From: $adminmail \n";
mail($qmail,$subj,$txt,$tet);
return lj('small','valid_login,form',"password sent to user $user $qmail");}

#newuser
static function adduser($qb,$user,$pasw,$mail){$dayx=$_SESSION['dayx'];
$qdu=$_SESSION['qdu']; $mbrs="7::admin,"; $open=''; $ip=hostname();
if(prmb(11)>=6 or post('create_hub')){
	$open=1; $menus=$dayx; $hub=$user;
	[$rstr,$config]=self::ndprms_defaults();
	if(ses('first'))sqlsav('qdb',[$user,$qb,7]);//first
	else sqlsav('qdb',[$user,$qb,6]);}
elseif(prmb(11)>=1)sqlsav('qdb',[$user,$qb,prmb(11)]);
$ex=sql('id','qdu','v','id=1');
//if(!$ex)echo plugin('install','pub');
return insert('qdu',"(NULL,'$user',PASSWORD('$pasw'),'$mail','".$dayx."','','$ip','$rstr','$mbrs','$hub','0','$config','','','$menus','$open')");}

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
update('qdu','rstr',$rstr,'name',ses('qb'));
update('qdu','config',$config,'name',ses('qb'));}
$clr=msql_read('system','default_clr_1','');
$css='css/'.$qb.'_design_1.css'; styl::build_css($css,styl::css_default(1),$clr);
$clr=msql_read('system','default_clr_2','');
$css='css/'.$qb.'_design_2.css'; styl::build_css($css,styl::css_default(),$clr);
update('qdu','menus',ses('dayx'),'name',$qb);
if(!is_dir('users/'.$qb))mkdir_r('users/'.$qb);
$first=sql('id','qda','v','id=1');
if(!$first){
	$rw=['',$qb,'',time(),$qb,'public',nms(186).' &#127804;',1,0,'','','',ses('lng')];
	$nid=sqlsav('qda',$rw); sqlsavi('qdm',[$nid,'[philum?48:picto]']);}
return $qb;}

}
?>