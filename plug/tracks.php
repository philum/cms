<?php
//philum_plugin_tracks
session_start();
error_reporting(6135);

function captcha($d){return substr($d,2,2).substr($d,0,2);}//lol
function secure_tracks(){
$scod=substr(microtime(),2,4); $im=plugin('imgtxt',$scod,"crackman","ok");
$ret=hidden('secur','trkscr',captcha($scod));
if(!rstr(15))return $ret.hidden('','trkscrvrf',$scod);
if(prms('nogdf') or !$im)$ret.=btn('txtcadr',$scod);//gdf_ability
else $ret.=$im;
$ret.=autoclic('secure" id="trkscrvrf',helps('track_captcha'),'14','5','').' ';
return $ret;}

function track_errors($d){if($d)return helps('tracks_error'.$d); else return nms(114);}

function track_answer($id){$nm=sql('name','qdi','v','id="'.$id.'"');
return lj('popw','popup_plup___tracks_track*answmsg_'.$id,'@'.$nm).' ';}

/*function track_quote($id){
list($nm,$day,$msg)=sql('name,day,msg','qdi','r','id="'.$id.'"');
$bt=lkc('txtblc',urlread($_SESSION['read']).'#trk'.$id,$nm); 
$msg=correct_br($msg); $msg=miniconn($msg);
$msg=correct_txt($msg,'','sconn'); $msg=embed_p($msg);
$day=btn('txtsmall2',mkday($day,'y/m/d H:i'));
return divc('track',$bt.' '.$day.br().$msg);}*/

function track_answmsg($id){return trk_publish($id,'');}

function f_inp_track($id,$msg=''){$w=currentwidth()-100; $user=$_GET['user'];
if($_SESSION['USE'])$use=$_SESSION['USE']; else list($use,$ml)=sql('name,mail','qdi','r','host="'.hostname().'" ORDER BY id DESC LIMIT 1');
$gn='" onkeyup="log_goodname(\'trkname\');';
if($user)$ret.=btn("txtred",nms(29).' '.nms(34).': '.$user);
$ret.=ljb('popsav','SaveBbd','track_'.($user?$user:$id).'_1',nms(29)).btd('bts','').' ';
if(rstr(2) && !auth(4))$ret.=btn('small',helps('tracks_moderation'));
if($_SESSION['USE']){$ret.=hidden('name','trkname',$use).hidden('mail','trkmail','');
	$ret.=hidden('sb','trkscr','').hidden('sc','trkscrvrf','');}//?$use:nms(38)
else{$ret.=autoclic('name" id="trkname'.$gn,$use,'8','50','',1).' ';//name
	$ret.=autoclic('mail" id="trkmail',$ml?$ml:'mail','13','50','',1).' ';//mail
	if(!$user && $id!=$_SESSION['qb'])$ret.=hlpbt('track_follow').' ';
	$ret.=secure_tracks().br();}
//$ret.=balc('button','txtx" onclick="embed(\'video\')',picto('video'));
$ret.=btd('bts'.$id,$sav).' '.hlpbt('trackhelp').' ';//.hlpbt('track_orth').' ';
$ret.=lj('" title="'.nms(65),'popup_trkpreview_txtarea_',picto('view')).' ';
//$ret.=divedit('txtarea','track','min-height:100px; min-width:320px;','',$d?$d:$msg);
$ret.=micro_connedit('txtarea').br().txarea('txtarea',$d?$d:$msg,80,16,'console').br();
return $ret.$r['html'];}

function trk_publish($id,$o){req('spe,pop,art,tri');
if($o)publish_art($o,$id,'qdi');
return tracks_read($id,'','');}

function save_track($msg,$id,$name,$mail){$pdt=time(); $ip=hostname();
if(is_numeric($id) or substr($id,0,4)=='wall')$local=true;
if(!$msg)return;// btn('popdel','bruuu! '.helps('empty_msg'));
require('prog/sav.php'); $qb=$_SESSION['qb']; $base=$_SESSION['qdi'];
$_GET['idy']='ok'; $_GET['insert']='ok'; $_POST['name']=$nm; $_POST['msg']=$msg;
if(!rstr(2) or auth(4))$op=1; else $op=0;
$here=host().'/?read='.$id; $msg=str_replace(":chat","",$msg); $msg=repair_latin($msg);
$msg=embed_links($msg); $amsg=mysql_real_escape_string(stripslashes($msg));
$nread=msquery("INSERT INTO $base VALUES ('','$ib','$name','$mail','$pdt','$qb','$id','$suj','$amsg','$op','','','','$ip')");
$suj=$local?suj_of_id($id):nms(84);
$nmsg=lka($here.'#trk'.$nread,$local?helps('trackmail'):nms(84)).br().br();
$nmsg.=nms(68).': '.$name.', '.mkday($pdt).br().br().format_txt($msg,'','');
$admail=$_SESSION['qbin']['adminmail'];//to_admin
if($name!=$_SESSION['USE'])send_mail_html($admail,$suj,$nmsg,$mail,urlread($id));
if($local)$rmails=sql('mail','qdi','k','frm="'.$id.'" AND re>="1"');//deploy
$kem=rse('name',$_SESSION['qda'].' WHERE id="'.$id.'"');//send_to_author
if($kem!=$name){$kmail=rse('mail',$_SESSION['qdu'].' WHERE name="'.$kem.'"');
	if($admail!=$kmail)$rmails[$kmail]=1;} //send_track_to_user
if($rmails && $op==1)send_mail_r(array_keys_b($rmails),'html',$suj,$nmsg,$mail,$id);
if(!$local)return popup(nms(34),divc('',helps('formail')),'');
//elseif(!$local)return btn('popbt',helps('formail'));
//return output_trk(read_idy($id,"DESC"));
return tracks_read($nread,'','');}

//redit
function trk_redit_sav($v,$id){//$v=embed_links($v); 
$v=mysql_real_escape_string(stripslashes($v)); 
update('qdi','msg',$v,'id',$id); return tracks_read($id,1,1);}

function trk_redit($id){$msg=sql('msg','qdi','v','id='.$id);
$ret=lj('popsav','trk'.$id.'_trkedit_trkedit_x_'.$id.'','save').btd('bts','').' ';
$ret.=micro_connedit('trkedit').br().txarea('trkedit',$msg,80,16,'console').br();
return $ret;}

//form
function formail($d,$res){
$ra=explode(',',ajx($d,1)); $na=count($r)-1;
$rb=ajxr($res); $nb=count($rb)-1;
for($i=0;$i<$nb;$i++){list($label,$type)=split('=',$ra[$i]);
	$ret.=$label.' : '.$rb[$i].br();}
$from=$_SESSION['qbin']['adminmail'];
$url=urlread($_SESSION['read']);
send_mail_html($from,host().$url,$ret,$from,$url);
return br().btn('',helps('formail'));}

function micro_connedit($id){
$r=array('b'=>'bold','i'=>'italic','u'=>'underline','q'=>'quote','list'=>'list');
$ret=ljb('','embed_slct(\'[\',\']\',\''.$id.'\')','','[]');
foreach($r as $k=>$v)$ret.=ljb('','embed_slct(\'[\',\':'.$k.']\',\''.$id.'\')','','['.$v.']');
return btn('nbp',$ret);}

function plug_tracks($p,$o){
return $ret;}

?>