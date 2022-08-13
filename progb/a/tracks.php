<?php //b/tracs
class tracks{//unused//}

/*static function send_track($id,$nread,$local,$name,$msg,$tim,$mail,$re){
$nmsg=lka($here.'#trk'.$nread,$local?helps('trackmail'):nms(84)).br().br();
$nmsg.=ucfirst(nms(68)).': '.$name.', '.mkday($tim).br().br().conn::read($msg,'','');
$admail=$_SESSION['qbin']['adminmail'];//to_admin
$suj=$local?ma::suj_of_id($id):nms(84);
if($name!=$_SESSION['USE'])mails::send_mail('html',$admail,$suj,$nmsg,$mail,urlread($id));
if($local)$rmails=sql('mail','qdi','k','frm="'.$id.'" AND re>="1"');//deploy
$kem=sql('name','qda','v','id="'.$id.'"');//send_to_author
if($kem!=$name){$kmail=sql('mail','qdu','v','name="'.$kem.'"');
	if($admail!=$kmail)$rmails[$kmail]=1;} //sendtrk
if($rmails && $re==1)mails::batch(array_keys_b($rmails),'html',$suj,$nmsg,$mail,$id);}*/

//form
static function formail($d,$prm){
$ra=explode(',',ajx($d,1)); $na=count($r)-1;
$rb=($prm); $nb=count($rb)-1;
for($i=0;$i<$nb;$i++){[$label,$type]=explode('=',$ra[$i]);
	$ret.=$label.' : '.$rb[$i].br();}
$from=$_SESSION['qbin']['adminmail'];
$url=urlread($_SESSION['read']);
mails::send_mail('html',$from,host().$url,$ret,$from,$url);
return br().btn('',helps('formail'));}

static function trkowner($id,$o,$prm){
if($prm)update('qdi','name',$prm[0],'id',$id);
$nm=sql('name','qdi','v','id="'.$id.'"');
//$r=sql('name','qdi','rv','nod="'.ses('qb').'"');
$j='trknm'.$id.'_tracks,trkowner_trkchgnm__'.$id;
$ret=inputj('trkchgnm',$nm,$j).lj('',$j,picto('ok'));
return div(atd('trknm'.$id),$ret);}

static function trkstatus($id,$st){$ret='';
if($st){update('qdi','re',$st,'id',$id); return art::trkone($id);}
$re=sql('re','qdi','v','id="'.$id.'"');
//$r=[1=>nms(21),nms(171),nms(91),nms(182)];//commentaire/question/réponse/solution
$r=explode('/','/'.prmb(10));
for($i=1;$i<=4;$i++){$c=$i==$re?'active':'';
	$ret.=lj($c,'trk'.$id.'_tracks,trkstatus___'.$id.'_'.$i,$r[$i]);}
return div(atc('list'),$ret);}

static function trklang($id,$lang){$ret='';
if($lang=='find' && rstr(129)){$txt=sql('msg','qdi','v','id='.$id);
	$lang=yandex::detect('','',$txt);}
if($lang)update('qdi','lg',$lang,'id',$id);
else $lang=sql('lg','qdi','v','id="'.$id.'"');
if(!$lang)$lang=prmb(25); $r=explode(' ',prmb(26));
foreach($r as $k=>$v){$c=$v==$lang?'active':'';
	$ret.=lj($c,'trklg'.$id.'_tracks,trklang___'.$id.'_'.$v,$v).' ';}
$ret.=lj('','trklg'.$id.'_tracks,trklang___'.$id.'_find',picto('finder'));
return div(atc('list').atd('trklg'.$id),$ret);}

static function trash($id,$ok){
if(!$ok)return lj('txtyl','trk'.$id.'_tracks,trash__xd_'.$id.'_x',nms(43));
if(auth(6))sqldel('qdi',$id); return btn('txtred','deleted');}

static function publish($id,$o){
if($o=='on' or $o=='off')sav::publish_art($o,$id,'qdi');
return art::trkone($id);}

//static function save($msg,$id,$name,$mail){$tim=time(); $iq=hostname(); //ses('iq');
static function save($id,$o,$prm){$tim=time(); $iq=hostname(); //echo $id.'-'.$o;
[$msg,$name,$mail,$ib]=arr($prm,4); $suj=''; $lg=prmb(25);
$msg=htmlentities_b($msg); $msg=usg::html2conn(nl2br($msg),1);
if(is_numeric($id) or substr($id,0,4)=='wall')$local=1; else $local=0;
if(!is_numeric($id)){$id=''; $ib=$id;}//$to=frm
if(!$msg)return;// btn('popdel','bruuu! '.helps('empty_msg'));
$qb=$_SESSION['qb']; $base=$_SESSION['qdi'];
//if(rstr(129))$lg=yandex::detect('','',$msg);
$use=cookie('use'); if(!$use && $name){cookie('use',$name); cookie('mail',$mail);}
if(!rstr(2) or auth(4))$re=1; else $re=0;
$here=host().'/'.$id; $msg=strip_tags($msg); //$msg=repair_latin($msg);
$msg=embed_links($msg); //$amsg=qres($msg);
$r=[$id,$name,$mail,$tim,$qb,$ib,$suj,$msg,$re,$iq,$lg];//,'','',''
$nread=insert('qdi',mysqlra($r,1),0);
//send_track($id,$nread,$local,$name,$msg,$tim,$mail,$re);
if(!$local){ses::$r['popt']=nms(34); return helps('formail');}
if($nread)return divd('trk'.$nread,art::trkone($nread));}

//redit
static function reditsav($id,$o,$prm){
$d=$prm[0]??''; $d=preg_replace('/(\n){2,}/',"\n\n",$d);
$r=explode("\n",$d); foreach($r as $v)$rb[]=trim($v); $d=implode("\n",$rb);
update('qdi','msg',$d,'id',$id);
return art::trkone($id,1);}

static function redit($id){$msg=sql('msg','qdi','v','id='.$id);
$ret=lj('popsav','trk'.$id.'_tracks,reditsav_edtrk'.$id.'__'.$id.'',nms(28)).' ';
//$ret.=bj('trk'.$id.'|tracks,redit_sav|'.$id.'|edtrk'.$id,nms(28),'popsav').' ';
$ret.=editarea('edtrk'.$id,$msg);
return $ret;}

static function captcha($d){return substr($d,2,2).substr($d,0,2);}//lol
static function secure_tracks(){
$scod=substr(microtime(),2,4); $im=plugin('imgtxt',$scod,'crackman','ok');
$ret=hidden('trkscr',self::captcha($scod));//'secur',//!
if(!rstr(15))return $ret.hidden('trkscrvrf',$scod);
if(prms('nogdf') or !$im)$ret.=btn('txtcadr',$scod); else $ret.=$im;//gdf_ability
//$ret.=autoclic('secure" id="trkscrvrf',helps('track_captcha'),'14','5','').' ';
$ret.=input1('trkscrvrf',helps('track_captcha'),'14','','secure','5');
return $ret;}

static function errors($d){if($d)return helps('tracks_error'.$d); else return nms(114);}

static function answer($id){$nm=sql('name','qdi','v','id="'.$id.'"');
return lj('popw','popup_tracks,answmsg_____'.$id,'@'.$nm).' ';}

static function read($id){return art::trkone($id);}
static function answmsg($id){return art::trkone($id);}

static function form($id,$msg='',$capt=false){
$w=cw()-100; $user=get('user'); $ret=''; $ib='';
if(is_numeric($msg)){$ib=$msg; $msg='';}//'['.$ib.':to]'."\n\n"
elseif($capt!=false)$msg='['.$msg.'§'.$capt.':callquote]'."\n\n";
$use=ses('USE'); if(!$use)$use=cookie('use'); $ml=cookie('mail');
$rid='edtrk'.$id; $rx=['trkname','trkmail','trkib'];
if(!$use)[$use,$ml]=sql('name,mail','qdi','r','host="'.hostname().'" order by id desc limit 1');
if($user)$ret.=btn('txtred',nms(29).' '.nms(34).': '.$user);
$ids=implode(',',$rx); $to=$user?$user:$id;
$ret.=lj('popsav','track'.$id.'_tracks,save_'.$rid.','.$ids.'_14x_'.$to,nms(28)).' ';//sav
$mid=$user?$user:$id;
if(rstr(2) && !auth(4))$ret.=btn('small',helps('tracks_moderation'));
if($_SESSION['USE']){$ret.=hidden($rx[0],$use).hidden($rx[1],'');
	$ret.=hidden('trkscr','').hidden('trkscrvrf','');}//?$use:nms(38)//'sb',//'sc',//!
else{$pr['onkeyup']=atj('log_goodname','trkname');
	$ret.=input1('trkname'.$gn,$use,'8','','name','50',$pr);
	$ret.=input1('trkmail'.$gn,$ml,'14','email','name','50',$pr);
	if(!$user && $id!=$_SESSION['qb'])$ret.=hlpbt('track_follow').' ';
	$ret.=self::secure_tracks().br();}
$ret.=hidden($rx[2],$ib);//'ib',//!
$ret.=btd('bts'.$id,'');//.' '.hlpbt('trackhelp').' ';//.hlpbt('track_orth').' ';
$ret.=lj('','popup_conn,read2_'.$rid.'_',picto('view'),att(nms(65))).' ';
$ret.=editarea($rid,$msg);
return $ret;}

static function home($p,$o){
return self::form($p,$o);}

}
?>