<?php
//philum_sav 

function save_art(){$dayx=$_SESSION['dayx']; $frm=$_SESSION['frm'];
$qb=$_SESSION['qb']; $base=$_SESSION['qda']; $qdm=$_SESSION['qdm']; $USE=$_SESSION['USE'];
if(!$frm or $frm=="Home" or $frm=="user")$frm="public"; 
$suj=clean_title($_POST['suj']); $suj=etc($suj,240);
$msg=nl2br($_POST['msg']); $name=$_POST['name']; $mail=$_POST['mail']; 
$ib=trim($_POST['ib']); $pdat=$_POST['postdat']; $urlsrc=$_POST['urlsrc']; 
if($_POST['pub'])$re=1;
if($urlsrc)$mail=https($urlsrc); $mail=utmsrc($mail); if(!$ib)$ib='/';//!$_POST['sub'] or 
if(!$name or $name==nms(38)){alert("empty_name $name"); $stoop="ok";}
if($mail=="mail" or $mail=="url"){$mail='';$urlsrc='';}
$msg=str_replace(array("<br />","<br/>","<br>","<BR>"),"\n",$msg);
$msg=str_replace("\n","",$msg); $msg=str_replace("\r","\n",$msg);
if(!$msg && $urlsrc)list($suj,$msg)=vacuum($mail,$suj);
$msg=html_entity_decode_b($msg); $msg=embed_links($msg); $msg=unescape($msg);
$msg=clean_br_lite($msg); $msg=clean_punct($msg);
if($pdat!=date("y-m-d-H-i",$dayx) && $pdat){$rdat=explode('-',$pdat);
	$pdt=mktime($rdat[3],$rdat[4],0,$rdat[1],$rdat[2],$rdat[0]);}
	else{$pdt=$dayx;}
if(empty($suj))$suj="forbidden title";
if(empty($msg)){alert('msg forbidden'); $stoop='ok';}
if($stoop==""){
	$msg=mysql_real_escape_string(stripslashes($msg)); $siz=strlen($msg);
	$suj=mysql_real_escape_string(stripslashes($suj));
	$frm=mysql_real_escape_string(stripslashes($frm));
	$nid=msquery("INSERT INTO $base VALUES ('','$ib','$name','$mail','$pdt','$qb','$frm','$suj','$re','$lu','$img','$kywk','$siz')");
	$nid=msquery("INSERT INTO $qdm VALUES ('$nid','$msg')");}
if($nid && $USE!=$qb && $_SESSION["auth"]<6){
	mail($_SESSION['qbin']["adminmail"],'new article: '.stripslashes($suj),'
	'.host().'/'.$nid.',
	auth_level: '.$_SESSION["auth"]."\n",'From: '.$USE);}
if($_SESSION['vacuum'][nohttp($urlsrc)])unset($_SESSION['vacuum'][nohttp($urlsrc)]);
if($nid){$_SESSION['rqt'][$nid]=array($pdt,stripslashes($frm),stripslashes($suj),'',$qb,'','','',$siz,$urlsrc,$ib,$re); $msg=correct_txt($msg,$nid,'savimg'); $exp_out=$nid;
	$_GET['read']=$nid; deductions_from_read($nid,''); $_POST='';}
$_SESSION['daya']=$_SESSION['dayx'];
return $exp_out;}

function saveart_url($k){$cat=$_SESSION['vaccat'][$k];
$base=$_SESSION['qda']; $qdm=$_SESSION['qdm']; $qb=$name=$_SESSION['qb']; 
$pdt=$_SESSION['dayx']; $frm=$cat?$cat:'public'; $re=rstr(11)?1:0;
$_GET['urlsrc']=$k; list($suj,$msg)=vacuum($k,'');
$msg=embed_links($msg); $msg=clean_br_lite($msg); $msg=clean_punct($msg); $s=strlen($msg);
$lnk=mysql_real_escape_string(stripslashes($k));
$frm=mysql_real_escape_string(stripslashes($frm));
$suj=mysql_real_escape_string(stripslashes($suj));
$msg=mysql_real_escape_string(stripslashes($msg));
$nid=msquery("INSERT INTO $base VALUES ('','/','$name','$lnk','$pdt','$qb','$frm','$suj','$re','$lu','$img','$kywk','')"); 
$nid=msquery("INSERT INTO $qdm VALUES ('$nid','$msg')");
$msg=correct_txt($msg,$nid,'savimg');
$_SESSION['rqt'][$nid]=array($pdt,stripslashes($frm),stripslashes($suj),'',$qb,'','','',$s,$lnk,$ib,$re); $_SESSION['daya']=$_SESSION['dayx'];
return divc('txtx',lka(htac('read').$nid,$suj));}

function save_art_batch(){$r=($_SESSION['vacuum']);//array_reverse
if($r)foreach($r as $k=>$v){$rb[]=saveart_url($k); unset($_SESSION['vacuum'][$k]);
	$_SESSION['vacsuj'][$k]=''; $_SESSION['vaccat'][$k]=''; $_SESSION['dayx']==time();}
if($rb){req('pop,spe,art,tri,mod'); $n=count($rb);
$ret.=lkc('poph','/module/recents/all/Batch/articles/'.$n,nbof($n,1)).' ';
$t=pictxt('view',nms(45).' '.nms(100));
$ret.=lj('poph','popup_modpop___all/Batch/articles/'.$n.':recents',$t);}
else $ret=nms(11).' '.nms(16); //$ret.=build_mod_r('all/Batch/multi/'.$n.':recents');
return divs('width:140px;',$ret);}

function modif_art($read,$msg){$qdm=$_SESSION['qdm'];
if($_SESSION['auth']<3)return; $msg=str_replace("\r","",$msg);
$msg=html_entity_decode_b($msg); $msg=embed_links($msg); $msg=unescape($msg);
$msg=correct_txt($msg,$read,'savimg'); $msg=clean_br_lite($msg);
$msg=clean_punct($msg); $msg=repair_tags($msg);//if(rstr(70))$msg=retape($msg,$read);
$msg=addslashes(stripslashes($msg));
msquery("UPDATE $qdm SET msg='$msg' WHERE id='$read' LIMIT 1");
return stripslashes($msg);}

function trash_art(){$erz=$_GET["trash_art"]; $USE=$_SESSION['USE'];
if($erz && $USE && ($USE==$_SESSION['author'] or $_SESSION["auth"]>=6)){
update("qda","re","0","id",$erz); update("qda","frm","_trash","id",$erz);
$_SESSION['rqt'][$erz][1]='_trash';
relod('/?read='.$erz);}}

function delete_art(){$erz=$_GET["delete_art"]; $USE=$_SESSION['USE'];
if($erz && $USE && ($USE==$_SESSION['author'] or $_SESSION["auth"]>=4)){
delete("qda",$erz); delete("qdm",$erz); unset($_SESSION['rqt'][$erz]); 
relod('/?section='.$_SESSION['frm']);}}

function save_img(){
$qb=$_SESSION['qb']; $read=$_SESSION['read'];
$fich=$_FILES['fichier']['name']; $fich_tmp=$_FILES['fichier']['tmp_name'];
$xt=xt($fich); $fich=normalize($fich); $fich=str_replace("-","",$fich);
if($fich=="")$exp_out.="no file uploaded "; else{$goodxt=".mp4.m4a.mov.mpg.mp3.wav.wmv.asf.rmv.ram.rm.swf.flv.jpg.png.gif.pdf.txt.rar.zip.tar.gz";
$goodxt.=$_SESSION['prmb'][23]; $goodext=str_replace(array(".php",".js"),"",$goodxt);
if(stristr($goodxt,$xt)===false)$exp_out.=$xt.'=forbidden ; authorized='.$goodxt.br();
$poids=$_FILES['fichier']['size']/1024; $uplimit=prms('uplimit')*1000;
if($poids>=$uplimit || $poids==0)$exp_out.="$poids > 250Mo "; if($xt==".rm")$fich.="v";
$rep='img/';
if(stristr(".m4a.mpg.mp4.asf.rmv.wmv.flv",$xt)!==false)$rep='video/';
elseif(stristr(".rar.swf.txt.pdf",$xt)!==false)$rep='docs/';
elseif(stristr(".mp3",$xt)!==false)$rep='mp3/'; 
if(stristr(".txt.mp3.pdf.swf",$xt)!==false)$rep='users/'.$qb.'/'.$rep;
elseif(stristr(".jpg.png.gif",$xt)===false)$rep='users/'.$qb.'/'.$rep;
if(stristr(".jpg.png.gif.mp3.mp4.pmg.swf.wmv.flv.pdf",$xt)===false)$w=':w';
if(stristr(".txt",$xt)!==false)$w=':scrut';
if($_GET['mode']=="banim")$mg='ban_'.$qb.'.jpg';
elseif($_GET['avnim']=="ok"){$mg='avatar_'.$_SESSION['USE'].'.gif';$rep='imgb/';}
elseif($_GET['edit_css']){$mg='css_'.$qb.'_'.$fich;$rep='imgb/';}
elseif($_GET['bkgim']=="ok"){$mg='bkg_'.$qb.'.jpg';$rep='imgb/';}
elseif($_GET["mode"]=="disk"){$rep='users/'.ajx($_GET['opdir'],1).'/'; $mg=$fich;
	if($_GET['opdir']!=$qb)mkdir_r($rep);}
else{$mg=$qb.'_'.$read.'_'.$fich;}
if(!is_dir($rep))mkdir($rep,0777);
if(is_uploaded_file($fich_tmp) && !$exp_out){
    if(!move_uploaded_file($fich_tmp,$rep.$mg))$exp_out.=" not saved";
	if($xt=='.tar' or $xt=='.gz')unpack_gz($rep.$mg,$rep);
	if($read && !$_GET["mode"]){add_im_img($mg); 
		if(!$_POST["imnot"])add_im_msg("",$rep.$mg.$w);}}//msg
else{$exp_out.="upload refused: $rep$mg";}
}//end_no_file
if($exp_out)alert($exp_out);
return $rep.$mg;}

function edit_tracks($hide,$erase){$id=$hide?$hide:$erase;
if($_SESSION['USE']==$nam or $_SESSION['auth']>=4){
	if($hide){list($nam,$suj,$ip)=sql('frm,suj','qdi','r','id="'.$id.'"');
	update("qdi","suj",'hide_'.$suj,"id",$id);}
	elseif($erase)delete('qdi',$id);}}

function sav_actions($read){
if($_GET['insert']=='ok')save_art();
if($_GET['continue']=="ok" && $read)modif_art($read,$_POST['msg']);
if($_GET['trash_art'])trash_art();
if($_GET['delete_art'])delete_art();
if($_GET['im']=='on')$im=save_img();
if($_GET['publish'] && $_GET['idy'])publish_art($_GET['publish'],$_GET['idy'],'qdi');
elseif($_GET['publish'] && $read)publish_art($_GET['publish'],$read,"qda");
if($_GET['deploy']){req('ajxf'); alert($_GET['deploy']);}
if($_GET['idy_hide'] or $_GET['idy_erase'])edit_tracks($_GET["idy_hide"],$_GET["idy_erase"]);}

?>