<?php //philum/b/tracs
class tracks{//unused//}

/*static function send_track($id,$nread,$local,$name,$msg,$tim,$mail,$re){
$nmsg=lka($here.'#trk'.$nread,$local?helps('trackmail'):nms(84)).br().br();
$nmsg.=ucfirst(nms(68)).': '.$name.', '.mkday($tim).br().br().conn::read($msg,'','');
$admail=$_SESSION['qbin']['adminmail'];//to_admin
$suj=$local?suj_of_id($id):nms(84);
if($name!=$_SESSION['USE'])send_mail_html($admail,$suj,$nmsg,$mail,urlread($id));
if($local)$rmails=sql('mail','qdi','k','frm="'.$id.'" AND re>="1"');//deploy
$kem=sql('name','qda','v','id="'.$id.'"');//send_to_author
if($kem!=$name){$kmail=sql('mail','qdu','v','name="'.$kem.'"');
	if($admail!=$kmail)$rmails[$kmail]=1;} //send_track_to_user
if($rmails && $re==1)send_mail_r(array_keys_b($rmails),'html',$suj,$nmsg,$mail,$id);}*/
 
//form
static function formail($d,$res){
$ra=explode(',',ajx($d,1)); $na=count($r)-1;
$rb=ajxr($res); $nb=count($rb)-1;
for($i=0;$i<$nb;$i++){list($label,$type)=explode('=',$ra[$i]);
	$ret.=$label.' : '.$rb[$i].br();}
$from=$_SESSION['qbin']['adminmail'];
$url=urlread($_SESSION['read']);
send_mail_html($from,host().$url,$ret,$from,$url);
return br().btn('',helps('formail'));}

static function trkowner($id,$o,$res=''){
if($res)update('qdi','name',ajxg($res),'id',$id);
$nm=sql('name','qdi','v','id="'.$id.'"');
//$r=sql('name','qdi','rv','nod="'.ses('qb').'"');
$j='trknm'.$id.'_tracks,trkowner___'.$id.'____trkchgnm';
$ret=inputj('trkchgnm',$nm,$j).lj('',$j,picto('ok'));
return div(atd('trknm'.$id),$ret);}

static function trkstatus($id,$st){$ret='';
if($st)update('qdi','re',$st,'id',$id);
$re=sql('re','qdi','v','id="'.$id.'"');
//$r=[1=>nms(21),nms(171),nms(91),nms(182)];//commentaire/question/réponse/solution
$r=explode('/','/'.prmb(10));
for($i=1;$i<=4;$i++){$c=$i==$re?'active':'';
	$ret.=lj($c,'trkst'.$id.'_tracks,trkstatus___'.$id.'_'.$i,$r[$i]);}
return div(atc('list').atd('trkst'.$id),$ret);}

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
if(!$ok)return lj('txtyl','trk'.$id.'_app__xd_tracks_trash_'.$id.'_x',nms(43));
if(auth(6))sqldel('qdi',$id); return btn('txtred','deleted');}

static function publish($id,$o){req('spe,pop,art,tri,sav');
if($o=='on' or $o=='off')publish_art($o,$id,'qdi');
return tracks_one($id);}

//static function save($msg,$id,$name,$mail){$tim=time(); $iq=hostname(); //ses('iq');
static function save($msg,$id,$res){$tim=time(); $iq=hostname(); //ses('iq');
$r=ajxr($res); list($name,$mail,$ib)=arr($r,3); $suj=''; $lg=prmb(25);
$msg=htmlentities_b($msg); $msg=html2conn_b(nl2br($msg),1);
if(is_numeric($id) or substr($id,0,4)=='wall')$local=1; else $local=0;//
if(!is_numeric($id)){$id=''; $ib=$id;}//$to=frm
if(!$msg)return;// btn('popdel','bruuu! '.helps('empty_msg'));
req('sav'); $qb=$_SESSION['qb']; $base=$_SESSION['qdi'];
//if(rstr(129))$lg=yandex::detect('','',$msg);
$use=cookie('use'); if(!$use && $name){cookie('use',$name); cookie('mail',$mail);}
if(!rstr(2) or auth(4))$re=1; else $re=0;
$here=host().'/'.$id; $msg=repair_latin($msg); $msg=strip_tags($msg);
$msg=embed_links($msg); //$amsg=qres($msg);
$values=[$id,$name,$mail,$tim,$qb,$ib,$suj,$msg,$re,$iq,$lg];//,'','',''
$nread=insert('qdi',mysqlra($values,1),0);
//send_track($id,$nread,$local,$name,$msg,$tim,$mail,$re);
if(!$local)return popup(nms(34),divc('',helps('formail')),'');
if($nread)return divd('trk'.$nread,tracks_one($nread));}

//redit
static function redit_sav($d,$id){//$v=embed_links($v);
$d=preg_replace('/(\n){2,}/',"\n\n",$d);
$r=explode("\n",$d); foreach($r as $v)$rb[]=trim($v); $d=implode("\n",$rb); 
update('qdi','msg',$d,'id',$id);
return tracks_one($id,1);}

static function redit($id){$msg=sql('msg','qdi','v','id='.$id);
$ret=lj('popsav','trk'.$id.'_trkedit_edtrk'.$id.'__'.$id.'',nms(28)).btd('bts','').' ';
//$ret.=bj('trk'.$id.'|tracks,redit_sav|'.$id.'|edtrk'.$id,nms(28),'popsav').btd('bts','').' ';
$ret.=editarea('edtrk'.$id,$msg);
return $ret;}

static function captcha($d){return substr($d,2,2).substr($d,0,2);}//lol
static function secure_tracks(){
$scod=substr(microtime(),2,4); $im=plugin('imgtxt',$scod,'crackman','ok');
$ret=hidden('secur','trkscr',self::captcha($scod));
if(!rstr(15))return $ret.hidden('','trkscrvrf',$scod);
if(prms('nogdf') or !$im)$ret.=btn('txtcadr',$scod); else $ret.=$im;//gdf_ability
$ret.=autoclic('secure" id="trkscrvrf',helps('track_captcha'),'14','5','').' ';
return $ret;}

static function errors($d){if($d)return helps('tracks_error'.$d); else return nms(114);}

static function answer($id){$nm=sql('name','qdi','v','id="'.$id.'"');
return lj('popw','popup_tracks,answmsg_____'.$id,'@'.$nm).' ';}

static function read($id){req('art,tri');
return tracks_one($id);}

static function answmsg($id){return self::publish($id,'');}

static function form($id,$msg='',$capt=false){req('pop,spe');
$w=cw()-100; $user=get('user'); $ret=''; $ib='';
if(is_numeric($msg)){$ib=$msg; $msg='';}//'['.$ib.':to]'."\n\n"
elseif($capt!=false)$msg='['.$msg.'§'.$capt.':callquote]'."\n\n";
$use=ses('USE'); if(!$use)$use=cookie('use'); $ml=cookie('mail');
$rid='edtrk'.$id; $rx=['trkname','trkmail','trkib'];
if(!$use)list($use,$ml)=sql('name,mail','qdi','r','host="'.hostname().'" ORDER BY id DESC LIMIT 1');
$gn='" onkeyup="log_goodname(\'trkname\');';
if($user)$ret.=btn('txtred',nms(29).' '.nms(34).': '.$user);
$jx=implode('|',$rx); $to=$user?$user:$id; $jxb=implode(',',$rx);
$ret.=lj('popsav','track'.$id.'_tracks_'.$rid.'_14x_'.$to.'____'.$jx,nms(28)).btd('bts','').' ';//sav
$mid=$user?$user:$id;
if(rstr(2) && !auth(4))$ret.=btn('small',helps('tracks_moderation'));
if($_SESSION['USE']){$ret.=hidden('name',$rx[0],$use).hidden('mail',$rx[1],'');
	$ret.=hidden('sb','trkscr','').hidden('sc','trkscrvrf','');}//?$use:nms(38)
else{$ret.=autoclic('name" id="trkname'.$gn,$use?$use:'name','8','50','',1).' ';//name
	$ret.=autoclic('mail" id="trkmail',$ml?$ml:'mail','13','50','',1).' ';//mail
	if(!$user && $id!=$_SESSION['qb'])$ret.=hlpbt('track_follow').' ';
	$ret.=self::secure_tracks().br();}
$ret.=hidden('ib',$rx[2],$ib);
$ret.=btd('bts'.$id,'');//.' '.hlpbt('trackhelp').' ';//.hlpbt('track_orth').' ';
$ret.=lj('','popup_trkpreview_'.$rid.'_',picto('view'),att(nms(65))).' ';
$ret.=editarea($rid,$msg);
return $ret;}

static function home($p,$o){
return self::form($p,$o);}

}
?>