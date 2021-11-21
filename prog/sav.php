<?php
//philum_sav

function save_art(){$dayx=$_SESSION['dayx']; $frm=$_SESSION['frm'];
$qb=$_SESSION['qb']; $USE=$_SESSION['USE']; $ko=''; $lg=''; $nid='';
if(!$frm or $frm=='Home' or $frm=='user')$frm='public'; 
$suj=clean_title(post('suj')); $suj=etc($suj,240);
$msg=nl2br(post('msg')); $name=post('name'); $mail=post('mail'); 
$ib=trim(post('ib')); $pdat=post('postdat'); $urlsrc=get('urlsrc'); 
if(post('pub'))$re=1; else $re=0;
if($urlsrc)$mail=http($urlsrc); $mail=utmsrc($mail); if(!$ib)$ib='0';//!$_POST['sub'] or 
if(!$name or $name==nms(38)){alert('empty_name $name'); $ko='ok';}
if($mail=='mail' or $mail=='url'){$mail='';$urlsrc='';}
$msg=str_replace(['<br />','<br/>','<br>','<BR>'],"\n",$msg);
$msg=str_replace("\n",'',$msg); $msg=str_replace("\r","\n",$msg);
if(!$msg && $urlsrc)list($suj,$msg)=conv::vacuum($mail,$suj);
$msg=html_entity_decode_b($msg); $msg=embed_links($msg);
$msg=decode_unicode($msg); $msg=clean_br_lite($msg); $msg=clean_punct($msg);
if($pdat!=date('y-m-d-H-i',$dayx) && $pdat){$rdat=explode('-',$pdat);
	$pdt=mktime($rdat[3],$rdat[4],0,$rdat[1],$rdat[2],$rdat[0]);}
else $pdt=$dayx;
if(empty($suj))$suj='forbidden title';
if(empty($msg)){alert('msg forbidden'); $ko='ok';}
if(!$ko){
	$sz=strlen($msg); $img=''; $thm=hardurl($suj);//if(rstr(38))
	if(rstr(129))$lg=yandex::detect('','',$suj); if($lg==ses('lng'))$lg='';
	$rw=[$ib,$name,$mail,$pdt,$qb,$frm,$suj,$re,0,$img,$thm,$sz,$lg];
	$nid=sqlsav('qda',$rw,0); if($nid)sqlsavi('qdm',[$nid,$msg],0);}
//if($nid && $USE!=$qb && $_SESSION['auth']<6){mail($_SESSION['qbin']['adminmail'],'new article: '.stripslashes($suj),host().'/'.$nid.',auth_level: '.$_SESSION['auth']."\n",'From: '.$USE);}
vacses($urlsrc,'u','x');
if($nid){$rc=[$pdt,$frm,$suj,$img,$qb,$thm,0,$name,$sz,$urlsrc,$ib,$re,$lg];
	if(!isset($_SESSION['rqt'][$nid]))$_SESSION['rqt'][$nid]=$rc; 
	msql::modif('',nod('cache'),$rc,'one','',$nid);
	$msg=codeline::parse($msg,$nid,'savimg');
	$_GET['read']=$nid; deductions_from_read($nid,''); $_POST=[];}
$_SESSION['dayx']=time(); $_SESSION['daya']=$_SESSION['dayx'];
return $nid;}

function saveart_url($u){$cat=vacses($u,'c');
$qda=$_SESSION['qda']; $qdm=$_SESSION['qdm']; $qb=$name=$_SESSION['qb']; 
$pdt=$_SESSION['dayx']; $frm=$cat?$cat:'public'; $re=rstr(11)?1:0;
$_GET['urlsrc']=$u; list($suj,$msg)=conv::vacuum($u,''); $ib='0'; $lg='';
$msg=embed_links($msg); $msg=clean_br_lite($msg); $msg=clean_punct($msg); $sz=strlen($msg); $img='';
$thm=hardurl($suj);//if(rstr(38))
//$lg=ses('lang')!='all'?ses('lang'):substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
if(rstr(129))$lg=yandex::detect('','',$suj); if($lg==ses('lng'))$lg='';
$rw=[$ib,$name,$u,$pdt,$qb,$frm,$suj,$re,0,$img,$thm,$sz,$lg];
$nid=sqlsav('qda',$rw); if($nid)sqlsavi('qdm',[$nid,$msg]);
if($nid)vacses($u,'b','x');
$msg=codeline::parse($msg,$nid,'savimg');
$_SESSION['rqt'][$nid]=[$pdt,stripslashes($frm),stripslashes($suj),'',$qb,'','','',$sz,$u,$ib,$re]; $_SESSION['daya']=$_SESSION['dayx'];
return $nid;}

function save_art_batch(){$r=$_SESSION['vac']; $_SESSION['vac2']=$r;//array_reverse
if($r)foreach($r as $k=>$v){$rb[]=saveart_url($v['u']); $_SESSION['dayx']=time();}
if($rb){$n=count($rb); $ids=implode('|',$rb); 
$ret=lj('poph','popup_apij___id:'.$ids.',preview:2',pictxt('view',nbof($n,1)));}
else $ret=nmx([11,16]);
return $ret;}

function modif_art($id,$msg){$qdm=$_SESSION['qdm'];
if($_SESSION['auth']<3)return; $msg=str_replace("\r",'',$msg);
$msg=clean_acc($msg); $msg=stupid_acc($msg); $msg=embed_links($msg);
$msg=decode_unicode($msg); $msg=codeline::parse($msg,$id,'savimg'); $msg=clean_br_lite($msg);
$msg=clean_punct($msg); $msg=repair_tags($msg);//if(rstr(70))$msg=conn::retape($msg,$id);
if(is_numeric($id))sqlup('qdm',['msg'=>$msg],'id',$id);
$l=strlen($msg); update('qda','host',$l,'id',$id); cachevs($id,8,$l);
return stripslashes($msg);}

function publish_art($d,$id,$bs){if(auth(4)){
if($d=='on'){update($bs,'re','1','id',$id);
	send_user_mail($_SESSION['read'],'published_art');
	if($bs=='qdi')send_track_to_user($id);}
elseif($d=='off')update($bs,'re','0','id',$id);}}

function upload_sav($id,$type,$dsk){$rid='upfile'.$id;
$f=$_FILES[$rid]['name']; $f_tmp=$_FILES[$rid]['tmp_name'];
if(!$f)return 'no file uploaded '; $er=''; $rep=''; $w='';
$f=normalize($f); $xt=xt($f); $qb=ses('qb');
$goodxt='.mp4.m4a.mov.mpg.mp3.mkv.mid.wav.jpg.png.gif.pdf.txt.docx.rar.zip.tar.gz.svg.webp.webm.ods.odt';
$goodxt.=$_SESSION['prmb'][23];
if(stristr($goodxt,$xt)===false)$er=$xt.'=forbidden; authorized='.$goodxt.br();
if(stristr('.jpg.png.gif.mp3.mp4.pdf',$xt)===false)$w=':w';
$fsize=$_FILES[$rid]['size']/1024; $uplimit=prms('uplimit');
if($fsize>=$uplimit || $fsize==0)$er.='>'.$uplimit.'Ko';
if(stristr('.m4a.mpg.mp4.webm',$xt)!==false)$rep='users/'.$qb.'/video/';
elseif(stristr('.rar.txt.pdf.svg',$xt)!==false)$rep='users/'.$qb.'/docs/';
elseif(stristr('.mp3.mid',$xt)!==false)$rep='users/'.$qb.'/mp3/'; 
if($type=='banim'){$fb='ban_'.$qb.'.jpg'; $dir='imgb/';}
elseif($type=='avnim'){$fb='avatar_'.ses('USE').'.gif'; $dir='imgb/';}
elseif($type=='css'){$fb='css_'.$qb.'_'.$f; $dir='imgb/';}
elseif($type=='bkgim'){$fb='bkg_'.$qb.'.jpg'; $dir='imgb/';}
elseif($type=='disk'){$dir='users/'.$dsk.'/'; $fb=$f; if($dsk!=$qb)mkdir_r($dir);}
elseif($type=='trk'){$fb=$qb.'_'.substr($id,2).'_'.substr(md5($f),0,6).$xt; $dir=$rep?$rep:'img/';}
else{$fb=$qb.'_'.$id.'_'.substr(md5($f),0,6).$xt; $dir=$rep?$rep:'img/';}
if(!is_dir($dir))mkdir_r($dir); $fc=$dir.$fb;
if(is_uploaded_file($f_tmp) && !$er){
	if(!move_uploaded_file($f_tmp,$fc))$er.='not saved';
	if($type=='art' && is_image($fc)){conn::add_im_img($fb,$id);}//conn::add_im_msg($id,'',$fb.$w);
	if($xt=='.tar' or $xt=='.gz')unpack_gz($fc,$dir);}
else $er.='upload refused: '.$fb;
if(!$er && $type=='avnim')make_mini($fc,$fc,72,72,2);
if($er)return btn('txtyl',picto('false').' '.$fc.': '.$er);
elseif($type=='disk' or !is_image($fc))return btn('txtyl',picto('true').' '.$fc);
elseif($type=='art')return placeim($id);
elseif($type=='trk')return placeimtrk($fb,$id);
else return image($fc,48,48).btn('txtx',picto('true').' '.$fc);}

?>