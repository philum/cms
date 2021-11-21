<?php
//philum_plugin_forum

function forum_read($cht){
if($_POST["submit"]){forumsave($_POST["name"],$cht,$_POST["msg"],$_POST["suj"]);}
$qdi=$_SESSION['qdi'];$qb=$_SESSION['qb'];
if($_GET['open']) $ar[]=array("name","date","msg"); 
else $ar[]=array("title","msg","nb","name","date");
$otp=sql('suj,id','qdi','kr','nod="'.$qb.'" AND frm="forum'.$cht'" ORDER BY id desc');
if($otp){foreach($otp as $suj=>$r){$mx=count($r); $bid=$r[0];
	list($id,$name,$day,$msg)=sql('id,name,day,msg','qdi','r','id='.$bid);
	$suj=lkc('','/?read='.$_SESSION['read'].'&suj='.$suj.'&open='.$bid,$suj);
	if($_GET['open']==$bid){
		for($i=0;$i<$mx;$i++){$cid=$r[$i];
		list($id,$name,$day,$msg)=sql('id,name,day,msg','qdi','r','id='.$cid);
		$ar[]=array($name,time_ago($day),$msg);}}
	elseif(!$_GET['open']){
		$ar[]=array($suj,$msg,$mx,$name,time_ago($day));}}}//$answ
return tabler($ar,"txtblc","");}

function forumsave($name,$frm,$msg,$suj){
$qb=$_SESSION['qb']; $qdi=$_SESSION['qdi']; $pdt=$_SESSION['dayx']; 
return qrid("INSERT INTO $qdi VALUES ('','$ib','$name','$mail','$pdt','$qb','forum$frm','$suj','$msg','1','','')");}

function forumform($cht){
$tfield=btn("txtx","subject:").' ';
$tfield.=hidden('name','',$_SESSION['USE']);
if(!$_GET['open'])$tfield.=autoclic('text','suj',$_GET['suj']?$_GET['suj']:'suj',"15",'1000',"txtx").' '; else $tfield.=hidden('suj','',$_GET['suj']);
$tfield.=autoclic('text','msg','msg',"25",'1000',"txtx").' ';
$tfield.=submit('submit','ok','txtx');
if($_SESSION['auth']>=1)return form('/?read='.$cht.'&suj='.$_GET['suj'].'&open='.$_GET['open'],$tfield);}

function plug_forum($cht){
$cht=normalize($cht);
//$ret.=forumform($cht);
if($_GET['open'])$ret.=lkc("txtx",'/?read='.$_SESSION['read'],"<-");
//$ret.=forum_read($cht);
return $ret;}

?>