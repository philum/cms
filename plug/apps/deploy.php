<?php //deploy
class deploy{
static function home($deploy){$ret='';
$qb=$_SESSION['qb']; $USE=$_SESSION['USE']; $raed=ma::suj_of_id($deploy);
if($deploy && $USE){//prep
	[$qauth,$subj]=sql('name,suj','qda','r','id="'.$deploy.'"');
	$msg=sql('msg','qdm','v','id="'.$deploy.'"');
	if($USE==$qauth or auth(5)){$http=host();
		if(!$_POST['dpl']){$qmail=mails::datas(1);
		$ret.=form('/?read=$deploy&deploy=$deploy',textarea('dpl" maxlength="1000',$qmail,40,10).br().checkbox('dpf','ok','html',1).checkbox('multiple','ok','each_one',1).submit('send',nms(50),'popbt'));} 
		else{$htacc=urlread($deploy);//deploy
			if($_POST['dpf']=='ok'){$mail_format='html';
				$txt=conn::read($msg,'',$deploy,1); $txt=html_entity_decode($txt);
				$txt=str_replace('href="/','href="'.$http.'/',$txt);
				$msg=lkc('',$http.$htacc,tagb("h2",$subj));
				$msg.=divc('panel justy',$txt);}
			else{$mail_format='txt'; 
			$msg=clean_internaltag($msg); $msg=html_entity_decode($msg);}
	//send  
	$sender=sql('mail','qdu','v','name="'.$USE.'"');
	$lstm=str_replace("\n",",",$_POST['dpl']);
	$lstm=str_replace("\r",",",$lstm);
	$listmail=explode(",",trim($lstm));
	if($_POST['multiple']=="ok" && is_array($listmail)){
		$sentto=mails::batch($listmail,$mail_format,$qb.' :: '.$raed,$msg,$sender,$htacc);}
	else{$sentto=$_POST['dpl']; $vm=str_replace(array(",",";","\n"," "),",",$sentto);
	send_mail($mail_format,$vm,$qb.' :: '.$raed,$msg,$sender,$htacc);}
	$ret.=lkc("popbt",'/?read='.$deploy,'article '.$deploy.' sent to: '.$sentto);}}
else{$ret.=btn('popdel','forbidden');}}
//if($_POST['dpl'])return $ret; 
return $ret;}
}
?>