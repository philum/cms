<?php //forum
class forum[
static function read($cht){
if($_POST["submit"]){self::save($_POST["name"],$cht,$_POST["msg"],$_POST["suj"]);}
$qdi=$_SESSION['qdi'];$qb=$_SESSION['qb'];
if($_GET['open']) $ar[]=["name","date","msg"]; 
else $ar[]=["title","msg","nb","name","date"];
$otp=sql('suj,id','qdi','kr','nod="'.$qb.'" AND frm="forum'.$cht'" ORDER BY id desc');
if($otp){foreach($otp as $suj=>$r){$mx=count($r); $bid=$r[0];
	[$id,$name,$day,$msg]=sql('id,name,day,msg','qdi','r','id='.$bid);
	$suj=lkc('','/'.ses('read').'&suj='.$suj.'&open='.$bid,$suj);
	if($_GET['open']==$bid){
		for($i=0;$i<$mx;$i++){$cid=$r[$i];
		[$id,$name,$day,$msg]=sql('id,name,day,msg','qdi','r','id='.$cid);
		$ar[]=array($name,time_ago($day),$msg);}}
	elseif(!$_GET['open']){
		$ar[]=array($suj,$msg,$mx,$name,time_ago($day));}}}//$answ
return tabler($ar,"txtblc","");}

static function save($name,$frm,$msg,$suj){
$qb=$_SESSION['qb']; $qdi=$_SESSION['qdi']; $pdt=$_SESSION['dayx']; 
return sql::qrid("INSERT INTO $qdi VALUES ('','$ib','$name','$mail','$pdt','$qb','forum$frm','$suj','$msg','1','','')");}

static function form($cht){
$tfield=btn("txtx","subject:").' ';
$tfield.=hidden('name',$_SESSION['USE']);
if(!get('open'))$tfield.=inputb('text',get('suj'),15,'subject',1000,[]);
else $tfield.=hidden('suj',$_GET['suj']);
$tfield.=inputb('text','',25,'message',1000,[]);
$tfield.=submit('submit','ok','txtx');
if($_SESSION['auth']>=1)return form('/?read='.$cht.'&suj='.$_GET['suj'].'&open='.$_GET['open'],$tfield);}

static function home($cht){
$cht=normalize($cht);
//$ret.=self::form($cht);
if($_GET['open'])$ret.=lkc("txtx",'/'.ses('read'),"<-");
//$ret.=self::read($cht);
return $ret;}
}
?>