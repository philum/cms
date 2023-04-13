<?php 
class tracks{//}

//form
static function formail($d,$prm){
$ra=explode(',',ajx($d,1)); $na=count($ra)-1;
$rb=($prm); $nb=count($rb)-1; $ret='';
for($i=0;$i<$nb;$i++){[$label,$type]=explode('=',$ra[$i]);
	$ret.=$label.' : '.$rb[$i].br();}
$from=$_SESSION['qbin']['adminmail'];
$url=urlread(ses('read'));
mails::send_mail('html',$from,host().$url,$ret,$from,$url);
return br().btn('',helps('formail'));}

static function trkowner($id,$o,$prm){
if($prm)sql::upd('qdi',['name'=>$prm[0]],$id);
$nm=sql('name','qdi','v','id="'.$id.'"');
//$r=sql('name','qdi','rv','nod="'.ses('qb').'"');
$j='trknm'.$id.'_tracks,trkowner_trkchgnm__'.$id;
$ret=inputj('trkchgnm',$nm,$j).lj('',$j,picto('ok'));
return div(atd('trknm'.$id),$ret);}

static function trkstatus($id,$st){$ret='';
if($st){sql::upd('qdi',['re'=>$st],$id); return art::trkone($id);}
$re=sql('re','qdi','v','id="'.$id.'"');
//$r=[1=>nms(21),nms(171),nms(91),nms(182)];//commentaire/question/réponse/solution
$r=explode('/','/'.prmb(10));
for($i=1;$i<=4;$i++){$c=active($i,$re);
	$ret.=lj($c,'trk'.$id.'_tracks,trkstatus___'.$id.'_'.$i,$r[$i]);}
return div(atc('list'),$ret);}

static function trklang($id,$lang){$ret='';
if($lang=='find' && rstr(129)){$txt=sql('msg','qdi','v',$id);
	$lang=trans::detect('','',$txt);}
if($lang)sql::upd('qdi',['lg'=>$lang],$id);
else $lang=sql('lg','qdi','v',$id);
if(!$lang)$lang=prmb(25); $r=explode(' ',prmb(26));
foreach($r as $k=>$v){$c=active($v,$lang);
	$ret.=lj($c,'trklg'.$id.'_tracks,trklang___'.$id.'_'.$v,$v).' ';}
$ret.=lj('','trklg'.$id.'_tracks,trklang___'.$id.'_find',picto('finder'));
return div(atc('list').atd('trklg'.$id),$ret);}

static function trash($id,$ok){
if(!$ok)return lj('txtyl','trk'.$id.'_tracks,trash__xd_'.$id.'_x',nms(43));
if(auth(6))sql::del('qdi',$id); return btn('txtred','deleted');}

static function publish($id,$o){
if($o=='on' or $o=='off')sav::publish_art($o,$id,'qdi');
return art::trkone($id);}

//static function save($msg,$id,$name,$mail){$tim=time(); $iq=hostname(); //ses('iq');
static function save($id,$o,$prm){$tim=time(); $iq=hostname();
[$msg,$name,$mail,$ib]=arr($prm,4); $suj=''; $lg=prmb(25);
$msg=str::htmlentities_b($msg); $msg=usg::html2conn(nl2br($msg),1);
if(is_numeric($id) or substr($id,0,4)=='wall')$local=1; else $local=0;
if(!is_numeric($id)){$ib=$id; $id=0;}//$to=frm
if(!$msg)return;// btn('popdel','bruuu! '.helps('empty_msg'));
$qb=$_SESSION['qb']; $base=$_SESSION['qdi'];
//if(rstr(129))$lg=trans::detect('','',$msg);
$use=cookie('use'); if(!$use && $name){cookie('use',$name); cookie('mail',$mail);}
if(!rstr(2) or auth(4))$re=1; else $re=0;
$here=host().'/'.$id; $msg=strip_tags($msg);
$msg=str::embed_links($msg); //$amsg=sql::qres($msg);
$r=[$id,$name,$mail,$tim,$qb,$ib,$suj,$msg,$re,$iq,$lg];//,'','',''
$nread=sql::sav('qdi',$r,0);
//send_track($id,$nread,$local,$name,$msg,$tim,$mail,$re);
if(!$local){ses::$r['popt']=nms(34); return helps('formail');}
if($o)return self::redit($nread,40,1);
if($nread)return divd('trk'.$nread,art::trkone($nread));}

//redit
static function reditsav($id,$o,$prm){
$d=$prm[0]??''; $d=preg_replace('/(\n){2,}/',"\n\n",$d);
$r=explode("\n",$d); foreach($r as $v)$rb[]=trim($v); $d=implode("\n",$rb);
sql::upd('qdi',['msg'=>$d],$id);
return art::trkone($id,1);}

static function redit($id,$sz='',$cl=''){
[$ib,$msg]=sql('ib,msg','qdi','w',$id);
$ret=lj('popsav','trk'.$id.'_tracks,reditsav_edtrk'.$id.'__'.$id.'',picto('save'));//nms(27)
if($cl)$ret.=lj('','track'.$ib.'_tracks,reditsav_edtrk'.$id.'_14xk_'.$id.'',picto('sclose'));
else $ret.=lj('popbt','trkdsk_tracks,redit__x_'.$id.'_40_1',picto('popup'),att(nms(198)));
//$ret.=bj('trk'.$id.'|tracks,redit_sav|'.$id.'|edtrk'.$id,nms(28),'popsav');
$ret.=editarea('edtrk'.$id,$msg,$sz?$sz:80);
return $ret;}

static function captcha($d){return substr($d,2,2).substr($d,0,2);}//lol
static function secure_tracks(){
$scod=substr(microtime(),2,4); $im=imgtxt::home($scod,'crackman','ok');
$ret=hidden('trkscr',self::captcha($scod));//'secur',//!
if(!rstr(15))return $ret.hidden('trkscrvrf',$scod);
if(prms('nogdf') or !$im)$ret.=btn('txtcadr',$scod); else $ret.=$im;//gdf_ability
$ret.=inputb('trkscrvrf','','14',helps('track_captcha'),'5',['name'=>'secure']);
return $ret;}

static function errors($d){if($d)return helps('tracks_error'.$d); else return nms(114);}

static function answer($id){$nm=sql('name','qdi','v','id="'.$id.'"');
return lj('popw','popup_tracks,answmsg_____'.$id,'@'.$nm).' ';}

static function read($id){return art::trkone($id);}
static function answmsg($id){return art::trkone($id);}
static function preview($id,$p,$prm=[]){return conn::read2($prm[0]??'');}

static function form($id,$msg='',$capt=false){
$w=cw()-100; $ret=''; $ib=''; $user=''; $nfo='';
if(is_numeric($msg)){$ib=$msg; $msg='['.$ib.':to]'."\n\n"; $nfo='reply';}
elseif($capt!=false){$msg='['.$msg.'§'.$capt.':callquote]'."\n\n"; $nfo='quote';}
elseif(!is_numeric($id)){$user=$id; $id=''; $nfo='private';}
$use=ses('USE'); if(!$use)$use=cookie('use'); $ml=cookie('mail');
if(!$use)[$use,$ml]=sql('name,mail','qdi','r',['host'=>hostname(),'_code'=>'order by id desc limit 1']);
//mode
if($nfo=='reply')$ret.=btn('txtred',nms(174).' '.sql('name','qdi','v',$ib));
elseif($nfo=='quote')$ret.=btn('txtred',nms(190));
elseif($nfo=='private')$ret.=btn('txtred',nms(84));
//bt
$rx=['trkname','trkmail','trkib']; $ids=implode(',',$rx); $rid='edtrk'.$id; 
if($user)$ret.=lj('popdel','popup_tracks,save_'.$rid.','.$ids.'_x_'.$user,nms(34).' '.nms(36).' '.$user).' ';
else{$j='track'.$id.'_tracks,save_'.$rid.','.$ids;
	$ret.=lj('popsav','track'.$id.'_tracks,save_'.$rid.','.$ids.'_14x_'.$id,picto('save')).' ';//nms(28)
	$ret.=lj('','trkdsk_tracks,save_'.$rid.','.$ids.'_x_'.$id.'_1',picto('popup'),att(nms(198))).' ';}
//form
if(rstr(2) && !auth(4))$ret.=btn('small',helps('tracks_moderation'));
if(ses('USE'))$ret.=hidden($rx[0],$use).hidden($rx[1],'').hidden('trkscr','').hidden('trkscrvrf','');
else{$pr['onkeyup']=atj('log_goodname','trkname');
	$ret.=inputb('trkname',$use,'8','name','50',$pr);
	//$ret.=inputb('trkmail',$ml,'14','mail','50',$pr+['type'=>'mail']);
	$ret.=inpmail('trkmail',$ml,$pr);
	if(!$user && $id!=ses('qb'))$ret.=hlpbt('track_follow').' ';
	$ret.=self::secure_tracks().br();}
$ret.=hidden($rx[2],$ib);//'ib',//!
$ret.=btd('bts'.$id,'');//.' '.hlpbt('trackhelp').' ';//.hlpbt('track_orth').' ';
//$ret.=lj('','popup_tracks,preview_'.$rid,picto('view'),att(nms(65))).' ';
$ret.=editarea($rid,$msg);//divarea
ses::$r['popw']='620';
return $ret;}

static function home($p,$o){
return self::form($p,$o);}
}
?>