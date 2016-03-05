<?php
//philum_plugin_deploy

function plug_deploy($deploy){
$qb=$_SESSION['qb']; $USE=$_SESSION['USE']; $raed=$_SESSION["raed"];
$nl=$_GET['nl']?$_GET['nl']:"nl";
if($deploy && $USE){//prep
	list($qauth,$subj)=sql('name,suj','qda','r','id="'.$deploy.'"');
	$msg=sql('msg','qdm','v','id="'.$deploy.'"');
	if($USE==$qauth or auth(5)){$http=host();
		if($_POST['dpl']==""){ 
		$qmail=recup_mails_tosend();
		$ret.=form("/?read=$deploy&deploy=$deploy&nl=nlb",txarea('dpl" maxlength="1000',$qmail,40,10).br().checkbox("dpf","ok","html",1).checkbox("multiple","ok","each_one",1).input2('submit',"send",nms(50),'popbt'));} 
		else{$htacc=urlread($deploy); $_SESSION['nl']=$nl;//deploy
			if($_POST['dpf']=="ok"){$mail_format="html";
				$txt=format_txt($msg,$nl,$deploy); $txt=html_entity_decode($txt);
				$txt=str_replace('href="/','href="'.$http.'/',$txt);
				$msg=lkc("",$http.$htacc,bal("h2",$subj));
				$msg.=divc("panel justy",$txt);}
			else{$mail_format="txt"; 
			$msg=clean_internaltag($msg); $msg=html_entity_decode($msg);}
		$_SESSION['nl']="";
	//send  
	$sender=sql('mail','qdu','v','name="'.$USE.'"');
	$lstm=str_replace("\n",",",$_POST['dpl']);
	$lstm=str_replace("\r",",",$lstm);
	$listmail=explode(",",trim($lstm));
	if($_POST['multiple']=="ok" && is_array($listmail)){
		$sentto=send_mail_r($listmail,$mail_format,$qb.' :: '.$raed,$msg,$sender,$htacc);}
	else{$sentto=$_POST['dpl']; $vm=str_replace(array(",",";","\n"," "),",",$sentto);
	send_mail($mail_format,$vm,$qb.' :: '.$raed,$msg,$sender,$htacc);}
	$ret.=lkc("popbt",'/?read='.$deploy,'article '.$deploy.' sent to: '.$sentto);}}
else{$ret.=btn("popdel","forbidden");}}
//if($_POST['dpl'])return $ret; 
return $ret;}

?>