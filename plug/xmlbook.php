<?php
//philum_plugin_xmlbook
session_start();

function bald($bal,$txt){return '<'.$bal.'>'.$txt.'</'.$bal.'>'."\n";}

if($_GET["plug"]==""){
require_once('../params/_connectx.php');
require_once("../progb/pop.php");
require_once("../progb/art.php");
require_once("../progb/spe.php");
require_once("../progb/tri.php");
require_once("../progb/mod.php");
require_once("../progb/lib.php");}
//require_once("../progb/sys.php");
require_once("sys.php");
//require_once("lib.php");
$daya=time();
$dayb=$daya-86400*$_SESSION['nbj'];
if($_GET["plug"]) $plg='?plug='.$_GET["plug"].'&'; else $plg="/plug/xmlbook.php?";
$fxml='data/'.$_SESSION["qb"].'_book.xml';
$flist='data/book_list.txt';

if(!isset($_SESSION["line"]) or $_GET["hub"]!=""){$_SESSION['qb']=$_GET["hub"];
$_SESSION['line']=sql('frm','qda','k','nod = "'.$_SESSION['qb'].'" 
and day < '.$daya.' and day > '.$dayb.' AND re!=""');}

//menus
echo lkc("","/plug/xmlbook","book");
if($_GET["mb"]){$_SESSION['mb']=$_GET["mb"];}
if($_GET["tag"]){$_SESSION['mtg']=$_GET["tag"];}
//else{$_SESSION['mb']="All";}
if(is_array($_SESSION['line'])){$lk=$plg.'mb=';
	$_SESSION['line']["All"]=1;
	asort($_SESSION['line']);
	foreach($_SESSION['line'] as $k=>$fa){
	$css=$_SESSION["mb"]==$k?"txtred":"txtx"; 
	if($k!="user" && $k!=""){$ret.=lkc($css,$lk.$k,$k).' ';}}}
echo divc("tabd",$ret).' ';
//dates
if($_GET["nbjb"]){$_SESSION['nbjb']=$_GET["nbjb"];}
//else{$_SESSION['nbjb']="365";}
$nbjs=array(1=>"1",7=>"7",30=>"30",90=>"90",365=>"365");
$lk=$plg.'nbjb=';$ret="";
	foreach($nbjs as $k=>$fa){
	$css=$_SESSION["nbjb"]==$k?"txtred":"txtx";
	$ret.=lkc($css,$lk.$k,$k).' ';}
echo divc("tabd",$ret).' ';
//daybb
$daybb=$daya-86400*$_SESSION['nbjb'];

//heads
if($_GET["plug"]==""){
$title='xmlbook';
$rh[]['css']='../css/_admin.css';
$rh[]['css_in']='
body { font-family: Georgia; }
#page {	width:600px; font-size:18px; }
.txtfrmb { font-family: Times ; }
.titres { font-size:24px; }
.justy { font-size:16px; }';
echo headers_r($title,$rh);
echo '<body"><center><div id="page" class="tabd">';}

//render
if($_SESSION["mb"]!="All"){$cate=' and frm ="'.$_SESSION["mb"].'"';}
if($_SESSION["mtg"]!="All"){$cate.=' and thm LIKE "%'.$_SESSION["mtg"].'%"';}
if($_SESSION["prmb"][9]==""){$ordr="day DESC";}else{$ordr=$_SESSION["prmb"][9];}
if($_GET["req"]){$r=make_list_arts($_GET["req"]); $plg.='req='.$_GET["req"].'&';
//echo 'req=cat=futur|present|dream|politic~from=01-01-11~until=31-12-12';
if($r)foreach($r as $k=>$v){$sq.='id='.$k.' OR ';} $sq=substr($sq,0,-4);
$rq=res("id,day,mail,frm,suj,img,nod,thm,re,lu,host",$qda.' WHERE '.$sq);}
else{$rq=res("id,day,mail,frm,suj,img,nod,thm,re,lu,host",$qda.' WHERE nod = "'.$_SESSION['qb'].'" and day < '.$daya.' and day > '.$daybb.' '.$cate.' ORDER BY '.$ordr.'');}
$rqt=tri_cache($rq);

//print_r($rqt);
if($_GET["tej"]){$_SESSION["keep"][$_GET["tej"]]=1;}
if($_GET["rec"]){$_SESSION["keep"][$_GET["rec"]]="";}
if($_GET["all"]){$_SESSION["keep"]="";}
echo lkc("txtbox",$plg.'all==',"all_arts").' | ';
if($_SESSION["auth"]>4){}
	echo lkc("txtbox",$plg.'save_xml==',"save_xml").' | ';
	echo lkc("txtbox",$plg.'save_list==',"save_list").' ';
	if(is_file($flist))echo lkt('txtyl" title="?req=',$flist,"see").' | ';
echo lkc("txtbox",$plg.'req=cat=cat1|cat2~from=01-01-12~until=31-12-12',"req").' ';
//echo input();

if(is_array($rqt)){
foreach($rqt as $id=>$cnt){
if(is_numeric($id)){
	if(!$_GET["save_xml"]){
	if(!$_SESSION["keep"][$id]){$tj=lkc("",$plg.'tej='.$id.'#top'.$ida,"x");
		if($_GET["save_list"]){$rtd.=$id.'|';}}
	else{$tj=lkc("",'?rec='.$id,"+");}
$ida=$id;}
$rstr13=$_SESSION['rstr'][13]; $_SESSION['rstr'][13]=1;
if(!$_SESSION["keep"][$id]){$rtb.='<a name="top'.$id.'">';
$rtb.=date($_SESSION["prmb"][17],$cnt[0]).' '.lkc("",'#'.$id,$cnt[2]).' ['.art_lenght($cnt[8]).'] '.$tj.br();}//menu
else{
$rtc.=date($_SESSION["prmb"][17],$cnt[0]).' <small>'.lkc("",'#'.$id,$cnt[2]).' '.art_lenght($cnt[8]).'</small> '.$tj.br();}
if(!$_SESSION["keep"][$id]){
$rtr.='<a name="'.$id.'">';
$rtr.=lkc("",'#top'.$id,"^").divc("titres",$cnt[2]).br();
$rtr.='<div class="txtfrmb">';
$rtr.='<div class="txtb">';
$rtr.=''.date($_SESSION["prmb"][17],$cnt[0]).' ';
$rtr.=art_lenght($cnt[8]).' ';
$rtr.=lkt('','/'.$id,'>');
$rtr.=br().br();
$rtr.='</div>';
$rtr.='<div class="justy">';
$msg=rse("msg",$_SESSION["qdm"].' WHERE id="'.$id.'"');
	$msg=correct_txt($msg,'striplink','correct');
	$msg=format_txt($msg,"nl",$id);
$rtr.=$msg;
$rtr.='</div>';
$rtr.='</div>';
$rtr.=br().hr().br();
$duree+=$cnt[8];
if($_GET["save_xml"]){$i++;
	$xml.=bald("id",$id);
	$xml.=bald("title",$cnt[2]);
		$length=art_lenght($cnt[8]);
		$length=str_replace("< ","",$length);
	$xml.=bald("category",$cnt[1]);
	$xml.=bald("date",date($_SESSION["prmb"][17],$cnt[0]));
	$xml.=bald("lenght",$length);
	$xml.=bald("link",$id);//$_SERVER['HTTP_HOST'].'/'.
	//$xml.=bald("nfo",date($_SESSION["prmb"][17],$cnt[0]).' '.$cnt[1].' '.$length.' '.$id);
		//$msg=correct_txt($msg,'stripconn','correct');
		//$msg=format_txt($msg,"nl",$id);
	//$msg=str_replace("<br />","\n",$msg);
	//$msg=str_replace(array("<",">"),"",$msg);
	//$msg=parse_msg_xml($msg);
	$msg=strip_tags($msg);
	$xml.=bald("description",$msg);
$xml=str_replace("&nbsp;"," ",$xml);
$xml=html_entity_decode($xml);
$xml=html_entity_decode_b($xml);
$item='item';//
//$item='item'.$id;
//$item=normalize($cnt[2]);//eradic_acc
$xml_out.=bald($item,$xml);}
//::'.$i.'::'.$id
$xml="";
}}}}
//$rtr.=tracks_read($id,$page,$share,"nl",$nb);
$_SESSION['rstr'][13]=rstr13;

$xml='<'.'?xml version="1.0" encoding="iso-8859-1" ?'.'>'."\n"; //
//$xml.=bald('channel',$xml_out);
$xml.='<rss version="2.0">'."\n"; 
$xml.=$xml_out;
$xml.="</rss>";
//$xml.="</xml>";

if($_GET["save_xml"]){write_file($fxml,$xml);
echo lkc("txtyl",$fxml,"xml");}

if($_GET["save_list"]){write_file($flist,'list='.$rtd);}

//$ret=output($rqt,$page,$share,$media);
echo divc("titres", $_SESSION["qb"]).' ';
echo art_lenght($duree).br().br();
echo $rtb.br().hr().br();
echo $rtc.br().hr().br();
echo $rtr;

if($_GET["plug"]==""){
//eye_b($read);
//echo footer($startime);
}

echo '</div></center></body></html>';

?>