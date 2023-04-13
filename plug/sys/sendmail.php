<?php //sendmail
class sendmail{
static function form($arr,$goto){
if($_GET["kill"]) $r=["from"=>$_GET["kill"],"dest"=>$_GET["dest"],"suj"=>$_GET["suj"]];
	foreach($arr as $k=>$v){
	if($v=="text"){
	$ret.=inputb($k,$r[$k],44,'',255,['name'=>$k]);}
	if($v=="textarea"){$ret.=tag($v,['name'=>$k,'id'=>$k,'class'=>'txtblc','cols'=>64,'rows'=>10],$k);}
	if($v=="submit"){$ret.=submit($v,$k,"txtblc");}
	if($v!="submit")$ret.=tag('label',["for"=>$k],$k).br();}
	return form("",$ret);}

static function home(){
$ret.=lkc("","sendmail.php","index").br();
$ip=hostname();
$arr=["from"=>"text","dest"=>"text","suj"=>"text","msg"=>"textarea","ok"=>"submit"];
if($_POST["submit"]=="ok"){
foreach($arr as $k=>$v){$$k=$_POST[$k]; $ret.=$k.': '.$$k."\n";}
if($ip==$myip){$ret.=nl2br($ret);
	mail($dest,$suj,$msg,'From: '.$from."\n","");}
else{$ret.="_specify_your_ip_in_source".br();}}
	$f="data/sendmail.txt";//$ret.=lkc("",$f,"txt").br();
	$t.=date("ymd.Hi",time())."\n".$ip."\n".$ret."---\n";
	$t.=read_file($f);
	write_file($f,$t."\n");
	//write_file($f,$t,"a+");
$ret.=self::form($arr,"");
return $ret;}
}
?>